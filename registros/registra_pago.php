<?php
session_start();
include('../conexion.php');
include('../header.php');

if (!isset($_SESSION['id_usuario'])) die("Acceso denegado.");

$id_compra = intval($_GET['id_compra'] ?? 0);
if ($id_compra <= 0) die("Compra inválida");

$r = $conn->query("SELECT * FROM compra WHERE id_compra = $id_compra AND id_cliente = {$_SESSION['id_usuario']}");
if (!$r || !$compra = $r->fetch_assoc()) die("Compra no autorizada");

$total = floatval($compra['total']);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnregistrar'])) {
    $monto = floatval($_POST['monto_pagado']);
    $fecha = $_POST['fecha_pago'];
    $ubi = $conn->real_escape_string($_POST['ubicacion_entrega']);
    $met = $conn->real_escape_string($_POST['metodo_pago']);

    if ($monto < $total) {
        echo "<script>alert('El monto no puede ser menor al total');</script>";
    } else {
        $sql = "
          INSERT INTO pago (id_compra, monto_pagado, fecha_pago, ubicacion_entrega, metodo_pago, estado)
          VALUES (
            $id_compra,
            $monto,
            '$fecha',
            '$ubi',
            '$met',
            'pagado'
          )";
        if ($conn->query($sql)) {
            // Redirigir directamente a la factura para que el navegador la muestre en la misma ventana
            header("Location: ../pdf/pdf_factura.php?id_compra=$id_compra");
            exit();
        } else {
            echo "<script>alert('Error al registrar pago: " . $conn->error . "');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Registrar Pago</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <div class="pagina-login">
        <form method="post" class="FormCajaLogin">
            <h1>Registrar pago de la compra #<?= $id_compra ?></h1>

            <p class="TextoCajas">Total a pagar: Bs. <?= number_format($total, 2) ?></p>

            <label class="TextoCajas" for="monto_pagado">Monto cancelado:</label>
            <input
                type="number"
                step="0.01"
                name="monto_pagado"
                id="monto_pagado"
                value="<?= number_format($total, 2, '.', '') ?>"
                min="<?= number_format($total, 2, '.', '') ?>"
                required
                class="CajaTexto">

            <label class="TextoCajas" for="fecha_pago">Fecha de pago:</label>
            <input
                type="date"
                name="fecha_pago"
                id="fecha_pago"
                value="<?= date('Y-m-d') ?>"
                required
                class="CajaTexto">

            <label class="TextoCajas" for="ubicacion_entrega">Ubicación entrega:</label>
            <input
                type="text"
                name="ubicacion_entrega"
                id="ubicacion_entrega"
                required
                class="CajaTexto">

            <label class="TextoCajas" for="metodo_pago">Método:</label>
            <select name="metodo_pago" id="metodo_pago" required class="CajaTexto">
                <option>Efectivo</option>
                <option>QR</option>
                <option>Transferencia</option>
                <option>Tarjeta</option>
            </select>

            <button name="btnregistrar" class="BtnRegistrar">Confirmar Pago</button>
        </form>
    </div>
</body>
</html>
