<?php
include('conexion.php');
include("header.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registros</title>
  <link rel="stylesheet" href="styles/styles_tablas.css"> 
</head>
<body>
<div class="ContenedorPrincipal">	

<?php
$filasmax = 25;
$pagina = isset($_GET['pag']) ? $_GET['pag'] : 1;

if (isset($_POST['btnbuscar'])) {
    $buscar = $_POST['txtbuscar'];
    $sqlusu = mysqli_query($conn, "SELECT * FROM pago_prueba WHERE correo = '$buscar'"); 
} else {
    $sqlusu = mysqli_query($conn, "SELECT * FROM pago_prueba ORDER BY monto_pagado DESC LIMIT " . (($pagina - 1) * $filasmax) . ", $filasmax");
}

$resultadoMaximo = mysqli_query($conn, "SELECT count(*) as total FROM pago_prueba");
$maxusutabla = mysqli_fetch_assoc($resultadoMaximo)['total'];
?>

<div class="ContenedorTabla">
  <form method="POST">
    <h1>Lista de Pagos</h1>
    <style>
      h1{
        color:white;
      }
    </style>

    <div style="text-align:left">
      <a href="pago_tabla.php" class="BotonesUsuarios">Inicio de la tabla</a>
      <input class="BotonesUsuarios" type="submit" value="Buscar" name="btnbuscar">
      <input class="CajaTexto" type="text" name="txtbuscar" placeholder="metodo" autocomplete="off" style='width:20%'>
    </div>

    <div class="tabla_datos">
  </form>

  <table>
    <tr>
      <th>Monto pagado</th>
      <th>Fecha pago</th>
      <th>Ubicación entrega</th>
      <th>Método de pago</th>
    </tr>

<?php
while ($mostrar = mysqli_fetch_assoc($sqlusu)) {
    echo "<tr>";
    echo "<td>" . $mostrar['monto_pagado'] . "</td>";
    echo "<td>" . $mostrar['fecha_pago'] . "</td>";
    echo "<td>" . $mostrar['ubicacion_entrega'] . "</td>";
    echo "<td>" . $mostrar['metodo_pago'] . "</td>";
    
}
?>
  </table>
</div>

<div style='text-align:right'>
  <br>
  <?php echo "Total de usuarios: " . $maxusutabla; ?>
</div>

<div style="text-align:center">
  <br>

<?php
// Botón ANTERIOR
if ($pagina > 1) {
    echo "<a class='BotonesUsuarios' href='usuarios_tabla.php?pag=" . ($pagina - 1) . "'>Anterior</a>";
} else {
    echo "<a class='BotonesUsuarios' href='#' style='pointer-events: none'>Anterior</a>";
}

// Botón SIGUIENTE
if (($pagina * $filasmax) < $maxusutabla) {
    echo "<a class='BotonesUsuarios' href='usuarios_tabla.php?pag=" . ($pagina + 1) . "'>Siguiente</a>";
} else {
    echo "<a class='BotonesUsuarios' href='#' style='pointer-events: none'>Siguiente</a>";
}
?>
</div>

</div>
</body>
</html>
