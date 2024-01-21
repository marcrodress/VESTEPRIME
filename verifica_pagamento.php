<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>VERIFICA JUROS</title>
</head>

<body>
<?
require "conexao.php";


$id_cliente = $_GET['id_cliente'];
if($id_cliente == ''){
	$id_cliente = 1;
}

$conta_clientes = mysqli_num_rows((mysqli_query($conexao_bd, "SELECT * FROM faturas_fechadas")))+200;


if($id_cliente > $conta_clientes){
	echo "<script language='javascript'>window.location='verifica_fatura.php';</script>";
}
$total_dias_juros = 0;
echo "<br>DIA DE JUROS $dia<br>";
$sql_verifica_faturas = mysqli_query($conexao_bd, "SELECT * FROM faturas_fechadas WHERE dias_juros = '$dia' AND id = '$id_cliente'");
if(mysqli_num_rows($sql_verifica_faturas) == ''){
$id_cliente++;
echo "Cliente não está passível aplicação de JUROS";
echo "<script language='javascript'>window.location='?id_cliente=$id_cliente';</script>";
}else{
echo "Cliente está passível de aplicação de JUROS";

	while($res_verifica_juros = mysqli_fetch_array($sql_verifica_faturas)){
		$status_fatura = $res_verifica_juros['sit_pag'];
		$saldo = $res_verifica_juros['saldo'];
		$cliente = $res_verifica_juros['cliente'];
		$code_fatura = $res_verifica_juros['code_fatura'];
		
		if($status_fatura == 'PAGO PARCIALMENTE' || $status_fatura == 'AGUARDA PAGAMENTO' && $saldo > 0){		


		 mysqli_query($conexao_bd, "UPDATE faturas_fechadas SET sit_juros = 'SIM', sit_pag = 'VENCIDA' WHERE code_fatura = '$code_fatura'");
		 
		 mysqli_query($conexao_bd, "UPDATE conta_corrente SET status = 'BLOQUEADO', proposta_credito = 'BLOQUEADO POR FALTA DE PAGAMENTO' WHERE cliente = '$cliente' AND status != 'CANCELADO'");
		 
		 echo $code_fatura;
		 

		 $incluir_juros = mysqli_query($conexao_bd, "SELECT * FROM juros_cartao WHERE code_fatura = '$code_fatura'");
		 if(mysqli_num_rows($incluir_juros) == ''){
			 mysqli_query($conexao_bd, "INSERT INTO juros_cartao (status, ip, dia, mes, ano, data, data_completa, code_fatura, cliente, dias_atraso, multa_atraso, valor, tipo, fatura_lancamento, mora_atraso, ultimo_juro, juros, iof) VALUES ('Aguarda', '$ip', '$dia', '$mes', '$ano', '$data', '$data_completa', '$code_fatura', '$cliente', '0', '0', '0', 'MULTA', '0', '0', '0', '0', '0')");
			 mysqli_query($conexao_bd, "INSERT INTO juros_cartao (status, ip, dia, mes, ano, data, data_completa, code_fatura, cliente, dias_atraso, mora_atraso, valor, tipo, fatura_lancamento, multa_atraso, ultimo_juro, juros, iof) VALUES ('Aguarda', '$ip', '$dia', '$mes', '$ano', '$data', '$data_completa', '$code_fatura', '$cliente', '0', '0', '0', 'MORA', '0', '0', '0', '0', '0')");
			 mysqli_query($conexao_bd, "INSERT INTO juros_cartao (status, ip, dia, mes, ano, data, data_completa, code_fatura, cliente, dias_atraso, mora_atraso, valor, tipo, fatura_lancamento, multa_atraso, ultimo_juro, juros, iof) VALUES ('Aguarda', '$ip', '$dia', '$mes', '$ano', '$data', '$data_completa', '$code_fatura', '$cliente', '0', '0', '0', 'JUROS', '0', '0', '0', '0', '0')");
			 mysqli_query($conexao_bd, "INSERT INTO juros_cartao (status, ip, dia, mes, ano, data, data_completa, code_fatura, cliente, dias_atraso, mora_atraso, valor, tipo, fatura_lancamento, multa_atraso, ultimo_juro, juros, iof) VALUES ('Aguarda', '$ip', '$dia', '$mes', '$ano', '$data', '$data_completa', '$code_fatura', '$cliente', '0', '0', '0', 'IOF', '0', '0', '0', '0', '0')");
			 
		 }else{
		 } // verifica se tem juros
		} // fecha a verificação de pagamento
	}
	
$id_cliente++;
echo "<script language='javascript'>window.location='?id_cliente=$id_cliente';</script>";
} // final que verifica se existe juros para hoje
?>
</body>
</html>