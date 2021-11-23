$(function (){
 
    $("form").submit(function(e){
        
        var mensaje = ""
        if($("#importacion_solicitudServicio").val() == "")
        {
            mensaje = "<div>- Indique la Solicitud de servicio</div>";
        } 
           if($("#importacion_condicionCompra").val() == "")
        {
            mensaje = mensaje + "<div>- Indique la Condición de compra</div>";
        }
          if($("#importacion_estadoServicio").val() == "")
        {
            mensaje = mensaje + "<div>- Indique el Estado de servicio</div>";
        } 
          if($("#importacion_puertoDestino").val() == "")
        {
            mensaje = mensaje + "<div>- Indique el Puerto destino</div>";
        } 
           if($("#importacion_puertoOrigen").val() == "")
        {
            mensaje = mensaje + "<div>- Indique el Puerto origen</div>";
        } 
           if($("#importacion_contenedor").val() == "")
        {
            mensaje = mensaje + "<div>- Indique el Contenedor</div>";
        } 
             if($("#importacion_contrato").val() == "")
        {
            mensaje = mensaje + "<div>- Indique el Contrato</div>";
        } 
            if($("#importacion_viaTransportacion").val() == "")
        {
            mensaje = mensaje + "<div>- Indique la Vía de transportación</div>";
        } 
             if($("#importacion_tipoMoneda").val() == "")
        {
            mensaje = mensaje + "<div>- Indique el Tipo de moneda</div>";
        } 
            if($("#importacion_buque").val() == "")
        {
            mensaje = mensaje + "<div>- Indique el Buque</div>";
        } 
           if($("#importacion_desglose").val() == "")
        {
            mensaje = mensaje + "<div>- Indique el Desglose</div>";
        } 
          if($("#importacion_fechaEstimadoServicio").val() == "")
        {
            mensaje = mensaje + "<div>- Indique la Fecha estimada de servicio</div>";
        } 
        if($("#importacion_fechaSalidaEmbarque").val() == "")
        {
            mensaje = mensaje + "<div>- Indique la Fecha de salida de embarque</div>";
        } 
        if($("#importacion_fechaArribo").val() == "")
        {
            mensaje = mensaje + "<div>- Indique la Fecha de arribo</div>";
        } 
          if($("#importacion_fechaEstimadaSalida").val() == "")
        {
            mensaje = mensaje + "<div>- Indique la Fecha estimada de salida</div>";
        }  
        
       if($("#importacion_descripcionCarga").val() == "")
        {
            mensaje = mensaje + "<div>- Indique la Descripción de carga</div>";
        } 
        if($("#importacion_direccionDestino").val() == "")
        {
            mensaje = mensaje + "<div>- Indique la Dirección destino</div>";
        } 
         if($("#importacion_documentosRecibidos").val() == "")
        {
            mensaje = mensaje + "<div>- Indique los Documentos recibidos</div>";
        } 
         if($("#importacion_detalleServicios").val() == "")
        {
            mensaje = mensaje + "<div>- Indique los Detalles de servicios</div>";
        }   
        if($("#importacion_observaciones").val() == "")
        {
            mensaje = mensaje + "<div>- Indique las Observaciones</div>";
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