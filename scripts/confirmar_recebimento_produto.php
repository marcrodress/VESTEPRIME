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
<? require "../config.php";  ?>
<body>
<? if(@$_GET['pg'] == 'muda'){ ?>
<form name="" method="post" enctype="multipart/form-data" action="">
 Quem vai receber o produto?<br />
 <select name="recebedor" size="1">
   <option value="O PROPRIO CLIENTE">O pr&oacute;prio cliente</option>
   <option value="OUTRA PESSOA">Outra pessoa</option>
 </select>
 <input name="enviar" type="submit" value="Enviar" />
</form>
<? if(isset($_POST['enviar'])){

$carrinho = $_GET['carrinho'];
$cliente = $_GET['cliente'];
$produto = $_GET['produto'];
$recebedor = $_POST['recebedor'];

mysqli_query($conexao_bd, "UPDATE loja_online_carrinho SET status_entrega = 'ENTREGUE' WHERE code_carrinho = '$carrinho'");

mysqli_query($conexao_bd, "INSERT INTO loja_online_produto_entregue (data, data_completa, operador, carrinho, recebedor) VALUES ('$data', '$data_completa', '$operador', '$carrinho', '$recebedor')");


echo "<script language='javascript'>window.location='?carrinho=$carrinho&cliente=$cliente&produto=$produto&recebedor=$recebedor';</script>";

}?>
<? } ?>




<? if(@$_GET['pg'] == ''){ ?>
<script language="javascript">window.print();</script>
<h1 style="text-align:center">CONFIRMA&Ccedil;&Atilde;O DE RECEBIMENTO DE PRODUTO<BR />
<span style="font:20px Arial, Helvetica, sans-serif; text-align:center"><? echo date("d/m/Y H:i:s"); ?></span></h1>
<hr />
<h1>
  <? 

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
  
  
  
</h1>
<table width="990" border="0">
  <tr>
    <td width="199" rowspan="5"><img src="../img/logo.png" width="199" height="109" /></td>
    <td colspan="3" align="center" bgcolor="#0099CC"><h2 style="font:20px Arial, Helvetica, sans-serif; text-align:center"><strong>VESTE PRIME - ELETR&Ocirc;NICOS E ACESS&Oacute;RIOS DE CELULARES <br />LOJA ONLINE</strong></h2></td>
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
<h1>1. DADOS DO CLIENTE</h1>
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
    <td><? echo strtolower($res_carrinho['status_pagamento']); ?></td>
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
    <td width="132" bgcolor="#CCCCCC">&nbsp;</td>
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
</table>


<h1>4. DADOS DO RECEBEDOR</h1>
<strong style="float:left;">*Os dados abaixo devem ser preenchidos apenas se o recebedor não for o cliente informado no ítem 1. DADOS DO CLIENTE</strong>
<table width="990" border="0">
  <tr>
    <td colspan="3"><strong>NOME:</strong></td>
  </tr>
  <tr>
    <td height="34" colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td width="257"><strong>NOME DA M&Atilde;E:</strong></td>
    <td width="240"><strong>NOME DO PAI:</strong></td>
    <td width="197"><strong>DATA DE NASCIMENTO:</strong></td>
  </tr>
  <tr>
    <td height="29">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>RG</strong></td>
    <td><strong>TELEFONE 1</strong></td>
    <td><strong>TELEFONE 2</strong></td>
  </tr>
  <tr>
    <td height="32">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>ENDERE&Ccedil;O:</strong></td>
    <td><strong>BAIRRO:</strong></td>
    <td><strong>CEP:</strong></td>
  </tr>
  <tr>
    <td height="34">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="28" colspan="3"><strong>E-MAIIL(S):</strong></td>
  </tr>
  <tr>
    <td height="28"><strong>FORMA DE AUTORIZA&Ccedil;&Atilde;O DE RECEBIMENTO</strong></td>
    <td height="28"><strong>DATA DA AUTORIZA&Ccedil;&Atilde;O</strong></td>
    <td height="28"><strong>HORA COMPLETA DA AUTORIZA&Ccedil;&Atilde;O</strong></td>
  </tr>
  <tr>
    <td height="28">&nbsp;</td>
    <td height="28">&nbsp;</td>
    <td height="28">&nbsp;</td>
  </tr>
</table>
<p style="text-align:left;">&nbsp;</p>
<h1>5. CONFIRMA&Ccedil;&Atilde;O DE RECEBIMENTO DE PRODUTO</h1>
<p style="text-align:left;">Declaro para devido fins de prova, que recebi o produto acima informado e estou ciente de todas as condi&ccedil;&otilde;es estabelecidas no contrato de presta&ccedil;&atilde;o de servi&ccedil;o.</p>
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
 de <? echo date("Y"); ?>.</p>
<p></p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>_________________________________________</p>
<p>ASSINATURA DO RECEBEDOR DO PRODUTO</p>
<p></p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>_____________________________________</p>
<p>OPERADOR: <?

 $sql_operador = mysqli_query($conexao_bd, "SELECT * FROM adm WHERE cpf = '$operador'");
 while($res_operador = mysqli_fetch_array($sql_operador)){
	 	echo $res_operador['nome'];
	 }

?></p>
<p>&nbsp;</p>

<? }}} ?>


<? } ?>
</body>
</html>