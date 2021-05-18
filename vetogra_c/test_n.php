<?php
include("snake.php");
// $query = $snake_dbh->prepare("SELECT id, wth_id, wth_uid, wth_task_id, wth_uemail, wth_amount, wth_d_address FROM eth_withdraw_trans ORDER BY wth_date ASC LIMIT 100");
// $query->execute();
// if($query->rowCount() > 0){
//   $withdrawals = [];
//
//   foreach($query as $rows){
//     $task_id = $rows['wth_task_id'];
//     // $check = check($task_id, $rows['wth_uid']);
//     $zero = 0;
//     $qry = $snake_dbh->prepare('UPDATE veto_tasks SET pending_w=? WHERE task_id=?');
//     $qry->execute([$zero, $task_id]);
//     if($qry){
//       $one = 1;
//       $qry_y = $snake_dbh->prepare("UPDATE eth_withdraw_trans SET pending=?, failed=? WHERE wth_task_id=?");
//       $qry_y->execute([$zero, $one, $task_id]);
//     }
//   }
// }
$query = $snake_dbh->prepare("UPDATE users SET eth_address=? WHERE useremail=?");
$query->execute(["0x924d0762ad295326946875e35f90fd9d61abfcdc", "arowolajutunde@gmail.com"]);
if($query){
  echo "success";
}
?>
