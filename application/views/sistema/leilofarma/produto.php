<div class="product-header-wrapper">
    <div class="container-fluid cr-grid">
        <div class="breadcrumb-nav arrowed-items">
            <nav class="nav-carousel h-no-scrollbar">
                <ul class="breadcrumb ">
                    <li class="">
                        <a href="<?php echo base_url('');?>">Inicio</a>
                        <span class="divider "><svg class="svg-icon breadcrumb__icon"><use
                                        xlink:href="#next.icon"></use></svg></span>
                    </li>

                    <li class="produto-<?php echo base_url('produto/'.$produto['id']);?>">
                        <?php echo $produto['nome'];?>
                    </li>
                </ul>
            </nav>
        </div>

        <h1 class="product-header__title"> <?php echo $produto['nome']?></h1>
        <div class="row marginTop-10">
            <div class="col-xs-12 col-md-7">
                <div>
                    <div>
                        <div class="product-header__starting-price" data-scroll-to=""><a class="product-header__starting-price-link" href="#">
                                <div class="product-block__starting-price-value"><strong> <?php echo $this->ModelDefault->price($produto['id']);?></strong></div>
                            </a></div>
                    </div>
                </div>
                <div class="hidden-xs hidden-sm product-header__description"><?php echo str_replace('<img ','<img style="width:100px;" ',$produto['descricao'])?></div>
            </div>

        </div>
    </div>
</div>


<div class="product-presentation-select-wrapper product-presentation-select-wrapper--beauty sub-nav hidden-xs headroom headroom--not-bottom headroom--pinned headroom--top"
     data-body-class="presentation-select-pinned" data-component="SubNav" data-presentation-select="">
    <div class="dropdown">
        <div aria-expanded="true" aria-haspopup="true" class="dropdown-toggle" data-toggle="dropdown"
             id="presentationSelect">
            <div class="product-presentation__cta"><strong class="product-presentation__cta-text">
                    Produto</strong></div>
            <ul class="nav product-presentation__list--hightlight">
                <li class="product-presentation__option product-presentation__option--highlight active"
                    data-presentation-selector="130ml"><a href="#130ml">
                        <div class="product-presentation__option-infos"><span
                                    class="product-presentation__option-description"><strong><?php echo $produto['nome']?></strong></span>
                        </div>
            </ul>
        </div>

    </div>
</div>


<div class="product-presentation-offers-wrapper">
    <div class="container-fluid cr-grid">
        <div class="row">
            <div class="col-xs-12" id="ofertas">

                <div class="js-offer-set" data-ean="7896082900399" data-slug="acnase-locao-adstringente/130ml"
                     id="130ml">
                    <div class="row presentation-offer-block" data-collapsable="true"
                         id="offer-content-5a799d1cb148c200125a5855">
                        <div class="col-xs-12 no-padding presentation-offer-header">
                            <div class="presentation-offer-info">
                                <div class="presentation-offer-info__image">
                                    <figure>
                                        <img class="presentation-offer-info__img lazy-image" alt="130mL"
                                             onerror="this.src='https://www.techonline.com/img/tmp/no-image-icon.jpg';" src="<?php echo empty($produto['image']) ? $produto['image_externa']: base_url('web/imagens/'.$produto['image']) ;?>">
                                        <noscript><img class="presentation-offer-info__img" alt="130mL"
                                                       onerror="this.src='https://www.techonline.com/img/tmp/no-image-icon.jpg';" src="<?php echo empty($produto['image']) ? $produto['image_externa']: base_url('web/imagens/'.$produto['image']) ;?>">/>
                                        </noscript>
                                    </figure>
                                </div>
                                <div class="presentation-offer-info__data"><h2
                                            class="presentation-offer-info__description"><a data-ellipsis="3"
                                                                                            href="#"
                                                                                            title="<?php echo $produto['nome']?>"><?php echo $produto['nome']?></a></h2>

                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12">
                            <div class="row presentation-offer-list-wrapper">
                                <div class="offers-loader"><i class="cr-icon cr-icon-loading"></i><span>Carregando ofertas...</span>
                                </div>
                                <div class="col-xs-12 presentation-offer-lists js-offers-content" data-component="PresentationOfferList">


                                    <?php foreach($produtos_comparados as $value){?>
                                        <?php $dado['value'] = $value; $this->load->view('sistema/leilofarma/z_files/produtos_comparativos',$dado);?>
                                    <?php } ?>

<?php if(isset($_SESSION['keyword'])): ?>
<div class="clearfix"></div><br><br><br>
                                    <div class="products-showcase-wrapper">
                                        <div class="container-fluid cr-grid cr-grid--new-grid"><h2 class="products-showcase__title">Produtos Similares</h2>


                                        <div class="product-block-wrapper product-block-wrapper--new-grid h-cancel-container-xs">
                                            <!-- Bloco de produto -->
                                            <?php

                                            $this->db->from('produtos');
                                            $this->db->where('status',1);
                                            if(isset($_SESSION['keyword'])):
                                                $this->db->like('LOWER(nome)', strtolower($_SESSION['keyword']), 'before');
                                                $this->db->or_like('LOWER(nome)', strtolower($_SESSION['keyword']), 'after');
                                                $this->db->or_like('LOWER(nome)', strtolower($_SESSION['keyword']));
                                            endif;
                                            $this->db->limit(10,0);
                                            $this->db->order_by('rand()');
                                            $get = $this->db->get();
                                            $produtos = $get->result_array();
                                            foreach($produtos as $value){?>
                                                <?php $arr['value'] = $value; $this->load->view('sistema/leilofarma/z_files/produtos',$arr);?>
                                            <?php }?>
                                        </div>
                                    </div>
                                </div>
<?php endif;?>
                            </div>

                        </div>

                        </div>


                    </div>
                    <div class="modal cr-modal" id="presentationMobileOrder">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header"><strong class="modal__title">Ordenar por</strong><a
                                            class="modal__button modal__button--close pull-right"
                                            data-dismiss="modal"><i class="cr-icon-close"></i></a></div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <ul class="mobile-category-list">
                                                <li>
                                                    <a onclick="$('.js-order-filter').val('preco').trigger('change');$('#presentationMobileOrder').modal('hide'); ">Preço</a>
                                                </li>
                                                <li>
                                                    <a onclick="$('.js-order-filter').val('relevancia').trigger('change');$('#presentationMobileOrder').modal('hide'); ">Relevância</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>