

    <!-- Banner -->
    <div class="page-hero-wrapper">
        <?php foreach($banner_topo as $value){?>
        <a <?php if(!empty($value['link'])): echo 'target="_blank" href="'.$value['link'].'"'; endif;?>><img class="page-hero__image visible-lg" onerror="this.src='https://www.techonline.com/img/tmp/no-image-icon.jpg';" src="<?php echo base_url('web/imagens/'.$value['image']) ;?>" /></a>
        <?php }?>

    </div>
<br>
<br>

    <!-- Area de banner quadrado e categoria de produtos -->
    <div class="beauty-categories-wrapper" >
        <div class="container-fluid cr-grid">
            <div class="row">

<!-- Banner quadrado comparar preços -->

                <div class="col-sm-4 col-sm-push-8 beauty-categories-highlight-wrapper">

                    <?php if(count($banner_lateral) > 0):?>
                    <div class="beauty-categories-highlight" style="background-image: url(<?php echo base_url('web/imagens/'.$banner_lateral['image']);?>)"><a href="<?php echo base_url('produtos')?>"></a></div>
                    <?php endif;?>
                </div>





                <!-- Container de produtos de categorias -->
                <div class="col-sm-8 col-sm-pull-4 beauty-category-blocks-wrapper">
                    <div class="row">
                        <?php foreach($categorias as $value){?>
                    <?php $arr['value'] = $value; $this->load->view('sistema/leilofarma/z_files/categorias_home',$arr);?>
                        <?php }?>
                    </div>
                </div>

            </div>

            <div class="row visible-xs text-center">
                <div class="col-xs-12"><a class="btn btn-magenta beauty-categories-highlight__button beauty-categories-highlight__button--mobile"
                        href="categorias.html">Ver todas categorias</a></div>
            </div>
        </div>
    </div>

<?php if(count($produtos) > 0):?>
    <!-- Area de produtos recomendados -->
    <div class="products-showcase-wrapper">
        <div class="container-fluid cr-grid cr-grid--new-grid"><h2 class="products-showcase__title">Produtos
                recomendados</h2>

            <div class="product-block-wrapper product-block-wrapper--new-grid h-cancel-container-xs">
         <!-- Bloco de produto -->
            <?php foreach($produtos as $value){?>
            <?php $arr['value'] = $value; $this->load->view('sistema/leilofarma/z_files/produtos',$arr);?>
            <?php }?>
            </div>
        </div>
    </div>
<?php endif;?>

