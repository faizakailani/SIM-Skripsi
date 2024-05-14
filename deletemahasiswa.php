<?php
session_start();
if (!isset($_SESSION["Email"])) {
    header("location:index.php");
}
?>
<?php include("db.php"); ?>
<?php
//cek otoritas
$q = "SELECT * FROM tw_hak_akses where tabel='mahasiswa' and user = '" . $_SESSION['Email'] . "' and deleteData='1'";
$r = mysqli_query($con, $q);
if ($obj = @mysqli_fetch_object($r)) {
?>
<?php
    include("tulislog.php");
    $NIM = mysqli_real_escape_string($con, $_REQUEST['NIM']);
    $result = mysqli_query($con, "DELETE FROM mahasiswa WHERE NIM = '" . $NIM . "'");
    tulislog("delete mahasiswa", $con);
    header("Location:listmahasiswa.php");
    mysqli_close($con);
?>
<?php
} else {
    header("Location:content.php");
}
?>