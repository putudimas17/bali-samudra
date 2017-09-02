<?php 

$inputan_tahun=@$_POST['tahun'];
$cari=@$_POST['cari'];
if($cari)
{
$tampung_bulan= mysqli_query($db,"select sum(total) as total, monthname(tgl) as bulan from tb_penjualan where year(tgl)='$inputan_tahun' group by month(tgl)");
$tampung_drilldown= mysqli_query($db,"select sum(total) as total, monthname(tgl) as bulan from tb_penjualan where year(tgl)='$inputan_tahun' group by month(tgl)");
	
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
            type: 'column'
        },
        title: {
            text: 'Grafik Penjualan  UD Aditya Tahun '
        },
       
        xAxis: {
            categories: [
             ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'rupiah'
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
            name: 'Penjualan',
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
            type: 'column'
        },
        title: {
            text: '<?php echo "Grafik Penjualan UD Aditya Tahun $inputan_tahun" ?> '
        },
				 subtitle: {
            text: 'Klik bulan untuk per kategori'
        },
      
        xAxis: {
            type: 'category'
        },
        yAxis: {
            title: {
                text: 'jumlah'
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
                    format: 'Rp {point.y:,.0f}'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>Rp {point.y:,.0f}</b><br/>'
        },

        series: [{
            name: 'Penjualan',
            colorByPoint: true,
            data: [
			<?php
			while($row=mysqli_fetch_array($tampung_bulan))
			{
				
				$drilldown=$row['bulan'];
				$penjualan=$row['total'];
			 $penjualan_format = number_format($penjualan,0,",",".");
				
				?>	
						
			{
                name: '<?php echo $row['bulan']; ?>',
                y: <?php echo $penjualan; ?>,
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
			$bulan=$rowdrill['bulan'];
			?>
			{
				
                name: '<?php echo $bulan ?>',
                id: '<?php echo $bulan ?>',
                data:
				
				[
				<?php
				
$tampung_data = mysqli_query($db,"select tb_kategori.nama_kategori, sum(tb_detail_penjualan.subtotal) as harga from tb_detail_penjualan
join tb_penjualan on tb_penjualan.id_penjualan=tb_detail_penjualan.id_penjualan
join tb_barang on tb_barang.kode_brg=tb_detail_penjualan.kode_brg
join tb_kategori on tb_kategori.id_kategori=tb_barang.id_kategori
where monthname(tb_penjualan.tgl)='$bulan' and year(tb_penjualan.tgl)=$inputan_tahun
group by tb_kategori.id_kategori
");
				
				while($datadrilldown=mysqli_fetch_array($tampung_data))
				{
				?>
					[
					'<?php echo $datadrilldown['nama_kategori']; ?>',
					<?php echo $datadrilldown['harga']; ?>
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
			<h2 class="page-title">Grafik Penjualan</h2>
				<!--form-->
				<form action="" method="post">
      <div class="row clearfix">
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

