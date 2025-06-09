<?php
include('../conexion.php');
    include('../header.php');

if (isset($_POST["btnregistrar"])) {
    $monto_pagado = $_POST["monto_pagado"];
    $fecha_pago = $_POST["fecha_pago"];
    $ubicacion_entrega = $_POST["ubicacion_entrega"];
    $metodo_pago = $_POST["metodo_pago"];

    $sql = "INSERT INTO pago_prueba (monto_pagado, fecha_pago, ubicacion_entrega, metodo_pago) 
            VALUES ('$monto_pagado', '$fecha_pago', '$ubicacion_entrega', '$metodo_pago')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Pago registrado correctamente en tabla de prueba');</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Registrar Pago</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/SISTEMA_PROYECTO/styles/estilopago.css">
</head>
<body>
<div class="FormCajaLogin">
    <div class="FormLogin">
        <form method="post">
            <fieldset>
                <h2>💰 Registrar Pago</h2> 
                <div class="TextoCajas">• Monto pagado</div>
                <input type="number" step="0.01" name="monto_pagado" class="CajaTexto" required>
                <div class="TextoCajas">• Fecha de pago</div>
                <input type="date" name="fecha_pago" class="CajaTexto" required>
                <div class="TextoCajas">• Ubicación de entrega</div>
                <input type="text" name="ubicacion_entrega" class="CajaTexto" required>         
                <div class="TextoCajas">• Método de pago</div>         
                <select name="metodo_pago" class="CajaTexto" required>
                <option value="">Seleccione método </option>
                <option value="Efectivo">Efectivo</option>
                <option value="QR">QR</option>
                <option value="Transferencia">Transferencia</option>
                <option value="Tarjeta">Tarjeta</option>
            </select>

            <br>
            <input type="submit" name="btnregistrar" value="Pagar" class="BtnRegistrar">
            </fieldset>
        </form>
        <br>
        <a href="registrar_compra.php" class="BtnLogin">Ir a registrar compra</a>
        <a href="/SISTEMA_PROYECTO/inicio.php" class="BtnLogin">Volver</a>
    </div>
</div>

</body>
