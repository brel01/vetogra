<?php
function checkUemail($uemail){
  GLOBAL $snake_dbh;

  $query = $snake_dbh->prepare("SELECT id FROM users WHERE useremail=?");
  $query->execute([$uemail]);
  if($query->rowCount() == 0){
    $error = "success";
    return $error;
  }else{
    $error = "error";
    return $error;
  }
}

function checkUname($uname){
  GLOBAL $snake_dbh;

  $query = $snake_dbh->prepare("SELECT id FROM users WHERE username=?");
  $query->execute([$uname]);
  if($query->rowCount() == 0){
    $error = "success";
    return $error;
  }else{
    $error = "Username taken";
    return $error;
  }
}

function generate_uid(){
  GLOBAL $snake_dbh;

  $date = time();
  $Alpha22=range("A","Z");
  $Alpha12=range("A","Z");
  $alpha22=range("a","z");
  $alpha12=range("a","z");
  $num22=range(1000,9999);
  $num12=range(1000,9999);
  $numU22=range(99999,10000);
  $numU12=range(99999,10000);
  $AlphaB22=array_rand($Alpha22);
  $AlphaB12=array_rand($Alpha12);
  $alphaS22=array_rand($alpha22);
  $alphaS12=array_rand($alpha12);
  $Num22=array_rand($num22);
  $NumU22=array_rand($numU22);
  $Num12=array_rand($num12);
  $NumU12=array_rand($numU12);
  $res22=$Alpha22[$AlphaB22].$num22[$Num22].$Alpha12[$AlphaB12].$numU22[$NumU22].$alpha22[$alphaS22].$num12[$Num12].$date;
  $retj=str_shuffle($res22);
  $alaye = "$/$/";
  $rak = str_shuffle($retj.$alaye);
  $retjy = str_shuffle($rak);
  $text22=$retjy.$rak.$res22;

  $query = $snake_dbh->prepare("SELECT id FROM users WHERE unique_id=?");
  $query->execute([$text22]);
  if($query->rowCount() == 0){
    return $text22;
  }else{
    return generate_uid();
  }
}

function generate_ref_code(){
  GLOBAL $snake_dbh;

  $data = "0987654321abcdefghijklmnopqrstuvwxyz1234567890";
  $code = str_shuffle($data);
  $ref_code = substr($code,0,6);
  $query = $snake_dbh->prepare("SELECT id FROM users WHERE referral_code=?");
  $query->execute([$ref_code]);
  if($query->rowCount() == 0){
    return $ref_code;
  }else{
    return generate_ref_code();
  }
}

function get_uname($uemail){
  GLOBAL $snake_dbh;

  $query = $snake_dbh->prepare("SELECT username FROM users WHERE useremail=?");
  $query->execute([$uemail]);
  $row = $query->fetchAll(PDO::FETCH_ASSOC)[0];
  $uemail = $row['username'];
  return $uemail;
}

function get_address($uemail){
  GLOBAL $snake_dbh;

  $query = $snake_dbh->prepare("SELECT eth_address FROM users WHERE useremail=?");
  $query->execute([$uemail]);
  $row = $query->fetchAll(PDO::FETCH_ASSOC)[0];
  $address = $row['eth_address'];
  return $address;
}

function confirm_eth_address($eth_add){
  GLOBAL $snake_dbh;

  $query = $snake_dbh->prepare("SELECT id FROM users WHERE eth_address=?");
  $query->execute([$eth_add]);
  if($query->rowCount() == 0){
    $error ="success";
    return $error;
  }else{
    $error = "ETH address have been registered";
    return $error;
  }
}

function generate_task_id(){
  GLOBAL $snake_dbh;
  $pre_task_id = "abcdefghijklmnopqrstuvwxyz0987654321";
  $p_task_id = str_shuffle($pre_task_id);
  $pp_task_id = substr($p_task_id,0,24);
  $date = time();
  $v_t_ = "v_t_";
  $task_id = $v_t_.$pp_task_id.$date;

  $query = $snake_dbh->prepare("SELECT id FROM veto_tasks WHERE task_id=?");
  $query->execute([$task_id]);
  if($query->rowCount() > 0){
    generate_uid();
  }else{
    return $task_id;
  }
}

function generate_trans_id(){
  GLOBAL $snake_dbh;
  $pre_trans_id = "abc432defghijkl987mnopqrstuvwxyz0651";
  $p_trans_id = str_shuffle($pre_trans_id);
  $pp_trans_id = substr($p_trans_id,0,24);
  $date = time();
  $eth_d_ = "eth_d_";
  $trans_id = $eth_d_.$pp_trans_id.$date;

  $query = $snake_dbh->prepare("SELECT id FROM eth_deposit_trans WHERE eth_trans_id=?");
  $query->execute([$trans_id]);
  if($query->rowCount() > 0){
    generate_trans_id();
  }else{
    return $trans_id;
  }
}

function get_gas_num($user_id){
  GLOBAL $snake_dbh;
  $query = $snake_dbh->prepare("SELECT id FROM veto_gas WHERE upline_usr_id=?");
  $query->execute([$user_id]);
  if($query){
    $num = $query->rowCount();
    return $num;
  }else{
    return "error";
  }
}

function ready_to_withdraw_num($user_id){
  GLOBAL $snake_dbh;
  $query = $snake_dbh->prepare("SELECT id FROM veto_tasks WHERE user_id=? && task_ended=1  && task_payment_status=1 && withdrawn=0");
  $query->execute([$user_id]);
  if($query){
    $num = $query->rowCount();
    return $num;
  }else{
    return "error";
  }
}
?>
