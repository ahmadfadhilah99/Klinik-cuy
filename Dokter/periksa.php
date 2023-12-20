<?php
include_once('../Koneksi/config.php');

if(isset($_POST['update']))
{	
	$id = $_POST['id_periksa'];
	
	$nik = $_POST['nik'];
	$keluhan=$_POST['keluhan'];
	$diagnosa=$_POST['diagnosa'];
	$obat=$_POST['obat'];
	$dokter=$_POST['dokter'];
	$keterangan=$_POST['keterangan'];
	$status=$_POST['status'];
		
	// update user data
	$result = mysqli_query($mysqli, "UPDATE `periksa_pasien` SET `id_periksa`='$id',`keluhan`='$keluhan',`diagnosa`='$diagnosa',`obat`='$obat',`dokter`='$dokter',`keterangan`='$keterangan',`status`='$status' WHERE `id_periksa` = '$id'");
    
    // mengirim record pasien
    $record = mysqli_query($mysqli, "INSERT INTO record_pasien(nik_pasien,keluhan,diagnosa,obat,dokter,keterangan) VALUES('$nik', '$keluhan', '$diagnosa', '$obat', '$dokter', '$keterangan')");
	
	// Redirect to homepage to display updated user in list
    header('location:dokter.php?pesan=berhasil');

}

?>

<?php
$id = $_GET['id'];
// untuk menampilkan data detail pasien
$biodata = mysqli_query($mysqli, "SELECT periksa_pasien.id_periksa, data_pasien.nama_pasien, data_pasien.umur_pasien, data_pasien.jk_pasien, periksa_pasien.nik_pasien, periksa_pasien.no_antrian, periksa_pasien.tanggal 
FROM data_pasien INNER JOIN periksa_pasien
ON data_pasien.nik_pasien=periksa_pasien.nik_pasien;");

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
    session_start();

    if ($_SESSION['role'] == '') {
        header("location:../index.php?pesan=gagal");
    } else if ($_SESSION['role'] == 'admin') {
        header("location:Admin/admin.php");
    } else if ($_SESSION['role'] == 'register') {
        header("location:Administrasi/regist.php");
    } else if ($_SESSION['role'] == 'apoteker') {
        header("location:../Apotik/apotik.php");    
    }

    ?>
    
    <!-- Navbar -->
    <ul>
        <a href="dokter.php">Dashboard</a>
        <span>|</span>
        <a href="../logout.php">keluar</a>
    </ul>

    <!-- Content -->
    <h3>hello dokter, <?= $_SESSION['username'] ?></h3>
    <br>
    <br>

    <!-- Menampilkan data si pasien-->
    <h3>Data Pasien</h3>
    <?php 
    while ($d = mysqli_fetch_array($biodata)){
        if ($d['id_periksa'] == $id){
            
    ?>     
        <h6>Nama Pasien : <?= $d['nama_pasien']?></h6>
        <h6>NIK : <?= $d['nik_pasien']?></h6>
        <h6>Umur : <?= $d['umur_pasien']?></h6>
        <h6>Gender : <?= $d['jk_pasien']?></h6>
        <h6>Nomor urut : <?= $d['no_antrian']?></h6>     
        <br>  


    <!-- Konsultasi pasien -->
    <h3>Form Pasien</h3>
    <form name="periksa_pasien" method="POST" action="periksa.php">
        <input type="number" name="id_periksa" value=<?=$_GET['id']?> hidden> 
        <input type="number" name="nik" value=<?= $d['nik_pasien'] ?> hidden> 
        Keluhan :
        <input type="text" name="keluhan" value="" placeholder="Keluhan Pasien"> 
        <br>
        
        Diagnosa :
        <input type="text" name="diagnosa" value="" placeholder="Masukkan Diagnosa"> 
        <br>
        
        Obat :
        <textarea type="text" name="obat" placeholder="Masukkan Obat"></textarea> 
        <br>
        
        <input type="text" name="dokter" value=<?=$_SESSION['username']?> hidden> 
        
        Keterangan :
        <textarea type="text" name="keterangan" placeholder="Masukkan Keterangan"></textarea> 
        <br>
        
        <input type="text" name="status" value='apotik' hidden> 
        <br>    
        
        <input type="submit" name="update" value="Kirim">
    </form>
        <br>    
        <br>

        <?php 
    }
        } 
    ?>
        <!-- yang harusnya disini ada biodata pasien ngambil dari data_pasien setelah itu dibawahnya ada form konsul -->
        <!-- setelah form konsul baru ada rekam medis pasien dibawahnya dengan cara mencocokkan niknya  -->
    
      
      
      
   

</body>
</html>