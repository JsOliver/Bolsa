<div class="slide col-4" style="margin-bottom: 10px">
    <div class="productImage clearfix">
        <a class="natureza_min" style="color: white;"><?php echo $this->ModelDefault->natureza('lotes',$item['id']);?></a>
        <a class="tipo_min" style="color: white;"><?php echo $item['local_do_deposito'];?></a>
        <?php if($item['stats'] == 0):?>
        <a href="<?php if($this->ModelDefault->count_lotes($item['id']) == 0): echo 'javascript:void(0);'; else: echo base_url('lotes/'.$item['id']);endif;?>">
            <?php else:?>
            <a href="<?php if($this->ModelDefault->count_lotes($item['id']) == 0): echo 'javascript:void(0);'; else: echo base_url('lotes/'.$item['id']);endif;?>">
            <?php endif;?>
            <img src="<?php echo base_url('web/imagens/'.$item['image'])?>" onerror="this.src='<?php echo base_url('web/default.jpg');?>';" style="object-fit: cover!important; object-position: center!important;float: left;width: 100%;height: 180px;" alt="featured-product-img">
        </a>
        <?php
        if($item['stats'] == 0):
            $valor = '<span class="situacao" style="background: #39c470;">Aberto</span>';
        else:

        $valor = '<span class="situacao" style="background: #6d0e2b;">Finalizado</span>';
        endif;
        echo $valor
        ?>    </div>
    <div class="productCaption clearfix">


        <?php if($item['stats'] == 0):?>
        <a href="<?php if($this->ModelDefault->count_lotes($item['id']) == 0): echo 'javascript:void(0);'; else: echo base_url('lotes/'.$item['id']);endif;?>">
            <?php else:?>
            <a href="<?php if($this->ModelDefault->count_lotes($item['id']) == 0): echo 'javascript:void(0);'; else: echo base_url('lotes/'.$item['id']);endif;?>">
                <?php endif;?>
            <h4><?php echo $this->ModelDefault->limita_caracteres($item['nome'],75);?></h4>
                <?php if($item['stats'] == 0):?>
                <!--<a href="<?php echo base_url('auditorio/'.$item['id']);?>" class="situacao" style="background: #c43248;"><i class="fa fa-gavel"></i> ACOMPANHAR NO AUDITÓRIO</a>
                --><?php endif;?>
            <br>
            <div class="row" style="padding-left: 10px;">
                <div class="col-md-6 col-6">
                    <p style="font-size: 11px;height: 8px;"><i class="fa fa-flag"></i> <?php echo $this->ModelDefault->comitentes($item['comitente']);?></p>
                    <p style="font-size: 11px;height: 8px;"><i class="fa fa-map-marker"></i> <?php echo $this->ModelDefault->localidade($item['id']);?></p>
                    <p style="font-size: 11px;height: 8px;"><i class="fa fa-calendar"></i> Início: <?php echo $this->ModelDefault->inicioleilao($item['id']);?></p>
                    <p style="font-size: 11px;height: 8px;"><i class="fa fa-calendar"></i> Fim: <?php echo $this->ModelDefault->fimleilao($item['id']);?></p>
                    <?php
                    if(empty($item['data_ini'])):
                    $ars['data_ini'] = $this->ModelDefault->inicioleilao($item['id']);
                    $this->db->where('id',$item['id']);
                    $this->db->update('leiloes',$ars);
                    endif;

                    if(empty($item['data_fim'])):
                    $ars['data_fim'] = $this->ModelDefault->fimleilao($item['id']);
                    $this->db->where('id',$item['id']);
                    $this->db->update('leiloes',$ars);
                    endif;

                    ?>
                </div>
                <div class="col-md-6 col-6">
                    <h3 style="padding-top: 20px;color: #b70718;"> <?php echo ($item['stats'] == 0)?  $this->ModelDefault->count_lotes($item['id']) : 'Encerrado';?> </h3>
                </div>

            </div>
        </a>

    </div>
</div>


