<?php
session_start();
include("snake.php");
include("functions.php");

if(isset($_POST)){
  if(isset($_SESSION['@snake_id'])){
    $query = $snake_dbh->prepare("SELECT id FROM users WHERE _unique_id_=?");
    $query->execute([$_SESSION['@snake_id']]);
    if($query->rowCount() > 0){
      $qry = $snake_dbh->prepare("UPDATE veto_tasks SET cancled=1 WHERE user_id=? && task_payment_status=0 && cancled=0");
      $qry->execute([$_SESSION['@snake_id']]);
      if($qry){
        $qr = $snake_dbh->prepare("UPDATE eth_deposit_trans SET cancled=1 WHERE eth_d_uid=? && eth_d_status=0 && cancled=0");
        $qr->execute([$_SESSION['@snake_id']]);
        if($qr){
          $error = "success";
          $data = ["msg"=>$error];
          $msg = json_encode($data);
          echo $msg;
        }else{
          $error = "Error occured during procesing";
          $data = ["msg"=>$error];
          $msg = json_encode($data);
          echo $msg;
        }
      }else{
        $error = "Error occured during procesing";
        $data = ["msg"=>$error];
        $msg = json_encode($data);
        echo $msg;
      }
    }else{
      $error = "Error occured during procesing";
      $data = ["msg"=>$error];
      $msg = json_encode($data);
      echo $msg;
    }
  }else {
    $error= "Error occured during procesing";
    $data = ["msg"=>$error];
    $msg = json_encode($data);
    echo $msg;
  }
}
?>
