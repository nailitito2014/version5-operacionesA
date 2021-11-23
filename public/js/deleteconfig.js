$(function () {
    /*
   $(".link-eliminar").click( function( event ) {
       $("#link-popup-eliminar").attr("href", $(this).attr("data-url"));
       $("#text-descripcion-popup-eliminar").html($(this).attr("data-descripcion"));
   });
   */
   
   
   $('body').on('click', '.link-eliminar', function () {
            $(".btn-eliminar").attr("href", $(this).attr("data-url"));
            $(".text-descripcion-popup-eliminar").html($(this).attr("data-descripcion"));
        });   
        
   $(".btn-eliminar").click(function ()
   {
      //$("#link-popup-eliminar").attr("data-dismiss", "modal")
	  $("#modal-delete").css("display", "none")
	  $(".modal-backdrop").css("opacity", 0)
   })
   
})
