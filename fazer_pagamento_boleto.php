<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/fazer_pagamento_boleto.css" rel="stylesheet" type="text/css" />
</head>

<body>
<? require "topo.php"; ?>
<div id="box_pagamento_1">
<? if($_GET['p'] == ''){ ?>

<? echo "<script language='javascript'>window.location='?p=1';</script>"; ?>

<? } // FECHA A VERIFICAÇÃO DE PAGAMENTOS ?>



<? if($_GET['p'] == '1'){ ?>
<h1><strong>Informe o código de barras que será feito o pagamento</strong></h1>
<form name="" method="post" action="" enctype="multipart/form-data">
  <span id="sprytextfield_valida_codigo_barras">
  <input class="input" type="text" name="codigo_barras" />
  <span class="textfieldRequiredMsg"></span><span class="textfieldInvalidFormatMsg"></span></span>
  <input class="input2" type="submit" name="valida" value="Avançar" />
</form>
<hr />
<? if(isset($_POST['valida'])){
	
$codigo_barras = $_POST['codigo_barras'];
if($codigo_barras == ''){
	echo "<script language='javascript'>window.alert('Por favor, digite o código de barras para verificação');window.location='';</script>";
}else{
	
$banco1 = $codigo_barras[0];
$banco2 = $codigo_barras[1];
$banco3 = $codigo_barras[2];

$moeda = $codigo_barras[3];

$banco = "$banco1$banco2$banco3";

$vencimento = date("d/m/Y");

$empresa12 = $codigo_barras[12];
$empresa13 = $codigo_barras[13];
$empresa14 = $codigo_barras[14];
$empresa15 = $codigo_barras[15];
$empresa16 = $codigo_barras[16];

$empresa = "$empresa12$empresa13$empresa14$empresa15$empresa16";

$valor2 = $codigo_barras[44];
$valor3 = $codigo_barras[45];
$valor4 = $codigo_barras[46];
$valor5 = $codigo_barras[47];
$valor6 = $codigo_barras[48];
$valor7 = $codigo_barras[49];
$valor8 = $codigo_barras[50];
$valor9 = $codigo_barras[51];
$valor10 = $codigo_barras[52];
$valor11 = $codigo_barras[53];

$valor = "$valor2$valor3$valor4$valor5$valor6$valor7$valor8$valor9.$valor10$valor11";



$valor40 = $codigo_barras[40];
$valor41 = $codigo_barras[41];
$valor42 = $codigo_barras[42];
$valor43 = $codigo_barras[43];

$code_vencimento = "$valor40$valor41$valor42$valor43";

$sql_verifica_banco = mysql_query("SELECT * FROM lista_bancos WHERE codigo = '$banco'");
if(mysql_num_rows($sql_verifica_banco) == ''){
echo "<script language='javascript'>window.alert('BOLETO COM INFORMAÇÕES INCORRETAS!');</script>";
}else{
if($moeda != 9){
	echo "<script language='javascript'>window.alert('BOLETO COM INFORMAÇÕES INCORRETAS!');</script>";
}else{
	
	$soma_pagamentos = 0;
	$verifica_pagamentos = mysql_query("SELECT * FROM pagamentoboletos WHERE status = 'Aguarda' AND vencimento = '$data'");	
	 	while($res_soma_pagamentos = mysql_fetch_array($verifica_pagamentos)){
			$soma_pagamentos = $soma_pagamentos+$res_soma_pagamentos['valor'];
		}
		
	$soma_depositos = 0;
	$sverifica_depositos = mysql_query("SELECT * FROM deposito_banco_brasil WHERE status = 'Ativo' AND data = '$data'");
	 	while($res_depositos = mysql_fetch_array($sverifica_depositos)){
			$soma_depositos = $soma_depositos+$res_depositos['valor'];
		}
		
	$soma_saque = 0;
	$sverifica_saques = mysql_query("SELECT * FROM saque_banco_brasil WHERE status = 'Ativo' AND data = '$data'");
	 	while($res_saques = mysql_fetch_array($sverifica_saques)){
			$soma_saque = $soma_saque+$res_saques['valor'];
		}	
	
	$saldo_maquina = ($soma_pagamentos+$soma_depositos)-$soma_saque;
	$saldo_com_valor = (($soma_pagamentos+$soma_depositos)-$soma_saque)+$valor;
	
	if($apenas_hora <=13){
		if(($saldo_com_valor) >= 10000 && $apenas_hora > 13){
		echo "<script language='javascript'>window.alert('ATENÇÃO: O VALOR SUPERA O LIMITE DE RECEBIMENTO DESDE CORRESPONDE BANCARIO, POR ISSO, NÃO PODEREMOS RECEBER!');</script>";
		}
	}elseif($apenas_hora >=13){
	 
	} // verifica o horário de pagamento
	
	if(($saldo_maquina+$valor) >= 10000 && $apenas_hora > 13){
		echo "<script language='javascript'>window.alert('ATENÇÃO: O VALOR SUPERA O LIMITE DE RECEBIMENTO DESDE CORRESPONDE BANCARIO, POR ISSO, NÃO PODEREMOS RECEBER!');</script>";
	}elseif($valor > 5000 && $apenas_hora >= 16 && ($saldo_maquina+$valor) >= 10000){
		echo "<script language='javascript'>window.alert('ATENÇÃO: DEVIDO O HORÁRIO, NÃO PODEREMOS RECEBER ESSE PAGAMENTO!');</script>";
	}else{
	echo "<script language='javascript'>window.alert('$valor');</script>";
	}
	
	
   } // vefifica moeda	
  }
 } // verifica se foi digitado o código de barras
}?>


<? } // FECHA VERIFICAÇÃO DO CÓDIGO DE BARRAS ?>






</div><!-- box_pagamento_1 -->

<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield_valida_codigo_barras", "custom", {useCharacterMasking:true, validateOn:["blur"], pattern:"00000.00000 00000.000000 00000.000000 0 00000000000000"});
</script>
</body>
</html>