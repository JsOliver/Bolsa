
    <div class="product-block" data-component="ProductBlock" data-link="#">
        <div class="product-block__top-info">
            <div class="product-block__image-wrapper">
                <a href="<?php echo base_url('produto/'.$value['id']);?>">
                    <img class="product-block__image" onerror="this.src='https://www.techonline.com/img/tmp/no-image-icon.jpg';" src="<?php echo empty($value['image']) ? $value['image_externa']: base_url('web/imagens/'.$value['image']) ;?>" alt=""/>
                </a>
            </div>


            <h4 class="product-block__title has-presentations">
                <a href="#"><span class="product-block__product-name" data-ellipsis="2"><?php echo $value['nome'];?></span>
                    <div class="product-block__presentations" style="display:none;"><i
                            class="product-block__classification is-medium cr-icon-medicine-similar"
                            data-placement="top" data-toggle="tooltip" title="Similar"></i>1
                        apresentação
                    </div>
                </a>
            </h4>


        </div>
        <div class="product-block__cta-wrapper">
            <a class="product-block__meta-info product-block__price" href="#">

                <div>
                    <div class="product-block__starting-price-label">A partir de</div>
                    <div class="product-block__starting-price-value">R$ <strong> <?php echo number_format($value['preco'],2,',','.');?></strong></div>
                    <div class="product-block__pharmacy-offers" style="display:none;">em <strong>20</strong> farmácias</div>
                </div>
            </a>
            <br>
            <a class="btn btn-success product-block__button product-block__button--uppercase left-button"  href="javascript:$('#modalprod<?php echo $value['id'];?>').modal('show');" onclick="$('#modalprod<?php echo $value['id']?>').modal('show');intencao_cotacao(<?php echo $value['id']?>);"><i class="fa fa-gavel"></i> Dar Lance </a>
            <a class="btn btn-success product-block__button product-block__button--uppercase right-button" <?php if(!empty($value['link_url'])): echo 'href="'.$value['link_url'].'" target="_blank"'; endif;?> ><i class="fa fa-shopping-bag"></i> Comprar</a>

            <a class="btn btn-success product-block__button product-block__button--uppercase left-button" href="<?php echo base_url('produto/'.$value['id']);?>?compare=true"><i class="fa fa-retweet"></i> Compare </a>
            <a class="btn btn-success product-block__button product-block__button--uppercase right-button" href="javascript:carrinhoadd(<?php echo $value['id']?>);"><i class="fa fa-cart-plus"></i> Add Carrinho</a>
        </div>
    </div>

    <div class="modal fade" id="modalprod<?php echo $value['id']?>" tabindex="-1" role="dialog" aria-labelledby="modalprod<?php echo $value['id']?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Faça seu Lance</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <p style="font-size: 20px;">Você quer dar um lance para adiquirir este produto? <a href="#" style="text-decoration: none;"><?php echo $value['nome'];?></a></p>
                    <hr>
                    <p style="margin-top: 15px"> Indique a quantidade desejada e o valor de sua proposta</p>

                    <form id="darlanceform<?php echo $value['id'];?>" method="post">

                        <input type="hidden" name="id" value="<?php echo $value['id'];?>">

                        <input type="hidden" name="valoratual" value="<?php echo $value['id'];?>">

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="large-rounded-inputpreco<?php echo $value['id'];?>" style="font-size: 15px">Minha Proposta</label>
                                    <input class="form-control form-control-lg money2" name="valor" type="tel" id="large-rounded-inputpreco<?php echo $value['id'];?>" placeholder="EX: R$ <?php echo empty($value['preco']) ? $value['preco'] : ($value['id']);?>">
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
                                        <input class="form-control form-control-lg cep" name="cep" type="tel" id="large-rounded-inputcep<?php echo $value['id'];?>" placeholder="00000-000">
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