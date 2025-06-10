<?php
session_start();
include('../conexion.php');
include('../header.php');

if (!isset($_SESSION['id_usuario'])) {
    die("Acceso denegado.");
}

$id_pago = intval($_GET['id_pago'] ?? 0);  
$pagina = $_GET['pag'] ?? 1;

if ($id_pago <= 0) {
    die("ID de pago inválido.");
}

$stmt = $conn->prepare("SELECT * FROM pago WHERE id_pago = ?");
$stmt->bind_param("i", $id_pago);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Pago no encontrado.");
}

$pago = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Ver Pago</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <div class="pagina-login">
        <form class="FormCajaLogin">
            <h1>Detalle del Pago</h1>

            <p class="TextoCajas"><strong>ID Pago:</strong> <?= htmlspecialchars($pago['id_pago']) ?></p>
            <p class="TextoCajas"><strong>Monto Pagado:</strong> Bs. <?= number_format($pago['monto_pagado'], 2) ?></p>
            <p class="TextoCajas"><strong>Fecha de Pago:</strong> <?= htmlspecialchars($pago['fecha_pago']) ?></p>
            <p class="TextoCajas"><strong>Ubicación de Entrega:</strong> <?= htmlspecialchars($pago['ubicacion_entrega']) ?></p>
            <p class="TextoCajas"><strong>Método de Pago:</strong> <?= htmlspecialchars($pago['metodo_pago']) ?></p>
            <p class="TextoCajas"><strong>Estado:</strong> <?= htmlspecialchars($pago['estado']) ?></p>

            <a class="BtnRegistrar" href="../tabla/pago_tabla.php?pag=<?= intval($pagina) ?>">Regresar</a>
        </form>
    </div>
</body>
</html>
