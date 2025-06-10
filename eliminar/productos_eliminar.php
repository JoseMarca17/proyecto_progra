<?php
include('../conexion.php');

if (isset($_GET['id_producto'])) {
    $id = intval($_GET['id_producto']);
    $pagina = isset($_GET['pag']) ? intval($_GET['pag']) : 1;
    
    // Obtener nombre para el mensaje de confirmación
    $sql = "SELECT nombre FROM producto WHERE id_producto = $id LIMIT 1";
    $resultado = mysqli_query($conn, $sql);
    $producto = mysqli_fetch_assoc($resultado);
    
    // Mostrar confirmación
    if (!isset($_GET['confirm'])) {
        echo "<script>
            if (confirm('¿Estás seguro de eliminar el producto \"".addslashes($producto['nombre'])."\"?')) {
                window.location.href = '../eliminar/productos_eliminar.php?id_producto=$id&pag=$pagina&confirm=1';
            } else {
                window.location.href = '../tablas/producto_tabla.php?pag=$pagina';
            }   
        </script>";
        exit();
    }
    
    // Eliminar después de confirmación
    $sql = "DELETE FROM producto WHERE id_producto = $id";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: ../tablas/producto_tabla.php?pag=$pagina&deleted=1");
    } else {
        die("Error al eliminar: " . mysqli_error($conn));
    }
} else {
    die("ID de producto no especificado");
}
?>