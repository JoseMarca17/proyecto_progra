<?php
session_start();
include('../conexion.php');
include('../header.php');

if (!isset($_SESSION['id_usuario'])) die("Acceso denegado.");

$id_producto = intval($_GET['id_producto'] ?? 0);
if ($id_producto <= 0) die("Producto no válido.");

$r = $conn->query("SELECT * FROM producto WHERE id_producto = $id_producto");
if (!$r || !$producto = $r->fetch_assoc()) die("Producto no encontrado");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnconfirmar'])) {
    $cantidad = intval($_POST['cantidad']);
    $talla = $conn->real_escape_string($_POST['talla']);
    $total = floatval($_POST['total']);

    $sql = "
      INSERT INTO compra (id_cliente, nombre_producto, cantidad, talla, total, fecha_compra)
      VALUES (
        {$_SESSION['id_usuario']},
        '{$conn->real_escape_string($producto['nombre'])}',
        $cantidad,
        '$talla',
        $total,
        NOW()
      )";
    if ($conn->query($sql)) {
        $id_compra = $conn->insert_id;
        header("Location: registra_pago.php?id_compra=$id_compra");
        exit();
    } else {
        echo "<script>alert('Error al registrar compra: " . $conn->error . "');</script>";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Comprar Producto</title>
    <link rel="stylesheet" href="../styles.css">
    <script>
        function actualizarTotal() {
            let precio = parseFloat(document.getElementById('precio').value) || 0;
            let cantidad = parseInt(document.getElementById('cantidad').value) || 1;
            let total = precio * cantidad;
            document.getElementById('total').value = total.toFixed(2);
            document.getElementById('total_mostrar').value = total.toFixed(2);
        }
    </script>
</head>

<body>
    <div class="pagina-login">
        <form method="post" class="FormCajaLogin" oninput="actualizarTotal()">
            <h1>🛍️ Comprar: <?= htmlspecialchars($producto['nombre']) ?></h1>

            <label class="TextoCajas" for="precio">Precio unitario:</label>
            <input id="precio" name="precio" value="<?= $producto['precio'] ?>" readonly class="CajaTexto">

            <label class="TextoCajas" for="cantidad">Cantidad:</label>
            <input type="number" id="cantidad" name="cantidad" value="1" min="1" required class="CajaTexto">

            <label class="TextoCajas" for="talla">Talla:</label>
            <select name="talla" id="talla" required class="CajaTexto">
                <option value="">Seleccione</option>
                <option>XS</option>
                <option>S</option>
                <option>M</option>
                <option>L</option>
                <option>XL</option>
            </select>

            <label class="TextoCajas" for="total_mostrar">Total:</label>
            <input id="total_mostrar" readonly class="CajaTexto">

            <input type="hidden" name="total" id="total">

            <button type="submit" name="btnconfirmar" class="BtnRegistrar">Proceder a pagar</button>
        </form>
    </div>
</body>

</html>