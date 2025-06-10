<?php
include('../conexion.php');

if (!isset($_GET['id_producto'])) {
    die("ID de producto no especificado");
}

$id = intval($_GET['id_producto']);

$sql = "SELECT * FROM producto WHERE id_producto = $id LIMIT 1";
$resultado = mysqli_query($conn, $sql);

if (!$resultado || mysqli_num_rows($resultado) == 0) {
    die("Producto no encontrado.");
}

$producto = mysqli_fetch_assoc($resultado);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Detalle de Producto</title>
    <link rel="stylesheet" href="../styles/styles_tablas.css">
</head>
<body>
<div class="ContenedorPrincipal">
    <div class="ContenedorTabla">
        <h1>Detalle del Producto</h1>
        
        <div style="margin: 20px; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
            <p><strong>ID:</strong> <?php echo htmlspecialchars($producto['id_producto']); ?></p>
            <p><strong>Nombre:</strong> <?php echo htmlspecialchars($producto['nombre']); ?></p>
            <p><strong>Precio:</strong> $<?php echo htmlspecialchars(number_format($producto['precio'], 0, ',', '.')); ?></p>
            <p><strong>Categoría:</strong> <?php echo htmlspecialchars($producto['categoria']); ?></p>
            <p><strong>Talla:</strong> <?php echo htmlspecialchars($producto['talla']); ?></p>
            <p><strong>Descripción:</strong> <?php echo htmlspecialchars($producto['descripcion']); ?></p>
        </div>
        
        <div style="text-align: center; margin-top: 20px;">
            <a class="BotonesUsuarios" href="producto_tabla.php<?php echo isset($_GET['pag']) ? '?pag=' . intval($_GET['pag']) : ''; ?>">Volver a la lista</a>
            <a class="BotonesUsuarios" href="producto_modificar.php?id_producto=<?php echo $producto['id_producto']; ?>&pag=<?php echo isset($_GET['pag']) ? $_GET['pag'] : 1; ?>">Modificar</a>
        </div>
    </div>
</div>
</body>
</html>