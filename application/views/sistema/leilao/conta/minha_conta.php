<section class="lightSection clearfix pageHeader">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="page-title">
                    <h2>MINHA CONTA</h2>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb float-right">
                    <li>
                        <a href="<?php echo base_url('');?>">Inicio</a>
                    </li>
                    <li class="active">MINHA CONTA</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="mainContent clearfix userProfile">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="btn-group" role="group" aria-label="...">
                    <a href="<?php echo base_url('minha-conta');?>" class="btn btn-default <?php if($this->uri->segment(2) == ''): echo 'active'; endif;?>"><i class="fa fa-th" aria-hidden="true"></i>Meus Dados</a>
                   <a href="<?php echo base_url('minha-conta/lances');?>" class="btn btn-default <?php if($this->uri->segment(2) == 'lances'): echo 'active'; endif;?>"><i class="fa fa-list" aria-hidden="true"></i>Lances</a>
                   <a href="<?php echo base_url('minha-conta/lotes-arrematados');?>" class="btn btn-default <?php if($this->uri->segment(2) == 'lotes-arrematados'): echo 'active'; endif;?>"><i class="fa fa-list" aria-hidden="true"></i>Lotes Arrematados</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="innerWrapper">


                    <?php


                    if(isset($_POST['id_docs'])):
                        $dps['CPF'] = '';
                        $dps['COMPROVANTE_ENDERECO'] = '';
                        $dps['RG'] = '';
                        $dps['visualizado'] = 0;
                        $dps['respondido'] = 0;
                        $dps['RG'] = '';
                        $dps['cadastro'] = $_SESSION['ID'];

                        if(isset($_FILES['CPF']))
                        {
                            $ext = strtolower(substr($_FILES['CPF']['name'],-4));
                            $new_name = date('dmY') . '_' . rand(). $ext;
                            $dir = $_SERVER['DOCUMENT_ROOT'] . "/web/imagens/";

                            if(move_uploaded_file($_FILES['CPF']['tmp_name'], $dir.$new_name)){

                                echo '  <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        Aviso! CPF Enviado com Sucesso
                    </div>';
                                $dps['CPF'] = $new_name;

                            }else{
                                echo '      <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        Aviso! Erro ao enviar CPF
                    </div>';
                            }
                        }

                        if(isset($_FILES['RG']))
                        {
                            $ext = strtolower(substr($_FILES['RG']['name'],-4));
                            $new_name = date('dmY') . '_' . rand(). $ext;
                            $dir = $_SERVER['DOCUMENT_ROOT'] . "/web/imagens/";

                            if(move_uploaded_file($_FILES['RG']['tmp_name'], $dir.$new_name)){

                                echo '  <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        Aviso! RG Enviado com Sucesso
                    </div>';
                                $dps['RG'] = $new_name;

                            }else{
                                echo '      <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        Aviso! Erro ao enviar RG
                    </div>';
                            }
                        }

                        if(isset($_FILES['COMPROVANTE_ENDERECO']))
                        {
                            $ext = strtolower(substr($_FILES['COMPROVANTE_ENDERECO']['name'],-4));
                            $new_name = date('dmY') . '_' . rand(). $ext;
                            $dir = $_SERVER['DOCUMENT_ROOT'] . "/web/imagens/";

                            if(move_uploaded_file($_FILES['COMPROVANTE_ENDERECO']['tmp_name'], $dir.$new_name)){

                                echo '  <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        Aviso! COMPROVANTE DE RESIDENCIA Enviado com Sucesso
                    </div>';

                                $dps['COMPROVANTE_ENDERECO'] = $new_name;
                            }else{
                                echo '      <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        Aviso! Erro ao enviar COMPROVANTE DE RESIDÊNCIA
                    </div>';
                                $dps['COMPROVANTE_ENDERECO'] = '';

                            }
                        }


                        $this->db->select('id');
                        $this->db->from('documentos');
                        $this->db->where('cadastro',$_SESSION['ID']);
                        $get = $this->db->get();
                        $count = $get->num_rows();
                        if($count > 0):

                            $this->db->where('cadastro',$_SESSION['ID']);
                            $this->db->update('documentos',$dps);

                        else:

                            $this->db->insert('documentos',$dps);

                        endif;




                        endif;

                    ?>

                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        Aviso! Ao arrematar um produto verifique todos os dados do termo de arrematação
                    </div>
                    <h3>Bem Vindo <span><?php echo $_SESSION['NAME'];?></span></h3>


                    <?php if(!isset($_GET['enviar_docs'])):?>
                    <div class="orderBox">
                        <h4>DADOS CADASTRAIS</h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>NOME</th>
                                    <th>EMAIL</th>
                                    <th>LOGIN</th>
                                    <th>CPF</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><?php echo $usuario['nome'];?></td>
                                    <td><?php echo $usuario['email'];?></td>
                                    <td><?php echo $usuario['user'];?></td>
                                    <td><?php echo $usuario['cpf'];?></td>
                                    <td><a href="javascript:$('#alterardados').modal('show');" class="btn btn-sm btn-secondary-outlined">ALTERAR</a></td>
                                </tr>
                                </tbody>
                            </table>

                            <br>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>NASC</th>
                                    <th>SEXO</th>
                                    <th>TELEFONE</th>
                                    <th>CELULAR</th>
                                    <th>ENDERECO</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><?php echo $usuario['data_nasc'];?></td>
                                    <td><?php echo $usuario['sexo'];?></td>
                                    <td><?php echo $usuario['telefone'];?></td>
                                    <td><?php echo $usuario['celular'];?></td>
                                    <td><?php echo $usuario['endereco'];?></td>
                                    <td><a href="javascript:$('#alterardados').modal('show');" class="btn btn-sm btn-secondary-outlined">ALTERAR</a></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php endif;?>

                    <div class="orderBox">
                        <h4>DOCUMENTAÇÕES E HABILITAÇÕES</h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Habilitado para Participar</th>
                                    <th>Bloqueado por Inadimplência</th>

                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><?php echo ($usuario['validado'] == 1) ? 'Habilitado para dar Lances': 'Aguardando Envio/Validação de Documentos';?></td>
                                    <td><?php echo ($usuario['inadimplente'] == 1) ? 'SIM': 'NÃO';?></td>
                                    <td><a href="javascript:$('#enviardocumentos').modal('show');$('.example-1').removeClass('example-1');" class="btn btn-sm btn-secondary-outlined example-1">GERENCIAR</a></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade " id="alterardados" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-lg">
            <div class="modal-header justify-content-center">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title">Alterar Dados</h3>
            </div>
            <div class="modal-body">
                <form action="javascript:alterardados();" method="POST" role="form" id="formalteradados">

                    <div style="padding: 10px 15px 10px 15px;">
                        <div class="row">

                            <input type="hidden" name="id" value="<?php echo $usuario['id'];?>">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nome">Nome Completo</label>
                                    <input type="text" class="form-control nome" id="nome" name="nome" value="<?php echo $usuario['nome'];?>">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">E-mail</label>
                                    <input type="email" class="form-control email" id="email" name="email" value="<?php echo $usuario['email'];?>">
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cpf">CPF</label>
                                    <input type="text" class="form-control cpf" id="cpf" name="cpf" value="<?php echo $usuario['cpf'];?>">
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="rg">RG</label>
                                    <input type="text" class="form-control rg" id="rg" name="rg" value="<?php echo $usuario['rg'];?>">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sexo">Sexo</label>

                                    <select class="form-control sexo" name="sexo" id="sexo">
                                        <option value="Masculino">Masculino</option>
                                        <option  value="Feminino">Feminino</option>
                                    </select>


                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nascimento">Data de Nascimento</label>
                                    <input type="text" class="form-control date" id="nascimento" value="<?php echo $usuario['data_nasc'];?>" name="nascimento">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="telefone">Telefone</label>
                                    <input type="text" class="form-control phone_with_ddd" id="telefone" value="<?php echo $usuario['telefone'];?>" name="telefone">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="celular">Celular</label>
                                    <input type="text" class="form-control phone_with_dddcel" id="celular" value="<?php echo $usuario['celular'];?>" name="celular">
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="cep">CEP</label>
                                    <input type="text" class="form-control cep" id="cep" name="cep" value="<?php echo $usuario['cep'];?>">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="endereco">Endereço</label>
                                    <input type="text" class="form-control rua" id="endereco" name="endereco" value="<?php echo $usuario['endereco'];?>">
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="numero">Número</label>
                                    <input type="text" class="form-control numero" id="numero" name="numero" value="<?php echo $usuario['numero'];?>">
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="complemento">Complemento</label>
                                    <input type="text" class="form-control complemento" id="complemento" value="<?php echo $usuario['complemento'];?>" name="complemento">
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="bairro">Bairro</label>
                                    <input type="text" class="form-control bairro" id="bairro" name="bairro" value="<?php echo $usuario['bairro'];?>">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="cidade">Cidade</label>
                                    <input type="text" class="form-control cidade" id="cidade" name="cidade" value="<?php echo $usuario['cidade'];?>">
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="estado">Estado</label>
                                    <input type="text" class="form-control uf" id="estado" name="estado" value="<?php echo $usuario['estado'];?>">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="pais">País</label>
                                    <input type="text" class="form-control pais" id="pais" name="pais" value="<?php echo $usuario['pais'];?>">
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nick">Nick</label>
                                    <input type="text" class="form-control nick" id="nick" name="nick" value="<?php echo $usuario['user'];?>">
                                </div>
                            </div>




                            <button type="submit" class="btn btn-primary btn-block">ALTERAR DADOS CADASTRAIS</button>


                            <h3 id="blockcads" style="float: left;width: 100%;text-align: center;"></h3>

                        </div>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>



<div class="modal fade " id="enviardocumentos" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-lg">
            <div class="modal-header justify-content-center">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title">ENVIAR DOCUMENTOS</h3><br/>
                
            </div>
            <p><h4>&nbsp;&nbsp;OS ARQUIVOS NÃO DEVEM EXCEDER 1MB POR ARQUIVO</h4></p>

            <p><h4 style="padding-left:1%">Caso não consiga fazer Upload de Seus Documentos, favor enviá-los para o e-mail: dayanna@bolsadeleiloes.com.br</h4></p>
            
            <div class="modal-body">
                <form action="<?php echo base_url('minha-conta')?>" method="POST" role="form" enctype="multipart/form-data">

                    <div style="padding: 10px 15px 10px 15px;">
                        <div class="row">

                            <input type="hidden" name="id_docs" value="<?php echo $usuario['id'];?>">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nome">CPF (tamanho max.:1Mb)</label>
                                    <input type="file" class="form-control" id="CPF" name="CPF" style="margin-bottom: 5px;" />
                                </div>
                                <?php if(isset($documentos['CPF']) and !empty($documentos['CPF'])): echo '<a href="'.base_url('web/imagens/'.$documentos['CPF']).' " class="btn btn-primary text-white" target="_blank" style="color: black;margin-bottom: 10px;">VISUALIZAR CPF</a>'; endif;?>

                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nome">RG (tamanho max.:1Mb)</label>
                                    <input type="file" class="form-control" id="RG" name="RG" style="margin-bottom: 5px;" />
                                </div>
                                <?php if(isset($documentos['RG']) and !empty($documentos['RG'])): echo '<a href="'.base_url('web/imagens/'.$documentos['RG']).'" target="_blank" class="btn btn-primary text-white" style="color: black;margin-bottom: 10px;">VISUALIZAR RG</a>'; endif;?>

                            </div>
                            <div class="clearfix"></div>
                            <br>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <br>
                                    <label for="nome">COMPROVANTE DE RESIDENCIA (tamanho max.:1Mb)</label>
                                    <input type="file" class="form-control" id="COMPROVANTE_ENDERECO" name="COMPROVANTE_ENDERECO" style="margin-bottom: 5px;" />
                                </div>
                                <?php if(isset($documentos['COMPROVANTE_ENDERECO']) and !empty($documentos['COMPROVANTE_ENDERECO'])): echo '<a class="btn btn-primary text-white" href="'.base_url('web/imagens/'.$documentos['COMPROVANTE_ENDERECO']).'" target="_blank" style="color: black;margin-bottom: 10px;">VISUALIZAR COMPROVANTE DE RESIDÊNCIA</a>'; endif;?>
                                <br> <br>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block">ENVIAR DOCUMENTOS</button>


                            <h3 id="blockcads" style="float: left;width: 100%;text-align: center;"></h3>

                        </div>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>

