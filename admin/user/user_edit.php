<?php 
include "../../koneksi.php"; 
	$id=@$_GET['id'];
	$modal=mysqli_query($db,"SELECT * FROM tb_user WHERE id='$id'");
	while($r=mysqli_fetch_array($modal)){
?>
   <!--modal dialog -->
    <div class="row">
		<div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading" align="center">Edit Data User</div>
					<div class="panel-body">
						<form name="modal_popup" method="POST" action="user/user_edit.php">
							<div class="form-group" hidden="">
								<label for="id">id</label>
									<input type="text" id="id" class="form-control" placeholder="" name="id" value="<?php echo $r['id']; ?>">
							</div>
							<div class="form-group">
								<label for="nama">Nama</label>
									<input type="text" id="nama" class="form-control" placeholder="Masukkan Nama" name="nama" value="<?php echo $r['Nama']; ?>" required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="setCustomValidity('')">	
							</div>
							<div class="form-group" >
										<label for="username">Username</label>
											<input type="text" id="username" class="form-control" placeholder="Masukkan Username" name="username" value="<?php echo $r['Username']; ?>"required oninvalid="this.setCustomValidity('username tidak boleh kosong')" oninput="setCustomValidity('')">	
									</div>
									<div class="form-group">
										<label for="password">Password</label>
											<input type="password" id="password" class="form-control" placeholder="Masukkan Password" name="password" alue="<?php echo $r['Password']; ?>"required oninvalid="this.setCustomValidity('password tidak boleh kosong')" oninput="setCustomValidity('')">	
									</div>
									<div class="form-group">
										<label for="level">Level</label>
											<select name="level" id="level" class="form-control" required oninvalid="this.setCustomValidity('Pilih Level Anda!')" oninput="setCustomValidity('')">
												<option value="admin" <?php if($r['Level'] == "admin") {echo "selected";}?> >Admin</option>
									<option value="karyawan" <?php if($r['Level'] == "karyawan") {echo "selected";}?> >Karyawan</option>
									<option value="owner" <?php if($r['Level'] == "owner") {echo "selected";}?> >Owner</option>
												</select>	
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

	$username	=$_POST['Username'];
	$password	=$_POST['Password'];
	$level		=$_POST['Level'];
		
		$save=mysqli_query($db, "UPDATE tb_user SET Nama='$nama',  Username='$username', Password='$password', Level='$level' WHERE id='$id'");	
		
		if($save){
					echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data User Berhasil Di Simpan.</div>'; header('location:../index.php?page=datauser');
				}else{
						echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Ups, Data User Gagal Di simpan !</div>';
					}
	}
										 
?>
							</div>
						</div>
					</div>

				</div>
<!-- end modal dialog -->