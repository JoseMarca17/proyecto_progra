<?php
session_start();
include('../conexion.php');
include('../header.php');

if (!isset($_SESSION['id_usuario'])) {
    die("Acceso denegado.");
}

// Obtener el ID desde GET, coincide con el enlace de la tabla
$idcompra = isset($_GET['id']) ? intval($_GET['id']) : 0;
$pagina = isset($_GET['pag']) ? intval($_GET['pag']) : 1;

if ($idcompra <= 0) {
    die("ID de compra inválido.");
}

// Preparar y ejecutar la consulta segura
$stmt = $conn->prepare("SELECT * FROM compra WHERE id_compra = ?");
$stmt->bind_param("i", $idcompra);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Compra no encontrada.");
}

$compra = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Ver compra</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <div class="pagina-login">
        <form class="FormCajaLogin">
            <h1>Detalle de la compra #<?= $idcompra ?></h1>

            <p class="TextoCajas"><strong>ID Compra:</strong> <?= htmlspecialchars($compra['id_compra']) ?></p>
            <p class="TextoCajas"><strong>ID Cliente:</strong> <?= htmlspecialchars($compra['id_cliente']) ?></p>
            <p class="TextoCajas"><strong>Fecha de compra:</strong> <?= htmlspecialchars($compra['fecha_compra']) ?></p>
            <p class="TextoCajas"><strong>Total:</strong> $<?= number_format($compra['total'], 2) ?></p>
            <p class="TextoCajas"><strong>Nombre Producto:</strong> <?= htmlspecialchars($compra['nombre_producto']) ?></p>

            <a class="BtnRegistrar" href="../tablas/compra_tabla.php?pag=<?= $pagina ?>">Regresar</a>
        </form>
    </div>
</body>
</html>
