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
			<h2 class="page-title">Data Supplier</h2>
				<div class="panel-heading">
					<p><a href="#" class="btn btn-primary" data-target="#ModalAdd" data-toggle="modal">Tambah Data</a>
					</p>
				</div>

				<div class="panel panel-default">
							
							<div class="panel-body">
								<table id="zctb" class="table table-striped table-bordered table-hover" >
									<thead>
										<tr>
											<th>No</th>
											<th>Nama</th>
											<th>Alamat</th>
											<th>No Tlp</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
<?php 
  //menampilkan data mysqli

 $no = 1;
  $modal = mysqli_query($db, "SELECT * FROM tb_supel");
  while($r = mysqli_fetch_assoc($modal)){
  
?>
									
	<tr>
		<td><?php echo  $no++; ?></td>
		<td><?php echo  $r['Nama']; ?></td>
		<td><?php echo  $r['Alamat']; ?></td>
		<td><?php echo  $r['No_tlp']; ?></td>
		<td align="center">
			<a href="supel/supel_edit.php?id=<?php echo $r['id_supel']; ?>" data-target="#EditDataSupel" data-toggle="modal" data-backdrop="static" class="fa fa-edit" -></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a href="#" class="hapus_modal fa fa-trash-o" onclick="confirm_modal('supel/supel_hapus.php?&id=<?php echo  $r['id_supel']; ?>');"></a>
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
							<div class="panel-heading"align="center">Tambah Data Supplier</div>
								<div class="panel-body">
									<!-- form -->
									<form method="POST">
										<div class="form-group">
											<label for="Nama">Nama</label>
												<input type="text" id="Nama" class="form-control" name="Nama" placeholder="Nama" autofocus required oninvalid="this.setCustomValidity('Nama tidak boleh kosong')" oninput="setCustomValidity('')">
										</div>
										<div class="form-group">
											<label for="Alamat">Alamat</label>
												<input type="text" id="Alamat" class="form-control" name="Alamat" placeholder="Alamat" required oninvalid="this.setCustomValidity('Alamat tidak boleh kosong')" oninput="setCustomValidity('')">
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label">No Tlp</label>
												<input type="number" id="No_tlp" class="form-control" name="No_tlp" placeholder="No_tlp" required oninvalid="this.setCustomValidity('no_tlp tidak boleh kosong')" oninput="setCustomValidity('')">
										</div>
										<div class="modal-footer">
									   		<input type="submit" class="btn btn-success" value="Simpan" name="simpan">
									   		<button type="reset" class="btn btn-danger waves-effect" data-dismiss="modal" onclick="window.location.href=window.location.href;">Batal</button>
									  	</div>
									</form>
									<!-- end form -->
								<?php
								if ( isset( $_POST[ 'simpan' ] ) ) {

									$Nama = $_POST[ 'Nama' ];
									$Alamat = $_POST[ 'Alamat' ];
									$No_tlp = $_POST[ 'No_tlp' ];
									
									$query = mysqli_query( $db, "SELECT * FROM tb_supel WHERE Nama = '$Nama' " );
									$cek = mysqli_num_rows( $query );
									if ( $cek >= 1 ) {
										echo "<script> alert('Data sudah pernah diinput, Coba Periksa Lagi!');window.location='index.php?page=datasupel';</script>";

									} else {
										mysqli_query( $db, "INSERT INTO tb_supel (Nama, Alamat, No_tlp) VALUES ('$Nama', '$Alamat', '$No_tlp')" )or die( $db->error );
										echo "<script>window.location='index.php?page=datasupel';</script>";

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
	
	<!--edit data supel -->
	<div class="modal fade" id="EditDataSupel" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content"> </div>
          </div>
        </div>
	<!--edit data supel -->
	
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