$(function () {

    function calculateDate(date) {

        if (date == '') {
            return 0;
        }

        // Expressão regular
        var regular_expression = /<!-- [0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]-->/;

        if (regular_expression.test(date)) {
            var i = date.indexOf("<!-- ") + 5;
            return date.substring(i, i + 8);
        }

        if (date.length > 10) {
            date = date.substring((date.indexOf("/") - 2), (date.indexOf("/") + 8 ));
        }

        var date = date.replace(" ", "");

        if (date.indexOf('/') > 0) {
            /* date a, format dd/mm/(yyyy) ; (year is optional) */
            var splitDate = date.split('/');

            var year = 0;
            if (splitDate[2]) {
                year = splitDate[2];
            }

            var month = splitDate[0];
            if (window.lang == 'pt_BR') {
                month = splitDate[1];
            }

            if (month.length == 1) {
                month = 0 + month;
            }

            var day = splitDate[1];
            if (window.lang == 'pt_BR') {
                day = splitDate[0];
            }

            if (day.length == 1) {
                day = 0 + day;
            }

            return (year + month + day) * 1;

        } else {
            return 0;
        }
    }

    jQuery.fn.dataTableExt.oSort['order-by-date-asc'] = function (a, b) {

        x = calculateDate(a);
        y = calculateDate(b);

        return ((x < y) ? -1 : ((x > y) ? 1 : 0));
    };

    jQuery.fn.dataTableExt.oSort['order-by-date-desc'] = function (a, b) {

        x = calculateDate(a);
        y = calculateDate(b);

        return ((x < y) ? 1 : ((x > y) ? -1 : 0));
    };
});
