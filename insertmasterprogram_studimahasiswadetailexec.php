<?php
session_start();
if(!isset($_SESSION["Email"])){
header("location:index.php");
}
?>
<?php
include("db.php");
$NIM= mysqli_real_escape_string($con, $_POST["NIM"]);
$Nama= mysqli_real_escape_string($con, $_POST["Nama"]);
$Program_Studi= mysqli_real_escape_string($con, $_POST["Program_Studi"]);
$Foto= mysqli_real_escape_string($con, $_POST["Foto"]);

 mysqli_query($con, "INSERT INTO mahasiswa(NIM,Nama,Program_Studi,Foto) VALUES ('$NIM','$Nama','$Program_Studi','$Foto')");
 $_SESSION["success_message"] = "Data berhasil disimpan!";
header("Location: listmasterprogram_studimahasiswadetail.php?Kode=$Kode");
mysqli_close($con)
?>
