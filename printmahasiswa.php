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
echo "<font face=Verdana color=black size=1>mahasiswa</font><br><br>";
$result = mysqli_query($con, "SELECT * FROM mahasiswa");
echo "<div class='table-responsive'> "; 
echo "<table id=laporan width=100%>"; 
echo "<tr bgcolor=D3DCE3>
<th><font face=Verdana color=black size=1>NIM</font></th>
<th><font face=Verdana color=black size=1>Nama</font></th>
<th><font face=Verdana color=black size=1>Program_Studi</font></th>
<th><font face=Verdana color=black size=1>Foto</font></th>
</tr>";
while($row = mysqli_fetch_array($result))
  {
  echo "<td><font face=Verdana color=black size=1>" . $row['NIM'] . "</font></td>";
  echo "<td><font face=Verdana color=black size=1>" . $row['Nama'] . "</font></td>";
  echo "<td><font face=Verdana color=black size=1>" . $row['Program_Studi'] . "<br>";
  $l = mysqli_query($con, "select Program_Studi from program_studi where Kode = '". $row['Program_Studi'] ."'"); 
  while($rl = mysqli_fetch_array($l)){  
    echo $rl[0];    
  } 
  echo "</font></td>";
  echo "<td><font face=Verdana color=black size=1><a href='images/" . $row['Foto'] . "' target=_blank><img src='images/" . $row['Foto'] . "' width=50 height=50></a></font></td>";
  echo "</tr>";
  }
echo "</table><br>";
echo "</div>";
mysqli_close($con);
echo "</td></tr>";
 ?>   
 </div> 
