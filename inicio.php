<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Inicio | Sistema de Gestión</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles/styles.css"> 
</head>
<body>
    <?php include 'header.html'; ?> 
    <main>
        <div class="FormCajaLogin">
            <h1 style="text-align: center;">Sistema de Gestión</h1>
            <p style="text-align: center;">Bienvenido, selecciona una opción:</p>
            <div class="FormLogin" style="text-align: center; display: flex; flex-direction: column; gap: 20px; align-items: center;">
                <a href="registrar_usuario.php" class="BtnLogin">👤 Registrar Usuario</a>
                <a href="registrar_producto.php" class="BtnLogin">📦 Registrar Producto</a>
                <a href="registrar_compra.php" class="BtnLogin">🛒 Registrar Compra</a>
                <a href="indice_tablas.php" class="BtnLogin">📋 Ver tablas</a>
            </div>
        </div>
    </main>
</body>
</html>
