<?php

class Categorias
{


    public function agregarCategoria($datos)
    {

        $c = new Conectar();
        $conexion = $c->Conexion();

        $sql = "INSERT INTO categorias(    id_usuario,
                                           nombreCategoria,
                                           fechaCaptura)
                            VALUES(
                                    '$datos[0]',
                                    '$datos[1]',
                                    '$datos[2]')";


        return mysqli_query($conexion, $sql);
    }

    public function actualizaCategoria($datos)
    {


        $c = new Conectar();
        $conexion = $c->Conexion();

        $sql = "UPDATE  categorias SET nombreCategoria='$datos[1]' WHERE id_categoria = '$datos[0]' ";


        return mysqli_query($conexion, $sql);
    }

    public function eliminaCategoria($idCategoria){

        $c = new Conectar();
        $conexion = $c->Conexion();

        $sql = "DELETE FROM categorias WHERE id_categoria = '$idCategoria' ";


        return mysqli_query($conexion, $sql);

    }
}
