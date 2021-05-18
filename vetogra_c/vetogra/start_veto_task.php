<?php
include("snake.php");
include("functions.php");
session_start();

if(isset($_POST)){
  if(!isset($_SESSION["@snake_id"])){
    $error = "Error occured during procesing";
    $msg = json_encode($error);
    echo $msg;
  }else{
    if(isset($_SESSION["@snake_id"])){
      $qri = $snake_dbh->prepare("SELECT id FROM users WHERE _unique_id_=?");
      $qri->execute([$_SESSION["@snake_id"]]);
      if($qri->rowCount() != 1){
        header('location: ../');
      }else{
        $json = file_get_contents('php://input');
        $resp = $_POST;
        $t_id = generate_task_id();
        $u_id = $_SESSION["@snake_id"];
        $eth_task_amt = $_POST['eth_task_amt'];
        $task_type = $_POST['task_type'];
        $date = time();
        if(strlen($eth_task_amt) > 0){
          if(strlen($eth_task_amt) > 0){
            if(strlen($task_type) > 0){
              if($eth_task_amt > 0.19){
                if($eth_task_amt < 10.01){
                  if($task_type == "series"){
                    $gas_f = (20/100)*$eth_task_amt;
                    $gas_fee = round($gas_f,2);
                  }else if($task_type == "parallel"){
                    $gas_f  = (60/100)*$eth_task_amt;
                    $gas_fee = round($gas_f,2);
                  }
                  $qry_p = $snake_dbh->prepare("SELECT id FROM eth_deposit_trans WHERE eth_d_uid=? && eth_d_status=0 && cancled=0");
                  $qry_p->execute([$_SESSION['@snake_id']]);

                  if($qry_p->rowCount() == 0){

                    $qry_pp = $snake_dbh->prepare("SELECT id FROM veto_tasks WHERE user_id=? && task_ended=0 && task_payment_status=1");
                    $qry_pp->execute([$_SESSION['@snake_id']]);

                    if($qry_pp->rowCount() == 0){
                      if($task_type == "parallel"){
                        $one = 1;
                        $query = $snake_dbh->prepare("INSERT INTO veto_tasks(task_id,user_id,eth_task_amt,eth_task_gas_amt,task_start_date,task_type,parallel) VALUE (?,?,?,?,?,?,?)");
                        $query->execute([$t_id, $u_id, $eth_task_amt, $gas_fee, $date, $task_type, $one]);
                      }else if($task_type == "series"){
                        $one = 1;
                        $query = $snake_dbh->prepare
                        ("INSERT INTO veto_tasks(task_id,user_id,eth_task_amt,eth_task_gas_amt,task_start_date,task_type,series)
                         VALUE (?,?,?,?,?,?,?)");
                        $query->execute([$t_id, $u_id, $eth_task_amt, $gas_fee, $date, $task_type, $one]);
                      }
                      if($query){
                        $qry = $snake_dbh->prepare("SELECT id FROM veto_task WHERE task_id=?");
                        $qry->execute([$t_id]);
                        if($qry){
                          if($query->rowCount() == 1){
                            // $error = "success";
                            // $msg = json_encode($error);
                            // echo $msg;
                                      $user_id = $_SESSION['@snake_id'];
                                      $get_spill_query = $snake_dbh->prepare("SELECT task_spillover_amt FROM veto_tasks WHERE user_id=? ORDER BY task_start_date DESC LIMIT 2");
                                      $get_spill_query->execute([$user_id]);
                                      if($get_spill_query){
                                        if($get_spill_query->rowCount() == 2){
                                          $g_row = $get_spill_query->fetchAll(PDO::FETCH_ASSOC)[1];
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
                                        $spill_amount = 0;
                                        if($fectched_spill_amt >= $eth_task_amt){
                                          if($fectched_spill_amt > $eth_task_amt){
                                            $remain = $fectched_spill_amt - $eth_task_amt;
                                            $spill_amount = $remain;
                                          }
                                          $date = time();
                                          $qry_u = $snake_dbh->prepare("UPDATE veto_tasks SET eth_task_bal=?,  task_end_date=?, task_ended=1, task_spillover_amt=? WHERE task_id=? && cancled=0 && task_payment_status=0");
                                          $qry_u->execute([$fectched_spill_amt, $date, $spill_amount, $t_id]);

                                          $spill_query = $snake_dbh->prepare("INSERT INTO spillovers(spill_usr_id, spill_task_id, spill_amt, spill_date) VALUES (?,?,?,?) ");
                                          $spill_query->execute([$user_id, $t_id, $fectched_spill_amt, $date]);

                                          if($task_type == "series"){
                                            $gas_f = (20/100)*$eth_task_amt;
                                            $gas_fee = round($gas_f,2);
                                            include("_create_transaction.php");
                                          }else if($task_type == "parallel"){
                                            $gas_f  = (60/100)*$eth_task_amt;
                                            $gas_fee = round($gas_f,2);
                                            include("_create_transaction.php");
                                          }else{
                                            $error = "Error occured during procesing8";
                                            $data = ["msg"=>$error];
                                            $msg = json_encode($data);
                                            echo $msg;
                                          }
                                        }else{
                                          $qry_u = $snake_dbh->prepare("UPDATE veto_tasks SET eth_task_bal=?, task_spillover_amt=? WHERE task_id=? && cancled=0 && task_payment_status=0");
                                          $qry_u->execute([$fectched_spill_amt, $spill_amount, $t_id]);

                                          if($fectched_spill_amt > 0){
                                            $spill_query = $snake_dbh->prepare("INSERT INTO spillovers(spill_usr_id, spill_task_id, spill_amt, spill_date) VALUES (?,?,?,?) ");
                                            $spill_query->execute([$user_id, $t_id, $fectched_spill_amt, $date]);
                                          }
                                          if($task_type == "series"){
                                            $gas_f = (20/100)*$eth_task_amt;
                                            $gas_fee = round($gas_f,2);
                                            include("_create_transaction.php");
                                          }else if($task_type == "parallel"){
                                            $gas_f  = (60/100)*$eth_task_amt;
                                            $gas_fee = round($gas_f,2);
                                            include("_create_transaction.php");
                                          }else{
                                            $error = "Error occured during procesing8";
                                            $data = ["msg"=>$error];
                                            $msg = json_encode($data);
                                            echo $msg;
                                          }
                                        }
                                      }else{
                                        $error = "Error occured during procesing10";
                                        $data = ["msg"=>$error];
                                        $msg = json_encode($data);
                                        echo $msg;
                                      }
                          }else{
                            $error = "Error occured during procesing8";
                            $data = ["msg"=>$error];
                            $msg = json_encode($data);
                            echo $msg;
                          }
                        }else{
                          $error = "Error occured during procesing";
                          $data = ["msg"=>$error];
                          $msg = json_encode($data);
                          echo $msg;
                        }
                      }else{
                        $error = "Error occured during procesing";
                        $data = ["msg"=>$error];
                        $msg = json_encode($data);
                        echo $msg;
                      }
                    }else{
                      $error = "You have a running VETOTASK";
                      $data = ["msg"=>$error];
                      $msg = json_encode($data);
                      echo $msg;
                    }
                  }else{
                    $error = "You have a pending VETOTASK";
                    $data = ["msg"=>$error];
                    $msg = json_encode($data);
                    echo $msg;
                  }
                }else{
                  $error = "Error occured during procesing";
                  $data = ["msg"=>$error];
                  $msg = json_encode($data);
                  echo $msg;
                }
              }else{
                $error = "Error occured during procesing";
                $data = ["msg"=>$error];
                $msg = json_encode($data);
                echo $msg;
              }
            }else{
              $error = "Error occured during procesing";
              $data = ["msg"=>$error];
              $msg = json_encode($data);
              echo $msg;
            }
          }else{
            $error = "Error occured during procesing";
            $data = ["msg"=>$error];
            $msg = json_encode($data);
            echo $msg;
          }
        }else{
          $error = "Error occured during procesing";
          $data = ["msg"=>$error];
          $msg = json_encode($data);
          echo $msg;
        }
      }
    }
  }
}else{
  $error = "Error occured during procesing";
  $data = ["msg"=>$error];
  $msg = json_encode($data);
  echo $msg;
}
?>
