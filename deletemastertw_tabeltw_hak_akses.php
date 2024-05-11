<?php
session_start();
if(!isset($_SESSION["Email"])){
header("location:index.php");
}
?>
<?php include("db.php"); ?>
<?php
//cek otoritas
$q = "SELECT * FROM tw_hak_akses where tabel='Manage_User_Access' and user = '". $_SESSION['Email'] ."' and deleteData='1'";
$r = mysqli_query($con, $q);
if ( $obj = @mysqli_fetch_object($r) )
 {
?>
<?php
$tabel = mysqli_real_escape_string($con, $_REQUEST[tabel]);
$result = mysqli_query($con, "DELETE FROM tw_tabel WHERE tabel = '". $tabel . "'");
header("Location:listmastertw_tabeltw_hak_akses.php");
mysqli_close($con);
?>
<?php
} else {
 header("Location:content.php");
}
?>
