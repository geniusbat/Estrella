set serveroutput on;
create or replace 
package pruebas_usuarios as  
    procedure inicializar;
    procedure insertar(dni_in char, nombre_in varchar, direccion_in varchar, dni_esperado char, nombre_esperado varchar, salida_esperada boolean);
    procedure actualizar(dni_in char, telefono_in char, telefono_esperado char, salida_esperada boolean); 
    procedure eliminar(dni char, salida_esperada boolean);
end pruebas_usuarios;
/
create or replace 
package body pruebas_usuarios as  
    procedure inicializar as 
    begin
        delete from usuarios;
    end inicializar;
    
    procedure insertar(
        dni_in char, nombre_in varchar, direccion_in varchar, dni_esperado char, nombre_esperado varchar, salida_esperada boolean
    )
    as
        fila usuarios%rowtype;
        salida boolean := true;
        valor integer;
    begin         
        insert into usuarios(dni,nombre,direccion) values(dni_in,nombre_in,direccion_in);
        select * into fila from usuarios where usuarios.dni=dni_in;
        if ((fila.dni<>dni_esperado)and(fila.nombre<>nombre_esperado))
        then salida := false;
        end if;
        commit work;
        dbms_output.put_line('Prueba insertar ' || pruebausuariosSec.nextval || ': ' || assert_equals(salida,salida_esperada));
        
        exception 
        when others then
            dbms_output.put_line('Prueba insertar ' || pruebausuariosSec.nextval || ': ' || assert_equals(false,salida_esperada));
            rollback;       
    end insertar;
    
    procedure actualizar(
        dni_in char, telefono_in char, telefono_esperado char, salida_esperada boolean
    ) as
        fila usuarios%rowtype;
        salida boolean :=true;
        valor integer; 
    begin
        update usuarios set usuarios.telefono=telefono_in where usuarios.dni=dni_in;
        select * into fila from usuarios where usuarios.dni=dni_in;
        if (fila.telefono<>telefono_esperado)
        then salida := false;
        end if;
        commit work;
        dbms_output.put_line('Prueba actualizar ' || pruebausuariosSec.nextval || ': ' || assert_equals(salida,salida_esperada));
        
        exception 
        when others then
            dbms_output.put_line('Prueba actualizar ' || pruebausuariosSec.nextval || ': ' || assert_equals(false,salida_esperada));
            rollback;
    end actualizar;
    
    procedure eliminar(
        dni char, salida_esperada boolean
    ) as
        salida boolean :=true;
        valor integer;
    begin
                if (valor<>0)
        then salida := false;
        end if;
        commit work;
        dbms_output.put_line('Prueba eliminar ' || pruebausuariosSec.nextval || ': ' || assert_equals(salida,salida_esperada));
        exception 
        when others then
            dbms_output.put_line('Prueba eliminar ' || pruebausuariosSec.nextval || ': ' || assert_equals(false,salida_esperada));
            rollback;  
    end eliminar;
end;