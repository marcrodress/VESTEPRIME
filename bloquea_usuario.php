<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<? require "conexao.php"; ?>
</head>

<body>

<? 

	$p = strtoupper($_GET['p']);
	$id = $_GET['id'];
	
	$acao = mysqli_query($conexao_bd, "UPDATE conta_corrente SET status = '$p' WHERE id = '$id'");
	
	if($acao == ''){
		echo "<script language='javascript'>window.alert('FALHA AO PROCESSAR!');window.location='todos_os_clientes.php';</script>";	
	}else{
		echo "<script language='javascript'>window.location='todos_os_clientes.php';</script>";	
	}
?>
</body>
</html>