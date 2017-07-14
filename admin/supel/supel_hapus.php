<?php
	include "../../koneksi.php";
	$id=$_GET['id'];
	$modal=mysqli_query($db,"DELETE FROM tb_supel WHERE id='$id'");
	header('location:../index.php?page=datasupel');
?>