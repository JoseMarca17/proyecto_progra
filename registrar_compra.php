<?php
include("conexion.php");
?>
<?php include 'header.html'; ?> 
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Registrar Compra</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>

<div class="FormCajaLogin">
    <div class="FormLogin">
        <form method="post">
            <h2>🛍️ Comprar Producto</h2>

            <div class="TextoCajas">• Producto</div>
            <input type="text" name="producto" class="CajaTexto" required>

            <div class="TextoCajas">• Precio Unitario</div>
            <input type="number" step="0.01" name="precio" class="CajaTexto" required>

            <div class="TextoCajas">• Cantidad</div>
            <input type="number" name="cantidad" class="CajaTexto" required>

            <div class="TextoCajas">• Talla</div>
            <input type="text" name="talla" class="CajaTexto" required>

            <br>
            <input type="submit" name="btncomprar" value="Comprar" class="BtnRegistrar">
        </form>
        <br>
        <a href="inicio.php" class="BtnLogin">Volver</a>
    </div>
</div>

</body>
</html>

<?php
if (isset($_POST["btncomprar"])) {
    $producto = $_POST["producto"];
    $precio = $_POST["precio"];
    $cantidad = $_POST["cantidad"];
    $talla = $_POST["talla"];
    $fecha_compra = date("Y-m-d H:i:s");
    $total = $precio * $cantidad;

    $sql = "INSERT INTO compra_prueba(producto, precio, cantidad, talla, total, fecha_compra)
            VALUES ('$producto', '$precio', '$cantidad', '$talla', '$total', '$fecha_compra')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>
                alert('Compra registrada correctamente');
                window.location.href = 'registro_pago.php';
              </script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}
?>
