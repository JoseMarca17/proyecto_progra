<?php include 'header.php'; ?> 
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Inicio | Sistema de Gestión</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles/styles.css"> 
</head>
<body>

<div class="FormCajaLogin">
    <h1 style="text-align: center;">Sistema de Gestión</h1>
    <p style="text-align: center;">Bienvenido, selecciona una opción:</p>

    <div class="FormLogin" style="text-align: center; display: flex; flex-direction: column; gap: 20px; align-items: center;">
        <a href="usuario_tabla.php" class="BtnLogin">👤 Tabla Usuario</a>
        <a href="producto_tabla.php" class="BtnLogin">📦 Tabla Producto</a>
        <a href="compra_tabla.php" class="BtnLogin">🛒 Tabla Compra</a>
        <a href="pago_tabla.php" class="BtnLogin">📋 Tabla Pagos</a>
        <a href="inicio.php" class="BtnLogin"> 🔙 Volver</a>

    </div>
</div>
</body>
</html>
