<?php
session_start();

include_once("../Koneksi/config.php");

if (isset($_POST['add'])) {
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $umur = $_POST['umur'];
    $jk = $_POST['jk'];
    $alamat = $_POST['alamat'];

    $data = mysqli_query($mysqli, "INSERT INTO data_pasien(nik_pasien,nama_pasien,umur_pasien,jk_pasien,alamat_pasien) VALUES('$nik', '$nama', '$umur', '$jk', '$alamat')");

    header('location:tambah_pasien.php?pesan=berhasil');
}
?>


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

    if ($_SESSION['role'] == '') {
        header("location:../index.php?pesan=gagal");
    } else if ($_SESSION['role'] == 'admin') {
        header("location:Admin/admin.php");
    } else if ($_SESSION['role'] == 'dokter') {
        header("location:Dokter/dokter.php");
    } else if ($_SESSION['role'] == 'apoteker') {
        header("location:Apotik/apotik.php");
    }

    ?>
    
    <!-- Navbar -->
    <ul>
        <a href="regist.php">Dashboard</a>
        <span>|</span>
        <a href="antrian_pasien.php">Antrian</a>
        <span>|</span>
        <a href="../logout.php">keluar</a>
    </ul>


    <!-- Content -->
    <h3>Tambah Pasien</h3>
    <form action="tambah_pasien.php" method="POST" name="form1">
        <br>
        
        NIK :
        <input type="number" name="nik" placeholder="Masukkan NIK"> 
        <br>
        <br>
        
        Nama :
        <input type="text" name="nama" placeholder="Masukkan Nama"> 
        <br>
        <br>
        
        Umur :
        <input type="number" name="umur" placeholder="Masukkan Umur"> 
        <br>
        <br>
        
        Jenis Kelamin : 
        <select name="jk" id="isi">
            <option value=""></option>
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
        </select>
        <br>
        <br>

        Alamat :
        <input type="text" name="alamat" placeholder="Masukkan Alamat"> 
        <br>
        <br>
        
        <div class="aksi" style="display : flex">
            <a class="" href="regist.php">Batal</a>
            <h3>|</h3>
            <input type="submit" class="" name="add" value="Tambah">
        </div>

    </form>


    <!-- Alert -->
    <?php
    if (isset($_GET['pesan'])) {
        if ($_GET['pesan'] == 'berhasil') {
    ?>
            <script type="text/javascript">
                alert("Data Pasien Berhasil Ditambahkan ")
            </script>
    <?php
        }
    }
    ?>

</body>
</html>