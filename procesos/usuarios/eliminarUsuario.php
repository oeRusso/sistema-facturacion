<?php

require_once '../../clases/conexion.php';
require_once '../../clases/usuarios.php';

$obj = new Usuarios();

$iduser = $_POST['idusuario'];


echo $obj->eliminaUsuario($iduser);