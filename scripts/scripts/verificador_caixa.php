<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>

<body>
<?

include "../config.php";

$verifica_caixa = mysqli_query($conexao_bd, "SELECT * FROM abertura_de_caixa WHERE operador = '$operador' AND data = '$data' AND status = 'Aberto'");
if(mysqli_num_rows($verifica_caixa) == ''){
	echo "<script language='javascript'>window.location='abrir_caixa.php';</script>";
}


?>
</body>
</html>