<?php
session_start();
if (!isset($_SESSION["Email"])) {
    header("location:index.php");
    exit();
}
?>
<?php
include("db.php");
include("tulislog.php");

$pk = mysqli_real_escape_string($con, $_POST["pk"]);
$Email = mysqli_real_escape_string($con, $_POST["Email"]);
$Password = mysqli_real_escape_string($con, $_POST["Password"]);
$Active = mysqli_real_escape_string($con, $_POST["Active"]);

// Check if the password field is not empty
if (!empty($Password)) {
    $updateQuery = "UPDATE user SET Email='$Email', Password=md5('$Password'), Active='$Active' WHERE Email='$pk'";
} else {
    $updateQuery = "UPDATE user SET Email='$Email', Active='$Active' WHERE Email='$pk'";
}

// Execute the query
if (mysqli_query($con, $updateQuery)) {
    tulislog("update user", $con);
$_SESSION["edit_success"] = "Data berhasil diubah.";

    header("Location: listuser.php");
    exit();
} else {
    echo "Error updating record: " . mysqli_error($con);
}

mysqli_close($con);
?>