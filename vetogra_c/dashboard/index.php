<?php
session_start();
include("../functions.php");
include("../snake.php");
$uname = get_uname($_SESSION["_@_uemail"]);
$address = get_address($_SESSION["_@_uemail"]);
if(!isset($_SESSION["@snake_id"])){
  header('location: ../');
}

if(isset($_SESSION["@snake_id"])){
  $qri = $snake_dbh->prepare("SELECT id FROM users WHERE _unique_id_=?");
  $qri->execute([$_SESSION["@snake_id"]]);
  if($qri->rowCount() != 1){
    header('location: ../logout');
  }else{
    null;
  }
}

$rt = $snake_dbh->prepare("SELECT id FROM users WHERE useremail=? && verified=1");
$rt->execute([$_SESSION["_@_uemail"]]);
if($rt->rowCount() !== 1){
    header('location: ../verify');
}

if(strlen($address) > 0){
  include("../dashboard.php");
}else{
  include("../address.php");
}
?>
