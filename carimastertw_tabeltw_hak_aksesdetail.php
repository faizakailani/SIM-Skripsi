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
echo "<td>";
$cari = mysqli_real_escape_string($con, $_POST["cari"]);
$select = mysqli_real_escape_string($con, $_POST["select"]);
$tabel = mysqli_real_escape_string($con, $_POST["tabel"]);
// Langkah 1: Tentukan batas,cek halaman & posisi data
$batas   = 5;
if(isset($_GET["halaman"])){ $halaman = $_GET['halaman'];}
if(empty($halaman)){
	$posisi  = 0;
	$halaman = 1;
}
else{
	$posisi = ($halaman-1) * $batas;
}
$result = mysqli_query($con, "SELECT * FROM tw_hak_akses where ". $_POST["select"] ." like '%". $cari ."%' and tabel='$tabel' LIMIT $posisi,$batas");
echo "<font face=Verdana color=black size=1>tw_hak_akses</font>";
echo "<div class='table-responsive'> "; 
echo "<table class='table table-striped'>"; 
$firstColumn = 1;
$warna = 0;
while($row = mysqli_fetch_array($result))
  {
  if ($firstColumn == 1) {
echo "<tr bgcolor=D3DCE3>
<th></th>
<th></th>
<th></th>
<th>id</th>
<th>tabel</th>
<th>user</th>
<th>listData</th>
<th>viewData</th>
<th>insertData</th>
<th>editData</th>
<th>deleteData</th>
<th>detailData</th>
</tr>";
$firstColumn = 0;
  }
  if ($warna == 0){
  	echo "<tr bgcolor=E5E5E5 onMouseOver=this.className='highlight' onMouseOut=this.className='normal'>";
	$warna = 1;
  }else{
  	echo "<tr bgcolor=D5D5D5 onMouseOver=this.className='highlight' onMouseOut=this.className='normal'>";
	$warna = 0;
  }
  echo "<td><a class=linklist href=viewmastertw_tabeltw_hak_aksesdetail.php?id=$cari&tabel=".$row['tabel']."><button type='button' class='btn btn-warning'><font face=Verdana size=1><i class='fa fa-check'></i></font></button></a></td>";
  echo "<td><a class=linklist href=editmastertw_tabeltw_hak_aksesdetail.php?id=$cari&tabel=".$row['tabel']."><button type='button' class='btn btn-primary'><font face=Verdana size=1><i class='fa fa-edit'></i></font></button></a></td>";
  echo "<td><a class=linklist href=deletemastertw_tabeltw_hak_aksesdetail.php?id=$cari&tabel=".$row['tabel']." onclick=\"return confirm('Are you sure you want to delete this data?')\"><button type='button' class='btn btn-danger'><font face=Verdana size=1><i class='fa fa-trash'></i></font></button></a></td>";
  echo "<td>" . $row['id'] . "</td>";
  echo "<td>" . $row['tabel'] . "</td>";
  echo "<td>" . $row['user'] . "</td>";
if ($row['listData'] == '1') {
  echo "<td align=center>&nbsp;<img src=lihat.png>&nbsp;</td>";
} else {
  echo "<td align=center>&nbsp;<img src=hapus.png>&nbsp;</td>";
}
if ($row['viewData'] == '1') {
  echo "<td align=center>&nbsp;<img src=lihat.png>&nbsp;</td>";
} else {
  echo "<td align=center>&nbsp;<img src=hapus.png>&nbsp;</td>";
}
if ($row['insertData'] == '1') {
  echo "<td align=center>&nbsp;<img src=lihat.png>&nbsp;</td>";
} else {
  echo "<td align=center>&nbsp;<img src=hapus.png>&nbsp;</td>";
}
if ($row['editData'] == '1') {
  echo "<td align=center>&nbsp;<img src=lihat.png>&nbsp;</td>";
} else {
  echo "<td align=center>&nbsp;<img src=hapus.png>&nbsp;</td>";
}
if ($row['deleteData'] == '1') {
  echo "<td align=center>&nbsp;<img src=lihat.png>&nbsp;</td>";
} else {
  echo "<td align=center>&nbsp;<img src=hapus.png>&nbsp;</td>";
}
if ($row['detailData'] == '1') {
  echo "<td align=center>&nbsp;<img src=lihat.png>&nbsp;</td>";
} else {
  echo "<td align=center>&nbsp;<img src=hapus.png>&nbsp;</td>";
}
  echo "</tr>";
  }
echo "</table><br>";
echo "</div>";
//Langkah 3: Hitung total data dan halaman
$tampil2 = mysqli_query($con, "SELECT * FROM tw_hak_akses where ". $_POST["select"] ." like '%". $cari ."%' and tabel='$tabel' LIMIT $posisi,$batas");
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
echo "<a href=listmastertw_tabeltw_hak_aksesdetail.php?tabel=$tabel><button type='button' class='btn btn-warning'><font face=Verdana size=1><i class='fa fa-check'></i>&nbsp;Back</font></button></a>";
echo "</td></tr>";
?>
</div> 
<?php 
include("footer.php");
?>
