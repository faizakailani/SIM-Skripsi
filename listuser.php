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
$q = "SELECT * FROM tw_hak_akses where tabel='user' and user = '". $_SESSION['Email'] ."' and listData='1'";
$r = mysqli_query($con, $q);
if ( $obj = @mysqli_fetch_object($r) )
 {
?>
<?php
echo "<td bgcolor=F5F5F5 align=left valign=top>";
?>
<?php
echo "<br><h4>Setting User</h4><br>";

echo "<div class='row'>";
echo "<div class='col-md-6 mb-20'>";
echo "<a href=insertuser.php><button type='button' class='btn btn-light'><font face=Verdana color=black size=1><i class='fa fa-plus'></i>&nbsp;Insert</font></button></a><br>";
echo "</div>";
//cari tabel
echo "<div class='col-md-6 mb-20 text-right'>";
echo "<form action=listuser.php method=post class='form-inline'>";
echo "<div class='form-group'>";
echo "<select class='form-control' name=select>";
$menu=mysqli_query($con, "show columns from user");
while($rowmenu = mysqli_fetch_array($menu))
{
   if ($rowmenu['Field'] == 'Password') {
   } else {
    echo "<option value=". $rowmenu['Field'] .">". $rowmenu['Field']."</option>";
   }
}
echo "</select>";
echo "</div>";
echo "<div class='form-group'>";
echo "<input type=text  class='form-control' name=cari>";
echo "</div>";
echo "<button type='submit' class='btn btn-success'><i class='fa fa-search-plus'></i>Search</font></button></form>";

echo "</div>";
echo "</div>";

if (isset($_POST["cari"]) && ($_POST["cari"] != "")){
//hasil pencarian tabel
$dd = "SELECT * FROM user where ". $_POST["select"]." like '%" . $_POST["cari"] . "%'";
$resultcari = mysqli_query($con, $dd);
if ( $obj = mysqli_fetch_object($resultcari) )
{
$result = mysqli_query($con, $dd);
echo "<font face=Verdana color=black size=1>user </font>";
echo "<div class='table-responsive'> "; 
echo "<table class='custom-table mt-10'>"; 
echo "<tr bgcolor=4ba6ef>
<th><font color=black size=2>Email</font></th>
<th><font color=black size=2>Password</font></th>
<th><font color=black size=2>Active</font></th>
<th class='align-middle'><font color=black size=2>Aksi</font></th>
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
  
  echo "<td><font face=Verdana color=black size=1>". $row['Email'] ."</font></td>";
  echo "<td><font face=Verdana color=black size=1>**********</font></td>";
  echo "<td><font face=Verdana color=black size=1>". $row['Active'] ."</font></td>";
  echo "<td class='align-middle'><a class=linklist href=viewuser.php?Email=".$row['Email']."><button type='button' class='btn btn-warning'><font face=Verdana size=1><i class='fa fa-eye'></i></font></button></a>";
  echo "<a class=linklist href=edituser.php?Email=".$row['Email']."><button type='button' class='btn btn-primary'><font face=Verdana size=1><i class='fa fa-edit'></i></font></button></a>";
  echo "<a class=linklist href=deleteuser.php?Email=".$row['Email']." onclick=\"return confirm('Are you sure you want to delete this data?')\"><button type='button' class='btn btn-danger'><font face=Verdana size=1><i class='fa fa-trash'></i></font></button></a></td>";
  echo "</tr>";
  }
echo "</table><br><br>";
echo "</div>";
} else {
	echo "<font size=2 face=Verdana color=#FF0000>Data user not find - please try again!</font><br><br>";
}
}
if((!isset($_POST["cari"])) or ($_POST["cari"] == "")){
// Langkah 1: Tentukan batas,cek halaman & posisi data
$batas   = 10;
if(isset($_GET["halaman"])){ $halaman = $_GET['halaman']; }
if(empty($halaman)){
	$posisi  = 0;
	$halaman = 1;
}
else{
	$posisi = ($halaman-1) * $batas;
}
$result = mysqli_query($con, "SELECT * FROM user LIMIT $posisi,$batas");
echo "<font face=Verdana color=black size=1>user</font>";
echo "<div class='table-responsive'> "; 
echo "<table class='custom-table'>";
$firstColumn = 1;
$warna = 0;
while($row = mysqli_fetch_array($result))
  {
  if ($firstColumn == 1) {
echo "<tr bgcolor=4ba6ef>
<th><font color=black size=2>Email</font></th>
<th><font color=black size=2>Password</font></th>
<th><font color=black size=2>Active</font></th>
<th class='align-middle'><font color=black size=2>Aksi</font></th>
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
  
  echo "<td><font face=Verdana color=black size=1>" . $row['Email'] . "</font></td>";
  echo "<td><font face=Verdana color=black size=1>**********</font></td>";
  echo "<td><font face=Verdana color=black size=1>" . $row['Active'] . "</font></td>";
  echo "<td class='align-middle'><a class=linklist href=viewuser.php?Email=".$row['Email']."><button type='button' class='btn btn-warning'><font face=Verdana size=1><i class='fa fa-eye'></i></font></button></a>";
  echo "<a class=linklist href=edituser.php?Email=".$row['Email']."><button type='button' class='btn btn-primary'><font face=Verdana size=1><i class='fa fa-edit'></i></font></button></a>";
  echo "<a class=linklist href=deleteuser.php?Email=".$row['Email']." onclick=\"return confirm('Are you sure you want to delete this data?')\"><button type='button' class='btn btn-danger'><font face=Verdana size=1><i class='fa fa-trash'></i></font></button></a></td>";
  echo "</tr>";
  }
echo "</table><br>";
echo "</div>";
//Langkah 3: Hitung total data dan halaman
$tampil2 = mysqli_query($con, "SELECT * FROM user");
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
