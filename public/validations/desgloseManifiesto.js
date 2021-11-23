$(function (){
 
    $("form").submit(function(e){
        
        var mensaje = ""
        if($("#desglose_manifiesto_numeroDesgloseManifiesto").val() == "")
        {
            mensaje = "<div>- Indique el Número de desglose de manifiesto</div>";
        } 
        
           if($("#desglose_manifiesto_numeroMBL").val() == "")
        {
            mensaje = mensaje + "<div>- Indique el Número de MBL</div>";
        }
          if($("#desglose_manifiesto_numeroViaje").val() == "")
        {
            mensaje = mensaje + "<div>- Indique el Número de viaje</div>";
        } 
           if($("#desglose_manifiesto_contenedor").val() == "")
        {
            mensaje = mensaje + "<div>- Indique el Contenedor</div>";
        } 
           if($("#desglose_manifiesto_aduaman").val() == "")
        {
            mensaje = mensaje + "<div>- Indique el Aduaman</div>";
        } 
           if($("#desglose_manifiesto_coment").val() == "")
        {
            mensaje = mensaje + "<div>- Indique el Coment</div>";
        } 
            if($("#desglose_manifiesto_fechaArriboBuque").val() == "")
        {
            mensaje = mensaje + "<div>- Indique la Fecha de arribo de buque</div>";
        } 
            if($("#desglose_manifiesto_fechaReciboManifiesto").val() == "")
        {
            mensaje = mensaje + "<div>- Indique la Fecha de recibo de manifiesto</div>";
        } 
             if($("#desglose_manifiesto_fechaDesgloseManifiesto").val() == "")
        {
            mensaje = mensaje + "<div>- Indique la Fecha de desglose de manifiesto</div>";
        } 
             if($("#desglose_manifiesto_fechaNotificacionMulta").val() == "")
        {
            mensaje = mensaje + "<div>- Indique la Fecha de notificación de multa</div>";
        }
             if($("#desglose_manifiesto_fechaRecibidaMulta").val() == "")
        {
            mensaje = mensaje + "<div>- Indique la Fecha de recibida la multa</div>";
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