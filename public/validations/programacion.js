$(function (){
 
    $("form").submit(function(e){
        
        var mensaje = ""
        if($("#programacion_numeroDesglose").val() == "")
        {
            mensaje = "<div>- Indique el Número de desglose</div>";
        } 
           if($("#programacion_numeroManifiesto").val() == "")
        {
            mensaje = mensaje + "<div>- Indique el Número de manifiesto</div>";
        } 
           if($("#programacion_contenedor").val() == "")
        {
            mensaje = mensaje + "<div>- Indique el Contenedor</div>";
        } 
           if($("#programacion_transitario").val() == "")
        {
            mensaje = mensaje + "<div>- Indique el Transitario</div>";
        } 
           if($("#programacion_naviera").val() == "")
        {
            mensaje = mensaje + "<div>- Indique la Naviera</div>";
        } 
           if($("#programacion_tipoContenedor").val() == "")
        {
            mensaje = mensaje + "<div>- Indique el Tipo de contenedor</div>";
        } 
            if($("#programacion_observaciones").val() == "")
        {
            mensaje = mensaje + "<div>- Indique las Observaciones</div>";
        } 
            if($("#programacion_cliente").val() == "")
        {
            mensaje = mensaje + "<div>- Indique el Cliente</div>";
        } 
            if($("#programacion_deposito").val() == "")
        {
            mensaje = mensaje + "<div>- Indique el Depósito</div>";
        } 
             if($("#programacion_bultos").val() == "")
        {
            mensaje = mensaje + "<div>- Indique los Bultos</div>";
        } 
             if($("#programacion_fechaArriboMariel").val() == "")
        {
            mensaje = mensaje + "<div>- Indique la Fecha de arribo de mariel</div>";
        } 
              if($("#programacion_fechaEntregadoAduana").val() == "")
        {
            mensaje = mensaje + "<div>- Indique la Fecha de entregado aduana</div>";
        } 
               if($("#programacion_fechaDespachar").val() == "")
        {
            mensaje = mensaje + "<div>- Indique la Fecha a despachar</div>";
        }
               if($("#programacion_detalleCarga").val() == "")
        {
            mensaje = mensaje + "<div>- Indique el Detalle de carga</div>";
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