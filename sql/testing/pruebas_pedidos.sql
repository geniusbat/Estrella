set serveroutput on;
create or replace 
package pruebas_pedidos as  
    procedure inicializar;
    procedure insertar(precioTotal_in number,fechaInicio_in date,dni_in char, preciototal_esperado number,salida_esperada boolean);
    procedure actualizar(pedidoid_in integer,preciototal_in number,preciototal_esperado number,salida_esperada boolean);
    procedure eliminar(pedidoid_in integer, salida_esperada boolean);
end pruebas_pedidos;
/
create or replace 
package body pruebas_pedidos as  
    procedure inicializar as 
    begin
        delete from pedidos;
    end inicializar;
    
    procedure insertar(
            precioTotal_in number,fechaInicio_in date,dni_in char, preciototal_esperado number,salida_esperada boolean
    )
    as
        fila pedidos%rowtype;
        salida boolean := true;
        valor integer;
    begin         
        insert into pedidos(pedidoid,preciototal,fechainicio,enviado,dni) 
            values(secuenciapedidos.nextval,precioTotal_in,fechainicio_in,0,dni_in);
        
        valor := secuenciapedidos.currval;
        select * into fila from pedidos where pedidos.pedidoid=valor;
        if((preciototal_esperado<>fila.preciototal))
        then salida:=false;
        end if;
        commit work;
        dbms_output.put_line('Prueba insertar ' || pruebaPedidoSec.nextval || ': ' || assert_equals(salida,salida_esperada));
        
        exception 
        when others then
            dbms_output.put_line('Prueba insertar ' || pruebaPedidoSec.nextval || ': ' || assert_equals(false,salida_esperada));
            rollback;
    end insertar;
    
    procedure actualizar(
        pedidoid_in integer,preciototal_in number,preciototal_esperado number,salida_esperada boolean
    ) as
        salida boolean :=true;
        valor integer;
        fila pedidos%rowtype;
    begin
        update pedidos set pedidos.preciototal=preciototal_in where pedidos.pedidoid=pedidoid_in;
        select * into fila from pedidos where pedidos.pedidoid=pedidoid_in;
        if ((preciototal_esperado<>fila.precioTotal))
        then salida := false;
        end if;
        commit work;
        dbms_output.put_line('Prueba actualizar ' || pruebaPedidoSec.nextval || ': ' || assert_equals(salida,salida_esperada));
        exception 
        when others then
            dbms_output.put_line('Prueba actualizar ' || pruebaPedidoSec.nextval || ': ' || assert_equals(false,salida_esperada));
            rollback;  
    end actualizar;
    
    procedure eliminar(
        pedidoid_in integer, salida_esperada boolean
    ) as
        salida boolean :=true;
        valor integer;
    begin
        delete from pedidos where pedidos.pedidoid=pedidoid_in;
        select count(*) into valor from pedidos where pedidos.pedidoid=pedidoid_in;
        if (valor<>0)
            then salida := false;
        end if;
        commit work;
        dbms_output.put_line('Prueba eliminar ' || pruebaPedidoSec.nextval || ': ' || assert_equals(salida,salida_esperada));
        
        exception 
        when others then
            dbms_output.put_line('Prueba eliminar ' || pruebaPedidoSec.nextval || ': ' || assert_equals(false,salida_esperada));
            rollback; 
    end eliminar;
end;