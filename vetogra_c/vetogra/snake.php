
<?php
define('DB_HOST', 'localhost');
define('DB_USER','metrqnjf_admin');
define('DB_PASS','2Eleolaju.');
define('DB_NAME', 'metrqnjf_vetogra');
try
{
$dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS);
}
catch(PDOException $e)
{
  exit("Error: " . $e->getMessage());
}
?>
