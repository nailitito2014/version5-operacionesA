$(function (){
 
    $("form").submit(function(e){
        
        var mensaje = ""
        if($("#condicion_compra_nombre").val() == "")
        {
            mensaje = "<div>- Indique la Condición de compra</div>";
        } 
         var regex = /^[a-zA-ZñÁÉÍĺ .ÓÚáéíóú ]+$/;
 
        if ($("#condicion_compra_nombre").val() != "" && regex.test($("#condicion_compra_nombre").val()) == false)
        {
            mensaje = mensaje + " <div>- Inserte solo letras en el campo Condición de compra </div>"
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