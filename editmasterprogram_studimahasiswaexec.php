<?php
session_start();
if (!isset($_SESSION["Email"])) {
    header("location:index.php");
}
?>
<?php
include("db.php");
$pk = mysqli_real_escape_string($con, $_POST["pk"]);
$Kode = mysqli_real_escape_string($con, $_POST["Kode"]);
$Program_Studi = mysqli_real_escape_string($con, $_POST["Program_Studi"]);
$Kaprodi = mysqli_real_escape_string($con, $_POST["Kaprodi"]);

list($nidn_kaprodi, $nama_kaprodi) = explode('|', $Kaprodi);

mysqli_query($con, "update program_studi set Kode='$Kode', Program_Studi='$Program_Studi', Kaprodi='$nama_kaprodi', NIDN_Kaprodi='$nidn_kaprodi' where Kode='$pk'");
$_SESSION["edit_success"] = "Data berhasil diubah.";
header("Location: listmasterprogram_studimahasiswa.php");
mysqli_close($con);
?>