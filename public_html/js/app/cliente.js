$(function () {

    console.log('cliente.js');

    $('.btn-excluir-cliente').click(function (e){
        e.preventDefault();
        var url = $(this).attr('href');
        $("#confirm-modal").modal('show');
        $("div.modal-body").find("b.info").text("excluir");
        $(".btn-sim").click(function(){
            window.location.href = url;
        });

        $(".btn-nao").click(function(){
            $("#confirm-modal").modal('hide');
        });
    });

    $('#btn-remove-regra').on('click', function (e) {
        var sel = document.getElementById("regra_disponiveis");
        var pasta = document.getElementById("regra");

        if (! pasta.options[pasta.selectedIndex]) {
            alert("Você precisa selecionar alguma regra");
            return;
        }

        var options = $(pasta.selectedOptions).clone(true);
        for (var i = 0; i < options.length; i++) {
            var option = $(options[i]);
            sel.options[sel.length] = new Option(option.text(), option.val());
            $("#regra option[value='"+option.val()+"']").remove();
        }

    })

});
