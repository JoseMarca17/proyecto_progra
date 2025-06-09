<?php include 'header.php'; ?> 
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Inicio | Sistema de Gestión</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles.css"> 
</head>
<body>
<main>
    <div class="FormCajaLogin">
        <h1 style="text-align: center;">Sistema de Gestión</h1>
        <p style="text-align: center;">Bienvenido, selecciona una opción:</p>

        <div class="FormLogin" style="
            text-align: center;
            display: flex;
            flex-direction: column;
            gap: 20px;
            align-items: center;
        ">
            <a href="tablas/usuario_tabla.php" class="BtnLogin">👤 Tabla Usuario</a>
            <a href="tablas/producto_tabla.php" class="BtnLogin">📦 Tabla Producto</a>
            <a href="tablas/compra_tabla.php" class="BtnLogin">🛒 Tabla Compra</a>
            <a href="tablas/pago_tabla.php" class="BtnLogin">📋 Tabla Pagos</a>
            <a href="inicio.php" class="BtnLogin">🔙 Volver</a>
        </div>
    </div>
</main>

<style>
    main{
            padding: 100px;
            width: 50%; 
            margin: 0 auto;
            height: 100vh;
            color:white;
    }

</style>
</body>
</html>
