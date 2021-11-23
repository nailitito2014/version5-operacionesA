$(function (){
 
    $("form").submit(function(e){
        
        var mensaje = ""
        if($("#buque_nombre").val() == "")
        {
            mensaje = "<div>- Indique el Nombre</div>";
        } 
        
           if($("#buque_numeroViaje").val() == "")
        {
            mensaje = mensaje + "<div>- Indique el Número de viaje</div>";
        }
          if($("#buque_puertoSalida").val() == "")
        {
            mensaje = mensaje + "<div>- Indique el Puerto de salida</div>";
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