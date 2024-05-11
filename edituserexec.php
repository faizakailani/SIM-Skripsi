<?php
session_start();
if(!isset($_SESSION["Email"])){
header("location:index.php");
}
?>
<?php
include("db.php");
include("tulislog.php");
$pk = mysqli_real_escape_string($con, $_POST["pk"]);
$Email = mysqli_real_escape_string($con, $_POST["Email"]);
$Password = mysqli_real_escape_string($con, $_POST["Password"]);
$Active = mysqli_real_escape_string($con, $_POST["Active"]);

if (isset($_POST['cp'])){
if (isset($Email) && isset($Password) && isset($Active)){
mysqli_query($con, "update user set Email='$Email', Password=md5('$Password'), Active='$Active' where Email='$Email'");
}
} else {
if (isset($Email) && isset($Active)){ 
mysqli_query($con, "update user set Email='$Email', Active='$Active' where Email='$Email'");
}
}
 tulislog("update user", $con); 
header("Location: listuser.php");
mysqli_close($con);
?>
