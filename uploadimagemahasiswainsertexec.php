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
?>
<html>
<head>
<title>SIM Skripsi</title>
<link rel="stylesheet" type="text/css" href="tag.css">
<script type="text/javascript" src="tag.js"></script>
<script type="text/javascript" src="kalender/calendar.js"></script>
<link href="kalender/calendar.css" rel="stylesheet" type="text/css" media="screen">
</head>
<body topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 bgcolor =FFFFFF>
<?php
?>
<link href="standar.css" rel="stylesheet" type="text/css">

<!-- calendar -->
<script src="php_calendar/scripts.js" type="text/javascript"></script>
<!-- TinyMCE -->
<script type="text/javascript" src="tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		mode : "textareas",
		theme : "advanced",
		plugins : "youtube,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,zoom,flash,searchreplace,print,paste,directionality,fullscreen,noneditable,contextmenu",
		theme_advanced_buttons1_add_before : "save,newdocument,separator",
		theme_advanced_buttons1_add : "fontselect,fontsizeselect",
		theme_advanced_buttons2_add : "separator,insertdate,inserttime,preview,zoom,separator,forecolor,backcolor,liststyle",
		theme_advanced_buttons2_add_before: "cut,copy,paste,pastetext,pasteword,separator,search,replace,separator",
		theme_advanced_buttons3_add_before : "tablecontrols,separator,youtube,separator",
		theme_advanced_buttons3_add : "emotions,iespell,flash,advhr,separator,print,separator,ltr,rtl,separator,fullscreen",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		plugin_insertdate_dateFormat : "%Y-%m-%d",
		plugin_insertdate_timeFormat : "%H:%M:%S",
		extended_valid_elements : "hr[class|width|size|noshade]",
		file_browser_callback : "fileBrowserCallBack",
		paste_use_dialog : false,
		theme_advanced_resizing : true,
		theme_advanced_resize_horizontal : false,
		theme_advanced_link_targets : "_something=My somthing;_something2=My somthing2;_something3=My somthing3;",
		media_strict : false,
		apply_source_formatting : true
	});

	function fileBrowserCallBack(field_name, url, type, win) {
		var connector = "../../filemanager/browser.html?Connector=connectors/php/connector.php";
		var enableAutoTypeSelection = true;

		var cType;
		tinymcpuk_field = field_name;
		tinymcpuk = win;

		switch (type) {
			case "image":
				cType = "Image";
				break;
			case "flash":
				cType = "Flash";
				break;
			case "file":
				cType = "File";
				break;
		}

		if (enableAutoTypeSelection && cType) {
			connector += "&Type=" + cType;
		}

		window.open(connector, "tinymcpuk", "modal,width=600,height=400");
	}
</script>
<!-- /TinyMCE -->
<?php
include("header.php");
include("menu.php");
echo "<div id='page-wrapper'>"; 
echo "<td valign=top>";
echo "<table>";
echo "<tr><td colspan=2><font face=Verdana color=black size=1>mahasiswa</font></td></tr>";
echo "<form action=insertmahasiswaexec.php method=post>";
echo "<tr><td bgcolor=CCCCCC><font face=Verdana color=black size=1>Kode</font></td>";
echo "<td bgcolor=CCEEEE><input type=text  class='form-control' name='Kode' value=".$namaBaruFile." size = 50></td>";
echo "<tr><td bgcolor=CCCCCC><font face=Verdana color=black size=1>Program_Studi</font></td>";
echo "<td bgcolor=CCEEEE>";
echo "<select class='form-control' name='Program_Studi'>";
$result = mysqli_query($con, "select * from program_studi"); 
while($r = mysqli_fetch_array($result)){
echo "<option value='". $r[Kode] ."'>". $r[Kode] ." | ". $r[Program_Studi] ."</option>";
}
echo "</select>";
echo "</td>";
echo "<tr><td bgcolor=CCCCCC><font face=Verdana color=black size=1>Kaprodi</font></td>";
echo "<td bgcolor=CCEEEE>";
echo "<select class='form-control' name='Kaprodi'>";
$result = mysqli_query($con, "select * from program_studi"); 
while($r = mysqli_fetch_array($result)){
echo "<option value='". $r[Kode] ."'>". $r[Kode] ." | ". $r[Program_Studi] ."</option>";
}
echo "</select>";
echo "</td>";
echo "<tr><td bgcolor=CCCCCC><font face=Verdana color=black size=1>NIDN_Kaprodi</font></td>";
echo "<td bgcolor=CCEEEE>";
echo "<select class='form-control' name='NIDN_Kaprodi'>";
$result = mysqli_query($con, "select * from program_studi"); 
while($r = mysqli_fetch_array($result)){
echo "<option value='". $r[Kode] ."'>". $r[Kode] ." | ". $r[Program_Studi] ."</option>";
}
echo "</select>";
echo "</td>";
echo "<tr><td colspan=2 align=center><button type=submit><font face=Verdana size=1>&nbsp;Insert&nbsp;</font></button></td></tr>";
echo "</form>";
echo "</table></td></tr>";
echo "</div>";
include("footer.php");
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
