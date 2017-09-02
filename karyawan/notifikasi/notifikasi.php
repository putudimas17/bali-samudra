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
			<h2 class="page-title">Sisa Stok Barang dibawah atau 6 per Tanggal <?php echo date("d-m-Y"); ?></h2>
    			
                <div class="panel panel-default">
					<div class="panel-body">
						<table id="zctb" class="table table-striped table-bordered table-hover" >
							<thead>
										<tr>
                    
								<th>No</th>											
								<th>Kategori </th>
										<th>Nama Barang </th>
											<th>Sisa Stok</th>
											<th>Satuan</th>
										</tr>
									</thead>
								<tbody>
<?php 
//menampilkan data mysqli
$no = 1;
function TanggalIndo($date){
	$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
 
	$tahun = substr($date, 0, 4);
	$bulan = substr($date, 5, 2);
	$tgl   = substr($date, 8, 2);
 
	$result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;		
	return($result);
}
$modal=mysqli_query($db,"SELECT tb_kategori.nama_kategori, nama_brg, stok, satuan from tb_barang
join tb_kategori on tb_kategori.id_kategori=tb_barang.id_kategori
where stok <=6 order by stok  ");
while($r=mysqli_fetch_assoc($modal)) {
$kategori=$r['nama_kategori'];
$barang=$r['nama_brg'];
$stok=$r['stok'];
$satuan=$r['satuan'];

?>
	<tr>
			<td style="width:15px"><?php echo  $no++ ?></td>
			<td><?php echo  $kategori; ?></td>
			<td><?php echo  $barang; ?></td>
      <td><?php echo  $stok; ?></td>
      <td><?php echo  $satuan; ?></td>

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


</div>
<!-- /end container -->
  
       