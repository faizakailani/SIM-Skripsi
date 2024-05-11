<?php
session_start();
if(!isset($_SESSION["Email"])){
header("location:index.php");
}
?>
 <?php 
include("db.php");  
include("header.php"); 
include("menu.php"); 
include("tulislog.php"); 
?> 
<div id="page-wrapper">  
<?php
//cek otoritas
$q = "SELECT * FROM tw_hak_akses where tabel='logtw' and user = '". $_SESSION['Email'] ."' and viewData='1'";
$r = mysqli_query($con, $q);
if ( $obj = @mysqli_fetch_object($r) )
 {
?>
<html>
<head>
<title>SIM Skripsi</title>
<link rel="stylesheet" type="text/css" href="tag.css">
<script type="text/javascript" src="tag.js"></script>
<script type="text/javascript" src="kalender/calendar.js"></script>
<link href="kalender/calendar.css" rel="stylesheet" type="text/css" media="screen">
</head>
<body topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 bgcolor =FFFFFF>
<?php
echo "<td bgcolor=F5F5F5 valign=top>";
echo "<div class='table-responsive'> "; 
echo "<table class='table table-striped'>"; 
echo "<tr><td colspan=2><font face=Verdana color=black size=1>logtw</font></td></tr>";
$result = mysqli_query($con, "SELECT * FROM logtw where id = '". mysqli_real_escape_string($con, $_GET['id']) . "'");
while($row = mysqli_fetch_array($result))
{
echo "<tr><td bgcolor=CCCCCC><font face=Verdana color=black size=1>id</font></td>";
echo "<td bgcolor=CCEEEE><font face=Verdana color=black size=1>" . $row['id'] . "</font></td>";
echo "<tr><td bgcolor=CCCCCC><font face=Verdana color=black size=1>Time</font></td>";
echo "<td bgcolor=CCEEEE><font face=Verdana color=black size=1>" . $row['Time'] . "</font></td>";
echo "<tr><td bgcolor=CCCCCC><font face=Verdana color=black size=1>User</font></td>";
echo "<td bgcolor=CCEEEE><font face=Verdana color=black size=1>" . $row['User'] . "</font></td>";
echo "<tr><td bgcolor=CCCCCC><font face=Verdana color=black size=1>IpAddress</font></td>";
echo "<td bgcolor=CCEEEE><font face=Verdana color=black size=1>" . $row['IpAddress'] . "</font></td>";
echo "<tr><td bgcolor=CCCCCC><font face=Verdana color=black size=1>Information</font></td>";
echo "<td bgcolor=CCEEEE><font face=Verdana color=black size=1>" . $row['Information'] . "</font></td>";
echo "<tr><td colspan=2 align=center><a href=listlogtw.php><button type='button' class='btn btn-warning'><font face=Verdana size=1><i class='fa fa-check'></i>&nbsp;Back</font></button></a></td></tr>";
echo "</table><br>";
echo "</div>"; 
}
 tulislog("view logtw", $con); 
 ?>   
 </div> 
 <?php 
include("footer.php");
?>
<?php
} else {
 //header("Location:content.php");
}
?>
