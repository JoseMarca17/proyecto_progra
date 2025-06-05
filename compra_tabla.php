<?php
include('conexion.php');
include("header.php");

?>

<!DOCTYPE html>
<html>
<head>
    <title>Registros de Compras</title>
    <link rel="stylesheet" href="styles/styles_tablas.css">
</head>
<body>
	
<div class="ContenedorPrincipal">  

<?php
$filasmax = 25;

$pagina = isset($_GET['pag']) ? intval($_GET['pag']) : 1;

$buscar = '';
$where = '';

if (isset($_POST['btnbuscar']) && !empty($_POST['txtbuscar'])) {
    $buscar = mysqli_real_escape_string($conn, $_POST['txtbuscar']);
    $where = "WHERE producto LIKE '%$buscar%'";
}

// Consulta con filtro y paginación
$sqlusu = mysqli_query($conn, "SELECT * FROM compra_prueba $where ORDER BY producto DESC LIMIT " . (($pagina - 1) * $filasmax) . ", $filasmax");

// Total de registros (para paginación)
$resultadoMaximo = mysqli_query($conn, "SELECT COUNT(*) as total FROM compra_prueba $where");
$maxusutabla = mysqli_fetch_assoc($resultadoMaximo)['total'];
?>

<div class="ContenedorTabla">
<form method="POST" action="">
    <h1>Lista de Compras</h1>
    <style>
        h1{
            color:white;
        }
    </style>

    <div style="text-align:left">
        <a href="compra_tabla.php" class="BotonesUsuarios">Inicio de la tabla</a>

        <input class="BotonesUsuarios" type="submit" value="Buscar" name="btnbuscar">
        <input class="CajaTexto" type="text" name="txtbuscar" placeholder="Ingresar producto" autocomplete="off" style="width:20%" value="<?php echo htmlspecialchars($buscar); ?>">
    </div>
</form>

<table>
    <tr>
        <th>Producto</th>
        <th>Precio</th>
        <th>Cantidad</th>
        <th>Talla</th>
        <th>Total</th>
        <th>Acciones</th>
    </tr>

<?php while ($mostrar = mysqli_fetch_assoc($sqlusu)) { ?>
    <tr>
        <td><?php echo htmlspecialchars($mostrar['producto']); ?></td>
        <td><?php echo htmlspecialchars($mostrar['precio']); ?></td>
        <td><?php echo htmlspecialchars($mostrar['cantidad']); ?></td>
        <td><?php echo htmlspecialchars($mostrar['talla']); ?></td>
        <td><?php echo htmlspecialchars($mostrar['total']); ?></td>
        <td style="width:24%">
            <a class="BotonesUsuarios" href="compra_ver.php?id=<?php echo $mostrar['id']; ?>&pag=<?php echo $pagina; ?>">Ver</a> 
            <a class="BotonesUsuarios" href="compra_modificar.php?id=<?php echo $mostrar['id']; ?>&pag=<?php echo $pagina; ?>">Modificar</a> 
            <a class="BotonesUsuarios" href="compra_eliminar.php?id=<?php echo $mostrar['id']; ?>&pag=<?php echo $pagina; ?>" onClick="return confirm('¿Estás seguro de eliminar la compra <?php echo htmlspecialchars($mostrar['producto']); ?>?')">Eliminar</a>
        </td>
    </tr>
<?php } ?>

</table>

<div style="text-align:right">
    <br>
    <?php echo "Total de registros: " . $maxusutabla; ?>
</div>
</div>

<div style="text-align:center; margin-top: 15px;">
<?php
// Botón Anterior
if ($pagina > 1) {
    $prev = $pagina - 1;
    echo "<a class='BotonesUsuarios' href='compra_tabla.php?pag=$prev'>Anterior</a> ";
} else {
    echo "<a class='BotonesUsuarios' href='#' style='pointer-events: none'>Anterior</a> ";
}

// Botón Siguiente
if (($pagina * $filasmax) < $maxusutabla) {
    $next = $pagina + 1;
    echo "<a class='BotonesUsuarios' href='compra_tabla.php?pag=$next'>Siguiente</a>";
} else {
    echo "<a class='BotonesUsuarios' href='#' style='pointer-events: none'>Siguiente</a>";
}
?>
</div>

</div>
</body>
</html>
