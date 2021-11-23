$(function (){
 
    $("form").submit(function(e){
        
        var mensaje = ""
        if($("#estado_servicio_nombre").val() == "")
        {
            mensaje = "<div>- Indique el Nombre</div>";
        }
         var regex = /^[a-zA-ZñÁÉÍĺ .ÓÚáéíóú ]+$/;
 
        if ($("#estado_servicio_nombre").val() != "" && regex.test($("#estado_servicio_nombre").val()) == false)
        {
            mensaje = mensaje + " <div>- Inserte solo letras en el campo Estado de servicio </div>"
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