<?php
$curl = curl_init();
$id="bitcoin";
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

$datos_json = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);
$datos_php = json_decode($datos_json, true);
// var_dump($datos_php);
$c = $datos_php["data"];
echo "simbolo -> ".$c["symbol"];
echo "<br>";
echo "precio -> ".$c["priceUsd"];

?>
<!-- https://api.coincap.io/v2/assets
https://covid-api.mmediagroup.fr/v1/cases?ab=$pais -->