<div id="content-container">
    <div id="page-head">
        <style>
            .table{
                overflow-x: scroll;
            }

        </style>

    </div>


    <div id="page-content" style="overflow-x: scroll!important;">


        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title" id="button">Minha Tabela</h3>

            </div>


            <div class="clearfixs"></div>
            <br>
            <div class="panel-body">


                <div class="table-responsive">
                    <table id="example" class="table">
                        <thead>

                        <tr>
                            <td>Leilão</td>
                            <td>Lote</td>
                            <td>Valor Arrematado</td>
                            <td>Valor Total</td>
                            <td>Situação</td>
                            <td>Nome</td>
                            <td>E-mail</td>
                            <td>Telefone</td>
                            <td>CPF</td>
                            <td>RG</td>
                            <td>ENDEREÇO</td>
                            <td>CIDADE</td>
                            <td>ESTADO</td>
                        </tr>
                        </thead>
                        <tbody>

                        <?php

                        $this->db->select('nome');
                        $this->db->from('leiloes');
                        $this->db->where('id',$_GET['id']);
                        $get = $this->db->get();

                        $leilao = $get->result_array()[0];

                        $this->db->from('lotes');
                        $this->db->where('leiloes',$_GET['id']);
                        $get = $this->db->get();

                        $count = $get->num_rows();

                        if($count > 0):
                            $result = $get->result_array();

                        foreach ($result as $value){

                            if($value['arrematante'] > 0):
                            $this->db->from('usuarios');
                            $this->db->where('id',$value['arrematante']);
                            $get = $this->db->get();

                                $usuario = $get->result_array()[0];
endif;
                        ?>
                        <tr>
                            <td><?php echo $leilao['nome'];?></td>
                            <td>LOTE Nª <?php echo $value['nlote'];?></td>
                                <td>R$ <?php echo $value['lance_atual'];?></td>
                            <td>R$ <?php echo ($value['lance_atual'] == 0) ? 0 :@number_format((($value['lance_atual'] + (($value['lance_atual'] / 100) * 5)) + 220),2,'.',',');?></td>
                            <td><?php


                                if($value['stats'] == 3):
                                    echo 'Arrematado';
                                elseif ($value['stats'] == 4):
                                    echo 'Em Condicional';
                                elseif ($value['stats'] == 5):
                                    echo 'Finalizado';

                                    else:

                                endif;

                                ?></td>

                            <?php if($value['arrematante'] > 0):?>
                            <td><?php echo $usuario['nome'];?></td>
                            <td><?php echo $usuario['email'];?></td>
                            <td><?php echo $usuario['telefone'];?></td>
                            <td><?php echo $usuario['cpf'];?></td>
                            <td><?php echo $usuario['rg'];?></td>
                            <td><?php echo $usuario['endereco'];?></td>
                            <td><?php echo $usuario['cidade'];?></td>
                            <td><?php echo $usuario['estado'];?></td>

                            <?php else:?>
                                <td>-----------</td>
                                <td>-----------</td>
                                <td>-----------</td>
                                <td>-----------</td>
                                <td>-----------</td>
                                <td>-----------</td>
                                <td>-----------</td>
                                <td>-----------</td>
                                <td>-----------</td>




                            <?php endif;?>
                        </tr>

                        <?php } endif; ?>
                        </tbody>
                        <tfoot>


                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>


