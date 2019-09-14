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
			<h2 class="page-title">Laporan Pembelian</h2>
     		<form method="post" class="form-horizontal" action="laporan_pembelian/cetak_laporan_pembelian.php">

              <div class="form-group">
										<label class="col-sm-2 control-label">Pilih:</label>
										<div class="col-sm-10">

                    <select class="selectpicker" name="bulan" required>
												<option value="">-- Pilih Bulan --</option>
												<option value="1">Januari</option>
                        <option value="2">Februari</option>
                        <option value="3">Maret</option>
                        <option value="4">April</option>
                        <option value="5">Mei</option>
                        <option value="6">Juni</option>
                        <option value="7">Juli</option>
                        <option value="8">Agustus</option>
                        <option value="9">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>

											</select>


											<select class="selectpicker" name="tahun" required>
												<option value="">-- pilih tahun -- </option>
                        <?php
												$bln=mysqli_query($db,"select DISTINCT year(tgl) as tahun from tb_pembelian order by year(tgl) desc");
												while($bulan=mysqli_fetch_array($bln))
												{
												 ?>
													<option value="<?php echo $bulan['tahun']; ?>"> <?php echo $bulan['tahun']; ?></option>
												<?php
												}
												?>

											</select>



                      <button class="btn btn-primary" type="submit">Cetak</button>
                      <div class="hr-dashed"></div>
										</div>




								 </form>

                <div class="panel panel-default">
					<div class="panel-body">
						<table id="zctb" class="table table-striped table-bordered table-hover" >
							<thead>
										<tr>
											<th> No</th>
											<th>Tanggal Penjualan </th>
											<th>Total Penjualan</th>

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

$modal = mysqli_query($db,"SELECT *, sum(total) as total FROM tb_pembelian group by tgl order by tgl desc");
if ($modal) {
	while ($r = mysqli_fetch_assoc($modal)) {
		$tgl = $r['tgl'];
		$total = $r['total'];
		$total_format = number_format($total,0,",","."); ?>
		<tr>
			<td style="width:15px"><?php echo  $no++ ?></td>
			<td><?php echo  TanggalIndo($tgl); ?></td>
			<td><?php echo  'Rp '.$total_format; ?></td>
		</tr>
	<?php }
} ?>
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

