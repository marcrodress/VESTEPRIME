<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>

<body>
<?
 
 $code_barras = $_GET['code_barras'];
 $cliente = 0;
 $sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM faturas_fechadas WHERE anexo_boleto = '$code_barras'");
 	while($res_cliente = mysqli_fetch_array($sql_cliente)){
		$cliente = $res_cliente['cliente'];
	}

	
 $valor_pag = 0;
 $sql_pag = mysqli_query($conexao_bd, "SELECT * FROM pagamentoboletos WHERE id = '".$_GET['id']."'");
 	while($res_pag = mysqli_fetch_array($sql_pag)){
		  $valor_pag = $res_pag['valor'];

	}

$nome_cliente_sms = 0;
$telefone_cliente = 0;
$sql_email_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '$cliente'");	
	while($res_email_cliente = mysqli_fetch_array($sql_email_cliente)){
		$email_cliente = strtolower($res_email_cliente['email']);
		$nome_cliente = strtoupper($res_email_cliente['nome']);
		$telefone_cliente = $res_email_cliente['celular_1'];
	}

$nome1 = $nome_cliente[0];
$nome2 = $nome_cliente[1];
$nome3 = $nome_cliente[2];
$nome4 = $nome_cliente[3];
$nome5 = $nome_cliente[4];
$nome6 = $nome_cliente[5];
$nome7 = $nome_cliente[6];
$nome8 = $nome_cliente[7];
$nome9 = $nome_cliente[8];
$nome10 = $nome_cliente[9];
$nome11 = $nome_cliente[10];
$nome12 = $nome_cliente[11];
$nome13 = $nome_cliente[12];
$nome14 = $nome_cliente[13];
$nome15 = $nome_cliente[14];
$nome16 = $nome_cliente[15];
$nome17 = $nome_cliente[16];
$nome18 = $nome_cliente[17];
$nome19 = $nome_cliente[18];
$nome20 = $nome_cliente[19];

$valor_sms = number_format($valor_pag,2,',','.');
$nome_cliente_sms = "$nome1$nome2$nome3$nome4$nome5$nome6$nome7$nome8$nome9$nome10$nome11$nome12$nome13$nome14$nome15$nome16$nome17";

$telefone_cliente = str_replace(" ", "", $telefone_cliente); 
$telefone_cliente = str_replace(",", "", $telefone_cliente); 
$telefone_cliente = str_replace("ã", "", $telefone_cliente);
$telefone_cliente = str_replace("á", "", $telefone_cliente); 
$telefone_cliente = str_replace("à", "", $telefone_cliente); 
$telefone_cliente = str_replace("é", "", $telefone_cliente);
$telefone_cliente = str_replace("ê", "", $telefone_cliente); 
$telefone_cliente = str_replace("è", "", $telefone_cliente); 
$telefone_cliente = str_replace("í", "", $telefone_cliente);
$telefone_cliente = str_replace("ì", "", $telefone_cliente); 
$telefone_cliente = str_replace("ó", "", $telefone_cliente); 
$telefone_cliente = str_replace("õ", "", $telefone_cliente);
$telefone_cliente = str_replace("ç", "", $telefone_cliente); 
$telefone_cliente = str_replace("(", "", $telefone_cliente); 
$telefone_cliente = str_replace(")", "", $telefone_cliente);
$telefone_cliente = str_replace(".", "", $telefone_cliente);

$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.smsdev.com.br/v1/send?key=TZXZSWGNSZY51PZTLQ1SI772BRGA1FGQAKH16GEYTWKMUBSHF2K5D4O4REAUCWD2KG686DRENLFCJZKQT0FEJ4V1YSVICR1DCRU1PJW2OZIW48VKFQ8V084I82QJ5SSZ&type=9&number=$telefone_cliente&msg=".urlencode("VESTE PRIME: $nome_cliente_sms, recebemos R$ $valor_sms referente ao pagamento de sua fatura. Obrigado!
  
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
 
 
 
 $code_fatura = 0;
 $valor_fatura = 0;
 $status_fatura = 0;
 $sit_pag = 0;
 $soma_pagamentos = 0;
 $pagamento_minimo = 0;
 $score = 0;
 
 
	mysqli_query($conexao_bd, "INSERT INTO pagamento_fatura (operador, ip, status, data, data_completa, dia, mes, ano, cliente, valor, forma_pagamento) VALUES ('$operador', '$ip', 'Aguarda', '$data', '$data_completa', '$dia', '$mes', '$ano', '$cliente', '$valor_pag', 'DINHEIRO')");
	

    $sql_verifica_ultima_fatura = mysqli_query($conexao_bd, "SELECT * FROM faturas_fechadas WHERE status = 'FECHADO' AND cliente = '$cliente' ORDER BY id DESC LIMIT 1");
		while($res_ultima_fatura = mysqli_fetch_array($sql_verifica_ultima_fatura)){
			$code_fatura = $res_ultima_fatura['code_fatura'];
			$valor_fatura = $res_ultima_fatura['valor'];
			$pagamento_minimo = $res_ultima_fatura['minimo'];
			$status_fatura = $res_ultima_fatura['status'];
			$saldo_fatura = $res_ultima_fatura['saldo'];
		}
	
	if($status_fatura == 'FECHADO'){
		$sql_verifica_pagamentos = mysqli_query($conexao_bd, "SELECT * FROM pagamento_fatura WHERE status = 'Aguarda' AND cliente = '$cliente'");
		while($res_pagamentos = mysqli_fetch_array($sql_verifica_pagamentos)){
		 	$soma_pagamentos = $soma_pagamentos+$res_pagamentos['valor'];
		 }
		if($soma_pagamentos >= $saldo_fatura){
			$sit_pag = "PAGO";
			mysqli_query($conexao_bd, "UPDATE faturas_fechadas SET sit_juros = 'NAO' WHERE code_fatura = '$code_fatura' AND cliente = '$cliente'");
		}else{
			$sit_pag = "PAGO PARCIALMENTE";
		}
		
		$saldo_restante = $saldo_fatura-$soma_pagamentos;
				
		if($saldo_restante <=0){
			$saldo_restante = 0;
		}else{
			$saldo_restante = $saldo_restante;
		}
		
		mysqli_query($conexao_bd, "UPDATE faturas_fechadas SET sit_pag = '$sit_pag', saldo = '$saldo_restante' WHERE code_fatura = '$code_fatura' AND cliente = '$cliente'");
		
	}else{
	}
	
	$verifica_limite_usado = 0;
	$limite_credito = 0;
	$limite_pagamento = 0;
	$novo_limite_pagamento = 0;
	$novo_limite_pagamento_atual = 0;
	$novo_limite = 0;
	$sobra_limite = 0;
	$situacao = 0;
	$situacao2 = 0;
	$status = 0;
	
	$sql_altera_limite = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente WHERE cliente = '$cliente'");
		while($res_altera_limite = mysqli_fetch_array($sql_altera_limite)){
			$limite_atual = $res_altera_limite['limite_loja_disponivel']+0;
			$limite_credito = $res_altera_limite['limite_loja']+0;
			$limite_pagamento = $res_altera_limite['disponivel_pagamento_contas']+0;
			$pagamento_contas = $res_altera_limite['pagamento_contas']+0;
			$score = $res_altera_limite['score'];
			$status = $res_altera_limite['status'];
			$situacao2 = $res_altera_limite['proposta_credito'];
			
			 $novo_limite = $valor_pag+$limite_atual;
			 
			if($novo_limite > $limite_credito){
			   $sobra_limite = $novo_limite-$limite_credito;
			   $novo_limite_pagamento = $limite_pagamento+$sobra_limite;
			   $novo_limite = $limite_credito;
			   
			}else{
				$novo_limite = $novo_limite;
				$novo_limite_pagamento = $novo_limite_pagamento;
			}
			
			if($valor_pag >= $pagamento_minimo){
				if($status == 'CANCELADO'){
				$situacao = 'CANCELADO';				
				}else{
				$situacao = 'ATIVO';
				$situacao2 = 'APROVADO';
				}
				$score = $score+30;
			}else{
				if($status == 'CANCELADO'){
					$situacao = 'CANCELADO';				
				}else{
				$situacao = 'BLOQUEADO';
				}
				$score = $score-($valor_pag*10);
			}
			
			
			
		$score = 0;
		$sql_score = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente WHERE cliente = '$cliente'");
		 while($res_score = mysqli_fetch_array($sql_score)){
			 $score = $res_score['score'];
		 }
		  
		 mysqli_query($conexao_bd, "INSERT INTO score (operador, tipo, data, dia, mes, ano, cliente, descricao, pontos) VALUES ('$operador', 'CREDITO', '$data', '$dia', '$mes', '$ano', '$cliente', 'PAGAMENTO DE FATURA', '".$valor_pag*0.05."')");
		 
		 $score = $score+30;
		 mysqli_query($conexao_bd, "UPDATE conta_corrente SET score = '$score' WHERE cliente = '$cliente'");			
			
			
		 mysqli_query($conexao_bd, "UPDATE conta_corrente SET limite_loja_disponivel = '$novo_limite', disponivel_pagamento_contas = '$novo_limite_pagamento', score = '$score', status = '$situacao', proposta_credito = '$situacao2' WHERE cliente = '$cliente'");
			
		}
		

?>
</body>
</html>