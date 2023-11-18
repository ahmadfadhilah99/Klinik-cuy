<?php
include_once('../Koneksi/config.php');
$search = "";
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
    <h3>hello register, <?= $_SESSION['username'] ?></h3>
    <br>
    <a href="tambah_pasien.php">Tambah Pasien</a>
    <br>
    <br>
    <br>
    <h3>Cari Data Pasien</h3>
    <form action="regist.php" method="GET" name="form1">
        <br>
        
        NIK :
        <input type="number" name="nik" placeholder="Cari NIK"> 
        <input type="submit" class="" name="cari" value="Cari">
    </form>


    <!-- Mencari Data melalui nik -->
    <?php 
    if(isset($_GET['cari'])){
	    $nik = $_GET['nik'];
	echo "<b>Hasil pencarian : ".$nik."</b>";
    }
    ?>

    <br>
    <br>

    <table border="1">
	<tr>
		<th>No</th>
		<th>NIK</th>
		<th>Nama</th>
	</tr>
	<?php 
    if(isset($_GET['cari'])){
        $nik = $_GET['nik'];
        $search = mysqli_query($mysqli,"SELECT * FROM `data_pasien` WHERE `nik_pasien` = '$nik'");				
	} else {
        $search=mysqli_query($mysqli,"SELECT * FROM `data_pasien`");
    }
    if  ($search != ""){
        $no = 1;
        while ($d = mysqli_fetch_array($search)){
            ?>
     
     <tr>
         <td><?php echo $no++; ?></td>
         <td><?php echo $d['nik_pasien']; ?></td>
         <td><?php echo $d['nama_pasien']; ?></td>
         
        </tr>
        
        <?php 
        } 
    }
        ?>
</table>


</body>
</html>