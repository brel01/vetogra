
<?php
 session_start();
unset($_SSESION['_@_uemail']);
unset($_SESSION['@snake_id']);
session_destroy();
header("location:../")
 ?>
