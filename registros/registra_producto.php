<?php
session_start();
include('../conexion.php');
include('../header.php');

// Validar que esté iniciada la sesión
if (!isset($_SESSION['id_usuario'])) {
    echo "<script>alert('❌ Debes iniciar sesión para registrar productos'); window.location='../login.php';</script>";
    exit();
}

$id_admin = $_SESSION['id_usuario'];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Registrar Producto</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../styles.css">
    <style>
        main {
            padding: 100px;
            width: 50%;
            margin: 0 auto;
            height: 100vh;
            color: white;
        }
    </style>
</head>
<body>

<main>
    <div class="FormCajaLogin">
        <div class="FormLogin">
            <form method="post" enctype="multipart/form-data">
                <h2>🛍 Registrar Nuevo Producto</h2>

                <div class="TextoCajas">• Nombre del producto</div>
                <input type="text" name="nombre" class="CajaTexto" required>

                <div class="TextoCajas">• Descripción</div>
                <textarea name="descripcion" class="CajaTexto" rows="4" required></textarea>

                <div class="TextoCajas">• Precio</div>
                <input type="number" name="precio" class="CajaTexto" step="0.01" required>

                <div class="TextoCajas">• Categoría</div>
                <select name="categoria" class="CajaTexto" required>
                    <option value="">-- Seleccione una categoría --</option>
                    <option value="Camisas">Camisas</option>
                    <option value="Pantalones">Pantalones</option>
                    <option value="Chaquetas">Chaquetas</option>
                    <option value="Vestidos">Vestidos</option>
                    <option value="Polera">Poleras</option>
                </select>

                <div class="TextoCajas">• Talla</div>
                <select name="talla" class="CajaTexto" required>
                    <option value="">-- Seleccione talla --</option>
                    <option value="S">S</option>
                    <option value="M">M</option>
                    <option value="L">L</option>
                    <option value="XL">XL</option>
                </select>

                <div class="TextoCajas">• Imagen del producto</div>
                <input type="file" name="imagen" class="CajaTexto" accept="image/*" required>

                <br><br>
                <input type="submit" name="btnregistrar" value="Registrar Producto" class="BtnRegistrar">
            </form>

            <hr><br>

            <div>
                <a href="../inicio.php" class="BtnLogin">Volver</a>
            </div>
        </div>
    </div>
</main>

</body>
</html>

<?php
if (isset($_POST["btnregistrar"])) {
    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    $precio = $_POST["precio"];
    $categoria = $_POST["categoria"];
    $talla = $_POST["talla"];

    // Usar sesión para id_admin
    $id_admin = $_SESSION["id_usuario"];

    $imagen = $_FILES['imagen']['name'];
    $ruta_temporal = $_FILES['imagen']['tmp_name'];
    $carpeta_destino = "../imagenes/";
    $ruta_destino = $carpeta_destino . basename($imagen);

    if (move_uploaded_file($ruta_temporal, $ruta_destino)) {
        $ruta_bd = "imagenes/" . basename($imagen);

        $sql = "INSERT INTO producto (nombre, descripcion, precio, categoria, talla, imagen, id_admin) 
                VALUES ('$nombre', '$descripcion', '$precio', '$categoria', '$talla', '$ruta_bd', '$id_admin')";

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('✅ Producto registrado correctamente');</script>";
        } else {
            echo "<script>alert('❌ Error: " . mysqli_error($conn) . "');</script>";
        }
    } else {
        echo "<script>alert('❌ Error al subir la imagen');</script>";
    }
}
?>
