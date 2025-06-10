<?php
include('../conexion.php');

if (!isset($_GET['id'])) {
    die("ID no especificado");
}

$id = intval($_GET['id']);

$sql = "SELECT * FROM compra WHERE id_compra = $id LIMIT 1";
$resultado = mysqli_query($conn, $sql);

if (!$resultado || mysqli_num_rows($resultado) == 0) {
    die("Compra no encontrada.");
}

$compra = mysqli_fetch_assoc($resultado);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Ver Compra</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <h1>Detalle de Compra</h1>
    <form>
        <label>Producto:</label><br>
        <input type="text" value="<?php echo htmlspecialchars($compra['producto']); ?>" disabled><br><br>

        <label>Precio:</label><br>
        <input type="number" step="0.01" value="<?php echo htmlspecialchars($compra['precio']); ?>" disabled><br><br>

        <label>Cantidad:</label><br>
        <input type="number" value="<?php echo htmlspecialchars($compra['cantidad']); ?>" disabled><br><br>

        <label>Talla:</label><br>
        <input type="text" value="<?php echo htmlspecialchars($compra['talla']); ?>" disabled><br><br>

        <label>Total:</label><br>
        <input type="number" step="0.01" value="<?php echo htmlspecialchars($compra['total']); ?>" disabled><br><br>

        <label>Fecha de Compra:</label><br>
        <input type="datetime-local" value="<?php echo date('Y-m-d\TH:i', strtotime($compra['fecha_compra'])); ?>" disabled><br><br>
    </form>
    <br>
    <a href="compra_tabla.php<?php echo isset($_GET['pag']) ? '?pag=' . intval($_GET['pag']) : ''; ?>">Regresar</a>
</body>
</html>
