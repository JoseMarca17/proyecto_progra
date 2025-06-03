<?php
include('conexion.php');

if (!isset($_GET['id'])) {
    die("ID no especificado");
}

$id = intval($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $producto = mysqli_real_escape_string($conn, $_POST['producto']);
    $precio = floatval($_POST['precio']);
    $cantidad = intval($_POST['cantidad']);
    $talla = mysqli_real_escape_string($conn, $_POST['talla']);
    $total = floatval($_POST['total']);
    $fecha_compra = mysqli_real_escape_string($conn, $_POST['fecha_compra']);
    $sql_update = "UPDATE compra_prueba SET 
        producto = '$producto',
        precio = $precio,
        cantidad = $cantidad,
        talla = '$talla',
        total = $total,
        fecha_compra = '$fecha_compra'
        WHERE id = $id";

    if (mysqli_query($conn, $sql_update)) {
        header("Location: compra_tabla.php" . (isset($_GET['pag']) ? '?pag=' . intval($_GET['pag']) : ''));
        exit;
    } else {
        echo "Error al actualizar: " . mysqli_error($conn);
    }
} else {
    // Obtener datos para mostrar en formulario
    $sql = "SELECT * FROM compra_prueba WHERE id = $id LIMIT 1";
    $resultado = mysqli_query($conn, $sql);

    if (!$resultado || mysqli_num_rows($resultado) == 0) {
        die("Compra no encontrada.");
    }

    $compra = mysqli_fetch_assoc($resultado);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Modificar Compra</title>
</head>
<body>
    <h1>Modificar Compra</h1>
    <form method="POST" action="">
        <label>Producto:</label><br>
        <input type="text" name="producto" value="<?php echo htmlspecialchars($compra['producto']); ?>" required><br><br>

        <label>Precio:</label><br>
        <input type="number" step="0.01" name="precio" value="<?php echo htmlspecialchars($compra['precio']); ?>" required><br><br>

        <label>Cantidad:</label><br>
        <input type="number" name="cantidad" value="<?php echo htmlspecialchars($compra['cantidad']); ?>" required><br><br>

        <label>Talla:</label><br>
        <input type="text" name="talla" value="<?php echo htmlspecialchars($compra['talla']); ?>" required><br><br>

        <label>Total:</label><br>
        <input type="number" step="0.01" name="total" value="<?php echo htmlspecialchars($compra['total']); ?>" required><br><br>

        <label>Fecha de Compra:</label><br>
        <input type="datetime-local" name="fecha_compra" value="<?php 
            echo date('Y-m-d\TH:i', strtotime($compra['fecha_compra']));
        ?>" required><br><br>

        <button type="submit">Guardar Cambios</button>
    </form>
    <br>
    <a href="compra_tabla.php<?php echo isset($_GET['pag']) ? '?pag=' . intval($_GET['pag']) : ''; ?>">Regresar</a>
</body>
</html>
