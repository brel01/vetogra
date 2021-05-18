<?php
include("snake.php");
include("functions.php");
session_start();
if(isset($_SESSION['@snake_id'])){
  $q = $snake_dbh->prepare("SELECT id FROM users WHERE _unique_id_=?");
  $q->execute([$_SESSION['@snake_id']]);
  if($q->rowCount() == 1){
    $task_id = $_POST['task_id'];
    $user_id = $_SESSION['@snake_id'];
    $query = $snake_dbh->prepare("SELECT task_id, eth_task_amt, eth_task_bal FROM veto_tasks WHERE user_id=? && task_id=? && task_payment_status=1 && task_ended=1");
    $query->execute([$user_id, $task_id]);
    if($query){
      if($query->rowCount() == 1){
        $row = $query->fetchAll(PDO::FETCH_ASSOC)[0];
        $task_amt = $row['eth_task_amt'];
        $task_bal = $row['eth_task_bal'];
        $qry_s = $snake_dbh->prepare("SELECT SUM(gas_amt) AS gas_total FROM veto_gas WHERE upline_usr_id=? && upline_task_id=?");
        $qry_s->execute([$user_id, $task_id]);
        if($qry_s){
          $row_s = $qry_s->fetch(PDO::FETCH_ASSOC);
          $gas_total = $row_s['gas_total'];

          $qry_spill = $snake_dbh->prepare("SELECT spill_amt FROM spillovers WHERE spill_usr_id=? && spill_task_id=?");
          $qry_spill->execute([$user_id, $task_id]);
          if($qry_spill){
            if($qry_spill->rowCount() > 0){
              $spill_row = $qry_spill->fetchAll(PDO::FETCH_ASSOC)[0];
              $spill_amount = $spill_row['spill_amt'];
            }else{
              $spill_amount = 0;
            }
            $additon = $gas_total + $spill_amount;
            if($additon >= $task_bal){
              $w_qry = $snake_dbh->prepare("SELECT user_id, eth_task_amt FROM veto_tasks WHERE task_id=?");
              $w_qry->execute([$task_id]);
              if($w_qry->rowCount() > 0){
                $r_qry = $w_qry->fetchAll(PDO::FETCH_ASSOC)[0];
                $u_id = $r_qry['user_id'];
                $ww_qry = $snake_dbh->prepare("SELECT useremail, eth_address FROM users WHERE _unique_id_=?");
                $ww_qry->execute([$u_id]);
                if($ww_qry->rowCount() == 1){
                  $rr_qry = $ww_qry->fetchAll(PDO::FETCH_ASSOC)[0];
                  $u_email = $rr_qry['useremail'];
                  $eth_add = $rr_qry['eth_address'];

                  function gen_wth_id(){
                    global $snake_dbh;
                    $strings = "1234567890qwertyuioplkjhgfdsazxcvbnmMNBVCXZLKJHGFDSAPOIUYTREWQ";
                    $str_s = str_shuffle($strings);
                    $val = substr($str_s,0,24);
                    $wth_id = "w_t_".$val;
                    $find = $snake_dbh->prepare("SELECT id FROM eth_withdraw_trans WHERE wth_id=?");
                    $find->execute([$wth_id]);
                    if($find->rowCount() == 0){
                      return $wth_id;
                    }else{
                      gen_wth_id();
                    }
                  }
                  $s_find = $snake_dbh->prepare("SELECT id FROM eth_withdraw_trans WHERE wth_task_id=? && (pending=1 || success=1)");
                  $s_find->execute([$task_id]);
                  if($s_find->rowCount() == 0){
                    $one = 1;
                    $u_qry = $snake_dbh->prepare("UPDATE veto_tasks SET pending_w=? WHERE task_id=?");
                    $u_qry->execute([$one, $task_id]);

                    $wth_id = gen_wth_id();
                    $date = time();
                    $one = 1;
                    $w_query = $snake_dbh->prepare("INSERT INTO eth_withdraw_trans(wth_id, wth_uid, wth_task_id, wth_uemail, wth_amount, wth_d_address, wth_date, pending) VALUE (?,?,?,?,?,?,?,?)");
                    $w_query->execute([$wth_id, $u_id, $task_id, $u_email, $task_amt, $eth_add, $date,$one]);
                    if($w_query){
                      $error = "success";
                      $msg  = json_encode($error);
                      echo $msg;
                    }else{
                      $error = 'Error occured during procesing';
                      $msg  = json_encode($error);
                      echo $msg;
                    }
                  }else{
                    $error = "Error occured during processing";
                    $msg  = json_encode($error);
                    echo $msg;
                  }
                }else{
                  $error = "Error occured during processing";
                  $msg  = json_encode($error);
                  echo $msg;
                }
              }else{
                $error = "Error occured during processing";
                $msg  = json_encode($error);
                echo $msg;
              }
            }else{
              $error = "Error";
              $msg  = json_encode($error);
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
        $error = "Error occured during procesing";
        $msg = json_encode($error);
        echo $msg;
      }
    }else{
      $error = "Error occured during procesing";
      $msg = json_encode($error);
      echo $msg;
    }
  }else{
    $error = "Error occured during processing";
  }
}else{
  $error = "Error occured during processing";
}
?>
