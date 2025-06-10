<?php
session_start();
include('conexion.php');

if (isset($_SESSION['usuarioingresando'])) {
  header('Location: Ptlprpl.php');
  exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Usuarios</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="styles/style_login.css" />
</head>
<body>
  <div class="FormCajaLogin">
    <div class="ContenedorImagenIzquierda"></div>

    <div class="FormLogin">
      <form method="POST" autocomplete="off">
        <h1>Iniciar sesión</h1>

        <div class="TextoCajas">• Ingresar correo</div>
        <input type="email" name="txtcorreo" class="CajaTexto" required>

        <div class="TextoCajas">• Ingresar password</div>
        <input type="password" id="txtpassword" name="txtpassword" class="CajaTexto" required>

        <div class="CheckBox1">
          <input type="checkbox" id="mostrarPass" onClick="verpassword()"> Mostrar password
        </div>

        <input type="submit" value="Iniciar sesión" class="BtnLogin" name="btningresar">
        <hr>
        <a href="registros/registrar_usuario.php" class="BtnRegistrar">Crea nueva cuenta</a>
      </form>
    </div>
  </div>

  <script>
    function verpassword() {
      var tipo = document.getElementById("txtpassword");
      tipo.type = tipo.type === "password" ? "text" : "password";
    }
  </script>
</body>
</html>

<?php
if (isset($_POST['btningresar'])) {
  $correo = $_POST["txtcorreo"];
  $pass = $_POST["txtpassword"];

  $stmt = $conn->prepare("SELECT id_usuario, nombre, correo, rol, password FROM usuarios WHERE correo = ?");
  $stmt->bind_param("s", $correo);
  $stmt->execute();
  $resultado = $stmt->get_result();

  if ($resultado->num_rows === 1) {
    $fila = $resultado->fetch_assoc();
    $passwordBD = $fila['password'];

    // Validar hash SHA-256
    if (strlen($passwordBD) === 64 && ctype_xdigit($passwordBD)) {
      if (hash('sha256', $pass) === $passwordBD) {
        $_SESSION['id_usuario'] = $fila['id_usuario'];      // <-- clave para el registro producto
        $_SESSION['usuarioingresando'] = $correo;
        $_SESSION['usuario'] = $fila['nombre'];
        $_SESSION['rol'] = $fila['rol'];
        echo "<script>alert('¡Bienvenido, " . addslashes($fila['nombre']) . "!'); window.location='Ptlprpl.php';</script>";
        exit();
      } else {
        echo "<script>alert('Usuario o contraseña incorrectos'); window.location='login.php';</script>";
      }
    } else {
      // Contraseña en texto plano (no recomendado)
      if ($pass === $passwordBD) {
        $_SESSION['id_usuario'] = $fila['id_usuario'];      // <-- clave para el registro producto
        $_SESSION['usuarioingresando'] = $correo;
        $_SESSION['usuario'] = $fila['nombre'];
        $_SESSION['rol'] = $fila['rol'];
        echo "<script>alert('¡Bienvenido, " . addslashes($fila['nombre']) . "!'); window.location='Ptlprpl.php';</script>";
        exit();
      } else {
        echo "<script>alert('Usuario o contraseña incorrectos'); window.location='login.php';</script>";
      }
    }
  } else {
    echo "<script>alert('Usuario o contraseña incorrectos'); window.location='login.php';</script>";
  }

  $stmt->close();
}
?>
