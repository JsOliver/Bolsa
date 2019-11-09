<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class ModelDefault extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->db->reconnect();
        @session_start();
        date_default_timezone_set('America/Sao_Paulo');

    }


    public function limita_caracteres($texto, $limite, $quebra = true){
        $tamanho = strlen($texto);
        if($tamanho <= $limite){ //Verifica se o tamanho do texto é menor ou igual ao limite
            $novo_texto = $texto;
        }else{ // Se o tamanho do texto for maior que o limite
            if($quebra == true){ // Verifica a opção de quebrar o texto
                $novo_texto = trim(mb_substr($texto, 0, $limite))."...";
            }else{ // Se não, corta $texto na última palavra antes do limite
                $ultimo_espaco = strrpos(mb_substr($texto, 0, $limite), " "); // Localiza o útlimo espaço antes de $limite
                $novo_texto = trim(mb_substr($texto, 0, $ultimo_espaco))."..."; // Corta o $texto até a posição localizada
            }
        }
        return $novo_texto; // Retorna o valor formatado
    }

    public function acrescimoLotes($leiloes,$lote){


        $this->db->select('id,data_acrescimo,data_fim');
        $this->db->from('lotes');
        $this->db->where('id !=',$lote);
        $this->db->where('leiloes',$leiloes);
        $this->db->where('id >',$lote);
        $this->db->where('stats',0);
        $get = $this->db->get();
        $count = $get->num_rows();

        if($count > 0):
            $lotes = $get->result_array();


        $i = 1;
            foreach ($lotes as $value){


                if(!empty($value['data_acrescimo'])):
                    $diferenca = (str_replace('-','',date('YmdHis') - date('YmdHis',strtotime($value['data_acrescimo']))) / 2);
                else:
                    $diferenca = (str_replace('-','',date('YmdHis') - date('YmdHis',strtotime($value['data_fim']))) / 2);

                endif;

                $diferenca = str_replace('-','',$diferenca);

                if(empty($value['data_acrescimo'])):

                    $db['data_acrescimo'] = date("Y-m-d H:i:s", strtotime($value['data_fim'] . " + 60 seconds"));

                else:

                    $db['data_acrescimo'] = date("Y-m-d H:i:s", strtotime($value['data_acrescimo'] . " + 60 seconds"));

                endif;



                if($diferenca <= (40 * $i)):

                $this->db->where('id',$value['id']);
                $this->db->update('lotes',$db);

                endif;




                $i = $i + 1;

            }


        endif;


    }

    public function verificarCampos($post,$arr){

        $count = count($arr);

        for($i=0;$i<=$count;$i++):

            if(!isset($post[$arr[$i]])):
                echo 'Campo '.$arr[$i].' não encontrado';
                break;
                exit();
            endif;

            if(empty($post[$arr[$i]])):
                echo 'Preencha o campo '.$arr[$i].'';
                break;
                exit();
            endif;

        endfor;

        echo 0;


    }
    public function arrematantes($arr){

        $this->db->select('user');
        $this->db->from('usuarios');
        $this->db->where('id',$arr);
        $get = $this->db->get();
        $count = $get->num_rows();
        if($count > 0):
            $users = $get->result_array()[0];
            $arr = $users['user'];

        else:

            $arr = '';
        endif;
        return $arr;


    }

    public function time_to_sec($time) {
        $hours = substr($time, 0, -6);
        $minutes = substr($time, -5, 2);
        $seconds = substr($time, -2);

        return $hours * 3600 + $minutes * 60 + $seconds;
    }


    public function terminoLote($arr,$leilao){


        $this->db->select('id');
        $this->db->from('lances_lote');
        $this->db->where('leilao',$leilao);
        $this->db->where('lote',$arr);
        $get = $this->db->get();
        $count = $get->num_rows();
        if($count > 0):
            $lance = $get->result_array();


            $this->db->select('lance_atual,lance_min');
            $this->db->from('lotes');
            $this->db->where('id',$arr);
            $get = $this->db->get();
            $lote = $get->result_array()[0];

            $explode = explode('.',$lote['lance_atual']);


            if(isset($lote['lance_atual']) and $explode[0] < $lote['lance_min']):

                $db['stats'] = 4;

            else:

                $db['stats'] = 3;


            endif;


        else:

            $db['stats'] = 5;


        endif;


        $this->db->where('id',$arr);
        $this->db->update('lotes',$db);


        return $db['stats'];



    }


    public function count_lotes($arr){

        $this->db->from('lotes');
        $this->db->where('leiloes', $arr);
        $this->db->where('status', 1);
        $get = $this->db->get();
        $count = $get->num_rows();

        if($count > 0):

            if($count > 1):

                $arr = $count.' Lotes';

            else:

                $arr = $count.' Lote';

            endif;
        else:

            $arr = '0 Lotes';

        endif;
        return $arr;
    }

    public function inicioleilao($arr){

        $this->db->from('lotes');
        $this->db->where('leiloes', $arr);
        $this->db->order_by('data_ini', 'asc');
        $this->db->limit(1, 0);
        $get = $this->db->get();
        $count = $get->num_rows();

        if($count > 0):
            $result = $get->result_array();

            $arr = date('d/m/Y',strtotime($result[0]['data_ini']));

        else:

            $arr = 'Não Informado';

        endif;
        return $arr;
    }

    public function fimleilao($arr){

        $this->db->from('lotes');
        $this->db->where('leiloes', $arr);
        $this->db->order_by('data_fim', 'desc');
        $this->db->limit(1, 0);
        $get = $this->db->get();
        $count = $get->num_rows();

        if($count > 0):
            $result = $get->result_array();

            $arr = date('d/m/Y',strtotime($result[0]['data_fim']));


        else:

            $arr = 'Não Informado';
        endif;


        return $arr;
    }

    public function localidade($arr){
        if(!empty($arr)):

            $this->db->from('leiloes');
            $this->db->where('id', $arr);
            $get = $this->db->get();
            $count = $get->num_rows();

            if($count > 0):
                $result = $get->result_array();

                $arr = $result[0]['cidade'].' / '.$result[0]['estado'];


            else:
                $arr = 'Indefinido';
            endif;

        else:

            $arr = 'Indefinido';
        endif;

        return $arr;
    }

    public function comitentes($arr){
        if(!empty($arr)):

            $this->db->select('nome');
            $this->db->from('comitentes');
            $this->db->where('id', $arr);
            $get = $this->db->get();
            $count = $get->num_rows();

            if($count > 0):
                $result = $get->result_array();

                $arr = $result[0]['nome'];


            else:
                $arr = 'Indefinido';
            endif;

        else:

            $arr = 'Indefinido';
        endif;

        return $arr;
    }

    public function comitente($arr){
        if(!empty($arr)):

            $this->db->from('leiloes');
            $this->db->where('id', $arr);
            $get = $this->db->get();
            $count = $get->num_rows();

            if($count > 0):
                $result = $get->result_array();

                $arr = $result[0]['comitente'];

                $this->db->from('comitentes');
                $this->db->where('id', $arr);
                $get = $this->db->get();
                $count = $get->num_rows();

                if($count > 0):
                    $result = $get->result_array();

                    $arr = $result[0]['nome'];

                else:
                    $arr = 'Indefinido';
                endif;
            else:
                $arr = 'Indefinido';
            endif;

        else:

            $arr = 'Indefinido';
        endif;

        return $arr;
    }

    public function natureza($table,$arr)
    {

        if (!empty($arr)):

            if($table == 'lotes'):

                $this->db->from('leiloes');
                $this->db->where('id', $arr);
                $get = $this->db->get();
                $count = $get->num_rows();

                if($count > 0):
                    $result = $get->result_array();

                    $arr = $result[0]['tipos'];

                else:
                    return 'Indefinido';
                    exit();
                endif;

            endif;

            $this->db->from('natureza');
            $this->db->where('id', $arr);
            $get = $this->db->get();
            $count = $get->num_rows();

            if ($count > 0):
                $result = $get->result_array();

                $arr = $result[0]['nome'];
            else:
                $arr = 'Indefinida';

            endif;

        else:

            $arr = 'Indefinida';

        endif;

        return $arr;

    }

    public function tipoleilao($table,$arr)
    {

        if (!empty($arr)):
            if($table == 'lotes'):

                $this->db->from('leiloes');
                $this->db->where('id', $arr);
                $get = $this->db->get();
                $count = $get->num_rows();

                if($count > 0):
                    $result = $get->result_array();

                    $arr = $result[0]['tipos'];

                else:
                    return 'Indefinido';
                    exit();
                endif;

            endif;
            $this->db->from('tipo');
            $this->db->where('id', $arr);
            $get = $this->db->get();
            $count = $get->num_rows();

            if ($count > 0):
                $result = $get->result_array();

                $arr = $result[0]['nome'];
            else:
                $arr = 'Indefinido';

            endif;

        else:

            $arr = 'Indefinido';

        endif;

        return $arr;

    }

    public function session()
    {
        if (isset($_SESSION['ID']) and isset($_SESSION['EMAIL']) and isset($_SESSION['PASS'])):

            try {
                $this->db->from('usuarios');
                $this->db->where('id', $_SESSION['ID']);
                $this->db->where('email', $_SESSION['EMAIL']);
                $get = $this->db->get();
                $count = $get->num_rows();

                if ($count > 0):

                    return true;

                else:

                    unset($_SESSION['ID']);
                    unset($_SESSION['IP']);
                    unset($_SESSION['EMAIL']);
                    unset($_SESSION['PASS']);

                    return false;

                endif;

            } catch (Exception $e) {
                return false;
            }

        else:

            return false;

        endif;

    }

    public function textolimit($var, $limite)
    {
        if (strlen($var) > $limite) {
            $var = substr($var, 0, $limite);
            $var = trim($var) . "...";
        }
        return $var;
    }

    public function categoriasname($id)
    {


        $this->db->from('categorias');
        $this->db->where('id', $id);
        $get = $this->db->get();
        $count = $get->num_rows();

        if ($count > 0):
            $result = $get->result_array();

            return $result[0]['nome'];
        else:
            return 'Indefinido';

        endif;
    }

    public function empresaname($id)
    {


        $this->db->from('empresas');
        $this->db->where('id', $id);
        $get = $this->db->get();
        $count = $get->num_rows();

        if ($count > 0):
            $result = $get->result_array();

            return $result[0]['nome'];
        else:
            return 'Indefinido';

        endif;
    }

    public function price($id)
    {

        $this->db->from('produtos');
        $this->db->where('id', $id);
        $get = $this->db->get();

        $result = $get->result_array();

        if (empty($result[0]['preco1'])):
            $price = 'R$ ' . number_format($result[0]['preco'], 2, ',', ',') . '';

        else:

            $price = '<del>R$ ' . $result[0]['preco'] . '</del> R$ ' . $result[0]['preco1'] . '';

        endif;
        return $price;
    }

    public function price_code($id)
    {

        $this->db->from('produtos');
        $this->db->where('id', $id);
        $get = $this->db->get();

        $result = $get->result_array();

        if (empty($result[0]['preco1'])):
            $price = $result[0]['preco'];

        else:

            $price = $result[0]['preco1'] . '';

        endif;
        return $price;
    }


    public function sendMail($arr)
    {


        @include 'application/models/PHPMailer/class.phpmailer.php';
        @include 'application/models/PHPMailer/class.smtp.php';
        $this->db->from('config');
        $this->db->order_by('id', 'desc');
        $this->db->limit(1, 0);
        $get = $this->db->get();
        $result = $get->result_array();

        $headers = "From: " . strip_tags($result[0]['EMAIL_SITE']) . "\r\n";
        $headers .= "Reply-To: " . strip_tags($result[0]['EMAIL_SITE']) . "\r\n";
        $headers .= "CC: " . $result[0]['EMAIL_SITE'] . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        if (isset($arr['para']) and isset($arr['npara']) and isset($arr['assunto']) and isset($arr['corpo'])):


            if (mail($arr['para'], utf8_decode($arr['assunto']), utf8_decode($arr['corpo']), $headers, "-r" . $result[0]['EMAIL_SITE'])) { // Se for Postfix
                return 11;
            } else {

                $mail = new PHPMailer;
                $mail->CharSet = "UTF-8";
                $mail->IsSMTP();

                $template = 0;

                $this->db->from('config');
                $this->db->order_by('id', 'desc');
                $this->db->limit(1, 0);
                $get = $this->db->get();

                $count = $get->num_rows();

                if ($count > 0):
                    $result = $get->result_array();


                    $mail->Host = $result[0]['SMTP'];
                    $mail->SMTPAuth = true;
                    $mail->Port = 465;
                    $mail->Username = $result[0]['SMTP_USER'];
                    $mail->Password = $result[0]['SMTP_PASS'];

                    $mail->SetFrom($result[0]['EMAIL_SITE'], $arr['npara']);
                    $mail->AddReplyTo($result[0]['EMAIL_SITE'], $arr['npara']);
                    $mail->Subject = $arr['assunto'];
                    $count = explode(',', $arr['para']);
                    if (count($count) > 0):
                        for ($i = 0; $i < count($count); $i++):
                            $mail->AddAddress($count[$i], $arr['npara']);
                        endfor;
                    else:
                        $mail->AddAddress($arr['para'], $arr['npara']);

                    endif;

                    $mail->MsgHTML($arr['corpo']);

                    if ($mail->Send()):
                        return 11;
                    else:
                        return 'Erro ao enviar o e-mail!';

                    endif;


                endif;
            }
        else:
            return 0;
        endif;

    }

}