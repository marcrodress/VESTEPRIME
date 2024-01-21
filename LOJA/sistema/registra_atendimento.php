<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<? require "config.php"; ?>
</head>

<body>
<?

$date_complet = date("d/m/Y H:i:s");
$ip = $_SERVER['REMOTE_ADDR'];
$nome_cliente = $_POST['nome_cliente'];
$telefone_cliente = $_POST['telefone_cliente'];
$cpf_cliente = $_POST['cpf_cliente'];
$rg_cliente = $_POST['rg_cliente'];
$tipo_atendimento_cliente = $_POST['tipo_atendimento'];

$sql_registra = mysql_query("INSERT INTO atendimentos (ip, date, status, nome, telefone, cpf, rg, tipo_atendimento, atendente) VALUES ('$ip', '$date_complet', 'Aberto', '$nome_cliente', '$telefone_cliente', '$cpf_cliente', '$rg_cliente', '$tipo_atendimento_cliente', '$nome_operador')");

echo "<script language='javascript'>window.location='redirecionador';</script>";

?>
</body>
</html>