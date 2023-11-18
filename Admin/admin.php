<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BerObat</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/dashboard.css?v=3">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <?php
    session_start();

    if ($_SESSION['role'] == '') {
        header("location:../index.php?pesan=gagal");
    } else if ($_SESSION['role'] == 'register') {
        header("location:Administrasi/regist.php");
    } else if ($_SESSION['role'] == 'dokter') {
        header("location:Dokter/dokter.php");
    } else if ($_SESSION['role'] == 'apoteker') {
        header("location:Apotik/apotik.php");
    }

    ?>
    
    <!-- Navbar -->
    <a href="../logout.php">keluar</a>

    <!-- Content -->
    <h3>hello admin, <?= $_SESSION['username'] ?></h3>

</body>
</html>