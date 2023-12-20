<?php
    session_start();
    include_once('../Koneksi/config.php');


    // mengubah status pasien
    if(isset($_POST['selesai']))
    {	
        $id = $_POST['id_periksa'];
        
        $status = $_POST['status'];
        // update user data
        $result = mysqli_query($mysqli, "UPDATE `periksa_pasien` SET `id_periksa`='$id',`status`='$status' WHERE `id_periksa` = '$id'");
            
        // Redirect to homepage to display updated user in list
        header('location:apotik.php?pesan=berhasil');

    }

    // menambahkan obat secara per item
    if(isset($_POST['tambah']))
    {
        $id = $_POST["id"];
        $nm = $_POST["nama_obat"];
        $qt = $_POST["jumlah"];
        $pc = $_POST["harga"];
        
        if($qt == 0){
            // tampilkan error
            echo "Error";
        } else {
            $_SESSION["cart"][$id] = [
                "nama" => $nm,
                "harga" => $pc,
                "jumlah" => $qt
            ];
        }
            
            header("location: resep.php?id={$_GET['id']}");
    }

?>

<?php
$id = $_GET['id'];
// untuk menampilkan data detail pasien
$biodata = mysqli_query($mysqli, "SELECT periksa_pasien.id_periksa, data_pasien.nama_pasien, data_pasien.jk_pasien, periksa_pasien.nik_pasien, periksa_pasien.obat 
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
        <h6>Gender : <?= $d['jk_pasien']?></h6>
        <br>
        <h6>Resep dokter</h6>
        <form name="obat_pasien" method="POST" action="resep.php">
            <input type="number" name="id_periksa" value=<?=$_GET['id']?> hidden>
            <textarea name="obat" id="obat" cols="30" rows="10"><?= $d['obat']?></textarea>
            <input type="text" name="status" value='selesai' hidden> 
            <br>
            <input type="submit" name="selesai" value="Selesai">
        </form>
        <?php 
    }
        } 
    ?>

<br><br><br>
    <!-- List Barang -->
    <h2>List Barang</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>jumlah</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $no = 1;
                    $sql = "SELECT * FROM tbl_obat";
                    $query = mysqli_query($mysqli, $sql);
                    while($data = mysqli_fetch_array($query)){?>
                        
                        <tr>
                            <form name="keranjang" method="POST" action="resep.php?id=<?= $_GET['id']?>">
                                <td><?php echo $no; ?></td>
                                <input type="text" name="id" value=<?= $data["id_obat"]?> hidden> 

                                <td>
                                    <input type="text" name="nama_obat" value=<?= $data["nama_obat"]?> readonly> 
                                </td>

                                <td>
                                    <input type="text" name="harga" value=<?= $data["harga"]?> readonly> 
                                </td>
                                
                                <td><input type="text" name="jumlah" value=1 placeholder="jumlah"> </td>
                                <td><input type="submit" name="tambah" value="Tambah"></td>
                            </form>
                        </tr>

                        <?php $no++; ?>
                    <?php }
                ?>
            </tbody>
        </table>

    
    
    <h2>Keranjang</h2>
        <?php
            if(empty($_SESSION["cart"])){
        ?>
        <table border="1">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td></td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                </tr>
                <tr>
                        <td colspan="4">Grand Total</td>	
                        <td>0</td>
                </tr>
            </tbody>
        </table>

        <?php
            } else {
        ?>
            <table border="1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no=1;
                        $grandtotal = 0;
                        foreach ($_SESSION["cart"] as $cart => $val) {
                            $subtotal = $val["harga"] * $val["jumlah"];
                            ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $val["nama"]; ?></td>
                                <td><?php echo $val["harga"]; ?></td>
                                <td><?php echo $val["jumlah"]; ?></td>
                                <td><?php echo $subtotal; ?></td>
                                <td>
                                    <a href="hapus.php?id_obat=<?php echo $cart?>&id=<?= $_GET['id']?>">Kosongkan</a>
                                </td>
                            </tr>
                            <?php
                            $grandtotal+=$subtotal;
                        }
                    ?>
                    <tr>
                        <td colspan="4">Grand Total</td>	
                        <td><?php echo $grandtotal; ?></td>
                    </tr>
                </tbody>
            </table>
            <a href="bayar.php?total=<?=$grandtotal?>&id=<?= $_GET['id']?>">Checkout</a>
                
        <?php 
            }
        ?>

</body>
</html>