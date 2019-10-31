<div class="boxed" id="navigationViewAerea">

    <div id="content-container">
        <div id="page-head" >

            <?php
            if(isset($_SESSION['ID_EMPRESA']) and !isset($_SESSION['ID_ADMIN'])):
                $this->db->from('empresas');
                $this->db->where('id',$_SESSION['ID_EMPRESA']);

            else:
            $this->db->from('administrador');
            $this->db->where('id',$_SESSION['ID_ADMIN']);
            endif;
            $get = $this->db->get();

            $admin = $get->result_array()[0];
            ?>
            <div class="pad-all text-center">
                <h3>Bem Vindo, <?php echo $admin['nome'];?>.</h3>
                <p><?php echo $this->Model->frases_motivacionais()?>.</p>
            </div>
        </div>



        <div id="page-content">

            <div class="row">
                <div class="col-lg-7">

                    <div id="demo-panel-network" class="panel">
                        <div class="panel-heading">
                          <!--  <div class="panel-control">
                                <button onclick="reload();" class="btn btn-default btn-active-primary" data-toggle="panel-overlay" data-target="#demo-panel-network"><i class="demo-psi-repeat-2"></i></button>
                                <div class="dropdown">
                                    <button class="dropdown-toggle btn btn-default btn-active-primary" data-toggle="dropdown" aria-expanded="false"><i class="demo-psi-dot-vertical"></i></button>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="#">Relatorio Geral</a></li>
                                        <li><a href="#">Relatorio Financeiro</a></li>
                                        <li><a href="#">Ações de Marketing</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">Configurações de Coleta de Dados</a></li>
                                    </ul>
                                </div>
                            </div>-->
                            <h3 class="panel-title">Gráfico de lances dos ultimos 50 dias</h3>
                        </div>


                        <div class="pad-all">
                            <div id="demo-chart-network" style="height: 255px"></div>
                        </div>


                        <div class="panel-body">

                            <div class="row">
                                <div class="col-lg-8">
                                    <p class="text-semibold text-uppercase text-main">Lances Totais</p>
                                    <div class="row">
                                        <div class="col-xs-5">
                                            <div class="media">
                                                <div class="media-left">
                                                    <span class="text-3x text-thin text-main"><?php echo $pedido_resumo_diario[0]['total_intencoes'];?></span>
                                                </div>

                                            </div>
                                        </div>

                                    </div>

                                    <hr>

                                    <div class="pad-rgt">
                                        <p class="text-semibold text-uppercase text-main">Frase do Dia</p>
                                        <p class="text-muted mar-top"><?php echo $this->Model->frase_do_dia()?></p>
                                    </div>
                                </div>



                                <div class="col-lg-4">

                                    <p class="text-uppercase text-semibold text-main">Lances Diarios</p>

                                    <?php echo $this->Model->charts('','media_pedidos','dashboard_under_day',$pedido_resumo_diario);?>

                                </div>
                            </div>
                        </div>


                    </div>


                </div>
                <div class="col-lg-5">
                    <div class="row">

                        <?php //echo $this->Model->cols_sm('Earning','6');?>
                        <?php // echo $this->Model->cols_sm('Sales','6');?>


                    </div>


                    <?php if($this->Model->session_empresa() == false): echo $this->Model->usages('new-users',$pedido_resumo_diario[0]); endif;?>




                    <div class="panel" style="display: none;">
                        <div class="panel-body text-center clearfix">
                            <form method="get" action="<?php if($this->Model->session_empresa() == false): echo base_url('painel'); else: echo base_url('empresa'); endif;?>">

                                <?php
                                if(!isset($_GET['dataini'])):
                                    $default_value = date("Y-m-d", strtotime(date("Y-m-d") . "-1 days"));
                                else:
                                    $default_value = $_GET['dataini'];
                                endif;


                                if(!isset($_GET['datafim'])):
                                    $default_value1 = date('Y-m-d');

                                else:
                                    $default_value1 = $_GET['datafim'];

                                endif;
                                ?>

                                <?php if($this->Model->session_empresa() == false):?>

                                <div class="col-sm-6 pad-top">

                                  <label>Data Inicial:   </label>
                                  <input type="date" class="form-control" name="dataini" value="<?php echo $default_value;?>"/>
                            </div>
                            <div class="col-sm-6 pad-top">
                                  <label>Data Final:   </label>
                                  <input type="date" class="form-control" name="datafim" value="<?php echo $default_value1;?>"/>
                            </div>

                                <?php else:?>
                                    <div class="col-sm-5 pad-top">

                                        <label>Data Inicial:   </label>
                                        <input type="date" class="form-control" name="dataini" value="<?php echo $default_value;?>"/>
                                    </div>
                                    <div class="col-sm-5 pad-top">
                                        <label>Data Final:   </label>
                                        <input type="date" class="form-control" name="datafim" value="<?php echo $default_value1;?>"/>
                                    </div>


                                    <div class="col-sm-2 pad-top">
                                        <button class="btn btn-primary" style="margin-top: 23px;">Filtrar</button>
                                    </div>
                                <?php endif;?>

                                <?php if($this->Model->session_empresa() == false):?>
                                <div class="col-sm-10 pad-top">

                                    <select class="form-control" name="empresa">

                                        <option value="">Selecione o parceiro</option>

                                        <?php
                                        $this->db->from('empresas');
                                        $this->db->where('status',1);
                                        $get = $this->db->get();
                                        $count = $get->num_rows();

                                        if($count > 0):

                                            $results = $get->result_array();

                                        foreach ($results as $value){

                                            if(isset($_GET['empresa']) and $_GET['empresa'] == $value['id']):


                                                echo ' <option value="'.$value['id'].'" selected>'.$value['nome'].'</option>';


                                            else:

                                                    echo ' <option value="'.$value['id'].'">'.$value['nome'].'</option>';


                                            endif;


                                        }

                                        endif;

                                        ?>

                                    </select>

                                </div>

                                    <div class="col-sm-2 pad-top">
                                        <button class="btn btn-primary">Filtrar</button>
                                    </div>

                                <?php endif;?>


                            </form>


                            <div class="clearfix"></div>
                            <br>
                            <br>

                            <?php
                            $this->db->from('clique_produtos');
                            $this->db->where('data >=',date("d/m/Y", strtotime($default_value)));
                            $this->db->where('data <=',date("d/m/Y", strtotime($default_value1)));
                            if(isset($_GET['empresa']) and !empty($_GET['empresa'])):
                            $this->db->where('empresa',$_GET['empresa']);
                            elseif(isset($_SESSION['ID_EMPRESA']) and $_SESSION['ID_EMPRESA']):
                                $this->db->where('empresa',$_SESSION['ID_EMPRESA']);
                            endif;
                            $get = $this->db->get();
                            $count = $get->num_rows();
                            ?>
                            <div class="col-sm-4 pad-top">
                                <div class="text-lg">
                                    <p class="text-5x text-thin text-main"><?php echo number_format($count);?></p>
                                </div>
                                <p class="text-sm text-bold text-uppercase">Total de Cliques</p>
                            </div>
                            <div class="col-sm-8">
                                <p class="text-xs">Valores e cadastros estão sujeitos a alteração.</p>
                                <ul class="list-unstyled text-center bord-top pad-top mar-no row">


                                    <?php

                                    $this->db->from('cotacoes_itens');
                                    $this->db->where('data >=',date("d/m/Y", strtotime($default_value)));
                                    $this->db->where('data <=',date("d/m/Y", strtotime($default_value1)));
                                    if(isset($_GET['empresa']) and !empty($_GET['empresa'])):
                                       // $this->db->where('empresa',$_GET['empresa']);
                                    elseif(isset($_SESSION['ID_EMPRESA']) and $_SESSION['ID_EMPRESA']):
                                        //$this->db->where('empresa',$_SESSION['ID_EMPRESA']);
                                    endif;
                                    $get = $this->db->get();
                                    $count = $get->num_rows();
                                    ?>

                                    <li class="col-xs-4">
                                        <span class="text-lg text-semibold text-main"><?php if(isset($_GET['empresa']) or isset($_SESSION['ID_EMPRESA'])): echo number_format($count); else: echo number_format(($count * 3)); endif;?></span>
                                        <p class="text-sm text-muted mar-no">Produtos Cotados</p>
                                    </li>

                                    <?php

                                    $this->db->from('clique_produtos');
                                    $this->db->where('data >=',date("d/m/Y", strtotime($default_value)));
                                    $this->db->where('data <=',date("d/m/Y", strtotime($default_value1)));
                                    if(isset($_GET['empresa']) and !empty($_GET['empresa'])):
                                      //  $this->db->where('empresa',$_GET['empresa']);
                                    elseif(isset($_SESSION['ID_EMPRESA']) and $_SESSION['ID_EMPRESA']):
                                      //  $this->db->where('empresa',$_SESSION['ID_EMPRESA']);
                                    endif;
                                    $get = $this->db->get();
                                    $count = $get->num_rows();
                                    ?>
                                    <li class="col-xs-4">
                                        <span class="text-lg text-semibold text-main"><?php if(isset($_GET['empresa']) or isset($_SESSION['ID_EMPRESA'])): echo number_format($count); else: echo number_format(($count * 3)); endif;?></span>
                                        <p class="text-sm text-muted mar-no">Clique em Produtos</p>
                                    </li>

                                    <?php

                                    $this->db->from('cotacoes_intencoes');
                                    $this->db->where('data >=',date("d/m/Y", strtotime($default_value)));
                                    $this->db->where('data <=',date("d/m/Y", strtotime($default_value1)));
                                    if(isset($_GET['empresa']) and !empty($_GET['empresa'])):
                                     //   $this->db->where('empresa',$_GET['empresa']);
                                    elseif(isset($_SESSION['ID_EMPRESA']) and $_SESSION['ID_EMPRESA']):
                                       // $this->db->where('empresa',$_SESSION['ID_EMPRESA']);
                                    endif;
                                    $get = $this->db->get();
                                    $count = $get->num_rows();
                                    ?>
                                    <li class="col-xs-4">
                                        <span class="text-lg text-semibold text-main"><?php if(isset($_GET['empresa']) or isset($_SESSION['ID_EMPRESA'])): echo number_format($count); else: echo number_format(($count * 3)); endif;?></span>
                                        <p class="text-sm text-muted mar-no">Intenções de Compras</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>


                </div>
            </div>


        </div>

    </div>


