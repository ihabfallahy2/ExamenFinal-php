<?php
include("include/BD.php");
session_start();
if(isset($_SESSION['usuario'])){
    $user = unserialize($_SESSION['usuario']);
    $nombre=$user->nombre;
}else{
    die("Error - debe <a href='login.php'>identificarse</a>.<br />");
}

if(isset($_REQUEST['codigo'])){
    $cod = $_REQUEST['codigo'];
    BD::eliminarConsulta($nombre,$cod);
    header("Location: consultas.php");
}
?>