$(function (){
 
    $("form").submit(function(e){
        
        var mensaje = ""
        if($("#rectificacion_desglose_manifiesto_numeroMBL").val() == "")
        {
            mensaje = "<div>- Indique el Número de MBL</div>";
        } 
          if($("#rectificacion_desglose_manifiesto_numeroManifiesto").val() == "")
        {
            mensaje = mensaje + "<div>- Indique el Número de Manifiesto</div>";
        }
             if($("#rectificacion_desglose_manifiesto_contenedor").val() == "")
        {
            mensaje = mensaje + "<div>- Indique el Contenedor</div>";
        }
             if($("#rectificacion_desglose_manifiesto_naviera").val() == "")
        {
            mensaje = mensaje + "<div>- Indique la Naviera</div>";
        }
        if($("#rectificacion_desglose_manifiesto_aduaman").val() == "")
        {
            mensaje = mensaje + "<div>- Indique el Aduaman</div>";
        }
         if($("#rectificacion_desglose_manifiesto_tipo").val() == "")
        {
            mensaje = mensaje + "<div>- Indique el Tipo</div>";
        }
          if($("#rectificacion_desglose_manifiesto_desagrupe").val() == "")
        {
            mensaje = mensaje + "<div>- Indique el Desagrupe</div>";
        }
           if($("#rectificacion_desglose_manifiesto_fechaNotificacionMulta").val() == "")
        {
            mensaje = mensaje + "<div>- Indique la Fecha de notificación de multa</div>";
        }
           if($("#rectificacion_desglose_manifiesto_fechaReciboManifiesto").val() == "")
        {
            mensaje = mensaje + "<div>- Indique la Fecha de recibo de manifiesto</div>";
        }
        
            if($("#rectificacion_desglose_manifiesto_fechaReciboManifiesto").val() == "")
        {
            mensaje = mensaje + "<div>- Indique la Fecha de recibo de manifiesto</div>";
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