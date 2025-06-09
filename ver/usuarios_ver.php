<?php 
include("conexion.php");
include("usuario_tabla.php");
$pagina = $_GET['pag'];
$correo = $_GET['correo'];

$querybuscar = mysqli_query($conn, "SELECT * FROM usuarios WHERE correo = '$correo'");
 
while($mostrar = mysqli_fetch_array($querybuscar))
{
	$nombre 	= $mostrar['nombre'];
	$correo 	= $mostrar['correo'];
	$apellido 	= $mostrar['apellido'];
	$telefono 	= $mostrar['telefono'];
	$ubicacion 	= $mostrar['ubicacion'];
}
?>
<html>
<body>
<div class="caja_popup2">
<form class="contenedor_popup" method="POST">
<table>
<tr><th colspan="2">Ver usuario</th></tr>
<tr> 
<td><b>Nombre:</b></td>
<td><?php echo $nombre;?></td>
</tr>
<tr> 
<td><b>Apellido:</b></td>
<td><?php echo $apellido;?></td>
</tr>			
<tr> 
<td><b>Correo: </b></td>
<td><?php echo $correo;?></td>
</tr>
<tr> 
<td><b>Telefono:</b></td>
<td><?php echo $telefono;?></td>
</tr>
<tr> 
<td><b>Ubicación:</b></td>
<td><?php echo $ubicacion;?></td>
</tr>

<tr>
				
<td colspan="2">
<?php echo "<a class='BotonesUsuarios' href=\"usuario_tabla.php?pag=$pagina\">Regresar</a>";?>
</td>
</tr>
</table>
</form>
</div>
</body>
</html>