<?php
session_start();
if(!isset($_SESSION["Email"])){
header("location:index.php");
}
?>
<?php include("db.php"); ?>
<?php
//cek otoritas
$q = "SELECT * FROM tw_hak_akses where tabel='user' and user = '". $_SESSION['Email'] ."' and deleteData='1'";
$r = mysqli_query($con, $q);
if ( $obj = @mysqli_fetch_object($r) )
 {
?>
<?php
include("tulislog.php");
$Email = mysqli_real_escape_string($con, $_REQUEST[Email]);
$result = mysqli_query($con, "DELETE FROM user WHERE Email = '". $Email . "'");
$_SESSION["delete_success"] = "Data berhasil dihapus.";
 tulislog("delete from user", $con); 
header("Location:listuser.php");
mysqli_close($con);
?>
<?php
} else {
 header("Location:content.php");
}
?>
