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
    header('location: ../');
  }else{
    null;
  }
}

if(strlen($address) > 0){
  include("../dashboard.php");
}else{
  include("../address.php");
}
?>
