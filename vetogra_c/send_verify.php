<?php
require 'mailgun/vendor/autoload.php';
use Mailgun\Mailgun;
session_start();
include("snake.php");
include("functions.php");
if(isset($_POST)){
  $json = file_get_contents('php://input');
  $resp = $_POST;
  $uemail = $_SESSION["_@_uemail"];

  $query = $snake_dbh->prepare("SELECT fullname, username, useremail, v_code FROM users WHERE useremail=?");
  $query->execute([$uemail]);
  if($query){
    if($query->rowCount() == 1){
      $rows = $query->fetchAll(PDO::FETCH_ASSOC)[0];
      $fname = $rows['fullname'];
      $uname = $rows['username'];
      $uemail = $rows['useremail'];
      $vcode = $rows['v_code'];

      $link = "https://vetogra.com/verification?v=".$vcode."&u=".$uname."";

      $mgClient = Mailgun::create('1100d4c80cd552c7611e601ef1334245-7cd1ac2b-9d16bc62', 'https://api.mailgun.net/v3/mg.vetogra.com');
      $domain = "mg.vetogra.com";
      $params = array(
          'from'                  => 'no reply <noreply@vetogra.com>',
          'to'                    => $uemail,
          'subject'               => 'Registration Successfull',
          'template'              => 'register4',
          'v:fname'  => $fname,
          'v:link'   => $link,
          'v:link2' => $link
          );

      # Make the call to the client.
      $result = $mgClient->messages()->send($domain, $params);

    }else{
      $error = 'Verification Message could not be sent.';
      $msg = json_encode($error);
      echo $msg;
    }
  }else{
    $error = 'Verification Message could not be sent.';
    $msg = json_encode($error);
    echo $msg;
  }
}
?>
