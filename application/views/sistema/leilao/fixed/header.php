<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bolsa de Leilões</title>

    <link href="<?php echo base_url('assets/sistemas/leilao/');?>plugins/jquery-ui/jquery-ui.css" rel="stylesheet">
    <link href="<?php echo base_url('assets/sistemas/leilao/');?>plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url('assets/sistemas/leilao/');?>plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url('assets/sistemas/leilao/');?>plugins/selectbox/select_option1.css" rel="stylesheet">
    <link href="<?php echo base_url('assets/sistemas/leilao/');?>plugins/fancybox/jquery.fancybox.min.css" rel="stylesheet">
    <link href="<?php echo base_url('assets/sistemas/leilao/');?>plugins/iziToast/css/iziToast.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/sistemas/leilao/');?>plugins/rs-plugin/css/settings.css" media="screen">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/sistemas/leilao/');?>plugins/slick/slick.css" media="screen">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/sistemas/leilao/');?>plugins/slick/slick-theme.css" media="screen">

    <link rel="stylesheet" href="<?php echo base_url('assets/sistemas/personalizado/');?>css.css">

    <link href="<?php echo base_url('assets/sistemas/leilao/');?>css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('assets/sistemas/leilao/');?>css/default.css" id="option_color">

    <link rel="shortcut icon" href="<?php echo base_url('web/imagens/'.$config['FAVICON']);?>" />
    <script>
        var datadoserver = '<?php echo !empty($lote['data_acrescimo']) ? date('Y-m-d H:i:s',strtotime($lote['data_acrescimo'].' + 1 hour')) : date('Y-m-d H:i:s',strtotime($lote['data_fim'].' + 1 hour'));?>';
        var idlote = '<?php echo $lote['id'];?>';
    </script>


    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <script src="<?php echo base_url('assets/sistemas/leilao/');?>plugins/jquery/jquery.min.js"></script>

    <script src="<?php echo base_url('assets/sistemas/leilao/');?>plugins/jquery/jquery-migrate-3.0.0.min.js" type="d41b71007e2c37a873dcb9ba-text/javascript"></script>
    <script src="<?php echo base_url('assets/sistemas/leilao/');?>plugins/jquery-ui/jquery-ui.js" type="d41b71007e2c37a873dcb9ba-text/javascript"></script>
    <script src="<?php echo base_url('assets/sistemas/leilao/');?>plugins/bootstrap/js/popper.min.js" type="d41b71007e2c37a873dcb9ba-text/javascript"></script>
    <script src="<?php echo base_url('assets/sistemas/leilao/');?>plugins/bootstrap/js/bootstrap.min.js" type="d41b71007e2c37a873dcb9ba-text/javascript"></script>
    <script src="<?php echo base_url('assets/sistemas/leilao/');?>plugins/rs-plugin/js/jquery.themepunch.tools.min.js" type="d41b71007e2c37a873dcb9ba-text/javascript"></script>
    <script src="<?php echo base_url('assets/sistemas/leilao/');?>plugins/rs-plugin/js/jquery.themepunch.revolution.min.js" type="d41b71007e2c37a873dcb9ba-text/javascript"></script>
    <script src="<?php echo base_url('assets/sistemas/leilao/');?>plugins/slick/slick.js" type="d41b71007e2c37a873dcb9ba-text/javascript"></script>
    <script src="<?php echo base_url('assets/sistemas/leilao/');?>plugins/fancybox/jquery.fancybox.min.js" type="d41b71007e2c37a873dcb9ba-text/javascript"></script>
    <script src="<?php echo base_url('assets/sistemas/leilao/');?>plugins/iziToast/js/iziToast.js" type="d41b71007e2c37a873dcb9ba-text/javascript"></script>
    <script src="<?php echo base_url('assets/sistemas/leilao/');?>plugins/prismjs/prism.js" type="d41b71007e2c37a873dcb9ba-text/javascript"></script>
    <script src="<?php echo base_url('assets/sistemas/leilao/');?>plugins/selectbox/jquery.selectbox-0.1.3.min.js" type="d41b71007e2c37a873dcb9ba-text/javascript"></script>
    <script src="<?php echo base_url('assets/sistemas/leilao/');?>plugins/countdown/jquery.syotimer.js" type="d41b71007e2c37a873dcb9ba-text/javascript"></script>
    <script src="<?php echo base_url('assets/sistemas/leilao/');?>plugins/velocity/velocity.min.js" type="d41b71007e2c37a873dcb9ba-text/javascript"></script>
    <script src="<?php echo base_url('assets/sistemas/leilao/');?>js/custom.js" type="d41b71007e2c37a873dcb9ba-text/javascript"></script>

    <script src="<?php echo base_url('assets/sistemas/leilao/');?>ajax.cloudflare.com/cdn-cgi/scripts/95c75768/cloudflare-static/rocket-loader.min.js" data-cf-settings="d41b71007e2c37a873dcb9ba-|49" defer=""></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.countdown/2.2.0/jquery.countdown.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment-with-locales.min.js"></script>
    <script>var DIR = '<?php echo base_url();?>';</script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.4.0/moment-timezone-with-data-2010-2020.min.js"></script>
    <script src="<?php echo base_url('assets/sistemas/personalizado/');?>js.js"></script>
        <?php if(isset($_GET['enviar_docs'])): ?>
    <style>
        @keyframes shadow-pulse
        {
            0% {
                box-shadow: 0 0 0 0px rgba(0, 0, 0, 0.2);
            }
            100% {
                box-shadow: 0 0 0 35px rgba(0, 0, 0, 0);
            }
        }
        .example-1
        {
            animation: shadow-pulse 1s infinite;
        }

    </style>
    <?php endif; ?>
    <?php if(isset($page) and $page == 'lote' and $lote['stats'] == 0):?>
        <script>

             // Obtém a data/hora atual
        var data = new Date();

        // Guarda cada pedaço em uma variável
        var dia     = data.getDate();           // 1-31
        var dia_sem = data.getDay();            // 0-6 (zero=domingo)
        var mes     = data.getMonth();          // 0-11 (zero=janeiro)
        var ano2    = data.getYear();           // 2 dígitos
        var ano4    = data.getFullYear();       // 4 dígitos
        var hora    = data.getHours();          // 0-23
        var min     = data.getMinutes();        // 0-59
        var seg     = data.getSeconds();        // 0-59
        var mseg    = data.getMilliseconds();   // 0-999
        var tz      = data.getTimezoneOffset(); // em minutos

        // Formata a data e a hora (note o mês + 1)
        var str_data = dia + '/' + (mes+1) + '/' + ano4;
        var str_hora = hora + ':' + min + ':' + seg;


function checkstimelocal(){


                               


}


            function checktime(){
                if(contagem === '0000'){

                    $("#lancevalues").val('');

                    atualizar_lote(0,<?php echo $lote['id']?>);

                    if(contagem === '0000') {

                        $("#blocksdisplays").css("display","block");

                        $("#clock").html("<img src='<?php echo base_url('web/clock.gif')?>' style='width:50px;'> Registrando");

                        $.ajax({
                            url:'<?php echo base_url('')?>/AjaxDefault/homologar_lote',
                            data: {lote: <?php echo $lote['id']?>},
                            type: 'POST',
                            beforeSend: function () {

                                timeout = setTimeout(function () { // quando o timer for disparado...
                                    timeout = false; // ... apagamos sua referência ...
                                    $("#clock").html("<img src='<?php echo base_url('web/clock.gif')?>' style='width:40px;'> Homologando");

                                }, 200);

                            },
                            error: function (res) {
                                timeout = setTimeout(function () { // quando o timer for disparado...
                                    timeout = false; // ... apagamos sua referência ...
                                    $("#clock").html("<i class='fa fa-2x fa-times text-danger'></i> Erro");

                                }, 2000);


                            },
                            success: function (data) {



                                if(data == 0){


                                    timeout = setTimeout(function () { // quando o timer for disparado...
                                        timeout = false; // ... apagamos sua referência ...
                                        $("#clock").html("<i class='fa fa-2x fa-times text-danger'></i> Erro");

                                    }, 2000);
                                }else{

                                    timeout = setTimeout(function () { // quando o timer for disparado...
                                        timeout = false; // ... apagamos sua referência ...
                                        $("#clock").html("<i class='fa fa-2x fa-check-circle text-success'></i> Sucesso");



                                    }, 2000);


                                }



                            }
                        });



                    }

                }else{




                    setTimeout(function(){ checktime(); }, 1000);

                }



            }
        </script>

        <?php if(date('d/m/Y') == date('d/m/Y',strtotime($lote['data_fim']))): ?>
        <script>
            $(document).ready(function() {

                iniciarcronometro(datadoserver);

                <?php  if(date('Y-m-d') == date('Y-m-d',strtotime($lote['data_fim']))): ?>

                atualizar_lote(0,idlote,1);
                checktime();
                checkstimelocal();
                <?php endif;?>
            });
        </script>
    <?php else:?>
        <script>
            $(document).ready(function() {

                var nextYear = moment.tz(datadoserver, "America/Sao_Paulo");

                $('#clock').countdown(nextYear.toDate(), function(event) {
                    $(this).html(event.strftime('%D dias %H:%M:%S'));


                });

            });
        </script>
    <?php endif; endif;?>


</head>

<body class="body-wrapper">
<?php
$url = $this->uri->segment(1);

if(empty($url)):
?>
<!--
<div id="preloader" class="smooth-loader-wrapper">
    <div class="preloader_container">
        <div class="block"></div>
        <div class="block"></div>
        <div class="block"></div>
        <div class="block"></div>
        <div class="block"></div>
        <div class="block"></div>
        <div class="block"></div>
        <div class="block"></div>
        <div class="block"></div>
        <div class="block"></div>
        <div class="block"></div>
        <div class="block"></div>
        <div class="block"></div>
        <div class="block"></div>
        <div class="block"></div>
        <div class="block"></div>
    </div>
</div>-->
<?php endif;?>
<div class="main-wrapper">

    <div class="header clearfix headerV3">

        <!-- TOPBAR -->
        <div class="topBar" style="background: #990000!important;color: white!important;">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 d-none d-md-block">
                        <ul class="list-inline" style="color:white!important;">
                            <li><a href="https://www.facebook.com/bolsadeleiloesbrasil/" target="_blank"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="https://www.instagram.com/bolsadeleiloes/" target="_blank"><i class="fa fa-instagram"></i></a></li>
                        </ul>
                    </div>
                    <div class="col-md-6 col-12">
                        <ul class="list-inline float-right top-right">
                            <?php if ($this->ModelDefault->session() == false):?>
                            <li class="account-login"><span><a data-toggle="modal" href='#login'>Entrar</a><small>ou</small><a data-toggle="modal" href='#signups'>Cadastre-se</a></span></li>
                            <?php else:?>
                             <li class="account-login"><span><a href='<?php echo base_url('minha-conta');?>'>Minha Conta</a><small>ou</small><a href="javascript:logout();">Logout</a></span></li>
                            <?php endif;?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- NAV TOP -->
        <div class="navTop text-center">
            <div class="container">

                <a class="navbar-brand" href="<?php echo base_url('');?>">
                  <img src="<?php echo base_url('web/imagens/'.$config['LOGOMARCA']);?>">
                </a>

                <div class="navTop-middle">
                    <div class="filterArea d-none d-lg-block">
                        <select name="guiest_id1" id="guiest_id1" class="select-drop">
                            <option value="all">Todos os Comitentes</option>

                            <?php
                            foreach ($comitentes as $value){
                            ?>
                            <option value="<?php echo $value['id'];?>"><?php echo $value['nome'];?></option>
                            <?php }?>
                        </select>
                    </div>
                    <div class="searchBox">
                <span class="input-group">
                  <input id="searchbox" type="text" class="form-control" placeholder="O que você procura?" aria-describedby="basic-addon2">
                  <button id="searchButton" type="submit" class="input-group-addon"><i class="fa fa-search"></i></button>
                </span>
                    </div>
                </div>

            </div>
        </div>
        <?php if(isset($banners) and count($banners) > 0):?>
        <!-- NAVBAR -->
        <nav class="navbar navbar-main navbar-default navbar-expand-md nav-V3" role="navigation">
            <div class="container">

                <div class="nav-category dropdown">
                    <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        Categorias
                        <button type="button">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-left">

                        <?php foreach ($categorias as $item){?>
                        <li><a <?php if(!empty($item['link'])): echo 'href="'.$item['link'].'" target="_blank"'; endif;?>><i class="lnr lnr-camera" aria-hidden="true"></i><?php echo $item['nome'];?></a></li>
                        <?php }?>

                        <?php if(@$banner_lateral):?>

                        <li><a <?php if(!empty($banner_lateral['link'])): echo 'href="'.$banner_lateral['link'].'" '; endif;?>><img src="<?php echo base_url('web/imagens/'.$banner_lateral['image']);?>" alt="<?php echo $banner_lateral['nome'];?>"></a></li>

                        <?php else:?>
                            <li><a></a></li>


                        <?php endif;?>
                    </ul>
                </div>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbar-ex1-collapse" aria-controls="navbar-ex1-collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="fa fa-bars"></span>
                </button>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav">
                        <li class="nav-item active">
                            <a href="<?php echo base_url('');?>" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Inicio</a>
                        </li>

                        <li class="nav-item">
                            <a href="<?php echo base_url('quem-somos');?>" class="nav-link" >Quem Somos</a>
                        </li>


                        <li class="nav-item">
                            <a href="mailto:atendimento@bolsadeleiloes.com.br" class="nav-link">Fale Conosco</a>
                        </li>
                        <li class="nav-item">
                                <a href="<?php echo base_url('como-funciona');?>"  class="nav-link">Como Funciona</a>
                        </li>




                    </ul>
                </div><!-- /.navbar-collapse -->


            </div>
        </nav>
        <?php endif;?>

    </div>
<?php if(isset($banners) and count($banners) > 0):?>
    <div class="container">
        <div class="row justify-content-md-end">
            <div class="col-sm-12 ml-auto bannercontainer ">
                <div class="fullscreenbanner-container bannerV4">
                    <div class="fullscreenbanner">
                        <ul>

<?php foreach ($banners as $item) { ?>
                            <li data-transition="slidehorizontal" data-slotamount="5" data-masterspeed="700" data-title="Slide 1">
                                <img src="<?php echo base_url('web/imagens/'.$item['image']);?>" style="height: 100px!important;" alt="slidebg1" data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat">

                            </li>
<?php }?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php else:?>
        <br>
    <?php endif;?>
