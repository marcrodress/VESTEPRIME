<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-" />
<? require "../../conexao.php"; ?>
</head>

<body>

<?

$n_proposta = $_POST['n_proposta'];
$cpf = $_POST['cpf'];
$valor = $_POST['valor'];
$meses = $_POST['meses'];
$mensalidade = $_POST['mensalidade'];
$sit_profissional = $_POST['sit_profissional'];

$ip = $_SERVER['REMOTE_ADDR'];
$date = date("d/m/Y");
$date_complet = date("d/m/Y H:i:s");

$sql_5 = mysql_query("INSERT INTO envio_de_propostas (ip, date, status, tipo_de_proposta, tipo_de_emprestimo, n_proposta, cpf, empresa_de_envio, valor_parcelas, valor_solicitado, quantidade_parcelas, motivo_em) VALUES ('$ip', '$date', 'Em análise', 'Empréstimo', '$sit_profissional', '$n_proposta', '$cpf', 'Mesf', '$mensalidade', '$valor', '$meses', 'Não informado')");

if($sql_5 == ''){
	echo "<script language='javascript'>window.alert('Ocorreu um erro, ao enviar dados para análise!');window.location='../?pack=Eb5S&tipo=carteira_assinada';</script>";
}else{
	echo "<script language='javascript'>window.alert('Propósta cadastrada com sucesso!');window.location='../?pack=Eb5S&tipo=carteira_assinada';</script>";
 }
 
?>
</body>
</html>