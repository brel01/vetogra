<?php
session_start();
include("snake.php");
include("functions.php");

if(isset($_POST)){
  if(isset($_SESSION['@snake_id'])){
    $query = $snake_dbh->prepare("SELECT id FROM users WHERE _unique_id_=?");
    $query->execute([$_SESSION['@snake_id']]);
    if($query->rowCount() > 0){
      $qry = $snake_dbh->prepare("SELECT task_id, eth_task_amt, eth_task_bal, num_gas_added, task_start_date, task_type FROM veto_tasks WHERE user_id=? && task_ended = 0 && task_payment_status=1");
      $qry->execute([$_SESSION['@snake_id']]);
      if($qry->rowCount() > 0){
        $row = $qry->fetchAll(PDO::FETCH_ASSOC)[0];
        $t_id = $row['task_id'];
        $task_amt = $row['eth_task_amt'];
        $task_bal = $row['eth_task_bal'];
        $num_gas = $row['num_gas_added'];
        $start_date = $row['task_start_date'];
        $type = $row['task_type'];
        $error = "success";

        $date = date('M d Y', $start_date);
            if( $date == date('M d Y')){
              $date = "Today";
            }else if($date == date('M d Y',time() - (24 * 60 * 60))){
                $date = "Yesterday";
            };

        $data = ["msg"=>$error, "t_id"=>$t_id, "type"=>$type, "task_amt"=>$task_amt, "task_bal"=>$task_bal, "num_gas"=>$num_gas, "start_date"=>$date];
        $msg = json_encode($data);
        echo $msg;
      }else{
        $error = "error";
        $data = ["msg"=>$error];
        $msg = json_encode($data);
        echo $msg;
      }
    }else{
      $error  ="Error occured during processing";
      $data = ["msg"=>$error];
      $msg = json_encode($data);
      echo $msg;
    }
  }else{
    $error = "Error occured during processing";
    $data = ["msg"=>$error];
    $msg = json_encode($data);
    echo $msg;
  }
}
?>
