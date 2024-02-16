<?php

class Clientes
{


    public function agregaCliente($datos)
    {
        $c = new Conectar();
        $conexion = $c->Conexion();
        $idusuario =  $_SESSION['iduser'];

        $sql = "INSERT INTO clientes (id_usuario,nombre,apellido,direccion,email,telefono,rfc) VALUES '','','','','','',''";
        $result = mysqli_query($conexion, $sql);
    }
}
