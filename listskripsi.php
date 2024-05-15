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
$q = "SELECT * FROM tw_hak_akses where tabel='skripsi' and user = '". $_SESSION['Email'] ."' and listData='1'";
$r = mysqli_query($con, $q);
if ( $obj = @mysqli_fetch_object($r) )
 {
?>
<?php
echo "<br><h4>Master Data Skiripsi</h4><br>";

echo "<div class='row'>";
echo "<div class='col-md-6 mb-20'>";
echo "<a href=insertskripsi.php><button type='button' class='btn btn-light'><font face=Verdana color=black size=2><i class='fa fa-plus'></i>&nbsp;Insert</font></button></a>";
echo "&nbsp;&nbsp;<a href='printskripsi.php' target=_blank><button type='button' class='btn btn-light'><font face=Verdana color=black size=2><i class='fa fa-print'></i>&nbsp;Print</font></button></a>";
echo "</div>";

//cari tabel
echo "<div class='col-md-6 text-right mb-20'>";
echo "<form action=listskripsi.php method=post class='form-inline'>";
echo "<div class='form-group'>";
echo "<select class='form-control' name=select>";
$menu=mysqli_query($con, "show columns from skripsi");
while($rowmenu = mysqli_fetch_array($menu))
{
    echo "<option value=". $rowmenu['Field'] .">". $rowmenu['Field']."</option>";
}
echo "</select>";
echo "</div>";
echo "<input type=text  class='form-control' name=cari>";
echo "<button type='submit' class='btn btn-success'><i class='fa fa-search-plus'></i>Search</font></button>
</form><br>";
echo "</div>";
echo "</div>"; 

if(isset($_POST["cari"])){ $cari = mysqli_real_escape_string($con, $_POST["cari"]); }
if (isset($_POST["cari"]) && ($_POST["cari"] != "")){
//hasil pencarian tabel
$dd = "SELECT * FROM skripsi where ". $_POST["select"]." like '%" . $cari . "%'";
$resultcari = mysqli_query($con, $dd);
if ( $obj = mysqli_fetch_object($resultcari) )
{
$result = mysqli_query($con, $dd);
echo "<font color=black size=2>Hasil Pencarian</font>";
echo "<div class='table-responsive'> "; 
echo "<table class='custom-table mt-10'>"; 
echo "<tr bgcolor=337ab7>
<th><font color=white size=2>id</font></th>
<th><font color=white size=2>NIM</font></th>
<th><font color=white size=2>Pembimbing</font></th>
<th><font color=white size=2>Penguji1</font></th>
<th><font color=white size=2>Penguji2</font></th>
<th><font color=white size=2>Tanggal Daftar</font></th>
<th><font color=white size=2>Tanggal Sidang</font></th>
<th><font color=white size=2>Ruang Sidang</font></th>
<th><font color=white size=2>Nilai Pembimbing</font></th>
<th><font color=white size=2>Nilai Penguji1</font></th>
<th><font color=white size=2>Nilai Penguji2</font></th>
<th><font color=white size=2>Nilai Akhir</font></th>
<th><font color=white size=2>Keterangan</font></th>
<th 'align-middle'><font color=black size=2>Aksi</font></th>
</tr>";
$warna = 0;
while($row = mysqli_fetch_array($result))
  {
  if ($warna == 0){
  	echo "<tr bgcolor=FFFFFF onMouseOver=\"this.bgColor='#D3DCE3';\" onMouseOut=\"this.bgColor='FFFFFF';\">";
	$warna = 1;
  }else{
  	echo "<tr bgcolor=FFFFFF onMouseOver=\"this.bgColor='#D3DCE3';\" onMouseOut=\"this.bgColor='FFFFFF';\">";
	$warna = 0;
  }  
  echo "<td><font face=Verdana color=black size=2>" . $row['id'] . "</font></td>";
  echo "<td><font face=Verdana color=black size=2>" . $row['NIM'] . "<br>";
  $l = mysqli_query($con, "select Nama from mahasiswa where NIM = '". $row['NIM'] ."'"); 
  while($rl = mysqli_fetch_array($l)){  
    echo $rl[0];    
  } 
  echo "</font></td>";
  echo "<td><font face=Verdana color=black size=2>" . $row['Pembimbing'] . "<br>";
  $l = mysqli_query($con, "select Nama from dosen where NIDN = '". $row['Pembimbing'] ."'"); 
  while($rl = mysqli_fetch_array($l)){  
    echo $rl[0];    
  } 
  echo "</font></td>";
  echo "<td><font face=Verdana color=black size=2>" . $row['Penguji1'] . "<br>";
  $l = mysqli_query($con, "select Nama from dosen where NIDN = '". $row['Penguji1'] ."'"); 
  while($rl = mysqli_fetch_array($l)){  
    echo $rl[0];    
  } 
  echo "</font></td>";
  echo "<td><font face=Verdana color=black size=2>" . $row['Penguji2'] . "<br>";
  $l = mysqli_query($con, "select Nama from dosen where NIDN = '". $row['Penguji2'] ."'"); 
  while($rl = mysqli_fetch_array($l)){  
    echo $rl[0];    
  } 
  echo "</font></td>";
  echo "<td><font face=Verdana color=black size=2>" . $row['Tanggal_Daftar'] . "</font></td>";
  echo "<td><font face=Verdana color=black size=2>" . $row['Tanggal_Sidang'] . "</font></td>";
  echo "<td><font face=Verdana color=black size=2>" . $row['Ruang_Sidang'] . "</font></td>";
  echo "<td><font face=Verdana color=black size=2>" . $row['Nilai_Pembimbing'] . "</font></td>";
  echo "<td><font face=Verdana color=black size=2>" . $row['Nilai_Penguji1'] . "</font></td>";
  echo "<td><font face=Verdana color=black size=2>" . $row['Nilai_Penguji2'] . "</font></td>";
  echo "<td><font face=Verdana color=black size=2>" . $row['Nilai_Akhir'] . "</font></td>";
  echo "<td><font face=Verdana color=black size=2>" . $row['Keterangan'] . "</font></td>";
  echo "<td class='align-middle'><a class=linklist href=viewskripsi.php?id=".$row['id']."><button type='button' class='btn btn-warning' data-toggle='tooltip' data-placement='top' title='Lihat data'><font face=Verdana size=1><i class='fa fa-eye'></i></font></button></a>";
  echo "<a class=linklist href=editskripsi.php?id=".$row['id']."><button type='button' class='btn btn-primary' data-toggle='tooltip' data-placement='top' title='Edit data'><font face=Verdana size=1><i class='fa fa-edit'></i></font></button></a>";
  echo "<a class=linklist href=deleteskripsi.php?id=".$row['id']." onclick=\"return confirm('Are you sure you want to delete this data?')\"><button type='button' class='btn btn-danger' data-toggle='tooltip' data-placement='top' title='Hapus data'><font face=Verdana size=1><i class='fa fa-trash'></i></font></button></a></td>";
  echo "</tr>";
  }
echo "</table><br><br>";
echo "</div>";
} else {
	echo "<font size=2 face=Verdana color=#FF0000>Data skripsi not found - try again!</font><br><br>";
}
}
if((!isset($_POST["cari"])) or ($_POST["cari"] == "")){
// Langkah 1: Tentukan batas,cek halaman & posisi data
$batas   = 100;
if(isset($_GET["halaman"])){ $halaman = $_GET['halaman']; }
if(empty($halaman)){
	$posisi  = 0;
	$halaman = 1;
}
else{
	$posisi = ($halaman-1) * $batas;
}
$result = mysqli_query($con, "SELECT * FROM skripsi LIMIT $posisi,$batas");
echo "<div class='table-responsive'> "; 
echo "<table class='custom-table'>";  
$firstColumn = 1;
$warna = 0;
while($row = mysqli_fetch_array($result))
  {
  if ($firstColumn == 1) {
echo "<tr bgcolor=337ab7>
<th><font color=white size=2>id</font></th>
<th><font color=white size=2>NIM</font></th>
<th><font color=white size=2>Pembimbing</font></th>
<th><font color=white size=2>Penguji1</font></th>
<th><font color=white size=2>Penguji2</font></th>
<th><font color=white size=2>Tanggal Daftar</font></th>
<th><font color=white size=2>Tanggal Sidang</font></th>
<th><font color=white size=2>Ruang Sidang</font></th>
<th><font color=white size=2>Nilai Pembimbing</font></th>
<th><font color=white size=2>Nilai Penguji1</font></th>
<th><font color=white size=2>Nilai Penguji2</font></th>
<th><font color=white size=2>Nilai Akhir</font></th>
<th><font color=white size=2>Keterangan</font></th>
<th class='align-middle'><font color=white size=2>Aksi</font></th>
</tr>";
$firstColumn = 0;
  }
  if ($warna == 0){
  	echo "<tr bgcolor=FFFFFF onMouseOver=\"this.bgColor='#D3DCE3';\" onMouseOut=\"this.bgColor='FFFFFF';\">";
	$warna = 1;
  }else{
  	echo "<tr bgcolor=FFFFFF onMouseOver=\"this.bgColor='#D3DCE3';\" onMouseOut=\"this.bgColor='FFFFFF';\">";
	$warna = 0;
  }
  echo "<td><font face=Verdana color=black size=2>" . $row['id'] . "</font></td>";
  echo "<td><font face=Verdana color=black size=2>" . $row['NIM'] . "<br>";
  $l = mysqli_query($con, "select Nama from mahasiswa where NIM = '". $row['NIM'] ."'"); 
  while($rl = mysqli_fetch_array($l)){  
    echo $rl[0];    
  } 
  echo "</font></td>";
  echo "<td><font face=Verdana color=black size=2>" . $row['Pembimbing'] . "<br>";
  $l = mysqli_query($con, "select Nama from dosen where NIDN = '". $row['Pembimbing'] ."'"); 
  while($rl = mysqli_fetch_array($l)){  
    echo $rl[0];    
  } 
  echo "</font></td>";
  echo "<td><font face=Verdana color=black size=2>" . $row['Penguji1'] . "<br>";
  $l = mysqli_query($con, "select Nama from dosen where NIDN = '". $row['Penguji1'] ."'"); 
  while($rl = mysqli_fetch_array($l)){  
    echo $rl[0];    
  } 
  echo "</font></td>";
  echo "<td><font face=Verdana color=black size=2>" . $row['Penguji2'] . "<br>";
  $l = mysqli_query($con, "select Nama from dosen where NIDN = '". $row['Penguji2'] ."'"); 
  while($rl = mysqli_fetch_array($l)){  
    echo $rl[0];    
  } 
  echo "</font></td>";
  echo "<td><font face=Verdana color=black size=2>" . $row['Tanggal_Daftar'] . "</font></td>";
  echo "<td><font face=Verdana color=black size=2>" . $row['Tanggal_Sidang'] . "</font></td>";
  echo "<td><font face=Verdana color=black size=2>" . $row['Ruang_Sidang'] . "</font></td>";
  echo "<td><font face=Verdana color=black size=2>" . $row['Nilai_Pembimbing'] . "</font></td>";
  echo "<td><font face=Verdana color=black size=2>" . $row['Nilai_Penguji1'] . "</font></td>";
  echo "<td><font face=Verdana color=black size=2>" . $row['Nilai_Penguji2'] . "</font></td>";
  echo "<td><font face=Verdana color=black size=2>" . $row['Nilai_Akhir'] . "</font></td>";
  echo "<td><font face=Verdana color=black size=2>" . $row['Keterangan'] . "</font></td>";
  echo "<td class='align-middle'><a class=linklist href=viewskripsi.php?id=".$row['id']."><button type='button' class='btn btn-warning' data-toggle='tooltip' data-placement='top' title='Lihat data'><font face=Verdana size=1><i class='fa fa-eye'></i></font></button></a>";
  echo "<a class=linklist href=editskripsi.php?id=".$row['id']."><button type='button' class='btn btn-primary' data-toggle='tooltip' data-placement='top' title='Edit data'><font face=Verdana size=1><i class='fa fa-edit'></i></font></button></a>";
  echo "<a class=linklist href=deleteskripsi.php?id=".$row['id']." onclick=\"return confirm('Are you sure you want to delete this data?')\"><button type='button' class='btn btn-danger' data-toggle='tooltip' data-placement='top' title='Hapus data'><font face=Verdana size=1><i class='fa fa-trash'></i></font></button></a></td>";
  echo "</tr>";
  echo "</tr>";
  }
echo "</table><br>";
echo "</div>";
//Langkah 3: Hitung total data dan halaman
$tampil2 = mysqli_query($con, "SELECT * FROM skripsi");
$jmldata = mysqli_num_rows($tampil2);
$jmlhal  = ceil($jmldata/$batas);
echo "<div class='text-center'>";
echo "<ul class='pagination'>";
// Link ke halaman sebelumnya (previous)
if($halaman > 1){
	$prev=$halaman-1;
	echo "<li><a href='$_SERVER[PHP_SELF]?halaman=$prev'>&laquo; Prev</a></li>";
}
else{
	echo "<li class='disabled'><span>&laquo; Prev</span></li>";
}
// Tampilkan link halaman 1,2,3 ...
for($i=1;$i<=$jmlhal;$i++)
if ($i != $halaman){
	echo "<li><a href='$_SERVER[PHP_SELF]?halaman=$i'>$i</a></li>";
}
else{
	echo "<li class='active'><span>$i</span></li>";
}
// Link kehalaman berikutnya (Next)
if($halaman < $jmlhal){
	$next=$halaman+1;
	echo "<li><a href='$_SERVER[PHP_SELF]?halaman=$next'>Next &raquo;</a></li>";
}
else{
	echo "<li class='disabled'><span>Next &raquo;</span></li>";
}
echo "</ul>";
echo "</div>";

echo "<div class='text-center'>";
echo "<p>Total <b>$jmldata</b> data</p>";
mysqli_close($con);
echo "</div>";

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
