<?php
require_once '../../clases/conexion.php';
require_once '../../clases/ventas.php';

$objv = new Venta();

$c = new Conectar();
$conexion = $c->conexion();

$idventa = $_GET['idventa'];
$total=0;
$sql = "SELECT ve.id_venta,
               ve.fechaCompra,
               ve.id_cliente,
               art.nombre,
               art.precio,
               art.descripcion 
               FROM ventas ve 
               INNER JOIN articulos art 
               ON ve.id_producto=art.id_producto 
               AND ve.id_venta='$idventa'";

$result = mysqli_query($conexion, $sql);

$ver = mysqli_fetch_row($result);
$folio = $ver[0];
$fecha = $ver[1];
$idcliente = $ver[2];
$totalV= $total + $ver[4];


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/sistema-de-facturacion/librerias/bootstrap/css/bootstrap.css">
    <title>Reporte de venta</title>
</head>

<body>
    <img src="http://localhost/sistema-de-facturacion/img/almacenagustin.jpg" style="border-radius: 2rem;" width="200" height="100">
    <br><br><br><br>
    <table class="table">
        <tr>
            <td>Fecha: <?php echo $fecha ?></td>
        </tr>
        <tr>
            <td>Folio: <?php echo $folio ?></td>
        </tr>
        <tr>
            <td>
            Cliente: <?php echo @$objv->nombreCliente($idcliente) ?>
            </td>
        </tr>
    </table>
    <table class="table">
        <tr>
            <td>Nombre producto</td>
            <td>Precio</td>
            <td>Cantidad</td>
            <td>Descripcion</td>
        </tr>
            <?php
                $sql = "SELECT ve.id_venta,
                ve.fechaCompra,
                ve.id_cliente,
                art.nombre,
                art.precio,
                art.descripcion 
                FROM ventas ve 
                INNER JOIN articulos art 
                ON ve.id_producto=art.id_producto 
                AND ve.id_venta='$idventa'";
 
                $result = mysqli_query($conexion, $sql);
                $total=0;
                while($mostrar=mysqli_fetch_row($result)):
            ?>       
        <tr>
                <td><?php echo $ver[3] ?></td>
                <td><?php echo $ver[4] ?></td>
                <td>1</td>
                <td><?php echo $ver[5] ?></td>
        </tr>
        <?php
            $total= $total + $ver[4];
            endwhile;
        ?>
        <tr>
            <td>
                Total= <?php echo "$".$total?>
            </td>
        </tr>
     
    </table>
</body>

</html>