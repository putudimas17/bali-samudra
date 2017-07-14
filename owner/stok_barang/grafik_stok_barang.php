<?php
if ( !isset( $_SESSION ) ) {
	session_start();

}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<!-- container -->
<div class="container-fluid">
	<!-- row -->
	<div class="row">
		<!--col-->
		<div class="col-md-12">
			<h2 class="page-title">Data Stok Barang</h2>
				<!--form-->
				<form action="" method="post">
      <div class="row clearfix">
      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
        <div class="form-group">
          <select name="tahun" id="tahun" class="form-control" required>
          <option value="">-- pilih tahun --</option>
          <?php 
					$tahun=mysqli_query($db, "SELECT DISTINCT tahun from tb_tk_rs");
					while($rowtahun=mysqli_fetch_array($tahun))
					{
					$datatahun=$rowtahun['tahun'];
        	?>
          <option value="<?php echo $rowtahun['tahun']?>" <?php if($datatahun== $inputan_tahun) {echo 'selected';} ?>><?php echo $datatahun ?></option>
          <?php
					}
					?>
         </select>
         </div>
       
       </div>
      <div class="">
        <input type="submit" class="btn btn-primary btn m-l-15 waves-effect" value="Cari" name="cari">
          <!-- <a  href="javascript:printDiv('cetak_perencanaan');" class="btn btn-success waves-effect">Cetak</a> -->
           <a href="javascript:void(0);" class="btn btn-success waves-effect" onclick="window.open('laporan_stok_barang.php?tahun=<?php echo $inputan_tahun; ?>','nama_window_pop_up')">Cetak Laporan</a> 
       </div>
     </div>
     </form>				
				<!-- end form-->
		</div>
		<!-- /col-->
	</div>
	<!-- /row-->
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
</body>
</html>