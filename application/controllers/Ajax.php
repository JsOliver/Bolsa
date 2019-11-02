<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model');
        $this->load->model('ModelDefault');
        date_default_timezone_set("America/Sao_Paulo");
        setlocale(LC_ALL, 'pt_BR');
    }

    public function remover_imagem(){

        $arr[''.$_POST['campo'].''] = '';
        $this->db->where('id',$_POST['id']);
        $this->db->update($_POST['tabela'],$arr);

        echo 11;
    }

    public function finalizarLeilao(){

        $this->db->from('lotes');
        $this->db->where('id',$_POST['lote']);
        $this->db->where('status',1);
        $get = $this->db->get();

        $lote = $get->result_array()[0];
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
    public function BuscaAdmin(){

        $post['campo'] = $_POST['tabela'];
        $post['keywordAdmin'] = $_POST['busca'];
        echo $this->Model->rowstbodyViewAdmin($post);
        echo '<script></script>';
    }

    public function uploadImage()
    {

        $extensao = pathinfo($_FILES['file']['name']);
        $extensao = ".".$extensao['extension'];
        $imagem = time().rand().$extensao;
        $filename = $imagem;

        /* Location */
        $location = $_SERVER['DOCUMENT_ROOT'] . "/projetos/Bolsa/web/imagens/" . $filename;
        $uploadOk = 1;
        $imageFileType = pathinfo($location, PATHINFO_EXTENSION);

        /* Valid Extensions */
        $valid_extensions = array("jpg", "jpeg", "png", "pdf",  "doc", "gif", "webp");
        /* Check file extension */
        if (!in_array(strtolower($imageFileType), $valid_extensions)) {
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo 0;
        } else {
            /* Upload file */
            if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
                echo $filename;
            } else {
                echo 0;
            }
        }


    }

    public function stars()
    {
        if ($this->Model->session_admin() == true):

            $arr['star'] = $_POST['acao'];
            $this->db->where('id', $_POST['id']);
            $this->db->update('lotes', $arr);

            echo 11;
        endif;

    }


    public function enviar_termo(){

        if(isset($_POST['lote']) and $_POST['lote'] > 0):


            $this->db->from('lotes');
            $this->db->where('id',$_POST['lote']);
            $get = $this->db->get();
            $lote = $get->result_array()[0];


            $this->db->from('leiloes');
            $this->db->where('id',$lote['leiloes']);
            $get = $this->db->get();
            $leiloes = $get->result_array()[0];


            $this->db->from('usuarios');
            $this->db->where('id',$lote['arrematante']);
            $get = $this->db->get();
            $usuario = $get->result_array()[0];



            $corpo = '<table border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100.0%">
    <tbody>
    <tr>
        <td style="padding:11.25pt 11.25pt 11.25pt 11.25pt">
            <div align="center">
                <table border="0" cellspacing="0" cellpadding="0" width="813" style="width:487.5pt;background:white">
                    <tbody>
                    <tr>
                        <td style="padding:0cm 0cm 0cm 0cm">
                            <div style="border:solid #4a2714 1.0pt;padding:0cm 0cm 0cm 0cm">
                                <table border="1" cellspacing="0" cellpadding="0" width="100%"
                                       style="width:100.0%;background:white;border:solid white 1.0pt">
                                    <tbody>
                                    <tr>
                                        <td valign="top" style="border:none;padding:0cm 0cm 0cm 0cm"><p
                                                class="MsoNormal" align="center"
                                                style="text-align:center;line-height:24.0pt"><span
                                                style="font-size:9.0pt;font-family:&quot;Helvetica&quot;,&quot;sans-serif&quot;"><br><a
                                                href="https://bolsadeleiloes.com.br" target="_blank"
                                                data-saferedirecturl="https://www.google.com/url?q=https://bolsadeleiloes.com.br&amp;source=gmail&amp;ust=1571168992077000&amp;usg=AFQjCNGMnTH2L534POKtJPsOr_-KqZw8_w"><span
                                                style="text-decoration:none"><img border="0"
                                                                                  id="m_-3921160328360491252_x0000_i1026"
                                                                                  src="https://ci6.googleusercontent.com/proxy/iIWiw-yGRSFOWww19mrbpkDrO2WTzHzeQBrau76-h5VeTrqaypwh19TvdibWMVLod_5y9obBXcTVLJpIUvCfLRq7anZTd2b2gexfQ1ywF_lU4dc=s0-d-e1-ft#https://bolsadeleiloes.com.br/principal/imagens/logo-topo2.png"
                                                                                  class="CToWUd"></span></a><u></u><u></u></span>
                                        </p></td>
                                    </tr>
                                    </tbody>
                                </table>
                                <p class="MsoNormal"><span style="display:none"><u></u>&nbsp;<u></u></span></p>
                                <table border="0" cellspacing="0" cellpadding="0" width="738"
                                       style="width:442.5pt;margin-left:22.5pt;background:white"
                                       id="m_-3921160328360491252content">
                                    <tbody>
                                    <tr>
                                        <td style="border:none;border-top:solid #4a2714 1.0pt;padding:0cm 0cm 0cm 0cm">
                                            <div>
                                                <p><span
                                                        style="font-size:9.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;">Parabéns, '.$usuario['nome'].'<br><br>Você foi o vencedor(a) da disputa de um ou mais lotes do leilão '.$leiloes['nome'].' realizado no dia '.date('d/m/Y',strtotime($lote['data_fim'])).' em nosso site <a
                                                        href="https://bolsadeleiloes.com.br" target="_blank"
                                                        data-saferedirecturl="https://www.google.com/url?q=https://bolsadeleiloes.com.br&amp;source=gmail&amp;ust=1571168992077000&amp;usg=AFQjCNGMnTH2L534POKtJPsOr_-KqZw8_w">https://bolsadeleiloes.com.br</a>. <br><br><b>Dados do Arrematante:</b><br><b>Nome:</b> '.$usuario['nome'].'<br><b>CPF/CNPJ:</b> '.$usuario['cpf'].'<br><b>Endereço:</b> '.$usuario['endereco'].', '.$usuario['bairro'].' / '.$usuario['cidade'].' - '.$usuario['estado'].'<br><b>Telefone:</b> , '.$usuario['telefone'].'<br><br><b>Dados do Arremate:</b> '.date('d/m/Y',strtotime($lote['data_fim'])).'<br><b>Valor de Arremate:</b> R$ '.number_format($lote['lance_atual'],2,',','.').'<br>                                                                                                                                        
                                                        <br>Para visualizer e imprimir o recibo de arrematação e dados do(s) lote(s) arrematados acesse:<br><a
                                                        href="'.base_url('minha-conta/lotes-arrematados').'"
                                                        target="_blank"
                                                        data-saferedirecturl="https://www.google.com/url?q=https://bolsadeleiloes.com.br/leilao/recibo/abd815286ba1007abfbb8415b83ae2cf&amp;source=gmail&amp;ust=1571168992077000&amp;usg=AFQjCNFmGv5cqSuITiQvmt9gzDhsvMYbaw">'.base_url('minha-conta/lotes-arrematados').'</a> <br><br><b>***LEIA COM ATENÇÃO***</b><br><br><b><u>INSTRUÇÕES DE PAGAMENTO E OUTRAS INFORMAÇÕES:</u><br></b><br><strong><span
                                                        style="font-family:&quot;Arial&quot;,&quot;sans-serif&quot;">A) PRAZO DE PAGAMENTO </span></strong><u></u><u></u></span>
                                                </p>
                                                <div><p class="MsoNormal"><span
                                                        style="font-size:9.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;">O pagamento deverá ser feito em até 01 (um) dia útil após data de arremate. <u></u><u></u></span>
                                                </p></div>
                                                <div><p class="MsoNormal"><span
                                                        style="font-size:9.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;"><u></u>&nbsp;<u></u></span>
                                                </p></div>
                                                <div><p class="MsoNormal"><strong><span
                                                        style="font-size:9.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;">B) FORMA DE PAGAMENTO </span></strong><span
                                                        style="font-size:9.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;"><br>O pagamento deverá ser feito em seu <strong><span
                                                        style="font-family:&quot;Arial&quot;,&quot;sans-serif&quot;">VALOR TOTAL DE: R$ '.($lote['lance_atual'] + (($lote['lance_atual'] / 100) * 5) + 220).'</span></strong> através de depósito, transferência bancária ou TED para a conta abaixo informada: <u></u><u></u></span>
                                                </p></div>
                                                <div><p class="MsoNormal"><strong><span
                                                        style="font-size:9.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;">Banco: BRADESCO - 237 </span></strong><b><span
                                                        style="font-size:9.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;"><br><strong><span
                                                        style="font-family:&quot;Arial&quot;,&quot;sans-serif&quot;">Agência: 0849 </span></strong><br><strong><span
                                                        style="font-family:&quot;Arial&quot;,&quot;sans-serif&quot;">Conta Corrente: 21400-0 </span></strong><br><strong><span
                                                        style="font-family:&quot;Arial&quot;,&quot;sans-serif&quot;">Favorecido: Viviane Garzon Correa</span></strong><br><strong><span
                                                        style="font-family:&quot;Arial&quot;,&quot;sans-serif&quot;">CPF: 002.330.006-07 </span></strong></span></b><span
                                                        style="font-size:9.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;"><br><br><strong><span
                                                        style="font-family:&quot;Arial&quot;,&quot;sans-serif&quot;">C) COMPROVANTE DE PAGAMENTO </span></strong><br>Após feito o pagamento deverá ser respondido a este email sendo anexado o comprovante de pagamento. Somente após o envio do comprovante será dado como concluso a arrematação. <br><br><strong><span
                                                        style="font-family:&quot;Arial&quot;,&quot;sans-serif&quot;">D) RETIRADA </span></strong><br>O Arrematante terá prazo de 03 (Três) dias úteis para a retirada do bem arrematado, mediante a apresentação da Nota de Arremate, a contar da data do leilão. Finalizando este prazo será cobrado R$ 10,00 (Dez Reais) ao dia por m2 a título de armazenagem em nosso pátio. Decorridos 30 dias, o arrematante perderá o direito de propriedade do bem, sem direito a qualquer restituição. Para a retirada do Recibo de Arrematação é necessária apresentação dos documentos de identificação do arrematante (Cédula de Identidade e CPF/MF, no caso de Pessoa Física, e Contrato Social ou Estatuto Social acompanhado de Ata de Eleição da Diretoria, no caso de Pessoa Jurídica). No caso de procuradores, será necessária autorização por escrito do arrematante, com firma reconhecida em cartório – não serão abertas exceções. Na retirada dos bens, o arrematante deverá conferir o(s) referido(s) lote(s) (natureza, quantidade, estado ou condições em que o(s) mesmo(s) estiver(em)). Não poderá o arrematante alegar qualquer irregularidade e/ou divergência após a remoção do(s) bem(ns). Caso algum lote não seja encontrado no momento da retirada, o montante total pago pelo mesmo (ou algum valor proporcional em comum acordo com o Arrematante) será devolvido em até 3 dias (três) dias úteis através de depósito em cheque. <br><br><strong><span
                                                        style="font-family:&quot;Arial&quot;,&quot;sans-serif&quot;">E) INADIMPLÊNCIA </span></strong><br>Caso o arrematante não pague o preço do bem arrematado, a comissão do Leiloeiro Oficial e as taxas de adminstração no prazo de até 01 (um) dia útil após data de arremate, a arrematação ficará cancelada, devendo arrematante pagar o valor correspondente a 25% (vinte e cinco por cento) do lance ofertado, sendo 5% (cinco por cento) a título de comissão do Leiloeiro Oficial e 20% (vinte por cento) destinado à comitente e ao pagamento de eventuais despesas incorridas. Poderá a Leiloeira emitir título de crédito para a cobrança de tais valores, encaminhando-o a protesto por falta de pagamento, sem prejuízo da execução prevista no artigo 39, do Decreto no. 21.981/32.<u></u><u></u></span>
                                                </p></div>
                                                <p class="MsoNormal"><span
                                                        style="font-size:9.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;">Muito Obrigado<br>Bolsa de Leilões<br><a
                                                        href="https://bolsadeleiloes.com.br" target="_blank"
                                                        data-saferedirecturl="https://www.google.com/url?q=https://bolsadeleiloes.com.br&amp;source=gmail&amp;ust=1571168992077000&amp;usg=AFQjCNGMnTH2L534POKtJPsOr_-KqZw8_w">https://www.bolsadeleiloes.com.br</a> <u></u><u></u></span>
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <p class="MsoNormal"><span style="display:none"><u></u>&nbsp;<u></u></span></p>
                                <table border="0" cellspacing="0" cellpadding="0" width="738"
                                       style="width:442.5pt;margin-left:22.5pt;background:white"
                                       id="m_-3921160328360491252footer">
                                    <tbody>
                                    <tr>
                                        <td style="border:none;border-top:solid #4a2714 1.0pt;padding:0cm 0cm 0cm 0cm"></td>
                                    </tr>
                                    <tr style="height:11.25pt">
                                        <td style="padding:0cm 0cm 0cm 0cm;height:11.25pt"><p class="MsoNormal"><span
                                                style="font-size:9.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:white">.<u></u><u></u></span>
                                        </p></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <p class="MsoNormal"><span style="color:windowtext"><u></u><u></u></span></p></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </td>
    </tr>
    </tbody>
</table>';


          //  base_url('minha-conta/lotes-arrematados');
            $array['corpo'] = $corpo;
            $array['para'] = $usuario['email'];
            $array['npara'] = 'TERMO DE ARREMATAÇÃO';
            $array['assunto'] = 'TERMO DE ARREMATAÇÃO - BOLSA DE LEILÕES';

            if ($this->ModelDefault->sendMail($array)):
                echo 11;
            else:
                echo 'Erro ao enviar TERMO';
            endif;


        elseif(isset($_POST['leilao']) and $_POST['leilao'] > 0):

            $this->db->from('leiloes');
            $this->db->where('id',$_POST['leilao']);
            $get = $this->db->get();
            $leiloes = $get->result_array();


            $email = '';

            foreach ($leiloes as $value) {
                $this->db->from('lotes');
                $this->db->where('leiloes', $value['id']);
                $this->db->where('stats', 3);
                $get = $this->db->get();
                $count = $get->num_rows();
                if($count > 0):
                $lote = $get->result_array()[0];


                $this->db->from('usuarios');
                $this->db->where('id', $lote['arrematante']);
                $get = $this->db->get();
                $usuario = $get->result_array()[0];
                    $email .= $usuario['email'].',';
                endif;
            }
                $corpo = 'Olá Arrematante! <br><br><br>

Abaixo link para termo de Arrematação.<br><br><br>

Link : <a href="' . base_url('minha-conta/lotes-arrematados') . '">' . base_url('minha-conta/lotes-arrematados') . '</a>
<br><br><br><br>
 

Att,
<br><br>
Equipe Bolsa de Leilões';
                $array['corpo'] = $corpo;
                $array['para'] = $email;
                $array['npara'] = 'TERMO DE ARREMATAÇÃO';
                $array['assunto'] = 'TERMO DE ARREMATAÇÃO - BOLSA DE LEILÕES';

                if ($this->ModelDefault->sendMail($array)):
                    echo 11;
                else:
                    echo 'Erro ao enviar TERMO';
                endif;

        endif;

    }


    public function changestatus()
    {
        if ($this->Model->session_admin() == true):


            $arr['status'] = $_POST['status'];
            $this->db->where('id', $_POST['item']);
            $this->db->update($_POST['table'], $arr);

            echo 11;
        endif;


    }


    public function chagevalidado()
    {
        if ($this->Model->session_admin() == true):


            if($_POST['table'] == 'usuarios' and $_POST['validado'] == 1):


                $arr['validado'] = $_POST['validado'];
                $this->db->where('id', $_POST['item']);
                $this->db->update($_POST['table'], $arr);

                $arpns['visualizado'] = 1;
                $arpns['respondido'] = 1;
                $this->db->where('cadastro',$_POST['item']);
                $this->db->update('documentos',$arpns);


                $this->db->from('usuarios');
                $this->db->where('id',$_POST['item']);
                $get = $this->db->get();
                $usuario = $get->result_array()[0];

                $corpo = '<table border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100.0%">
    <tbody>
    <tr>
        <td style="padding:11.25pt 11.25pt 11.25pt 11.25pt">
            <div align="center">
                <table border="0" cellspacing="0" cellpadding="0" width="813" style="width:487.5pt;background:white">
                    <tbody>
                    <tr>
                        <td style="padding:0cm 0cm 0cm 0cm">
                            <div style="border:solid #003c53 1.0pt;padding:0cm 0cm 0cm 0cm">
                                <table border="1" cellspacing="0" cellpadding="0" width="100%"
                                       style="width:100.0%;background:white;border:solid white 1.0pt">
                                    <tbody>
                                    <tr>
                                        <td valign="top" style="border:none;padding:0cm 0cm 0cm 0cm"><p
                                                class="MsoNormal" align="center"
                                                style="text-align:center;line-height:24.0pt"><span
                                                style="font-size:9.0pt;font-family:&quot;Helvetica&quot;,&quot;sans-serif&quot;"><br></span><a
                                                href="http://www.bolsadeleiloes.com.br/" target="_blank"
                                                data-saferedirecturl="https://www.google.com/url?q=http://www.bolsadeleiloes.com.br/&amp;source=gmail&amp;ust=1571165355434000&amp;usg=AFQjCNFAdI_EJrBve5-6KKhQC23mU86O3w"><span
                                               ><img
                                                border="0" width="100" height="80"
                                                id="m_-7298482167671199781m_-6410468127861094398_x005f_x0000_i1025"
                                                src="https://bolsadeleiloes.com.br/web/imagens/22072019_24497712logo.png"
                                                alt="Descrição: Imagem removida pelo remetente."
                                                data-image-whitelisted="" class="CToWUd"></span></a><u></u><u></u></p><br>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <table border="0" cellspacing="0" cellpadding="0" width="738"
                                       style="width:442.5pt;margin-left:22.5pt;background:white"
                                       id="m_-7298482167671199781m_-6410468127861094398content">
                                    <tbody>

                                    <tr>
                                        <td style="border:none;border-top:solid #003c53 1.0pt;padding:0cm 0cm 0cm 0cm">
                                            <div><p><span
                                                    style="font-size:9.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;"><br>Prezado(a) Arrematante,<br><strong><span
                                                    style="font-family:&quot;Arial&quot;,&quot;sans-serif&quot;">Seu cadastro em nosso site foi aprovado!</span></strong><br>Lembramos que caso detectemos a falta de algum documento no ato de conclusão de arremate e participação em nossos Leilões iremos solicitar o(s) mesmo(s). Observamos que caso não venhamos receber tais documentos solicitados até a data do leilão seu acesso será cancelado e seus lances anteriores desconsiderados. <br><br>Login: <a
                                                    href="mailto:'.$usuario['email'].'" target="_blank">'.$usuario['email'].'</a><br>
                                                <br>Acesse nosso site e de seus lances: <a
                                                    href="http://www.bolsadeleiloes.com.br" target="_blank"
                                                    data-saferedirecturl="https://www.google.com/url?q=http://www.bolsadeleiloes.com.br&amp;source=gmail&amp;ust=1571165355434000&amp;usg=AFQjCNHxwnrSMR-8YuIs5LeQms_kNxe6ww">www.bolsadeleiloes.com.br</a><br><br>Muito Obrigado.</span><u></u><u></u>
                                            </p></div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <p class="MsoNormal">&nbsp;<u></u><u></u></p>
                                <table border="0" cellspacing="0" cellpadding="0" width="738"
                                       style="width:442.5pt;margin-left:22.5pt;background:white"
                                       id="m_-7298482167671199781m_-6410468127861094398footer">
                                    <tbody>
                                    <tr>
                                        <td style="border:none;border-top:solid #003c53 1.0pt;padding:0cm 0cm 0cm 0cm">
                                            <div><p class="MsoNormal"><span
                                                    style="font-size:8.5pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#999999">Bolsa de Leilões</span><u></u><u></u>
                                            </p></div>
                                        </td>
                                    </tr>
                                    <tr style="height:11.25pt">
                                        <td style="padding:0cm 0cm 0cm 0cm;height:11.25pt"><p class="MsoNormal"
                                                                                              style="line-height:11.25pt">
                                            <span style="font-size:9.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:white">.</span><u></u><u></u>
                                        </p></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </td>
    </tr>
    </tbody>
</table>';
                $array['corpo'] = $corpo;
                $array['para'] = $usuario['email'];
                $array['npara'] = 'Sua Habilitação foi Efetuada com Sucesso';
                $array['assunto'] = 'Sua Habilitação foi Efetuada com Sucesso - BOLSA DE LEILÕES';

                if ($this->ModelDefault->sendMail($array)):
                    echo 11;
                else:
                    echo 'Erro ao enviar TERMO';
                endif;



            else:



            $arr['validado'] = $_POST['validado'];
            $this->db->where('id', $_POST['item']);
            $this->db->update($_POST['table'], $arr);

            $arpns['visualizado'] = 1;
            $arpns['respondido'] = 1;
            $this->db->where('cadastro',$_POST['item']);
            $this->db->update('documentos',$arpns);

            echo 11;
        endif;
        endif;

    }

    public function deleteitens()
    {
        if ($this->Model->session_admin() == true):

            $this->db->from('menu_admin');
            $this->db->where('id', $_POST['table']);
            $get = $this->db->get();
            $menu_admin = $get->result_array()[0];


            if ($_POST['item'] == '34' and $menu_admin['tabela'] == 'menu_admin'):

            else:
                $this->db->from($menu_admin['tabela']);
                $this->db->where('id', $_POST['item']);
                $get = $this->db->get();
                $count = $get->num_rows();
                if ($count > 0):
                    $result = $get->result_array()[0];
                    if (isset($result['image'])):
                        @unlink($_SERVER['DOCUMENT_ROOT'] . "/leilao/web/imagens/" . $result['image']);
                    endif;
                endif;

                if ($menu_admin['tabela'] == 'administradores' and $_POST['item'] == $_SESSION['ID_ADMIN'] and $_POST['item'] <> 2):
                    echo 'Erro ao Deletar';

                elseif ($menu_admin['tabela'] == 'cotacoes'):


                    $this->db->where('lista_cotacao', $_POST['item']);
                    $this->db->delete('cotacoes_itens');


                    $this->db->where('id', $_POST['item']);
                    $this->db->delete($menu_admin['tabela']);
                else:
                    $this->db->where('id', $_POST['item']);
                    $this->db->delete($menu_admin['tabela']);
                endif;
            endif;
            echo 11;

        endif;

    }

    public function ProcessarForm()
    {
        if ($this->Model->session_admin() == true):


            $_POST = $this->Model->tratar_campos($_POST);

            $this->db->from('menu_admin');
            $this->db->where('id', $_POST['tabelaid']);
            $get = $this->db->get();
            $menu_admin = $get->result_array()[0];
            unset($_POST['tabelaid']);


            if (isset($_POST['iditem'])):

                $editid = $_POST['iditem'];
                unset($_POST['iditem']);
                $lastinsertbackup = 0;


                $this->db->from($menu_admin['tabela']);
                $this->db->where('id', $editid);
                $get = $this->db->get();
                $backuptable = $get->result_array()[0];


                $backup['data_alterada'] = date('d/m/Y H:i:s');
                $backup['id_admin'] = $_SESSION['ID_ADMIN'];
                $backup['ip_alteracao'] = $_SERVER['REMOTE_ADDR'];


                $explodedata = explode(',', $menu_admin['tb']);

                $databackup = '';
                for ($n = 0; $n < count($explodedata); $n++):

                    @$databackup .= '<<< <b>' . $explodedata[$n] . ': </b>' . $backuptable[$explodedata[$n]] . ' >>>,';

                endfor;
                $backup['sql_dump'] = $databackup;

                $this->db->insert('beforedata', $backup);
                $lastinsertbackup = $this->db->insert_id();

                if (isset($_POST['codigo_fonte'])):
                    $_POST['codigo_fonte'] = htmlspecialchars($_POST['codigo_fonte']);
                endif;

                if (isset($_POST['codigo_fonte2'])):
                    $_POST['codigo_fonte2'] = htmlspecialchars($_POST['codigo_fonte2']);
                endif;

                $this->db->where('id', $editid);
                $this->db->update($menu_admin['tabela'], $_POST);

                $log['acao'] = 'Alterado dado com <b>ID ' . $editid . '</b> na <b>tabela ' . $menu_admin['tabela'] . '</b>';
                $log['tipo_acao'] = 2;
                $log['beforedata'] = $lastinsertbackup;
                $log['id_admin'] = $_SESSION['ID_ADMIN'];
                $log['ip'] = $_SERVER['REMOTE_ADDR'];
                $log['data_up_admin'] = $_SESSION['ID_ADMIN'];
                $this->db->insert('log_admin', $log);

                echo 11;
            else:


                if (isset($_POST['codigo_fonte'])):
                    $_POST['codigo_fonte'] = trim(htmlspecialchars($_POST['codigo_fonte']));
                endif;

                if (isset($_POST['codigo_fonte2'])):
                    $_POST['codigo_fonte2'] = trim(htmlspecialchars($_POST['codigo_fonte2']));
                endif;


                $this->db->insert($menu_admin['tabela'], $_POST);
                $lastinsert = $this->db->insert_id();


                $log['acao'] = 'Adicionado dado com <b>ID ' . $lastinsert . '</b> na <b>tabela ' . $menu_admin['tabela'] . '</b>';
                $log['tipo_acao'] = 2;
                $log['id_admin'] = $_SESSION['ID_ADMIN'];
                $log['ip'] = $_SERVER['REMOTE_ADDR'];
                $log['data_up_admin'] = $_SESSION['ID_ADMIN'];
                $this->db->insert('log_admin', $log);

                echo 11;
            endif;


        endif;

    }

    public function formFilds()
    {

        if ($this->Model->session_admin() == true or $this->Model->session_empresa() == true):

            $return = '';

            $this->db->from('menu_admin');
            $this->db->where('id', $_POST['tabela']);
            $get = $this->db->get();

            $count = $get->num_rows();
            if (isset($_POST['edit'])):

                $class = 'form_' . $_POST['edit'];

            else:

                $class = 'form_';

            endif;

            if ($count > 0):


                $menu = $get->result_array()[0];

                $campoexplode = explode(',', $menu['tb']);

                $return .= '<form method="post" action="javascript:saveForm();" id="' . $class . '">';
                if (isset($_POST['edit'])):
                    $return .= '<input type="hidden" name="iditem" value="' . $_POST['edit'] . '">';
                endif;
                $return .= '<input type="hidden" name="tabelaid" value="' . $_POST['tabela'] . '">';
                for ($i = 0; $i < count($campoexplode); $i++):

                    if ($campoexplode[$i] == 'nome' and $_POST['tabela'] == '30' or $campoexplode[$i] == 'nome' and $_POST['tabela'] == '31'):
                        $campowidth = '95%';
                    elseif ($campoexplode[$i] == 'conteudo' or $campoexplode[$i] == 'descricao' or $campoexplode[$i] == 'EMAIL_CONFIRMAR_EMAIL' or $campoexplode[$i] == 'EMAIL_CADASTRO' or $campoexplode[$i] == 'EMAIL_PEDIDO_EFETUADO' or $campoexplode[$i] == 'codigo_fonte' or $campoexplode[$i] == 'codigo_fonte2'):
                        $campowidth = '100%';

                    else:
                        $campowidth = '30%';

                    endif;

                    if ($this->Model->TitleSearch($campoexplode[$i]) == true):
                        $return .= $this->Model->TitleReplace($campoexplode[$i]);
                    else:


                        if ($campoexplode[$i] == 'permissoes' and isset($_SESSION['PERMISSAO_ADMIN']) and $_SESSION['PERMISSAO_ADMIN'] > 1):

                            $return .= '<input type="hidden" name="permissoes" value="' . $_SESSION['PERMISSAO_ADMIN'] . '">';
                        else:

                            if (isset($_POST['edit'])):
                                $return .= $this->Model->campos_filtro($_POST['edit'], $campoexplode[$i], $_POST['tabela'], $campowidth);

                            else:
                                $return .= $this->Model->campos_filtro(0, $campoexplode[$i], $_POST['tabela'], $campowidth);

                            endif;

                        endif;
                    endif;


                endfor;


                $return .= '</form>';
                echo ' <script>
 
 $(\'.js-example-basic-single\').select2({
  placeholder: \'Select an option\'
});
 
    var editor = new FroalaEditor(\'#froala-editor\'); 
    
    $(document).ready(function() {
    $(\'select\').select2();
});    
    
    
    
  </script>

  
  ';


            endif;
            echo $return;
        endif;
    }

    public function NavegacaoView()
    {

        $arr['edits'] = @$_POST['edit'];
        if ($this->Model->session_admin() == true and $this->Model->session_empresa() == false):

            $this->db->from('administrador');
            $this->db->where('id', $_SESSION['ID_ADMIN']);
            $get = $this->db->get();
            $administrativo = $get->result_array()[0];


            $this->db->from('menu_admin_categorias');
            $this->db->where('status', 1);
            $this->db->order_by('ordem', 'desc');
            $get = $this->db->get();
            $menu_admin_categoria = $get->result_array();


            $array['admin'] = $administrativo;
            $array['menu_categoria'] = $menu_admin_categoria;
            $array['pedido_resumo_diario'] = array([
                "total_pedidos" => "147",
                "total_intencoes" => "28",
                "pedidos_ao_dia_anterior_porc" => $this->Model->porcentagem_compara_dias('pedidos', 'pedidos', 1547, 645),
                "intencoes_ao_dia_anterior_porc" => $this->Model->porcentagem_compara_dias('pedidos', 'intencoes', 154, 28),

            ]);


            $arr['post'] = $_POST;


            if ($_POST['campo'] == 0):
                $this->load->view('painel/app/header', $array);
                $this->load->view('painel/app/navigation', $array);
                $this->load->view('painel/app/footer', $array);

            else:
                $this->load->view('painel/sys/data/ViewPost', $arr);
                $this->load->view('painel/sys/Ons/Js');

            endif;

            $this->load->view('painel/sys/Ons/addOns', $array);

        else:
            if ($this->Model->session_empresa() == false):
                echo 'reload_action';
            endif;
        endif;

        if ($this->Model->session_empresa() == true and $this->Model->session_admin() == false):

            $this->db->from('empresas');
            $this->db->where('id', $_SESSION['ID_EMPRESA']);
            $get = $this->db->get();
            $administrativo = $get->result_array()[0];


            $this->db->from('menu_admin_categorias');
            $this->db->where('status', 1);
            $this->db->where('empresa', 1);
            $this->db->order_by('ordem', 'desc');
            $get = $this->db->get();
            $menu_admin_categoria = $get->result_array();


            $array['admin'] = $administrativo;
            $array['menu_categoria'] = $menu_admin_categoria;
            $array['pedido_resumo_diario'] = array([
                "total_pedidos" => "147",
                "total_intencoes" => "28",
                "pedidos_ao_dia_anterior_porc" => $this->Model->porcentagem_compara_dias('pedidos', 'pedidos', 1547, 645),
                "intencoes_ao_dia_anterior_porc" => $this->Model->porcentagem_compara_dias('pedidos', 'intencoes', 154, 28),

            ]);


            $arr['post'] = $_POST;


            if ($_POST['campo'] == 0):
                $this->load->view('painel/app/header', $array);
                $this->load->view('painel/app/navigation', $array);
                $this->load->view('painel/app/footer', $array);

            else:
                $this->load->view('painel/sys/data/ViewPost', $arr);
                $this->load->view('painel/sys/Ons/Js');

            endif;

            $this->load->view('painel/sys/Ons/addOns', $array);

        else:
            if ($this->Model->session_admin() == false):
                echo 'reload_action';
            endif;
        endif;

    }

    public function logout()
    {
        $log_update['data_saida'] = date('d/m/Y H:i:s');
        $this->db->where('id', $_SESSION['ID_LOG']);
        $this->db->update('log_admin', $log_update);


        unset($_SESSION['ID_ADMIN']);
        unset($_SESSION['USER_ADMIN']);
        unset($_SESSION['ID_LOG']);
        unset($_SESSION['IP_ADMIN']);
        unset($_SESSION['EMAIL_ADMIN']);
        unset($_SESSION['PASS_ADMIN']);
        echo 11;
    }

    public function logoutEmpresa()
    {


        unset($_SESSION['ID_EMPRESA']);
        unset($_SESSION['USER_EMPRESA']);
        unset($_SESSION['IP_EMPRESA']);
        unset($_SESSION['EMAIL_EMPRESA']);
        unset($_SESSION['PASS_EMPRESA']);
        echo 11;
    }

    public function login()
    {
        if (isset($_POST['empresaLogin']) and $_POST['empresaLogin'] == 1):

            try {

                if ($this->Model->session_empresa() == true):

                    echo 'O usuario já está logado!';

                else:

                    $this->db->from('empresas');
                    $this->db->where('user', $_POST['user']);
                    $this->db->where('pass', md5($_POST['pass']));
                    $get = $this->db->get();
                    $count = $get->num_rows();

                    if ($count > 0):

                        $result = $get->result_array()[0];


                        $update['ultimo_acesso'] = date('d/m/Y H:i:s');
                        $this->db->where('id', $result['id']);
                        $this->db->update('empresas', $update);


                        $log['id_admin'] = $result['id'];
                        $log['acao'] = 'Empresa -  Login: USUARIO: ' . $_POST['user'] . ' || SENHA: *********';

                        $log['ip'] = $_SERVER['REMOTE_ADDR'];
                        $log['data_entrada'] = date('d/m/Y H:i:s');
                        $this->db->insert('log_admin', $log);


                        $_SESSION['ID_LOG'] = $this->db->insert_id();
                        $_SESSION['ID_EMPRESA'] = $result['id'];
                        $_SESSION['USER_EMPRESA'] = $result['user'];
                        $_SESSION['IP_EMPRESA'] = $_SERVER['REMOTE_ADDR'];
                        $_SESSION['EMAIL_EMPRESA'] = $result['email'];
                        $_SESSION['PASS_EMPRESA'] = $result['pass'];

                        echo 11;

                    else:

                        $log['acao'] = 'EMPRESA - Tentativa de Login: USUARIO: ' . $_POST['user'] . ' || SENHA: ' . $_POST['pass'] . '';
                        $log['ip'] = $_SERVER['REMOTE_ADDR'];
                        $log['data'] = date('d/m/Y H:i:s');
                        $this->db->insert('log_erros', $log);


                        echo 'Usuario ou Senha Incorretos';

                    endif;
                endif;

            } catch (Exception $e) {
                echo 'Ocorreu um erro no Sistema';
            }


        else:

            try {

                if ($this->Model->session_admin() == true):

                    echo 'O usuario já está logado!';

                else:

                    $this->db->from('administrador');
                    $this->db->where('user', $_POST['user']);
                    $this->db->where('pass', md5($_POST['pass']));
                    $get = $this->db->get();
                    $count = $get->num_rows();

                    if ($count > 0):

                        $result = $get->result_array()[0];


                        $update['ultimo_acesso'] = date('d/m/Y H:i:s');
                        $this->db->where('id', $result['id']);
                        $this->db->update('administrador', $update);


                        $log['id_admin'] = $result['id'];
                        $log['acao'] = 'ADMINISTRAÇÃO -  Login: USUARIO: ' . $_POST['user'] . ' || SENHA: *********';

                        $log['ip'] = $_SERVER['REMOTE_ADDR'];
                        $log['data_entrada'] = date('d/m/Y H:i:s');
                        $this->db->insert('log_admin', $log);


                        $_SESSION['ID_LOG'] = $this->db->insert_id();
                        $_SESSION['ID_ADMIN'] = $result['id'];
                        $_SESSION['USER_ADMIN'] = $result['user'];
                        $_SESSION['IP_ADMIN'] = $_SERVER['REMOTE_ADDR'];
                        $_SESSION['PERMISSAO_ADMIN'] = $result['permissoes'];
                        $_SESSION['EMAIL_ADMIN'] = $result['email'];
                        $_SESSION['PASS_ADMIN'] = $result['pass'];

                        echo 11;

                    else:


                        $log['acao'] = 'ADMINISTRAÇÃO - Tentativa de Login: USUARIO: ' . $_POST['user'] . ' || SENHA: ' . $_POST['pass'] . '';
                        $log['ip'] = $_SERVER['REMOTE_ADDR'];
                        $log['data'] = date('d/m/Y H:i:s');
                        $this->db->insert('log_erros', $log);


                        echo 'Usuario ou Senha Incorretos';

                    endif;
                endif;

            } catch (Exception $e) {
                echo 'Ocorreu um erro no Sistema';
            }

        endif;

    }

    public function perfilAltera(){
        if ($this->Model->session_empresa() == true):
            $_POST = $this->Model->tratar_campos($_POST);

            $this->db->where('id',$_SESSION['ID_EMPRESA']);
            $this->db->update('empresas',$_POST);

            echo 11;

            else:
            echo 'E necessario estar logado como empresa!';

        endif;
        }
}
