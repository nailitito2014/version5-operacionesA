$(function (){
 
    $("form").submit(function(e){
        
        var mensaje = ""
        if($("#puerto_nombre").val() == "")
        {
            mensaje = "<div>- Indique el Nombre</div>";
        } 
           var regex = /^[a-zA-ZñÁÉÍĺ .ÓÚáéíóú ]+$/;
 
        if ($("#puerto_nombre").val() != "" && regex.test($("#puerto_nombre").val()) == false)
        {
            mensaje = mensaje + " <div>- Inserte solo letras en el campo Nombre </div>"
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