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
<div id="page-wrapper" style="padding-top: 2rem;">
    <?php
	//cek otoritas
	$q = "SELECT * FROM tw_hak_akses where tabel='dosen/skripsi' and user = '" . $_SESSION['Email'] . "' and insertData='1'";
	$r = mysqli_query($con, $q);
	if ($obj = @mysqli_fetch_object($r)) {
	?>
    <?php
		?>
    <link href="standar.css" rel="stylesheet" type="text/css">

    <!-- calendar -->
    <script src="php_calendar/scripts.js" type="text/javascript"></script>
    <!-- TinyMCE -->
    <script type="text/javascript" src="tiny_mce/tiny_mce.js"></script>
    <script type="text/javascript">
    tinyMCE.init({
        mode: "textareas",
        theme: "advanced",
        plugins: "youtube,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,zoom,flash,searchreplace,print,paste,directionality,fullscreen,noneditable,contextmenu",
        theme_advanced_buttons1_add_before: "save,newdocument,separator",
        theme_advanced_buttons1_add: "fontselect,fontsizeselect",
        theme_advanced_buttons2_add: "separator,insertdate,inserttime,preview,zoom,separator,forecolor,backcolor,liststyle",
        theme_advanced_buttons2_add_before: "cut,copy,paste,pastetext,pasteword,separator,search,replace,separator",
        theme_advanced_buttons3_add_before: "tablecontrols,separator,youtube,separator",
        theme_advanced_buttons3_add: "emotions,iespell,flash,advhr,separator,print,separator,ltr,rtl,separator,fullscreen",
        theme_advanced_toolbar_location: "top",
        theme_advanced_toolbar_align: "left",
        theme_advanced_statusbar_location: "bottom",
        plugin_insertdate_dateFormat: "%Y-%m-%d",
        plugin_insertdate_timeFormat: "%H:%M:%S",
        extended_valid_elements: "hr[class|width|size|noshade]",
        file_browser_callback: "fileBrowserCallBack",
        paste_use_dialog: false,
        theme_advanced_resizing: true,
        theme_advanced_resize_horizontal: false,
        theme_advanced_link_targets: "_something=My somthing;_something2=My somthing2;_something3=My somthing3;",
        media_strict: false,
        apply_source_formatting: true
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
    <div class="panel panel-primary">
        <div class=" panel-heading">
            <h3 class="panel-title">Tambah Master Dosen/Skripsi</h3>
        </div>
        <div class="panel-body">
            <div class="border border-dark">
                <form action=insertmasterdosenskripsiexec.php method=post enctype='multipart/form-data'>
                    <div style="margin-bottom: 2rem;">
                        <label for="inputNIDN" class="form-label">NIDN</label>
                        <input type="text" class="form-control" name="NIDN" id="inputNIDN" aria-describedby="emailHelp"
                            required>
                    </div>
                    <div style="margin-bottom: 2rem;">
                        <label for="inputNama" class="form-label">Nama</label>
                        <input type="text" class="form-control" name="Nama" id="inputNama" required>
                    </div>
                    <div style="margin-bottom: 3rem;">
                        <label for="inputFile" class="form-label">Foto</label>
                        <input type="file" class="form-control" name="Foto" id="inputFile" required>
                    </div>
                    <button class="btn btn-primary" name="send_image">Insert</button>
                </form>
            </div>
        </div>
        <?php
			include("footer.php");
			?>
        <?php
	} else {
		//header("Location:content.php");
	}
		?>