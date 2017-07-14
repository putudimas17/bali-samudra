<?php
if ( !isset( $_SESSION ) ) {
	session_start();

}
?>
<!-- container -->
<div class="container-fluid">
	<!-- row -->
	<div class="row">
		<!--col-->
		<div class="col-md-12">
			<h2 class="page-title">Data User</h2>
				<div class="panel-heading">
					<p><a href="#" class="btn btn-primary" data-target="#ModalAdd" data-toggle="modal">Tambah Data</a>
					</p>
				</div>
				

				<div class="panel panel-default">
							
							<div class="panel-body">
								<table id="zctb" class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
											<th> No</th>
											<th>Nama </th>
											<th>Username</th>
											<th>Password</th>
											<th>Level</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
									<?php 
  //menampilkan data mysqli

 $no=1;
  $modal=mysqli_query($db,"SELECT * FROM tb_user");
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
									<a href="user/user_edit.php?id=<?php echo $r['id']; ?>" data-target="#EditDataUser" data-toggle="modal" data-backdrop="static" class="fa fa-edit"-></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<a href="#" class="hapus_modal fa fa-trash-o" onclick="confirm_modal('user/user_hapus.php?&id=<?php echo  $r['id']; ?>');"></a>
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
							<div class="panel-heading" align="center">Tambah Data User</div>
							<div class="panel-body">

										
								<form method="POST" >
									<div class="form-group">
										<label for="nama">Nama</label>
											<input type="text" id="nama" class="form-control" placeholder="Masukkan Nama" name="nama" autofocus required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="setCustomValidity('')">	
									</div>
									<div class="form-group" >
										<label for="username">Username</label>
											<input type="text" id="username" class="form-control" placeholder="Masukkan Username" name="username" required oninvalid="this.setCustomValidity('username tidak boleh kosong')" oninput="setCustomValidity('')">	
									</div>
									<div class="form-group">
										<label for="password">Password</label>
											<input type="password" id="password" class="form-control" placeholder="Masukkan Password" name="password" required oninvalid="this.setCustomValidity('password tidak boleh kosong')" oninput="setCustomValidity('')">	
									</div>
									<div class="form-group">
										<label for="level">Level</label>
											<select name="level" id="level" class="form-control" required oninvalid="this.setCustomValidity('Pilih Level Anda!')" oninput="setCustomValidity('')">
													<option value=""> -- Pilih Sebagai --</option>
												<option value="admin">ADMIN</option>
												<option value="karyawan">KARYAWAN</option>
												<option value="owner">OWNER</option>
												</select>	
									</div>
									  <div class="modal-footer">
									   <input type="submit" class="btn btn-success" value="Simpan" name="simpan">
									   <button type="reset" class="btn btn-danger waves-effect" data-dismiss="modal" onclick="window.location.href=window.location.href;">Batal</button>
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
										echo "<script> alert('Data sudah pernah diinput, Coba Periksa Lagi!');window.location='index.php?page=datauser';</script>";

									} else {
										mysqli_query( $db, "INSERT INTO tb_user VALUES ('','$nama', '$username', '$password', '$level')" )or die( $db->error );
										echo "<script>window.location='index.php?page=datauser';</script>";

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
	<div class="modal fade" id="EditDataUser" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
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
        <a href="#" class="btn btn-danger" id="delete_link">Hapus</a>
        <button type="button" class="btn btn-success" data-dismiss="modal">Batal</button>
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