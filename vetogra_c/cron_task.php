<?php
include("/var/www/html/snake.php");
$query = $snake_dbh->prepare("SELECT task_id, task_start_date FROM veto_tasks WHERE task_payment_status=0 && cancled=0 && pending=0 ORDER BY task_start_date ASC LIMIT 100");
$query->execute();
if($query){
  if($query->rowCount() > 0){
    foreach($query as $row){
      $task_id = $row['task_id'];
      $s_date = $row['task_start_date'];
      $c_date = time();
      $hr = 60*60;
      $dif = $c_date - $s_date;
      $diff = 2*$dif;
      if($dif >= 7200){
        $one = 1;
        $qry = $snake_dbh->prepare("UPDATE veto_tasks SET cancled=? WHERE task_id=?");
        $qry->execute([$one, $task_id]);
        if($qry){
          $qry_y = $snake_dbh->prepare("UPDATE eth_deposit_trans SET cancled=? WHERE task_id=?");
          $qry_y->execute([$one, $task_id]);
          if($qry_y){
            $error = "success";
            // //echo $error;
          }
        }else{
          $error = "Error occured during processing3";
          // //echo $error;
        }
      }
    }
  }else{
    $error = "Error occured during processing2";
    // //echo $error;
  }
}else{
  $error = "Error occured during processing1";
  // //echo $error;
}
?>
