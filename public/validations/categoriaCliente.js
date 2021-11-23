$(function (){
 
    $("form").submit(function(e){
        
        var mensaje = ""
        if($("#categoria_cliente_nombre").val() == "")
        {
            mensaje = "<div>- Indique el Nombre</div>";
        } 
          var regex = /^[a-zA-ZñÁÉÍĺ .ÓÚáéíóú ]+$/;
 
        if ($("#categoria_cliente_nombre").val() != "" && regex.test($("#categoria_cliente_nombre").val()) == false)
        {
            mensaje = mensaje + " <div>- Inserte solo letras en el campo Categoría de cliente </div>"
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