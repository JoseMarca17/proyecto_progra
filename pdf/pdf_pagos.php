<?php
include('../conexion.php');
require('../libs/fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();

// Título
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'Lista de Pagos', 0, 1, 'C');
$pdf->Ln(5);

// Encabezado
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFillColor(200, 220, 255);
$pdf->Cell(25, 8, 'ID Pago', 1, 0, 'C', true);
$pdf->Cell(35, 8, 'Monto', 1, 0, 'C', true);
$pdf->Cell(40, 8, 'Fecha', 1, 0, 'C', true);
$pdf->Cell(50, 8, 'Ubicacion', 1, 0, 'C', true);
$pdf->Cell(40, 8, 'Metodo Pago', 1, 1, 'C', true);

// Datos
$pdf->SetFont('Arial', '', 10);
$query = mysqli_query($conn, "SELECT * FROM pago ORDER BY fecha_pago DESC");

while ($row = mysqli_fetch_assoc($query)) {
    $pdf->Cell(25, 8, $row['id_pago'], 1);
    $pdf->Cell(35, 8, number_format($row['monto_pagado'], 2), 1);
    $pdf->Cell(40, 8, $row['fecha_pago'], 1);
    $pdf->Cell(50, 8, utf8_decode($row['ubicacion_entrega']), 1);
    $pdf->Cell(40, 8, utf8_decode($row['metodo_pago']), 1);
    $pdf->Ln();
}

$pdf->Output();
?>
