$(function (){
 
    $("form").submit(function(e){
        
        var mensaje = ""
        if($("#municipio_nombre").val() == "")
        {
            mensaje = "<div>- Indique el Nombre</div>";
        }
        if($("#municipio_provincia").val() == "")
        {
            mensaje =  mensaje + "<div>- Indique la Provincia</div>";
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