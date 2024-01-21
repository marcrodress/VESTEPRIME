<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<? require "config.php"; ?>
</head>

<body>
<?

$limite_utilizacoes = 0;
$total_utilizacoes = 0;
$percentual = 0;
$valor_desconto = 0;
$usuario = 0;
$vencimento = 0;
$minimo_carrinho = 0;
$id_cupom = 0;

$desconto = 0;
$data_vencimento = 0;


$sql_cupom = mysqli_query($conexao_bd, "SELECT * FROM cupom_descontos WHERE cupom = '$valor_pag' AND status = 'Ativo'");
if(mysqli_num_rows($sql_cupom) == ''){
	echo "<script language='javascript'>window.alert('CUPOM DE DESCONTO NÃO ENCONTRADO OU O MESMO FOI CANCELADO!');</script>";
}else{
	while($res_cupom = mysqli_fetch_array($sql_cupom)){
		
		$limite_utilizacoes = $res_cupom['limite_utilizacoes'];
		$total_utilizacoes = $res_cupom['total_utilizacoes'];
		$percentual = ($res_cupom['percentual']/100);
		$valor_desconto = $res_cupom['valor_desconto'];
		$usuario = $res_cupom['usuario'];
		$vencimento = $res_cupom['vencimento'];
		$minimo_carrinho = $res_cupom['minimo_carrinho'];
		$id_cupom = $res_cupom['id'];
		
		$sql_data_vencimento = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento WHERE vencimento = '$data'");
			while($res_data_vencimento = mysqli_fetch_array($sql_data_vencimento)){
				
				$data_vencimento = $res_data_vencimento['codigo'];
				
			}
		
		
		
		
		
		if($limite_utilizacoes == $total_utilizacoes){
		 echo "<script language='javascript'>window.alert('O NÚMERO DE UTILIZAÇÕES DESTE CUPOM FOI ATINGIDO!');</script>";
		 	mysqli_query($conexao_bd, "UPDATE cupom_descontos SET status = 'EXPIRADO' WHERE id = '$id_cupom'");
		
		
		/*}elseif($usuario != '' && $usuario != $cliente){
		 echo "<script language='javascript'>window.alert('ESTE CUPOM NÃO ESTÁ HABILIDADE PARA ESTE CLIENTE!');</script>";
		*/
		
		}elseif($minimo_carrinho > $valor_compras){
		 echo "<script language='javascript'>window.alert('ESTE CUPOM NÃO PODE SER REGATADO, POIS A COMPRA MÍNIMA É DE $minimo_carrinho!');</script>";
		}elseif($data_vencimento > $vencimento){
		 echo "<script language='javascript'>window.alert('O período de utilização deste cupom foi expirado!');</script>";
	 	 mysqli_query($conexao_bd, "UPDATE cupom_descontos SET status = 'EXPIRADO' WHERE id = '$id_cupom'");
		}else{
			
			if($percentual == ''){
				$desconto = $valor_desconto;
			}else{
				$desconto = $percentual*$valor_compras;
			}
			
			mysqli_query($conexao_bd, "INSERT INTO pagamento_carrinho (status, ip, dia, mes, ano, data, data_completa, code_carrinho, form_pag, parcelas, cartao, valor_total, valor_fornecido, valor_parcela, quant_parcelas, cliente, status_cheque, troco, operador, descontos) VALUES ('Ativo', '$ip', '$dia', '$mes', '$ano', '$data', '$data_completa', '$code_carrinho', 'CUPOM', '', '', '$desconto', '', '', '', '$cliente', '', '', '$operador', '')");
			
			$total_utilizacoes++;
			/*
			
			mysqli_query($conexao_bd, "UPDATE cupom_descontos SET total_utilizacoes = '$total_utilizacoes', status = 'UTILIZADO' WHERE id = '$id_cupom'");
			*/

			mysqli_query($conexao_bd, "UPDATE cupom_descontos SET total_utilizacoes = '$total_utilizacoes' WHERE id = '$id_cupom'");

			
            echo "<script language='javascript'>window.alert('Cupom resgatado com sucesso!');window.location='';</script>";

						
		}
		
	}
}
?>
</body>
</html>