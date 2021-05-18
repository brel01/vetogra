<?php
session_start();
include("snake.php");
include("functions.php");

if(isset($_POST)){
  if(isset($_SESSION['@snake_id'])){
    $query = $snake_dbh->prepare("SELECT id FROM users WHERE _unique_id_=?");
    $query->execute([$_SESSION['@snake_id']]);
    if($query->rowCount() > 0){
      $qry = $snake_dbh->prepare("SELECT eth_d_amount, eth_d_date, eth_d_address, qrcode_url FROM eth_deposit_trans WHERE eth_d_uid=? && eth_d_status=0 && cancled=0");
      $qry->execute([$_SESSION['@snake_id']]);
      if($qry){
        if($qry->rowCount() == 1){
          $row = $qry->fetchAll(PDO::FETCH_ASSOC)[0];
          $eth_amt = $row['eth_d_amount'];
          $eth_date = $row['eth_d_date'];
          $eth_add = $row['eth_d_address'];
          $qrcode_url = $row['qrcode_url'];
          $data = ["msg"=>"success", "eth_amt"=>$eth_amt, "eth_date"=>$eth_date, "eth_add"=>$eth_add, "qrcode_url"=>$qrcode_url];
          $msg = json_encode($data);
          echo $msg;
        }else{
          $error = "error";
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
