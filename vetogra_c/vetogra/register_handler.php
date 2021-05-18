<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
session_start();
include("snake.php");
include("functions.php");
if(isset($_POST)){
  $json = file_get_contents('php://input');
  $resp = $_POST;
  $fname = $resp['fname'];
  $uname = $resp['uname'];
  $uemail = $resp['uemail'];
  $country = $resp['country'];
  $pwd = $resp['pwd'];

  function sendMail($fname, $uname, $uemail, $vcode){
    $message = "
                            <center><img src='https://spiritanssounds.com/logo3.jpeg' /></center>
                					<center><h2>VETOGRA</h2>
                					<p>".$fname."</p>
                					<p>Your Registration Is Successfull</p>
                					<p>Thank You For Registering With Us</p>
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


                			    }
                			    catch (Exception $e) {
                			     //   $_SESSION['error'] = 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
                			        $message = 'Message could not be sent. Mailer Error: ';
                                 // $error = json_encode($message);
                                 return $message;
                               };
  }

  if(strlen($fname) > 0){
    if(strlen($uname) > 0){
      $check_uname = checkUname($uname);
      if($check_uname == "success"){
        if(strlen($uemail) > 0){
          $check_uemail = checkUemail($uemail);
          if(filter_var($uemail,FILTER_VALIDATE_EMAIL)){
            if($check_uemail == "success"){
              if(strlen($pwd) > 7){
                $p_rand = "1234567890qwertyuiopasdfghjkzxcvbnm";
                $pepper = str_shuffle($p_rand);
                $pwd_p = hash_hmac("sha256", $pwd, $pepper);
                $password = password_hash($pwd_p, PASSWORD_DEFAULT);
                $u_id = generate_uid();
                $date = time();
                $v_rand = "8mn4bvcx2zlkjhgfdsapoiuytrewq0987654212";
                $v_r = str_shuffle($v_rand);
                $vcode = substr($v_r,0,16);
                $ref_code = generate_ref_code();
                $referrer = $resp['referrer'];
                if(strlen($resp["referrer"]) == 0){
                  $referred = "NO";
                  // $ee = $snake_dbh->prepare("SELECT user_id FROM veto_tasks WHERE task_ended=0 && task_payment_status=1");
                }else{
                  $referred = "YES";
                }

                $query = $snake_dbh->prepare("INSERT INTO users(_unique_id_, fullname, username, useremail, country, v_code, password, pepper, reg_date, referral_code, upline_ref_code, referred) VALUE (?,?,?,?,?,?,?,?,?,?,?,?)");
                $query->execute([$u_id, $fname, $uname, $uemail, $country, $vcode, $password, $pepper, $date, $ref_code, $referrer, $referred]);
                if($query){
                  $qy = $snake_dbh->prepare("SELECT id FROM users WHERE useremail=?");
                  $qy->execute([$uemail]);
                  if($qy->rowCount() == 1){
                    $errror = sendMail($fname, $uname, $uemail, $vcode);
                    $_SESSION["_@_uemail"] = $uemail;
                    $error = "success";
                    $msg = json_encode($error);
                    echo $msg;
                  }else{
                    $error = "Error occured during process";
                    $msg = json_encode($error);
                    echo $msg;
                  }
                }else{
                  $error = "Error occured during process";
                  $msg = json_encode($error);
                  echo $msg;
                }
              }else{
                $error = "Invaild Password";
                $msg = json_encode($error);
                echo $msg;
              }
            }else{
              $error = "Email Already Exist";
              $msg = json_encode($check_uemail);
              echo $msg;
            }
          }else{
            $error = "Invalid Email";
            $msg = json_encode($error);
            echo $msg;
          }
        }else{
          $error = "Invaild Email";
          $msg = json_encode($error);
          echo $msg;
        }
      }else{
        $error = "Username taken";
        $msg = json_encode($error);
        echo $msg;
      }
    }else{
      $error = "Invalid Username";
      $msg = json_encode($error);
      echo $msg;
    }
  }else{
    $error = "Invalid Fullname";
    $msg = json_encode($error);
    echo $msg;
  }
}
?>
