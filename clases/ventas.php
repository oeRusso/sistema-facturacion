<?php

class Venta
{

    public function obtenDatosProducto($idproducto)
    {
        $c = new Conectar();
        $conexion = $c->conexion();
        $sql = "SELECT art.nombre,art.descripcion,art.cantidad,img.ruta,art.precio FROM articulos art 
        INNER JOIN imagenes img ON art.id_imagen = img.id_imagen AND art.id_producto = '$idproducto'";

        $result = mysqli_query($conexion, $sql);

        $ver = mysqli_fetch_row($result);

        $d = explode("/", $ver[3]);

        $img = $d[1] . '/' . $d[2] . '/' . $d[3];

        $datos = array(
            'nombre' => $ver[0],
            'descripcion' => $ver[1],
            'cantidad' => $ver[2],
            'ruta' => $img,
            'precio' => $ver[4]

        );

        return $datos;
    }

    public function crearVenta()
    {
        $c = new Conectar();
        $conexion = $c->conexion();

        $fecha = date('Y-m-d');
        $idventa = self::creaFolio();
        $datos = $_SESSION['tablasComprasTemp'];

        $idusuario = $_SESSION['iduser'];
        $r = 0;


        for ($i = 0; $i < count($datos); $i++) {
            $d = explode("||", $datos[$i]);

            $sql = "INSERT INTO ventas (id_venta, id_cliente, id_producto, id_usuario, precio, fechaCompra)
                    VALUES('$idventa','$d[5]','$d[0]','$idusuario','$d[3]','$fecha')";

            $result = mysqli_query($conexion, $sql);

            $r = $r + $result;
            self::descuentaCantidad($d[0], 1);
        }

        return $r;
    }

    public function descuentaCantidad($idproducto, $cantidad)
    {
        $c = new Conectar();
        $conexion = $c->conexion();
        $sql = "SELECT cantidad FROM articulos WHERE id_producto='$idproducto'";
        $result = mysqli_query($conexion, $sql);
        $cantidad1= mysqli_fetch_row($result)[0];
        $cantidadNueva = abs($cantidad - $cantidad1);
        $sql="UPDATE articulos SET cantidad='$cantidadNueva' WHERE id_producto = '$idproducto'";
        return mysqli_query($conexion,$sql);
    }
    public function creaFolio()
    {
        $c = new conectar();
        $conexion = $c->conexion();

        $sql = "SELECT id_venta from ventas group by id_venta desc";

        $resul = mysqli_query($conexion, $sql);
        $id = mysqli_fetch_row($resul)[0];

        if ($id == "" or $id == null or $id == 0) {
            return 1;
        } else {
            return $id + 1;
        }
    }

    public function nombreCliente($idCliente)
    {
        $c = new conectar();
        $conexion = $c->conexion();

        $sql = "SELECT apellido,nombre 
			from clientes 
			where id_cliente='$idCliente'";
        $result = mysqli_query($conexion, $sql);

        $ver = mysqli_fetch_row($result);

        return $ver[0] . " " . $ver[1];
    }

    public function obtenerTotal($idventa)
    {
        $c = new conectar();
        $conexion = $c->conexion();

        $sql = "SELECT precio 
				from ventas 
				where id_venta='$idventa'";
        $result = mysqli_query($conexion, $sql);

        $total = 0;

        while ($ver = mysqli_fetch_row($result)) {
            $total = $total + $ver[0];
        }

        return $total;
    }
}
