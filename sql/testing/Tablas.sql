drop table encargos;
drop table pedidos;
drop table usuariosVIP;
drop table usuarios;
drop table provisiones;
drop table proveedores;
drop table manufacturacion;
drop table productos;
drop table materiales;
drop table empleados;
drop table login;
drop table personas;

create table materiales(
    materialID integer primary key,
    unidad varchar(8),
    cantidadInventario integer,
    descripcion varchar(30)
);


create table productos(
    productoID integer primary key,
    nombre varchar(10) not null,
    descripcion varchar(70),
    personalizable varchar(1), 
    precioBase number(8,2) not null,
    ventas integer
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
    nombre varchar(15) not null,
    direccion varchar(20),
    telefono char(9)
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
    sueldo number(6,2) not null,
    horarioID integer not null,
    dias varchar(20),
    horario varchar(15),
    foreign key (dni) references personas on delete Cascade
);

create table login (
    loginID integer primary key,
    dni char(9) not null,
    pass varchar(10) not null,
    FOREIGN key (dni) references personas on delete Cascade
);