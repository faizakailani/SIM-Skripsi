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
echo "<font face=Verdana color=black size=1>setting</font><br><br>";
$result = mysqli_query($con, "SELECT * FROM setting");
echo "<div class='table-responsive'> "; 
echo "<table id=laporan width=100%>"; 
echo "<tr bgcolor=D3DCE3>
<th><font face=Verdana color=black size=1>ID</font></th>
<th><font face=Verdana color=black size=1>Nama</font></th>
<th><font face=Verdana color=black size=1>Alamat</font></th>
<th><font face=Verdana color=black size=1>Telepon</font></th>
<th><font face=Verdana color=black size=1>Email</font></th>
<th><font face=Verdana color=black size=1>Logo</font></th>
</tr>";
while($row = mysqli_fetch_array($result))
  {
  echo "<td><font face=Verdana color=black size=1>" . $row['ID'] . "</font></td>";
  echo "<td><font face=Verdana color=black size=1>" . $row['Nama'] . "</font></td>";
  echo "<td><font face=Verdana color=black size=1>" . $row['Alamat'] . "</font></td>";
  echo "<td><font face=Verdana color=black size=1>" . $row['Telepon'] . "</font></td>";
  echo "<td><font face=Verdana color=black size=1>" . $row['Email'] . "</font></td>";
  echo "<td><font face=Verdana color=black size=1><a href='images/" . $row['Logo'] . "' target=_blank><img src='images/" . $row['Logo'] . "' width=100 height=100></a></font></td>";
  echo "</tr>";
  }
echo "</table><br>";
echo "</div>";
mysqli_close($con);
echo "</td></tr>";
 ?>   
 </div> 
