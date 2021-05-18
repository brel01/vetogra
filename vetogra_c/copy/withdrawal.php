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
            $spill_row = $qry_spill->fetchAll(PDO::FETCH_ASSOC);
            $spill_amount = $spill_row['spill_amt'];
          }else{
            $spill_amount = 0;
          }
          $additon = $gas_total + $spill_amount;
          if($additon == $task_bal){
            $error = "Success";
            $msg = json_encode($error);
            echo $msg;
          }else{
            $error = "Error";
            $msg = json_encode($spill_amount);
            var_dump($spill_row);
            echo $msg;
          }
        }else{
          $error = "Error occured during processing5";
          $msg = json_encode($error);
          echo $msg;
        }
      }else{
        $error = "Error occured during processing4";
        $msg = json_encode($error);
        echo $msg;
      }
    }else{
      $error = "Error occured during procesing3";
      $msg = json_encode($error);
      echo $msg;
    }
  }else{
    $error = "Error occured during procesing2";
    $msg = json_encode($error);
    echo $msg;
  }
}else{
  $error = "Error occured during procesing1";
  $msg = json_encode($error);
  echo $msg;
}
?>
