
<div class="slide col-3" style="margin-bottom: 20px;float: left;" id="lotebolsaaud<?php echo $item['id'];?>">
    <div class="productImage clearfix">
        <a class="natureza_min" style="color: white;"><?php echo $this->ModelDefault->natureza('lotes',$item['leiloes']);?></a>
        <a class="tipo_min" style="color: white;"><?php echo $this->ModelDefault->tipoleilao('lotes',$item['leiloes']);?></a>
        <a href="<?php echo base_url('lote/'.$item['id']);?>">
            <img src="<?php echo base_url('web/imagens/'.$item['image'])?>" onerror="this.src='<?php echo base_url('web/default.jpg')?>';" style="float: left;width: 100%;height: 250px;" alt="featured-product-img">
        </a>

        <?php
        if($item['stats'] == 0):
            $valor = '<span class="situacao" id="situacaoloteabs'.$item['id'].'" style="background: #39c470;">Aberto para Lances</span>';
        elseif($item['stats'] == 1):
            $valor = '<span class="situacao" style="background: #97bac4;">Em Loteamento</span>';
        elseif($item['stats'] == 2):
            $valor = '<span class="situacao" style="background: #97bac4;">Aguardando para Abrir</span>';
        elseif($item['stats'] == 3):
            $valor = '<span class="situacao" style="background: #c42052;">Arrematado</span>';
        elseif($item['stats'] == 4):
            $valor = '<span class="situacao" style="background: #c0c43e;">Em Condicional</span>';
        elseif($item['stats'] == 5):
            $valor = '<span class="situacao" style="background: #6d0e2b;">Finalizado</span>';
        elseif($item['stats'] == 6):
            $valor = '<span class="situacao" style="background: #2e47c4;">Venda Direta</span>';
        else:
            $valor = '<span class="situacao" style="background: #6f8a92;">Indefinido</span>';
        endif;
        echo $valor
        ?>
    </div>
    <div class="productCaption clearfix">


        <a>
            <h4 style="height: 65px;">Lote <?php echo $item['nlote'];?> - <?php echo $this->ModelDefault->limita_caracteres($item['nome'],40);?></h4>
            <br>
            <div class="row" style="padding-left: 10px;">
                <div class="col-md-6 col-6">
                    <p style="font-size: 10px;height: 8px;"><i class="fa fa-flag"></i> <?php echo $this->ModelDefault->comitente($item['leiloes']);?></p>
                    <p style="font-size: 10px;height: 8px;"><i class="fa fa-map-marker"></i> <?php echo $this->ModelDefault->localidade($item['leiloes']);?></p>
                    <?php if($item['stats'] == 0):?>

                        <p style="font-size: 12px;height: 8px;font-weight: bold;"><i class="fa fa-clock-o"></i> <span id="clock<?php echo $item['id'];?>">00:00</span></p>

                    <?php else:?>
                        <p style="font-size: 12px;height: 8px;font-weight: bold;"><i class="fa fa-clock-o"></i> <span>Lote Finalizado</span></p>

                    <?php endif;?>
                    <p style="font-size: 15px;height: 8px;color: #c43248;">Dê seu Lance</p>

                </div>
                <div class="col-md-6 col-6">
                    <p style="font-size: 10px;height: 25px;"><i class="fa fa-calendar"></i> Lance Inicial: <br><b>R$ <?php echo number_format($item['lance_ini'],2,'.',',')?></b></p>
                    <p style="font-size: 10px;height: 8px;"><i class="fa fa-calendar"></i> Lance Atual: <br><b>R$ <span id="lance_atual<?php echo $item['id'];?>"><?php echo empty($item['lance_atual']) ? 'R$ 0,00': number_format($item['lance_atual'],2,'.',',');?></span></b></p>
                    <br>
                    <p style="font-size: 10px;height: 8px;" id="nickclass<?php echo $item['id'];?>"><i class="fa fa-user"></i>: <b id="nickname<?php echo $item['id'];?>"><span class="text-danger">Sem Lance</span></b></p>
                </div>
            </div>


            <form id="lancevalor<?php echo $item['id'];?>" action="javascript:dar_lanceauditorio(<?php echo $item['id'];?>);" method="post">
                        <span class="">

                            <input type="hidden" name="lote" value="<?php echo $item['id'];?>">

                <input type="tel" name="lance" class="form-control money2<?php echo $item['id'];?>" style="float: left;width: 100%;" id="lancevalues<?php echo $item['id'];?>" placeholder="Informe o valor (Ex. R$ 15.000,00)" required="required"/>
                  </span>
                <div class="btn-area">
                    <button type="submit" style="float: left;width: 100%;" class="btn btn-primary btn-default"><span class="fa fa-gavel"></span> Enviar meu Lance <i class="fa fa-angle-right" aria-hidden="true"></i></button>
                    <div class="clearfixr"></div>

                </div>
            </form>
        </a>

    </div>
</div>
<script>
    var datadoserver = '<?php echo !empty($item['data_acrescimo']) ? date('Y-m-d H:i:s',strtotime($item['data_acrescimo'])) : date('Y-m-d H:i:s',strtotime($item['data_fim']));?>';
    var idlote = '<?php echo $item['id'];?>';



    $(document).ready(function() {
        iniciarcronometroauditorio("<?php echo !empty($item['data_acrescimo']) ? date('Y-m-d H:i:s',strtotime($item['data_acrescimo'])) : date('Y-m-d H:i:s',strtotime($item['data_fim']));?>",<?php echo $item['id'];?>);
        atualizar_loteauditorio(0,<?php echo $item['id'];?>,1);
        <?php if($item['stats'] == 0):?>
        checktimeauditorio(<?php echo $item['id'];?>);
        <?php endif;?>

        $('.money2<?php echo $item["id"];?>').mask("#,##0.00", {reverse: true});


    });

</script>