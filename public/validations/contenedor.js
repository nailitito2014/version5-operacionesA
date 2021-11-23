$(function (){
 
    $("form").submit(function(e){
        
        var mensaje = ""
        if($("#contenedor_numeroContenedor").val() == "")
        {
            mensaje = "<div>- Indique el Número de contenedor</div>";
        } 
           if($("#contenedor_mbl").val() == "")
        {
            mensaje = mensaje + "<div>- Indique el Número de MBL</div>";
        } 
             if($("#contenedor_kgCarga").val() == "")
        {
            mensaje = mensaje + "<div>- Indique los Kgs de carga</div>";
        } 
           if($("#contenedor_cantBultos").val() == "")
        {
            mensaje = mensaje + "<div>- Indique la Cantidad de bultos</div>";
        } 
          if($("#contenedor_buque").val() == "")
        {
            mensaje = mensaje + "<div>- Indique el Buque</div>";
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