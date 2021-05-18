<?php
include("/var/www/html/snake.php");
include('/var/www/html/c_r_o_n_v/coinpayments/src/CoinpaymentsAPI.php');
include('/var/www/html/c_r_o_n_v/coinpayments/src/keys.php');



function check($task_id, $user_id){
  GLOBAL $snake_dbh;
  // $task_id = $_POST['task_id'];
  // $user_id = $_SESSION['@snake_id'];
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
            $error = "success";
            $msg  = json_encode($error);
            return "success";
          }else{
            $error = "Error";
            $msg  = json_encode($error);
            return $msg;
          }
        }else{
          $error = "Error occured during processing";
          $msg = json_encode($error);
          return $msg;
        }
      }else{
        $error = "Error occured during processing";
        $msg = json_encode($error);
        return $msg;
      }
    }else{
      $error = "Error occured during procesing";
      $msg = json_encode($error);
      return $msg;
    }
  }else{
    $error = "Error occured during procesing";
    $msg = json_encode($error);
    return $msg;
  }
}
/** Scenario: Create a mass withdrawal, demonstrating different values for each withdrawal. **/

// Create a new API wrapper instance
$cps_api = new CoinpaymentsAPI($private_key, $public_key, 'json');

// Setup the withdrawals array values, each as a nested array with it's own unique key.
// The key can contain ONLY a-z, A-Z, and 0-9.
// Withdrawals with empty keys or containing other characters will be silently ignored.
// $query = $snake_dbh->prepare("SELECT id, wth_id, wth_uid, wth_task_id, wth_uemail, wth_amount, wth_d_address FROM eth_withdraw_trans ORDER BY wth_date ASC LIMIT 100");
$query = $snake_dbh->prepare("SELECT id, wth_id, wth_uid, wth_task_id, wth_uemail, wth_amount, wth_d_address FROM eth_withdraw_trans WHERE pending=1 && success=0 && failed=0 ORDER BY wth_date ASC LIMIT 100");
$query->execute();
if($query->rowCount() > 0){
  $withdrawals = [];

  foreach($query as $rows){
    $task_id = $rows['wth_task_id'];
    $check = check($task_id, $rows['wth_uid']);
    if($check == "success"){
      $amount = (90/100)*$rows['wth_amount'];
      // $amount = 0.012;
      $id = "wd".$rows['wth_id'];
      $ind = "wd".$rows['id'];
      $withdrawals[$ind]  = [
          "amount"=>$amount,
          "add_tx_fee"=>1,
          "currency"=>"ETH",
          "currency2"=>"ETH",
          "address"=>$rows['wth_d_address'],
          "ipn_url"=>"https://vetogra/ipn_snake.php",
          "note"=>"Vetogra Withdrawal"
        ];
    }else{
      $error = "errorv";
      //echo $error;
    }
  }

      // Attempt the mass withdrawal API call
      try {
          $mass_withdrawal = $cps_api->CreateMassWithdrawal($withdrawals);
      } catch (Exception $e) {
          //echo 'Error: ' . $e->getMessage();
          exit();
      }

      // Check the result of the API call and generate a result output
      // //echo $rows['wth_d_address'];
      // print_r($mass_withdrawal['result']);
      //echo "<br>";
      // var_dump($withdrawals);
      //echo "<br>";
      // var_dump($withdrawal);
      // var_dump($with);
      if ($mass_withdrawal["error"] == "ok") {
          // $output = '<table><tbody><tr><td>Withdrawal Key</td><td>Error?</td><td>ID</td><td>Status</td><td>Amount</td></tr>';
          foreach ($mass_withdrawal['result'] as $single_withdrawal_result => $single_withdrawal_result_array) {
              $w_d = $single_withdrawal_result;
              $wd = substr($w_d, 2);
              $q = $snake_dbh->prepare("SELECT wth_task_id FROM eth_withdraw_trans WHERE id=?");
              $q->execute([$wd]);
              if($q->rowCount() == 1){
                $r_w = $q->fetchAll(PDO::FETCH_ASSOC)[0];
                $task_id = $r_w['wth_task_id'];
                if ($single_withdrawal_result_array['error'] == 'ok') {
                  $this_id = $single_withdrawal_result_array['id'];
                  if($single_withdrawal_result_array['status'] == 1){
                    $qry_y = $snake_dbh->prepare("UPDATE eth_withdraw_trans SET wth_trans_id=? WHERE wth_task_id=?");
                    $qry_y->execute([$this_id, $task_id]);
                    if($qry_y){
                      //echo "success".$wd;
                    }
                  }else{
                    $zero = 0;
                    $qry = $snake_dbh->prepare('UPDATE veto_tasks SET pending_w=? WHERE task_id=?');
                    $qry->execute([$zero, $task_id]);
                    if($qry){
                      $one = 1;
                      $qry_y = $snake_dbh->prepare("UPDATE eth_withdraw_trans SET pending=?, failed=? WHERE wth_task_id=?");
                      $qry_y->execute([$zero, $one, $task_id]);
                    }
                  }
                } else {
                }
              }else{
                //echo " eewfregerg";
              }
              // if ($single_withdrawal_result_array['error'] == 'ok') {
              //   $this_id = $single_withdrawal_result_array['id'];
              //   if($single_withdrawal_result_array['status'] == 1){
              //     $qry_y = $snake_dbh->prepare("UPDATE eth_withdraw_trans SET wth_id=? WHERE wth_task_id=?");
              //     $qry_y->execute([$this_id, $task_id]);
              //     if($qry_y){
              //       echo "success";
              //     }
              //   }else{
              //     $zero = 0;
              //     $qry = $snake_dbh->prepare('UPDATE veto_tasks SET pending_w=? WHERE task_id=?');
              //     $qry->execute([$zero, $task_id]);
              //     if($qry){
              //       $one = 1;
              //       $qry_y = $snake_dbh->prepare("UPDATE eth_withdraw_trans SET pending=?, failed=? WHERE wth_task_id=?");
              //       $qry_y->execute([$zero, $one, $task_id]);
              //     }
              //   }
              //     $this_status = $single_withdrawal_result_array['status'];
              //     $this_amount = $single_withdrawal_result_array['amount'];
              //     $output .= '<tr><td>' . $single_withdrawal_result . '</td><td>ok</td><td>' . $this_id . '</td><td>' . $this_status . '</td><td>' . $this_amount . '</td></tr>';
              // } else {
              //     $this_error = $single_withdrawal_result_array['error'];
              //     $output .= '<tr><td>' . $single_withdrawal_result . '</td><td>' . $this_error . '</td><td>n/a</td><td>n/a</td><td>n/a</td></tr>';
              // }
          }
          // $output .= '</tbody></table>';
          //echo $output;
      } else {
        $zero = 0;
        $qry = $snake_dbh->prepare('UPDATE veto_tasks SET pending_w=? WHERE task_id=?');
        $qry->execute([$zero, $task_id]);
        if($qry){
          $one = 1;
          $qry_y = $snake_dbh->prepare("UPDATE eth_withdraw_trans SET pending=?, failed=? WHERE wth_task_id=?");
          $qry_y->execute([$zero, $one, $task_id]);
        }
      }

  // }
}else{

}
