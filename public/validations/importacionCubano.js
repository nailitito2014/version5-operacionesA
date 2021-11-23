$(function (){
 
    $("form").submit(function(e){
        
        var mensaje = ""
        if($("#importa_cubano_solicitudServicio").val() == "")
        {
            mensaje = "<div>- Indique la Solicitud de servicio</div>";
        } 
          if($("#importa_cubano_numeroManifiesto").val() == "")
        {
            mensaje = mensaje + "<div>- Indique el Número de manifiesto</div>";
        } 
         if($("#importa_cubano_transitario").val() == "")
        {
            mensaje = mensaje + "<div>- Indique el Transitario</div>";
        }
           if($("#importa_cubano_naviera").val() == "")
        {
            mensaje = mensaje + "<div>- Indique la Naviera</div>";
        } 
         if($("#importa_cubano_provincia").val() == "")
        {
            mensaje = mensaje + "<div>- Indique la Provincia</div>";
        } 
         if($("#importa_cubano_paisOrigen").val() == "")
        {
            mensaje = mensaje + "<div>- Indique el País de origen</div>";
        } 
           if($("#importa_cubano_paisProcedencia").val() == "")
        {
            mensaje = mensaje + "<div>- Indique el País de procedencia</div>";
        } 
           if($("#importa_cubano_desgloseManifiesto").val() == "")
        {
            mensaje = mensaje + "<div>- Indique el Número de desglose</div>";
        } 
             if($("#importa_cubano_contenedor").val() == "")
        {
            mensaje = mensaje + "<div>- Indique el Contenedor</div>";
        } 
             if($("#importa_cubano_estadoServicio").val() == "")
        {
            mensaje = mensaje + "<div>- Indique el Estado de servicio</div>";
        } 
             if($("#importa_cubano_fechaEntregaAduana").val() == "")
        {
            mensaje = mensaje + "<div>- Indique la Fecha de entrega de aduana</div>";
        } 
             if($("#importa_cubano_fechaEntregaTransito").val() == "")
        {
            mensaje = mensaje + "<div>- Indique la Fecha de entrega de tránsito</div>";
        } 
             if($("#importa_cubano_fechaAutorizoEmbarque").val() == "")
        {
            mensaje = mensaje + "<div>- Indique la Fecha de autorizo de embarque</div>";
        } 
             if($("#importa_cubano_fechaArribo").val() == "")
        {
            mensaje = mensaje + "<div>- Indique la Fecha de arribo</div>";
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