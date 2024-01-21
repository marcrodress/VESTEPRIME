<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<? require "conexao.php"; ?>
</head>

<body>
<?

$code_vencimento = 0;

$sql_code_vencimento = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento WHERE vencimento = '$data'");
	while($res_code_vencimento = mysqli_fetch_array($sql_code_vencimento)){
		$code_vencimento = $res_code_vencimento['codigo'];
	}

?>
</body>
</html>