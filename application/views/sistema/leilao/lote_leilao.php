<section class="lightSection clearfix pageHeader" style="height: 170px;padding: 25px 0;">
    <div class="container">
        <div class="row" onclick="window.location.href='<?php echo base_url('lotes/').$lote['leiloes'];?>';">
            <div class="col-md-2">
                <div class="page-title">
                    <img src="<?php echo  base_url('web/imagens/'.$comitente['image']);?>" onerror="this.src='<?php echo base_url('web/default.jpg')?>';" style="width: 150px;height: 100px;">
                </div>
            </div>
            <div class="col-md-10">
                <div class="page-title mobilehide">
                    <p style="font-size:25px;line-height: 30px;">
                        <?php echo $comitente['nome']?> - <?php echo $leiloes['nome'];?>
                    </p>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <p style="height: 8px;"><b>Comitente</b> <?php echo $comitente['nome']?></p>
                                <p><b>Data de Início</b> <?php echo $this->ModelDefault->inicioleilao($lote['leiloes']);?></p>
                            </div>
                            <div class="col-md-6">
                                <p style="height: 8px;"><b>Modalidade</b> <?php echo $this->ModelDefault->tipoleilao('lotes',$lote['leiloes']);?></p>
                                <p><b>Data de Término:</b> <?php echo $this->ModelDefault->fimleilao($lote['leiloes']);?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
            </div>
            <div class="col-md-4">

                <?php if(!empty($leiloes['edital'])):?>
                    <a href="<?php echo base_url('web/imagens/'.$leiloes['edital'])?>"  target="_blank" class="btn btn-primary text-white">VER EDITAL</a>
                <?php endif;?>
                <a class="btn btn-danger text-white" style="background: #9a241f;border-color: #9a241f;text-transform: uppercase;"><?php echo $this->ModelDefault->natureza('lotes',$lote['leiloes']);?></a>

            </div>
        </div>
    </div>
</section>

<section class="mainContent clearfix">
    <div class="container">
        <div class="row singleProduct">

            <div class="col-md-12">
                <h3 style="margin-top: -10px;"><b>Lote <?php echo $lote['nlote'];?></b> - <?php echo $lote['nome'];?></h3>
                <br>
                <br>
                <?php
                $this->db->select('id,nlote');
                $this->db->from('lotes');
                $this->db->where('leiloes',$lote['leiloes']);
                $this->db->order_by('id','asc');
                $get = $this->db->get();
                $count = $get->num_rows();

                if($count > 0):
                    $lotes_navega = $get->result_array();
                    ?>
                    <div class="col-9" style="float: left;"></div>
                    <div class="col-3" style="float: left;margin-top: -20px;">
                        <select class="form-control" onchange="window.location.href='<?php echo base_url('lote/');?>'+this.value;">

                            <?php foreach ($lotes_navega as $item) {
                                if($lote['id'] == $item['id']):

                                    echo '<option value="'.$item['id'].'" selected="selected">Lote '.$item['nlote'].'</option>';

                                else:
                                    echo '<option value="'.$item['id'].'">Lote '.$item['nlote'].'</option>';

                                endif;

                            }?>


                        </select>
                    </div>
                    <div class="clearfix"></div>
                <?php endif;?>
                <div class="media flex-wrap" style="margin-bottom: 20px!important;">

                    <div class="media-left productSlider">
                        <div id="carousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active" data-thumb="0">
                                    <img style="width:450px;height: 450px;" src="<?php echo base_url('web/imagens/'.$lote['image'])?>" onerror="this.src='<?php echo base_url('web/default.jpg')?>';">
                                </div>

                            </div>
                        </div>
                        <div class="clearfix">
                            <div id="thumbcarousel" class="carousel slide" data-interval="false" style="display:none;">
                                <div class="carousel-inner">
                                    <div data-target="#carousel" data-slide-to="0" class="thumb"><img src="<?php echo base_url('web/imagens/'.$lote['image'])?>" onerror="this.src='<?php echo base_url('web/default.jpg')?>';"></div>

                                </div>
                                <a class="left carousel-control" href="#thumbcarousel" role="button" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left"></span>
                                </a>
                                <a class="right carousel-control" href="#thumbcarousel" role="button" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="media-body">
                        <ul class="list-inline">
                            <li><a><i class="fa fa-eye" aria-hidden="true"></i> <?php echo ($lote['visualizacoes']);?> Visualizações</a></li>
                            <li><a><i class="fa fa-gavel" aria-hidden="true"></i><?php echo ($lances_count);?> Lances</a></li>
                        </ul>
                        <div class="row">

                            <div class="col-md-8">
                                <?php  if($lote['stats'] == 0):?>
                                    <!--   <a href="<?php echo base_url('auditorio/'.$lote['leiloes']);?>" class="situacao" style="background: #c43248;padding: 10px;"><i class="fa fa-gavel"></i> ACOMPANHAR NO AUDITÓRIO</a>
                            <br>
                            <br>
                            <br>-->
                                <?php endif;?>
                                <?php
                                if($lote['stats'] == 0):

                                    $valor = '<span class="situacao" id="situacaols" style="background: #39c470;padding: 10px;">Aberto para Lances</span>';
                                elseif($lote['stats'] == 1):
                                    $valor = '<span class="situacao" id="situacaols" style="background: #97bac4;padding: 10px;">Em Loteamento</span>';
                                elseif($lote['stats'] == 2):
                                    $valor = '<span class="situacao" id="situacaols" style="background: #97bac4;padding: 10px;">Aguardando para Abrir</span>';
                                elseif($lote['stats'] == 3):
                                    $valor = '<span class="situacao" id="situacaols" style="background: #c42052;padding: 10px;">Arrematado</span>';
                                elseif($lote['stats'] == 4):
                                    $valor = '<span class="situacao" id="situacaols" style="background: #c0c43e;padding: 10px;">Em Condicional</span>';
                                elseif($lote['stats'] == 5):
                                    $valor = '<span class="situacao" id="situacaols" style="background: #6d0e2b;padding: 10px;">Finalizado</span>';
                                elseif($lote['stats'] == 6):
                                    $valor = '<span class="situacao" id="situacaols" style="background: #2e47c4;padding: 10px;">Venda Direta</span>';
                                else:
                                    $valor = '<span class="situacao" id="situacaols" style="background: #6f8a92;padding: 10px;">Indefinido</span>';
                                endif;
                                echo $valor
                                ?>
                                <div class="clearfixr"></div>
                                <br>
                                <br>
                                <br>
                                <form id="lancevalor" action="javascript:dar_lance(<?php echo $lote['id'];?>);" method="post">
                        <span class="">
                            <h3 class="text-danger" style="color: #9a241f!important;height: 10px;">Dê seu Lance</h3>

                            <input type="hidden" name="lote" value="<?php echo $lote['id'];?>">

                <input type="tel" name="lance" class="form-control money2" style="float: left;width: 100%;" id="lancevalues" placeholder="Informe o valor (Ex. R$ 15.000,00)" required="required"/>
                  </span>
                                    <div class="btn-area">
                                        <button type="submit" style="float: left;width: 100%;" class="btn btn-primary btn-default"><span class="fa fa-gavel"></span> Enviar meu Lance <i class="fa fa-angle-right" aria-hidden="true"></i></button>
                                        <div class="clearfixr"></div>

                                    </div>
                                </form>
                                <div id="blocksdisplays" style="padding: 5px;float: left;background: red;position: absolute;height: 230px;width: 93%;top: 0;background: #0000003d;display: none;"></div>

                                <div class="clearfixr"></div>
                                <br>
                            </div>
                            <div class="col-md-4">
                            <span style="text-align: center;padding: 20px 10px 20px 10px;color: #9a241f;float: left;width: 100%;background: #fafafa">

                                <?php if($lote['stats'] == 0):?>
                                    <h5 style="margin-top: 25px;">Leilão Encerra em:</h5>
                                    <p style="font-size: 18px;height: 5px;" id="clock">00:00:00</p>
                                    <br>
                                    <h5>Lance Atual</h5>

                                <?php elseif($lote['stats'] == 3):?>
                                    <h5 style="margin-top: 25px;">Leilão Arrematado:</h5>

                                <?php else:?>

                                    <h5 style="margin-top: 25px;">Leilão Finalizado:</h5>

                                <?php endif;?>

                                <?php if($lote['stats'] == 0):?>

                                    <p style="font-size: 18px;height: 0px;margin-bottom: 20px;" id="lance_atual">R$ <?php  echo empty($lote['lance_atual']) ? '0.00' : @number_format($lote['lance_atual'],2,'.',',');?></p>

                                <?php else:?>
                                    <p style="font-size: 18px;height: 0px;margin-bottom: 20px;">---- ----</p>
                                <?php endif;?>
                                <small id="data_lance"><?php echo $lote['data_lance'];?></small>

                              <p style="font-size: 18px;height: 5px;" id="nickname"><?php echo (empty($lote['nickname'])) ? $this->ModelDefault->arrematantes($lote['arrematante']) : $lote['nickname'];?></p>



                            </span>



                            </div>
                        </div>
                        <br>
                        <div class="tabArea">
                            <div class="clearfixr"></div>

                            <ul class="nav nav-tabs bar-tabs">
                                <?php if(empty($lote['descricao'])):?>

                                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#details" aria-expanded="true">Descrição</a></li>
                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#about-art" aria-expanded="false">Historico de Lances</a></li>
                                <?php else:?>
                                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#details" aria-expanded="true">Descrição</a></li>
                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#about-art" aria-expanded="false">Historico de Lances</a></li>
                                <?php endif;?>
                            </ul>
                            <div class="tab-content">

                                <?php if(empty($lote['descricao'])):?>

                                    <div id="details" class="tab-pane fade active show" aria-expanded="true">


                                        <?php       $this->db->select('descricao');
                                        $this->db->from('lotes_descritivos');
                                        $this->db->where('leilao',$lote['leiloes']);
                                        $this->db->where('id_lote',$lote['nlote']);
                                        $this->db->order_by('id','asc');
                                        $get = $this->db->get();
                                        $descritivos = $get->result_array();

                                        foreach ($descritivos as $descritivo) {
                                            echo $descritivo['descricao'].'<br>';
                                        }
                                        ?>                                    </div>
                                    <div id="about-art" class="tab-pane fade" aria-expanded="false">
                                        <ul class="list-unstyled">
                                            <?php foreach ($historico as $value){

                                                $this->db->select('user');
                                                $this->db->from('usuarios');
                                                $this->db->where('id',$value['cadastro']);
                                                $get = $this->db->get();
                                                $users = $get->result_array()[0];

                                                echo '<li>'.$users['user'].' - <b>'.$value['data_lance'].' às '.$value['hora_lance'].'</b><br><b>Valor: </b>R$ '.number_format($value['valor_lance'],2,'.',',').'</li>';

                                            }?>

                                        </ul>

                                    </div>
                                <?php else:?>
                                    <div id="details" class="tab-pane fade active show" aria-expanded="true">

                                        <?php       $this->db->select('descricao');
                                        $this->db->from('lotes_descritivos');
                                        $this->db->where('leilao',$lote['leiloes']);
                                        $this->db->where('id_lote',$lote['nlote']);
                                        $this->db->order_by('id','asc');
                                        $get = $this->db->get();
                                        $descritivos = $get->result_array();

                                        foreach ($descritivos as $descritivo) {
                                            echo $descritivo['descricao'].'<br>';
                                        }
                                        ?>
                                    </div>
                                    <div id="about-art" class="tab-pane fade" aria-expanded="false">
                                        <ul class="list-unstyled">
                                            <?php foreach ($historico as $value){

                                                $this->db->select('user');
                                                $this->db->from('usuarios');
                                                $this->db->where('id',$value['cadastro']);
                                                $get = $this->db->get();
                                                $users = $get->result_array()[0];

                                                echo '<li>'.$users['user'].' - <b>'.$value['data_lance'].' às '.$value['hora_lance'].'</b><br><b>Valor: </b>R$ '.number_format($value['valor_lance'],2,'.',',').'</li>';

                                            }?>

                                        </ul>

                                    </div>
                                <?php endif;?>


                            </div>
                        </div>

                    </div>

                </div>

                <div class="row">
                    <div class="col-md-2">
                        <h3>Informações</h3>

                        <p style="height: 5px;">Lote: <?php echo $comitente['nome'];?> - <?php echo $lote['nlote'];?></p>
                        <p style="height: 5px;font-weight: bold;">Lance Inicial: <br>
                        <h4>R$ <?php echo @number_format($lote['lance_ini'],2,'.',',');?></h4>
                        </p>
                    </div>

                    <div class="col-md-3">
                        <br>
                        <p style="height: 5px;margin-top: 5px;">Início: <?php echo date('d/m/Y H:i',strtotime($lote['data_ini']));?></p>
                        <p style="height: 5px;">Término: <?php echo date('d/m/Y H:i',strtotime($lote['data_fim']));?></p>
                        <p style="height: 5px;">Localidade: Belo Horizonte, MG</p>
                        <?php if($lote['stats'] == 0):?>
                            <p style="height: 5px;">Despesas: R$ 220</p>
                        <?php endif;?>
                        <p style="height: 5px;">Comissão do Leiloeiro: 5% - Cinco Porcento</p>

                    </div>
                </div>
                <br>
                <br>
                <div class="clearfix"></div>
            </div>
        </div>
        <?php if(isset($proximos_lote) and count($proximos_lote) > 0):?>
            <div class="page-header">
                <h4>Proximos Lotes</h4>
            </div>
            <div class="row productsContent">

                <?php


                foreach ($proximos_lote as $value){
                    $arr['item'] = $value;  $this->load->view('sistema/leilao/z_files/lotes',$arr);
                }
                ?>



            </div>

        <?php endif;?>
    </div>
</section>