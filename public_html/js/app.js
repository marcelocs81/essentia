$(document).ready(function() {

    var table = $('.data-table');

    var ordenado = 0,
        direcao = 'desc';

    var configPadrao = {
        initComplete: function (settings, json) {
            $('.loading-page').hide();
            $(this).closest('.wrapper-data-table').show();
        },
        columnDefs: [
            {visible: false, targets: "ocultar"},
            {orderable: false, targets: 'no-sort'},
            {"sType": "order-by-date", targets: 'date-column'}
        ],
        stateSave: false,
        autoWidth: false,
        bProcessing: true,
        "language": {
            "emptyTable": "Nenhum dado disponível na tabela",
            "info": "Exibindo de _START_ até _END_ de _TOTAL_ Registros",
            "infoEmpty": "Exibindo de 0 até 0 de 0 Registro(s)",
            "infoFiltered": "(filtrado do total de _MAX_ Registros)",
            "lengthMenu": "Exibir _MENU_ registros",
            "zeroRecords": 'Nenhum registro encontrado',
            "search": 'Filtrar',
            "paginate": {
                "previous": "Anterior",
                "next": "Próximo",
            }
        },
        displayLength: 10,
        "order": [[ordenado, direcao]]
    };

    var dataTable = table.DataTable(configPadrao);

});