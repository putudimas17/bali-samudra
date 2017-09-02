<?php
session_start();
ob_start();
if(@$_SESSION['karyawan'])
{
include "../koneksi.php";
?>
<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	
	<title>SIE UD ADITYA</title>

	<!-- Font awesome -->
	<link rel="stylesheet" href="../css/font-awesome.min.css">
	<!-- Sandstone Bootstrap CSS -->
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<!-- Bootstrap Datatables -->
	<link rel="stylesheet" href="../css/dataTables.bootstrap.min.css">
	<!-- Bootstrap social button library -->
	<link rel="stylesheet" href="../css/bootstrap-social.css">
	<!-- Bootstrap select -->
	<link rel="stylesheet" href="../css/bootstrap-select.css">
	<!-- Bootstrap file input -->
	<link rel="stylesheet" href="../css/fileinput.min.css">
	<!-- Awesome Bootstrap checkbox -->
	<link rel="stylesheet" href="../css/awesome-bootstrap-checkbox.css">
	<!-- Admin Stye -->
	<link rel="stylesheet" href="../css/style.css">
	<script type="text/javascript" src='../dist/vendor.js'></script>
	<script type="text/javascript" src='../dist/app.js'></script>
	<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

        <div class="" id="myDivId"></div>
       
       
	
	  
	<div class="brand clearfix" >
	<?php
			if(@$_SESSION['karyawan'])
			{
				$user_id= $_SESSION['karyawan'];
				}
			$user_login=mysqli_query($db,"SELECT * FROM tb_user WHERE id='$user_id'") or die (mysqli_error());
			$data_user=mysqli_fetch_array($user_login);
	?>
		<a href="index.php"class="logo"> <img src="../img/LOGO.png" class="img-responsive" alt=""></a>
		<span class="menu-btn"><i class="fa fa-bars"></i></span>
		<ul class="ts-profile-nav">
			<li class="ts-account">
			<!-- untuk menghitung jumlah barang dengan stok kurang dari 6 -->
			<?php 
	$stok=mysqli_query($db,"SELECT count(tb_barang.stok) as count from tb_barang
where stok <=6") or die (mysqli_error());
			$count=mysqli_fetch_array($stok);
				
			?>
			
			
				<a href="#"><?php echo $count['count'].' ';?><i class="fa fa-envelope"> Sisa Stok </i><i class="fa fa-angle-down hidden-side"></i></a>
				<ul>
				<!-- untuk menampilkan barang dengan stok kurang dari 6 -->
			<?php 
	$barang=mysqli_query($db,"SELECT nama_brg, stok from tb_barang where stok <=6 limit 10" ) or die (mysqli_error());
	while($show=mysqli_fetch_array($barang))		
			{
			?>
					<li><a href="#" style="width:300px"><?php echo $show['nama_brg'].' sisa stok '.$show['stok'] ?></a></li>
					<?php
			}
					?>
					<li style="background-color: aliceblue"><a href="index.php?page=stok_barang" style="width:300px">Lihat Semua Stok</a></li>
				</ul>
			</li>
			<li class="ts-account">
				<a href="#"><?php echo $data_user['Nama'] ?><i class="fa fa-angle-down hidden-side"></i></a>
				<ul>
					<li><a href="logout.php">Logout</a></li>
				</ul>
			</li>
		</ul>
	</div>
<!-- menu -->
	<div class="ts-main-content">
		<nav class="ts-sidebar">
			<ul class="ts-sidebar-menu">
				<li class="ts-label">MENU</li>
				<li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
				<li><a href="?page=stok_barang"><i class="fa fa-files-o"></i> Sisa Stok Barang</a>
				</li>
				<li><a href="#"><i class="fa fa-files-o"></i> Transaksi</a>
					<ul>
						<li><a href="?page=penjualan"><i class="fa fa-calculator"></i>Data Penjualan</a></li>
						<li><a href="?page=pembelian"><i class="fa fa-shopping-cart"></i>Data Pembelian</a></li>
					</ul>
				</li>
				<li><a href="#"><i class="fa fa-retweet"></i> Data Retur</a>
					<ul>
						<li><a href="?page=retur-penjualan"><i class="fa fa-database"></i>Data Retur Penjualan</a></li>
						<li><a href="?page=retur-pembelian"><i class="fa fa-database"></i>Data Retur Pembelian</a></li>
					</ul>
				</li>
				

				<!-- Account from above -->
				<ul class="ts-profile-nav">
					<li><a href="#">Help</a></li>
					<li><a href="#">Settings</a></li>
					<li class="ts-account">
						<a href="#"><img src="../img/ts-avatar.jpg" class="ts-avatar hidden-side" alt=""> Account <i class="fa fa-angle-down hidden-side"></i></a>
						<ul>
							<li><a href="#">My Account</a></li>
							<li><a href="#">Edit Account</a></li>
							<li><a href="logout.php">Logout</a></li>
						</ul>
					</li>
				</ul>

			</ul>
		</nav>
		<!--content -->
		<div class="content-wrapper">
			<?php

	$page = @$_GET['page'];

	if($page == "penjualan")
	{
		include "penjualan/penjualan.php";
		
	} else if($page == "pembelian")
	{
		include "pembelian/pembelian.php";
		
	}else if($page == 'retur-pembelian'){
		include 'retur_pembelian/retur_pembelian.php';
	} 
	else if($page == 'retur-penjualan'){
		include 'retur_penjualan/retur_penjualan.php';
	} 
	else if($page == "databarang")
	{
		include "barang/barang.php";
		
	}
	else if($page == "stok_barang")
	{
		include "notifikasi/notifikasi.php";
		
	}
	else if($page == "datasupel")
	{
		include "supel/supel.php";
		
	} else {
		
	?>	
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<h2 class="page-title">Home</h2>
					</div>
				</div>
				<div class="row clearfix">
            </div>
       <div align="center" style="margin:0 auto;">
         
         <p style="font-family:Arial; font-size:20px; font-weight:600"> Selamat Datang   <span style="color:#190A9F"><?php echo $data_user['Nama']; ?></span> di Sistem Informasi Eksekutif</p>
         <p style="font-family:Arial; font-size:20px; font-weight:600"> UD ADITYA </p>
         <img src="../img/cara-meningkatkan-penjualan.jpg" height="400">
         
         </div>


			</div>
			<?php 
}
?>
		</div>
	</div>
<!-- end menu -->
	<!-- Loading Scripts -->
	<script src="../js/jquery.min.js"></script>
	<script src="../js/bootstrap-select.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/jquery.dataTables.min.js"></script>
	<script src="../js/dataTables.bootstrap.min.js"></script>
	<script src="../js/Chart.min.js"></script>
	<script src="../js/fileinput.js"></script>
	<script src="../js/chartData.js"></script>
	<script src="../js/main.js"></script>
	
	<script>
		
	window.onload = function(){
    
		// Line chart from swirlData for dashReport
		// var ctx = document.getElementById("dashReport").getContext("2d");
		/*
		window.myLine = new Chart(ctx).Line(swirlData, {
			responsive: true,
			scaleShowVerticalLines: false,
			scaleBeginAtZero : true,
			multiTooltipTemplate: "<%if (label){%><%=label%>: <%}%><%= value %>",
		}); */
		
		// Pie Chart from doughutData
		// var doctx = document.getElementById("chart-area3").getContext("2d");
		// window.myDoughnut = new Chart(doctx).Pie(doughnutData, {responsive : true});

		// Dougnut Chart from doughnutData
		// var doctx = document.getElementById("chart-area4").getContext("2d");
		// window.myDoughnut = new Chart(doctx).Doughnut(doughnutData, {responsive : true});

	}
	</script>

</body>

</html>
<?php
}
?>