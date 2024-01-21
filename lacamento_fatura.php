<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>LANÇAMENTO DE FATURA</title>
<style type="text/css">
body,td,th {
	color: #000;
}
body {
	background-color:#09C;
}
</style>
</head>

<body>
<img src="img/roler.gif" /> Carregando sistema e módulos de segurança...<br /><br />

<? require "conexao.php"; ?>


<?

$conta_clientes = mysqli_num_rows((mysqli_query($conexao_bd, "SELECT * FROM conta_corrente")))+200;




$valor_fatura = 0;
$calcula_minimo = 0;
$cliente = 0;
$vencimento = 0;
$fechamento = 0;
$code_fatura = 0;
$valor_pagamentos = 0;
$code_fatura = 0;
$soma_lancamento = 0;
$soma_pagamentos = 0;
$sit_pag = 0;
$tarifa = 0;
$fatura_liminar = 0;

$id_cliente = $_GET['id_cliente'];
if($id_cliente == ''){
	$id_cliente = 1;
}else{
	$id_cliente = $id_cliente;
}

if($id_cliente > $conta_clientes){
	echo "<script language='javascript'>window.location='fechamento_fatura.php?id_cliente=1';</script>";
}

$sql_1_verifica_lacamento = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente WHERE id = '$id_cliente' AND fechamento = '$dia'");
if(mysqli_num_rows($sql_1_verifica_lacamento) == ''){
$id_cliente++;

echo "<br>O fechamento da fatura desse cliente não é para hoje: $dia</br>";

echo "<script language='javascript'>window.location='?id_cliente=$id_cliente';</script>";
}else{
  while($res_verifica_lacamento = mysqli_fetch_array($sql_1_verifica_lacamento)){	  
	  $cliente = $res_verifica_lacamento['cliente'];
   	  
	  echo "<br>Verificação de conta corrente está OK: $dia para o cliente $cliente</br>";

	  $sql_puxa_fatura = mysqli_query($conexao_bd, "SELECT * FROM faturas_fechadas WHERE cliente = '$cliente' AND status = 'Aberto'");
	  if(mysqli_num_rows($sql_puxa_fatura) == ''){
   		echo "<br>Não foi encontrado faturas em aberto para o cliente $cliente</br>";
	  }else{
		while($res_puxa_fatura = mysqli_fetch_array($sql_puxa_fatura)){
   			echo "<br>Foi encontrado faturas em aberto</br>";
		 $code_fatura = $res_puxa_fatura['code_fatura'];
		 $sql_lacamentos = mysqli_query($conexao_bd, "SELECT * FROM lancamento_fatura WHERE cliente = '$cliente' AND status = 'Ativo'");
		 if(mysqli_num_rows($sql_lacamentos) == ''){
    		echo "<br>Não encontrado lançamento em aberto</br>";
		
		 }else{
		   while($res_lacamento = mysqli_fetch_array($sql_lacamentos)){
    		echo "<br>Foi encontrado lançamento em aberto</br>";
			$code_transacao = $res_lacamento['code_transacao'];
			$parcelado = $res_lacamento['parcelado']; 
			$sql_parceladas = mysqli_query($conexao_bd, "SELECT * FROM compras_parceladas WHERE code_transacao = '$code_transacao' AND status = 'Aguarda' LIMIT 1");	
			if(mysqli_num_rows($sql_parceladas) == ''){
				echo "<br>NÃO EXISTE PARCELA PARA SER LANÇADA, FOI FINALIZADO.</br>";
				mysqli_query($conexao_bd, "UPDATE lancamento_fatura SET status = 'TERMINADO' WHERE code_transacao = '$code_transacao'");
			}else{
				while($res_parceladas = mysqli_fetch_array($sql_parceladas)){
				echo "<br>EXISTE PARCELA PARA SER LANÇADA, FOI FINALIZADO.</br>";
					
					$n_parcela = $res_parceladas['n_parcela'];
					$valor_parcela = $res_parceladas['valor_parcela'];
					$id_parcela = $res_parceladas['id'];
					$id_compra_parcelada = $res_parceladas['id'];
					
					$sql_verifica_fechamento = mysqli_query($conexao_bd, "SELECT * FROM lancamento_fechados WHERE code_fatura = '$code_fatura' AND code_transacao = '$code_transacao'");
					if(mysqli_num_rows($sql_verifica_fechamento) >= 1){
					}else{

					mysqli_query($conexao_bd, "INSERT INTO lancamento_fechados (code_transacao, status, data, data_completa, dia, mes, ano, valor, n_parcela, cliente, id_compra_parcelada, parcelado, code_fatura) VALUES ('$code_transacao', 'Ativo', '$data', '$data_completa', '$dia', '$mes', '$ano', '$valor_parcela', '$n_parcela', '$cliente', '$id_compra_parcelada', '$parcelado', '$code_fatura')");
					
					mysqli_query($conexao_bd, "UPDATE compras_parceladas SET status = 'Lancada' WHERE id = '$id_compra_parcelada'");

					$sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM compras_parceladas WHERE code_transacao = '$code_transacao' AND status = 'Aguarda'");
					if(mysqli_num_rows($sql_verifica) == ''){
						mysqli_query($conexao_bd, "UPDATE lancamento_fatura SET status = 'TERMINADO' WHERE code_transacao = '$code_transacao'");
					}else{
					} // fecha o if de compras parceladas						
				} // fecha o IF que mostra que os lançamentos foram fechados								
			 } // fecha o while das compras parceladas
			} // fecha o if que verifica as compras parceladas   
		   } // fecha o while de lamento da fatura
		 } // fecha o IF do lançamento da fatura		 
		} // fecha o while de faturas fechadas
	  } // fecha o if de faturas fechadas


echo "<br>VERIFICAÇÃO DE PAGAMENTO!</br>";

$code_fatura = $code_fatura;
$valor_pagamentos = 0;
$sql_verifica_pagamentos = mysqli_query($conexao_bd, "SELECT * FROM pagamento_fatura WHERE status = 'Aguarda' AND cliente = '$cliente'");
if(mysqli_num_rows($sql_verifica_pagamentos) == ''){
}else{
	while($res_verifica_pagamento = mysqli_fetch_array($sql_verifica_pagamentos)){
	
	$data_pagamento = $res_verifica_pagamento['data'];
	$id_pagamento = $res_verifica_pagamento['id'];
	$valor_pagamento = $res_verifica_pagamento['valor'];
	$valor_pagamentos = $res_verifica_pagamento['valor']+$valor_pagamentos;	 
	
		$sql_puxa_fatura = mysqli_query($conexao_bd, "SELECT * FROM faturas_fechadas WHERE cliente = '$cliente' ORDER BY id DESC LIMIT 1");
		while($res_puxa_fatura = mysqli_fetch_array($sql_puxa_fatura)){
		$code_fatura = $res_puxa_fatura['code_fatura'];
		}	
	
		mysqli_query($conexao_bd, "INSERT INTO pagamentos_fechados (id_pagamento, status, data, data_completa, dia, mes, ano, valor, data_pagamento, cliente, code_fatura) VALUES ('$id_pagamento', 'Ativo', '$data', '$data_completa', '$dia', '$mes', '$ano', '$valor_pagamento', '$data_pagamento', '$cliente', '$code_fatura')");
		
		mysqli_query($conexao_bd, "UPDATE pagamento_fatura SET status = 'Lancada' WHERE id = '$id_pagamento'");		
  } // fecha o whiile que verifica o pagamento da fatura
} // fecha o if que verifica se houve pagamentos




/*
  $sql_verifica_juros = mysql_query("SELECT * FROM juros_cartao WHERE status = 'Aguarda' AND cliente = '$cliente'");
  if(mysql_num_rows($sql_verifica_juros) == ''){
  }else{
	  while($res_juros = mysql_fetch_array($sql_verifica_juros)){
	   
	   $id_juros = $res_juros['id'];
	   
	   mysql_query("UPDATE juros_cartao SET status = 'Lancada' WHERE id = '$id_juros'");
	   
	} // fecha o while do juros do cartão
  } // fecha o IF que verifica que existe juros do cartão
*/


echo "<br>";
$code_fatura;


  $id_cliente++;
  echo "<script language='javascript'>window.location='?id_cliente=$id_cliente';</script>";


  } // fecha o while da conta corrente

} // fecha a fatura com todos os lançamentos





?>
</body>
</html>