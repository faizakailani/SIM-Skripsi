<?php
session_start();
if(!isset($_SESSION["Email"])){
header("location:index.php");
}
?>
<?php include("db.php"); ?>
<?php
//cek otoritas
$q = "SELECT * FROM tw_hak_akses where tabel='program_studi/mahasiswa' and user = '". $_SESSION['Email'] ."' and deleteData='1'";
$r = mysqli_query($con, $q);
if ( $obj = @mysqli_fetch_object($r) )
 {
?>
<?php
$Kode = mysqli_real_escape_string($con, $_REQUEST[Kode]);
$result = mysqli_query($con, "DELETE FROM program_studi WHERE Kode = '". $Kode . "'");
header("Location:listmasterprogram_studimahasiswa.php");
mysqli_close($con);
?>
<?php
} else {
 header("Location:content.php");
}
?>
