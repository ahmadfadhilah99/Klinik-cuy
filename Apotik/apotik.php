<?php
include_once('../Koneksi/config.php');

$antrian_obat = mysqli_query($mysqli,"SELECT * FROM `periksa_pasien` WHERE `status` = 'apotik'");

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
        header("location:../Admin/admin.php");
    } else if ($_SESSION['role'] == 'register') {
        header("location:../Administrasi/regist.php");
    } else if ($_SESSION['role'] == 'dokter') {
        header("location:../Dokter/dokter.php");
    }

    ?>
    
    <!-- Navbar -->
    <ul>
        <a href="apotik.php">Dashboard</a>
        <span>|</span>
        <a href="../logout.php">keluar</a>
    </ul>

    <!-- Content -->
    <h3>hello apoteker, <?= $_SESSION['username'] ?></h3>
    <br>
    <br>

    <!-- Menampilkan antrian-->
    <h3>Antrian Obat Pasien</h3>
    <br>
    <table border="1">
	<tr>
		<th>NIK</th>
		<th>No Antrian</th>
		<th>Aksi</th>
	</tr>
	<?php 
        while ($d = mysqli_fetch_array($antrian_obat)){
            if($d['status'] == 'apotik'){
            ?>
     
    <tr>
         <td><?= $d['nik_pasien']; ?></td>
         <td><center><?= $d['no_antrian']; ?></center></td>
         <?= "<td><a href='resep.php?id=$d[id_periksa]'>Resep</a></td>"?>
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
                alert("Pasien sudah diberi obat oleh apoteker")
            </script>
    <?php
        }
    }
    ?>


</body>
</html>