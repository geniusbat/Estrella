function validateFormLogin() {
    var username = document.getElementById("usuario").value;
    var pass = document.getElementById("pass").value;
    console.log(username.length>10);
    //Check if inputs are empty
    if ((username.length>10)&&(pass.length>10)) {
        console.log("dentro");
        //Check if name is correct
        if (username.match(/[A-ZÑa-zñ\_\-0-9]*/)) {
            //Check if password correct
            if (pass.match(/[A-ZÑa-zñ\_\-0-9]*/)) {
                return true;
            }
            else {
                alert("Escriba la contraseña de forma correcta");
                return false; 
            }
        }
        else {
            alert("Escriba el usuario de forma correcta");
            return false;
        }
    }
}