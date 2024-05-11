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
$q = "SELECT * FROM tw_hak_akses where tabel='user' and user = '". $_SESSION['Email'] ."' and insertData='1'";
$r = mysqli_query($con, $q);
if ( $obj = @mysqli_fetch_object($r) )
 {
?>
<?php
echo "<table class='table table-striped'>";
echo "<tr><td colspan=2><font face=Verdana color=black size=1>user</font></td></tr>";
echo "<form action=insertuserexec.php method=post>";
echo "<tr><td bgcolor=CCCCCC><font face=Verdana color=black size=1>Email</font></td>";
echo "<td bgcolor=CCEEEE><input type=text  class='form-control' name='Email'></td>";
echo "<tr><td bgcolor=CCCCCC><font face=Verdana color=black size=1>Password</font></td>";
echo "<td bgcolor=CCEEEE><input type=password class='form-control' name='Password'></td>";
echo "<tr><td bgcolor=CCCCCC><font face=Verdana color=black size=1>Active</font></td>";
echo "<td bgcolor=CCEEEE>";
echo "<select class='form-control' name='Active'>";
echo "<option value='0'>False</option>";
echo "<option value='1'>True</option>";
echo "</select>";
echo "</td>";
echo "<tr><td colspan=2 align=center><button type=submit><font face=Verdana size=1>&nbsp;Insert&nbsp;</font></button></td></tr>";
echo "</form>";
echo "</table>";
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
