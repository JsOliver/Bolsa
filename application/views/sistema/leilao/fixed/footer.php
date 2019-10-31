
<!-- FOOTER -->
<div class="footer clearfix">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-12">

            </div>
            <div class="col-md-2 col-12">
                <div class="footerLink">
                    <h5>Informações</h5>

                    <ul class="list-inline">
                        <li><a href="#" style="font-size: 12px;">Quem Somos</a></li>
                        <li><a href="#" style="font-size: 12px;">Termos de Uso</a></li>
                        <li><a href="#" style="font-size: 12px;">Perguntas Frequentes</a></li>
                        <li><a href="#" style="font-size: 12px;">Fale Conosco</a></li>

                    </ul>
                </div>
            </div>
       <div class="col-md-2 col-12">
                <div class="footerLink">
                    <h5>Serviços</h5>

                    <ul class="list-inline">

                    </ul>
                </div>
            </div>

            <div class="col-md-2 col-12">
                <div class="footerLink">
                    <h5>Minha Conta</h5>

                    <ul class="list-inline">
                        <li><a href="#" style="font-size: 12px;">Cadastre-se</a></li><br>
                        <li><a href="#" style="font-size: 12px;">Login</a></li><br>
                        <li><a href="#" style="font-size: 12px;">Esqueci minha senha</a></li>

                    </ul>
                </div>
            </div>
            <div class="col-md-3 col-12">
                <div class="newsletter clearfix">
                    <h4>Newsletter</h4>
                    <h3>Cadastre-se Já</h3>
                    <p>Cadastre-se na nossa newslatter e receba novidades diretamente no seu e-mail!</p>
                    <div class="input-group">
                        <input type="text" class="form-control"  aria-describedby="basic-addon2">
                        <a href="#" class="input-group-addon" id="basic-addon2">Ir <i class="fa fa-chevron-right"></i></a>
                    </div>

                </div>
            </div>

            <div style="color:white; font-size:18px; float:left;">Anel Rodoviário Celso Mello Azevedo, 3713 - Bonsucesso, Belo Horizonte - MG. CEP: 30622-213

            <br/><br/>Telefones: (31) 3422-6739 / 3383-1063</div>
            <br><br>
            <div style="color:white; font-size:18px; float:left;"><br>SÃO PAULO .: CD Via Varejo 710 – Castanho, Jundiaí – SP.



                <br/><br/></div>
        </div>
    </div>
    
</div>

<div class="copyRight clearfix">
    <div class="container">
        <div class="row">
            <div class="col-md-7 col-12">
                <p>&copy; 2019 Bolsa de Leilões. Desenvolvido por  <a target="_blank" href="https://jdlsites.com">Agência JDL</a>.</p>
            </div>

        </div>
    </div>
</div>
</div>
<?php if ($this->ModelDefault->session() == false):?>
<div class="modal fade login-modal" id="login" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <h3 class="modal-title">Acessar</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <form action="javascript:login();" method="POST" role="form" id="loginforms">
                    <div class="form-group">
                        <label for="">E-mail ou Usuario</label>
                        <input type="text" class="form-control" id="user" name="user">
                    </div>
                    <div class="form-group">
                        <label for="">Senha</label>
                        <input type="password" class="form-control" id="pass" name="pass">
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Acessar</button>
                    <button type="button" class="btn btn-link btn-block">Esqueceu sua Senha?</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade " id="signups" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-lg">
            <div class="modal-header justify-content-center">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title">Criar minha conta</h3>
            </div>
            <div class="modal-body">
                <form action="javascript:cadastro();" method="POST" role="form" id="formcadastro">

                    <div style="padding: 10px 15px 10px 15px;">
                    <div class="row">


                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nome">Nome Completo *</label>
                                <input type="text" class="form-control nome" id="nome" name="nome" required="required">
                            </div>
                        </div>

                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">E-mail *</label>
                            <input type="email" class="form-control email" id="email" name="email" required="required">
                        </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cpf">CPF ou CNPJ*</label>
                                <input type="text" class="form-control cpfCnpj" id="cpfcnpj" name="cpf" required="required" maxlength="14">
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="rg">RG</label>
                                <input type="text" class="form-control rg" id="rg" name="rg" required="required">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="sexo">Sexo *</label>

                                <select class="form-control sexo" id="sexo" name="sexo" required="required">
                                    <option value="Masculino">Masculino</option>
                                    <option  value="Feminino">Feminino</option>
                                </select>


                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nascimento">Data de Nascimento</label>
                                <input type="text" class="form-control date" id="nascimento" name="nascimento" required="required">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="telefone">Telefone *</label>
                                <input type="text" class="form-control phone_with_ddd" id="telefone" name="telefone" required="required">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="celular">Celular</label>
                                <input type="text" class="form-control phone_with_dddcel" id="celular" name="celular">
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="cep">CEP *</label>
                                <input type="text" class="form-control cep" id="cep" name="cep" required="required">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="endereco">Endereço *</label>
                                <input type="text" class="form-control rua" id="endereco" name="endereco" required="required">
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="numero">Número *</label>
                                <input type="text" class="form-control numero" id="numero" name="numero" required="required">
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="complemento">Complemento</label>
                                <input type="text" class="form-control complemento" id="complemento" name="complemento">
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="bairro">Bairro *</label>
                                <input type="text" class="form-control bairro" id="bairro" name="bairro" required="required">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="cidade">Cidade *</label>
                                <input type="text" class="form-control cidade" id="cidade" name="cidade" required="required">
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="estado">Estado *</label>
                                <input type="text" class="form-control uf" id="estado" name="estado" required="required">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="pais">País *</label>
                                <input type="text" class="form-control pais" id="pais" name="pais" required="required">
                            </div>
                        </div>


                        <div class="col-md-6">
                        <div class="form-group">
                        <label for="nick">Apelido *</label>
                        <input type="text" class="form-control nick" id="nick" name="nick" required="required">
                        </div>
                        </div>

                        <div class="col-md-6">
                        <div class="form-group">
                        <label for="pass">Senha *</label>
                        <input type="password" class="form-control pass" id="pass" name="pass" required="required">
                        </div>
                        </div>



                    <button type="submit" class="btn btn-primary btn-block">Cadastre-se</button>
                    <button type="button" onclick="abrirlogin();" class="btn btn-link btn-block">Já Possui conta?</button>


                        <h3 id="blockcads" style="float: left;width: 100%;text-align: center;"></h3>

                    </div>
                    </div>
                </form>

                </div>

        </div>
    </div>
</div>
<?php endif;?>


<script>
    $(document).ready(function(e) {
        $(".cpfCnpj").unmask();
        $(".cpfCnpj").focusout(function() {
            $(".cpfCnpj").unmask();
            var tamanho = $(".cpfCnpj").val().replace(/\D/g, '').length;
            if (tamanho == 11) {
                $(".cpfCnpj").mask("999.999.999-99");
            } else if (tamanho == 14) {
                $(".cpfCnpj").mask("99.999.999/9999-99");
                document.getElementById("rg").required = false;
                document.getElementById("nascimento").required = false;

            }else if(tamanho < 11){
                $(".cpfCnpj").val('');
            }
            else if(tamanho > 14){
                $(".cpfCnpj").val('');
            }
        });
        $(".cpfCnpj").focusin(function() {
            $(".cpfCnpj").unmask();
        });
    });
</script>
</body>

</html>

