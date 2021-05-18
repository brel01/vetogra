<?php
session_start();
include("snake.php");
include("functions.php");
if($_POST){
  $task_id = $_POST['task_id'];
  $user_id = $_SESSION['@snake_id'];
  $query = $snake_dbh->prepare("SELECT task_id, eth_task_amt, eth_task_bal FROM veto_tasks WHERE user_id=? && task_id=? && task_payment_status=1 && task_ended=1");
  $query->execute([$user_id, $task_id]);
  if($query){
    if($query->rowCount() == 1){
      $row = $query->fetchAll(PDO::FETCH_ASSOC)[0];
      $task_amt = $row['eth_task_amt'];
      $task_bal = $row['eth_task_bal'];
      $qry_s = $snake_dbh->prepare("SELECT SUM(gas_amt) AS gas_total FROM veto_gas WHERE upline_usr_id=? && upline_task_id=?");
      $qry_s->execute([$user_id, $task_id]);
      if($qry_s){
        $row_s = $qry_s->fetch(PDO::FETCH_ASSOC);
        $gas_total = $row_s['gas_total'];

        $qry_spill = $snake_dbh->prepare("SELECT spill_amt FROM spillovers WHERE spill_usr_id=? && spill_task_id=?");
        $qry_spill->execute([$user_id, $task_id]);
        if($qry_spill){
          if($qry_spill->rowCount() > 0){
            $spill_row = $qry_spill->fetchAll(PDO::FETCH_ASSOC)[0];
            $spill_amount = $spill_row['spill_amt'];
            // var_dump($spill_row);
          }else{
            $spill_amount = 0;
          }
          $addition = $gas_total + $spill_amount;
          if($addition >= $task_bal){
            $qqqq = $snake_dbh->prepare("SELECT eth_task_amt FROM veto_tasks WHERE task_id=?");
            $qqqq->execute([$task_id]);
            $r_r_q = $qqqq->fetchAll(PDO::FETCH_ASSOC)[0];
            $amt = $r_r_q['eth_task_amt'];
            $error = ["msg"=>"success", "amt"=>$amt];
            $msg = json_encode($error);
            echo $msg;
          }else{
            $error = ["msg"=>"Error occured during processing"];
            $msg = json_encode($error);
            echo $msg;
          }
        }else{
          $error = ["msg"=>"Error occured during processing"];
          $msg = json_encode($error);
          echo $msg;
        }
      }else{
        $error = ["msg"=>"Error occured during processing"];
        $msg = json_encode($error);
        echo $msg;
      }
    }else{
      $error = ["msg"=>"Error occured during processing"];
      $msg = json_encode($error);
      echo $msg;
    }
  }else{
    $error = ["msg"=>"Error occured during processing"];
    $msg = json_encode($error);
    echo $msg;
  }
}else{
  $error = ["msg"=>"Error occured during processing"];
  $msg = json_encode($error);
  echo $msg;
}
?>
