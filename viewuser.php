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
$q = "SELECT * FROM tw_hak_akses where tabel='user' and user = '". $_SESSION['Email'] ."' and viewData='1'";
$r = mysqli_query($con, $q);
if ( $obj = @mysqli_fetch_object($r) )
 {
?>
<?php
echo "<div class='table-responsive'> "; 
echo "<table class='table table-striped'>"; 
echo "<tr><td colspan=2><font face=Verdana color=black size=1>user</font></td></tr>";
$result = mysqli_query($con, "SELECT * FROM user where Email = '". $_GET['Email'] . "'");
while($row = mysqli_fetch_array($result))
{
echo "<tr><td bgcolor=CCCCCC><font face=Verdana color=black size=1>Email</font></td>";
echo "<td bgcolor=CCEEEE><font face=Verdana color=black size=1>" . $row['Email'] . "</font></td>";
echo "<tr><td bgcolor=CCCCCC><font face=Verdana color=black size=1>Password</font></td>";
echo "<td bgcolor=CCEEEE><font face=Verdana color=black size=1>**********</font></td>";
echo "<tr><td bgcolor=CCCCCC><font face=Verdana color=black size=1>Active</font></td>";
echo "<td bgcolor=CCEEEE><font face=Verdana color=black size=1>" . $row['Active'] . "</font></td>";
echo "<tr><td colspan=2 align=center><a href=listuser.php><button type='button' class='btn btn-warning'><font face=Verdana size=1><i class='fa fa-check'></i>&nbsp;Back</font></button></a></td></tr>";
echo "</table><br>";
echo "</div>"; 
}
 tulislog("view user", $con); 
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
