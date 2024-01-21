<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<? require "../../conexao.php"; ?>
</head>

<body>

<? 
$cpf = $_POST['cpf'];
$operadora = $_POST['operadora'];
$telefone = $_POST['telefone'];
$valor = $_POST['valor'];
	
$valor = $_POST['valor'];
$metodo_de_pagamento = $_POST['metodo_de_pagamento'];

$dia = date("d/m/Y");
$date = date("d/m/Y H:i:s");
$ip  = $_SERVER['REMOTE_ADDR'];

$sql_3 = mysql_query("INSERT INTO recargas_de_telefone (date, ip, dia, cpf, operadora, telefone, valor_recarga, valor_total) VALUES ('$date', '$ip', '$cpf', '$operadora', '$telefone', '$valor', '$valor', '$metodo_de_pagamento')");

$ip = $_SERVER['REMOTE_ADDR'];
$date = date("d/m/Y");
$date_complet = date("d/m/Y H:i:s");

$dia = date("d");
$mes = date("m");
$ano = date("Y");

$lucro = $valor*5/100;

$sql_4 = mysql_query("INSERT INTO relatorio_do_caixa (ip, tipo, date, date_complet, dia, mes, ano, codigo, cpf, motivo, valor, forma_de_recebimento, lucro) VALUES ('$ip', 'Crédito', '$date', '$date_complet', '$dia', '$mes', '$ano', '$telefone', '$cpf', 'Recarga de celular pré-pago', '$valor', '$metodo_de_pagamento', '$lucro')");

?>
Recarga efetuada com sucesso!
</body>
</html>