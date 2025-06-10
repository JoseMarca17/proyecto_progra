<?php
session_start();
include('../conexion.php');
include('../header.php');

if (!isset($_SESSION['id_usuario'])) die("Acceso denegado.");

// Obtener ID de la compra desde el parámetro GET
$idcompra = isset($_GET['id']) ? intval($_GET['id']) : 0;
$pagina = isset($_GET['pag']) ? intval($_GET['pag']) : 1;

// Verificar que el ID no sea 0
if ($idcompra <= 0) {
    die("Compra no válida.");
}

// Procesar el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cliente = intval($_POST['id_cliente']);
    $producto = $conn->real_escape_string($_POST['nombre_producto']);
    $fecha = $conn->real_escape_string($_POST['fecha_compra']);
    $total = floatval($_POST['total']);

    $sql = "UPDATE compra SET 
                nombre_producto = '$producto',
                fecha_compra = '$fecha',
                id_cliente = $cliente,
                total = $total
            WHERE id_compra = $idcompra";

    if ($conn->query($sql)) {
        echo "<script>alert('Compra modificada correctamente'); window.location.href='../tablas/compra_tabla.php?pag=$pagina';</script>";
        exit;
    } else {
        echo "<script>alert('Error al modificar: " . $conn->error . "');</script>";
    }
}

// Obtener datos de la compra actual
$query = $conn->query("SELECT * FROM compra WHERE id_compra = $idcompra");
$compra = $query->fetch_assoc();

if (!$compra) {
    die("Compra no encontrada con ID: $idcompra");
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Modificar compra</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
<div class="pagina-login">
    <form method="post" class="FormCajaLogin">
        <h1>Modificar compra #<?= $idcompra ?></h1>

        <label class="TextoCajas">Nombre del Producto:</label>
        <input class="CajaTexto" type="text" name="nombre_producto" value="<?= htmlspecialchars($compra['nombre_producto']) ?>" required>

        <label class="TextoCajas">ID del Cliente:</label>
        <input class="CajaTexto" type="number" name="id_cliente" value="<?= intval($compra['id_cliente']) ?>" required>

        <label class="TextoCajas">Total:</label>
        <input class="CajaTexto" type="number" step="0.01" name="total" value="<?= $compra['total'] ?>" required>

        <label class="TextoCajas">Fecha:</label>
        <input class="CajaTexto" type="date" name="fecha_compra" value="<?= $compra['fecha_compra'] ?>" required>

        <button class="BtnRegistrar">Guardar Cambios</button>
        <a class="BtnRegistrar" href="../tablas/compra_tabla.php?pag=<?= $pagina ?>">Cancelar</a>
    </form>
</div>
</body>
</html>
