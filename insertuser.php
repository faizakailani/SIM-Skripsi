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
    $q = "SELECT * FROM tw_hak_akses where tabel='user' and user = '" . $_SESSION['Email'] . "' and insertData='1'";
    $r = mysqli_query($con, $q);
    if ($obj = @mysqli_fetch_object($r)) {
    ?>
        <?php
        ?>
        <link rel="stylesheet" type="text/css" href="tag.css">
        <script type="text/javascript" src="jquery.js"></script>
        <script type="text/javascript" src="jquery.form.js"></script>
        <div class="panel panel-primary">
            <div class=" panel-heading">
                <h3 class="panel-title">Add User</h3>
            </div>
            <div class="panel-body">
                <div class="border border-dark">
                    <form action=insertuserexec.php method=post enctype='multipart/form-data'>
                        <div style="margin-bottom: 2rem;">
                            <label for="Email" class="form-label">Email</label>
                            <input type="text" class="form-control" name="Email" id="Email" aria-describedby="emailHelp" required>
                        </div>
                        <div style="margin-bottom: 2rem;">
                            <label for="Password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="Password" id="Password" required>
                        </div>
                        <div style="margin-bottom: 2rem;">
                            <label for="Active" class="form-label">Active</label>
                            <select name="Active" class="form-control" required>
                                <option selected disabled>-- Pilih --</option>
                                <option value="0" selected="">False</option>
                                <option value="1">True</option>
                            </select>
                        </div>
                        <button class="btn btn-primary" name="send_image">Insert</button>
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