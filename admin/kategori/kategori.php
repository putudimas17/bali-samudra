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
			<h2 class="page-title">Data Kategori</h2>
				<div class="panel-heading">
					<p><a href="#" class="btn btn-primary" data-target="#ModalAdd" data-toggle="modal">Tambah Data</a>
					</p>
				</div>

				<div class="panel panel-default">

					<div class="panel-body">
						<table id="zctb" class="display table table-striped table-bordered table-hover" >
							<thead>
								<tr>
									<th>No</th>
									<th>Nama Kategori</th>
									<th>Aksi</th>
								</tr>
							</thead>
								<tbody>
<?php
  //menampilkan data mysqli

  $no = 1;
  $modal=mysqli_query($db,"SELECT * FROM tb_kategori");
  while($r=mysqli_fetch_assoc($modal)){

?>

		<tr>
			<td><?php echo  $no++; ?></td>
			<td><?php echo  $r['nama_kategori']; ?></td>
			<td align="center">
				<a href="kategori/kategori_edit.php?id_kategori=<?php echo $r['id_kategori']; ?>" data-target="#EditDataKategori" data-toggle="modal" data-backdrop="static" class="fa fa-edit" -></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="#" class="hapus_modal fa fa-trash-o" onclick="confirm_modal('kategori/kategori_hapus.php?&id_kategori=<?php echo  $r['id_kategori']; ?>');"></a>
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
							<div class="panel-heading" align="center">Tambah Data Kategori</div>
							<div class="panel-body">


								<form method="post" >
									<div class="form-group" >
										<label for="nama_kategori">Nama Kategori</label>
											<input type="text" id="nama_kategori" class="form-control" placeholder="Masukkan Nama Kategori" name="nama_kategori" required oninvalid="this.setCustomValidity('nama kategori tidak boleh kosong')" oninput="setCustomValidity('')">
									</div>
									<div class="modal-footer">
									   <input type="submit" class="btn btn-success" value="Simpan" name="simpan">
									   <button type="reset" class="btn btn-danger waves-effect" data-dismiss="modal" onclick="window.location.href=window.location.href;">Batal</button>
									 </div>

								</form>

								<?php
								if ( isset( $_POST[ 'simpan' ] ) ) {

									$nama_kategori = $_POST[ 'nama_kategori' ];



									$query = mysqli_query( $db, "SELECT * FROM tb_kategori WHERE nama_kategori='$nama_kategori'" );
									$cek = mysqli_num_rows( $query );
									if ( $cek >= 1 ) {
										echo "<script> alert('Data sudah pernah diinput, Coba Periksa Lagi!');window.location='index.php?page=kategori';</script>";

									} else {
										mysqli_query( $db, "INSERT INTO tb_kategori (nama_kategori) VALUES ('$nama_kategori')" )or die( $db->error );
										echo "<script>window.location='index.php?page=kategori';</script>";

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
	<div class="modal fade" id="EditDataKategori" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
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