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
$q = "SELECT * FROM tw_hak_akses where tabel='Manage_User_Access' and user = '". $_SESSION['Email'] ."' and listData='1'";
$r = mysqli_query($con, $q);
if ( $obj = @mysqli_fetch_object($r) )
 {
?>
<?php
echo "<br><h4>Setting Akses User</h4><br>";

echo "<div class='row'>";
echo "<div class='col-md-6 mb-20'>";
echo "<a href='insertmastertw_tabeltw_hak_akses.php'><button type='button' class='btn btn-light'><font face=Verdana color=black size=2><i class='fa fa-plus'></i>&nbsp;Tambah</font></button></a><br>";
echo "</div>";

//cari tabel
echo "<div class='col-md-6 mb-20 text-right' >";
echo "<form action='listmastertw_tabeltw_hak_akses.php' method='post' class='form-inline'>";
echo "<div class='form-group'>";
echo "<select class='form-control' name=select>";
$menu=mysqli_query($con, "show columns from tw_tabel");
while($rowmenu = mysqli_fetch_array($menu))
{
    echo "<option value=". $rowmenu['Field'] .">". $rowmenu['Field']."</option>";
}
echo "</select>";
echo "</div>";
echo "<div class='form-group'>";
echo "<input type=text  class='form-control' name=cari>";
echo "</div>";
echo "<button type='submit' class='btn btn-success'><i class='fa fa-search-plus'></i>Search</button>";
echo "</form>";
echo "</div>";
echo "</div>";

if (isset($_POST["cari"]) && ($_POST["cari"] != "")){
//hasil pencarian tabel
$dd = "SELECT * FROM tw_tabel where ". $_POST["select"]." like '%" . $_POST["cari"] . "%'";
$resultcari = mysqli_query($con, $dd);
if ( $obj = mysqli_fetch_object($resultcari) )
{
$result = mysqli_query($con, $dd);
echo "<font color=black size=2>Hasil Pencarian</font>";
echo "<div class='table-responsive'> "; 
echo "<table class='custom-table mt-10'>"; 
echo "<tr bgcolor=337ab7>
<th><font color=white size=2>Menu</font></th>
<th class='align-middle'><font color=white size=2>Aksi</font></th>
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
  echo "<td><font face=Verdana color=black size=2>" . $row['tabel'] . "</font></td>";
  echo "<td class='align-middle'><a class=linklist href=viewmastertw_tabeltw_hak_akses.php?tabel=".$row['tabel']."><button type='button' class='btn btn-warning' data-toggle='tooltip' data-placement='top' title='Lihat data'><font face=Verdana size=1><i class='fa fa-eye'></i></font></button></a>";
  echo "<a class=linklist href=editmastertw_tabeltw_hak_akses.php?tabel=".$row['tabel']."><button type='button' class='btn btn-primary' data-toggle='tooltip' data-placement='top' title='Edit data'><font face=Verdana size=1><i class='fa fa-edit'></i></font></button></a>";
  echo "<a class=linklist href=deletemastertw_tabeltw_hak_akses.php?tabel=".$row['tabel']." onclick=\"return confirm('Are you sure you want to delete this data?')\"><button type='button' class='btn btn-danger' data-toggle='tooltip' data-placement='top' title='Hapus data'><font face=Verdana size=1><i class='fa fa-trash'></i></font></button></a>";
  echo "<a class=linklist href=listmastertw_tabeltw_hak_aksesdetail.php?tabel=".$row['tabel']."><button type='button' class='btn btn-success'><font face=Verdana color=white size=1>Kelola Akses</font></button></a></td>";
  echo "</tr>";
  }
echo "</table><br><br>";
echo "</div>";
} else {
	echo "<font size=2 face=Verdana color=#FF0000>Data tw_tabel not found - try again!</font><br><br>";
}
}
if((!isset($_POST["cari"])) or ($_POST["cari"] == "")){
// Langkah 1: Tentukan batas,cek halaman & posisi data
$batas   = 10;
if(isset($_GET["halaman"])){ $halaman = $_GET['halaman'];}
if(empty($halaman)){
	$posisi  = 0;
	$halaman = 1;
}
else{
	$posisi = ($halaman-1) * $batas;
}
$result = mysqli_query($con, "SELECT * FROM tw_tabel LIMIT $posisi,$batas");
echo "<font face=Verdana color=black size=1></font>";
echo "<div class='table-responsive'> "; 
echo "<table class='custom-table'>"; 
$firstColumn = 1;
$warna = 0;
while($row = mysqli_fetch_array($result))
  {
  if ($firstColumn == 1) {
  echo "<tr bgcolor=337ab7>
  <th><font color=white size=2>Menu</font></th>
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
  echo "<td><font face=Verdana color=black size=2>" . $row['tabel'] . "</font></td>";
  echo "<td class='align-middle'><a class=linklist href=listmastertw_tabeltw_hak_aksesdetail.php?tabel=".$row['tabel']."><button type='button' class='btn btn-success'><font face=Verdana color=white size=1>Kelola Akses</font></button></a>";
  echo "<a class=linklist href=viewmastertw_tabeltw_hak_akses.php?tabel=".$row['tabel']."><button type='button' class='btn btn-warning' data-toggle='tooltip' data-placement='top' title='Lihat data'><font face=Verdana size=1><i class='fa fa-eye'></i></font></button></a>";
  echo "<a class=linklist href=editmastertw_tabeltw_hak_akses.php?tabel=".$row['tabel']."><button type='button' class='btn btn-primary' data-toggle='tooltip' data-placement='top' title='Edit data'><font face=Verdana size=1><i class='fa fa-edit'></i></font></button></a>";
  echo "<a class=linklist href=deletemastertw_tabeltw_hak_akses.php?tabel=".$row['tabel']." onclick=\"return confirm('Are you sure you want to delete this data?')\"><button type='button' class='btn btn-danger' data-toggle='tooltip' data-placement='top' title='Hapus data'><font face=Verdana size=1><i class='fa fa-trash'></i></font></button></a></td>";
  
  echo "</tr>";
  }
echo "</table><br>";
echo "</div>";
//Langkah 3: Hitung total data dan halaman
$tampil2 = mysqli_query($con, "SELECT * FROM tw_tabel");
$jmldata = mysqli_num_rows($tampil2);
$jmlhal  = ceil($jmldata/$batas);
echo "<div class='text-center'>";
echo "<ul class='pagination'>";
// Link to the previous page
if($halaman > 1){
  $prev = $halaman - 1;
  echo "<li><a href='$_SERVER[PHP_SELF]?halaman=$prev'>&laquo; Prev</a></li>";
} else {
  echo "<li class='disabled'><span>&laquo; Prev</span></li>";
}

// Display page links
for($i = 1; $i <= $jmlhal; $i++) {
  if ($i != $halaman){
      echo "<li><a href='$_SERVER[PHP_SELF]?halaman=$i'>$i</a></li>";
  } else {
      echo "<li class='active'><span>$i</span></li>";
  }
}

// Link to the next page
if($halaman < $jmlhal){
  $next = $halaman + 1;
  echo "<li><a href='$_SERVER[PHP_SELF]?halaman=$next'>Next &raquo;</a></li>";
} else {
  echo "<li class='disabled'><span>Next &raquo;</span></li>";
}
echo "</ul>";
echo "</div>";

echo "<div class='text-center'>";
echo "<p>Total <b>$jmldata</b> data</p>";
echo "</div>";
}
?>
</div> 
<div class="pagefooter">
 <?php 
 include("footer.php"); 
 mysqli_close($con);
 ?>
 </div>
<?php
} else {
 //header("Location:content.php");
}
?>
