<?php  
session_start(); 
if(!isset($_SESSION["Email"])){ 
header("location:index.php");  
}    
?>  
<html>  
<head>  
<title>SIM Skripsi</title>  
<link rel="stylesheet" type="text/css" href="tag.css"> 
<script type="text/javascript" src="jquery.js"></script>  
<script type="text/javascript" src="jquery.form.js"></script>   
<script> 
$(document).ready(function(){  
$('form').ajaxForm(function(){  
alert("Uploaded SuccessFully"); 
});  
});  
function preview_image(){  
var total_file=document.getElementById("upload_file").files.length;  
for(var i=0;i<total_file;i++){   
	$('#image_preview').append("<imgsrc='"+URL.createObjectURL(event.target.files[i])+"'><br>"); 
} 
} 
</script>   
</head>  
<body topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 bgcolor =FFFFFF>  
<?php 
include("db.php"); 
include("header.php"); 
include("menu.php");    
echo "<td bgcolor=F5F5F5 valign=top>"; 
?> 
<div id="page-wrapper">  
<td valign=top>  
<table class='table table-striped'>
<tr><td colspan=2><font face=Verdana color=black size=1>Laporan mahasiswa/skripsi</font></td></tr>
<form action="laporan_mahasiswaskripsiexec.php" method="post" target="_blank">     
<tr><td bgcolor=CCCCCC><font face=Verdana color=black size=1>&nbsp;Tanggal Awal :</font></td> 
<td bgcolor=CCEEEE><input type=text id='TanggalAwal' name='TanggalAwal' size=10>   
<font face=Verdana color=black size=1><script type='text/javascript'>calendar.set('TanggalAwal');</script></font></td>
<tr><td bgcolor=CCCCCC><font face=Verdana color=black size=1>&nbsp;Tanggal Akhir :</font></td>  

<td bgcolor=CCEEEE><input type=text id='TanggalAkhir' name='TanggalAkhir' size=10>   
<font face=Verdana color=black size=1><script type='text/javascript'>calendar.set('TanggalAkhir');</script></font></td>  

<tr><td bgcolor=CCCCCC><font face=Verdana color=black size=1>&nbsp;Print Semua Data :&nbsp;</font></td>  
<td bgcolor=CCEEEE>   
	<select class='form-control' name=All>  
		<option value="Tidak" selected="">Tidak</option> 
		<option value="Ya">Ya</option>  
	</select>
</td> 
</tr> 
<tr><td colspan=2 align=center><input type=submit value=Proses></td></tr> 
</form>  
</table></td></tr>  
</div> 
<?php echo "</td>";  
include("footer.php");  
?>  
</body>  
</html> 
