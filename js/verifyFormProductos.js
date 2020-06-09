function checkea() {
    var nombre = document.getElementById('nombre').value;
    var descripcion = document.getElementById('descripcion').value;
    var personalizable = document.getElementById('personalizable').value;
    var preciobase = document.getElementById('preciobase').value;
    var a1 = ((nombre.length<25)&&((nombre.match(/^[A-ZÁÉÍÓÚÑ]*(\s|[a-zñ]+|[áéíóúÁÉÍÚÓ ]*|[A-ZÑ])+/))[0].length>0));
    var a2 = ((personalizable==0)||(personalizable==1));
    var a3 = (preciobase)<999999;
    var a4 = ((descripcion.length<70)&&((descripcion.match(/^[A-ZÁÉÍÓÚÑ]*(\s|[a-zñ ]+|[áéíóúÁÉÍÚÓ]*|[A-ZÑ])+/))[0].length>0));
    var a5 = document.getElementById('direccion').value != null;
    if (a1&&a2&&a3&&a4&&a5) {
        return true;
    }
    else {
        document.getElementById("notif").innerHTML="<p>Por favor rellene correctamente el formulario</p>";
        return false;
    }
}