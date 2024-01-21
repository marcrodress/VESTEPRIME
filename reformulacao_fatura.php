<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Gerar fatura</title>
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

$sql_verifica_fechamento = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente WHERE fechamento = '$dia' AND status = 'Ativo'");
if(mysqli_num_rows($sql_verifica_fechamento) == ''){
}else{
	while($res_verifica_fechamento = mysqli_fetch_array($sql_verifica_fechamento)){
	$cliente = $res_verifica_fechamento['cliente'];
	$vencimento = $res_verifica_fechamento['vencimento'];
		
	$sql_lancamento_fatura = mysqli_query($conexao_bd, "SELECT * FROM lancamento_fatura WHERE cliente	= '$cliente' AND status = 'Ativo'");
    if(mysqli_num_rows($sql_lancamento_fatura) == ''){
	}else{
		while($res_lancamento_fatura = mysqli_fetch_array($sql_lancamento_fatura)){
			  $code_transacao = $res_lancamento_fatura['code_transacao'];
			  $parcelado = $res_lancamento_fatura['parcelado']; 
			   
			$sql_vefifica_lancamentos = mysqli_query($conexao_bd, "SELECT * FROM compras_parceladas WHERE code_transacao = '$code_transacao' AND status = 'Aguarda' ORDER BY id ASC LIMIT 1");
			if(mysqli_num_rows($sql_vefifica_lancamentos) == ''){
			}else{
				while($res_pega_valor = mysqli_fetch_array($sql_vefifica_lancamentos)){

					$valor_parcela = $res_pega_valor['valor_parcela'];
					$n_parcela = $res_pega_valor['n_parcela'];
					$id_compra_parcelada = $res_pega_valor['id'];
					
					mysqli_query($conexao_bd, "INSERT INTO lancamento_fechados (code_transacao, status, data, data_completa, dia, mes, ano, valor, n_parcela, cliente, id_compra_parcelada, parcelado) VALUES ('$code_transacao', 'Ativo', '$data', '$data_completa', '$dia', '$mes', '$ano', '$valor_parcela', '$n_parcela', '$cliente', '$id_compra_parcelada', '$parcelado')");
					
					mysqli_query($conexao_bd, "UPDATE compras_parceladas SET status = 'Lancada' WHERE id = '$id_compra_parcelada'");
					
					$sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM compras_parceladas WHERE code_transacao = '$code_transacao' AND status = 'Aguarda'");
					if(mysqli_num_rows($sql_verifica) == ''){
						mysqli_query($conexao_bd, "UPDATE lancamento_fatura SET status = 'TERMINADO' WHERE code_transacao = '$code_transacao'");
					} // fecha a verificação se ainda existe fatura					
				} // fecha o while de verificação de lançamentos
			} // fecha a verificação dos lançamentos
	  } // fecha o peda codigo para verifica o lançamento da fatura
	} // fecha a verificação se existe lançamento fatura
   } // fecha o while da conta corrente
   
   
   
$sql_verifica_pagamentos = mysqli_query($conexao_bd, "SELECT * FROM pagamento_fatura WHERE status = 'Aguarda' AND cliente = '$cliente'");
if(mysqli_num_rows($sql_verifica_pagamentos) == ''){
}else{
	while($res_verifica_pagamento = mysqli_fetch_array($sql_verifica_pagamentos)){
		
		$valor_pagamento = $res_verifica_pagamento['valor'];
		$data_pagamento = $res_verifica_pagamento['data'];
		$id_pagamento = $res_verifica_pagamento['id'];
		$valor_pagamentos = $valor_pagamentos+$valor_pagamento;
		
		mysqli_query($conexao_bd, "INSERT INTO pagamentos_fechados (id_pagamento, status, data, data_completa, dia, mes, ano, valor, data_pagamento, cliente) VALUES ('$id_pagamento', 'Ativo', '$data', '$data_completa', '$dia', '$mes', '$ano', '$valor_pagamento', '$data_pagamento', '$cliente')");
		
		mysqli_query($conexao_bd, "UPDATE pagamento_fatura SET status = 'Lancada' WHERE id = '$id_pagamento'");
		
 } // fecha o while se houve pagamento
} // fecha a verificação para vê se houve pagamento da fatura
   
   
     
   $minimo = number_format(0.4*$valor_fatura,2);
   $valor_fatura = number_format($valor_fatura,2);
   
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
	   	$ano_vencimento = $ano_vencimento+1;
	   }else{
		   $ano_vencimento = $ano;
	   }
   }else{
	  $ano_vencimento = $ano; 
   }
   
   
   
   $data_vencimento = "$vencimento/$mes_vencimento/$ano_vencimento";
     
   $valor_total_fatura = number_format($valor_fatura-$valor_pagamento,2);
   
   mysqli_query($conexao_bd, "UPDATE faturas_fechadas SET status = 'FECHADO', valor = '$valor_total_fatura', vencimento = '$data_vencimento', minimo = '$minimo', valor_pago = '$valor_pagamento', valor_debitos = '$valor_fatura', mes_vencimento = '$mes_vencimento', sit_pag = 'NAO PAGO', dia_vencimento = '$vencimento' WHERE code_fatura = '$code_fatura'");
   
   
} // final para verificar se existe fatura para hoje



?>
</body>
</html>