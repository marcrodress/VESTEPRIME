<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
body {
	font:12px Arial, Helvetica, sans-serif;
	text-align:center;
}
</style>
<? require "../conexao.php"; ?>
</head>

<body>
<? if(@$_GET['p'] == ''){?>
<strong>Selecione o limite que deseja transferir</strong>
<br />
<? if(isset($_POST['Submit'])){


$limite = $_POST['limite'];
$cliente = $_GET['cliente'];

$limite_loja_disponivel = 0;
$disponivel_pagamento_contas = 0;
$credito_pessoal_disponivel = 0;
$credito_pessoal_cartao_credito_dsponivel = 0;
$limite_bandeirado_disponivel = 0;

$sql_limites = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente WHERE cliente = '$cliente'");
	while($res_limites = mysqli_fetch_array($sql_limites)){
		$limite_loja_disponivel = $res_limites['limite_loja_disponivel'];
		$disponivel_pagamento_contas = $res_limites['disponivel_pagamento_contas'];
		$credito_pessoal_disponivel = $res_limites['credito_pessoal_disponivel'];
		$credito_pessoal_cartao_credito_dsponivel = $res_limites['credito_pessoal_cartao_credito_dsponivel'];
		$limite_bandeirado_disponivel = $res_limites['limite_bandeirado_disponivel'];
	}

$analise = 0;
$limite_maximo = 0;
if($limite == 'PRIVATELABEL' && $limite_loja_disponivel <10){
	$analise = 0;
	$limite_maximo = $limite_loja_disponivel*0.7;
}elseif($limite == 'FINANCIAMENTO' && $disponivel_pagamento_contas <10){
	$analise = 0;
	$limite_maximo = $disponivel_pagamento_contas*0.7;
}elseif($limite == 'CREDITO_PESSOAL_VESTEPRIME' && $credito_pessoal_disponivel <10){
	$analise = 0;
	$limite_maximo = $credito_pessoal_disponivel*0.7;
}elseif($limite == 'CREDITO_PESSOAL_CARTAO_CREDITO' && $credito_pessoal_cartao_credito_dsponivel <10){
	$analise = 0;
	$limite_maximo = $credito_pessoal_cartao_credito_dsponivel*0.7;
}elseif($limite == 'BANDEIRADO' && $limite_bandeirado_disponivel <10){
	$analise = 0;
	$limite_maximo = $limite_bandeirado_disponivel*0.7;
}else{
	$analise = 1;
	if($limite == 'PRIVATELABEL'){
	$limite_maximo = $limite_loja_disponivel*0.7;
	}elseif($limite == 'FINANCIAMENTO'){
	$limite_maximo = $disponivel_pagamento_contas*0.7;
	}elseif($limite == 'CREDITO_PESSOAL_VESTEPRIME'){
	$limite_maximo = $credito_pessoal_disponivel*0.7;
	}elseif($limite == 'CREDITO_PESSOAL_CARTAO_CREDITO'){
	$limite_maximo = $credito_pessoal_cartao_credito_dsponivel*0.7;
	}elseif($limite == 'BANDEIRADO'){
	$limite_maximo = $limite_bandeirado_disponivel*0.7;
	}
	
}

$limite_maximo = str_replace(",", "", $limite_maximo);
$limite_maximo = str_replace(".", "", $limite_maximo);


if($analise == 0){
echo "<strong>Prezado cliente!</strong><br><br>O limite solicitado que deseja transferir possui um limite inferior que não pode ser transferido. Pedimos que selecione outro limite, lembre-se, a taxa de transferência de limites é R$ 10,90.";
}else{
echo "<script language='javascript'>window.location='?p=1&limite_loja_disponivel=$limite_loja_disponivel&disponivel_pagamento_contas=$disponivel_pagamento_contas&credito_pessoal_disponivel=$credito_pessoal_disponivel&credito_pessoal_cartao_credito_dsponivel=$credito_pessoal_cartao_credito_dsponivel&limite_bandeirado_disponivel=$limite_bandeirado_disponivel&limite=$limite&limite_maximo=$limite_maximo&cliente=$cliente';</script>";
}


}?>
<form name="" method="post" action="" enctype="multipart/form-data">
<select style="font:12px Arial, Helvetica, sans-serif; padding:5px; border:1px solid #000; border-radius:5px;" name="limite" size="1">
  <option value="PRIVATELABEL">LIMITE PRIVATE LABEL</option>
  <option value="FINANCIAMENTO">LIMITE FINANCIAMENTO</option>
  <option value="CREDITO_PESSOAL_VESTEPRIME">LIMITE EMPRÉSTIMO NO VESTE PRIME CARD</option>
  <option value="CREDITO_PESSOAL_CARTAO_CREDITO">LIMITE EMPRÉSTIMO NO CARTÃO DE CRÉDITO</option>
  <option value="BANDEIRADO">LIMITE BANDEIRADO</option>
</select>
<br />
<input style="font:12px Arial, Helvetica, sans-serif; padding:10px; width:80px; margin:5px; border:1px solid #000; border-radius:5px;" name="Submit" type="submit" value="Avançar" />
</form>
<? } ?>

<? if(@$_GET['p'] == '1'){?>
<strong>Limite disponível para transferência</strong>
<br />
<? if(isset($_POST['Submit'])){

$limite_loja_disponivel = $_GET['limite_loja_disponivel'];
$disponivel_pagamento_contas = $_GET['disponivel_pagamento_contas'];
$credito_pessoal_disponivel = $_GET['credito_pessoal_disponivel'];
$credito_pessoal_cartao_credito_dsponivel = $_GET['credito_pessoal_cartao_credito_dsponivel'];
$limite_bandeirado_disponivel = $_GET['limite_bandeirado_disponivel'];

$limite_maximo = $_GET['limite_maximo'];
$limite = $_GET['limite'];
$cliente = $_GET['cliente'];




$limite_a_transfererir = $_POST['limite_a_transfererir'];
$tamanho_valor = strlen($limite_a_transfererir);


for($i=0; $i<$tamanho_valor; $i++){
	if($valor_enviar[$i] == ','){
		$verifica_se_existe_virgula = 1;
	}
}

if($verifica_se_existe_virgula == 1){
	echo "<script language='javascript'>window.alert('OS NÚMEROS NÃO PODE CONTER VIRGULA, APENAS O PONTO É UTILIZADO PARA DIFERENCIAR OS CENTAVOS!');</script>";
}else{

if($limite_a_transfererir > ($limite_maximo)){
	echo "<script language='javascript'>window.alert('Limite que deseja transferir é maior que o limite disponível para transferência!');window.location='';</script>";
}elseif($limite_a_transfererir < (-$limite_maximo)){
	echo "<script language='javascript'>window.alert('Limite que deseja transferir é menor que o limite disponível para transferência!');window.location='';</script>";
}else{
	
echo "<script language='javascript'>window.location='?p=2&limite_loja_disponivel=$limite_loja_disponivel&disponivel_pagamento_contas=$disponivel_pagamento_contas&credito_pessoal_disponivel=$credito_pessoal_disponivel&credito_pessoal_cartao_credito_dsponivel=$credito_pessoal_cartao_credito_dsponivel&limite_bandeirado_disponivel=$limite_bandeirado_disponivel&limite=$limite&limite_maximo=$limite_a_transfererir&cliente=$cliente';</script>";
	
 }
}


}?>


<form name="" method="post" action="" enctype="multipart/form-data">
<input style="font:18px Arial, Helvetica, sans-serif; padding:10px; width:80px; margin:5px; border:1px solid #000; text-align:center; color:#F90; border-radius:5px;" type="text" name="limite_a_transfererir" value="<? echo $_GET['limite_maximo']; ?>" />
<br />
<input style="font:12px Arial, Helvetica, sans-serif; padding:10px; width:80px; margin:5px; border:1px solid #000; border-radius:5px;" name="Submit" type="submit" value="Avançar" />
</form>
<? } ?>




<? if(@$_GET['p'] == '2'){?>

<? if(isset($_POST['Submit'])){


$novo_limite = $_POST['novo_limite'];
$limite = $_GET['limite'];
$cliente = $_GET['cliente'];
$senha = $_POST['senha'];


$sql_confere_senha = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '$cliente' AND senha = '$senha'");
if(mysqli_num_rows($sql_confere_senha) == ''){
	echo "<script language='javascript'>window.alert('Senha não confere!');window.location='';</script>";	
}else{

$limite_loja_disponivel = $_GET['limite_loja_disponivel']+$_GET['limite_maximo'];
$disponivel_pagamento_contas = $_GET['disponivel_pagamento_contas']+$_GET['limite_maximo'];
$credito_pessoal_disponivel = $_GET['credito_pessoal_disponivel']+$_GET['limite_maximo'];
$credito_pessoal_cartao_credito_dsponivel = $_GET['credito_pessoal_cartao_credito_dsponivel']+$_GET['limite_maximo'];
$limite_bandeirado_disponivel = $_GET['limite_bandeirado_disponivel']+$_GET['limite_maximo'];

$limite_credito_carne = 0;

$sql_limite_credito_carne = mysqli_query($conexao_bd, "SELECT * FROM clientes_emprestimo_carne WHERE cliente = '$cliente'");
while($res_carne = mysqli_fetch_array($sql_limite_credito_carne)){
	$limite_credito_carne = $res_carne['limite'];
}

$limite_credito_carne = $limite_credito_carne+$_GET['limite_maximo'];



$limite_maximo = $_GET['limite_maximo'];

	if($novo_limite == 'PRIVATELABEL'){
		$sql_limite_transfererir = mysqli_query($conexao_bd, "UPDATE conta_corrente SET limite_loja_disponivel = '$limite_loja_disponivel' WHERE cliente = '$cliente'");
	}elseif($novo_limite == 'FINANCIAMENTO'){
		$sql_limite_transfererir = mysqli_query($conexao_bd, "UPDATE conta_corrente SET disponivel_pagamento_contas = '$disponivel_pagamento_contas' WHERE cliente = '$cliente'");
	}elseif($novo_limite == 'CREDITO_PESSOAL_VESTEPRIME'){
		$sql_limite_transfererir = mysqli_query($conexao_bd, "UPDATE conta_corrente SET credito_pessoal_disponivel = '$credito_pessoal_disponivel' WHERE cliente = '$cliente'");
	}elseif($novo_limite == 'CREDITO_PESSOAL_CARTAO_CREDITO'){
		$sql_limite_transfererir = mysqli_query($conexao_bd, "UPDATE conta_corrente SET credito_pessoal_cartao_credito_dsponivel = '$credito_pessoal_cartao_credito_dsponivel' WHERE cliente = '$cliente'");
	}elseif($novo_limite == 'BANDEIRADO'){
		$sql_limite_transfererir = mysqli_query($conexao_bd, "UPDATE conta_corrente SET limite_bandeirado_disponivel = '$limite_bandeirado_disponivel' WHERE cliente = '$cliente'");
	}elseif($novo_limite == 'CARNE'){
		$sql_limite_tras = mysqli_query($conexao_bd, "UPDATE clientes_emprestimo_carne SET limite = '$limite_credito_carne' WHERE cliente = '$cliente'");
	}



$limite_loja_disponivel = $_GET['limite_loja_disponivel']-$_GET['limite_maximo'];
$disponivel_pagamento_contas = $_GET['disponivel_pagamento_contas']-$_GET['limite_maximo'];
$credito_pessoal_disponivel = $_GET['credito_pessoal_disponivel']-$_GET['limite_maximo'];
$credito_pessoal_cartao_credito_dsponivel = $_GET['credito_pessoal_cartao_credito_dsponivel']-$_GET['limite_maximo'];
$limite_bandeirado_disponivel = $_GET['limite_bandeirado_disponivel']-$_GET['limite_maximo'];


	if($limite == 'PRIVATELABEL'){
		$sql_limite_transfererir = mysqli_query($conexao_bd, "UPDATE conta_corrente SET limite_loja_disponivel = '$limite_loja_disponivel' WHERE cliente = '$cliente'");
	}elseif($limite == 'FINANCIAMENTO'){
		$sql_limite_transfererir = mysqli_query($conexao_bd, "UPDATE conta_corrente SET disponivel_pagamento_contas = '$disponivel_pagamento_contas' WHERE cliente = '$cliente'");
	}elseif($limite == 'CREDITO_PESSOAL_VESTEPRIME'){
		$sql_limite_transfererir = mysqli_query($conexao_bd, "UPDATE conta_corrente SET credito_pessoal_disponivel = '$credito_pessoal_disponivel' WHERE cliente = '$cliente'");
	}elseif($limite == 'CREDITO_PESSOAL_CARTAO_CREDITO'){
		$sql_limite_transfererir = mysqli_query($conexao_bd, "UPDATE conta_corrente SET credito_pessoal_cartao_credito_dsponivel = '$credito_pessoal_cartao_credito_dsponivel' WHERE cliente = '$cliente'");
	}elseif($limite == 'BANDEIRADO'){
		$sql_limite_transfererir = mysqli_query($conexao_bd, "UPDATE conta_corrente SET limite_bandeirado_disponivel = '$limite_bandeirado_disponivel' WHERE cliente = '$cliente'");
	}

		echo "<strong>Prezado cliente!</strong><br><br>Limite de crédito transferido com sucesso!<br><br><em>Lembre-se que o limite transferido é temporário e pode ser removido a qualquer momento.</em>";
		
		$code_transacao = rand();
 		mysqli_query($conexao_bd, "INSERT INTO lancamento_fatura (code_transacao, status, data, data_completa, dia, mes, ano, descricao, valor, code_carrinho, cliente, parcelado, quant_parcela, valor_parcela) VALUES ('$code_transacao', 'Ativo', '$data', '$data_completa', '$dia', '$mes', '$ano', 'TARIFA - TRANSFERÊNCIA DE LIMITE', '5.90', '$code_transacao', '$cliente', '', '', '')");
		
    	mysqli_query($conexao_bd, "INSERT INTO compras_parceladas (code_transacao, ip, status, data_compra, data_completa, estabelecimento, parcela, n_parcela, total_parcela, valor_parcela, sit_pag_fatura) VALUES ('$code_transacao', '$ip', 'Aguarda', '$data', '$data_completa', 'SISTEMA', '1', '1', '1', '5.90', '')");
		
		
		
		die;
		
}

}?>
<strong>Selecione o limite que deseja receber o limite</strong>
<br />
<form name="" method="post" action="" enctype="multipart/form-data">
<select style="font:12px Arial, Helvetica, sans-serif; padding:5px; border:1px solid #000; border-radius:5px;" name="novo_limite" size="1">
 <? if($_GET['limite'] != 'PRIVATELABEL'){ ?>
  <option value="PRIVATELABEL">LIMITE PRIVATE LABEL</option>
 <? } ?>
 <? if($_GET['limite'] != 'FINANCIAMENTO'){ ?>
  <option value="FINANCIAMENTO">LIMITE FINANCIAMENTO</option>
 <? } ?>
 <? if($_GET['limite'] != 'CREDITO_PESSOAL_VESTEPRIME'){ ?>
  <option value="CREDITO_PESSOAL_VESTEPRIME">LIMITE EMPRÉSTIMO NO VESTE PRIME CARD</option>
 <? } ?>
 <? if($_GET['limite'] != 'CREDITO_PESSOAL_CARTAO_CREDITO'){ ?>
  <option value="CREDITO_PESSOAL_CARTAO_CREDITO">LIMITE EMPRÉSTIMO NO CARTÃO DE CRÉDITO</option>
 <? } ?>
 <? if($_GET['limite'] != 'BANDEIRADO'){ ?>
  <option value="BANDEIRADO">LIMITE BANDEIRADO</option>
 <? } ?>
  <option value="CARNE">LIMITE EMPRÉSTIMO NO CARNÊ</option>
</select>
<br />
  <br>
Concordo que a transferência de limite se aprovado ir&aacute; gerar uma tarifa de <strong style="font:15px Arial, Helvetica, sans-serif;"><strong>R$ 5,90</strong></strong> na fatura do cliente.</p>
  <input name="senha" type="password" id="textfield" style="font:20px Arial, Helvetica, sans-serif; color:#F90; text-align:center; border-radius:5px; border:1px solid #000;" size="5" maxlength="6" autofocus />
  <br>
<hr />

<input style="font:12px Arial, Helvetica, sans-serif; padding:10px; width:80px; margin:5px; border:1px solid #000; border-radius:5px;" name="Submit" type="submit" value="Confirmar" />
</form>
<? } ?>
</body>
</html>