/*$(document).ready(function(){
    
    var emailReg = new RegExp(/^([A-Z0-9.%+-]+@@[A-Z0-9.-]+.[A-Z]{2,6})([,;][\s]([A-Z0-9.%+-]+@@[A-Z0-9.-]+.[A-Z]{2,6}))*$/i);
      var emailText = $('#user').val();

      if (!emailReg.test(emailText)) {
        $('#user').setCustomValidity(error1);
        return (error1.length==0);
        }

        var passReg = new RegExp(/^([A-ZÑa-zñ\_\-0-9]))*$/i);
        var password = $('#pass').val();
  
        if (!passReg.test(password)) {
            $('#pass').setCustomValidity(error2);
            return (error2.length==0);
              ;
          }
      
});
*/
$(document).ready(function() {
    $("#altaUsuario").on("submit",function(){
    return validateForm();
    });
    });

    var emailReg = new RegExp(/^([A-Z0-9.%+-]+@@[A-Z0-9.-]+.[A-Z]{2,6})([,;][\s]([A-Z0-9.%+-]+@@[A-Z0-9.-]+.[A-Z]{2,6}))*$/i);
      var emailText = $('#user').val();

      if (!emailReg.test(emailText)) {
        $('#user').setCustomValidity(error1);
        return (error1.length==0);
        }

        var passReg = new RegExp(/^([A-ZÑa-zñ\_\-0-9]))*$/i);
        var password = $('#pass').val();
  
        if (!passReg.test(password)) {
            $('#pass').setCustomValidity(error2);
            return (error2.length==0);
              ;
          }