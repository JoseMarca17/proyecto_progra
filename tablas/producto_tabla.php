
<?php
session_start();
include('../conexion.php');
include('../header.php');

// Validar que esté iniciada la sesión
if (!isset($_SESSION['id_usuario'])) {
    echo "<script>alert('❌ Debes iniciar sesión para ver los productos'); window.location='../login.php';</script>";
    exit();
}

$id_admin = $_SESSION['id_usuario'];

$filasmax = 25;

if (isset($_GET['pag'])) {
    $pagina = (int)$_GET['pag'];
    if ($pagina < 1) $pagina = 1;
} else {
    $pagina = 1;
}

$buscar = '';
$where_sql = "WHERE id_admin = $id_admin"; 

if (isset($_POST['btnbuscar'])) {
    $buscar = trim(mysqli_real_escape_string($conn, $_POST['txtbuscar']));
    if ($buscar !== '') {
        $where_sql .= " AND nombre LIKE '%$buscar%'";
    }
}

$sqlusu = mysqli_query($conn, "SELECT * FROM producto $where_sql ORDER BY nombre DESC LIMIT " . (($pagina - 1) * $filasmax) . ", $filasmax");

$resultadoMaximo = mysqli_query($conn, "SELECT COUNT(*) as num_producto FROM producto $where_sql");
$maxusutabla = mysqli_fetch_assoc($resultadoMaximo)['num_producto'];
?>

<html>
<title>Registros de Productos</title>
<link rel="stylesheet" href="../styles/styles_tablas.css">

<body>
<div class="ContenedorPrincipal">
    <div class="ContenedorTabla">
        <form method="POST" style="margin-bottom: 15px;">
            <h1>Lista de Productos</h1>
            <div style="text-align:left;">
                <a href="productos_tabla.php" class="BotonesUsuarios">Inicio de la tabla</a>
                <input class="CajaTexto" type="text" name="txtbuscar" placeholder="Buscar producto" autocomplete="off" style="width: 20%;" value="<?= htmlspecialchars($buscar) ?>">
                <input class="BotonesUsuarios" type="submit" value="Buscar" name="btnbuscar">
            </div>
        </form>

        <table>
            <tr>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Categoría</th>
                <th>Talla</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>

            <?php
            if ($sqlusu && mysqli_num_rows($sqlusu) > 0) {
                while ($mostrar = mysqli_fetch_assoc($sqlusu)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($mostrar['nombre']) . "</td>";
                    echo "<td>" . number_format($mostrar['precio'], 2) . "</td>";
                    echo "<td>" . htmlspecialchars($mostrar['categoria']) . "</td>";
                    echo "<td>" . htmlspecialchars($mostrar['talla']) . "</td>";
                    echo "<td>" . htmlspecialchars($mostrar['descripcion']) . "</td>";
                    echo "<td style='width:24%'>
                        <a class='BotonesUsuarios' href=\"../ver/productos_ver.php?id_producto=" . $mostrar['id_producto'] . "&pag=$pagina\">Ver</a> 
                        <a class='BotonesUsuarios' href=\"../modificar/productos_modificar.php?id_producto=" . $mostrar['id_producto'] . "&pag=$pagina\">Modificar</a> 
                        <a class='BotonesUsuarios' href=\"../eliminar/productos_eliminar.php?id_producto=" . $mostrar['id_producto'] . "&pag=$pagina\" onClick=\"return confirm('¿Estás seguro de eliminar a " . addslashes(htmlspecialchars($mostrar['nombre'])) . "?')\">Eliminar</a>
                    </td>";
                    echo "</tr>";
                }
            } else {
                echo '<tr><td colspan="6" style="text-align:center;">No se encontraron productos.</td></tr>';
            }
            ?>
        </table>

        <div style="text-align:right; margin-top: 10px;">
            <br>
            <?php echo "Total de productos: " . $maxusutabla; ?>
        </div>

        <div style="text-align:center; margin-top: 20px;">
            <?php if ($pagina > 1): ?>
                <a class="BotonesUsuarios" href="productos_tabla.php?pag=<?= $pagina - 1 ?>">Anterior</a>
            <?php else: ?>
                <a class="BotonesUsuarios" href="#" style="pointer-events: none; opacity: 0.5;">Anterior</a>
            <?php endif; ?>

            <?php if ($pagina * $filasmax < $maxusutabla): ?>
                <a class="BotonesUsuarios" href="productos_tabla.php?pag=<?= $pagina + 1 ?>">Siguiente</a>
            <?php else: ?>
                <a class="BotonesUsuarios" href="#" style="pointer-events: none; opacity: 0.5;">Siguiente</a>
            <?php endif; ?>
        </div>
        <a href="../pdf/pdf_productos.php" class="BotonesUsuarios" target="_blank">Exportar PDF</a>

    </div>
</div>
</body>
</html>