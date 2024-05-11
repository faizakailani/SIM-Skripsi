<?php
session_start();
if(!isset($_SESSION["Email"])){
header("location:index.php");
}
?>
<?php
include("db.php");
include("tulislog.php");
$id= mysqli_real_escape_string($con, $_POST["id"]);
$Time= mysqli_real_escape_string($con, $_POST["Time"]);
$User= mysqli_real_escape_string($con, $_POST["User"]);
$IpAddress= mysqli_real_escape_string($con, $_POST["IpAddress"]);
$Information= mysqli_real_escape_string($con, $_POST["Information"]);

if (isset($id) && isset($Time) && isset($User) && isset($IpAddress) && isset($Information)){
mysqli_query($con, "INSERT INTO logtw(id,Time,User,IpAddress,Information) VALUES (null,'$Time','$User','$IpAddress','$Information')");
}

tulislog("insert into logtw", $con); 
header("Location: listlogtw.php");
mysqli_close($con)
?>
