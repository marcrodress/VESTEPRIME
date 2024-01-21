<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>RELAÇÃO DE CLIENTES</title>
</head>

<body>
<? 
require "../conexao.php"; 

$conta_clientes = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM conta_corrente"));

$id_clientes = 1;
$cliente = 0;

if($id_clientes >= $conta_clientes){
	
}else{
	
	$busca_cliente = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente WHERE id = '$id_clientes'");
		while($res_cliente = mysqli_fetch_array($busca_cliente)){

			$cliente = $res_cliente['cliente'];

	$sql_fatura = mysql_query($conexao_bd, "SELECT * FROM faturas_fechadas WHERE sit_pag = 'VENCIDA' AND ");
	
	
	
	
	} // PEGA INFORMAÇÕES DO CLIENTE
	
} // VERIFICADOR DE CLIENTES



?>
</body>
</html>