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
<script src="../SpryAssets/SpryValidationCheckbox.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationCheckbox.css" rel="stylesheet" type="text/css" />
</head>

<body>
<p>
<? if(isset($_POST['enviar'])){

require "../conexao.php";

$tarifa = $_POST['tarifa'];
$senha = $_POST['senha'];

if($tarifa == ''){
	echo "<script language='javascript'>window.alert('O cliente precisa concordar com a tarifa para iniciar a avaliação automática de crédito!');window.location='';</script>";
}elseif($senha == ''){
	echo "<script language='javascript'>window.alert('Peça ao cliente que digite sua senha para iniciar a avaliação de crédito!');window.location='';</script>";
}else{
	
	$cliente = $_GET['cliente'];
	$score = $_GET['score'];
	
	$fatura_pago = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM faturas_fechadas WHERE sit_pag = 'PAGO' AND cliente = '$cliente"));
	$fatura_pago_parcialmente = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM faturas_fechadas WHERE sit_pag = 'PAGO PARCIALMENTE' AND cliente = '$cliente"));;
	$fatura_refaturado = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM faturas_fechadas WHERE sit_pag = 'REFATURADO' AND cliente = '$cliente"));
	$fatura_vencida = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM faturas_fechadas WHERE sit_pag = 'VENCIDA' AND cliente = '$cliente"));
	$faturas = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM faturas_fechadas WHERE cliente = '$cliente'"));
	$code_vencimento_hoje = 0;
	$sql_data = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento WHERE vencimento = '$data'");
	while($res_data = mysqli_fetch_array($sql_data)){
		$code_vencimento_hoje = $res_data['codigo'];
	}
	
	
	$ultima_analise = 0;
	$sql_aumento_limite = mysqli_query($conexao_bd, "SELECT * FROM aumento_limite WHERE cliente = '$cliente' ORDER BY id DESC LIMITE 1");
	while($res_aumento = mysqli_fetch_array($sql_aumento_limite)){
		$ultima_analise = $res_aumento['code_data'];
	}
	
	$sql_confere_senha = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '$cliente' AND senha = '$senha'");
	if(mysqli_num_rows($sql_confere_senha) == ''){
		echo "<script language='javascript'>window.alert('Senha não confere!');window.location='';</script>";

	}else{
	
	if($faturas <=3){
		echo "<strong>Prezado cliente!</strong><br><br>Fizemos uma avaliação de crédito em seu perfil e no momento informamos que não é possível aumentar seus limites atuais, sugerimos que mantenha seus dados sempre atualizados e tenha um bom uso de seu cartão e sempre pague suas faturas em dia.";
		mysqli_query($conexao_bd, "INSERT INTO aumento_limite (data, data_completa, dia, mes, ano, cliente, score, decisao, code_data, motivo) VALUES ('$data', '$data_completa', '$dia', '$mes', '$ano', '$cliente', '$score', 'NEGADO', '$code_vencimento_hoje', 'CLIENTE TEM MENOS DE 3 MESES DE CADASTRO')");
		die;
	}elseif($fatura_vencida >= 1){
		echo "<strong>Prezado cliente!</strong><br><br>Fizemos uma avaliação de crédito em seu perfil e no momento informamos que não é possível aumentar seus limites atuais, sugerimos que mantenha seus dados sempre atualizados e tenha um bom uso de seu cartão e sempre pague suas faturas em dia.";
		mysqli_query($conexao_bd, "INSERT INTO aumento_limite (data, data_completa, dia, mes, ano, cliente, score, decisao, code_data, motivo) VALUES ('$data', '$data_completa', '$dia', '$mes', '$ano', '$cliente', '$score', 'NEGADO', '$code_vencimento_hoje', 'CLIENTE POSSUI FATURA VENCIDA')");
		die;
	}elseif($fatura_pago_parcialmente >= 2){
		echo "<strong>Prezado cliente!</strong><br><br>Fizemos uma avaliação de crédito em seu perfil e no momento informamos que não é possível aumentar seus limites atuais, sugerimos que mantenha seus dados sempre atualizados e tenha um bom uso de seu cartão e sempre pague suas faturas em dia.";
		mysqli_query($conexao_bd, "INSERT INTO aumento_limite (data, data_completa, dia, mes, ano, cliente, score, decisao, code_data, motivo) VALUES ('$data', '$data_completa', '$dia', '$mes', '$ano', '$cliente', '$score', 'NEGADO', '$code_vencimento_hoje', 'TEM MAIS DE DUAS FATURAS PAGAS PARCIALMENTE')");
		die;
	}elseif($fatura_refaturado >= 2){
		echo "<strong>Prezado cliente!</strong><br><br>Fizemos uma avaliação de crédito em seu perfil e no momento informamos que não é possível aumentar seus limites atuais, sugerimos que mantenha seus dados sempre atualizados e tenha um bom uso de seu cartão e sempre pague suas faturas em dia.";
		mysqli_query($conexao_bd, "INSERT INTO aumento_limite (data, data_completa, dia, mes, ano, cliente, score, decisao, code_data, motivo) VALUES ('$data', '$data_completa', '$dia', '$mes', '$ano', '$cliente', '$score', 'NEGADO', '$code_vencimento_hoje', 'TEM MAIS DE DUAS FATURAS REFATURADAS')");
		die;
	}elseif($_GET['score'] <= 500){
		echo "<strong>Prezado cliente!</strong><br><br>Fizemos uma avaliação de crédito em seu perfil e no momento informamos que não é possível aumentar seus limites atuais, sugerimos que mantenha seus dados sempre atualizados e tenha um bom uso de seu cartão e sempre pague suas faturas em dia.";
		mysqli_query($conexao_bd, "INSERT INTO aumento_limite (data, data_completa, dia, mes, ano, cliente, score, decisao, code_data, motivo) VALUES ('$data', '$data_completa', '$dia', '$mes', '$ano', '$cliente', '$score', 'NEGADO', '$code_vencimento_hoje', 'SCORE')");
		die;
	}elseif(($code_vencimento_hoje-$ultima_analise) <60){
		echo "<strong>Prezado cliente!</strong><br><br>Fizemos uma avaliação de crédito em seu perfil e no momento informamos que não é possível aumentar seus limites atuais, sugerimos que mantenha seus dados sempre atualizados e tenha um bom uso de seu cartão e sempre pague suas faturas em dia.";
		mysqli_query($conexao_bd, "INSERT INTO aumento_limite (data, data_completa, dia, mes, ano, cliente, score, decisao, code_data, motivo) VALUES ('$data', '$data_completa', '$dia', '$mes', '$ano', '$cliente', '$score', 'NEGADO', '$code_vencimento_hoje', 'MENOS DE 60 DIAS')");
		die;
	}else{
		
		echo "<img src='../img/correto.jpg' width='15' height='15'> <strong>LIMITE ALTERADO COM SUCESSO!</strong><br><br><strong>Prezado cliente!</strong><br><br>Fizemos uma avaliação de crédito em seu perfil e informamos que seu aumento de limite foi aprovado.<br>Caso deseje, pode fazer a transferência de limite conforme sua necessidade.<br><br><em>Pressione F5 para mesclar a operação.</em>";
		
		$novo_score = $_GET['pagamento_contas'];
		
		mysqli_query($conexao_bd, "INSERT INTO aumento_limite (data, data_completa, dia, mes, ano, cliente, score, decisao, code_data, motivo) VALUES ('$data', '$data_completa', '$dia', '$mes', '$ano', '$cliente', '$score', 'APROVADO', '$code_vencimento_hoje', 'SOLICITAÇÃO APROVADA')");
		
		mysqli_query($conexao_bd, "INSERT INTO informacoes_financeiras_externas (data, cliente, informacao, tipo, valor) VALUES ('$data', '$cliente', 'ALTERAÇÃO DE LIMITES APROVADO', 'CREDITO', '$novo_score')");
		
		$limite_loja = $_GET['limite_loja'];
		$limite_loja_disponivel = $_GET['limite_loja_disponivel'];
		$pagamento_contas = $_GET['pagamento_contas'];
		$disponivel_pagamento_contas = $_GET['disponivel_pagamento_contas'];
		
		mysqli_query($conexao_bd, "UPDATE conta_corrente SET score = '$novo_score', limite_loja = '$limite_loja', limite_loja_disponivel = '$limite_loja_disponivel', pagamento_contas = '$pagamento_contas', disponivel_pagamento_contas = '$disponivel_pagamento_contas' WHERE cliente = '$cliente'");
		
		
		
		$code_transacao = rand();
 		mysqli_query($conexao_bd, "INSERT INTO lancamento_fatura (code_transacao, status, data, data_completa, dia, mes, ano, descricao, valor, code_carrinho, cliente, parcelado, quant_parcela, valor_parcela) VALUES ('$code_transacao', 'Ativo', '$data', '$data_completa', '$dia', '$mes', '$ano', 'TARIFA - AUMENTO DE LIMITE', '20.90', '$code_transacao', '$cliente', '', '', '')");
		
    	mysqli_query($conexao_bd, "INSERT INTO compras_parceladas (code_transacao, ip, status, data_compra, data_completa, estabelecimento, parcela, n_parcela, total_parcela, valor_parcela, sit_pag_fatura) VALUES ('$code_transacao', '$ip', 'Aguarda', '$data', '$data_completa', 'SISTEMA', '1', '1', '1', '20.99', '')");
				
		
		
		die;
   }
  } 
 }
}?>
<form name="" method="post" action="" enctype="multipart/form-data">
  <span id="sprycheckbox1">
  <input type="checkbox" name="tarifa" id="checkbox" />
  <span class="checkboxRequiredMsg">O cliente precisar concordar com a cobran&ccedil;a da tarifa.</span></span>
  <label for="checkbox"></label> 
Concordo que o aumento de limite se aprovado ir&aacute; gerar uma tarifa de <strong style="font:15px Arial, Helvetica, sans-serif;"><strong>R$ 20,90</strong></strong> na fatura do cliente.</p>
<p><hr />
  <p>
    <label for="textfield"></label>
    Digite a senha para confirmar </p>
  <p>
  <input name="senha" type="password" id="textfield" style="font:20px Arial, Helvetica, sans-serif; color:#F90; text-align:center; border-radius:5px; border:1px solid #000;" size="5" maxlength="6" autofocus />
    </p>
  </p>
<p>
  <input style="font:12px Arial, Helvetica, sans-serif; color:#666; padding:5px; border-radius:3px; border:1px solid #000;" type="submit" name="enviar" id="button" value="Confirmar" />
</form>
</p>
<script type="text/javascript">
var sprycheckbox1 = new Spry.Widget.ValidationCheckbox("sprycheckbox1");
</script>
</body>
</html>