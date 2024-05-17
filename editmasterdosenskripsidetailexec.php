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
$NIM = mysqli_real_escape_string($con, $_POST["NIM"]);
$Pembimbing = mysqli_real_escape_string($con, $_POST["Pembimbing"]);
$Penguji1 = mysqli_real_escape_string($con, $_POST["Penguji1"]);
$Penguji2 = mysqli_real_escape_string($con, $_POST["Penguji2"]);
$Tanggal_Daftar = mysqli_real_escape_string($con, $_POST["Tanggal_Daftar"]);
$Tanggal_Sidang = mysqli_real_escape_string($con, $_POST["Tanggal_Sidang"]);
$Ruang_Sidang = mysqli_real_escape_string($con, $_POST["Ruang_Sidang"]);
$Nilai_Pembimbing = mysqli_real_escape_string($con, $_POST["Nilai_Pembimbing"]);
$Nilai_Penguji1 = mysqli_real_escape_string($con, $_POST["Nilai_Penguji1"]);
$Nilai_Penguji2 = mysqli_real_escape_string($con, $_POST["Nilai_Penguji2"]);
$Nilai_Akhir = mysqli_real_escape_string($con, $_POST["Nilai_Akhir"]);
$Keterangan = mysqli_real_escape_string($con, $_POST["Keterangan"]);

mysqli_query($con, "update skripsi set id='$id', NIM='$NIM', Pembimbing='$Pembimbing', Penguji1='$Penguji1', Penguji2='$Penguji2', Tanggal_Daftar='$Tanggal_Daftar', Tanggal_Sidang='$Tanggal_Sidang', Ruang_Sidang='$Ruang_Sidang', Nilai_Pembimbing='$Nilai_Pembimbing', Nilai_Penguji1='$Nilai_Penguji1', Nilai_Penguji2='$Nilai_Penguji2', Nilai_Akhir='$Nilai_Akhir', Keterangan='$Keterangan' where id=$pk");
$_SESSION["edit_success"] = "Data berhasil diubah.";
header("Location: listmasterdosenskripsidetail.php?NIDN=$NIDN");
mysqli_close($con);
?>
