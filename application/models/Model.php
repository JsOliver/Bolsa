<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->db->reconnect();
        @session_start();
    }


    public function setDirSystem($arr)
    {

        $return = 'default';


        $this->db->from('permissoes');
        $this->db->where('id', $arr);
        $this->db->where('status', 1);
        $get = $this->db->get();
        $count = $get->num_rows();


        if ($count > 0):
            $administrador = $get->result_array()[0];


            if (file_exists('../../views/sistema/' . $administrador['itens'] . '/index.php')):

            else:

                if ($administrador['acoes'] == 0):
                    mkdir(dirname(__FILE__) . '../../../assets/sistemas/' . $administrador['itens'] . '', 0777, true);
                    mkdir(dirname(__FILE__) . '../../views/sistema/' . $administrador['itens'] . '', 0777, true);
                    mkdir(dirname(__FILE__) . '../../views/sistema/' . $administrador['itens'] . '/fixed', 0777, true);

                    $conteudop = '<?php 
            
        $this->db->from("permissoes");
        $this->db->where("id", ' . $arr . ');
        $this->db->where("status", 1);
        $this->db->where("acoes", 0);
        $get = $this->db->get();
        $count = $get->num_rows();
if($count > 0):

header("Location:/");

else:

echo "' . $administrador['nome'] . '";
endif;
            
            ?>';
                    $conteudo = '';

                    file_put_contents(dirname(__FILE__) . '../../views/sistema/' . $administrador['itens'] . '/fixed/header.php', $conteudo);
                    file_put_contents(dirname(__FILE__) . '../../views/sistema/' . $administrador['itens'] . '/fixed/footer.php', $conteudo);
                    file_put_contents(dirname(__FILE__) . '../../views/sistema/' . $administrador['itens'] . '/index.php', $conteudop);

                    $ars['acoes'] = 1;
                    $this->db->where('id', $arr);
                    $this->db->update('permissoes', $ars);
                endif;
            endif;

            $return = $administrador['itens'];

        endif;


        return $return;
    }


    public function tratar_campos($post)
    {

        if (isset($post['pass'])):
            $post['pass'] = md5($post['pass']);
        endif;


        if(isset($post['stats']) and $post['stats'] == 0 and isset($post['iditem']) and $post['iditem'] > 0):
            $post['data_acrescimo'] = '';

            $this->db->from('lotes');
            $this->db->where('id',$post['iditem']);
            $this->db->where('status',1);
            $get = $this->db->get();
            $lote = $get->result_array()[0];
            /*

                        if(empty($lote['data_acrescimo'])):
                            if(date('Y-m-d H:i') > date('Y-m-d H:i',strtotime($lote['data_fim'])) and isset($post['data_fim'])):

                                $post['data_fim'] = str_replace(' ','T',date("Y-m-d H:i", strtotime(date('Y-m-d H:i:s') . " + 5 minutes")));
                                $post['data_acrescimo'] = '';

                            endif;
                            else:
                                if(date('Y-m-d H:i') > date('Y-m-d H:i',strtotime($lote['data_acrescimo'])) and isset($post['data_acrescimo'])):

                                    $post['data_fim'] = str_replace(' ','T',date("Y-m-d H:i", strtotime(date('Y-m-d H:i:s') . " + 5 minutes")));
                                    $post['data_acrescimo'] = '';

                                endif;
                        endif;

            */

        endif;


        return $post;
    }


    public function newbuttomtable($post,$class)
    {

        $return = '';

        $this->db->from('menu_admin');
        $this->db->where('id', $post['campo']);
        $get = $this->db->get();
        $count = $get->num_rows();

        if ($count > 0):
            $result = $get->result_array()[0];

            if($result['tabela'] <> 'cotacoes'):
                if (!empty($result['condicao'])):

                    $explode = explode(',', $result['condicao']);


                    if (!empty($explode[0]) and !empty($explode[1]) and $explode[0] == 'tipo'):
                        if($class == 'show'):

                            $return = ' <a href="javascript:newPostTable(1,' . $post['campo'] . ',' . $explode[1] . ');" class="btn btn-primary"><i class="fa fa-plus"></i> NOVO</a>';

                        else:
                            $return = ' <a href="javascript:void(0);" class="btn btn-default disabled"><i class="fa fa-plus"></i> NOVO</a>';

                        endif;
                    else:
                        if($class == 'show'):

                            $return = ' <a href="javascript:newPostTable(1,' . $post['campo'] . ');" class="btn btn-primary"><i class="fa fa-plus"></i> NOVO</a>';

                        else:
                            $return = ' <a href="javascript:void(0);" class="btn btn-default disabled"><i class="fa fa-plus"></i> NOVO</a>';

                        endif;
                    endif;


                else:

                    if($class == 'show'):
                        $return = ' <a href="javascript:newPostTable(1,' . $post['campo'] . ');" class="btn btn-primary"><i class="fa fa-plus"></i> NOVO</a>';
                    else:
                        $return = ' <a href="javascript:void(0);" class="btn btn-default disabled"><i class="fa fa-plus"></i> NOVO</a>';

                    endif;

                endif;
            endif;

            $return .= ' <a href="javascript:deletetudo();" class="btn btn-danger removeallselects disabled"><i class="fa fa-trash"></i> DELETAR SELECIONADOS</a>';



            $return .= '<div class="clearfixs"></div>';
            $return .= '<br>';


        endif;



        return $return;

    }


    public function recupera_fields($arr, $id)
    {


        $this->db->select('' . $arr['sel'] . '');
        $this->db->from('' . $arr['t1'] . '');
        $this->db->where('id', $id);
        $get = $this->db->get();
        $menu_admin = $get->result_array()[0];

        $this->db->from('' . $arr['t2'] . '');
        $this->db->where('id', $menu_admin[$arr['sel']]);
        $get = $this->db->get();
        $result = $get->result_array();


        return $result;

    }


    //Inicio Tables Admin Funções

    public function rowstbodyViewAdmin($arr)
    {
        if ($this->session_empresa() == true and $this->session_admin() == false):

            $this->db->from('empresas');
            $this->db->where('status', 1);
            $this->db->where('id', $_SESSION['ID_EMPRESA']);
        else:
            $this->db->from('administrador');
            $this->db->where('status', 1);
            $this->db->where('id', $_SESSION['ID_ADMIN']);
        endif;
        $get = $this->db->get();
        $administrador = $get->result_array()[0];

        $this->db->select('tabela,condicao,where_empresa,th');
        $this->db->from('menu_admin');
        $this->db->where('status', 1);
        $this->db->where('id', $arr['campo']);
        $get = $this->db->get();
        $menu_admin = $get->result_array();

        $explodeCond1 = explode('(//)', $menu_admin[0]['condicao']);
        $this->db->from('' . $menu_admin[0]['tabela'] . '');


        if(isset($arr['edit']) and $arr['edit'] > 0 and $menu_admin[0]['tabela'] == 'lotes'):
            $this->db->where('leiloes',$arr['edit']);

        endif;

        if (!empty($menu_admin[0]['condicao'])):
            for ($i = 0; $i < count($explodeCond1); $i++):
                $explodeCond2 = explode(',', $explodeCond1[$i]);
                $this->db->where($explodeCond2[0], $explodeCond2[1]);
            endfor;
        endif;


        $explodeCond3 = explode(',', $menu_admin[0]['where_empresa']);
        if (!empty($menu_admin[0]['where_empresa']) and isset($_SESSION['ID_EMPRESA'])):
            //  $this->db->where($explodeCond3[0], $_SESSION['ID_EMPRESA']);
        endif;
        if(isset($arr['keywordAdmin']) and !empty($arr['keywordAdmin'])):

            if($menu_admin[0]['tabela'] == 'produtos'):
                $this->db->like('nome', $arr['keywordAdmin']);

            elseif ($menu_admin[0]['tabela'] == 'usuarios'):
                $nbr_cpf = $arr['keywordAdmin'];

                $parte_um     = substr($nbr_cpf, 0, 3);
                $parte_dois   = substr($nbr_cpf, 3, 3);
                $parte_tres   = substr($nbr_cpf, 6, 3);
                $parte_quatro = substr($nbr_cpf, 9, 2);

                $monta_cpf = "$parte_um.$parte_dois.$parte_tres-$parte_quatro";

                $this->db->like('nome', $arr['keywordAdmin']);
                $this->db->or_like('email', $arr['keywordAdmin']);
                $this->db->or_like('id', $arr['keywordAdmin']);
                $this->db->or_like('cpf', $arr['keywordAdmin']);
                $this->db->or_like('cpf', $monta_cpf);
                $this->db->or_like('telefone', $arr['keywordAdmin']);
            else:

                $this->db->like('nome', $arr['keywordAdmin']);

            endif;
        endif;

        $this->db->order_by('id', 'desc');
        $get = $this->db->get();
        $count = $get->num_rows();
        $result = $get->result_array();

        if ($count > 0):

            foreach ($result as $value) {

                if ($arr['campo'] == 2):

                    if ($value['permissoes'] >= $administrador['permissoes']):
                        echo $this->tbodyViewAdmin($menu_admin[0]['tabela'], $arr, $value);
                    endif;
                else:
                    echo $this->tbodyViewAdmin($menu_admin[0]['tabela'], $arr, $value);

                endif;
            }

        else:


        endif;
    }


    public function tbodyViewAdmin($table, $arr, $value)
    {
        $return = '';
        $this->db->select('th,response');
        $this->db->from('menu_admin');
        $this->db->where('status', 1);
        $this->db->where('id', $arr['campo']);
        $get = $this->db->get();
        $menu_admin = $get->result_array();
        $forExplode = explode(',', $menu_admin[0]['th']);
        $return .= '<tr id="' . $value['id'] . '" lang="dsa" style="border-bottom:1px solid black;">';
        for ($i = 0; $i < count($forExplode); $i++):
            if (trim($forExplode[$i]) == 'acoes'):

                $styletd = 'style="text-align:center!important;"';

            else:

                $styletd = 'style="text-align:center!important;"';

            endif;

            if ($arr['campo'] == '34' and $value['id'] == 34):
                if ($i == 0):
                    $return .= '<td ' . $styletd . ' onclick="addSelect(' . $value['id'] . ');">' . $this->tabela_campos_filtro($menu_admin[0]['response'], $arr['campo'], trim($forExplode[$i]), $value[trim($forExplode[$i])], $value) . '</td>';

                else:
                    $return .= '<td ' . $styletd . '>' . $this->tabela_campos_filtro($menu_admin[0]['response'], $arr['campo'], trim($forExplode[$i]), $value[trim($forExplode[$i])], $value) . '</td>';

                endif;

            else:

                if ($i == 0):
                    $return .= '<td ' . $styletd . ' onclick="addSelect(' . $value['id'] . ');">' . $this->tabela_campos_filtro($menu_admin[0]['response'], $arr['campo'], trim($forExplode[$i]), $value[trim($forExplode[$i])], $value) . '</td>';

                else:
                    $return .= '<td ' . $styletd . '>' . $this->tabela_campos_filtro($menu_admin[0]['response'], $arr['campo'], trim($forExplode[$i]), $value[trim($forExplode[$i])], $value) . '</td>';

                endif;

            endif;

        endfor;
        $return .= '</tr>';
        return $return;
    }


    public function theadViewAdmin($arr)
    {
        $return = '';
        $this->db->select('th');
        $this->db->from('menu_admin');
        $this->db->where('status', 1);
        $this->db->where('id', $arr['campo']);
        $get = $this->db->get();
        $menu_admin = $get->result_array();
        $forExplode = explode(',', $menu_admin[0]['th']);
        $return .= '<tr>';
        for ($i = 0; $i < count($forExplode); $i++):
            $return .= '<th style="text-align: center;">' . $this->tabela_filtro(trim($forExplode[$i])) . '</th>';
        endfor;
        $return .= '</tr>';
        return $return;
    }

    //Fim Tables Admin Funções


    public function frases_motivacionais()
    {
        return 'As pessoas costumam dizer que a motivação não dura sempre. Bem, nem o efeito do banho, por isso recomenda-se diariamente.';
    }

    public function frase_do_dia()
    {
        return '"Se você não está disposto a arriscar, esteja disposto a uma vida comum" – Jim Rohn, empreendedor';
    }


    public function notificacoes()
    {

        $return = '<br><a class="media add-tooltip" style="text-align: center!important;padding: 10px;">Nenhuma Notificação a Exibir</a>';
        /*
        $return = ' <li>
                                            <a href="#" class="media add-tooltip" data-title="Used space : 95%" data-container="body" data-placement="bottom">
                                                <div class="media-left">
                                                    <i class="demo-pli-data-settings icon-2x text-main"></i>
                                                </div>
                                                <div class="media-body">
                                                    <p class="text-nowrap text-main text-semibold">HDD is full</p>
                                                    <div class="progress progress-sm mar-no">
                                                        <div style="width: 95%;" class="progress-bar progress-bar-danger">
                                                            <span class="sr-only">95% Complete</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>';
*/

        return $return;
    }


    public function usages($usage)
    {
        $return = '';

        $arr['usage'] = $usage;

        $this->load->view('painel/sys/data/usages', $arr);

        return $return;

    }


    public function cols_sm($cols, $size)
    {
        $return = '';

        $arr['coluna'] = $cols;
        $arr['size'] = $size;

        $this->load->view('painel/sys/data/charts', $arr);

        return $return;


    }


    public function charts($data, $view, $template, $arrs)
    {


        $return = '';


        $arr['template'] = $template;
        $arr['sys'] = $arrs[0];


        $this->load->view('painel/sys/data/' . $view, $arr);


        return $return;

    }


    public function countMenuDataTable($menu)
    {
        $this->db->from('menu_admin');
        $this->db->where('id', $menu);
        $this->db->where('status', 1);
        $get = $this->db->get();
        $resultmen = $get->result_array()[0];


        $this->db->from($resultmen['tabela']);
        $get = $this->db->get();
        $count = $get->num_rows();

        return $count;

    }


    public function checktable($menu)
    {


        $this->db->from('menu_admin');
        $this->db->where('id', $menu);
        $this->db->where('status', 1);
        $get = $this->db->get();
        $resultmen = $get->result_array()[0];


        return $resultmen['tabela'];

    }


    public function monitor_rodape()
    {


        return '<div class="mainnav-widget">

                        <div class="show-small">
                            <a href="#" data-toggle="menu-widget" data-target="#demo-wg-server">
                                <i class="demo-pli-monitor-2"></i>
                            </a>
                        </div>

                        <div id="demo-wg-server" class="hide-small mainnav-widget-content">
                            <ul class="list-group">
                                <li class="list-header pad-no mar-ver">Metas & Acessos</li>
                                <li class="mar-btm">
                                    <span class="label label-primary pull-right">5%</span>
                                    <p>Meta Diária</p>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar progress-bar-primary" style="width: 5%;">
                                            <span class="sr-only">5%</span>
                                        </div>
                                    </div>
                                </li>
                                <li class="mar-btm">
                                    <span class="label label-purple pull-right">120</span>
                                    <p>Acessos</p>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar progress-bar-purple" style="width: 75%;">
                                            <span class="sr-only">0</span>
                                        </div>
                                    </div>
                                </li>
                                <li class="pad-ver"><a href="#" class="btn btn-success btn-bock">Alterar Parâmetros </a></li>
                            </ul>
                        </div>
                    </div>';
    }


    public function porcentagem_compara_dias($area_de_atuacao, $tipo, $dec_primario, $dec_secundario)
    {


        $return = 0;

        if ($area_de_atuacao == 'pedidos'):


            if ($tipo == 'pedidos'):


                if ($dec_secundario > $dec_primario):

                    $return = 100;

                else:

                    $return = @(100 - intval(((($dec_primario - $dec_secundario) / $dec_primario) * 100)));
                endif;
            elseif ($tipo == 'intencoes'):

                if ($dec_secundario > $dec_primario):

                    $return = 100;

                else:

                    $return = @(100 - intval(((($dec_primario - $dec_secundario) / $dec_primario) * 100)));
                endif;
            endif;

        endif;

        return $return;

    }


    public function menu_admin($arr, $ordem)
    {

        $return = '';
        if(isset($_SESSION['ID_EMPRESA']) and !isset($_SESSION['ID_ADMIN'])):

            $this->db->from('empresas');
            $this->db->where('id', $_SESSION['ID_EMPRESA']);
        else:
            $this->db->from('administrador');
            $this->db->where('id', $_SESSION['ID_ADMIN']);
        endif;

        $get = $this->db->get();
        $administrativo = $get->result_array()[0];


        if ($arr['has_sub'] > 0):

            $this->db->from('menu_admin');
            $this->db->where('id', $arr['id']);
            if(isset($_SESSION['ID_EMPRESA'])):
                $this->db->where('empresa', 1);
            endif;
            $this->db->where('status', 1);
            $get = $this->db->get();
            $resultmen = $get->result_array();

            $this->db->from('menu_admin');
            if(isset($_SESSION['ID_EMPRESA'])):
                $this->db->where('empresa', 1);
            endif;
            $this->db->where('status_menu', 1);
            $this->db->where('status', 1);
            $this->db->where('sub_id', $arr['id']);
            if(isset($_SESSION['ID_EMPRESA']) and !isset($_SESSION['ID_ADMIN'])):
                $this->db->where('empresa', 1);

            else:

                if ($administrativo['permissoes'] <> 1):
                    $this->db->where('permissao', $administrativo['permissoes']);

                    $this->db->or_where('tipo_painel', 1);
                    $this->db->where('status_menu', 1);

                    $this->db->where('status', 1);
                    $this->db->where('sub_id', $arr['id']);
                endif;
            endif;
            $this->db->order_by('ordem', 'desc');
            $get = $this->db->get();

            $menu_subs_count = $get->num_rows();

            $menu_subs = $get->result_array();
            $menu_sub_itens = '';
            foreach ($menu_subs as $value) {
                if ($this->db->table_exists('' . $value['tabela'] . '')):
                    $menu_sub_itens .= '<li ><a href="javascript:view(1,' . $value['id'] . ',0);">' . $value['nome'] . '</a></li>';
                else:
                    $menu_sub_itens .= '<li ><a href="javascript:alerts(\'Table Não Encontrada no Banco de Dados\');">' . $value['nome'] . '</a></li>';

                endif;
            }


            if ($ordem == 0):
                $class = 'class="active-sub"';
            else:
                $class = '';
            endif;

            if ($menu_subs_count > 0):
                $arrow = '<i class="arrow"></i>';
            else:
                $arrow = '';
            endif;
            if (!empty($resultmen[0]['tipo_painel'])):

                $this->db->from('menu_admin');
                $this->db->where('status_menu', 1);
                $this->db->where('status', 1);
                $this->db->where('sub_id', $arr['id']);
                if(isset($_SESSION['ID_EMPRESA']) and !isset($_SESSION['ID_ADMIN'])):
                    $this->db->where('empresa', 1);
                else:
                    if ($administrativo['permissoes'] <> 1):
                        $this->db->where('tipo_painel>=', $administrativo['permissoes']);
                        $this->db->or_where('tipo_painel', 1);
                        $this->db->where('status_menu', 1);
                        $this->db->where('status', 1);
                        $this->db->where('sub_id', $arr['id']);
                    endif;
                endif;
                $get = $this->db->get();
                $countmtps = $get->num_rows();

                if ($countmtps > 0):

                    $return = '<li ' . $class . '>
                            <a href="javascript:void(0);">
                                <i class="demo-pli-home"></i>
                                <span class="menu-title">' . $arr['nome'] . '</span>
                                ' . $arrow . '
                            </a>

                            <ul class="collapse">
                                
                            ' . $menu_sub_itens . '

                            </ul>
                        </li>';

                endif;

            endif;
        else:

            $this->db->from('menu_admin');
            $this->db->where('id', $arr['id']);
            $this->db->where('status', 1);
            if(isset($_SESSION['ID_EMPRESA']) and !isset($_SESSION['ID_ADMIN'])):
                $this->db->where('empresa', 1);
            endif;
            $get = $this->db->get();
            $resultmen = $get->result_array();

            $this->db->from('menu_admin');
            $this->db->where('id', $arr['id']);
            $this->db->where('status', 1);
            if(isset($_SESSION['ID_EMPRESA']) and !isset($_SESSION['ID_ADMIN'])):
                $this->db->where('empresa', 1);
            else:
                if ($administrativo['permissoes'] <> 1):
                    $this->db->where('permissao', $administrativo['permissoes']);
                else:
                    $this->db->where('permissao', $administrativo['permissoes']);
                    $this->db->or_where('tipo_painel', '');
                    $this->db->where('id', $arr['id']);
                    $this->db->where('status', 1);

                endif;
            endif;
            $get = $this->db->get();
            $countgetwhere = $get->num_rows();


            if ($countgetwhere > 0 and !empty($resultmen[0]['tipo_painel'])):
                if ($this->db->table_exists('' . $arr['tabela'] . '')):
                    echo '<li ><a href="javascript:view(1,' . $arr['id'] . ',0);"> <i class="demo-pli-home"></i> ' . $arr['nome'] . '</a></li>';
                else:
                    echo '<li ><a  href="javascript:alerts(\'Table Não Encontrada no Banco de Dados\');"> <i class="demo-pli-home"></i> ' . $arr['nome'] . '</a></li>';
                endif;
            endif;
        endif;

        return $return;
    }


    public function session_admin()
    {

        if (isset($_SESSION['ID_ADMIN']) and isset($_SESSION['USER_ADMIN']) and isset($_SESSION['IP_ADMIN']) and isset($_SESSION['EMAIL_ADMIN']) and isset($_SESSION['PASS_ADMIN'])):


            try {
                $this->db->from('administrador');
                $this->db->where('id', $_SESSION['ID_ADMIN']);
                $this->db->where('user', $_SESSION['USER_ADMIN']);
                $this->db->where('email', $_SESSION['EMAIL_ADMIN']);
                $this->db->where('pass', $_SESSION['PASS_ADMIN']);
                $get = $this->db->get();
                $count = $get->num_rows();

                if ($count > 0):

                    return true;

                else:

                    unset($_SESSION['ID_ADMIN']);
                    unset($_SESSION['USER_ADMIN']);
                    unset($_SESSION['IP_ADMIN']);
                    unset($_SESSION['EMAIL_ADMIN']);
                    unset($_SESSION['PASS_ADMIN']);

                    return false;

                endif;

            } catch (Exception $e) {
                return false;
            }

        else:

            return false;

        endif;

    }


    public function session_empresa()
    {

        if (isset($_SESSION['ID_EMPRESA']) and isset($_SESSION['USER_EMPRESA']) and isset($_SESSION['IP_EMPRESA']) and isset($_SESSION['EMAIL_EMPRESA']) and isset($_SESSION['PASS_EMPRESA'])):


            try {
                $this->db->from('empresas');
                $this->db->where('id', $_SESSION['ID_EMPRESA']);
                $this->db->where('user', $_SESSION['USER_EMPRESA']);
                $this->db->where('email', $_SESSION['EMAIL_EMPRESA']);
                $this->db->where('pass', $_SESSION['PASS_EMPRESA']);
                $get = $this->db->get();
                $count = $get->num_rows();

                if ($count > 0):

                    return true;

                else:

                    unset($_SESSION['ID_EMPRESA']);
                    unset($_SESSION['USER_EMPRESA']);
                    unset($_SESSION['IP_EMPRESA']);
                    unset($_SESSION['EMAIL_EMPRESA']);
                    unset($_SESSION['PASS_EMPRESA']);

                    return false;

                endif;

            } catch (Exception $e) {
                return false;
            }

        else:

            return false;

        endif;

    }


    public function TitleSearch($field)
    {

        $varReturn = false;
        switch ($field) {
            case '|admin_credentials|':
                $varReturn = true;
                break;
            case '|PAGINA_TITLE|':
                $varReturn = true;
                break;
            case '|permissao_admin|':
                $varReturn = true;
                break;
            case '|admin_title|':
                $varReturn = true;
                break;
            case '|user_title|':
                $varReturn = true;
                break;
            case '|user_title|':
                $varReturn = true;
                break;

            case '|user_docs|':
                $varReturn = true;
                break;
            case '|user_credentials|':
                $varReturn = true;
                break;
            case '|user_address|':
                $varReturn = true;
                break;

            case '|user_anexos_docs|':
                $varReturn = true;
                break;

            case '|leilao_title|':
                $varReturn = true;
                break;

            case '|lote_title|':
                $varReturn = true;
                break;

            case '|lote_regras|':
                $varReturn = true;
                break;

            case '|lote_anexos|':
                $varReturn = true;
                break;

            case '|outros_anexos|':
                $varReturn = true;
                break;

            case '|lote_descricao|':
                $varReturn = true;
                break;
            case '|Titulo Suporte|':
                $varReturn = true;
                break;
            case '|Endereco|':
                $varReturn = true;
                break;
            case '|Acesso|':
                $varReturn = true;
                break;

        }

        return $varReturn;
    }


    public function TitleReplace($field)
    {

        $varReturn = $field;
        switch ($field) {
            case '|Acesso|':
                $varReturn = '<h4 style="float:left;width:100%;text-align: center;margin-bottom: 20px;">Dados de Acesso</h4>';
                break;

            case '|Endereco|':
                $varReturn = '<h4 style="float:left;width:100%;text-align: center;margin-bottom: 20px;">Endereço</h4>';
                break;
            case '|Titulo Suporte|':
                $varReturn = '<h4 style="float:left;width:100%;text-align: center;margin-bottom: 20px;">Informações da Empresa</h4>';
                break;

            case '|admin_title|':
                $varReturn = '<h4 style="float:left;width:100%;text-align: center;margin-bottom: 20px;">Informações do Administrador</h4>';
                break;

            case '|PAGINA_TITLE|':
                $varReturn = '<h4 style="float:left;width:100%;text-align: center;margin-bottom: 20px;">Criação & Estilo da Pagina</h4>';
                break;

            case '|permissao_admin|':
                $varReturn = '<h4 style="float:left;width:100%;text-align: center;margin-bottom: 20px;">Credenciais do Administrador</h4>';
                break;

            case '|lote_title|':
                $varReturn = '<h4 style="float:left;width:100%;text-align: center;margin-bottom: 20px;">Informações do Lote</h4>';
                break;

            case '|lote_regras|':
                $varReturn = '<h4 style="float:left;width:100%;text-align: center;margin-bottom: 20px;">Regras do Lote</h4>';
                break;

            case '|admin_credentials|':
                $varReturn = '<h4 style="float:left;width:100%;text-align: center;margin-bottom: 20px;margin-top: 20px;">Credenciais do Administrador</h4>';
                break;

            case '|user_title|':
                $varReturn = '<h4 style="float:left;width:100%;text-align: center;margin-bottom: 20px;margin-top: 20px;">Informações do Usuario</h4>';
                break;
            case '|user_address|':
                $varReturn = '<h4 style="float:left;width:100%;text-align: center;margin-bottom: 20px;">Endereço do Usuario</h4>';
                break;
            case '|user_docs|':
                $varReturn = '<h4 style="float:left;width:100%;text-align: center;margin-bottom: 20px;">Documentos do Usuario</h4>';
                break;

            case '|user_credentials|':
                if(isset($_POST['tabela'])):
                    $varReturn = '<h6 id="brnaltera"><a class="btn btn-info" href="javascript:alterar_pass();" style="margin-top: 23px;margin-left: 15px;">ALTERAR SENHA</a></h6>';
                else:
                    $varReturn = '';
                endif;
                break;
            case '|leilao_title|':
                $varReturn = '<h4 style="float:left;width:100%;text-align: center;margin-bottom: 20px;">Informações do Leilão</h4>';
                break;

            //Anexar DOCUMENTOS
            case '|user_anexos_docs|':
                $varReturn = '';
                break;

            case '|lote_anexos|':
                $varReturn = '<h4 style="float:left;width:100%;text-align: center;margin-bottom: 20px;">Arquivos para Anexar</h4>';
                break;

            case '|lote_descricao|':
                $varReturn = '<h4 style="float:left;width:100%;text-align: center;margin-bottom: 20px;">Descrição do Lote</h4>';
                break;
            case '|outros_anexos|':
                $varReturn = '';
                break;


        }

        return $varReturn;
    }


    public function tabela_filtro($field)
    {

        switch ($field) {
            case 'status':
                $field = "Status";
                break;

            case 'SMTP':
                $field = "Servidor SMTP";
                break;

            case 'SMTP_USER':
                $field = "Usuário SMTP";
                break;

            case 'SMTP_PASS':
                $field = "Senha SMTP";
                break;

            case 'id':
                $field = "Registro";
                break;


            case 'id_user':
                $field = "Cliente";
                break;

            case 'id_cliente':
                $field = "Cliente";
                break;

            case 'oq_inclui':
                $field = "Incluso";
                break;
            case 'obs':
                $field = "Observação";
                break;

            case 'valor_custo_adulto':
                $field = "Custo Para Adulto";
                break;

            case 'valor_venda_adulto':
                $field = "Venda Para Adulto";
                break;


            case 'valor_custo_crianca':
                $field = "Custo Para Criança";
                break;

            case 'valor_venda_crianca':
                $field = "Venda Para Criança";
                break;

            case 'desconto_adulto':
                $field = "Desconto para Adultos";
                break;


            case 'desconto_crianca':
                $field = "Desconto para Crianças";
                break;


            case 'oq_n_inclui':
                $field = "Não Incluso";
                break;
            case 'valor_total':
                $field = "Valor do Pedido";
                break;
            case 'dia_ida':
                $field = "Data do Tour";
            case 'xml_url':
                $field = "Link do XML";
                break;
            case 'dia_volta':
                $field = "Data da Volta";
                break;

            case 'data_pedido':
                $field = "Data do Pedido";
                break;

            case 'data_passeio':
                $field = "Data do Passeio / Marcada";
                break;

            case 'id_passeio':
                $field = "Passeio";
                break;


            case 'image':
                $field = "Foto";
                break;


            case 'image1':
                $field = "Foto 1";
                break;


            case 'image2':
                $field = "Foto 2";
                break;


            case 'image3':
                $field = "Foto 3";
                break;


            case 'image4':
                $field = "Foto 4";
                break;


            case 'image5':
                $field = "Foto 5";
                break;


            case 'disponibilidade':
                $field = "Pacote Disponível ou Agêndamento";
                break;

            case 'dias':
                $field = "Dias Escolhidos - Passeio";
                break;

            case 'custos_extras':
                $field = "Custos / Despesas Extras";
                break;

            case 'valor':
                $field = "Custos Total";
                break;

            case 'valor_desconto':
                $field = "Custos Total do Lance";
                break;

            case 'nome':
                $field = "Nome";
                break;
            case 'email':
                $field = "E-mail";
                break;
            case 'user':
                $field = "Usuario";
                break;
            case 'cpf_passaporte':
                $field = "CPF ou Passaporte";
                break;


            case 'rua':
                $field = "Logradouro";
                break;

            case 'rg':
                $field = "Numero da Identidade";
                break;

            case 'rg_frente':
                $field = "Foto Documento Frente";
                break;
            case 'rg_tras':
                $field = "Foto Documento Verso";
                break;

            case 'pass':
                $field = "Senha";
                break;

            case 'meta_title':
                $field = "Titulo (META DESCRIÇÃO)";
                break;

            case 'observacao':
                $field = "Observação";
                break;

            case 'system_id':
                $field = "Sistema";
                break;

            case 'data_inicio':
                $field = "Data Inicial";
                break;

            case 'data_fim':
                $field = "Data Final";
                break;

            case 'lance_inicial':
                $field = "Valor Inicial";
                break;

            case 'nlote':
                $field = "Numero do Lote";
                break;

            case 'data_ini':
                $field = "Data Inicial";
                break;

            case 'data_fim':
                $field = "Data Final";
                break;

            case 'lance_ini':
                $field = "Lance Inicial";
                break;

            case 'lance_min':
                $field = "Lance Minimo";
                break;

            case 'lance_minimo':
                $field = "Valor Minimo para Finalizar";
                break;

            case 'comissao_leiloeiro':
                $field = "Comissão do Leiloeiro";
                break;


            case 'descricao_completa':
                $field = "Descrição do Lote";
                break;

            case 'titulo_extra1':
                $field = "Titulo 1";
                break;

            case 'titulo_extra2':
                $field = "Titulo 2";
                break;

            case 'titulo_extra3':
                $field = "Titulo 3";
                break;

            case 'data_nasc':
                $field = "Data de Nascimento";
                break;

            case 'descricao_extra1':
                $field = "Descrição 1";
                break;

            case 'descricao_extra2':
                $field = "Descrição 2";
                break;

            case 'descricao_extra3':
                $field = "Descrição 3";
                break;

            case 'url':
                $field = "URL";
                break;

            case 'conteudo':
                $field = "Conteúdo";
                break;

            case 'cpf':
                $field = "CPF";
                break;

            case 'ultimo_acesso':
                $field = "Último Acesso";
                break;


            case 'lance_atual':
                $field = "Lance Atual";
                break;

            case 'infos':
                $field = "Informações";
                break;

            case 'stats':
                $field = "Situação";
                break;



        }

        return ucwords($field);
    }


    public function tabela_campos_filtro($response, $tabela, $campo, $valor, $outros_values)
    {

        $this->db->from('menu_admin');
        $this->db->where('id', $tabela);
        if(isset($_SESSION['ID_EMPRESA'])):
            $this->db->where('empresa', 1);
        endif;
        $get = $this->db->get();
        $menu_admin = $get->result_array()[0];

        if ($response > 0):
            $this->db->from('' . $menu_admin['tabela'] . '');
            $this->db->where('id', $outros_values['id']);
            $get = $this->db->get();
            $response = $get->result_array();
        endif;
        if ($campo == 'acoes'):
            $valor = '';
            if($menu_admin['tabela'] == 'leiloes'):
                if($outros_values['finalizado'] == 1):
                    $valor .= '<a href="'.base_url('painel/relatorio/?id='.$outros_values['id']).'" target="_blank" class="btn btn-info"><i class="fa fa-bars"></i> RELATORIOS</a><div class="clearfix"></div><br>';
                endif;
                $valor .= '<a href="javascript:enviartermos('.$outros_values['id'].',\'\');" class="btn btn-info"><i class="fa fa-bars"></i> ENVIAR EMAILS DE ARREMATE</a><div class="clearfix"></div><br>';

                $this->db->select('id');
                $this->db->from('lotes');
                $this->db->where('leiloes',$outros_values['id']);
                $get = $this->db->get();
                $count = $get->num_rows();



                $valor .= '<a href="javascript:$(\'#modalimporta'.$outros_values['id'].'\').modal(\'show\');" class="btn btn-primarysim "><i class="fa fa-bars"></i> IMPORTAR LOTES</a><div class="clearfix"></div><br>';



                $valor .= '<div class="modal fade" id="modalimporta'.$outros_values['id'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">IMPORTAR '.$outros_values['nome'].'</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
      <form method="post" action="'.base_url('importar.php').'" enctype="multipart/form-data">
      
      <input type="hidden" name="leilao" value="'.$outros_values['id'].'">      
      <label>Data Inicial: <input type="datetime-local" name="data_ini" class="form-control"></label>
      <label>Data Final: <input type="datetime-local" name="data_fim" class="form-control"></label>
      <div class="clearfix"></div><br>
      <label>Arquivo de Importação: <input type="file" name="EnviarArquivo" class="form-control"></label>
            <div class="clearfix"></div><br>

              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>

        <button type="submit" class="btn btn-primary">Enviar Arquivo</button>

      </form>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>';




                $valor .= '<a href="javascript:$(\'#modalimportadesc'.$outros_values['id'].'\').modal(\'show\');" class="btn btn-primarysim "><i class="fa fa-bars"></i> IMPORTAR LOTES DESCRIÇÃO</a><div class="clearfix"></div><br>';



                $valor .= '<div class="modal fade" id="modalimportadesc'.$outros_values['id'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">IMPORTAR DESCRIÇÃO '.$outros_values['nome'].'</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
      <form method="post" action="'.base_url('importarDescricao.php').'" enctype="multipart/form-data">
      
      <input type="hidden" name="leilao" value="'.$outros_values['id'].'">      
    
      <div class="clearfix"></div><br>
      <label>Arquivo de Importação: <input type="file" name="EnviarArquivo" class="form-control"></label>
            <div class="clearfix"></div><br>

              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>

        <button type="submit" class="btn btn-primary">Enviar Arquivo</button>

      </form>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>';



            endif;
            if ($response > 0):


                $valor .= '<div style="float: left;width: 100%;margin-bottom: 8px!important;">';
                $valor .= '<label>Situação: </label>&nbsp;&nbsp;&nbsp;';
                $valor .= '<select class="form-control" onchange="chagestatus(this,' . $outros_values['id'] . ',\'' . $menu_admin['tabela'] . '\');">';

                if ($response[0]['status'] == 1):
                    $valor .= '<option value="1">Ativado</option>';
                    $valor .= '<option value="0">Desativado</option>';
                else:

                    $valor .= '<option value="0">Desativado</option>';
                    $valor .= '<option value="1">Ativado</option>';
                endif;


                $valor .= '</select>';
                $valor .= '</div>';
                $valor .= '<div class="clearfix"></div>';
                $valor .= '';

            endif;


            if($menu_admin['tabela'] == 'documentos'):
                $valor .= '<a href="javascript:editar_item(\'modal\',\'' . $tabela . '\',' . $outros_values['id'] . ');" class="btn btn-primary" style="margin-bottom: 10px;"><i class="fas fa-eye"></i> Visualizar Documentos</a> &nbsp;&nbsp;&nbsp;';

            else:
                if($menu_admin['tabela'] == 'usuarios'):


                    $valor .= '<div style="float: left;width: 100%;margin-bottom: 8px!important;">';
                    $valor .= '<label>Situação: </label>&nbsp;&nbsp;&nbsp;';
                    $valor .= '<select class="form-control" onchange="chagevalidado(this,' . $outros_values['id'] . ',\'' . $menu_admin['tabela'] . '\');">';

                    if ($outros_values['validado'] == 1):
                        $valor .= '<option value="1">Habilitado</option>';
                        $valor .= '<option value="0">Desabilitado</option>';
                    else:

                        $valor .= '<option value="0">Desabilitado</option>';
                        $valor .= '<option value="1">Habilitado</option>';

                    endif;


                    $valor .= '</select>';
                    $valor .= '</div>';
                    $valor .= '<div class="clearfix"></div>';
                    $valor .= '';

                endif;
                if($menu_admin['tabela'] <> 'cotacoes'):
                    $valor .= '<a href="javascript:editar_item(\'modal\',\'' . $tabela . '\',' . $outros_values['id'] . ');" class="btn btn-primary" style="margin-bottom: 10px;"><i class="fas fa-edit"></i> Editar</a> &nbsp;&nbsp;&nbsp;';
                endif;
                if($menu_admin['tabela'] <> 'config'):

                    $valor .= '<a href="javascript:delecsts(\'' . $tabela . '\',' . $outros_values['id'] . ',0);" class="btn btn-danger" style="margin-bottom: 10px;"><i class="fas fa-trash"></i> Excluir</a>';
                endif;
                if($menu_admin['tabela'] == 'lotes'):


                    if($outros_values['star'] == 0):

                        $valor .= '<br><span id="star'.$outros_values['id'].'"><a href="javascript:starlote(\''.$outros_values['id'].'\',\'1\');" class="btn btn-default" style="margin-top: 8px;"><i class="far fa-star"></i>Destaque</a></span>';

                    else:

                        $valor .= '<br><span id="star'.$outros_values['id'].'"><a href="javascript:starlote(\''.$outros_values['id'].'\',\'0\');" class="btn btn-default btn-warning" style="margin-top: 8px;"><i class="fas fa-star text-warning"></i> Remover Destaque</a></span>';

                    endif;


                    if($outros_values['stats'] == 4 or $outros_values['stats'] == 3):

                        $valor .= '<br><br><a href="javascript:enviartermos('.$outros_values['leiloes'].','.$outros_values['id'].');" class="btn" style="border-color: #d3d3d3;margin-bottom: 10px;">Enviar Termo de Arrematação</a> &nbsp;&nbsp;&nbsp; <a href="'.base_url('termo/'.$outros_values['id']).'" target="_blank" class="btn" style="border-color: #d3d3d3;margin-bottom: 10px;">Visualizar Termo de Arrematação</a>';

                    endif;
                endif;
            endif;

            if($menu_admin['tabela'] == 'usuarios'):
                $this->db->from('documentos');
                $this->db->where('cadastro', $outros_values['id']);
                $get = $this->db->get();
                $count = $get->num_rows();

                if($count > 0):
                    $documentos = @$get->result_array()[0];

                    $valor .= '<br>';



                    if(!empty($documentos['CPF'])):
                        $valor .= '<a href="'.base_url('web/imagens/').@$documentos['CPF'].'" target="_blank" class="btn btn-info">VISUALIZAR CPF</a>&nbsp;';
                    endif;

                    if(!empty($documentos['RG'])):
                        $valor .= '<a href="'.base_url('web/imagens/').@$documentos['RG'].'" target="_blank" class="btn btn-info">VISUALIZAR RG</a>&nbsp;';
                    endif;

                    if(!empty($documentos['COMPROVANTE_ENDERECO'])):
                        $valor .= '<a href="'.base_url('web/imagens/').@$documentos['COMPROVANTE_ENDERECO'].'" target="_blank" class="btn btn-info">VISUALIZAR CR</a>';
                    endif;

                endif;
            endif;

        endif;

        if ($campo == 'posicao'):

            $valor = ($valor == 0) ? 'Lateral' : 'Topo';

        endif;
        if ($campo == 'LOGOMARCA' or $campo == 'FAVICON'):
            $valor = '<img src="' . base_url('web/imagens/' . $valor) . '" onerror="this.src=\''.base_url('web/default.jpg').'\';" style="width:100px;">';
        endif;

        if ($campo == 'lotes'):
            $this->db->from('lotes');
            $this->db->where('leiloes', $outros_values['id']);
            $get = $this->db->get();
            $count = $get->num_rows();
            $valor = '<a href="javascript:view(1,49,'.$outros_values['id'].');"> <b>'.$count.'</b> <i class="fa fa-bars"></i></a>';
        endif;

        if ($campo == 'empresa'):

            $this->db->from('empresas');
            $this->db->where('id', $valor);
            $get = $this->db->get();
            $response = $get->result_array()[0];
            $valor = '<img src="' . base_url('web/imagens/' . $response['image']) . '" onerror="this.src=\''.base_url('web/default.jpg').'\';" style="width:100px;">';
        endif;

        if ($campo == 'lance_atual'):
            if($valor == 0 or empty($valor)):
                $valor = 'Sem Lance';
            else:
                $valor = 'R$ '.number_format($valor,2,'.',',');
            endif;
        endif;

        if ($campo == 'arrematante'):
            if($valor == 0 or empty($valor)):
                $valor = 'Sem Arrematante';
            else:
                $this->db->from('usuarios');
                $this->db->where('id', $valor);
                $get = $this->db->get();
                $response = $get->result_array()[0];
                $valor = $response['user'];
            endif;
        endif;


        if ($campo == 'infos'):

            $valor = '<b>Inicio:</b> '.date('d/m/Y H:i',strtotime($outros_values['data_ini'])).'<br>';
            $valor .= '<b>Fim:</b> '.date('d/m/Y H:i',strtotime($outros_values['data_fim'])).'<br>';
            $valor .= '<b>Lance Minimo:</b> R$ '.$outros_values['lance_min'].'<br>';

        endif;
        if ($campo == 'stats'):


            if($valor == 0):
                $valor = '<span class="btn btn-success">Aberto</span>';
            elseif($valor == 1):
                $valor = '<span class="btn btn-warning">Em Loteamento</span>';
            elseif($valor == 2):
                $valor = '<span class="btn btn-default">Aguardando para Abrir</span>';
            elseif($valor == 3):
                $valor = '<span class="btn btn-danger">Arrematado</span>';
            elseif($valor == 4):
                $valor = '<span class="btn btn-warning">Em Condicional</span>';
            elseif($valor == 5):
                $valor = '<span class="btn btn-danger" style="background: #4b0010;">Finalizado</span>';
            elseif($valor == 5):
                $valor = '<span class="btn btn-primary">Venda Direta</span>';
            else:
                $valor = '<span class="btn btn-danger">Indefinido</span>';
            endif;
        endif;

        if ($campo == 'leiloes'):

            $this->db->from('leiloes');
            $this->db->where('id', $valor);
            $get = $this->db->get();
            $response = @$get->result_array()[0];
            $valor = @$response['nome'];
        endif;

        if ($campo == 'visualizado'):
            $valor = ($valor == 0)? 'Não' : 'Sim';
            $arpns['visualizado'] = 1;
            $this->db->where('id',$outros_values['id']);
            $this->db->update('documentos',$arpns);

        endif;

        if ($campo == 'respondido'):
            $valor = ($valor == 0)? 'Não' : 'Sim';
        endif;
        if ($campo == 'cadastro'):

            $this->db->from('usuarios');
            $this->db->where('id', $valor);
            $get = $this->db->get();
            $response = @$get->result_array()[0];
            $valor = $response['email'];
        endif;
        if ($campo == 'image'):

            if (isset($outros_values['image_externa']) and !empty($outros_values['image_externa'])):
                $valor = '<img src="' . $outros_values['image_externa'] . '" onerror="this.src=\''.base_url('web/default.jpg').'\';" style="width:100px;">';

            else:

                $valor = '<img src="' . base_url('web/imagens/' . $valor) . '" onerror="this.src=\''.base_url('web/default.jpg').'\';" style="width:100px;">';

            endif;

        endif;

        if ($campo == 'cadastro'):

            if ($tabela == '44'):

                if (empty($valor) or $valor == 0):

                    if (!empty($outros_values['cliente']) and $outros_values['cliente'] <> 0):
                        $this->db->from('cotacoes_usuarios');
                        $this->db->where('id', $outros_values['cliente']);
                        $get = $this->db->get();
                        $count = $get->num_rows();

                        if ($count > 0):

                            $cliente = $get->result_array()[0];
                            $valor = '<b class="text-primary" onclick="$(\'#modalplus' . $cliente['id'] . '\').modal(\'show\');">' . $cliente['nome'] . '</b>';
                            $valor .= '<div class="modal fade" id="modalplus' . $cliente['id'] . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Dados do Cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       ';


                            $valor .= '<b>Nome Completo:</b> <span>'.$cliente['nome'].'</span><br>';
                            $valor .= '<b>Email:</b> <span>'.$cliente['email'].'</span><br>';
                            $valor .= '<b>Telefone:</b> <span>'.$cliente['telefone'].'</span><br>';
                            $valor .= '<b>Endereço:</b> <span> '.$cliente['cidade'].' - '.$cliente['estado'].' - '.$cliente['cep'].'</span><br>';

                            $this->db->from('cotacoes');
                            $this->db->where('cliente',$valor);
                            $this->db->order_by('data','desc');
                            $this->db->limit(25,0);
                            $get = $this->db->get();
                            $cotacoes = $get->result_array();


                            $this->db->from('cotacoes_itens');
                            $this->db->where('lista_cotacao',$outros_values['id']);
                            $this->db->join('produtos','cotacoes_itens.produto_id=produtos.id','inner');
                            $this->db->order_by('produtos.nome','asc');
                            $get = $this->db->get();
                            $count = $get->num_rows();
                            if($count > 0):

                                $result = $get->result_array();
                                $valornormal = 0;
                                $valordesconto = 0;
                                foreach ($result as $value1) {

                                    $valor .= '<p style="float: left;width: 100%;margin-top: 10px;padding-top: 20px;">';
                                    $valor .= '<span style="float: left;width: 30%;"> <b>Produto: </b><span>'.$value1['nome'].'</span></span>';
                                    $valor .= '<span style="float: left;width: 20%;"><b>Original: </b><span>R$ '.@number_format($value1['valor'],2,',','.').'</span></span>';
                                    $valor .= '<span style="float: left;width: 20%;"><b>Ofertado: </b><span>R$ '.@number_format($value1['valor_desconto'],2,',','.').'</span></span>';
                                    $valor .= '<span style="float: left;width: 20%;"><b>Quantidade: </b><span>'.@number_format($value1['quantidade']).'</span></span>';
                                    $valor .= '</p>';

                                    $valornormal = @($value1['valor'] * $value1['quantidade']) + $valornormal;
                                    $valordesconto = @($value1['valor_desconto'] * $value1['quantidade']) + $valordesconto;
                                }


                                $valor .= '<p style="float: left;width: 100%;margin-top: 20px">';
                                $valor .= '<span style="float: left;width: 30%;"> <b>Valor Total </b></span>';
                                $valor .= '<span style="float: left;width: 20%;"><b>Original: </b><span>R$ '.number_format($valornormal,2,',','.').'</span></span>';
                                $valor .= '<span style="float: left;width: 20%;"><b>Ofertado: </b><span>R$ '.number_format($valordesconto,2,',','.').'</span></span>';
                                $valor .= '<span style="float: left;width: 20%;"><b>-------</span></span>';
                                $valor .= '</p>';
                            endif;

                            $valor .= '</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>';

                        else:
                            $valor = '<b class="text-danger">Usuario não existente ou excluido</b>';

                        endif;

                    else:
                        $valor = '<b class="text-danger" style="text-align: center;">Usuario não existente<br> ou excluido</br>';
                    endif;
                else:
                    $this->db->from('usuarios');
                    $this->db->where('id', $valor);
                    $get = $this->db->get();
                    $count = $get->num_rows();

                    if ($count > 0):

                        $cliente = $get->result_array()[0];
                        $valor = '<b class="text-success" onclick="$(\'#modalpluscad' . $cliente['id'] . '\').modal(\'show\');">' . $cliente['nome'] . '</b>';
                        $valor .= '<div class="modal fade" id="modalpluscad' . $cliente['id'] . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Dados do Cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       ';

                        $valor .= '<b>Nome Completo:</b> <span>'.$cliente['nome'].'</span><br>';
                        $valor .= '<b>Email:</b> <span>'.$cliente['email'].'</span><br>';
                        $valor .= '<b>Telefone:</b> <span>'.$cliente['telefone'].'</span><br>';
                        $valor .= '<b>Endereço:</b> <span>'.$cliente['endereco'].', '.$cliente['cidade'].' - '.$cliente['estado'].' - '.$cliente['cep'].'</span><br>';

                        $this->db->from('cotacoes');
                        $this->db->where('cadastro',$valor);
                        $this->db->order_by('data','desc');
                        $this->db->limit(25,0);
                        $get = $this->db->get();
                        $cotacoes = $get->result_array();


                        $this->db->from('cotacoes_itens');
                        $this->db->where('lista_cotacao',$outros_values['id']);
                        $this->db->join('produtos','cotacoes_itens.produto_id=produtos.id','inner');
                        $this->db->order_by('produtos.nome','asc');
                        $get = $this->db->get();
                        $count = $get->num_rows();
                        if($count > 0):

                            $result = $get->result_array();
                            $valornormal = 0;
                            $valordesconto = 0;
                            foreach ($result as $value1) {

                                $valor .= '<p style="float: left;width: 100%;margin-top: 10px;padding-top: 20px;">';
                                $valor .= '<span style="float: left;width: 30%;"> <b>Produto: </b><span>'.$value1['nome'].'</span></span>';
                                $valor .= '<span style="float: left;width: 20%;"><b>Original: </b><span>R$ '.number_format($value1['valor'],2,',','.').'</span></span>';
                                $valor .= '<span style="float: left;width: 20%;"><b>Ofertado: </b><span>R$ '.number_format($value1['valor_desconto'],2,',','.').'</span></span>';
                                $valor .= '<span style="float: left;width: 20%;"><b>Quantidade: </b><span>'.number_format($value1['quantidade']).'</span></span>';
                                $valor .= '</p>';

                                $valornormal = ($value1['valor'] * $value1['quantidade']) + $valornormal;
                                $valordesconto = ($value1['valor_desconto'] * $value1['quantidade']) + $valordesconto;
                            }


                            $valor .= '<p style="float: left;width: 100%;margin-top: 20px">';
                            $valor .= '<span style="float: left;width: 30%;"> <b>Valor Total </b></span>';
                            $valor .= '<span style="float: left;width: 20%;"><b>Original: </b><span>R$ '.number_format($valornormal,2,',','.').'</span></span>';
                            $valor .= '<span style="float: left;width: 20%;"><b>Ofertado: </b><span>R$ '.number_format($valordesconto,2,',','.').'</span></span>';
                            $valor .= '<span style="float: left;width: 20%;"><b>-------</span></span>';
                            $valor .= '</p>';
                        endif;
                        $valor .= '</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>';

                    else:
                        $valor = '<b class="text-danger">Usuario não existente ou excluido</b>';

                    endif;

                endif;


            endif;


        endif;
        if ($campo == 'SMTP_PASS'):

            $valor = '*******';

        endif;
        if ($campo == 'system_id'):
            $this->db->from('permissoes');
            $this->db->where('id', $outros_values['system_id']);
            $get = $this->db->get();
            $result = $get->result_array()[0];
            $valor = $result['nome'];


        endif;
        if ($campo == 'data_pedido' or $campo == 'dia_ida'):
            $date = new DateTime('' . $valor . '');
            $valor = $date->format('d/m/Y');

        endif;
        if ($campo == 'id_user'):
            $this->db->from('clientes');
            $this->db->where('id', $valor);
            $get = $this->db->get();
            $result = $get->result_array()[0];
            $valor = $result['nome'];

        endif;
        if ($campo == 'id_passeio'):
            $this->db->from('passeios');
            $this->db->where('id', $valor);
            $get = $this->db->get();

            $count = $get->num_rows();
            if ($count > 0):
                $result = $get->result_array()[0];
                $valor = $result['nome'];
            else:
                $valor = '<b>Não Encontrado</b>';
            endif;

        endif;


        return $valor;
    }


    public function tabela_valor_filtro($fieldname, $fields)
    {

        if ($fieldname == 'status'):

            $fields = ($fields == 0) ? '<a class="btn"><i class="mdi mdi-check-circle"></i> Ativar</a>' : '<a class="btn"><i class="mdi mdi-close-box"></i> Desativar</a>';

        endif;

        return $fields;
    }


    public function campos_filtro($id, $fields, $tabela, $wid)
    {

        if ($id > 0):


            $this->db->from('menu_admin');
            $this->db->where('id', $tabela);
            $get = $this->db->get();
            $menu_adm = $get->result_array()[0];


            $this->db->from($menu_adm['tabela']);
            $this->db->where('id', $id);
            $get = $this->db->get();
            $result = $get->result_array()[0];
            $value = 'value="' . $result['' . $fields . ''] . '"';
            $valuetxt = $result['' . $fields . ''];

        else:

            $value = '';
            $valuetxt = '';
        endif;


        if ($fields == 'pass'):
            $value = '';
            $valuetxt = '';
        endif;

        $tfields = '<div class="form-group" style="float: left;width: ' . $wid . ';margin-left: 20px">
                        <label for="recipient-name" class="control-label">' . $this->tabela_filtro(trim($fields)) . ':</label>
                        <input type="text" class="form-control ' . $fields . '" name="' . $fields . '" id="' . $fields . '" ' . $value . '>
                    </div>';

        if ($fields == 'sexo'):

            $tfields = '<div class="form-group" style="float: left;width: ' . $wid . ';margin-left: 20px">
                        <label for="recipient-name" class="control-label">' . $this->tabela_filtro(trim($fields)) . ':</label>
                        <input type="text" class="form-control ' . $fields . '" name="' . $fields . '" id="' . $fields . '" ' . $value . '>
                    </div>
                    <div id="passAlterarsss"></div>
                    ';
        endif;

        if ($fields == 'pass'):
            $tfields = '<div class="form-group" style="float: left;width: ' . $wid . ';margin-left: 20px">
                        <label for="recipient-name" class="control-label">' . $this->tabela_filtro(trim($fields)) . ':</label>
                        <input type="password" autocomplete="off" class="form-control ' . $fields . '" name="' . $fields . '" id="' . $fields . '" ' . $value . ' >
                    </div>';
        endif;

        if ($fields == 'dias' or $fields == 'nlote' or $fields == 'acrescimo'):
            $tfields = '<div class="form-group" style="float: left;width: ' . $wid . ';margin-left: 20px">
                        <label for="recipient-name" class="control-label">' . $this->tabela_filtro(trim($fields)) . ':</label>
                        <input type="number" class="form-control ' . $fields . '" name="' . $fields . '" id="' . $fields . '" ' . $value . '>
                    </div>';
        endif;

        if ($fields == 'dia_ida' or $fields == 'dia_volta' or $fields == 'data_pedido'):
            $tfields = '<div class="form-group" style="float: left;width: ' . $wid . ';margin-left: 20px">
                        <label for="recipient-name" class="control-label">' . $this->tabela_filtro(trim($fields)) . ':</label>
                        <input type="date" class="form-control ' . $fields . '" name="' . $fields . '" id="' . $fields . '" ' . $value . '>
                    </div>';
        endif;
        if ($fields == 'data_ini' or $fields == 'data_fim'):
            $tfields = '<div class="form-group" style="float: left;width: ' . $wid . ';margin-left: 20px">
                        <label for="recipient-name" class="control-label">' . $this->tabela_filtro(trim($fields)) . ':</label>
                        <input type="datetime-local" class="form-control ' . $fields . '" name="' . $fields . '" id="' . $fields . '" ' . $value . '>
                    </div>';
        endif;

        if ($fields == 'LOGOMARCA' or $fields == 'FAVICON' or $fields == 'edital' or $fields == 'CPF' or $fields == 'COMPROVANTE_ENDERECO' or $fields == 'RG' or $fields == 'image' or $fields == 'image1' or $fields == 'image2' or $fields == 'image3' or $fields == 'image4' or $fields == 'image5'):



            if(!empty($valuetxt)){
                $tfields = '<div class="form-group" style="float: left;width: ' . $wid . ';margin-left: 20px">
                        <label for="recipient-name" class="control-label">' . $this->tabela_filtro(trim($fields)) . ':</label>
                        <input type="file" onchange="enviarimage(\''.$fields.'\');" class="form-control ' . $fields . '" name="' . $fields . '" id="' . $fields . '" >
                        
                                <div class=\'preview\'> </div>
                   ';
                $tfields .= '<a class="btn btn-primary" href="'.base_url('web/imagens/'.$valuetxt).'" target="_blank" style="width: 45%;margin-right: 5px;margin-top: 2px;">VISUALIZAR</a> <a class="btn btn-danger" href="javascript:remover_imagem('.$id.',\''.$menu_adm['tabela'].'\',\''.$fields.'\');"  style="width: 45%;margin-top: 2px;">Remover</a> </div>';
            }else{
                $tfields = '<div class="form-group" style="float: left;width: ' . $wid . ';margin-left: 20px">
                        <label for="recipient-name" class="control-label">' . $this->tabela_filtro(trim($fields)) . ':</label>
                        <input type="file" onchange="enviarimage(\''.$fields.'\');" class="form-control ' . $fields . '" name="' . $fields . '" id="' . $fields . '" >
                        
                                <div class=\'preview\'> </div>
                    </div>';
            }


        endif;
        if ($fields == 'conteudo' or $fields == 'descricao' or $fields == 'EMAIL_CONFIRMAR_EMAIL' or $fields == 'EMAIL_CADASTRO' or $fields == 'EMAIL_PEDIDO_EFETUADO'):

            $tfields = '<div class="form-group" style="float: left;width: ' . $wid . ';padding: 0 20px 0 20px;height: 200px!important;">
                        <label for="recipient-name" class="control-label">' . $this->tabela_filtro(trim($fields)) . ':</label>
                        <textarea name="' . $fields . '" style="float:left;width:100%;height:250px;padding:20px;" id="froala-editor"> ' . $valuetxt . '</textarea>
                    </div>';

        endif;

        if ($fields == 'codigo_fonte' or $fields == 'codigo_fonte2'):

            $tfields = '<div class="form-group" style="float: left;width: ' . $wid . ';padding: 0 20px 0 20px;">
                        <label for="recipient-name" class="control-label">' . $this->tabela_filtro(trim($fields)) . ':</label>
                        <textarea name="' . $fields . '" style="float:left;width:100%;height:250px;padding:20px;"> ' . $valuetxt . '</textarea>
                    </div>';

        endif;

        if ($fields == 'email'):

            $tfields = '<div class="form-group" style="float: left;width: ' . $wid . ';margin-left: 20px">
                        <label for="recipient-name" class="control-label">' . $this->tabela_filtro(trim($fields)) . ':</label>
                        <input type="email" class="form-control" name="' . $fields . '" id="' . $fields . '" ' . $value . '>
                    </div>';

        endif;


        if ($fields == 'posicao'):



            $this->db->from('banner');
            $this->db->where('posicao',0);
            $get = $this->db->get();
            $countlateral = $get->num_rows();

            $this->db->from('banner');
            $this->db->where('posicao',1);
            $get = $this->db->get();
            $counttopo = $get->num_rows();



            $this->db->from('banner');
            $this->db->where('posicao',1);
            $this->db->where('posicao',0);
            $get = $this->db->get();
            $countall = $get->num_rows();




            if($id > 0):

                $tfields =  '<input type="hidden"  name="' . $fields . '" id="' . $fields . '" ' . $value . '>';



            else:

                $options = '';

                if ($id > 0):
                    if ($result[$fields] == 1):

                        $options .= '<option value="1">Topo</option>';

                        if($countlateral == 0):
                            $options .= '<option value="0">Lateral</option>';
                        endif;
                    else:
                        $options .= '<option value="1">Topo</option>';

                        if($countlateral == 0):
                            $options .= '<option value="0" selected>Lateral</option>';
                        endif;
                    endif;

                else:

                    $options .= '<option value="1">Topo</option>';

                    if($countlateral == 0):
                        $options .= '<option value="0">Lateral</option>';
                    endif;
                endif;

                $tfields = '<div class="form-group" style="float: left;width: ' . $wid . ';margin-left: 20px">
                        <label for="recipient-name" class="control-label">' . $this->tabela_filtro(trim($fields)) . ':</label>
                  
                  <select class="form-control" name="' . $fields . '" id="' . $fields . '">
                  ' . $options . '
                  </select>
                  
                  
                    </div>';

            endif;
        endif;

        if ($fields == 'finalizado'):

            if ($id > 0):
                if ($result[$fields] == 1):

                    $options = '<option value="1" selected>Sim</option>';
                    $options .= '<option value="0">Não</option>';
                else:
                    $options = '<option value="1">Sim</option>';
                    $options .= '<option value="0" selected>Não</option>';

                endif;

            else:

                $options = '<option value="1">Sim</option>';
                $options .= '<option value="0" selected>Não</option>';
            endif;

            $tfields = '<div class="form-group" style="float: left;width: ' . $wid . ';margin-left: 20px">
                        <label for="recipient-name" class="control-label">' . $this->tabela_filtro(trim($fields)) . ':</label>
                  
                  <select class="form-control" name="' . $fields . '" id="' . $fields . '">
                  ' . $options . '
                  </select>
                  
                  
                    </div>';


        endif;
        if ($fields == 'inadimplente'):

            if ($id > 0):
                if ($result[$fields] == 1):

                    $options = '<option value="1" selected>Sim</option>';
                    $options .= '<option value="0">Não</option>';
                else:
                    $options = '<option value="1">Sim</option>';
                    $options .= '<option value="0" selected>Não</option>';

                endif;

            else:

                $options = '<option value="1">Sim</option>';
                $options .= '<option value="0" selected>Não</option>';
            endif;

            $tfields = '<div class="form-group" style="float: left;width: ' . $wid . ';margin-left: 20px">
                        <label for="recipient-name" class="control-label">' . $this->tabela_filtro(trim($fields)) . ':</label>
                  
                  <select class="form-control" name="' . $fields . '" id="' . $fields . '">
                  ' . $options . '
                  </select>
                  
                  
                    </div>';


        endif;

        if ($fields == 'status'):

            if ($id > 0):
                if ($result[$fields] == 1):

                    $options = '<option value="1" selected>Ativo</option>';
                    $options .= '<option>Desativado</option>';
                else:
                    $options = '<option value="1">Ativo</option>';
                    $options .= '<option selected>Desativado</option>';

                endif;

            else:

                $options = '<option value="1" selected>Ativo</option>';
                $options .= '<option>Desativado</option>';
            endif;

            $tfields = '<div class="form-group" style="float: left;width: ' . $wid . ';margin-left: 20px">
                        <label for="recipient-name" class="control-label">' . $this->tabela_filtro(trim($fields)) . ':</label>
                  
                  <select class="form-control" name="' . $fields . '" id="' . $fields . '">
                  ' . $options . '
                  </select>
                  
                  
                    </div>';


        endif;

        if ($fields == 'stats'):

            if ($id > 0):
                if ($result[$fields] == 1):

                    $options = '<option value="0" selected>Aberto</option>';
                    $options .= '<option value="3">Arrematado</option>';
                    $options .= '<option value="5">Finalizado</option>';
                    $options .= '<option value="4">Em Condicional</option>';
                elseif($result[$fields] == 3):
                    $options = '<option value="0">Aberto</option>';
                    $options .= '<option value="3" selected>Arrematado</option>';
                    $options .= '<option value="5">Finalizado</option>';
                    $options .= '<option value="4">Em Condicional</option>';
                elseif($result[$fields] == 5):
                    $options = '<option value="0">Aberto</option>';
                    $options .= '<option value="3">Arrematado</option>';
                    $options .= '<option value="5" selected>Finalizado</option>';
                    $options .= '<option value="4">Em Condicional</option>';
                elseif($result[$fields] == 4):
                    $options = '<option value="0">Aberto</option>';
                    $options .= '<option value="3">Arrematado</option>';
                    $options .= '<option value="5">Finalizado</option>';
                    $options .= '<option value="4" selected>Em Condicional</option>';
                else:
                    $options = '<option value="0" selected>Aberto</option>';
                    $options .= '<option value="3">Arrematado</option>';
                    $options .= '<option value="5">Finalizado</option>';
                    $options .= '<option value="4">Em Condicional</option>';

                endif;

            else:

                $options = '<option value="0" selected>Aberto</option>';
                $options .= '<option value="3">Arrematado</option>';
                $options .= '<option value="5">Finalizado</option>';
                $options .= '<option value="4">Em Condicional</option>';
            endif;

            $tfields = '<div class="form-group" style="float: left;width: ' . $wid . ';margin-left: 20px">
                        <label for="recipient-name" class="control-label">' . $this->tabela_filtro(trim($fields)) . ':</label>
                  
                  <select class="form-control js-example-basic-single" name="' . $fields . '" id="' . $fields . '">
                  ' . $options . '
                  </select>
                  
                  
                    </div>';


        endif;


        if ($fields == 'id_user' or $fields == 'leiloes' or  $fields == 'cadastro' or $fields == 'natureza' or $fields == 'comitente' or $fields == 'tipos' or $fields == 'id_passeio' or $fields == 'empresa' or $fields == 'permissoes' or $fields == 'system_id'):

            if($this->session_empresa() == true and  $fields == 'empresa'):

                $tfields = '<input type="hidden" name="' . $fields . '" id="' . $fields . '" value="'.$_SESSION['ID_EMPRESA'].'">';

            else:


                $this->db->select('id,nome');


                $options = '<option>Selecione uma Opção</option>';

                $old = '';

                if (isset($_GET['edit'])):


                    if ($fields == 'leiloes'):
                        $this->db->from('leiloes');
                    endif;

                    if ($fields == 'id_user'):
                        $this->db->from('clientes');
                    endif;

                    if ($fields == 'empresa'):
                        $this->db->from('empresas');
                    endif;
                    if ($fields == 'id_passeio'):
                        $this->db->from('passeios');
                    endif;

                    if ($fields == 'system_id'):
                        $old = 'system_id';
                        $this->db->from('permissoes');
                    endif;
                    if ($fields == 'comitente'):
                        $old = 'comitente';
                        $this->db->from('comitentes');
                    endif;

                    if ($fields == 'permissoes'):
                        $this->db->from('permissoes');
                    endif;

                    if ($fields == 'natureza'):
                        $this->db->from('natureza');
                    endif;

                    if ($fields == 'tipos'):
                        $old = 'tipos';
                        $this->db->from('tipo');
                    endif;
                    if ($fields == 'cadastro'):
                        $old = 'cadastro';
                        $this->db->from('usuarios');
                    endif;
                    $get = $this->db->get();
                    $users = $get->result_array();

                    foreach ($users as $val) {

                        if ($val['id'] == $valuetxt):
                            $options .= '<option value="' . $val['id'] . '" selected>' . $val['nome'] . '</option>';

                        else:
                            $options .= '<option value="' . $val['id'] . '">' . $val['nome'] . '</option>';

                        endif;

                    }

                else:

                    if ($fields == 'leiloes'):
                        $this->db->from('leiloes');
                    endif;

                    if ($fields == 'id_user'):
                        $this->db->from('clientes');
                    endif;
                    if ($fields == 'empresa'):
                        $this->db->from('empresas');
                    endif;
                    if ($fields == 'id_passeio'):
                        $this->db->from('passeios');
                    endif;
                    if ($fields == 'permissoes'):
                        $this->db->from('permissoes');
                    endif;

                    if ($fields == 'system_id'):
                        $old = 'system_id';
                        $this->db->from('permissoes');
                    endif;

                    if ($fields == 'comitente'):
                        $old = 'comitente';
                        $this->db->from('comitentes');
                    endif;
                    if ($fields == 'natureza'):
                        $this->db->from('natureza');
                    endif;

                    if ($fields == 'tipos'):
                        $old = 'tipos';
                        $this->db->from('tipo');
                    endif;
                    if ($fields == 'cadastro'):
                        $old = 'cadastro';
                        $this->db->from('usuarios');
                    endif;
                    $get = $this->db->get();
                    $users = $get->result_array();

                    foreach ($users as $val) {

                        if ($val['id'] == $valuetxt):
                            $options .= '<option value="' . $val['id'] . '" selected>' . $val['nome'] . '</option>';

                        else:
                            $options .= '<option value="' . $val['id'] . '">' . $val['nome'] . '</option>';

                        endif;

                    }

                endif;

                if ($fields == 'permissoes' and $old == 'system_id'):
                    $fields = 'system_id';
                endif;

                $tfields = '<div class="form-group" style="float: left;width: ' . $wid . ';margin-left: 20px">
                        <label for="recipient-name" class="control-label">' . $this->tabela_filtro(trim($fields)) . ':</label>
                  
                  <select class="js-example-basic-single form-control" name="' . $fields . '" id="' . $fields . '">
                  ' . $options . '
                  </select>
                  
                  
                    </div>';


            endif;
        endif;

        return $tfields;
    }


}