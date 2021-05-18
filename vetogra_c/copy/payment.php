<?php
// include("snake.php");
// include("functions.php");
// session_start();

// if(isset($_POST)){
  // $json = file_get_contents('php://input');
  // $resp = json_decode($json, true);
  // $task_id = $resp['task_id'];
  // $amount_paid = $resp['amt_paid'];
  $query = $snake_dbh->prepare("SELECT user_id, eth_task_amt, task_payment_status FROM veto_tasks WHERE task_id=? && cancled=0 && task_payment_status=0");
  $query->execute([$task_id]);
  if($query){
    if($query->rowCount() == 1){
      $row = $query->fetchAll(PDO::FETCH_ASSOC)[0];
      $user_id = $row['user_id'];
      $task_amount = $row['eth_task_amt'];
      if($row['task_payment_status'] == 0){
        $qry_t = $snake_dbh->prepare("SELECT eth_d_trans_id, eth_d_amount, eth_d_uid, eth_d_status, cancled FROM eth_deposit_trans  WHERE eth_d_status=0 && task_id=? && cancled=0");
        $qry_t->execute([$task_id]);
        if($qry_t){
          if($qry_t->rowCount() == 1){
            $rw = $qry_t->fetchAll(PDO::FETCH_ASSOC)[0];
            if($rw['eth_d_status'] == 0 && $rw['cancled'] == 0){
              if($amount_paid >= $rw['eth_d_amount']){
                $date = time();
                $deposite_id = $rw['eth_d_trans_id'];
                $deposite_amount = $rw['eth_d_amount'];

                if($amount_paid > $rw['eth_d_amount']){
                  $spill_amount = $amount_paid - $rw['eth_d_amount'];
                }else{
                  $spill_amount = 0;
                }

                $get_spill_query = $snake_dbh->prepare("SELECT task_spillover_amt FROM veto_tasks WHERE user_id=? && task_id=?");
                $get_spill_query->execute([$user_id, $task_id]);
                if($get_spill_query){
                  if($get_spill_query->rowCount() == 1){
                    $g_row = $get_spill_query->fetchAll(PDO::FETCH_ASSOC)[0];
                    $fectched_spill_amt = $g_row['task_spillover_amt'];
                    if($fectched_spill_amt == ""){
                      $fectched_spill_amt = 0;
                    }else{
                      $fectched_spill_amt = $g_row['task_spillover_amt'];
                    }
                    if($fectched_spill_amt > 0){
                      $fectched_spill_amt = $g_row['task_spillover_amt'];
                    }else{
                      $fectched_spill_amt = 0;
                    }
                  }else{
                    $fectched_spill_amt = 0;
                  }
                  $fectched_spill_amt = $fectched_spill_amt + $spill_amount;
                    $date = time();
                    $qry_u = $snake_dbh->prepare("UPDATE veto_tasks SET task_spillover_amt=?, task_payment_status=1, eth_deposite_id=? WHERE task_id=? && cancled=0 && task_payment_status=0");
                    $qry_u->execute([$fectched_spill_amt, $deposite_id, $task_id]);

                  if($qry_u){
                    $qry_y = $snake_dbh->prepare("UPDATE eth_deposit_trans SET eth_d_amount_paid=?, eth_d_status=1, eth_d_confirm_date=? WHERE eth_d_status=0 && task_id=? && cancled=0");
                    $qry_y->execute([$amount_paid, $date, $task_id]);
                    if($qry_y){
                      $q_u = $snake_dbh->prepare("SELECT upline_ref_code, parallel_ref FROM users WHERE _unique_id_=?");
                      $q_u->execute([$user_id]);
                      if($q_u){
                        if($q_u->rowCount() == 1){
                          $r_w = $q_u->fetchAll(PDO::FETCH_ASSOC)[0];
                          $referral = $r_w['upline_ref_code'];
                          $parallel_ref = $r_w['parallel_ref'];
                          if(strlen($referral)  > 0){
                            $qw = $snake_dbh->prepare("SELECT _unique_id_ FROM users WHERE username=?");
                            $qw->execute([$referral]);
                            if($qw){
                              if($qw->rowCount() == 1){
                                $rows = $qw->fetchAll(PDO::FETCH_ASSOC)[0];
                                $ref_id = $rows['_unique_id_'];

                                $qq = $snake_dbh->prepare("SELECT task_id, user_id, eth_task_amt, eth_task_bal, eth_task_gas_amt, num_gas_added FROM veto_tasks WHERE user_id=? && task_ended=0 && task_payment_status=1 && cancled=0 && invalid=0");
                                $qq->execute([$ref_id]);
                                if($qq){
                                  if($qq->rowCount() > 0){
                                    $row_k = $qq->fetchAll(PDO::FETCH_ASSOC)[0];
                                    if($ref_id == $row_k['user_id']){
                                      $ref_task_id = $row_k['task_id'];
                                      $eth_task_amt = $row_k['eth_task_amt'];

                                      // amount made
                                      if(strlen($row_k['eth_task_bal']) == ""){
                                        $eth_task_bal = 0;
                                      }else{
                                        $eth_task_bal = $row_k['eth_task_bal'];
                                      }
                                      // amount of gas paid to start task
                                      $eth_task_gas_amt = $row_k['eth_task_gas_amt'];
                                      // nunof gases added to achive balance
                                      if(strlen($row_k['num_gas_added']) == ""){
                                        $gas_added = 0 + 1;
                                      }else{
                                        $gas_added = $row_k['num_gas_added'] + 1;
                                      }
                                      $amt_paid = (80/100)*$amount_paid;
                                      $admin_amt = (20/100)*$amount_paid;
                                      $admin = "admin";
                                      $new_eth_task_amt = $eth_task_bal + $amt_paid;
                                      if($new_eth_task_amt > $eth_task_amt){
                                        $spill = $new_eth_task_amt - $eth_task_amt;
                                        $date = time();
                                        $one = 1;
                                        $q_ww = $snake_dbh->prepare("UPDATE veto_tasks SET eth_task_bal=?, num_gas_added=?, task_end_date=?, task_ended=?, task_spillover_amt=? WHERE task_id=?");
                                        $q_ww->execute([$new_eth_task_amt, $gas_added, $date, $spill, $one, $ref_task_id]);

                                        $qqqq = $snake_dbh->prepare("INSERT INTO veto_gas(upline_usr_id, downline_usr_id, gas_amt, task_amt, upline_task_id, downline_task_id, date) VALUE (?,?,?,?,?,?,?)");
                                        $qqqq->execute([ $ref_id, $user_id, $amt_paid, $eth_task_amt, $ref_task_id, $task_id, $date]);

                                        $a_qqqq = $snake_dbh->prepare("INSERT INTO veto_gas(upline_usr_id, downline_usr_id, gas_amt, task_amt, upline_task_id, downline_task_id, date) VALUE (?,?,?,?,?,?,?)");
                                        $a_qqqq->execute([$admin, $ref_id, $admin_amt, $amt_paid, $admin, $task_id, $date]);
                                        $error = "success1";
                                        $msg = json_encode($error);
                                        echo $error;
                                      }else if($new_eth_task_amt == $eth_task_amt){
                                        $one = 1;
                                        $q_ww = $snake_dbh->prepare("UPDATE veto_tasks SET eth_task_bal=?, num_gas_added=?, task_end_date=?, task_ended=? WHERE task_id=?");
                                        $q_ww->execute([$new_eth_task_amt, $gas_added, $date, $one, $ref_task_id]);

                                        $qqqq = $snake_dbh->prepare("INSERT INTO veto_gas(upline_usr_id, downline_usr_id, gas_amt, task_amt, upline_task_id, downline_task_id, date) VALUE (?,?,?,?,?,?,?)");
                                        $qqqq->execute([$user_id, $ref_id, $amt_paid, $eth_task_amt, $task_id, $ref_task_id, $date]);

                                        $a_qqqq = $snake_dbh->prepare("INSERT INTO veto_gas(upline_usr_id, downline_usr_id, gas_amt, task_amt, upline_task_id, downline_task_id, date) VALUE (?,?,?,?,?,?,?)");
                                        $a_qqqq->execute([$admin, $ref_id, $admin_amt, $amt_paid, $task_id, $admin, $date]);
                                        $error = "success2";
                                        $msg = json_encode($error);
                                        echo $error;
                                      }else{
                                        $q_ww = $snake_dbh->prepare("UPDATE veto_tasks SET eth_task_bal=?, num_gas_added=? WHERE task_id=?");
                                        $q_ww->execute([$new_eth_task_amt, $gas_added, $ref_task_id]);

                                        $qqqq = $snake_dbh->prepare("INSERT INTO veto_gas(upline_usr_id, downline_usr_id, gas_amt, task_amt, upline_task_id, downline_task_id, date) VALUE (?,?,?,?,?,?,?)");
                                        $qqqq->execute([ $user_id, $ref_id, $amt_paid, $eth_task_amt, $task_id, $ref_task_id,  $date]);

                                        $a_qqqq = $snake_dbh->prepare("INSERT INTO veto_gas(upline_usr_id, downline_usr_id, gas_amt, task_amt, upline_task_id, downline_task_id, date) VALUE (?,?,?,?,?,?,?)");
                                        $a_qqqq->execute([$admin, $ref_id, $admin_amt, $amt_paid, $task_id, $admin, $date]);
                                        $error ="success3";
                                        $msg = json_encode($error);
                                        echo $error;
                                      }
                                    }else{
                                      $error = "Error occured during processing20";
                                      $msg = json_encode($error);
                                      echo $error;
                                    }
                                  }else{
                                    $rui = $snake_dbh->prepare("INSERT INTO veto_bin(amt, vb_user_id, vb_task_id, vb_date) VALUE (?,?,?,?)");
                                    $rui->execute([$ref_id, $user_id, $task_id, $date]);
                                    $rtg = $snake_dbh->prepare("SELECT task_id, user_id, eth_task_amt, eth_task_bal FROM veto_tasks WHERE task_ended=0 && task_payment_status=1 && parallel=1 ORDER BY task_start_date ASC LIMIT 1");
                                    $rtg->execute();
                                    if($rtg){
                                      if($rtg->rowCount() > 0){
                                        $tt_row = $rtg->fetchAll(PDO::FETCH_ASSOC)[0];
                                        $tt_task_id = $tt_row['task_id'];
                                        $tt_user_id = $tt_row['user_id'];
                                        $tt = $tt_row['eth_task_bal'];
                                        $tt_real_amt = (80/100)*$amount_paid;
                                        $tt_eth_task_bal = $tt_row['eth_task_bal'];
                                        $tt_new_amount = $tt_real_amt + $tt_eth_task_bal;
                                        $tt_eth_task_amt = $tt_row['eth_task_amt'];
                                        $admin_amt = (20/100)*$amount_paid;

                                        if($tt_new_amount >= $tt_eth_task_amt){
                                          $spill = 0;
                                          if($tt_new_amount > $tt_eth_task_amt){
                                            $spill =  $tt_new_amount - $tt_eth_task_amt;
                                          }

                                          $date = time();
                                          $one = 1;
                                          $q_ww = $snake_dbh->prepare("UPDATE veto_tasks SET eth_task_bal=?, num_gas_added = num_gas_added + 1, task_end_date=?, task_ended=1, task_spillover_amt=? WHERE task_id=?");
                                          $q_ww->execute([$tt_new_amount, $date, $spill, $tt_task_id]);
                                          $admin = "admin";

                                          $one = 1;
                                          $qqqq = $snake_dbh->prepare("INSERT INTO veto_gas(upline_usr_id, downline_usr_id, gas_amt, task_amt, upline_task_id, downline_task_id, date, parallel) VALUE (?,?,?,?,?,?,?,?)");
                                          $qqqq->execute([ $tt_user_id, $user_id, $tt_real_amt, $tt_eth_task_amt, $tt_task_id, $task_id, $date, $one]);

                                          $a_qqqq = $snake_dbh->prepare("INSERT INTO veto_gas(upline_usr_id, downline_usr_id, gas_amt, task_amt, upline_task_id, downline_task_id, date, parallel) VALUE (?,?,?,?,?,?,?,?)");
                                          $a_qqqq->execute([ $admin, $user_id, $admin_amt, $tt_eth_task_amt, $admin, $task_id, $date, $one]);

                                          $error = "alaye";
                                          $msg = json_encode($error);
                                        }else{
                                          $date = time();
                                          $one = 1;
                                          $q_ww = $snake_dbh->prepare("UPDATE veto_tasks SET eth_task_bal=?, num_gas_added = num_gas_added + 1 WHERE task_id=?");
                                          $q_ww->execute([$tt_new_amount, $tt_task_id]);
                                          $admin = "admin";

                                          $qqqq = $snake_dbh->prepare("INSERT INTO veto_gas(upline_usr_id, downline_usr_id, gas_amt, task_amt, upline_task_id, downline_task_id, date, parallel) VALUE (?,?,?,?,?,?,?,?)");
                                          $qqqq->execute([ $tt_user_id, $user_id, $tt_real_amt, $tt_eth_task_amt, $tt_task_id, $task_id, $date, $one]);

                                          $a_qqqq = $snake_dbh->prepare("INSERT INTO veto_gas(upline_usr_id, downline_usr_id, gas_amt, task_amt, upline_task_id, downline_task_id, date, parallel) VALUE (?,?,?,?,?,?,?,?)");
                                          $a_qqqq->execute([ $admin, $user_id, $admin_amt, $tt_eth_task_amt, $admin, $task_id, $date, $one]);

                                          $error = "alaye";
                                          $msg = json_encode($error);
                                        }
                                      }else{
                                        $error = "Error occured during processing12";
                                        $msg = json_encode($error);
                                        echo $error;
                                      }
                                    }else{
                                      $error = "Error occured during processing12";
                                      $msg = json_encode($error);
                                      echo $error;
                                    }
                                    $error = "Error occured during processing19";
                                    $msg = json_encode($error);
                                    echo $error;
                                  }
                                }else{
                                  $error = "Error occured during processing18";
                                  $msg = json_encode($error);
                                  echo $error;
                                }
                              }else{
                                $rtg = $snake_dbh->prepare("SELECT task_id, user_id, eth_task_amt, eth_task_bal FROM veto_tasks WHERE task_ended=0 && task_payment_status=1 && parallel=1 ORDER BY task_start_date ASC LIMIT 1");
                                $rtg->execute();
                                if($rtg){
                                  if($rtg->rowCount() > 0){
                                    $tt_row = $rtg->fetchAll(PDO::FETCH_ASSOC)[0];
                                    $tt_task_id = $tt_row['task_id'];
                                    $tt_user_id = $tt_row['user_id'];
                                    $tt = $tt_row['eth_task_bal'];
                                    $tt_real_amt = (80/100)*$amount_paid;
                                    $tt_eth_task_bal = $tt_row['eth_task_bal'];
                                    $tt_new_amount = $tt_real_amt + $tt_eth_task_bal;
                                    $tt_eth_task_amt = $tt_row['eth_task_amt'];
                                    $admin_amt = (20/100)*$amount_paid;
                                    if($tt_new_amount >= $tt_eth_task_amt){
                                      $spill = 0;
                                      if($tt_new_amount > $tt_eth_task_amt){
                                        $spill =  $tt_new_amount - $tt_eth_task_amt;
                                      }

                                      $date = time();
                                      $one = 1;
                                      $q_ww = $snake_dbh->prepare("UPDATE veto_tasks SET eth_task_bal=?, num_gas_added = num_gas_added + 1, task_end_date=?, task_ended=1, task_spillover_amt=? WHERE task_id=?");
                                      $q_ww->execute([$tt_new_amount, $date, $spill, $tt_task_id]);
                                      $admin = "admin";

                                      $one = 1;
                                      $qqqq = $snake_dbh->prepare("INSERT INTO veto_gas(upline_usr_id, downline_usr_id, gas_amt, task_amt, upline_task_id, downline_task_id, date, parallel) VALUE (?,?,?,?,?,?,?,?)");
                                      $qqqq->execute([ $tt_user_id, $user_id, $tt_real_amt, $tt_eth_task_amt, $tt_task_id, $task_id, $date, $one]);

                                      $a_qqqq = $snake_dbh->prepare("INSERT INTO veto_gas(upline_usr_id, downline_usr_id, gas_amt, task_amt, upline_task_id, downline_task_id, date, parallel) VALUE (?,?,?,?,?,?,?,?)");
                                      $a_qqqq->execute([ $admin, $user_id, $admin_amt, $tt_eth_task_amt, $admin, $task_id, $date, $one]);

                                      $error = "alaye";
                                      $msg = json_encode($error);
                                    }else{
                                      $date = time();
                                      $one = 1;
                                      $q_ww = $snake_dbh->prepare("UPDATE veto_tasks SET eth_task_bal=?, num_gas_added = num_gas_added + 1 WHERE task_id=?");
                                      $q_ww->execute([$tt_new_amount, $tt_task_id]);
                                      $admin = "admin";

                                      $qqqq = $snake_dbh->prepare("INSERT INTO veto_gas(upline_usr_id, downline_usr_id, gas_amt, task_amt, upline_task_id, downline_task_id, date, parallel) VALUE (?,?,?,?,?,?,?,?)");
                                      $qqqq->execute([ $tt_user_id, $user_id, $tt_real_amt, $tt_eth_task_amt, $tt_task_id, $task_id, $date, $one]);

                                      $a_qqqq = $snake_dbh->prepare("INSERT INTO veto_gas(upline_usr_id, downline_usr_id, gas_amt, task_amt, upline_task_id, downline_task_id, date, parallel) VALUE (?,?,?,?,?,?,?,?)");
                                      $a_qqqq->execute([ $admin, $user_id, $admin_amt, $tt_eth_task_amt, $admin, $task_id, $date, $one]);

                                      $error = "alaye";
                                      $msg = json_encode($error);
                                    }
                                  }else{
                                    $error = "Error occured during processing12";
                                    $msg = json_encode($error);
                                    echo $error;
                                  }
                                }else{
                                  $error = "Error occured during processing12";
                                  $msg = json_encode($error);
                                  echo $error;
                                }
                                $empty = "";
                                $q_o = $snake_dbh->prepare("UPDATE users SET upline_ref_code=?, referred=0 WHERE _unique_id_=? ");
                                $q_o->execute([$empty, $user_id]);
                                $error = "referral invalid";
                                $msg = json_encode($error);
                                echo $error;
                              }
                            }else {
                              $error = "Error occured during processing17";
                              $msg = json_encode($error);
                              echo $error;
                            }
                          }else if(strlen($parallel_ref) > 0){
                          }else{
                            $rtg = $snake_dbh->prepare("SELECT task_id, user_id, eth_task_amt, eth_task_bal FROM veto_tasks WHERE task_ended=0 && task_payment_status=1 && parallel=1 ORDER BY task_start_date ASC LIMIT 1");
                            $rtg->execute();
                            if($rtg){
                              if($rtg->rowCount() > 0){
                                $tt_row = $rtg->fetchAll(PDO::FETCH_ASSOC)[0];
                                $tt_task_id = $tt_row['task_id'];
                                $tt_user_id = $tt_row['user_id'];
                                $tt = $tt_row['eth_task_bal'];
                                $tt_real_amt = (80/100)*$amount_paid;
                                $tt_eth_task_bal = $tt_row['eth_task_bal'];
                                $tt_new_amount = $tt_real_amt + $tt_eth_task_bal;
                                $tt_eth_task_amt = $tt_row['eth_task_amt'];
                                $admin_amt = (20/100)*$amount_paid;
                                if($tt_new_amount >= $tt_eth_task_amt){
                                  $spill = 0;
                                  if($tt_new_amount > $tt_eth_task_amt){
                                    $spill =  $tt_new_amount - $tt_eth_task_amt;
                                  }

                                  $date = time();
                                  $one = 1;
                                  $q_ww = $snake_dbh->prepare("UPDATE veto_tasks SET eth_task_bal=?, num_gas_added = num_gas_added + 1, task_end_date=?, task_ended=1, task_spillover_amt=? WHERE task_id=?");
                                  $q_ww->execute([$tt_new_amount, $date, $spill, $tt_task_id]);
                                  $admin = "admin";

                                  $one = 1;
                                  $qqqq = $snake_dbh->prepare("INSERT INTO veto_gas(upline_usr_id, downline_usr_id, gas_amt, task_amt, upline_task_id, downline_task_id, date, parallel) VALUE (?,?,?,?,?,?,?,?)");
                                  $qqqq->execute([ $tt_user_id, $user_id, $tt_real_amt, $tt_eth_task_amt, $tt_task_id, $task_id, $date, $one]);

                                  $a_qqqq = $snake_dbh->prepare("INSERT INTO veto_gas(upline_usr_id, downline_usr_id, gas_amt, task_amt, upline_task_id, downline_task_id, date, parallel) VALUE (?,?,?,?,?,?,?,?)");
                                  $a_qqqq->execute([ $admin, $user_id, $admin_amt, $tt_eth_task_amt, $admin, $task_id, $date, $one]);

                                  $error = "alaye";
                                  $msg = json_encode($error);
                                }else{
                                  $date = time();
                                  $one = 1;
                                  $q_ww = $snake_dbh->prepare("UPDATE veto_tasks SET eth_task_bal=?, num_gas_added = num_gas_added + 1 WHERE task_id=?");
                                  $q_ww->execute([$tt_new_amount, $tt_task_id]);
                                  $admin = "admin";

                                  $qqqq = $snake_dbh->prepare("INSERT INTO veto_gas(upline_usr_id, downline_usr_id, gas_amt, task_amt, upline_task_id, downline_task_id, date, parallel) VALUE (?,?,?,?,?,?,?,?)");
                                  $qqqq->execute([ $tt_user_id, $user_id, $tt_real_amt, $tt_eth_task_amt, $tt_task_id, $task_id, $date, $one]);

                                  $a_qqqq = $snake_dbh->prepare("INSERT INTO veto_gas(upline_usr_id, downline_usr_id, gas_amt, task_amt, upline_task_id, downline_task_id, date, parallel) VALUE (?,?,?,?,?,?,?,?)");
                                  $a_qqqq->execute([ $admin, $user_id, $admin_amt, $tt_eth_task_amt, $admin, $task_id, $date, $one]);

                                  $error = "alaye";
                                  $msg = json_encode($error);
                                }
                              }else{
                                $error = "Error occured during processing12";
                                $msg = json_encode($error);
                                echo $error;
                              }
                            }else{
                              $error = "Error occured during processing12";
                              $msg = json_encode($error);
                              echo $error;
                            }
                          }
                        }else{
                          $error = "Error occured during processing12";
                          $msg = json_encode($error);
                          echo $error;
                        }
                      }else{
                        $error = "Error occured during processing11";
                        $msg = json_encode($error);
                        echo $error;
                      }
                    }else{
                      $error = "error occured during procesing10";
                      $msg = json_encode($error);
                      echo $error;
                    }
                  }else{
                    $error = "error occured during processing9";
                    $msg = json_encode($error);
                    echo $error;
                  }
              }else{
                $error = "Error occured during procesing8";
                $msg = json_encode($error);
                echo $error;
              }
              }else{
                $date = time();
                $deposite_id = $rw['eth_d_trans_id'];
                $qry_u = $snake_dbh->prepare("UPDATE veto_tasks SET task_payment_status=1, eth_deposit_id=?, invalid=1 WHERE task_id=? && cancled=0 && task_payment_status=0");
                $qry_u->execute([$deposite_id, $task_id]);
                if($qry_u){
                  $qry_y = $snake_dbh->prepare("UPDATE eth_deposit_trans SET eth_d_amount_paid=?, eth_d_status=1, eth_d_confirm_date=?, invalid=1 WHERE eth_d_status=0 && task_id=? && cancled=0");
                  $qry_y->execute([$amount_paid, $date, $task_id]);
                  if($qry_y){
                    $gas = $amount_paid;
                    $in_gas_qry = $snake_dbh->prepare("INSERT INTO invalid_veto_gas(usr_id, gas_amt, task_amt,task_id,date) VALUE (?,?,?,?,?)");
                    $in_gas_qry->execute([$user_id, $gas, $task_amount, $task_id, $date]);
                    $error = "completed";
                    $msg = json_encode($error);
                    echo $error;
                  }else{
                    $error = "error occured during procesing7";
                    $msg = json_encode($error);
                    echo $error;
                  }
                }else{
                  $error = "error occured during processing6";
                  $msg = json_encode($error);
                  echo $error;
                }
              }
            }else{
              $error = "Error occured during procesing5";
              $msg = json_encode($error);
              echo $error;
            }
          }else{
            $error = "Error occured during procesing4";
            $msg = json_encode($error);
            echo $error;
          }
        }else{
          $error = "Error occured during procesing4";
          $msg = json_encode($error);
          echo $error;
        }
      }else{
        $error = "Error occured during procesing3";
        $msg = json_encode($error);
        echo $error;
      }
    }else{
      $error = "Error occured during processing2";
      $msg = json_encode($error);
      echo $error;
    }
  }else{
    $errror = "Error occured during procesing1";
    $msg = json_encode($error);
    echo $error;
  }
// }
?>
