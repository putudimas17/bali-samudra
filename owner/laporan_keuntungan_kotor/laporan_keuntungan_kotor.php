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
			<h2 class="page-title">Laporan Keuntungan Kotor</h2>
    				<form method="post" class="form-horizontal" action="laporan_keuntungan_kotor/cetak_keuntungan_kotor.php">
							
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
												$bln=mysqli_query($db,"select DISTINCT year(tgl) as tahun from tb_penjualan order by year(tgl) desc");
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
											<th>Keuntungan</th>
											<
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
$modal=mysqli_query($db,"select  tb_penjualan.tgl, sum(tb_barang.harga_beli*tb_detail_penjualan.jumlah) as harga_beli, sum(tb_detail_penjualan.subtotal) as subtotal, tb_detail_penjualan.jumlah,
sum(tb_detail_penjualan.subtotal-(tb_barang.harga_beli*tb_detail_penjualan.jumlah)) as keuntungan
from tb_detail_penjualan
join tb_barang on tb_barang.kode_brg=tb_detail_penjualan.kode_brg
join tb_penjualan on tb_penjualan.id_penjualan=tb_detail_penjualan.id_penjualan
group by tb_penjualan.tgl desc");
while($r=mysqli_fetch_assoc($modal)) {
$tgl=$r['tgl'];
$keuntungan=$r['keuntungan'];
$keuntungan_format = number_format($keuntungan,0,",",".");
?>
	<tr>
			<td style="width:15px"><?php echo  $no++ ?></td>
			<td><?php echo  TanggalIndo($tgl); ?></td>
			<td><?php echo 'Rp '. $keuntungan_format; ?></td>

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
  
       