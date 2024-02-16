<?php

require_once '../../clases/conexion.php';
require_once '../../clases/usuarios.php';

$obj = new Usuarios();

$idusuario = $_POST['idusuario'];
 

echo json_encode($obj->obtenDatosUsuarios($idusuario));
