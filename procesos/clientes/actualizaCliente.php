<?php

session_start();
require_once '../../clases/conexion.php';
require_once '../../clases/clientes.php';

$obj = new Clientes();



$datos = array(
    $_POST['idClienteU'],
    $_POST['nombreU'],
    $_POST['apellidoU'],
    $_POST['direccionU'],
    $_POST['emailU'],
    $_POST['telefonoU'],
    $_POST['rfcU']
);


echo $obj->actualizaCliente($datos);