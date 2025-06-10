<?php
session_start();
include("../conexion.php");

$correo_sesion = $_SESSION['correo'] ?? '';
$correo = $_GET['correo'] ?? '';
$pagina = $_GET['pag'] ?? 1;

// No permitir eliminarse a uno mismo
if ($correo === $correo_sesion) {
    echo "<script>
        alert('No puedes eliminar tu propio usuario.');
        window.location.href = '../tablas/usuarios_tabla.php?pag=$pagina';
    </script>";
    exit;
}

// Eliminar usuario
mysqli_query($conn, "DELETE FROM usuarios WHERE correo = '$correo'");

// Mostrar mensaje y redirigir con JavaScript
echo "<script>
    alert('Usuario eliminado.');
    window.location.href = '../tablas/usuario_tabla.php?pag=$pagina';
</script>";
exit;
?>
