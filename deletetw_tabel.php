<?php
session_start();
if(!isset($_SESSION["Email"])){
header("location:index.php");
}
?>
<?php include("db.php"); ?>
<?php
//cek otoritas
$q = "SELECT * FROM tw_hak_akses where tabel='tw_tabel' and user = '". $_SESSION['Email'] ."' and deleteData='1'";
$r = mysqli_query($con, $q);
if ( $obj = @mysqli_fetch_object($r) )
 {
?>
<?php
include("tulislog.php");
$tabel = mysqli_real_escape_string($con, $_REQUEST[tabel]);
$result = mysqli_query($con, "DELETE FROM tw_tabel WHERE tabel = '". $tabel . "'");
 tulislog("delete tw_tabel", $con); 
header("Location:listtw_tabel.php");
mysqli_close($con);
?>
<?php
} else {
 header("Location:content.php");
}
?>
