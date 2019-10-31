    <section class="content clearfix">
                <div class="container">

                    <?php if($lotes_destaques):?>
                    <div class="page-header">
                <h4>Lotes em Destaques</h4>
            </div>
            <div class="row featuredProducts featuredProductsSlider margin-bottom">
                <?php foreach ($lotes_destaques as $value){ $arr['item'] = $value; $this->load->view('sistema/leilao/z_files/lotes_destaques',$arr); }?>





            </div>

                    <?php endif;?>



                    <?php if($leiloes){?>


            <div class="page-header">
                <h4>Leilões Online</h4>
            </div>
            <div class="row">

                <?php foreach ($leiloes as $value){ $value['stats'] = 0; $arr['item'] = $value; $this->load->view('sistema/leilao/z_files/leiloes',$arr); }?>





            </div>
                    <?php } ?>



                    <?php if($leiloes_finalizados){?>

                    <div class="page-header">
                        <h4>Leilões Finalizados</h4>
                    </div>
                    <div class="row">

                        <?php foreach ($leiloes_finalizados as $value){ $value['stats'] = 1; $arr['item'] = $value; $this->load->view('sistema/leilao/z_files/leiloes',$arr); }?>





                    </div>

                    <?php } ?>
        </div>

<br>

    </section>
