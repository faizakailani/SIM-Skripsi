<?php
session_start();
if(!isset($_SESSION["Email"])){
header("location:index.php");
}
?>
<?php
include("db.php");
$Kode= mysqli_real_escape_string($con, $_POST["Kode"]);
$Program_Studi= mysqli_real_escape_string($con, $_POST["Program_Studi"]);
$Kaprodi= mysqli_real_escape_string($con, $_POST["Kaprodi"]);
$NIDN_Kaprodi= mysqli_real_escape_string($con, $_POST["NIDN_Kaprodi"]);


if ($Kode!= ""){
 mysqli_query($con, "INSERT INTO program_studi(Kode,Program_Studi,Kaprodi,NIDN_Kaprodi) VALUES ('$Kode','$Program_Studi','$Kaprodi','$NIDN_Kaprodi')");
}
header("Location: listmasterprogram_studimahasiswa.php");
mysqli_close($con)
?>
