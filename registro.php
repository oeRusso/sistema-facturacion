<?php

require_once 'clases/conexion.php';
$obj = new Conectar();
$conexion = $obj->conexion();

$sql = "SELECT * FROM usuarios WHERE email='admin'";
$result = mysqli_query($conexion, $sql);

$validar = 0;
if (mysqli_num_rows($result) > 0) {
   header("Location:index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="librerias/bootstrap/css/bootstrap.css">
    <script src="librerias/jquery-3.2.1.min.js"></script>
    <script src="js/funciones.js"></script>
</head>

<body>
    <br><br><br>
    <div class="container">
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <div class="panel panel-danger">
                    <div class="panel panel-heading">Registrar administrador</div>
                    <div class="panel panel-body">
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
                            <a href="index.php" class="btn btn-default">Regresar Login</a>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-4"></div>

        </div>
    </div>

</body>

</html>

<script type="text/javascript">
    
    $(document).ready(function() {
        $('#registro').click(function() {

            vacios = validarFormVacio('frmRegistro');
            
            if (vacios > 0) {
                alert("Debes llenar todos los campos!!");
                return false;
            }


            datos = $('#frmRegistro').serialize();
            $.ajax({
                type: "POST",
                data: datos,
                url: "procesos/regLogin/registrarUsuario.php",
                success: function(r) {
                    
                    if (r == 1) {
                        alert("Agregado con exito");
                    } else {
                        alert("Fallo al agregar :(");
                    }
                }
            });
        });
    });
</script>