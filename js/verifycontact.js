function validateFormContact() {
    var name = document.getElementById("nombre");
    var email = document.getElementById("email");
    alert("estamos");
    //Check if inputs are empty
    if ((name.length>0)&&(email.length>0)) {
        //Check if name is correct
        if (name.match("^[A-ZÁÉÍÓÚÑ]*(\s|[a-zñ]+|[áéíóúÁÉÍÚÓ]*|[A-ZÑ])+")) {
            return true;
        }
        else {
            alert("Escriba el usuario de forma correcta");
            return false;
        }
    }
}