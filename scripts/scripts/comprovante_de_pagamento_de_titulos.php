<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>COMPROVANTE DE PAGAMENTO DE TITULOS</title>
<link href="css/comprovante_de_pagamento_de_titulos.css" rel="stylesheet" type="text/css" />
</head>

<body>
<? require "../conexao.php"; ?>

<div id="box">
<?
$code_boleto = $_GET['code_boleto'];
$verifica_pagador = 0;
$tarifa_recebimento = 0;
$boleto_vencido = 0;
$boleto_tarifado = 0;
$boleto_impresso = 0;
$valor_boleto = 0;
$verifica_tipo_de_pagamento = 0;

$total_pagamentos = 0;

$sql_vefica = mysqli_query($conexao_bd, "SELECT * FROM pagamento_boletos WHERE code_boleto = '$code_boleto' AND status != 'Cancelado'");
	while($res_verifica = mysqli_fetch_array($sql_vefica)){
	
  $sql_pagamentos = mysqli_query($conexao_bd, "SELECT * FROM pagamento_boletos_opcoes WHERE code_boleto = '".$_GET['code_boleto']."'");
	while($res_pagamentos = mysqli_fetch_array($sql_pagamentos)){
		if($res_pagamentos['forma_pagamento'] != 'DINHEIRO'){
			$verifica_tipo_de_pagamento = 1;
		}
		$total_pagamentos = $res_pagamentos['valor']+$total_pagamentos;
	}
	
	
	$tarifa_recebimento = $res_verifica['tarifa_recebimento'];
	$boleto_vencido = $res_verifica['boleto_vencido'];
	$boleto_tarifado = $res_verifica['boleto_tarifado'];
	$boleto_impresso = $res_verifica['boleto_impresso'];
	$valor = $res_verifica['valor'];
	$valor_recebido = $res_verifica['valor_recebido'];
	
			
	if($valor <=500){
		$verifica_pagador = 1;
	}elseif($valor > 1000){
		$verifica_pagador = 1;
	}elseif($tarifa_recebimento > 0){
		$verifica_pagador = 1;
	}elseif($boleto_tarifado > 0){
		$verifica_pagador = 1;
	}else{
		$verifica_pagador = 0;
	}
			
?>
<? if($total_pagamentos < $valor_recebido){ echo "ESTE BOLETO NÃO FOI PAGO COMPLETAMENTE, POR FAVOR, REFAÇA O PAGAMENTO POIS O MESMO NÃO SERÁ PROCESSADO!"; }else{?>
<script language="javascript">window.print();</script>

<table width="300" border="0">
  <tr>
    <td align="center" colspan="3">
    <strong>
	<? if($verifica_pagador == 1){ echo "RECARGAPAY"; }else{ echo "REDE MAIS VOC&Ecirc;"; } ?>
    </strong></td>
  </tr>
  <tr>
    <td colspan="3" align="center"><p>Via Cliente</p>
    <p>
	<? if($verifica_pagador == 1){ echo "ARGENTE: 2231474"; }else{ echo "VESTE PRIME VESTU&Aacute;RIO E ACESS&Oacute;RIOS DE CELULARES"; ?></p></td>
  </tr>
  <tr>
    <td width="109" align="center">Pos 74419001</td>
    <td width="104" align="center">LT: 62 Doc:13</td>
    <td width="73" align="center">Oper:174419</td>
  </tr>
  <tr>
    <td align="center" colspan="3"><? echo date("d/m/Y H:i:s"); }?><br />
      -------------------------------------------------------------------------</td>
  </tr>
  <? if($verifica_pagador == 1){ }else{ ?>
  <tr>
    <td>COBAN: 074419</td>
    <td>LOJA: 0001</td>
    <td>PDV: 000001</td>
  </tr>
  <? } ?>
  <tr>
    <td align="center" colspan="3">
	<? if($verifica_pagador == 1){ }else{ ?>
	<? echo date("d/m/Y"); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;     
    - 
    <? } ?>
    <? echo $data_completa; ?><br />
	 <? if($verifica_pagador == 0){ }else{ ?>
        &nbsp;&nbsp;&nbsp;&nbsp;
    <? } ?>    
     <? if($verifica_pagador == 1){ echo " BANCO RENDIMENTO "; }else{ echo " BANCO DO BRASIL "; } ?>
    <br />
    </td>
  </tr>
  <tr>
    <td align="center" colspan="3">262241901 CORRESPONDE BANC&Aacute;RIO 0034</td>
  </tr>
  <tr>
    <td colspan="3">==========================================<br />
    <p>
    <? if($res_verifica['tipo'] == 'BOLETO'){ ?> COMPROVANTE DE PAGAMENTO DE TITULOS <? }else{ ?> COMPROVANTE DE RECEBIMENTO DE CONVÊNIO  <? } ?>
    </p>
    ==========================================<br />
    </td>
  </tr>
  <tr>
    <td colspan="3"> <? if($res_verifica['tipo'] == 'BOLETO'){ ?><? }else{ ?> CONVÊNIO <? } ?></td>
  </tr>
  <tr>
    <td colspan="3">
	 <?
	  if($res_verifica['tipo'] == 'BOLETO'){
	  $sql_banco = mysqli_query($conexao_bd, "SELECT * FROM lista_bancos WHERE codigo = '".$res_verifica['banco']."'");
		while($res_banco = mysqli_fetch_array($sql_banco)){
					echo strtoupper($res_banco['nome_banco']);
			}
     }else{ 
	 	echo strtoupper($res_verifica['banco']); 
	 } 
	 ?>
    </td>
  </tr>
  <tr>
    <td colspan="3"><? echo $res_verifica['code_barras']; ?><br /> 
            -------------------------------------------------------------------------
      </td>
  </tr>
  <tr>
    <td colspan="2">NR. DOCUMENTO</td>
    <td>10.001</td>
  </tr>
  <? if($res_verifica['tipo'] == 'BOLETO'){ ?>
  <tr>
    <td colspan="2">DATA DE VENCIMENTO</td>
    <td><? echo $res_verifica['vencimento']; ?></td>
  </tr>
  <? } ?>
  <tr>
    <td colspan="2">DATA DO PAGAMENTO</td>
    <td><? 
	
	  $dia_pagamento = date("d/m/Y");
	  $sql_pagamento = mysqli_query($conexao_bd, "SELECT * FROM datas_pagamento_contas WHERE dia = '$dia_pagamento'");
	  if(mysqli_num_rows($sql_pagamento) == ''){
		  echo $dia_pagamento = date("d/m/Y");
	  }else{
		  while($res_pagamento = mysqli_fetch_array($sql_pagamento)){
			 echo $dia_pagamento = $res_pagamento['proximo_dia'];
	   }
	  }	
	
	 ?></td>
  </tr>
  <tr>
    <td colspan="2">VLR DOCUMENTO</td>
    <td><? echo @number_format($valor, 2, ',', '.'); ?></td>
  </tr>
  <? if($res_verifica['tipo'] == 'BOLETO'){ ?>
  <tr>
    <td colspan="2">JUROS/MULTA</td>
    <td><? echo @number_format($res_verifica['juros']+$res_verifica['boleto_vencido']+0, 2, ',', '.'); ?></td>
  </tr>
  <tr>
    <td colspan="2">DESCONTO</td>
    <td><? echo @number_format($res_verifica['desconto']+0, 2, ',', '.'); ?></td>
  </tr>
  <? } ?>
  <tr>
    <td colspan="2">VALOR COBRADO</td>
    <td><? echo @number_format(($res_verifica['valor']+$res_verifica['juros']+$res_verifica['boleto_vencido'])-$res_verifica['desconto'], 2, ',', '.'); ?></td>
  </tr>
  <tr>
    <td colspan="3">-------------------------------------------------------------------------</td>
  </tr>
  <tr>
    <td colspan="3">NR. AUTENTICA&Ccedil;&Atilde;O 
      <?
	$nr_autenciacao = md5(date("d/m/Y H:i:s"));
	
	$n = date("s");
	echo $n[0];
	echo ".";
	echo strtoupper($nr_autenciacao[0]);
	echo strtoupper($nr_autenciacao[1]);
	echo strtoupper($nr_autenciacao[2]);
	echo ".";
	echo strtoupper($nr_autenciacao[3]);
	echo strtoupper($nr_autenciacao[4]);
	echo strtoupper($nr_autenciacao[5]);
	echo ".";
	echo strtoupper($nr_autenciacao[6]);
	echo strtoupper($nr_autenciacao[7]);
	echo strtoupper($nr_autenciacao[8]);
	echo ".";
	echo strtoupper($nr_autenciacao[9]);
	echo strtoupper($nr_autenciacao[10]);
	echo strtoupper($nr_autenciacao[11]);
	echo ".";
	echo strtoupper($nr_autenciacao[12]);
	echo strtoupper($nr_autenciacao[13]);
	echo strtoupper($nr_autenciacao[14]);
	?></td>
    </tr>
</table>




<br /><br />
<br />
<? if($res_verifica['tarifa_recebimento'] == '1' || $res_verifica['boleto_vencido'] == '1' || $verifica_tipo_de_pagamento == '1' || $res_verifica['boleto_impresso'] == '1'){ ?>
<table width="300" border="1" style="page-break-before: always;">
  <tr>
    <td colspan="3" align="center" bgcolor="#0033CC"><h1><img src="../img/logo.png" width="270" height="123" /></h1> 
      <h2>RELAT&Oacute;RIO DE PAGAMENTO<br /><?  echo date("d/m/Y H:i:s");?><br />
    </h2>
  </td>
  </tr>
  <tr>
    <td align="center" colspan="5" bgcolor="#CCCCCC"><strong>      VESTE PRIME - VESTU&Aacute;RIO E ACESS&Oacute;RIOS DE CELULARES
  </strong><br />
      CNPJ: 32.450.862/0001-02 <br />
      Rua Capit&atilde;o In&aacute;cio Prata - 2010 - Taiba <br />
      S&atilde;o Gon&ccedil;alo do Amarante - Cear&aacute; <br />
  <strong>CEP: </strong>62670-000 <br />
  <strong>CONTATO: </strong>(85) 3315.6199 / 99158.7323</td>
  </tr>
  <tr>
    <td align="center" colspan="3"><strong>DESCRI&Ccedil;&Atilde;O DO PAGAMENTO</strong></td>
  </tr>
  <tr>
    <td colspan="2" align="center" bgcolor="#F0F0F0"><strong>DESCRI&Ccedil;&Atilde;O</strong></td>
    <td align="center" bgcolor="#F0F0F0"><strong>VALOR</strong></td>
  </tr>
  <?
  $sql_boleto = mysqli_query($conexao_bd, "SELECT * FROM pagamento_boletos WHERE code_boleto = '".$_GET['code_boleto']."'");
  	while($res_boleto = mysqli_fetch_array($sql_boleto)){
  ?>
  <tr>
    <td colspan="2" align="left">VALOR DO BOLETO</td>
    <td align="center"><? echo number_format(($res_boleto['valor']+$res_boleto['juros'])-$res_boleto['desconto'], 2, ',', '.'); ?></td>
  </tr>
  <tr>
    <td colspan="2" align="left">VALOR DA IMPRESS&Atilde;O</td>
    <td align="center"><? echo number_format($res_boleto['boleto_impresso'], 2, ',', '.'); ?></td>
  </tr>
  <tr>
    <td colspan="2" align="left">BOLETO VENCIDO</td>
    <td align="center"><? echo number_format($res_boleto['boleto_vencido'], 2, ',', '.'); ?></td>
  </tr>
  <tr>
    <td colspan="2" align="left">BOLETO P/AUTO AUTOATENDIMENTO</td>
    <td align="center"><? echo number_format($res_boleto['boleto_tarifado'], 2, ',', '.'); ?></td>
  </tr>
  <tr>
    <td colspan="2" align="right"><strong>VALOR A RECEBER R$</strong></td>
    <td align="center"><? echo number_format($res_boleto['valor_recebido'], 2, ',', '.'); ?></td>
    </tr>
  <? } ?>
  <tr>
    <td colspan="3" align="center" bgcolor="#F0F0F0"><strong>HIST&Oacute;RICO DE PAGAMENTOS</strong></td>
  </tr>
  <?
  $total_pagamentos = 0;
  $sql_pagamentos = mysqli_query($conexao_bd, "SELECT * FROM pagamento_boletos_opcoes WHERE code_boleto = '".$_GET['code_boleto']."'");
  ?>
  <tr>
    <td align="center" width="62"><strong>VALOR</strong></td>
    <td align="center" width="157"><strong>FORMA DE PAGAMENTO</strong></td>
    <td align="center" width="59"><strong>TROCO</strong></td>
  </tr>
  <?  while($res_pagamentos = mysqli_fetch_array($sql_pagamentos)){ ?>
  <tr>
    <td align="center">R$ <? echo number_format($res_pagamentos['valor'], 2, ',', '.'); $total_pagamentos = $res_pagamentos['valor']+$total_pagamentos; ?></td>
    <td align="center"><? echo $res_pagamentos['forma_pagamento']; ?></td>
    <td align="center">R$ <? echo number_format($res_pagamentos['troco'], 2, ',', '.') ?></td>
  </tr>
  <? } ?>
  <tr>
    <td colspan="3" align="center"><strong>VALOR RECEBIDO</strong></td>
    </tr>
  <tr>
    <td colspan="3" align="center"><br />R$ <? echo number_format($total_pagamentos, 2, ',', '.'); ?>*<hr />*O valor recebido mostrado acima <strong>NÃO</strong> informa os <strong>JUROS</strong> relativos ao parcelamento nos cartões de crédito a qual o mesmo deve ser consultado no momento do pagamento.</td>
  </tr>
  <tr>
    <td colspan="3" align="center" bgcolor="#FFFFFF"><p><strong>CÓDIGO DE CONTROLE INTERNO</strong><br /><? echo strtoupper(md5($_GET['cliente']+$_GET['valor'])); ?></p></td>
  </tr>
  <tr>
    <td colspan="3" align="justify" bgcolor="#FFFFFF"><strong>OBSERVA&Ccedil;&Otilde;ES DO PAGAMENTO</strong>
      <ul>
        <li>O pagamento pode demorar at&eacute; 5 dias &uacute;teis (sem contar sabádos, domingos e feriados), para ser reconhecido pela empresa.</li>
        <li>Pagamentos realizados ap&oacute;s as 15 horas poder&aacute; ser processados somente no pr&oacute;ximo dia &uacute;til.</li>
        <li>O pagamento &eacute; processado pela Rede Mais Voc&ecirc; em parceria com o Banco do Brasil ou Banco Rendimento em parceria com a RecargaPay.</li>
      </ul>
      <hr />
      <p>O comprovante de quita&ccedil;&atilde;o de pagamento pode ser retirado 1 dia &uacute;til ap&oacute;s o vencimento neste corresponde banc&aacute;rio.</p></td>
  </tr>
</table>
<? }}} ?>

</div><!-- box -->
</body>
</html>