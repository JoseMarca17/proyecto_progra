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
<td><b>Correo: </b></td>z
<td><?php echo $correo;?></td>
</tr>
<tr>
    <td><b>Telefono: </b></td>
    <td><?php echo $telefono;?></td>
</tr>
<tr>
    <td><b>Ubicacion: </b></td>
    <td><?php echo $ubicacion;?></td>
</tr>       
				
<td colspan="2">
<?php echo "<a class='BotonesUsuarios' href=\"usuarios_tabla.php?pag=$pagina\">Regresar</a>";?>
</td>
</tr>
</table>
</form>
</div>
</body>
</html>