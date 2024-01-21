<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CONFIRMAÇÃO DE ENTREGA</title>
<style type="text/css">
body {
	font:12px Arial, Helvetica, sans-serif;
	text-align:center;
}
body h1{
	text-align:left;
}
body table td{
	border:1px solid #CCC;
	border-radius:5px;
	text-align:left;
}
</style>
</head>

<body>
<? require "../config.php"; 

$cliente = 0;
$sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM carrinho WHERE status = 'Ativo' AND ip = '$ip'");
	while($res_cliente = mysqli_fetch_array($sql_cliente)){
		$cliente = $res_cliente['cliente'];
} // fecha busca cliente

$sql_dados_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '$cliente'");
 while($res_dados_cliente = mysqli_fetch_array($sql_dados_cliente)){

$sql_carrinhos = mysqli_query($conexao_bd, "SELECT * FROM loja_online_carrinho WHERE code_carrinho = '".$_GET['carrinho']."'");
 	
	while($res_carrinho = mysqli_fetch_array($sql_carrinhos)){
  	 
	 $sql_produtos = mysqli_query($conexao_bd, "SELECT * FROM loja_online_produto WHERE id = '".$res_carrinho['id_produto']."'");
 	  
	   while($res_produto = mysqli_fetch_array($sql_produtos)){
?>



<table width="990" border="0">
  <tr>
    <td width="199" rowspan="5"><img src="../img/logo.png" width="199" height="109" /></td>
    <td colspan="3" align="center" bgcolor="#0099CC"><h2 style="font:20px Arial, Helvetica, sans-serif; text-align:center"><strong>VESTE PRIME - ELETR&Ocirc;NICOS E ACESS&Oacute;RIOS DE CELULARES <br />
    LOJA ONLINE</strong> - <strong><? echo date("d/m/Y H:i:s"); ?></strong><br />
    <h2 style="font:20px Arial, Helvetica, sans-serif; text-align:center"><strong>C&oacute;digo de venda: </strong><? echo $_GET['carrinho']; ?></h2></td>
  </tr>
  <tr>
    <td width="237"><strong>CNPJ: </strong>32.450.862/0001-02</td>
    <td width="287"><strong>RAZ&Atilde;O SOCIAL:</strong> M R O 05379839371</td>
    <td width="249"><strong>TELEFONE:</strong> (85) 9958.7323</td>
  </tr>
  <tr>
    <td colspan="3"><strong>ENDERE&Ccedil;O: </strong>Rua Capit&atilde;o In&aacute;cio Prata, 2010 - Taiba - S&atilde;o Gon&ccedil;alo do Amarante - Cear&aacute; - CEP: 62670-000</td>
  </tr>
  <tr>
    <td height="9" colspan="3"><strong>OBJETIVO:</strong> Intermediar no processo de compra de produtos e servi&ccedil;os de lojas parceiras</td>
  </tr>
  <tr>
    <td height="10" colspan="3"><strong>FUN&Ccedil;&Atilde;O: </strong>Intermediar e/ou financiar o processo de compra de produtos ou servi&ccedil;os.</td>
  </tr>
</table>
<h1>1. DADOS DO CONTRATANTE</h1>
<table width="990" border="0">
  <tr>
    <td width="257"><strong>NOME:</strong></td>
    <td width="240"><strong>CPF:</strong></td>
    <td width="197"><strong>RG</strong></td>
    <td width="278"><strong>DATA DE NASCIMENTO</strong></td>
  </tr>
  <tr>
    <td><? echo strtoupper($res_dados_cliente['nome']); ?></td>
    <td><? echo $res_dados_cliente['cpf']; ?></td>
    <td><? echo $res_dados_cliente['rg']; ?></td>
    <td><? echo $res_dados_cliente['nascimento']; ?></td>
  </tr>
  <tr>
    <td><strong>NOME DA M&Atilde;E:</strong></td>
    <td><strong>NOME DO PAI:</strong></td>
    <td><strong>SEXO:</strong></td>
    <td><strong>ESCOLARIDADE:</strong></td>
  </tr>
  <tr>
    <td><? echo strtoupper($res_dados_cliente['mae']); ?></td>
    <td><? echo strtoupper($res_dados_cliente['pai']); ?></td>
    <td><? echo strtoupper($res_dados_cliente['sexo']); ?></td>
    <td><? echo strtoupper($res_dados_cliente['escolaridade']); ?></td>
  </tr>
  <tr>
    <td><strong>NATURALIDADE:</strong></td>
    <td><strong>TELEFONE 1</strong></td>
    <td><strong>TELEFONE 2</strong></td>
    <td><strong>NACIONALIDADE</strong></td>
  </tr>
  <tr>
    <td><? echo strtoupper($res_dados_cliente['naturalidade']); ?></td>
    <td><? echo $res_dados_cliente['celular_1']; ?></td>
    <td><? echo $res_dados_cliente['celular_2']; ?></td>
    <td><? echo strtoupper($res_dados_cliente['nacionalidade']); ?></td>
  </tr>
  <tr>
    <td><strong>ENDERE&Ccedil;O:</strong></td>
    <td><strong>BAIRRO:</strong></td>
    <td><strong>CEP:</strong></td>
    <td><strong>CIDADE/ESTADO:</strong></td>
  </tr>
  <tr>
    <td><? echo strtoupper($res_dados_cliente['endereco']); ?> - <? echo $res_dados_cliente['n_residencia']; ?></td>
    <td><? echo strtoupper($res_dados_cliente['bairro']); ?></td>
    <td><? echo $res_dados_cliente['cep']; ?></td>
    <td><? echo strtoupper($res_dados_cliente['cidade']); ?>/<? echo strtoupper($res_dados_cliente['estado']); ?></td>
  </tr>
  <tr>
    <td colspan="4"><strong>E-MAIIL(S):</strong></td>
  </tr>
  <tr>
    <td colspan="4"><? echo strtolower($res_dados_cliente['email']); ?></td>
  </tr>
</table>
<h1>2. DADOS DO PRODUTO</h1>
<table width="990" border="0">
  <tr>
    <td width="89" rowspan="4"><img src="<? echo $res_produto['img']; ?>" width="86" height="80" /></td>
    <td colspan="7" bgcolor="#CCCCCC"><strong>TITULO DO PRODUTO</strong></td>
  </tr>
  <tr>
    <td colspan="7"><? echo $res_produto['titulo']; ?></td>
  </tr>
  <tr>
    <td width="91" bgcolor="#CCCCCC"><strong>COD:</strong></td>
    <td width="135" bgcolor="#CCCCCC"><strong>DATA DA COMPRA:</strong></td>
    <td width="99" bgcolor="#CCCCCC"><strong>QUANTIDADE:</strong></td>
    <td width="125" bgcolor="#CCCCCC"><strong>VALOR UNIT&Aacute;RIO</strong></td>
    <td width="108" bgcolor="#CCCCCC"><strong>VALOR TOTAL</strong></td>
    <td width="131" bgcolor="#CCCCCC"><strong>PRAZO DE ENTREGA:</strong></td>
    <td width="178" bgcolor="#CCCCCC"><strong>STATUS DO PAGAMENTO:</strong></td>
  </tr>
  <tr>
    <td><? echo $res_produto['id']; ?></td>
    <td><? echo $res_carrinho['data']; ?></td>
    <td><? echo $res_carrinho['quantidade']; ?></td>
    <td>R$ <? echo number_format($res_carrinho['valor_unitario'],2,',','.'); ?></td>
    <td>R$ <? echo number_format($res_carrinho['valor_total'],2,',','.'); ?></td>
    <td><? echo $res_produto['entrega']+2; ?> dias</td>
    <td><? echo strtoupper($res_carrinho['status_pagamento']); ?></td>
  </tr>
  <tr>
    <td colspan="8" bgcolor="#CCCCCC"><strong>INFORMA&Ccedil;&Otilde;ES SOBRE ENVIO DO PRODUTO</strong></td>
  </tr>
  <tr>
    <td colspan="8"><? echo $res_carrinho['envio']; ?></td>
  </tr>
</table>


<h1>3. DADOS DO PAGAMENTO</h1>
<? 

$carrinho = $_GET['carrinho'];
$sql_pagamentos = mysqli_query($conexao_bd, "SELECT * FROM loja_online_pagamentos WHERE code_carrinho = '$carrinho'");
?>
<table width="990" border="0">
  <tr>
    <td width="164" bgcolor="#CCCCCC"><strong>FORMA DE PAGAMENTO</strong></td>
    <td width="100" bgcolor="#CCCCCC"><strong>VALOR PAGO:</strong></td>
    <td width="84" bgcolor="#CCCCCC"><strong>TROCO</strong></td>
    <td width="132" bgcolor="#CCCCCC"><strong>STATUS</strong></td>
    <td width="156" bgcolor="#CCCCCC">&nbsp;</td>
    <td width="133" bgcolor="#CCCCCC">&nbsp;</td>
    <td width="191" bgcolor="#CCCCCC">&nbsp;</td>
  </tr
  >
  <? while($res_pagamentos = mysqli_fetch_array($sql_pagamentos)){ ?>
  <tr>
    <td><? echo $res_pagamentos['forma_pagamento']; ?></td>
    <td>R$ <? echo number_format($res_pagamentos['valor'],2,',','.'); ?></td>
    <td>R$ <? echo number_format($res_pagamentos['troco'],2,',','.'); ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <? } ?>
  <tr>
    <td colspan="7" bgcolor="#CCCCCC"><strong>INFORMA&Ccedil;&Otilde;ES SOBRE O PAGAMENTO</strong></td>
  </tr>
  <tr>
    <td colspan="7"><? echo $res_carrinho['comentario_pagamento']; ?></td>
  </tr>
</table>


<h1>4. CONTRATO DE PRESTA&Ccedil;&Atilde;O DE SERVI&Ccedil;OS</h1>
<table width="990" border="0">
  <tr>
    <td><strong>1&ordm; CL&Aacute;USULA: ATUA&Ccedil;&Atilde;O DA VESTE PRIME</strong></td>
  </tr>
  <tr>
    <td><p>1.1. A VESTE PRIME atua como como intermediador do processo de compra, por meio de sistema DROPSHIPPING a qual &eacute; a respons&aacute;vel por realizar a compra no site de seus parceiros e fazer a entrega diretamente para o cliente.</p>
    <p>1.2. A VESTE PRIME se isenta de atrados quanto a prazos de entrega e/ou reparos de assist&ecirc;cias t&eacute;cnicas, tendo em vista que esses servi&ccedil;os depende dos parceiros de compra de entrega.</p></td>
  </tr>
  <tr>
    <td><strong>2&ordm; CL&Aacute;USULA: DA CONTRA&Ccedil;&Atilde;O</strong></td>
  </tr>
  <tr>
    <td><p>2.1. A contrata&ccedil;&atilde;o do servi&ccedil;o de intermedia&ccedil;&atilde;o se dar&aacute; diretamente no site da loja.</p>
    <p>2.2. A contrata&ccedil;&atilde;o do servi&ccedil;o s&oacute; se dar&aacute; ap&oacute;s a aprova&ccedil;&atilde;o do pagamento pela emissora do cart&atilde;o de cr&eacute;dito e confirma&ccedil;&atilde;o de disponibilidade de estoque pela loja parceira.</p>
    <p>2.3. Caso alguns do itens citados no paragrafo 2.2. seja negado, a VESTE PRIME tem o direito de cancelar a seu crit&eacute;rio e sem aviso pr&eacute;vio a contrata&ccedil;&atilde;o e aviso ao cliente por meio de seus canais digitais, e-mails, telefone, WhatsApp, etc.</p>
    <p>2.4. A VESTE PRIME a seu crit&eacute;rio poder&aacute; avisar ao cliente por meio de seus canais digitais sobre a confirma&ccedil;&atilde;o da contrata&ccedil;&atilde;o do produto e/ou servi&ccedil;o.</p></td>
  </tr>
  <tr>
    <td><strong>3&ordm; CL&Aacute;USULA: DO PRAZO DE ENTREGA</strong></td>
  </tr>
  <tr>
    <td><p>3.1. O prazo de entrega do produto s&oacute; se inicia ap&oacute;s o cliente ser notificado por meio dos canais digitais sobre a confirma&ccedil;&atilde;o da contrata&ccedil;&atilde;o do produto.</p>
    <p>3.2. Por ser apenas intermediadora a VESTE PRIME poder&aacute; atrasar a entrega do produto ao cliente, avisando antecipamente de no minimo de 1 hora. Tendo em vista que o produto ser&aacute; adquirido pelas lojas parceiras do sistema DROPSHIPP.</p>
    <p>3.3. O cliente poder&aacute; ao seu crit&eacute;rio em caso de notifica&ccedil;&atilde;o de atraso, CANCELAR a contrata&ccedil;&atilde;o do servi&ccedil;o oferecido pela VESTE PRIME com antecedencia minima de 1 hora ap&oacute;s recebimento da notifica&ccedil;&atilde;o.</p></td>
  </tr>
  <tr>
    <td><strong>4&ordm; CL&Aacute;USULA: DA ENTREGA</strong></td>
  </tr>
  <tr>
    <td><p>4.1. A entrega do produto, poder&aacute; ser efetuada no prazo estabelecido ou n&atilde;o e somente no estabelecimento de uma das unidades da VESTE PRIME que ofere&ccedil;a o servi&ccedil;o.</p>
    <p>4.2. O produto ser&aacute; entregue DIRETAMENTE ao CONTRATANTE, sendo vedado a entrega a qualquer outra pessoa, exceto se tiver uma procura&ccedil;&atilde;o registrada em cart&oacute;rio para esse sim ou com uma declara&ccedil;&atilde;o de recebimento informando previamente informada antes da confirmaca&ccedil;&atilde;o da contrata&ccedil;&atilde;o.</p>
    <p>4.3. Ap&oacute;s receber e conferir o produto o cliente deve assinar o termo de recebimento, n&atilde;o sendo aceito qualquer tipo de reclama&ccedil;&atilde;o ap&oacute;s a assinatura do termo de recebimento.</p></td>
  </tr>
  <tr>
    <td><strong>5&ordm; CL&Aacute;USULA: DO PAGAMENTO E FINANCIAMENTO</strong></td>
  </tr>
  <tr>
    <td><p>5.1. Para contrata&ccedil;&atilde;o do servi&ccedil;o de DROPSHIPPING oferecido pela VESTE PRIME os meios de pagamentos ser&atilde;o apenas, DINHEIRO, CART&Atilde;O DE CR&Eacute;DITO e FINANCIAMENTO DE COMPRA DA VESTE PRIME, CORRESPONDENTE BANCARIO DE INSTITUI&Ccedil;&Otilde;ES FINANCEIRA E BANCO DO BRASIL.</p>
    <p>5.2. Pagamento em dinheiro: Deve ser pago antecipadamente no balc&atilde;o de atendimento de umas das unidades da VESTE PRIME.</p>
    <p>5.3. Pagamento pelo cart&atilde;o de cr&eacute;dito: A cobran&ccedil;a no cart&atilde;o de cr&eacute;dito ser&aacute; efetuado diretamente pela loja parceira ou ao seu crit&eacute;rio pela VESTE PRIME.</p>
    <p>5.4. Pagamento por meio do FINANCIAMENTO VESTE PRIME: Ap&oacute;s a analise e aprova&ccedil;&atilde;o do cr&eacute;dito, a VESTE PRIME ir&aacute; financi&aacute; a compra do produto e/ou servi&ccedil;o realizado pelo sistema de DROPSHIPING, sendo que o cliente ter&aacute; que pagar mensalmente as parcelas que vencerem diretamente nas unidades e atendimento da VESTE PRIME.</p></td>
  </tr>
  <tr>
    <td><strong>6&ordm; CL&Aacute;USULA: DA GARANTIA</strong></td>
  </tr>
  <tr>
    <td><p>6.1. Todos os produtos oferecidos pelo sistema de DROPSHIPING da VESTE PRIME tem garantia legal prevista em lei de 90 dias, podendo ser oferecido pelo fabricante do produto uma garantia a mais, n&atilde;o podendo ser ultrapassado 12 meses.</p>
    <p>6.2. A solicita&ccedil;&atilde;o da garantia deve ser feita diretamente ao fabricante.</p>
    <p>6.3. A nota fiscal original do produto deve ser solicitada diretamente nas unidades da VESTE PRIME.</p>
    <p>6.4. A VESTE PRIME n&atilde;o se responsabiliza por qualquer tipo de dano ao produto ou de atedimento e presta&ccedil;&atilde;o para reparo do produto, o mesmo deve ser feito diretamente ao fabricante.</p></td>
  </tr>
  <tr>
    <td><strong>7&ordm; CL&Aacute;USULA: DIFEREN&Ccedil;A DE VALORES DO PRODUTO</strong></td>
  </tr>
  <tr>
    <td><p>7.1. Por ser sistema de DROPSHIPING, a VESTE PRIME tem parcerias com lojas oficiais para adiquirir produtos com um pre&ccedil;o mais acess&iacute;vel, sendo que a nota fiscal original ser&aacute; emitida com o valor.</p>
    <p>7.2. Conforme consta no &iacute;tem 7.1. A crit&eacute;rio os produtos s&atilde;o adquiridos nas lojas parceiras por um pre&ccedil;o mais acess&iacute;vel repassados ao cliente com um valor maior, tendo em vista esta condi&ccedil;&atilde;o, o cliente concorda com tal informa&ccedil;&atilde;o.</p></td>
  </tr>
</table>
<p></p>
<p></p>
<p></p>
<p>&nbsp;</p>
<p><strong>Taiba, </strong>S&atilde;o Gon&ccedil;alo do Amarante, <? echo date("d"); ?> de
  <? $mes = date("m");
		
		if($mes == '1'){
			echo "janeiro";
		}elseif($mes == '2'){
			echo "fevereiro";
		}elseif($mes == '3'){
			echo "mar&ccedil;o";
		}elseif($mes == '4'){
			echo "abril";
		}elseif($mes == '5'){
			echo "maio";
		}elseif($mes == '6'){
			echo "junho";
		}elseif($mes == '7'){
			echo "julho";
		}elseif($mes == '8'){
			echo "agosto";
		}elseif($mes == '9'){
			echo "setembro";
		}elseif($mes == '10'){
			echo "outubro";
		}elseif($mes == '11'){
			echo "novembro";
		}else{
			echo "dezembro";
		}
	
	 ?>
de <? echo date("Y"); ?></p>
<p></p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>_________________________________________</p>
<p>NOME DO CLIENTE: <? echo strtoupper($res_dados_cliente['nome']); ?></p>
<p></p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>_____________________________________</p>
<p>OPERADOR: 
  <?

 $sql_operador = mysqli_query($conexao_bd, "SELECT * FROM adm WHERE cpf = '$operador'");
 while($res_operador = mysqli_fetch_array($sql_operador)){
	 	echo $res_operador['nome'];
	 }

?>
</p>
<p>&nbsp;</p>

<? }}} ?>
</body>
</html>