set serveroutput on;
create or replace
package pruebas_manufacturacion as
    procedure inicializar;
    procedure insertar (materialID_in integer, productoID_in integer, salida_esperada boolean);
    procedure actualizar(manufacturacionID_in integer,salida_esperada boolean);
    procedure eliminar(manufacturacionID_in integer, salida_esperada boolean);
    
end pruebas_manufacturacion;
/
create or replace
package body pruebas_manufacturacion as
    procedure inicializar as
    begin
        delete from manufacturacion;
    end inicializar;
        
    procedure insertar (materialID_in integer, productoID_in integer, salida_esperada boolean) as
        fila manufacturacion%rowtype;
        salida boolean := true;
        valor integer;
    begin
        insert into manufacturacion(manufacturacionID, materialID) 
            values(secuenciaManufacturacion.nextval, materialID_in, productoID_in);
        
        valor := secuenciaManufacturacion.currval;
        
        commit work;
            dbms_output.put_line('Prueba insertar ' || pruebaManufacturacionSec.nextval || ': ' || assert_equals(salida,salida_esperada));
        exception 
        when others then
            dbms_output.put_line('Prueba insertar ' || pruebaManufacturacionSec.nextval || ': ' || assert_equals(false,salida_esperada));
            rollback;  
    end insertar;
    
    procedure actualizar (manufacturacionID_in integer, salida_esperada boolean) as
        salida boolean := true;
        valor integer;
        fila manufacturacion%rowtype;
    begin
        
        select * into fila from manufacturacion where manufacturacionID=manufacturacionID_in;
        if (false)
            then salida := false;
        end if;
        
        commit work;
            dbms_output.put_line('Prueba actualizar ' || pruebaManufacturacionSec.nextval || ': ' || assert_equals(salida,salida_esperada));
        exception 
        when others then
            dbms_output.put_line('Prueba actualizar ' || pruebaManufacturacionSec.nextval || ': ' || assert_equals(false,salida_esperada));
        rollback;  
    end actualizar; 
    
    procedure eliminar (manufacturacionID_in integer, salida_esperada boolean) as
        salida boolean := true;
        valor integer;
    begin
        delete from manufacturacion where manufacturacion.manufacturacionID=manufacturacionID_in;
        
        select count(*) into valor from manufacturacion where manufacturacion.manufacturacionID=manufacturacionID_in;
        if (valor<>0)
            then salida := false;
        end if;
        
        commit work;
            dbms_output.put_line('Prueba eliminar ' || pruebaManufacturacionSec.nextval || ': ' || assert_equals(salida,salida_esperada));
        
        exception 
        when others then
            dbms_output.put_line('Prueba eliminar ' || pruebaManufacturacionSec.nextval || ': ' || assert_equals(false,salida_esperada));
        rollback; 
    end eliminar;

end;
    
    
    
    
    
        
        
        
        