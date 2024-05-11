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
echo "<font face=Verdana color=black size=1>tw_hak_akses</font><br><br>";
$result = mysqli_query($con, "SELECT * FROM tw_hak_akses");
echo "<div class='table-responsive'> "; 
echo "<table id=laporan width=100%>"; 
echo "<tr bgcolor=D3DCE3>
<th><font face=Verdana color=black size=1>id</font></th>
<th><font face=Verdana color=black size=1>tabel</font></th>
<th><font face=Verdana color=black size=1>user</font></th>
<th><font face=Verdana color=black size=1>listData</font></th>
<th><font face=Verdana color=black size=1>viewData</font></th>
<th><font face=Verdana color=black size=1>insertData</font></th>
<th><font face=Verdana color=black size=1>editData</font></th>
<th><font face=Verdana color=black size=1>deleteData</font></th>
<th><font face=Verdana color=black size=1>detailData</font></th>
</tr>";
while($row = mysqli_fetch_array($result))
  {
  echo "<td><font face=Verdana color=black size=1>" . $row['id'] . "</font></td>";
  echo "<td><font face=Verdana color=black size=1>" . $row['tabel'] . "</font></td>";
  echo "<td><font face=Verdana color=black size=1>" . $row['user'] . "</font></td>";
  echo "<td><font face=Verdana color=black size=1>" . $row['listData'] . "</font></td>";
  echo "<td><font face=Verdana color=black size=1>" . $row['viewData'] . "</font></td>";
  echo "<td><font face=Verdana color=black size=1>" . $row['insertData'] . "</font></td>";
  echo "<td><font face=Verdana color=black size=1>" . $row['editData'] . "</font></td>";
  echo "<td><font face=Verdana color=black size=1>" . $row['deleteData'] . "</font></td>";
  echo "<td><font face=Verdana color=black size=1>" . $row['detailData'] . "</font></td>";
  echo "</tr>";
  }
echo "</table><br>";
echo "</div>";
mysqli_close($con);
echo "</td></tr>";
 ?>   
 </div> 
