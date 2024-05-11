<?php
session_start();
if(!isset($_SESSION["Email"])){
header("location:index.php");
}
?>
<?php
include("db.php");
$tabel= mysqli_real_escape_string($con, $_POST["tabel"]);

if ($tabel!= ""){
 mysqli_query($con, "INSERT INTO tw_tabel(tabel) VALUES ('$tabel')");
}
header("Location: listmastertw_tabeltw_hak_akses.php");
mysqli_close($con)
?>
