<?php
session_start();
include('db.php');
include('tulislog.php');

$Email = mysqli_real_escape_string($con, $_POST["Email"]);
$Password = mysqli_real_escape_string($con, $_POST["Password"]);

 $q = "SELECT * FROM user where Email = '$Email' and Password = md5('$Password') and Active = '1'";

$r = mysqli_query($con, $q);

if ( $obj = @mysqli_fetch_object($r) )
  {
 // Register $myusername, $mypassword and redirect to file "login_success.php"
   $_SESSION["Email"] = $Email;
   $_SESSION["Password"] = $Password;
 tulislog("$Email login sukses",$con); 
  	header("Location:content.php");
  }
 else
  {
 tulislog("login gagal", $con); 
  	header('Location:index.php');
  }
?>

