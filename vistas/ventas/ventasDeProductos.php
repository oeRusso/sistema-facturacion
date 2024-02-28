<?php
require_once '../../clases/conexion.php';

$c = new Conectar();
$conexion = $c->conexion();


?>

<h2>Vender un Producto</h2>
<div class="row">
    <div class="col-sm-4">
        <form id="frmVentasProductos">
            <label for="">Selecciona Cliente</label>
            <select class="form-control input-sm" id="clienteVenta" name="clienteVenta">
                <option value="A">Seleccion</option>
                <option value="0">Sin cliente</option>

                <?php
                $sql = "SELECT id_cliente,nombre,apellido FROM clientes";
                $result = mysqli_query($conexion, $sql);
                while ($cliente = mysqli_fetch_row($result)) :
                ?>
                    <option value="<?php echo $cliente[0] ?>"><?php echo $cliente[2] . " " . $cliente[1] ?></option>
                <?php endwhile; ?>
            </select>
            <label for="">Producto</label>
            <select class="form-control input-sm" id="productoVenta" name="productoVenta">
                <option value="A">Seleccion</option>
                <?php
                $sql = "SELECT id_producto,nombre FROM articulos";
                $result = mysqli_query($conexion, $sql);
                while ($producto = mysqli_fetch_row($result)) :
                ?>
                    <option value="<?php echo $producto[0] ?>"><?php echo $producto[1] ?></option>
                <?php endwhile; ?>
            </select>
            <label for="">Descripcion</label>
            <textarea readonly="" name="descripcionV" id="descripcionV" class="form-control input-sm"></textarea>
            <label for="">Cantidad</label>
            <input readonly="" type="text" class="form-control input-sm" id="cantidadV" name="cantidadV">
            <label for="">Precio</label>
            <input readonly="" type="text" class="form-control input-sm" id="precioV" name="precioV">
            <p></p>
            <span class="btn btn-primary" id="btnAgregarVenta">Agregar</span>
            <span class="btn btn-danger" id="btnVaciarVentas">Vaciar ventas</span>
        </form>
    </div>
    <div class="col-sm-3">
        <div id="imgProducto">

        </div>
    </div>
    <div class="col-sm-4">
        <div id="tablaVentasTempLoad">

        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        $('#tablaVentasTempLoad').load("ventas/tablaVentasTemp.php");

        $('#productoVenta').change(function() {
            $.ajax({
                type: "POST",
                data: "idproducto=" + $('#productoVenta').val(),
                url: "../procesos/ventas/llenarFormProducto.php",
                success: function(r) {
                    dato = jQuery.parseJSON(r);
                    $('#descripcionV').val(dato['descripcion']);
                    $('#cantidadV').val(dato['cantidad']);
                    $('#precioV').val(dato['precio']);

                    // $('#imgProducto').prepend('<img class="img-thumbnail" id="imgp" src="' + dato['ruta'] + '" />');

                }
            });
        });

        $('#btnAgregarVenta').click(function() {
            vacios = validarFormVacio('frmVentasProductos');

            if (vacios > 0) {
                alertify.alert("Debes llenar todos los campos!!");
                return false;
            }

            datos = $('#frmVentasProductos').serialize();
            $.ajax({
                type: "POST",
                data: datos,
                url: "../procesos/ventas/agregaProductosTemp.php",
                success: function(r) {

                    $('#tablaVentasTempLoad').load("ventas/tablaVentasTemp.php");
                }
            });
        });


        $('#btnVaciarVentas').click(function() {

         
            $.ajax({
                url: "../procesos/ventas/vaciarTemp.php",
                success: function(r) {
                    $('#tablaVentasTempLoad').load("ventas/tablaVentasTemp.php");
                }
            });
        });

    });
</script>

<script>
    function quitarP(index){

        $.ajax({
			type:"POST",
			data:"ind=" + index,
			url:"../procesos/ventas/quitarProducto.php",
			success:function(r){
                $('#tablaVentasTempLoad').load("ventas/tablaVentasTemp.php");
                alertify.success("Se quito el producto");
			}
		});
    }

    function crearVenta(){
        $.ajax({
			url:"../procesos/ventas/crearVenta.php",
			success:function(r){
                if (r > 0) {
                    $('#tablaVentasTempLoad').load("ventas/tablaVentasTemp.php");
                    $('#frmVentasProductos')[0].reset();
                    alertify.alert("Venta creada con exito, consulte mas informacion en VENTAS HECHAS");
                }else if(r==0){
                    alertify.alert("No hay lista de venta");
                }else{
                    // alertify.error("No se pudo crear la venta");
                }
			}
		});
    }
</script>

<script>
    $(document).ready(function() {
        $('#clienteVenta').select2();
        $('#productoVenta').select2();

    });
</script>