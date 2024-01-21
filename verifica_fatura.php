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

$saldo_devedor_fatura = 0;
$saldo_pagador_fatura_pago = 0;
$saldo_pagador_fatura_atual = 0;
$saldo_a_pagar = 0;

$id = $_GET['id'];
if($id == 0){
	$id = 1;
}else{
	echo $id = $id;	
}
$conta_clientes_total = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM conta_corrente"))+200;
if($id > $conta_clientes_total){
echo "<script language='javascript'>window.location='verifica_emprestimo_individual.php';</script>";	
}else{
$conta_clientes = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente WHERE id = '$id'");
if(mysqli_num_rows($conta_clientes) <=0){
$id++;
echo "<script language='javascript'>window.location='?id=$id';</script>";	
}else{
	while($res_fatura = mysqli_fetch_array($conta_clientes)){

		$data = $res_fatura['data'];
		$cliente = $res_fatura['cliente'];
		$data = $res_fatura['data'];
		$data = $res_fatura['data'];
		$data = $res_fatura['data'];
		
		$sql_verifica_fatura = mysqli_query($conexao_bd, "SELECT * FROM compras_parceladas WHERE sit_pag_fatura = '$cliente'");
		if(mysqli_num_rows($sql_verifica_fatura) <=0){
			  $id++;
			  echo "<script language='javascript'>window.location='?id=$id';</script>";				
		}else{
		if(mysqli_num_rows($sql_verifica_fatura) >= 1){
			
			while($res_verifica_saldo_devedor = mysqli_fetch_array($sql_verifica_fatura)){
				$saldo_devedor_fatura = $res_verifica_saldo_devedor['valor_parcela']+$saldo_devedor_fatura;
				
			} // while que soma as compras parceladas
			
		}
		

		$sql_verifica_juros = mysqli_query($conexao_bd, "SELECT * FROM juros_cartao WHERE cliente = '$cliente'");
			while($res_verifica_juros = mysqli_fetch_array($sql_verifica_juros)){
				$saldo_devedor_fatura = $res_verifica_juros['mora_atraso']+$res_verifica_juros['juros']+$res_verifica_juros['iof']+$saldo_devedor_fatura;
			}		
			
			
		$sql_verifica_fatura_pago = mysqli_query($conexao_bd, "SELECT * FROM pagamento_fatura WHERE cliente = '$cliente'");
			while($res_verifica_saldo_pago = mysqli_fetch_array($sql_verifica_fatura_pago)){
				$saldo_pagador_fatura_pago = $res_verifica_saldo_pago['valor']+$saldo_pagador_fatura_pago;
			}

			
			
		$saldo_a_pagar = ($saldo_devedor_fatura-$saldo_pagador_fatura_pago);
			
			
		$data_fatura_vencimento = 0;
		$data_completa_fatura_vencimento = 0;
		$dia_vencimento = 0;
		$mes_vencimento = 0;
		$ano_vencimento = 0;
		$status_ultima_fatura = 0;
		$vencimento_ultima_fatura = 0;
		$code_ultima_fatura = 0;
		
		$sql_ultima_fatura = mysqli_query($conexao_bd, "SELECT * FROM faturas_fechadas WHERE cliente = '$cliente'");
		echo "<br>";
		echo mysqli_num_rows($sql_ultima_fatura);
			while($res_ultima_fatura = mysqli_fetch_array($sql_ultima_fatura)){
				$data_fatura_vencimento = $res_ultima_fatura['data'];
				$data_completa_fatura_vencimento = $res_ultima_fatura['data_completa'];
				$dia_vencimento = $res_ultima_fatura['d'];
				$mes_vencimento = $res_ultima_fatura['m'];
				$ano_vencimento = $res_ultima_fatura['a'];
				$status_ultima_fatura = $res_ultima_fatura['sit_pag'];
				$vencimento_ultima_fatura = $res_ultima_fatura['code_vencimento'];
				$code_ultima_fatura = $res_ultima_fatura['code_fatura'];
			}
		  $sql_verifica_cartao = mysqli_query($conexao_bd, "SELECT * FROM dados_da_divida WHERE cliente = '$cliente' AND tipo = 'CARTAO'");
		  if(mysqli_num_rows($sql_verifica_cartao) == ''){
			  mysqli_query($conexao_bd, "INSERT INTO dados_da_divida (data, data_completa, dia, mes, ano, status, situacao, tipo, vencimento, cliente, code_divida, valor_total, saldo_pagar, valor_pago) VALUES ('$data_fatura_vencimento', '$data_completa_fatura_vencimento', '$dia_vencimento', '$mes_vencimento', '$ano_vencimento', '$status_ultima_fatura', 'NAO NEGATIVADO', 'CARTAO', '$vencimento_ultima_fatura', '$cliente', '$code_ultima_fatura', '$saldo_devedor_fatura', '$saldo_a_pagar', '$saldo_pagador_fatura_pago')");
			  $id++;
			  echo "<script language='javascript'>window.location='?id=$id';</script>";	
		  }else{
			  $status = 0;
			  while($res_status = mysqli_fetch_array($sql_verifica_cartao)){
				  $status = $res_status['status'];
			  }
			  if($status != 'NEGOCIACAO'){
			  mysqli_query($conexao_bd, "UPDATE dados_da_divida SET valor_pago = '$saldo_pagador_fatura_pago', valor_total = '$saldo_devedor_fatura', saldo_pagar = '$saldo_a_pagar', vencimento = '$vencimento_ultima_fatura', code_divida = '$code_ultima_fatura', status = '$status_ultima_fatura', ano = '$ano_vencimento', mes = '$mes_vencimento', dia = '$dia_vencimento', data_completa = '$data_completa_fatura_vencimento', data = '$data_fatura_vencimento' WHERE cliente = '$cliente' AND tipo = 'CARTAO'");
			  }
			  $id++;
			  echo "<script language='javascript'>window.location='?id=$id';</script>";				  
		  }
			
		}

			  $id++;
			  echo "<script language='javascript'>window.location='?id=$id';</script>";				
		
	}
	
 }
} // if que verifica se ainda tem cliente para verificar dívida a ser lançada
?>
</body>
</html>