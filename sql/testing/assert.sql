create or replace function assert_equals(
    salida boolean,
    salida_esperada boolean
) return varchar2 as 
begin
    if (salida=salida_esperada) 
    then return 'EXITO';
    else return 'FALLO';
    end if;
end assert_equals;
/
