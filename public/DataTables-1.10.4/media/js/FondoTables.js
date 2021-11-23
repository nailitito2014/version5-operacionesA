// Script to use datatables with the id specified
$(function() {
    $('#example').dataTable({
        "aLengthMenu": [5, 10, 25, 50, 100],
        "iDisplayLength": 10,
        "bPaginate": true,
        "sPaginationType": "full_numbers",
        "language": {
            "processing": "Por favor espere...",
            "lengthMenu": "Mostrar: _MENU_",
            "zeroRecords": "No existen datos para mostrar.",
            "info": "Mostrando _START_ de _END_ en _TOTAL_ entradas",
            "infoEmpty": "Mostrando 0 de 0 entradas",
            "infoFiltered": "(Filtrar de  _MAX_  entradas)",
            "infoPostFix": "",
            "search": "Buscar:",
            "url": "",
            "paginate": {
                "first": "Primero",
                "previous": "Anterior",
                "next": "Pr&oacute;ximo",
                "last": "&Uacute;ltimo"
            }
        }
    });
}
);
//para dar scroll a las tablas
$(function() {
    $('#datas').dataTable({
        "scrollY": "300px",
        "scrollCollapse": true,
        "searching": false,
        "paging": false,
        "bPaginate": true,
        "sPaginationType": "full_numbers",
        "language": {
            "processing": "Por favor espere...",
            "lengthMenu": "Mostrar: _MENU_",
            "zeroRecords": "No existen datos para mostrar.",
            "info": "Mostrando _START_ de _END_ en _TOTAL_ entradas",
            "infoEmpty": "Mostrando 0 de 0 entradas",
            "infoFiltered": "(Filtrar de  _MAX_  entradas)",
            "infoPostFix": "",
            "search": "Buscar:",
            "url": "",
            "paginate": {
                "first": "Primero",
                "previous": "Anterior",
                "next": "Pr&oacute;ximo",
                "last": "&Uacute;ltimo"
            }
        }
    });
});
//notificaciones
$(function() {
    $('#notify_btn_1').on('click', function() {
        $.Notify({
            style: {background: 'red', color: 'white'},
            shadow: true,
            position: 'bottom-right',
            content: "Se ha borrado correctamente"
        });
    });
    $('#notify_btn_2').on('click', function() {
        $.Notify({
            style: {background: 'red', color: 'white'},
            shadow: true,
            position: 'bottom-right',
            content: "{{error1}}"
        });
    });
    $('#notify_btn_3').setTimeout(function() {
    }, 2000);
});


//para crear un dialog y poder confirmar antes de borrar algo        

$(document).ready(function(){
    $("#createFlatWindow").on('click', function() {
        $.Dialog({
            overlay: true,
            shadow: true,
            title: 'Eliminar Cliente',
            icon: '<span class="icon-warning"></span>',
            flat: true,
            height: '20px',
            width: '50px',
            background: '#efeae3',
            content: '',
            onShow: function(_dialog) {
                var content =
                        '<br/>' +
                        '<p class="text-bold">' +
                        '&nbsp;' + '&nbsp;' + '¿Está seguro que desea eliminar el cliente?' +
                        '</p>' +
                        '<p class="text-italic">' +
                        '&nbsp;' + '&nbsp;' + ' - ' + '' +
                        '</p>' +
                        '<br/>' +
                        '&nbsp;' + '&nbsp;' + '&nbsp;' + '&nbsp;' + '&nbsp;' + '&nbsp;' + '&nbsp;' + '&nbsp; ' + ' &nbsp; ' + ' &nbsp; ' + ' &nbsp; ' + ' &nbsp; ' + '<button class="button danger fg-white" type="submit"><i class="icon-remove on-left"></i> Eliminar</button> ' +
                        '&nbsp;' + '&nbsp;' + '&nbsp;' +
                        '<a class="button inverse fg-white" id="notify_btn_1" onclick="$.Dialog.close()">' +
                        '<i class="icon-cancel-2 on-left"></i>Cancelar' +
                        '</a>';
                $.Dialog.content(content);
                $.Metro.initInputs();
            }
        });
    });
    });


// fechas
$(function() {
    $("#datepicker").datepicker({
        date: "2015-01-01", // set init date
        format: "d/m/y", // set output format
        effect: "none", // none, slide, fade
        position: "bottom", // top or bottom,
        locale: 'en', // 'ru' or 'en', default is $.Metro.currentLocale
    });
});