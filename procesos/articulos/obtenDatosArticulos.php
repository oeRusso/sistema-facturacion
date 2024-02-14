<?php
require_once '../../clases/conexion.php';
require_once '../../clases/articulos.php';

$obj = new Articulos();

$idart = $_POST['idart'];


echo json_encode($obj->obtenDatosArticulos($idart));
