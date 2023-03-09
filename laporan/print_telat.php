<?php
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
$pdf->Cell(25.2,0.7,"Laporan Telat",0,10,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(5,0.7,"\nDi cetak pada : ".date("D-d/m/Y"),0,0,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(2, 0.8, 'NO', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Kode Pinjam', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Nama Anggota', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Tanggal Pinjam', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Jatuh Tempo', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Telat', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Denda', 1, 1, 'C');
$pdf->SetFont('Arial','',10);
$sql=mysql_query("SELECT * from t_pinjam where status='belum lunas' order by kode_pinjam desc");
    $nomer=1;
    while($data=mysql_fetch_array($sql))
    	{
    		$a=$data['tgl_tempo'];$dat=date("Y-m-d");
			if($dat>$a)
			{
			$go=round($telat=((abs(strtotime($dat)-strtotime($a)))/(60*60*24))); $denda=$go * 1000;
				$kd_a=$data['kode_anggota'];
    		$anggota=mysql_fetch_array(mysql_query("SELECT nama_anggota from t_anggota where kode_anggota='$kd_a'"));
    		$kd_j=$data['kode_jenis_pinjam'];
    		$jenis=mysql_fetch_array(mysql_query("SELECT nama_pinjaman from t_jenis_pinjam where kode_jenis_pinjam='$kd_j'"));
$pdf->Cell(2, 0.8, $nomer, 1, 0, 'C');
$pdf->Cell(3, 0.8, $kd_p=$data['kode_pinjam'], 1, 0, 'C');
$pdf->Cell(4, 0.8, $anggota['nama_anggota'], 1, 0, 'C');
$pdf->Cell(4, 0.8, $data['tgl_entri'], 1, 0, 'C');
$pdf->Cell(4, 0.8, $a, 1, 0, 'C');
$pdf->Cell(4, 0.8, $go." Hari", 1, 0, 'C');
$pdf->Cell(3, 0.8, $denda, 1, 1, 'C');
			}
			else
			{
				
			}
    	$nomer++;}
$pdf->Output("Laporan telat.pdf","I");

?>