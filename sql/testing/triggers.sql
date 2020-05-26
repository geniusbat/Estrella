create or replace trigger chequeaEnviadoBoolean
before update or insert on pedidos for each row
begin
    if ((:new.enviado!=1)and(:new.enviado!=0))
    then raise_application_error
            (-20600,'Solo se permiten 0s o 1s');
    end if;
end;
/
create or replace trigger chequeaPersonalizableBoolean
before update or insert on productos for each row
begin
    if ((:new.personalizable!=1)and(:new.personalizable!=0))
    then raise_application_error
            (-20600,'Solo se permiten 0s o 1s');
    end if;
end;
/
create or replace trigger añadeVentas
after insert on encargos for each row
begin
    update productos set ventas=ventas+1 where productoID=:new.productoID;
end;
/
create or replace trigger chequeaEstadoCorrectoEncargo
before insert or update on encargos for each row    
declare estado varchar(11);
begin 
    estado := :new.estado;
    if not ((estado='terminado')or(estado='sin empezar')or(estado='empezado'))
    then raise_application_error
            (-20600,'Estado no permitido');
    end if;
end;
/


