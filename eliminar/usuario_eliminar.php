<?php
session_start();
include("../conexion.php");

$correo_sesion = $_SESSION['correo'] ?? '';
$correo = $_GET['correo'] ?? '';
$pagina = $_GET['pag'] ?? 1;

if ($correo === $correo_sesion) {
    echo "<script>
        alert('No puedes eliminar tu propio usuario.');
        window.location.href = '../tablas/usuarios_tabla.php?pag=$pagina';
    </script>";
    exit;
}

mysqli_query($conn, "DELETE FROM usuarios WHERE correo = '$correo'");

echo "<script>
    alert('Usuario eliminado.');
    window.location.href = '../tablas/usuario_tabla.php?pag=$pagina';
</script>";
exit;
?>
