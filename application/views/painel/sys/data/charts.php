<?php if($coluna == 'Earning'): ?>
    <div class="col-sm-<?php echo $size;?> col-lg-<?php echo $size;?>">

        <div class="panel panel-info panel-colorful">
            <div class="pad-all">
                <p class="text-lg text-semibold">Ganhos</p>
                <p class="mar-no">
                    <span class="pull-right text-bold">R$ 0.00</span> Hoje
                </p>
                <p class="mar-no">
                    <span class="pull-right text-bold">R$ 0.00</span> Ultimos 7 Dias
                </p>
            </div>
            <div class="pad-top text-center">

                <div id="demo-sparkline-line" class="sparklines-full-content"></div>

            </div>
        </div>
    </div>

<script>

    var earningSparkline = function(){
        $("#demo-sparkline-line").sparkline([0, 754, 805, 855, 678, 987, 1026, 885, 878, 922, 875, ], {
            type: 'line',
            width: '100%',
            height: '60',
            spotRadius: 0,
            lineWidth: 2,
            lineColor: '#ffffff',
            fillColor: false,
            minSpotColor: false,
            maxSpotColor: false,
            highlightLineColor: '#ffffff',
            highlightSpotColor: '#ffffff',
            tooltipChartTitle: 'Lucros',
            tooltipPrefix: 'R$ ',
            spotColor: '#ffffff',
            valueSpots: {
                '0:': '#ffffff'
            }
        });
    }

</script>
<?php endif;?>


<?php if($coluna == 'Sales'): ?>

    <div class="col-sm-<?php echo $size;?> col-lg-<?php echo $size;?>">

        <div class="panel panel-purple panel-colorful">
            <div class="pad-all">
                <p class="text-lg text-semibold"><i class="demo-pli-basket-coins icon-fw"></i> Vendas Totais</p>
                <p class="mar-no">
                    <span class="pull-right text-bold">R$ 0.00</span> Hoje
                </p>
                <p class="mar-no">
                    <span class="pull-right text-bold">R$ 0.00</span> Ultimos 7 Dias
                </p>
            </div>
            <div class="text-center">

                <div id="demo-sparkline-bar" class="box-inline"></div>

            </div>
        </div>
    </div>


<?php endif;?>

