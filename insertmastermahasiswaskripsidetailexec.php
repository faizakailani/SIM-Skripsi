<?php
session_start();
if(!isset($_SESSION["Email"])){
header("location:index.php");
}
?>
<?php
include("db.php");
$id= mysqli_real_escape_string($con, $_POST["id"]);
$NIM= mysqli_real_escape_string($con, $_POST["NIM"]);
$Pembimbing= mysqli_real_escape_string($con, $_POST["Pembimbing"]);
$Penguji1= mysqli_real_escape_string($con, $_POST["Penguji1"]);
$Penguji2= mysqli_real_escape_string($con, $_POST["Penguji2"]);
$Tanggal_Daftar= mysqli_real_escape_string($con, $_POST["Tanggal_Daftar"]);
$Tanggal_Sidang= mysqli_real_escape_string($con, $_POST["Tanggal_Sidang"]);
$Ruang_Sidang= mysqli_real_escape_string($con, $_POST["Ruang_Sidang"]);
$Nilai_Pembimbing= mysqli_real_escape_string($con, $_POST["Nilai_Pembimbing"]);
$Nilai_Penguji1= mysqli_real_escape_string($con, $_POST["Nilai_Penguji1"]);
$Nilai_Penguji2= mysqli_real_escape_string($con, $_POST["Nilai_Penguji2"]);
$Nilai_Akhir= mysqli_real_escape_string($con, $_POST["Nilai_Akhir"]);
$Keterangan= mysqli_real_escape_string($con, $_POST["Keterangan"]);

 mysqli_query($con, "INSERT INTO skripsi(id,NIM,Pembimbing,Penguji1,Penguji2,Tanggal_Daftar,Tanggal_Sidang,Ruang_Sidang,Nilai_Pembimbing,Nilai_Penguji1,Nilai_Penguji2,Nilai_Akhir,Keterangan) VALUES (null,'$NIM','$Pembimbing','$Penguji1','$Penguji2','$Tanggal_Daftar','$Tanggal_Sidang','$Ruang_Sidang','$Nilai_Pembimbing','$Nilai_Penguji1','$Nilai_Penguji2','$Nilai_Akhir','$Keterangan')");
header("Location: listmastermahasiswaskripsidetail.php?NIM=$NIM");
mysqli_close($con)
?>
