set serveroutput on;
create or replace 
package pruebas_encargos as  
    procedure inicializar;
    procedure insertar();
    procedure actualizar();
    procedure eliminar();
end pruebas_encargos;
/
create or replace 
package body pruebas_encargos as  
    procedure inicializar as 
    begin
        delete from encargos;
    end inicializar;
    
    procedure insertar(
        
    )
    as
        fila __%rowtype;
        salida boolean := true;
        valor integer;
    begin         
    end insertar;
    
    procedure actualizar(
        salida boolean :=true;
        valor integer; 
    ) as
    begin
    
    end actualizar;
    
    procedure eliminar(
        
    ) as
        salida boolean :=true;
        valor integer;
    begin
    end eliminar;
end;