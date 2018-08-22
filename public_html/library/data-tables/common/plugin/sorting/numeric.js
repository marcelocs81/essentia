$(function () {

    function trataConteudo(conteudo) {

        var texto = conteudo;
        try {
            if (conteudo.indexOf("<!--") > -1) {
                texto = conteudo.substring(conteudo.indexOf("<!--") + 4, conteudo.indexOf("-->"));
            } else {
                if ($(conteudo).filter('.value').length > 0) {
                    texto = $(conteudo).filter('.value').text();
                }
            }
        } catch (error) {

        }

        return stringFormatToNumberByCurrentLocale(texto);
    }

    jQuery.fn.dataTableExt.oSort['order-by-numeric-asc'] = function (a, b) {
        x = trataConteudo(a);
        y = trataConteudo(b);

        return ((x < y) ? -1 : ((x > y) ? 1 : 0));
    };

    jQuery.fn.dataTableExt.oSort['order-by-numeric-desc'] = function (a, b) {
        x = trataConteudo(a);
        y = trataConteudo(b);

        return ((x < y) ? 1 : ((x > y) ? -1 : 0));
    };
});
