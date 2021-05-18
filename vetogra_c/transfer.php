<?php
    require('./coinpayments.inc.php');
	$cps = new CoinPaymentsAPI();
	$cps->Setup('4fA9410575b00D43fd7144518473c3F0E700Ff23A868d403b7ed6f555Cb6fE6a', '32b5d4f5aaed69e4993d85e6f9d9cd15644997cc8c7855661e3b26328ce67880');

	$result = $cps->CreateWithdrawal(0.03772100, 'ETH', '0x5dad17d45bc2b314205bf5686b2965d9406f8d88');
	if ($result['error'] == 'ok') {
		print 'Withdrawal created with ID: '.$result['result']['id'];
	} else {
		print 'Error: '.$result['error']."\n";
	}
?>