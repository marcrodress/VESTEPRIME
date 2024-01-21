<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/mostrar_cliente.css" rel="stylesheet" />
<? require "../../conexao.php"; ?>
</head>

<body>
<? 

$sql_cliente = mysqli_query($conexao_db, "SELECT * FROM clientes WHERE cpf = '".$_GET['cliente']."'");
	while($res_cliente = mysqli_fetch_array($sql_cliente)){
		
		echo $res_cliente['nome'];
		
	}

?>
</body>
</html>