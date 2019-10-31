<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" type="text/css">
<div class="container">
<table cellpadding="0" cellspacing="0" border="1"
       style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; width: 100%;float: left">
    <tbody>
    <tr>
        <td style="text-align: center; border-right: 0px;">
            <div style="padding-top: 10px;"><img src="https://bolsadeleiloes.com.br/web/imagens/22072019_24497712logo.png"
                                                 style="max-width: 200px;"></div>
        </td>
        <td rowspan="2" style="text-align: center; border-left: 0px; border-right: 0px;">
            <div style="font-weight: bold;"></div>
            <div style="font-size: 11px;">Bolsa de Leilões</div>
            <div style="font-size: 11px;">
                <div style="width: 200px; display: inline-block;">Anel Rodoviário Celso Mello Azevedo, 3713 -
                    Bonsucesso - CEP 30622-213 - BH / MG
                </div>
            </div>
            <div style="font-size: 11px;">Telefone (31) 3422-6739/3383-1063</div>
            <div style="font-size: 11px; font-weight: bold;">http://bolsadeleiloes.com.br</div>
        </td>
        <td rowspan="2" style="text-align: center; border-left: 0px;">
            <div style="font-size: 24px; font-weight: bold;">
                <div style="padding: 5px 0px;">TERMO<br>PROVISÓRIO<br>DE ARREMATAÇÃO</div>
                <div style="padding-bottom: 5px; font-size: 16px;"><b>EMISSÃO: <?php echo date('d/m/Y');?></b></div>
            </div>
        </td>
    </tr>
    </tbody>
</table>
<div style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; height: 20px;"></div>
<table cellpadding="5" cellspacing="0" border="1"
       style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; width: 100%;float: left;">
    <tbody>
    <tr>
        <td colspan="2"><b>Leilão:</b>&nbsp;<?php echo $leiloes['nome'];?></td>
        <td colspan="2"><b>Lote:</b>&nbsp;<?php echo $lote['nlote'];?> - <?php echo $lote['nome'];?>
        </td>
        <td colspan="2"><b>Comitente:</b>&nbsp;<?php echo $comitente['nome'];?></td>
        <td colspan="2"><b>Data do leilão:</b><?php echo date('d/m/Y',strtotime($lote['data_fim']));?></td>
    </tr>
    <tr>
        <td colspan="2"><b>Arrematante:</b>&nbsp;<?php echo $usuario['nome'];?></td>
        <td colspan="2"><b>Data de Nascimento:</b>&nbsp;<?php echo $usuario['data_nasc'];?></td>
        <td colspan="2"><b>Email:</b><?php echo $usuario['email'];?></td>
        <td colspan="2"><b>CPF/CNPJ:</b><?php echo $usuario['cpf'];?></td>
    </tr>
    <tr>
        <td colspan="3"><b>Rua/Av:</b>&nbsp;<?php echo $usuario['endereco'];?></td>
        <td colspan="3"><b>Nº:</b>&nbsp;<?php echo $usuario['numero'];?></td>
        <td colspan="3"><b>Compl.:</b> <?php echo $usuario['complemento'];?></td>
    </tr>
    <tr>
        <td colspan="3"><b>Bairro:</b>&nbsp;<?php echo $usuario['bairro'];?></td>
        <td colspan="3"><b>CEP:</b>&nbsp;<?php echo $usuario['cep'];?></td>
        <td colspan="3"><b>Cidade:</b><?php echo $usuario['cidade'];?></td>
    </tr>
    <tr>
        <td colspan="4"><b>Telefones:</b>&nbsp;<?php echo $usuario['telefone'];?>  <?php echo $usuario['celular'];?></td>
        <td colspan="4"><b>RG:</b>&nbsp;<?php echo $usuario['rg'];?></td>
    </tr>
    </tbody>
</table>
<div style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; height: 20px;"></div>
<table cellpadding="5" cellspacing="0" border="1"
       style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; width: 100%;float: left;">
    <tbody>
    <tr>
        <td colspan="6" align="center"><b>RELAÇÃO DE LOTES</b></td>
    </tr>
    <tr>
        <td><b>LOTE</b></td>
        <td><b>VL. ARREMATADO</b></td>
        <td><b>COMISSÃO</b></td>
        <td><b>DESPESAS</b></td>
        <td><b>VALOR TOTAL</b></td>
    </tr>
    <tr>
        <td><?php echo $lote['nlote'];?></td>
        <td>R$&nbsp;<?php echo @number_format($lote['lance_atual'],2,'.',',');?></td>
        <td>R$&nbsp;<?php echo @number_format((($lote['lance_atual'] / 100) * 5),2,'.',',');?></td>
        <td>R$&nbsp;220,00</td>
        <td>R$&nbsp;<?php echo number_format((($lote['lance_atual'] + (($lote['lance_atual'] / 100) * 5)) + 220),2,'.',',');?></td>
        <td>Arrematado</td>
    </tr>

    </tbody>
</table>
<div style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; padding: 10px;">

    <div class="clearfix"></div>
    <div style="padding-top: 0px;margin-top: 20px;"><b>VALOR TOTAL DOS ARREMATADOS:</b>&nbsp;R$&nbsp;<?php echo number_format((($lote['lance_atual'] + (($lote['lance_atual'] / 100) * 5)) + 220),2,'.',',');?></div>
</div>
<div style="font-family: Arial, Helvetica, sans-serif; padding: 5px 10px 0px; margin-top: 20px; border: 2px solid rgb(102, 102, 102);float: left;width: 99%;">
    <br><br>
    <div style="font-size: 22px; text-align: center;"><b>FORMA DE PAGAMENTO</b></div>
    <div style="padding-top: 15px;"><b>O pagamento deverá ser feito através de depósito, transferência ou TED, para a
            conta da leiloeira em até 1 dia útil</b></div>
    <br>
    <div style="padding-top: 15px; font-size: 20px; text-align: center;"><b>Dados para Depósito</b>&nbsp;<br>BANCO
        BRADESCO - 237&nbsp;<br>AG: 0849&nbsp;<br>CONTA CORRENTE: 21400-0&nbsp;<br>VIVIANE GARZON CORREA&nbsp;<br>CPF:
        002.330.006-07
    </div>
    <br><br>
    <div style="padding-top: 15px; font-size: 18px;"><b>VALOR TOTAL DO DEPÓSITO: R$&nbsp;<?php echo number_format((($lote['lance_atual'] + (($lote['lance_atual'] / 100) * 5)) + 220),2,'.',',');?></b></div>
    <div style="padding-top: 2px; font-size: 18px;"><b>RETIRADA: A retirada dos lotes deverá ser feita em até 3 dias
            úteis após arrematação</b></div>
    <div style="padding-top: 2px; padding-bottom: 10px; font-size: 18px;"><b>Horario de Retirada: 09:00 às 11:30 ou
            13:30 às 16:30</b></div>
    <div style="font-size: 20px;"><b>Em caso de desistência, deverá ser pago o valor referente a 20% do Lance.</b></div>
</div>
<div style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; padding: 35px 0px 15px; text-align: center;float: left;width: 100%;">
    __________________________________________________________________________
    <div>ASSINATURA</div>
</div>


</div>

<script>window.print();</script>