<nav id="mainnav-container">
    <div id="mainnav">

        <div id="mainnav-menu-wrap">
            <div class="nano">
                <div class="nano-content">


                    <div id="mainnav-profile" class="mainnav-profile">
                        <div class="profile-wrap text-center">

                            <a href="#profile-nav" class="box-block" data-toggle="collapse" aria-expanded="false">
                                            <span class="pull-right dropdown-toggle">
                                                <i class="dropdown-caret"></i>
                                            </span>
                                <p class="mnp-name"><?php echo $admin['nome'];?></p>
                                <span class="mnp-desc"><?php echo $admin['email'];?></span>
                                <br>
                                <a href="<?php echo base_url('')?>" target="_blank" class="mnp-desc">Visitar Site</a>
                            </a>
                        </div>
                        <div id="profile-nav" class="collapse list-group bg-trans">
                            <a href="#"  data-toggle="modal" data-target="#alteracaoperfil" class="list-group-item">
                                <i class="demo-pli-male icon-lg icon-fw"></i> Ver Perfil
                            </a>

                            <?php if($this->Model->session_empresa() == true):?>
                            <a href="<?php echo base_url('contato')?>" target="_blank" class="list-group-item">
                                <i class="demo-pli-information icon-lg icon-fw"></i> Ajuda
                            </a>
                            <?php endif;?>

                            <?php if($this->Model->session_empresa() == true):?>
                                <a href="javascript:logout_empresa();" class="list-group-item">
                                    <i class="demo-pli-unlock icon-lg icon-fw"></i> Logout
                                </a>

                            <?php else:?>
                                <a href="javascript:logout();" class="list-group-item">
                                    <i class="demo-pli-unlock icon-lg icon-fw"></i> Logout
                                </a>
                            <?php endif;?>

                        </div>
                    </div>



                    <div id="mainnav-shortcut" class="">
                        <ul class="list-unstyled shortcut-wrap" style="text-align: center;">

                            <li class="col-xs-12" data-content="Bloquear Tela ">
                                <a class="shortcut-grid" href="#">
                                    <div class="icon-wrap icon-wrap-sm icon-circle bg-purple">
                                        <i class="demo-pli-lock-2"></i>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>



                    <ul id="mainnav-menu" class="list-group">


                        <?php
                        $number = 0;

                        foreach ($menu_categoria as $value){




                        ?>

                        <li class="list-header"><?php echo $value['nome']?></li>


                            <?php
                            $this->db->from('menu_admin');
                            $this->db->where('categoria',$value['id']);
                            $this->db->where('status_menu',1);
                            $this->db->where('status',1);
                            $this->db->where('sub_id',0);
                            $this->db->order_by('ordem','desc');
                            $get = $this->db->get();
                            $menu = $get->result_array();
                            foreach ($menu as $values){
                               echo $this->Model->menu_admin($values,$number);
                                $number++;
                            }

                            ?>


                        <li class="list-divider"></li>


                        <?php } ?>

                    </ul>



                    <?php //echo $this->Model->monitor_rodape();?>


                </div>
            </div>
        </div>

    </div>
</nav>

</div>
<?php if($this->Model->session_empresa() == true):?>
<div class="modal fade" id="alteracaoperfil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Dados do Perfil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php
            $this->db->from('empresas');
            $this->db->where('id',$_SESSION['ID_EMPRESA']);
            $get = $this->db->get();
            $empresa = $get->result_array()[0];
            ?>
            <div class="modal-body">
                <form method="post" id="formempresaperfil">
                    <label> Nome da Empresa </label>
                    <input type="text" name="nome" value="<?php echo $empresa['nome']?>" class="form-control" />


                    <label> E-mail </label>
                    <input type="text" name="email" value="<?php echo $empresa['email']?>" class="form-control" />

                    <label> Telefone </label>
                    <input type="text" name="telefone" value="<?php echo $empresa['telefone']?>" class="form-control" />

                    <label> Xml dos Produtos </label>
                    <input type="text" name="xml_url" value="<?php echo $empresa['xml_url']?>" class="form-control" />

                    <label> Senha </label>
                    <input type="password" name="pass"  class="form-control" />


                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" onclick="salvePerfilEmpresa();" class="btn btn-primary">Salvar Alterações</button>
            </div>
        </div>
    </div>
</div>
<?php endif;?>
<footer id="footer" style="display: none;">

    <div class="show-fixed pad-rgt pull-right">
        You have <a href="#" class="text-main"><span class="badge badge-danger">3</span> pending action.</a>
    </div>




    <div class="hide-fixed pull-right pad-rgt">
        Versão <b>0.1 ALPHA</b>
    </div>



    <p class="pad-lft">&#0169; <?php echo date('Y');?> <a href="https://jdlsites.com" target="_blank">Agência JDL</a></p>



</footer>


<button class="scroll-top btn">
    <i class="pci-chevron chevron-up"></i>
</button>
</div>
<script>var DIR = '<?php echo base_url('')?>';</script>
<script src="<?php echo base_url('assets/codes/') ?>js/jquery.min.js"></script>


<script src="<?php echo base_url('assets/codes/') ?>js/bootstrap.min.js"></script>


<script type='text/javascript' src='https://cdn.jsdelivr.net/npm/froala-editor@3.0.0-rc.2/js/froala_editor.pkgd.min.js'></script>


<script src="<?php echo base_url('assets/codes/') ?>js/nifty.min.js"></script>




<script src="<?php echo base_url('assets/codes/') ?>js/demo/nifty-demo.min.js"></script>


<script src="<?php echo base_url('assets/codes/') ?>plugins/flot-charts/jquery.flot.min.js"></script>
<script src="<?php echo base_url('assets/codes/') ?>plugins/flot-charts/jquery.flot.resize.min.js"></script>
<script src="<?php echo base_url('assets/codes/') ?>plugins/flot-charts/jquery.flot.tooltip.min.js"></script>


<script src="<?php echo base_url('assets/codes/') ?>plugins/sparkline/jquery.sparkline.min.js"></script>


<script src="<?php echo base_url('assets/codes/') ?>js/demo/dashboard.js"></script>
<script src="<?php echo base_url('assets/codes/') ?>js/scripts.js"></script>


<script src="<?php echo base_url('assets/codes/') ?>plugins/datatables/media/js/jquery.dataTables.js"></script>
<script src="<?php echo base_url('assets/codes/') ?>plugins/datatables/media/js/dataTables.bootstrap.js"></script>
<script src="<?php echo base_url('assets/codes/') ?>plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable( {
            dom: 'Bfrtip',
            buttons: [{
                extend: 'csv',
                charset: 'UTF-8',
                fieldSeparator: ';',
                bom: true,
                filename: 'RelatorioLeilão-<?php echo date('d/m/Y');?>',
                title: 'RelatorioLeilão'

            }
            ]
        } );
    } );

</script>

<script>
var DIR = '<?php echo base_url('')?>';
    function submit_files(extensao,val) {

        alert(extensao);
    }


function alterar_pass() {
        $("#brnaltera").remove();
    $("#passAlterarsss").html('<div class="form-group" style="float: left;width: 30%;margin-left: 20px">\n' +
        '                        <label for="recipient-name" class="control-label">NOVA SENHA:</label>\n' +
        '                        <input type="password" class="form-control pass" name="pass" id="pass">\n' +
        '                    </div>');
}



    function starlote(id,acao) {

        $.ajax({
            url: DIR+'Ajax/stars',
            data: {id:id,acao:acao},
            type: 'POST',
            beforeSend: function () {
            },
            error: function (res) {

            },
            success: function (data) {

                if(data == 11){

                    if(acao == 1){
                        $("#star"+id).html("<a href=\"javascript:starlote("+id+",0);\" class=\"btn btn-default btn-warning\" style=\"margin-top: 8px;\"><i class=\"fas fa-star text-warning\"></i> Remover Destaque</a>");

                    }else{

                        $("#star"+id).html("<a href=\"javascript:starlote("+id+",1);\" class=\"btn btn-default\" style=\"margin-top: 8px;\"><i class=\"far fa-star\"></i> Destaque</a>");

                    }

                }
            }

        });

    }


    function enviartermos(leilao,lote) {
        $.ajax({
            url: DIR+'Ajax/enviar_termo',
            data: {leilao:leilao,lote:lote},
            type: 'POST',
            beforeSend: function () {
            },
            error: function (res) {

            },
            success: function (data) {

                if(data == 11){

                    alert('Termo Enviado com Sucesso');

                }else{

                    alert('Erro ao Enviar Termo');

                }
            }

        });
    }

</script>
</body>

</html>

