insert into materiales(materialID,unidad,cantidadInventario,descripcion) values (0,'metros',1,'Testing');
insert into productos(productoID,nombre,descripcion,personalizable,precioBase,ventas) values (0,'producto','Objeto de prueba',0,20,0);
insert into manufacturacion(manufacturacionID,materialID,productoID) values (0,0,0);
insert into personas(dni,nombre,direccion,telefono) values ('26839538X','Paco Alas', 'Calle Test', '675897450');
insert into personas(dni,nombre,direccion,telefono) values ('26839538Y','ATEST', 'Calle Test', '675897450');
insert into proveedores(proveedorID,direccion) values (0,'Calle Test A');
insert into provisiones(provisionID,materialID,proveedorID,precioUnitario) values (0,0,0,12);
insert into usuarios(usarioID,dni) values (0,'26839538X');
insert into usuariosVIP(vipID,usuarioID,extra) values (0,0,'Es amigo mio');
insert into empleados(empleadoID,dni,sueldo,horarioID,dias) values (0,'26839538Y',1,'lunes, martes','tarde');
insert into pedidos(pedidoID,precioTotal,fechaInicio,fechaEnvio,enviado,dniu,dnie) values (0,12,TO_DATE('17/12/2015', 'DD/MM/YYYY'),TO_DATE('17/12/2020', 'DD/MM/YYYY'),0,'26839538X','26839538Y');
insert into encargos(encargoID,precio,extras,productoID,pedidoID,estado) values (0,12,'N/A',0,0,'sin empezar');
insert into login(loginID,dni,pass) values (0, '26839538Y', 'admin');

SELECT pass from login where login.dni='26839538Y';