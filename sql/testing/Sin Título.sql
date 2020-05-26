/*
create or replace trigger dniCorrecto
before insert or update on usuarios for each row
begin
    if not(:new.dni like '[1234567890][1234567890][1234567890][1234567890][1234567890][1234567890][1234567890][1234567890][A-Z]')
    then raise_application_error
            (-20600,'DNI del usuario incorrecto');
    end if;
end;
/
create or replace trigger dniCorrectoEmpleados
before insert or update on empleados for each row
begin
    if not(:new.dni like '[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][A-Za-z]')
    then raise_application_error
            (-20600,'DNI del empleado incorrecto');
    end if;
end;
/
create or replace trigger telefonoCorrecto
before insert or update on usuarios for each row
begin
    if not(:new.telefono like '[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]')
    then raise_application_error
            (-20600,'Número de teléfono del usuario incorrecto');
    end if;
end;
/
insert into usuarios(dni,nombre,direccion) values ('26839538x','PACO','CAlle pepe');
select * from usuarios;*/
