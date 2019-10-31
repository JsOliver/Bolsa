<section class="content clearfix">
    <div class="container">
<hr>
<div class="row">

    <div id="appenddata" style="float: left;width: 100%;">
    <?php foreach ($lotes as $value){ $arr['item'] = $value; $this->load->view('sistema/leilao/z_files/lotes',$arr); }?>

</div>
    <div class="clearfix"></div>
<div style="float: left;width: 100%;text-align: center;" id="buttonloadmore">
    <a href="javascript:loadmore('<?php echo $this->uri->segment(2);?>',1);" class="btn btn-danger text-white">Carregar Mais</a>
</div>
    <div class="clearfix"></div>

    <br>

</div>
</div>
</section>
<br>
<br>