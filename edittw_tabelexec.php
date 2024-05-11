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
$tabel = mysqli_real_escape_string($con, $_POST["tabel"]);

mysqli_query($con, "update tw_tabel set tabel='$tabel' where tabel='$pk'");
 tulislog("update tw_tabel", $con); 
header("Location: listtw_tabel.php");
mysqli_close($con);
?>
