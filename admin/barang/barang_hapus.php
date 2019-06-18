<?php
	include "../../koneksi.php";
	$kode_brg=$_GET['Kode_tiket'];
	$modal=mysqli_query($db,"DELETE FROM tb_tiket WHERE Kode_tiket='$kode_brg'");
	header('location:../index.php?page=databarang');
?>