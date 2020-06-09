function checkea() {
    var dni = document.getElementById('dni').value;
    var nombre = document.getElementById('nombre').value;
    var telefono = document.getElementById('telefono').value;
    var direccion = document.getElementById('direccion').value;
    var a1 = ((dni.length<10)&&(dni.match(/^([0-9]{8}[A-ZÑa-zñ])/)[0].length>0));
    var a2 = ((nombre.length<26)&&(nombre.match(/[A-ZÑa-zñ\, \-áéíóúÁÉÍÚÓ])/)[0].length>0));
    var a3 = ((telefono.length<13)&&(telefono.match(/^([+]{0,1}[0-9]{0,3}[0-9]{9})/)[0].length>0));
    var a4 = ((direccion.length<26)&&(direccion.match(/[A-ZÑa-zñ\,\. \-áéíóúÁÉÍÚÓ0-9])/)[0].length>0));
    if (a1&&a2&&a3&&a4) {
        return true;
    }
    else {
        document.getElementById("notif").innerHTML="<p>Por favor rellene correctamente el formulario</p>";
        return false;
    }
}