<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>

<body>
<?

$boletoAnalizado = analisaBoleto($_GET['codigoBarras']);

@$banco = $boletoAnalizado['banco'];

@$vencimento = $_POST['vencimento'];

@$juros_multas = $_GET['valorJuros'];

@$valor = $_POST['valor'];
@$descontos = limpaValorBoleto($_POST['descontos']);
@$telefone = $_POST['telefone'];
@$dia_pagamento = $_POST['dia_pagamento'];
@$forma_pgt = $_POST['pagamento'];

$verifica_virgula = 0;

for($i=0; $i<(strlen($valor)); $i++){
	if($valor[$i] == ','){
		$verifica_virgula = 1;
	}
}
for($i=0; $i<(strlen($descontos)); $i++){
	if($descontos[$i] == ','){
		$verifica_virgula = 1;
	}
}


@$impresso = $_POST['impresso'];
@$tarifa_boleto_impresso = 0;

if($impresso == ''){ $tarifa_boleto_impresso = 0; }else{ $tarifa_boleto_impresso = 2; }

@$pontos = array(",", ".");
@$valor = str_replace($pontos, ".", $valor);

@$pontos = array(",", ".");
@$descontos = str_replace($pontos, ".", $descontos);

$tarifa_boleto_vencido = 0;
if($_GET['valorJuros'] == 0){
$tarifa_boleto_vencido = 0;
}else{
$tarifa_boleto_vencido = $_GET['tarifa'];
}

$autenticacao = md5((date("s")+date("H")+date("i")+date("d")));
$code_barra = restaraConfiguracaoBoleto($_GET['codigoBarras']);

$tipo = "BOLETO";

	$sql_confere_fatura = mysqli_query($conexao_bd, "SELECT * FROM faturas_fechadas WHERE anexo_boleto = '$code_barra'");
	if(mysqli_num_rows($sql_confere_fatura) >= 1){
		$banco = "VESTEPRIME CARD";
	}
	
$codeVencimento = 0;	
$sqlCodeVencimento = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento WHERE vencimento = '$vencimento'");
	while($resCodeVencimento = mysqli_fetch_array($sqlCodeVencimento)){
		$codeVencimento = $resCodeVencimento['codigo'];
	}



$n_doc = date("s")*date("d")+date("m")+date("H");
$n_doc = "121.$n_doc";

$code_boleto = rand()+(date("s")*date("s")*date("d")+date("m")+date("Y")+date("H")*date("d"));

$code_boleto = rand()*$code_boleto;


$cliente = 0;
$tarifa_recebimento = $_GET['tarifaRecebimento'];

$valor_recebido = ($tarifa_boleto_impresso+$valor+$juros_multas+$tarifa_recebimento+$tarifa_boleto_vencido)-$descontos;

$sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM carrinho WHERE status = 'Ativo' AND ip = '$ip'");
	while($res_cliente = mysqli_fetch_array($sql_cliente)){
		$cliente = $res_cliente['cliente'];
} // fecha busca cliente


if($valor <=0){
	echo "<script language='javascript'>window.alert('$valor - Verificamos que você está tentando pagar uma fatura de cartão de crédito, por favor, insira o valor do pagamento!');</script>";
}else{
	
	$code_conjunto = 0;
	$verifica_conjunto = mysqli_query($conexao_bd, "SELECT * FROM pagamento_boleto_conjunto WHERE status = 'Aguarda' AND operador = '$operador'");
		while($res_conjunto = mysqli_fetch_array($verifica_conjunto)){
			$code_conjunto = $res_conjunto['code_conjunto'];
		}
	
	$verifica_sucesso_boleto = mysqli_query($conexao_bd, "INSERT INTO pagamentoboletos (
	codeHoje, codeCaixa, turno, code_boleto, data, data_completa, dia, mes, ano, ip, operador, status, cliente, valor, desconto, juros, code_barras, banco, vencimento, codeVencimento, tarifa_recebimento, boleto_vencido, boleto_impresso, valor_recebido, autenticacao, boleto_tarifado, tipo, telefone, confirma_boleto_vencido, forma_processamento, banco_processamento, tarifa_processamento, operador_efetivado, data_efetivado, comissao, data_pagamento, observacao, motivo_cancelamento, operador_cancelamento, data_cancelamento, juros_maquina, diferenca_cartao, comprovante, invisivel, conjunto
	) VALUES (
	'$code_vencimento_hoje', '$codeCaixa', '$turno', '$code_boleto', '$data', '$data_completa', '$dia', '$mes', '$ano', '$ip', '$operador', 'Aguarda', '$cliente', '$valor', '$descontos', '$juros_multas', '$code_barra', '$banco', '$vencimento', '$codeVencimento', '$tarifa_recebimento', '$tarifa_boleto_vencido', '$tarifa_boleto_impresso', '$valor_recebido', '$autenticacao', '$tarifa_recebimento', '$tipo', '$telefone', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '$code_conjunto'
	)");
	if($verifica_sucesso_boleto == ''){
      echo "<script language='javascript'>window.alert('SISTEMA BANCARIO INOPERANTE NO MOMENTO, TENTE NOVAMENTE MAIS TARDE!');</script>";
	}else{
	  $sql_verifica_boleto = mysql_query($conexao_bd, "SELECT * FROM pagamentoboletos WHERE valor = '$valor' AND code_barras = '$code_barra' AND vencimento = '$vencimento' AND data = '$data'");
	  
	  if(mysqli_num_rows($sql_verifica_boleto) == '' && $code_conjunto <= 0){
      echo "<script language='javascript'>window.location='?p=4&code_boleto=$code_boleto';</script>";
	  }elseif(mysqli_num_rows($sql_verifica_boleto) == '' && $code_conjunto >= 1){
      echo "<script language='javascript'>window.location='fazer_pagamento_conjunto.php?code_conjunto=$code_conjunto';</script>";
	  }else{
      echo "<script language='javascript'>window.alert('BOLETO DUPLICADO, CANCELE ESSE BOLETO E TENTE NOVAMENTE!');window.location='boletos_processando.php?p=';</script>";
	  }
	  
	}
  } // verifica se o pagamento já foi efetuado!

?>
</body>
</html>