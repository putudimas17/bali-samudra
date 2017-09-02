<?php 
include "../../koneksi.php"; 
	$kode_brg=@$_GET['kode_brg'];
	$modal=mysqli_query($db,"SELECT * FROM tb_barang WHERE kode_brg='$kode_brg'");
	while($r=mysqli_fetch_array($modal)){
?>

   <!--modal dialog -->
    <div class="row">
		<div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading" align="center">Edit Data Barang</div>
					<div class="panel-body">
						<form name="modal_popup" method="POST" action="barang/barang_edit.php">
							<div class="form-group" hidden="">
								<label id="kode_brg">Kode Barang</label>
									<input type="text" id="kode_brg" placeholder="Kode Barang" name ="kode_brg" class="form-control" value="<?php echo $r['kode_brg']; ?>" required readonly>
								</div>
							<div class="form-group" >
								<label id="kategori">Kategori</label>
									<select id="bkategori" name="bkategori" class="form-control" required oninvalid="this.setCustomValidity('Pilih Level Anda!')" oninput="setCustomValidity('')">
										<?php
											$bkategori=mysqli_query($db,"SELECT * FROM tb_kategori");
											while($n=mysqli_fetch_array($bkategori)){
										?>
										<option value="<?php echo $n['id_kategori']; ?>" <?php if($n['id_kategori']==$r['id_kategori']){?> selected <?php } ?> > <?php echo $n['nama_kategori']; ?></option>
										<?php } ?>
					 				</select>
							</div>
							<div class="form-group" >
								<label for="nama_brg">Nama Barang</label>
									<input type="text" id="nama_brg" placeholder="Nama Barang" name ="nama_brg" class="form-control" value="<?php echo $r['nama_brg']; ?>" required oninvalid="this.setCustomValidity('nama barang tidak boleh kosong')" oninput="setCustomValidity('')">
							</div>
							<div class="form-group" >
								<label for="stok">Stok</label>
									<input type="number" id="stok" placeholder="Stok" name ="stok" class="form-control" value="<?php echo $r['stok']; ?>" required oninvalid="this.setCustomValidity('stok tidak boleh kosong')" oninput="setCustomValidity('')">
							</div>
							<div class="form-group" >
								<label for="harga">Harga Jual</label>
									<input type="number" id="harga" placeholder="Harga Jual" name ="harga" class="form-control" value="<?php echo $r['harga']; ?>" required oninvalid="this.setCustomValidity('harga jual tidak boleh kosong')" oninput="setCustomValidity('')">
							</div>
							<div class="form-group" >
								<label for="harga_beli">Harga Beli</label>
									<input type="number" id="harga_beli" placeholder="Harga Beli" name ="harga_beli" class="form-control" value="<?php echo $r['harga_beli']; ?>" required oninvalid="this.setCustomValidity('harga beli tidak boleh kosong')" oninput="setCustomValidity('')">
							</div>
							<div class="form-group" >
								<label for="satuan">Satuan</label>
									<input type="text" id="satuan" placeholder="Satuan" name ="satuan" class="form-control" value="<?php echo $r['satuan']; ?>" required oninvalid="this.setCustomValidity('satuan tidak boleh kosong')" oninput="setCustomValidity('')">
							</div>
							 <div class="modal-footer">
								<input type="submit" class="btn btn-success" value="Simpan" name="simpan">
								<button type="reset" class="btn btn-danger waves-effect" data-dismiss="modal" onclick="window.location.href=window.location.href;">Batal</button>
							 </div>
						</form>
<?php
}
?>
	<?php
	if(isset($_POST['simpan'])){
	$kode_brg			=$_POST['kode_brg'];
	$id_kategori		=$_POST['bkategori'];
	$nama_brg			=$_POST['nama_brg'];
	$stok				=$_POST['stok'];
	$harga				=$_POST['harga'];
	$harga_beli			=$_POST['harga_beli'];
	$satuan				=$_POST['satuan'];
		
		$query=mysqli_query($db, "SELECT * FROM tb_barang WHERE id_kategori='$id_kategori' and nama_brg='$nama_brg' ");
			$cek = mysqli_num_rows( $query );
				if ( $cek > 0 ) {
					echo "<script> alert('Data sudah pernah diinput, Coba Periksa Lagi!');window.location='../index.php?page=databarang';</script>";

				} else {
					mysqli_query( $db, "UPDATE tb_barang SET id_kategori='$id_kategori', nama_brg='$nama_brg', stok='$stok' , harga='$harga', harga_beli='$harga_beli', satuan='$satuan' WHERE kode_brg='$kode_brg'" )or die( $db->error );
					echo "<script>window.location='../index.php?page=databarang';</script>";
				}
		
	}
										 
?>
							</div>
						</div>
					</div>
				</div>
<!-- end modal dialog -->