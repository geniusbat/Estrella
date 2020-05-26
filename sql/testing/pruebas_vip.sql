set serveroutput on;
create or replace 
package pruebas_usuariosVIP as  
    procedure inicializar;
    procedure insertar(extra_in varchar, extra_esperado varchar, salida_esperada boolean);
    procedure actualizar(vipid_in integer,extra_in varchar,extra_esperado varchar, salida_esperada boolean);
    procedure eliminar(vipid_in integer, salida_esperada boolean);
end pruebas_usuariosVIP;
/
create or replace 
package body pruebas_usuariosVIP as  
    procedure inicializar as 
    begin
        delete from usuariosVIP;
    end inicializar;
    
    procedure insertar(
        extra_in varchar, extra_esperado varchar, salida_esperada boolean
    )
    as
        fila usuariosVIP%rowtype;
        salida boolean := true;
        valor integer;
    begin         
        insert into usuariosVIP(vipid,extra) values(secuenciaUsuariosVip.nextval,extra_in);
        valor := secuenciaUsuariosVip.currval;
        select * into fila from UsuariosVip where UsuariosVip.vipid=valor;
        if ((extra_esperado<>fila.extra))
            then salida := false;
        end if;
        commit work;
            dbms_output.put_line('Prueba insertar ' || pruebaVipSec.nextval || ': ' || assert_equals(salida,salida_esperada));
        exception 
        when others then
            dbms_output.put_line('Prueba insertar ' || pruebaVipSec.nextval || ': ' || assert_equals(false,salida_esperada));
            rollback;  
    end insertar;
    
    procedure actualizar(vipid_in integer,extra_in varchar,extra_esperado varchar, salida_esperada boolean) as
        fila usuariosVIP%rowtype;
        salida boolean := true;
        valor integer;
    begin
        update usuariosVip set extra=extra_in where vipid=vipid_in;
        
        select * into fila from usuariosVip where vipid=vipid_in;
        if ((extra_esperado <> fila.extra))
            then salida := false;
        end if;
    
        commit work;
            dbms_output.put_line('Prueba actualizar ' || pruebaVipSec.nextval || ': ' || assert_equals(salida,salida_esperada));
        exception 
        when others then
            dbms_output.put_line('Prueba actualizar ' || pruebaVipSec.nextval || ': ' || assert_equals(false,salida_esperada));
        rollback; 
    end actualizar;
    
    procedure eliminar(
        vipid_in integer, salida_esperada boolean
    ) as
        salida boolean :=true;
        valor integer;
    begin
        delete from usuariosVip where usuariosVip.vipId=vipId_in;
        
        select count (*) into valor from usuariosVip where usuariosVip.vipId=vipId_in;
        if (valor<>0)
            then salida := false;
        end if;
        
        commit work;
            dbms_output.put_line('Prueba eliminar ' || pruebaVipSec.nextval || ': ' || assert_equals(salida,salida_esperada));
        exception 
        when others then
            dbms_output.put_line('Prueba eliminar ' || pruebaVipSec.nextval || ': ' || assert_equals(false,salida_esperada));
        rollback; 
    end eliminar;
end;