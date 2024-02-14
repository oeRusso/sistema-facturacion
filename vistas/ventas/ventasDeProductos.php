<h2>Vender un Producto</h2>
<div class="row">
    <div class="col-sm-4">
        <form id="frmVentasProductos">
            <label for="">Selecciona Cliente</label>
            <select class="form-control input-sm" id="clienteVenta" name="clienteVenta">
                <option value="A">Seleccion</option>
            </select>
            <label for="">Producto</label>
            <select class="form-control input-sm" id="productoVenta" name="productoVenta">
                <option value="A">Seleccion</option>
            </select>
            <label for="">Descripcion</label>
            <textarea name="" id="" class="form-control input-sm"></textarea>
            <label for="">Cantidad</label>
            <input type="text" class="form-control input-sm" id="" name="">
            <label for="">Precio</label>
            <input type="text" class="form-control input-sm" id="" name="">
            <p></p>
            <span class="btn btn-primary" id="btnAgregarVenta">Agregar</span>
        </form>
    </div>
</div>

<script>
     $(document).ready(function() {
         $('#clienteVenta').select2();
        });
</script>