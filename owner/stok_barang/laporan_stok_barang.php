<?php  
     
require('../fpdf/fpdf.php');

	class PrintLaporanSptPDF{
		
		function __construct() {
			$this->pdf=new FPDF();
			$this->pdf->AddPage('P', 'Legal');
		}
		
			function CreateReportkop(){
			//Logo
		$this->pdf->Image('../images/logo.jpg',8,4);
		//Arial bold 15
		$this->pdf->SetFont('Arial','B',15);
		$this->pdf->Cell(80);
		$this->pdf->Cell(40,0,'PEMERINTAH PROVINSI BALI',0,0,'C');
		$this->pdf->Ln();
		$this->pdf->Cell(80);
		$this->pdf->Cell(40,12,'DINAS KESEHATAN',0,0,'C');
		$this->pdf->Ln(10);
		$this->pdf->SetFont('Arial','BI',11);
		$this->pdf->Cell(80);
		$this->pdf->Cell(40,5,'Alamat: Jalan Melati No. 20 Denpasar, Bali, Indonesia 80236',0,0,'C');
		$this->pdf->Ln();
		$this->pdf->SetFont('Arial','BI',11);
		$this->pdf->Cell(80);
		$this->pdf->Cell(40,5,'Telp/Fax (0361) 222412 / 234922, e-mail: admin.diskes@baliprov.go.id',0,0,'C');
		
		
			$this->pdf->Ln();
			
		
			$this->pdf->Line(10,35,205,35); //buat garis
			$this->pdf->Line(10,35.2,205,35.2); //buat garis
			$this->pdf->Line(10,35.4,205,35.4); //buat garis
			$this->pdf->Ln(0);
		}
		
		
		function CreateReportHeader(){
			$this->pdf->SetFont('Arial','B',13);
		
			$this->pdf->Ln(10);
			$this->pdf->Cell(0,10,'LAPORAN JUMLAH TENAGA KESEHATAN PUSKESMAS PROVINSI BALI TAHUN '.$_GET['tahun'],0,0,'C');
			$this->pdf->Ln(15);
		}
		
		function CreateReportDetail(){
			$this->pdf->Cell(35,5, '',0,0,'C',0); // untuk tabel ditengan
			$this->pdf->SetFont('Arial','B',11);
			$this->pdf->Cell(10,10,'No.','1',0,'C',0); 
			$this->pdf->Cell(80,10,'Nama Tenaga Kesehatan','1',0,'C',0); 
			$this->pdf->Cell(30,10,'Jumlah',1,0,'C',0);
			$this->pdf->Ln();
			
			$this->pdf->SetFont('Arial', '', 11);
		
			
			
			include "../koneksi.php";
			$link = new mysqli("localhost", "root", "", "sie");
			$kadis="";
			$kadis=$link -> query("SELECT * FROM tb_user where Level=owner");
			$result = "";
			if($_GET['tahun'])
			{
				$no=1;
			$inputan_tahun=$_GET['tahun'];
				$result=$link -> query("SELECT tb_jns_tenaga_kes.nama_jns_tk, SUM(tb_tenagakesehatan_puskesmas.total_tkp) as total from tb_tenagakesehatan_puskesmas 
join tb_jns_tenaga_kes on tb_tenagakesehatan_puskesmas.id_jns_tk=tb_jns_tenaga_kes.id_jns_tk
where tb_tenagakesehatan_puskesmas.tahun=$inputan_tahun GROUP by tb_tenagakesehatan_puskesmas.id_jns_tk");
			}
			else
			{
				$result = $link-> query("SELECT tb_jns_tenaga_kes.nama_jns_tk, SUM(tb_tenagakesehatan_puskesmas.total_tkp) as total from tb_tenagakesehatan_puskesmas 
join tb_jns_tenaga_kes on tb_tenagakesehatan_puskesmas.id_jns_tk=tb_jns_tenaga_kes.id_jns_tk
where tb_tenagakesehatan_puskesmas.tahun=0000 GROUP by tb_tenagakesehatan_puskesmas.id_jns_tk");
			}
			
			while($row=mysqli_fetch_array($result))
			{				
			$nama_jns_tk=$row['nama_jns_tk'];
			$total=$row['total'];
			$this->pdf->SetFont('Arial','',11);
			$this->pdf->Cell(35,5, '',0,0,'C',0);
			$this->pdf->Cell(10,10,$no.'.','1',0,'C',0); 
			$this->pdf->Cell(80,10,$nama_jns_tk,'1',0,'L',0); 
			$this->pdf->Cell(30,10,$total,1,0,'C',0);
			$this->pdf->Ln(10);
			$no++;			
			}
			
		}
		
		function CreateReportFooter(){
			include "../koneksi.php";
			$link = new mysqli("localhost", "root", "", "aditya");
			$kadis="";
			$kadis=$link -> query("SELECT * FROM tb_user where Level='owner'");
			while($r=mysqli_fetch_array($kadis))
			{
				$nama_kadis=$r['Nama'];
				}
			
			$this->pdf->SetFont('ARIAL','',11);
		
			$this->pdf->Ln(25);
			$this->pdf->Cell(100,5, '',0,0,'C',0);
			$this->pdf->Cell(100,5, 'Kepala Dinas Kesehatan',0,0,'C',0);	
			$this->pdf->Ln(5);
			$this->pdf->Cell(300,5, 'Provinsi Bali',0,0,'C',0);	
			$this->pdf->Ln(20);
			
			$this->pdf->SetFont('ARIAL','BU',11);
		
			$this->pdf->Cell(100,5, '',0,0,'C',0);
			$this->pdf->Cell(100,5, $nama_kadis, '0','0','C','0');
			
			$this->pdf->Ln();
			
			$this->pdf->SetFont('ARIAL','',11);
		
			$this->pdf->Cell(100,5, '',0,0,'C',0);
			$this->pdf->Cell(100,5, $nip, '0','0','C','0');	
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

