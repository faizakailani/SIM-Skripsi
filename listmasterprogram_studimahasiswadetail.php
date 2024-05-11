<?php
session_start();
if(!isset($_SESSION["Email"])){
header("location:index.php");
}
error_reporting(0);
?>
<?php     
include("db.php");  
include("header.php"); 
include("menu.php"); 
?>      
<div id="page-wrapper">
<?php
//cek otoritas
$q = "SELECT * FROM tw_hak_akses where tabel='program_studi/mahasiswa' and user = '". $_SESSION['Email'] ."' and detailData='1'";
$r = mysqli_query($con, $q);
if ( $obj = @mysqli_fetch_object($r) )
 {
?>
<?php
echo "<td bgcolor=F5F5F5 valign=top>";
echo "<div class='table-responsive'> "; 
echo "<table class='table table-striped'>"; 
echo "<tr><td><font face=Verdana color=black size=1>program_studi</font></td></tr>";
if(isset($_GET['Kode'])){$result = mysqli_query($con, "SELECT * FROM program_studi where Kode = '". mysqli_real_escape_string($con, $_GET['Kode']) . "'");}
while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td bgcolor=CCCCCC><font face=Verdana color=black size=1><b>Kode</b></font></td>";
echo "<td bgcolor=CCCCCC><font face=Verdana color=black size=1><b>Program_Studi</b></font></td>";
echo "<td bgcolor=CCCCCC><font face=Verdana color=black size=1><b>Kaprodi</b></font></td>";
echo "<td bgcolor=CCCCCC><font face=Verdana color=black size=1><b>NIDN_Kaprodi</b></font></td>";
echo "</tr>";
echo "<tr>";
  echo "<td bgcolor=E5E5E5><font face=Verdana color=black size=1>" . $row['Kode'] . "</font></td>";
  echo "<td bgcolor=E5E5E5><font face=Verdana color=black size=1>" . $row['Program_Studi'] . "</font></td>";
  echo "<td bgcolor=E5E5E5><font face=Verdana color=black size=1>" . $row['Kaprodi'] . "</font></td>";
  echo "<td bgcolor=E5E5E5><font face=Verdana color=black size=1>" . $row['NIDN_Kaprodi'] . "</font></td>";
echo "</tr>";
}
echo "<tr><td align=left><a href=listmasterprogram_studimahasiswa.php><button type='button' class='btn btn-warning'><font face=Verdana size=1><i class='fa fa-check'></i>&nbsp;Back</font></button></a></td></tr>";
echo "</table>";
echo "</div>";
echo "<br><br>";
echo "<font face=Verdana color=black size=1>mahasiswa</font><br>";
if(isset($_GET['Kode'])){echo "<a href=insertmasterprogram_studimahasiswadetail.php?Kode=". mysqli_real_escape_string($con, $_GET['Kode']) ."><button type='button' class='btn btn-light'><font face=Verdana size=1><i class='fa fa-plus'></i>&nbsp;Insert</font></button></a><br><br>";}
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
if(isset($_GET['Kode'])){$result = mysqli_query($con, "SELECT * FROM mahasiswa where mahasiswa.Program_Studi= '".mysqli_real_escape_string($con, $_GET['Kode'])."' LIMIT $posisi,$batas");}
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
<td><font face=Verdana color=black size=1><b>NIM</b></font></td>
<td><font face=Verdana color=black size=1><b>Nama</b></font></td>
<td><font face=Verdana color=black size=1><b>Program_Studi</b></font></td>
<td><font face=Verdana color=black size=1><b>Foto</b></font></td>
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
  if(isset($_GET['Kode'])){echo "<td><a class=linklist href=viewmasterprogram_studimahasiswadetail.php?NIM=".$row['NIM']."&Kode=". mysqli_real_escape_string($con, $_GET['Kode']) ."><button type='button' class='btn btn-warning'><font face=Verdana size=1><i class='fa fa-check'></i></font></button></a></td>";}
  if(isset($_GET['Kode'])){echo "<td><a class=linklist href=editmasterprogram_studimahasiswadetail.php?NIM=".$row['NIM']."&Kode=". mysqli_real_escape_string($con, $_GET['Kode']) ."><button type='button' class='btn btn-primary'><font face=Verdana size=1><i class='fa fa-edit'></i></font></button></a></td>";}
  if(isset($_GET['Kode'])){echo "<td><a class=linklist href=deletemasterprogram_studimahasiswadetail.php?NIM=".$row['NIM']."&Kode=". mysqli_real_escape_string($con, $_GET['Kode']) ." onclick=\"return confirm('Are you sure you want to delete this data?')\"><button type='button' class='btn btn-danger'><font face=Verdana size=1><i class='fa fa-Trash'></i></font></button></a></td>";}
  echo "<td><font face=Verdana color=black size=1>" . $row['NIM'] . "</font></td>";
  echo "<td><font face=Verdana color=black size=1>" . $row['Nama'] . "</font></td>";
  echo "<td><font face=Verdana color=black size=1>" . $row['Program_Studi'] . "<br>";
  $l = mysqli_query($con, "select Program_Studi from program_studi where Program_Studi = '". $row['Program_Studi'] ."'"); 
  while($rl = mysqli_fetch_array($l)){  
    echo $rl[0];    
  } 
  echo "</font></td>";
  echo "<td><font face=Verdana color=black size=1><a href='images/" . $row['NIDN_Kaprodi'] . "' target=_blank><img src='images/" . $row['NIDN_Kaprodi'] . "'  width=50 height=50></a></font></td>";
  echo "</tr>";
  }
echo "</table><br>";
echo "</div>";
//Langkah 3: Hitung total data dan halaman
if(isset($_GET['Kode'])){$tampil2 = mysqli_query($con, "SELECT * FROM mahasiswa where mahasiswa.Program_Studi='".mysqli_real_escape_string($con, $_GET['Kode'])."'");}
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
