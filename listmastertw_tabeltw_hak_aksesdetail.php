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
$q = "SELECT * FROM tw_hak_akses where tabel='Manage_User_Access' and user = '". $_SESSION['Email'] ."' and detailData='1'";
$r = mysqli_query($con, $q);
if ( $obj = @mysqli_fetch_object($r) )
 {
?>
<?php
echo "<td bgcolor=F5F5F5>";
echo "<table class='table table-striped'>";
echo "<tr><td><font face=Verdana color=black size=1>tw_tabel</font></td></tr>";
$result = mysqli_query($con, "SELECT * FROM tw_tabel where tabel = '". $_GET['tabel'] . "'");
while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td bgcolor=CCCCCC><font face=Verdana color=black size=1>tabel</font></td>";
echo "</tr>";
echo "<tr>";
echo "<td bgcolor=CCEEEE><font face=Verdana color=black size=1>" . $row['tabel'] . "</font></td>";
echo "</tr>";
echo "<tr><td align=center><a href=listmastertw_tabeltw_hak_akses.php><button type='button' class='btn btn-warning'><font face=Verdana size=1><i class='fa fa-check'></i>&nbsp;Back</font></button></a></td></tr>";
echo "</table>";
}
echo "<br><br>";
echo "<font face=Verdana color=black size=1>tw_hak_akses</font><br>";
echo "<a href=insertmastertw_tabeltw_hak_aksesdetail.php?tabel=". $_GET['tabel'] ."><button type='button' class='btn btn-light'><font face=Verdana color=black size=1><i class='fa fa-plus'></i>&nbsp;Insert</font></button></a><br>";
//cari tabel
echo "<br><br><form action=carimastertw_tabeltw_hak_aksesdetail.php method=post>
 <select class='form-control' name=select>";
$menu=mysqli_query($con, "show columns from tw_hak_akses");
while($rowmenu = mysqli_fetch_array($menu))
{
    echo "<option value=". $rowmenu['Field'] .">". $rowmenu['Field']."</option>";
}
echo "    </select>
<input type=text  class='form-control' name=cari>
<input type=hidden name=tabel value=". $_GET['tabel'] ."><button type='submit' class='btn btn-success'><font face=Verdana size=1><i class='fa fa-search-plus'></i>Search</font></button></form><br><br>";
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
$result = mysqli_query($con, "SELECT * FROM tw_hak_akses where tw_hak_akses.tabel= '".$_GET['tabel']."' LIMIT $posisi,$batas");
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
$firstColumn = 0;
  }
  if ($warna == 0){
  	echo "<tr bgcolor=E5E5E5 onMouseOver=\"this.bgColor='#8888FF';\" onMouseOut=\"this.bgColor='E5E5E5';\">";
	$warna = 1;
  }else{
  	echo "<tr bgcolor=D5D5D5 onMouseOver=\"this.bgColor='#8888FF';\" onMouseOut=\"this.bgColor='D5D5D5';\">";
	$warna = 0;
  }
  echo "<td><a class=linklist href=viewmastertw_tabeltw_hak_aksesdetail.php?id=".$row['id']."&tabel=". $_GET['tabel'] ."><button type='button' class='btn btn-warning'><font face=Verdana size=1><i class='fa fa-check'></i></font></button></a></td>";
  echo "<td><a class=linklist href=editmastertw_tabeltw_hak_aksesdetail.php?id=".$row['id']."&tabel=". $_GET['tabel'] ."><button type='button' class='btn btn-primary'><font face=Verdana size=1><i class='fa fa-edit'></i></font></button></a></td>";
  echo "<td><a class=linklist href=deletemastertw_tabeltw_hak_aksesdetail.php?id=".$row['id']."&tabel=". $_GET['tabel'] ." onclick=\"return confirm('Are you sure you want to delete this data?')\"><button type='button' class='btn btn-danger'><font face=Verdana size=1><i class='fa fa-trash'></i></font></button></a></td>";
  echo "<td><font face=Verdana color=black size=1>" . $row['id'] . "</font></td>";
  echo "<td><font face=Verdana color=black size=1>" . $row['tabel'] . "</font></td>";
  echo "<td><font face=Verdana color=black size=1>" . $row['user'] . "</font></td>";
if ($row['listData'] == '1') {
  echo "<td align=center><font face=Verdana size=1>&nbsp;<img src=lihat.png>&nbsp;</font></td>";
} else {
  echo "<td align=center><font face=Verdana size=1>&nbsp;<img src=hapus.png>&nbsp;</font></td>";
}
if ($row['viewData'] == '1') {
  echo "<td align=center><font face=Verdana size=1>&nbsp;<img src=lihat.png>&nbsp;</font></td>";
} else {
  echo "<td align=center><font face=Verdana size=1>&nbsp;<img src=hapus.png>&nbsp;</font></td>";
}
if ($row['insertData'] == '1') {
  echo "<td align=center><font face=Verdana size=1>&nbsp;<img src=lihat.png>&nbsp;</font></td>";
} else {
  echo "<td align=center><font face=Verdana size=1>&nbsp;<img src=hapus.png>&nbsp;</font></td>";
}
if ($row['editData'] == '1') {
  echo "<td align=center><font face=Verdana size=1>&nbsp;<img src=lihat.png>&nbsp;</font></td>";
} else {
  echo "<td align=center><font face=Verdana size=1>&nbsp;<img src=hapus.png>&nbsp;</font></td>";
}
if ($row['deleteData'] == '1') {
  echo "<td align=center><font face=Verdana size=1>&nbsp;<img src=lihat.png>&nbsp;</font></td>";
} else {
  echo "<td align=center><font face=Verdana size=1>&nbsp;<img src=hapus.png>&nbsp;</font></td>";
}
if ($row['detailData'] == '1') {
  echo "<td align=center><font face=Verdana size=1>&nbsp;<img src=lihat.png>&nbsp;</font></td>";
} else {
  echo "<td align=center><font face=Verdana size=1>&nbsp;<img src=hapus.png>&nbsp;</font></td>";
}
  echo "</tr>";
  }
echo "</table><br>";
echo "</div>";
//Langkah 3: Hitung total data dan halaman
$tampil2 = mysqli_query($con, "SELECT * FROM tw_hak_akses where tw_hak_akses.tabel='".$_GET['tabel']."'");
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
