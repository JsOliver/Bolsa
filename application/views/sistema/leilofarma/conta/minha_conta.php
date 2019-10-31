<?php $array['usuario'] = $usuario; $this->load->view('sistema/leilofarma/conta/z_top/topo',$array); ?>



        <div class="col mt-3 mt-md-0" >
            <div class="card">
                <div class="card-body">

                    <style>
                        .form-item {
                            font-size:14px!important;
                            margin-left:-13px;
                        }
                    </style>

                    <?php if(!isset($_GET['page'])):?>
                    <div class="coluna-conta">
                        <h3>Meu Perfil</h3><hr style="margin-bottom:10px;">
                        <form class="form-style-1"  method="post" action="javascript:alterardados();" id="formlogs">
                            <div class="form-row">
                                <div class="form-group col-sm-6">
                                    <label for="nome">Nome</label>
                                    <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $usuario['nome'];?>">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="email">Meu E-mail</label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $usuario['email'];?>" disabled>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="telefone">Meu Telefone</label>
                                    <input type="text" class="form-control phone_with_ddd" id="telefone" name="telefone" value="<?php echo $usuario['telefone'];?>">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="cep">Meu CEP</label>
                                    <input type="text" class="form-control cep" id="cep" name="cep" value="<?php echo $usuario['cep'];?>">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="endereco">Meu Endereço</label>
                                    <input type="text" class="form-control" id="endereco" name="endereco" value="<?php echo $usuario['endereco'];?>">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="estado">Meu Estado</label>
                                    <select name="estado" id="estado"  class="form-control">
                                        <option <?php if($usuario['estado'] == 'AC'): echo 'selected'; endif;?> value="AC">Acre</option>
                                        <option <?php if($usuario['estado'] == 'AL'): echo 'selected'; endif;?> value="AL">Alagoas</option>
                                        <option <?php if($usuario['estado'] == 'AP'): echo 'selected'; endif;?> value="AP">Amapá</option>
                                        <option <?php if($usuario['estado'] == 'AM'): echo 'selected'; endif;?> value="AM">Amazonas</option>
                                        <option <?php if($usuario['estado'] == 'BA'): echo 'selected'; endif;?> value="BA">Bahia</option>
                                        <option <?php if($usuario['estado'] == 'CE'): echo 'selected'; endif;?> value="CE">Ceará</option>
                                        <option <?php if($usuario['estado'] == 'DF'): echo 'selected'; endif;?> value="DF">Distrito Federal</option>
                                        <option <?php if($usuario['estado'] == 'ES'): echo 'selected'; endif;?> value="ES">Espírito Santo</option>
                                        <option <?php if($usuario['estado'] == 'GO'): echo 'selected'; endif;?> value="GO">Goiás</option>
                                        <option <?php if($usuario['estado'] == 'MA'): echo 'selected'; endif;?> value="MA">Maranhão</option>
                                        <option <?php if($usuario['estado'] == 'MT'): echo 'selected'; endif;?> value="MT">Mato Grosso</option>
                                        <option <?php if($usuario['estado'] == 'MS'): echo 'selected'; endif;?> value="MS">Mato Grosso do Sul</option>
                                        <option <?php if($usuario['estado'] == 'MG'): echo 'selected'; endif;?> value="MG">Minas Gerais</option>
                                        <option <?php if($usuario['estado'] == 'PA'): echo 'selected'; endif;?> value="PA">Pará</option>
                                        <option <?php if($usuario['estado'] == 'PB'): echo 'selected'; endif;?> value="PB">Paraíba</option>
                                        <option <?php if($usuario['estado'] == 'PR'): echo 'selected'; endif;?> value="PR">Paraná</option>
                                        <option <?php if($usuario['estado'] == 'PE'): echo 'selected'; endif;?> value="PE">Pernambuco</option>
                                        <option <?php if($usuario['estado'] == 'PI'): echo 'selected'; endif;?> value="PI">Piauí</option>
                                        <option <?php if($usuario['estado'] == 'PI'): echo 'selected'; endif;?> value="PI">Rio de Janeiro</option>
                                        <option <?php if($usuario['estado'] == 'RN'): echo 'selected'; endif;?> value="RN">Rio Grande do Norte</option>
                                        <option <?php if($usuario['estado'] == 'RS'): echo 'selected'; endif;?> value="RS">Rio Grande do Sul</option>
                                        <option <?php if($usuario['estado'] == 'RO'): echo 'selected'; endif;?> value="RO">Rondônia</option>
                                        <option <?php if($usuario['estado'] == 'RR'): echo 'selected'; endif;?> value="RR">Roraima</option>
                                        <option <?php if($usuario['estado'] == 'SC'): echo 'selected'; endif;?> value="SC">Santa Catarina</option>
                                        <option <?php if($usuario['estado'] == 'SP'): echo 'selected'; endif;?> value="SP">São Paulo</option>
                                        <option <?php if($usuario['estado'] == 'SE'): echo 'selected'; endif;?> value="SE">Sergipe</option>
                                        <option <?php if($usuario['estado'] == 'TO'): echo 'selected'; endif;?> value="TO">Tocantins</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="cidade">Minha Cidade</label>
                                    <input type="text" class="form-control" id="cidade" name="cidade" value="<?php echo $usuario['cidade'];?>">
                                </div>
                                <div class="form-group col-12">
                                    <button type="button" class="btn btn-primary" onclick="alterardados();">ATUALIZAR PERFIL</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <?php endif;?>

                    <?php if(isset($_GET['page']) and $_GET['page'] == 'meus-lances'): ?>

                        <?php

                        $this->db->from('lances_propostas');
                        $this->db->where('usuario',$_SESSION['ID']);
                        $this->db->order_by('id','desc');
                        $get = $this->db->get();
                        $count = $get->num_rows();

                        if($count > 0):
                            $result = $get->result_array();


                            ?>
                            <br>
                            <br>

                            <h5>Meus Arremates:</h5>
                            <hr>
                            <div class="table-responsive">
                            <table class="table table-hover" data-addclass-on-xs="table-sm">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">Data</th>
                                <th scope="col" class="text-right">Detalhes</th>
                                <th scope="col" class="text-right">Produto</th>
                                <th scope="col" class="text-right">Valor Original</th>
                                <th scope="col" class="text-right">Valor Ofertado</th>
                                <th scope="col" class="text-right">Unidades</th>
                                <th scope="col" class="text-center">Status do Lance</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            foreach ($result as $value) {


                                $this->db->from('produtos');
                                $this->db->where('id',$value['produto']);
                                $this->db->order_by('id','desc');
                                $get = $this->db->get();
                                $count = $get->num_rows();


                                if($count > 0):


                                    $produto = $get->result_array()[0];


                                    ?>
                                    <tr>
                                        <td></td>
                                        <td><img onerror="this.src='<?php echo base_url('web/default.jpg');?>'" src="<?php echo empty($produto['image_externa']) ? base_url('web/imagens/').$produto['image'] : $produto['image_externa'];?>" style="width: 100px;" /> </td>
                                        <td class="text-right"><a href="<?php echo base_url('oferta/'.$produto['id']);?>" target="_blank" style="text-decoration: none;color:#ed770d;"><?php echo $produto['nome'];?></a></td>
                                        <td class="text-right"><?php echo $value['valor'];?></td>
                                        <td class="text-right"><?php echo $value['proposta'];?></td>
                                        <td class="text-right"><?php echo $value['quantidades'];?></td>
                                        <td class="text-center"><span class="badge badge-warning rounded">

                                            <?php if(($value['resposta']) == 1):?>

                                                Proposta Aceita, o Parceiro Responsável Entrara em Contato

                                            <?php elseif(($value['resposta']) == 2):?>

                                                Proposta Recusada pelo Parceiro

                                            <?php else:?>

                                                Aguardando Análise

                                            <?php endif;?>


                                        </span></td>
                                    </tr>

                                <?php endif;  }   endif;?>
                        </tbody>
                        </table>
                        </div>
                    <?php endif;?>






                </div>
            </div>
        </div>

<?php $this->load->view('sistema/leilofarma/conta/z_top/rodape',$array); ?>
