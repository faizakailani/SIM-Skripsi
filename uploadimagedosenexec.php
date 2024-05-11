<?php
session_start();
if(!isset($_SESSION["Email"])){
header("location:index.php");
}
?>
<?php 
include("db.php"); 
if(isset($_POST['send_image'])){ 
$ukuran_maks_file = 2000000; 
$array_tipe_file = array('jpg','png','gif','jpeg'); 
$folder = 'images/'; 
$file = $_FILES['file']; 
$namafile = explode(".", $file["name"]); 
$nama_file_tanpa_ekstensi = isset($namafile[0]) ? $namafile[0] : null; 
$ekstensi_file = $namafile[count($namafile)-1]; 
$ukuran_file = $file['size'];
if( $file['error'] == 0 ){ 
   if( in_array($ekstensi_file, $array_tipe_file)){ 
       if( $ukuran_file <= $ukuran_maks_file ){ 
               $namaBaruFile = md5( $nama_file_tanpa_ekstensi[0].microtime() ).'.'.$ekstensi_file ; 
               if( move_uploaded_file($file['tmp_name'], $folder.$namaBaruFile) ){ 
				mysqli_query($con, "update dosen set Foto='". $namaBaruFile ."' where NIDN='". $_POST['NIDN'] ."'"); 
				header("Location: editdosen.php?NIDN=". $_POST['NIDN'] .""); 
              }else{ 
                   echo "Error: can not upload image"; 
               } 
       }else{  
          echo "Error: image size too big"; 
       } 
  }else{ 
       echo "Error: image type not supported"; 
   } 
} 
} 
?> 
