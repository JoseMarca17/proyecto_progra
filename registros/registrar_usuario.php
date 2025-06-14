<?php
session_start();
include('../conexion.php');
include('../header.php');
?>

<html>

<head>
    <title>Crear cuenta</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../styles.css">
</head>

<body>
    <main>
        <div class="FormCajaLogin">
            <div class="FormLogin">
                <form method="post">
                    <h1>Crear nueva cuenta</h1><br>

                    <div class="TextoCajas">• Ingresar nombre</div>
                    <input type="text" name="txtnombre" class="CajaTexto" required>

                    <div class="TextoCajas">• Ingresar apellidos</div>
                    <input type="text" name="txtapellido" class="CajaTexto" required>

                    <div class="TextoCajas">• Ingresar su teléfono</div>
                    <input type="text" name="txttelefono" class="CajaTexto" required>

                    <div class="TextoCajas">• Seleccionar ubicación</div>
                    <select name="txtubicacion" class="CajaTexto" required>
                        <option value="">-- Seleccione un departamento --</option>
                        <option value="La Paz">La Paz</option>
                        <option value="Santa Cruz">Santa Cruz</option>
                        <option value="Cochabamba">Cochabamba</option>
                        <option value="Oruro">Oruro</option>
                        <option value="Potosí">Potosí</option>
                        <option value="Chuquisaca">Chuquisaca</option>
                        <option value="Tarija">Tarija</option>
                        <option value="Beni">Beni</option>
                        <option value="Pando">Pando</option>
                    </select>

                    <div class="TextoCajas">• Ingresar correo</div>
                    <input type="email" name="txtcorreo" class="CajaTexto" required>

                    <div class="TextoCajas">• Ingresar Carnet de Identidad</div>
                    <input type="text" id="txtcarnet" name="txtcarnet" class="CajaTexto" required>

                    <div class="TextoCajas">• Ingresar password</div>
                    <input type="password" id="txtpassword" name="txtpassword" class="CajaTexto" required>

                    <div class="CheckBox1">
                        <input type="checkbox" onClick="verpassword()"> Mostrar password
                    </div>

                    <div>
                        <input type="submit" value="Crear nueva cuenta" class="BtnRegistrar" name="btnregistrar">
                    </div>
                </form>

                <hr><br>
                <div>
                    <a href="/SISTEMA_PROYECTO/cerrar_sesion.php" class="BtnLogin">Volver</a>
                </div>
            </div>
        </div>
    </main>

    <style>
        main {
            padding: 100px;
            width: 50%;
            margin: 0 auto;
            height: 20vh;
        }
    </style>

    <script>
        function verpassword() {
            var tipo = document.getElementById("txtpassword");
            tipo.type = (tipo.type === "password") ? "text" : "password";
        }
    </script>
</body>

</html>

<?php
if (isset($_POST["btnregistrar"])) {
    $nomuser = $_POST["txtnombre"];
    $apellido = $_POST["txtapellido"];
    $telefono = $_POST["txttelefono"];
    $ubicacion = $_POST["txtubicacion"];
    $ci = $_POST["txtcarnet"];
    $email = $_POST["txtcorreo"];
    $contra = $_POST["txtpassword"];
    $rol = 'cliente';

    $sql = "INSERT INTO usuarios(nombre, apellido, correo, telefono, ubicacion, ci, password, rol)
            VALUES ('$nomuser', '$apellido', '$email', '$telefono', '$ubicacion', '$ci', '$contra', '$rol')";

    $insertarusu = mysqli_query($conn, $sql);

    if ($insertarusu) {
        echo "<script>
                alert('Registro exitoso $nomuser');
                window.location.href = '../login.php';
</script>";
    } else {
        echo "<script>alert('Error en registro, posiblemente correo duplicado');</script>";
    }
}
?>