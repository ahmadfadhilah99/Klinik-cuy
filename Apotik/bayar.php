<?php
	session_start();
    include_once('../Koneksi/config.php');
	
	$id = $_GET["id"];
	$th = $_GET["total"];
	$tg = date("Y:m:d");

	$sql = "INSERT INTO tbl_transaksi(tagihan, tanggal) VALUES('$th','$tg')";
	$query = mysqli_query($mysqli, $sql);
	$id_t = mysqli_insert_id($mysqli);
    
    $result = mysqli_query($mysqli,"UPDATE periksa_pasien SET id_transaksi = ".$id_t." WHERE periksa_pasien.id_periksa = $id");
    $record = mysqli_query($mysqli,"UPDATE record_pasien SET id_transaksi = ".$id_t." WHERE record_pasien.id_record = $id");
	
	foreach($_SESSION["cart"] as $cart => $val){

		$ambil = mysqli_query($mysqli, "SELECT stok FROM tbl_obat WHERE id_obat = $cart");
		while($data = mysqli_fetch_array($ambil)){
			$stok_ada = $data['stok'];
		}
        
        $ubah = mysqli_query($mysqli,"UPDATE tbl_obat SET stok = $stok_ada -".$val["jumlah"]." WHERE tbl_obat.id_obat = $cart");
		
		$sql = "INSERT INTO tbl_detail_transaksi(id_transaksi, id_obat,jumlah) VALUES(".$id_t.",".$cart.",".$val["jumlah"].")";
		$query = mysqli_query($mysqli, $sql);
	}

	unset($_SESSION["cart"]);

	header("location: resep.php?id=$id");
?>