<?php

class Usuarios
{


    public function registrarUsuario($datos)
    {
        $c = new Conectar();
        $conexion = $c->conexion();
        $fecha = date('Y-m-d');
        $sql = "INSERT into usuarios (
                             nombre,
                             apellido,
                             email,
                             password,
                             fechaCaptura) 
                     values ('$datos[0]',
                             '$datos[1]',
                             '$datos[2]',
                             '$datos[3]',
                             '$fecha')";

        return mysqli_query($conexion, $sql);
    }

    public function loginUser($datos)
    {
        $c = new Conectar();
        $conexion = $c->conexion();
        $password = sha1($datos[1]);

        $_SESSION['usuario'] = $datos[0];
        $_SESSION['iduser'] = self::traerID($datos);

        $sql = "SELECT * FROM usuarios WHERE email='$datos[0]' AND password='$password'";

        $result = mysqli_query($conexion, $sql);

        if (mysqli_num_rows($result) > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function traerID($datos)
    {
        $c = new Conectar();
        $conexion = $c->conexion();
        $password = sha1($datos[1]);
        $sql = "SELECT id_usuario FROM usuarios WHERE email='$datos[0]' AND password='$password'";
        $result = mysqli_query($conexion, $sql);

        return mysqli_fetch_row($result)[0];
    }

    public function obtenDatosUsuarios($idusuario)
    {
        $c = new Conectar();
        $conexion = $c->conexion();
        $sql = "SELECT id_usuario, nombre, apellido, email   FROM usuarios WHERE id_usuario = '$idusuario'";
        $result = mysqli_query($conexion, $sql);

        $ver = mysqli_fetch_row($result);

        $datos = array(
            "id_usuario" => $ver[0],
            "nombre" => $ver[1],
            "apellido" => $ver[2],
            "email" => $ver[3]
        );



        return $datos;
    }

    public function actualizaUsuario($datos)
    {
        $c = new Conectar();
        $conexion = $c->conexion();
        $sql = "UPDATE usuarios SET nombre='$datos[1]', apellido='$datos[2]', email='$datos[3]' WHERE id_usuario='$datos[0]'";
       
        return mysqli_query($conexion, $sql);
    }

    public function eliminaUsuario($idusuario)
    {

        $c = new Conectar();
        $conexion = $c->conexion();
        $sql = "DELETE FROM usuarios WHERE id_usuario = '$idusuario'";
        return  mysqli_query($conexion, $sql);
    }
}
