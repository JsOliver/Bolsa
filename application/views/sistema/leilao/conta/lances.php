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
                    <li class="active">MEUS LANCES</li>
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

                    <div class="orderBox myAddress">
                        <h2>Meus Lances</h2>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Lote</th>
                                    <th>Comitente</th>
                                    <th>Valor Arrematado</th>
                                    <th>Valor Total</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $this->db->from('lances_lote');
                                $this->db->where('cadastro',$_SESSION['ID']);
                                $this->db->order_by('id','desc');
                                $get = $this->db->get();
                                $lances = $get->result_array();
                                foreach ($lances as $value){
                                    $this->db->from('lotes');
                                    $this->db->where('id',$value['lote']);
                                    $get = $this->db->get();
                                    $count = $get->num_rows();
                                    if($count > 0):
                                    $lote = $get->result_array()[0];
                                    else:
                                        $lote['nome'] = 'Não Informado';
                                        $lote['leiloes'] = 0;
                                    endif;
                                    if($lote['leiloes'] > 0):
                                    ?>
                                    <tr>
                                        <td><?php echo $lote['nome'];?></td>
                                        <td><?php echo $this->ModelDefault->comitente($lote['leiloes']);?></td>
                                        <td><?php echo $value['data_lance'];?> às <?php echo $value['hora_lance'];?></td>
                                        <td>R$ <?php echo @number_format($value['valor_lance'],2,',','.');?></td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="<?php echo base_url('lote/'.$value['lote']);?>" target="_blank" class="btn btn-default"><i class="fa fa-globe" aria-hidden="true"></i> Ver Lote</a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endif; } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</section>