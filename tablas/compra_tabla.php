<?php
include('../conexion.php');
include('../header.php');

$filasmax = 25;
$pagina = isset($_GET['pag']) ? intval($_GET['pag']) : 1;
$buscar = '';
$where = '';

// Procesar búsqueda
if (isset($_POST['btnbuscar']) && !empty($_POST['txtbuscar'])) {
    $buscar = mysqli_real_escape_string($conn, $_POST['txtbuscar']);
    $where = "WHERE c.nombre_producto LIKE '%$buscar%'";
}

// Contar total de registros para paginación
$sqlCount = "SELECT COUNT(*) as total FROM compra c $where";
$resultCount = mysqli_query($conn, $sqlCount);
$totalRegistros = mysqli_fetch_assoc($resultCount)['total'];

// Consulta con JOIN para mostrar datos de compra y cliente
$offset = ($pagina - 1) * $filasmax;
$sql = "SELECT c.*, u.nombre AS cliente_nombre, u.apellido AS cliente_apellido 
        FROM compra c 
        JOIN usuarios u ON c.id_cliente = u.id_usuario
        $where 
        ORDER BY c.fecha_compra DESC 
        LIMIT $offset, $filasmax";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Lista de Compras</title>
    <link rel="stylesheet" href="../styles/styles_tablas.css">
    <style>
        h1 { color: white; }
    </style>
</head>
<body>
<div class="ContenedorPrincipal">

    <div class="ContenedorTabla">
        <form method="POST" action="">
            <h1>Lista de Compras</h1>

            <div style="text-align:left">
                <a href="compra_tabla.php" class="BotonesUsuarios">Inicio de la tabla</a>
                <input class="BotonesUsuarios" type="submit" value="Buscar" name="btnbuscar">
                <input class="CajaTexto" type="text" name="txtbuscar" placeholder="Ingresar producto" autocomplete="off" style="width:20%" value="<?php echo htmlspecialchars($buscar); ?>">
            </div>
        </form>

        <table>
            <tr>
                <th>ID Compra</th>
                <th>Cliente</th>
                <th>Producto</th>
                <th>Fecha Compra</th>
                <th>Total</th>
                <th>Acciones</th>
            </tr>

            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id_compra']); ?></td>
                    <td><?php echo htmlspecialchars($row['cliente_nombre'] . ' ' . $row['cliente_apellido']); ?></td>
                    <td><?php echo htmlspecialchars($row['nombre_producto']); ?></td>
                    <td><?php echo htmlspecialchars($row['fecha_compra']); ?></td>
                    <td><?php echo htmlspecialchars(number_format($row['total'], 2)); ?></td>
                    <td style="width:24%">
                        <a class="BotonesUsuarios" href="../ver/compra_ver.php?id=<?php echo $row['id_compra']; ?>&pag=<?php echo $pagina; ?>">Ver</a> 
<a class="BotonesUsuarios" href="../modificar/compra_modificar.php?id=<?php echo $row['id_compra']; ?>&pag=<?php echo $pagina; ?>">Modificar</a> 
<a class="BotonesUsuarios" href="../eliminar/compra_eliminar.php?id=<?php echo $row['id_compra']; ?>&pag=<?php echo $pagina; ?>" onclick="return confirm('¿Estás seguro de eliminar la compra <?php echo htmlspecialchars($row['nombre_producto']); ?>?')">Eliminar</a>

                    </td>
                </tr>
            <?php } ?>
        </table>

        <div style="text-align:right">
            <br>
            <?php echo "Total de registros: " . $totalRegistros; ?>
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
        if (($pagina * $filasmax) < $totalRegistros) {
            $next = $pagina + 1;
            echo "<a class='BotonesUsuarios' href='compra_tabla.php?pag=$next'>Siguiente</a>";
        } else {
            echo "<a class='BotonesUsuarios' href='#' style='pointer-events: none'>Siguiente</a>";
        }
        ?>
        <a href="../pdf/pdf_compras.php" class="BotonesUsuarios">Descargar PDF</a>
    </div>

</div>
</body>
</html>
