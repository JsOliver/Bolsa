<?php if($usage == 'new-users'): ?>
    <div class="panel">
        <div class="panel-body text-center clearfix">
            <div class="col-sm-4 pad-top">
                <div class="text-lg">
                    <?php


                    $this->db->from('usuarios');
                    $this->db->where('data_up',date('d/m/Y'));
                    $get = $this->db->get();
                    $countusuarios = $get->num_rows();

                    ?>
                    <p class="text-5x text-thin text-main"><?php echo @number_format($countusuarios);?></p>
                </div>
                <p class="text-sm text-bold text-uppercase">Novos Usuarios</p>
            </div>
            <div class="col-sm-8">
                <p class="text-xs">Valores e cadastros estão sujeitos a alteração.</p>
                <ul class="list-unstyled text-center bord-top pad-top mar-no row">
                    <?php


                    $this->db->from('usuarios');
                    $get = $this->db->get();
                    $countusuarios = $get->num_rows();

                    ?>
                    <li class="col-xs-4">
                        <span class="text-lg text-semibold text-main"><?php echo @number_format($countusuarios);?></span>
                        <p class="text-sm text-muted mar-no">Cadastros</p>
                    </li>

                    <?php

                    $lotecount = 0;

                    $this->db->from('lotes');
                    $this->db->where('stats',0);
                    $get = $this->db->get();
                    $lotes = $get->result_array();

                    foreach ($lotes as $value){

                        $lotecount = $lotecount + $value['visualizacoes'];


                    }
                    ?>

                    <li class="col-xs-4">
                        <span class="text-lg text-semibold text-main"><?php echo @number_format($lotecount);?></span>
                        <p class="text-sm text-muted mar-no">Visitas</p>
                    </li>

                </ul>
            </div>
        </div>
    </div>
<?php endif;?>
