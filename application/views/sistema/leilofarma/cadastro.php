<section class="section white-backgorund">
    <div class="container">
        <div class="row" style="margin-top: 30px;margin-bottom: 35px;">
            <!-- start sidebar -->
            <div class="col-sm-3">
                <div class="widget">
                    <figure>
                        <a href="javascript:void(0);">
                        </a>
                    </figure>
                </div><!-- end widget -->
            </div><!-- end col -->
            <!-- end sidebar -->
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-12 text-left">
                        <h2 class="title" style="margin-top:20px;">Criar uma conta</h2>
                    </div><!-- end col -->
                </div><!-- end row -->

                <div class="row">
                    <div class="col-sm-12 col-md-10 col-lg-12">
                        <form class="form-horizontal" method="post" action="javascript:cadastro();">


                                <div class="col-sm-6">
                                    <div class="form-group" >
                                    <label for="name">Nome <span class="text-danger">*</span></label>

                                    <input type="text" class="form-control input-md" id="name" name="nome" placeholder="Nome" required>
                                </div>
                            </div><!-- end form-group -->

                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label for="email">Email <span class="text-danger">*</span></label>

                                    <input type="email" class="form-control input-md" id="email" name="email" placeholder="Email" required>
                                </div>
                            </div>

                            <div class="col-sm-6">
                            <div class="form-group">
                                <label for="large-rounded-inputcep" style="font-size: 15px">Seu CEP <span class="text-danger">*</span></label>
                                <input class="form-control form-control-lg cep" name="cep" required type="text" id="large-rounded-inputcep" placeholder="00000-000">
                            </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="large-rounded-inputcidade" style="font-size: 15px">Sua Cidade <span class="text-danger">*</span></label>
                                    <input class="form-control form-control-lg cidade" name="cidade" required type="text" id="large-rounded-inputcidade" placeholder="Minha Cidade">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="select-inputestado" style="font-size: 15px">Seu Estado <span class="text-danger">*</span></label>
                                    <select class="form-control uf" id="select-inputestado" name="estado" required>
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
                                    <label for="large-rounded-inputtelefone" style="font-size: 15px">Seu Telefone <span class="text-danger">*</span></label>
                                    <input class="form-control form-control-lg phone_with_ddd" name="telefone" type="tel" id="large-rounded-inputtelefone" required placeholder="(00) 00000-0000">
                                </div>
                            </div>
                            <div class="col-sm-12">
                            <div class="form-group">

                                    <label for="password">Senha <span class="text-danger">*</span></label>

                                    <input type="password" class="form-control input-md" id="pass" name="pass" placeholder="Senha" required>
                                </div>
                            </div>
                                <div class="col-sm-12">
                                    <a href="javascript:cadastro();" class="btn btn-default round btn-md" style="margin-top: 20px; width:100%; background: #ec7000!important; border-color: #ec7000!important; color: #fff; ">Cadastrar</a>
                                </div>
                            </div><!-- end form-group -->

                        </form>
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end col -->
        </div><!-- end row -->
    </div><!-- end container -->
</section>

