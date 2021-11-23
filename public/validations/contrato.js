$(function (){
 
    $("form").submit(function(e){
        
        var mensaje = ""
        if($("#contrato_numeroContrato").val() == "")
        {
            mensaje = "<div>- Indique el Número de contrato</div>";
        } 
           if($("#contrato_titular").val() == "")
        {
            mensaje = mensaje + "<div>- Indique el Titular</div>";
        } 
            if($("#contrato_titular").val() == "")
        {
            mensaje = mensaje + "<div>- Indique el Titular</div>";
        } 
         if($("#contrato_tipoContrato").val() == "")
        {
            mensaje = mensaje + "<div>- Indique el Tipo de contrato</div>";
        } 
       if($("#contrato_fechaVencimiento").val() == "")
        {
            mensaje = mensaje + "<div>- Indique la Fecha de vencimiento</div>";
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