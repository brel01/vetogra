<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
session_start();
include("snake.php");
include("functions.php");

function sendMail($fname, $uname, $uemail, $code){
  $message = "
                          <center><img src='https://spiritanssounds.com/logo3.jpeg' /></center>
                        <center><h2>Vetogra</h2>
                        <p>".$fname."</p>
                        <p>Password Recovery</p>
                        <p>Click on the Link below</p>
                        <a href='http://192.168.0.109/vetogra/submit_password?v=".$code."&u=".$uname."'>Change Password</a>
                        </center>
                      ";

                      //Load phpmailer
                        require 'vendor/autoload.php';

                        $mail = new PHPMailer(true);
                        try {
                            //Server settings
                            $mail->isSMTP();
                            $mail->Host = 'spiritanssounds.com';
                            $mail->SMTPAuth = true;
                            $mail->Username = 'info@spiritanssounds.com';
                            $mail->Password = '@spiritanssounds.com';
                            $mail->SMTPOptions = array(
                                'ssl' => array(
                                'verify_peer' => false,
                                'verify_peer_name' => false,
                                'allow_self_signed' => true
                                )
                            );
                            $mail->SMTPSecure = 'ssl';
                            $mail->Port = 465;

                            $mail->setFrom('info@spiritanssounds.com');

                            //Recipients
                            $mail->addAddress($uemail);
                            $mail->addReplyTo('info@spiritanssounds.com');

                            //Content
                            $mail->isHTML(true);
                            $mail->Subject = 'Forgot Password';
                            $mail->Body    = $message;

                            $mail->send();

                            return "success";

                        }
                        catch (Exception $e) {
                         //   $_SESSION['error'] = 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
                            $message = 'Message could not be sent. Mailer Error: ';
                               // $error = json_encode($message);
                               return $message;
                             };
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
