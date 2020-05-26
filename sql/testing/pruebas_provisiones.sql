set serveroutput on;
create or replace 
package pruebas_provisiones as  
    procedure inicializar;
    procedure insertar(materialid_in integer, proveedorid_in integer, preciounitario_in number, preciounitario_esperado number, salida_esperada boolean);
    procedure actualizar(provisionid_in integer, preciounitario_in number, preciounitario_esperado number,salida_esperada boolean);
    procedure eliminar(provisionid_in integer, salida_esperada boolean);
end pruebas_provisiones;
/
create or replace 
package body pruebas_provisiones as  
    procedure inicializar as 
    begin
        delete from provisiones;
    end inicializar;
    
    procedure insertar(
        materialid_in integer, proveedorid_in integer, preciounitario_in number, preciounitario_esperado number, salida_esperada boolean
    )
    as
        fila provisiones%rowtype;
        salida boolean := true;
        valor integer;
        precioBase number;
    begin         
        insert into provisiones(provisionid,materialid,proveedorid,preciounitario)
            values(secuenciaProvisiones.nextval,materialid_in,proveedorid_in,preciounitario_in);
        valor := secuenciaProvisiones.currval;
        select * into fila from provisiones where provisiones.provisionid=valor;
        
        if ((preciounitario_esperado<>fila.preciounitario))
        then salida := false;
        end if;
        commit work;
        dbms_output.put_line('Prueba insertar ' || pruebaProvisionesSec.nextval || ': ' || assert_equals(salida,salida_esperada));
        
        exception 
        when others then
            dbms_output.put_line('Prueba insertar ' || pruebaProvisionesSec.nextval || ': ' || assert_equals(false,salida_esperada));
            rollback; 
    end insertar;
    
    procedure actualizar(
        provisionid_in integer, preciounitario_in number, preciounitario_esperado number,salida_esperada boolean
    ) as
        salida boolean :=true;
        valor integer;
        fila provisiones%rowtype;
    begin
        update provisiones set preciounitario=preciounitario_in where provisionid=provisionid_in;
        
        select * into fila from provisiones where provisionid=provisionid_in;
        if ((preciounitario_esperado<>fila.precioUnitario))
        then salida := false;
        end if;
        commit work;
        dbms_output.put_line('Prueba actualizar ' || pruebaprovisionessec.nextval || ': ' || assert_equals(salida,salida_esperada));
        exception 
        when others then
            dbms_output.put_line('Prueba actualizar ' || pruebaprovisionessec.nextval || ': ' || assert_equals(false,salida_esperada));
            rollback;  
    end actualizar; 
    
    procedure eliminar(
        provisionid_in integer,salida_esperada boolean
    ) as
        salida boolean :=true;
        valor integer;
    begin
        delete from provisiones where provisiones.provisionid=provisionid_in;
        select count(*) into valor from provisiones where provisiones.provisionid=provisionid_in;
        
        if (valor<>0)
        then salida := false;
        end if;
        commit work;
        dbms_output.put_line('Prueba eliminar ' || pruebaprovisionessec.nextval || ': ' || assert_equals(salida,salida_esperada));
        exception 
        when others then
            dbms_output.put_line('Prueba eliminar ' || pruebaprovisionessec.nextval || ': ' || assert_equals(false,salida_esperada));
            rollback;  
    end eliminar;
end;