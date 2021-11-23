$(function (){
 
    $("form").submit(function(e){
        
        var mensaje = ""
        if($("#tipo_contenedor_nombre").val() == "")
        {
            mensaje = "<div>- Indique el Tipo de contenedor</div>";
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