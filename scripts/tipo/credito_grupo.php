<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>

<body>
<?

$vencimento = 0;

mysqli_query($conexao_bd, "UPDATE dados_da_divida_negociacao SET status = 'NEGOCIACAO' WHERE code_negociacao = '$code_negociacao'");

mysqli_query($conexao_bd, "UPDATE dados_da_divida_negociacao_fechado SET status = 'CONFIRMADO' WHERE code_negociacao = '$code_negociacao'");

$sql_divida = mysqli_query($conexao_bd, "SELECT * FROM dados_da_divida_negociacao WHERE code_negociacao = '$code_negociacao'");
while($res_dividas = mysqli_fetch_array($sql_divida)){
	
mysqli_query($conexao_bd, "UPDATE dados_da_divida SET status = 'NEGOCIACAO' WHERE code_divida = '".$res_dividas['code_divida']."'");
		
}


$sql_negociacao = mysqli_query($conexao_bd, "SELECT * FROM dados_da_divida_negociacao_fechado WHERE code_negociacao = '$code_negociacao'");
while($res_negociacao = mysqli_fetch_array($sql_negociacao)){
	
	$saldo_pagar = $res_negociacao['vl_pagar']-$res_negociacao['valor_parcela'];

$sql_2 = mysqli_query($conexao_bd, "SELECT * FROM boletos_negociacao WHERE proposta = '$code_negociacao' AND status = 'AGUARDA' LIMIT 1");
while($res_2 = mysqli_fetch_array($sql_2)){
	$vencimento = $res_2['vencimento'];
}

$cliente = $_GET['cpf'];
	
mysqli_query($conexao_bd, "INSERT INTO dados_da_divida (data, data_completa, dia, mes, ano, status, situacao, tipo, vencimento, cliente, code_divida, valor_pago, valor_total, saldo_pagar) VALUES ('$data', '$data_completa', '$dia', '$mes', '$ano', 'RENEGOCIACAO', 'NAO NEGATIVADO', 'RENEGOCIACAO', '$vencimento', '".$_GET['cpf']."', '$code_negociacao', '".$res_negociacao['valor_parcela']."', '".$res_negociacao['vl_pagar']."', '$saldo_pagar')");
}

/*
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.smsdev.com.br/v1/send?key=TZXZSWGNSZY51PZTLQ1SI772BRGA1FGQAKH16GEYTWKMUBSHF2K5D4O4REAUCWD2KG686DRENLFCJZKQT0FEJ4V1YSVICR1DCRU1PJW2OZIW48VKFQ8V084I82QJ5SSZ&type=9&number=85984228226&msg=".urlencode("VESTE PRIME: Cliente de CPF: $cliente pagou a negociação, verique.
  
  "),
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_SSL_VERIFYHOST => 0,
  CURLOPT_SSL_VERIFYPEER => 0,
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}	
	
*/

?>
</body>
</html>