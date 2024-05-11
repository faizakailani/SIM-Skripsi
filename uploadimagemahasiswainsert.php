<?php
session_start();
if(!isset($_SESSION["Email"])){
header("location:index.php");
}
?>
<html>
<head>
<title>store</title> 
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
<br>
<div id="page-wrapper"> 
<form action="uploadimagemahasiswainsertexec.php" method="post" enctype="multipart/form-data"> 
<input type="file" id="upload_file" name="file" onchange="preview_image();" multiple/> 
<input type="submit" name='send_image' value="Upload Image"/> 
</form>
<div id="image_preview"></div> 
</div>
<?php echo "</td>"; 
include("footer.php");
?>
</body>
</html>
