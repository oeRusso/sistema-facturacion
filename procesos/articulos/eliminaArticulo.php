<?php



require_once '../../clases/conexion.php';
require_once '../../clases/articulos.php';

$idart = $_POST['idarticulo'];

$obj = new Articulos();

echo $obj->eliminaArticulo($idart);
