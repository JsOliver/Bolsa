<?php $array['usuario'] = $usuario; $this->load->view('sistema/leilofarma/conta/z_top/topo',$array); ?>
<div class="coluna-conta">

<table class="table">
    <thead>
    <tr>
        <th scope="col">Data da Cotação</th>
        <th scope="col">Valor Total dos Produtos</th>
        <th scope="col">Valor Total dos Lances</th>
        <th scope="col">Situação</th>
    </tr>
    </thead>
    <tbody>

    <?php foreach ($cotacoes as $value){
        $this->db->from('cotacoes_itens');
            $this->db->where('lista_cotacao',$value['id']);
            $this->db->join('produtos','cotacoes_itens.produto_id=produtos.id','inner');
            $this->db->order_by('produtos.nome','asc');
            $get = $this->db->get();
            $count = $get->num_rows();
            if($count > 0):

                $result = $get->result_array();
                $valornormal = 0;
                $valordesconto = 0;
                foreach ($result as $value1) {
                    $valornormal = ($value1['valor'] * $value1['quantidade']) + $valornormal;
                    $valordesconto = ($value1['valor_desconto'] * $value1['quantidade']) + $valordesconto;
                }
    endif;
        ?>
    <tr style="cursor: pointer;" onclick="$('#modalprod<?php echo $value['id']?>').modal('show');" data-toggle="tooltip" title="Clique aqui para visualizar os produtos cotados."  data-original-title="Clique aqui para visualizar os produtos cotados.">
        <th scope="row"><?php echo $value['data']?></th>
        <td>R$ <?php echo number_format($valornormal,2,',','.');?></td>
        <td>R$ <?php echo number_format($valordesconto,2,',','.');?></td>
        <td>Em Analise</td>
    </tr>
        <div class="modal fade" id="modalprod<?php echo $value['id']?>" tabindex="-1" role="dialog" aria-labelledby="modalprod<?php echo $value['id']?>" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Produtos Cotados</h4>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="" style="padding-left: 3%;margin-top: 10px">
                        <div class="clearfix"></div>
                        <?php

                        $this->db->from('cotacoes_itens');
                        $this->db->where('lista_cotacao',$value['id']);
                        $this->db->join('produtos','cotacoes_itens.produto_id=produtos.id','inner');
                        $this->db->order_by('produtos.nome','asc');
                        $get = $this->db->get();
                        $count = $get->num_rows();
                        if($count > 0):

                            $result = $get->result_array();
$valornormal = 0;
$valordesconto = 0;
                        foreach ($result as $value1){

                        ?>
                        <p style="float: left;width: 100%;margin-top: 10px">
                            <span style="float: left;width: 30%;"> <b>Produto: </b><span><?php echo $value1['nome'];?> </span></span>
                            <span style="float: left;width: 20%;"><b>Original: </b><span>R$ <?php echo number_format($value1['valor'],2,',','.');?> </span></span>
                            <span style="float: left;width: 20%;"><b>Ofertado: </b><span>R$ <?php echo number_format($value1['valor_desconto'],2,',','.');?> </span></span>
                            <span style="float: left;width: 20%;"><b>Quantidade: </b><span> <?php echo number_format($value1['quantidade']);?> </span></span>
                        </p>
                        <?php

                            $valornormal = ($value1['valor'] * $value1['quantidade']) + $valornormal;
                        $valordesconto = ($value1['valor_desconto'] * $value1['quantidade']) + $valordesconto;

                        } endif;?>

                        <p style="float: left;width: 100%;margin-top: 20px">
                            <span style="float: left;width: 30%;"><b>Valor Total</b></span>
                            <span style="float: left;width: 20%;"><b>Original: </b><span>R$ <?php echo number_format($valornormal,2,',','.');?> </span></span>
                            <span style="float: left;width: 20%;"><b>Ofertado: </b><span>R$ <?php echo number_format($valordesconto,2,',','.');?> </span></span>
                            <span style="float: left;width: 20%;color: white;">Vazio</span>
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-outline-secondary btn-sm" type="button" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
    <?php }?>

    </tbody>
</table>
</div>

<?php $this->load->view('sistema/leilofarma/conta/z_top/rodape',$array); ?>
