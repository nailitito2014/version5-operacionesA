$(function (){
 
    $("form").submit(function(e){
        
        var mensaje = ""
        if($("#cliente_nombre").val() == "")
        {
            mensaje = "<div>- Indique el Nombre</div>";
        } 
           if($("#cliente_primerApellido").val() == "")
        {
            mensaje = mensaje + "<div>- Indique el Primer apellido</div>";
        } 
           if($("#cliente_segundoApellido").val() == "")
        {
            mensaje = mensaje + "<div>- Indique el Segundo apellido</div>";
        } 
           if($("#cliente_pasaporte").val() == "")
        {
            mensaje = mensaje + "<div>- Indique el Pasaporte</div>";
        } 
           if($("#cliente_carnetIdentidad").val() == "")
        {
            mensaje = mensaje + "<div>- Indique el  Carnét de identidad</div>";
        } 
            if($("#cliente_pais").val() == "")
        {
            mensaje = mensaje + "<div>- Indique el País</div>";
        } 
           if($("#cliente_categoriaCliente").val() == "")
        {
            mensaje = mensaje + "<div>- Indique la Categoría del cliente</div>";
        } 
         if($("#cliente_fechaCertificoInmigracion").val() == "")
        {
            mensaje = mensaje + "<div>- Indique la Fecha de certifico de inmigración</div>";
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