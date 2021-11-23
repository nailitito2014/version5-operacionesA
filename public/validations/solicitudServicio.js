$(function () {

    $("form").submit(function (e) {

        var mensaje = ""
        if ($("#solicitud_servicio_numeroSolicitud").val() == "")
        {
            mensaje = "<div>- Indique el Número de solicitud</div>";
        }
        if ($("#solicitud_servicio_cliente").val() == "")
        {
            mensaje = mensaje + "<div>- Indique el Cliente</div>";
        }
         if ($("#solicitud_servicio_tipoServicio").val() == "")
        {
            mensaje = mensaje + "<div>- Indique el Tipo de servicio</div>";
        }
        if ($("#solicitud_servicio_viaRecepcion").val() == "")
        {
            mensaje = mensaje + "<div>- Indique la Vía de recepción</div>";
        }
         
        if ($("#solicitud_servicio_fechaSolicitud").val() == "")
        {
            mensaje = mensaje + "<div>- Indique la Fecha de solicitud</div>";
        }
       
        if (mensaje == "")
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