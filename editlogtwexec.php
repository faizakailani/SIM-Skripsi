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
$id = mysqli_real_escape_string($con, $_POST["id"]);
$Time = mysqli_real_escape_string($con, $_POST["Time"]);
$User = mysqli_real_escape_string($con, $_POST["User"]);
$IpAddress = mysqli_real_escape_string($con, $_POST["IpAddress"]);
$Information = mysqli_real_escape_string($con, $_POST["Information"]);

mysqli_query($con, "update logtw set id='$id', Time='$Time', User='$User', IpAddress='$IpAddress', Information='$Information' where id='$pk'");
 tulislog("update logtw", $con); 
header("Location: listlogtw.php");
mysqli_close($con);
?>
