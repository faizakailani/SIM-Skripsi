<?php
session_start();
if(!isset($_SESSION["Email"])){
header("location:index.php");
}
?>
<?php
include("db.php");
$id = mysqli_real_escape_string($con, $_REQUEST[id]);
$result = mysqli_query($con, "DELETE FROM tw_hak_akses WHERE id = '". $id . "'");
$_SESSION["delete_success"] = "Data berhasil dihapus.";
header("Location:listmastertw_tabeltw_hak_aksesdetail.php?tabel=$_GET[tabel]");
mysqli_close($con);
?>
