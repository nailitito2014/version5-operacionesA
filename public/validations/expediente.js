$(function (){
 
    $("form").submit(function(e){
        
        var mensaje = ""
        if($("#expediente_numeroExpediente").val() == "")
        {
            mensaje = "<div>- Indique el Número de expediente</div>";
        } 
           if($("#expediente_naviera").val() == "")
        {
            mensaje = mensaje + "<div>- Indique la Naviera</div>";
        } 
            if($("#expediente_contenedor").val() == "")
        {
            mensaje = mensaje + "<div>- Indique el Contenedor</div>";
        } 
         if($("#expediente_desgloseManifiesto").val() == "")
        {
            mensaje = mensaje + "<div>- Indique el Desglose de manifiesto</div>";
        } 
       if($("#expediente_pais").val() == "")
        {
            mensaje = mensaje + "<div>- Indique el País</div>";
        } 
         if($("#expediente_provincia").val() == "")
        {
            mensaje = mensaje + "<div>- Indique la Provincia</div>";
        } 
        if($("#expediente_pais").val() == "")
        {
            mensaje = mensaje + "<div>- Indique el País</div>";
        }
        if($("#expediente_bultos").val() == "")
        {
            mensaje = mensaje + "<div>- Indique los Bultos</div>";
        }  
       
           if($("#expediente_pies").val() == "")
        {
            mensaje = mensaje + "<div>- Indique los Pies</div>";
        }
         if($("#expediente_pesoKg").val() == "")
        {
            mensaje = mensaje + "<div>- Indique el Peso en KG</div>";
        } 
        if($("#expediente_numeroMBL").val() == "")
        {
            mensaje = mensaje + "<div>- Indique el Número de MBL</div>";
        }  
          if($("#expediente_notas").val() == "")
        {
            mensaje = mensaje + "<div>- Indique las Notas</div>";
        }  
         if($("#expediente_nombre").val() == "")
        {
            mensaje = mensaje + "<div>- Indique el Nombre</div>";
        }  
         if($("#expediente_primerApellido").val() == "")
        {
            mensaje = mensaje + "<div>- Indique el Primer apellido</div>";
        } 
        if($("#expediente_segundoApellido").val() == "")
        {
            mensaje = mensaje + "<div>- Indique el Segundo apellido</div>";
        }  
      if($("#expediente_numeroManifiesto").val() == "")
        {
            mensaje = mensaje + "<div>- Indique el Número de manifiesto</div>";
        }
        if($("#expediente_recibidoAduana").val() == "")
        {
            mensaje = mensaje + "<div>- Indique Recibido en aduana</div>";
        }
            if($("#expediente_entregadoAgencia").val() == "")
        {
            mensaje = mensaje + "<div>- Indique Entregado en agencia</div>";
        }
        
        
        
        
        
         if($("#expediente_fechaDespacho").val() == "")
        {
            mensaje = mensaje + "<div>- Indique la Fecha de despacho</div>";
        }
          if($("#expediente_fechaEntrega").val() == "")
        {
            mensaje = mensaje + "<div>- Indique la Fecha de entrega</div>";
        } 
          if($("#expediente_fechaArribo").val() == "")
        {
            mensaje = mensaje + "<div>- Indique la Fecha de arribo</div>";
        } 
      
        if($("#expediente_certificoInmigracionFile").val() == "")
        {
            mensaje = mensaje + "<div>- Indique el Certifico de inmigración</div>";
        } 
        if($("#expediente_cartaOriginalFile").val() == "")
        {
            mensaje = mensaje + "<div>- Indique la Carta original</div>";
        } 
          if($("#expediente_franquiciaDiplomaticaFile").val() == "")
        {
            mensaje = mensaje + "<div>- Indique la Franquicia  diplomática</div>";
        } 
          if($("#expediente_desgloseFile").val() == "")
        {
            mensaje = mensaje + "<div>- Indique el Desglose</div>";
        } 
      
       if($("#expediente_manifiestoFile").val() == "")
        {
            mensaje = mensaje + "<div>- Indique el Manifiesto</div>";
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