$(function (){
 
    $("form").submit(function(e){
        
        var mensaje = ""
        if($("#provincia_nombre").val() == "")
        {
            mensaje = "<div>- Indique el Nombre</div>";
        } 
             if($("#provincia_municipio").val() == "")
        {
            mensaje = mensaje + "<div>- Indique el Municipio</div>";
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