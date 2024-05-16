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
    $q = "SELECT * FROM tw_hak_akses where tabel='user' and user = '" . $_SESSION['Email'] . "' and editData='1'";
    $r = mysqli_query($con, $q);
    if ($obj = @mysqli_fetch_object($r)) {
    ?>
        <?php
        ?>
        <link href="standar.css" rel="stylesheet" type="text/css">

        <div class="panel panel-primary">
            <div class=" panel-heading">
                <h3 class="panel-title">Edit User</h3>
            </div>
            <div class="panel-body">
                <div class="border border-dark">
                    <form action=edituserexec.php method=post enctype='multipart/form-data'>
                        <?php
                        $result = mysqli_query($con, "SELECT * FROM user where Email = '" . $_GET['Email'] . "'");
                        while ($row = mysqli_fetch_array($result)) {
                        ?>
                            <input type="hidden" name="pk" value="<?php echo $row['Email'] ?>">
                            <div style="margin-bottom: 2rem;">
                                <label for="Email" class="form-label">Email</label>
                                <input type="text" class="form-control" name="Email" id="Email" value="<?php echo $row['Email'] ?>" required>
                            </div>
                            <div style="margin-bottom: 2rem;">
                                <label for="Password" class="form-label">Password</label>
                                <input type="password" class="form-control" name="Password" id="Password" value="<?php echo $row['Password'] ?>" required>
                            </div>
                            <div style="margin-bottom: 2rem;">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="cp" value="ok">
                                    <label class="form-check-label" for="cp">Change Password</label>
                                </div>
                            </div>
                            <?php
                            $activeStatus = $row['Active'];
                            ?>
                            <div style="margin-bottom: 2rem;">
                                <label for="Active" class="form-label">Active</label>
                                <select name="Active" class="form-control" required>
                                    <option selected disabled>-- Pilih --</option>
                                    <option value="0" <?php echo $activeStatus == False ? 'selected' : ''; ?>>False</option>
                                    <option value="1" <?php echo $activeStatus == 1 ? 'selected' : ''; ?>>True</option>
                                </select>
                            </div>
                        <?php
                        }
                        ?>
                        <button class="btn btn-primary" name="send_image">Update</button>
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