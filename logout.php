<?php
session_start();
include('db.php');
include('tulislog.php');
 tulislog("logout", $con); 
session_destroy();
header("Location: index.php");
?>
