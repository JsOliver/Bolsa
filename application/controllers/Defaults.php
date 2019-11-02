<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Defaults extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model');
        $this->load->model('ModelDefault');
        date_default_timezone_set("America/Sao_Paulo");
        setlocale(LC_ALL, 'pt_BR');
    }

    public function index()
    {

        $this->db->from('set_up');
        $this->db->where('status', 1);
        $get = $this->db->get();
        $count = $get->num_rows();
        if ($count > 0):



            $administrativo = $get->result_array()[0];



            $this->db->from('config');
            $get = $this->db->get();
            $config = $get->result_array()[0];
            $array['config'] = $config;

            $this->db->from('categorias');
            $this->db->where('status',1);
            $this->db->limit(6,0);
            $get = $this->db->get();

            $categorias = $get->result_array();
            $array['categorias'] = $categorias;


            $this->db->from('comitentes');
            $this->db->where('status',1);
            $this->db->limit(6,0);
            $get = $this->db->get();

            $comitentes = $get->result_array();
            $array['comitentes'] = $comitentes;

            $this->db->from('banner');
            $this->db->where('posicao',1);
            $this->db->where('status',1);
            $get = $this->db->get();
            $banner_topo = $get->result_array();
            $array['banners'] = $banner_topo;


            $this->db->from('banner');
            $this->db->where('posicao',0);
            $this->db->where('status',1);
            $get = $this->db->get();
            $countbanner = $get->num_rows();
            if($countbanner > 0):
                $banner_lateral = $get->result_array()[0];
                $array['banner_lateral'] = $banner_lateral;
            endif;
            $this->db->from('lotes');
            if(isset($_SESSION['comitente_set']) and $_SESSION['comitente_set'] > 0):
                $this->db->where('leiloes',$_SESSION['comitente_set']);
            endif;
            $this->db->where('star',1);
            $this->db->where('status',1);
            $this->db->where('stats',0);
            $this->db->order_by('id','rand()');
            $this->db->limit(25,0);
            $get = $this->db->get();
            $lotes_destaques = $get->result_array();
            $array['lotes_destaques'] = $lotes_destaques;


            $this->db->from('leiloes');
            $this->db->where('status',1);
            $this->db->where('finalizado',0);
            $this->db->order_by('id','desc');
            $this->db->limit(25,0);
            $get = $this->db->get();
            $leiloes = $get->result_array();
            $array['leiloes'] = $leiloes;


            $this->db->from('leiloes');
            $this->db->where('status',1);
            $this->db->where('finalizado',0);
            $this->db->order_by('id','desc');
            $this->db->limit(5,0);
            $get = $this->db->get();
            $leiloes = $get->result_array();
            $array['leiloes_limit'] = $leiloes;


            $this->db->from('leiloes');
            $this->db->where('status',1);
            $this->db->where('finalizado',1);
            $this->db->order_by('id','desc');
            $this->db->limit(25,0);
            $get = $this->db->get();
            $leiloes_finalizados = $get->result_array();
            $array['leiloes_finalizados'] = $leiloes_finalizados;

            $this->load->view('sistema/' . $this->Model->setDirSystem($administrativo['permissoes']) . '/fixed/header', $array);
            $this->load->view('sistema/' . $this->Model->setDirSystem($administrativo['permissoes']) . '/index', $array);
            $this->load->view('sistema/' . $this->Model->setDirSystem($administrativo['permissoes']) . '/fixed/footer', $array);


        else:

            echo '<a href="' . base_url('painel') . '">Acessar Painel</a>';

        endif;
    }

    public function busca(){
        $this->db->from('set_up');
        $this->db->where('status', 1);
        $get = $this->db->get();
        $count = $get->num_rows();
        if ($count > 0):



            $administrativo = $get->result_array()[0];



            $this->db->from('config');
            $get = $this->db->get();
            $config = $get->result_array()[0];
            $array['config'] = $config;
            $this->db->from('leiloes');
            $this->db->where('status',1);
            $this->db->where('finalizado',0);
            $this->db->order_by('id','desc');
            $this->db->limit(5,0);
            $get = $this->db->get();
            $leiloes = $get->result_array();
            $array['leiloes_limit'] = $leiloes;


            //Area da Busca

            $this->db->from('lotes');
            if(isset($_GET['busca']) and !empty($_GET['busca'])):
                $this->db->like('nome',$_GET['busca']);
            endif;
            $this->db->order_by('status',1);
            $this->db->limit(12,0);
            $get = $this->db->get();
            $lotes = $get->result_array();
            $array['lotes_busca'] = $lotes;


            $this->load->view('sistema/' . $this->Model->setDirSystem($administrativo['permissoes']) . '/fixed/header', $array);
            $this->load->view('sistema/' . $this->Model->setDirSystem($administrativo['permissoes']) . '/busca', $array);
            $this->load->view('sistema/' . $this->Model->setDirSystem($administrativo['permissoes']) . '/fixed/footer', $array);

        endif;
        }

    public function quem_somos(){
        $this->db->from('set_up');
        $this->db->where('status', 1);
        $get = $this->db->get();
        $count = $get->num_rows();
        if ($count > 0):



            $administrativo = $get->result_array()[0];



            $this->db->from('config');
            $get = $this->db->get();
            $config = $get->result_array()[0];
            $array['config'] = $config;


            $this->db->from('leiloes');
            $this->db->where('status',1);
            $this->db->where('finalizado',0);
            $this->db->order_by('id','desc');
            $this->db->limit(5,0);
            $get = $this->db->get();
            $leiloes = $get->result_array();
            $array['leiloes_limit'] = $leiloes;


            $this->load->view('sistema/' . $this->Model->setDirSystem($administrativo['permissoes']) . '/fixed/header', $array);
            $this->load->view('sistema/' . $this->Model->setDirSystem($administrativo['permissoes']) . '/quem_somos', $array);
            $this->load->view('sistema/' . $this->Model->setDirSystem($administrativo['permissoes']) . '/fixed/footer', $array);


        else:
                echo '<a href="' . base_url('painel') . '">Acessar Painel</a>';



        endif;

    }

    public function como_funciona(){

        $this->db->from('set_up');
        $this->db->where('status', 1);
        $get = $this->db->get();
        $count = $get->num_rows();
        if ($count > 0):



            $administrativo = $get->result_array()[0];



            $this->db->from('config');
            $get = $this->db->get();
            $config = $get->result_array()[0];
            $array['config'] = $config;


            $this->db->from('leiloes');
            $this->db->where('status',1);
            $this->db->where('finalizado',0);
            $this->db->order_by('id','desc');
            $this->db->limit(5,0);
            $get = $this->db->get();
            $leiloes = $get->result_array();
            $array['leiloes_limit'] = $leiloes;

            $this->load->view('sistema/' . $this->Model->setDirSystem($administrativo['permissoes']) . '/fixed/header', $array);
            $this->load->view('sistema/' . $this->Model->setDirSystem($administrativo['permissoes']) . '/como_funciona', $array);
            $this->load->view('sistema/' . $this->Model->setDirSystem($administrativo['permissoes']) . '/fixed/footer', $array);



        else:

                echo '<a href="' . base_url('painel') . '">Acessar Painel</a>';


        endif;

    }

    public function comofunciona(){
        $this->db->from('set_up');
        $this->db->where('status', 1);
        $get = $this->db->get();
        $count = $get->num_rows();
        if ($count > 0):



            $administrativo = $get->result_array()[0];



            $this->db->from('config');
            $get = $this->db->get();
            $config = $get->result_array()[0];
            $array['config'] = $config;
            $this->db->from('leiloes');
            $this->db->where('status',1);
            $this->db->where('finalizado',0);
            $this->db->order_by('id','desc');
            $this->db->limit(5,0);
            $get = $this->db->get();
            $leiloes = $get->result_array();
            $array['leiloes_limit'] = $leiloes;


            $this->load->view('sistema/' . $this->Model->setDirSystem($administrativo['permissoes']) . '/fixed/header', $array);
            $this->load->view('sistema/' . $this->Model->setDirSystem($administrativo['permissoes']) . '/fixed/comofunciona', $array);
            $this->load->view('sistema/' . $this->Model->setDirSystem($administrativo['permissoes']) . '/fixed/footer', $array);


        else:

            echo '<a href="' . base_url('painel') . '">Acessar Painel</a>';
        endif;





    }

    public function lotes()
    {
        $this->db->from('comitentes');
        $this->db->where('status',1);
        $this->db->limit(6,0);
        $get = $this->db->get();

        $comitentes = $get->result_array();
        $array['comitentes'] = $comitentes;

        $this->db->from('set_up');
        $this->db->where('status', 1);
        $get = $this->db->get();
        $count = $get->num_rows();
        if ($count > 0):



            $administrativo = $get->result_array()[0];



            $this->db->from('config');
            $get = $this->db->get();
            $config = $get->result_array()[0];
            $array['config'] = $config;

            $this->db->from('categorias');
            $this->db->where('status',1);
            $this->db->limit(6,0);

            $get = $this->db->get();

            $categorias = $get->result_array();
            $array['categorias'] = $categorias;

            $this->db->from('lotes');
            $this->db->where('leiloes',$this->uri->segment(2));
            $this->db->where('status',1);
            $this->db->order_by('id','asc');
            $this->db->limit(24,0);
            $get = $this->db->get();
            $countlote = $get->num_rows();

            if($countlote == 0):

                echo 'Pagina não encontrada';
                exit();
            endif;
            $lotes = $get->result_array();
            $array['lotes'] = $lotes;


            if(isset($_GET['EndLeiloes'])):
                $this->db->select('id,data_acrescimo,data_fim');
                $this->db->from('lotes');
                $this->db->where('leiloes',$this->uri->segment(2));
                $this->db->where('status',1);
                $get = $this->db->get();
                $count = $get->num_rows();
                if($count > 0):
                    $response1 = $get->result_array();
                    foreach ($response1 as $lote){
                        if(date('Y-m-d H:i:s') > date('Y-m-d H:i:s',strtotime($lote['data_fim']))):


                            if(!empty($lote['data_acrescimo'])):
                                if(date('Y-m-d H:i:s') > date('Y-m-d H:i:s',strtotime($lote['data_acrescimo']))):

                                    $lote['stats'] = $this->ModelDefault->terminoLote($lote['id']);

                                endif;

                            else:

                                $lote['stats'] = $this->ModelDefault->terminoLote($lote['id']);

                            endif;


                        endif;

                    }
                endif;
            endif;



            $this->db->from('leiloes');
            $this->db->where('status',1);
            $this->db->where('finalizado',0);
            $this->db->order_by('id','desc');
            $this->db->limit(5,0);
            $get = $this->db->get();
            $leiloes = $get->result_array();
            $array['leiloes_limit'] = $leiloes;

            $this->load->view('sistema/' . $this->Model->setDirSystem($administrativo['permissoes']) . '/fixed/header', $array);
            $this->load->view('sistema/' . $this->Model->setDirSystem($administrativo['permissoes']) . '/lotes', $array);
            $this->load->view('sistema/' . $this->Model->setDirSystem($administrativo['permissoes']) . '/fixed/footer', $array);


        else:

            echo '<a href="' . base_url('painel') . '">Acessar Painel</a>';

        endif;
    }

    public function lote()
    {



        if(isset($_SESSION['cronometroProximo']) and !empty($_SESSION['cronometroProximo']) and $_SESSION['cronometroProximo'] > 0):


            $dbpb['data_acrescimo'] = date("Y-m-d H:i:s", strtotime(date('Y-m-d H:i:s') . " + 60 seconds"));
            $this->db->where('id',$this->uri->segment(2));
            //$this->db->update('lotes',$dbpb);
            unset($_SESSION['cronometroProximo']);

        endif;


        $this->db->from('comitentes');
        $this->db->where('status',1);
        $this->db->limit(6,0);
        $get = $this->db->get();

        $comitentes = $get->result_array();
        $array['comitentes'] = $comitentes;
        $this->db->from('leiloes');
        $this->db->where('status',1);
        $this->db->where('finalizado',0);
        $this->db->order_by('id','desc');
        $this->db->limit(5,0);
        $get = $this->db->get();
        $leiloes = $get->result_array();
        $array['leiloes_limit'] = $leiloes;

        $this->db->from('set_up');
        $this->db->where('status', 1);
        $get = $this->db->get();
        $count = $get->num_rows();
        if ($count > 0):



            $administrativo = $get->result_array()[0];



            $this->db->from('config');
            $get = $this->db->get();
            $config = $get->result_array()[0];
            $array['config'] = $config;

            $this->db->from('categorias');
            $this->db->where('status',1);
            $this->db->limit(6,0);

            $get = $this->db->get();

            $categorias = $get->result_array();
            $array['categorias'] = $categorias;


            $this->db->from('lotes');
            $this->db->where('id',$this->uri->segment(2));
            $this->db->where('status',1);
            $this->db->limit(6,0);
            $get = $this->db->get();

            $countlote = $get->num_rows();

            if($countlote == 0):

                echo 'Pagina não encontrada';
            exit();

            endif;
            $lote = $get->result_array()[0];
            $lote['visualizacoes'] = ($lote['visualizacoes'] + 1);
            $array['lote'] = $lote;



            $arps['visualizacoes'] = ($lote['visualizacoes']);
            $this->db->where('id',$this->uri->segment(2));
            $this->db->update('lotes',$arps);

            if(empty($lote['nickname']) and isset($lote['arrematente']) and $lote['arrematente'] > 0):
                $this->db->from('usuarios');
                @$this->db->where('id',@$lote['arrematente']);
                $get = $this->db->get();
                $usuariosnicks = $get->result_array()[0];
                $array['nicklance'] = $usuariosnicks['user'];

            else:
                $array['nicklance'] = '';
            endif;

            if(isset($_GET['proximo']) and $lote['stats'] <> 0):
                $this->db->select('id,stats');
                $this->db->from('lotes');

                $this->db->where('leiloes',$lote['leiloes']);
                $this->db->where('nlote <',$lote['nlote']);
                $this->db->where('stats',0);
                $this->db->limit(1,0);
                $this->db->order_by('id','asc');

                $get = $this->db->get();
                $countss = $get->num_rows();

                if($countss > 0):
                    $respond = $get->result_array()[0];

                    //echo '<script>window.location.href="'.base_url('lote/'.$respond['id']).'";</script>';


                endif;

            endif;




            $this->db->select('edital,nome,image,comitente');
            $this->db->from('leiloes');
            $this->db->where('id',$lote['leiloes']);
            $this->db->where('status',1);
            $get = $this->db->get();

            $leiloes = $get->result_array()[0];
            $array['leiloes'] = $leiloes;

            $this->db->select('nome,image');
            $this->db->from('comitentes');
            $this->db->where('id',$leiloes['comitente']);
            $this->db->where('status',1);
            $get = $this->db->get();
            $comitente = $get->result_array()[0];
            $array['comitente'] = $comitente;

            $this->db->from('lances_lote');
            $this->db->where('lote',$lote['id']);
            $this->db->where('status',1);
            if($lote['stats'] == 0):
                $this->db->limit(8,0);
            endif;
            $this->db->order_by('valor_lance','desc');
            $get = $this->db->get();
            $historico = $get->result_array();
            $array['historico'] = $historico;



            $this->db->from('lotes');
            $this->db->where('nlote',($lote['nlote'] + 1));
            $this->db->where('leiloes',$lote['leiloes']);
            $this->db->where('status',1);
            $this->db->limit(1,0);
            $get = $this->db->get();
            $count = $get->num_rows();
            if($count > 0):
                $proximo_lote = $get->result_array()[0];
                $array['proximo_lote'] = $proximo_lote;
            endif;


            $this->db->from('lotes');
            $this->db->where('id > ',$lote['id']);
            $this->db->where('leiloes',$lote['leiloes']);
            $this->db->where('status',1);
            $this->db->limit(8,0);
            $get = $this->db->get();
            $count = $get->num_rows();
            if($count > 0):
                $proximo_lote = $get->result_array();
                $array['proximos_lote'] = $proximo_lote;
            endif;


          /*  if(date('Y-m-d H:i:s') > date('Y-m-d H:i:s',strtotime($lote['data_fim']))):


                if(!empty($lote['data_acrescimo'])):
                    if(date('Y-m-d H:i:s') > date('Y-m-d H:i:s',strtotime($lote['data_acrescimo']))):

                        $lote['stats'] = $this->ModelDefault->terminoLote($lote['id']);

                    endif;

                else:

                    $lote['stats'] = $this->ModelDefault->terminoLote($lote['id']);

                endif;


            endif;*/
            $array['page'] = 'lote';

            $this->db->select('id');
            $this->db->from('lances_lote');
            $this->db->where('lote',$lote['id']);
            $get = $this->db->get();
            $lances_count = $get->num_rows();
            $array['lances_count'] = $lances_count;

            $this->load->view('sistema/' . $this->Model->setDirSystem($administrativo['permissoes']) . '/fixed/header', $array);
            $this->load->view('sistema/' . $this->Model->setDirSystem($administrativo['permissoes']) . '/lote', $array);
            $this->load->view('sistema/' . $this->Model->setDirSystem($administrativo['permissoes']) . '/fixed/footer', $array);


        else:

            echo '<a href="' . base_url('painel') . '">Acessar Painel</a>';

        endif;
    }

    public function lote_leilao(){



        if(isset($_SESSION['cronometroProximo']) and !empty($_SESSION['cronometroProximo']) and $_SESSION['cronometroProximo'] > 0):


            $dbpb['data_acrescimo'] = date("Y-m-d H:i:s", strtotime(date('Y-m-d H:i:s') . " + 60 seconds"));
            $this->db->where('id',$this->uri->segment(2));
            //$this->db->update('lotes',$dbpb);
            unset($_SESSION['cronometroProximo']);

        endif;


        $this->db->from('comitentes');
        $this->db->where('status',1);
        $this->db->limit(6,0);
        $get = $this->db->get();

        $comitentes = $get->result_array();
        $array['comitentes'] = $comitentes;

        $this->db->from('set_up');
        $this->db->where('status', 1);
        $get = $this->db->get();
        $count = $get->num_rows();
        if ($count > 0):



            $administrativo = $get->result_array()[0];
            $this->db->from('leiloes');
            $this->db->where('status',1);
            $this->db->where('finalizado',0);
            $this->db->order_by('id','desc');
            $this->db->limit(5,0);
            $get = $this->db->get();
            $leiloes = $get->result_array();
            $array['leiloes_limit'] = $leiloes;



            $this->db->from('config');
            $get = $this->db->get();
            $config = $get->result_array()[0];
            $array['config'] = $config;

            $this->db->from('categorias');
            $this->db->where('status',1);
            $this->db->limit(6,0);

            $get = $this->db->get();

            $categorias = $get->result_array();
            $array['categorias'] = $categorias;


            $this->db->from('lotes');
            $this->db->where('id',$this->uri->segment(2));
            $this->db->where('status',1);
            $this->db->limit(6,0);
            $get = $this->db->get();

            $countlote = $get->num_rows();

            if($countlote == 0):

                echo 'Pagina não encontrada';
                exit();

            endif;
            $lote = $get->result_array()[0];
            $lote['visualizacoes'] = ($lote['visualizacoes'] + 1);
            $array['lote'] = $lote;



            $arps['visualizacoes'] = ($lote['visualizacoes']);
            $this->db->where('id',$this->uri->segment(2));
            $this->db->update('lotes',$arps);

            if(empty($lote['nickname']) and isset($lote['arrematente']) and $lote['arrematente'] > 0):
                $this->db->from('usuarios');
                @$this->db->where('id',@$lote['arrematente']);
                $get = $this->db->get();
                $usuariosnicks = $get->result_array()[0];
                $array['nicklance'] = $usuariosnicks['user'];

            else:
                $array['nicklance'] = '';
            endif;

            if(isset($_GET['proximo']) and $lote['stats'] <> 0):
                $this->db->select('id,stats');
                $this->db->from('lotes');

                $this->db->where('leiloes',$lote['leiloes']);
                $this->db->where('nlote <',$lote['nlote']);
                $this->db->where('stats',0);
                $this->db->limit(1,0);
                $this->db->order_by('id','asc');

                $get = $this->db->get();
                $countss = $get->num_rows();

                if($countss > 0):
                    $respond = $get->result_array()[0];

                    //echo '<script>window.location.href="'.base_url('lote/'.$respond['id']).'";</script>';


                endif;

            endif;




            $this->db->select('edital,nome,image,comitente');
            $this->db->from('leiloes');
            $this->db->where('id',$lote['leiloes']);
            $this->db->where('status',1);
            $get = $this->db->get();

            $leiloes = $get->result_array()[0];
            $array['leiloes'] = $leiloes;

            $this->db->select('nome,image');
            $this->db->from('comitentes');
            $this->db->where('id',$leiloes['comitente']);
            $this->db->where('status',1);
            $get = $this->db->get();
            $comitente = $get->result_array()[0];
            $array['comitente'] = $comitente;

            $this->db->from('lances_lote');
            $this->db->where('lote',$lote['id']);
            $this->db->where('status',1);
            if($lote['stats'] == 0):
                $this->db->limit(8,0);
            endif;
            $this->db->order_by('valor_lance','desc');
            $get = $this->db->get();
            $historico = $get->result_array();
            $array['historico'] = $historico;



            $this->db->from('lotes');
            $this->db->where('nlote',($lote['nlote'] + 1));
            $this->db->where('leiloes',$lote['leiloes']);
            $this->db->where('status',1);
            $this->db->limit(1,0);
            $get = $this->db->get();
            $count = $get->num_rows();
            if($count > 0):
                $proximo_lote = $get->result_array()[0];
                $array['proximo_lote'] = $proximo_lote;
            endif;


            $this->db->from('lotes');
            $this->db->where('id > ',$lote['id']);
            $this->db->where('leiloes',$lote['leiloes']);
            $this->db->where('status',1);
            $this->db->limit(8,0);
            $get = $this->db->get();
            $count = $get->num_rows();
            if($count > 0):
                $proximo_lote = $get->result_array();
                $array['proximos_lote'] = $proximo_lote;
            endif;


            /*  if(date('Y-m-d H:i:s') > date('Y-m-d H:i:s',strtotime($lote['data_fim']))):


                  if(!empty($lote['data_acrescimo'])):
                      if(date('Y-m-d H:i:s') > date('Y-m-d H:i:s',strtotime($lote['data_acrescimo']))):

                          $lote['stats'] = $this->ModelDefault->terminoLote($lote['id']);

                      endif;

                  else:

                      $lote['stats'] = $this->ModelDefault->terminoLote($lote['id']);

                  endif;


              endif;*/

            $array['page'] = 'lote';

            $this->db->select('id');
            $this->db->from('lances_lote');
            $this->db->where('lote',$lote['id']);
            $get = $this->db->get();
            $lances_count = $get->num_rows();
            $array['lances_count'] = $lances_count;

            $this->load->view('sistema/' . $this->Model->setDirSystem($administrativo['permissoes']) . '/fixed/header', $array);
            $this->load->view('sistema/' . $this->Model->setDirSystem($administrativo['permissoes']) . '/lote_leilao', $array);
            $this->load->view('sistema/' . $this->Model->setDirSystem($administrativo['permissoes']) . '/fixed/footer', $array);


        else:

            echo '<a href="' . base_url('painel') . '">Acessar Painel</a>';

        endif;

    }

    public function lances(){
        if ($this->ModelDefault->session() == true):

            $this->db->from('set_up');
            $this->db->where('status', 1);
            $get = $this->db->get();
            $count = $get->num_rows();
            if ($count > 0):

                $administrativo = $get->result_array()[0];



                $this->db->from('usuarios');
                $this->db->where('id',$_SESSION['ID']);
                $get = $this->db->get();
                $usuario = $get->result_array()[0];
                $array['usuario'] = $usuario;



                $this->db->from('config');
                $get = $this->db->get();
                $config = $get->result_array()[0];
                $array['config'] = $config;
                $this->db->from('comitentes');
                $this->db->where('status',1);
                $this->db->limit(6,0);
                $get = $this->db->get();

                $comitentes = $get->result_array();
                $array['comitentes'] = $comitentes;

                $this->db->from('documentos');
                $this->db->where('cadastro',$_SESSION['ID']);
                $get = $this->db->get();
                $counts = $get->num_rows();
                if($counts > 0):
                    $documentos = $get->result_array()[0];
                    $array['documentos'] = $documentos;
                endif;
                $this->db->from('leiloes');
                $this->db->where('status',1);
                $this->db->where('finalizado',0);
                $this->db->order_by('id','desc');
                $this->db->limit(5,0);
                $get = $this->db->get();
                $leiloes = $get->result_array();
                $array['leiloes_limit'] = $leiloes;

                $this->load->view('sistema/' . $this->Model->setDirSystem($administrativo['permissoes']) . '/fixed/header', $array);
                $this->load->view('sistema/' . $this->Model->setDirSystem($administrativo['permissoes']) . '/conta/lances', $array);
                $this->load->view('sistema/' . $this->Model->setDirSystem($administrativo['permissoes']) . '/fixed/footer', $array);


            else:

                echo '<a href="' . base_url('painel') . '">Acessar Painel</a>';

            endif;

        else:

            header("Location:/leilao");

        endif;
    }

    public function conta(){
        if ($this->ModelDefault->session() == true):

            $this->db->from('set_up');
            $this->db->where('status', 1);
            $get = $this->db->get();
            $count = $get->num_rows();
            if ($count > 0):

                $administrativo = $get->result_array()[0];



                $this->db->from('usuarios');
                $this->db->where('id',$_SESSION['ID']);
                $get = $this->db->get();
                $usuario = $get->result_array()[0];
                $array['usuario'] = $usuario;



                $this->db->from('config');
                $get = $this->db->get();
                $config = $get->result_array()[0];
                $array['config'] = $config;
                $this->db->from('comitentes');
                $this->db->where('status',1);
                $this->db->limit(6,0);
                $get = $this->db->get();

                $comitentes = $get->result_array();
                $array['comitentes'] = $comitentes;

                $this->db->from('documentos');
                $this->db->where('cadastro',$_SESSION['ID']);
                $get = $this->db->get();
                $counts = $get->num_rows();
                if($counts > 0):
                    $documentos = $get->result_array()[0];
                    $array['documentos'] = $documentos;
                endif;
                $this->db->from('leiloes');
                $this->db->where('status',1);
                $this->db->where('finalizado',0);
                $this->db->order_by('id','desc');
                $this->db->limit(5,0);
                $get = $this->db->get();
                $leiloes = $get->result_array();
                $array['leiloes_limit'] = $leiloes;

                $this->load->view('sistema/' . $this->Model->setDirSystem($administrativo['permissoes']) . '/fixed/header', $array);
                $this->load->view('sistema/' . $this->Model->setDirSystem($administrativo['permissoes']) . '/conta/minha_conta', $array);
                $this->load->view('sistema/' . $this->Model->setDirSystem($administrativo['permissoes']) . '/fixed/footer', $array);


            else:

                echo '<a href="' . base_url('painel') . '">Acessar Painel</a>';

            endif;

        else:

            header("Location:/leilao");

        endif;
    }

    public function lotes_arrematados(){
        if ($this->ModelDefault->session() == true):

            $this->db->from('set_up');
            $this->db->where('status', 1);
            $get = $this->db->get();
            $count = $get->num_rows();
            if ($count > 0):

                $administrativo = $get->result_array()[0];



                $this->db->from('usuarios');
                $this->db->where('id',$_SESSION['ID']);
                $get = $this->db->get();
                $usuario = $get->result_array()[0];
                $array['usuario'] = $usuario;



                $this->db->from('config');
                $get = $this->db->get();
                $config = $get->result_array()[0];
                $array['config'] = $config;
                $this->db->from('comitentes');
                $this->db->where('status',1);
                $this->db->limit(6,0);
                $get = $this->db->get();

                $comitentes = $get->result_array();
                $array['comitentes'] = $comitentes;

                $this->db->from('documentos');
                $this->db->where('cadastro',$_SESSION['ID']);
                $get = $this->db->get();
                $counts = $get->num_rows();
                if($counts > 0):
                    $documentos = $get->result_array()[0];
                    $array['documentos'] = $documentos;
                endif;
                $this->db->from('leiloes');
                $this->db->where('status',1);
                $this->db->where('finalizado',0);
                $this->db->order_by('id','desc');
                $this->db->limit(5,0);
                $get = $this->db->get();
                $leiloes = $get->result_array();
                $array['leiloes_limit'] = $leiloes;

                $this->load->view('sistema/' . $this->Model->setDirSystem($administrativo['permissoes']) . '/fixed/header', $array);
                $this->load->view('sistema/' . $this->Model->setDirSystem($administrativo['permissoes']) . '/conta/lotes_arrematados', $array);
                $this->load->view('sistema/' . $this->Model->setDirSystem($administrativo['permissoes']) . '/fixed/footer', $array);


            else:

                echo '<a href="' . base_url('painel') . '">Acessar Painel</a>';

            endif;

        else:

            header("Location:/leilao");

        endif;
    }

    public function redireciona(){


        $this->db->select('id,ativads');
        $this->db->from('lotes');
        $this->db->where('leiloes',$_GET['leilao']);
        $this->db->where('stats',0);
        $this->db->order_by('id','asc');
        $this->db->limit(1,0);
        $get = $this->db->get();

        $result = $get->result_array()[0];






        if($result['ativads'] == 0):
            $dbpb['ativads'] = 1;

            $dbpb['data_acrescimo'] = date("Y-m-d H:i:s", strtotime(date('Y-m-d H:i:s') . " + 30 seconds"));
            $this->db->where('id',$result['id']);
            $this->db->update('lotes',$dbpb);

        endif;
        $this->db->from('leiloes');
        $this->db->where('status',1);
        $this->db->where('finalizado',0);
        $this->db->order_by('id','desc');
        $this->db->limit(5,0);
        $get = $this->db->get();
        $leiloes = $get->result_array();
        $array['leiloes_limit'] = $leiloes;

        echo '<script>window.location.href="'.base_url('lote/'.($_GET['lote']+1)).'";</script>';



    }
}