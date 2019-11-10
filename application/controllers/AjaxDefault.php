<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AjaxDefault extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model');
        $this->load->model('ModelDefault');
        date_default_timezone_set("America/Sao_Paulo");
        setlocale(LC_ALL, 'pt_BR');
    }

    public function readline() {
        return rtrim(fgets(STDIN));
    }


    public function loadmoreauditorio(){


        $pages = (24 * $_POST['pages']) - 24;

        $this->db->from('lotes');
        $this->db->where('leiloes',$_POST['leilao']);
        $this->db->where('status',1);
        $this->db->where('stats',0);

        $this->db->limit(24,$pages);
        $get = $this->db->get();
        $lote = $get->result_array();

        foreach ($lote as $value){

            $arr['item'] = $value; $this->load->view('sistema/leilao/z_files/lotes_auditorio',$arr);
        }


    }
    public function loadmore(){


        $pages = (24 * $_POST['pages']) - 24;

        $this->db->from('lotes');
        $this->db->where('leiloes',$_POST['leilao']);
        $this->db->where('status',1);
        $this->db->limit(24,$pages);
        $get = $this->db->get();
        $lote = $get->result_array();

        foreach ($lote as $value){

            $arr['item'] = $value; $this->load->view('sistema/leilao/z_files/lotes',$arr);
        }


    }
    public function finalizarleilao(){


        $this->db->select('stats');
        $this->db->from('lotes');
        $this->db->where('id',$_POST['lote']);
        $this->db->where('status',1);
        $get = $this->db->get();
        $lote = $get->result_array()[0];

        if($lote['stats'] == 0):
            $this->db->select('id,data_fim,leiloes,data_acrescimo');
            $this->db->from('lotes');
            $this->db->where('id',$_POST['lote']);
            $this->db->where('status',1);
            $this->db->limit(6,0);
            $get = $this->db->get();

            $lote = $get->result_array()[0];
            if(date('Y-m-d H:i') > date('Y-m-d H:i',strtotime($lote['data_fim']))):


                if(!empty($lote['data_acrescimo'])):
                    if(date('Y-m-d H:i:s') > date('Y-m-d H:i:s',strtotime($lote['data_acrescimo']))):



                        $this->db->select('id');
                        $this->db->from('lotes');
                        $this->db->where('id <',$_POST['lote']);
                        $this->db->where('leiloes',$lote['leiloes']);
                        $this->db->where('status',1);
                        $this->db->where('stats',0);
                        $get = $this->db->get();
                        $countoutros = $get->num_rows();


                        if($countoutros > 0):
                            $db['data_acrescimo'] = date("Y-m-d H:i:s", strtotime(date('Y-m-d H:i:s') . " + 30 seconds"));
                            $this->db->where('id',($_POST['lote']+1));
                            $this->db->update('lotes',$db);
                            echo 77;
                        else:

                            $lote['stats'] = $this->ModelDefault->terminoLote($lote['id']);

                            echo 11;

                        endif;
                    endif;

                else:


                    $this->db->select('id');
                    $this->db->from('lotes');
                    $this->db->where('id <',$_POST['lote']);
                    $this->db->where('leiloes',$lote['leiloes']);
                    $this->db->where('status',1);
                    $this->db->where('stats',0);
                    $get = $this->db->get();
                    $countoutros = $get->num_rows();


                    if($countoutros > 0):
                        $db['data_acrescimo'] = date("Y-m-d H:i:s", strtotime(date('Y-m-d H:i:s') . " + 30 seconds"));
                        $this->db->where('id',($_POST['lote'] + 1));
                        $this->db->update('lotes',$db);
                        echo 77;
                    else:
                        $lote['stats'] = $this->ModelDefault->terminoLote($lote['id']);
                        echo 11;

                    endif;
                endif;


            else:


                echo 13;

            endif;

        else:

            echo 12;
        endif;



    }

    public function alterardados(){

        $dd['nome'] = isset($_POST['nome']) ? $_POST['nome'] : '';
        $dd['cep'] = isset($_POST['cep']) ? $_POST['cep'] : '';
        $dd['cpf'] = isset($_POST['cpf']) ? $_POST['cpf'] : '';
        $dd['rg'] = isset($_POST['rg']) ? $_POST['rg'] : '';
        $dd['sexo'] = isset($_POST['sexo']) ? $_POST['sexo'] : '';
        $dd['data_nasc'] = isset($_POST['nascimento']) ? $_POST['nascimento'] : '';
        $dd['telefone'] = isset($_POST['telefone']) ? $_POST['telefone'] : '';
        $dd['celular'] = isset($_POST['celular']) ? $_POST['celular'] : '';
        $dd['cidade'] = isset($_POST['cidade']) ? $_POST['cidade'] : '';
        $dd['estado'] = isset($_POST['estado']) ? $_POST['estado'] : '';
        $dd['endereco'] = isset($_POST['endereco']) ? $_POST['endereco'] : '';
        $dd['numero'] = isset($_POST['numero']) ? $_POST['numero'] : '';
        $dd['complemento'] = isset($_POST['complemento']) ? $_POST['complemento'] : '';
        $dd['bairro'] = isset($_POST['bairro']) ? $_POST['bairro'] : '';
        $dd['pais'] = isset($_POST['pais']) ? $_POST['pais'] : '';
        $dd['user'] = isset($_POST['nick']) ? $_POST['nick'] : '';
        $dd['data_up'] = date('d/m/Y');
        $dd['email'] = isset($_POST['email']) ? $_POST['email'] : '';
        $this->db->where('id',$_SESSION['ID']);
        $this->db->update('usuarios', $dd);


        echo 11;


    }


    public function homologar_lote(){



        $this->db->select('id,stats,data_fim,data_acrescimo,lance_min,lance_atual,leiloes');
        $this->db->from('lotes');
        $this->db->where('id',$_POST['lote']);
        $get = $this->db->get();

        $count = $get->num_rows();

        if($count > 0):
            $lote = $get->result_array()[0];
            if($lote['stats'] == 0):

                if(empty($lote['data_acrescimo'])):
                    if(date('Y-m-d H:i:s') >= date('Y-m-d H:i:s',strtotime($lote['data_acrescimo']))):

                        echo $this->ModelDefault->terminoLote($lote['id'],$lote['leiloes']);


                    else:

                        echo 0;

                    endif;
                else:

                    if(date('Y-m-d H:i:s') >= date('Y-m-d H:i:s',strtotime($lote['data_fim']))):

                        echo $this->ModelDefault->terminoLote($lote['id'],$lote['leiloes']);



                    else:

                        echo 0;

                    endif;

                endif;

            else:

                echo 0;

            endif;

        else:

            echo 0;




        endif;
    }
    public function dar_lance(){

        date_default_timezone_set('America/Belem');

        if($this->ModelDefault->session() == false):

            $arr['mensagem'] = 'E necessario estar Logado';
            $arr['sucesso'] = 0;

        else:

            $this->db->select('status,validado');
            $this->db->from('usuarios');
            $this->db->where('id',$_SESSION['ID']);
            $get = $this->db->get();
            $count = $get->num_rows();

            if($count > 0):
                $result = $get->result_array();

                if($result[0]['status'] == 1):

                    if($result[0]['validado'] == 1):

                        if(isset($_POST['lote']) and isset($_POST['lance']) and !empty($_POST['lote']) and !empty($_POST['lance']) and $_POST['lance'] > 0):

                            $this->db->select('data_acrescimo,data_fim,leiloes,lance_ini,lance_atual,stats');
                            $this->db->from('lotes');
                            $this->db->where('id',$_POST['lote']);
                            $this->db->where('status',1);
                            $get = $this->db->get();
                            $count = $get->num_rows();
                            if($count > 0):
                                $lote = $get->result_array()[0];

                                if($lote['stats'] <> 0):

                                    $arr['mensagem'] = 'Lote Finalizado ou Não Iniciado';
                                    $arr['sucesso'] = 0;

                                else:

                                    if(!empty($lote['data_acrescimo'])):
                                        $datafimse = $lote['data_acrescimo'];

                                    else:

                                        $datafimse = $lote['data_fim'];

                                    endif;

                                    if((( date('YmdHis',strtotime($datafimse)) - date('YmdHis')) - 40) <= 30):
                                        $dppm['data_acrescimo'] =  date("Y-m-d H:i:s", strtotime(date('c'). " + 30 seconds"));
                                        $this->db->where('id',$_POST['lote']);
                                        $this->db->update('lotes',$dppm);
                                    endif;





                                    $lance = str_replace('.','/',$_POST['lance']);
                                    $lance = str_replace(',','',$lance);
                                    $lance = str_replace('/','.',$lance);
                                    if(str_replace(',','',$_POST['lance']) >= $lote['lance_ini']):


                                        if(!empty($lote['lance_atual'])):

                                            if(str_replace(',','',$_POST['lance']) > $lote['lance_atual']):

                                                if((str_replace(',','',$_POST['lance'])) < ($lote['lance_atual'] + 50)):
                                                    $arr['mensagem'] = 'O lance tem que ser superior no minimo R$ 50,00 do último lance! ';
                                                    $arr['sucesso'] = 0;
                                                    echo json_encode($arr);

                                                    exit();

                                                endif;




                                                $dbs['data_lance'] = date('d/m/Y H:i');
                                                $dbs['lance_atual'] = $lance;
                                                $dbs['nickname'] = $_SESSION['NICKNAME'];
                                                $dbs['arrematante'] = $_SESSION['ID'];
                                                $this->db->where('id',$_POST['lote']);
                                                $this->db->update('lotes',$dbs);


                                                $dpsp['lote'] = $_POST['lote'];
                                                $dpsp['leilao'] = $lote['leiloes'];
                                                $dpsp['cadastro'] = $_SESSION['ID'];
                                                $dpsp['data_lance'] = date('d/m/Y');
                                                $dpsp['hora_lance'] = date('H:i:s');
                                                $dpsp['valor_lance'] = $lance;
                                                $dpsp['status'] = 1;
                                                $this->db->insert('lances_lote',$dpsp);

                                            else:

                                                $arr['mensagem'] = 'Lance tem que ser maior que o lance atual';
                                                $arr['sucesso'] = 0;

                                            endif;

                                        else:


                                            $dbs['data_lance'] = date('d/m/Y H:i');
                                            $dbs['lance_atual'] = $lance;
                                            $dbs['nickname'] = $_SESSION['NICKNAME'];
                                            $dbs['arrematante'] = $_SESSION['ID'];
                                            $this->db->where('id',$_POST['lote']);
                                            $this->db->update('lotes',$dbs);


                                            $dpsp['lote'] = $_POST['lote'];
                                            $dpsp['leilao'] = $lote['leiloes'];
                                            $dpsp['cadastro'] = $_SESSION['ID'];
                                            $dpsp['data_lance'] = date('d/m/Y');
                                            $dpsp['hora_lance'] = date('H:i:s');
                                            $dpsp['valor_lance'] = $lance;
                                            $dpsp['status'] = 1;
                                            $this->db->insert('lances_lote',$dpsp);

                                        endif;


                                    else:

                                        $arr['mensagem'] = 'Lance tem que ser maior que o lance inicial';
                                        $arr['sucesso'] = 0;
                                    endif;


                                endif;


                            else:

                                $arr['mensagem'] = 'Lote Excluido ou Bloqueado';
                                $arr['sucesso'] = 0;

                            endif;


                        else:

                            $arr['mensagem'] = 'Valores Informados Inválidos';
                            $arr['sucesso'] = 0;

                        endif;

                    else:
                        $arr['mensagem'] = 'Usuario não validado, por favor envie seus documentos';
                        $arr['sucesso'] = 0;
                    endif;
                else:
                    $arr['mensagem'] = 'Usuario Bloqueado';
                    $arr['sucesso'] = 0;
                endif;


            else:

                $arr['mensagem'] = 'Usuario excluido ou não cadastrado';
                $arr['sucesso'] = 0;

            endif;



        endif;

        echo json_encode($arr);

    }

    public function verificar_cronometro(){

        $this->db->select('nickname,data_lance,lance_atual,data_acrescimo');
        $this->db->from('lotes');
        $this->db->where('id', $_POST['lote']);
        $get = $this->db->get();
        if ($get->num_rows() > 0):
            $result = $get->result_array()[0];


            if(!empty($result['data_acrescimo'])):

                $arr['cronometro'] = date('Y-m-d H:i:s',strtotime($result['data_acrescimo'].' + 1 hour'));

            endif;

            if(!empty($result['data_lance'])):

                $arr['data_lance'] = $result['data_lance'];

            endif;

            if(!empty($result['nickname'])):

                $arr['nickname'] = $result['nickname'];

            endif;


            if(!empty($result['lance_atual'])):

                $arr['lance_atual'] = 'R$ '.number_format($result['lance_atual'],2,'.',',');

            else:


                $arr['lance_atual'] = 'R$ 0,00';
            endif;

        endif;


        echo json_encode($arr);

    }


    public function proximo_lote(){

        $this->db->select('id,stats');
        $this->db->from('lotes');
        $this->db->where('id', $_POST['lote']);
        $get = $this->db->get();
        $count = $get->num_rows();
        if ($count > 0):

        $result = $get->result_array()[0];


        if($result['stats'] == 0):

            $arr['finalizado'] = 0;

        else:
            $arr['finalizado'] = 1;
            $arr['loteid'] = ($_POST['lote'] + 1);
        endif;


        echo json_encode($arr);
endif;
    }

    //Funções de Acesso
    public function cadastro()
    {
        if ($this->ModelDefault->session() == false):


            $this->db->from('usuarios');
            $this->db->where('email', $_POST['email']);
            $get = $this->db->get();
            if ($get->num_rows() > 0):
                echo 'Usuario já cadastrado!!';
            else:

                $this->db->from('usuarios');
                $this->db->where('user', $_POST['nick']);
                $get = $this->db->get();
                if ($get->num_rows() > 0):
                    echo 'Nickname já em uso!!';
                else:
                    $dd['status'] = 1;
                    $dd['nome'] = isset($_POST['nome']) ? $_POST['nome'] : '';
                    $dd['cep'] = isset($_POST['cep']) ? $_POST['cep'] : '';
                    $dd['cpf'] = isset($_POST['cpf']) ? $_POST['cpf'] : '';
                    $dd['rg'] = isset($_POST['rg']) ? $_POST['rg'] : '';
                    $dd['sexo'] = isset($_POST['sexo']) ? $_POST['sexo'] : '';
                    $dd['data_nasc'] = isset($_POST['nascimento']) ? $_POST['nascimento'] : '';
                    $dd['telefone'] = isset($_POST['telefone']) ? $_POST['telefone'] : '';
                    $dd['celular'] = isset($_POST['celular']) ? $_POST['celular'] : '';
                    $dd['cidade'] = isset($_POST['cidade']) ? $_POST['cidade'] : '';
                    $dd['estado'] = isset($_POST['estado']) ? $_POST['estado'] : '';
                    $dd['endereco'] = isset($_POST['endereco']) ? $_POST['endereco'] : '';
                    $dd['numero'] = isset($_POST['numero']) ? $_POST['numero'] : '';
                    $dd['complemento'] = isset($_POST['complemento']) ? $_POST['complemento'] : '';
                    $dd['bairro'] = isset($_POST['bairro']) ? $_POST['bairro'] : '';
                    $dd['pais'] = isset($_POST['pais']) ? $_POST['pais'] : '';
                    $dd['user'] = isset($_POST['nick']) ? $_POST['nick'] : '';
                    $dd['data_up'] = date('d/m/Y');
                    $dd['email'] = isset($_POST['email']) ? $_POST['email'] : '';
                    $dd['pass'] = isset($_POST['pass']) ? md5($_POST['pass']) : '';
                    $insert = $this->db->insert('usuarios', $dd);
                    $_SESSION['Auth01'] = 'true';
                    $_SESSION['NAME'] = $_POST['nome'];
                    $_SESSION['EMAIL'] = $_POST['email'];
                    $_SESSION['NICKNAME'] = $_POST['nick'];
                    $_SESSION['PASS'] = md5($_POST['pass']);
                    $_SESSION['ID'] = $this->db->insert_id();

                    if ($this->db->insert_id() > 0):
                        $dps['ultimo_acesso'] = date('d/m/Y H:i:s');
                        $this->db->where('id', $this->db->insert_id());
                        $this->db->update('usuarios',$dps);
                        echo 11;
                    else:
                        echo 'Erro ao cadastrar o usuario!!';
                    endif;
                endif;
            endif;


        else:

            echo 11;

        endif;


    }

    public function login()
    {

        if ($this->ModelDefault->session() == false):


            $this->db->from('usuarios');
            $this->db->where('email', $_POST['user']);
            $this->db->where('inadimplente',0);
            $this->db->or_where('user', $_POST['user']);
            $this->db->where('inadimplente',0);

            $get = $this->db->get();
            if ($get->num_rows() > 0):


                $this->db->from('usuarios');
                $this->db->where('email', $_POST['user']);
                $this->db->where('pass', md5($_POST['pass']));
                $this->db->or_where('user', $_POST['user']);
                $this->db->where('pass', md5($_POST['pass']));

                $get = $this->db->get();
                if ($get->num_rows() > 0):

                    $result = $get->result_array();
                    if ($result[0]['status'] == 1):


                        $dps['ultimo_acesso'] = date('d/m/Y H:i:s');
                        $this->db->where('id', $result[0]['id']);
                        $this->db->update('usuarios',$dps);

                        $_SESSION['Auth01'] = 'true';
                        $_SESSION['IP'] = $_SERVER["REMOTE_ADDR"];
                        $_SESSION['NAME'] = $result[0]['nome'];
                        $_SESSION['EMAIL'] = $result[0]['email'];
                        $_SESSION['NICKNAME'] = $result[0]['user'];
                        $_SESSION['PASS'] = $result[0]['pass'];
                        $_SESSION['ID'] = $result[0]['id'];

                        echo 11;

                    else:

                        echo 'Usuario bloqueado!!';

                    endif;
                else:

                    echo 'Senha incorreta!!';

                endif;
            else:

                echo 'Usuario não cadastrado!!';


            endif;
        else:

            echo 11;

        endif;


    }


    //Funções de Conta

    public function dadosupdate()
    {
        if ($this->ModelDefault->session() == true):
            $this->db->from('usuarios');
            $this->db->where('id', $_SESSION['ID']);
            $get = $this->db->get();
            if ($get->num_rows() > 0):

                $dd['nome'] = $_POST['nome'];
                $dd['cidade'] = $_POST['cidade'];
                $dd['estado'] = $_POST['estado'];
                $dd['endereco'] = $_POST['endereco'];
                $dd['cep'] = $_POST['cep'];
                $dd['telefone'] = str_replace(array(' ', '(', ')', '-'), array('', '', '', ''), $_POST['telefone']);
                if (!empty($_POST['cpf'])):
                    $dd['cpf'] = $_POST['cpf'];
                endif;
                $this->db->where('id', $_SESSION['ID']);
                $this->db->update('usuarios', $dd);

                echo 11;

            else:

                echo 'Usuario não encontrado!';
            endif;
        else:

            echo 'Ocorreu um erro!';
        endif;

    }

    public function logout()
    {
        if ($this->ModelDefault->session() == true):
            if (isset($_SESSION['Auth01'])): unset($_SESSION['Auth01']); endif;
            if (isset($_SESSION['NAME'])): unset($_SESSION['NAME']); endif;
            if (isset($_SESSION['EMAIL'])): unset($_SESSION['EMAIL']); endif;
            if (isset($_SESSION['PASS'])): unset($_SESSION['PASS']); endif;
            if (isset($_SESSION['ID'])): unset($_SESSION['ID']); endif;
            if (isset($_SESSION['IP'])): unset($_SESSION['IP']); endif;
            echo 11;
        else:
            echo 'Erro ao realizar logoff';

        endif;
    }

    //Funções do Carrinho

    public function carrinho()
    {
        $mps = 0;
        if (!isset($_SESSION['addcarrinho'])):
            $_SESSION['addcarrinho'] = $_POST['id'];
        else:
            $explode = explode(',', $_SESSION['addcarrinho']);
            $count = count($explode);
            for ($i = 0; $i < $count; $i++):
                if ($explode[$i] == $_POST['id']):
                    $mps = 1;
                endif;
            endfor;
            if ($mps == 0):
                $_SESSION['addcarrinho'] = $_SESSION['addcarrinho'] . ',' . $_POST['id'];
            endif;
        endif;
        echo 11;
    }

    public function remover_item_carrinho()
    {
        $_SESSION['addcarrinho'] = @str_replace(array(',' . $_POST['produto'], $_POST['produto'] . ',', $_POST['produto']), array('', '', ''), $_SESSION['addcarrinho']);
        echo 11;
    }

    public function limpar_carrinho()
    {

        if (isset($_SESSION['addcarrinho'])):

            $explode = explode(',', $_SESSION['addcarrinho']);

            $count = count($explode);

            if ($count > 0):

                for ($i = 0; $i < $count; $i++):

                    if (isset($_SESSION['PROPOSTA_' . $explode[$i]])):
                        unset($_SESSION['PROPOSTA_' . $explode[$i]]);
                    endif;

                    if (isset($_SESSION['QNCAR' . $explode[$i]])):
                        unset($_SESSION['QNCAR' . $explode[$i]]);
                    endif;


                endfor;

            endif;

            unset($_SESSION['addcarrinho']);

            echo 11;

        endif;
    }

    //Sub Funções do Carrinho

    public function attache_card()
    {


        $explode = explode(',', $_SESSION['addcarrinho']);

        $count = count($explode);


        if (isset($_SESSION['addcarrinho'])):
            $explode = explode(',', $_SESSION['addcarrinho']);

            $count = count($explode);
            for ($i = 0; $i < 5; $i++):
                $this->db->from('produtos');
                $this->db->where('id', @$explode[$i]);
                $this->db->where('status', 1);
                $get = $this->db->get();
                $count = $get->num_rows();
                if ($count > 0):
                    $produto = $get->result_array()[0];

                    if (empty($produto['image']) and !empty($produto['image_externa'])):
                        $image = $produto['image_externa'];
                    else:
                        $image = base_url('web/imagens/' . $produto['image']);
                    endif;

                    if (isset($_SESSION['QNCAR' . $explode[$i]])):

                        $quantidade = $_SESSION['QNCAR' . $explode[$i]];

                    else:

                        $quantidade = 1;

                    endif;
                    ?>
                    <!-- Entry-->
                    <div class="entry">
                        <div class="entry-thumb"><a href="<?php echo base_url('oferta/' . $produto['id']); ?>"><img
                                        src="<?php echo $image; ?>" alt="Product"></a></div>
                        <div class="entry-content">
                            <h4 class="entry-title"><a
                                        href="<?php echo base_url('oferta/' . $produto['id']); ?>"><?php echo $this->ModelDefault->textolimit($produto['nome'], 30); ?></a>
                            </h4><span
                                    class="entry-meta"><?php echo number_format($quantidade); ?> x R$<?php echo $produto['valor']; ?></span>
                        </div>


                        <?php if ($count > 1): ?>

                            <div class="entry-delete" onclick="removecarrinho('<?php echo $produto['id']; ?>');"><i
                                        class="icon-x"></i></div>

                        <?php else: ?>

                            <div class="entry-delete" onclick="limparcarrinho();"><i class="icon-x"></i></div>

                        <?php endif; ?>
                    </div>


                <?php

                endif;
            endfor;

            ?>
            <div class="d-flex">
                <div class="pr-2 w-50"><a class="btn btn-secondary btn-sm btn-block mb-0"
                                          href="<?php echo base_url('carrinho'); ?>">Todos Itens</a></div>
                <div class="pl-2 w-50"><a class="btn btn-primary btn-sm btn-block mb-0"
                                          href="javascript:limparcarrinho();">Limpar</a></div>
            </div>

        <?php
        endif;

    }

    public function count_card()
    {
        if (isset($_SESSION['addcarrinho'])):
            $explode = explode(',', $_SESSION['addcarrinho']);

            $count = count($explode);

            echo $count;
        endif;
    }


    public function updateqnt_card()
    {

        if($_POST['quantidade'] > 0):

            $_SESSION['QNCAR' . $_POST['id']] = $_POST['quantidade'];

        endif;
        echo 11;
    }

    public function lanceitemcard()
    {
        if ($this->ModelDefault->session() == false):

            echo 'E necessario estar logado para enviar esse tipo de cotação';

        else:

            $this->db->from('produtos');
            $this->db->where('id', $_POST['item']);
            $get = $this->db->get();
            $produto = $get->result_array()[0];

            if ($_POST['valor'] >= $produto['preco'] and isset($_SESSION['PROPOSTA_' . $_POST['item']])):
                unset($_SESSION['PROPOSTA_' . $_POST['item']]);
                echo 11;
            elseif ($_POST['valor'] > $produto['preco'] and !isset($_SESSION['PROPOSTA_' . $_POST['item']])):
                echo 'O valor da Proposta esta acima do preço do produto!';

            elseif ($_POST['valor'] == $produto['preco'] and !isset($_SESSION['PROPOSTA_' . $_POST['item']])):
                echo 11;

            elseif ($_POST['valor'] <= 0):
                echo 'Informe um valor para valido!';

            else:
                $_SESSION['PROPOSTA_' . $_POST['item']] = str_replace(',', '', $_POST['valor']);
                echo 11;

            endif;


        endif;
    }

    //Funções de Envio da Proposta

    public function enviarcotacao()
    {
        if(isset($_POST['quantidade']) and !empty($_POST['quantidade'])):
            $quantidade = $_POST['quantidade'];
        else:
            $quantidade = 1;
        endif;
        if($_POST['valor'] < 0 or $quantidade < 0):
            echo 'Quantidade ou preço informado, inválidos';
        else:

            if (isset($_SESSION['ID'])):
                $this->db->from('produtos');
                $this->db->where('id', $_POST['id']);
                $get = $this->db->get();
                $count = $get->num_rows();

                if ($count > 0):
                    $produto = $get->result_array()[0];

                    $this->db->from('empresas');
                    $this->db->where('id', $produto['empresa']);
                    $this->db->where('status', 1);
                    $get = $this->db->get();
                    $count = $get->num_rows();
                    if ($count > 0):
                        $empresa = $get->result_array()[0];


                        $this->db->from('usuarios');
                        $this->db->where('id', $_SESSION['ID']);
                        $get = $this->db->get();
                        $countus = $get->num_rows();


                        if ($countus > 0):

                            $userdados = $get->result_array()[0];
                            $code = $_POST['id'] . $produto['empresa'] . rand();

                            $dparrayss['data'] = date('d/m/Y');
                            $dparrayss['cadastro'] = $_SESSION['ID'];
                            $dparrayss['empresa'] = $produto['empresa'];
                            $dparrayss['valor'] = $produto['preco'];
                            $dparray['valor_desconto'] =  str_replace(',','',$_POST['valor']);
                            $dparrayss['produtos_cotados'] = 1;
                            $dparrayss['situacao'] = 0;
                            $dparrayss['status'] = 1;
                            $this->db->insert('cotacoes', $dparrayss);

                            $cotacao_id = $this->db->insert_id();

                            if(isset($_POST['quantidade']) and !empty($_POST['quantidade'])):
                                $quantidade = $_POST['quantidade'];
                            else:
                                $quantidade = 1;
                            endif;

                            $dparray['lista_cotacao'] = $cotacao_id;
                            $dparray['produto_id'] = $_POST['id'];
                            $dparray['empresa'] = $produto['empresa'];
                            $dparray['quantidade'] = $quantidade;
                            $dparray['data'] = date('d/m/Y');
                            $dparray['valor'] = $produto['preco'];
                            $dparray['valor_desconto'] =  str_replace(',','',$_POST['valor']);
                            $dparray['status'] = 1;
                            $this->db->insert('cotacoes_itens', $dparray);


                            $cotacoesdb['valor'] = $produto['preco'];
                            $cotacoesdb['valor_desconto'] = $_POST['valor'];
                            $this->db->where('id', $cotacao_id);
                            $this->db->update('cotacoes', $cotacoesdb);

                            $corpo = '<meta name="viewport" content="width=device-width, initial-scale=1.0">     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">     <title>Configurar uma nova senha para [Product Name]</title>                <style type="text/css"> body { width: 100% !important; height: 100%; margin: 0; line-height: 1.4; background-color: #F2F4F6; color: #74787E; -webkit-text-size-adjust: none; } @media only screen and (max-width: 600px) {   .email-body_inner {     width: 100% !important;   }   .email-footer {     width: 100% !important;   } } @media only screen and (max-width: 500px) {   .button {     width: 100% !important;   } } </style>   <span class="preheader" style="box-sizing: border-box; display: none !important; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; font-size: 1px; line-height: 1px; max-height: 0; max-width: 0; mso-hide: all; opacity: 0; overflow: hidden; visibility: hidden;">Use esse link para resetar sua senha. O link e valido por 24 horas.</span>     <table class="email-wrapper" width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; margin: 0; padding: 0; width: 100%;" bgcolor="#F2F4F6">       <tbody><tr>         <td align="center" style="box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; word-break: break-word;">           <table class="email-content" width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; margin: 0; padding: 0; width: 100%;">             <tbody><tr>               <td class="email-masthead" style="box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; padding: 25px 0; word-break: break-word;" align="center"><p><img src="https://demojdlsites.com/sistema-busca/web/imagens/12012019_270824410.png" data-filename="14012019_853197161Cópia de LEILÃO ONLINE.png" style="width: 25%; float: none;margin-botton:-50px;" class=""><a href="https://demojdlsites.com/sistema-leilao/" class="email-masthead_name" style="box-sizing: border-box; color: #bbbfc3; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; font-size: 16px; font-weight: bold; text-decoration: none; text-shadow: 0 1px 0 white;"></a></p></td></tr><tr><td class="email-body" width="100%" cellpadding="0" cellspacing="0" style="-premailer-cellpadding: 0; -premailer-cellspacing: 0; border-bottom-color: #EDEFF2; border-bottom-style: solid; border-bottom-width: 1px; border-top-color: #EDEFF2; border-top-style: solid; border-top-width: 1px; box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; margin: 0; padding: 0; width: 100%; word-break: break-word;" bgcolor="#FFFFFF"><table class="email-body_inner" align="center" width="570" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; margin: 0 auto; padding: 0; width: 570px;" bgcolor="#FFFFFF">                                      <tbody><tr>                     <td class="content-cell" style="box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; padding: 35px; word-break: break-word;">                       <h1 style="box-sizing: border-box; color: #2F3133; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; font-size: 19px; font-weight: bold; margin-top: 0;" align="left">Olá, Parceiro</h1>                       <p style="box-sizing: border-box; color: #74787E; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; font-size: 16px; line-height: 1.5em; margin-top: 0;" align="left">Você tem uma nova Solicitação de Cotação, confira a sua lista clicando no botão abaixo.</p>                                              <table class="body-action" align="center" width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; margin: 30px auto; padding: 0; text-align: center; width: 100%;">                         <tbody><tr>                           <td align="center" style="box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; word-break: break-word;">                                                          <table width="100%" border="0" cellspacing="0" cellpadding="0" style="box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif;">                               <tbody><tr>                                 <td align="center" style="box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; word-break: break-word;">                                   <table border="0" cellspacing="0" cellpadding="0" style="box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif;">                                     <tbody><tr>                                       <td style="box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; word-break: break-word;"><a href="{{action_url}}" class="button button--green" target="_blank" style="-webkit-text-size-adjust: none; background: #22BC66; border-color: #22bc66; border-radius: 3px; border-style: solid; border-width: 10px 18px; box-shadow: 0 2px 3px rgba(0, 0, 0, 0.16); box-sizing: border-box; color: #FFF; display: inline-block; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; text-decoration: none;">Acessar Lista</a>                                       </td>                                     </tr>                                   </tbody></table>                                 </td>                               </tr>                             </tbody></table>                           </td>                         </tr>                       </tbody></table>                       <p style="box-sizing: border-box; color: #74787E; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; font-size: 16px; line-height: 1.5em; margin-top: 0;" align="left"><br></p>                       <p style="box-sizing: border-box; color: #74787E; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; font-size: 16px; line-height: 1.5em; margin-top: 0;" align="left">Obrigado,                         <br>A equipe do&nbsp;<span style="color: rgb(121, 121, 121); background-color: transparent; font-size: 14px;">LeiloFarma</span></p>                                                                   </td>                   </tr>                 </tbody></table>               </td>             </tr>             <tr>               <td style="box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; word-break: break-word;">                 <table class="email-footer" align="center" width="570" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; margin: 0 auto; padding: 0; text-align: center; width: 570px;">                   <tbody><tr>                     <td class="content-cell" align="center" style="box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; padding: 35px; word-break: break-word;">                       <p class="sub align-center" style="box-sizing: border-box; color: #AEAEAE; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; font-size: 12px; line-height: 1.5em; margin-top: 0;" align="center">©&nbsp;<span style="color: rgb(121, 121, 121); font-size: 14px; text-align: -webkit-left;">LeiloFarma</span>. Todos os Direitos Reservados.</p>                       <p class="sub align-center" style="box-sizing: border-box; color: #AEAEAE; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; font-size: 12px; line-height: 1.5em; margin-top: 0;" align="center">                         https://demojdlsites.com/sistema-leilao/                                                </p>                     </td>                   </tr>                 </tbody></table>               </td>             </tr>           </tbody></table>         </td>       </tr>     </tbody></table>    ';
                            $array['corpo'] = str_replace('{{action_url}}', base_url('empresa'), $corpo);
                            $array['para'] = $empresa['email'];
                            $array['npara'] = 'LeiloFarma Solicitação de Cotação';
                            $array['assunto'] = 'LeiloFarma Solicitação de Cotação';



                            if ($this->ModelDefault->sendMail($array)):
                                echo 11;
                            else:
                                echo 'Erro ao enviar cotação no Email do Parceiro';
                            endif;

                        else:
                            echo 'Usuario Inexistente';


                        endif;
                    else:

                        echo 'Empresa Inexistente ou Descredenciada';

                    endif;
                else:

                    echo 'Produto não encontrado!';

                endif;


            else:

                $this->db->from('produtos');
                $this->db->where('id', $_POST['id']);
                $get = $this->db->get();
                $count = $get->num_rows();

                if ($count > 0):
                    $produto = $get->result_array()[0];

                    $this->db->from('empresas');
                    $this->db->where('id', $produto['empresa']);
                    $this->db->where('status', 1);
                    $get = $this->db->get();
                    $count = $get->num_rows();
                    if ($count > 0):
                        $empresa = $get->result_array()[0];

                        $this->db->from('cotacoes_usuarios');
                        $this->db->where('estado', $_POST['estado']);
                        $this->db->where('cidade', $_POST['cidade']);
                        $this->db->where('telefone', $_POST['telefone']);
                        $this->db->where('nome', $_POST['nome']);
                        $this->db->where('email', $_POST['email']);
                        if(isset($_POST['cep'])):
                            $this->db->where('cep', @$_POST['cep']);
                        endif;
                        $this->db->where('status', 1);
                        $get = $this->db->get();
                        $countcliente = $get->num_rows();

                        if ($countcliente > 0):
                            $clienteid = $get->result_array()[0]['id'];
                        else:
                            $clarray['estado'] = $_POST['estado'];
                            $clarray['cidade'] = $_POST['cidade'];
                            $clarray['telefone'] = $_POST['telefone'];
                            $clarray['nome'] = $_POST['nome'];
                            $clarray['email'] = $_POST['email'];
                            $clarray['status'] = 1;
                            if(isset($_POST['cep'])):
                                $clarray['cep'] = $_POST['cep'];
                            endif;
                            $this->db->insert('cotacoes_usuarios', $clarray);
                            $clienteid = $this->db->insert_id();

                        endif;


                        $dparrayss['data'] = date('d/m/Y');
                        $dparrayss['cliente'] = $clienteid;
                        $dparrayss['empresa'] = $produto['empresa'];
                        $dparrayss['valor'] = $produto['preco'];
                        $dparrayss['valor_desconto'] =  str_replace(',','',$_POST['valor']);
                        $dparrayss['produtos_cotados'] = 1;
                        $dparrayss['status'] = 1;
                        $this->db->insert('cotacoes', $dparrayss);

                        $cotacao_id = $this->db->insert_id();

                        if(isset($_POST['quantidade']) and !empty($_POST['quantidade'])):
                            $quantidade = $_POST['quantidade'];
                        else:
                            $quantidade = 1;
                        endif;

                        $dparray['lista_cotacao'] = $cotacao_id;
                        $dparray['produto_id'] = $_POST['id'];;
                        $dparray['empresa'] = $produto['empresa'];
                        $dparray['data'] = date('d/m/Y');
                        $dparray['valor'] = $produto['preco'];
                        $dparray['quantidade'] = $quantidade;
                        $dparray['valor_desconto'] =  $_POST['valor'];
                        $dparray['status'] = 1;
                        $this->db->insert('cotacoes_itens', $dparray);


                        $cotacoesdb['valor'] = $produto['preco'];
                        $cotacoesdb['valor_desconto'] = $_POST['valor'];
                        $this->db->where('id', $cotacao_id);
                        $this->db->update('cotacoes', $cotacoesdb);

                        $corpo = '<meta name="viewport" content="width=device-width, initial-scale=1.0">     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">     <title>Configurar uma nova senha para [Product Name]</title>                <style type="text/css"> body { width: 100% !important; height: 100%; margin: 0; line-height: 1.4; background-color: #F2F4F6; color: #74787E; -webkit-text-size-adjust: none; } @media only screen and (max-width: 600px) {   .email-body_inner {     width: 100% !important;   }   .email-footer {     width: 100% !important;   } } @media only screen and (max-width: 500px) {   .button {     width: 100% !important;   } } </style>   <span class="preheader" style="box-sizing: border-box; display: none !important; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; font-size: 1px; line-height: 1px; max-height: 0; max-width: 0; mso-hide: all; opacity: 0; overflow: hidden; visibility: hidden;">Use esse link para resetar sua senha. O link e valido por 24 horas.</span>     <table class="email-wrapper" width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; margin: 0; padding: 0; width: 100%;" bgcolor="#F2F4F6">       <tbody><tr>         <td align="center" style="box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; word-break: break-word;">           <table class="email-content" width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; margin: 0; padding: 0; width: 100%;">             <tbody><tr>               <td class="email-masthead" style="box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; padding: 25px 0; word-break: break-word;" align="center"><p><img src="https://demojdlsites.com/sistema-busca/web/imagens/12012019_270824410.png" data-filename="14012019_853197161Cópia de LEILÃO ONLINE.png" style="width: 25%; float: none;margin-botton:-50px;" class=""><a href="https://demojdlsites.com/sistema-leilao/" class="email-masthead_name" style="box-sizing: border-box; color: #bbbfc3; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; font-size: 16px; font-weight: bold; text-decoration: none; text-shadow: 0 1px 0 white;"></a></p></td></tr><tr><td class="email-body" width="100%" cellpadding="0" cellspacing="0" style="-premailer-cellpadding: 0; -premailer-cellspacing: 0; border-bottom-color: #EDEFF2; border-bottom-style: solid; border-bottom-width: 1px; border-top-color: #EDEFF2; border-top-style: solid; border-top-width: 1px; box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; margin: 0; padding: 0; width: 100%; word-break: break-word;" bgcolor="#FFFFFF"><table class="email-body_inner" align="center" width="570" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; margin: 0 auto; padding: 0; width: 570px;" bgcolor="#FFFFFF">                                      <tbody><tr>                     <td class="content-cell" style="box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; padding: 35px; word-break: break-word;">                       <h1 style="box-sizing: border-box; color: #2F3133; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; font-size: 19px; font-weight: bold; margin-top: 0;" align="left">Olá, Parceiro</h1>                       <p style="box-sizing: border-box; color: #74787E; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; font-size: 16px; line-height: 1.5em; margin-top: 0;" align="left">Você tem uma nova Solicitação de Cotação, confira a sua lista clicando no botão abaixo.</p>                                              <table class="body-action" align="center" width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; margin: 30px auto; padding: 0; text-align: center; width: 100%;">                         <tbody><tr>                           <td align="center" style="box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; word-break: break-word;">                                                          <table width="100%" border="0" cellspacing="0" cellpadding="0" style="box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif;">                               <tbody><tr>                                 <td align="center" style="box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; word-break: break-word;">                                   <table border="0" cellspacing="0" cellpadding="0" style="box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif;">                                     <tbody><tr>                                       <td style="box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; word-break: break-word;"><a href="{{action_url}}" class="button button--green" target="_blank" style="-webkit-text-size-adjust: none; background: #22BC66; border-color: #22bc66; border-radius: 3px; border-style: solid; border-width: 10px 18px; box-shadow: 0 2px 3px rgba(0, 0, 0, 0.16); box-sizing: border-box; color: #FFF; display: inline-block; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; text-decoration: none;">Acessar Lista</a>                                       </td>                                     </tr>                                   </tbody></table>                                 </td>                               </tr>                             </tbody></table>                           </td>                         </tr>                       </tbody></table>                       <p style="box-sizing: border-box; color: #74787E; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; font-size: 16px; line-height: 1.5em; margin-top: 0;" align="left"><br></p>                       <p style="box-sizing: border-box; color: #74787E; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; font-size: 16px; line-height: 1.5em; margin-top: 0;" align="left">Obrigado,                         <br>A equipe do&nbsp;<span style="color: rgb(121, 121, 121); background-color: transparent; font-size: 14px;">LeiloFarma</span></p>                                                                   </td>                   </tr>                 </tbody></table>               </td>             </tr>             <tr>               <td style="box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; word-break: break-word;">                 <table class="email-footer" align="center" width="570" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; margin: 0 auto; padding: 0; text-align: center; width: 570px;">                   <tbody><tr>                     <td class="content-cell" align="center" style="box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; padding: 35px; word-break: break-word;">                       <p class="sub align-center" style="box-sizing: border-box; color: #AEAEAE; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; font-size: 12px; line-height: 1.5em; margin-top: 0;" align="center">©&nbsp;<span style="color: rgb(121, 121, 121); font-size: 14px; text-align: -webkit-left;">LeiloFarma</span>. Todos os Direitos Reservados.</p>                       <p class="sub align-center" style="box-sizing: border-box; color: #AEAEAE; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; font-size: 12px; line-height: 1.5em; margin-top: 0;" align="center">                         https://demojdlsites.com/sistema-leilao/                                                </p>                     </td>                   </tr>                 </tbody></table>               </td>             </tr>           </tbody></table>         </td>       </tr>     </tbody></table>    ';
                        $array['corpo'] = str_replace('{{action_url}}', base_url('empresa'), $corpo);
                        $array['para'] = $empresa['email'];
                        $array['npara'] = 'LeiloFarma Solicitação de Cotação - ' . $empresa['nome'];
                        $array['assunto'] = 'LeiloFarma Solicitação de Cotação';

                        if ($this->ModelDefault->sendMail($array)):
                            echo 11;
                        else:
                            echo 'Erro ao enviar cotação no Email do Parceiro';
                        endif;

                    else:

                        echo 'Empresa Inexistente ou Descredenciada';

                    endif;
                else:

                    echo 'Produto não encontrado!';

                endif;



            endif;


        endif;
    }


    public function intencao()
    {
        $dparrayss['data'] = date('d/m/Y');
        $dparrayss['usuario'] = isset($_SESSION['ID']) ? $_SESSION['ID'] : '';
        $dparrayss['produto_id'] = $_POST['id'];
        $dparrayss['ip'] = $_SERVER["REMOTE_ADDR"];
        $this->db->insert('cotacoes_intencoes', $dparrayss);

    }


    public function enviarcotacaocarrinho()
    {
        if ($this->ModelDefault->session() == false):

            echo 'E necessario estar logado para enviar esse tipo de cotação';

        else:
            if (isset($_SESSION['addcarrinho'])):


                $dparrayss['data'] = date('d/m/Y');
                $dparrayss['cadastro'] = $_SESSION['ID'];
                $dparrayss['produtos_cotados'] = 1;
                $dparrayss['situacao'] = 0;
                $dparrayss['status'] = 1;
                $this->db->insert('cotacoes', $dparrayss);

                $cotacao_id = $this->db->insert_id();


                $explode = explode(',', $_SESSION['addcarrinho']);

                $countsss = count($explode);

                if ($countsss > 0):

                    $valorss = 0;
                    $valordescontoss = 0;
                    for ($i = 0; $i < $countsss; $i++):
                        $this->db->from('produtos');
                        $this->db->where('id', $explode[$i]);
                        $get = $this->db->get();
                        $count = $get->num_rows();

                        if ($count > 0):

                            $produto = $get->result_array()[0];


                            if (isset($_SESSION['QNCAR' . $explode[$i]])):

                                $quantidade = $_SESSION['QNCAR' . $explode[$i]];

                            else:

                                $quantidade = 1;

                            endif;

                            if (isset($_SESSION['PROPOSTA_' . $explode[$i]])): $valordesconto = $_SESSION['PROPOSTA_' . $explode[$i]];
                                unset($_SESSION['PROPOSTA_' . $explode[$i]]);
                            else: $valordesconto = $produto['preco']; endif;

                            $dparray['lista_cotacao'] = $cotacao_id;
                            $dparray['produto_id'] = $produto['id'];
                            $dparray['valor'] = $produto['preco'];
                            $dparray['empresa'] = $produto['empresa'];
                            $dparray['valor_desconto'] = $valordesconto;
                            $dparray['data'] = date('d/m/Y');
                            $dparray['quantidade'] = $quantidade;
                            $dparray['status'] = 1;
                            $this->db->insert('cotacoes_itens', $dparray);

                        endif;
                        $valorss = $valorss + $produto['preco'];
                        $valordescontoss = $valordescontoss + $valordesconto;

                        unset($_SESSION['QNCAR' . $produto['id']]);
                    endfor;
                    $cotacoesdb['valor'] = 0;
                    $cotacoesdb['valor_desconto'] = 0;



                    $this->db->where('id', $cotacao_id);
                    $this->db->update('cotacoes', $cotacoesdb);

                    $this->db->from('empresas');
                    $this->db->where('id', $produto['empresa']);
                    $this->db->where('status', 1);
                    $get = $this->db->get();
                    $count = $get->num_rows();
                    if ($count > 0):
                        $empresa = $get->result_array()[0];


                        $corpo = '<meta name="viewport" content="width=device-width, initial-scale=1.0">     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">     <title>Configurar uma nova senha para [Product Name]</title>                <style type="text/css"> body { width: 100% !important; height: 100%; margin: 0; line-height: 1.4; background-color: #F2F4F6; color: #74787E; -webkit-text-size-adjust: none; } @media only screen and (max-width: 600px) {   .email-body_inner {     width: 100% !important;   }   .email-footer {     width: 100% !important;   } } @media only screen and (max-width: 500px) {   .button {     width: 100% !important;   } } </style>   <span class="preheader" style="box-sizing: border-box; display: none !important; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; font-size: 1px; line-height: 1px; max-height: 0; max-width: 0; mso-hide: all; opacity: 0; overflow: hidden; visibility: hidden;">Use esse link para resetar sua senha. O link e valido por 24 horas.</span>     <table class="email-wrapper" width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; margin: 0; padding: 0; width: 100%;" bgcolor="#F2F4F6">       <tbody><tr>         <td align="center" style="box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; word-break: break-word;">           <table class="email-content" width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; margin: 0; padding: 0; width: 100%;">             <tbody><tr>               <td class="email-masthead" style="box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; padding: 25px 0; word-break: break-word;" align="center"><p><img src="https://demojdlsites.com/sistema-busca/web/imagens/12012019_270824410.png" data-filename="14012019_853197161Cópia de LEILÃO ONLINE.png" style="width: 25%; float: none;margin-botton:-50px;" class=""><a href="https://demojdlsites.com/sistema-leilao/" class="email-masthead_name" style="box-sizing: border-box; color: #bbbfc3; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; font-size: 16px; font-weight: bold; text-decoration: none; text-shadow: 0 1px 0 white;"></a></p></td></tr><tr><td class="email-body" width="100%" cellpadding="0" cellspacing="0" style="-premailer-cellpadding: 0; -premailer-cellspacing: 0; border-bottom-color: #EDEFF2; border-bottom-style: solid; border-bottom-width: 1px; border-top-color: #EDEFF2; border-top-style: solid; border-top-width: 1px; box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; margin: 0; padding: 0; width: 100%; word-break: break-word;" bgcolor="#FFFFFF"><table class="email-body_inner" align="center" width="570" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; margin: 0 auto; padding: 0; width: 570px;" bgcolor="#FFFFFF">                                      <tbody><tr>                     <td class="content-cell" style="box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; padding: 35px; word-break: break-word;">                       <h1 style="box-sizing: border-box; color: #2F3133; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; font-size: 19px; font-weight: bold; margin-top: 0;" align="left">Olá, Parceiro</h1>                       <p style="box-sizing: border-box; color: #74787E; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; font-size: 16px; line-height: 1.5em; margin-top: 0;" align="left">Você tem uma nova Solicitação de Cotação, confira a sua lista clicando no botão abaixo.</p>                                              <table class="body-action" align="center" width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; margin: 30px auto; padding: 0; text-align: center; width: 100%;">                         <tbody><tr>                           <td align="center" style="box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; word-break: break-word;">                                                          <table width="100%" border="0" cellspacing="0" cellpadding="0" style="box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif;">                               <tbody><tr>                                 <td align="center" style="box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; word-break: break-word;">                                   <table border="0" cellspacing="0" cellpadding="0" style="box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif;">                                     <tbody><tr>                                       <td style="box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; word-break: break-word;"><a href="{{action_url}}" class="button button--green" target="_blank" style="-webkit-text-size-adjust: none; background: #22BC66; border-color: #22bc66; border-radius: 3px; border-style: solid; border-width: 10px 18px; box-shadow: 0 2px 3px rgba(0, 0, 0, 0.16); box-sizing: border-box; color: #FFF; display: inline-block; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; text-decoration: none;">Acessar Lista</a>                                       </td>                                     </tr>                                   </tbody></table>                                 </td>                               </tr>                             </tbody></table>                           </td>                         </tr>                       </tbody></table>                       <p style="box-sizing: border-box; color: #74787E; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; font-size: 16px; line-height: 1.5em; margin-top: 0;" align="left"><br></p>                       <p style="box-sizing: border-box; color: #74787E; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; font-size: 16px; line-height: 1.5em; margin-top: 0;" align="left">Obrigado,                         <br>A equipe do&nbsp;<span style="color: rgb(121, 121, 121); background-color: transparent; font-size: 14px;">LeiloFarma</span></p>                                                                   </td>                   </tr>                 </tbody></table>               </td>             </tr>             <tr>               <td style="box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; word-break: break-word;">                 <table class="email-footer" align="center" width="570" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; margin: 0 auto; padding: 0; text-align: center; width: 570px;">                   <tbody><tr>                     <td class="content-cell" align="center" style="box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; padding: 35px; word-break: break-word;">                       <p class="sub align-center" style="box-sizing: border-box; color: #AEAEAE; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; font-size: 12px; line-height: 1.5em; margin-top: 0;" align="center">©&nbsp;<span style="color: rgb(121, 121, 121); font-size: 14px; text-align: -webkit-left;">LeiloFarma</span>. Todos os Direitos Reservados.</p>                       <p class="sub align-center" style="box-sizing: border-box; color: #AEAEAE; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; font-size: 12px; line-height: 1.5em; margin-top: 0;" align="center">                         https://demojdlsites.com/sistema-leilao/                                                </p>                     </td>                   </tr>                 </tbody></table>               </td>             </tr>           </tbody></table>         </td>       </tr>     </tbody></table>    ';
                        $array['corpo'] = str_replace('{{action_url}}', base_url('empresa'), $corpo);
                        $array['para'] = $empresa['email'];
                        $array['npara'] = 'LeiloFarma Solicitação de Cotação';
                        $array['assunto'] = 'LeiloFarma Solicitação de Cotação';

                        unset($_SESSION['addcarrinho']);
                        if ($this->ModelDefault->sendMail($array)):
                            echo 11;
                        else:
                            echo 'Erro ao enviar cotação no Email do Parceiro';
                        endif;

                    else:
                        echo 11;

                    endif;
                endif;

            endif;


        endif;


    }


    //Funções da Busca

    public function keypress()
    {


        if (empty($_POST['valor']) or !empty($_POST['valor']) and strlen($_POST['valor']) <= 4):

            unset($_SESSION['ORDER_RAND']);

        endif;

        if (!empty($_POST['valor']) and strlen($_POST['valor']) > 5):

            $_SESSION['ORDER_RAND'] = 1;

        endif;
        $this->db->from('produtos');
        $this->db->where('status', 1);
        $this->db->where('ean!=','');
        $this->db->like('LOWER(nome)', strtolower($_POST['valor']), 'before');
        $this->db->or_like('LOWER(nome)', strtolower($_POST['valor']), 'after');
        $this->db->or_like('LOWER(nome)', strtolower($_POST['valor']));
        if (isset($_SESSION['ORDER_RAND'])):
            //$this->db->order_by('acessos','desc');
        endif;
        $this->db->limit(12, 0);
        $get = $this->db->get();
        $count = $get->num_rows();
        if ($count > 0):
            $produto = $get->result_array();

            $empresa = 0;
            $cts = $count;

            foreach ($produto as $value) {

                if (!empty($value['image_externa'])):

                    $image = $value['image_externa'];

                else:

                    $image = base_url('web/imagens/' . $value['image']);
                endif;

                // echo '<li><a onclick="keysession(\''.$_POST['valor'].'\');" href="' . base_url('produto/' . $value['id'] . '') . '"><img src="'.$image.'" style="width: 40px;">&nbsp;&nbsp;&nbsp;&nbsp;' . $value['nome'] . '</a></li>';
                echo '<li><a onclick="keysession(\''.$_POST['valor'].'\');" href="' . base_url('produto/' . $value['id'] . '') . '">&nbsp;&nbsp;' . $value['nome'] . '</a></li>';


            }

        else:
            echo '<li><a>): Nenhuma sujestão encontrada</a></li>';

        endif;
    }

    public function keysession(){

        $_SESSION['keyword'] = $_POST['valor'];

    }

}