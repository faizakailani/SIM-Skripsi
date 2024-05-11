<?php
session_start();
if(!isset($_SESSION["Email"])){
header("location:index.php");
}
?>
<?php include("db.php"); ?>
<?php
//cek otoritas
$q = "SELECT * FROM tw_hak_akses where tabel='setting' and user = '". $_SESSION['Email'] ."' and deleteData='1'";
$r = mysqli_query($con, $q);
if ( $obj = @mysqli_fetch_object($r) )
 {
?>
<?php
include("tulislog.php");
$ID = mysqli_real_escape_string($con, $_REQUEST[ID]);
$result = mysqli_query($con, "DELETE FROM setting WHERE ID = '". $ID . "'");
 tulislog("delete setting", $con); 
header("Location:listsetting.php");
mysqli_close($con);
?>
<?php
} else {
 header("Location:content.php");
}
?>
