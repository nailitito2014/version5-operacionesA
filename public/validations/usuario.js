$(function (){
 
    $("form").submit(function(e){
        
        var mensaje = ""
        if($("#usuario_nombre").val() == "")
        {
            mensaje = "<div>- Indique el Nombre</div>";
        }
        if($("#usuario_primerApellido").val() == "")
        {
            mensaje = mensaje + "<div>- Indique el Primer apellido</div>";
        }
          if($("#usuario_segundoApellido").val() == "")
        {
            mensaje = mensaje + "<div>- Indique el Segundo apellido</div>";
        }
            
      if($("#usuario_rol").val() == "")
        {
            mensaje = mensaje + "<div>- Indique el Rol</div>";
        }
         if($("#usuario_entidad").val() == "")
        {
            mensaje = mensaje + "<div>- Indique la Entidad</div>";
        }
         if($("#usuario_nombreUsuario").val() == "")
        {
            mensaje = mensaje + "<div>- Indique el Nombre de usuario</div>";
        }
      
         if($("#usuario_contrasenna_first").val() == "")
        {
            mensaje = mensaje + "<div>- Indique la Contraseña</div>";
        }
          if($("#usuario_contrasenna_second").val() == "")
        {
            mensaje = mensaje + "<div>- Indique Repetir Contraseña</div>";
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