<?php
	include "../../koneksi.php";
	$id_kategori=$_GET['id_kategori'];
	$modal=mysqli_query($db,"DELETE FROM tb_kategori WHERE id_kategori='$id_kategori'");
	header('location:../index.php?page=kategori');
?>