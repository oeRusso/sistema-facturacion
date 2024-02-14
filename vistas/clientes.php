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

    </body>

    </html>

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
                            $('#tablasClientesLoad').load("clientes/tablaCliente.php");
                            alertify.success("Categoria agregada con exito");
                        } else {
                            alertify.error("No se pudo agregar categoria");
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