<?php
session_start();

if (isset($_SESSION['usuario'])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Usuarios</title>
        <?php require_once "menu.php" ?>
    </head>

    <body>
        <div class="container">
            <h1>Administrar usuario</h1>
            <div class="row">
                <div class="col-sm-4">
                    <form id="frmRegistro">
                        <label for="">Nombre</label>
                        <input type="text" class="form-control input-sm" name="nombre" id="nombre">
                        <label for="">Apellido</label>
                        <input type="text" class="form-control input-sm" name="apellido" id="apellido">
                        <label for="">Usuario</label>
                        <input type="text" class="form-control input-sm" name="usuario" id="usuario">
                        <label for="">Password</label>
                        <input type="text" class="form-control input-sm" name="password" id="password">
                        <p></p>
                        <span class="btn btn-primary" id="registro"> Registrar</span>
                    </form>
                </div>
                <div class="col-sm-7">
                    <div id="tablaUsuariosLoad">

                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#tablaUsuariosLoad').load('usuarios/tablaUsuario.php');

            $('#registro').click(function() {

                vacios = validarFormVacio('frmRegistro');

                if (vacios > 0) {
                    alertify.alert("Debes llenar todos los campos!!");
                    return false;
                }


                datos = $('#frmRegistro').serialize();
                $.ajax({
                    type: "POST",
                    data: datos,
                    url: "../procesos/regLogin/registrarUsuario.php",
                    success: function(r) {

                        if (r == 1) {
                            alertify.success("Agregado con exito");
                            $('#tablaUsuariosLoad').load('usuarios/tablaUsuario.php');
                        } else {
                            alertify.error("Fallo al agregar :(");
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