$(function (){
 
    $("form").submit(function(e){
        
        var mensaje = ""
        if($("#base_datos_fecha").val() == "")
        {
            mensaje = "<div>- Indique la Fecha</div>";
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