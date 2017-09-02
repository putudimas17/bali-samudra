<?php 
include "../../koneksi.php"; 
	$id=@$_GET['id'];
	$modal=mysqli_query($db,"SELECT * FROM tb_supel WHERE id='$id'");
	while($r=mysqli_fetch_array($modal)){
?>
   <!--modal dialog -->
     <div class="row">
		<div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading" align="center">Edit Data Supplier</div>
					<div class="panel-body">
						<form name="modal_popup"  method="POST" action="supel/supel_edit.php">
							<div class="form-group" hidden="">
								<label for="id">id</label>
									<input type="text" id="id" placeholder="id" name ="id" class="form-control" value="<?php echo $r['id']; ?>" required readonly>
							</div>
							<div class="form-group" >
								<label for="Nama">Nama</label>
									<input type="text" id="Nama" placeholder="Nama User" name ="Nama" class="form-control" value="<?php echo $r['Nama']; ?>" required oninvalid="this.setCustomValidity('nama tidak boleh kosong')" oninput="setCustomValidity('')">
							</div>
							<div class="form-group" >
								<label for="Alamat">Alamat</label>
									<input type="text" id="Alamat" placeholder="Alamat" name ="Alamat" class="form-control" value="<?php echo $r['Alamat']; ?>" required oninvalid="this.setCustomValidity('alamat tidak boleh kosong')" oninput="setCustomValidity('')">
							</div>
							<div class="form-group" >
								<label for="No_tlp">No Tlp</label>
									<input type="number" id="No_tlp" placeholder="No_tlp" name ="No_tlp" class="form-control" value="<?php echo $r['No_tlp']; ?>" required oninvalid="this.setCustomValidity(no_tlp tidak boleh kosong')" oninput="setCustomValidity('')">
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
	$id			=$_POST['id'];
	$nama		=$_POST['Nama'];
	$alamat	=$_POST['Alamat'];
	$no_tlp	=$_POST['No_tlp'];
		
		$query = mysqli_query( $db, "SELECT * FROM tb_supel WHERE Nama='$nama' " );
			$cek = mysqli_num_rows( $query );
				if ( $cek > 0 ) {
					echo "<script> alert('Data sudah pernah diinput, Coba Periksa Lagi!');window.location='../index.php?page=datasupel';</script>";

				} else {
					mysqli_query( $db, "UPDATE tb_supel SET Nama='$nama',  Alamat='$alamat', No_tlp='$no_tlp' WHERE id='$id'" )or die( $db->error );
					echo "<script>window.location='../index.php?page=datasupel';</script>";
				}
		
		
	}
										 
?>
							</div>
						</div>
					</div>

				</div>
<!-- end modal dialog -->