<?php
	include "../../koneksi.php";
	$kode_brg=$_GET['kode_brg'];
	$modal=mysqli_query($db,"DELETE FROM tb_barang WHERE kode_brg='$kode_brg'");
	header('location:../index.php?page=databarang');
?>