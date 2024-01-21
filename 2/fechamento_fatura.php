<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>FECHAMENTO DE FATURA</title>
</head>

<body>
<? require "conexao.php"; ?>


<?
$valor_fatura = 0;
$calcula_minimo = 0;
$cliente = 0;
$vencimento = 0;
$code_fatura = 0;
$valor_pagamentos = 0;
$code_fatura = 0;
$soma_lancamento = 0;
$soma_pagamentos = 0;
$sit_pag = 0;
$tarifa = 0;
$fatura_liminar = 0;


$sql_verifica_fechamento = mysql_query("SELECT * FROM conta_corrente WHERE fechamento = '$dia' AND status = 'Ativo'");
if(mysql_num_rows($sql_verifica_fechamento) == ''){
}else{
  while($res_verifica_fechamento = mysql_fetch_array($sql_verifica_fechamento)){
	$cliente = $res_verifica_fechamento['cliente'];
	$vencimento = $res_verifica_fechamento['vencimento'];
	
	$sql_verifica_code_fatura = mysql_query("SELECT * FROM faturas_fechadas WHERE status = 'Aberta' AND cliente = '$cliente'");
	if(mysql_num_rows($sql_verifica_code_fatura) == ''){
	}else{
	while($res_code_fatura = mysql_fetch_array($sql_verifica_code_fatura)){
		$code_fatura = $res_code_fatura['code_fatura'];
	  } // fecha o while para pegar o código da fatura
	} // fecha o if se a fatura ainda se encontra aberta
	
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
		$soma_pagamentos = $soma_pagamentos+$res_verifica_pagamento['valor'];
		
		mysql_query("INSERT INTO pagamentos_fechados (id_pagamento, status, data, data_completa, dia, mes, ano, valor, data_pagamento, cliente, code_fatura) VALUES ('$id_pagamento', 'Ativo', '$data', '$data_completa', '$dia', '$mes', '$ano', '$valor_pagamento', '$data_pagamento', '$cliente', '$code_fatura')");
		
		mysql_query("UPDATE pagamento_fatura SET status = 'Lancada' WHERE id = '$id_pagamento'");
		
 } // fecha o while se houve pagamento
} // fecha a verificação para vê se houve pagamento da fatura  


	
	
	$sql_soma_pagamentos = mysql_query("SELECT * FROM pagamentos_fechados WHERE code_fatura = '$code_fatura'");
	while($res_soma_pagamentos = mysql_fetch_array($sql_soma_pagamentos)){
		$soma_pagamentos = $soma_pagamentos+$res_soma_pagamentos['valor'];
	}  // fecha o while da soma de pagamentos
	
	
	$sql_soma_lacamentos = mysql_query("SELECT * FROM lancamento_fechados WHERE code_fatura = '$code_fatura'");
	while($res_soma_lacamentos = mysql_fetch_array($sql_soma_lacamentos)){
		$soma_lancamento = $soma_lancamento+$res_soma_lacamentos['valor'];
	}  // fecha o while da soma de laçamentos
   
    
	$fatura_liminar = number_format($soma_lancamento-$soma_pagamentos,2);
    if($fatura_liminar <= 0){
	}else{
	mysql_query("INSERT INTO lancamento_fechados (code_transacao, status, data, data_completa, dia, mes, ano, valor, cliente, code_fatura, n_parcela) VALUES ('$code_transacao', 'Ativo', '$data', '$data_completa', '$dia', '$mes', '$ano', '2.99', '$cliente', '$code_fatura', 'ANUIDADE')");
	}
	 
	 
	 
   
 
   $mes_vencimento = 0;
   $ano_vencimento = 0;
   
   if($vencimento >18){
	   if(($mes+1) > 12){
		   $mes_vencimento = 1;
	   }else{
		   $mes_vencimento = $mes;
	   }
   }else{
	   $mes_vencimento = $mes;
   }
   
   
   
   if($vencimento >18){
	   if($mes == 12){
	   	$ano_vencimento = $ano+1;
	   }else{
		$ano_vencimento = $ano;
	   }
   }else{
	  $ano_vencimento = $ano; 
   }
   
   if($mes_vencimento <10){
    $mes_vencimento = "0$mes_vencimento";
   }else{
	$mes_vencimento = $mes_vencimento;
   }
   
   if($vencimento <10){
    $vencimento = "0$vencimento";
   }else{
	$vencimento = $vencimento;
   }
   
   
   $data_vencimento = "$vencimento/$mes_vencimento/$ano_vencimento";
     
   $valor_total_fatura = number_format($soma_lancamento-$soma_pagamentos,2);
   
   $minimo = number_format(($valor_total_fatura*0.4),2);
   
   if($valor_total_fatura <= 0){
   	$sit_pag = "PAGO";
   }else{
	$sit_pag = "AGUARDA PAGAMENTO";
   }
   
   $dias_juros = $vencimento+1;
   if($mes_vencimento == '2' && $dias_juros == '29'){
	   $dias_juros = 1;
   }else{
	   $dias_juros = $dias_juros;
   }
   
   
   mysql_query("UPDATE faturas_fechadas SET status = 'FECHADO', valor = '$valor_total_fatura', valor_debitos = '$soma_lancamento', vencimento = '$data_vencimento', minimo = '$minimo', valor_pago = '$soma_pagamentos', mes_vencimento = '$mes_vencimento', sit_pag = '$sit_pag', dia_vencimento = '$vencimento', dias_juros = '$dias_juros' WHERE code_fatura = '$code_fatura'");
   
   
	$valor_fatura = 0;
	$calcula_minimo = 0;
	$cliente = 0;
	$vencimento = 0;
	$code_fatura = 0;
	$valor_pagamentos = 0;
	$code_fatura = 0;
	$soma_lancamento = 0;
	$soma_pagamentos = 0;
	$sit_pag = 0;
	$tarifa = 0;
	$fatura_liminar = 0;
	$dias_juros = 0;


    } // fecha o while para pegar os dados dos clientes

  
} // fecha o if para saber se tem fatura para hoje






?>
</body>
</html>