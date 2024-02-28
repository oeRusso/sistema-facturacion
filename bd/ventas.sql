`ventas`SELECT*FROM usuarios;

SELECT*FROM clientes;
SELECT*FROM categorias;
SELECT*FROM imagenes;
SELECT*FROM articulos;
SELECT*FROM usuarios;
SELECT*FROM ventas;




TRUNCATE TABLE ventas;
TRUNCATE TABLE clientes;
TRUNCATE TABLE imagenes;
TRUNCATE TABLE articulos;
TRUNCATE TABLE categorias;







SELECT art.nombre,art.descripcion,art.cantidad,art.precio , img.ruta, cat.nombreCategoria
        FROM articulos art INNER JOIN imagenes img ON art.id_imagen = img.id_imagen
			   INNER JOIN categorias cat ON art.id_categoria = cat.id_categoria;
			   
			   
			   SELECT id_producto,id_categoria,nombre,descripcion,cantidad,precio FROM articulos WHERE id_producto = 3;
			   
SELECT ve.id_venta,ve.fechaCompra,cli.nombre,cli.apellido,art.nombre,art.precio,art.descripcion FROM ventas ve INNER JOIN clientes cli ON ve.id_cliente=cli.id_cliente
 INNER JOIN articulos art ON ve.id_producto=art.id_producto AND ve.id_venta=1;
 
        SELECT ve.id_venta,
               ve.fechaCompra,
               ve.id_cliente,
               art.nombre,
               art.precio,
               art.descripcion 
               FROM ventas ve 
               INNER JOIN articulos art 
               ON ve.id_producto=art.id_producto 
               AND ve.id_venta=1;