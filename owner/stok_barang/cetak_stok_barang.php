
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
	
			$this->pdf->SetFont('Arial','B',13);
		
			$this->pdf->Ln(10);
			$this->pdf->Cell(0,10,'LAPORAN STOK BARANG UD ADITYA ',0,0,'C');
			$this->pdf->Ln(5);
			$this->pdf->Cell(0,10,'Tanggal '.date('d-m-Y'),0,0,'C');
			$this->pdf->Ln(15);
		}
		
		function CreateReportDetail(){
			$this->pdf->Cell(10,5, '',0,0,'C',0); // untuk tabel ditengah
			$this->pdf->SetFont('Arial','B',11);
			$this->pdf->Cell(10,10,'No.','1',0,'C',0); 
			$this->pdf->Cell(45,10,'Kategori','1',0,'C',0); 
			$this->pdf->Cell(75,10,'Nama Barang',1,0,'C',0);
			$this->pdf->Cell(20,10,'Stok',1,0,'C',0);
			$this->pdf->Cell(30,10,'Satuan',1,0,'C',0);
	
			$this->pdf->Ln();
			
			$this->pdf->SetFont('Arial', '', 11);
		
			
			
			include "../../koneksi.php";
			$query=mysqli_query($db,"SELECT tb_kategori.nama_kategori, tb_barang.nama_brg, tb_barang.stok, tb_barang.satuan
from tb_barang 
join tb_kategori on tb_kategori.id_kategori=tb_barang.id_kategori 
order by tb_kategori.nama_kategori");
				
			
			$no=1;	
			while($kategori=mysqli_fetch_array($query))
			{
			
			$nama_kategori=$kategori['nama_kategori'];
			$nama_brg = $kategori['nama_brg'];
			$stok = $kategori['stok'];
			$satuan = $kategori['satuan'];
			
		
			$this->pdf->SetFont('Arial','',11);
			$this->pdf->Cell(10,5,'',0,0,'C',0);
			$this->pdf->Cell(10,10,$no,1,0,'C',0); 
			$this->pdf->Cell(45,10,$nama_kategori,1,0,'L',0); 
			$this->pdf->Cell(75,10,$nama_brg,1,0,'L',0);
			$this->pdf->Cell(20,10,$stok,1,0,'C',0);
			$this->pdf->Cell(30,10,$satuan,1,0,'C',0);
		
			$this->pdf->Ln(10);
			$no++;
				/*$this->pdf->Row(array($no++, $row['nama_jns_tk'], 
			$row['total'])); */
			
			}
			
			
			
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
