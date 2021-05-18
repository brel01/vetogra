<?php
session_start();
include("snake.php");
include("functions.php");

$query = $snake_dbh->prepare("SELECT id FROM users WHERE useremail=? && verified=1");
$query->execute([$_SESSION["_@_uemail"]]);
if($query->rowCount() == 1){
  $msg = "success";
  $msg = json_encode($msg);
  echo $msg;
}else{
  $msg = "no";
  $msg = json_encode($msg);
  echo $msg;
}
?>
