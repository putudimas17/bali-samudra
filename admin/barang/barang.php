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
			<h2 class="page-title">Data Barang</h2>
				<div class="panel-heading">
					<p><a href="#" class="btn btn-primary" data-target="#ModalAdd" data-toggle="modal">Tambah Data</a>
					</p>
				</div>
                <div class="panel panel-default">
					<div class="panel-body">
						<table id="zctb" class="table table-striped table-bordered table-hover" >
							<thead>
										<tr>
											<th> No</th>
											<th>Kode Barang </th>
											<th>Kategori</th>
											<th>Nama Barang</th>
											<th>Stok</th>
											<th>Harga Jual</th>
											<th>Harga Beli</th>
											<th>Satuan</th>
											<th>Action</th>
										</tr>
									</thead>
								<tbody>
<?php 
//menampilkan data mysqli
$no = 1;
$modal=mysqli_query($db,"SELECT * FROM tb_barang order by id_kategori");
while($r=mysqli_fetch_assoc($modal)) {
$kategori=mysqli_fetch_array(mysqli_query($db,"SELECT * FROM tb_kategori WHERE id_kategori='$r[id_kategori]'"));
$hargabarangbeli = number_format($r['harga_beli'],0,",",".");
$hargabarangjual = number_format($r['harga'],0,",",".");
?>
	<tr>
			<td><?php echo  $no++ ?></td>
			<td><?php echo  $r['kode_brg']; ?></td>
			<td><?php echo  $kategori['nama_kategori']; ?></td>
			<td><?php echo  $r['nama_brg']; ?></td>
			<td><?php echo  $r['stok']; ?></td>
			<td><?php echo 'Rp '.$hargabarangjual ?></td>
			<td><?php echo 'Rp '.$hargabarangbeli ?></td>
			<td><?php echo  $r['satuan'];?></td>
			<td align="center">
			<a href="barang/barang_edit.php?kode_brg=<?php echo $r['kode_brg']; ?>" data-target="#EditDataBarang" data-toggle="modal" data-backdrop="static" class="fa fa-edit"-> </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                                        
            <a href="#" class="hapus_modal fa fa-trash-o"  onclick="confirm_modal('barang/barang_hapus.php?&kode_brg=<?php echo  $r['kode_brg']; ?>');" ></a>
            </td>
	</tr>
		<?php 
	}
		?>
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
							<div class="panel-heading" align="center">Tambah Data Barang</div>
							<div class="panel-body">
								<!-- form add data -->
								<form method="POST">
									<div class="form-group">
										<label for="kategori">Kategori</label>
											<select id="bkategori" name="bkategori" class="form-control" required oninvalid="this.setCustomValidity('Pilih Kategori!')" oninput="setCustomValidity('')">
												<option value=""> -- Pilih Kategori --</option>
												 <?php
													$bkategori=mysqli_query($db,"SELECT * FROM tb_kategori");
													while($n=mysqli_fetch_array($bkategori)){
													?>
												 <option value="<?php echo $n['id_kategori']; ?>"><?php echo $n['nama_kategori']; ?></option>
												 <?php } ?>
					 					 		 </select>
									</div>
									<div class="form-group">
										<label for="nama_brg">Nama Barang</label>
											<input type="text" id="nama_brg" placeholder="Nama Barang" class="form-control" name="nama_brg" required oninvalid="this.setCustomValidity('nama barang tidak boleh kosong')" oninput="setCustomValidity('')">
									</div>
									<div class="form-group">
										<label for="stok">Stok</label>
										<input type="number" id="stok" placeholder="Stok" class="form-control" name="stok" required oninvalid="this.setCustomValidity('stok tidak boleh kosong')" oninput="setCustomValidity('')">
									</div>
									<div class="form-group">
										<label for="harga">Harga Jual</label>
											<input type="number" id="harga" placeholder="Harga Jual" class="form-control" name="harga" required oninvalid="this.setCustomValidity('harga jual tidak boleh kosong')" oninput="setCustomValidity('')" >
										</div>
									<div class="form-group">
										<label for="harga_beli">Harga Beli</label>
											<input type="number" id="harga_beli" placeholder="Harga Beli" class="form-control" name="harga_beli" required oninvalid="this.setCustomValidity('harga beli tidak boleh kosong')" oninput="setCustomValidity('')" >
										</div>
									<div class="form-group">
										<label for="satuan">Satuan</label>
											<input type="text" id="satuan" placeholder="Satuan" class="form-control" name="satuan" required oninvalid="this.setCustomValidity('satuan tidak boleh kosong')" oninput="setCustomValidity('')">
										</div>
									 <div class="modal-footer">
									   <input type="submit" class="btn btn-success" value="Simpan" name="simpan">
									   <button type="reset" class="btn btn-danger waves-effect" data-dismiss="modal" onclick="window.location.href=window.location.href;">Batal</button>
									  </div>
								</form>
								<!-- end form add data -->

  <?php
if(isset($_POST['simpan'])){
	$id_kategori		=$_POST['bkategori'];
	$nama_brg			=$_POST['nama_brg'];
	$stok				=$_POST['stok'];
	$harga				=$_POST['harga'];
	$harga_beli			=$_POST['harga_beli'];
	$satuan				=$_POST['satuan'];


$query=mysqli_query($db, "SELECT * FROM tb_barang WHERE id_kategori='$id_kategori' and nama_brg='$nama_brg' ");
$cek=mysqli_num_rows($query);
		if($cek>=1)
		{
			echo "<script> alert('Data sudah pernah diinput, Coba Periksa Lagi!');window.location='index.php?page=databarang';</script>";
			
		}
		else 
		{
			mysqli_query($db, "INSERT INTO tb_barang VALUES ('B$no', '$id_kategori', '$nama_brg', '$stok', '$harga', '$harga_beli', '$satuan')") or 	die (mysqli_error());	
			echo "<script>window.location='index.php?page=databarang';</script>";
			
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
	
	<!--edit data barang -->
	<div class="modal fade" id="EditDataBarang" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content"> </div>
          </div>
        </div>
	<!--edit data barang -->
	
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