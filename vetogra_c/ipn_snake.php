<?php
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;
include("snake.php");
include("functions.php");
// $r = send_mail("fname", "uname", "arowolajutunde@gmail.com", "vcode");
   // Fill these in with the information from your CoinPayments.net account.
   $cp_merchant_id = '06ee24518be0405810e66efd72e11447';
   $cp_ipn_secret = '123qwerty.0';
   $cp_debug_email = 'vetogra01@gmail.com';

   //These would normally be loaded from your database, the most common way is to pass the Order ID through the 'custom' POST field.
   $order_currency = 'ETH';
   // $order_total = 10.00;

   function errorAndDie($error_msg) {
       global $cp_debug_email;
       if (!empty($cp_debug_email)) {
           $report = 'Error: '.$error_msg."\n\n";
           $report .= "POST Data\n\n";
           foreach ($_POST as $k => $v) {
               $report .= "|$k| = |$v|\n";
           }
           mail($cp_debug_email, 'CoinPayments IPN Error', $report);
       }
       die('IPN Error: '.$error_msg);
   }

   if (!isset($_POST['ipn_mode']) || $_POST['ipn_mode'] != 'hmac') {
       errorAndDie('IPN Mode is not HMAC');
   }

   if (!isset($_SERVER['HTTP_HMAC']) || empty($_SERVER['HTTP_HMAC'])) {
       errorAndDie('No HMAC signature sent.');
   }

   $request = file_get_contents('php://input');
   if ($request === FALSE || empty($request)) {
       errorAndDie('Error reading POST data');
   }

   if (!isset($_POST['merchant']) || $_POST['merchant'] != trim($cp_merchant_id)) {
       errorAndDie('No or incorrect Merchant ID passed');
   }

   $hmac = hash_hmac("sha512", $request, trim($cp_ipn_secret));
   if (!hash_equals($hmac, $_SERVER['HTTP_HMAC'])) {
   //if ($hmac != $_SERVER['HTTP_HMAC']) { <-- Use this if you are running a version of PHP below 5.6.0 without the hash_equals function
       errorAndDie('HMAC signature does not match');
   }

   // HMAC Signature verified at this point, load some variables.

   $ipn_type = $_POST['ipn_type'];

  if ($ipn_type = 'api') { // Advanced Button payment
    // $ko = "ffff";
    //  $fp = $snake_dbh->prepare("INSERT INTO test(name) VALUES (?)");
    //  $fp->execute([$ko]);

    $txn_id = $_POST['txn_id'];
    $item_name = $_POST['item_name'];
    $item_number = $_POST['item_number'];
    $amount1 = floatval($_POST['amount1']);
    $amount2 = floatval($_POST['amount2']);
    $currency1 = $_POST['currency1'];
    $currency2 = $_POST['currency2'];
    $status = intval($_POST['status']);
    $status_text = $_POST['status_text'];

    if ($status >= 100 || $status == 2) {
      $query = $snake_dbh->prepare("SELECT task_id FROM eth_deposit_trans WHERE eth_d_status=0 && eth_d_txn_id=? && cancled=0 && invalid=0");
      $query->execute([$txn_id]);
      if($query){
        if($query->rowCount() > 0){
          $row = $query->fetchAll(PDO::FETCH_ASSOC)[0];
          $task_id = $row['task_id'];
          $amount_paid = $amount1;
          include("_payment.php");
        }else{
          $error = "Error occured during procesing";
        }
      }else{
        $error = "Error occured during procesing";
      }
        // payment is complete or queued for nightly payout, success
    } else if ($status < 0) {
        //payment error, this is usually final but payments will sometimes be reopened if there was no exchange rate conversion or with seller consent
    } else if ($status == 1){
      $query = $snake_dbh->prepare("SELECT task_id FROM eth_deposit_trans WHERE eth_d_status=0 && eth_d_txn_id=?");
      $query->execute([$txn_id]);
      if($query){
        if($query->rowCount() > 0){
            $row = $query->fetchAll(PDO::FETCH_ASSOC)[0];
            $task_id = $row['task_id'];
            $one = 1;
            // $zero = 0;
            $qry = $snake_dbh->prepare("UPDATE eth_deposit_trans SET pending=? WHERE task_id=?");
            $qry->execute([$one, $task_id]);
        }
      }
    }else{
      //payment is pending, you can optionally add a note to the order page
    }
      // die("IPN OK: Not a button payment");
  }

  if($ipn_type = "withdrawal"){
    $id = $_POST['id'];
    $txn_id = $_POST['txn_id'];
    $amount = floatval($_POST['amount']);
    $currency = $_POST['currency'];
    $status = intval($_POST['status']);
    $status_text = $_POST['status_text'];
    if($status == 2){
      // txn_id is being enterd into eth_batch
      $w_qry = $snake_dbh->prepare("UPDATE eth_withdraw_trans SET wth_batch=?, pending=0, success=1 WHERE wth_trans_id=?");
      $w_qry->execute([$txn_id, $id]);
      if($w_qry){
        $w_get = $snake_dbh->prepare("SELECT wth_task_id FROM eth_withdraw_trans WHERE wth_trans_id=?");
        $w_get->execute([$id]);
        if($w_get->rowCount() > 0){
          $w_row = $w_get->fetchAll(PDO::FETCH_ASSOC)[0];
          $w_task_id = $w_row['wth_task_id'];
          $w_query = $snake_dbh->prepare("UPDATE veto_tasks SET withdrawn=1, pending_w=0 WHERE task_id=?");
          $w_query->execute([$w_task_id]);
        }else{
          $error = "error";
        }
      }
    }else if($status == 1 ){
        $error = "pending";
    }else if($status < 0){
      $w_qry = $snake_dbh->prepare("UPDATE eth_withdraw_trans SET wth_batch=?, pending=0, failed=1 WHERE wth_trans_id=?");
      $w_qry->execute([$txn_id, $id]);
      if($w_qry){
        $w_get = $snake_dbh->prepare("SELECT wth_task_id FROM eth_withdraw_trans WHERE wth_trans_id=?");
        $w_get->execute([$id]);
        if($w_get->rowCount() > 0){
          $w_row = $w_get->fetchAll(PDO::FETCH_ASSOC)[0];
          $w_task_id = $w_row['wth_task_id'];
          $w_query = $snake_dbh->prepare("UPDATE veto_tasks SET pending_w=0 WHERE task_id=?");
          $w_query->execute([$w_task_id]);
        }else{
          $error = "error";
        }
      }
    }
  }
   //depending on the API of your system, you may want to check and see if the transaction ID $txn_id has already been handled before at this point

   // Check the original currency to make sure the buyer didn't change it.
//   if ($currency1 != $order_currency) {
//       errorAndDie('Original currency mismatch!');
//   }

   // Check amount against order total
   // if ($amount1 < $order_total) {
   //     errorAndDie('Amount is less than order total!');
   // }

   die('IPN OK');
?>
