set serveroutput on;
create or replace
package pruebas_empleados as
    procedure inicializar;
    procedure insertar (dni_in char, nombre_in varchar, direccion_in varchar, telefono_in char, sueldo_in number, horarioID_in integer, sueldo_esperado number, salida_esperada boolean);
    procedure actualizar (empleadoID_in integer, sueldo_in number, sueldo_esperado number, salida_esperada boolean);
    procedure eliminar (empleadoID_in integer, salida_esperada boolean);
end pruebas_empleados;
/
create or replace
package body pruebas_empleados as
    procedure inicializar as
    begin
        delete from empleados;
    end inicializar;
    
    procedure insertar (dni_in char, nombre_in varchar, direccion_in varchar, telefono_in char, sueldo_in number, horarioID_in integer, sueldo_esperado number, salida_esperada boolean) as
        fila empleados%rowtype;
        salida boolean := true;
        valor integer;
        
    begin
        insert into empleados (empleadoID, DNI, nombre, direccion, telefono, sueldo, horarioID)
            values (secuenciaEmpleados.nextval, dni_in, nombre_in, direccion_in, telefono_in, sueldo_in, horarioID_in);
            
        valor := secuenciaEmpleados.currval;
        
        select * into fila from empleados where empleados.empleadoID=valor;
        if ((sueldo_esperado<>fila.sueldo))
            then salida := false;
        end if;
        
        commit work;
            dbms_output.put_line('Prueba insertar ' || pruebaEmpleadosSec.nextval || ': ' || assert_equals(salida,salida_esperada));
        exception 
        when others then
            dbms_output.put_line('Prueba insertar ' || pruebaEmpleadosSec.nextval || ': ' || assert_equals(false,salida_esperada));
            rollback;  
    end insertar;
        
    procedure actualizar (empleadoID_in integer, sueldo_in number, sueldo_esperado number, salida_esperada boolean) as
        salida boolean := true;
        valor integer;
        fila empleados%rowtype;
    begin
        update empleados set sueldo=sueldo_in where empleadoID=empleadoID_in;
        
        select * into fila from empleados where empleadoID=empleadoID_in;
        if ((sueldo_esperado <> fila.sueldo))
            then salida := false;
        end if;
    
        commit work;
            dbms_output.put_line('Prueba actualizar ' || pruebaEmpleadosSec.nextval || ': ' || assert_equals(salida,salida_esperada));
        exception 
        when others then
            dbms_output.put_line('Prueba actualizar ' || pruebaEmpleadosSec.nextval || ': ' || assert_equals(false,salida_esperada));
        rollback;  
    end actualizar;
    
    procedure eliminar (empleadoID_in integer, salida_esperada boolean) as
        salida boolean := true;
        valor integer;
    begin 
        delete from empleados where empleados.empleadoID=empleadoID_in;
        
        select count (*) into valor from empleados where empleados.empleadoID=empleadoID_in;
        if (valor<>0)
            then salida := false;
        end if;
        
        commit work;
            dbms_output.put_line('Prueba eliminar ' || pruebaEmpleadosSec.nextval || ': ' || assert_equals(salida,salida_esperada));
        
        exception 
        when others then
            dbms_output.put_line('Prueba eliminar ' || pruebaEmpleadosSec.nextval || ': ' || assert_equals(false,salida_esperada));
        rollback; 
    end eliminar;
    
    
end;