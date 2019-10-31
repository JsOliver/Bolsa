<div class="page-title" style="margin-top:30px;">
    <div class="container">
        <div class="column">
            <h1>Carrinho</h1>
        </div>

    </div>
</div>

<div class="container padding-bottom-3x mb-1" style="padding:0 0 20px 0;<?php if(!isset($_SESSION['addcarrinho'])): echo 'margin-bottom: 165px;'; else: echo 'margin-bottom: 30px;'; endif;?>">

    <div class="table-responsive shopping-cart">
        <table class="table">
            <thead>
            <tr>
                <th>Produto</th>
                <th class="text-center">Quantidade</th>
                <th class="text-center">Preço</th>
                <th class="text-center">Meu Lance</th>
                <th class="text-center"><a class="btn btn-danger" href="javascript:limparcarrinho();">Remover Todos</a>
                </th>
            </tr>
            </thead>
            <tbody>
            <?php
            $total = 0;

            if (isset($_SESSION['addcarrinho'])):
                $explode = explode(',', $_SESSION['addcarrinho']);

                $count = count($explode);

                if ($count > 0):

                    for ($i = 0; $i < $count; $i++):
                        $this->db->from('produtos');
                        $this->db->where('id', $explode[$i]);
                        $this->db->where('status', 1);
                        $get = $this->db->get();
                        $produto = $get->result_array()[0];

                        if (empty($produto['image']) and !empty($produto['image_externa'])):
                            $image = $produto['image_externa'];
                        else:
                            $image = base_url('web/imagens/' . $produto['image']);
                        endif;


                        ?>
                        <?php

                        if (isset($_SESSION['QNCAR' . $explode[$i]])):

                            $quantidade = $_SESSION['QNCAR' . $explode[$i]];

                        else:

                            $quantidade = 1;

                        endif;

                        if (isset($_SESSION['PROPOSTA_' . $explode[$i]])):
                            $total = $total + (str_replace(array('BRL', ' '), array('', ''), $_SESSION['PROPOSTA_' . $explode[$i]]) * $quantidade);

                        else:
                                    $total = $total + (str_replace(array('BRL', ' '), array('', ''), $produto['preco']) * $quantidade);

                        endif;


                        if ($quantidade <= 1):
                            $precounit = $this->ModelDefault->price($produto['id']);
                        else:

                        if (isset($_SESSION['PROPOSTA_' . $explode[$i]])):
                            $precounit = 'R$ ' . number_format(str_replace(array('BRL', ' '), array('', ''), $_SESSION['PROPOSTA_' . $explode[$i]]) * $quantidade, 2, ',', '.') . ' BRL';

                        else:

                                $precounit = 'R$ ' . number_format(str_replace(array('BRL', ' '), array('', ''), $produto['preco']) * $quantidade, 2, ',', '.') . ' BRL';

                        endif;
                        endif;


                        ?>

                        <tr>
                            <td>
                                <div class="product-item">
                                    <a class="product-thumb" href="<?php echo base_url('produto/' . $produto['id']); ?>">
                                        <img style="width: 100px" src="<?php echo $image; ?>" alt="<?php echo $produto['nome']; ?>">
                                    </a>
                                    <div class="product-info">
                                        <h4 class="product-title"><a
                                                    href="<?php echo base_url('produto/' . $produto['id']); ?>">
                                                <?php echo $this->ModelDefault->textolimit($produto['nome'], 30); ?></a>
                                        </h4>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="count-input" style="width: 100px"   data-toggle="tooltip" title=""
                                     data-original-title="Informe a quantidade e pressione Enter">
                                    <input onchange="atualizarqnt('<?php echo $produto['id'] ?>',this.value);"
                                           type="number" class="form-control" name="quantidade" placeholder="1" style="width: 50px"
                                           aria-valuemin="1"
                                           value="<?php if (isset($_SESSION['QNCAR' . $explode[$i]])): echo $_SESSION['QNCAR' . $explode[$i]]; else: echo 1; endif; ?>">
                                </div>
                            </td>
                            <td class="text-center text-lg"><?php echo $precounit; ?></td>

                            <td class="text-center text-lg"><span
                                        id="meulance<?php echo $produto['id']; ?>"><?php if (isset($_SESSION['PROPOSTA_' . $explode[$i]])): echo '<small>Original: '.$this->ModelDefault->price($produto['id']).'</small><br>'.'Lance R$ '.number_format($_SESSION['PROPOSTA_' . $explode[$i]],2,',','.'); else: echo $this->ModelDefault->price($produto['id']); endif; ?></span>
                              <br><br>
                                <input type="text" name="valor"  style="display: none;margin-bottom: 5px;" id="meulancefields<?php echo $produto['id']; ?>" class="form-control money2" value="'<?php if (isset($_SESSION['PROPOSTA_' . $explode[$i]])): echo number_format($_SESSION['PROPOSTA_' . $explode[$i]],2,'.',''); else: echo number_format($produto['preco'],2,'.',''); endif; ?>" onchange="alterarLanceCard(<?php echo $explode[$i]; ?>,this.value);">
                                <span id="buttonalterarlance<?php echo $produto['id']; ?>"> <a href="javascript:showLancebtn(<?php echo $produto['id']; ?>);intencao_cotacao(<?php echo $produto['id']?>);" class="btn btn-primary">ALTERAR LANCE</a></span>
                            </td>

                            <?php if ($count > 1): ?>

                                <td class="text-center">
                                    <a class="remove-from-cart"
                                       href="javascript:removecarrinho('<?php echo $produto['id']; ?>');"
                                       data-toggle="tooltip" title=""
                                       data-original-title="Remover item"><i class="fa fa-2x fa-times"></i></a>
                                </td>
                            <?php else: ?>
                                <td class="text-center">
                                    <a class="remove-from-cart" href="javascript:limparcarrinho();"
                                       data-toggle="tooltip" title=""
                                       data-original-title="Remover item"><i class="fa fa-2x fa-times"></i></a>
                                </td>
                            <?php endif; ?>

                        </tr>

                    <?php endfor; endif; endif; ?>
            </tbody>
        </table>
        <div class="column text-lg" style="margin-top:15px;"><span class="text-muted">Subtotal:&nbsp; </span><span
                    class="text-gray-dark">R$ <?php echo number_format($total, 2, ',', '.'); ?></span></div>
    </div>
    <div class="shopping-cart-footer" style="margin-top: 20px;">
        <div class="column" id="btncols"><a class="btn btn-primary" href="javascript:revisarPedido();"><i class="fa fa-paper-plane"></i> Enviar Cotação</a></div>
    </div>


</div>

