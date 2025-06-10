<?php
include('../conexion.php');
include('../header.php');

$id_pago = intval($_GET['id_pago'] ?? 0);
$pagina = $_GET['pag'] ?? 1;

if ($id_pago <= 0) {
    echo "<script>alert('ID de pago inválido.'); window.location.href='pago_tabla.php?pag=$pagina';</script>";
    exit;
}

// Verificar que el pago exista antes de eliminar
$sql_check = "SELECT id_pago FROM pago WHERE id_pago = $id_pago";
$result_check = $conn->query($sql_check);

if ($result_check->num_rows === 0) {
    echo "<script>alert('El pago no existe.'); window.location.href='../pago_tabla.php?pag=$pagina';</script>";
    exit;
}

// Eliminar el pago
$sql_delete = "DELETE FROM pago WHERE id_pago = $id_pago";

if ($conn->query($sql_delete)) {
    echo "<script>alert('Pago eliminado correctamente.'); window.location.href='../indice_tablas.php?pag=$pagina';</script>";
} else {
    echo "<script>alert('Error al eliminar el pago: " . $conn->error . "'); window.location.href='pago_tabla.php?pag=$pagina';</script>";
}
?>
