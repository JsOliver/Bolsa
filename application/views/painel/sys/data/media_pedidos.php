<?php if($template == 'dashboard_under_day'): ?>

    <ul class="list-unstyled">
        <li>
            <div class="media pad-btm">
                <div class="media-left">
                    <span class="text-2x text-thin text-main"><?php echo $sys['total_pedidos']?></span>
                </div>

            </div>
        </li>

        <li>
            <div class="clearfix">
                <p class="pull-left mar-no">Lances em Relação ao Dia Anterior</p>
                <p class="pull-right mar-no"><?php echo $sys['pedidos_ao_dia_anterior_porc']?>%</p>
            </div>
            <div class="progress progress-sm">
                <div class="progress-bar progress-bar-primary" style="width: <?php echo $sys['pedidos_ao_dia_anterior_porc']?>%;">
                    <span class="sr-only"><?php echo $sys['pedidos_ao_dia_anterior_porc']?>% Completo</span>
                </div>
            </div>
        </li>
    </ul>

<?php endif;?>
