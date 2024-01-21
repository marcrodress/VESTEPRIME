<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Gera fatura</title>
<link href="img/logo.png" rel="shortcut icon" />
<style type="text/css">
body,td,th {
	color: #000;
}
body {
	background-color:#0FF;
}
</style>
</head>

<body>
<img src="img/roler.gif" /> Carregando sistema e módulos de segurança...<br /><br />
<? require "conexao.php"; ?>

<?

mysqli_query($conexao_bd, "UPDATE conta_corrente SET status = 'ATIVO' WHERE status = 'Ativo'");
mysqli_query($conexao_bd, "UPDATE faturas_fechadas SET sit_juros = 'NAO' WHERE sit_pag = 'REFATURADO'");


/*
mysql_query("UPDATE compras_parceladas SET status = 'Aguarda'");
mysql_query("UPDATE pagamento_fatura SET status = 'Aguarda'");
*/

/*
mysql_query("UPDATE conta_corrente SET status = 'Ativo'");
*/



$valor_fatura = 0;
$calcula_minimo = 0;
$cliente = 0;
$vencimento = $dia;
$fechamento = $dia;
$code_fatura = 0;
$valor_pagamentos = 0;
$code_fatura = 0;
$soma_lancamento = 0;
$soma_pagamentos = 0;
$sit_pag = 0;
$tarifa = 0;
$fatura_liminar = 0;
$mes_vencimento = 0;
$ano_vencimento = 0;
$code_vencimento_fatura = 0;
   

   if($vencimento >=19){
	   if(($mes+1) > 12){
		   $mes_vencimento = "01";
	   }else{
		   $mes_vencimento = $mes+1;
		   if($mes_vencimento <10){
		   	$mes_vencimento = "0$mes_vencimento";		   
		   }else{
		   	$mes_vencimento = $mes_vencimento; 
		   }
	   }
   }else{
	   $mes_vencimento = $mes;
		   if($mes_vencimento <10){
		   	$mes_vencimento = "$mes_vencimento";	   
		   }else{
		   	$mes_vencimento = $mes_vencimento; 
		   }	   
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


$id = $_GET['id'];
if($id == 0){
	$id = 1;
}else{
	echo $id = $id;	
}


$conta_clientes = mysqli_num_rows((mysqli_query($conexao_bd, "SELECT * FROM conta_corrente")))+200;


if($id > $conta_clientes){
echo "<script language='javascript'>window.location='lacamento_fatura.php?id_cliente=1';</script>";	
}

$code_fatura = rand()+$dia+$id+$ano;
  
$sql_1_verifica_vencimento = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente WHERE id = '$id' AND fechamento = '$dia'");
if(mysqli_num_rows($sql_1_verifica_vencimento) == ''){
$id++;
echo "<script language='javascript'>window.location='?id=$id';</script>";
}else{
    while($res_verifica_vencimento = mysqli_fetch_array($sql_1_verifica_vencimento)){
		
		$vencimento = $res_verifica_vencimento['vencimento'];
		$cliente = $res_verifica_vencimento['cliente'];
		
		if($vencimento == 1){
			$vencimento = "01";
		}elseif($vencimento == 2){
			$vencimento = "02";
		}elseif($vencimento == 3){
			$vencimento = "03";
		}elseif($vencimento == 4){
			$vencimento = "04";
		}elseif($vencimento == 5){
			$vencimento = "05";
		}elseif($vencimento == 6){
			$vencimento = "06";
		}elseif($vencimento == 7){
			$vencimento = "07";
		}elseif($vencimento == 8){
			$vencimento = "08";
		}elseif($vencimento == 9){
			$vencimento = "09";
		}else{
			$vencimento = $vencimento;
			} // verifica vencimento
		
		echo $data_vecimento = "$vencimento/$mes_vencimento/$ano_vencimento";
		echo "<br>$cliente<br>";
		
		if($vencimento == 28 && $mes_vencimento == 2){
			$dias_juros = "01";
		}else{
			$dias_juros = $vencimento+1;
		} // verifica vencimento
		
		
		if($dias_juros == 1){
			$dias_juros = "01";
		}elseif($dias_juros == 2){
			$dias_juros = "02";
		}elseif($dias_juros == 3){
			$dias_juros = "03";
		}elseif($dias_juros == 4){
			$dias_juros = "04";
		}elseif($dias_juros == 5){
			$dias_juros = "05";
		}elseif($dias_juros == 6){
			$dias_juros = "06";
		}elseif($dias_juros == 7){
			$dias_juros = "07";
		}elseif($dias_juros == 8){
			$dias_juros = "08";
		}elseif($dias_juros == 9){
			$dias_juros = "09";
		}else{
			$dias_juros = $dias_juros;
			} // verifica dias de juros		
		
		
		$sql_refaturamento = mysqli_query($conexao_bd, "UPDATE faturas_fechadas SET sit_pag = 'REFATURADO', sit_juros = 'NAO' WHERE sit_pag = 'VENCIDA' AND cliente = '$cliente'");
		if($sql_refaturamento == ''){
		}else{
		  
		  $sql_limite = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente SET limite_loja = '0', limite_loja_disponivel = '0', pagamento_contas = '0', disponivel_pagamento_contas = '0', credito_pessoal = '0', credito_pessoal_disponivel = '0', credito_pessoal_cartao_credito = '0', credito_pessoal_cartao_credito_dsponivel = '0', limite_bandeirado = '0', limite_bandeirado_disponivel = '0' WHERE cliente = '$cliente'");
		  
		  
		$score = 0;
		$sql_score = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente WHERE cliente = '$cliente'");
		 while($res_score = mysqli_fetch_array($sql_score)){
			 $score = $res_score['score'];
		 }
		  
		   mysqli_query($conexao_bd, "INSERT INTO score (operador, tipo, data, dia, mes, ano, cliente, descricao, pontos) VALUES ('$operador', 'DEBITO', '$data', '$dia', '$mes', '$ano', '$cliente', 'REFATURAMENTO DA FATURA', '".$score*0.9."')");
		 
		  $score = $score*0.9;
		   mysqli_query($conexao_bd, "UPDATE conta_corrente SET score = '$score' WHERE cliente = '$cliente'");		  
		  
		  
		}
		
		
		
		$verifica_existe = mysqli_query($conexao_bd, "SELECT * FROM faturas_fechadas WHERE vencimento = '$data_vecimento' AND cliente = '$cliente'");
		if(mysqli_num_rows($verifica_existe) == ''){
			
			$sql_vencimento = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento WHERE vencimento = '$data_vecimento'");
			 while($res_code_vencimento = mysqli_fetch_array($sql_vencimento)){
				 $code_vencimento_fatura = $res_code_vencimento['codigo'];
			 }
			
			
			mysqli_query($conexao_bd, "INSERT INTO faturas_fechadas (data, data_completa, d, m, a, ip, status, cliente, code_fatura, mes_vencimento, dia_vencimento, vencimento, dias_juros, valor, saldo, valor_debitos, minimo, valor_pago, sit_pag, sit_juros, total_dias_juros, saldo_juros, boleto_bancario, soma_lancamento, soma_juros, soma_pagamentos, saldo_anterior, anexo_boleto, sit_boleto, code_vencimento, vencimento_sete_dias, vencimento_tres_dias, vencimento_um_dia) VALUES ('$data', '$data_completa', '$dia', '$mes', '$ano', '$ip', 'Aberto', '$cliente', '$code_fatura', '$mes_vencimento', '$vencimento', '$data_vecimento', '$dias_juros', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '$code_vencimento_fatura', '".($code_vencimento_fatura-7)."', '".($code_vencimento_fatura-3)."', '".($code_vencimento_fatura-1)."')");
		$id++;
		echo "<script language='javascript'>window.location='?id=$id';</script>";
		}else{ 
		$id++;
		echo "<script language='javascript'>window.location='?id=$id';</script>";
		} // verifica se a fatura foi fechada
		
		
	$sql_tira_juros = mysqli_query($conexao_bd, "SELECT * FROM faturas_fechadas WHERE cliente = '$cliente' AND status = 'FECHADO' ORDER BY id DESC LIMIT 1");
	if(mysqli_num_rows($sql_tira_juros) == ''){
	}else{
		while($res_juros = mysqli_fetch_array($sql_tira_juros)){
			
			$code_fatura_antiga = $res_juros['code_fatura'];
			
			mysqli_query($conexao_bd, "UPDATE faturas_fechadas SET sit_juros = 'NAO' WHERE code_fatura = '$code_fatura_antiga'");
			
		} // while o tira juros
	} // verifica o tira juros
	
	
	$id++;
	echo "<script language='javascript'>window.location='?id=$id';</script>";
	} // verifica o fechamento
} // fecha a verificação se existe cliente com vencimento para hoje







/*
$sql_verifica_se_existe_fatura_cliente = mysql_query("SELECT * FROM conta_corrente WHERE status = 'Ativo' AND fechamento = '$dia'");
if(mysql_num_rows($sql_verifica_se_existe_fatura_cliente) != ''){
	while($res_cliente = mysql_fetch_array($sql_verifica_se_existe_fatura_cliente)){
		$cliente = $res_cliente['cliente'];
		$vencimento = $res_verifica_fechamento['vencimento'];
		$fechamento = $res_verifica_fechamento['fechamento'];




	$sql_busca_faturas = mysql_query("SELECT * FROM faturas_fechadas WHERE cliente = '$cliente' AND vencimento = '$data_vencimento'");
	if(mysql_num_rows($sql_busca_faturas) == ''){
		$code_fatura = rand();
		mysql_query("INSERT INTO faturas_fechadas (data, data_completa, d, m, a, ip, status, cliente, code_fatura, vencimento) VALUES ('$data', '$data_completa', '$dia', '$mes', '$ano', '$ip', 'Aberta', '$cliente', '$code_fatura', '$data_vencimento')");
		echo "<script language='javascript'>window.location='lacamento_fatura.php?id_cliente=1';</script>";
	}else{
		echo "<script language='javascript'>window.location='lacamento_fatura.php?id_cliente=1';</script>";
	} // fecha o IF
	} // fecha o while
}else{
}


*/

?>
</body>
</html>