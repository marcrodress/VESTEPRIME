<?
$sql_produto = mysql_query("SELECT * FROM produtos WHERE code = '$key' AND status = 'Ativo'");
if(mysql_num_rows($sql_produto) == ''){
	echo "<script language='javascript'>window.alert('PRODUTO NÃO ENCONTRADO!');</script>";
}else{
	$puxa_carrinho = mysql_query("SELECT * FROM carrinho WHERE ip = '$ip' AND status = 'Ativo'");
	if(mysql_num_rows($puxa_carrinho) == ''){
		$code_carrinho = rand();
		mysql_query("INSERT INTO carrinho (ip, code_carrinho, hora_abertura, data, status, operador) VALUES ('$ip', '$code_carrinho', '$data_completa', '$data', 'Ativo', '$operador')");
		while($res_produto = mysql_fetch_array($sql_produto)){
			$tipo = $res_produto['tipo'];
			$valor = $res_produto['valor'];
		mysql_query("INSERT INTO produtos_caixa (ip, code_carrinho, data, status, operador, tipo, quant, valor, code_produto) VALUES ('$ip', '$code_carrinho', '$data', 'Ativo', '$operador', '$tipo', '1', '$valor', '$key')");
		}// fecha o while
	}else{
		
		while($res_carrinho = mysql_fetch_array($puxa_carrinho)){
			
			$code_carrinho = $res_carrinho['code_carrinho'];
			$cliente = $res_carrinho['cliente'];
			
			$sql_verifica_produto = mysql_query("SELECT * FROM produtos_caixa WHERE code_produto = '$key' AND ip = '$ip' AND status = 'Ativo' AND code_carrinho = '$code_carrinho'");
			if(mysql_num_rows($sql_verifica_produto) == ''){
				while($res_produto = mysql_fetch_array($sql_produto)){
					$tipo = $res_produto['tipo'];
					$valor = $res_produto['valor'];
				mysql_query("INSERT INTO produtos_caixa (ip, code_carrinho, data, status, cliente, operador, tipo, quant, valor, code_produto) VALUES ('$ip', '$code_carrinho', '$data', 'Ativo', '$cliente', '$operador', '$tipo', '1', '$valor', '$key')");
				}
			}else{
				while($res_produto = mysql_fetch_array($sql_verifica_produto)){
					
					$quant = $res_produto['quant'];
					$valor = $res_produto['valor'];
					
				}
			}	
		
		}
  		
  }
 }
 
 ?>