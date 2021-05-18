<?php
// session_start();
// include("snake.php");
// include("functions.php");
/*
	CoinPayments.net API Example
	Copyright 2014-2018 CoinPayments.net. All rights reserved.
	License: GPLv2 - http://www.gnu.org/licenses/gpl-2.0.txt
*/
	require('./coinpayments.inc.php');
	$cps = new CoinPaymentsAPI();
	$cps->Setup('FdCC8CA80f8d64DF9750312e5842Ca80a23c012629c68ceC5FF752768Bc7b965', 'df74d2a671890e832753129ddceef678418989ec82937bb606b06bfa951a94cd');

	$req = array(
		'amount' => $gas_fee,
		'currency1' => 'ETH',
		'currency2' => 'ETH',
		'buyer_email' => '',
		'item_name' => $task_type.'Veto Task Description',
		'address' => '', // leave blank send to follow your settings on the Coin Settings page
		'ipn_url' => 'https://metricplux/ipn.php',
	);
	// See https://www.coinpayments.net/apidoc-create-transaction for all of the available fields

	$result = $cps->CreateTransaction($req);
	if ($result['error'] == 'ok') {
		$le = php_sapi_name() == 'cli' ? "\n" : '<br />';
		// print 'Transaction created with ID: '.$result['result']['txn_id'].$le;
		// print 'Buyer should send '.sprintf('%.08f', $result['result']['amount']).' ETH'.$le;
		// print 'Status URL: '.$result['result']['status_url'].$le;
		// $output .= 'Address for buyer to send to: ' . $result['result']['address'] . '<br>';
		$txn_id = $result['result']['txn_id'];
		$amount = $result['result']['amount'];
		$address = $result['result']['address'];
		// json_decode($result);
		// var_dump($result);
		$checkout_url = $result['result']['checkout_url'];
		$status_url = $result['result']['status_url'];
		$qrcode_url = $result['result']['qrcode_url'];
		$trans_id = generate_trans_id();
		$u_id = $_SESSION['@snake_id'];
		$u_email = $_SESSION['_@_uemail'];
		$date = time();
		$query = $snake_dbh->prepare("INSERT INTO eth_deposit_trans(eth_d_trans_id, eth_d_uid, eth_d_uemail, eth_d_amount, eth_d_date, eth_d_address, eth_d_txn_id, checkout_url, status_url, qrcode_url, task_id) VALUE (?,?,?,?,?,?,?,?,?,?,?)");
		$query->execute([$trans_id, $u_id, $u_email, $amount, $date, $address, $txn_id, $checkout_url, $status_url, $qrcode_url, $t_id]);
		if($query){
			$qry = $snake_dbh->prepare("SELECT id FROM eth_deposit_trans WHERE eth_d_trans_id=? ");
			$qry->execute([$trans_id]);
			if($qry->rowCount() == 1){
				$qry_u = $snake_dbh->prepare("UPDATE veto_tasks SET eth_deposit_id=? WHERE task_id=?");
				$qry_u->execute([$trans_id, $t_id]);
				$data = ["msg"=>"success", "txn_id"=>$txn_id, "amount"=>$amount, "address"=>$address, "checkout_url"=>$checkout_url, "status_url"=>$status_url, "qrcode_url"=>$qrcode_url ];
				$msg = json_encode($data);
				echo $msg;
			}else{
				$error = "error occured during procesing";
				$data = ["msg"=>$error];
				$msg = json_encode($data);
				echo $msg;
			}
		}else{
			$error = "error occured during procesing";
			$data = ["msg"=>$error];
			$msg = json_encode($data);
			echo $msg;
		}

	} else {
		print 'Error: '.$result['error']."\n";
	}

?>
