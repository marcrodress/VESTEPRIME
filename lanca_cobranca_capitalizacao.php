<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<? require "conexao.php"; ?>
</head>

<body>
<?

if($dia > 28){
	echo "<script language='javascript'>window.location='lanca_pagamento_capitalizacao.php';</script>";
}else{


$conta_titulos = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM plano_capitalizao"));
$id_titulo = $_GET['id_titulo'];
if($id_titulo > $conta_titulos){
	echo "<script language='javascript'>window.location='lanca_pagamento_capitalizacao.php';</script>";
}else{
 
 if($id_titulo == 0){
	 $id_titulo = 1;
 }else{
	 $id_titulo = $id_titulo;
 }
	 
	 $code_titulo = 0;
	 $cliente = 0;
	 $plano = 0;
	 $forma_pagamento = 0;
	 $total_fatura = 0;
	 $fatura_para_lancar = 0;
	 $n_parcela = 0;
	 $valor = 0;
	 $diavencimento = 0;
	 
	 $sql_titulo = mysqli_query($conexao_bd, "SELECT * FROM plano_capitalizao WHERE id = '$id_titulo' AND status = 'Ativo'"); 
	  while($res_titulo = mysqli_fetch_array($sql_titulo)){
		  $code_titulo = $res_titulo['code'];
		  $cliente = $res_titulo['cliente'];
		  $plano = $res_titulo['plano'];
		  $valor = $res_titulo['valor'];
		  $diavencimento = $res_titulo['vencimento'];
		  $forma_pagamento = $res_titulo['forma_pagamento'];
	  }
	  
	 $sql_parcelas = mysqli_query($conexao_bd, "SELECT * FROM parcelas_capitalizacao WHERE code_capitalizacao = '$code_titulo'");
	 $n_parcela = mysqli_num_rows($sql_parcelas)+1;
	 
	 if($plano == 'VAREJO'){
		 $fatura_para_lancar = 12;
	 }elseif($plano == 'GOLD'){
		 $fatura_para_lancar = 24;
	 }elseif($plano == 'PLATINUM'){
		 $fatura_para_lancar = 36;
	 }elseif($plano == 'BLACK'){
		 $fatura_para_lancar = 48;
	 }elseif($plano == 'MASTERBLACK'){
		 $fatura_para_lancar = 60;
	 }
	 
	 
	 if(mysqli_num_rows($sql_parcelas) >= $fatura_para_lancar){
		 $id_titulo++;
		 echo "<script language='javascript'>window.location='?id_titulo=$id_titulo';</script>";
	 }else{
		 
		$mes_vencimento = $mes+1;
		if($mes_vencimento > 12){
			$mes_vencimento = "1";
			$ano = $ano+1;
		}elseif($mes_vencimento > 24){
			$mes_vencimento = "1";
			$ano = $ano+2;
		}else{
			$mes_vencimento = $mes_vencimento;
			$ano = $ano;
		}
		if($mes_vencimento <10){ $mes_vencimento = "0$mes_vencimento"; }		 
		

		 $sql_verifica_lancamento = mysqli_query($conexao_bd, "SELECT * FROM parcelas_capitalizacao WHERE mes = '$mes_vencimento' AND ano = '$ano' AND code_capitalizacao = '$code_titulo'");
		 if(mysqli_num_rows($sql_verifica_lancamento) == ''){

			
			$code_vencimento = 0;
			
			$sqli_code_vencimento = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento WHERE vencimento = '$diavencimento/$mes_vencimento/$ano'");
			while($res_vencimento = mysqli_fetch_array($sqli_code_vencimento)){
				$code_vencimento = $res_vencimento['codigo'];
			}
			
			$status_pag = 0;
			$data_forma_pagamento = 0;
			$forma_pag = 0;
			
			if($forma_pagamento == 'VESTE PRIME CARD'){
				
			 $sql_verifica_cliente = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente WHERE cliente = '$cliente' AND status = 'ATIVO'");
				 if(mysqli_num_rows($sql_verifica_cliente) >= 1){
					 $code_transacao = rand();
					 mysqli_query($conexao_bd, "INSERT INTO lancamento_fatura (code_transacao, status, data, data_completa, dia, mes, ano, descricao, valor, parcelado, quant_parcela, valor_parcela, cliente, code_carrinho, comprovante, operador) VALUES ('$code_transacao', 'Ativo', '$data', '$data_completa', '$dia', '$mes', '$ano', 'CAPITALIZAÇÃO: $code_titulo', '$valor', '', '', '$valor', '$cliente', '$code_transacao', 'NULL', 'NULL')");
					 
					 mysqli_query($conexao_bd, "INSERT INTO compras_parceladas (code_transacao, ip, status, data_compra, data_completa, estabelecimento, parcela, n_parcela, total_parcela, valor_parcela, sit_pag_fatura) VALUES ('$code_transacao', '$ip', 'Aguarda', '$data', '$data_completa', 'ONLINE', '1', '1', '$valor', '$valor', '$cliente')");
				 
				 $status_pag = "Pago";
				 $data_forma_pagamento = "$data";
				 $forma_pag = "VESTE PRIME CARD";
				 
				 
				 }else{
				 $status_pag = 'Aguarda';
				 }
				
			}else{
			 $status_pag = 'Aguarda';
			 $data_forma_pagamento = NULL;
			 $forma_pag = NULL;
			}
			
			mysqli_query($conexao_bd, "INSERT INTO parcelas_capitalizacao (code_capitalizacao, n_parcela, cliente, status, vencimento, code_vencimento, valor, operador_pgto, multa, juros, vl_recebido, forma_pagt, dia_pagt, mes_pagt, ano_pagt, data_pagt, data_completa_pagt, mes, ano, code_barras) VALUES ('$code_titulo', '$n_parcela', '$cliente', '$status_pag', '$diavencimento/$mes_vencimento/$ano', '$code_vencimento', '$valor', '', '', '', '', '$forma_pag', '', '', '', '$data_forma_pagamento', '', '$mes_vencimento', '$ano', '')");
		 $id_titulo++;;
		 echo "<script language='javascript'>window.location='?id_titulo=$id_titulo';</script>";
		 }else{
			 
		 $id_titulo++;
		 echo "<script language='javascript'>window.location='?id_titulo=$id_titulo';</script>";
		 }
		 
		 
	 } // verifica se existe mes para lançar
	 $id_titulo++;
	
} // verifica o contador de titulos



} // VERIFICA SE HOJE É DIA DE LANÇAR FATURAS
?>
</body>
</html>