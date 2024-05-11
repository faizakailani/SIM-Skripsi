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
?>      
<div id="page-wrapper">
<?php
//cek otoritas
$q = "SELECT * FROM tw_hak_akses where tabel='Manage_User_Access' and user = '". $_SESSION['Email'] ."' and viewData='1'";
$r = mysqli_query($con, $q);
if ( $obj = @mysqli_fetch_object($r) )
 {
?>
<?php
echo "<td bgcolor=F5F5F5>";
echo "<table class='table table-striped'>";
echo "<tr><td colspan=2><font face=Verdana color=black size=1>tw_tabel</font></td></tr>";
$result = mysqli_query($con, "SELECT * FROM tw_tabel where tabel = '". $_GET['tabel'] . "'");
while($row = mysqli_fetch_array($result))
{
echo "<tr><td bgcolor=CCCCCC><font face=Verdana color=black size=1>tabel</font></td>";
echo "<td bgcolor=CCEEEE><font face=Verdana color=black size=1>" . $row['tabel'] . "</font></td>";
echo "<tr><td colspan=2 align=center><a href=listmastertw_tabeltw_hak_akses.php><button type='button' class='btn btn-warning'><font face=Verdana size=1><i class='fa fa-check'></i>&nbsp;Back</font></button></a></td></tr>";
echo "</table></td></tr>";
}
include("footer.php");
?>
<?php
} else {
 //header("Location:content.php");
}
?>
