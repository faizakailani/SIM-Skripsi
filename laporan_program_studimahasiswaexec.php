<style> 
#laporan td, #laporan th { 
  border: 1px solid #ddd; 
  padding: 4px; 
}
</style> 
<?php     
include("db.php");  
$TanggalAwal = mysqli_real_escape_string($con, $_POST['TanggalAwal']);  
$TanggalAkhir = mysqli_real_escape_string($con, $_POST['TanggalAkhir']);
$All = mysqli_real_escape_string($con, $_POST['All']);
  
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
 
echo "<font face=Verdana color=black size=1><b>Laporan program_studi/mahasiswa</b></font><br>";
if ($All == "Tidak"){  
 echo "<font face=Verdana color=black size=1>Tanggal : $TanggalAwal s.d. $TanggalAkhir</font><br>";
} 
 
echo "<table width=100%>";  
if ($All == "Tidak"){ 
$result = mysqli_query($con, "SELECT * FROM program_studi where Tanggal >= '$TanggalAwal' and Tanggal <= '$TanggalAkhir'");
} else { 
$result = mysqli_query($con, "SELECT * FROM program_studi");
} 
while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td bgcolor=D3DCE3><font face=Verdana color=black size=1><b>Kode</b></font></td>";
echo "<td bgcolor=D3DCE3><font face=Verdana color=black size=1><b>Program_Studi</b></font></td>";
echo "<td bgcolor=D3DCE3><font face=Verdana color=black size=1><b>Kaprodi</b></font></td>";
echo "<td bgcolor=D3DCE3><font face=Verdana color=black size=1><b>NIDN_Kaprodi</b></font></td>";
echo "</tr>";
echo "<tr>";
echo "<td bgcolor=E5E5E5><font face=Verdana color=black size=1>" . $row['Kode'] . "</font></td>";
echo "<td bgcolor=E5E5E5><font face=Verdana color=black size=1>" . $row['Program_Studi'] . "</font></td>";
echo "<td bgcolor=E5E5E5><font face=Verdana color=black size=1>" . $row['Kaprodi'] . "</font></td>";
echo "<td bgcolor=E5E5E5><font face=Verdana color=black size=1>" . $row['NIDN_Kaprodi'] . "</font></td>";
echo "</tr>"; 
echo "<tr>"; 
echo "<td colspan=4>"; 
echo "<table id=laporan align=right width=80%>";  
echo "<tr>";
echo "<td><font face=Verdana color=black size=1><b>NIM</b></font></td>";
echo "<td><font face=Verdana color=black size=1><b>Nama</b></font></td>";
echo "<td><font face=Verdana color=black size=1><b>Program_Studi</b></font></td>";
echo "<td><font face=Verdana color=black size=1><b>Foto</b></font></td>";
echo "</tr>";
$result2 = mysqli_query($con, "SELECT * FROM mahasiswa where Program_Studi = '". $row['Kode'] ."'");
while($row2 = mysqli_fetch_array($result2))
{
echo "<tr>";
echo "<td><font face=Verdana color=black size=1>" . $row2['NIM'] . "</font></td>";
echo "<td><font face=Verdana color=black size=1>" . $row2['Nama'] . "</font></td>";
  echo "<td><font face=Verdana color=black size=1>" . $row2['Program_Studi'] . "<br>";
  $l = mysqli_query($con, "select Program_Studi from program_studi where Program_Studi = '". $row2['Program_Studi'] ."'"); 
  while($rl = mysqli_fetch_array($l)){  
    echo $rl[0];    
  } 
  echo "</font></td>";
  echo "<td><font face=Verdana color=black size=1><a href='images/" . $row2['Foto'] . "' target=_blank><img src='images/" . $row['Foto'] . "'  width=50 height=50></a></font></td>";
echo "</tr>"; 
} 
echo "</table>"; 
} 
echo "</td>"; 
echo "</tr>"; 
echo "</table>"; 
mysqli_close($con);
?>
