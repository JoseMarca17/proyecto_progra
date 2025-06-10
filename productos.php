<?php
include('conexion.php');
include('header.php');
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <title>Catálogo de Productos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="styles/style_producto.css">
</head>

<body>
    <h1 style="text-align:center; margin-top:40px;">Catálogo de Productos</h1>
    <div class="productos-container">
        <?php
        $res = $conn->query("SELECT * FROM producto");
        while ($p = $res->fetch_assoc()):
        ?>
            <div class="producto-card">
                <img src="<?php echo htmlspecialchars($p['imagen']); ?>" alt="<?php echo htmlspecialchars($p['nombre']); ?>">
                <div class="producto-info">
                    <h3><?php echo htmlspecialchars($p['nombre']); ?></h3>
                    <p class="descripcion"><?php echo nl2br(htmlspecialchars($p['descripcion'])); ?></p>
                    <p class="precio">Bs. <?php echo number_format($p['precio'], 2, ',', '.'); ?></p>
                    <a href="registros/registra_compra.php?id_producto=<?php echo $p['id_producto']; ?>" class="btn-comprar">Comprar</a>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</body>

</html>