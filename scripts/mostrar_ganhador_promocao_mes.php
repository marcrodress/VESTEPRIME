<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
body {
	background-color: #FFF;
	font:12px Arial, Helvetica, sans-serif;
}
</style>
<? require "../config.php"; ?>
</head>

<body>
<?

$sql = mysqli_query($conexao_bd, "SELECT * FROM promocao_cupom_gerador WHERE codigo_promocao = '".$_GET['codigo_promocao']."' AND codigo_cupom = '".$_GET['codigo_cupom']."'");
while($res_sql = mysqli_fetch_array($sql)){
	echo "<strong>Nome:</strong> "; echo "<br>";
	echo $res_sql['nome']; echo "<br>";
	echo "<strong>Telefone:</strong> "; echo "<br>";
	echo $res_sql['telefone']; echo "<br>";
	echo "<strong>CPF:</strong> "; echo "<br>";
	echo $res_sql['cpf']; echo "<br>";
}


?>
</body>
</html>