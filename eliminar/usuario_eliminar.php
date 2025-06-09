<?php
include("conexion.php");
include("header.php");
$correo = $_SESSION['correo'];
$pagina = $_GET['pag'];
$correo = $_GET['correo'];

if ($correo == $correo )
{
echo "<script> alert('No puedes eliminar a tu propio usuario.'); window.location='usuarios_tabla.php' </script>";
}
else
{
mysqli_query($conn, "DELETE FROM usuarios WHERE correo='$correo'");
header("Location:usuarios_tabla.php?pag=$pagina");
}
?>
