<?php
session_start();
include("snake.php");
include("functions.php");

if(isset($_POST)){
//   $json = file_get_contents('php://input');
  $resp = $_POST;

  $uemail = $resp['uemail'];
  $pwd = $resp['pwd'];

  if(strlen($uemail) > 0){
    if(filter_var($uemail, FILTER_VALIDATE_EMAIL)){
      if(strlen($pwd) > 7){
        // error response means the email exists
        $checkemail = checkUemail($uemail);
        if($checkemail == "error"){
          $query = $snake_dbh->prepare("SELECT password, pepper FROM users WHERE useremail=?");
          $query->execute([$uemail]);
          $row = $query->fetchAll(PDO::FETCH_ASSOC)[0];
          $pepper = $row['pepper'];
          $pwd_hashed = hash_hmac("sha256", $pwd, $pepper);

          $password = $row['password'];

          if(password_verify($pwd_hashed, $password)){
            $qry = $snake_dbh->prepare("SELECT _unique_id_, eth_address, verified FROM users WHERE useremail=?");
            $qry->execute([$uemail]);
            $rw = $qry->fetchAll(PDO::FETCH_ASSOC)[0];
            $_SESSION["@snake_id"] = $rw['_unique_id_'];
            $_SESSION["_@_uemail"] = $uemail;
            if($rw['verified'] == 1){
              if(strlen($rw['eth_address']) > 0){
                $error = "success";
                $msg = json_encode($error);
                echo $msg;
              }else{
                $error = "no eth address";
                $msg = json_encode($error);
                echo $msg;
              }
            }else{
              $error = "not verified";
              $msg = json_encode($error);
              echo $msg;
            }
          }else{
            $error = "Incorrect Password";
            $msg = json_encode($error);
            echo $msg;
          }
        }else{
          $error = "Invalid details";
          $msg = json_encode($error);
          echo $msg;
        }
      }else{
        $error = "Invalid Password";
        $msg = json_encode($error);
        echo $msg;
      }
    }else{
      $error = "Invaild email";
      $msg = json_encode($error);
      echo $msg;
    }
  }else{
    $error = "Invalid email";
    $msg = json_encode($error);
    echo $msg;
  }
}
?>
