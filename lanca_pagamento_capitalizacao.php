<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<? require "conexao.php"; ?>
</head>

<body>
<?
$conta_titulos = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM plano_capitalizao"));
$id_titulo = $_GET['id_titulo'];
if($id_titulo > $conta_titulos){
	echo "<script language='javascript'>window.location='aviso_tres_dias_emprestimo.php';</script>";
}else{
	
 $sql_confere_titulo = mysqli_query($conexao_bd, "SELECT * FROM plano_capitalizao WHERE id = '$id_titulo' AND forma_pagamento = 'VESTE PRIME CARD'");
 if(mysqli_num_rows($sql_confere_titulo) == ''){
	 $id_titulo++;
	echo "<script language='javascript'>window.location='?id_titulo=$id_titulo';</script>";
 }else{
	$code_titulo = 0;
	$cliente = 0;
	$valor = 0;
	$multa = 0;
	$juros = 0;
	$vl_receber = 0;
	while($res_dados_titulo = mysqli_fetch_array($sql_confere_titulo)){
		$code_titulo = $res_dados_titulo['code'];
		$cliente = $res_dados_titulo['cliente'];
	}
	
	$sql_verifica_cliente_ativo = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente WHERE cliente = '$cliente' AND status = 'ATIVO'");
	if(mysqli_num_rows($sql_verifica_cliente_ativo) == ''){
	 $id_titulo++;
	 echo "<script language='javascript'>window.location='?id_titulo=$id_titulo';</script>";
	}else{
	  
	  $sql_verifica_parcelas = mysqli_query($conexao_bd, "SELECT * FROM parcelas_capitalizacao WHERE code_capitalizacao = '$code_titulo' AND cliente = '$cliente' AND status = 'Aguarda'");
	  if(mysqli_num_rows($sql_verifica_parcelas) == ''){
		 $id_titulo++;
		 echo "<script language='javascript'>window.location='?id_titulo=$id_titulo';</script>";
	  }else{
		  
		  $id_parcela = 0;
		  $code_vencimento = 0;
		  $code_vencimento_hoje = 0;
		  while($res_parcela = mysqli_fetch_array($sql_verifica_parcelas)){
			  $id_parcela = $res_parcela['id'];
			  $code_vencimento = $res_parcela['code_vencimento'];
			  $valor = $res_parcela['valor'];
		  } // while res_parcela
		  
		$sqli_code_vencimento = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento WHERE vencimento = '$data'");
		while($res_vencimento = mysqli_fetch_array($sqli_code_vencimento)){
			$code_vencimento_hoje = $res_vencimento['codigo'];
		}
		
		if($code_vencimento_hoje > $code_vencimento){
			$multa = $valor*0.05;
			$juros = $valor*0.005*($code_vencimento_hoje-$code_vencimento);
			$vl_receber = $valor+$multa+$juros;
		}else{
			$vl_receber = $valor;
		}
		
		$code_transacao = rand();
		
		 mysqli_query($conexao_bd, "INSERT INTO lancamento_fatura (code_transacao, status, data, data_completa, dia, mes, ano, descricao, valor, parcelado, quant_parcela, valor_parcela, cliente, code_carrinho, comprovante, operador) VALUES ('$code_transacao', 'Ativo', '$data', '$data_completa', '$dia', '$mes', '$ano', 'CAPITALIZAÇÃO: $code_titulo', '$valor', '', '', '$vl_receber', '$cliente', '$code_titulo', '', '')");
					 
		 mysqli_query($conexao_bd, "INSERT INTO compras_parceladas (code_transacao, ip, status, data_compra, data_completa, estabelecimento, parcela, n_parcela, total_parcela, valor_parcela, sit_pag_fatura) VALUES ('$code_transacao', '$ip', 'Aguarda', '$data', '$data_completa', 'ONLINE', '1', '1', '$vl_receber', '$vl_receber', '$cliente')");		
		 
		 mysqli_query($conexao_bd, "UPDATE parcelas_capitalizacao SET status = 'Pago', multa = '$multa', juros = '$juros', vl_recebido = '$vl_receber', forma_pagt = 'VESTE PRIME CARD', dia_pagt = '$dia', mes_pagt = '$mes', ano_pagt = '$ano', data_pagt = '$data', data_completa_pagt = '$data_completa' WHERE id = '$id_parcela'");
		
		 mysqli_query($conexao_bd, "UPDATE plano_capitalizao SET status = 'Ativo' WHERE code = '$code_titulo'");

		 $id_titulo++;
		 echo "<script language='javascript'>window.location='?id_titulo=$id_titulo';</script>";
		  
	  } // sql_verifica_parcelas
	} //sql_verifica_cliente_ativo
	
 } // sql_confere_titulo
 
} // VERIFICA SE HOJE É DIA DE LANÇAR FATURAS
?>
</body>
</html>