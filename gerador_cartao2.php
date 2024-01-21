<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
</head>

<body>
<?

require "conexao.php";

$sql_puxa_cliente  = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente");

if(mysqli_num_rows($sql_puxa_cliente) == ''){
	echo "NÃO GEROU";
}else{
	while($res_cliente = mysqli_fetch_array($sql_puxa_cliente)){			

	 $cpf_cliente = $res_cliente['cliente'];
	 $cartao = $res_cliente['cartao'];
	 
	 if($cartao == 'cartao'){
		 mysqli_query($conexao_bd, "UPDATE conta_corrente SET cartao = '' WHERE cliente = '$cpf_cliente'");
	 }
	 	
		if($cartao == ''){
		
		 $gera_bloco1 = rand(1000,9999);
		 $gera_bloco2 = rand(1001,9999);
		 $gera_bloco3 = rand(1041,9999);
		 $gera_bloco4 = rand(1141,9999);
		 		 
		echo $numero_cartao = "$gera_bloco1$gera_bloco2$gera_bloco3$gera_bloco4";
	 echo "<br>";
		mysqli_query($conexao_bd, "UPDATE conta_corrente SET cartao = '$numero_cartao' WHERE cliente = '$cpf_cliente'");
		}


	}
	}
?>
</body>
</html>