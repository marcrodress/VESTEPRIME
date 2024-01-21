<?

require "../config.php";

function retornaCarrinho($cpf_cliente){

$sql_carrinho = mysqli_query($conexao_bd, "SELECT * FROM carrinho WHERE ip = '$ip' AND status = 'Ativo'");
	if(mysqli_num_rows($sql_carrinho) == ''){
		
		$code_carrinho = rand();
		mysqli_query($conexao_bd, "INSERT INTO carrinho (codeCaixa, ip, code_carrinho, hora_abertura, data, status, cliente, operador, code_dia, loja) VALUES ('$codeCaixa', '$ip', '$code_carrinho', '$data_completa', '$data', 'Ativo', '$cpf_cliente', '$operador', '$code_dia', '$loja')");
	 
	 return $code_carrinho;
	
	}else{
	 
	 	mysqli_query($conexao_bd, "UPDATE carrinho SET cliente = '$cpf_cliente' WHERE ip = '$ip' AND status = 'Ativo'");
	 
	 return $code_carrinho;
   }


}

?>