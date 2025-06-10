    <?php
    include('../conexion.php');
    require('../libs/fpdf.php');


    $pdf = new FPDF();
    $pdf->AddPage();

    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, 'Tabla de Usuarios', 0, 1, 'C'); 
    $pdf->Ln(5); 

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetFillColor(200, 220, 255); 
    $pdf->Cell(35, 8, 'Nombre', 1, 0, 'C', true);
    $pdf->Cell(35, 8, 'Apellido', 1, 0, 'C', true);
    $pdf->Cell(50, 8, 'Correo', 1, 0, 'C', true);
    $pdf->Cell(30, 8, 'Telefono', 1, 0, 'C', true);
    $pdf->Cell(40, 8, 'Ubicacion', 1, 1, 'C', true);

    $pdf->SetFont('Arial', '', 10);
    $query = mysqli_query($conn, "SELECT * FROM usuarios ORDER BY nombre DESC");

    while ($row = mysqli_fetch_assoc($query)) {
        $pdf->Cell(35, 8, utf8_decode($row['nombre']), 1);
        $pdf->Cell(35, 8, utf8_decode($row['apellido']), 1);
        $pdf->Cell(50, 8, utf8_decode($row['correo']), 1);
        $pdf->Cell(30, 8, utf8_decode($row['telefono']), 1);
        $pdf->Cell(40, 8, utf8_decode($row['ubicacion']), 1);
        $pdf->Ln();
    }

    $pdf->Output();
    ?>
