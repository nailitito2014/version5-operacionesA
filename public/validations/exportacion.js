$(function (){
 
    $("form").submit(function(e){
        
        var mensaje = ""
        if($("#exportacion_solicitudServicio").val() == "")
        {
            mensaje = "<div>- Indique la Solicitud de servicio</div>";
        } 
          if($("#exportacion_numeroExportacion").val() == "")
        {
            mensaje = mensaje + "<div>- Indique el Número de exportación</div>";
        } 
          if($("#exportacion_viaTransportacion").val() == "")
        {
            mensaje = mensaje + "<div>- Indique la Vía de transportación</div>";
        } 
          if($("#exportacion_condicionCompra").val() == "")
        {
            mensaje = mensaje + "<div>- Indique la Condición de compra</div>";
        } 
         if($("#exportacion_puertoDestino").val() == "")
        {
            mensaje = mensaje + "<div>- Indique el Puerto destino</div>";
        } 
         if($("#exportacion_puertoOrigen").val() == "")
        {
            mensaje = mensaje + "<div>- Indique el Puerto origen</div>";
        } 
          if($("#exportacion_direccionOrigen").val() == "")
        {
            mensaje = mensaje + "<div>- Indique la Dirección origen</div>";
        } 
           if($("#exportacion_fechaEstimadoServicio").val() == "")
        {
            mensaje = mensaje + "<div>- Indique la Fecha estimada de servicio</div>";
        } 
           if($("#exportacion_fechaSalidaEmbarque").val() == "")
        {
            mensaje = mensaje + "<div>- Indique la Fecha de salida de embarque</div>";
        } 
            if($("#exportacion_fechaArribo").val() == "")
        {
            mensaje = mensaje + "<div>- Indique la Fecha de arribo</div>";
        } 
             if($("#exportacion_fechaEstimadaSalida").val() == "")
        {
            mensaje = mensaje + "<div>- Indique la Fecha estimada de salida</div>";
        } 
         if($("#exportacion_contenedor").val() == "")
        {
            mensaje = mensaje + "<div>- Indique el Contenedor</div>";
        }  
         if($("#exportacion_buque").val() == "")
        {
            mensaje = mensaje + "<div>- Indique el Buque</div>";
        }  
         if($("#exportacion_contrato").val() == "")
        {
            mensaje = mensaje + "<div>- Indique el Contrato</div>";
        } 
         if($("#exportacion_costoOrigen").val() == "")
        {
            mensaje = mensaje + "<div>- Indique el Costo de origen</div>";
        } 
           if($("#exportacion_flete").val() == "")
        {
            mensaje = mensaje + "<div>- Indique el Flete</div>";
        } 
         if($("#exportacion_destino").val() == "")
        {
            mensaje = mensaje + "<div>- Indique el Destino</div>";
        } 
        if($("#exportacion_recargo").val() == "")
        {
            mensaje = mensaje + "<div>- Indique el Recargo</div>";
        } 
        if($("#exportacion_rx").val() == "")
        {
            mensaje = mensaje + "<div>- Indique el Rx manipulación</div>";
        } 
         if($("#exportacion_descripcionCarga").val() == "")
        {
            mensaje = mensaje + "<div>- Indique la Rx Descripción de carga</div>";
        } 
        if($("#exportacion_direccionDestino").val() == "")
        {
            mensaje = mensaje + "<div>- Indique la Dirección de destino</div>";
        } 
          if($("#exportacion_documentosRecibidos").val() == "")
        {
            mensaje = mensaje + "<div>- Indique los Documentos recibidos</div>";
        } 
      if($("#exportacion_detalleServicios").val() == "")
        {
            mensaje = mensaje + "<div>- Indique los Detalles de servicios</div>";
        }  
         if($("#exportacion_observaciones").val() == "")
        {
            mensaje = mensaje + "<div>- Indique las Observaciones</div>";
        }  
         if($("#exportacion_fechaVisita").val() == "")
        {
            mensaje = mensaje + "<div>- Indique la Fecha de visita</div>";
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