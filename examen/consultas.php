<?php
include("include/BD.php");
session_start();
if(isset($_SESSION['usuario'])){
    // $usuario = $_SESSION['usuario'];
    $user = unserialize($_SESSION['usuario']);
}else{
    die("Error - debe <a href='login.php'>identificarse</a>.<br />");
}
    $nombre=$user->nombre;
?>
<br>
<hr>
<br>

<?php
    echo "<form action='consultas.php' method='post'>";
    echo "<input type='number' name='cantidad' placeholder='CANTIDAD'>";
    $fh = fopen("monedas.txt", 'r') or die("Se produjo un error al abrir el archivo");
    echo "<select name='moneda'>";    
    while($linea = fgets($fh)){
      $trimmed = rtrim($linea);
      echo "<option value='$trimmed'>$trimmed</option>";
    }
    echo "</select>";
    fclose($fh);
    echo "<input type='submit' value='Enviar' name='enviar'>";
    echo "</form>";

    if(isset($_REQUEST['enviar'])){
        $curl = curl_init();
        $id = $_REQUEST['moneda'];
        $cantidad = $_REQUEST['cantidad'];
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.coincap.io/v2/assets/$id",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "accept: application/json",
                "content-type: application/json"
            ),
        ));
        $err = curl_error($curl);
        $datos_json = curl_exec($curl);
        curl_close($curl);
        $datos_php = json_decode($datos_json, true);
        
        echo "<br>";
        $c = $datos_php["data"];
        $siglas = $c["symbol"];
        $precio = $c["priceUsd"];
        
        $calculo = ($cantidad*1)/$c["priceUsd"];
        
        BD::insertaConsulta($nombre,$cantidad,$id,$siglas,$calculo);
    }

        echo
        "<hr>
        <br>";
?>

<table border>
            <tr>
                <th>Codigo</th>
                <th>Usuario</th>
                <th>cantidad</th>
                <th>criptomoneda</th>
                <th>siglas</th>
                <th>equivalencia</th>
                <th>time</th>
                <th>Eliminar</th>
            </tr>
        <?php
        $consultas = BD::obtieneConsultas($nombre);
        foreach($consultas as $c){
            echo '<tr>';
            echo '<td>' . $c->getId() . '</td>';
            echo '<td>' . $c->getUsuario() . '</td>';
            echo '<td>' . $c->getCantidad() . '</td>';
            echo '<td>' . $c->getCriptomoneda() . '</td>';
            echo '<td>' . $c->getSiglas() . '</td>';
            echo '<td>' . $c->getEquivalencia() . '</td>';
            echo '<td>' . $c->getTime() . '</td>';
            echo "<td><a href='eliminar.php?codigo=" . $c->getId() . "'>Eliminar</a>";
            echo '</tr>';           
        }
        echo "</table>";
        ?>

        <br>

        <div id="pie">     
                <form action='logoff.php' method='post'>         
                    <input type='submit' name='desconectar' value='Desconectar a    <?php echo $nombre; ?>'/>     
                </form>         
            </div> 