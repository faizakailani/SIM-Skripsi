<?php
session_start();
if(!isset($_SESSION["Email"])){
header("location:index.php");
}
?>
<?php
include("db.php");
include("tulislog.php");
$tabel= mysqli_real_escape_string($con, $_POST["tabel"]);

if (isset($tabel)){
mysqli_query($con, "INSERT INTO tw_tabel(tabel) VALUES ('$tabel')");
$_SESSION["success_message"] = "Data berhasil disimpan!";
}

tulislog("insert into tw_tabel", $con); 
header("Location: listtw_tabel.php");
mysqli_close($con)
?>
