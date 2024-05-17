<?php
session_start();
if(!isset($_SESSION["Email"])){
header("location:index.php");
}
?>
<?php
include("db.php");
$pk = mysqli_real_escape_string($con, $_POST["pk"]);
$tabel = mysqli_real_escape_string($con, $_POST["tabel"]);

mysqli_query($con, "update tw_tabel set tabel='$tabel' where tabel='$pk'");
$_SESSION["edit_success"] = "Data berhasil diubah.";
header("Location: listmastertw_tabeltw_hak_akses.php");
mysqli_close($con);
?>
