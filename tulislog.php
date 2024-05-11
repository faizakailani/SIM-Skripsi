<?php
function tulislog($Keterangan, $con){
 $Siapa = $_SESSION["Email"];
 $ip=$_SERVER['REMOTE_ADDR'];
 $hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
 $Dimana = $ip ."/". $hostname;
 mysqli_query($con, "INSERT INTO logtw(User, IpAddress, Information) values('$Siapa', '$Dimana', '$Keterangan')");
}
?>
