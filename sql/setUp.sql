insert into materiales(materialID,unidad,cantidadInventario,descripcion) values (secuenciaMateriales.nextval,'metros',1,'Testing');
insert into productos(productoID,nombre,descripcion,personalizable,precioBase,ventas) values (secuenciaProductos.nextval,'producto','Objeto de prueba',0,20,0);
insert into manufacturacion(manufacturacionID,materialID,productoID) values (secuenciaManufacturacion.nextval,secuenciaMateriales.currval-1,secuenciaProductos.currval-1);
insert into personas(dni,nombre,direccion,telefono) values ('26839538X','Paco Alas', 'Calle Test', '675897450');
insert into proveedores(proveedorID,direccion) values (secuenciaProveedores.nextval,'Calle Test A');
insert into provisiones(provisionID,materialID,proveedorID,precioUnitario) values (secuenciaProvisiones.nextval,secuenciaMateriales.currval-1,
        secuenciaProveedores.currval-1,12);
insert into usuarios(usuarioID,dni) values (secuenciaUsuarios.nextval,'26839538X');
insert into usuariosVIP(vipID,usuarioID,extra) values (secuenciaUsuariosVip.nextval,secuenciaUsuarios.currval-1,'Es amigo mio');
insert into empleados(empleadoID,dni,sueldo,horarioID,dias) values (secuenciaEmpleados.nextval,'26839538Y',122,'lunes, martes','tarde');
insert into pedidos(pedidoID,precioTotal,fechaInicio,fechaEnvio,enviado,dniu,dne) values (secuenciaPedidos.nextval,12,TO_DATE('17/12/2015', 'DD/MM/YYYY'),TO_DATE('17/12/2020', 'DD/MM/YYYY'),0,'26839538X','26839538Y');
insert into encargos(encargoID,precio,extras,productoID,pedidoID,estado) values (secuenciaEncargos.nextval,12,'N/A',secuenciaProductos.currval-1,secuenciaPedidos.currval-1,'sin empezar');