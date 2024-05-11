<style> 
#laporan td, #laporan th {  
  border: 1px solid #ddd;  
  padding: 4px; 
}   
</style> 
<?php     
include("db.php");  
?>      
<div id="page-wrapper">

<?php
//ambil data setting  
$hset = mysqli_query($con ,"select * from setting");  
while($rset = mysqli_fetch_array($hset)){ 
	$Nama = $rset["Nama"]; 
	$Alamat = $rset["Alamat"]; 
	$Telepon = $rset["Telepon"];   
	$Logo = $rset["Logo"];  
} 
?> 
  
<table width=100%>  
<thead> 
  <tr>  
    <td rowspan="3" width=20% align=center><?php echo "<img src='images/" . $Logo . "' width=100 height=100><br>"; ?></td> 
    <td><font face=verdana size=5><?php echo $Nama; ?></font></td> 
  </tr> 
  <tr> 
    <td><font face=Verdana color=black size=1><?php echo $Alamat; ?></font></td> 
  </tr> 
  <tr> 
    <td><font face=Verdana color=black size=1>Telepon : <?php echo $Telepon; ?></font></td> 
  </tr>  
</thead>  
</table>  
<hr> 

<?php
echo "<font face=Verdana color=black size=1>logtw</font><br><br>";
$result = mysqli_query($con, "SELECT * FROM logtw");
echo "<div class='table-responsive'> "; 
echo "<table id=laporan width=100%>"; 
echo "<tr bgcolor=D3DCE3>
<th><font face=Verdana color=black size=1>id</font></th>
<th><font face=Verdana color=black size=1>Time</font></th>
<th><font face=Verdana color=black size=1>User</font></th>
<th><font face=Verdana color=black size=1>IpAddress</font></th>
<th><font face=Verdana color=black size=1>Information</font></th>
</tr>";
while($row = mysqli_fetch_array($result))
  {
  echo "<td><font face=Verdana color=black size=1>" . $row['id'] . "</font></td>";
  echo "<td><font face=Verdana color=black size=1>" . $row['Time'] . "</font></td>";
  echo "<td><font face=Verdana color=black size=1>" . $row['User'] . "</font></td>";
  echo "<td><font face=Verdana color=black size=1>" . $row['IpAddress'] . "</font></td>";
  echo "<td><font face=Verdana color=black size=1>" . $row['Information'] . "</font></td>";
  echo "</tr>";
  }
echo "</table><br>";
echo "</div>";
mysqli_close($con);
echo "</td></tr>";
 ?>   
 </div> 
