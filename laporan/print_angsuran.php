
<?php
$kode=$_GET['kode_anggota'];
$kode_pinjam=$_GET['kode_pinjam'];
include "../config/koneksi.php";

require('pdf/fpdf.php');
$pdf = new FPDF("L","cm","A4");
$pdf->SetMargins(2,1,1);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','B',11);
$pdf->MultiCell(19.5,0.5,'',0,'L'); 
$pdf->SetX(4);      
$pdf->SetFont('Times','B',18);
$pdf->SetX(4);
$pdf->Image('../logo_kop.GIF',2,1.3,2,1.6);
$pdf->SetX(11); 
$pdf->MultiCell(19.5,0.5,'   KOPERASI KARYAWAN ',0,'L');
$pdf->SetX(8); 
$pdf->SetFont('Times','',14);
$pdf->MultiCell(19.5,0.5,'  PT PELABUHAN INDONESIA II (PERSERO) CABANG CIREBON',0,'L');
$pdf->SetFont('Times','B',20);
$pdf->SetX(13); 
$pdf->MultiCell(19.5,0.5,'  " PUSAKA "',0,'L');
$pdf->SetX(9);
$pdf->SetFont('Times','B',14);
$pdf->MultiCell(19.5,0.5,'  Jln.Perniagaan No. 4 Telp. (0231) 240109 Pelabuhan Cirebon',0,'L');
$pdf->SetX(7);
$pdf->MultiCell(19.5,0.5,'  (Badan Hukum No. 7349/BH/PAD/KKPKM/1/2003 Tanggal 30 Januari 2003)',0,'L');
$pdf->SetX(11);
$pdf->MultiCell(19.5,0.5,'  NPWP  : No.01.150.128.5.426.000 ',0,'L');
$pdf->Line(1,5.3,28.10,5.3);
$pdf->SetLineWidth(0.1);      
$pdf->Line(1,5.4,28.10,5.4);   
$pdf->SetLineWidth(0);
$pdf->ln(1);
$pdf->SetFont('Arial','B',14);
$angg=mysql_fetch_array(mysql_query("SELECT nama_anggota from t_anggota where kode_anggota='$kode'"));
$pdf->Cell(25.2,0.7,"Laporan Angsuran ".$angg['nama_anggota']."",0,10,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(5,0.7,"\nDi cetak pada : ".date("D-d/m/Y"),0,0,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(2, 0.8, 'NO', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Kode Angsuran', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Kode Pinjam', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Tanggal Angsuran', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Angsuran Ke', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Besar Angsuran', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Keterangan', 1, 1, 'C');
$pdf->SetFont('Arial','',10);
$no=1;
$q=mysql_query("SELECT*from t_angsur where kode_pinjam='$kode_pinjam' AND kode_anggota='$kode'");
while($ang=mysql_fetch_array($q)){
$pdf->Cell(2, 0.8, $no, 1, 0, 'C');
$pdf->Cell(3, 0.8, $ang['kode_angsur'], 1, 0, 'C');
$pdf->Cell(4, 0.8, $l=$ang['kode_pinjam'], 1, 0, 'C');
$pdf->Cell(4, 0.8, $ang['tgl_entri'], 1, 0, 'C');
$pdf->Cell(4, 0.8, $ang['angsuran_ke'], 1, 0, 'C');
$pdf->Cell(4, 0.8, number_format($ang['besar_angsuran']), 1, 0, 'C');
$pdf->Cell(4, 0.8, "-", 1, 1, 'C');

$no++;}
$pdf->Output("Laporan Angsuran.pdf","I");

?>

