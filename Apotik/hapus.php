<?php
	session_start();
	include "koneksi.php";

	$id = $_GET["id"];
	$id_obat = $_GET["id_obat"];

	unset($_SESSION["cart"][$id_obat]);

	header("location:resep.php?id=$id");

?>