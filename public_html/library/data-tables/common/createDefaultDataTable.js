
function createDefaultDataTableClean(newConfig) {

    var table = $('.data-table');

    var ordenado = 0,
        direcao = 'desc';

    var novaOrdem = table.data('ordenado');
    if (novaOrdem != undefined) {
        ordenado = novaOrdem;
    }

    var novaDirecao = table.data('direcao');
    if (novaDirecao != undefined) {
        direcao = novaDirecao;
    }

    var configPadrao = {
        //dom: '<"pull-left "l<"clear">><"pull-right"<"toolbar pull-left"><"clear">>rt<"bottom"pi<"clear">>',
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
            "emptyTable": $.i18n._('Nenhum dado disponível na tabela'),
            "info": $.i18n._("Exibindo de _START_ até _END_ de _TOTAL_ Registros"),
            "infoEmpty": $.i18n._("Exibindo de 0 até 0 de 0 Registro(s)"),
            "infoFiltered": $.i18n._("(filtrado do total de _MAX_ Registros)"),
            "lengthMenu": $.i18n._("Exibir _MENU_ registros"),
            "zeroRecords": $.i18n._('Nenhum registro encontrado'),
            "search": $.i18n._('Filtrar'),
            "paginate": {
                "previous": "Anterior",
                "next": "Próximo",
            }
        },
        displayLength: 10,
        "order": [[ordenado, direcao]]
    };

    if (newConfig != undefined) {
        $.extend(configPadrao, newConfig);
    }

    var dataTable = table.DataTable(configPadrao);

    return dataTable;
}

function createDefaultDataTableCleanNoSearch(newConfig) {

    var table = $('.data-table-nosearch');

    var ordenado = 0,
        direcao = 'desc';

    var novaOrdem = table.data('ordenado');
    if (novaOrdem != undefined) {
        ordenado = novaOrdem;
    }

    var novaDirecao = table.data('direcao');
    if (novaDirecao != undefined) {
        direcao = novaDirecao;
    }

    var configPadrao = {
        dom: '<"pull-left "l<"clear">><"pull-right"<"toolbar pull-left"><"clear">>rt<"bottom"pi<"clear">>',
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
            "emptyTable": $.i18n._('Nenhum dado disponível na tabela'),
            "info": $.i18n._("Exibindo de _START_ até _END_ de _TOTAL_ Registros"),
            "infoEmpty": $.i18n._("Exibindo de 0 até 0 de 0 Registro(s)"),
            "infoFiltered": $.i18n._("(filtrado do total de _MAX_ Registros)"),
            "lengthMenu": $.i18n._("Exibir _MENU_ registros"),
            "zeroRecords": $.i18n._('Nenhum registro encontrado'),
            "paginate": {
                "previous": "Anterior",
                "next": "Próximo",
            }
        },
        displayLength: 10,
        "order": [[ordenado, direcao]]
    };

    if (newConfig != undefined) {
        $.extend(configPadrao, newConfig);
    }

    var dataTable = table.DataTable(configPadrao);

    return dataTable;
}

function createDefaultDataTableTo(table, newConfig) {

    if (table.length <= 0) {
        return;
    }

    var tr = table.find('thead tr').not('.not-dataTable').clone(true);
    tr.prop('class', '');
    tr.addClass('filtros-cabecalho');
    table.find('tfoot tr').not('.not-dataTable').before(tr);

    var expr = new RegExp('>[ \t\r\n\v\f]*<', 'g');
    var tbhtml = table.html();
    table.html(tbhtml.replace(expr, '><'));

    var fileName = table.data('title');

    if (fileName == '' || fileName == undefined) {
        fileName = table.prop('id');
        if (fileName == '' || fileName == undefined) {
            fileName = 'Exportado-Portal-Fonecedores';
        }
    }

    var configPadrao = {
        dom: '<"pull-left tools-data-table"l<"clear">><"pull-right"<"toolbar pull-left"><"toolbar-reset pull-right">TC<"clear">>rt<"bottom"pi<"clear">>',
        tableTools: {
            sSwfPath: "/library/data-tables/media/swf/copy_csv_xls_pdf.swf",
            aButtons: [
                {
                    "sExtends": "xls",
                    "sFileName": fileName + ".xls",
                    "fnComplete": function (nButton, oConfig, oFlash, sFlash) {
                        alert('Download realizado com sucesso');
                    },
                    "sButtonClass": "btn-export btn-export-excel",
                    "sButtonText": $.i18n._('GERAR EXCEL'),
                    "mColumns": "visible",
                    "oSelectorOpts": {filter: 'applied', order: 'current'}
                }
            ]
        },
        colVis: {
            "buttonText": $.i18n._('Escolha as colunas'),
            "reload": $.i18n._('Recarregar'),
            restore: $.i18n._('Selecionar padrão'),
            showAll: $.i18n._('Selecionar todas'),
            showNone: $.i18n._('Desmarcar todas')
        },
        initComplete: function (settings, json) {

            var r = table.find('tfoot tr.filtros-cabecalho').not('.not-dataTable');
            table.find('thead').not('.not-dataTable').append(r);

            $('.loading-page').hide();
            $(this).closest('.wrapper-data-table').show();

        },
        footerCallback: function (row, data, start, end, display) {

            var tr = $(row);

            var api = this.api(), data;

            if (tr.hasClass('totaliza')) {

                api.columns('.sum').eq(0).each(function (colIdx) {

                    if(!api.column(colIdx).visible()){
                        return;
                    }

                    // Total over all pages
                    var total = api
                        .column(colIdx)
                        .data()
                        .reduce(function (a, b) {
                            return obtemValorCelula(a) + obtemValorCelula(b);
                        }, 0);

                    // Total over this page
                    var pageTotal = api
                        .column(colIdx, {search: 'applied'})
                        .data()
                        .reduce(function (a, b) {
                            return obtemValorCelula(a) + obtemValorCelula(b);
                        }, 0);


                    var qtColunasVisiveis = 0;
                    api.columns()
                        .visible()
                        .each(function (visible, index) {
                            if (visible) {
                                qtColunasVisiveis++;
                            }
                        });

                    if ($(api.table().footer()).find('tr').eq(0).find('th').length == qtColunasVisiveis) {

                        var cont = 0,
                            colIdxVisivel = 0;
                        api.columns()
                            .visible()
                            .each(function (visible, index) {

                                if(cont == colIdx){
                                    return;
                                }
                                if (visible) {
                                    colIdxVisivel ++;
                                }

                                cont ++;
                            });
                        // Update footer
                        $(api.table().footer()).find('tr.totaliza').eq(0).find('th').eq(colIdxVisivel).html(
                            ((pageTotal == total) ?
                                '<span class="total-geral">' + formatNumberToCurrentLocale(total, 2) + '</span>' :
                                '<span class="total-visivel">' + formatNumberToCurrentLocale(pageTotal, 2) + '</span>' +
                                '<br /><span class="total-geral">(' + formatNumberToCurrentLocale(total, 2) + ')</span>')
                        );
                    }
                });
            }
        },
        columnDefs: [
            {visible: false, targets: "ocultar"},
            {orderable: false, targets: 'no-sort'},
            {"sType": "order-by-date", targets: 'date-column'},
            {"sType": "order-by-numeric", targets: 'numeric-sort'},
        ],
        stateSave: true,
        autoWidth: false,
        bProcessing: true,
        "language": {
            search: "<span class=\"label-search\">Busca:</span>",
            searchPlaceholder: "Digite o que você procura...",
            processing: "Processando...",
            emptyTable: 'Nenhum dado disponível na tabela',
            info: "Exibindo de _START_ até _END_ de _TOTAL_ Registros",
            infoEmpty: "Exibindo de 0 até 0 de 0 Registro(s)",
            infoFiltered: "(filtrado do total de _MAX_ Registros)",
            lengthMenu: "Exibir _MENU_ registros",
            zeroRecords: 'Nenhum registro encontrado'
        },
        displayLength: 25
    };

    if (newConfig != undefined) {
        $.extend(configPadrao, newConfig);
    }

    // Setup - add a text input to each footer cell
    table.find('tfoot tr.filtros-cabecalho').find('th').not('.not-dataTable').each(function () {
        if (!$(this).hasClass('no-filter')) {
            $(this).html('<input class="data-table-input-filter" type="text"/>');
            $(this).addClass('data-table-row-filter');
        } else {
            $(this).html('');
        }
    });

    var dataTable = table.DataTable(configPadrao),
        saveState = true,
        columnsState = null;

    if (dataTable.state() == null) {
        saveState = false;
    } else {
        columnsState = dataTable.state().columns;
    }

    dataTable = preparaFiltrosDataTable(dataTable);

    // Draw the table to apply the initial search
    dataTable.draw();

    // Se no fixed head tiver duas linhas no header, a segunda será deletada pois é a do filtro
    if (document.querySelectorAll('.fixedHeader thead tr').length == 2) {
        document.querySelectorAll('.fixedHeader thead tr')[1].remove();
    }

    //   table.stickyTableHeaders();

    var toolbarReset = $('.toolbar-reset');
    toolbarReset.html('<button title="Restaurar filtros" class="btn-toolbar-reset" data-table-id="' + table.attr('id') + '" />');

    $(document).ready(function () {
        $('#' + table.attr('id') + '_wrapper').on('click', '.btn-toolbar-reset', function () {
            dataTable.state.clear();
            runLoading();
            window.location.reload();
        });
    });

    return dataTable;
}

function createDefaultDataTableSimples(table, newConfig) {

    if (table.length <= 0) {
        return;
    }

    var expr = new RegExp('>[ \t\r\n\v\f]*<', 'g');
    var tbhtml = table.html();
    table.html(tbhtml.replace(expr, '><'));

    var configPadrao = {
        dom: '<"pull-left tools-data-table"l<"clear">><"pull-right"<"toolbar pull-left"><"clear">>rt<"bottom"pi<"clear">>',
        initComplete: function (settings, json) {
            var r = table.find('tfoot tr').not('.not-dataTable');
            table.find('thead').not('.not-dataTable').append(r);
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
            "emptyTable": $.i18n._('Nenhum dado disponível na tabela'),
            "info": $.i18n._("Exibindo de _START_ até _END_ de _TOTAL_ Registros"),
            "infoEmpty": $.i18n._("Exibindo de 0 até 0 de 0 Registro(s)"),
            "infoFiltered": $.i18n._("(filtrado do total de _MAX_ Registros)"),
            "lengthMenu": $.i18n._("Exibir _MENU_ registros"),
            "zeroRecords": $.i18n._('Nenhum registro encontrado'),
        },
        displayLength: 10
    };

    if (newConfig != undefined) {
        $.extend(configPadrao, newConfig);
    }

    // Setup - add a text input to each footer cell
    table.find('tfoot th').not('.not-dataTable').each(function () {
        if (!$(this).hasClass('no-filter')) {
            $(this).html('<input class="data-table-input-filter" type="text"/>');
            $(this).addClass('data-table-row-filter');
        } else {
            $(this).html('');
        }
    });

    var dataTable = table.DataTable(configPadrao);

    dataTable = preparaFiltrosDataTable(dataTable);

    // Draw the table to apply the initial search
    dataTable.draw();

    return dataTable;
}

function preparaFiltrosDataTable(dataTable) {

    console.log('preparaFiltrosDataTable');

    dataTable.columns().eq(0).each(function (colIdx) {
        var columnVal = '',
            header = dataTable.column(colIdx).header(),
            footer = dataTable.column(colIdx).footer(),
            pesquisa = null;

        $(header).find('input:text').val(columnVal);
        $(footer).find('input:text').val(columnVal);

        dataTable
            .column(colIdx)
            .search(columnVal);

        pesquisa = footer;
        if (footer == null) {
            pesquisa = header;
        }

        if (null == pesquisa) {
            return;
        }
        ;

        $('input:text', pesquisa).on('keyup change', function () {
            dataTable
                .column(colIdx)
                .search(this.value)
                .draw();
        });
    });

    return dataTable;
}

// Remove the formatting to get integer data for summation
function obtemValorCelula(i) {

    var value = i;

    try {
        if ($(i).filter('.value').length > 0) {
            value = $(i).filter('.value').text();
        } else if ($(i).find('.value').length > 0) {
            value = $(i).find('.value').text();
        }
    } catch (error) {

    }

    var valor = stringFormatToNumberByCurrentLocale(value);

    if (typeof valor !== 'number' || isNaN(valor)) {
        valor = 0;
    }

    return valor;
};