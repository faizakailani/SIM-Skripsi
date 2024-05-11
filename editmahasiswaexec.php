<?php
session_start();
if(!isset($_SESSION["Email"])){
header("location:index.php");
}
?>
<?php
include("db.php");
include("tulislog.php");
$pk = mysqli_real_escape_string($con, $_POST["pk"]);
$NIM = mysqli_real_escape_string($con, $_POST["NIM"]);
$Nama = mysqli_real_escape_string($con, $_POST["Nama"]);
$Program_Studi = mysqli_real_escape_string($con, $_POST["Program_Studi"]);
$Foto = mysqli_real_escape_string($con, $_POST["Foto"]);

mysqli_query($con, "update mahasiswa set NIM='$NIM', Nama='$Nama', Program_Studi='$Program_Studi', Foto='$Foto' where NIM='$pk'");
 tulislog("update mahasiswa", $con); 
header("Location: listmahasiswa.php");
mysqli_close($con);
?>
