<!DOCTYPE html>
<html lang="pt-br">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Login</title>


    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>


    <link href="<?php echo base_url('assets/codes/') ?>css/bootstrap.min.css" rel="stylesheet">


    <link href='https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css' rel='stylesheet' type='text/css'>


    <link href="<?php echo base_url('assets/codes/') ?>css/nifty.min.css" rel="stylesheet">


    <link href="<?php echo base_url('assets/codes/') ?>css/demo/nifty-demo-icons.min.css" rel="stylesheet">


    <link href="<?php echo base_url('assets/codes/') ?>plugins/pace/pace.min.css" rel="stylesheet">
    <script src="<?php echo base_url('assets/codes/') ?>plugins/pace/pace.min.js"></script>


    <link href="<?php echo base_url('assets/codes/') ?>css/demo/nifty-demo.min.css" rel="stylesheet">

    <script> var DIR = '<?php echo base_url();?>';</script>

</head>


<body>
<div id="container" class="cls-container">


    <div id="bg-overlay"></div>


    <div class="cls-content">
        <div class="cls-content-sm panel">
            <div class="panel-body">
                <div class="mar-ver pad-btm">
                    <h1 class="h3">Acessar Area Restrita</h1>
                </div>
                <form action="javascript:login();">

                    <?php
                    if(isset($empresa) and $empresa == 1):
                    echo '<input type="hidden" name="empresaLogin" value="1">';
                    endif;
                    ?>

                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Usuario" name="user" autofocus>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="pass" placeholder="Senha">
                    </div>
                    <div class="checkbox pad-btm text-left">
                        <input id="demo-form-checkbox" class="magic-checkbox" type="checkbox">
                        <label for="demo-form-checkbox">Manter Logado</label>
                    </div>
                    <button class="btn btn-primary btn-lg btn-block" type="submit">Acessar</button>
                </form>
            </div>

            <div class="pad-all">
                <a href="javascript:recupera_senha();" class="btn-link mar-rgt">Esqueceu a Senha ?</a>


            </div>
        </div>
    </div>




</div>


<script src="<?php echo base_url('assets/codes/') ?>js/jquery.min.js"></script>


<script src="<?php echo base_url('assets/codes/') ?>js/bootstrap.min.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


<script src="<?php echo base_url('assets/codes/') ?>js/nifty.min.js"></script>


<script src="<?php echo base_url('assets/codes/') ?>js/demo/bg-images.js"></script>

<script>

    function login(){

        var form = $('form').serialize();
        $.ajax({
            url: '<?php echo base_url('Ajax/login')?>',
            data: form,
            type: 'POST',
            beforeSend: function () {

            },
            error: function (res) {
                toastr.error("Ocorreu um erro ao processar a solicitação", "ATENÇÃO", {
                    "timeOut": "0",
                    "extendedTImeout": "0"
                });
            },
            success: function (data) {

                if(data == 11){
                    window.location.reload();
                }else{

                    toastr.error(data, "ATENÇÃO", {
                        "timeOut": "0",
                        "extendedTImeout": "0"
                    });

                }



            }
        });

    }


</script>
</body>

</html>
