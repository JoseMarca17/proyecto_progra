<?php 
include("conexion.php");
include("usuario_tabla.php");

$pagina = $_GET['pag'];
$correo = $_GET['correo'];

$querybuscar = mysqli_query($conn, "SELECT * FROM usuarios WHERE correo = '$correo'");
 
while($mostrar = mysqli_fetch_array($querybuscar))
{
	$nombre	= $mostrar['nombre'];
	$apellido	= $mostrar['apellido'];
	$correo 	= $mostrar['correo'];
	$password	= $mostrar['password'];
	$telefono	= $mostrar['telefono'];
	$ubicacion	= $mostrar['ubicacion'];
	 
}
?>
<html>
<body>
<div class="caja_popup2">
<form class="contenedor_popup" method="POST">
<table>
<tr><th colspan="2">Modificar usuario</th></tr>
<tr> 
<td>Nombre</td>
<td><input class="CajaTexto" type="text" name="nombre" value="<?php echo $nombre;?>" required></td>
</tr>
<tr> 
<td>apellido</td>
<td><input class="CajaTexto" type="text" name="apellido" value="<?php echo $apellido;?>" required></td>
</tr>
<tr> 
<td>Correo</td>
<td><input class="CajaTexto" type="email" name="correo" value="<?php echo $correo;?>" readonly></td>
</tr>
<tr> 
<td>Password</td>
<td><input class="CajaTexto" type="password" name="password" value="<?php echo $password;?>" required></td>
</tr>
<tr>
<tr> 
<td>Telefono</td>
<td><input class="CajaTexto" type="text" name="telefono" value="<?php echo $telefono;?>" required></td>
</tr>
<tr> 
<td>ubicacion</td>
<td><input class="CajaTexto" type="text" name="ubicacion" value="<?php echo $ubicacion;?>" required></td>
</tr>
<td colspan="2">
<?php echo "<a class='BotonesUsuarios' href=\"usuarios_tabla.php?pag=$pagina\">Cancelar</a>";?>
<input class="BotonesUsuarios" type="submit" name="btnmodificar" value="Modificar" onClick="javascript: return confirm('¿Deseas modificar este usuario?');">
</td>
</tr>
</table>
</form>
</div>
</body>
</html>

<?php
	
if(isset($_POST['btnmodificar']))
{    
	$nombre	= $mostrar['nombre'];
	$apellido	= $mostrar['apellido'];
	$correo 	= $mostrar['correo'];
	$password	= $mostrar['password'];
	$telefono	= $mostrar['telefono'];
	$ubicacion	= $mostrar['ubicacion'];
      
$querymodificar = mysqli_query($conn, "UPDATE usuarios SET nombre='$nombre',correo='$correo',password='$password',telefono ='$telefono',ubicacion ='$ubicacion' WHERE correo = '$correo'");
echo "<script>window.location= 'usuario_tabla.php?pag=$pagina' </script>";
    
}
?>