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
    $('.phone_us').mask('(000) 000-0000');
    $('.mixed').mask('AAA 000-S0S');
    $('.cpf').mask('000.000.000-00', {reverse: true});
    $('.cnpj').mask('00.000.000/0000-00', {reverse: true});
    $('.money').mask('000.000.000.000.000,00', {reverse: true});
    $('.money2').mask("#.##0,00", {reverse: true});
    $('#preco').mask("#.##0,00", {reverse: true});
    $('#preco1').mask("#.##0,00", {reverse: true});
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
function reload() {
    $.ajax({
        url: DIR + 'Ajax/NavegacaoView',
        data: {campo: 0},
        type: 'POST',
        beforeSend: function () {
            loadpagerequest(1);

        },
        error: function (res) {
            loadpagerequest(0);

            alert('erro');

        },
        success: function (data) {

            if (data) {

                if (data == 'reload_action') {
                    window.location.reload();
                } else {
                    $('body').html(data);
                }
                loadpagerequest(0);

            } else {
                loadpagerequest(0);

                alert(data);

            }


        }
    });
}

function view(tipo, campo) {
    $.ajax({
        url: DIR + 'Ajax/NavegacaoView',
        data: {tipo: tipo, campo: campo},
        type: 'POST',
        beforeSend: function () {
            loadpagerequest(1);

        },
        error: function (res) {
            loadpagerequest(0);

            alert('erro');

        },
        success: function (data) {

            if (data) {

                if (data == 'reload_action') {
                    window.location.reload();
                } else {
                    $('#navigationViewAerea').html(data);
                }
                loadpagerequest(0);

            } else {
                loadpagerequest(0);

                alert(data);

            }


        }
    });
}

function logout() {

    $.ajax({
        url: DIR + 'Ajax/logout',
        type: 'POST',
        beforeSend: function () {

        },
        error: function (res) {
            alert('erro');
        },
        success: function (data) {

            if (data == 11) {
                window.location.reload();
            } else {

                alert(data);

            }


        }
    });

}

function logout_empresa() {

    $.ajax({
        url: DIR + 'Ajax/logoutEmpresa',
        type: 'POST',
        beforeSend: function () {

        },
        error: function (res) {
            alert('erro');
        },
        success: function (data) {

            if (data == 11) {
                window.location.reload();
            } else {

                alert(data);

            }


        }
    });

}


function remover_imagem(id,tabela,campo) {
    $.ajax({
        url: DIR+'Ajax/remover_imagem',
        data: {id:id,tabela:tabela,campo:campo},
        type: 'POST',
        beforeSend: function () {
        },
        error: function (res) {
        },
        success: function (data) {
            $('.modal').hide();
            $('.modal-backdrop').removeClass('modal-backdrop');
        }
    });
}


function loadpagerequest(acao) {
    if (acao == 1) {
        $('body').css('opacity', '0.5');
    } else {
        $('body').css('opacity', '1');

    }
}


function newPostTable(acao, tabela, tipo, edit) {

    if (tipo) {
        $('.modal').modal({backdrop: 'static', keyboard: false});

        $.ajax({
            url: DIR + 'Ajax/formFilds',
            data: {acao: acao, tabela: tabela, tipo: tipo},
            type: 'POST',

            error: function (res) {

                alert('Erro ao Carregar o Conteudo');

            },
            success: function (data) {

                if (data) {

                    if (data == 'reload_action') {
                        window.location.reload();
                    } else {
                        $('.modal .modal-body').html(data);
                    }

                } else {

                    alert('Erro ao Carregar e Exibir o Conteudo');

                }


            }
        });

    } else {

        $('.modal').modal({backdrop: 'static', keyboard: false});

        if (edit) {
            $.ajax({
                url: DIR + 'Ajax/formFilds',
                data: {acao: acao, tabela: tabela, edit: edit},
                type: 'POST',

                error: function (res) {

                    alert('Erro ao Carregar o Conteudo');

                },
                success: function (data) {

                    if (data) {

                        if (data == 'reload_action') {
                            window.location.reload();
                        } else {
                            $('.modal .modal-body').html(data);
                        }

                    } else {

                        alert('Erro ao Carregar e Exibir o Conteudo');

                    }


                }
            });
        } else {
            $.ajax({
                url: DIR + 'Ajax/formFilds',
                data: {acao: acao, tabela: tabela},
                type: 'POST',

                error: function (res) {

                    alert('Erro ao Carregar o Conteudo');

                },
                success: function (data) {

                    if (data) {

                        if (data == 'reload_action') {
                            window.location.reload();
                        } else {
                            $('.modal .modal-body').html(data);
                        }

                    } else {

                        alert('Erro ao Carregar e Exibir o Conteudo');

                    }


                }
            });
        }


    }

}


function editar_item(action, tabela, id) {
    newPostTable(1, tabela, '', id);
}

function saveForm(table) {

    var form = $('form').serialize();

    $.ajax({
        url: DIR + 'Ajax/ProcessarForm',
        data: form,
        type: 'POST',

        error: function (res) {

            alert('Erro ao Carregar o Conteudo');

        },
        success: function (data) {

            if (data) {

                if (data == 11) {
                    $('.modal').modal('hide');
                    view(1, table);
                } else {
                    alert(data);

                }

            } else {

                alert('Erro ao Carregar e Exibir o Conteudo');

            }


        }
    });
}

function addSelect(edit) {

    if ($('#' + edit).hasClass('selected')) {

        $('#' + edit).removeClass('selected');


    } else {

        $('#' + edit).addClass('selected');
        $('.removeallselects').removeClass('disabled');

    }

}

function delecsts(table, item, multiple) {

    $.ajax({
        url: DIR + 'Ajax/deleteitens',
        data: {table: table, item: item},
        type: 'POST',

        error: function (res) {

            alert('Erro ao Carregar o Conteudo');

        },
        success: function (data) {

            if (data) {

                var tables = $('#demo-dt-addrow').DataTable();


                if (data == 11) {
                    if (multiple == 1) {


                        tables.row('.selected').remove().draw(false);


                    } else {
                        view(1, table);

                    }
                } else {
                    alert(data);

                }

            } else {

                alert('Erro ao Carregar e Exibir o Conteudo');

            }


        }
    });
}


function chagestatus(arrdata, id, table) {

    var status = arrdata.value;
    $.ajax({
        url: DIR + 'Ajax/changestatus',
        data: {table: table, item: id, status: status},
        type: 'POST',

        error: function (res) {

            alert('Erro ao Carregar o Conteudo');

        },
        success: function (data) {

            if (data) {

                var tables = $('#demo-dt-addrow').DataTable();


                if (data == 11) {

                } else {
                    alert(data);

                }

            } else {

                alert('Erro ao Carregar e Exibir o Conteudo');

            }


        }
    });


}

function enviarimage(identificador) {


    var fd = new FormData();
    var files = $('#'+identificador)[0].files[0];
    fd.append('file',files);

    $.ajax({
        url: DIR+'Ajax/uploadImage',
        type: 'post',
        data: fd,
        contentType: false,
        processData: false,
        success: function(response){
        if(response != 0){

            $(".preview").html('<input type="hidden" name="'+identificador+'" value="'+response+'">');

        }else{
            alert('file not uploaded');
        }
    },
});
}

function salvePerfilEmpresa() {
    var form = $('#formempresaperfil').serialize();

    $.ajax({
        url: DIR + 'Ajax/perfilAltera',
        data: form,
        type: 'POST',

        error: function (res) {

            alert('Erro ao Carregar o Conteudo');

        },
        success: function (data) {

            if (data) {

                if (data == 11) {
                    $('#alteracaoperfil').modal('hide');

                } else {
                    alert(data);

                }

            } else {

                alert('Erro ao Carregar e Exibir o Conteudo');

            }


        }
    });
}

function alerts(alerttext) {
    alert(alerttext);
}


