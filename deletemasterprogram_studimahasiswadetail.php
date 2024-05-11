<?php
session_start();
if(!isset($_SESSION["Email"])){
header("location:index.php");
}
?>
<?php
include("db.php");
$NIM = mysqli_real_escape_string($con, $_REQUEST[NIM]);
$result = mysqli_query($con, "DELETE FROM mahasiswa WHERE NIM = '". $NIM . "'");
header("Location:listmasterprogram_studimahasiswadetail.php?Kode=$_GET[Kode]");
mysqli_close($con);
?>
