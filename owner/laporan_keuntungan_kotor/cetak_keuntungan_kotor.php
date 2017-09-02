<?php  
 function TanggalIndo($date){
	$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
 
	$tahun = substr($date, 0, 4);
	$bulan = substr($date, 5, 2);
	$tgl   = substr($date, 8, 2);
 
	$result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;		
	return($result);
}
    
require('../../fpdf/fpdf.php');



	class PrintLaporanSptPDF{
		
		function __construct() {
			$this->pdf=new FPDF();
			$this->pdf->AddPage('P', 'Legal');
		}
		
			function CreateReportkop(){
			//Logo
		$this->pdf->Image('../../img/logo_aditya.png',15,4);
		//Arial bold 15
		$this->pdf->SetFont('Arial','B',15);
		$this->pdf->Cell(80);
		$this->pdf->Cell(40,0,'UD ADITYA',0,0,'C');
		$this->pdf->Ln();
		$this->pdf->Ln(5);
		$this->pdf->SetFont('Arial','BI',11);
		$this->pdf->Cell(80);
		$this->pdf->Cell(40,5,'Alamat: Jalan Raya Apuan, Senganan, Tabanan, Bali',0,0,'C');
		$this->pdf->Ln();
		$this->pdf->SetFont('Arial','BI',11);
		$this->pdf->Cell(80);
		$this->pdf->Cell(40,5,'Telp : 081338386102 / e-mail: info@ud.aditya.id',0,0,'C');
		
		
			$this->pdf->Ln();
			
		
			$this->pdf->Line(10,30,205,30); //buat garis
			$this->pdf->Line(10,30.2,205,30.2); //buat garis
			$this->pdf->Line(10,30.4,205,30.4); //buat garis
			$this->pdf->Ln(0);
		}
		
		
		function CreateReportHeader(){
	include "../../koneksi.php";
	$bln=$_POST['bulan'];
if($bln==1) {$nama_bulan='JANUARI';}
else if($bln==2) {$nama_bulan='FEBRUARI';}
else if($bln==3) {$nama_bulan='MARET';}
else if($bln==4) {$nama_bulan='APRIL';}
else if($bln==5) {$nama_bulan='MEI';}
else if($bln==6) {$nama_bulan='JUNI';}
else if($bln==7) {$nama_bulan='JULI';}
else if($bln==8) {$nama_bulan='AGUSTUS';}
else if($bln==9) {$nama_bulan='SEPTEMBER';}
else if($bln==10) {$nama_bulan='OKTOBER';}
else if($bln==11) {$nama_bulan='NOVEMBER';}
else if($bln==12) {$nama_bulan='DESEMBER';}

			$this->pdf->SetFont('Arial','B',13);
		
			$this->pdf->Ln(10);
			$this->pdf->Cell(0,10,'LAPORAN KEUNTUNGAN KOTOR UD ADITYA ',0,0,'C');
			$this->pdf->Ln(5);
			$this->pdf->Cell(0,10,' BULAN '.$nama_bulan.' TAHUN '.$_POST['tahun'],0,0,'C');
			$this->pdf->Ln(15);
		}
		
		function CreateReportDetail(){
			$this->pdf->Cell(40,5, '',0,0,'C',0); // untuk tabel ditengah
			$this->pdf->SetFont('Arial','B',11);
			$this->pdf->Cell(10,10,'No.','1',0,'C',0); 
			$this->pdf->Cell(55,10,'Tanggal','1',0,'C',0); 
			$this->pdf->Cell(45,10,'Keuntungan',1,0,'C',0);
	
			$this->pdf->Ln();
			
			$this->pdf->SetFont('Arial', '', 11);
		
			
			
			include "../../koneksi.php";
			if($_POST['tahun']&&$_POST['bulan'])
			{
					$no=1;
			$tahun=$_POST['tahun'];
			$bulan=$_POST['bulan'];
			$query=mysqli_query($db,"select  tb_penjualan.tgl, 
sum(tb_detail_penjualan.subtotal-(tb_barang.harga_beli*tb_detail_penjualan.jumlah)) as keuntungan
from tb_detail_penjualan
join tb_barang on tb_barang.kode_brg=tb_detail_penjualan.kode_brg
join tb_penjualan on tb_penjualan.id_penjualan=tb_detail_penjualan.id_penjualan
where month(tb_penjualan.tgl)=$bulan and year(tb_penjualan.tgl)=$tahun
group by tb_penjualan.tgl");
			$hitungkeuntungan=mysqli_query($db,"select  tb_penjualan.tgl, 
sum(tb_detail_penjualan.subtotal-(tb_barang.harga_beli*tb_detail_penjualan.jumlah)) as keuntungan
from tb_detail_penjualan
join tb_barang on tb_barang.kode_brg=tb_detail_penjualan.kode_brg
join tb_penjualan on tb_penjualan.id_penjualan=tb_detail_penjualan.id_penjualan
where month(tb_penjualan.tgl)=$bulan and year(tb_penjualan.tgl)=$tahun"); 
			}
			else
			{
			$tahun=""	;
			$bulan="";
			$query=mysqli_query($db,"select  tb_penjualan.tgl, 
sum(tb_detail_penjualan.subtotal-(tb_barang.harga_beli*tb_detail_penjualan.jumlah)) as keuntungan
from tb_detail_penjualan
join tb_barang on tb_barang.kode_brg=tb_detail_penjualan.kode_brg
join tb_penjualan on tb_penjualan.id_penjualan=tb_detail_penjualan.id_penjualan
where month(tb_penjualan.tgl)=$bulan and year(tb_penjualan.tgl)=$tahun
group by tb_penjualan.tgl");
			 $hitungkeuntungan=mysqli_query($db,"select  tb_penjualan.tgl, 
sum(tb_detail_penjualan.subtotal-(tb_barang.harga_beli*tb_detail_penjualan.jumlah)) as keuntungan
from tb_detail_penjualan
join tb_barang on tb_barang.kode_brg=tb_detail_penjualan.kode_brg
join tb_penjualan on tb_penjualan.id_penjualan=tb_detail_penjualan.id_penjualan
where month(tb_penjualan.tgl)=$bulan and year(tb_penjualan.tgl)=$bulan");
				
				}
			while($keuntungan=mysqli_fetch_array($query))
			{
			
			
			$untung=$keuntungan['keuntungan'];
			$untung_format = number_format($untung,0,",",".");
			$tgl=$keuntungan['tgl'];
		
			$this->pdf->SetFont('Arial','',11);
			$this->pdf->Cell(40,5,'',0,0,'C',0);
			$this->pdf->Cell(10,10,$no,1,0,'C',0); 
			$this->pdf->Cell(55,10,TanggalIndo($tgl),1,0,'C',0); 
			$this->pdf->Cell(45,10,'Rp '.$untung_format,1,0,'C',0);
		
			$this->pdf->Ln(10);
			$no++;
				/*$this->pdf->Row(array($no++, $row['nama_jns_tk'], 
			$row['total'])); */
			
			}
			
			
			
			while($hitunggrandkeuntungan=mysqli_fetch_array($hitungkeuntungan))
			{
				$hitungkeuntungan2=$hitunggrandkeuntungan['keuntungan'];
				$hitungkeuntungan_format = number_format($hitungkeuntungan2,0,",",".");
			}
			$this->pdf->Cell(40,5, '',0,0,'C',0); // untuk tabel ditengah
			$this->pdf->SetFont('Arial','B',11);
			 
			$this->pdf->Cell(65,10,'TOTAL','1',0,'C',0); 
			$this->pdf->Cell(45,10,'Rp '.$hitungkeuntungan_format,1,0,'C',0);
			
			$this->pdf->Ln();
			$this->pdf->Ln(10);
				
			
			
		}
		
		function CreateReportFooter()
		{
			
		}
		
		function PrintReport(){
			
			$this->pdf->Output(/*'laporan jumlah tenaga kesehatan Provinsi Bali tahun '. $_GET['tahun'].'.pdf','D' */);
			close();
		}
	}
	
	$printToPdf = new PrintLaporanSptPDF();
	$printToPdf->CreateReportKop();
	$printToPdf->CreateReportHeader();
	$printToPdf->CreateReportDetail();
	$printToPdf->CreateReportFooter();
	$printToPdf->PrintReport();
	
?>
