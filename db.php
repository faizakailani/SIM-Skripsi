<?php
$con = mysqli_connect("localhost","root","","simskripsi");
function rupiah($angka){       
	$hasil_rupiah = "Rp " . number_format($angka,2,',','.');   
	return $hasil_rupiah;  
}     
   
function nomor($angka){  
	$hasil_nomor = number_format($angka,0,',','.'); 
	return $hasil_nomor;   
}      
?>
