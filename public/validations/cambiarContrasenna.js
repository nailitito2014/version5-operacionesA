$(function (){
 
    $("form").submit(function(e){
        
        var mensaje = ""
        if($("#usuario_cambiar_password_contrasenna_first").val() == "")
        {
            mensaje = "<div>- Indique la Nueva contraseña</div>";
        } 
          if($("#usuario_cambiar_password_contrasenna_second").val() == "")
        {
            mensaje = mensaje + "<div>- Indique Repetir contraseña</div>";
        }
        if(mensaje == "")
            return true
        
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "showDuration": "20000",
        }
        
        toastr.error(mensaje)
        return false
        
    })
    
    
})