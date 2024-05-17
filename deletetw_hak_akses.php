<?php
session_start();
if(!isset($_SESSION["Email"])){
header("location:index.php");
}
?>
<?php include("db.php"); ?>
<?php
//cek otoritas
$q = "SELECT * FROM tw_hak_akses where tabel='tw_hak_akses' and user = '". $_SESSION['Email'] ."' and deleteData='1'";
$r = mysqli_query($con, $q);
if ( $obj = @mysqli_fetch_object($r) )
 {
?>
<?php
include("tulislog.php");
$id = mysqli_real_escape_string($con, $_REQUEST[id]);
$result = mysqli_query($con, "DELETE FROM tw_hak_akses WHERE id = '". $id . "'");
$_SESSION["delete_success"] = "Data berhasil dihapus.";
 tulislog("delete tw_hak_akses", $con); 
header("Location:listtw_hak_akses.php");
mysqli_close($con);
?>
<?php
} else {
 header("Location:content.php");
}
?>
