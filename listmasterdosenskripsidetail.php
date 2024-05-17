<?php
session_start();
if (!isset($_SESSION["Email"])) {
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
  $q = "SELECT * FROM tw_hak_akses where tabel='dosen/skripsi' and user = '" . $_SESSION['Email'] . "' and detailData='1'";
  $r = mysqli_query($con, $q);
  if ($obj = @mysqli_fetch_object($r)) {
  ?>
    <?php
    echo "<td bgcolor=F5F5F5 valign=top>";

    echo "<br><h4>Kelola Program Studi</h4>";

    echo "<div class='table-responsive' style='max-width: 600px;'> ";
    echo "<table class='custom-table'>";
    if (isset($_GET['NIDN'])) {
      $result = mysqli_query($con, "SELECT * FROM dosen where NIDN = '" . mysqli_real_escape_string($con, $_GET['NIDN']) . "'");
    }
    while ($row = mysqli_fetch_array($result)) {
      echo "<tr>";
      echo "<td bgcolor=FFFFFF><font color=black size=2><b>NIDN</b></font></td>";
      echo "<td bgcolor=FFFFFF><font color=black size=2>" . $row['NIDN'] . "</font></td>";
      echo "</tr>";
      echo "<tr>";
      echo "<td bgcolor=FFFFFF><font color=black size=2><b>Nama</b></font></td>";
      echo "<td bgcolor=FFFFFF><font color=black size=2>" . $row['Nama'] . "</font></td>";
      echo "</tr>";
      echo "<tr>";
      echo "<td bgcolor=FFFFFF><font color=black size=2><b>Foto</b></font></td>";
      echo "<td bgcolor=FFFFFF><font color=black size=2><a href='images/" . $row['Foto'] . "' target=_blank><img src='images/" . $row['Foto'] . "' width=50 height=50></a></font></td>";
      echo "</tr>";
    }
    echo "</table>";
    echo "</div>";
    echo "<br><a href=listmasterdosenskripsi.php><button type='button' class='btn btn-warning'><font face=Verdana size=2>&nbsp;Back</font></button></a></br>";
    echo "<br><h5>Daftar Skripsi</h5>";
    if (isset($_GET['NIDN'])) {
      echo "<a href=insertmasterdosenskripsidetail.php?NIDN=" . mysqli_real_escape_string($con, $_GET['NIDN']) . "><button type='button' class='btn btn-light'><font face=Verdana color='black' size=2><i class='fa fa-plus'></i>&nbsp;Tambah</font></button></a><br><br>";
    }
    if ((!isset($_POST["cari"])) or ($_POST["cari"] == "")) {
      // Langkah 1: Tentukan batas,cek halaman & posisi data
      $batas   = 10;
      if (isset($_GET["halaman"])) {
        $halaman = $_GET['halaman'];
      }
      if (empty($halaman)) {
        $posisi  = 0;
        $halaman = 1;
      } else {
        $posisi = ($halaman - 1) * $batas;
      }
      if (isset($_GET['NIDN'])) {
        $result = mysqli_query($con, "SELECT * FROM skripsi where skripsi.Pembimbing= '" . mysqli_real_escape_string($con, $_GET['NIDN']) . "' LIMIT $posisi,$batas");
      }
      echo "<div class='table-responsive'> ";
      echo "<table class='custom-table'>";
      $firstColumn = 1;
      $warna = 0;
      while ($row = mysqli_fetch_array($result)) {
        if ($firstColumn == 1) {
          echo "<tr bgcolor=337ab7>
<th><font color=white size=2><b>id</b></font></th>
<th><font color=white size=2><b>NIM</b></font></th>
<th><font color=white size=2><b>Pembimbing</b></font></th>
<th><font color=white size=2><b>Penguji 1</b></font></th>
<th><font color=white size=2><b>Penguji 2</b></font></th>
<th><font color=white size=2><b>Tanggal Daftar</b></font></th>
<th><font color=white size=2><b>Tanggal Sidang</b></font></th>
<th><font color=white size=2><b>Ruang Sidang</b></font></th>
<th><font color=white size=2><b>Nilai Pembimbing</b></font></th>
<th><font color=white size=2><b>Nilai Penguji1</b></font></th>
<th><font color=white size=2><b>Nilai Penguji2</b></font></th>
<th><font color=white size=2><b>Nilai Akhir</b></font></th>
<th><font color=white size=2><b>Keterangan</b></font></th>
<th class='align-middle'><font color=white size=2>Aksi</font></th>
</tr>";
          $firstColumn = 0;
        }
        if ($warna == 0) {
          echo "<tr bgcolor=FFFFFF onMouseOver=\"this.bgColor='#D3DCE3';\" onMouseOut=\"this.bgColor='FFFFFF';\">";
          $warna = 1;
        } else {
          echo "<tr bgcolor=FFFFFF onMouseOver=\"this.bgColor='#D3DCE3';\" onMouseOut=\"this.bgColor='FFFFFF';\">";
          $warna = 0;
        }
        echo "<td><font face=Verdana color=black size=2>" . $row['id'] . "</font></td>";
        echo "<td><font face=Verdana color=black size=2>" . $row['NIM'] . "<br>";
        $l = mysqli_query($con, "select Nama from mahasiswa where NIM = '" . $row['NIM'] . "'");
        while ($rl = mysqli_fetch_array($l)) {
          echo $rl[0];
        }
        echo "</font></td>";
        echo "<td><font face=Verdana color=black size=2>" . $row['Pembimbing'] . "<br>";
        $l = mysqli_query($con, "select Nama from dosen where NIDN = '" . $row['Pembimbing'] . "'");
        while ($rl = mysqli_fetch_array($l)) {
          echo $rl[0];
        }
        echo "</font></td>";
        echo "<td><font face=Verdana color=black size=2>" . $row['Penguji1'] . "<br>";
        $l = mysqli_query($con, "select Nama from dosen where NIDN = '" . $row['Penguji1'] . "'");
        while ($rl = mysqli_fetch_array($l)) {
          echo $rl[0];
        }
        echo "</font></td>";
        echo "<td><font face=Verdana color=black size=2>" . $row['Penguji2'] . "<br>";
        $l = mysqli_query($con, "select Nama from dosen where NIDN = '" . $row['Penguji2'] . "'");
        while ($rl = mysqli_fetch_array($l)) {
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
        if (isset($_GET['NIDN'])) {
          echo "<td class='align-middle'><a class=linklist href=viewmasterdosenskripsidetail.php?id=" . $row['id'] . "&NIDN=" . mysqli_real_escape_string($con, $_GET['NIDN']) . "><button type='button' class='btn btn-warning' data-toggle='tooltip' data-placement='top' title='Lihat data'><font face=Verdana size=1><i class='fa fa-eye'></i></font></button></a>";
        }
        if (isset($_GET['NIDN'])) {
          echo "<a class=linklist href=editmasterdosenskripsidetail.php?id=" . $row['id'] . "&NIDN=" . mysqli_real_escape_string($con, $_GET['NIDN']) . "><button type='button' class='btn btn-primary' data-toggle='tooltip' data-placement='top' title='Edit data'><font face=Verdana size=1><i class='fa fa-edit'></i></font></button></a>";
        }
        if (isset($_GET['NIDN'])) {
          echo "<a class=linklist href=deletemasterdosenskripsidetail.php?id=" . $row['id'] . "&NIDN=" . mysqli_real_escape_string($con, $_GET['NIDN']) . " onclick=\"return confirm('Are you sure you want to delete this data?')\"><button type='button' class='btn btn-danger' data-toggle='tooltip' data-placement='top' title='Hapus data'><font face=Verdana size=1><i class='fa fa-Trash'></i></font></button></a></td>";
        }
        echo "</tr>";
      }
      echo "</table><br>";
      echo "</div>";
      //Langkah 3: Hitung total data dan halaman
      if (isset($_GET['NIDN'])) {
        $tampil2 = mysqli_query($con, "SELECT * FROM skripsi where skripsi.Pembimbing='" . mysqli_real_escape_string($con, $_GET['NIDN']) . "'");
      }
      $jmldata = mysqli_num_rows($tampil2);
      $jmlhal  = ceil($jmldata / $batas);
      echo "<div class='text-center'>";
      echo "<ul class='pagination'>";
      // Link ke halaman sebelumnya (previous)
      if ($halaman > 1) {
        $prev = $halaman - 1;
        echo "<li><a href='$_SERVER[PHP_SELF]?halaman=$prev'>&laquo; Prev</a></li>";
      } else {
        echo "<li class='disabled'><span>&laquo; Prev</span></li>";
      }
      // Tampilkan link halaman 1,2,3 ...
      for ($i = 1; $i <= $jmlhal; $i++)
        if ($i != $halaman) {
          echo "<li><a href='$_SERVER[PHP_SELF]?halaman=$i'>$i</a></li>";
        } else {
          echo "<li class='active'><span>$i</span></li>";
        }
      // Link kehalaman berikutnya (Next)
      if ($halaman < $jmlhal) {
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