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
<div id="page-wrapper">
    <?php
    //cek otoritas
    $q = "SELECT * FROM tw_hak_akses where tabel='program_studi/mahasiswa' and user = '" . $_SESSION['Email'] . "' and editData='1'";
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
            <h3 class="panel-title">Edit Master Program Studi</h3>
        </div>
        <div class="panel-body">
            <div class="border border-dark">
                <form action="editmasterprogram_studimahasiswaexec.php" method="post">
                    <?php
                        $result = mysqli_query($con, "SELECT * FROM program_studi WHERE Kode = '" . mysqli_real_escape_string($con, $_GET['Kode']) . "'");
                        while ($row = mysqli_fetch_array($result)) {
                        ?>
                    <input type="hidden" name="pk" value="<?php echo $row['Kode'] ?>">
                    <div style="margin-bottom: 2rem;">
                        <label for="inputKode" class="form-label">Kode</label>
                        <input type="text" class="form-control" name="Kode" value="<?php echo $row['Kode'] ?>"
                            id="inputKode" aria-describedby="emailHelp" required>
                    </div>
                    <div style="margin-bottom: 2rem;">
                        <label for="inputProdi" class="form-label">Program Studi</label>
                        <input type="text" class="form-control" name="Program_Studi"
                            value="<?php echo $row['Program_Studi'] ?>" id="inputProdi" required>
                    </div>
                    <div style="margin-bottom: 2rem;">
                        <label for="inputKaprodi" class="form-label">Kaprodi</label>
                        <select name="Kaprodi" class="form-control" required>
                            <option selected disabled>-- Pilih --</option>
                            <?php
                                    $rs = mysqli_query($con, "SELECT * FROM dosen");
                                    while ($r = mysqli_fetch_array($rs)) {
                                        $selected = ($r['NIDN'] == $row['NIDN_Kaprodi']) ? 'selected' : '';
                                        echo "<option value='" . $r['NIDN'] . "|" . $r['Nama'] . "' $selected>" . $r['NIDN'] . " | " . $r['Nama'] . "</option>";
                                    }
                                    ?>
                        </select>
                    </div>
                    <?php
                        }
                        ?>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>

            </div>
        </div>
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