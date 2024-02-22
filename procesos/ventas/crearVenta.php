<?php
session_start();
require_once "../../clases/conexion.php";
require_once "../../clases/ventas.php";

$obj= new Venta();

if (count($_SESSION['tablasComprasTemp'])==0) {
    echo 0;
}else{
    $result=$obj->crearVenta();
    unset($_SESSION['tablasComprasTemp']);
    echo $result;
}