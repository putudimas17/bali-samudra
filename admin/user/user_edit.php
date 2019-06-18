<?php 
include "../../koneksi.php"; 
	$id=@$_GET['id'];
	$modal=mysqli_query($db,"SELECT * FROM tb_user WHERE id_user='$id'");
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
									<input type="text" id="id" class="form-control" placeholder="" name="id" value="<?php echo $r['id_user']; ?>">
							</div>
							<div class="form-group">
								<label for="Nama">Nama</label>
									<input type="text" id="Nama" class="form-control" placeholder="Masukkan Nama" name="Nama" value="<?php echo $r['Nama']; ?>" required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="setCustomValidity('')">	
							</div>
							<div class="form-group" >
										<label for="Username">Username</label>
											<input type="text" id="Username" class="form-control" placeholder="Masukkan Username" name="Username" value="<?php echo $r['Username']; ?>"required oninvalid="this.setCustomValidity('username tidak boleh kosong')" oninput="setCustomValidity('')">	
									</div>
									<div class="form-group">
										<label for="Password">Password</label>
											<input type="Password" id="Password" class="form-control" placeholder="Masukkan Password" name="Password" value="<?php echo $r['Password']; ?>"required oninvalid="this.setCustomValidity('password tidak boleh kosong')" oninput="setCustomValidity('')">	
									</div>
									<div class="form-group">
										<label for="Level">Level</label>
											<select name="Level" id="level" class="form-control" required oninvalid="this.setCustomValidity('Pilih Level Anda!')" oninput="setCustomValidity('')">
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
		
$sql=mysqli_query($db,"select * from tb_user where id_user=$id");
$sql2=mysqli_query($db,"select * from tb_user where Username='$username' and Level='$level'");
		
$cek=mysqli_num_rows($sql2);
while($rowcek=mysqli_fetch_array($sql))
{
	$rowlevel=$rowcek['Level'];
	$rowuser=$rowcek['Username'];
if($username==$rowuser && $level==$rowlevel)
{
	mysqli_query($db, "UPDATE tb_user SET Nama='$nama', Username='$username', Password='$password', Level = '$level' WHERE id_user='$id' ") or die ($db->error);	
echo "<script>window.location='../index.php?page=datauser';</script>";
}
else if($cek>0)
{
	echo "<script>alert('Username sudah pernah diinputkan, Periksa Kembali');</script>";	
		echo "<script>window.location='../index.php?page=datauser';</script>";
}
else if($level=='owner')
{
	echo "<script>alert('Level Kadis Sudah tersedia, Periksa Kembali');</script>";	
	echo "<script>window.location='../index.php?page=datauser';</script>";
	}
else
{
mysqli_query($db, "UPDATE tb_user SET Nama='$nama', Username='$username', Password='$password', Level = '$level' WHERE id_user='$id' ") or die ($db->error);	
echo "<script>window.location='../index.php?page=datauser';</script>";
	}
}
	}
										 
?>
							</div>
						</div>
					</div>

				</div>
<!-- end modal dialog -->