<?php

require_once '../../clases/conexion.php';
require_once '../../clases/clientes.php';

$obj = new Clientes();

$idcliente = $_POST['idcliente'];

echo $obj->eliminaCliente($idcliente);