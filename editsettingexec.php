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
$ID = mysqli_real_escape_string($con, $_POST["ID"]);
$Nama = mysqli_real_escape_string($con, $_POST["Nama"]);
$Alamat = mysqli_real_escape_string($con, $_POST["Alamat"]);
$Telepon = mysqli_real_escape_string($con, $_POST["Telepon"]);
$Email = mysqli_real_escape_string($con, $_POST["Email"]);
$Logo = mysqli_real_escape_string($con, $_POST["Logo"]);

mysqli_query($con, "update setting set ID='$ID', Nama='$Nama', Alamat='$Alamat', Telepon='$Telepon', Email='$Email', Logo='$Logo' where ID=$pk");
 tulislog("update setting", $con); 
header("Location: listsetting.php");
mysqli_close($con);
?>
