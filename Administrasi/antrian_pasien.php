<?php
session_start();

include_once("../Koneksi/config.php");

// mengambil nomor antrian
$tanggal = date('Y-m-d');
$pasien = mysqli_query($mysqli, "SELECT * FROM `periksa_pasien` WHERE `tanggal` = '$tanggal'");
$no = mysqli_num_rows($pasien);

$antrian = mysqli_query($mysqli, "SELECT data_pasien.id_pasien, data_pasien.nama_pasien, periksa_pasien.nik_pasien, periksa_pasien.no_antrian,periksa_pasien.tanggal, periksa_pasien.status
FROM data_pasien INNER JOIN periksa_pasien
ON data_pasien.nik_pasien=periksa_pasien.nik_pasien;");



// menambahkan antrian
if (isset($_POST['add'])) {
    $nik = $_POST['nik'];
    $nomor = $_POST['nomor'];
    $status = $_POST['status'];

    $data = mysqli_query($mysqli, "INSERT INTO periksa_pasien(nik_pasien,no_antrian,status) VALUES ('$nik', '$nomor', '$status')");

    header('location:antrian_pasien.php?pesan=berhasil');
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

    <!-- antrian -->
    <h5>Banyak antrian saat ini : <?= $no?></h5>
    
    <!-- form daftar -->
    <h3>Daftar Antrian</h3>
    <form action="antrian_pasien.php" method="POST" name="form1">
        <br>
        
        NIK :
        <input type="number" name="nik" placeholder="Masukkan NIK"> 
        <br>
        <br>
        
        No : 
        <input type="number" name="nomor" value='<?= $no + 1 ?>' readonly>  

        <input type="text" name="status" value='dokter' hidden>
        <br>
        <br>
        
        <div class="aksi" style="display : flex">
            <a class="" href="regist.php">Batal</a>
            <h3>|</h3>
            <input type="submit" class="" name="add" value="Tambah">
        </div>
    </form>
    
    <!-- list antrian -->
    <br><br>
    <h3>Data Antrian</h3>
    <table border="1">
	<tr>
        <th>NIK</th>
		<th>Nama</th>
		<th>No Antrian</th>
		<th>Notif</th>
	</tr>
    <?php 
    while ($a = mysqli_fetch_array($antrian)){
    if ($a['tanggal']  == $tanggal){
    
    ?>
     
     <tr>
         <td><?php echo $a['nik_pasien']; ?></td>
         <td><?php echo $a['nama_pasien']; ?></td>
         <td><center><?php echo $a['no_antrian']; ?></center></td>
         <td><center><?php
         
         echo $a['status'] == "dokter" ? 'kuning' : 'hijau'; 
         
         ?></center></td>
         
        </tr>
        
        <?php 
        }        
        }        
    ?>
    </table>



    <!-- Alert -->
    <?php
    if (isset($_GET['pesan'])) {
        if ($_GET['pesan'] == 'berhasil') {
    ?>
            <script type="text/javascript">
                alert("Antrian Pasien Berhasil Ditambahkan ")
            </script>
    <?php
        }
    }
    ?>

</body>
</html>