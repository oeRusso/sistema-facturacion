<?php
session_start();

if (isset($_SESSION['usuario'])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Articulos</title>
        <?php require_once "menu.php" ?>
        <?php require_once "../clases/conexion.php";
        $c = new Conectar();
        $conexion = $c->Conexion();
        $sql = "SELECT id_categoria,nombreCategoria FROM categorias";
        $result = mysqli_query($conexion, $sql);
        ?>

    </head>

    <body>
        <div class="container">
            <h1>Articulos</h1>
            <div class="row">
                <div class="col-sm-4">
                    <form id="frmArticulos" enctype="multipart/form-data">
                        <label for="">Categoria</label>
                        <select class="form-control input-sm" id="categoriaSelect" name="categoriaSelect">
                            <option value="A">Selecciona Categoria</option>
                            <?php while ($ver = mysqli_fetch_row($result)) :  ?>
                                <option value="<?php echo $ver[0] ?>"><?php echo $ver[1]; ?></option>
                            <?php endwhile; ?>
                        </select>
                        <label for="">Nombre</label>
                        <input type="text" class="form-control input-sm" id="nombre" name="nombre">
                        <label for="">Descripcion</label>
                        <input type="text" class="form-control input-sm" id="descripcion" name="descripcion">
                        <label for="">Cantidad</label>
                        <input type="text" class="form-control input-sm" id="cantidad" name="cantidad">
                        <label for="">Precio</label>
                        <input type="text" class="form-control input-sm" id="precio" name="precio">
                        <label for="">Imagen</label>
                        <input type="file" id="imagen" name="imagen">
                        <p></p>
                        <span id="btnAgregaArticulo" class="btn btn-primary">Agregar </span>
                    </form>

                </div>
                <div class="col-sm-8">
                    <div id="tablaArticulosLoad">

                    </div>

                </div>
            </div>
        </div>

      

        <!-- Modal -->
        <div class="modal fade" id="abreModalUpdateArticulo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Actualiza Articulo</h4>
                    </div>
                    <div class="modal-body">
                        <form id="frmArticulosU">
                            <input type="text" hidden="" id="idArticulo" name="idArticulo">
                            <label for="">Categoria</label>
                            <select class="form-control input-sm" id="categoriaSelectU" name="categoriaSelectU">
                                <option value="A">Selecciona Categoria</option>
                                <?php 
                                     $sql = "SELECT id_categoria,nombreCategoria FROM categorias";
                                     $result = mysqli_query($conexion, $sql);
                                ?>
                                <?php while ($ver = mysqli_fetch_row($result)) :  ?>
                                    <option value="<?php echo $ver[0] ?>"><?php echo $ver[1]; ?></option>
                                <?php endwhile; ?>
                            </select>
                            <label for="">Nombre</label>
                            <input type="text" class="form-control input-sm" id="nombreU" name="nombreU">
                            <label for="">Descripcion</label>
                            <input type="text" class="form-control input-sm" id="descripcionU" name="descripcionU">
                            <label for="">Cantidad</label>
                            <input type="text" class="form-control input-sm" id="cantidadU" name="cantidadU">
                            <label for="">Precio</label>
                            <input type="text" class="form-control input-sm" id="precioU" name="precioU">
                            <p></p>
                            <span id="btnAgregaArticulo" class="btn btn-primary">Agregar </span>
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button id="btnActualizaArticulo" type="button" class="btn btn-warning" data-dismiss="modal">Actualizar</button>
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>
    <script>
        function agregaDatosArticulo(idarticulo) {
            $.ajax({
                type: "POST",
                data: "idart=" + idarticulo,
                url: "../procesos/articulos/obtenDatosArticulos.php",
                success: function(r) {
                    alert(r);
                    dato = jQuery.parseJSON(r);
                }
            });
        }
    </script>
    <script>
        $(document).ready(function() {

            $('#tablaArticulosLoad').load("articulos/tablaArticulo.php");
            $('#btnAgregaArticulo').click(function() {

                vacios = validarFormVacio('frmArticulos');

                if (vacios > 0) {
                    alertify.alert("Debes llenar todos los campos!!");
                    return false;
                }


                var formData = new FormData(document.getElementById("frmArticulos"));

                $.ajax({
                    url: "../procesos/articulos/insertaArticulo.php",
                    type: "post",
                    dataType: "html",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,

                    success: function(r) {

                        if (r == 1) {
                            $('#frmArticulos')[0].reset();
                            $('#tablaArticulosLoad').load("articulos/tablaArticulo.php");
                            alertify.success("Agregado con exito :D");
                        } else {
                            alertify.error("Fallo al subir el archivo :(");
                        }
                    }
                });
            });

        })
    </script>

<?php
} else {
    header("location:../index.php");
}
?>