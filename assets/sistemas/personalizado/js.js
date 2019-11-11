$(document).ready(function() {

    function limpa_formulário_cep() {
        // Limpa valores do formulário de cep.
        $(".rua").val("");
        $(".bairro").val("");
        $(".cidade").val("");
        $(".uf").val("");
        $(".ibge").val("");
    }

    //Quando o campo cep perde o foco.
    $(".cep").blur(function() {

        //Nova variável "cep" somente com dígitos.
        var cep = $(this).val().replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                $(".rua").val("...");
                $(".bairro").val("...");
                $(".cidade").val("...");
                $(".uf").val("...");
                $(".ibge").val("...");

                //Consulta o webservice viacep.com.br/
                $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                    if (!("erro" in dados)) {
                        //Atualiza os campos com os valores da consulta.
                        $(".rua").val(dados.logradouro);
                        $(".bairro").val(dados.bairro);
                        $(".cidade").val(dados.localidade);
                        $(".uf").val(dados.uf);
                        $(".ibge").val(dados.ibge);
                        $(".pais").val('Brasil');
                    } //end if.
                    else {
                        //CEP pesquisado não foi encontrado.
                        limpa_formulário_cep();
                        alert("CEP não encontrado.");
                    }
                });
            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    });
});

$(document).ready(function(){
    $('.date').mask('00/00/0000');
    $('.time').mask('00:00:00');
    $('.date_time').mask('00/00/0000 00:00:00');
    $('.cep').mask('00000-000');
    $('.phone').mask('0000-0000');
    $('.phone_with_ddd').mask('(00) 0000-0000');
    $('.phone_with_dddcel').mask('(00) 00000-0000');
    $('.phone_us').mask('(000) 000-0000');
    $('.mixed').mask('AAA 000-S0S');

    $('.cpf').mask('000.000.000-00', {reverse: true});
    $('.cnpj').mask('00.000.000/0000-00', {reverse: true});
    $('.money').mask('000.000.000.000.000,00', {reverse: true});
    $('.money2').mask("#,##0.00", {reverse: true});
    $('.ip_address').mask('0ZZ.0ZZ.0ZZ.0ZZ', {
        translation: {
            'Z': {
                pattern: /[0-9]/, optional: true
            }
        }
    });
    $('.ip_address').mask('099.099.099.099');
    $('.percent').mask('##0,00%', {reverse: true});
    $('.clear-if-not-match').mask("00/00/0000", {clearIfNotMatch: true});
    $('.placeholder').mask("00/00/0000", {placeholder: "__/__/____"});
    $('.fallback').mask("00r00r0000", {
        translation: {
            'r': {
                pattern: /[\/]/,
                fallback: '/'
            },
            placeholder: "__/__/____"
        }
    });
    $('.selectonfocus').mask("00/00/0000", {selectOnFocus: true});
});

$(function () {
    var i = -1;
    var toastCount = 0;
    var $toastlast;

    var getMessage = function () {
        var msgs = ['My name is Inigo Montoya. You killed my father. Prepare to die!',
            'Are you the six fingered man?',
            'Inconceivable!',
            'I do not think that means what you think it means.',
            'Have fun storming the castle!'
        ];
        i++;
        if (i === msgs.length) {
            i = 0;
        }

        return msgs[i];
    };

    var getMessageWithClearButton = function (msg) {
        msg = msg ? msg : 'Clear itself?';
        msg += '<br /><br /><button type="button" class="btn btn-default clear">Yes</button>';
        return msg;
    };

    $('#showtoast').click(function () {
        var shortCutFunction = $("#toastTypeGroup input:radio:checked").val();
        var msg = $('#message').val();
        var title = $('#title').val() || '';
        var $showDuration = $('#showDuration');
        var $hideDuration = $('#hideDuration');
        var $timeOut = $('#timeOut');
        var $extendedTimeOut = $('#extendedTimeOut');
        var $showEasing = $('#showEasing');
        var $hideEasing = $('#hideEasing');
        var $showMethod = $('#showMethod');
        var $hideMethod = $('#hideMethod');
        var toastIndex = toastCount++;
        var addClear = $('#addClear').prop('checked');

        toastr.options = {
            closeButton: $('#closeButton').prop('checked'),
            debug: $('#debugInfo').prop('checked'),
            newestOnTop: $('#newestOnTop').prop('checked'),
            progressBar: $('#progressBar').prop('checked'),
            positionClass: $('#positionGroup input:radio:checked').val() || 'toast-top-right',
            preventDuplicates: $('#preventDuplicates').prop('checked'),
            onclick: null
        };

        if ($('#addBehaviorOnToastClick').prop('checked')) {
            toastr.options.onclick = function () {
                alert('You can perform some custom action after a toast goes away');
            };
        }

        if ($showDuration.val().length) {
            toastr.options.showDuration = $showDuration.val();
        }

        if ($hideDuration.val().length) {
            toastr.options.hideDuration = $hideDuration.val();
        }

        if ($timeOut.val().length) {
            toastr.options.timeOut = addClear ? 0 : $timeOut.val();
        }

        if ($extendedTimeOut.val().length) {
            toastr.options.extendedTimeOut = addClear ? 0 : $extendedTimeOut.val();
        }

        if ($showEasing.val().length) {
            toastr.options.showEasing = $showEasing.val();
        }

        if ($hideEasing.val().length) {
            toastr.options.hideEasing = $hideEasing.val();
        }

        if ($showMethod.val().length) {
            toastr.options.showMethod = $showMethod.val();
        }

        if ($hideMethod.val().length) {
            toastr.options.hideMethod = $hideMethod.val();
        }

        if (addClear) {
            msg = getMessageWithClearButton(msg);
            toastr.options.tapToDismiss = false;
        }
        if (!msg) {
            msg = getMessage();
        }

        $('#toastrOptions').text('Command: toastr["'
            + shortCutFunction
            + '"]("'
            + msg
            + (title ? '", "' + title : '')
            + '")\n\ntoastr.options = '
            + JSON.stringify(toastr.options, null, 2)
        );

        var $toast = toastr[shortCutFunction](msg, title); // Wire up an event handler to a button in the toast, if it exists
        $toastlast = $toast;

        if (typeof $toast === 'undefined') {
            return;
        }

        if ($toast.find('#okBtn').length) {
            $toast.delegate('#okBtn', 'click', function () {
                alert('you clicked me. i was toast #' + toastIndex + '. goodbye!');
                $toast.remove();
            });
        }
        if ($toast.find('#surpriseBtn').length) {
            $toast.delegate('#surpriseBtn', 'click', function () {
                alert('Surprise! you clicked me. i was toast #' + toastIndex + '. You could perform an action here.');
            });
        }
        if ($toast.find('.clear').length) {
            $toast.delegate('.clear', 'click', function () {
                toastr.clear($toast, {force: true});
            });
        }
    });

    function getLastToast() {
        return $toastlast;
    }

    $('#clearlasttoast').click(function () {
        toastr.clear(getLastToast());
    });
    $('#cleartoasts').click(function () {
        toastr.clear();
    });
});

/*Funções do Site */

function intencao_cotacao(produto) {
    $.ajax({
        url: DIR+'/AjaxDefault/intencao',
        data: {id:produto},
        type: 'POST',
        beforeSend: function () {
        },
        error: function (res) {
        },
        success: function (data) {
        }
    });
}

//Função de Busca

function setar_comitente(comitente) {
    $.ajax({
        url: DIR+'/AjaxDefault/setar_comitente',
        data: {comitente:comitente},
        type: 'POST',
        beforeSend: function () {
        },
        error: function (res) {
        },
        success: function (data) {
            if(data == 11){
                $("body").css('opacity','0.5');
                timeout = setTimeout(function () { // quando o timer for disparado...
                    timeout = false; // ... apagamos sua referência ...
                    window.location.reload();
                }, 1000);
            }
        }
    });
}

function categoria(val) {

    $('#categoriasearch').val(val);
    sujestaoserach(val)

}

//Funções de Acesso


function alterardados() {

    var form = $('#formalteradados').serialize();
    $.ajax({
        url: DIR+'/AjaxDefault/alterardados',
        data: form,
        type: 'POST',
        beforeSend: function () {
            $('body').css('opacity','0.5');

        },
        error: function (res) {
            $('body').css('opacity','1');

            $("#alterardados .modal-title").text(data);
            $("#blockcads").text(data);




        },
        success: function (data) {

            $('body').css('opacity','1');

            if(data == 11){

                window.location.reload();

            }

            else{
                $("#alterardados .modal-title").text(data);
                $("#blockcads").text(data);
                Command: toastr["warning"](data);

                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
            }



        }
    });


}


function cadastro() {

    var form = $('#formcadastro').serialize();
    $.ajax({
        url: DIR+'/AjaxDefault/cadastro',
        data: form,
        type: 'POST',
        beforeSend: function () {
            $('body').css('opacity','0.5');

        },
        error: function (res) {
            $('body').css('opacity','1');

            $("#signups .modal-title").text(data);
            $("#blockcads").text(data);




        },
        success: function (data) {

            $('body').css('opacity','1');

            if(data == 11){

                window.location.href=DIR+"/minha-conta?enviar_docs=true";

            }

            else{
                $("#signups .modal-title").text(data);
                $("#blockcads").text(data);
                Command: toastr["warning"](data);

                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
            }



        }
    });
}


function login() {

    var form = $('#loginforms').serialize();
    $.ajax({
        url: DIR+'/AjaxDefault/login',
        data: form,
        type: 'POST',
        beforeSend: function () {
            $('body').css('opacity','0.5');

        },
        error: function (res) {
            $("#login .modal-title").text('Ocorreu um erro, tente novamentes');

            Command: toastr["error"]("Ocorreu um erro, tente novamente!");

            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
            $('body').css('opacity','1');

        },
        success: function (data) {

            $('body').css('opacity','1');

            if(data == 11){

                window.location.reload();

            }

            else{
                $("#login .modal-title").text(data);

                Command: toastr["warning"](data);

                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
            }



        }
    });
}


function redefinirAgora() {
    var form = $("#emailRedefinirNow").serialize();
    $.ajax({
        url: DIR+'/Ajax/redefinirPassNow',
        data: form,
        type: 'POST',
        beforeSend: function () {
            $('body').css('opacity','0.5');
        },
        error: function (res) {


            $('body').css('opacity','1');

        },
        success: function (data) {


            if(data == 11){

                window.location.reload();
            }else{

                Command: toastr["warning"](data);

                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
                $('body').css('opacity','1');

            }


        }
    });

}

//Funções de Conta

function logout() {

    $.ajax({
        url: DIR+'/AjaxDefault/logout',
        type: 'POST',
        beforeSend: function () {
            $('body').css('opacity','0.5');
        },
        error: function (res) {

            Command: toastr["danger"]('Erro ao realizar o Logout!');

            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
            $('body').css('opacity','1');

        },
        success: function (data) {

            if(data == 11){

                window.location.reload();

            }else{

                Command: toastr["danger"]('Erro ao realizar o Logout!');

                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
                $('body').css('opacity','1');

            }



        }
    });

}

//Funções do Carrinho

function removecarrinho(id) {
    $.ajax({
        url: DIR+'AjaxDefault/remover_item_carrinho',
        data: {produto:id},
        type: 'POST',
        beforeSend: function () {

        },
        error: function (res) {

            Command: toastr["error"]('Ocorreu um erro ao limpar o carrinho!');

            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }

        },
        success: function (data) {


            if(data == 11){

                window.location.reload();


            }else{

                Command: toastr["warning"](data);

                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }


            }


        }
    });
}


function limparcarrinho() {
    $.ajax({
        url: DIR+'AjaxDefault/limpar_carrinho',
        type: 'POST',
        beforeSend: function () {

        },
        error: function (res) {

            Command: toastr["error"]('Ocorreu um erro ao limpar o carrinho!');

            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }

        },
        success: function (data) {


            if(data == 11){

                window.location.reload();


            }else{

                Command: toastr["warning"](data);

                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }


            }


        }
    });
}


function carrinhoadd(id) {
    $.ajax({
        url: DIR+'AjaxDefault/carrinho',
        data: {id:id},
        type: 'POST',
        beforeSend: function () {

        },
        error: function (res) {

            Command: toastr["error"]('Ocorreu um erro ao adicionar o item no carrinho!');

            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }

        },
        success: function (data) {


            if(data == 11){
                $.ajax({
                    url: DIR+'AjaxDefault/attache_card',
                    type: 'POST',
                    beforeSend: function () {

                    },
                    error: function (res) {

                    },
                    success: function (data) {

                        if(data){
                            //   $('.cart-dropdown').html(data);
                            swal({
                                title: "Confirmado",
                                text: "Adicionado ao carrinho com sucesso.",
                                icon: "success",
                                timer: 2000,
                                showCancelButton: false,
                                showConfirmButton: false
                            });
                            $.ajax({
                                url: DIR+'AjaxDefault/count_card',
                                type: 'POST',
                                beforeSend: function () {

                                },
                                error: function (res) {

                                },
                                success: function (data) {

                                    if(data){
                                        $('.count-label').html(data);
                                    }else{
                                        $('.count-label').html('1');

                                    }

                                }
                            });


                        }

                    }
                });


            }else{

                Command: toastr["warning"](data);

                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }


            }


        }
    });
}

function atualizarqnt(id, quantidade) {
    $.ajax({
        url: DIR+'AjaxDefault/updateqnt_card',
        data: {id: id, quantidade: quantidade},
        type: 'POST',
        beforeSend: function () {

        },
        error: function (res) {

            Command: toastr["error"]('Ocorreu um erro alterar a quantidade no carrinho');

            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }

        },
        success: function (data) {


            if (data == 11) {

                window.location.reload();


            } else {

                Command: toastr["warning"](data);

                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }


            }


        }
    });
}

function showLancebtn(produto) {

    if($("#meulancefields"+produto).hasClass('openss')){
        $("#meulancefields"+produto).removeClass('openss');
        $("#meulancefields"+produto).css("display","none");
        $("#buttonalterarlance"+produto).html('<a href="javascript:showLancebtn('+produto+');" class="btn btn-primary">ALTERAR LANCE</a>');

    }else{
        $("#meulancefields"+produto).css("display","block");

        var valor = $('#meulancefields'+produto).val();

        $("#buttonalterarlance"+produto).html('<a href="javascript:alterarLanceCard('+produto+','+valor+');" class="btn btn-primary">CONFIRMAR LANCE</a>');

    }

}

function alterarLanceCard(item,valor) {
    if(valor) {

        $.ajax({
            url: DIR + 'AjaxDefault/lanceitemcard',
            data: {item: item,valor:valor},
            type: 'POST',
            beforeSend: function () {

            },
            error: function (res) {

                Command: toastr["error"]('Ocorreu um erro alterar a quantidade no carrinho');

                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }

            },
            success: function (data) {


                if (data == 11) {

                    window.location.reload();


                } else {
                    showLancebtn(item);
                    Command: toastr["warning"](data);

                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }


                }


            }
        });

    }else{
        Command: toastr["error"]('Digite um preço valido');

        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    }
}


//Funções do Lance

function enviar_proposta(oferta) {

    var form = $("#darlanceform"+oferta).serialize();
    $.ajax({
        url: DIR+'AjaxDefault/enviarcotacao',
        data: form,
        type: 'POST',
        beforeSend: function () {

        },
        error: function (res) {

            Command: toastr["error"]('Ocorreu um erro ao enviar o seu lance!');

            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }

        },
        success: function (data) {


            if(data == 11){



                $("#modalprod"+oferta).modal('hide');

                Command: toastr["success"]('Proposta enviada com Sucesso!');

                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }


            }else{
                $("#modalprod"+oferta).modal('hide');

                Command: toastr["warning"](data);

                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }


            }


        }
    });

}

//Funções do Carrinho

function revisarPedido() {
    $('#btncols').html('<a class="btn btn-default disabled" style="cursor: not-allowed;" href="javascript:void(0);"><i class="fa fa-paper-plane"></i> Enviar Cotação</a>');
    $.ajax({
        url: DIR+'AjaxDefault/enviarcotacaocarrinho',
        type: 'POST',
        beforeSend: function () {
            Command: toastr["success"]('Sua proposta esta sendo processada.');

            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }

        },
        error: function (res) {

            Command: toastr["error"]('Ocorreu um erro ao finalizar a sua proposta, tente novamente.');

            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }

        },
        success: function (data) {


            if (data == 11) {


                Command: toastr["success"]("Proposta Enviada com Sucesso");

                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }

                var delay = 3000;
                setTimeout(function () {
                    window.location.href = DIR+"minha-conta/cotacoes";
                }, delay);


            } else {

                Command: toastr["warning"](data);

                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }


            }


        }
    });

}

function keysession(valor) {
    $.ajax({
        url: DIR+'AjaxDefault/keysession',
        data: {valor:valor},
        type: 'POST',
        beforeSend: function () {
        },
        error: function (res) {

        },
        success: function (data) {

        }



    });
}

var contagem = 0;
function pegar_segundos(valor) {

    contagem = valor;
}

var contagemauditorio = new Array();

function pegar_segundosauditorio(valor,id) {


    contagemauditorio[id] = valor;


}

function iniciarcronometro(variavel) {
    var nextYear = moment.tz(variavel, "America/Sao_Paulo");

    $('#clock').countdown(nextYear.toDate(), function(event) {
        $(this).html(event.strftime('%H:%M:%S'));


        pegar_segundos(event.strftime('%M%S'));
    });
}

function iniciarcronometroauditorio(variavel,id) {
    var nextYear = moment.tz(variavel, "America/Sao_Paulo");

    $('#clock'+id).countdown(nextYear.toDate(), function(event) {
        $(this).html(event.strftime('%D d %H:%M:%S'));

        pegar_segundosauditorio(event.strftime('%D%H%M%S'),id);



    });
}

function atualizar_lote(metodo,lote,setTime) {




        $.ajax({
            url: DIR+'AjaxDefault/verificar_cronometro',
            data: {lote:lote},
            type: 'POST',
            beforeSend: function () {
            },
            error: function (res) {

            },
            success: function (data) {


                var duce =  jQuery.parseJSON(data);


                if(duce.cronometro && duce.cronometro !== 1574002){
                    iniciarcronometro(duce.cronometro);
                }
                if(duce.cronometro == 1574002) {
                $("#hoverdrop").css('display','none');
                $("#hoverdrop2").html('<b id="textescrits">Aguardando Lotes Anteriores Encerrarem</b>');

                }else{
                    $("#hoverdrop").css('display','block');
                    $("#textescrits").remove();

                }
                    if(duce.lance_atual){
                    $("#lance_atual").text(duce.lance_atual);
                }

                if(duce.data_lance){
                    $("#data_lance").text(duce.data_lance);
                }

                if(duce.nickname){
                    $("#nickname").text(duce.nickname);
                }

            }



        });





    if(contagem < '0059'){



        setTimeout(function(){ atualizar_lote(0,idlote); }, 3000);

    }else{

        setTimeout(function(){ atualizar_lote(0,idlote); }, 10000);

    }


}

function atualizar_loteauditorio(metodo,lote,setTime) {

    if(metodo == 1){


    }
    else{


        $.ajax({
            url: DIR+'AjaxDefault/verificar_cronometro',
            data: {lote:lote},
            type: 'POST',
            beforeSend: function () {
            },
            error: function (res) {

            },
            success: function (data) {
                var duce =  jQuery.parseJSON(data);

                if(duce.cronometro){
                    iniciarcronometroauditorio(duce.cronometro,lote);
                }

                if(duce.lance_atual){
                    $("#lance_atual"+lote).text(duce.lance_atual);
                }

                if(duce.data_lance){
                    $("#data_lance"+lote).text(duce.data_lance);
                }

                if(duce.nickname){

                    $("#nickclass"+lote).css('display','block');
                    $("#nickname"+lote).text(duce.nickname);
                }

            }



        });

    }



    if(contagem < '00000059'){



        setTimeout(function(){ atualizar_loteauditorio(0,lote,1); }, 3000);

    }else{

        setTimeout(function(){ atualizar_loteauditorio(0,lote,1); }, 10000);

    }



}

function checktimeauditorio(lote){


    if(contagemauditorio[lote] === '00000000'){


        $("#lancevalues"+lote).val('');

        atualizar_loteauditorio(0,lote,1);


        $.ajax({
            url: DIR+'AjaxDefault/finalizarleilao',
            data: {lote:lote},
            type: 'POST',
            beforeSend: function () {
            },
            error: function (res) {
            },
            success: function (data) {
                if(data != 0){
                    $("#blocksdisplays"+lote).css("display","block");
                    $("#lotebolsaaud"+lote).remove();

                }else{
                    $("#blocksdisplays"+lote).css("display","none");
                }
            }
        });
        var timer = setInterval(function() {
            $("#blocksdisplays"+lote).css("display","block");
            $("#clock"+lote).text('Lote Finalizado');
            $("#situacaoloteabs"+lote).css('background','#B7C4BF');
            $("#situacaoloteabs"+lote).text('Lote Finalizado');
            $("#situacaols"+lote).remove();
        }, 1000);




    }

    setTimeout(function(){ checktimeauditorio(lote); }, 1000);

}

function dar_lance(lote) {

    var form = $('#lancevalor').serialize();

    $.ajax({
        url: DIR+'AjaxDefault/dar_lance',
        data: form,
        type: 'POST',
        beforeSend: function () {
        },
        error: function (res) {

        },
        success: function (data) {
            $("#lancevalues").val('');
            atualizar_lote(0,lote);

            var duce =  jQuery.parseJSON(data);

            if(duce.sucesso === 1){
                $("#lancevalues").val('');
            }else{

                if(duce.mensagem === 'E necessario estar Logado'){

                    $("#login").modal('show');


                }else{

                    if(duce.mensagem === 'Usuario não validado, por favor envie seus documentos'){
                        swal({
                            title: "Atenção",
                            text: duce.mensagem,
                            icon: "warning",
                            timer: 2000,
                            showCancelButton: false,
                            showConfirmButton: false
                        });
                        var timer = setInterval(function() {  window.location.href=DIR+"/minha-conta?enviar_docs=true"; }, 4000);

                    }else{
                        swal({
                            title: "Atenção",
                            text: duce.mensagem,
                            icon: "warning",
                            timer: 2000,
                            showCancelButton: false,
                            showConfirmButton: false
                        });
                    }


                }

            }


        }

    });

}

function dar_lanceauditorio(lote) {

    var form = $('#lancevalor'+lote).serialize();

    $.ajax({
        url: DIR+'AjaxDefault/dar_lance',
        data: form,
        type: 'POST',
        beforeSend: function () {
        },
        error: function (res) {

        },
        success: function (data) {
            $("#lancevalues"+lote).val('');
            atualizar_loteauditorio(0,lote,1);

            var duce =  jQuery.parseJSON(data);

            if(duce.sucesso === 1){
                $("#lancevalues"+lote).val('');
            }else{

                if(duce.mensagem === 'E necessario estar Logado'){

                    $("#login").modal('show');


                }else{

                    if(duce.mensagem === 'Usuario não validado, por favor envie seus documentos'){
                        swal({
                            title: "Atenção",
                            text: duce.mensagem,
                            icon: "warning",
                            timer: 2000,
                            showCancelButton: false,
                            showConfirmButton: false
                        });
                        var timer = setInterval(function() {  window.location.href=DIR+"/minha-conta?enviar_docs=true"; }, 4000);

                    }else{
                        swal({
                            title: "Atenção",
                            text: duce.mensagem,
                            icon: "warning",
                            timer: 2000,
                            showCancelButton: false,
                            showConfirmButton: false
                        });
                    }


                }

            }


        }

    });

}

function loadmore(leilao,page) {

    $("#buttonloadmore").html('<a href="javascript:void(0);" class="btn btn-danger text-white">Carregando...</a>');
    var pages = page + 1;

    $.ajax({
        url: DIR+'AjaxDefault/loadmore',
        data: {leilao:leilao,pages:pages},
        type: 'POST',
        beforeSend: function () {
        },
        error: function (res) {
            $("#buttonloadmore").html('<a href="javascript:loadmore('+leilao+','+pages+');" class="btn btn-danger text-white">Carregar Mais</a>');

        },
        success: function (data) {


            $("#buttonloadmore").html('<a href="javascript:loadmore('+leilao+','+pages+');" class="btn btn-danger text-white">Carregar Mais</a>');

            $("#appenddata").append(data);
        }

    });

}

function loadmoreauditorio(leilao,page) {

    $("#buttonloadmore").html('<a href="javascript:void(0);" class="btn btn-danger text-white">Carregando...</a>');
    var pages = page + 1;

    $.ajax({
        url: DIR+'AjaxDefault/loadmoreauditorio',
        data: {leilao:leilao,pages:pages},
        type: 'POST',
        beforeSend: function () {
        },
        error: function (res) {
            $("#buttonloadmore").html('<a href="javascript:loadmoreauditorio('+leilao+','+pages+');" class="btn btn-danger text-white">Carregar Mais</a>');

        },
        success: function (data) {


            $("#buttonloadmore").html('<a href="javascript:loadmoreauditorio('+leilao+','+pages+');" class="btn btn-danger text-white">Carregar Mais</a>');

            $("#appenddata").append(data);
        }

    });

}


