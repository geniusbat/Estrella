set serveroutput on;
create or replace
package pruebas_proveedores as
    procedure inicializar;
    procedure insertar (direccion_in varchar, salida_esperada boolean);
    procedure actualizar (proveedorID_in integer, salida_esperada boolean);
    procedure eliminar (proveedorID_in integer, salida_esperada boolean);
end pruebas_proveedores;
/
create or replace 
package body pruebas_proveedores as
    procedure inicializar as
    begin
        delete from proveedores;
    end inicializar;
    
    procedure insertar (direccion_in varchar, salida_esperada boolean) as
        fila proveedores%rowtype;
        salida boolean := true;
        valor integer;
        
    begin
        insert into proveedores (proveedorID, direccion, costeEnvio)
            values (secuenciaProveedores.nextval, direccion_in);
            
        valor := secuenciaProveedores.currval;
            
        select * into fila from proveedores where proveedores.proveedorID=valor;
        if (false)
            then salida := false;
        end if;
        
        commit work;
            dbms_output.put_line('Prueba insertar ' || pruebaproveedoressec.nextval || ': ' || assert_equals(salida,salida_esperada));
        exception
        when others then
            dbms_output.put_line('Prueba insertar ' || pruebaproveedoressec.nextval || ': ' || assert_equals(false,salida_esperada));
        rollback;
        
    end insertar;
            
    procedure actualizar (proveedorID_in integer,salida_esperada boolean) as
        salida boolean := true;
        valor integer;
        fila proveedores%rowtype;
    begin
        
        select * into fila from proveedores where proveedorID=proveedorID_in;
        if (false)
            then salida := false;
        end if;
        
        commit work;
            dbms_output.put_line('Prueba actualizar ' || pruebaproveedoressec.nextval || ': ' || assert_equals(salida,salida_esperada));
        exception 
        when others then
            dbms_output.put_line('Prueba actualizar ' || pruebaproveedoressec.nextval || ': ' || assert_equals(false,salida_esperada));
        rollback;  
    end actualizar; 
        
        
    procedure eliminar (proveedorID_in integer, salida_esperada boolean) as
        salida boolean := true;
        valor integer;
    begin
        delete from proveedores where proveedores.proveedorID=proveedorID_in;
        
        select count (*) into valor from proveedores where proveedores.proveedorID=proveedorID_in;
        if (valor<>0)
            then salida := false;
        end if;
        
        commit work;
            dbms_output.put_line('Prueba eliminar ' || pruebaproveedoressec.nextval || ': ' || assert_equals(salida,salida_esperada));
        exception 
        when others then
            dbms_output.put_line('Prueba eliminar ' || pruebaproveedoressec.nextval || ': ' || assert_equals(false,salida_esperada));
        rollback;  
    end eliminar;
        
end;