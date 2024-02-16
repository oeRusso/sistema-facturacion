<?php

require_once '../../clases/conexion.php';
require_once '../../clases/articulos.php';

$obj = new Articulos();
$datos = array(
    $_POST['idArticulo'],
    $_POST['categoriaSelectU'],
    $_POST['nombreU'],
    $_POST['descripcionU'],
    $_POST['cantidadU'],
    $_POST['precioU']

);

echo $obj->actualizaArticulos($datos);
