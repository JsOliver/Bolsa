
        <div class="col-xs-6 col-sm-3">
            <div class="beauty-category-block">
                <a href="javascript:categoria('<?php echo $value['palavra_chave'];?>');">
                    <div class="beauty-category__image-wrapper">
                        <img class="img-responsive beauty-category__image" onerror="this.src='https://www.techonline.com/img/tmp/no-image-icon.jpg';" src="<?php echo base_url('web/imagens/'.$value['image']) ;?>"  alt="<?php echo $value['nome'];?>"/></div>
                    <p class="beauty-category__name" ><?php echo $value['nome'];?></p>
                </a>
            </div>
        </div>
