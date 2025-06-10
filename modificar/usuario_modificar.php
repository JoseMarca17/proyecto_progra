<?php
include("../conexion.php");
include("../tablas/usuario_tabla.php");

$pagina = $_GET['pag'];
$correo = $_GET['correo'];

$querybuscar = mysqli_query($conn, "SELECT * FROM usuarios WHERE correo = '$correo'");

while ($mostrar = mysqli_fetch_array($querybuscar)) {
	$nombre 	= $mostrar['nombre'];
	$correo 	= $mostrar['correo'];
	$password 	= $mostrar['password'];
	$ci 	= $mostrar['ci'];
	$telefono 	= $mostrar['telefono'];
	$ubicacion 	= $mostrar['ubicacion'];
}
?>
<html>

<body>
	<div class="caja_popup2">
		<form class="contenedor_popup" method="POST">
			<table>
				<tr>
					<th colspan="2">Modificar usuario</th>
				</tr>
				<tr>
					<td>Nombre</td>
					<td><input class="CajaTexto" type="text" name="txtnom" value="<?php echo $nombre; ?>" required></td>
				</tr>
				<tr>
					<td>Correo</td>
					<td><input class="CajaTexto" type="email" name="txtcorreo" value="<?php echo $correo; ?>" readonly></td>
				</tr>
				<tr>
					<td>Password</td>
					<td><input class="CajaTexto" type="password" name="txtpass" value="<?php echo $password; ?>" required></td>
				</tr>
				<tr>
				<tr>
					<td>Telefono</td>
					<td><input class="CajaTexto" type="text" name="txttelefono" value="<?php echo $telefono; ?>" required></td>
				</tr>
				<tr>
					<td>Ubicacion</td>
					<td><input class="CajaTexto" type="text" name="txtubicacion" value="<?php echo $ubicacion; ?>" required></td>
				</tr>
				<tr>
					<td>Carnet</td>
					<td><input class="CajaTexto" type="text" name="txtcarnet" value="<?php echo $ci; ?>" required></td>
				</tr>
				<td colspan="2">
					<?php echo "<a class='BotonesUsuarios' href=\"usuarios_tabla.php?pag=$pagina\">Cancelar</a>"; ?>
					<input class="BotonesUsuarios" type="submit" name="btnmodificar" value="Modificar" 
					onClick="javascript: return confirm('¿Deseas modificar este usuario?');">
				</td>
				</tr>
			</table>
		</form>
	</div>
</body>

</html>

<?php

if (isset($_POST['btnmodificar'])) {
	$nom1 		= $_POST['txtnom'];
	$correo1 	= $_POST['txtcorreo'];
	$pass1 		= $_POST['txtpass'];
	$telefono1 	= $_POST['txttelefono'];
	$ci1 	= $_POST['txtcarnet'];
	$ubicacion1 	= $_POST['txtubicacion'];
	$querymodificar = mysqli_query($conn, "UPDATE usuarios SET nom='$nom1',correo='$correo1',
	password = '$pass1',telefono = '$telefono1',ubicacion = '$ubicacion1', ci = '$ci1' WHERE correo = '$correo1'");
	echo "<script>window.location= 'usuarios_tabla.php?pag=$pagina' </script>";
}
?>