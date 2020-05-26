set serveroutput on;
create or replace
package pruebas_horarios as
    procedure inicializar;
    procedure insertar (lunes_in varchar2, martes_in varchar2, miercoles_in varchar2, jueves_in varchar2, viernes_in varchar2, martes_esperado varchar2, salida_esperada boolean);
    procedure actualizar (horarioID_in integer, miercoles_in varchar2, miercoles_esperado varchar2, salida_esperada boolean);
    procedure eliminar (horarioID_in integer, salida_esperada boolean);
end pruebas_horarios;
/
create or replace
package body pruebas_horarios as
    procedure inicializar as
    begin
        delete from horarios;
    end inicializar;
    
    procedure insertar (lunes_in varchar2, martes_in varchar2, miercoles_in varchar2, jueves_in varchar2, viernes_in varchar2, martes_esperado varchar2, salida_esperada boolean) as
        fila horarios%rowtype;
        salida boolean := true;
        valor integer;
    begin 
        insert into horarios (horarioID, lunes, martes, miercoles, jueves, viernes)
            values (secuenciaHorarios.nextval, lunes_in, martes_in, miercoles_in, jueves_in, viernes_in);
        
        valor := secuenciaHorarios.currval;
        
        select * into fila from horarios where horarios.horarioID=valor;
        if ((martes_esperado<>fila.martes))
            then salida := false;
        end if;
        
        commit work;
            dbms_output.put_line('Prueba insertar ' || pruebaHorariosSec.nextval || ': ' || assert_equals(salida,salida_esperada));
        exception 
        when others then
            dbms_output.put_line('Prueba insertar ' || pruebaHorariosSec.nextval || ': ' || assert_equals(false,salida_esperada));
            rollback;  
    end insertar;
        
    procedure actualizar (horarioID_in integer, miercoles_in varchar2, miercoles_esperado varchar2, salida_esperada boolean) as
        salida boolean := true;
        valor integer;
        fila horarios%rowtype;
    begin
        update horarios set miercoles=miercoles_in where horarioID=horarioID_in;
        
        select * into fila from horarios where horarioID=horarioID_in;
        if ((miercoles_esperado<>fila.miercoles))
            then salida := false;
        end if;
        
        commit work;
            dbms_output.put_line('Prueba actualizar ' || pruebaHorariosSec.nextval || ': ' || assert_equals(salida,salida_esperada));
        exception 
        when others then
            dbms_output.put_line('Prueba actualizar ' || pruebaHorariosSec.nextval || ': ' || assert_equals(false,salida_esperada));
        rollback;  
    end actualizar; 
        
    procedure eliminar (horarioID_in integer, salida_esperada boolean) as
        salida boolean := true;
        valor integer;
    begin
        delete from horarios where horarios.horarioID=horarioID_in;
        
        select count (*) into valor from horarios where horarios.horarioID=horarioID_in;
        if (valor<>0)
            then salida := false;
        end if;
        
        commit work;
            dbms_output.put_line('Prueba eliminar ' || pruebaHorariosSec.nextval || ': ' || assert_equals(salida,salida_esperada));
        
        exception 
        when others then
            dbms_output.put_line('Prueba eliminar ' || pruebaHorariosSec.nextval || ': ' || assert_equals(false,salida_esperada));
        rollback; 
    end eliminar;
    
end;