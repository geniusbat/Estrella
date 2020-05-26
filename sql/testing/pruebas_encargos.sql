set serveroutput on;
create or replace 
package pruebas_encargos as  
    procedure inicializar;
    procedure insertar(productoid_in integer, pedidoid_in integer, extra_in varchar, precioextra_in number, precio_esperado number,salida_esperada boolean);
    procedure actualizar(encargoid_in integer, precio_in number, precio_esperado number,salida_esperada boolean);
    procedure eliminar(encargoid_in integer, salida_esperada boolean);
end pruebas_encargos;
/
create or replace 
package body pruebas_encargos as  
    procedure inicializar as 
    begin
        delete from encargos;
    end inicializar;
    
    procedure insertar(
        productoid_in integer, pedidoid_in integer, extra_in varchar, precioextra_in number, precio_esperado number, salida_esperada boolean
    )
    as
        fila encargos%rowtype;
        salida boolean := true;
        valor integer;
        precioBase number;
        precioaux number;
    begin         
        select productos.precioBase into precioBase from productos where (productos.productoID = productoid_in);
        select sum(precio) into precioaux from encargos where encargos.pedidoid=pedidoid_in;
        insert into encargos(encargoID,precio,extras,productoID,pedidoID,estado) values(secuenciaEncargos.nextval,(precioBase+precioExtra_in),extra_in,productoid_in,pedidoid_in,'sin empezar');
        if (precioaux is null)
        then precioaux:=0;
        end if;
        update pedidos set pedidos.preciototal=(precioaux+preciobase+precioextra_in) where pedidos.pedidoid=pedidoid_in;
        
        
        valor := secuenciaencargos.currval;
        select * into fila from encargos where encargos.encargoid=valor;
        
        if ((precio_esperado<>fila.precio)and('sin empezar'<>fila.estado))
        then salida := false;
        end if;
        commit work;
        dbms_output.put_line('Prueba insertar ' || pruebaencargosec.nextval || ': ' || assert_equals(salida,salida_esperada));
        
        exception 
        when others then
            dbms_output.put_line('Prueba insertar ' || pruebaencargosec.nextval || ': ' || assert_equals(false,salida_esperada));
            rollback; 
    end insertar;
    
    procedure actualizar(
        encargoid_in integer, precio_in number, precio_esperado number,salida_esperada boolean
    ) as
        salida boolean :=true;
        valor integer;
        fila encargos%rowtype;
    begin
        update encargos set precio=precio_in where encargoid=encargoid_in;
        
        select * into fila from encargos where encargoid=encargoid_in;
        if ((precio_esperado<>fila.precio))
        then salida := false;
        end if;
        commit work;
        dbms_output.put_line('Prueba actualizar ' || pruebaencargosec.nextval || ': ' || assert_equals(salida,salida_esperada));
        exception 
        when others then
            dbms_output.put_line('Prueba actualizar ' || pruebaencargosec.nextval || ': ' || assert_equals(false,salida_esperada));
            rollback;  
    end actualizar; 

    procedure eliminar(
        encargoid_in integer, salida_esperada boolean
    ) as
        salida boolean :=true;
        valor integer;
    begin
        delete from encargos where encargos.encargoid=encargoid_in;
        select count(*) into valor from encargos where encargos.encargoid=encargoid_in;
        if (valor<>0)
            then salida := false;
        end if;
        commit work;
        dbms_output.put_line('Prueba eliminar ' || pruebaencargosec.nextval || ': ' || assert_equals(salida,salida_esperada));
        
        exception 
        when others then
            dbms_output.put_line('Prueba eliminar ' || pruebaencargosec.nextval || ': ' || assert_equals(false,salida_esperada));
            rollback; 
    end eliminar;
end;