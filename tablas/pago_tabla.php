<?php
include('../conexion.php');
include('../header.php');

$filasmax = 25;
$pagina = isset($_GET['pag']) ? intval($_GET['pag']) : 1;
$buscar = '';
$where = '';

// Procesar búsqueda (buscando en método de pago)
if (isset($_POST['btnbuscar']) && !empty($_POST['txtbuscar'])) {
    $buscar = mysqli_real_escape_string($conn, $_POST['txtbuscar']);
    $where = "WHERE p.metodo_pago LIKE '%$buscar%'";
}

// Contar total de registros para paginación
$sqlCount = "SELECT COUNT(*) as total FROM pago p $where";
$resultCount = mysqli_query($conn, $sqlCount);
$totalRegistros = mysqli_fetch_assoc($resultCount)['total'];

// Consulta para mostrar pagos
$offset = ($pagina - 1) * $filasmax;
$sql = "SELECT p.* 
        FROM pago p 
        $where 
        ORDER BY p.fecha_pago DESC 
        LIMIT $offset, $filasmax";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Lista de Pagos</title>
    <link rel="stylesheet" href="../styles/styles_tablas.css">
    <style> h1 { color: white; } </style>
</head>
<body>
<div class="ContenedorPrincipal">
    <div class="ContenedorTabla">
        <form method="POST" action="">
            <h1>Lista de Pagos</h1>
            <div style="text-align:left">
                <a href="pago_tabla.php" class="BotonesUsuarios">Inicio de la tabla</a>
                <input class="BotonesUsuarios" type="submit" value="Buscar" name="btnbuscar">
                <input class="CajaTexto" type="text" name="txtbuscar" placeholder="Ingresar método de pago" 
                autocomplete="off" style="width:20%" value="<?php echo htmlspecialchars($buscar); ?>">
            </div>
        </form>

        <table>
            <tr>
                <th>ID Pago</th>
                <th>Monto pagado</th>
                <th>Fecha pago</th>
                <th>Ubicación entrega</th>
                <th>Método de pago</th>
                <th>Acciones</th>
            </tr>

            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id_pago']); ?></td>
                    <td><?php echo htmlspecialchars(number_format($row['monto_pagado'], 2)); ?></td>
                    <td><?php echo htmlspecialchars($row['fecha_pago']); ?></td>
                    <td><?php echo htmlspecialchars($row['ubicacion_entrega']); ?></td>
                    <td><?php echo htmlspecialchars($row['metodo_pago']); ?></td>
                    <td style="width:24%">
                        <a class="BotonesUsuarios" href="../ver/pago_ver.php?id_pago=<?= $row['id_pago'] ?>&pag=<?= $pagina ?>">Ver</a> 
                        <a class="BotonesUsuarios" href="../modificar/pago_modificar.php?id_pago=<?= $row['id_pago'] ?>&pag=<?= $pagina ?>">Modificar</a> 
                        <a class="BotonesUsuarios" href="../eliminar/pago_eliminar.php?id_pago=<?= $row['id_pago'] ?>&pag=<?= $pagina ?>" 
                        onclick="return confirm('¿Estás seguro de eliminar el pago con ID <?= $row['id_pago'] ?>?')">Eliminar</a>
                    </td>
                </tr>
            <?php } ?>
        </table>

        <div style="text-align:right"><br>Total de registros: <?= $totalRegistros ?></div>
    </div>

    <div style="text-align:center; margin-top: 15px;">
        <?php
        if ($pagina > 1) {
            echo "<a class='BotonesUsuarios' href='pago_tabla.php?pag=" . ($pagina - 1) . "'>Anterior</a> ";
        } else {
            echo "<a class='BotonesUsuarios' href='#' style='pointer-events: none'>Anterior</a> ";
        }

        if (($pagina * $filasmax) < $totalRegistros) {
            echo "<a class='BotonesUsuarios' href='pago_tabla.php?pag=" . ($pagina + 1) . "'>Siguiente</a>";
        } else {
            echo "<a class='BotonesUsuarios' href='#' style='pointer-events: none'>Siguiente</a>";
        }
        ?>
    </div>
    <div style="margin-top: 10px;">
    <a href="../pdf/pdf_pagos.php" class="BotonesUsuarios">Descargar PDF</a>
</div>

</div>
</body>
</html>
