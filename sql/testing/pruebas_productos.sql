set serveroutput on;
create or replace 
package pruebas_productos as  
    procedure inicializar;
    procedure insertar(nombre_in varchar,preciobase_in number,salida_esperada boolean,nombre_esperado varchar,preciobase_esperado number);
    procedure actualizar(productoid_in integer, nombre_in varchar, nombre_esperado varchar,salida_esperada boolean);
    procedure eliminar(productoid_in integer,salida_esperada boolean);
end pruebas_productos;
/
create or replace 
package body pruebas_productos as  
    procedure inicializar as 
    begin
        delete from productos;
    end inicializar;
    
    procedure insertar(
        nombre_in varchar,preciobase_in number,salida_esperada boolean,nombre_esperado varchar,preciobase_esperado number
    )
    as
        fila productos%rowtype;
        salida boolean := true;
        valor integer;
    begin 
        insert into productos(productoid,nombre,preciobase,ventas) values(secuenciaproductos.nextval,nombre_in,preciobase_in,0);
        valor := secuenciaproductos.currval;
        select * into fila from productos where productos.productoid=valor;
        
        if ((nombre_esperado<>fila.nombre)and(preciobase_esperado<>fila.preciobase))
        then salida := false;
        end if;
        commit work;
        
        dbms_output.put_line('Prueba insertar ' || pruebaproductosec.nextval || ': ' || assert_equals(salida,salida_esperada));
        
        exception 
        when others then
            dbms_output.put_line('Prueba insertar ' || pruebaproductosec.nextval || ': ' || assert_equals(false,salida_esperada));
            rollback;        
    end insertar;
    
    procedure actualizar(
        productoid_in integer, nombre_in varchar, nombre_esperado varchar,salida_esperada boolean
    ) as
        salida boolean :=true;
        valor integer;
        fila productos%rowtype;
    begin
        update productos set nombre=nombre_in where productoid=productoid_in;
        
        select * into fila from productos where productoid=productoid_in;
        if ((nombre_esperado<>fila.nombre))
        then salida := false;
        end if;
        commit work;
        dbms_output.put_line('Prueba actualizar ' || pruebaproductosec.nextval || ': ' || assert_equals(salida,salida_esperada));
        exception 
        when others then
            dbms_output.put_line('Prueba actualizar ' || pruebaproductosec.nextval || ': ' || assert_equals(false,salida_esperada));
            rollback;  
    end actualizar; 
    
    procedure eliminar(
        productoid_in integer, salida_esperada boolean
    ) as
        salida boolean :=true;
        valor integer;
    begin
        delete from productos where productos.productoid=productoid_in;
        select count(*) into valor from productos where productos.productoid=productoid_in;
        
        if (valor<>0)
        then salida := false;
        end if;
        commit work;
        dbms_output.put_line('Prueba eliminar ' || pruebaproductosec.nextval || ': ' || assert_equals(salida,salida_esperada));
    
        exception 
        when others then
            dbms_output.put_line('Prueba eliminar ' || pruebaproductosec.nextval || ': ' || assert_equals(false,salida_esperada));
            rollback;   
    end eliminar;
end;