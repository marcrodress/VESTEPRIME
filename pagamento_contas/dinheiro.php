<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>

<body>
<?
$code_conjunto = $_GET['code_conjunto'];

if($code_conjunto <=0){
$pag_form = $_GET['pag_form'];
$valorusar = $_GET["valorusar"];

 $pagamentos_feitos = 0;
 $sql_busca_pagamento = mysqli_query($conexao_bd, "SELECT * FROM pagamento_boletos_opcoes WHERE code_boleto = '$code_boleto'");
 	while($res_busca_pagamento = mysqli_fetch_array($sql_busca_pagamento)){
		$pagamentos_feitos = $res_busca_pagamento['valor']+$pagamentos_feitos;
	}
 
 $falta_pagar = ($res_boleto['valor_recebido']-$pagamentos_feitos);
 
$troco = $valorusar-$falta_pagar;
if($troco <=0){
	$troco = 0;
}else{
	$troco = $troco;
}

if($valorusar > $falta_pagar){
	$valorusar = $falta_pagar;
}else{
	$valorusar = $valorusar;
}

mysqli_query($conexao_bd, "INSERT INTO pagamento_boletos_opcoes (codeCaixa, turno, code_boleto, data, data_completa, dia, mes, ano, operador, status, forma_pagamento, n_parcelas, bandeira, valor, valor_parcela, valor_transacao, troco, cliente, limite_antes, limite_consumido, cheque_especial, conjunto) VALUES ('$codeCaixa', '$turno', '$code_boleto', '$data', '$data_completa', '$dia', '$mes', '$ano', '$operador', 'Ativo', '$pag_form', '1', '$pag_form', '$valorusar', '$valorusar', '$valorusar', '$troco', '$cliente', '', '', '', '$code_conjunto')");
 
echo "<script language='javascript'>window.location='?p=4&code_boleto=$code_boleto';</script>";

}


if($code_conjunto >=1){
$pag_form = $_GET['pag_form'];
$valorusar = $_GET['valorusar'];


 $pagamentos_feitos = 0;
 $sql_busca_pagamento = mysqli_query($conexao_bd, "SELECT * FROM pagamento_boletos_opcoes WHERE conjunto = '$code_conjunto'");
 	while($res_busca_pagamento = mysqli_fetch_array($sql_busca_pagamento)){
		$pagamentos_feitos = $res_busca_pagamento['valor']+$pagamentos_feitos;
	}
 
 $falta_pagar = ($valor_total-$pagamentos_feitos);
 

$troco = $valorusar-$falta_pagar;
if($troco <=0){
	$troco = 0;
}else{
	$troco = $troco;
}

if($valorusar > $falta_pagar){
	$valorusar = $falta_pagar;
}else{
	$valorusar = $valorusar;
}

mysqli_query($conexao_bd, "INSERT INTO pagamento_boletos_opcoes (codeCaixa, turno, code_boleto, data, data_completa, dia, mes, ano, operador, status, forma_pagamento, n_parcelas, bandeira, valor, valor_parcela, valor_transacao, troco, cliente, limite_antes, limite_consumido, cheque_especial, conjunto) VALUES ('$codeCaixa', '$turno', '$code_boleto', '$data', '$data_completa', '$dia', '$mes', '$ano', '$operador', 'Ativo', '$pag_form', '1', '$pag_form', '$valorusar', '$valorusar', '$valorusar', '$troco', '$cliente', '', '', '', '$code_conjunto')");
 
echo "<script language='javascript'>window.location='?code_conjunto=$code_conjunto';</script>";	
}

?>
</body>
</html>