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
echo "<td bgcolor=F5F5F5>";
echo "<table class='table table-striped'>";
echo "<tr><td colspan=2><font face=Verdana color=black size=1>tw_hak_akses</font></td></tr>";
$result = mysqli_query($con, "SELECT * FROM tw_hak_akses where tw_hak_akses.id=".$_GET['id']);
while($row = mysqli_fetch_array($result))
{
echo "<tr><td bgcolor=CCCCCC><font face=Verdana color=black size=1>id</font></td>";
echo "<td bgcolor=CCEEEE><font face=Verdana color=black size=1>" . $row['id'] . "</font></td>";
echo "<tr><td bgcolor=CCCCCC><font face=Verdana color=black size=1>tabel</font></td>";
echo "<td bgcolor=CCEEEE><font face=Verdana color=black size=1>" . $row['tabel'] . "</font></td>";
echo "<tr><td bgcolor=CCCCCC><font face=Verdana color=black size=1>user</font></td>";
echo "<td bgcolor=CCEEEE><font face=Verdana color=black size=1>" . $row['user'] . "</font></td>";
echo "<tr><td bgcolor=CCCCCC><font face=Verdana color=black size=1>listData</font></td>";
echo "<td bgcolor=CCEEEE><font face=Verdana color=black size=1>" . $row['listData'] . "</font></td>";
echo "<tr><td bgcolor=CCCCCC><font face=Verdana color=black size=1>viewData</font></td>";
echo "<td bgcolor=CCEEEE><font face=Verdana color=black size=1>" . $row['viewData'] . "</font></td>";
echo "<tr><td bgcolor=CCCCCC><font face=Verdana color=black size=1>insertData</font></td>";
echo "<td bgcolor=CCEEEE><font face=Verdana color=black size=1>" . $row['insertData'] . "</font></td>";
echo "<tr><td bgcolor=CCCCCC><font face=Verdana color=black size=1>editData</font></td>";
echo "<td bgcolor=CCEEEE><font face=Verdana color=black size=1>" . $row['editData'] . "</font></td>";
echo "<tr><td bgcolor=CCCCCC><font face=Verdana color=black size=1>deleteData</font></td>";
echo "<td bgcolor=CCEEEE><font face=Verdana color=black size=1>" . $row['deleteData'] . "</font></td>";
echo "<tr><td bgcolor=CCCCCC><font face=Verdana color=black size=1>detailData</font></td>";
echo "<td bgcolor=CCEEEE><font face=Verdana color=black size=1>" . $row['detailData'] . "</font></td>";
echo "<tr><td colspan=2 align=center><a href=listmastertw_tabeltw_hak_aksesdetail.php?tabel=$_GET[tabel]><button type='button' class='btn btn-warning'><font face=Verdana size=1><i class='fa fa-check'></i>&nbsp;Back</font></button></a></td></tr>";
echo "</table></td></tr>";
}
?>
</div> 
<?php 
?>
</div> 
<?php 
include("footer.php");
?>
