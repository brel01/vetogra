<?php
include("snake.php");
include("functions.php");

$empty = "";
$qry = $snake_dbh->prepare("SELECT task_id, user_id FROM veto_tasks WHERE eth_deposite_id=? ASC LIMIT 1 ORDER BY task_start_date ");
$qry->execute([$empty]);

foreach ($qry as $row) {
  $user_id = $row['user_id'];
  $task_id = $row['task_id'];
  $spill = $row['task_spillover_amt'];
  $rrr = $snake_dbh->prepare("UPDATE veto_tasks SET eth_deposit_id WHERE task_id=?");
  $rrr->execute([$task_id]);

  $qy = $snake_dbh->prepare("UPDATE veto_tasks SET task_spillover_amt WHERE user_id=?, task_ended=0 && task_payment_status=1);
  $qy->execute([$spill]);
  $rows = $qy->fetchAll(PDO::FETCH_ASSOC)[0];

}
?>
