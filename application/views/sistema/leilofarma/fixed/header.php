<!DOCTYPE html>
<html class="no-js">


<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
<head>
    <meta content="<?php echo base_url();?>" name="author"/>
    <meta charset="UTF-8"/>
    <meta content="IE=edge" http-equiv="X-UA-Compatible"/>

    <meta content="width=device-width, initial-scale=1, user-scalable=no" name="viewport"/>
    <title>LeiloFarma - Produtos farmacêuticos pelo melhor preço.</title>
    <meta name="description" content="">
    <link rel="canonical" href="<?php echo base_url();?>">
    <meta property="og:site_name" content="LeiloFarma">
    <meta property="og:type" content="website">
    <meta property="og:image"
          content="<?php echo base_url('web/imagens/'.$config['FAVICON']);?>">
    <meta property="og:locale" content="pt_br">
    <link rel="shortcut icon" href="<?php echo base_url('web/imagens/'.$config['FAVICON']);?>" />

    <meta name="theme-color" content="#ee7c16">
    <link rel="stylesheet" media="screen" href="<?php echo base_url('assets/sistemas/leilofarma/');?>packs/css/vendor-a453ec6b.chunk.css"/>
    <link rel="stylesheet" media="screen" href="<?php echo base_url('assets/sistemas/leilofarma/');?>packs/css/1-654f27ea.chunk.css"/>
    <link rel="stylesheet" media="screen" href="<?php echo base_url('assets/sistemas/leilofarma/');?>packs/css/app-cd01b012.chunk.css"/>
    <link rel="stylesheet" media="screen" href="<?php echo base_url('assets/sistemas/personalizado/css.css');?>"/>
    <link rel="stylesheet" media="all"
          href="<?php echo base_url('assets/sistemas/leilofarma/');?>assets/default-38342bb9850daf620b5dfc67a8956eecee7b7fe43daeef9c6d82a787bba15db6.css"
          data-turbolinks-track="true"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">

    <script>var DIR = '<?php echo base_url();?>';</script>
    <script src="<?php echo base_url('assets/sistemas/leilofarma/');?>assets/application-491d31dd539e320d96b227d87d651b59cb2b07dfa641d3472713972b8c4b8772.js"
            data-turbolinks-track="true"></script>




    <style>
        html.turbolinks-progress-bar::before{
            background: #eeaa10 !important;
        }

    </style>
    <script src="<?php echo base_url('assets/sistemas/leilofarma/');?>packs/js/runtime_app-80eaa8853a2f2436dc54.js" data-turbolinks-track="reload"></script>
    <script src="<?php echo base_url('assets/sistemas/leilofarma/');?>packs/js/vendor-429827aa82f6e8446c57.chunk.js" data-turbolinks-track="reload"></script>
    <script src="<?php echo base_url('assets/sistemas/leilofarma/');?>packs/js/1-a7ab7f36a26548fc01b5.chunk.js" data-turbolinks-track="reload"></script>
    <script src="<?php echo base_url('assets/sistemas/leilofarma/');?>packs/js/app-02fdef6215f7fe75d543.chunk.js" data-turbolinks-track="reload"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="<?php echo base_url('assets/sistemas/personalizado/js.js');?>"></script>

    <script>
        function sujestaoserach(valor) {
            $.ajax({
                url: '<?php echo base_url('AjaxDefault/keypress')?>',
                data: {valor:valor},
                type: 'POST',
                beforeSend: function () {

                },
                error: function (res) {

                    Command: toastr["error"]('Ocorreu um erro ao buscar a sujestão!');

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


                    if(data){

                        if(valor.length > 2){
                            $('#serchtyping').css('display','block');

                            $('#serchtyping ul').html(data);
                        }else{
                            $('#serchtyping').css('display','none');

                        }




                    }else{

                        Command: toastr["warning"]('Nenhuma sujestão encontrada!');

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

                        $('#serchtyping').css('display','none');

                    }


                }
            });
        }

    </script>
</head>
<body class="pages-home  " data-component="Ads" data-flash-alert="" data-flash-notice="">

<div data-vue-component="" data-name="FlashNotification" data-props="{}" data-raw-props="{}"></div>
<div class="search-bar-results"></div>
<div class="top-bar-container" data-component="TopBar" id="fixed-top-bar">
    <div class="container-fluid cr-grid h-xs-visible">
        <div class="top-bar__grid-row">



            <!-- Area da Logomarca -->

            <div class="top-bar__grid-col"><a class="top-bar__link-logo" data-no-turbolink="true" href="<?php echo base_url();?>"><img
                            class="top-bar__logo"  src="<?php echo base_url('web/imagens/'.$config['LOGOMARCA']);?>"
                            alt="Cr logo complete dark bg"/></a></div>


            <!-- Area da Comparação -->


            <!-- Area da Busca -->
            <div class="top-bar__grid-col--search-block top-bar__grid-col">
                <form method="post" action="javascript:sujestaoserach($('#categoriasearch').value);" class="search-bar-block search_form"
                      data-global-suggestions="/sugestoes?termo=%25QUERY">

                    <input type="text" name="search" class="search-camp" id="categoriasearch" placeholder="Busque por Produtos ou Medicamentos" onkeyup="sujestaoserach(this.value);">

                    <button type="submit" class="search-form"><i class="fa fa-search"></i></button>
                </form>

                <div id="serchtyping">
                    <ul>



                    </ul>

                </div>
            </div>



            <div class="menu-direito">

                <?php if($this->ModelDefault->session() == false):?>
                    <a href="<?php echo base_url('cadastrar');?>" class="cadastrar-header">Cadastrar</a>
                    <a href="<?php echo base_url('acessar');?>" class="acessar-header">Acessar</a>
                <?php else:?>

                    <a href="<?php echo base_url('minha-conta');?>" class="acessar-header">Minha Conta</a>
                    <a href="javascript:logout();" class="acessar-header">Sair</a>

                <?php endif;?>
                <a href="<?php echo base_url('carrinho');?>" class="carrinho-header"><i class="fa fa-2x fa-shopping-cart"></i>

                    <?php
                    if (isset($_SESSION['addcarrinho'])):
                        $explode = explode(',', $_SESSION['addcarrinho']);

                        $count = count($explode);

                    if ($count > 0):
                        ?>
                        <script> var contCard = <?php echo $count;?>; </script>

                        <span class="count-label"><?php echo $count; ?></span>

                    <?php else: ?>

                        <span class="count-label"></span>

                    <?php endif;
                    ?>

                    <?php else: ?>

                        <span class="count-label"></span>


                    <?php endif; ?>


                </a>
            </div>



            <!-- Area Mobile -->

            <div class="top-bar__grid-col hidden-md hidden-lg">
                <div class="top-bar__mobile-actions">



                    <!-- Area do Login Mobile -->

                    <div class="top-bar__mobile-action">

                        <div class="top-bar__logged-user dropdown">
                            <?php if($this->ModelDefault->session() == false):?>
                                <a class="top-bar__mobile-login-link" data-turbolinks="false" href="<?php echo base_url('acessar');?>">
                                    <i class="fa fa-user"></i>
                                </a>&nbsp;&nbsp;&nbsp;

                            <?php else:?>
                                <a class="top-bar__mobile-login-link" data-turbolinks="false" href="<?php echo base_url('minha-conta');?>">
                                    <i class="fa fa-user"></i>
                                </a>&nbsp;&nbsp;&nbsp;

                            <?php endif;?>
                            <a class="top-bar__mobile-login-link" data-turbolinks="false" href="<?php echo base_url('carrinho');?>">
                                <i class="fa fa-shopping-cart"></i>
                                <?php
                                if (isset($_SESSION['addcarrinho'])):
                                    $explode = explode(',', $_SESSION['addcarrinho']);

                                    $count = count($explode);

                                if ($count > 0):
                                    ?>
                                    <script> var contCard = <?php echo $count;?>; </script>

                                    <span class="count-label"><?php echo $count; ?></span>

                                <?php else: ?>

                                    <span class="count-label"></span>

                                <?php endif;
                                ?>

                                <?php else: ?>

                                    <span class="count-label"></span>


                                <?php endif; ?>

                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="content-footer-wrapper" style="margin-top: -20px;">