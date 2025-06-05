<?php 
session_start();
include('conexion.php');
include("header.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
<title>Carrito de Compras</title>
<link rel="stylesheet" href="styles/styles_tablas.css">
</head>
<body>
<div class="ContenedorPrincipal">

<?php
$filasmax = 5;
$pagina = isset($_GET['pag']) ? (int)$_GET['pag'] : 1;
$inicio = ($pagina - 1) * $filasmax;

if (isset($_POST['btnbuscar'])) {
    $buscar = mysqli_real_escape_string($conn, $_POST['txtbuscar']);
    $sqlprod = mysqli_query($conn, "SELECT * FROM compra_prueba WHERE producto LIKE '%$buscar%'");
} else {
    $sqlprod = mysqli_query($conn, "SELECT * FROM compra_prueba ORDER BY id DESC LIMIT $inicio, $filasmax");
}

$resultadoMaximo = mysqli_query($conn, "SELECT COUNT(*) as total FROM compra_prueba");
$maxusutabla = mysqli_fetch_assoc($resultadoMaximo)['total'];
?>

<div class="ContenedorTabla">
    <form method="POST">
        <h1>Carrito de Compras</h1>
        <div style="text-align:left">
            <a href="carrito.php" class="BotonesUsuarios">Inicio</a>
            <input class="BotonesUsuarios" type="submit" value="Buscar" name="btnbuscar">
            <input class="CajaTexto" type="text" name="txtbuscar" placeholder="Ingresar nombre" autocomplete="off" style="width:20%">
        </div>
    </form>

    <table>
    <tr>
        <th>ID Producto</th>
        <th>Producto</th>
        <th>Precio</th>
        <th>Cantidad</th>
        <th>Talla</th>
        <th>Total</th>
    </tr>

    <?php while ($mostrar = mysqli_fetch_assoc($sqlprod)) { ?>
        <tr>
            <td><?= $mostrar['id'] ?></td>
            <td><?= $mostrar['producto'] ?></td>
            <td>$<?= number_format($mostrar['precio'], 2) ?></td>
            <td><?= $mostrar['cantidad'] ?></td>
            <td><?= $mostrar['talla'] ?></td>
            <td>$<?= number_format($mostrar['total'], 2) ?></td>
            <td style="width:24%">
            <a class="BotonesUsuarios" href="carrito_ver.php?id=<?php echo $mostrar['id']; ?>&pag=<?php echo $pagina; ?>">Ver</a> 
            <a class="BotonesUsuarios" href="carrito_modificar.php?id=<?php echo $mostrar['id']; ?>&pag=<?php echo $pagina; ?>">Modificar</a> 
            <a class="BotonesUsuarios" href="compra_eliminar.php?id=<?php echo $mostrar['id']; ?>&pag=<?php echo $pagina; ?>" onClick="return confirm('¿Estás seguro de eliminar la compra <?php echo htmlspecialchars($mostrar['producto']); ?>?')">Eliminar</a>
        </td>
        </tr>
    <?php } ?>

</table>

    <!-- Botón Agregar al carrito -->
    <div style="text-align:right; margin-top: 10px;">
        <form method="POST" action="registrar_compra.php">
            <input type="submit" value="Agregar al carrito" class="BotonesUsuarios">
        </form>
    </div>

    <div style="text-align:right; margin-top: 10px;">
        <strong>Total de productos:</strong> <?= $maxusutabla ?>
    </div>
</div>

<div style="text-align:center; margin-top: 20px;">
    <?php if ($pagina > 1): ?>
        <a class="BotonesUsuarios" href="carrito.php?pag=<?= $pagina - 1 ?>">Anterior</a>
    <?php else: ?>
        <a class="BotonesUsuarios" href="#" style="pointer-events: none;">Anterior</a>
    <?php endif; ?>

    <?php if (($pagina * $filasmax) < $maxusutabla): ?>
        <a class="BotonesUsuarios" href="carrito.php?pag=<?= $pagina + 1 ?>">Siguiente</a>
    <?php else: ?>
        <a class="BotonesUsuarios" href="#" style="pointer-events: none;">Siguiente</a>
    <?php endif; ?>
</div>

</div>
</body>
</html>
