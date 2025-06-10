<?php
session_start();
include('../conexion.php');

if (!isset($_SESSION['id_usuario'])) die("Acceso denegado.");

$id_compra = intval($_GET['id_compra'] ?? 0);
if ($id_compra <= 0) die("Compra inválida");

// Consultar compra y pago
$rCompra = $conn->query("SELECT * FROM compra WHERE id_compra = $id_compra AND id_cliente = {$_SESSION['id_usuario']}");
if (!$rCompra || !$compra = $rCompra->fetch_assoc()) die("Compra no autorizada");

$rPago = $conn->query("SELECT * FROM pago WHERE id_compra = $id_compra ORDER BY id_pago DESC LIMIT 1");
$pago = $rPago ? $rPago->fetch_assoc() : null;

// Generar PDF con FPDF (asegúrate de tener la librería instalada y el archivo fpdf.php en tu proyecto)
require __DIR__ . '/../libs/fpdf.php';


$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);

$pdf->Cell(0,10,'Factura de Compra #'.$id_compra,0,1,'C');
$pdf->Ln(10);

$pdf->SetFont('Arial','',12);
$pdf->Cell(40,10,'Cliente: ');
$pdf->Cell(0,10,$_SESSION['nombre_usuario'] ?? 'Desconocido',0,1);

$pdf->Cell(40,10,'Fecha Compra: ');
$pdf->Cell(0,10,$compra['fecha'] ?? '',0,1);

$pdf->Cell(40,10,'Total: ');
$pdf->Cell(0,10,'Bs. '.number_format($compra['total'], 2),0,1);

if ($pago) {
    $pdf->Ln(10);
    $pdf->Cell(0,10,'Datos de Pago',0,1);
    $pdf->Cell(50,10,'Monto Pagado: Bs. '.number_format($pago['monto_pagado'], 2),0,1);
    $pdf->Cell(50,10,'Fecha Pago: '.$pago['fecha_pago'],0,1);
    $pdf->Cell(50,10,'Ubicación Entrega: '.$pago['ubicacion_entrega'],0,1);
    $pdf->Cell(50,10,'Método de Pago: '.$pago['metodo_pago'],0,1);
}

$pdf->Ln(20);
$pdf->Cell(0,10,'Gracias por su compra!',0,1,'C');

// Enviar headers para mostrar PDF inline en navegador
header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename="factura_'.$id_compra.'.pdf"');

// Salida PDF
$pdf->Output('I', 'factura_'.$id_compra.'.pdf');
exit();
