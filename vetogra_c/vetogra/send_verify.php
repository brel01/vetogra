<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
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

      $message = "
                              <center><img src='https://spiritanssounds.com/logo3.jpeg' /></center>
                  					<center><h2>VETOGRA</h2>
                  					<p>".$fname."</p>
                  					<p>Your Registration Is Successfull</p>
                  					<p>Welcome to the veto community of crypto</p>
                            <a href='http://192.168.0.109/vetogra/verification?v=".$vcode."&u=".$uname."'>Verify</a>
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
                  			        $mail->Subject = 'Registration Successful';
                  			        $mail->Body    = $message;

                  			        $mail->send();

                                $error = 'success';
                                $msg = json_encode($error);
                                echo $msg;
                  			    }
                  			    catch (Exception $e) {
                  			      $error = 'Verification Message could not be sent.';
                              $msg = json_encode($error);
                              echo $msg;
                            };
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
