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
    $q = "SELECT * FROM tw_hak_akses where tabel='Manage_User_Access' and user = '" . $_SESSION['Email'] . "' and viewData='1'";
    $r = mysqli_query($con, $q);
    if ($obj = @mysqli_fetch_object($r)) {
    ?>
        <?php
        ?>
        <link href="standar.css" rel="stylesheet" type="text/css">

        <div class="panel panel-primary">
            <div class=" panel-heading">
                <h3 class="panel-title">View TW Table</h3>
            </div>
            <div class="panel-body">
                <div class="border border-dark">
                    <form>
                        <?php
                        $result = mysqli_query($con, "SELECT * FROM tw_tabel where tabel = '" . $_GET['tabel'] . "'");
                        while ($row = mysqli_fetch_array($result)) {
                        ?>
                            <input type="hidden" name="pk" value="<?php echo $row['tabel'] ?>">
                            <div style="margin-bottom: 2rem;">
                                <label for="tabel" class="form-label">Tabel</label>
                                <input type="text" class="form-control" name="tabel" id="tabel" value="<?php echo $row['tabel'] ?>" aria-describedby="emailHelp" required readonly>
                            </div>
                        <?php
                        }
                        ?>
                        <a href=listmastertw_tabeltw_hak_akses.php><button type="button" class="btn btn-warning">Back</button></a>
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