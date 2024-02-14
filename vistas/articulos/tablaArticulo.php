<?php

require_once '../../clases/conexion.php';

$c = new Conectar();
$conexion = $c->Conexion();

$sql = " SELECT art.nombre,art.descripcion,art.cantidad,art.precio , img.ruta, cat.nombreCategoria,art.id_producto
                FROM articulos art 
                INNER JOIN imagenes img ON art.id_imagen = img.id_imagen
                INNER JOIN categorias cat ON art.id_categoria = cat.id_categoria";
$result = mysqli_query($conexion, $sql);
?>

<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
    <caption><label for="">Articulos</label></caption>
    <tr>
        <td>Nombre</td>
        <td>Descripcion</td>
        <td>Cantidad</td>
        <td>Precio</td>
        <td>Imagen</td>
        <td>Categoria</td>
        <td>Editar</td>
        <td>Eliminar</td>
    </tr>
    <?php
    while ($ver = mysqli_fetch_row($result)) :
    ?>
        <tr>
            <td><?php echo $ver[0] ?></td>
            <td><?php echo $ver[1] ?></td>
            <td><?php echo $ver[2] ?></td>
            <td><?php echo $ver[3] ?></td>
            <td>
                <?php
                $imgVer = explode("/", $ver[4]);
                $imgRuta = $imgVer[1] . "/" . $imgVer[2] . "/" . $imgVer[3];
                ?>
                <img width="100" height="100" src="<?php echo $imgRuta ?>" alt="foto de algun producto">
            </td>
            <td><?php echo $ver[5] ?></td>
            <td>
                <span data-toggle="modal" data-target="#abreModalUpdateArticulo" class="btn btn-warning btn-xs" onclick="agregaDatosArticulo('<?php echo $ver[6] ?>')">
                    <span class="glyphicon glyphicon-pencil"></span>
                </span>
            </td>
            <td>
                <span class="btn btn-danger btn-xs">
                    <span class="glyphicon glyphicon-remove"></span>
                </span>
            </td>
        </tr>
    <?php endwhile; ?>

</table>