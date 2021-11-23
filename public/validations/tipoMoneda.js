$(function (){
 
    $("form").submit(function(e){
        
        var mensaje = ""
        if($("#tipo_moneda_nombre").val() == "")
        {
            mensaje = "<div>- Indique el Tipo de moneda</div>";
        } 
           var regex = /^[a-zA-ZñÁÉÍĺ .ÓÚáéíóú ]+$/;
 
        if ($("#tipo_moneda_nombre").val() != "" && regex.test($("#tipo_moneda_nombre").val()) == false)
        {
            mensaje = mensaje + " <div>- Inserte solo letras en el campo Tipo de moneda </div>"
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