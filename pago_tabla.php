<?php
include('conexion.php');
//include("barra_lateral.php");
?>
<html>
<title> registros </title>
<link rel="stylesheet" href="styles_tablas.css"> 
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

 $sqlusu = mysqli_query($conn, "SELECT * FROM usuarios+ where correo = '".$buscar."'");

}
else
{
    $sqlusu = mysqli_query($conn, "SELECT * FROM pago_prueba ORDER BY monto_pagado DESC LIMIT " . (($pagina - 1) * $filasmax)  . "," . $filasmax);
 }
 
    $resultadoMaximo = mysqli_query($conn, "SELECT count(*) as id_pago FROM pago_prueba");
 
    $maxusutabla = mysqli_fetch_assoc($resultadoMaximo)['id_pago'];
	
    ?>
	<div class="ContenedorTabla" >
	<form method="POST">
	<h1>Lista de Pagos</h1>
	
	<div style="text-align:left">
	<a href="pago_tabla.php" class="BotonesUsuarios">Inicio de la tabla</a>
	
	<input class="BotonesUsuarios" type="submit" value="Buscar" name="btnbuscar">
	<input class="CajaTexto" type="text" name="txtbuscar"  placeholder="Ingresar " autocomplete="off" style='width:20%'>
	</div>

	<div class = "tabla_datos">
			</form>
    <table>
			<tr>
			<th>Monto pagado</th>
			<th>Fecha pago</th>
            <th>Ubicacion entrega</th>
			<th>Metodo de pago</th>
			</tr>
<?php
while ($mostrar = mysqli_fetch_assoc($sqlusu)) {
    echo "<tr>";
    echo "<td>" . $mostrar['monto_pagado'] . "</td>";
    echo "<td>" . $mostrar['fecha_pago'] . "</td>";
    echo "<td>" . $mostrar['ubicacion_entrega'] . "</td>";
    echo "<td>" . $mostrar['metodo_pago'] . "</td>";

}
?>

    </table>
	</div>
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
<a class="BotonesUsuarios" href="usuarios_tabla.php?pag=<?php  echo $_GET['pag'] + 1; ?>">Siguiente</a>
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