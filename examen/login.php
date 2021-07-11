<?php
// Comprobamos si ya se ha enviado el formulario    
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("./include/BD.php"); 

if (isset($_POST['enviar'])) {
    $usuario = $_POST['nombre'];
    $password = $_POST['contrasena'];
    if (empty($usuario) || empty($password))
    echo '<script type="text/javascript">alert("Debes introducir un nombre de usuario y una contraseña!");</script>';
    else {
        if (BD::verificaCliente($usuario, $password)) {
            session_start();
            $user = new Usuario();
            $user->nombre = $usuario;
            $user->contrasena = $password;
            $_SESSION['usuario'] = serialize($user);
            header("Location: consultas.php");
        } else {
            // Si las credenciales no son válidas, se vuelven a pedir
            $error = "Usuario o contraseña no válidos!";
        }
    }
}
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->
    <!-- <h2 class="active"> Sign In </h2> -->
    <h2 class="inactive underlineHover"> LOGIN </h2>

    <!-- Icon -->
    <div class="fadeIn first">
      <img src="../crud/contenido/icons8-contacts-100.png" id="icon" alt="User Icon" />
    </div>

    <!-- Login Form -->
    <form action="" method="post">
      <input type="text" id="login" class="fadeIn second" name="nombre" placeholder="login">
      <input type="text" id="password" class="fadeIn third" name="contrasena" placeholder="password">
      <input type="submit" class="fadeIn fourth" value="Log In" name="enviar">
    </form>

    <!-- Remind Passowrd -->
    <div id="formFooter">
      <a class="underlineHover" href="#">By Ihab Fallahy Aallam</a>
    </div>

  </div>
</div>
</body>
</html>

