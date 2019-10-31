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
                    <li class="active">LOTES ARREMATADOS</li>
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
                        <h2>Meus Lotes</h2>
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
                                $this->db->from('lotes');
                                $this->db->where('arrematante',$_SESSION['ID']);
                                $this->db->where('stats',3);
                                $get = $this->db->get();
                                $arrematante = $get->result_array();
                                foreach ($arrematante as $value){
                                ?>
                                <tr>
                                    <td><?php echo $value['nome'];?></td>
                                    <td><?php echo $this->ModelDefault->comitente($value['leiloes']);?></td>
                                    <td>R$ <?php echo @number_format($value['lance_atual'],2,',','.');?></td>
                                    <td>R$ <?php echo @number_format(($value['lance_atual'] + ((($value['lance_atual'] / 100) * 5) + 220)),2,',','.');?></td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="<?php echo base_url('lote/'.$value['id']);?>" target="_blank" class="btn btn-default"><i class="fa fa-globe" aria-hidden="true"></i> Ver Lote</a>
                                            <a href="<?php echo base_url('termo/'.$value['id']);?>" target="_blank" class="btn btn-default"><i class="fa fa-bars" aria-hidden="true"></i> Ver Termo de Arrematação</a>
                                        </div>
                                    </td>
                                </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</section>