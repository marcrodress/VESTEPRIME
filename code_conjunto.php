<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/fazer_pagamento.css" rel="stylesheet" type="text/css" />
</head>

<body>
<? require "topo.php";  require "scripts/verificador_caixa.php"; ?>

<div id="box_pagamento_1">
<? if($_GET['p'] == ''){ ?>
<h1><strong>SELECIONE O TIPO DE PAGAMENTO</strong> - <? echo $apenas_hora; ?> horas</h1>
<form name="" method="post" action="" enctype="multipart/form-data">
 <select class="select" name="tipo_convenio"  autofocus>
  <option value="BOLETO">BOLETO</option>
  <option value="CONVENIO">CONVÊNIO</option>
 </select>
 <input class="botao_avancar" type="submit" name="avancar" value="Avançar" />
</form>


<br /><br /><br /><br />

<?
$limite = 10000;

$pagamentos = 0;
$juros = 0;
$percentual_atual = 0;
$soma_saques = 0;
$soma_saques_bb = 0;
$transferencia_ted = 0;
$deposito_banco_brasil = 0;
$emprestimo_cartao = 0;
$sangria_caixa = 0;


$sql_soma_saques = mysqli_query($conexao_bd, "SELECT * FROM saques WHERE data = '$data'");
	while($res_saque = mysqli_fetch_array($sql_soma_saques)){
	 	$soma_saques = $res_saque['valor']+$soma_saques;
  } 

$sql_soma_saques_bb = mysqli_query($conexao_bd, "SELECT * FROM saque_banco_brasil WHERE data = '$data' AND status != 'Cancelado'");
	while($res_saque_bb = mysqli_fetch_array($sql_soma_saques_bb)){
	 	$soma_saques_bb = $res_saque_bb['valor']+$soma_saques_bb;
  }
$sql_transferencia_ted = mysqli_query($conexao_bd, "SELECT * FROM transferencia_ted WHERE data = '$data' AND status != 'Cancelado'");
	while($res_transferencia_ted = mysqli_fetch_array($sql_transferencia_ted)){
	 	$transferencia_ted = $res_transferencia_ted['valor']+$transferencia_ted;
  }
$sql_deposito_banco_brasil = mysqli_query($conexao_bd, "SELECT * FROM deposito_banco_brasil WHERE data = '$data' AND status != 'Cancelado'");
	while($res_deposito_banco_brasil = mysqli_fetch_array($sql_deposito_banco_brasil)){
	 	$deposito_banco_brasil = $res_deposito_banco_brasil['valor']+$deposito_banco_brasil;
  }
$sql_emprestimo_cartao = mysqli_query($conexao_bd, "SELECT * FROM emprestimo_cartao WHERE data = '$data' AND status != 'Cancelado'");
	while($res_emprestimo_cartao = mysqli_fetch_array($sql_emprestimo_cartao)){
	 	$emprestimo_cartao = $res_emprestimo_cartao['valor']+$emprestimo_cartao;
  }

$sql_soma_pagamento = mysqli_query($conexao_bd, "SELECT * FROM pagamento_boletos WHERE data = '$data' AND status != 'CANCELADO'");
	while($res_soma = mysqli_fetch_array($sql_soma_pagamento)){
	 	$pagamentos = ($res_soma['valor']+$res_soma['juros'])+$pagamentos;
  }

$sql_sangria_caixa = mysqli_query($conexao_bd, "SELECT * FROM sangria_caixa WHERE data = '$data'");
	while($res_sangria_caixa = mysqli_fetch_array($sql_sangria_caixa)){
	 	$sangria_caixa = $res_sangria_caixa['valor']+$sangria_caixa;
  }


$saldo = (($pagamentos+$deposito_banco_brasil+$transferencia_ted)-($soma_saques+$soma_saques_bb+$emprestimo_cartao+$sangria_caixa));
$percentual_atual = ($saldo*100)/$limite;

$verifica_limite = mysqli_query($conexao_bd, "SELECT * FROM limites_operacionais WHERE data = '$data'");
if(mysqli_num_rows($verifica_limite) == ''){
	mysqli_query($conexao_bd, "INSERT INTO limites_operacionais (data, saldo) VALUES ('$data', '$saldo')");
}else{
	mysqli_query($conexao_bd, "UPDATE limites_operacionais SET saldo = '$saldo' WHERE data = '$data'");
}


if($percentual_atual >=60){
?>

<hr />

<h2><strong>Atenção:</strong><br />

<?
echo number_format($percentual_atual,2);
?>% do limite de recebimento foi atingido e o saldo para recebimento é de R$ <? echo number_format($limite-$saldo,2, ',', '.'); ?>.<br />
Faça saques e libere o limite de recebimento.
</h2>
<hr />
<? } ?>



<? if(isset($_POST['avancar'])){
	
$tipo_pagamento = $_POST['tipo_convenio'];


$cliente = 0;
$carrinho = 0;
$code_carrinho = 0;
$sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM carrinho WHERE status = 'Ativo' AND ip = '$ip'");
while($res_cliente = mysqli_fetch_array($sql_cliente)){
$cliente = $res_cliente['cliente'];
$code_carrinho = $res_cliente['code_carrinho'];
$carrinho = $res_cliente['code_carrinho'];
}


if($percentual_atual >= 100){
echo "<script language='javascript'>window.alert('O LIMITE DE PAGAMENTOS FOI ATINGIDO, FAÇA SAQUES PARA LIBERAR PAGAMENTOS!');window.location='fazer_pagamento.php?p=';</script>";
}else{
echo "<script language='javascript'>window.location='?p=2&tipo=$tipo_pagamento';</script>";
}

}?>

<? }// pagamentos 1 ?>







<? if($_GET['p'] == '2'){ ?>
<h1><strong>DIGITE O CÓDIGO DE BARRAS</strong></h1>
<? if($_GET['tipo'] == 'BOLETO'){ ?>
<form name="" method="post" action="" enctype="multipart/form-data">
  <span id="sprytextfield500">
  <input class="codigo_barras" type="text" name="boleto"  autofocus/>
  <span class="textfieldRequiredMsg"></span><span class="textfieldInvalidFormatMsg"></span></span>
 <input class="botao_avancar2" type="submit" name="avancar" value="Avançar" />
</form>

<?
$limite = 10000;

$pagamentos = 0;
$juros = 0;
$percentual_atual = 0;
$soma_saques = 0;
$soma_saques_bb = 0;
$transferencia_ted = 0;
$deposito_banco_brasil = 0;
$emprestimo_cartao = 0;
$sangria_caixa = 0;


$sql_soma_saques = mysqli_query($conexao_bd, "SELECT * FROM saques WHERE data = '$data'");
	while($res_saque = mysqli_fetch_array($sql_soma_saques)){
	 	$soma_saques = $res_saque['valor']+$soma_saques;
  } 

$sql_soma_saques_bb = mysqli_query($conexao_bd, "SELECT * FROM saque_banco_brasil WHERE data = '$data' AND status != 'Cancelado'");
	while($res_saque_bb = mysqli_fetch_array($sql_soma_saques_bb)){
	 	$soma_saques_bb = $res_saque_bb['valor']+$soma_saques_bb;
  }
$sql_transferencia_ted = mysqli_query($conexao_bd, "SELECT * FROM transferencia_ted WHERE data = '$data' AND status != 'Cancelado'");
	while($res_transferencia_ted = mysqli_fetch_array($sql_transferencia_ted)){
	 	$transferencia_ted = $res_transferencia_ted['valor']+$transferencia_ted;
  }
$sql_deposito_banco_brasil = mysqli_query($conexao_bd, "SELECT * FROM deposito_banco_brasil WHERE data = '$data' AND status != 'Cancelado'");
	while($res_deposito_banco_brasil = mysqli_fetch_array($sql_deposito_banco_brasil)){
	 	$deposito_banco_brasil = $res_deposito_banco_brasil['valor']+$deposito_banco_brasil;
  }
$sql_emprestimo_cartao = mysqli_query($conexao_bd, "SELECT * FROM emprestimo_cartao WHERE data = '$data' AND status != 'Cancelado'");
	while($res_emprestimo_cartao = mysqli_fetch_array($sql_emprestimo_cartao)){
	 	$emprestimo_cartao = $res_emprestimo_cartao['valor']+$emprestimo_cartao;
  }

$sql_soma_pagamento = mysqli_query($conexao_bd, "SELECT * FROM pagamento_boletos WHERE data = '$data' AND status != 'CANCELADO'");
	while($res_soma = mysqli_fetch_array($sql_soma_pagamento)){
	 	$pagamentos = ($res_soma['valor']+$res_soma['juros'])+$pagamentos;
  }

$sql_sangria_caixa = mysqli_query($conexao_bd, "SELECT * FROM sangria_caixa WHERE data = '$data'");
	while($res_sangria_caixa = mysqli_fetch_array($sql_sangria_caixa)){
	 	$sangria_caixa = $res_sangria_caixa['valor']+$sangria_caixa;
  }


$saldo = (($pagamentos+$deposito_banco_brasil+$transferencia_ted)-($soma_saques+$soma_saques_bb+$emprestimo_cartao+$sangria_caixa));
$percentual_atual = ($saldo*100)/$limite;

$verifica_limite = mysqli_query($conexao_bd, "SELECT * FROM limites_operacionais WHERE data = '$data'");
if(mysqli_num_rows($verifica_limite) == ''){
	mysqli_query($conexao_bd, "INSERT INTO limites_operacionais (data, saldo) VALUES ('$data', '$saldo')");
}else{
	mysqli_query($conexao_bd, "UPDATE limites_operacionais SET saldo = '$saldo' WHERE data = '$data'");
}


if($percentual_atual >=60){
?>

<br /><br /><br /><br />
<hr />
<h2><strong>Atenção:</strong><br />

<?
echo number_format($percentual_atual,2);
?>% do limite de recebimento foi atingido e o saldo para recebimento é de R$ <? echo number_format($limite-$saldo,2, ',', '.'); ?>.<br />
Faça saques e libere o limite de recebimento.
</h2>
<hr />
<? } ?>
<? } ?>

<? if($_GET['tipo'] == 'CONVENIO'){ ?>
<form name="" method="post" action="" enctype="multipart/form-data">
  <span id="sprytextfield0616151">
  <input class="codigo_barras" type="text" name="boleto"  autofocus/>
  <span class="textfieldRequiredMsg"></span><span class="textfieldInvalidFormatMsg"></span></span>
 <input class="botao_avancar2" type="submit" name="avancar2" value="Avançar" />
</form>

<?
$limite = 7500;

$pagamentos = 0;
$juros = 0;
$percentual_atual = 0;
$soma_saques = 0;
$soma_saques_bb = 0;
$transferencia_ted = 0;
$deposito_banco_brasil = 0;
$emprestimo_cartao = 0;
$sangria_caixa = 0;


$sql_soma_saques = mysqli_query($conexao_bd, "SELECT * FROM saques WHERE data = '$data'");
	while($res_saque = mysqli_fetch_array($sql_soma_saques)){
	 	$soma_saques = $res_saque['valor']+$soma_saques;
  } 

$sql_soma_saques_bb = mysqli_query($conexao_bd, "SELECT * FROM saque_banco_brasil WHERE data = '$data' AND status != 'Cancelado'");
	while($res_saque_bb = mysqli_fetch_array($sql_soma_saques_bb)){
	 	$soma_saques_bb = $res_saque_bb['valor']+$soma_saques_bb;
  }
$sql_transferencia_ted = mysqli_query($conexao_bd, "SELECT * FROM transferencia_ted WHERE data = '$data' AND status != 'Cancelado'");
	while($res_transferencia_ted = mysqli_fetch_array($sql_transferencia_ted)){
	 	$transferencia_ted = $res_transferencia_ted['valor']+$transferencia_ted;
  }
$sql_deposito_banco_brasil = mysqli_query($conexao_bd, "SELECT * FROM deposito_banco_brasil WHERE data = '$data' AND status != 'Cancelado'");
	while($res_deposito_banco_brasil = mysqli_fetch_array($sql_deposito_banco_brasil)){
	 	$deposito_banco_brasil = $res_deposito_banco_brasil['valor']+$deposito_banco_brasil;
  }
$sql_emprestimo_cartao = mysqli_query($conexao_bd, "SELECT * FROM emprestimo_cartao WHERE data = '$data' AND status != 'Cancelado'");
	while($res_emprestimo_cartao = mysqli_fetch_array($sql_emprestimo_cartao)){
	 	$emprestimo_cartao = $res_emprestimo_cartao['valor']+$emprestimo_cartao;
  }

$sql_soma_pagamento = mysqli_query($conexao_bd, "SELECT * FROM pagamento_boletos WHERE data = '$data' AND status != 'CANCELADO'");
	while($res_soma = mysqli_fetch_array($sql_soma_pagamento)){
	 	$pagamentos = ($res_soma['valor']+$res_soma['juros'])+$pagamentos;
  }

$sql_sangria_caixa = mysqli_query($conexao_bd, "SELECT * FROM sangria_caixa WHERE data = '$data'");
	while($res_sangria_caixa = mysqli_fetch_array($sql_sangria_caixa)){
	 	$sangria_caixa = $res_sangria_caixa['valor']+$sangria_caixa;
  }


$saldo = (($pagamentos+$deposito_banco_brasil+$transferencia_ted)-($soma_saques+$soma_saques_bb+$emprestimo_cartao+$sangria_caixa));
$percentual_atual = ($saldo*100)/$limite;

$verifica_limite = mysqli_query($conexao_bd, "SELECT * FROM limites_operacionais WHERE data = '$data'");
if(mysqli_num_rows($verifica_limite) == ''){
	mysqli_query($conexao_bd, "INSERT INTO limites_operacionais (data, saldo) VALUES ('$data', '$saldo')");
}else{
	mysqli_query($conexao_bd, "UPDATE limites_operacionais SET saldo = '$saldo' WHERE data = '$data'");
}


if($percentual_atual >=60){
?>

<br /><br /><br /><br />
<hr />
<h2><strong>Atenção:</strong><br />

<?
echo number_format($percentual_atual,2);
?>% do limite de recebimento foi atingido e o saldo para recebimento é de R$ <? echo number_format($limite-$saldo,2, ',', '.'); ?>.<br />
Faça saques e libere o limite de recebimento.
</h2>
<hr />
<? } ?>
<? } ?>



<? if(isset($_POST['avancar2'])){  
$codigo_barras = $_POST['boleto'];
$tipo_pagamento = $_GET['tipo'];
$nega = $_GET['nega'];
$sem_cobranca = $_GET['sem_cobranca'];

$sql_verifica_convenio = mysqli_query($conexao_bd, "SELECT * FROM pagamento_boletos WHERE code_barras = '$codigo_barras' AND status != 'CANCELADO'");
if(mysqli_num_rows($sql_verifica_convenio) >=1){
echo "<br><br><br><br><hr><h3 class='h3'><strong>ATENÇÃO: ESTE PAGAMENTO JÁ FOI EFETUADO E NÃO PODERÁ SER REFEITO!</strong></h3>";
}else{
echo "<script language='javascript'>window.location='?p=2&tipo=CONVENIO&acao=verifica_convenio&boleto=$codigo_barras&nega=$nega&sem_cobranca=$sem_cobranca';</script>";
}} // verifica informações do convênio?>

<? if($_GET['acao'] == 'verifica_convenio'){ require "pagamento_contas/verifica_convenio.php"; } ?>



<? if(isset($_POST['avancar'])){ 
$codigo_barras = $_POST['boleto'];
$tipo_pagamento = $_GET['tipo'];
$nega = $_GET['nega'];
$sem_cobranca = $_GET['sem_cobranca'];


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

$valor = "$valor6$valor7$valor8$valor9.$valor10$valor11";
$valor = $valor+0;

$sql_verifica_boletos = 0;

if($valor == 0){
$sql_verifica_boletos = mysqli_query($conexao_bd, "SELECT * FROM pagamento_boletos WHERE code_barras = '$codigo_barras' AND status != 'CANCELADO' AND data = '$data'");
}else{
$sql_verifica_boletos = mysqli_query($conexao_bd, "SELECT * FROM pagamento_boletos WHERE code_barras = '$codigo_barras' AND status != 'CANCELADO'");	
}
if(mysqli_num_rows($sql_verifica_boletos) >= 1){		
echo "<br><br><br><br><hr><h3 class='h3'><strong>ATENÇÃO: ESTE PAGAMENTO JÁ FOI EFETUADO E NÃO PODERÁ SER REFEITO!</strong></h3>";
}else{

if($valor == ''){
echo "<script language='javascript'>window.location='?p=valor_boletotipo=BOLETO&acao=valor_boleto&boleto=$codigo_barras&nega=$nega&sem_cobranca=$sem_cobranca';</script>";
}else{
echo "<script language='javascript'>window.location='?p=2&tipo=BOLETO&acao=verifica_boleto&boleto=$codigo_barras&nega=$nega&sem_cobranca=$sem_cobranca';</script>";
// verifica informacoes do boleto
}}}
?>
<? if($_GET['acao'] == 'verifica_boleto'){ require "pagamento_contas/verifica_boleto.php"; } ?>





<? }// pagamentos 2 ?>


<? if($_GET['acao'] == 'valor_boleto'){ ?>
<? if(isset($_POST['confirma'])){

$valor_fatura = $_POST['valor_fatura'];
$tipo = $_GET['tipo'];
$codigo_barras = $_GET['boleto'];
$nega = $_GET['nega'];
$sem_cobranca = $_GET['sem_cobranca'];

@$pontos = array(",", ".");
@$valor_fatura = str_replace($pontos, ".", $valor_fatura);

echo "<script language='javascript'>window.location='?p=2&tipo=BOLETO&acao=verifica_boleto&boleto=$codigo_barras&nega=$nega&sem_cobranca=$sem_cobranca&valor=$valor_fatura';</script>";


}?>
 <form name="" method="post" action="" enctype="multipart/form-data">
  <h1 class="h5">
   Valor da fatura
   <input type="text" name="valor_fatura" class="input_juros" size="10"  autofocus/>
   <input type="submit" name="confirma" value="Avança" />   
   </h1>
 </form>
<? } ?>




<? if($_GET['p'] == 'juros'){ ?>
<? if(isset($_POST['avancar'])){
	
$tipo_juros = $_POST['tipo_multa'];
$select_type_juros = $_POST['tipo_juros'];
$multa = $_POST['multa'];
$juros = $_POST['juros'];

$tipo_pagamento = $_GET['tipo'];
$vencimento = $_GET['vencimento'];
$empresa = $_GET['empresa'];
$valor = $_GET['valor'];
$codigo_barras = $_GET['codigo_barras'];
$banco = $_GET['banco'];
$code_vencimento = $_GET['code_vencimento'];
$tarifa = $_GET['tarifa'];
$boleto_vencido = $_GET['boleto_vencido'];
$existe_boleto = $_GET['existe_boleto'];

$code_vencimento_hoje = $_GET['code_vencimento_hoje'];

$novo_vencimento = 0;

$verifica_se_juros_aceita = mysqli_query($conexao_bd, "SELECT * FROM datas_pagamento_contas WHERE dia = '$data'");
if(mysqli_num_rows($verifica_se_juros_aceita) >= 1){
	while($res_novo_vencimento = mysqli_fetch_array($verifica_se_juros_aceita)){
		  $novo_vencimento = $res_novo_vencimento['proximo_dia'];
	
	$sql_pega_novo_vencimento = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento WHERE vencimento = '$novo_vencimento'");
		while($res_proximo_vencimento = mysqli_fetch_array($sql_pega_novo_vencimento)){
			$code_vencimento_hoje = $res_proximo_vencimento['codigo'];
		}
	}
}


$total_dias_juros = $code_vencimento_hoje-$code_vencimento;

@$pontos = array(",", ".");
@$multa = str_replace($pontos, ".", $multa);

@$pontos = array(",", ".");
@$juros = str_replace($pontos, ".", $juros);

$tipo_juros = $_POST['tipo_juros'];
$taxa_juros_cobrados = 0;
if($tipo_juros == 1){
	$taxa_juros_cobrados = 3;
}elseif($tipo_juros == 2){
	$taxa_juros_cobrados = 1.5;
}else{
	$taxa_juros_cobrados = 0;
}


if($tipo_juros == 'porcentagem'){ $multa = ($valor*($multa/100)); }
if($select_type_juros == 'porcentagem'){ $juros = $valor*($juros/100)*($total_dias_juros+3);}
if($select_type_juros == 'reais'){ $juros = $juros*($total_dias_juros+3);}


$soma_juros_e_multa = $multa+$juros;

if($multa == 0 && $juros == 0){
echo "<script language='javascript'>window.location='?p=3&tipo=$tipo_pagamento&vencimento=$vencimento&empresa=$empresa&valor=$valor&codigo_barras=$codigo_barras&banco=$banco&code_vencimento=$code_vencimento&tarifa=$tarifa&boleto_vencido=2&existe_boleto=$verifica_tarifa_superior';</script>";
}else{
echo "<script language='javascript'>window.location='?p=3&tipo=$tipo_pagamento&vencimento=$vencimento&empresa=$empresa&valor=$valor&codigo_barras=$codigo_barras&banco=$banco&code_vencimento=$code_vencimento&tarifa=$tarifa&boleto_vencido=$boleto_vencido&existe_boleto=$existe_boleto&valor_juros=$soma_juros_e_multa&taxa_juros_cobrados=$taxa_juros_cobrados';</script>";
 } //
}?>

 <form name="" method="post" action="" enctype="multipart/form-data">
  <h1 class="h5">
   <select class="select_type_juros" name="tipo_multa" size="1">
     <option value="porcentagem">%</option>
     <option value="reais">$</option>
   </select>
   Multa 
   <input name="multa" type="text" class="input_juros" size="2"  autofocus/>
   Juros 
   <select class="select_type_juros" name="tipo_juros" size="1">
     <option value="porcentagem">%</option>
     <option value="reais">$</option>
   </select> 
   <input type="text" name="juros" class="input_juros" size="2" />    
   <select class="select_type_juros" name="tipo_juros" size="1">
     <option value="1">1</option>
     <option value="2">2</option>
     <option value="3">3</option>
   </select>   
  <input type="submit" name="avancar" value="Avançar" />
  </h1>
 </form>
<? } // fecha juros ?>

<? if($_GET['acao'] == 'pega_data'){ ?>
<? if(isset($_POST['confirma'])){
	
$data_vencimento = $_POST['data_vencimento'];

$tipo_pagamento = $_GET['tipo'];
$valor = $_GET['valor'];
$codigo_barras = $_GET['codigo_barras'];
$tarifa = $_GET['tarifa'];
$convenio = $_GET['convenio'];
$boleto_tarifado = $_GET['boleto_tarifado'];
$tarifa = $_GET['tarifa'];

$code_vencimento = 0;
$code_hoje = 0;

$busca_vencimento = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento WHERE vencimento = '$data_vencimento'");
while($res_busca_vencimento = mysqli_fetch_array($busca_vencimento)){
	$code_vencimento = $res_busca_vencimento['codigo'];
}
$busca_hoje = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento WHERE vencimento = '$data'");
while($res_busca_hoje = mysqli_fetch_array($busca_hoje)){
	$code_hoje = $res_busca_hoje['codigo'];
}
if($code_hoje > $code_vencimento){
	echo "<br><br><br><br><hr><h3 class='h3'><strong>O CONVÊNIO DE VENCIMENTO ESTÁ VENCIDO E NÃO É ACEITO O PAGAMENTO DO MESMO!</strong></h3><ul>";
	die;
}elseif($code_hoje == $code_vencimento && $apenas_hora > 16){
	echo "<br><br><br><br><hr><h3 class='h3'><strong>O CONVÊNIO DE VENCIMENTO ESTÁ VENCIDO E NÃO É ACEITO O PAGAMENTO DO MESMO!</strong></h3><ul>";
	die;
}else{
echo "<script language='javascript'>window.location='?p=3&tipo=$tipo_pagamento&vencimento=$data_vencimento&valor=$valor&codigo_barras=$codigo_barras&convenio=$convenio&tarifa=$tarifa&boleto_tarifado=$boleto_tarifado';</script>";
 }
}?>
 <form name="" method="post" action="" enctype="multipart/form-data">
  <h1 class="h5">
   Vencimento <span id="sprytextfield1_vencimento_convenio">
   <input type="text" name="data_vencimento" class="input_juros" size="20" value="<? echo date("d/m/Y"); ?>"/>
   <span class="textfieldRequiredMsg"></span><span class="textfieldInvalidFormatMsg"></span></span>
   <input type="submit" name="confirma" value="Avança"  autofocus/>   
   </h1>
 </form>
<? } ?>








<? if($_GET['p'] == '3'){ ?>
<? if($_GET['tipo'] == 'BOLETO'){ ?>

<? if(isset($_POST['buttons'])){ require "pagamento_contas/verifica_informacoes_boleto.php"; }?>


<h1><strong>VERIFIQUE AS INFORMAÇÕES CONTIDAS ABAIXO E CONFIRME O PAGAMENTO</strong></h1>
<form name="" method="post" action="" enctype="multipart/form-data">
<hr /><table width="950" border="0">
  <tr>
    <td colspan="3"><label for="textfield"></label>
    <input class="codigo_barras2" name="textfield" type="text" value="<? echo @$_GET['codigo_barras']; ?>" disabled id="textfield"></td>
  </tr>
  <tr>
    <td width="130">&nbsp;</td>
    <td align="right" width="473"><strong>BANCO FAVORECIDO</strong></td>
    <?  $banco2 = 0; ?>
    <td width="386"><input class="valores2" name="textfield2" type="text" disabled id="textfield2" value="<?
    $banco = $_GET['banco'];
	
	$sql_banco = mysqli_query($conexao_bd, "SELECT * FROM lista_bancos WHERE codigo = '$banco'");
		while($res_banco = mysqli_fetch_array($sql_banco)){
				echo $banco2 = $res_banco['nome_banco'];
			}
	
	
	?>"/></td><input type="hidden" name="banco" value="<? echo $banco2; ?>" />
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right"><strong>VENCIMENTO</strong>
    <?
	$code_hoje = 0;
	$sql_vencimento = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento WHERE vencimento = '$data'");
		while($res_vencimento = mysqli_fetch_array($sql_vencimento)){
			
			$code_hoje = $res_vencimento['codigo'];
	}
	?>
    </td>
    <td>
    <?
	$vencimento = 0;
	$sql_verifica_vencimento = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento WHERE codigo = '".$_GET['code_vencimento']."'");
	if(mysqli_num_rows($sql_verifica_vencimento) != ''){
	?>
    <span id="sprytextfield91111">
     <input name="vencimento" type="text" disabled="disabled" class="valores2" value="<? 
	   while($res_data_vencimento = mysqli_fetch_array($sql_verifica_vencimento)){ 
	   		echo $vencimento = $res_data_vencimento['vencimento'];
		} 
	?>" /></span>
    <input class="valores2" type="hidden" name="vencimento" value="<? echo $vencimento;  ?>" />
	<? }else{ ?>
    <span id="sprytextfield91111"><input class="valores2" type="text" name="vencimento" value="<? echo date("d/m/Y"); ?>" /></span>
    <? } ?>
      </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right"><strong>PAGAMENTO</strong></td>
    <td><label for="textfield4"></label>
      <span id="sprytextfield260000165412">
      <? $pagamento = 0; ?>
      <input name="textfield4" type="text" disabled="disabled" class="valores2" id="textfield4" value="<?
	  $dia_pagamento = date("d/m/Y");
	  $sql_pagamento = mysqli_query($conexao_bd, "SELECT * FROM datas_pagamento_contas WHERE dia = '$dia_pagamento'");
	  if(mysqli_num_rows($sql_pagamento) == ''){
		  echo $dia_pagamento = date("d/m/Y");
	  }else{
		  while($res_pagamento = mysqli_fetch_array($sql_pagamento)){
			 echo $dia_pagamento = $res_pagamento['proximo_dia'];
	   }
	  }
	  ?>   
      " />
      <input type="hidden" name="dia_pagamento" value="<? echo $dia_pagamento ?>" />
      </span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right"><strong>VALOR DO DOCUMENTO</strong></td>
    <td>
    <? if($_GET['valor'] == '0'){ ?>
      <input name="valor" type="text" class="valores2" id="textfield5" value="<? echo number_format($_GET['valor'], 2, ',', '.'); ?>" />
    <? }else{ ?>
      <input name="valorer" type="text" disabled="disabled" class="valores2" id="textfield5" value="<? echo number_format($_GET['valor'], 2, ',', '.'); ?>" /> <input type="hidden" name="valor" value="<? echo $_GET['valor']; ?>" />
      <? } ?>
      </td>
  </tr>
  <? if($_GET['boleto_vencido'] == 1){ ?>
  <tr>
    <td>&nbsp;</td>
    <td align="right"><strong>JUROS E MULTA</strong></td>
    <td><input name="juros_multa" type="text" disabled="disabled" class="valores2" id="textfield7" value="<? echo number_format($_GET['valor_juros']+$_GET['taxa_juros_cobrados'], 2, ',', '.'); ?>" /></td>
  </tr>
  <? } ?>
  
  <? if($_GET['boleto_vencido'] == 0){ ?>
  <tr>
    <td>&nbsp;</td>
    <td align="right"><strong>DESCONTOS</strong></td>
    <td>
      <input name="descontos" type="text" class="valores2" id="textfield5" value="" />
      </td>
  </tr>
  <? } ?>
  <tr>
    <td>&nbsp;</td>
    <td align="right"><strong>TELEFONE</strong></td>
    <td><span id="sprytextfield2">
    <input name="telefone" type="text" class="valores2" id="textfield3" value=""  autofocus/>
    </span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right"><strong>VALOR COBRADO</strong></td>
    <td><input name="telefone" type="text" disabled="disabled" class="valores2" id="textfield3" value="<? 
	$boleto_vencido = 0;
	if($_GET['valor_juros'] == 0){
		$boleto_vencido = 0;
	}else{
		$boleto_vencido = $_GET['taxa_juros_cobrados'];
	}
	echo number_format($_GET['valor']+($_GET['valor_juros']+$boleto_vencido), 2, ',', '.'); 
	
	?>" />
     <h6>
     <input name="impresso" type="checkbox" value="SIM"/>
     Boleto impresso</h6>
      </td>
  </tr>
  <tr>
    <td align="center" colspan="3"><hr><input class="botao_avancar3" type="submit" name="buttons" id="button" value="CONFIRMAR"></td>
  </tr>
</table>
</form>


<? } // verifica tipo de pagamento é boleto ?>





















<? if($_GET['tipo'] == 'CONVENIO'){ ?>


<? if(isset($_POST['buttonss'])){ require "pagamento_contas/verifica_informacoes_convenio.php"; } // fecha post ?>

<h1><strong>VERIFIQUE AS INFORMAÇÕES ABAIXO E CONFIRME O PAGAMENTO</strong></h1>
<form name="" method="post" action="" enctype="multipart/form-data">
<hr /><table width="950" border="0">
  <tr>
    <td colspan="3"><label for="textfield"></label>
    <input class="codigo_barras2" name="textfield" type="text" value="<? echo @$_GET['codigo_barras']; ?>" disabled id="textfield"></td>
  </tr>
  <tr>
    <td width="130">&nbsp;</td>
    <td align="right" width="473"><strong>CONV&Ecirc;NIO</strong></td>
    <td width="386"><input class="valores2" name="textfield2" type="text" disabled id="textfield2" value="<?
    $codeigo_barras = $_GET['codigo_barras'];
	$codigo_barras = $codeigo_barras[1];
	
	$numero_convenio1 = $codeigo_barras[19];
	$numero_convenio2 = $codeigo_barras[20];
	$numero_convenio3 = $codeigo_barras[21];
	$numero_convenio4 = $codeigo_barras[22];
	
	$convenio = 0;
	$verifica_boleto_tarifado = "NAO";
	
	$numero_convenio = $_GET['convenio'];
	
	$vefifica = mysqli_query($conexao_bd, "SELECT * FROM tipos_convenio WHERE codigo = '$numero_convenio'");
	if(mysqli_num_rows($vefifica) >=1){
		while($res_convenio = mysqli_fetch_array($vefifica)){
				echo $convenio = $res_convenio['convenio'];
					 $verifica_boleto_tarifado = $res_convenio['tarifado'];
			}
	}else{
		
	if($codigo_barras == '1'){
		echo $convenio = "Prefeituras";
	}elseif($codigo_barras == '2'){
		echo $convenio = "Saneamento";
	}elseif($codigo_barras == '3'){
		echo $convenio = "Energia Elétrica ou Gás";
	}elseif($codigo_barras == '4'){
		echo $convenio = "Telecomunicações";
	}elseif($codigo_barras == '5'){
		echo $convenio = "Órgãos Governamentais";
	}elseif($codigo_barras == '6'){
		echo $convenio = "Carnes e Assemelhados ou demais
 Empresas";
	}elseif($codigo_barras == '7'){
		echo $convenio = "Multas de trânsito";
	}elseif($codigo_barras == '9'){
		echo $convenio = "Uso exclusivo do banco";
	 }
	}
	
	?>
    ">
    
    <input type="hidden" name="orgao" value="<? echo $convenio; ?>" />
    <input type="hidden" name="verifica_boleto_tarifado" value="<? echo $$verifica_boleto_tarifado; ?>" />
    
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right"><strong>VENCIMENTO</strong></td>
    <td>
      <span id="sprytextfield151515">
      <input class="valores2" type="text" name="vencimento" value="<? if($_GET['vencimento'] != ''){ echo $_GET['vencimento']; }else{ echo date("d/m/Y");} ?>" />
      </span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right"><strong>PAGAMENTO</strong></td>
    <td>
      <span id="sprytextfield260000165412">
            <? $pagamento = 0; ?>
      <input name="textfield4" type="text" disabled="disab2led" class="valores2" id="textfield4" value="<?
	  $dia_pagamento = date("d/m/Y");
	  $sql_pagamento = mysqli_query($conexao_bd, "SELECT * FROM datas_pagamento_contas WHERE dia = '$dia_pagamento'");
	  if(mysqli_num_rows($sql_pagamento) == ''){
		  echo $dia_pagamento = date("d/m/Y");
	  }else{
		  while($res_pagamento = mysqli_fetch_array($sql_pagamento)){
			 echo $dia_pagamento = $res_pagamento['proximo_dia'];
	   }
	  }
	  ?>   
      " />
      <input type="hidden" name="dia_pagamento" value="<? echo $dia_pagamento ?>" />
      </span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right"><strong>VALOR DO PAGAMENTO</strong></td>
    <td>
      <input name="valor" type="text" disabled="disabled" class="valores2" id="textfield5" value="<? echo number_format($_GET['valor'], 2, ',', '.'); ?>" />
      <input type="hidden" name="valor" value="<? echo $_GET['valor']; ?>" />
      </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right"><strong>TELEFONE</strong></td>
    <td><span id="sprytextfield121525">
    <input name="telefone" type="text" class="valores2" id="textfield6"  autofocus/>
    </span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right"><strong>VALOR COBRADO</strong><input name="impresso" type="checkbox" value="SIM" /></td>
    <td>
      <input name="textfield8" class="valores2" type="text" disabled="disabled" value="<? echo number_format($_GET['valor']+$_GET['tarifa']+$_GET['boleto_tarifado'], 2, ',', '.'); ?>" id="textfield8" />
      </td>
  </tr>
  <tr>
    <td align="center" colspan="3"><hr><input class="botao_avancar3" type="submit" name="buttonss" id="button" value="CONFIRMAR"></td>
  </tr>
</table>
</form>


<? } // verifica tipo de pagamento é convênio ?>









<? }// pagamentos 3 ?>






<? if($_GET['p'] == '4'){ ?>
<h1><strong>Informações sobre o pagamento</strong></h1>
<? 
$code_boleto = @$_GET['code_boleto'];
$pagamento_escolhido = 0;
$valor_pagamento = 0;
$sql_boleto = mysqli_query($conexao_bd, "SELECT * FROM pagamento_boletos WHERE code_boleto = '$code_boleto'");
	while($res_boleto = @mysqli_fetch_array($sql_boleto)){
		$pagamento_escolhido = $res_boleto['pagamento_escolhido'];
		$valor_pagamento = $res_boleto['valor']+$res_boleto['juros'];
		
?>
<input class="codigo_barras3" type="text" disabled="disabled" value="<? echo $res_boleto['code_barras']; ?>" />
<div id="pagamento">
<? if(isset($_POST['valor_enviar'])){
	
$forma_pagamento = $_POST['forma_pagamento'];
$valor_enviar = $_POST['valor_enviar'];

@$pontos = array(",", ".");
@$valor_enviar = str_replace($pontos, ".", $valor_enviar);

$tamanho_valor = strlen($valor_enviar);
$verifica_se_existe_virgula = 0;

$verifica_conjunto = 0;


if($valor_enviar == "+"){
	$code_conjunto = date("s")*646+564;
	mysqli_query($conexao_bd, "INSERT INTO pagamento_boleto_conjunto (status, code_conjunto, data, data_completa, cliente) VALUES ('Aguarda', '$code_conjunto', '$data', '$data_completa', '$cliente')");
	
	mysqli_query($conexao_bd, "UPDATE pagamento_boletos SET conjunto = '$code_conjunto' WHERE code_boleto = '".$_GET['code_boleto']."'");
		
	echo "<script language='javascript'>window.location='fazer_pagamento.php?p=';</script>";

}


// aqui começa o conjunto
if($valor_enviar == '+'){
	
	$sql_verifica_conjunto = mysqli_query($conexao_bd, "SELECT * FROM pagamento_boleto_conjunto WHERE status = 'Aguarda'");
	if(mysqli_num_rows($sql_verifica_conjunto) == ''){
		$code_conjunto = date("s")*544;
		mysqli_query($conexao_bd, "INSERT INTO pagamento_boleto_conjunto (status, code_conjunto, operador, data, data_completa, cliente) VALUES ('Aguarda', '$code_conjunto', '$operador', '$data', '$data_completa', '$cliente')");
		
		mysqli_query($conexao_bd, "UPDATE pagamento_boletos SET conjunto = '$code_conjunto' WHERE code_boleto = '".$_GET['code_boleto']."'");
	}else{
		
		while($res_conjunto = mysqli_fetch_array($sql_verifica_conjunto)){
		 
			$code_conjunto = $res_conjunto[''];
			
		}
	}
}
// aqui termina o conjunto



for($i=0; $i<$tamanho_valor; $i++){
	if($valor_enviar[$i] == ','){
		$verifica_se_existe_virgula = 1;
	}
}

if($verifica_se_existe_virgula == 1){
	echo "<script language='javascript'>window.alert('OS NÚMEROS NÃO PODE CONTER VIRGULA, APENAS O PONTO É UTILIZADO PARA DIFERENCIAR OS CENTAVOS!');</script>";
}else{

$tipo = $_GET['tipo'];
$codigo_barras = $_GET['codigo_barras'];
$banco = $_GET['banco'];
$vencimento = $_GET['vencimento'];
$juros = $_GET['juros'];
$descontos = $_GET['descontos'];
$telefone = $_GET['telefone'];
$pgt_form = $_GET['forma_pagamento'];
$tarifado = $_GET['tarifado'];
$vencido = $_GET['vencido'];
$valor = $_GET['valor'];

$pagamentos_feitos = 0;
$sql_busca_pagamento = mysqli_query($conexao_bd, "SELECT * FROM pagamento_boletos_opcoes WHERE code_boleto = '$code_boleto'");
 	while($res_busca_pagamento = mysqli_fetch_array($sql_busca_pagamento)){
		$pagamentos_feitos = $res_busca_pagamento['valor']+$pagamentos_feitos;
	}

$valor_maximo_a_receber = $res_boleto['valor_recebido'];

$falta_ainda_receber = $valor_maximo_a_receber-$pagamentos_feitos;

if($pagamentos_feitos >= $valor_maximo_a_receber){
	echo "<script language='javascript'>window.alert('O pagamento total já foi efetuado!');</script>";
}elseif($valorusar>$falta_ainda_receber && $forma_pagamento != 'DINHEIRO'){
	echo "<script language='javascript'>window.alert('Não é possível efetivar um valor acima do que ainda falta pagar!');</script>";
}else{
 	
	$saldo_conta = 0;
	$cheque_especial = 0;
	$saldo_conta_e_cheque_especial = 0;
	$cliente = $res_boleto['cliente'];
	$status_cliente = 0;
	$limite_pagamento = 0;
	$taxa_juros = 0;
	$juros_parcelado = 0;
	$limite_emergencial_auto = 0;
	$sql_verifica_saldo = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente WHERE cliente = '$cliente'");
		while($res_verifica_saldo = mysqli_fetch_array($sql_verifica_saldo)){
			$saldo_conta = $res_verifica_saldo['saldo'];
			$status_cliente = $res_verifica_saldo['status'];
			$pagamento_contas = $res_verifica_saldo['pagamento_contas'];
			$limite_pagamento = $res_verifica_saldo['disponivel_pagamento_contas'];
			$taxa_juros = $res_verifica_saldo['taxa_juros'];
			$juros_parcelado = $res_verifica_saldo['juros_parcelamento'];
			$limite_emergencial_auto = $res_verifica_saldo['limite_emergencial'];
		}


	if($status_cliente != 'ATIVO' && $forma_pagamento == 'VESTE PRIME'){
		echo "<script language='javascript'>window.alert('Cliente não está apto para fazer pagamento usando o VESTE PRIME CARD!');</script>";
	}elseif($forma_pagamento == 'VESTE PRIME' && $limite_pagamento < $valor_enviar){	
		$limite_emergencial = ($pagamento_contas*0.3)+$limite_pagamento;
		if($limite_emergencial >= $valor_enviar && $limite_emergencial_auto == 'AUTORIZAR'){
 	 		echo "<script language='javascript'>window.location='?p=4&code_boleto=$code_boleto&limite_pagamento=$limite_emergencial&valorusar=$valor_enviar&pag_form=$forma_pagamento&taxa_juros=$taxa_juros&juros_parcelamento=$juros_parcelado&limiteemergencial=sim';</script>";
		}else{
		echo "<script language='javascript'>window.alert('CLIENTE NÃO TEM LIMITE DISPONÍVEL PARA FINANCIAR DESSE PAGAMENTO ESSE VALOR, ELE PODE TENTAR UMA AVALIAÇÃO EMERGICIAL DE CRÉDITO OU AUMENTO DE LIMITE PARA FINANCIAR ESSE PAGAMENTO. NÃO ESQUECER DE AVISAR DA TARIFA COBRADA!');</script>";
		}
	}elseif($forma_pagamento == 'VESTE PRIME' && $limite_pagamento >= $valor_enviar){
 	 echo "<script language='javascript'>window.location='?p=4&code_boleto=$code_boleto&limite_pagamento=$limite_pagamento&valorusar=$valor_enviar&pag_form=$forma_pagamento&taxa_juros=$taxa_juros&juros_parcelamento=$juros_parcelado';</script>";
	}else{
 	 echo "<script language='javascript'>window.location='?p=4&code_boleto=$code_boleto&limite_pagamento=$limite_pagamento&valorusar=$valor_enviar&pag_form=$forma_pagamento&taxa_juros=$taxa_juros&juros_parcelamento=$juros_parcelado';</script>";
   }
  }
 }
}?>

<? if($_GET['pag_form'] == ''){ ?>
<form name="" method="post" action="" enctype="multipart/form-data">
 <select name="forma_pagamento" size="1">
   <?
   $saldo_pagamento = 0;
   $sql_verifica_limite = mysqli_query($conexao_bd, "SELECT * FROM limites_operacionais WHERE data = '$data'");
   while($res_limite = mysqli_fetch_array($sql_verifica_limite)){ $saldo_pagamento = $res_limite['saldo']; }
   if(($saldo_pagamento+$valor_pagamento) <= 7500){
   ?>
   <option value="DINHEIRO">DINHEIRO</option>
   <? } ?>
   <? if($res_boleto['cliente'] != ''){ ?>
   <option value="VESTE PRIME">VESTE PRIME</option>
   <? } ?>
   <option value="CARTAO DE DEBITO">CART&Atilde;O DE D&Eacute;BITO</option>
   <option value="CARTAO DE CREDITO">CART&Atilde;O DE CR&Eacute;DITO</option>
 </select>
 <input name="valor_enviar" type="text" value="<? 
 $pagamentos_feitos = 0;
 $valor_a_receber = $res_boleto['valor_recebido'];
 $sql_busca_pagamento = mysqli_query($conexao_bd, "SELECT * FROM pagamento_boletos_opcoes WHERE code_boleto = '$code_boleto'");
 	while($res_busca_pagamento = mysqli_fetch_array($sql_busca_pagamento)){
		$pagamentos_feitos = $res_busca_pagamento['valor']+$pagamentos_feitos;
	}
 
 echo $falta_pagar = number_format(($res_boleto['valor_recebido']-$pagamentos_feitos), 2, '.', '');
 
 ?>" size="5"  <? if($falta_pagar >0){ ?>autofocus<? } ?>/>
</form>
<? } // verifica se existe informações ?>
<div id="opcoes_de_parcelamento">
<hr />

<? if(@$_GET['pag_form'] == 'DINHEIRO'){ require "pagamento_contas/dinheiro.php"; } // FINALIZA A SELEÇÃO DE DINHEIRO?>

<? if(@$_GET['pag_form'] == 'VESTE PRIME'){ require "pagamento_contas/pagamento_veste_prime.php"; } ?>

<? if(@$_GET['pag_form'] == 'CARTAO DE CREDITO'){ require "pagamento_contas/pagamento_cartao_credito.php"; } ?>

<? if(@$_GET['pag_form'] == 'CARTAO DE DEBITO'){ require "pagamento_contas/pagamento_cartao_debito.php"; } ?>



<? if($_GET['pag_form'] == ''){ ?>
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
<a class="aa" rel="superbox[iframe][905x200]" href="scripts/ver_pagamentos_boletos.php?code_boleto=<? echo $code_boleto; ?>">Ver pagamentos</a>
<h3 class="h3"><hr /><strong>VALOR A PAGAR:</strong> R$ <? echo number_format($res_boleto['valor_recebido'], 2, ',', '.'); ?></h3>
<h3 class="h4"><strong>VALOR PAGO:</strong> R$ <? echo number_format($pagamentos_feitos, 2, ',', '.'); ?><strong> - AINDA FALTA PAGAR:</strong> R$ <? echo number_format($falta_pagar, 2, ',', '.'); ?></h3>
<h3 class="h5"><strong>TROCO:</strong> R$
<?
$troco = 0;
$soma_troco = mysqli_query($conexao_bd, "SELECT * FROM pagamento_boletos_opcoes WHERE code_boleto = '$code_boleto'");
	while($res_troco = mysqli_fetch_array($soma_troco)){
			$troco = $res_troco['troco']+$troco;
	}
	
	echo number_format($troco, 2, ',', '.');
	
?>
</h3><br /><br /><br />
<? } ?>
</div><!-- opcoes_de_parcelamento -->
<hr />
<img src="img/redemaisvoce.jpg" width="150" height="70" />
<img src="img/banco_rendimento.png" width="150" height="70" />
<img src="img/bancodobrasil.jpg" width="400" height="60" />
</div><!-- pagamento -->


<div id="informacoes_pagamento">
<strong>Revise as informações do pagamento
<? if(@$res_boleto['tipo'] == 'CONVENIO'){ ?>
</strong><h1 class="h1">TIPO DE FAVORECIDO<br />
<input type="text" disabled="disabled" class="input2" value="<? echo $res_boleto['banco']; ?>" size="48" /><br />
<? }else{ ?>
</strong><h1 class="h1">BANCO FAVORECIDO<br />
<input type="text" disabled="disabled" class="input2" value="<?
    $banco = $_GET['banco'];
	$sql_banco = mysqli_query($conexao_bd, "SELECT * FROM lista_bancos WHERE codigo = '$banco'");
		while($res_banco = mysqli_fetch_array($sql_banco)){
				echo $banco2 = $res_banco['nome_banco'];
			}
?>" size="48" /><br />
<? } // verifica se é banco ou convênio ?>
VALOR<br />
<input type="text" disabled="disabled" class="input" value="<? echo number_format($res_boleto['valor'], 2, ',', '.'); ?>" size="7" /><br />
VENCIMENTO<br />
<input type="text" disabled="disabled" class="input" value="<? echo $res_boleto['vencimento']; ?>" size="7" /><br />
PAGAMENTO<br />
<input type="text" disabled="disabled" class="input" value="<?
	  $dia_pagamento = date("d/m/Y");
	  $sql_pagamento = mysqli_query($conexao_bd, "SELECT * FROM datas_pagamento_contas WHERE dia = '$dia_pagamento'");
	  if(mysqli_num_rows($sql_pagamento) == ''){
		  echo $dia_pagamento = date("d/m/Y");
	  }else{
		  while($res_pagamento = mysqli_fetch_array($sql_pagamento)){
			 echo $dia_pagamento = $res_pagamento['proximo_dia'];
	   }
	  }
	  ?>" size="7" /><br />
JUROS/MULTA<br />
<input type="text" disabled="disabled" class="input" value="<? echo number_format($res_boleto['juros']+$res_boleto['boleto_vencido'], 2, ',', '.'); ?>" size="7" /><br />
DESCONTOS<br />
<input type="text" disabled="disabled" class="input" value="<? echo $res_boleto['desconto']; ?>" size="7" /><br />
OUTRAS TARIFAS<br />
<input type="text" disabled="disabled" class="input" value="<?
$tarifas_extras = $res_boleto['boleto_tarifado']+$res_boleto['boleto_impresso'];
echo number_format($tarifas_extras, 2, ',', '.');

?>" size="7" /><br />
VALOR A RECEBER<br />
<input type="text" disabled="disabled" class="input" value="<? echo number_format($res_boleto['valor_recebido'], 2, ',', '.'); ?>" size="10" /><br />
<hr /></h1>
<form name="" method="post" action="" enctype="multipart/form-data">
<input class="botao_avancar" type="submit" name="cancelar" value="Cancelar" /><br />
</form>

<? if(isset($_POST['cancelar'])){
	

$verifica_pagamentos = mysqli_query($conexao_bd, "SELECT * FROM pagamento_boletos_opcoes WHERE code_boleto = '$code_boleto'");
if(mysqli_num_rows($verifica_pagamentos) == ''){
mysqli_query($conexao_bd, "UPDATE pagamento_boletos SET status = 'CANCELADO', motivo_cancelamento = 'BOLETO CANCELADO ANTES DE FINALIZADO', operador_cancelamento = '$operador' WHERE code_boleto = '$code_boleto'");
  echo "<script language='javascript'>window.alert('PAGAMENTO CANCELADO COM SUCESSO!');window.location='fazer_pagamento.php?p=';</script>";
}else{
  echo "<script language='javascript'>window.alert('EXCLUA TODOS OS PAGAMENTOS ANTES DE CANCELAR O PAGAMENTO DO BOLETO!');</script>";
 }
}?>




<? if(isset($_POST['confirmar'])){

$soma_pagamento = 0;
$valor_a_receber = 0;
$verifica_pagamentos = mysqli_query($conexao_bd, "SELECT * FROM pagamento_boletos_opcoes WHERE code_boleto = '$code_boleto'");
if(mysqli_num_rows($verifica_pagamentos) == ''){
  echo "<script language='javascript'>window.alert('ANTES DE ENVIAR O TITULO DE RECEBIMENTO PARA COMPENSAÇÃO, O PAGAMENTO DO MESMO DEVE SER CONFIRMADO!');</script>";
}else{
	while($res_soma_pagamentos = mysqli_fetch_array($verifica_pagamentos)){
		$soma_pagamento = $res_soma_pagamentos['valor']+$soma_pagamento;
	}
	
$sql_verifica_valor_receber = mysqli_query($conexao_bd, "SELECT * FROM pagamento_boletos WHERE code_boleto = '$code_boleto'");
	while($res_valor_receber = mysqli_fetch_array($sql_verifica_valor_receber)){
		$valor_a_receber = $res_valor_receber['valor_recebido'];
	}
	
	if($valor_a_receber < $soma_pagamento){
  	 echo "<script language='javascript'>window.alert('TÍTULO DE PAGAMENTO NÃO FOI QUITADO POR COMPLETO!');</script>";
	}else{
  	 echo "<script language='javascript'>window.location='?p=5&code_boleto=$code_boleto';</script>";
  }
 }
}?>


<? if($pagamentos_feitos-$valor_a_receber >=0){ ?>
<form name="" method="post" action="" enctype="multipart/form-data">
<input class="botao_avancar2" type="submit" name="confirmar" value="Confirmar" <? if($falta_pagar <=0){ ?>autofocus<? } ?> /><br />
</form>
<? } ?>


</div><!-- informacoes_pagamento -->


<? }// termina o while de verificação ?>



<? } // fechamento do 4 ?>









<? if($_GET['p'] == '5'){ ?>
<h1 class="h11"><strong>PROCESSANDO PAGAMENTO</strong></h1>
  <script type="text/javascript">
      function redirectTime(){
         window.location = "?p=6&code_boleto=<? echo $_GET['code_boleto']; ?>"
      }
   </script>
   <body onLoad="setTimeout('redirectTime()', 3000)">
  
  <img class="imggg" src="img/gif_carregando.gif" width="115" height="60" /> 
  <h6 class="h66">Verificando informações e validando pagamento, aguarde...</h6>
  <hr />
  <img class="imggg22" src="img/redemaisvoce.jpg" width="100" height="50" />
  <h6 class="h66">Este pagamento é processado e credenciado por meio de uma parceria do BANCO DO BRASIL/BANCO RENDIMENTO e REDE MAIS VOCÊ.</h6><br />
  <img class="imggg2" src="img/bancodobrasil.jpg" width="100" height="20" />
  <img class="h656" src="img/logo_banco_rendimento.png" width="150" height="20" /><br />
<? } // fechamento do 5 ?>


<? if($_GET['p'] == '6'){ ?>
<h1><strong>PAGAMENTO ENVIADO PARA EFETIVAÇÃO COM SUCESSO!</strong></h1>
<table width="900" border="0" class="table">
  <tr>
    <td align="center" width="662"><br />
    
   	  <script language="javascript">
		function abrePopUp(urlImagem){
			window.open(urlImagem,'Foto_Ampliada','top=150,left=500,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=340,height=400');
		}
	</script>      
    <a class="comprovante" rel="autofocus" onclick="abrePopUp('scripts/comprovante_de_pagamento_de_titulos.php?code_boleto=<? echo $_GET['code_boleto']; ?>');" href="fazer_pagamento.php?p=">IMPRIMIR COMPROVANTE DE PAGAMENTO</a></td>
    <td width="328" align="center" rowspan="3"><img class="pagamento_sucesso" src="img/bb_rendimento.png"></td>
  <?
  $novos_pontos = 0;
  $vestepoint = 0;
  $cliente = 0;
  $valor_boleto = 0;
  
  $busca_boleto = mysqli_query($conexao_bd, "SELECT * FROM pagamento_boletos WHERE code_boleto = '".$_GET['code_boleto']."'");
  	while($res_boleto = mysql_fetch_array($busca_boleto)){
		$cliente = $res_boleto['cliente'];
		$valor_boleto = $res_boleto['valor'];
	}
  
  
  $busca_cliente = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente WHERE cliente = '$cliente'");
  	while($res_cliente =  mysqli_fetch_array($busca_cliente)){
		
		$vestepoint = $res_cliente['vestepoint'];
		
		$categoria = $res_cliente['categoria'];
		if($categoria == 'black'){
			$novos_pontos = number_format($valor_boleto/2);
		}elseif($categoria == 'platinum'){
			$novos_pontos = number_format($valor_boleto/3);
		}elseif($categoria == 'gold'){
			$novos_pontos = number_format($valor_boleto/3.5);
		}else{
			$novos_pontos = number_format($valor_boleto/4);
		}	
		$vestepoint = $vestepoint+$novos_pontos;
	   }

		
		mysqli_query($conexao_bd, "INSERT INTO extratato_vestepoint (ip, dia, mes, ano, data, data_completa, status, tipo, cliente, descricao, operador, total, valor_transacao, novo_saldo) VALUES ('$ip', '$dia', '$mes', '$ano', '$data', '$data_completa', 'Ativo', 'CREDITO', '$cliente', 'PAGAMENTO DE CONTAS', '$operador', '$novos_pontos', '$valor_boleto', '$vestepoint')");
		
		mysqli_query($conexao_bd, "UPDATE conta_corrente SET vestepoint = '$vestepoint' WHERE cliente = '$cliente'");
			
  
  
  
  ?>  
    

    
  </tr>
  <tr>
    <td>
    <ul class="lic">
     <li>O pagamento foi processado com sucesso, o comprovante de efetivação poderá ser retirado 24 horas após o vencimento no site da Rede Mais Você.</li>
     <li>O pagamento pode demorar até 5 dias úteis para ser compensado.</li>
     <li>Todos os pagamentos realizados após as 15 horas poderá ser efetivado somente no próximo dia útil.</li>
    </ul>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<? } // fechamento do 6 ?>
</div><!-- box_pagamento_1 -->

<script type="text/javascript">
var sprytextfield500 = new Spry.Widget.ValidationTextField("sprytextfield500", "custom", {useCharacterMasking:true, pattern:"00000.00000 00000.000000 00000.000000 0 00000000000000"});
var sprytextfield0616151 = new Spry.Widget.ValidationTextField("sprytextfield0616151", "custom", {pattern:"00000000000-0 00000000000-0 00000000000-0 00000000000-0", useCharacterMasking:true});
var sprytextfield260000165412 = new Spry.Widget.ValidationTextField("sprytextfield260000165412", "date", {format:"dd/mm/yyyy", useCharacterMasking:true});
var sprytextfield121525 = new Spry.Widget.ValidationTextField("sprytextfield121525", "custom", {pattern:"(00) 00000.0000", useCharacterMasking:true});
var sprytextfield91111 = new Spry.Widget.ValidationTextField("sprytextfield91111", "date", {format:"dd/mm/yyyy", useCharacterMasking:true});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "custom", {pattern:"(00) 00000.0000", useCharacterMasking:true});
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1_vencimento_convenio", "date", {useCharacterMasking:true, format:"dd/mm/yyyy"});
</script>
</body>
</html>