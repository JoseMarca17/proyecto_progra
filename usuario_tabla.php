<?php
include('conexion.php');
//include("barra_lateral.php");
include ("header.php");
?>
<html>
<head>
    <title>Registros</title>
    <link rel="stylesheet" href="styles/styles_tablas.css"> 
</head>
<body>
    <div class="ContenedorPrincipal">	
        <?php
        $filasmax = 25;

        if (isset($_GET['pag'])) {
            $pagina = $_GET['pag'];
        } else {
            $pagina = 1;
        }

        $sqlusu = mysqli_query($conn, "SELECT * FROM usuarios ORDER BY nombre DESC LIMIT " . (($pagina - 1) * $filasmax)  . "," . $filasmax);
        $resultadoMaximo = mysqli_query($conn, "SELECT count(*) as num_usuarios FROM usuarios");
        ?>

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
</body>

</html>
