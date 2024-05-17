<?php
session_start();
if(!isset($_SESSION["Email"])){
header("location:index.php");
}
?>
<?php
include("db.php");
$pk = mysqli_real_escape_string($con, $_POST["pk"]);
$NIDN = mysqli_real_escape_string($con, $_POST["NIDN"]);
$Nama = mysqli_real_escape_string($con, $_POST["Nama"]);
$Foto = mysqli_real_escape_string($con, $_POST["Foto"]);

mysqli_query($con, "update dosen set NIDN='$NIDN', Nama='$Nama', Foto='$Foto' where NIDN='$pk'");
$_SESSION["edit_success"] = "Data berhasil diubah.";
header("Location: listmasterdosenskripsi.php");
mysqli_close($con);
?>
