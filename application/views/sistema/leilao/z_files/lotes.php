
<div class="slide col-3" style="margin-bottom: 20px;float: left;">
    <div class="productImage clearfix">
        <a class="natureza_min" style="color: white;"><?php echo $this->ModelDefault->natureza('lotes',$item['leiloes']);?></a>
        <a class="tipo_min" style="color: white;"><?php echo $this->ModelDefault->tipoleilao('lotes',$item['leiloes']);?></a>
        <a href="<?php echo base_url('lote-leilao/'.$item['id']);?>">
            <img src="<?php echo base_url('web/imagens/'.$item['image'])?>" onerror="this.src='<?php echo base_url('web/default.jpg')?>';" style="object-fit: cover!important; object-position: center!important;float: left;width: 100%;height: 250px;" alt="featured-product-img">
        </a>

        <?php
        if($item['stats'] == 0):
            $valor = '<span class="situacao" style="background: #39c470;">Aberto para Lances</span>';
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


        <a href="<?php echo base_url('lote-leilao/'.$item['id']);?>">
            <h4>Lote <?php echo $item['nlote'];?> - <?php echo $this->ModelDefault->limita_caracteres($item['nome'],40);?></h4>
            <?php if($item['stats'] == 0):?>
            <!--<a href="<?php echo base_url('auditorio/'.$item['leiloes']);?>" class="situacao" style="background: #c43248;"><i class="fa fa-gavel"></i> ACOMPANHAR NO AUDITÓRIO</a>
            --><?php endif;?>
            <br>
            <div class="row" style="padding-left: 10px;">
                <div class="col-md-6 col-6">
                    <p style="font-size: 10px;height: 8px;"><i class="fa fa-flag"></i> <?php echo $this->ModelDefault->comitente($item['leiloes']);?></p>
                    <p style="font-size: 10px;height: 8px;"><i class="fa fa-map-marker"></i> <?php echo $this->ModelDefault->localidade($item['leiloes']);?></p>
                    <p style="font-size: 10px;height: 8px;"><i class="fa fa-calendar"></i> Início: <?php echo date('d/m/Y',strtotime($item['data_ini']))?></p>
                    <p style="font-size: 10px;height: 8px;"><i class="fa fa-calendar"></i> Fim: <?php echo date('d/m/Y',strtotime($item['data_fim']))?></p>
                </div>
                <div class="col-md-6 col-6">

                    <?php  if($item['stats'] == 0):?>
                    <p style="font-size: 10px;height: 25px;"><i class="fa fa-calendar"></i> Lance Inicial: <br><b>R$ <?php echo number_format($item['lance_ini'],2,'.',',')?></b></p>
                    <p style="font-size: 10px;height: 8px;"><i class="fa fa-calendar"></i> Lance Atual: <br><b>R$ <?php echo empty($item['lance_atual']) ? 'R$ 0,00': number_format($item['lance_atual'],2,'.',',');?></b></p>
                    <?php else:?>
                        <p style="font-size: 10px;height: 25px;"><i class="fa fa-calendar"></i> Lance Inicial: <br><b>R$ <?php echo number_format($item['lance_ini'],2,'.',',')?></b></p>
                        <p style="font-size: 10px;height: 8px;"><i class="fa fa-calendar"></i> Lance Atual: <br><b>----- -----</b></p>


                    <?php endif;?>

                </div>
            </div>
        </a>

    </div>
</div>
