set serveroutput on;
create or replace
package pruebas_materiales as
    procedure inicializar;
    procedure insertar (unidad_in varchar, cantidadInventario_in integer, descripcion_in varchar, unidad_esperada varchar, salida_esperada boolean);
    procedure actualizar (materialID_in integer, cantidadInventario_in integer, cantidadInventario_esperado integer, salida_esperada boolean);
    procedure eliminar (materialID_in integer, salida_esperada boolean);
end pruebas_materiales;
/
create or replace
package body pruebas_materiales as
    procedure inicializar as
    begin
        delete from materiales;
    end inicializar;
    
    procedure insertar (unidad_in varchar, cantidadInventario_in integer, descripcion_in varchar, unidad_esperada varchar, salida_esperada boolean) as
        fila materiales%rowtype;
        salida boolean := true;
        valor integer;
    begin
        insert into materiales(materialID, unidad, cantidadInventario, descripcion)
            values (secuenciaMateriales.nextval, unidad_in, cantidadInventario_in, descripcion_in);
            
        valor:= secuenciaMateriales.currval;
        
        select * into fila from materiales where materiales.materialID=valor;
        if ((unidad_esperada<>fila.unidad))
            then salida := false;
        end if;
        
        commit work;
            dbms_output.put_line('Prueba insertar ' || pruebamaterialessec.nextval || ': ' || assert_equals(salida,salida_esperada));
        exception
        when others then
             dbms_output.put_line('Prueba insertar ' || pruebamaterialessec.nextval || ': ' || assert_equals(false,salida_esperada));
        rollback;
    end insertar;
        
    procedure actualizar (materialID_in integer, cantidadInventario_in integer, cantidadInventario_esperado integer, salida_esperada boolean) as
        salida boolean := true;
        valor integer;
        fila materiales%rowtype;
    begin
        update materiales set cantidadInventario=cantidadInventario_in where materialID=materialID_in;
        
        select * into fila from materiales where materialID=materialID_in;
        if ((cantidadInventario_esperado<>fila.cantidadInventario))
            then salida := false;
        end if;
        
        commit work;
            dbms_output.put_line('Prueba actualizar ' || pruebamaterialessec.nextval || ': ' || assert_equals(salida,salida_esperada));
        exception 
        when others then
            dbms_output.put_line('Prueba actualizar ' || pruebamaterialessec.nextval || ': ' || assert_equals(false,salida_esperada));
            rollback;  
    end actualizar; 
    
    procedure eliminar (materialID_in integer, salida_esperada boolean) as
        salida boolean := true;
        valor integer;
    begin
        delete from materiales where materiales.materialID=materialID_in;
        
        select count(*) into valor from materiales where materiales.materialID=materialID_in;
        if (valor<>0)
            then salida := false;
        end if;
        
        commit work;
            dbms_output.put_line('Prueba eliminar ' || pruebamaterialessec.nextval || ': ' || assert_equals(salida,salida_esperada));
        exception 
        when others then
            dbms_output.put_line('Prueba eliminar ' || pruebamaterialessec.nextval || ': ' || assert_equals(false,salida_esperada));
            rollback;  
    end eliminar;

end;