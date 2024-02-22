<?php

require_once '../../clases/conexion.php';
require_once '../../clases/ventas.php';

$c = new conectar();
$conexion = $c->conexion();
$obj = new Venta();

$sql = "SELECT id_venta, fechaCompra, id_cliente FROM ventas GROUP BY id_venta";

$result = mysqli_query($conexion, $sql);



?>



<h2>Reportes y ventas</h2>
<div class="row">
    <div class="col-sm-1"></div>
    <div class="col-sm-10">
        <div class="tabel-responsive">
            <table class="table table-hover table-condensed table-bordered" style="text-align: center;">
                <caption><label for="">Ventas</label></caption>
                <tr>
                    <td>Folio</td>
                    <td>Fecha</td>
                    <td>Cliente</td>
                    <td>Total de compra</td>
                    <td>Ticket</td>
                    <td>Reporte</td>
                </tr>
                <?php while ($ver = mysqli_fetch_row($result)) : ?>
                    <tr>
                        <td><?php echo $ver[0] ?></td>
                        <td><?php echo $ver[1] ?></td>
                        <td>
                            <?php
                            if ($obj->nombreCliente($ver[2]) == "") {
                                echo "S/C";
                            } else {
                                echo $obj->nombreCliente($ver[2]);
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            echo "$" . $obj->obtenerTotal($ver[0]);
                            ?>
                        </td>
                        <td>
                            <a href="#" class="btn btn-danger btn-sm">
                                Ticket <span class="glyphicon glyphicon-list-alt "></span>
                            </a>
                        </td>
                        <td>
                            <a href="#" class="btn btn-danger btn-sm">
                                Reporte <span class="glyphicon glyphicon-file "></span>
                            </a>
                        </td>
                    </tr>
                <?php endwhile ?>
            </table>
        </div>
    </div>
    <div class="col-sm-1"></div>

</div>