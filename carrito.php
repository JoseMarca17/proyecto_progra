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
    <style>
        .modal-overlay {
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background-color: rgba(0, 0, 0, 0.75);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .modal-content {
            background: #1a1a2e;
            padding: 20px;
            border-radius: 10px;
            max-width: 600px;
            width: 90%;
            color: #fff;
            box-shadow: 0 0 20px rgba(0,0,0,0.5);
            max-height: 90%;
            overflow-y: auto;
        }

        .close-btn {
            background: #e74c3c;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            float: right;
            cursor: pointer;
            margin-bottom: 10px;
        }

        .close-btn:hover {
            background: #ff6b6b;
        }
    </style>
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
        <th>Acciones</th>
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
                <button class="BotonesUsuarios" onclick="mostrarModal('carrito_ver.php', <?= $mostrar['id'] ?>, <?= $pagina ?>)">Ver</button> 
                <button class="BotonesUsuarios" onclick="mostrarModal('carrito_modificar.php', <?= $mostrar['id'] ?>, <?= $pagina ?>)">Modificar</button> 
                <a class="BotonesUsuarios" href="compra_eliminar.php?id=<?= $mostrar['id'] ?>&pag=<?= $pagina ?>" onClick="return confirm('¿Estás seguro de eliminar la compra <?= htmlspecialchars($mostrar['producto']) ?>?')">Eliminar</a>
            </td>
        </tr>
    <?php } ?>
    </table>

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

<div id="miModal" class="modal-overlay">
    <div class="modal-content">
        <button class="close-btn" onclick="cerrarModal()">Cerrar</button>
        <div id="contenidoModal">
        </div>
    </div>
</div>

<script>
function mostrarModal(archivo, id, pag) {
    const modal = document.getElementById('miModal');
    const contenido = document.getElementById('contenidoModal');
    
    modal.style.display = 'flex';
    contenido.innerHTML = '<p style="color:white">Cargando...</p>';

    fetch(`${archivo}?id=${id}&pag=${pag}`)
        .then(res => res.text())
        .then(html => {
            contenido.innerHTML = html;
        })
        .catch(() => {
            contenido.innerHTML = '<p style="color:red">Error al cargar contenido</p>';
        });
}

function cerrarModal() {
    document.getElementById('miModal').style.display = 'none';
}
</script>

</body>
</html>
