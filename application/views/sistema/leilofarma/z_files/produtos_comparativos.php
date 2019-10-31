<?php
$this->db->from('empresas');
$this->db->where('id',$value['empresa']);
$get = $this->db->get();
$empresa = $get->result_array()[0];
?>
<div class="presentation-offer__item" itemprop="offers" itemscope="">
    <div class="offer" data-is-express-delivery="false">
        <div class="offer__store-name">
            <div class="OfferStoreInfo__inlineBlock___3rwa3">
                <span class="OfferStoreInfo__storeInfoLink___1Sv3_">
                    Vendido e entregue por <?php echo $empresa['nome']?>
                </span> <!----> <!----></div>
        </div>
        <a  class="btn-gts-track offer__wrapper"
           data-category="clique ir para a loja" data-no-turbolink="true"
           data-action="<?php echo $empresa['nome']?>" data-opt-value="click" rel="nofollow"
          >
        <figure class="offer__store-logo-wrapper" itemscope=""
                   ><span class="hidden"
                                                                    itemprop="name"><?php echo $empresa['nome']?></span><img
                    class="offer__store-logo lazy-image" alt="<?php echo $empresa['nome']?>"
                    onerror="this.src='https://www.techonline.com/img/tmp/no-image-icon.jpg';" src="<?php echo base_url('web/imagens/'.$empresa['image']) ;?>">
                <noscript><img class="offer__store-logo" alt="Biolab em Casa"
                               onerror="this.src='https://www.techonline.com/img/tmp/no-image-icon.jpg';" src="<?php echo base_url('web/imagens/'.$empresa['image']) ;?>"/>
                </noscript>
            </figure>
            <div class="offer__price">
                <meta content="BRL" itemprop="priceCurrency">
                <meta content="29.9" itemprop="price">
                <span class="offer__price-currency"></span> <strong
                    class="offer__price-value"><?php echo $this->ModelDefault->price($value['id']);?></strong></div>
            <div class="offer__infos"></div>
            <div class="offer__btn-wrapper">
                <div class="btn btn-block btn-danger" <?php if(!empty($value['link_url'])): echo 'onclick="window.open(\''.$value['link_url'].'\',\'_blank\')"'; endif;?>><span><i class="fa fa-shopping-bag"></i> COMPRAR</span></div>
                <div class="btn btn-block btn-danger" onclick="carrinhoadd(<?php echo $value['id']?>);"><span><i class="fa fa-cart-plus"></i> ADICIONAR NO CARRINHO</span></div>
                <div class="btn btn-block btn-danger" onclick="$('#modalprod<?php echo $value['id']?>').modal('show');intencao_cotacao(<?php echo $value['id']?>);"><span><i class="fa fa-gavel"></i> DAR LANCE</span></div>
            </div>
        </a></div>
</div>


<div class="modal fade" id="modalprod<?php echo $value['id']?>" tabindex="-1" role="dialog" aria-labelledby="modalprod<?php echo $value['id']?>" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Faça seu Lance</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p style="font-size: 20px;">Você quer dar um lance para adiquirir este produto? <a href="<?php echo base_url('produto/'.$value['id']);?>" style="text-decoration: none;"><?php echo $value['nome']?></a></p>
                <hr>
                <p style="margin-top: 15px"> Indique a quantidade desejada e o valor de sua proposta</p>

                <form id="darlanceform<?php echo $value['id'];?>" method="post">

                    <input type="hidden" name="id" value="<?php echo $value['id'];?>">

                    <input type="hidden" name="valoratual" value="<?php echo $value['preco'];?>">

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="large-rounded-inputpreco<?php echo $value['id'];?>" style="font-size: 15px">Minha Proposta</label>
                                <input class="form-control form-control-lg money2" name="valor" type="tel" id="large-rounded-inputpreco<?php echo $value['id'];?>" placeholder="EX: R$ <?php echo empty($value['preco']) ? $value['preco'] : ($value['preco']);?>">
                            </div>

                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="large-rounded-inputquantidade<?php echo $value['id'];?>" style="font-size: 15px">Quantidade do Produto</label>
                                <input class="form-control form-control-lg" name="quantidade" type="number" id="large-rounded-inputquantidade<?php echo $value['id'];?>" placeholder="EX: 100">
                            </div>

                        </div>
                    </div>

                    <?php if(!isset($_SESSION['ID'])):?>
                        <hr>
                        <p style="margin-top: 15px;">Preencha corretamente os campos abaixo para que as farmacias credenciadas possam entrar em contato.</p>
                        <div class="row">

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="large-rounded-inputnome<?php echo $value['id'];?>" style="font-size: 15px">Nome</label>
                                    <input class="form-control form-control-lg" name="nome" type="text" id="large-rounded-inputnome<?php echo $value['id'];?>" placeholder="Meu Nome">
                                </div>

                                <div class="form-group">
                                    <label for="large-rounded-inputemail<?php echo $value['id'];?>" style="font-size: 15px">E-mail</label>
                                    <input class="form-control form-control-lg" name="email" type="email" id="large-rounded-inputemail<?php echo $value['id'];?>" placeholder="exemplo@exemplo.com">
                                </div>
                                <div class="form-group">
                                    <label for="select-inputestado<?php echo $value['id'];?>" style="font-size: 15px">Estado</label>
                                    <select class="form-control uf" id="select-inputestado<?php echo $value['id'];?>" name="estado">
                                        <option>Selecione seu Estado...</option>
                                        <option  value="AC">Acre</option>
                                        <option  value="AL">Alagoas</option>
                                        <option  value="AP">Amapá</option>
                                        <option  value="AM">Amazonas</option>
                                        <option  value="BA">Bahia</option>
                                        <option  value="CE">Ceará</option>
                                        <option  value="DF">Distrito Federal</option>
                                        <option  value="ES">Espírito Santo</option>
                                        <option  value="GO">Goiás</option>
                                        <option  value="MA">Maranhão</option>
                                        <option  value="MT">Mato Grosso</option>
                                        <option  value="MS">Mato Grosso do Sul</option>
                                        <option  value="MG">Minas Gerais</option>
                                        <option  value="PA">Pará</option>
                                        <option  value="PB">Paraíba</option>
                                        <option  value="PR">Paraná</option>
                                        <option  value="PE">Pernambuco</option>
                                        <option  value="PI">Piauí</option>
                                        <option  value="RJ">Rio de Janeiro</option>
                                        <option  value="RN">Rio Grande do Norte</option>
                                        <option  value="RS">Rio Grande do Sul</option>
                                        <option  value="RO">Rondônia</option>
                                        <option  value="RR">Roraima</option>
                                        <option  value="SC">Santa Catarina</option>
                                        <option  value="SP">São Paulo</option>
                                        <option  value="SE">Sergipe</option>
                                        <option  value="TO">Tocantins</option>

                                    </select>


                                </div>
                            </div>

                            <div class="col-sm-6">

                                <div class="form-group">
                                    <label for="large-rounded-inputcep<?php echo $value['id'];?>" style="font-size: 15px">CEP</label>
                                    <input class="form-control form-control-lg cep" name="tel" type="text" id="large-rounded-inputcep<?php echo $value['id'];?>" placeholder="00000-000">
                                </div>


                                <div class="form-group">
                                    <label for="large-rounded-inputcidade<?php echo $value['id'];?>" style="font-size: 15px">Cidade</label>
                                    <input class="form-control form-control-lg cidade" name="cidade" type="text" id="large-rounded-inputcidade<?php echo $value['id'];?>" placeholder="Minha Cidade">
                                </div>

                                <div class="form-group">
                                    <label for="large-rounded-inputtelefone<?php echo $value['id'];?>" style="font-size: 15px">Telefone</label>
                                    <input class="form-control form-control-lg phone_with_ddd" name="telefone" type="tel" id="large-rounded-inputtelefone<?php echo $value['id'];?>" placeholder="(00) 00000-0000">
                                </div>
                            </div>



                        </div>
                    <?php endif;?>

                </form>
            </div>
            <div class="modal-footer">
                <div>
                    <input type="checkbox" required id="aceito_termos" name="aceito_termos">
                    <label for="aceito_termos">Ao enviar a proposta declaro que aceito os <a href="<?php echo base_url(''); ?>pagina/termos-de-uso" target="_blank">Termos e Condições de Uso</a> do Site</label>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline-secondary btn-sm" type="button" data-dismiss="modal">Fechar</button>
                <button class="btn btn-primary btn-sm" type="button" onclick="enviar_proposta(<?php echo $value['id'];?>);">Enviar Proposta</button>
            </div>
        </div>
    </div>
</div>