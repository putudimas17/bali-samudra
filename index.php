<?php
session_start();
if(@$_SESSION['admin']  )
{
	echo "<script>window.location='admin';</script>";
}
else if(@$_SESSION['karyawan'])
{
	echo "<script>window.location='karyawan';</script>";
} else if(@$_SESSION['owner'])
{
	echo "<script>window.location='owner';</script>";
}
else
{
?>

<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>SIE BALI SAMUDRA</title>

	<!-- Font awesome -->
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<!-- Sandstone Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Bootstrap Datatables -->
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<!-- Bootstrap social button library -->
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<!-- Bootstrap select -->
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<!-- Bootstrap file input -->
	<link rel="stylesheet" href="css/fileinput.min.css">
	<!-- Awesome Bootstrap checkbox -->
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<!-- Admin Stye -->
	<link rel="stylesheet" href="css/style.css">

	<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
	
	<div class="login-page bk-img" style="background-image: url(img/bst.jpg);">
		<div class="form-content">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-md-offset-3">
						<h1 class="text-center text-bold text-light mt-4x" >Sign in</h1>
						<div class="well row pt-2x pb-3x bk-light">
							
							<!-- form login --> 
								<form action="index.php" class="mt" method="post">

									<label for="" class="text-uppercase text-sm">Username</label>
									<input type="text" placeholder="Username"  name="username" autofocus class="form-control mb">

									<label for="" class="text-uppercase text-sm">Password</label>
									<input type="password" placeholder="Password" class="form-control mb" name="password">

									<label for="" class="text-uppercase text-sm">Level</label>
									<select name="level" class="form-control"required>
										<option value=""> -- Pilih Sebagai --</option>
										<option value="admin">ADMIN</option>
										<option value="karyawan">KARYAWAN</option>
										<option value="owner">OWNER</option>
									</select>
									

									<label for="" class="text-uppercase text-sm"></label>
										<input type="submit" class="btn btn-primary btn-block btn-flat" value="LOGIN" name="login">
																			
							</form>
							<!-- end form -->
								
							</div>
						</div>
						<div class="text-center text-light">
						
						</div>
													<!-- proses login username dan password dan level name harus sama -->
								<?php

								include "koneksi.php";

if(isset($_POST['login']))
{
	$user= mysqli_real_escape_string($db,$_POST['username']);	
	$pass= mysqli_real_escape_string($db,$_POST['password']);	
	$level= mysqli_real_escape_string($db,$_POST['level']);	
	if($level=='admin')
	{
		$sql=mysqli_query($db, "SELECT * FROM tb_user WHERE Username='$user' AND Password='$pass' AND Level='$level'");
		$data=mysqli_fetch_array($sql);
		$id=$data[0];
		$cek=mysqli_num_rows($sql);
			if($cek>0)
			{
			$_SESSION['admin']=$id;
			echo "<script>window.location='admin';</script>";
			} 
			else
			{
			echo "<script >alert('Login Admin Gagal Silahkan periksa Username dan Password Anda');</script>";	
			}
	}
	else if($level=='karyawan')
	{
		$sql=mysqli_query($db, "SELECT * FROM tb_user WHERE Username='$user' AND Password='$pass' AND Level='$level'");
		$data=mysqli_fetch_array($sql);
		$id=$data[0];
		$cek=mysqli_num_rows($sql);
			if($cek > 0)
			{
			$_SESSION['karyawan']=$id;
			echo "<script>window.location='karyawan';</script>";
			} 
			else
			{
			echo "<script>alert('Login Karyawan Gagal Silahkan periksa Username dan Password Anda');</script>";	
			}
	}
	else if($level=='owner')
	{
		$sql=mysqli_query($db, "SELECT * FROM tb_user WHERE Username='$user' AND Password='$pass' AND level='$level'");
		$data=mysqli_fetch_array($sql);
		$id=$data[0];
		$cek=mysqli_num_rows($sql);
			if($cek>0)
			{
			$_SESSION['owner']=$id;
			echo "<script>window.location='owner';</script>";
			} 
			else
			{
			echo "<script>alert('Login Owner Gagal Silahkan periksa Username dan Password Anda');</script>";	
			}
	}
}

?>         
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<!-- Loading Scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>

</body>

</html>
<?php
}
?>