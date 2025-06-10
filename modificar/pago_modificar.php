<?php
session_start();
include('../conexion.php');
include('../header.php');

if (!isset($_SESSION['id_usuario'])) die("Acceso denegado.");

$id_pago = intval($_GET['id_pago'] ?? 0);
$pagina = $_GET['pag'] ?? 1;

if ($id_pago <= 0) die("ID de pago inválido.");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $monto = floatval($_POST['monto_pagado']);
    $fecha = $_POST['fecha_pago'];
    $ubicacion = $conn->real_escape_string($_POST['ubicacion_entrega']);
    $metodo = $conn->real_escape_string($_POST['metodo_pago']);

    $sql = "UPDATE pago SET 
                monto_pagado = $monto,
                fecha_pago = '$fecha',
                ubicacion_entrega = '$ubicacion',
                metodo_pago = '$metodo'
            WHERE id_pago = $id_pago";

    if ($conn->query($sql)) {
        echo "<script>alert('Pago modificado correctamente'); window.location.href='../indice_tablas.php?pag=$pagina';</script>";
        exit;
    } else {
        echo "<script>alert('Error al modificar: " . $conn->error . "');</script>";
    }
}

$query = $conn->query("SELECT * FROM pago WHERE id_pago = $id_pago");
$pago = $query->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Modificar Pago</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
<div class="pagina-login">
    <form method="post" class="FormCajaLogin">
        <h1>Modificar Pago #<?= $id_pago ?></h1>

        <label class="TextoCajas">Monto:</label>
        <input class="CajaTexto" type="number" step="0.01" name="monto_pagado" value="<?= $pago['monto_pagado'] ?>" required>

        <label class="TextoCajas">Fecha:</label>
        <input class="CajaTexto" type="date" name="fecha_pago" value="<?= $pago['fecha_pago'] ?>" required>

        <label class="TextoCajas">Ubicación:</label>
        <input class="CajaTexto" type="text" name="ubicacion_entrega" value="<?= htmlspecialchars($pago['ubicacion_entrega']) ?>" required>

        <label class="TextoCajas">Método:</label>
        <select class="CajaTexto" name="metodo_pago" required>
            <?php
            $metodos = ['Efectivo', 'QR', 'Transferencia', 'Tarjeta'];
            foreach ($metodos as $m) {
                $selected = ($pago['metodo_pago'] === $m) ? 'selected' : '';
                echo "<option $selected>$m</option>";
            }
            ?>
        </select>

        <button class="BtnRegistrar">Guardar Cambios</button>
        <a class="BtnRegistrar" href="../tabla/pago_tabla.php?pag=<?= $pagina ?>">Cancelar</a>
    </form>
</div>
</body>
</html>
