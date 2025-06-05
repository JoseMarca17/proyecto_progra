<?php
include("conexion.php");
include("header.php")
?>  
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Registrar Producto</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
   <main>
    <div class="FormCajaLogin">
        <div class="FormLogin">
            <form method="post">
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

                <br>
                <input type="submit" name="btnregistrar" value="Registrar Producto" class="BtnRegistrar">
            </form>

            <hr><br>

            <div>
                <a href="inicio.php" class="BtnLogin">Volver</a>
            </div>
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

<?php
if (isset($_POST["btnregistrar"])) {
    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    $precio = $_POST["precio"];
    $categoria = $_POST["categoria"];
    $talla = $_POST["talla"];

    $sql = "INSERT INTO producto (nombre, descripcion, precio, categoria, talla) 
            VALUES ('$nombre', '$descripcion', '$precio', '$categoria', '$talla')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert(' Producto registrado correctamente');</script>";
    } else {
        echo "<script>alert(' Error: " . mysqli_error($conn) . "');</script>";
    }
}
?>
