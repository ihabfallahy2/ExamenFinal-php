
<?php
session_start();
if(isset($_REQUEST["desconectar"])){
    session_unset(); 
  header("Location: login.php");
}
?>