<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../css/analises_proposta_de_cartao_bradescard.css" rel="stylesheet" type="text/css" />
<link href="../img/logo.png" rel="shortcut icon" />
</head>

<body>

<?

require "../../conexao.php";

$n_proposta = $_POST['n_proposta'];
$id = $_POST['id'];
$status = $_POST['status'];
$obs = $_POST['obs'];

mysql_query("UPDATE envio_de_propostas SET status = '$status', obs = '$obs' WHERE n_proposta = '$n_proposta' AND id = '$id'");

echo "<script language='javascript'>window.alert('Proposta cadastrada com sucesso!');window.location='../?pack=CC2';</script>";

?>

</body>
</html>