<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>COMPROVANTE DE PAGAMENTO DE TITULOS</title>
<link href="css/comprovante_de_pagamento_de_titulos.css" rel="stylesheet" type="text/css" />
</head><script language="javascript">window.print();</script>
<body>
<div id="box">
<? require "../config.php"; ?>

<? $code_conjunto = $_GET['code_conjunto']; ?>

<? if($code_conjunto >= 1){ ?>
<?

$valor_total = 0;
$sql_conjunto = mysqli_query($conexao_bd, "SELECT * FROM pagamentoboletos	WHERE conjunto = '$code_conjunto' AND status != 'CANCELADO'");
while($res_conjunto = mysqli_fetch_array($sql_conjunto)){
	$valor_total = $valor_total+$res_conjunto['valor_recebido'];
}

$soma_pagamento = 0;
$sql_pagamentos = mysqli_query($conexao_bd, "SELECT * FROM pagamento_boletos_opcoes WHERE conjunto = '$code_conjunto'");
	while($res_pagamentos = mysqli_fetch_array($sql_pagamentos)){
		$soma_pagamento = $soma_pagamento+$res_pagamentos['valor'];
}

if($valor_total <= $soma_pagamento){

$sql_conjunto = mysqli_query($conexao_bd, "SELECT * FROM pagamentoboletos WHERE conjunto = '$code_conjunto' AND status != 'CANCELADO'");
while($res_conjunto = mysqli_fetch_array($sql_conjunto)){

$code_boleto = $res_conjunto['code_boleto'];
$verifica_pagador = 0;
$tarifa_recebimento = 0;
$boleto_vencido = 0;
$boleto_tarifado = 0;
$boleto_impresso = 0;
$valor_boleto = 0;
$verifica_tipo_de_pagamento = 0;

$total_pagamentos = 0;

mysqli_query($conexao_bd, "INSERT INTO verifica_efetivado (data, data_completa, ip, code_boleto, code_conjunto, operador) VALUES ('$data', '$data_completa', '$ip', '$code_boleto', '$code_conjunto', '$operador')");


$sql_vefica = mysqli_query($conexao_bd, "SELECT * FROM pagamentoboletos WHERE code_boleto = '$code_boleto' AND status != 'CANCELADO'");
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
	
			
	if($valor <=100){
		$verifica_pagador = 1;
	}elseif($valor > 3000){
		$verifica_pagador = 1;
	}elseif($tarifa_recebimento > 0){
		$verifica_pagador = 1;
	}elseif($boleto_tarifado > 0){
		$verifica_pagador = 1;
	}else{
		$verifica_pagador = 0;
	}
	
	
	if($res_verifica['banco'] == 'DAE ESTADO CEARA'){ $verifica_pagador = 1; }else{$verifica_pagador = 0;}
			
?>

<table width="300" border="0" style="page-break-before: always;">
  <tr>
    <td align="center" colspan="3">
    <strong><? if($verifica_pagador == 1){ }else{ } ?></strong><br />Identificador: <? echo $res_verifica['id']; ?></td>
  </tr>
  <tr>
    <td colspan="3" align="center"><p>Via Cliente<br /><br />Identificador: <? echo $res_verifica['id']; ?></p>
    <p><? if($verifica_pagador == 1){ echo "AGENTE: 2231474"; }else{ echo "AGENTE: 2231474"; ?></p></td>
  </tr>
  <tr>
    <td width="109" align="center">Pos 2587423</td>
    <td width="104" align="center">LT: 62 Doc:13</td>
    <td width="73" align="center">Oper:951753</td>
  </tr>
  <tr>
    <td align="center" colspan="3"><? echo date("d/m/Y H:i:s"); }?><br />
      -------------------------------------------------------------------------</td>
  </tr>
  <? if($verifica_pagador == 1){ }else{ ?>
  <tr>
    <td>COBS: 3217456</td>
    <td>LOJA: 0008</td>
    <td>PDV: 850001</td>
  </tr>
  <? } ?>
  <tr>
    <td align="center" colspan="3">
	<? if($verifica_pagador == 1){ }else{ ?>
	<? echo date("d/m/Y"); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;     
    - 
    <? } ?>
    </td>
  </tr>
  <tr>
    <td colspan="3">==========================================<br />
    <p>
    <? if($res_verifica['tipo'] == 'BOLETO'){ ?> RECIBO SIMPLES NÃO BANCÁRIO <? }else{ ?> RECIBO SIMPLES NÃO BANCÁRIO  <? } ?>
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
  <? } ?>
  <tr>
    <td colspan="2">VALOR COBRADO</td>
    <td><? echo @number_format(($res_verifica['valor']+$res_verifica['juros']+$res_verifica['boleto_vencido'])-$res_verifica['desconto'], 2, ',', '.'); ?></td>
  </tr>
  <tr>
    <td colspan="3">-------------------------------------------------------------------------</td>
  </tr>
  <tr>
    <td colspan="3">CONTROLE INTERNO
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
	?><br />
     *Recibo simples, não é comprovante bancário, se precisar do comprovante de pagamento bancário ou 2° via, pode solicitar pelo (85) 99158.7323
    </td>
    </tr>
</table>

<? $codigo_produto = $res_verifica['code_boleto']; $tipo_servico = "PAGAMENTO DE CONTAS"; require "gerar_cupom_sorteio.php"; ?>

<? }}} ?>

<table width="300" border="0" style="page-break-before: always;">
  <tr>
    <td colspan="3" bgcolor="#CCCCCC"><strong>RELATÓRIO DE TRASAÇÃO</strong></td>
  </tr>
  <tr>
    <td width="23"><strong>ID</strong></td>
    <td width="167"><strong>INST. EMISSOR</strong></td>
    <td width="96"><strong>VALOR</strong></td>
  </tr>
<? $valor_total = 0; $i = 0;
$sql_conjunto = mysqli_query($conexao_bd, "SELECT * FROM pagamentoboletos WHERE conjunto = '$code_conjunto' AND status != 'CANCELADO'");
while($res_conjunto = mysqli_fetch_array($sql_conjunto)){ $i++;
	$valor_total = $valor_total+($res_conjunto['valor']+$res_conjunto['juros']-$res_conjunto['desconto']);
?>  
  <tr>
    <td><? echo $i; ?></td>
    <td><? echo $res_conjunto['banco']; ?></td>
    <td>R$ <? echo number_format($res_conjunto['valor']+$res_conjunto['juros']-$res_conjunto['desconto'],2,',','.'); ?></td>
  </tr>
<? } ?>
  <tr>
    <td align="right" colspan="2"><strong>TOTAL</strong></td>
    <td>R$ <? echo number_format($valor_total,2,',','.'); ?></td>
  </tr>
</table>

<? }else{ ?>





<?
$code_boleto = $_GET['code_boleto'];
$verifica_pagador = 0;
$tarifa_recebimento = 0;
$boleto_vencido = 0;
$boleto_tarifado = 0;
$boleto_impresso = 0;
$valor_boleto = 0;
$verifica_tipo_de_pagamento = 0;


mysqli_query($conexao_bd, "INSERT INTO verifica_efetivado (data, data_completa, ip, code_boleto, code_conjunto, operador) VALUES ('$data', '$data_completa', '$ip', '$code_boleto', '$code_conjunto', '$operador')");



$total_pagamentos = 0;

$sql_vefica = mysqli_query($conexao_bd, "SELECT * FROM pagamentoboletos WHERE code_boleto = '$code_boleto' AND status != 'Cancelado'");
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
	
			
	if($valor <=100){
		$verifica_pagador = 1;
	}elseif($valor > 3000){
		$verifica_pagador = 1;
	}elseif($tarifa_recebimento > 0){
		$verifica_pagador = 1;
	}elseif($boleto_tarifado > 0){
		$verifica_pagador = 1;
	}else{
		$verifica_pagador = 0;
	}
	
	
	if($res_verifica['banco'] == 'DAE ESTADO CEARA'){ $verifica_pagador = 1; }else{$verifica_pagador = 0;}
			
?>
<table width="300" border="0">
  <tr>
    <td align="center" colspan="3">
    <strong>
	<? if($verifica_pagador == 1){ }else{ } ?>
    </strong></td>
  </tr>
  <tr>
    <td colspan="3" align="center"><p>Via Cliente<br /><br />Identificador: <? echo $res_verifica['id']; ?></p>
    <p>
	<? if($verifica_pagador == 1){ echo "AGENTE: 2231474"; }else{ echo "AGENTE: 2231474"; ?></p></td>
  </tr>
  <tr>
    <td width="109" align="center">Pos 98745</td>
    <td width="104" align="center">LT: 35 Doc:78</td>
    <td width="73" align="center">Oper:66222</td>
  </tr>
  <tr>
    <td align="center" colspan="3"><? echo date("d/m/Y H:i:s"); }?><br /></td>
  </tr>
  <tr>
    <td colspan="3">==========================================<br />
    <p>
    <? if($res_verifica['tipo'] == 'BOLETO'){ ?> RECIBO SIMPLES NÃO BANCÁRIO <? }else{ ?> RECIBO SIMPLES NÃO BANCÁRIO  <? } ?>
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
  <? } ?>
  <tr>
    <td colspan="2">VALOR COBRADO</td>
    <td><? echo @number_format(($res_verifica['valor']+$res_verifica['juros']+$res_verifica['boleto_vencido'])-$res_verifica['desconto'], 2, ',', '.'); ?></td>
  </tr>
  <tr>
    <td colspan="3">-------------------------------------------------------------------------</td>
  </tr>
  <tr>
    <td colspan="3">CONTROLE INTERNO 
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
	?>
    <br />
    *Recibo simples não bancário, se precisar do comprovante de pagamento bancário ou 2° via, pode solicitar pelo (85) 99158.7323
    </td>
    </tr>
</table>

<? $codigo_produto = $_GET['code_boleto']; $tipo_servico = "PAGAMENTO DE CONTAS"; require "gerar_cupom_sorteio.php"; ?>
<? }} ?>
<br /><br />
<br />
</div><!-- box -->
</body>
</html>