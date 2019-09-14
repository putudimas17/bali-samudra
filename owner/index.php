<?php
session_start();
ob_start();
if(@$_SESSION['owner']) {
	include "../koneksi.php";
} else {
	echo "<script> window.location = '..'; </script>";
} ?>
<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">

	<title>SIE PT BALI SAMUDRA</title>

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

	<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
	<div class="brand clearfix" >
	<?php
			if(@$_SESSION['owner'])
			{
				$user_id= $_SESSION['owner'];
				}
			$user_login=mysqli_query($db,"SELECT * FROM tb_user WHERE id_user='$user_id'") or die (mysqli_error());
			$data_user=mysqli_fetch_array($user_login);
			?>
		<a href="index.php"class="logo"> <img src="../img/baner.png" class="img-responsive" alt=""></a>
		<span class="menu-btn"><i class="fa fa-bars"></i></span>
		<ul class="ts-profile-nav">

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
				<li class="ts-label">Menu</li>
				 	<li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
					<li><a href="#"><i class="fa fa-bar-chart-o"></i> Grafik</a>
					<ul>

						<li><a href="?page=grafik_penjualan"><i class="fa fa-bar-chart-o"></i>Grafik Penjualan</a></li>
						<li><a href="?page=grafik_pembelian"><i class="fa fa-bar-chart-o"></i>Grafik Pembelian</a></li>
            <li><a href="?page=grafik_kategori"><i class="fa fa-bar-chart-o"></i>Grafik per Kategori</a></li>

					</ul>
				</li>
        	<li><a href="#"><i class="fa fa-files-o"></i> Laporan</a>
					<ul>

			<li><a href="?page=laporan_penjualan"><i class="fa fa-files-o"></i>Laporan Penjualan</a></li>
			<li><a href="?page=laporan_pembelian"><i class="fa fa-files-o"></i>Laporan Pembelian</a></li>
            <li><a href="?page=laporan_stok"><i class="fa fa-files-o"></i>Laporan Stok</a></li>
            <li><a href="?page=laporan_supplier"><i class="fa fa-files-o"></i>Laporan Supplier</a></li>
            <li><a href="?page=laporan_keuntungan_kotor"><i class="fa fa-files-o"></i>Laporan Keuntungan Kotor</a></li>

					</ul>
				</li>



			</ul>
		</nav>
		<!--content -->
		<div class="content-wrapper">
			<?php

	$page = @$_GET['page'];

	if($page == "grafik_jenis_barang")
	{
		include "jenis_barang/grafik_jenis_barang.php";

	}  else if($page == "grafik_penjualan")
	{
		include "grafik_penjualan/grafik_penjualan.php";

	} else if($page == "grafik_pembelian")
	{
		include "grafik_pembelian/grafik_pembelian.php";

	}
	else if($page == "grafik_kategori")
	{
		include "grafik_per_kategori/grafik_per_kategori.php";

	}
	else if($page == "laporan_penjualan")
	{
		include "laporan_penjualan/laporan_penjualan.php";

	} else if($page == "laporan_pembelian")
	{
		include "laporan_pembelian/laporan_pembelian.php";


	}
	else if($page == "laporan_keuntungan_kotor")
	{
		include "laporan_keuntungan_kotor/laporan_keuntungan_kotor.php";

	}
	else if($page == "laporan_supplier")
	{
		include "laporan_supplier/laporan_supplier.php";

	}
	else if($page == "grafik_keuntungan")
	{
		include "grafik_keuntungan/grafik_keuntungan.php";

	}
	else {

	?>
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<h2 class="page-title">Home</h2>

					</div>
				</div>
				<div class="row clearfix">
            </div>
       <!-- <div class="bkg-depan" align="center" style="margin:0 auto;"> -->
       	<div class="bkg-depan" align="center" style="margin:0 auto;">

         <p style="font-family:aileron; font-size:20px; font-weight:600"> Selamat Datang   <span style="color:#000000"><?php echo $data_user['Nama']; ?></span> di Sistem Informasi Eksekutif <span style="color: #000000"></span></p>
         <p style="font-family:aileron; font-size:20px; font-weight:600"> BALI SAMUDRA </p>
         <img src="../img/travell.jpg" height="600">

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
		var ctx = document.getElementById("dashReport").getContext("2d");
		window.myLine = new Chart(ctx).Line(swirlData, {
			responsive: true,
			scaleShowVerticalLines: false,
			scaleBeginAtZero : true,
			multiTooltipTemplate: "<%if (label){%><%=label%>: <%}%><%= value %>",
		});

		// Pie Chart from doughutData
		var doctx = document.getElementById("chart-area3").getContext("2d");
		window.myDoughnut = new Chart(doctx).Pie(doughnutData, {responsive : true});

		// Dougnut Chart from doughnutData
		var doctx = document.getElementById("chart-area4").getContext("2d");
		window.myDoughnut = new Chart(doctx).Doughnut(doughnutData, {responsive : true});

	}
	</script>

</body>

</html>