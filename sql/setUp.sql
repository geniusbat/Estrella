drop sequence secuenciaEncargos;create sequence secuenciaEncargos start with 1 increment by 1;
drop sequence secuenciaProductos;create sequence secuenciaProductos start with 1 increment by 1;
drop sequence secuenciaPedidos;create sequence secuenciaPedidos start with 1 increment by 1;
drop sequence secuenciaManufacturacion;create sequence secuenciaManufacturacion start with 1 increment by 1;
drop sequence secuenciaProvisiones;create sequence secuenciaProvisiones start with 1 increment by 1;
drop sequence secuenciaMateriales;create sequence secuenciaMateriales start with 1 increment by 1;drop sequence secuenciaProveedores;
create sequence secuenciaProveedores start with 1 increment by 1;drop sequence secuenciaAuxPrecioPedido;
create sequence secuenciaAuxPrecioPedido start with 1 increment by 1;drop sequence secuenciaEmpleados;
create sequence secuenciaEmpleados start with 1 increment by 1;drop sequence secuenciaHorarios;
create sequence secuenciaHorarios start with 1 increment by 1;drop sequence secuenciaUsuariosVip;
create sequence secuenciaUsuariosVip start with 1 increment by 1;drop sequence secuenciaUsuarios;
create sequence secuenciaUsuarios start with 1 increment by 1;
drop table encargos;drop table pedidos;drop table usuariosVIP;drop table usuarios;drop table provisiones;drop table proveedores;
drop table manufacturacion;drop table productos;drop table materiales;drop table empleados;drop table login;drop table personas;
create table materiales(
    materialID integer primary key,
    unidad varchar(8),
    cantidadInventario integer,
    descripcion varchar(30)
);
create table productos(
    productoID integer primary key,
    nombre varchar(25) not null,
    descripcion varchar(70),
    personalizable integer, 
    precioBase number(8,2) not null,
    ventas integer,
    direccion varchar(70)
);
create table manufacturacion(
    manufacturacionID integer primary key,
    materialID integer,
    productoID integer,
    foreign key (productoID) references productos on delete cascade,
    foreign key (materialID) references materiales on delete CASCADE
);
create table personas(
    dni char(9) primary key,
    nombre varchar(25) not null,
    direccion varchar(25),
    telefono char(11)
);
create table proveedores(
    proveedorID integer primary key,
    direccion varchar(20) not null
);
create table provisiones(
    provisionID integer primary key,
    materialID integer,
    proveedorID integer,
    precioUnitario number(8,2),
    foreign key (materialID) references materiales on delete CASCADE,
    foreign key (proveedorID) references proveedores on delete CASCADE
);
create table usuarios(
    usarioID integer primary key,
    dni char(9) not null,
    foreign key (dni) references personas on delete Cascade
);
create table usuariosVIP (
    vipID integer primary key,
    usuarioID integer,
    extra varchar(30) not null,
    foreign key (usuarioID) references usuarios on delete CASCADE
);
create table pedidos(
    pedidoID integer primary key,
    precioTotal number(8,2),
    fechaInicio date, /*Hacer not null*/
    fechaEnvio date,
    enviado integer, check (enviado = 1 or enviado = 0),
    dniu char(9) not null,
    dnie char(9) not null,
    foreign key (dnie) references personas  on delete CASCADE,
    foreign key (dniu) references personas  on delete CASCADE
);
create table encargos(
    encargoID integer primary key,
    precio number(8,2),
    extras varchar(20),
    productoID integer,
    pedidoID integer,
    estado varchar(11) not null,
    foreign key (productoID) references productos on delete CASCADE,
    foreign key (pedidoID) references pedidos on delete Cascade
);
create table empleados(
    empleadoID integer primary key,
    dni char(9) not null,
    sueldo number(10,2) not null,
    dias varchar(30),
    horario varchar(15),
    foreign key (dni) references personas on delete Cascade
);
create table login (
    loginID integer primary key,
    dni char(9) not null,
    pass varchar(10) not null,
    FOREIGN key (dni) references personas on delete Cascade
);


insert into materiales(materialID,unidad,cantidadInventario,descripcion) values (secuenciamateriales.nextval,'metros',1,'Testing');
insert into productos(productoID,nombre,descripcion,personalizable,precioBase,ventas,direccion) values (secuenciaproductos.nextval,'producto','Objeto de prueba',0,20,0,'C:\xampp\htdocs\Estrella\img\logo.jpg');
insert into productos(productoID,nombre,descripcion,personalizable,precioBase,ventas,direccion) values (secuenciaproductos.nextval,'producto1','Objeto de prueba 1',1,200,0,'C:\xampp\htdocs\Estrella\img\logo.jpg');
insert into productos(productoID,nombre,descripcion,personalizable,precioBase,ventas,direccion) values (secuenciaproductos.nextval,'producto2','Objeto de prueba 2',0,20,0,'C:\xampp\htdocs\Estrella\img\logo.jpg');
insert into productos(productoID,nombre,descripcion,personalizable,precioBase,ventas,direccion) values (secuenciaproductos.nextval,'producto3','Objeto de prueba 3',0,10,10,'C:\xampp\htdocs\Estrella\img\logo.jpg');
insert into productos(productoID,nombre,descripcion,personalizable,precioBase,ventas,direccion) values (secuenciaproductos.nextval,'producto4','Objeto de prueba 4',1,20,3,'C:\xampp\htdocs\Estrella\img\logo.jpg');
insert into manufacturacion(manufacturacionID,materialID,productoID) values (secuenciamanufacturacion.nextval,secuenciamateriales.currval,secuenciaproductos.currval);
insert into personas(dni,nombre,direccion,telefono) values ('26839538X','Paco Alas', 'Calle Test', '675897450');
insert into personas(dni,nombre,direccion,telefono) values ('26839538Y','ATEST', 'Calle Test', '675897450');
insert into proveedores(proveedorID,direccion) values (secuenciaproveedores.nextval,'Calle Test A');
insert into provisiones(provisionID,materialID,proveedorID,precioUnitario) values (secuenciaprovisiones.nextval,secuenciamateriales.currval,secuenciaproveedores.currval,12);
insert into usuarios(usarioID,dni) values (secuenciaUsuarios.nextval,'26839538X');
insert into usuariosVIP(vipID,usuarioID,extra) values (secuenciaUsuariosVip.nextval,secuenciaUsuarios.currval,'Es amigo mio');
insert into empleados(empleadoID,dni,sueldo,dias,horario) values (0,'26839538Y',1,'lunes, martes','tarde');
insert into pedidos(pedidoID,precioTotal,fechaInicio,fechaEnvio,enviado,dniu,dnie) values (secuenciapedidos.nextval,12,TO_DATE('17/12/2015', 'DD/MM/YYYY'),TO_DATE('17/12/2020', 'DD/MM/YYYY'),0,'26839538X','26839538Y');
insert into encargos(encargoID,precio,extras,productoID,pedidoID,estado) values (secuenciaencargos.nextval,12,'N/A',secuenciaproductos.currval,secuenciaproductos.currval,'sin empezar');
insert into login(loginID,dni,pass) values (0, '26839538Y', 'admin');
COMMIT WORK;
SELECT pass from login where login.dni='26839538Y';
select * from personas;
