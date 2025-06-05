<?php
include('conexion.php');
<<<<<<< HEAD
include("header.php");
?>

=======
//include("barra_lateral.php");
include ("header.php");
?>
>>>>>>> 1e53ca60fd1501f06a4a22709da53ff85385e51b
<html>
<head>
    <title>Registros</title>
    <link rel="stylesheet" href="styles/styles_tablas.css"> 
</head>
<body>
<<<<<<< HEAD
    <div class="ContenedorPrincipal">	
        <?php
        $filasmax = 25;

        if (isset($_GET['pag'])) {
            $pagina = $_GET['pag'];
        } else {
            $pagina = 1;
=======
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
            echo  "<td style='width:24%'>
			 <a class='BotonesUsuarios' href=\"usuario_ver.php?correo=$mostrar[correo]&pag=$pagina\">Ver</a> 
			<a class='BotonesUsuarios' href=\"usuario_modificar.php?correo=$mostrar[correo]&pag=$pagina\">Modificar</a> 
	 <a class='BotonesUsuarios' href=\"usuario_eliminar.php?correo=$mostrar[correo]&pag=$pagina\" onClick=\"return confirm('¿Estás seguro de eliminar a $mostrar[nombre]?')\">Eliminar</a>
	</td>";  
			
>>>>>>> 1e53ca60fd1501f06a4a22709da53ff85385e51b
        }

        $sqlusu = mysqli_query($conn, "SELECT * FROM usuarios ORDER BY nombre DESC LIMIT " . (($pagina - 1) * $filasmax)  . "," . $filasmax);
        $resultadoMaximo = mysqli_query($conn, "SELECT count(*) as num_usuarios FROM usuarios");
        ?>
<<<<<<< HEAD

        <div class="ContenedorTabla">
            <form method="POST">
                <h1>Lista de usuarios</h1>
				<style>
					h1{
						color: white;
					}
				</style>
                
                <div style="text-align:left">
                    <a href="usuarios_tabla.php" class="BotonesUsuarios">Inicio de la tabla</a>
                    <input class="BotonesUsuarios" type="submit" value="Buscar" name="btnbuscar">
                    <input class="CajaTexto" type="text" name="txtbuscar" placeholder="Ingresar correo" autocomplete="off" style="width:20%">
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
                while ($mostrar = mysqli_fetch_assoc($sqlusu)) {
                    echo "<tr>";
                    echo "<td>".$mostrar['nombre']."</td>";
                    echo "<td>".$mostrar['apellido']."</td>";
                    echo "<td>".$mostrar['correo']."</td>";
                    echo "<td>".$mostrar['telefono']."</td>";
                    echo "<td>".$mostrar['ubicacion']."</td>";
                    echo "<td>*****</td>";
                }
                ?>
            </table>

            <div style="text-align:right">
                <br>
            </div>
        </div>

        <div style="text-align:right">
            <br>
        </div>

        <div style="text-align:center">
            <a class="BotonesUsuarios" href="#" style="pointer-events: none">Anterior</a>
            <a class="BotonesUsuarios" href="usuarios_tabla.php?pag=2">Siguiente</a>
        </div>
    </div>
=======
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
>>>>>>> 1e53ca60fd1501f06a4a22709da53ff85385e51b
</body>

</html>
