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
$q = "SELECT * FROM tw_hak_akses where tabel='user' and user = '". $_SESSION['Email'] ."' and editData='1'";
$r = mysqli_query($con, $q);
if ( $obj = @mysqli_fetch_object($r) )
 {
?>
<?php
echo "<table class='table table-striped'>";
echo "<tr><td colspan=2><font face=Verdana color=black size=1>user</font></td></tr>";
echo "<form action=edituserexec.php method=post>";
$result = mysqli_query($con, "SELECT * FROM user where Email = '". $_GET['Email'] . "'");
while($row = mysqli_fetch_array($result))
{
echo "<tr><td colspan=2><input type=hidden name=pk value='" . $row['Email'] . "'></td></tr>";
echo "<tr><td bgcolor=CCCCCC><font face=Verdana color=black size=1>&nbsp;&nbsp;Email&nbsp;&nbsp;</font></td>";
echo "<td bgcolor=CCEEEE><font face=Verdana color=black size=1>" . $row['Email'] . "</font></td>";
echo "<tr><td bgcolor=CCCCCC><font face=Verdana color=black size=1>&nbsp;&nbsp;Email&nbsp;&nbsp;</font></td>";
echo "<td bgcolor=CCEEEE><input type=text  class='form-control' name='Email' value='". $row['Email'] ."'></td>";
echo "<tr><td bgcolor=CCCCCC><font face=Verdana color=black size=1>&nbsp;&nbsp;Password&nbsp;&nbsp;</font></td>";
echo "<td bgcolor=CCEEEE><input type=password class='form-control' name='Password' value='". $row['Password'] ."'>";
echo "<input type=checkbox name='cp' value='ok'><font face=Verdana color=black size=1>change password</font></td>";
echo "<tr><td bgcolor=CCCCCC><font face=Verdana color=black size=1>&nbsp;&nbsp;Active&nbsp;&nbsp;</font></td>";
echo "<td bgcolor=CCEEEE>";
echo "<select class='form-control' name='Active'>";
if ($row['Active'] == '0') {
echo "<option value='0' selected>False</option>";
}else{
echo "<option value='0'>False</option>";
} 
if ($row['Active'] == '1') { 
echo "<option value='1' selected>True</option>"; 
}else{
echo "<option value='1'>True</option>";
}
echo "</select>";
echo "</td>";
echo "<tr><td colspan=2 align=center><button type='submit' class='btn btn-primary'><font face=Verdana size=1><i class='fa fa-edit'></i>&nbsp;Edit</font></button></td></tr>";
echo "</form>";
echo "</table></td></tr>";
}
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
