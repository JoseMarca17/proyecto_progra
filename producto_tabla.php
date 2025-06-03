<?php
include('conexion.php');
include('header.php')
?>

<html>
<title> registros </title>
<link rel="stylesheet" href="styles/styles_tablas.css"> 
<body>
<div class="ContenedorPrincipal">	
<?php
 
    $filasmax = 25;
 
    if (isset($_GET['pag'])) 
	{
        $pagina = $_GET['pag'];
    } else 
	{
        $pagina = 1;
    }
 
if(isset($_POST['btnbuscar']))
{
$buscar = $_POST['txtbuscar'];

$sqlusu = mysqli_query($conn, "SELECT * FROM usuarios where correo = '".$buscar."'");

}
else
{
    $sqlusu = mysqli_query($conn, "SELECT * FROM producto ORDER BY nombre DESC LIMIT " . (($pagina - 1) * $filasmax)  . "," . $filasmax);
}
 
    $resultadoMaximo = mysqli_query($conn, "SELECT count(*) as num_producto FROM producto");
 
   $maxusutabla = mysqli_fetch_assoc($resultadoMaximo)['num_producto'];
	
    ?>
	<div class="ContenedorTabla" >
	<form method="POST">
	<h1>Lista de Productos</h1>
	
	<div style="text-align:left">
	<a href="usuarios_tabla.php" class="BotonesUsuarios">Inicio de la tabla</a>
	
	<input class="BotonesUsuarios" type="submit" value="Buscar" name="btnbuscar">
	<input class="CajaTexto" type="text" name="txtbuscar"  placeholder="Ingresar producto" autocomplete="off" style='width:20%'>
	</div>
			</form>
    <table>
			<tr>
			<th>Nombre</th>
			<th>Precio</th>
            <th>Categoria</th>
			<th>Talla</th>
			<th>Descripcion</th>
			</tr>
 
        <?php
 
      while ($mostrar = mysqli_fetch_assoc($sqlusu)) 
		{
			
            echo "<tr>";
            echo "<td>".$mostrar['nombre']."</td>";
			echo "<td>".$mostrar['precio']."</td>";
			echo "<td>".$mostrar['categoria']."</td>";
			echo "<td>".$mostrar['talla']."</td>";
			echo "<td>".$mostrar['descripcion']."</td>";
            echo  "<td style='width:24%'>
			 <a class='BotonesUsuarios' href=\"productos_ver.php?id_producto=$mostrar[id_producto]&pag=$pagina\">Ver</a> 
			<a class='BotonesUsuarios' href=\"productos_modificar.php?id_producto=$mostrar[id_producto]&pag=$pagina\">Modificar</a> 
	 <a class='BotonesUsuarios' href=\"productos_eliminar.php?id_producto=$mostrar[id_producto]&pag=$pagina\" onClick=\"return confirm('¿Estás seguro de eliminar a $mostrar[nombre]?')\">Eliminar</a>
	</td>";  
			
        }
 
        ?>
    </table>
	<div style='text-align:right'>
	<br>
	<?php echo "Total de usuarios: ".$maxusutabla;?>
	</div>
	</div>
<div style='text-align:right'>
<br>
</div>
<div style="text-align:center">
<?php
if (isset($_GET['pag'])) {
if ($_GET['pag'] > 1) {
 ?>
<a class="BotonesUsuarios" href="usuarios_tabla.php?pag=<?php echo $_GET['pag'] - 1; ?>">Anterior</a>
<?php
} 
else 
{
?>
<a class="BotonesUsuarios" href="#" style="pointer-events: none">Anterior</a>
<?php
}
?>
 
 <?php
} 
else 
{
?>
<a class="BotonesUsuarios" href="#" style="pointer-events: none">Anterior</a>
<?php
}
 
if (isset($_GET['pag'])) {
if ((($pagina) * $filasmax) < $maxusutabla) {
?>
<a class="BotonesUsuarios" href="usuarios_tabla.php?pag=<?php echo $_GET['pag'] + 1; ?>">Siguiente</a>
<?php
} else {
?>
<a class="BotonesUsuarios" href="#" style="pointer-events: none">Siguiente</a>
<?php
}
?>
<?php
} else {
?>
<a class="BotonesUsuarios" href="usuarios_tabla.php?pag=2">Siguiente</a>
<?php
 }
?>
</div>
</div>
</body>
</html>