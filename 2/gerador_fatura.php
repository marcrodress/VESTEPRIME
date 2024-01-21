<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Gera fatura</title>
</head>

<body>
<? require "conexao.php"; ?>

<?

$sql_verifica_se_existe_fatura_cliente = mysql_query("SELECT * FROM conta_corrente WHERE status = 'Ativo'");
if(mysql_num_rows($sql_verifica_se_existe_fatura_cliente) != ''){
	while($res_cliente = mysql_fetch_array($sql_verifica_se_existe_fatura_cliente)){
		$cliente = $res_cliente['cliente'];
	$sql_busca_faturas = mysql_query("SELECT * FROM faturas_fechadas WHERE cliente = '$cliente' AND status = 'Aberta'");
	if(mysql_num_rows($sql_busca_faturas) == ''){
		$code_fatura = rand();
		mysql_query("INSERT INTO faturas_fechadas (data, data_completa, d, m, a, ip, status, cliente, code_fatura) VALUES ('$data', '$data_completa', '$dia', '$mes', '$ano', '$ip', 'Aberta', '$cliente', '$code_fatura')");
	}else{
	} // fecha o IF
	} // fecha o while
}else{
}

?>
</body>
</html>