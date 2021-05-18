<?php
include("../snake.php");
include("../functions.php");

$query = $snake_dbh->prepare("SELECT SUM(eth_d_amount_paid) AS amount  FROM eth_deposit_trans");
$query->execute();
if($query->rowCount() > 0){
  $row = $query->fetchAll(PDO::FETCH_ASSOC)[0];
  echo "one => ".$row['amount']."; ";
  $query_y = $snake_dbh->prepare("SELECT SUM(wth_amount) AS amount FROM eth_withdraw_trans");
  $query_y->execute();
  if($query_y->rowCount() > 0){
    $row_w = $query_y->fetchAll(PDO::FETCH_ASSOC)[0];
    echo "two => ".$row_w['amount']."; ";
    $in_qry = $snake_dbh->prepare("SELECT SUM(gas_amt) AS amount FROM invalid_veto_gas");
    $in_qry->execute();
    if($in_qry->rowCount() > 0){
      $in_row  = $in_qry->fetchAll(PDO::FETCH_ASSOC)[0];
      echo "three => ".$in_row['amount']."; ";
      $spill_qry = $snake_dbh->prepare("SELECT SUM(spill_amt) AS amount FROM spillovers");
      $spill_qry->execute();
      if($spill_qry->rowCount() > 0){
        $spill_row  = $spill_qry->fetchAll(PDO::FETCH_ASSOC)[0];
        echo "four => ".$spill_row['amount']."; ";
        $bin_qry = $snake_dbh->prepare("SELECT SUM(amt) AS amount FROM veto_bin");
        $bin_qry->execute();
        if($bin_qry->rowCount() > 0){
          $bin_row  = $bin_qry->fetchAll(PDO::FETCH_ASSOC)[0];
          echo "five => ".$bin_row['amount']."; ";
          $gas_qry_u = $snake_dbh->prepare("SELECT SUM(gas_amt) AS amount FROM veto_gas");
          $gas_qry_u->execute();
          if($gas_qry_u->rowCount() > 0){
            $gas_row_u  = $gas_qry_u->fetchAll(PDO::FETCH_ASSOC)[0];
            echo "six => ".$gas_row_u['amount']."; ";
            $gas_qry_a = $snake_dbh->prepare("SELECT SUM(gas_amt) AS amount FROM veto_gas WHERE upline_task_id=?");
            $gas_qry_a->execute(["admin"]);
            if($gas_qry_a->rowCount() > 0){
              $gas_row_a  = $gas_qry_a->fetchAll(PDO::FETCH_ASSOC)[0];
              echo "seven => ".$gas_row_a['amount']."; ";
            }else{
              $error = "Error7";
              echo $error;
            }
          }else{
            $error = "Error6";
            echo $error;
          }
        }else{
          $error = "Error5";
          echo $error;
        }
      }else{
        $error = "Error4";
        echo $error;
      }
    }else{
      $error = "Error3";
      echo $error;
    }
  }else{
    $error = "Error2";
    echo $error;
  }
}else {
  $error = "Error1";
  echo $error;
}
?>
