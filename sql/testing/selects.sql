set serveroutput on;

create or replace procedure getventas(
    producto in productos.ventas%type
) as
fila productos%rowtype;
begin 
    select * into fila from productos where productos.productoID = producto;
    dbms_output.put_line(fila.ventas||' ventas del producto '|| producto);
end;
/
create or replace procedure getventasall as
cursor productosC is
    select * from productos order by productos.ventas desc;
begin 
    for elemento in productosC loop
        if (elemento.ventas is not null)
        then
            dbms_output.put_line(elemento.ventas||' ventas del producto '|| elemento.productoID);
        else
            dbms_output.put_line('0 ventas del producto '|| elemento.productoID);
        end if;
    end loop;
end;
/
create or replace procedure getestadoencargosall as
cursor encargosC is
    select * from encargos;
begin 
    for elemento in encargosC loop
        dbms_output.put_line('Producto ' || elemento.encargoID||': '|| elemento.estado);
    end loop;
end;
/
create or replace procedure getmejorprecio(
    materialbuscado in materiales.materialid%type
) as
cursor provisionesc is select * from provisiones where provisiones.materialid=materialbuscado;
empieza integer:=0;
mejormaterial integer;
mejorprecio integer;
envio number(6,2);
precio number(8,2);
begin
    for elemento in provisionesc loop
        if (empieza=0)
        then 
            mejormaterial:=elemento.materialid; 
            select costeenvio into envio from proveedores where proveedores.proveedorid=elemento.proveedorid;
            precio:=elemento.preciounitario;
            mejorprecio:=precio+envio;
            empieza:=1;
        else 
            select costeenvio into envio from proveedores where proveedores.proveedorid=elemento.proveedorid;
            precio:=elemento.preciounitario;
            if (mejorprecio>(precio+envio))
            then
                mejormaterial:=elemento.materialid; 
                mejorprecio:=precio+envio;
            end if;
        end if;
    end loop;
    dbms_output.put_line('Mejor proveedor: ' || mejormaterial || ' a ' || mejorprecio || ' euros la unidad'); 
end;
/
create or replace procedure getinventario as
cursor materialesc is select * from materiales where cantidadInventario>0;
begin
    for elemento in materialesc loop
        dbms_output.put_line('Producto: '||elemento.materialid||', cantidad: ' ||elemento.cantidadInventario);
    end loop;
end;
/