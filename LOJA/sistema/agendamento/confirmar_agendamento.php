<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<? require "../../conexao.php"; ?>
</head>

<body>
<?

$date_complet = date("d/m/Y H:i:s");
$ip = $_SERVER['REMOTE_ADDR'];
$nome_cliente = $_POST['nome_cliente'];
$telefone_cliente = $_POST['telefone_cliente'];
$cpf_cliente = $_POST['cpf_cliente'];
$atividade = $_POST['atividade'];

$sql_registra = mysql_query("INSERT INTO atividades (ip, date, status, nome, telefone, cpf, atividade) VALUES ('$ip', '$date_complet', 'Ativo', '$nome_cliente', '$telefone_cliente', '$cpf_cliente', '$atividade')");

echo "<script language='javascript'>window.alert('Agendamento realizado com sucesso!');window.location='../redirecionador';</script>";

?>
</body>
</html>