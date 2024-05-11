<?php
session_start();
if(!isset($_SESSION["Email"])){
header("location:index.php");
}
?>
<?php
include("db.php");
include("tulislog.php");
$id= mysqli_real_escape_string($con, $_POST["id"]);
$tabel= mysqli_real_escape_string($con, $_POST["tabel"]);
$user= mysqli_real_escape_string($con, $_POST["user"]);
$listData= mysqli_real_escape_string($con, $_POST["listData"]);
$viewData= mysqli_real_escape_string($con, $_POST["viewData"]);
$insertData= mysqli_real_escape_string($con, $_POST["insertData"]);
$editData= mysqli_real_escape_string($con, $_POST["editData"]);
$deleteData= mysqli_real_escape_string($con, $_POST["deleteData"]);
$detailData= mysqli_real_escape_string($con, $_POST["detailData"]);

if (isset($id) && isset($tabel) && isset($user) && isset($listData) && isset($viewData) && isset($insertData) && isset($editData) && isset($deleteData) && isset($detailData)){
mysqli_query($con, "INSERT INTO tw_hak_akses(id,tabel,user,listData,viewData,insertData,editData,deleteData,detailData) VALUES (null,'$tabel','$user','$listData','$viewData','$insertData','$editData','$deleteData','$detailData')");
}

tulislog("insert into tw_hak_akses", $con); 
header("Location: listtw_hak_akses.php");
mysqli_close($con)
?>
