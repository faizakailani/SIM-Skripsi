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
include("tulislog.php");
?>
<div id="page-wrapper" style="padding-top: 2rem">
    <?php
  //cek otoritas
  $q = "SELECT * FROM tw_hak_akses where tabel='mahasiswa/skripsi' and user = '" . $_SESSION['Email'] . "' and viewData='1'";
  $r = mysqli_query($con, $q);
  if ($obj = @mysqli_fetch_object($r)) {
  ?>
    <div style="display: flex; justify-content: center; color: white">

        <div style="width: 30rem; border: 1px solid #ccc; border-radius: 5px; overflow: hidden; margin-bottom: 20px; ">
            <?php
        $result = mysqli_query($con, "SELECT * FROM mahasiswa where NIM = '" . mysqli_real_escape_string($con, $_GET['NIM']) . "'");
        while ($row = mysqli_fetch_array($result)) {
        ?>
            <img src="images/<?php echo $row['Foto']; ?>" class="card-img-top" alt="Foto Dosen"
                style="width: 100%; height: auto;">
            <div style="padding: 20px; background-color: gray">
                <h5 style="margin-bottom: 10px;"><?php echo $row['Nama']; ?></h5>
                <p class="card-text">NIM<span style="margin-left: 18px;"><?php echo ': ' . $row['NIM']; ?></span>
                </p>
                <p class="card-text">Nama<span style="margin-left: 7px"><?php echo ': ' . $row['Nama']; ?></span>
                </p>
                <?php $p = mysqli_query($con, "SELECT * FROM program_studi WHERE Kode = '$row[Program_Studi]'");
            $p_data = mysqli_fetch_assoc($p);
            ?>

                <p class="card-text">Prodi<span
                        style="margin-left: 12px"><?php echo ': ' . $p_data['Program_Studi']; ?></span>
                </p>
                <a href="listmastermahasiswaskripsi.php"
                    style=" margin-top: 10px;text-decoration: none; display: inline-block; padding: 8px 16px; background-color: #007bff; color: #fff; border-radius: 5px;">Back</a>
            </div>
        </div>
        <?php
        }
        tulislog("view mahasiswa", $con);
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