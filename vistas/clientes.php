<?php
session_start();

if (isset($_SESSION['usuario'])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Clientes</title>
        <?php require_once "menu.php" ?>
    </head>

    <body>
        <div class="container">
            <h1>Clientes</h1>
            <div class="row">
                <div class="col-sm-4">
                    <form id="frmClientes">
                        <label for="">Nombre</label>
                        <input type="text" class="form-control input-sm" id="nombre" name="nombre">
                        <label for="">Apellido</label>
                        <input type="text" class="form-control input-sm" id="apellido" name="apellido">
                        <label for="">Direccion</label>
                        <input type="text" class="form-control input-sm" id="direccion" name="direccion">
                        <label for="">Email</label>
                        <input type="text" class="form-control input-sm" id="email" name="email">
                        <label for="">Telefono</label>
                        <input type="text" class="form-control input-sm" id="telefono" name="telefono">
                        <label for="">Tipo de cliente</label>
                        <input type="text" class="form-control input-sm" id="rfc" name="rfc">
                        <p></p>
                        <span class="btn btn-primary" id="btnAgregarCliente">Agregar</span>
                    </form>
                </div>
                <div class="col-sm-8">
                    <div id="tablasClientesLoad"></div>
                </div>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="abreModalClientesUpdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Actualizar CLiente</h4>
                    </div>
                    <div class="modal-body">
                        <form id="frmClientesU">
                            <input type="text" hidden="" id="idClienteU" name="idClienteU">
                            <label for="">Nombre</label>
                            <input type="text" class="form-control input-sm" id="nombreU" name="nombreU">
                            <label for="">Apellido</label>
                            <input type="text" class="form-control input-sm" id="apellidoU" name="apellidoU">
                            <label for="">Direccion</label>
                            <input type="text" class="form-control input-sm" id="direccionU" name="direccionU">
                            <label for="">Email</label>
                            <input type="text" class="form-control input-sm" id="emailU" name="emailU">
                            <label for="">Telefono</label>
                            <input type="text" class="form-control input-sm" id="telefonoU" name="telefonoU">
                            <label for="">Tipo de cliente</label>
                            <input type="text" class="form-control input-sm" id="rfcU" name="rfcU">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button id="btnAgregarClienteU" type="button" class="btn btn-primary" data-dismiss="modal">Actualizar</button>

                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>

    <script>
        function agregaDatosCliente(idcliente) {

            console.log(idcliente);
            $.ajax({
                type: "POST",
                data: "idcliente=" + idcliente,
                url: "../procesos/clientes/obtenDatosCliente.php",
                success: function(r) {

                    dato = jQuery.parseJSON(r);
                    console.log(dato);


                    $('#idClienteU').val(dato['id_cliente']);

                    $('#nombreU').val(dato['nombre']);

                    $('#apellidoU').val(dato['apellido']);

                    $('#direccionU').val(dato['direccion']);

                    $('#emailU').val(dato['email']);

                    $('#telefonoU').val(dato['telefono']);

                    $('#rfcU').val(dato['rfc']);


                }
            });

        }

        function eliminarCliente(idcliente) {
            alertify.confirm('Desea eliminar este cliente?', function() {
                $.ajax({
                    type: "POST",
                    data: "idcliente=" + idcliente,
                    url: "../procesos/clientes/eliminarCliente.php",
                    success: function(r) {

                        if (r == 1) {
                            $('#tablasClientesLoad').load("clientes/tablaCliente.php");
                            alertify.success("Eliminado con exito!");
                        } else {
                            alertify.error("No se pudo eliminar ")
                        }
                    }
                });
            }, function() {
                alertify.error('Cancelo!')
            });
        }
    </script>

    <script>
        $(document).ready(function() {

            $('#tablasClientesLoad').load("clientes/tablaCliente.php");
            $('#btnAgregarCliente').click(function() {

                vacios = validarFormVacio('frmClientes');

                if (vacios > 0) {
                    alertify.alert("Debes llenar todos los campos!!");
                    return false;
                }

                datos = $('#frmClientes').serialize();
                $.ajax({
                    type: "POST",
                    data: datos,
                    url: "../procesos/clientes/agregaCliente.php",
                    success: function(r) {

                        if (r == 1) {
                            $('#frmClientes')[0].reset();
                            $('#tablasClientesLoad').load("clientes/tablaCliente.php");
                            alertify.success("Cliente agregado con exito");
                        } else {
                            alertify.error("No se pudo agregar el cliente");
                        }
                    }
                });
            });
        })
    </script>

    <script>
        $(document).ready(function() {
            $('#btnAgregarClienteU').click(function() {
                datos = $('#frmClientesU').serialize();
                $.ajax({
                    type: "POST",
                    data: datos,
                    url: "../procesos/clientes/actualizaCliente.php",
                    success: function(r) {

                        if (r == 1) {
                            $('#frmClientes')[0].reset();
                            $('#tablasClientesLoad').load("clientes/tablaCliente.php");
                            alertify.success("Cliente modificado con exito");
                        } else {
                            alertify.error("No se pudo modificar el cliente");
                        }
                    }
                });
            });
        });
    </script>

<?php
} else {
    header("location:../index.php");
}
?>