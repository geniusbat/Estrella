create or replace procedure creaEncargo(
    pedido in pedidos.pedidoID%TYPE,
    producto in encargos.productoID%TYPE,
    extra in encargos.extras%type,
    precioExtra in productos.precioBase%type
) as
precioBase number(8,2);
precioaux number(8,2);
begin 
    select productos.precioBase into precioBase from productos where (productos.productoID = producto);
    select sum(precio) into precioaux from encargos where encargos.pedidoid=pedido;
    insert into encargos(encargoID,precio,extras,productoID,pedidoID,estado) values(secuenciaEncargos.nextval,precioBase+precioExtra,extra,producto,pedido,'sin empezar');
    if (precioaux is null)
    then precioaux:=0;
    end if;
    update pedidos set pedidos.preciototal=(precioaux+preciobase+precioextra) where pedidos.pedidoid=pedido;
end;
/
create or replace procedure pedidoTerminado(
    pedID in pedidos.pedidoID%type
) as
begin
    update pedidos set fechaenvio=sysdate, enviado=1 where pedidoid=pedID;
end;
/
create or replace procedure encargoSiguientePaso(
    encID in encargos.encargoid%type
) as
estado encargos.estado%type;
begin 
    select encargos.estado into estado from encargos where encargos.encargoID=encID;
    if (estado='sin empezar')
    then update encargos set encargos.estado='empezado' where encargos.encargoid=encID;
    end if;
    if (estado='empezado')
    then update encargos set encargos.estado='terminado' where encargos.encargoid=encID;
    end if;
end;
/