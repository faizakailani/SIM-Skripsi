<?php
session_start();
if(!isset($_SESSION["Email"])){
header("location:index.php");
}
?>
<?php include("db.php"); ?>
<?php
//cek otoritas
$q = "SELECT * FROM tw_hak_akses where tabel='dosen/skripsi' and user = '". $_SESSION['Email'] ."' and deleteData='1'";
$r = mysqli_query($con, $q);
if ( $obj = @mysqli_fetch_object($r) )
 {
?>
<?php
$NIDN = mysqli_real_escape_string($con, $_REQUEST[NIDN]);
$result = mysqli_query($con, "DELETE FROM dosen WHERE NIDN = '". $NIDN . "'");
header("Location:listmasterdosenskripsi.php");
mysqli_close($con);
?>
<?php
} else {
 header("Location:content.php");
}
?>
