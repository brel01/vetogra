<?php
session_start();
include("snake.php");
include("functions.php");

if(isset($_POST)){
  $uemail = $_POST['uemail'];
  if(filter_var($uemail,FILTER_VALIDATE_EMAIL)){
    $pwd = $_POST['pwd'];
    if(strlen($pwd) > 7){
      // $qry = %
      $p_rand = "1234567890qwertyuiopasdfghjkzxcvbnm";
      $pepper = str_shuffle($p_rand);
      $pwd_p = hash_hmac("sha256", $pwd, $pepper);
      $password = password_hash($pwd_p, PASSWORD_DEFAULT);
      $empty = "";
      $query = $snake_dbh->prepare("UPDATE users SET password=?, pepper=?, forgot_pwd_key=? WHERE _unique_id_=? && useremail=?");
      $query->execute([$password, $pepper, $empty, $_SESSION['u_id_'], $uemail]);
      if($query){
        $error = "success";
        $msg = json_encode($error);
        echo $msg;
      }else{
        $error = "Error occured during processing";
        $msg = json_encode($error);
        echo $msg;
      }
    }else{
      $error = "Error occured during processing";
      $msg = json_encode($error);
      echo $msg;
    }
  }else{
    $error = "Error occured during processing";
    $msg = json_encode($error);
    echo $msg;
  }
}else{
  $error = "Error occured during processing";
  $msg = json_encode($error);
  echo $msg;
}
?>
