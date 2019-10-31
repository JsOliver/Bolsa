<section class="section white-backgorund">
    <div class="container">

        <div class="row" style="margin-top: 30px;margin-bottom: 50px;">
            <!-- start sidebar -->
            <div class="col-sm-3">
                <div class="widget">
                    <figure>
                        <a href="javascript:void(0);">
                        </a>
                    </figure>
                </div><!-- end widget -->
            </div><!-- end col -->
            <!-- end sidebar -->
            <div class="col-sm-9">
                <div class="row">
                    <div class="col-sm-12 text-left">
                        <h2 style="margin-top:20px;" class="title">Entrar em Minha Conta</h2>
                    </div><!-- end col -->
                </div><!-- end row -->

                <div class="row">
                    <div class="col-sm-12 col-md-10 col-lg-8">

                        <?php
                        if(isset($_GET['redefinirToken']) and !empty($_GET['redefinirToken'])):

                            $this->db->from('recupera_senha');
                            $this->db->where('token',$_GET['redefinirToken']);
                            $this->db->where('validade >',date('d/m/Y H:i:s'));
                            $get = $this->db->get();
                            $count = $get->num_rows();
                        if($count > 0):
                            $result = $get->result_array();
                            ?>

                            <form id="emailRedefinirNow" class="form-horizontal" method="post" action="javascript:redefinirAgora();" style="margin-bottom: 100px;">

                                <input type="hidden" name="email" value="<?php //echo $result[0]['email']?>">

                                <div class="form-group">
                                    <div class="col-sm-10">
                                        <label for="password">Nova Senha</label>

                                        <input type="password" class="form-control input-md" name="npass" id="npass" placeholder="Nova Senha">
                                    </div>
                                </div><!-- end form-group -->

                                <div class="form-group">
                                    <div class="col-sm-10">
                                        <label for="password">Repita a Nova Senha</label>

                                        <input type="password" class="form-control input-md" name="npassagain" id="npassagain" placeholder="Repita a Nova Senha">
                                    </div>
                                </div><!-- end form-group -->

                                <div class="form-group" style="padding-left: 15px;">
                                        <a href="javascript:redefinirAgora();" class="btn btn-default round btn-md"><i class="fa fa-lock mr-5"></i> Redefinir Senha</a>
                                </div><!-- end form-group -->
                            </form>

                        <?php else:?>
                            <h1 style="text-align: center;">Link EXPIRADO</h1>
                        <?php endif;  else:?>

                            <form class="form-horizontal" method="post" action="javascript:login();">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label for="email">Email</label>

                                        <input type="email" class="form-control input-md" name="email" id="email" placeholder="Email">
                                    </div>
                                </div><!-- end form-group -->
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label for="password">Senha</label>

                                        <input type="password" class="form-control input-md" name="pass" id="pass" placeholder="Senha">
                                    </div>
                                    <div class="col-sm-12">
                                        <a href="javascript:login();" class="btn btn-default round btn-md" style="margin-top: 20px; width:100%; background: #ec7000!important; border-color: #ec7000!important; color: #fff; "> Entrar</a>
                                    </div>
                                </div><!-- end form-group -->
                                <div class="form-group" style="padding-left: 15px;">
                                        <label><a style="cursor: pointer; text-decoration: none; color:#505050;" data-toggle="modal" data-target=".myModalMedium">Esqueceu sua senha?</a></label>
                                </div><!-- end form-group -->

                                <div class="modal fade myModalMedium" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" style="position:absolute; right:5%; top:5%;" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <div class="row">
                                                    <div class="col-sm-10 col-sm-offset-1">
                                                        <div class="icon-boxes style1">
                                                            <div class="box-content">
                                                                <h6 class="Title" style="font-size:20px; font-family: sans-serif;">Resetar minha senha</h6>
                                                                <p class="text-gray">Esqueceu sua senha? Não tem problema, informe seu e-mail e nós enviaremos um link para redefini-la.</p>
                                                            </div>
                                                        </div><!-- icon-box -->
                                                    </div><!-- end col -->
                                                </div><!-- end row -->
                                            </div><!-- end modal-header -->
                                            <div class="modal-body">
                                                <div class="row">

                                                    <div class="col-sm-8">
                                                        <input type="text" id="emailRedefinir" name="emailRedefinir" class="form-control input-md" placeholder="E-mail">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <a  class="btn btn-default btn-block round btn-md" style="background: #ec7000; border-color: #ec7000; color: white;" onclick="redefinir_senha();">Redefinir</a>
                                                    </div>



                                                </div><!-- end row -->
                                            </div><!-- end modal-body -->
                                        </div><!-- end modal-content -->
                                    </div><!-- end modal-dialog -->
                                </div><!-- end Modal Medium -->

                                <div class="form-group col-sm-12" style="text-align:center;"><a style="text-decoration: none;" href="<?php echo base_url('cadastrar')?>">Não é cadastrado? Cadastre-se AQUI.</a></div><!-- end form-group -->
                            </form>




                        <?php endif; ?>
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end col -->
        </div>


    </div>
