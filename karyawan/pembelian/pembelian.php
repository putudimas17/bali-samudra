<?php
if ( !isset( $_SESSION ) ) {
	session_start();
	
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<div class="container-fluid transaksi">
	<div class="header">
		<h3>Transaksi Pembelian</h3>
	</div>
	<div class="form">
		<div>
			<div class="row">
                <div class="col-md-12">
                	<div class="form-group">
					    <label class="control-label control-label-left col-sm-3" for="field1">No Pembelian</label>
					    <div class="controls col-sm-9">
  
    					<input id="field1" type="text" class="form-control k-textbox" data-role="text" data-parsley-errors-container="#errId1">
    						<span id="errId1" class="error"></span>
						</div>
    
					</div>
					<div class="form-group">
					    <label class="control-label control-label-left col-sm-3" for="field1">TANGGAL</label>
					    <div class="controls col-sm-9">
  
    					<input id="field1" type="text" class="form-control k-textbox" data-role="text" data-parsley-errors-container="#errId1">
    						<span id="errId1" class="error"></span>
						</div>
    
					</div>
					<div class="form-group">
						    <label class="control-label control-label-left col-sm-3" for="field2">Supplier</label>
						    <div class="controls col-sm-9">
			                    
			                <select id="field2" class="form-control" data-role="select" data-parsley-errors-container="#errId2">
							  <option value=""></option>
							  <option value="Option 1">Option 1</option>
							  <option value="Option 2">Option 2</option>
							  <option value="Option 3">Option 3</option>
							  <option value="Option 4">Option 4</option>
							</select>
							<span id="errId2" class="error"></span></div>
			                
					</div>
				</div>
            </div>
		</div>
		<div>
			<div class="row">
				<div class="col-md-2">
					<div class="form-group">
						    <label class="control-label" for="field1">Kode Barang</label>
						    <div class="controls">			                    
			                <input id="field1" type="text" class="form-control k-textbox" data-role="text" data-parsley-errors-container="#errId1"><span id="errId1" class="error"></span></div>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						    <label class="control-label" for="field1">Nama Barang</label>
						    <div class="controls">			                    
			                <input id="field1" type="text" class="form-control k-textbox" data-role="text" data-parsley-errors-container="#errId1"><span id="errId1" class="error"></span></div>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						    <label class="control-label" for="field1">Harga</label>
						    <div class="controls">			                    
			                <input id="field1" type="text" class="form-control k-textbox" data-role="text" data-parsley-errors-container="#errId1"><span id="errId1" class="error"></span></div>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						    <label class="control-label" for="field1">Jumlah</label>
						    <div class="controls">			                    
			                <input id="field1" type="text" class="form-control k-textbox" data-role="text" data-parsley-errors-container="#errId1"><span id="errId1" class="error"></span></div>
					</div>
				</div>
				<div class="col-md-2">
					<button class="btn btn-primary">Tambah</button>
				</div>
			</div>
		</div>
		<div>
			<div class="row">
				<div class="col-md-12">
					<div class="wr-table">
						<div class="panel panel-default">
							
							<div class="panel-body">
								<table id="zctb" class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
											<th>No</th>
											<th>Kode Barang</th>
											<th>Nama Barang</th>
										
											<th>Harga</th>
											<th>Jumlah</th>
											<th>Sub Total</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>
												
											</td>
											<td>
												
											</td>
											<td>
												
											</td>
											<td>
												
											</td>
											<td>
												
											</td>
											<td>
												
											</td>
											<td align="center">
												<a href="penjualan/penjualan_edit.php?id=<?php echo $r['id']; ?>" data-target="#EditDataPenjualan" data-toggle="modal" data-backdrop="static" class="fa fa-edit"-></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												<a href="#" class="hapus_modal fa fa-trash-o" onclick="confirm_modal('penjualan/penjualan_hapus.php?&id=<?php echo  $r['id']; ?>');"></a>
											</td>
										</tr>
									</tbody>
									
								</table>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



<!-- container -->
<div class="container-fluid" style="display: none">
	<!-- row -->
	<div class="row">
		<!--col-->
		<div class="col-md-12">
			<h2 class="page-title">Data Pemebelian</h2>
				<div class="panel-heading">
					<p><a href="#" class="btn btn-success" >Tambah Transaksi Pembelian</a>
					</p>
				</div>
				<div class="form">
					<div>

					</div>
					<div></div>
					<div></div>
				</div>

				<div class="panel panel-default">
							
							<div class="panel-body">
								<table id="zctb" class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
											<th> No </th>
											<th>Tanggal </th>
											<th> No Pembelian</th>
											<th>Suppelier</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
									<?php 
  //menampilkan data mysqli

 $no=1;
  $modal=mysqli_query($db,"SELECT * FROM tb_pembelian");
  while($r=mysqli_fetch_assoc($modal)){
  
?>
									
										<tr>
											
								<td>
									<?php echo  $no++; ?>
								</td>
								<td>
									<?php echo  $r['Nama']; ?>
								</td>
								<td>
									<?php echo  $r['Username']; ?>
								</td>
								<td>
									<?php echo  $r['Password']; ?>
								</td>
								<td>
									<?php echo  $r['Level']; ?>
								</td>
								<td align="center">
									<a href="pembelian/pembelian_edit.php?id=<?php echo $r['id']; ?>" data-target="#EditDataPembelian" data-toggle="modal" data-backdrop="static" class="fa fa-edit"-></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<a href="#" class="hapus_modal fa fa-trash-o" onclick="confirm_modal('pembelian/pembelian_hapus.php?&id=<?php echo  $r['id']; ?>');"></a>
								</td>
							
										</tr>
										<?php } ?>
									</tbody>
									
								</table>

							</div>
						</div>

			<!-- /Zero Configuration Table -->

		</div>
		<!-- /col-->
	</div>
	<!-- /row-->

	<!-- div memasukkan inputan -->
	<div id="ModalAdd" class="modal fade" tabindex="-1" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">

				<div class="row">
					<div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
						<div class="panel panel-default">
							<div class="panel-heading">Tambah Transaksi Pembelian </div>
							<div class="panel-body">

								<form method="post" class="form-horizontal" action="#">

									<div class="form-group">
										<label class="col-sm-2 control-label">Nama</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="nama">
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label">Username</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="username">
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label">Password</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="password">
										</div>
									</div>


									<div class="form-group">
										<label class="col-sm-2 control-label">Level</label>
										<div class="col-sm-10">
											<select name="level" class="form-control" required>
												<option value=""> -- Pilih Sebagai --</option>
												<option value="admin">ADMIN</option>
												<option value="karyawan">KARYAWAN</option>
												<option value="owner">OWNER</option>
											</select>
										</div>
									</div>


									<div class="col-sm-8 col-sm-offset-2">
										<button class="btn btn-primary" type="submit" name="simpan">Save </button>
										<button class="btn btn-default" type="reset" data-dismiss="modal" onclick="window.location.href=window.location.href;">Cancel</button>
										
									</div>

								</form>

								<?php
								if ( isset( $_POST[ 'simpan' ] ) ) {

									$nama = $_POST[ 'nama' ];
									$username = $_POST[ 'username' ];
									$password = $_POST[ 'password' ];
									$level = $_POST[ 'level' ];


									$query = mysqli_query( $db, "SELECT * FROM tb_user WHERE id='$id' " );
									$cek = mysqli_num_rows( $query );
									if ( $cek >= 1 ) {
										echo "<script> alert('Data sudah pernah diinput, Coba Periksa Lagi!');window.location='index.php?page=pembelian';</script>";

									} else {
										mysqli_query( $db, "INSERT INTO tb_user VALUES ('','$nama', '$username', '$password', '$level')" )or die( $db->error );
										echo "<script>window.location='index.php?page=pembelian';</script>";

									}
								}
								?>

							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
		<!-- /.box-body -->
	</div>
	<!-- end memasukkan data -->
	
	<!--edit data user -->
	<div class="modal fade" id="EditDataPembelian" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content"> </div>
          </div>
        </div>
	<!--edit data user -->
	
	<!-- modal hapus -->
	<div class="modal fade" id="modal_delete">
  <div class="modal-dialog">
    <div class="modal-content" style="margin-top:100px;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" style="text-align:center;">Anda Yakin Untuk Menghapus Data?</h4>
      </div>
                
      <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
        <a href="#" class="btn btn-danger" id="delete_link">Delete</a>
        <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
	<!-- end modal hapus -->

</div>
<!-- /end container -->
  
          <!-- Javascript untuk popup modal Delete--> 
<script type="text/javascript">
    function confirm_modal(delete_url)
    {
      $('#modal_delete').modal('show', {backdrop: 'static'});
      document.getElementById('delete_link').setAttribute('href' , delete_url);
    }
</script>
         <!--js delete -->
</body>
</html>