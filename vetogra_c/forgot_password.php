<?php
use Mailgun\Mailgun;
require 'mailgun/vendor/autoload.php';
session_start();
include("snake.php");
include("functions.php");

function sendMail($fname, $uname, $uemail, $code){
  $link = "http://192.168.0.109/vetogra/submit_password?v=".$code."&u=".$uname."";
  $mgClient = Mailgun::create('1100d4c80cd552c7611e601ef1334245-7cd1ac2b-9d16bc62', 'https://api.mailgun.net/v3/mg.vetogra.com');
  $domain = "mg.vetogra.com";
  $params = array(
      'from'                  => 'no reply <noreply@vetogra.com>',
      'to'                    => $uemail,
      'subject'               => 'Forgot Password',
      'template'              => 'forgot5',
      'v:fname'  => $fname,
      'v:link'   => $link
      );

  # Make the call to the client.
  $result = $mgClient->messages()->send($domain, $params);
  if($result){
    return "success";
  }else{
    return "error occured during processing";
  }
}

if(isset($_POST)){
  $uemail = $_POST['uemail'];
  if(filter_var($uemail,FILTER_VALIDATE_EMAIL)){
    $query = $snake_dbh->prepare("SELECT fullname, username, useremail FROM users WHERE useremail=?");
    $query->execute([$uemail]);
    if($query){
      // var_dump($query);
      if($query->rowCount() == 1){
        $dig = "qwertyuiopasdfghjklzxcvbnm1234567890POIUYTREWQASDFGHJKLZXCVBNM";
        $shuf = str_shuffle($dig);
        $value = substr($shuf,0,16);
        $code = $value;
        $rows = $query->fetchAll(PDO::FETCH_ASSOC)[0];
        $fname = $rows['fullname'];
        $uname = $rows['username'];
        $qry = $snake_dbh->prepare("UPDATE users SET forgot_pwd_key=? WHERE useremail=?");
        $qry->execute([$value, $uemail]);
        if($qry){
            $send_mail = sendMail($fname, $uname, $uemail, $code);
            if($send_mail = "success"){
              $error = "success";
              $msg = json_encode($error);
              echo $msg;
            }else{
              $error = "Error occured during processing";
              $msg = json_encode($error);
              echo $msg;
            }
        }else{
          $error = "Error occured durgin processing";
          $msg = json_encode($error);
          echo $msg;
        }
      }else{
        $error = "Invalid email";
        $msg = json_encode($error);
        echo $msg;
      }
    }else{
      $error = 'Error occured during processing';
      $msg = json_encode($error);
      echo $msg;
    }
  }else{
    $error = "Invaid Email";
    $msg = json_encode($error);
    echo $msg;
  }
}else{
  $error = "Error occured during processing";
  $msg = json_encode($error);
  echo $msg;
}
?>
