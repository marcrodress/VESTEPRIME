<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<? require "../../conexao.php"; ?>
</head>

<body>
<?
$n_proposta = $_POST['n_proposta'];
$cpf = $_POST['cpf'];
$ip = $_SERVER['REMOTE_ADDR'];
$date = date("d/m/Y H:i:s");

$sql_5 = mysql_query("INSERT INTO envio_de_propostas (ip, date, status, tipo_de_proposta, n_proposta, cpf, empresa_de_envio) VALUES ('$ip', '$date', 'Em análise', 'Cartão', '$n_proposta', '$cpf', 'Invest Acessória')");

if($sql_5 == ''){
	echo "<script language='javascript'>window.alert('Ocorreu um erro!');window.location='../?pack=CC1';</script>";
}else{
	echo "<script language='javascript'>window.alert('Propósta cadastrada com sucesso!');window.location='../?pack=CC1';</script>";
}
?>
</body>
</html>