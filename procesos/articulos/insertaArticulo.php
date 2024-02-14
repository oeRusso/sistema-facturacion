<?php
session_start();
$idUser=$_SESSION['iduser'];
require_once "../../clases/conexion.php";
require_once "../../clases/articulos.php";


$obj = new Articulos();


$select = $_POST['categoriaSelect'];
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$cantidad = $_POST['cantidad'];
$precio = $_POST['precio'];

$datos = array();


$nombreImg = $_FILES['imagen']['name'];
$rutaAlmacenamiento = $_FILES['imagen']['tmp_name'];
$carpeta = '../../archivos/';
$rutaFinal = $carpeta . $nombreImg;


$datosImg = array(
    $select,
    $nombreImg,
    $rutaFinal
);

if (move_uploaded_file($rutaAlmacenamiento, $rutaFinal)) {
     $idImagen = $obj->agregaImagen($datosImg);

     if ($idImagen > 0) {

        $datos[0] = $select;
        $datos[1] = $idImagen;
        $datos[2] = $idUser;
        $datos[3] = $nombre;
        $datos[4] = $descripcion;
        $datos[5] = $cantidad;
        $datos[6] = $precio;
        echo $obj->insertaArticulo($datos);
     }else{
        echo 0;
     }
}
