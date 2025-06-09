<?php
include('conexion.php');

if (!isset($_GET['id'])) {
    die("ID no especificado");
}

$id = intval($_GET['id']);

$sql_delete = "DELETE FROM compra_prueba WHERE id = $id";

if (mysqli_query($conn, $sql_delete)) {
    header("Location: compra_tabla.php" . (isset($_GET['pag']) ? '?pag=' . intval($_GET['pag']) : ''));
    exit;
} else {
    echo "Error al eliminar: " . mysqli_error($conn);
}
?>
