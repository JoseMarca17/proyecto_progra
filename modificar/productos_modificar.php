
<?php
include('../conexion.php');

// Obtener datos actuales
if (isset($_GET['id_producto'])) {
    $id = intval($_GET['id_producto']);
    $sql = "SELECT * FROM producto WHERE id_producto = $id LIMIT 1";
    $resultado = mysqli_query($conn, $sql);
    $producto = mysqli_fetch_assoc($resultado);
}

// Procesar actualización
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = intval($_POST['id_producto']);
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $precio = floatval($_POST['precio']);
    $categoria = mysqli_real_escape_string($conn, $_POST['categoria']);
    $talla = mysqli_real_escape_string($conn, $_POST['talla']);
    $descripcion = mysqli_real_escape_string($conn, $_POST['descripcion']);

    $sql = "UPDATE producto SET 
            nombre = '$nombre',
            precio = $precio,
            categoria = '$categoria',
            talla = '$talla',
            descripcion = '$descripcion'
            WHERE id_producto = $id";

    if (mysqli_query($conn, $sql)) {
        $pagina = isset($_GET['pag']) ? intval($_GET['pag']) : 1;
        header("Location: ../tablas/producto_tabla.php?pag=$pagina&success=1");
        exit();
    } else {
        die("Error al actualizar: " . mysqli_error($conn));
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Modificar Producto</title>
    <link rel="stylesheet" href="../styles/styles_tablas.css">
</head>
<body>
<div class="ContenedorPrincipal">
    <div class="ContenedorTabla">
        <h1>Modificar Producto</h1>
        
        <form method="POST" action="">
            <input type="hidden" name="id_producto" value="<?php echo $producto['id_producto']; ?>">
            
            <div style="margin: 20px; background: white; padding: 20px; border-radius: 8px;">
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px;"><strong>Nombre:</strong></label>
                    <input class="CajaTexto" type="text" name="nombre" value="<?php echo htmlspecialchars($producto['nombre']); ?>" required style="width: 100%;">
                </div>
                
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px;"><strong>Precio:</strong></label>
                    <input class="CajaTexto" type="number" name="precio" step="0.01" value="<?php echo htmlspecialchars($producto['precio']); ?>" required style="width: 100%;">
                </div>
                
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px;"><strong>Categoría:</strong></label>
                    <input class="CajaTexto" type="text" name="categoria" value="<?php echo htmlspecialchars($producto['categoria']); ?>" required style="width: 100%;">
                </div>
                
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px;"><strong>Talla:</strong></label>
                    <input class="CajaTexto" type="text" name="talla" value="<?php echo htmlspecialchars($producto['talla']); ?>" required style="width: 100%;">
                </div>
                
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px;"><strong>Descripción:</strong></label>
                    <textarea class="CajaTexto" name="descripcion" style="width: 100%; height: 100px;"><?php echo htmlspecialchars($producto['descripcion']); ?></textarea>
                </div>
                
                <div style="text-align: center; margin-top: 20px;">
                    <input class="BotonesUsuarios" type="submit" value="Guardar Cambios">
                    <a class="BotonesUsuarios" href="../tablas/producto_tabla.php<?php echo isset($_GET['pag']) ? '?pag=' . intval($_GET['pag']) : ''; ?>">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
</div>
</body>
</html>