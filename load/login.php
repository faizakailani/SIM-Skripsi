<?php require_once('connect.php');
if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $cekdata = mysqli_query($con, "SELECT * FROM tb_login WHERE email='$email' or password='$password'");
    $cek = mysqli_num_rows($cekdata);
    if($cek == 1){
        $row_akun = mysqli_fetch_array($cekdata);
        session_start();
        $_SESSION['email'] = $row_akun['email'];
        echo "<script>
            window.location=('../profile.php')</script>";
    }else{
        echo "<script>window.alert('Gagal! Username atau Password salah.');
            window.location=('')</script>";
    }
}
?>