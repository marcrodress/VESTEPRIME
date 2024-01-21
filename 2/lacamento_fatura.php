<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>LANÇAMENTO DE FATURA</title>
</head>

<body>
<? require "conexao.php"; ?>


<?

$cliente = 0;
$vencimento = 0;
$code_fatura = 0;

$sql_verifica_fechamento = mysql_query("SELECT * FROM conta_corrente WHERE fechamento = '$dia' AND status = 'Ativo'");
if(mysql_num_rows($sql_verifica_fechamento) == ''){
}else{
  while($res_verifica_fechamento = mysql_fetch_array($sql_verifica_fechamento)){
	$cliente = $res_verifica_fechamento['cliente'];
	$vencimento = $res_verifica_fechamento['vencimento'];
	
	$sql_verifica_code_fatura = mysql_query("SELECT * FROM faturas_fechadas WHERE status = 'Aberta' AND cliente = '$cliente'");
	while($res_code_fatura = mysql_fetch_array($sql_verifica_code_fatura)){
		$code_fatura = $res_code_fatura['code_fatura'];
	} // fecha o while para pegar o código da fatura
	
	
	$sql_lancamento_fatura = mysql_query("SELECT * FROM lancamento_fatura WHERE cliente	= '$cliente' AND status = 'Ativo'");
    if(mysql_num_rows($sql_lancamento_fatura) == ''){
	}else{
		while($res_lancamento_fatura = mysql_fetch_array($sql_lancamento_fatura)){
			  $code_transacao = $res_lancamento_fatura['code_transacao'];
			  $parcelado = $res_lancamento_fatura['parcelado']; 

			$sql_vefifica_lancamentos = mysql_query("SELECT * FROM compras_parceladas WHERE code_transacao = '$code_transacao' AND status = 'Aguarda' ORDER BY id ASC LIMIT 1");
			if(mysql_num_rows($sql_vefifica_lancamentos) == ''){
			}else{
				while($res_pega_valor = mysql_fetch_array($sql_vefifica_lancamentos)){

					$valor_parcela = $res_pega_valor['valor_parcela'];
					$n_parcela = $res_pega_valor['n_parcela'];
					$id_compra_parcelada = $res_pega_valor['id'];

					mysql_query("INSERT INTO lancamento_fechados (code_transacao, status, data, data_completa, dia, mes, ano, valor, n_parcela, cliente, id_compra_parcelada, parcelado, code_fatura) VALUES ('$code_transacao', 'Ativo', '$data', '$data_completa', '$dia', '$mes', '$ano', '$valor_parcela', '$n_parcela', '$cliente', '$id_compra_parcelada', '$parcelado', '$code_fatura')");
					
					mysql_query("UPDATE compras_parceladas SET status = 'Lancada' WHERE id = '$id_compra_parcelada'");
					$sql_verifica = mysql_query("SELECT * FROM compras_parceladas WHERE code_transacao = '$code_transacao' AND status = 'Aguarda'");
					if(mysql_num_rows($sql_verifica) == ''){
						mysql_query("UPDATE lancamento_fatura SET status = 'TERMINADO' WHERE code_transacao = '$code_transacao'");

				} // fecha o while de verificação de lançamentos
			} // fecha a verificação dos lançamentos
	  } // fecha o peda codigo para verifica o lançamento da fatura
	} // fecha a verificação se existe lançamento fatura
   } // fecha o while da conta corrente	
  
  
   
   
   
$sql_verifica_pagamentos = mysql_query("SELECT * FROM pagamento_fatura WHERE status = 'Aguarda' AND cliente = '$cliente'");
if(mysql_num_rows($sql_verifica_pagamentos) == ''){
}else{
	while($res_verifica_pagamento = mysql_fetch_array($sql_verifica_pagamentos)){
		
		$valor_pagamento = $res_verifica_pagamento['valor'];
		$data_pagamento = $res_verifica_pagamento['data'];
		$id_pagamento = $res_verifica_pagamento['id'];
		$valor_pagamentos = $valor_pagamentos+$valor_pagamento;
		
		mysql_query("INSERT INTO pagamentos_fechados (id_pagamento, status, data, data_completa, dia, mes, ano, valor, data_pagamento, cliente, code_fatura) VALUES ('$id_pagamento', 'Ativo', '$data', '$data_completa', '$dia', '$mes', '$ano', '$valor_pagamento', '$data_pagamento', '$cliente', '$code_fatura')");
		
		mysql_query("UPDATE pagamento_fatura SET status = 'Lancada' WHERE id = '$id_pagamento'");
		
 } // fecha o while se houve pagamento
} // fecha a verificação para vê se houve pagamento da fatura  

    } // fecha o while para pegar os dados dos clientes

  
} // fecha o if para saber se tem fatura para hoje






?>
</body>
</html>