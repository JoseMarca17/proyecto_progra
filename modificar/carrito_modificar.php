<?php
include('conexion.php');

if (!isset($_GET['id'])) {
    die("ID no especificado");
}

$id = intval($_GET['id']); {

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $producto = mysqli_real_escape_string($conn, $_POST['producto']);
    $id       = floatval($_POST['id']);
    $talla  = mysqli_real_escape_string($conn, $_POST['talla']);
    $cantidad = intval($_POST['cantidad']);
    
    $sql_update = "UPDATE compra_prueba SET 
        producto = '$producto',
        talla= $talla,
        cantidad = '$cantidad',
        total = $total,
        fecha_compra = '$fecha_compra'
        WHERE id = $id";

    if (mysqli_query($conn, $sql_update)) {
        header("Location: carrito.php" . (isset($_GET['pag']) ? '?pag=' . intval($_GET['pag']) : ''));
        exit;
    } else {
        echo "Error al actualizar: " . mysqli_error($conn);
    }
} else {
    $sql = "SELECT * FROM compra_prueba WHERE id = $id LIMIT 1";
    $resultado = mysqli_query($conn, $sql);

    if (!$resultado || mysqli_num_rows($resultado) == 0) {
        die("Compra no encontrada.");
    }

    $compra = mysqli_fetch_assoc($resultado);
}
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Modificar Compra</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <h1>Modificar Compra</h1>
    <form method="POST" action="">
        <label>Producto:</label><br>
        <input type="text" name="producto" value="<?php echo htmlspecialchars($compra['producto']); ?>" required><br><br>
        <label> talla:</label><br>
        <input type="number" step="0.01" name="talla" value="<?php echo htmlspecialchars($compra['talla']); ?>" required><br><br>
        <label>Cantidad:</label><br>
        <input type="number" name="cantidad" value="<?php echo htmlspecialchars($compra['cantidad']); ?>" required><br><br>
           </form>
    <br>
    <a href="carrito.php<?php echo isset($_GET['pag']) ? '?pag=' . intval($_GET['pag']) : ''; ?>">Regresar</a>
</body>
</html>
