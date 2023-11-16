<?php
session_start();

include_once('Koneksi/config.php');

$username = $_POST['username'];
$password = $_POST['password'];
// $password = md5($_POST['password']);


$login = mysqli_query($mysqli, "SELECT * FROM akun WHERE username='$username' and password='$password'");

$cek = mysqli_num_rows($login);


if ($cek > 0) {
    $data = mysqli_fetch_assoc($login);
    if ($data['status'] == 'aktif') {
        if ($data['id_role'] == '1') {
            $_SESSION['username'] = $username;
            $_SESSION['role'] = "admin";

            header("location:Admin/admin.php");
        } else if ($data['id_role'] == '2') {
            $_SESSION['username'] = $username;
            $_SESSION['role'] = "register";

            header("location:Administrasi/regist.php");
        } else if ($data['id_role'] == '3') {
            $_SESSION['username'] = $username;
            $_SESSION['role'] = "dokter";

            header("location:Dokter/dokter.php");

        } else if ($data['id_role'] == '4') {
            $_SESSION['username'] = $username;
            $_SESSION['role'] = "apoteker";

            header("location:Apotik/apotik.php");
        } else {
            header("location:index.php?pesan=gagal");
        }
    } else {
        header("location:index.php?pesan=nonaktif");
    }
} else {
    header("location:index.php?pesan=gagal");
}
