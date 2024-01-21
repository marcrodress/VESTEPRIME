<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>FORMULÁRIO DE FECHAMENTO DE CAIXA</title>
<link href="css/imprimir_formulario_de_fechamento_de_caixa.css" rel="stylesheet" type="text/css" />
</head>

<body>
<? require "../config.php"; ?>


<div id="box">
<table width="1000" border="0">
  <tr>
    <td width="134"><img src="../img/index.png" width="134" height="95" /></td>
    <td width="445" colspan="2" align="center" bgcolor="#CCCCCC"><strong>FORMUL&Aacute;RIO PARA FECHAMENTO DE CAIXA</strong></td>
  </tr>
</table>


<?

$soma_caixa_inicial = 0;
$id_do_caixa = 0;

$sql_abertura = mysqli_query($conexao_bd, "SELECT * FROM abertura_de_caixa WHERE operador = '$operador' AND status = 'Aberto' ORDER BY id DESC LIMIT 1");
 while($res_abertura = mysqli_fetch_array($sql_abertura)){
	 
$id_do_caixa =  $res_abertura['id'];
	 
$soma_caixa_inicial = $res_abertura['valor_caixa']+$soma_caixa_inicial;
	 
?>
<table width="1000" border="0">
  <tr>
    <td align="center" colspan="6"><hr /><strong>OPERADOR: <? echo strtoupper($nome); ?>  <br />DATA DE ABERTURA: <? echo $res_abertura['dada_completa']; ?></strong><hr /></td>
  </tr>
  <tr>
    <td><strong>SALDO MAQUINA BB</strong></td>
    <td><strong>NOTAS DE R$ 100,00</strong></td>
    <td><strong>NOTAS DE R$ 50,00</strong></td>
    <td><strong>NOTAS DE R$ 20,00</strong></td>
    <td><strong>NOTAS DE R$ 10,00</strong></td>
    <td><strong>NOTAS DE R$ 5,00</strong></td>
  </tr>
  <tr>
    <td>R$ <? echo number_format($res_abertura['saldaobb'], 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($res_abertura['notas100']*100, 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($res_abertura['notas50']*50, 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($res_abertura['notas20']*20, 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($res_abertura['notas10']*10, 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($res_abertura['notas5']*5, 2, ',', '.'); ?></td>
  </tr>
  <tr>
    <td><strong>NOTAS DE R$ 2,00</strong></td>
    <td><strong>MOEDAS DE R$ 1,00</strong></td>
    <td><strong>MOEDAS DE R$ 0,50</strong></td>
    <td><strong>MOEDAS DE R$ 0,25</strong></td>
    <td><strong>MOEDAS DE R$ 0,10</strong></td>
    <td><strong>MOEDAS DE 0,05</strong></td>
  </tr>
  <tr>
    <td>R$ <? echo number_format($res_abertura['notas2']*2, 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($res_abertura['moeda1']*1, 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($res_abertura['moeda50']*0.5, 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($res_abertura['moeda25']*0.25, 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($res_abertura['moeda10']*0.1, 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($res_abertura['moeda5']*0.05, 2, ',', '.'); ?></td>
  </tr>
  <tr>
    <td><strong>SALDO BANCO DO BRASIL</strong></td>
    <td><strong>SALDO BANCO INTER</strong></td>
    <td><strong>SALDO RECARGAPAY</strong></td>
    <td><strong>SALDO MERCADOPAGO</strong></td>
    <td><strong>SALDO CELCOIN</strong></td>
    <td><strong>PIC PAY</strong></td>
  </tr>
  <tr>
    <td>R$ <? echo number_format($res_abertura['bb'], 2, ',', '.'); ?></td>
    <td>R$ <? echo @number_format($res_abertura['bancointer'], 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($res_abertura['recargapay'], 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($res_abertura['mercadopago'], 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($res_abertura['celcoin'], 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($res_abertura['picpay'], 2, ',', '.'); ?></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#FFEADF" colspan="6"><hr /><strong>DINHEIRO INICIAL EM CAIXA</strong> <br />R$ 
	<? 
	
	$caixa_inicial = ($res_abertura['notas100']*100)+($res_abertura['notas50']*50)+($res_abertura['notas20']*20)+($res_abertura['notas10']*10)+($res_abertura['notas5']*5)+($res_abertura['notas2']*2)+($res_abertura['moeda1']*1)+($res_abertura['moeda50']*0.5)+($res_abertura['moeda25']*0.25)+($res_abertura['moeda10']*0.1)+($res_abertura['moeda5']*0.05);
	
	echo number_format($caixa_inicial, 2, ',', '.'); 
	
	?></td>
  </tr>
</table>
<? } ?>

<h2><strong>1º Fechamento de pagamentos de títulos e convênio</strong></h2>
<?
$valor_dinheiro = 0;
$valor_cartao_debito = 0;
$valor_cartao_credito = 0;
$valor_vesteprime = 0;
$valor_vale_transporte = 0;
$total = 0;
$code_boleto = 0;
$sql_boletos = mysqli_query($conexao_bd, "SELECT * FROM pagamento_boletos WHERE operador = '$operador' AND data = '$data'");
while($res_boletos = mysqli_fetch_array($sql_boletos)){
	
	$code_boleto = $res_boletos['code_boleto'];
	
  if($res_boletos['status'] != 'CANCELADO'){
	  $total++;
   
   $sql_busca_pagamentos = mysqli_query($conexao_bd, "SELECT * FROM pagamento_boletos_opcoes WHERE code_boleto = '$code_boleto'");
   	while($res_pagamento = mysqli_fetch_array($sql_busca_pagamentos)){ 
	  
	if($res_pagamento['forma_pagamento'] == 'CARTAO DE CREDITO'){
	$valor_cartao_credito = $res_pagamento['valor_transacao']+$valor_cartao_credito;
	}elseif($res_pagamento['forma_pagamento'] == 'VESTE PRIME'){
	$valor_vesteprime = $res_pagamento['valor_transacao']+$valor_vesteprime;
	}elseif($res_pagamento['forma_pagamento'] == 'DINHEIRO'){
	$valor_dinheiro = $res_pagamento['valor_transacao']+$valor_dinheiro;
	}elseif($res_pagamento['forma_pagamento'] == 'VALE ALIMENTACAO'){
	$valor_vale_transporte = $res_pagamento['valor_transacao']+$valor_vale_transporte;	
	}elseif($res_pagamento['forma_pagamento'] == 'CARTAO DE DEBITO'){
	$valor_cartao_debito = $res_pagamento['valor_transacao']+$valor_cartao_debito;
	}
   }
 } // fecha o while
}
?>
<table width="1000" border="0">
  <tr>
    <td colspan="5" bgcolor="#CCCCCC"><strong>Foram recebidos <? echo $total; ?> titulos para pagamento</strong></td>
  </tr>
  <tr>
    <td align="center" width="223"><strong>Dinheiro:</strong></td>
    <td width="239" align="center"><strong>Cartão de débito:</strong></td>
    <td width="239" align="center"><strong>VT:</strong></td>
    <td width="254" align="center"><strong>Cartão de crédito:</strong></td>
    <td width="256" align="center"><strong>Veste Prime Card</strong></td>
  </tr>
  <tr>
    <td align="center">R$ <? echo number_format($valor_dinheiro, 2, ',', '.'); ?></td>
    <td align="center">R$ <? echo number_format($valor_cartao_debito, 2, ',', '.'); ?></td>
    <td align="center">R$ <? echo number_format($valor_vale_transporte, 2, ',', '.'); ?></td>
    <td align="center">R$ <? echo number_format($valor_cartao_credito, 2, ',', '.'); ?></td>
    <td align="center">R$ <? echo number_format($valor_vesteprime, 2, ',', '.'); ?></td>
  </tr>
  <tr>
    <td colspan="5" align="center"><table width="990" border="0">
      <tr>
        <td align="center" width="74" bgcolor="#66CC00"><strong>TIPO</strong></td>
        <td width="132" align="center" bgcolor="#66CC00"><strong>EMISSOR</strong></td>
        <td bgcolor="#66CC00" align="center"><strong>C&Oacute;DIGO DE BARRAS</strong></td>
        <td bgcolor="#66CC00" align="center"><strong>VALOR</strong></td>
        <td align="center" bgcolor="#66CC00"><strong>JUROS</strong></td>
        <td width="108" align="center" bgcolor="#66CC00"><strong>TARIFAS EXTRAS</strong></td>
        <td colspan="2" align="center" bgcolor="#66CC00"><strong>VALOR TOTAL</strong></td>
        </tr>
      <?
      $code_boleto = 0;  $i = 0;
	  $puxa_faturas = mysqli_query($conexao_bd, "SELECT * FROM pagamento_boletos WHERE data = '$data' AND status != 'CANCELADO' AND operador = '$operador'");
	  	while($res_fatura = mysqli_fetch_array($puxa_faturas)){
	  			$code_boleto = $res_fatura['code_boleto'];
	  ?>
      <tr <? if($i%2 == 0){ echo "bgcolor='#CCCCCC'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
        <td align="center" ><? echo $res_fatura['tipo']; ?></td>
        <td align="center" ><? echo $res_fatura['banco']; ?></td>
        <td align="center" width="393"><? echo $res_fatura['code_barras']; ?></td>
        <td align="center" width="77">R$ <? echo number_format($res_fatura['valor'], 2, ',', '.'); ?></td>
        <td align="center" width="69">R$ <? echo number_format($res_fatura['juros'], 2, ',', '.'); ?></td>
        <td align="center" >R$ <? echo $tarifas = number_format($res_fatura['tarifa_recebimento']+$res_fatura['boleto_vencido']+$res_fatura['boleto_impresso']+$res_fatura['boleto_tarifado'], 2, ',', '.'); ?></td>
        <td align="center" colspan="2">R$ <? echo number_format($tarifas+$res_fatura['juros']+$res_fatura['valor'], 2, ',', '.'); ?></td>
        </tr>
      <tr>
        <td colspan="2"><strong>STATUS DA EFETIVAÇÃO:</strong> <? echo $res_fatura['status']; ?></td>
        <td>&nbsp;</td>
        <td colspan="5" bgcolor="#BBFFBB"><strong>RESUMO DE PAGAMENTO</strong></td>
        </tr>
      <?
	  $pagamento_opcoes = mysqli_query($conexao_bd, "SELECT * FROM pagamento_boletos_opcoes WHERE code_boleto = '$code_boleto'");
	  	while($res_opcoes = mysqli_fetch_array($pagamento_opcoes)){
      ?>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="4"><? echo $res_opcoes['forma_pagamento']; ?></td>
        <td width="99"><? echo number_format($res_opcoes['valor_transacao'], 2, ',', '.'); ?></td>
      </tr>
      <? }} ?>
    </table>
    </td>
   
    </tr>
</table>
<hr /><h2><strong>2º Fechamento de venda de produtos</strong></h2>
<?
$carrinho_dinheiro = 0;
$carrinho_cartao_debito = 0;
$carrinho_cartao_credito = 0;
$carrinho_vesteprime = 0;
$total_produtos = 0;

$conta_produtos = mysqli_query($conexao_bd, "SELECT * FROM produtos_caixa WHERE data = '$data' AND operador = '$operador'");
	while($res_produtos = mysqli_fetch_array($conta_produtos)){
		$total_produtos = $res_produtos['quant']+$total_produtos;
	}


$sql_produtos = mysqli_query($conexao_bd, "SELECT * FROM pagamento_carrinho WHERE data = '$data' AND operador = '$operador'");
while($res_produtos = mysqli_fetch_array($sql_produtos)){
	if($res_produtos['form_pag'] == 'CARTÃO DE CRÉDITO'){
	$carrinho_cartao_credito = $res_produtos['valor_total']+$carrinho_cartao_credito;
	}elseif($res_produtos['form_pag'] == 'VESTE PRIME'){
	$carrinho_vesteprime = ($res_produtos['quant_parcelas']*$res_produtos['valor_parcela'])+$carrinho_vesteprime;
	}elseif($res_produtos['form_pag'] == 'DINHEIRO'){
	$carrinho_dinheiro = $res_produtos['valor_total']+$carrinho_dinheiro;
	}elseif($res_produtos['form_pag'] == 'CARTÃO DE DÉBITO'){
	$carrinho_cartao_debito = $res_produtos['valor_total']+$carrinho_cartao_debito;
	}
 } // fecha o while
?>
<table width="1000" border="0">
  <tr>
    <td colspan="4" bgcolor="#CCCCCC"><strong>DISTRIBUIÇÃO DA VENDA DE PROUTOS E/OU SERVIÇOS</strong><br />
     Foram vendidos <? echo $total_produtos; ?> produtos
    </td>
  </tr>
  <tr>
    <td width="203"><strong>DINHEIRO</strong></td>
    <td width="279"><strong>CARTÃO DE DÉBITO</strong></td>
    <td width="212"><strong>CARTÃO DE CRÉDITO</strong></td>
    <td width="278"><strong>VESTE PRIME CARD</strong></td>
  </tr>
  <tr>
    <td>R$ <? echo number_format($carrinho_dinheiro, 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($carrinho_cartao_debito, 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($carrinho_cartao_credito, 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($carrinho_vesteprime, 2, ',', '.'); ?></td>
  </tr>
  <tr>
    <td colspan="4"><table width="995" border="0">
      <tr>
        <td align="center" width="106" bgcolor="#66CC00"><strong>COD. CARRINHO</strong></td>
        <td align="center" width="119" bgcolor="#66CC00"><strong>CLIENTE</strong></td>
        <td align="center" width="102" bgcolor="#66CC00"><strong>COD. PRODUTO</strong></td>
        <td align="left" width="306" bgcolor="#66CC00"><strong>PRODUTO</strong></td>
        <td align="center" width="76" bgcolor="#66CC00"><strong>QUANT.</strong></td>
        <td align="center" width="78" bgcolor="#66CC00"><strong>VALOR</strong></td>
        <td align="center" width="88" bgcolor="#66CC00"><strong>TIPO</strong></td>
        <td align="center" width="86" bgcolor="#66CC00"><strong>STATUS</strong></td>
      </tr>
     <?
     $i = 0;
	 $puxa_produtos = mysqli_query($conexao_bd, "SELECT * FROM produtos_caixa WHERE operador = '$operador' AND data = '$data'");
	 	while($res_produto = mysqli_fetch_array($puxa_produtos)){ $i++;
	 ?>
  	   <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
        <td align="center"><? echo $res_produto['code_carrinho']; ?></td>
        <td align="center"><? echo $res_produto['cliente']; ?></td>
        <td align="center"><? echo $res_produto['code_produto']; ?></td>
        <td align="left">
     <?
     
	 $mostra_produto = mysqli_query($conexao_bd, "SELECT * FROM produtos WHERE code = '".$res_produto['code_produto']."'");
	 	while($res_mostra_produto = mysqli_fetch_array($mostra_produto)){
			echo strtoupper($res_mostra_produto['titulo_resumido']);
		}
	 ?>
        </td>
        <td align="center"><? echo $res_produto['quant']; ?></td>
        <td align="center"><? echo number_format($res_produto['valor'], 2, ',', '.'); ?></td>
        <td align="center"><? echo $res_produto['tipo']; ?></td>
        <td align="center"><? echo $res_produto['status']; ?></td>
      </tr>
     <? } ?>
    </table></td>
  </tr>
  </table>
<hr /><h2><strong>3º Fechamento de empréstimos</strong></h2>
<?
$valor_caixa = 0;
$valor_ted = 0;
$valor_doc = 0;

$valor_caixa_transacao = 0;
$valor_ted_transacao = 0;
$valor_doc_transacao = 0;


@$total_emprestimos++;
$sql_puxa = mysqli_query($conexao_bd, "SELECT * FROM emprestimo_cartao WHERE data = '$data' AND operador = '$operador'");
while($res_produtos = mysqli_fetch_array($sql_puxa)){
	
	$total_emprestimos++;
	
	if($res_produtos['forma_pagamento'] == 'CAIXA'){
	$valor_caixa = $res_produtos['valor']+$valor_caixa;
	$valor_caixa_transacao = $res_produtos['valor_total']+$valor_caixa_transacao;
	}elseif($res_produtos['forma_pagamento'] == 'TED'){
	$valor_ted = $res_produtos['valor']+$valor_ted;
	$valor_ted_transacao = $res_produtos['valor_total']+$valor_ted_transacao;
	}elseif($res_produtos['forma_pagamento'] == 'DOC'){
	$valor_doc = $res_produtos['valor']+$valor_doc;
	$valor_doc_transacao = $res_produtos['valor_total']+$valor_doc_transacao;
	}
 } // fecha o while

?>
<table width="1000" border="0">
  <tr>
    <td colspan="3" bgcolor="#CCCCCC"><strong>TOTAL DE EMPRÉSTIMOS NO CARTÃO DE CRÉDITO</strong><br />
    Foram realizados <? echo mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM emprestimo_cartao WHERE operador = '$operador' AND data = '$data'")); ?> empréstimos no cartão de crédito
    </td>
  </tr>
  <tr>
    <td width="315"><strong>VALORES PAGOS NO CAIXA</strong></td>
    <td width="338"><strong>VALORES ENVIADOS POR TED</strong></td>
    <td width="333"><strong>VALORES ENVIADOS POR DOC</strong></td>
  </tr>
  <tr>
    <td>R$ <? echo number_format($valor_caixa, 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($valor_ted, 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($valor_doc, 2, ',', '.'); ?></td>
  </tr>
  <tr>
    <td>VALOR DA TRANSAÇÃO<br />R$ <? echo number_format($valor_caixa_transacao, 2, ',', '.'); ?></td>
    <td>VALOR DA TRANSAÇÃO<br />R$ <? echo number_format($valor_ted_transacao, 2, ',', '.'); ?></td>
    <td>VALOR DA TRANSAÇÃO<br />R$ <? echo number_format($valor_doc_transacao, 2, ',', '.'); ?></td>
  </tr>
  <tr>
    <td colspan="3"><table width="995" border="0">
      <tr>
        <td align="center" width="90" bgcolor="#66CC00"><strong>N. PROP&Oacute;STA</strong></td>
        <td align="center" width="67" bgcolor="#66CC00"><strong>STATUS</strong></td>
        <td align="center" width="141" bgcolor="#66CC00"><strong>FORM. PAGAMENTO</strong></td>
        <td align="center" width="45" bgcolor="#66CC00"><strong>VALOR</strong></td>
        <td align="center" width="49" bgcolor="#66CC00"><strong>JUROS</strong></td>
        <td align="center" width="46" bgcolor="#66CC00"><strong>TARIFA</strong></td>
        <td align="center" width="89" bgcolor="#66CC00"><strong>N. PARCELAS</strong></td>
        <td align="center" width="83" bgcolor="#66CC00"><strong>VL. PARCELA</strong></td>
        <td align="center" width="86" bgcolor="#66CC00"><strong>VALOR TOTAL</strong></td>
        <td align="center" width="78" bgcolor="#66CC00"><strong>CLIENTE</strong></td>
        <td align="center" width="175" bgcolor="#66CC00"><strong>INFORMA&Ccedil;&Otilde;ES BANCARIAS</strong></td>
      </tr>
      <?
	  $i = 0;
      $emprestimo_cartao = mysqli_query($conexao_bd, "SELECT * FROM emprestimo_cartao WHERE operador = '$operador' AND data = '$data'");
	  	while($res_emprestimo_cartao = mysqli_fetch_array($emprestimo_cartao)){ $i++;
	  ?>
  	   <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
        <td align="center"><? echo $res_emprestimo_cartao['n_proposta']; ?></td>
        <td align="center"><? echo $res_emprestimo_cartao['status']; ?></td>
        <td align="center"><? echo $res_emprestimo_cartao['forma_pagamento']; ?></td>
        <td align="center"><? echo $res_emprestimo_cartao['valor']; ?></td>
        <td align="center"><? echo $res_emprestimo_cartao['juros']; ?></td>
        <td align="center"><? echo $res_emprestimo_cartao['tarifa']; ?></td>
        <td align="center"><? echo $res_emprestimo_cartao['quant_parcela']; ?></td>
        <td align="center"><? echo $res_emprestimo_cartao['valor_parcela']; ?></td>
        <td align="center"><? echo $res_emprestimo_cartao['valor_total']; ?></td>
        <td align="center"><? echo $res_emprestimo_cartao['cpf']; ?></td>
        <td align="center">Banco:<? echo $res_emprestimo_cartao['banco']; ?> - Tipo: <? echo $res_emprestimo_cartao['tipo_conta']; ?><br />Agência: <? echo $res_emprestimo_cartao['agencia']; ?> - Conta: <? echo $res_emprestimo_cartao['conta']; ?></td>
      </tr>
      <? } ?>
    </table></td>
    </tr>
</table>

<?
$saque_caixa_debito = 0;
$saque_caixa_com_tarifa = 0;

$sql_saque = mysqli_query($conexao_bd, "SELECT * FROM saques WHERE data = '$data' AND operador = '$operador'");
	while($res_saque = mysqli_fetch_array($sql_saque)){
	
		$saque_caixa_debito = $res_saque['valor']+$saque_caixa_debito;	
		$saque_caixa_com_tarifa = $res_saque['valor_cobrado']+$saque_caixa_com_tarifa;	
			
}
?>
<hr /><h2><strong>4º Fechamento de saques no cartão de débito</strong></h2>
<table width="1000" border="0">
  <tr>
    <td colspan="3" bgcolor="#CCCCCC"><strong>TOTAL DE SAQUES NO CARTÃO DE DÉBITO</strong></td>
  </tr>
     <td width="238"><strong>VALORES PAGOS NO CAIXA</strong></td>
<tr>
   </tr>
  <tr>
    <td>R$ <? echo number_format($saque_caixa_debito, 2, ',', '.'); ?></td>
  </tr>
  <tr>
    <td width="238">VALOR DAS TRANSAÇÕES</td>
  </tr>
  <tr>
    <td>R$ <? echo number_format($saque_caixa_com_tarifa, 2, ',', '.'); ?></td>
  </tr>
  <tr>
    <td><table width="995" border="0">
      <tr>
        <td align="center" width="303" bgcolor="#66CC00"><strong>CLIENTE</strong></td>
        <td align="center" width="83" bgcolor="#66CC00"><strong>VALOR</strong></td>
        <td align="center" width="90" bgcolor="#66CC00"><strong>TARIFA</strong></td>
        <td align="center" width="123" bgcolor="#66CC00"><strong>VALOR COBRADO</strong></td>
        <td align="center" width="167" bgcolor="#66CC00"><strong>BANDEIRA</strong></td>
        <td align="center" width="203" bgcolor="#66CC00"><strong>BANCO</strong></td>
        </tr>
      <?
      $i=0;
	  $puxa_saques = mysqli_query($conexao_bd, "SELECT * FROM saques WHERE operador = '$operador' AND data = '$data'");
	  	while($res_saques = mysqli_fetch_array($puxa_saques)){ $i++;
	  ?>
  	   <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
        <td align="center"><? echo strtoupper($res_saques['cliente']); ?></td>
        <td align="center"><? echo strtoupper($res_saques['valor']); ?></td>
        <td align="center"><? echo strtoupper($res_saques['tarifa']); ?></td>
        <td align="center"><? echo strtoupper($res_saques['valor_cobrado']); ?></td>
        <td align="center"><? echo strtoupper($res_saques['bandeira_cartao']); ?></td>
        <td align="center"><? echo strtoupper($res_saques['banco']); ?></td>
        </tr>
      <? } ?>
    </table></td>
  </tr>
</table>





<hr /><h2><strong>5º FECHAMENTO DE SAQUES BANCO DO BRASIL</strong></h2>
<table width="1000" border="0">
  <tr>
    <td colspan="3" bgcolor="#CCCCCC"><strong>TOTAL DE SAQUES NO CARTÃO DE DÉBITO BANCO DO BRASIL</strong></td>
  </tr>
  <tr>
    <td width="238"><strong>VALORES PAGOS NO CAIXA</strong></td>
  </tr>
  <tr>
    <td>R$ <? 
	$saque_bb = 0;
	
	$sql_saque_debito = mysqli_query($conexao_bd, "SELECT * FROM saque_banco_brasil WHERE data = '$data' AND operador = '$operador' AND status = 'Ativo'");	
		while($res_saque = mysqli_fetch_array($sql_saque_debito)){
				$saque_bb = $res_saque['valor']+$saque_bb;
			}
	
	echo number_format($saque_bb, 2, ',', '.'); ?></td>
  </tr>
  <tr>
    <td><table width="995" border="0">
      <tr>
        <td align="center" bgcolor="#66CC00"><strong>CLIENTE</strong></td>
        <td align="center" bgcolor="#66CC00"><strong>AG&Ecirc;NCIA</strong></td>
        <td align="center" bgcolor="#66CC00"><strong>TIPO DE CONTA</strong></td>
        <td align="center" bgcolor="#66CC00"><strong>CONTA</strong></td>
        <td align="center" bgcolor="#66CC00"><strong>FAVORECIDO</strong></td>
        <td align="center" bgcolor="#66CC00"><strong>VALOR</strong></td>
        <td align="center" bgcolor="#66CC00"><strong>N&ordm; DOCUMENTO</strong></td>
      </tr>
      <?
      $i=0;
	  $puxa_saques_bb = mysqli_query($conexao_bd, "SELECT * FROM saque_banco_brasil WHERE operador = '$operador' AND data = '$data' AND status = 'Ativo'");
	  	while($res_saques_bb = mysqli_fetch_array($puxa_saques_bb)){ $i++;
	  ?>
  	   <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
       <td align="center"><? echo strtoupper($res_saques_bb['cliente']); ?></td>
        <td align="center"><? echo strtoupper($res_saques_bb['agencia']); ?></td>
        <td align="center"><? echo strtoupper($res_saques_bb['tipo_conta']); ?></td>
        <td align="center"><? echo strtoupper($res_saques_bb['conta']); ?></td>
        <td align="center"><? echo strtoupper($res_saques_bb['favorecido']); ?></td>
        <td align="center"><? echo strtoupper($res_saques_bb['valor']); ?></td>
        <td align="center"><? echo strtoupper($res_saques_bb['n_documento']); ?></td>
      </tr>
      <? } ?>
    </table></td>
  </tr>
</table>
<hr />


<h2><strong>6º Fechamento de TRANSFERÊNCIAS TED</strong></h2>
<table width="1000" border="0">
  <tr>
    <td colspan="3" bgcolor="#CCCCCC"><strong>TOTAL DE TRANSFERÊNCIAS REALIZADAS</strong></td>
  </tr>
  <tr>
    <td width="238"><strong>TOTAL DE TRANSFERÊNCIA TED</strong></td>
  </tr>
  <?
  $transferencia_ted = 0;
  $sql_transferencia_ted = mysqli_query($conexao_bd, "SELECT * FROM transferencia_ted WHERE data = '$data' AND operador = '$operador' AND status != 'Cancelado'");
  	while($res_ted = mysqli_fetch_array($sql_transferencia_ted)){
		$transferencia_ted = $res_ted['valor']+$res_ted['tarifa']+$transferencia_ted;
	}
		
  ?>
  <tr>
    <td><? echo number_format($transferencia_ted, 2, ',', '.');  ?></td>
  </tr>
  <tr>
    <td><table width="995" border="0">
      <tr>
        <td align="center" width="155" bgcolor="#66CC00"><strong>NOME DO REMETENTE</strong></td>
        <td align="center" width="103" bgcolor="#66CC00"><strong>CPF REMENTENTE</strong></td>
        <td align="center" width="94" bgcolor="#66CC00"><strong>TELEFONE</strong></td>
        <td align="center" width="167" bgcolor="#66CC00"><strong>NOME DO BENEFICI&Aacute;RIO</strong></td>
        <td align="center" width="128" bgcolor="#66CC00"><strong>CPF BENEFICI&Aacute;RIO</strong></td>
        <td align="center" width="50" bgcolor="#66CC00"><strong>TARIFA</strong></td>
        <td align="center" width="34" bgcolor="#66CC00"><strong>TIPO</strong></td>
        <td align="center" width="62" bgcolor="#66CC00"><strong>AGENCIA</strong></td>
        <td align="center" width="50" bgcolor="#66CC00"><strong>CONTA</strong></td>
        <td align="center" width="63" bgcolor="#66CC00"><strong>BANCO</strong></td>
        <td align="center" width="43" bgcolor="#66CC00"><strong>VALOR</strong></td>
        </tr>
      <?
      $i=0;
	  $puxa_saques_bb = mysqli_query($conexao_bd, "SELECT * FROM transferencia_ted WHERE operador = '$operador' AND data = '$data' AND status != 'Cancelado'");
	  	while($res_saques_bb = mysqli_fetch_array($puxa_saques_bb)){ $i++;
	  ?>
  	   <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
        <td align="center"><? echo strtoupper($res_saques_bb['nome_remetente']); ?></td>
        <td align="center"><? echo strtoupper($res_saques_bb['cpf_remetente']); ?></td>
        <td align="center"><? echo strtoupper($res_saques_bb['telefone_remetente']); ?></td>
        <td align="center"><? echo strtoupper($res_saques_bb['nome_beneficiario']); ?></td>
        <td align="center"><? echo strtoupper($res_saques_bb['cpf_beneficiario']); ?></td>
        <td align="center"><? echo number_format($res_saques_bb['tarifa'], 2, ',', '.'); ?></td>
        <td align="center"><? echo strtoupper($res_saques_bb['tipo_conta']); ?></td>
        <td align="center"><? echo strtoupper($res_saques_bb['agencia']); ?></td>
        <td align="center"><? echo strtoupper($res_saques_bb['conta_beneficario']); ?></td>
        <td align="center"><? echo strtoupper($res_saques_bb['banco']); ?></td>
        <td align="center"><? echo number_format($res_saques_bb['valor'], 2, ',', '.'); ?></td>
        </tr>
     <? } ?>
    </table></td>
  </tr>
</table>
<hr />






<h2><strong>7º Fechamento de DEPÓSITOS</strong></h2>
<table width="1000" border="0">
  <tr>
    <td colspan="3" bgcolor="#CCCCCC"><strong>TOTAL DE DEPOISTO REALIZADAS</strong></td>
  </tr>
  <tr>
    <td width="238"><strong>DEPÓSITO DIRETO BANCO DO BRASIL</strong></td>
  </tr>
  <?
  $deposito_bb = 0;
  $sql_deposito = mysqli_query($conexao_bd, "SELECT * FROM deposito_banco_brasil WHERE data = '$data' AND operador = '$operador' AND status != 'Cancelado'");
  	while($res_deposito = mysqli_fetch_array($sql_deposito)){
		$deposito_bb = $res_deposito['valor']+$deposito_bb;
	}
		
  ?>
  <tr>
    <td><? echo number_format($deposito_bb, 2, ',', '.');  ?></td>
  </tr>
  <tr>
    <td><table width="995" border="0">
      <tr>
        <td align="center" width="129" bgcolor="#66CC00"><strong>AG&Ecirc;NCIA</strong></td>
        <td align="center" width="173" bgcolor="#66CC00"><strong>TIPO DE CONTA</strong></td>
        <td align="center" width="152" bgcolor="#66CC00"><strong>CONTA</strong></td>
        <td align="center" width="285" bgcolor="#66CC00"><strong>FAVORECIDO</strong></td>
        <td align="center" width="91" bgcolor="#66CC00"><strong>VALOR</strong></td>
        <td align="center" width="139" bgcolor="#66CC00"><strong>N. DOCUMENTO</strong></td>
        </tr>
      <?
      $i=0;
  $sql_deposito = mysqli_query($conexao_bd, "SELECT * FROM deposito_banco_brasil WHERE data = '$data' AND operador = '$operador' AND status != 'Cancelado'");
	  
	  	while($res_deposito_bb = mysqli_fetch_array($sql_deposito)){ $i++;
	  ?>
  	   <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
        <td align="center"><? echo strtoupper($res_deposito_bb['agencia']); ?></td>
        <td align="center"><? echo strtoupper($res_deposito_bb['tipo_conta']); ?></td>
        <td align="center"><? echo strtoupper($res_deposito_bb['conta']); ?></td>
        <td align="center"><? echo strtoupper($res_deposito_bb['favorecido']); ?></td>
        <td align="center">R$ <? echo number_format($res_deposito_bb['valor'], 2, ',', '.'); ?></td>
        <td align="center"><? echo strtoupper($res_deposito_bb['n_documento']); ?></td>
        </tr>
      <? } ?>
    </table></td>
  </tr>
</table>
<hr />






<h2><strong>8º Fechamento de RECEBIMENTO DE FATURAS</strong></h2>
<table width="1000" border="0">
  <tr>
    <td colspan="3" bgcolor="#CCCCCC"><strong>TOTAL FATURAS RECEBIDAS</strong></td>
  </tr>
  <?
  $recebimento_faturas = 0;
  $sql_recebimento_faturas = mysqli_query($conexao_bd, "SELECT * FROM pagamento_fatura WHERE data = '$data' AND operador = '$operador' AND status != 'Cancelado'");
  	while($res_recebimento_faturas = mysqli_fetch_array($sql_recebimento_faturas)){
		$recebimento_faturas = $res_recebimento_faturas['valor']+$recebimento_faturas;
	}
		
  ?>
  <tr>
    <td>R$ <? echo number_format($recebimento_faturas, 2, ',', '.');  ?></td>
  </tr>
  <tr>
    <td><table width="995" border="0">
      <tr>
        <td align="center" width="146" bgcolor="#66CC00"><strong>STATUS</strong></td>
        <td align="center" width="161" bgcolor="#66CC00"><strong>CLIENTE</strong></td>
        <td align="center" width="125" bgcolor="#66CC00"><strong>VALOR</strong></td>
        <td align="center" width="421" bgcolor="#66CC00"><strong>FORMA DE PAGAMENTO</strong></td>
        </tr>
      <?
      $i=0;
  $sql_recebimento_faturas = mysqli_query($conexao_bd, "SELECT * FROM pagamento_fatura WHERE data = '$data' AND operador = '$operador' AND status != 'Cancelado'");	  
  		while($res_recebimento_faturas = mysqli_fetch_array($sql_recebimento_faturas)){ $i++;
	  ?>
  	   <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
        <td align="center"><? echo strtoupper($res_recebimento_faturas['status']); ?></td>
        <td align="center"><? echo strtoupper($res_recebimento_faturas['cliente']); ?></td>
        <td align="center">R$ <? echo number_format($res_recebimento_faturas['valor'], 2, ',', '.'); ?></td>
        <td align="center"><? echo strtoupper($res_recebimento_faturas['forma_pagamento']); ?></td>
        </tr>
      <? } ?>
    </table></td>
  </tr>
</table>
<hr />





<h2><strong>9º Fechamento de SANGRIA E ALÍVIO</strong></h2>
<table width="1000" border="0">
  <tr>
    <td colspan="3" bgcolor="#CCCCCC"><strong>TOTAL DE SANGRIA E ALIVIOS</strong></td>
  </tr>
  <tr>
    <td colspan="3" width="238"><strong>SANGRIA E ALIVIOS</strong></td>
  </tr>
  <?
  $sangria = 0;
  $alivio = 0;
  $sql_sangria = mysqli_query($conexao_bd, "SELECT * FROM sangria_caixa WHERE data = '$data' AND operador = '$operador' AND finalidade = 'SANGRIA'");
  	while($res_sangria = mysqli_fetch_array($sql_sangria)){
		$sangria = $res_sangria['valor']+$sangria;
	}
	
  $sql_alivio = mysqli_query($conexao_bd, "SELECT * FROM sangria_caixa WHERE data = '$data' AND operador = '$operador' AND finalidade = 'ALIVIO'");
  	while($res_alivio = mysqli_fetch_array($sql_alivio)){
		$alivio = $res_alivio['valor']+$alivio;
	}
		
  ?>
  <tr>
   <td><strong>TOTAL DE ALIVIO</strong></td>
   <td><strong>TOTAL DE SANGRIA</strong></td>
  </tr>
  <tr>
    <td><? echo number_format($sangria, 2, ',', '.');  ?></td>
    <td><? echo number_format($alivio, 2, ',', '.');  ?></td>
  </tr>
  <tr>
    <td colspan="2"><table width="995" border="0">
      <tr>
        <td align="center" width="614" bgcolor="#66CC00"><strong>FINALIDADE</strong></td>
        <td align="center" width="156" bgcolor="#66CC00"><strong>VALOR</strong></td>
        <td align="center" width="210" bgcolor="#66CC00"><strong>BANCO</strong></td>
        </tr>
      <?
      $i=0;
  $sql_alivio = mysqli_query($conexao_bd, "SELECT * FROM sangria_caixa WHERE data = '$data' AND operador = '$operador'");
  		while($res_alivio = mysqli_fetch_array($sql_alivio)){ $i++;
	  ?>
  	   <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
        <td align="center"><? echo strtoupper($res_alivio['finalidade']); ?></td>
        <td align="center">R$ <? echo number_format($res_alivio['valor'], 2, ',', '.'); ?></td>
        <td align="center"><? echo strtoupper($res_alivio['banco']); ?></td>
        </tr>
      <? } ?>
    </table></td>
    </tr>
</table>
<hr />








<h2><strong>10º Fechamento de RETIRADA DE DINHEIRO</strong></h2>
<table width="1000" border="0">
  <tr>
    <td colspan="3" bgcolor="#CCCCCC"><strong>Foram realizados 8 retiradas</strong></td>
  </tr>
  <?
  $comercial = 0;
  $pessoal = 0;
  $sql_comercial = mysqli_query($conexao_bd, "SELECT * FROM retirada_dinheiro WHERE data = '$data' AND operador = '$operador' AND finalidade = 'FINS COMERCIAIS'");
  	while($res_comercial = mysqli_fetch_array($sql_comercial)){
		$comercial = $res_comercial['valor']+$comercial;
	}
	
  $sql_pessoal = mysqli_query($conexao_bd, "SELECT * FROM retirada_dinheiro WHERE data = '$data' AND operador = '$operador' AND finalidade = 'FINS PESSOAIS'");
  	while($res_pessoal = mysqli_fetch_array($sql_pessoal)){
		$pessoal = $res_pessoal['valor']+$pessoal;
	}
		
  ?>
  <tr>
   <td><strong>FINS COMERCIAIS</strong></td>
   <td><strong>FINS PESSOAIS</strong></td>
  </tr>
  <tr>
    <td><? echo number_format($comercial, 2, ',', '.');  ?></td>
    <td><? echo number_format($pessoal, 2, ',', '.');  ?></td>
  </tr>
  <tr>
    <td colspan="2"><table width="995" border="0">
      <tr>
        <td align="center" width="614" bgcolor="#66CC00"><strong>DESCRIÇÃO</strong></td>
        <td align="center" width="156" bgcolor="#66CC00"><strong>FINALIDADE</strong></td>
        <td align="center" width="210" bgcolor="#66CC00"><strong>VALOR</strong></td>
        </tr>
      <?
      $i=0;
  $sql_alivio = mysqli_query($conexao_bd, "SELECT * FROM retirada_dinheiro WHERE data = '$data' AND operador = '$operador'");
  		while($res_alivio = mysqli_fetch_array($sql_alivio)){ $i++;
	  ?>
  	   <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
        <td align="center"><? echo strtoupper($res_alivio['descricao']); ?></td>
        <td align="center"><? echo strtoupper($res_alivio['finalidade']); ?></td>
        <td align="center">R$ <? echo number_format($res_alivio['valor'], 2, ',', '.'); ?></td>
        </tr>
      <? } ?>
    </table></td>
    </tr>
</table>
<h2><strong>11&ordm; Informa&ccedil;&atilde;ões sobre EMISSÃO DE NOTAS DE PAGAMENTOS</strong>
</h2>
<table width="1000" border="0">
  <tr>
    <td colspan="3" bgcolor="#CCCCCC"><strong>RELATÓRIO DE EMISSÃO DE NOTAS DE PAGAMENTOS</strong></td>
  </tr>
  <?
  $emissao = 0;
  $resgate = 0;
  $sql_emite = mysqli_query($conexao_bd, "SELECT * FROM emissao_de_nota_de_pagamento WHERE data = '$data' AND operador = '$operador' AND status != 'CANCELADO'");
  	while($res_emite = mysqli_fetch_array($sql_emite)){
		$emissao = $res_emite['valor']+$emissao;
	}
	
  $sql_resgate = mysqli_query($conexao_bd, "SELECT * FROM emissao_de_nota_de_pagamento WHERE dia_resgate = '$data' AND operador_regaste = '$operador' AND status = 'RESGATADO'");
  	while($res_resgate = mysqli_fetch_array($sql_resgate)){
		$resgate = ($res_resgate['valor']+$res_resgate['juros_rendidos'])+$resgate;
	}
		
  ?>
  <tr>
   <td width="551"><strong>EMISSÃO DE NOTAS</strong></td>
   <td width="439"><strong>RESGATE DE NOTAS</strong></td>
  </tr>
  <tr>
    <td><? echo number_format($emissao, 2, ',', '.');  ?></td>
    <td><? echo number_format($resgate, 2, ',', '.');  ?></td>
  </tr>
  <tr>
    <td colspan="2"><table width="990" border="0">
      <tr>
        <td width="81" bgcolor="#00CC00"><strong>Nº CUPOM</strong></td>
        <td width="144" bgcolor="#00CC00"><strong>DATA EMISSÃO</strong></td>
        <td width="144" bgcolor="#00CC00"><strong>STATUS</strong></td>
        <td width="321" bgcolor="#00CC00"><strong>NOME DO CLIENTE</strong></td>
        <td width="103" bgcolor="#00CC00"><strong>CPF</strong></td>
        <td width="87" bgcolor="#00CC00"><strong>TRAVADO</strong></td>
        <td width="56" bgcolor="#00CC00"><strong>VALOR</strong></td>
        <td width="48" bgcolor="#00CC00"><strong>DIA(S)</strong></td>
        <td width="116" bgcolor="#00CC00"><strong>VALOR A PAGAR</strong></td>
      </tr>
      <? $i=0;  
  $sql_emite = mysqli_query($conexao_bd, "SELECT * FROM emissao_de_nota_de_pagamento WHERE data = '$data' AND operador = '$operador' AND status = 'Ativo'");	  
  $sql_regate = mysqli_query($conexao_bd, "SELECT * FROM emissao_de_nota_de_pagamento WHERE data = '$data' AND operador = '$operador' AND status = 'RESGATADO'");	  
	  while($res_cupom = mysqli_fetch_array($sql_emite)){ $i++;
	   ?>
	  <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
        <td><? echo $res_cupom['code_cupom']; ?></td>
        <td><? echo $res_cupom['data_completa']; ?></td>
        <td><? echo $res_cupom['status']; ?></td>
        <td><? echo $res_cupom['nome']; ?></td>
        <td><? echo $res_cupom['cpf']; ?></td>
        <td><? echo $res_cupom['travado']; ?></td>
        <td>R$ <? echo number_format($res_cupom['valor'], 2, ',', '.'); ?></td>
        <td><? echo $res_cupom['dias_juros']; ?></td>
        <td>R$ <? echo number_format($res_cupom['valor']+$res_cupom['juros_rendidos'], 6, ',', '.'); ?></td>
      </tr>
      <? } ?>
      <?  
  $sql_regate = mysqli_query($conexao_bd, "SELECT * FROM emissao_de_nota_de_pagamento WHERE dia_resgate = '$data' AND operador = '$operador' AND status = 'RESGATADO'");	  
	  while($res_resgate = mysqli_fetch_array($sql_regate)){ $i++;
	   ?>
	  <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
        <td><? echo $res_resgate['code_cupom']; ?></td>
        <td><? echo $res_resgate['data_completa']; ?></td>
        <td><? echo $res_resgate['status']; ?></td>
        <td><? echo $res_resgate['nome']; ?></td>
        <td><? echo $res_resgate['cpf']; ?></td>
        <td><? echo $res_resgate['travado']; ?></td>
        <td>R$ <? echo number_format($res_resgate['valor'], 2, ',', '.'); ?></td>
        <td><? echo $res_cupom['dias_juros']; ?></td>
        <td>R$ <? echo number_format($res_resgate['valor']+$res_resgate['juros_rendidos'], 6, ',', '.'); ?></td>
      </tr>
      <? } ?>
    </table></td>
  </tr>
</table>
<hr />
<h2><strong>12&ordm; Informa&ccedil;&atilde;ões sobre RECARGA DE CELULAR PRÉ-PAGO</strong>
</h2>
<?
$soma_recarga_dinheiro = 0;
$soma_recarga_debito = 0;
$soma_recarga_debito_taxa = 0;
$soma_recarga_credito = 0;
$soma_recarga_credito_taxa = 0;
$soma_recarga_vesteprime = 0;

$sql_recargas = mysqli_query($conexao_bd, "SELECT * FROM recarga_prepago WHERE data = '$data' AND operador = '$operador' AND status = 'Ativo'");
	while($res_recargas = mysqli_fetch_array($sql_recargas)){
		if($res_recargas['forma_pagamento'] == 'DINHEIRO'){
			$soma_recarga_dinheiro = $res_recargas['valor']+$soma_recarga_dinheiro;
		}elseif($res_recargas['forma_pagamento'] == 'VESTE PRIME'){
			$soma_recarga_vesteprime = $res_recargas['valor']+$soma_recarga_vesteprime;
		}elseif($res_recargas['forma_pagamento'] == 'CARTAO DE CREDITO'){
			$soma_recarga_credito = $res_recargas['valor']+$soma_recarga_credito;
			$soma_recarga_credito_taxa = $res_recargas['valor']+$res_recargas['tarifa']+$soma_recarga_credito_taxa;		
		}elseif($res_recargas['forma_pagamento'] == 'CARTAO DE DEBITO'){
			$soma_recarga_debito = $res_recargas['valor']+$soma_recarga_debito;		
			$soma_recarga_debito_taxa = $res_recargas['valor']+$res_recargas['tarifa']+$soma_recarga_debito_taxa;		
		}
}

?>
<table width="1000" border="0">
  <tr>
    <td colspan="5" bgcolor="#CCCCCC"><strong>RELATÓRIO DE RECARGAS DE PRÉ-PAGO</strong></td>
  </tr>
  <tr>
   <td width="212"><strong>DINHEIRO</strong></td>
   <td width="337"><strong>CARTÃO DE DÉBITO</strong></td>
   <td width="248"><strong>CARTÃO DE CRÉDITO</strong></td>
   <td width="185"><strong>VESTE PRIME CARD</strong></td>
  </tr>
  <tr>
    <td><? echo number_format($soma_recarga_dinheiro, 2, ',', '.'); ?></td>
    <td><? echo number_format($soma_recarga_debito, 2, ',', '.'); ?></td>
    <td><? echo number_format($soma_recarga_credito, 2, ',', '.'); ?></td>
    <td><? echo number_format($soma_recarga_vesteprime, 2, ',', '.'); ?></td>
  </tr>
  <tr>
    <td colspan="4"><table width="990" border="0">
      <tr>
        <td width="65" bgcolor="#00CC00"><strong>DATA</strong></td>
        <td width="143" bgcolor="#00CC00"><strong>PROCESSAMENTO</strong></td>
        <td width="125" bgcolor="#00CC00"><strong>OPERADORA</strong></td>
        <td width="150" bgcolor="#00CC00"><strong>NÚMERO</strong></td>
        <td width="82" bgcolor="#00CC00"><strong>NSU</strong></td>
        <td width="89" bgcolor="#00CC00"><strong>CLIENTE</strong></td>
        <td width="165" bgcolor="#00CC00"><strong>FORM. PAGAMENTO</strong></td>
        <td width="62" bgcolor="#00CC00"><strong>VALOR</strong></td>
        <td width="71" bgcolor="#00CC00"><strong>TARIFA</strong></td>
      </tr>
      <? $i=0;
	  $sql_recargas = mysqli_query($conexao_bd, "SELECT * FROM recarga_prepago WHERE data = '$data' AND operador = '$operador' AND status = 'Ativo'");
	  while($res_sql_recargas = mysqli_fetch_array($sql_recargas)){ $i++;
	  ?>
	  <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
        <td><? echo $res_sql_recargas['data_completa']; ?></td>
        <td><? echo $res_sql_recargas['processamento']; ?></td>
        <td><? echo $res_sql_recargas['operadora']; ?></td>
        <td><? echo $res_sql_recargas['numero']; ?></td>
        <td><? echo $res_sql_recargas['nsu']; ?></td>
        <td><? echo $res_sql_recargas['cliente']; ?></td>
        <td><? echo $res_sql_recargas['forma_pagamento']; ?></td>
	    <td>R$ <? echo number_format($res_sql_recargas['valor'], 2, ',', '.'); ?></td>
	    <td>R$ <? echo number_format($res_sql_recargas['tarifa'], 2, ',', '.'); ?></td>
      </tr>
      <? } ?>
    </table></td>
  </tr>
</table>
<hr />
<h2><strong>13&ordm; Informa&ccedil;&atilde;ões sobre RECARGA DE TV PRÉ-PAGO</strong>
</h2>
<?
$soma_recarga_tv_prepago_dinheiro = 0;
$soma_recarga_tv_prepago_debito = 0;
$soma_recarga_tv_prepago_credito = 0;
$soma_recarga_tv_prepago_vesteprime = 0;

$sql_recargas_tv = mysqli_query($conexao_bd, "SELECT * FROM recarga_tv_prepago WHERE data = '$data' AND operador = '$operador' AND status = 'Ativo'");
	while($res_recargas = mysqli_fetch_array($sql_recargas_tv)){
		if($res_recargas['forma_pagamento'] == 'DINHEIRO'){
			$soma_recarga_tv_prepago_dinheiro = $res_recargas['valor']+$soma_recarga_tv_prepago_dinheiro;
		}elseif($res_recargas['forma_pagamento'] == 'VESTE PRIME'){
			$soma_recarga_tv_prepago_vesteprime = $res_recargas['valor']+$soma_recarga_tv_prepago_vesteprime;
		}elseif($res_recargas['forma_pagamento'] == 'CARTAO DE CREDITO'){
			$soma_recarga_tv_prepago_credito = $res_recargas['valor']+$soma_recarga_tv_prepago_credito;
		}elseif($res_recargas['forma_pagamento'] == 'CARTAO DE DEBITO'){
			$soma_recarga_tv_prepago_debito = $res_recargas['valor']+$soma_recarga_tv_prepago_debito;		
		}
}

?>
<table width="1000" border="0">
  <tr>
    <td colspan="5" bgcolor="#CCCCCC"><strong>RELATÓRIO DE RECARGAS DE PRÉ-PAGO</strong></td>
  </tr>
  <tr>
   <td width="212"><strong>DINHEIRO</strong></td>
   <td width="337"><strong>CARTÃO DE DÉBITO</strong></td>
   <td width="248"><strong>CARTÃO DE CRÉDITO</strong></td>
   <td width="185"><strong>VESTE PRIME CARD</strong></td>
  </tr>
  <tr>
    <td><? echo number_format($soma_recarga_tv_prepago_dinheiro, 2, ',', '.'); ?></td>
    <td><? echo number_format($soma_recarga_tv_prepago_debito, 2, ',', '.'); ?></td>
    <td><? echo number_format($soma_recarga_tv_prepago_credito, 2, ',', '.'); ?></td>
    <td><? echo number_format($soma_recarga_tv_prepago_vesteprime, 2, ',', '.'); ?></td>
  </tr>
  <tr>
    <td colspan="4"><table width="990" border="0">
      <tr>
        <td width="65" bgcolor="#00CC00"><strong>DATA</strong></td>
        <td width="143" bgcolor="#00CC00"><strong>PROCESSAMENTO</strong></td>
        <td width="125" bgcolor="#00CC00"><strong>OPERADORA</strong></td>
        <td width="150" bgcolor="#00CC00"><strong>CÓDIGO</strong></td>
        <td width="82" bgcolor="#00CC00"><strong>NSU</strong></td>
        <td width="89" bgcolor="#00CC00"><strong>CLIENTE</strong></td>
        <td width="165" bgcolor="#00CC00"><strong>FORM. PAGAMENTO</strong></td>
        <td width="62" bgcolor="#00CC00"><strong>VALOR</strong></td>
        <td width="71" bgcolor="#00CC00"><strong>TARIFA</strong></td>
      </tr>
      <? $i=0;
	  $sql_recargas_tv = mysqli_query($conexao_bd, "SELECT * FROM recarga_tv_prepago WHERE data = '$data' AND operador = '$operador' AND status = 'Ativo'");
	  while($res_sql_recargas = mysqli_fetch_array($sql_recargas_tv)){ $i++;
	  ?>
	  <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
        <td><? echo $res_sql_recargas['data_completa']; ?></td>
        <td><? echo $res_sql_recargas['processamento']; ?></td>
        <td><? echo $res_sql_recargas['tv']; ?></td>
        <td><? echo $res_sql_recargas['code_cliente']; ?></td>
        <td><? echo $res_sql_recargas['nsu']; ?></td>
        <td><? echo $res_sql_recargas['cliente']; ?></td>
        <td><? echo $res_sql_recargas['forma_pagamento']; ?></td>
	    <td>R$ <? echo number_format($res_sql_recargas['valor'], 2, ',', '.'); ?></td>
	    <td>R$ <? echo number_format($res_sql_recargas['tarifa'], 2, ',', '.'); ?></td>
      </tr>
      <? } ?>
    </table></td>
  </tr>
</table>
<hr />
<h2><strong>14&ordm; Informa&ccedil;&atilde;ões sobre GIFT CARD</strong>
</h2>
<?
$soma_giftcard_dinheiro = 0;
$soma_giftcard_debito = 0;
$soma_giftcard_credito = 0;
$soma_giftcard_vesteprime = 0;

$sql_giftcard = mysqli_query($conexao_bd, "SELECT * FROM gift_card WHERE data = '$data' AND operador = '$operador' AND status = 'Ativo'");
	while($res_recargas = mysqli_fetch_array($sql_giftcard)){
		if($res_recargas['forma_pagamento'] == 'DINHEIRO'){
			$soma_giftcard_dinheiro = $res_recargas['valor']+$soma_giftcard_dinheiro;
		}elseif($res_recargas['forma_pagamento'] == 'VESTE PRIME'){
			$soma_giftcard_vesteprime = $res_recargas['valor']+$soma_giftcard_vesteprime;
		}elseif($res_recargas['forma_pagamento'] == 'CARTAO DE CREDITO'){
			$soma_giftcard_credito = $res_recargas['valor']+$soma_giftcard_credito;
		}elseif($res_recargas['forma_pagamento'] == 'CARTAO DE DEBITO'){
			$soma_giftcard_debito = $res_recargas['valor']+$soma_giftcard_debito;		
		}
}

?>
<table width="1000" border="0">
  <tr>
    <td colspan="5" bgcolor="#CCCCCC"><strong>RELATÓRIO DE RECARGAS DE PRÉ-PAGO</strong></td>
  </tr>
  <tr>
   <td width="212"><strong>DINHEIRO</strong></td>
   <td width="337"><strong>CARTÃO DE DÉBITO</strong></td>
   <td width="248"><strong>CARTÃO DE CRÉDITO</strong></td>
   <td width="185"><strong>VESTE PRIME CARD</strong></td>
  </tr>
  <tr>
    <td><? echo number_format($soma_giftcard_dinheiro, 2, ',', '.'); ?></td>
    <td><? echo number_format($soma_giftcard_debito, 2, ',', '.'); ?></td>
    <td><? echo number_format($soma_giftcard_credito, 2, ',', '.'); ?></td>
    <td><? echo number_format($soma_giftcard_vesteprime, 2, ',', '.'); ?></td>
  </tr>
  <tr>
    <td colspan="4"><table width="990" border="0">
      <tr>
        <td width="65" bgcolor="#00CC00"><strong>DATA</strong></td>
        <td width="143" bgcolor="#00CC00"><strong>PROCESSAMENTO</strong></td>
        <td width="125" bgcolor="#00CC00"><strong>GIFT CARD</strong></td>
        <td width="150" bgcolor="#00CC00"><strong>PIN</strong></td>
        <td width="89" bgcolor="#00CC00"><strong>CLIENTE</strong></td>
        <td width="165" bgcolor="#00CC00"><strong>FORM. PAGAMENTO</strong></td>
        <td width="62" bgcolor="#00CC00"><strong>VALOR</strong></td>
        <td width="71" bgcolor="#00CC00"><strong>TARIFA</strong></td>
      </tr>
      <? $i=0;
	$sql_giftcard = mysqli_query($conexao_bd, "SELECT * FROM gift_card WHERE data = '$data' AND operador = '$operador' AND status = 'Ativo'");
	  while($res_sql_recargas = mysqli_fetch_array($sql_giftcard)){ $i++;
	  ?>
	  <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
        <td><? echo $res_sql_recargas['data_completa']; ?></td>
        <td><? echo $res_sql_recargas['processamento']; ?></td>
        <td><? echo $res_sql_recargas['gift']; ?></td>
        <td><? echo $res_sql_recargas['pin']; ?></td>
        <td><? echo $res_sql_recargas['cliente']; ?></td>
        <td><? echo $res_sql_recargas['forma_pagamento']; ?></td>
	    <td>R$ <? echo number_format($res_sql_recargas['valor'], 2, ',', '.'); ?></td>
	    <td>R$ <? echo number_format($res_sql_recargas['tarifa'], 2, ',', '.'); ?></td>
      </tr>
      <? } ?>
    </table></td>
  </tr>
</table>
<hr />
<h2><strong>15&ordm; Informa&ccedil;&atilde;o de declara&ccedil;&otilde;es de valores</strong>
</h2>
<?
$sql_caixa_final = mysqli_query($conexao_bd, "SELECT * FROM fechamento_de_caixa WHERE id_caixa = '$id_do_caixa' AND operador = '$operador'");
while($res_abertura = mysqli_fetch_array($sql_caixa_final)){ 
?>
<table width="1000" border="0">
  <tr>
    <td align="center" colspan="6"><hr /></td>
  </tr>
  <tr>
    <td><strong>SALDO MAQUINA BB</strong></td>
    <td><strong>NOTAS DE R$ 100,00</strong></td>
    <td><strong>NOTAS DE R$ 50,00</strong></td>
    <td><strong>NOTAS DE R$ 20,00</strong></td>
    <td><strong>NOTAS DE R$ 10,00</strong></td>
    <td><strong>NOTAS DE R$ 5,00</strong></td>
  </tr>
  <tr>
    <td>R$ <? echo number_format($res_abertura['saldaobb'], 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($res_abertura['notas100']*100, 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($res_abertura['notas50']*50, 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($res_abertura['notas20']*20, 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($res_abertura['notas10']*10, 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($res_abertura['notas5']*5, 2, ',', '.'); ?></td>
  </tr>
  <tr>
    <td><strong>NOTAS DE R$ 2,00</strong></td>
    <td><strong>MOEDAS DE R$ 1,00</strong></td>
    <td><strong>MOEDAS DE R$ 0,50</strong></td>
    <td><strong>MOEDAS DE R$ 0,25</strong></td>
    <td><strong>MOEDAS DE R$ 0,10</strong></td>
    <td><strong>MOEDAS DE 0,05</strong></td>
  </tr>
  <tr>
    <td>R$ <? echo number_format($res_abertura['notas2']*2, 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($res_abertura['moeda1']*1, 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($res_abertura['moeda50']*0.5, 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($res_abertura['moeda25']*0.25, 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($res_abertura['moeda10']*0.1, 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($res_abertura['moeda5']*0.05, 2, ',', '.'); ?></td>
  </tr>
  <tr>
    <td><strong>SALDO BANCO DO BRASIL</strong></td>
    <td><strong>SALDO BANCO INTER</strong></td>
    <td><strong>SALDO RECARGAPAY</strong></td>
    <td><strong>SALDO MERCADOPAGO</strong></td>
    <td><strong>SALDO CELCOIN</strong></td>
    <td><strong>PIC PAY</strong></td>
  </tr>
  <tr>
    <td>R$ <? echo number_format($res_abertura['bb'], 2, ',', '.'); ?></td>
    <td>R$ <? echo @number_format($res_abertura['bancointer'], 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($res_abertura['recargapay'], 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($res_abertura['mercadopago'], 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($res_abertura['celcoin'], 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($res_abertura['picpay'], 2, ',', '.'); ?></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#FFEADF" colspan="6"><hr />
      <strong>DINHEIRO FINAL INFORMADO</strong> <br />
      R$
      <? 
	
	$caixa_final = ($res_abertura['notas100']*100)+($res_abertura['notas50']*50)+($res_abertura['notas20']*20)+($res_abertura['notas10']*10)+($res_abertura['notas5']*5)+($res_abertura['notas2']*2)+($res_abertura['moeda1']*1)+($res_abertura['moeda50']*0.5)+($res_abertura['moeda25']*0.25)+($res_abertura['moeda10']*0.1)+($res_abertura['moeda5']*0.05);
	
	echo number_format($caixa_final, 2, ',', '.'); 
	
	?></td>
  </tr>
</table>
<? } ?>

<table width="1000" border="0">
  <tr>
    <td align="center" colspan="4" bgcolor="#00CC00"><h2><strong>RESUMO FINAL PARA FECHAMENTO DE CAIXA</strong></h2></td>
  </tr>
  <tr>
    <td width="224" bgcolor="#0099FF"><strong>VALOR EM DINEIRO</strong></td>
    <td width="258" bgcolor="#0099FF"><strong>VALOR EM CART&Atilde;O DE D&Eacute;BITO</strong></td>
    <td width="240" bgcolor="#0099FF"><strong>VALOR EM CART&Atilde;O DE CR&Eacute;DITO</strong></td>
    <td width="260" bgcolor="#0099FF"><strong>VALOR NO VESTE PRIME CARD</strong></td>
  </tr>
  <tr>
   <td>R$ <?
    $valor_disponivel_caixa = ($caixa_inicial+$soma_giftcard_dinheiro+$soma_recarga_dinheiro+$soma_recarga_tv_prepago_dinheiro+$emissao+$valor_dinheiro+$carrinho_dinheiro+$transferencia_ted+$deposito_bb+$recebimento_faturas)-($valor_caixa+$saque_caixa_debito+$saque_bb+$sangria+$resgate+$alivio+$comercial+$pessoal);
    echo number_format(($valor_disponivel_caixa), 2, ',', '.'); ?></td>
   <td>R$ <? echo number_format((($valor_cartao_debito+$soma_giftcard_debito+$soma_recarga_debito+$soma_recarga_tv_prepago_debito+$carrinho_cartao_debito+$saque_caixa_debito)), 2, ',', '.'); ?></td>
   <td>R$ <? echo number_format(($valor_cartao_credito+$soma_giftcard_credito+$soma_recarga_credito+$soma_recarga_tv_prepago_credito+$carrinho_cartao_credito+$valor_caixa), 2, ',', '.'); ?></td>
   <td>R$ <? echo number_format(($valor_vesteprime+$soma_giftcard_vesteprime+$carrinho_vesteprime+$soma_recarga_vesteprime+$soma_recarga_tv_prepago_vesteprime), 2, ',', '.'); ?></td>
  </tr>
  <tr>
   <td bgcolor="#FFBBBB">SALDO FINAL DO CAIXA</td>
    <td bgcolor="#0099FF"><strong>VALOR EM TRANSA&Ccedil;&Atilde;O SAQUE DÉBITO</strong></td>
    <td bgcolor="#0099FF"><strong>VALOR EM TRANSA&Ccedil;&Atilde;O EMPRÉSTIMO</strong></td>
    <td bgcolor=""></td>
  </tr>
  <tr>
    <td>R$ <? echo number_format($caixa_final-$valor_disponivel_caixa, 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($saque_caixa_com_tarifa, 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format(($valor_caixa_transacao+$valor_ted_transacao+$valor_doc_transacao), 2, ',', '.'); ?></td>
    <td></td>
  </tr>
</table>
<hr />

<br />


<table width="995" border="0">
  <tr>
    <td align="left" colspan="5" bgcolor="#FFCC00"><strong>ANEXOS DESTE RELATÓRIO</strong></td>
  </tr>
  <tr>
    <td align="left" colspan="5"><ul>
      <li>Comprovantes recargas de celulares maquina Banco do Brasil</li>
      <li>Comprovantes recargas de celulares na maquina do RecargaPay</li>
      <li>Comprovante de saques maquina Banco do Brasil</li>
      <li>Comprovante de depósitos maquina Banco do Brasil</li>
      <li>Comprovante de pagamentos com os respectivos boletos na maquina do Banco do Brasil</li>
      <li>Comprovante de pagamentos com os respectivos boletos realizados pelo RecargaPay</li>
      <li>Relatório de comprovante de transações da maquina do Banco do Brasil</li>
      <li>Relatório de transações na maquina do Mercado Pago</li>
      <li>Extrato de transações do RecargaPay</li>
      <li>Comprovante de fechamento de Caixa do Banco do Brasil</li>
      <li>Contratos de aberturas de cadastro do cartão VESTE PRIME CARD</li>
      <li>Comprovante de transações assinadas pelo cliente do cartao VESTE PRIME CARD</li>
      <li>Comprovante de transações realizados nos cartões crédito e débito</li>
      </ul></td>
  </tr>
  <tr>
    <td align="left" colspan="5">
    <strong>OBSERVAÇÕES</strong><br />
      <hr /><br>
      <hr /><br>
      <hr /><br>
      <hr /><br>
      <hr /><br>
      <hr /><br>
      <hr /><br>
      <hr /><br>
<p>&nbsp;</p>
      <p>&nbsp;</p>

  </tr>
  <tr>
   <td align="center">
      <p>Taiba - São Gonçalo do Amarante, <? echo date("d/m/Y"); ?></p><br>
       <br />___________________________________________________________________<br>
      OPERADOR: <? echo strtoupper($nome); ?>
   </td>
  </tr>
  </table>

</div><!-- box -->
</body>
</html>