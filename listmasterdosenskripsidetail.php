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
$q = "SELECT * FROM tw_hak_akses where tabel='dosen/skripsi' and user = '". $_SESSION['Email'] ."' and detailData='1'";
$r = mysqli_query($con, $q);
if ( $obj = @mysqli_fetch_object($r) )
 {
?>
<?php
echo "<td bgcolor=F5F5F5 valign=top>";
echo "<div class='table-responsive'> "; 
echo "<table class='table table-striped'>"; 
echo "<tr><td><font face=Verdana color=black size=1>dosen</font></td></tr>";
if(isset($_GET['NIDN'])){$result = mysqli_query($con, "SELECT * FROM dosen where NIDN = '". mysqli_real_escape_string($con, $_GET['NIDN']) . "'");}
while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td bgcolor=CCCCCC><font face=Verdana color=black size=1><b>NIDN</b></font></td>";
echo "<td bgcolor=CCCCCC><font face=Verdana color=black size=1><b>Nama</b></font></td>";
echo "<td bgcolor=CCCCCC><font face=Verdana color=black size=1><b>Foto</b></font></td>";
echo "</tr>";
echo "<tr>";
  echo "<td bgcolor=E5E5E5><font face=Verdana color=black size=1>" . $row['NIDN'] . "</font></td>";
  echo "<td bgcolor=E5E5E5><font face=Verdana color=black size=1>" . $row['Nama'] . "</font></td>";
  echo "<td bgcolor=E5E5E5><font face=Verdana color=black size=1><a href='images/" . $row['Foto'] . "' target=_blank><img src='images/" . $row['Foto'] . "' width=50 height=50></a></font></td>";
echo "</tr>";
}
echo "<tr><td align=left><a href=listmasterdosenskripsi.php><button type='button' class='btn btn-warning'><font face=Verdana size=1><i class='fa fa-check'></i>&nbsp;Back</font></button></a></td></tr>";
echo "</table>";
echo "</div>";
echo "<br><br>";
echo "<font face=Verdana color=black size=1>skripsi</font><br>";
if(isset($_GET['NIDN'])){echo "<a href=insertmasterdosenskripsidetail.php?NIDN=". mysqli_real_escape_string($con, $_GET['NIDN']) ."><button type='button' class='btn btn-light'><font face=Verdana size=1><i class='fa fa-plus'></i>&nbsp;Insert</font></button></a><br><br>";}
if((!isset($_POST["cari"])) or ($_POST["cari"] == "")){
// Langkah 1: Tentukan batas,cek halaman & posisi data
$batas   = 100;
if(isset($_GET["halaman"])){ $halaman = $_GET['halaman'];}
if(empty($halaman)){
	$posisi  = 0;
	$halaman = 1;
}
else{
	$posisi = ($halaman-1) * $batas;
}
if(isset($_GET['NIDN'])){$result = mysqli_query($con, "SELECT * FROM skripsi where skripsi.Pembimbing= '".mysqli_real_escape_string($con, $_GET['NIDN'])."' LIMIT $posisi,$batas");}
echo "<div class='table-responsive'> "; 
echo "<table class='table table-striped'>"; 
$firstColumn = 1;
$warna = 0;
while($row = mysqli_fetch_array($result))
  {
  if ($firstColumn == 1) {
echo "<tr bgcolor=D3DCE3>
<td></td>
<td></td>
<td></td>
<td><font face=Verdana color=black size=1><b>id</b></font></td>
<td><font face=Verdana color=black size=1><b>NIM</b></font></td>
<td><font face=Verdana color=black size=1><b>Pembimbing</b></font></td>
<td><font face=Verdana color=black size=1><b>Penguji1</b></font></td>
<td><font face=Verdana color=black size=1><b>Penguji2</b></font></td>
<td><font face=Verdana color=black size=1><b>Tanggal_Daftar</b></font></td>
<td><font face=Verdana color=black size=1><b>Tanggal_Sidang</b></font></td>
<td><font face=Verdana color=black size=1><b>Ruang_Sidang</b></font></td>
<td><font face=Verdana color=black size=1><b>Nilai_Pembimbing</b></font></td>
<td><font face=Verdana color=black size=1><b>Nilai_Penguji1</b></font></td>
<td><font face=Verdana color=black size=1><b>Nilai_Penguji2</b></font></td>
<td><font face=Verdana color=black size=1><b>Nilai_Akhir</b></font></td>
<td><font face=Verdana color=black size=1><b>Keterangan</b></font></td>
</tr>";
$firstColumn = 0;
  }
  if ($warna == 0){
  	echo "<tr bgcolor=E5E5E5 onMouseOver=\"this.bgColor='#8888FF';\" onMouseOut=\"this.bgColor='E5E5E5';\">";
	$warna = 1;
  }else{
  	echo "<tr bgcolor=D5D5D5 onMouseOver=\"this.bgColor='#8888FF';\" onMouseOut=\"this.bgColor='D5D5D5';\">";
	$warna = 0;
  }
  if(isset($_GET['NIDN'])){echo "<td><a class=linklist href=viewmasterdosenskripsidetail.php?id=".$row['id']."&NIDN=". mysqli_real_escape_string($con, $_GET['NIDN']) ."><button type='button' class='btn btn-warning'><font face=Verdana size=1><i class='fa fa-check'></i></font></button></a></td>";}
  if(isset($_GET['NIDN'])){echo "<td><a class=linklist href=editmasterdosenskripsidetail.php?id=".$row['id']."&NIDN=". mysqli_real_escape_string($con, $_GET['NIDN']) ."><button type='button' class='btn btn-primary'><font face=Verdana size=1><i class='fa fa-edit'></i></font></button></a></td>";}
  if(isset($_GET['NIDN'])){echo "<td><a class=linklist href=deletemasterdosenskripsidetail.php?id=".$row['id']."&NIDN=". mysqli_real_escape_string($con, $_GET['NIDN']) ." onclick=\"return confirm('Are you sure you want to delete this data?')\"><button type='button' class='btn btn-danger'><font face=Verdana size=1><i class='fa fa-Trash'></i></font></button></a></td>";}
  echo "<td><font face=Verdana color=black size=1>" . $row['id'] . "</font></td>";
  echo "<td><font face=Verdana color=black size=1>" . $row['NIM'] . "<br>";
  $l = mysqli_query($con, "select Nama from mahasiswa where NIM = '". $row['NIM'] ."'"); 
  while($rl = mysqli_fetch_array($l)){  
    echo $rl[0];    
  } 
  echo "</font></td>";
  echo "<td><font face=Verdana color=black size=1>" . $row['Pembimbing'] . "<br>";
  $l = mysqli_query($con, "select Nama from dosen where NIDN = '". $row['Pembimbing'] ."'"); 
  while($rl = mysqli_fetch_array($l)){  
    echo $rl[0];    
  } 
  echo "</font></td>";
  echo "<td><font face=Verdana color=black size=1>" . $row['Penguji1'] . "<br>";
  $l = mysqli_query($con, "select Nama from dosen where NIDN = '". $row['Penguji1'] ."'"); 
  while($rl = mysqli_fetch_array($l)){  
    echo $rl[0];    
  } 
  echo "</font></td>";
  echo "<td><font face=Verdana color=black size=1>" . $row['Penguji2'] . "<br>";
  $l = mysqli_query($con, "select Nama from dosen where NIDN = '". $row['Penguji2'] ."'"); 
  while($rl = mysqli_fetch_array($l)){  
    echo $rl[0];    
  } 
  echo "</font></td>";
  echo "<td><font face=Verdana color=black size=1>" . $row['Tanggal_Daftar'] . "</font></td>";
  echo "<td><font face=Verdana color=black size=1>" . $row['Tanggal_Sidang'] . "</font></td>";
  echo "<td><font face=Verdana color=black size=1>" . $row['Ruang_Sidang'] . "</font></td>";
  echo "<td><font face=Verdana color=black size=1>" . $row['Nilai_Pembimbing'] . "</font></td>";
  echo "<td><font face=Verdana color=black size=1>" . $row['Nilai_Penguji1'] . "</font></td>";
  echo "<td><font face=Verdana color=black size=1>" . $row['Nilai_Penguji2'] . "</font></td>";
  echo "<td><font face=Verdana color=black size=1>" . $row['Nilai_Akhir'] . "</font></td>";
  echo "<td><font face=Verdana color=black size=1>" . $row['Keterangan'] . "</font></td>";
  echo "</tr>";
  }
echo "</table><br>";
echo "</div>";
//Langkah 3: Hitung total data dan halaman
if(isset($_GET['NIDN'])){$tampil2 = mysqli_query($con, "SELECT * FROM skripsi where skripsi.Pembimbing='".mysqli_real_escape_string($con, $_GET['NIDN'])."'");}
$jmldata = mysqli_num_rows($tampil2);
$jmlhal  = ceil($jmldata/$batas);
echo "<div class=paging>";
// Link ke halaman sebelumnya (previous)
if($halaman > 1){
	$prev=$halaman-1;
	echo "<span class=prevnext><a href=$_SERVER[PHP_SELF]?halaman=$prev><< Prev</a></span> ";
}
else{
	echo "<span class=disabled><< Prev</span> ";
}
// Tampilkan link halaman 1,2,3 ...
for($i=1;$i<=$jmlhal;$i++)
if ($i != $halaman){
	echo " <a href=$_SERVER[PHP_SELF]?halaman=$i>$i</a> ";
}
else{
	echo " <span class=current>$i</span> ";
}
// Link kehalaman berikutnya (Next)
if($halaman < $jmlhal){
	$next=$halaman+1;
	echo "<span class=prevnext><a href=$_SERVER[PHP_SELF]?halaman=$next>Next >></a></span>";
}
else{
	echo "<span class=disabled>Next >></span>";
}
echo "</div>";
echo "<p align=center><font face=Verdana color=black size=1><b>$jmldata</b> data</font></p>";
mysqli_close($con);
echo "</td></tr>";
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
