<?php
session_start();
if(!isset($_SESSION["Email"])){
header("location:index.php");
}
?>
<?php
include("db.php");
include("tulislog.php");
$Email= mysqli_real_escape_string($con, $_POST["Email"]);
$Password= mysqli_real_escape_string($con, $_POST["Password"]);
$Active= mysqli_real_escape_string($con, $_POST["Active"]);

if (isset($Email) && isset($Password) && isset($Active)){
 mysqli_query($con, "INSERT INTO user(Email,Password,Active) VALUES ('$Email',md5('$Password'),'$Active')");
 $_SESSION["success_message"] = "Data berhasil disimpan!";
}
//isi user otoritas ke tabel tw_hak_akses
$result = mysqli_query($con, "select * from tw_tabel");
while($row = mysqli_fetch_array($result)){
 mysqli_query($con, "insert into tw_hak_akses values (null,'$row[0]','$Email','0','0','0','0','0','0')");
 $_SESSION["success_message"] = "Data berhasil disimpan!";
}
 tulislog("insert into user", $con); 
header("Location: listuser.php");
mysqli_close($con)
?>
