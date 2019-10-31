<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model');
        date_default_timezone_set("America/Sao_Paulo");
        setlocale(LC_ALL, 'pt_BR');
    }

    public function importa(){
        $this->db->from('lotes_descritivos');
        $this->db->where('leilao',21);
        $get = $this->db->get();
        $result = $get->result_array();
        foreach ($result as $value){

        $this->db->from('lotes');
            $this->db->where('leiloes',21);
            $this->db->where('nlote',$value['id_lote']);
            $result = $get->result_array()[0];
            $texto = $result['descricao'].'<br>'.$value['descricao'];

            $arr['descricao'] = $texto;
            $this->db->where('leiloes',21);
            $this->db->where('nlote',$value['id_lote']);
            //$this->db->update('lotes',$arr);

            echo $texto;


        }

    }

    public function index()
    {

        if($this->Model->session_admin() == true):


            $this->db->from('administrador');
            $this->db->where('id',$_SESSION['ID_ADMIN']);
            $get = $this->db->get();
            $administrativo = $get->result_array()[0];





            $this->db->from('menu_admin_categorias');
            $this->db->where('status',1);

            if($administrativo['permissoes'] <> 1):
                $this->db->where('tipo_acesso',$administrativo['permissoes']);
                $this->db->or_where('tipo_acesso>',$administrativo['permissoes']);
                $this->db->where('status',1);
                $this->db->or_where('tipo_acesso','all');
                $this->db->where('status',1);

            endif;
            $this->db->order_by('ordem','desc');
            $get = $this->db->get();
            $menu_admin_categoria = $get->result_array();




            $array['admin'] = $administrativo;
            $array['menu_categoria'] = $menu_admin_categoria;

$this->db->from('lances_lote');
$this->db->where('data_lance',date('d/m/Y'));
$get = $this->db->get();
$count = $get->num_rows();


            $this->db->from('lances_lote');
$get = $this->db->get();
$countintecoes = $get->num_rows();

            $this->db->from('lances_lote');
            $this->db->where('data_lance',date("d/m/Y",strtotime(date("Y-m-d")."-1 days")));
            $get = $this->db->get();
            $countant = $get->num_rows();


            $this->db->from('cotacoes_intencoes');
            $this->db->where('data',date("d/m/Y",strtotime(date("Y-m-d")."-1 days")));
            $get = $this->db->get();
            $countintecoesant = $get->num_rows();


            $array['pedido_resumo_diario'] = array([
                "total_pedidos" => @number_format($count),
                "total_intencoes" => @number_format($countintecoes),
                "pedidos_ao_dia_anterior_porc" => $this->Model->porcentagem_compara_dias('pedidos','pedidos',$countant,$count),
                "intencoes_ao_dia_anterior_porc" => $this->Model->porcentagem_compara_dias('pedidos','intencoes',$countintecoesant,$countintecoes),

            ]);

            $this->load->view('painel/app/header',$array);


            $this->load->view('painel/app/navigation',$array);


            $this->load->view('painel/app/footer',$array);

        else:
        $this->load->view('painel/login');
        endif;
    }
    public function relatorio()
    {

        if($this->Model->session_admin() == true):


            $this->db->from('administrador');
            $this->db->where('id',$_SESSION['ID_ADMIN']);
            $get = $this->db->get();
            $administrativo = $get->result_array()[0];





            $this->db->from('menu_admin_categorias');
            $this->db->where('status',1);

            if($administrativo['permissoes'] <> 1):
                $this->db->where('tipo_acesso',$administrativo['permissoes']);
                $this->db->or_where('tipo_acesso>',$administrativo['permissoes']);
                $this->db->where('status',1);
                $this->db->or_where('tipo_acesso','all');
                $this->db->where('status',1);

            endif;
            $this->db->order_by('ordem','desc');
            $get = $this->db->get();
            $menu_admin_categoria = $get->result_array();




            $array['admin'] = $administrativo;
            $array['menu_categoria'] = $menu_admin_categoria;


            $this->load->view('painel/app/header',$array);


            $this->load->view('painel/relatorio',$array);


            $this->load->view('painel/app/footer',$array);

        else:
        $this->load->view('painel/login');
        endif;
    }

    public function termo(){


        $this->db->from('lotes');
        $this->db->where('id',$this->uri->segment(2));
        $get = $this->db->get();
        $count = $get->num_rows();

        if($count > 0):
            $array['lote'] = $get->result_array()[0];

            $this->db->from('leiloes');
            $this->db->where('id',$array['lote']['leiloes']);
            $get = $this->db->get();
            $array['leiloes'] = $get->result_array()[0];

            $this->db->from('comitentes');
            $this->db->where('id',$array['leiloes']['comitente']);
            $get = $this->db->get();
            $array['comitente'] = $get->result_array()[0];


            $this->db->from('usuarios');
            $this->db->where('id',$array['lote']['arrematante']);
            $get = $this->db->get();
            $array['usuario'] = $get->result_array()[0];

            $this->load->view('painel/termo',$array);

        else:
        $this->index();
        endif;
    }

    public function empresa()
    {

        if($this->Model->session_empresa() == true):


            $this->db->from('empresas');
            $this->db->where('id',$_SESSION['ID_EMPRESA']);
            $get = $this->db->get();
            $administrativo = $get->result_array()[0];





            $this->db->from('menu_admin_categorias');
            $this->db->where('empresa',1);
            $this->db->where('status',1);

            $this->db->order_by('ordem','desc');
            $get = $this->db->get();
            $menu_admin_categoria = $get->result_array();




            $array['admin'] = $administrativo;
            $array['menu_categoria'] = $menu_admin_categoria;

$this->db->from('cotacoes');
$this->db->where('data',date('d/m/Y'));
$this->db->where('empresa',$_SESSION['ID_EMPRESA']);
$get = $this->db->get();
$count = $get->num_rows();


$this->db->from('cotacoes_intencoes');
$this->db->where('data',date('d/m/Y'));
$this->db->where('empresa',$_SESSION['ID_EMPRESA']);
$get = $this->db->get();
$countintecoes = $get->num_rows();


            $this->db->from('cotacoes');
            $this->db->where('empresa',$_SESSION['ID_EMPRESA']);
            $this->db->where('data',date("d/m/Y",strtotime(date("Y-m-d")."-1 days")));
            $get = $this->db->get();
            $countant = $get->num_rows();


            $this->db->from('cotacoes_intencoes');
            $this->db->where('empresa',$_SESSION['ID_EMPRESA']);
            $this->db->where('data',date("d/m/Y",strtotime(date("Y-m-d")."-1 days")));
            $get = $this->db->get();
            $countintecoesant = $get->num_rows();


            $array['pedido_resumo_diario'] = array([
                "total_pedidos" => $count,
                "total_intencoes" => $countintecoes,
                "pedidos_ao_dia_anterior_porc" => $this->Model->porcentagem_compara_dias('pedidos','pedidos',$countant,$count),
                "intencoes_ao_dia_anterior_porc" => $this->Model->porcentagem_compara_dias('pedidos','intencoes',$countintecoesant,$countintecoes),

            ]);

            $this->load->view('painel/app/header',$array);


            $this->load->view('painel/app/navigation',$array);


            $this->load->view('painel/app/footer',$array);

        else:

        $array['empresa'] = 1;
        $this->load->view('painel/login',$array);
        endif;
    }
}
