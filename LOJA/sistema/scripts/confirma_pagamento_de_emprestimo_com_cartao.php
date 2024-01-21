<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<? require "../../conexao.php"; ?>
</head>

<body>
<?
$n_proposta = $_POST['n_proposta'];
$comprovante = $_FILES['comprovante']['name'];

$date = date("d/m/Y H:i:s");

if(file_exists("../comprovantes/$comprovante")){ $a = 1;while(file_exists("../clientes_docs/[$a]$comprovante")){$a++;}$comprovante = "[".$a."]".$comprovante;}

$sql_1 = mysql_query("UPDATE emprestimo_cartao_credito SET data_de_pagamento = '$date', comprovante = 'http://www.easyloan.com.br/sky_sound_dt/sistema/comprovantes/$comprovante' WHERE n_proposta = '$n_proposta'");

	(move_uploaded_file($_FILES['comprovante']['tmp_name'], "../comprovantes/".$comprovante));

echo "<script language='javascript'>window.alert('Atualização feito com sucesso!');window.location='../?pack=Eb5S&tipo=confirmacao_de_credito';</script>";

?>
</body>
</html>