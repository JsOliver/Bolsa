<?

$uploaddir = 'web/lotes/';
@rmdir($uploaddir);

@mkdir("web/lotes", 0777);

@mkdir("/web/imagens/leilao" . $_POST['leilao'] . "", 0777);

$uploadfile = $uploaddir . basename($_FILES['EnviarArquivo']['name']);

$extensao = explode('.', $_FILES['EnviarArquivo']['name']);
if ($extensao[1] == 'xls'):

    if (move_uploaded_file($_FILES['EnviarArquivo']['tmp_name'], $uploadfile)) {

        error_reporting(E_ALL);
        ini_set('display_errors', TRUE);
        ini_set('display_startup_errors', TRUE);

        define('EOL', (PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

        date_default_timezone_set('Europe/London');

        /** Include PHPExcel_IOFactory */
        require_once dirname(__FILE__) . '/application/models/PHPExcel/Classes/PHPExcel.php';

        $objReader = new PHPExcel_Reader_Excel5();
        $objReader->setReadDataOnly(true);
        $objPHPExcel = $objReader->load($uploadfile);
        $objPHPExcel->setActiveSheetIndex(0);


        $numerosdeGrupos = 0;
        $linhasGrupos = array();
        $dados = array();
// navegar na linha
        for ($linha = 1; $linha <= 300; $linha++) {
            // navegar nas colunas da respectiva linha
            for ($coluna = 0; $coluna <= 12; $coluna++) {
                if ($linha == 1) {
                    // escreve o cabeçalho da tabela a bold
                } else {


                    if ($coluna == 0):
                        if (!empty(trim($objPHPExcel->getActiveSheet()->getCellByColumnAndRow($coluna, $linha)->getValue()))):

                            $numerosdeGrupos = $numerosdeGrupos + 1;

                            $linhasGrupos[$numerosdeGrupos] = 1;
                        else:

                            $linhasGrupos[$numerosdeGrupos] = $linhasGrupos[$numerosdeGrupos] + 1;

                        endif;


                    endif;
                }
            }
        }

        for ($i = 0; $i <= 12; $i++):

            $campos[$i] = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow($i, 1)->getValue();

        endfor;


        for ($i = 0; $i <= 12; $i++):
            $campos[setCampos(trim($campos[0]))] = setCampos(trim($campos[0]));
        endfor;


        @ob_start();

        require_once dirname(__FILE__) . "/oldsystem/system/conecta.php";
        require_once dirname(__FILE__) . "/oldsystem/system/mysql.php";
        include_once dirname(__FILE__) . '/oldsystem/app/Funcoes/funcoes.php';
        include_once dirname(__FILE__) . '/oldsystem/app/Classes/Email.php';

        $mysql = new Mysql();

        $mysql->filtro = "WHERE id = '" . $_POST['leilao'] . "'";
        $leilao = $mysql->read_unico('leiloes');

        $identificars = 1;


        if(isset($_POST['loteposition']) and $_POST['loteposition'] > 0):
            $n = $_POST['loteposition'];

        else:
            $n = 1;

        endif;

        for ($linha = 2; $linha < 300 + 2; $linha++) {

            if (!empty($objPHPExcel->getActiveSheet()->getCellByColumnAndRow(identificar('Identificador', $campos), $linha)->getValue())):

                $identificars = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(identificar('Identificador', $campos), $linha)->getValue();

            endif;

            $imagemLotes = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(identificar('Imagens', $campos), $linha)->getValue();


            $nomeclaturalotes[1] = 'a';
            $nomeclaturalotes[2] = 'b';
            $nomeclaturalotes[3] = 'c';
            $nomeclaturalotes[4] = 'd';
            $nomeclaturalotes[5] = 'e';


            $mysql->campo['image'] = 'leilao' . $_POST['leilao'] . '/'.$identificars.'a'.'.jpg';
            //$mysql->campo['foto1'] = 'leilao' . $_POST['leilao'] . '/'.$identificars.'b'.'.jpg';
          //  $mysql->campo['foto2'] = 'leilao' . $_POST['leilao'] . '/'.$identificars.'c'.'.jpg';
           // $mysql->campo['foto3'] = 'leilao' . $_POST['leilao'] . '/'.$identificars.'d'.'.jpg';
           // $mysql->campo['foto4'] = 'leilao' . $_POST['leilao'] . '/'.$identificars.'e'.'.jpg';


            $mysql->campo['nome'] = ($objPHPExcel->getActiveSheet()->getCellByColumnAndRow(1, $linha)->getValue());
            $mysql->campo['lance_ini'] = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(identificar('Valor Inicial', $campos), $linha)->getValue();
            $mysql->campo['lance_min'] = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(2, $linha)->getValue();
            $mysql->campo['leiloes'] = $_POST['leilao'];
            $mysql->campo['nlote'] = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(identificar('Identificador', $campos), $linha)->getValue();
            $mysql->campo['data_ini'] = $_POST['data_ini'];
            $mysql->campo['data_fim'] = ($identificars == 1) ? $_POST['data_fim'] : str_replace(' ','T',date("Y-m-d H:i:s", strtotime($_POST['data_fim'] . "+" . ($identificars - 1) . " minutes")));


            $mysql->campo['status'] = 1;

            if (!empty($objPHPExcel->getActiveSheet()->getCellByColumnAndRow(identificar('Identificador', $campos), $linha)->getValue())):
                $id = $mysql->insert('lotes');




            endif;
         //   echo $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(identificar('Identificador', $campos), $linha)->getValue() . '<br>';

            $n++;
        }

        echo '<script>window.location.href="/painel";</script>';

      //  unset($mysql->campo);


        @header("Location:/painel/");


        echo '<br><br>';
        //var_dump($leilao);
    } else {
        echo "Possível ataque de upload de arquivo!\n";
    }


endif;


function identificar($val, $arr)
{

    return array_search($val, $arr);

}


//Função de Filtragem de Campos
function setCampos($campo)
{

    if ($campo == 'Identificador'):
        $campo = 'id';

    elseif ($campo == 'Valor Mínimo'):
        $campo = 'lance_min';

    elseif ($campo == 'Despesas'):
        $campo = 'outras_despesas';

    elseif ($campo == 'Valor Inicial'):
        $campo = 'lance_ini';

    elseif ($campo == 'ID da Sub-categoria'):
        $campo = 'subcategoria_id';
    elseif ($campo == 'Detalhes'):
        $campo = 'nome';

    else:

        $campo = '';
    endif;

    return $campo;
}