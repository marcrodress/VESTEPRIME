<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<? require "../conexao.php"; ?>
</head>

<body>
<?
$conta_faturas = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM faturas_fechadas"));

$sql_faturas = mysqli_query($conexao_bd, "SELECT * FROM faturas_fechadas WHERE id = '$id_fatura'");




?>
</body>
</html>