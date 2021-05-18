<?php
session_start();
include("snake.php");
include("functions.php");
$json = file_get_contents('php://input');
$resp = $_POST;
if(strlen($resp['eth_add']) >= 40){
  $eth_add = $resp['eth_add'];
  $confirm_eth_add = confirm_eth_address($eth_add);
  if($confirm_eth_add == "success"){
    $query = $snake_dbh->prepare("UPDATE users SET eth_address=? WHERE _unique_id_=?");
    $query->execute([$resp['eth_add'], $_SESSION['@snake_id']]);
    if($query){
      $qy = $snake_dbh->prepare("SELECT id FROM users WHERE _unique_id_ =? and eth_address=?");
      $qy->execute([$_SESSION['@snake_id'], $resp['eth_add']]);
      if($qy->rowCount() == 1){
        $error = "success";
        $msg = json_encode($error);
        echo $msg;
      }else{
        $error = "Error occured during processing1";
        $msg = json_encode($error);
        echo $msg;
      }
    }else{
      $error = "Error occured during processing2";
      $msg = json_encode($error);
      echo $msg;
    }
  }else{
    $error = "ETH address have been registered";
  }
}else{
  $error = "Invalid ETH address";
  $msg = json_encode($error);
  echo $msg;
}
?>
