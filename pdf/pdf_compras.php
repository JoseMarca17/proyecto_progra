<?php
include('../conexion.php');
require('../libs/fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();

// Título
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'Lista de Compras', 0, 1, 'C');
$pdf->Ln(5);

// Encabezados
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFillColor(200, 220, 255);
$pdf->Cell(25, 8, 'ID', 1, 0, 'C', true);
$pdf->Cell(50, 8, 'Cliente', 1, 0, 'C', true);
$pdf->Cell(50, 8, 'Producto', 1, 0, 'C', true);
$pdf->Cell(30, 8, 'Fecha', 1, 0, 'C', true);
$pdf->Cell(30, 8, 'Total', 1, 1, 'C', true);

// Datos
$pdf->SetFont('Arial', '', 10);
$query = mysqli_query($conn, "SELECT c.*, u.nombre AS cliente_nombre, u.apellido AS cliente_apellido 
                              FROM compra c 
                              JOIN usuarios u ON c.id_cliente = u.id_usuario 
                              ORDER BY c.fecha_compra DESC");

while ($row = mysqli_fetch_assoc($query)) {
    $cliente = utf8_decode($row['cliente_nombre'] . ' ' . $row['cliente_apellido']);
    $pdf->Cell(25, 8, $row['id_compra'], 1);
    $pdf->Cell(50, 8, $cliente, 1);
    $pdf->Cell(50, 8, utf8_decode($row['nombre_producto']), 1);
    $pdf->Cell(30, 8, $row['fecha_compra'], 1);
    $pdf->Cell(30, 8, number_format($row['total'], 2), 1);
    $pdf->Ln();
}

$pdf->Output();
