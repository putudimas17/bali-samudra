<?php 
$inputan_tahun=@$_POST['tahun'];
$inputan_bulan=@$_POST['bulan'];
$cari=@$_POST['cari'];
if($cari)
{
	$bln=$_POST['bulan'];
if($bln==1) {$nama_bulan='Januari';}
else if($bln==2) {$nama_bulan='Februari';}
else if($bln==3) {$nama_bulan='Maret';}
else if($bln==4) {$nama_bulan='April';}
else if($bln==5) {$nama_bulan='Mei';}
else if($bln==6) {$nama_bulan='Juni';}
else if($bln==7) {$nama_bulan='Juli';}
else if($bln==8) {$nama_bulan='Agustus';}
else if($bln==9) {$nama_bulan='September';}
else if($bln==10) {$nama_bulan='Oktober';}
else if($bln==11) {$nama_bulan='November';}
else if($bln==12) {$nama_bulan='Desember';}

$tampung_kategori= mysqli_query($db,"select tb_kategori.nama_kategori, tb_penjualan.tgl, sum(tb_detail_penjualan.jumlah) as jumlah from tb_detail_penjualan
join tb_barang on tb_barang.kode_brg=tb_detail_penjualan.kode_brg
join tb_kategori on tb_kategori.id_kategori=tb_barang.id_kategori
join tb_penjualan on tb_penjualan.id_penjualan=tb_detail_penjualan.id_penjualan
where month(tb_penjualan.tgl)=$inputan_bulan and year(tb_penjualan.tgl)=$inputan_tahun
group by tb_kategori.nama_kategori
order by sum(tb_detail_penjualan.jumlah) desc");
$tampung_drilldown= mysqli_query($db,"select tb_kategori.nama_kategori, tb_penjualan.tgl, sum(tb_detail_penjualan.jumlah) as jumlah from tb_detail_penjualan
join tb_barang on tb_barang.kode_brg=tb_detail_penjualan.kode_brg
join tb_kategori on tb_kategori.id_kategori=tb_barang.id_kategori
join tb_penjualan on tb_penjualan.id_penjualan=tb_detail_penjualan.id_penjualan
where month(tb_penjualan.tgl)=$inputan_bulan and year(tb_penjualan.tgl)=$inputan_tahun
group by tb_kategori.nama_kategori
order by sum(tb_detail_penjualan.jumlah) desc");
	
}


?>


	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Highcharts Example</title>

		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<style type="text/css">
${demo.css}
		</style>
		<script type="text/javascript">
$(function () {
    Highcharts.chart('container', {
        chart: {
            type: 'pie'
        },
        title: {
            text: 'Grafik per Kategori UD Aditya Tahun '
        },
       
        xAxis: {
            categories: [
             ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'jumlah barang'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.0f} rb</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Kategori',
            data: [
			
			]

        },]
    });
});
		</script>
	 <script type="text/javascript">
$(function () {
    // Create the chart
    Highcharts.chart('container', {
        chart: {
            type: 'pie'
        },
        title: {
            text: '<?php echo "Grafik Pembelian UD Aditya Bulan $nama_bulan Tahun $inputan_tahun" ?> '
        },
				 subtitle: {
            text: 'Klik nama kategori untuk per barang'
        },
      
        xAxis: {
            type: 'category'
        },
        yAxis: {
            title: {
                text: 'jumlah barang'
            }

        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.0f}'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f}</b><br/>'
        },

        series: [{
            name: 'Kategori',
            colorByPoint: true,
            data: [
			<?php
			while($row=mysqli_fetch_array($tampung_kategori))
			{
				
				$drilldown=$row['nama_kategori'];
				$jumlah=$row['jumlah'];
			
				
				?>	
						
			{
                name: '<?php echo $row['nama_kategori']; ?>',
                y: <?php echo $jumlah; ?>,
				drilldown : '<?php echo $drilldown ?>'
						               
      },
			 
			<?php
			};
			?>
			
			]
        }],
        drilldown: {
			
			
            series: 
			[
			// mulai drill down
			<?php
			while ($rowdrill=mysqli_fetch_array($tampung_drilldown))
			{
			$namakategori=$rowdrill['nama_kategori'];
			?>
			{
				
                name: '<?php echo $namakategori ?>',
                id: '<?php echo $namakategori ?>',
                data:
				
				[
				<?php
				
$tampung_data = mysqli_query($db,"select tb_barang.nama_brg, tb_penjualan.tgl, sum(tb_detail_penjualan.jumlah) as jumlah from tb_detail_penjualan
join tb_barang on tb_barang.kode_brg=tb_detail_penjualan.kode_brg
join tb_kategori on tb_kategori.id_kategori=tb_barang.id_kategori
join tb_penjualan on tb_penjualan.id_penjualan=tb_detail_penjualan.id_penjualan
where month(tb_penjualan.tgl)=$inputan_bulan and year(tb_penjualan.tgl)=$inputan_tahun and tb_kategori.nama_kategori='$namakategori'
group by tb_barang.nama_brg
order by sum(tb_detail_penjualan.jumlah) desc");
				
				while($datadrilldown=mysqli_fetch_array($tampung_data))
				{
				?>
					[
					'<?php echo $datadrilldown['nama_brg']; ?>',
					<?php echo $datadrilldown['jumlah']; ?>
					],
				 	
				
          <?php
				};
					?> 
					   ]
			
				
            },
						<?php
			};
						?>
						// selesai series
			
						] 
			
			
        }
    });
});
		</script>
	</head>
	<body>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>
<div class="container-fluid">
	<!-- row -->
	<div class="row">
		<!--col-->
		<div class="col-md-12">
			<h2 class="page-title">Grafik per Kategori</h2>
				<!--form-->
				<form action="" method="post">
      <div class="row clearfix">
       <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
        <div class="form-group">
          <select name="bulan" id="bulan" class="form-control" required>
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
         </div>
       
       </div>
       
      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
        <div class="form-group">
          <select name="tahun" id="tahun" class="form-control" required>
          <option value="">-- pilih tahun --</option>
          <?php 
					$tahun=mysqli_query($db, "SELECT DISTINCT year(tgl) as tahun from tb_penjualan");
					while($rowtahun=mysqli_fetch_array($tahun))
					{
					$datatahun=$rowtahun['tahun'];
        	?>
          <option value="<?php echo $rowtahun['tahun']?> <?php if($datatahun== $inputan_tahun) {echo 'selected';} ?>"><?php echo $datatahun ?></option>
          <?php
					}
					?>
         </select>
         </div>
       
       </div>
      <div class="">
        <input type="submit" class="btn btn-primary btn m-l-15 waves-effect" value="Cari" name="cari">
          <!-- <a  href="javascript:printDiv('cetak_perencanaan');" class="btn btn-success waves-effect">Cetak</a> -->
           </div>
     </div>
     </form>				
				<!-- end form-->
		</div>
		<!-- /col-->
	</div>
	<!-- /row-->
</div>
<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto "></div>

	</body>

