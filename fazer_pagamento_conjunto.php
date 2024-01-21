<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/fazer_pagamento.css" rel="stylesheet" type="text/css" />
</head>

<body>
<? require "topo.php"; $code_conjunto = $_GET['code_conjunto']; ?>

<?

$sql_verifica_boleto = mysqli_query($conexao_bd, "SELECT * FROM verifica_efetivado WHERE code_conjunto = '$code_conjunto'");
if(mysqli_num_rows($sql_verifica_boleto) >= 1){
  
  mysqli_query($conexao_bd, "INSERT INTO notificacoes_de_sistema (data_completa, ip, operador, acao, url) VALUES ('$data_completa', '$ip', '$operador', 'Operador voltou a tela de pagamenton do boleto $code_boleto mesmo após emitir o recibo de pagamento', '$url')");	

 	mysqli_query($conexao_bd, "INSERT INTO acoes_operador (data, data_completa, ip, operador, tipo, descricao, url) VALUES ('$data', '$data_completa', '$ip', '$operador', 'PAGAMENTO', 'Usuário voltou a tela de pagamento mesmo após o recibo emitido $code_boleto', '$url')");

	
  echo "<script language='javascript'>window.alert('O recibo deste pagamento já emitido, por tanto, somente um requerimento pode cancelar esse pagamento. Lembrando que foi enviado uma notificação para verificar esta sua ação!');window.location='fazer_pagamento.php?p=';</script>";
  
}

?>


<div id="box_pagamento_1">
<h1 style="color:#03C;"><strong>Informações sobre conjunto de titulos de pagamento</strong> <a rel="superbox[iframe][930x500]" style="font:12px Arial, Helvetica, sans-serif; background:#090; border:2px solid #000; padding:5px; text-decoration:none; color:#FFF;" href="scripts/conjunto_titulos.php?code_conjunto=<? echo $code_conjunto; ?>">VERIFICAR TÍTULOS</a></h1>
<? 

$valor_total = 0;
$cliente = 0;
$sql_boleto = mysqli_query($conexao_bd, "SELECT * FROM pagamentoboletos WHERE conjunto = '$code_conjunto'");
	while($res_boleto = mysqli_fetch_array($sql_boleto)){
		 $valor_total = $valor_total+$res_boleto['valor_recebido'];
	}

$code_barras = 0;
$code_boleto = 0;
$sql_boleto = mysqli_query($conexao_bd, "SELECT * FROM pagamentoboletos WHERE conjunto = '$code_conjunto' ORDER BY id DESC LIMIT 1");
	while($res_boleto = mysqli_fetch_array($sql_boleto)){
		$code_barras = $res_boleto['code_barras'];
		$code_boleto = $res_boleto['code_boleto'];
		$cliente = $res_boleto['cliente'];
	}
?>
<input class="codigo_barras3" type="text" disabled="disabled" value="<? echo $code_barras; ?>" />
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
	
	mysqli_query($conexao_bd, "UPDATE pagamentoboletos SET conjunto = '$code_conjunto' WHERE code_boleto = '".$_GET['code_boleto']."'");
		
	echo "<script language='javascript'>window.location='fazer_pagamento.php?p=';</script>";

}


// aqui começa o conjunto
if($valor_enviar == '+'){
	
	$sql_verifica_conjunto = mysqli_query($conexao_bd, "SELECT * FROM pagamento_boleto_conjunto WHERE status = 'Aguarda' AND operador = '$operador'");
	if(mysqli_num_rows($sql_verifica_conjunto) == ''){
		$code_conjunto = date("s")*544;
		mysqli_query($conexao_bd, "INSERT INTO pagamento_boleto_conjunto (status, code_conjunto, operador, data, data_completa, cliente) VALUES ('Aguarda', '$code_conjunto', '$operador', '$data', '$data_completa', '$cliente')");
		
		mysqli_query($conexao_bd, "UPDATE pagamentoboletos SET conjunto = '$code_conjunto' WHERE code_boleto = '".$_GET['code_boleto']."'");
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
$sql_busca_pagamento = mysqli_query($conexao_bd, "SELECT * FROM pagamento_boletos_opcoes WHERE conjunto = '$code_conjunto'");
 	while($res_busca_pagamento = mysqli_fetch_array($sql_busca_pagamento)){
		$pagamentos_feitos = $res_busca_pagamento['valor']+$pagamentos_feitos;
	}

$falta_ainda_receber = $valor_total-$pagamentos_feitos;

if($pagamentos_feitos >= $valor_total){
	echo "<script language='javascript'>window.alert('O pagamento total já foi efetuado!');</script>";
}elseif($valorusar>$falta_ainda_receber && $forma_pagamento != 'DINHEIRO'){
	echo "<script language='javascript'>window.alert('Não é possível efetivar um valor acima do que ainda falta pagar!');</script>";
}else{
 	
	$saldo_conta = 0;
	$cheque_especial = 0;
	$saldo_conta_e_cheque_especial = 0;
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
 	 		echo "<script language='javascript'>window.location='?code_conjunto=$code_conjunto&limite_pagamento=$limite_emergencial&valorusar=$valor_enviar&pag_form=$forma_pagamento&taxa_juros=$taxa_juros&juros_parcelamento=$juros_parcelado&limiteemergencial=sim';</script>";
		}else{
		echo "<script language='javascript'>window.alert('CLIENTE NÃO TEM LIMITE DISPONÍVEL PARA FINANCIAR DESSE PAGAMENTO ESSE VALOR, ELE PODE TENTAR UMA AVALIAÇÃO EMERGICIAL DE CRÉDITO OU AUMENTO DE LIMITE PARA FINANCIAR ESSE PAGAMENTO. NÃO ESQUECER DE AVISAR DA TARIFA COBRADA!');</script>";
		}
	}elseif($forma_pagamento == 'VESTE PRIME' && $limite_pagamento >= $valor_enviar){
 	 echo "<script language='javascript'>window.location='?code_conjunto=$code_conjunto&cliente=$cliente&limite_pagamento=$limite_pagamento&valorusar=$valor_enviar&pag_form=$forma_pagamento&taxa_juros=$taxa_juros&juros_parcelamento=$juros_parcelado';</script>";
	}else{
		
		$limite_caractres = strlen($valor_enviar); 
		$verficado_multiplicacao = 0;
		
		for($i=0; $i<=$limite_caractres; $i++){
			if($valor_enviar[$i] == '*'){
				$verficado_multiplicacao = 1;
			}
		}

		
	 if($verficado_multiplicacao == 1){
	 $valor_enviar =  "$valor_enviar"+0;
 	 echo "<script language='javascript'>window.location='?code_conjunto=$code_conjunto&valor_nota=$valor_enviar&acao=multiplicador';</script>";
	 }
		
 	 echo "<script language='javascript'>window.location='?code_conjunto=$code_conjunto&cliente=$cliente&limite_pagamento=$limite_pagamento&valorusar=$valor_enviar&pag_form=$forma_pagamento&taxa_juros=$taxa_juros&juros_parcelamento=$juros_parcelado';</script>";
   }
  }
 }
}?>


<? if($_GET['acao'] == 'multiplicador'){ ?>

<? if(isset($_POST['quantidade'])){

$quantidade = $_POST['quantidade'];
$valor_nota = $_GET['valor_nota'];

$valorusar = $quantidade*$valor_nota;

$code_conjunto = $_GET['code_conjunto'];

 echo "<script language='javascript'>window.location='?code_conjunto=$code_conjunto&valorusar=$valorusar&pag_form=DINHEIRO';</script>";

}?>

<form name="" method="post" action="" enctype="multipart/form-data">
 <h6 style="float:left; font:25px Arial, Helvetica, sans-serif; margin:10px 0 0 5px;"><strong>Quantidade de notas</strong></h6>
 <input style="margin:5px 0 0 5px; width:100px;" name="quantidade" type="number" value="" size="5" autofocus/>
</form>
<? } // quantidade de notas ?>







<? if($_GET['pag_form'] == '' && $_GET['acao'] != 'multiplicador'){ ?>
<form name="" method="post" action="" enctype="multipart/form-data">
 <select name="forma_pagamento" size="1">
   <?
   $saldo_pagamento = 0;
   $sql_verifica_limite = mysqli_query($conexao_bd, "SELECT * FROM limites_operacionais WHERE data = '$data'");
   while($res_limite = mysqli_fetch_array($sql_verifica_limite)){ $saldo_pagamento = $res_limite['saldo']; }
   if(($saldo_pagamento+$valor_pagamento) <= 17500){
   ?>
   <? if($cliente != ''){ ?><option value="VESTE PRIME">1 - VESTE PRIME</option><? } ?>
   <option value="DINHEIRO">2 - DINHEIRO</option>
   <option value="TRANSFERENCIA">3 - TRANSFERENCIA/PIX</option>
   <option value="CARTAO DE DEBITO">4 - CART&Atilde;O DE D&Eacute;BITO</option>
   <option value="CARTAO DE CREDITO">5 - CART&Atilde;O DE CR&Eacute;DITO</option>
   <option value="M12">6 - AUTORIZAÇÃO M12</option>
   <? } ?>
</select>
 <input name="valor_enviar" type="text" value="<? 
 $pagamentos_feitos = 0;
 $sql_busca_pagamento = mysqli_query($conexao_bd, "SELECT * FROM pagamento_boletos_opcoes WHERE conjunto = '$code_conjunto'");
 	while($res_busca_pagamento = mysqli_fetch_array($sql_busca_pagamento)){
		$pagamentos_feitos += $res_busca_pagamento['valor'];
	}
 
echo $falta_pagar = number_format($valor_total-$pagamentos_feitos, 2, '.', '');
 
 ?>" size="5"  <? if($falta_pagar >0){ ?>autofocus<? } ?>/>
</form>
<? } // verifica se existe informações ?>
<div id="opcoes_de_parcelamento">
<hr />

<? if(@$_GET['pag_form'] == 'DINHEIRO' || @$_GET['pag_form'] == 'TRANSFERENCIA' || @$_GET['pag_form'] == 'M12'){ require "pagamento_contas/dinheiro.php"; } ?>

<? if(@$_GET['pag_form'] == 'VESTE PRIME'){ require "pagamento_contas/pagamento_veste_prime.php"; } ?>

<? if(@$_GET['pag_form'] == 'CARTAO DE CREDITO'){ require "pagamento_contas/pagamento_cartao_credito.php"; } ?>

<? if(@$_GET['pag_form'] == 'CARTAO DE DEBITO'){ require "pagamento_contas/pagamento_cartao_debito.php"; } ?>



<? if($_GET['pag_form'] == ''){ ?>
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
<a class="aa" rel="superbox[iframe][905x200]" href="scripts/ver_pagamentos_boletos.php?code_boleto=<? echo $code_boleto; ?>&code_conjunto=<? echo $code_conjunto; ?>">Ver pagamentos</a>
<h3 class="h3"><hr /><strong>VALOR A PAGAR:</strong> R$ <? echo number_format($valor_total, 2, ',', '.'); ?></h3>
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
<img src="img/bancodobrasil.jpg" width="400" height="60" />
</div><!-- pagamento -->


<div id="informacoes_pagamento">
<strong>Revise as informações do pagamento
<?
$sql_boleto = mysqli_query($conexao_bd, "SELECT * FROM pagamentoboletos WHERE code_boleto = '$code_boleto'");
	while($res_boleto = mysqli_fetch_array($sql_boleto)){
?>


<? if(@$res_boleto['tipo'] == 'CONVENIO'){ ?>
</strong><h1 class="h1">TIPO DE FAVORECIDO<br />
<input type="text" disabled="disabled" class="input2" value="<? echo $res_boleto['banco']; ?>" size="48" /><br />
<? }else{ ?>
</strong><h1 class="h1">BANCO FAVORECIDO<br />
<input type="text" disabled="disabled" class="input2" value="<?
    $banco = $res_boleto['banco'];
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
<? } ?>
<form name="" method="post" action="" enctype="multipart/form-data">
<input class="botao_avancar" type="submit" name="cancelar" value="Cancelar" /><br />
</form>

<? if(isset($_POST['cancelar'])){
	

$sql_verifica_boleto = mysqli_query($conexao_bd, "SELECT * FROM verifica_efetivado WHERE code_conjunto = '$code_conjunto'");
if(mysqli_num_rows($sql_verifica_boleto) >= 1){
  
  mysqli_query($conexao_bd, "INSERT INTO notificacoes_de_sistema (data_completa, ip, operador, acao, url) VALUES ('$data_completa', '$ip', '$operador', 'operador quis cancelar o pagamento $code_boleto mesmo após emitir o recibo de pagamento', '$url')");	
	
  echo "<script language='javascript'>window.alert('O recibo deste pagamento já emitido, por tanto, somente um requerimento pode cancelar esse pagamento. Lembrando que foi enviado uma notificação para verificar esta sua ação!');</script>";
}else{

$verifica_pagamentos = mysqli_query($conexao_bd, "SELECT * FROM pagamento_boletos_opcoes WHERE conjunto = '$code_conjunto'");
if(mysqli_num_rows($verifica_pagamentos) == ''){
mysqli_query($conexao_bd, "UPDATE pagamentoboletos SET status = 'CANCELADO', motivo_cancelamento = 'BOLETO CANCELADO ANTES DE FINALIZADO', operador_cancelamento = '$operador' WHERE conjunto = '$code_conjunto'");
mysqli_query($conexao_bd, "UPDATE pagamento_boleto_conjunto SET status = 'CANCELADO' WHERE code_conjunto = '$code_conjunto'");
  echo "<script language='javascript'>window.alert('PAGAMENTO CANCELADO COM SUCESSO!');window.location='fazer_pagamento.php?p=';</script>";
}else{
  echo "<script language='javascript'>window.alert('EXCLUA TODOS OS PAGAMENTOS ANTES DE CANCELAR O PAGAMENTO DO BOLETO!');</script>";
 }
}
}?>




<? if(isset($_POST['confirmar'])){

$soma_pagamento = 0;
$valor_a_receber = 0;
$saldo_a_pagar = 0;

$verifica_pagamentos = mysqli_query($conexao_bd, "SELECT * FROM pagamento_boletos_opcoes WHERE conjunto = '$code_conjunto'");
if(mysqli_num_rows($verifica_pagamentos) == ''){
  echo "<script language='javascript'>window.alert('ANTES DE ENVIAR O TITULO DE RECEBIMENTO PARA COMPENSAÇÃO, O PAGAMENTO DO MESMO DEVE SER CONFIRMADO!');</script>";
}else{
	while($res_soma_pagamentos = mysqli_fetch_array($verifica_pagamentos)){
		$soma_pagamento = $res_soma_pagamentos['valor']+$soma_pagamento;
	}
	
$sql_verifica_valor_receber = mysqli_query($conexao_bd, "SELECT * FROM pagamentoboletos WHERE conjunto = '$code_conjunto'");
	while($res_valor_receber = mysqli_fetch_array($sql_verifica_valor_receber)){
		$valor_a_receber = $res_valor_receber['valor_recebido']+$valor_a_receber;
	}
	
	$saldo_a_pagar = $valor_total-$soma_pagamento;
	
	if($saldo_a_pagar >0){
  	 echo "<script language='javascript'>window.alert('TÍTULO DE PAGAMENTO NÃO FOI QUITADO POR COMPLETO ($saldo_a_pagar)!');</script>";
	}else{
	 mysqli_query($conexao_bd, "UPDATE pagamento_boleto_conjunto SET status = 'Encerrado' WHERE code_conjunto = '$code_conjunto'");
	 
	$id_boleto = 0;
	$sql_boleto = mysqli_query($conexao_bd, "SELECT * FROM pagamentoboletos WHERE conjunto = '$code_conjunto' ORDER BY id ASC LIMIT 1");
	 while($res_conjunto = mysqli_fetch_array($sql_boleto)){
		 $id_boleto = $res_conjunto['id'];
	}
	 
  	 echo "<script language='javascript'>window.location='fazer_pagamento.php?p=confirmar_efetivacao_conjunto&code_conjunto=$code_conjunto&id_boleto=$id_boleto';</script>";
  }
 }
}?>


<? if($pagamentos_feitos-$valor_total >=0){ ?>
<form name="" method="post" action="" enctype="multipart/form-data">
<input class="botao_avancar2" type="submit" name="confirmar" value="Confirmar" <? if($falta_pagar <=0){ ?>autofocus<? } ?> /><br />
</form>
<? } ?>


</div><!-- informacoes_pagamento -->


</body>
</html>