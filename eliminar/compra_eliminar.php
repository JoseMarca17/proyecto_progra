<?php
session_start();
include('../conexion.php');

if (!isset($_GET['id'])) {
    die("ID de compra no especificado.");
}

$id = intval($_GET['id']);
$pagina = isset($_GET['pag']) ? intval($_GET['pag']) : 1;

$sql_delete = "DELETE FROM compra WHERE id_compra = $id";

if (mysqli_query($conn, $sql_delete)) {
    header("Location: ../tablas/compra_tabla.php?pag=$pagina&deleted=1");
    exit;
} else {
    echo "Error al eliminar: " . mysqli_error($conn);
}
?>
