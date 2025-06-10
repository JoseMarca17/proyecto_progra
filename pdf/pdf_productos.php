<?php
session_start();
require('../conexion.php');
require __DIR__ . '/../libs/fpdf.php';

if (!isset($_SESSION['id_usuario'])) {
    die("Acceso denegado.");
}

$id_admin = $_SESSION['id_usuario'];

// Configuración para filtrar o buscar (puedes adaptarlo)
$where_sql = "WHERE id_admin = $id_admin";

if (isset($_GET['buscar']) && $_GET['buscar'] !== '') {
    $buscar = $conn->real_escape_string(trim($_GET['buscar']));
    $where_sql .= " AND nombre LIKE '%$buscar%'";
}

$sql = "SELECT nombre, precio, categoria, talla, descripcion FROM producto $where_sql ORDER BY nombre DESC";
$result = $conn->query($sql);

// Crear PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,10,'Listado de Productos',0,1,'C');
$pdf->Ln(5);

// Encabezados de tabla
$pdf->SetFont('Arial','B',12);
$pdf->SetFillColor(200,200,200);
$pdf->Cell(50,10,'Nombre',1,0,'C',true);
$pdf->Cell(25,10,'Precio',1,0,'C',true);
$pdf->Cell(40,10,'Categoria',1,0,'C',true);
$pdf->Cell(20,10,'Talla',1,0,'C',true);
$pdf->Cell(55,10,'Descripcion',1,1,'C',true);

// Datos
$pdf->SetFont('Arial','',12);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pdf->Cell(50,8,utf8_decode($row['nombre']),1);
        $pdf->Cell(25,8,number_format($row['precio'],2),1,0,'R');
        $pdf->Cell(40,8,utf8_decode($row['categoria']),1);
        $pdf->Cell(20,8,utf8_decode($row['talla']),1);
        // Para descripción larga la podemos limitar y agregar puntos suspensivos si es necesario
        $desc = strlen($row['descripcion']) > 40 ? substr($row['descripcion'], 0, 37).'...' : $row['descripcion'];
        $pdf->Cell(55,8,utf8_decode($desc),1,1);
    }
} else {
    $pdf->Cell(190,10,'No se encontraron productos.',1,1,'C');
}

// Salida del PDF: se puede descargar o abrir en navegador
$pdf->Output('I', 'productos.pdf');
?>
