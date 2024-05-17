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
            <h3 class="panel-title">Edit Mahasiswa</h3>
        </div>
        <div class="panel-body">
            <div class="border border-dark">
                <form action=editmasterprogram_studimahasiswadetailexec.php method=post enctype='multipart/form-data'>
                    <?php
					$result = mysqli_query($con, "SELECT * FROM mahasiswa where NIM = '" . mysqli_real_escape_string($con, $_GET['NIM']) . "'");
					while ($row = mysqli_fetch_assoc($result)) {
					?>
                    <input type="hidden" name="pk" value="<?php echo $row['NIM'] ?>">
                    <div style="margin-bottom: 2rem;">
                        <label for="inputNIM" class="form-label">NIM</label>
                        <input type="text" class="form-control" name="NIM" id="inputNIM" required
                            value="<?php echo $row['NIM'] ?>">
                    </div>
                    <div style="margin-bottom: 2rem;">
                        <label for="inputNama" class="form-label">Nama</label>
                        <input type="text" class="form-control" name="Nama" id="inputNama" required
                            value="<?php echo $row['Nama'] ?>">
                    </div>
                    <div style="margin-bottom: 2rem;">
                        <label for="inputNama" class="form-label">Program Studi</label>
                        <select name="Program_Studi" class="form-control" required>
                            <option selected disabled>-- Pilih --</option>
                            <?php $result = mysqli_query($con, "select * from program_studi");
								while ($r = mysqli_fetch_array($result)) {
								?>
                            <option value="<?php echo $r['Kode'] ?>" <?php echo $r['Kode'] ? 'selected' : '' ?>>
                                <?php echo $r['Program_Studi'] ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div style="margin-bottom: 3rem;">
                        <label for="inputFile" class="form-label">Foto</label><br>
                        <?php if (isset($row['NIM'])) {
								if (!empty($row['Foto'])) { ?>
                        <a href="images/<?php echo $row['Foto'] ?>" target="_blank"><img src="
                            images/<?php echo $row['Foto'] ?>" width="100px" height="100px" alt="foto"
                                style="margin: 0 0 5px 10px"></a>
                        <input type="text" class="form-control" name="Foto" id="inputFile" required
                            value="<?php echo $row['Foto'] ?> " readonly>
                        <?php }
							} ?>
                        <a class="btn btn-success" style="color: white; font-weight: 5px"
                            href="uploadimagemahasiswa.php?NIM=<?php echo $row['NIM'] ?>">Upload image</a>
                    </div>
                    <?php } ?>
                    <button class="btn btn-primary" name="send_image">Update</button>
                </form>
            </div>
        </div>
    </div>
    <?php
	include("footer.php");
	?>