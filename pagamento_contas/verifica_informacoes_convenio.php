<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>

<body>
<?


$orgao = $_POST['orgao'];
$vencimento = $_POST['vencimento'];
$valor = $_GET['valorBoleto'];
$telefone = $_POST['telefone'];
$code_barra = formataCodigo($_GET['boleto']);
$tipo = $_GET['tipo'];
	
$impresso = $_POST['impresso'];

$tarifa_boleto_tarifado = $_GET['tarifaRecebimento'];

if($impresso == 'SIM'){
	$impresso = 2;
}



$code_boleto = rand()*($apenas_hora*$mes);

$cliente = 0;

$valor_recebido = $valor+$impresso+$tarifa_boleto_tarifado;

$autenticacao = md5($valor_recebido);

$sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM carrinho WHERE status = 'Ativo' AND ip = '$ip'");
	while($res_cliente = mysqli_fetch_array($sql_cliente)){
		$cliente = $res_cliente['cliente'];
} // fecha busca cliente

	$code_conjunto = 0;
	$verifica_conjunto = mysqli_query($conexao_bd, "SELECT * FROM pagamento_boleto_conjunto WHERE status = 'Aguarda' AND operador = '$operador'");
		while($res_conjunto = mysqli_fetch_array($verifica_conjunto)){
			$code_conjunto = $res_conjunto['code_conjunto'];
		}
		
$codeVencimento = 0;	
$sqlCodeVencimento = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento WHERE vencimento = '$vencimento'");
	while($resCodeVencimento = mysqli_fetch_array($sqlCodeVencimento)){
		$codeVencimento = $resCodeVencimento['codigo'];
	}		

	mysqli_query($conexao_bd, "INSERT INTO pagamentoboletos 
		(codeHoje, codeCaixa, turno, code_boleto, data, data_completa, dia, mes, ano, ip, operador, status, cliente, valor, code_barras, banco, vencimento, codeVencimento, tarifa_recebimento, boleto_tarifado, boleto_impresso, valor_recebido, autenticacao, tipo, telefone, desconto, juros, confirma_boleto_vencido, boleto_vencido, forma_processamento, banco_processamento, tarifa_processamento, operador_efetivado, data_efetivado, comissao, data_pagamento, observacao, motivo_cancelamento, operador_cancelamento, data_cancelamento, juros_maquina, diferenca_cartao, comprovante, invisivel, conjunto) VALUES 
		('$code_vencimento_hoje', '$codeCaixa', '$turno', '$code_boleto', '$data', '$data_completa', '$dia', '$mes', '$ano', '$ip', '$operador', 'Aguarda', '$cliente', '$valor', '$code_barra', '$orgao', '$vencimento', '$codeVencimento', '$tarifado', '$tarifa_boleto_tarifado', '$impresso', '$valor_recebido', '$autenticacao', '$tipo', '$telefone', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '$code_conjunto')");
	  
	  if($code_conjunto >= 1){
		  echo "<script language='javascript'>window.location='fazer_pagamento_conjunto.php?code_conjunto=$code_conjunto';</script>";
	  }else{
       echo "<script language='javascript'>window.location='?p=4&code_boleto=$code_boleto';</script>";	
	  }



?>
</body>
</html>