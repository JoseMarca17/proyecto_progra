<?php
include('../conexion.php');
    include('../header.php');
?>
<html>
<head>
    <title>Registros</title>
    <link rel="stylesheet" href="../styles/styles_tablas.css">

</head>
<body>
    <div class="ContenedorPrincipal">	
        <?php
        $filasmax = 25;
        $pagina = isset($_GET['pag']) ? $_GET['pag'] : 1;

        $sqlusu = mysqli_query($conn, "SELECT * FROM usuarios ORDER BY nombre DESC LIMIT " . (($pagina - 1) * $filasmax)  . "," . $filasmax);
        $resultadoMaximo = mysqli_query($conn, "SELECT count(*) as num_usuarios FROM usuarios");
        ?>

        <div class="ContenedorTabla">
            <form method="POST">
                <h1 style="color:white;">Lista de usuarios</h1>
                
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
                    <th>Teléfono</th>
                    <th>Ubicación</th>
                    <th>Carnet</th>
                    <th>Password</th>
                </tr>

                <?php
                while ($mostrar = mysqli_fetch_assoc($sqlusu)) {
                    echo "<tr>";
                    echo "<td>{$mostrar['nombre']}</td>";
                    echo "<td>{$mostrar['apellido']}</td>";
                    echo "<td>{$mostrar['correo']}</td>";
                    echo "<td>{$mostrar['telefono']}</td>";
                    echo "<td>{$mostrar['ubicacion']}</td>";
                    echo "<td>{$mostrar['ci']}</td>";
                    echo "<td>*****</td>";
                    echo "</tr>";
                    echo  "<td style='width:24%'>
                    <a class='BotonesUsuarios' href=\"../ver/usuario_ver.php?correo=$mostrar[correo]&pag=$pagina\">Ver</a> 
			        <a class='BotonesUsuarios' href=\"../modificar/usuario_modificar.php?correo=$mostrar[correo]&pag=$pagina\">Modificar</a> 
	                <a class='BotonesUsuarios' href=\"../eliminar/usuario_eliminar.php?correo=$mostrar[correo]&pag=$pagina\" 
                    onClick=\"return confirm('¿Estás seguro de eliminar a $mostrar[nombre]?')\">Eliminar</a>
	                </td>";  
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
        <a class="BotonesUsuarios" href="/SISTEMA_PROYECTO/pdf/exportar_pdf_usuario.php">Exportar a PDF</a>

    </div>
    
</body>
</html>
