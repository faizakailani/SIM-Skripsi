<?php
session_start();
if (!isset($_SESSION["Email"])) {
	header("location:index.php");
}
?>
<?php
include("db.php");
$NIDN = mysqli_real_escape_string($con, $_POST["NIDN"]);
$Nama = mysqli_real_escape_string($con, $_POST["Nama"]);
$Foto = mysqli_real_escape_string($con, $_POST["Foto"]);

//upload image 
if (isset($_POST['send_image'])) {
	$ukuran_maks_file = 2000000;
	$array_tipe_file = array('jpg', 'png', 'gif', 'jpeg');
	$folder = 'images/';
	$file = $_FILES['Foto'];
	$namafile = explode(".", $file["name"]);
	$nama_file_tanpa_ekstensi = isset($namafile[0]) ? $namafile[0] : null;
	$ekstensi_file = $namafile[count($namafile) - 1];
	$ukuran_file = $file['size'];
	if ($file['error'] == 0) {
		if (in_array($ekstensi_file, $array_tipe_file)) {
			if ($ukuran_file <= $ukuran_maks_file) {
				$namaBaruFile = md5($nama_file_tanpa_ekstensi[0] . microtime()) . '.' . $ekstensi_file;
				if (move_uploaded_file($file['tmp_name'], $folder . $namaBaruFile)) {
					echo "sukses upload file";
				} else {
					echo "Error: can not upload image";
				}
			} else {
				echo "Error: image size too big";
			}
		} else {
			echo "Error: image type not supported";
		}
	}
}
$Foto = $namaBaruFile;

if ($NIDN != "") {
	mysqli_query($con, "INSERT INTO dosen(NIDN,Nama,Foto) VALUES ('$NIDN','$Nama','$Foto')");
}
header("Location: listmasterdosenskripsi.php");
mysqli_close($con)
?>