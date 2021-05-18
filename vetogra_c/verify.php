<?php
include("snake.php");
if(isset($_GET)){
  $uname = $_GET['u'];
  $v_code = $_GET['i'];

  $query = $snake_dbh->prepare("SELECT id FROM users WHERE username=? && v_code=?");
  $query->execute([$uname, $v_code]);
  if($query->rowCount() > 0){
    $s = "";
    $one = 1;
    $qry = $snake_dbh->prepare("UPDATE users SET verified=?, v_code=? WHERE username=?");
    $qry->execute([$one, $s, $uname]);
    if($qry){
      $qy = $snake_dbh->prepare("SELECT id FROM users WHERE username=? && verified=1 && v_code=? ");
      $qy->execute([$uname, $s]);
      if($qy->rowCount() == 1){
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
