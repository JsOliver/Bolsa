<section class="content clearfix">
    <div class="container">

    <?php if($lotes_busca){?>


    <div class="page-header">
        <h4>Resultados de <small><?php echo $_GET['busca'];?></small></h4>
    </div>
    <div class="row">

        <?php foreach ($lotes_busca as $value){ $arr['item'] = $value; $this->load->view('sistema/leilao/z_files/lotes',$arr); }?>





    </div>
<?php }else{ ?>

<div style="padding: 120px 0 150px 0;">
    <h1><img src="http://localhost/projetos/Bolsa/web/imagens/31102019_43413002022072019_24497712logo.png" style="width: 150px;"></h1><br>
        <h1>Nenhum Resultado Encontrado :(</h1>
        <h2>Tente buscar com outras palavras, ou <a href="mailto:atendimento@bolsadeleiloes.com.br" class="text-info">Entre em Contato Conosco</a></h2>
</div>
        <?php } ?>
    </div>

    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
</section>