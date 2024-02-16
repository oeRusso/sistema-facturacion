<?php

require_once '../../clases/conexion.php';
require_once '../../clases/usuarios.php';

$obj = new Usuarios();


$datos = array(
    $_POST['idUsuario'],
    $_POST['nombreU'],
    $_POST['apellidoU'],
    $_POST['usuarioU']
);

echo $obj->actualizaUsuario($datos);
