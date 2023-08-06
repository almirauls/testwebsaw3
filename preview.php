<?php

include "config.php";
require('fpdf/fpdf.php');

    // ambil data dari input
    $tgl_jadwal=$_POST["tgl_jadwal"];


class PDF extends FPDF
{
	// page footer
	function Footer()
	{
		//atur posisi 1.5 cm dari bawah
		$this->SetY(-1);

		//Arial italic 9
		$this->SetFont('Arial','I',9);

		//nomor halaman
		$this->Cell(0,0.8,'Halaman '.$this->PageNo().' dari {nb}',0,0,'C');
	}
}

$pdf = new PDF('P','cm','A4');
$pdf->SetMargins(1,2,1);
$pdf->AliasNbPages();
$pdf->AddPage();

    // JUDUL HEADER
    $pdf->SetFont('Arial','B',11);
    $pdf->Cell(19,0.5,'JADWAL KEGIATAN MAINTENANCE',0,1,'C');
    $pdf->Cell(19,0.5,'Alat-alat Berat (A2B), Bandar Udara SAMS Sepinggan Balikpapan',0,1,'C');

    // JUDUL TABEL
    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(1,0.8,'No',1,0,'L');
    $pdf->Cell(2,0.8,'ID Aset',1,0,'L');
    $pdf->Cell(6,0.8,'Nama Aset',1,0,'L');
    $pdf->Cell(2,0.8,'Unit',1,0,'L');
    $pdf->Cell(2,0.8,'P. Jawab',1,0,'L');
    $pdf->Cell(2,0.8,'Teknisi',1,0,'L');
    $pdf->Cell(2,0.8,'Tanggal',1,0,'L');
    $pdf->Cell(2,0.8,'Status',1,1,'L');

    // ISI TABEL
    $pdf->SetFont('Arial','',9);

        $i=1;
        // if(isset($_SESSION['tgl_jadwal']) && !empty($_SESSION['tgl_jadwal'])){
        // $tgl_jadwal=$_SESSION["tgl_jadwal"];
        $sql = "SELECT penjadwalan.id_aset, perangkingan.id_perangkingan, aset.nama_aset, penjadwalan.unit, perangkingan.pj,perangkingan.teknisi,perangkingan.tgl_maintenance,perangkingan.status
                FROM perangkingan 
                INNER JOIN penjadwalan 
                ON perangkingan.id_jadwal=penjadwalan.id_jadwal 
                INNER JOIN aset 
                ON aset.id_aset=penjadwalan.id_aset 
                WHERE perangkingan.tgl_jadwal = '".$tgl_jadwal."'
                ORDER BY preferensi DESC";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()) {

        $pdf->Cell(1,0.8,$i++,1,0,'L');
        $pdf->Cell(2,0.8,$row['id_aset'],1,0,'L');
        $pdf->Cell(6,0.8,$row['nama_aset'],1,0,'L');
        $pdf->Cell(2,0.8,$row['unit'],1,0,'L');
        $pdf->Cell(2,0.8,$row['pj'],1,0,'L');
        $pdf->Cell(2,0.8,$row['teknisi'],1,0,'L');
        $pdf->Cell(2,0.8,$row['tgl_maintenance'],1,0,'L');
        $pdf->Cell(2,0.8,$row['status'],1,1,'L');
    }
                    
    $pdf->Output("cetak_jadwal.pdf","I");
    exit;
?>