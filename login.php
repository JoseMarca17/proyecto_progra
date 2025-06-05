<?php
session_start();
include('conexion.php');
if(isset($_SESSION['usuarioingresando']))
{
	header('location: principal.php');
}
?>

<html>
  <head>
  <title> usuarios </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles/style_login.css">
  </head>
<body>
<div class="FormCajaLogin">
<<<<<<< HEAD
  <img src="images/logo.svg" alt="logo" width="200" height="100">
  <style>
    img{
      display: block;
      margin: 100px;
      padding: 50px;
    }
  </style>
  <div class="FormLogin">
    <form method="POST">
      <h1>Iniciar sesión</h1>
=======
>>>>>>> 1e53ca60fd1501f06a4a22709da53ff85385e51b

 <!-- Imagen Izquierda -->
<div class="ContenedorImagenIzquierda"></div>

<!-- Formulario -->
<div class="FormLogin">
  <form method="POST">
    <h1>Iniciar sesión</h1>

    <div class="TextoCajas">• Ingresar correo</div>
    <input type="text" name="txtcorreo" class="CajaTexto" required>

    <div class="TextoCajas">• Ingresar password</div>
    <input type="password" id="txtpassword" name="txtpassword" class="CajaTexto" required>

    <div class="CheckBox1">
      <input type="checkbox" onClick="verpassword()"> Mostrar password
    </div>

    <input type="submit" value="Iniciar sesión" class="BtnLogin" name="btningresar">
    <hr>
    <a href="registrar_usuario.php" class="BtnRegistrar">Crea nueva cuenta</a>
  </form>
</div>

</body>

<script>

function verpassword()
  {
  var tipo = document.getElementById("txtpassword");
    if(tipo.type == "password"){
        tipo.type = "text";
      }else{
        tipo.type = "password";
      }
  }
</script>
</html>
<?php
  if(isset($_POST['btningresar'])){
    $correo = $_POST["txtcorreo"];
    $pass 	= $_POST["txtpassword"];
    $buscandousu = mysqli_query($conn,"SELECT * FROM usuarios WHERE correo = '".$correo."' and password = '".$pass."'");
    $nr = mysqli_num_rows($buscandousu);
    if($nr == 1){
      $_SESSION['usuarioingresando']=$correo;
      header("Location: Ptlprpl.html");
    }else if ($nr == 0) {
      echo "<script> alert('Usuario no existe');window.location= 'login.php' </script>";
    }
  }
?>