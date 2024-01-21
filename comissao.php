<?

require "conexao.php";
/*
$venda_produto = 0;
$id_comissao = 0;
$sql_busca_lista = mysql_query("SELECT * FROM comissao WHERE operador = '60425428346'");
	while($res_busca = mysql_fetch_array($sql_busca_lista)){
		
		$venda_produto = $res_busca['descricao'];
		$id_comissao = $res_busca['id'];
		
		
		$sql_deleta_comissao = mysql_query("DELETE FROM comissao WHERE descricao = '$venda_produto' AND id != '$id_comissao'");
		

}

*/


/*
mysql_query("UPDATE produtos_caixa SET operador = '60425428346' WHERE data = '20/12/2018'");
mysql_query("UPDATE produtos_caixa SET operador = '60425428346' WHERE data = '21/12/2018'");
mysql_query("UPDATE produtos_caixa SET operador = '60425428346' WHERE data = '22/12/2018'");
*/



/*

$sql_busca_code = mysql_query("SELECT * FROM produtos_caixa WHERE operador = '60425428346'");
	while($res_busca_code = mysql_fetch_array($sql_busca_code)){
		
		$code_produto = $res_busca_code['code_produto'];
		$code_carrinho = $res_busca_code['code_carrinho'];
		$quant = $res_busca_code['quant'];
		
		$sql_busca_comissao = mysql_query("SELECT * FROM produtos WHERE code = '$code_produto'");
		while($res_comissao = mysql_fetch_array($sql_busca_comissao)){
			$comissao = $res_comissao['comissao']*$quant;
			
		mysql_query("INSERT INTO comissao (data, data_completa, dia, mes, ano, status, operador, descricao, valor, ip, cliente, produto, carrinho, quantidade, tipo) VALUES ('$data', '$data_completa', '$dia', '$mes', '$ano', 'Aguarda', '60425428346', 'VENDA DE PRODUTO: $code_produto', '$comissao', '$ip', '$cliente', '$code_produto', '$code_carrinho', '$quant', 'PRODUTO')");
			
			
		}
	}
*/

?>