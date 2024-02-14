<?php
require_once '../../clases/conexion.php';
require_once '../../clases/categorias.php';



$datos = array(
    $_POST['idCategoria'],
    $_POST['categoriaU']
);

$obj = new Categorias();

echo $obj->actualizaCategoria($datos);