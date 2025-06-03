<?php
include('conexion.php');
//include("barra_lateral.php");
?>
<?php include 'header.html'; ?> 
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
    $sqlusu = mysqli_query($conn, "SELECT * FROM usuarios ORDER BY nombre DESC LIMIT " . (($pagina - 1) * $filasmax)  . "," . $filasmax);
 }
    $resultadoMaximo = mysqli_query($conn, "SELECT count(*) as num_usuarios FROM usuarios");
    $maxusutabla = mysqli_fetch_assoc($resultadoMaximo)['num_usuarios'];
    ?>
	<div class="ContenedorTabla" >
	<form method="POST">
	<h1>Lista de usuarios</h1>
	
	<div style="text-align:left">
	<a href="usuarios_tabla.php" class="BotonesUsuarios">Inicio de la tabla</a>
	
	<input class="BotonesUsuarios" type="submit" value="Buscar" name="btnbuscar">
	<input class="CajaTexto" type="text" name="txtbuscar"  placeholder="Ingresar correo" autocomplete="off" style='width:20%'>
	</div>
			</form>
    <table>
			<tr>
			<th>Nombre</th>
			<th>Apellido</th>
			<th>Correo</th>
			<th>Telefono</th>
			<th>Ubicacion</th>
            <th>Password</th>
			</tr>
        <?php
    while ($mostrar = mysqli_fetch_assoc($sqlusu)) 
{
    echo "<tr>";
    echo "<td>".$mostrar['nombre']."</td>";
    echo "<td>".$mostrar['apellido']."</td>";
    echo "<td>".$mostrar['correo']."</td>";
    echo "<td>".$mostrar['telefono']."</td>";
    echo "<td>".$mostrar['ubicacion']."</td>";
    echo "<td>*****</td>";
    echo "<td>".$mostrar['password']."</td>";
    echo "<td style='width:24%'>
            <div style=\"display: flex; gap: 5px; flex-wrap: wrap;\">
                <a class=\"BotonesUsuarios\" href=\"usuarios_ver.php?correo=".$mostrar['correo']."&pag=".$pagina."\">Ver</a>
                <a class=\"BotonesUsuarios\" href=\"usuarios_modificar.php?correo=".$mostrar['correo']."&pag=".$pagina."\">Modificar</a>
                <a class=\"BotonesUsuarios\" href=\"usuarios_eliminar.php?correo=".$mostrar['correo']."&pag=".$pagina."\" onclick=\"return confirm('¿Estás seguro de eliminar a ".$mostrar['nombre']."?')\">Eliminar</a>
            </div>
          </td>";
    echo "</tr>";
}
 
        ?>
    </table>
	<div style='text-align:right'>
	<br>
	<?php  echo "Total de usuarios: ".$maxusutabla;?>
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
<a class="BotonesUsuarios" href="usuarios_tabla.php?pag=<?php   echo $_GET['pag'] + 1; ?>">Siguiente</a>
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