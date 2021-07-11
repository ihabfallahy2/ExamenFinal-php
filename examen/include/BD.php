<?php

require 'Usuario.php';
require 'Consulta.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BD
 *
 * @author usuario
 */
class BD {

    static function ejecutaConsulta($sql) {
        try {
            $opc = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
            $dsn = "mysql:host=localhost;dbname=junio";
            $dwes = new PDO($dsn, "root", "", $opc);
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
        $resultado = $dwes->query($sql);
        return $resultado;
    }

    public static function verificaCliente($nombre, $contrasena) {
        $sql = "SELECT nombre FROM usuario ";
        $sql .= "WHERE nombre='$nombre' ";
        $sql .= "AND password='" . md5($contrasena) . "';";
        $resultado = self::ejecutaConsulta($sql);
        $verificado = false;
        if (isset($resultado)) {
            $fila = $resultado->fetch();
            if ($fila !== false)
                $verificado = true;
        }
        return $verificado;
    }

    static function obtieneConsultas($usuario) {
        $sql = "select id, usuario, cantidad, criptomoneda, siglas, equivalencia, time from consulta where usuario='$usuario' ORDER BY time;";
        $resultado = self::ejecutaConsulta($sql);
        $consultas = array();
        if ($resultado) {
            // Añadimos un elemento por cada consulta obtenido
            $row = $resultado->fetch();
            while ($row != null) {
                $consultas[] = new Consulta($row);
                $row = $resultado->fetch();
            }
        }
        return $consultas;
    }

    public static function insertaConsulta($usuario, $cantidad, $criptomoneda, $siglas, $equivalencia) {
        $sql= "INSERT INTO consulta (usuario, cantidad, criptomoneda, siglas, equivalencia) VALUES ('$usuario', $cantidad, '$criptomoneda', '$siglas', $equivalencia)";
        self::ejecutaConsulta($sql);
    }

    public static function eliminarConsulta($usuario,$id){
        $sql="DELETE FROM consulta WHERE usuario='$usuario' AND id=$id;";
        self::ejecutaConsulta($sql);
    }

}