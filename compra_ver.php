<?php
include('conexion.php');

if (!isset($_GET['id'])) {
    die("ID no especificado");
}

$id = intval($_GET['id']);

$sql = "SELECT * FROM compra_prueba WHERE id = $id LIMIT 1";
$resultado = mysqli_query($conn, $sql);

if (!$resultado || mysqli_num_rows($resultado) == 0) {
    die("Compra no encontrada.");
}

$compra = mysqli_fetch_assoc($resultado);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Detalle de Compra</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <h1>Detalle de la Compra</h1>
    <p><b>Producto:</b> <?php echo htmlspecialchars($compra['producto']); ?></p>
    <p><b>Precio:</b> <?php echo htmlspecialchars($compra['precio']); ?></p>
    <p><b>Cantidad:</b> <?php echo htmlspecialchars($compra['cantidad']); ?></p>
    <p><b>Talla:</b> <?php echo htmlspecialchars($compra['talla']); ?></p>
    <p><b>Total:</b> <?php echo htmlspecialchars($compra['total']); ?></p>
    <p><b>Fecha de Compra:</b> <?php echo htmlspecialchars($compra['fecha_compra']); ?></p>
    
    <a href="compra_tabla.php<?php echo isset($_GET['pag']) ? '?pag=' . intval($_GET['pag']) : ''; ?>">Regresar</a>
</body>
</html>
