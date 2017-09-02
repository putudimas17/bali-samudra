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
else if($bln==8) {$nama_bulan='AGUSTRUS';}
else if($bln==9) {$nama_bulan='SEPTEMBER';}
else if($bln==10) {$nama_bulan='OKTOBER';}
else if($bln==11) {$nama_bulan='NOVEMBER';}
else if($bln==12) {$nama_bulan='DESEMBER';}

			$this->pdf->SetFont('Arial','B',13);
		
			$this->pdf->Ln(10);
			$this->pdf->Cell(0,10,'LAPORAN PEMBELIAN PER SUPPLIER UD ADITYA ',0,0,'C');
			$this->pdf->Ln(5);
			$this->pdf->Cell(0,10,' BULAN '.$nama_bulan.' TAHUN '.$_POST['tahun'],0,0,'C');
			$this->pdf->Ln(15);
		}
		
		function CreateReportDetail(){
			
			$this->pdf->SetFont('Arial','B',11);
			$this->pdf->Cell(10,10,'No.','1',0,'C',0); 
			$this->pdf->Cell(25,10,'Tanggal','1',0,'C',0); 
			$this->pdf->Cell(50,10,'Nama Supplier',1,0,'C',0);
			$this->pdf->Cell(60,10,'Nama Barang',1,0,'C',0);
			$this->pdf->Cell(20,10,'Harga',1,0,'C',0);
			$this->pdf->Cell(15,10,'Jml',1,0,'C',0);
			$this->pdf->Cell(20,10,'Subtotal',1,0,'C',0);
	
			$this->pdf->Ln();
			
			$this->pdf->SetFont('Arial', '', 11);
		
			
			
			include "../../koneksi.php";
			if($_POST['tahun']&&$_POST['bulan'])
			{
					$no=1;
			$tahun=$_POST['tahun'];
			$bulan=$_POST['bulan'];
			$query=mysqli_query($db,"SELECT tb_pembelian.tgl, tb_supel.Nama, tb_barang.nama_brg, tb_detail_pembelian.jumlah,tb_detail_pembelian.harga, tb_detail_pembelian.total
from tb_detail_pembelian
join tb_barang on tb_barang.kode_brg=tb_detail_pembelian.kode_brg
join tb_pembelian on tb_pembelian.id_pembelian=tb_detail_pembelian.id_pembelian
join tb_supel on tb_pembelian.id_supel=tb_supel.id
where month(tb_pembelian.tgl)=$bulan and year(tb_pembelian.tgl)=$tahun
order by  tb_pembelian.tgl ");
			$hitungtotal=mysqli_query($db,"SELECT sum(tb_detail_pembelian.total) as total
from tb_detail_pembelian
join tb_pembelian on tb_pembelian.id_pembelian=tb_detail_pembelian.id_pembelian
where month(tb_pembelian.tgl)=$bulan and year(tb_pembelian.tgl)=$tahun"); 
			}
			else
			{
			$tahun=""	;
			$bulan="";
			$query=mysqli_query($db,"SELECT tb_pembelian.tgl, tb_supel.Nama, tb_barang.nama_brg, tb_detail_pembelian.jumlah,tb_detail_pembelian.harga, tb_detail_pembelian.total
from tb_detail_pembelian
join tb_barang on tb_barang.kode_brg=tb_detail_pembelian.kode_brg
join tb_pembelian on tb_pembelian.id_pembelian=tb_detail_pembelian.id_pembelian
join tb_supel on tb_pembelian.id_supel=tb_supel.id
where month(tb_pembelian.tgl)=$bulan and year(tb_pembelian.tgl)=$tahun
order by  tb_pembelian.tgl ");
			 $hitungtotal=mysqli_query($db,"SELECT sum(tb_detail_pembelian.total) as total
from tb_detail_pembelian
join tb_pembelian on tb_pembelian.id_pembelian=tb_detail_pembelian.id_pembelian
where month(tb_pembelian.tgl)=$bulan and year(tb_pembelian.tgl)=$tahun
");
				
				}
			while($pembelian=mysqli_fetch_array($query))
			{
			
			
			$total=$pembelian['total'];
			$total_format = number_format($total,0,",",".");
			$harga=$pembelian['harga'];
			$harga_format = number_format($harga,0,",",".");
			$tgl=$pembelian['tgl'];
		
			$this->pdf->Cell(10,10,$no,'1',0,'C',0); 
			$this->pdf->Cell(25,10,$tgl,'1',0,'L',0); 
			$this->pdf->Cell(50,10,$pembelian['Nama'],1,0,'L',0);
			$this->pdf->Cell(60,10,$pembelian['nama_brg'],1,0,'L',0);
			$this->pdf->Cell(20,10,$harga_format,1,0,'C',0);
			$this->pdf->Cell(15,10,$pembelian['jumlah'],1,0,'C',0);
			$this->pdf->Cell(20,10,$total_format,1,0,'C',0);
		
			$this->pdf->Ln(10);
			$no++;
				/*$this->pdf->Row(array($no++, $row['nama_jns_tk'], 
			$row['total'])); */
			
			}
			while($hitunggrandtotal=mysqli_fetch_array($hitungtotal))
			{
				$hitungpenjualan=$hitunggrandtotal['total'];
				$hitungpenjualan_format = number_format($hitungpenjualan,0,",",".");
			}
			
			$this->pdf->SetFont('Arial','B',14);
			 
			$this->pdf->Cell(145,10,'TOTAL PEMBELIAN SUPPLIER PER BULAN','1',0,'C',0); 
			$this->pdf->Cell(55,10,'Rp '.$hitungpenjualan_format,1,0,'C',0);
	
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
