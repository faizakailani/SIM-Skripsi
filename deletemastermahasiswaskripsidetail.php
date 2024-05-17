<?php
session_start();
if(!isset($_SESSION["Email"])){
header("location:index.php");
}
?>
<?php
include("db.php");
$id = mysqli_real_escape_string($con, $_REQUEST[id]);
$result = mysqli_query($con, "DELETE FROM skripsi WHERE id = '". $id . "'");
$_SESSION["delete_success"] = "Data berhasil dihapus.";
header("Location:listmastermahasiswaskripsidetail.php?NIM=$_GET[NIM]");
mysqli_close($con);
?>
