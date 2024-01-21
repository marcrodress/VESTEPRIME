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
$conta_clientes_total = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM emprestimo_boleto"))+200;

if($id > ($conta_clientes_total)+10){
echo "<script language='javascript'>window.location='verifica_emprestimo_grupo.php';</script>";	
}else{

$emprestimo = mysqli_query($conexao_bd, "SELECT * FROM emprestimo_boleto WHERE id = '$id'");
if(mysqli_num_rows($emprestimo) == ''){
	$id++;
	echo "<script language='javascript'>window.location='?id=$id';</script>";
}else{
	$n_proposta = 0;
	$valor_total = 0;
	$data_emprestimo = 0;
	$data_completa_emprestimo = 0;
	$dia_emprestimo = 0;
	$mes_emprestimo = 0;
	$ano_emprestimo = 0;
	$status = 0;
	$valor_pago = 0;
	$saldo_pagar = 0;
	$cliente = 0;
	$code_vencimento = 0;
	
   while($res_emprestimo = mysqli_fetch_array($emprestimo)){
	   
	$n_proposta = $res_emprestimo['n_proposta'];
	$valor_total = $res_emprestimo['valor_total'];
	$data_emprestimo = $res_emprestimo['data'];
	$data_completa_emprestimo = $res_emprestimo['data_completa'];
	$dia_emprestimo = $res_emprestimo['dia'];
	$mes_emprestimo = $res_emprestimo['mes'];
	$ano_emprestimo = $res_emprestimo['ano'];
	$status = $res_emprestimo['status'];
	$cliente = $res_emprestimo['cpf'];
	
	 $sql_verifica_parcela = mysqli_query($conexao_bd, "SELECT * FROM boletos_emprestimo_boleto WHERE proposta = '$n_proposta' AND status = 'PAGO'");	   
	 while($res_verifica_parcela = mysqli_fetch_array($sql_verifica_parcela)){
		 $valor_pago = $res_verifica_parcela['valor']+$valor_pago;
	 } // while res_verifica_parcela
	 
	 $saldo_pagar = $valor_total-$valor_pago;
	 
	 $sql_ultimo = mysqli_query($conexao_bd, "SELECT * FROM boletos_emprestimo_boleto WHERE proposta = '$n_proposta' AND status = 'AGUARDA' LIMIT 1");
	 while($res_ultimo = mysqli_fetch_array($sql_ultimo)){
		 $code_vencimento = $res_ultimo['vencimento'];
	 }   
	 
	   
   } // while res_emprestimo
   
   
      
   $sql_divida = mysqli_query($conexao_bd, "SELECT * FROM dados_da_divida WHERE code_divida = '$n_proposta'");
   if(mysqli_num_rows($sql_divida) == NULL){
	   mysqli_query($conexao_bd, "INSERT INTO dados_da_divida (data, data_completa, dia, mes, ano, status, situacao, tipo, vencimento, cliente, code_divida, valor_pago, valor_total, saldo_pagar) VALUES ('$data_emprestimo', '$data_completa_emprestimo', '$dia_emprestimo', '$mes_emprestimo', '$ano_emprestimo', '$status', 'NAO NEGATIVADO', 'CREDITO PESSOAL', '$code_vencimento', '$cliente', '$n_proposta', '$valor_pago', '$valor_total', '$saldo_pagar')");
	   	$id++;
	echo "<script language='javascript'>window.location='?id=$id';</script>";
   }else{
			  $status = 0;
			  while($res_status = mysqli_fetch_array($sql_divida)){
				  $status = $res_status['status'];
			  }
			  if($status != 'NEGOCIACAO'){	   
	   mysqli_query($conexao_bd, "UPDATE dados_da_divida SET vencimento = '$code_vencimento', valor_pago = '$valor_pago', valor_total = '$valor_total', saldo_pagar = '$saldo_pagar', status = '$status' WHERE code_divida = '$n_proposta' AND cliente = '$cliente'");
			  }
			  
	   	$id++;
	echo "<script language='javascript'>window.location='?id=$id';</script>";
   }
 

}// if que verifica o emprestimo no boleto
} // if que verifica se ainda tem cliente para verificar dívida a ser lançada
?>
</body>
</html>