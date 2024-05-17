<?php
session_start();
if(!isset($_SESSION["Email"])){
header("location:index.php");
}
?>
<?php
include("db.php");
$pk = mysqli_real_escape_string($con, $_POST["pk"]);
$id = mysqli_real_escape_string($con, $_POST["id"]);
$tabel = mysqli_real_escape_string($con, $_POST["tabel"]);
$user = mysqli_real_escape_string($con, $_POST["user"]);
$listData = mysqli_real_escape_string($con, $_POST["listData"]);
$viewData = mysqli_real_escape_string($con, $_POST["viewData"]);
$insertData = mysqli_real_escape_string($con, $_POST["insertData"]);
$editData = mysqli_real_escape_string($con, $_POST["editData"]);
$deleteData = mysqli_real_escape_string($con, $_POST["deleteData"]);
$detailData = mysqli_real_escape_string($con, $_POST["detailData"]);

mysqli_query($con, "update tw_hak_akses set id='$id', tabel='$tabel', user='$user', listData='$listData', viewData='$viewData', insertData='$insertData', editData='$editData', deleteData='$deleteData', detailData='$detailData' where id=$pk");
$_SESSION["edit_success"] = "Data berhasil diubah.";
header("Location: listmastertw_tabeltw_hak_aksesdetail.php?tabel=$tabel");
mysqli_close($con);
?>
