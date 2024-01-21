<? 

	
	
	function limpaBoleto($codigoBarras){
		
		$codigoBarras = $codigoBarras;
		
		$codigoBarras = str_replace('R$','',$codigoBarras);
		$codigoBarras = str_replace(' ','',$codigoBarras);
		$codigoBarras = str_replace('-','',$codigoBarras);
		$codigoBarras = str_replace('.','',$codigoBarras);
		$codigoBarras = str_replace(',','',$codigoBarras);
		
		return $codigoBarras;
		
				
	} // limpa o boleto
	
	function limpaValorBoleto($valor){
				
		$valor = str_replace('R$','',$valor);
		$valor = str_replace('%','',$valor);
		$valor = str_replace(' ','',$valor);
		$valor = str_replace('-','',$valor);
		$valor = str_replace('.','',$valor);
		$valor = str_replace(',','.',$valor);
		
		$valor = preg_replace("/[^0-9,.]/", "", $valor);
		$valor = str_replace(',', '.', $valor);
				
		$valorFloat = floatval($valor);
		
		return $valorFloat;		
	}
	
	function restaraConfiguracaoBoleto($codigo_barras){
		
		
		$codigo1 = $codigo_barras[0];
		$codigo2 = $codigo_barras[1];
		$codigo3 = $codigo_barras[2];
		$codigo4 = $codigo_barras[3];
		$codigo5 = $codigo_barras[4];
		$codigo6 = $codigo_barras[5];
		$codigo7 = $codigo_barras[6];
		$codigo8 = $codigo_barras[7];
		$codigo9 = $codigo_barras[8];
		$codigo10 = $codigo_barras[9];
		$codigo11 = $codigo_barras[10];
		$codigo12 = $codigo_barras[11];
		$codigo13 = $codigo_barras[12];
		$codigo14 = $codigo_barras[13];
		$codigo15 = $codigo_barras[14];
		$codigo16 = $codigo_barras[15];
		$codigo17 = $codigo_barras[16];
		$codigo18 = $codigo_barras[17];
		$codigo19 = $codigo_barras[18];
		$codigo20 = $codigo_barras[19];
		$codigo21 = $codigo_barras[20];
		$codigo22 = $codigo_barras[21];
		$codigo23 = $codigo_barras[22];
		$codigo24 = $codigo_barras[23];
		$codigo25 = $codigo_barras[24];
		$codigo26 = $codigo_barras[25];
		$codigo27 = $codigo_barras[26];
		$codigo28 = $codigo_barras[27];
		$codigo29 = $codigo_barras[28];
		$codigo30 = $codigo_barras[29];
		$codigo31 = $codigo_barras[30];
		$codigo32 = $codigo_barras[31];
		$codigo33 = $codigo_barras[32];
		$codigo34 = $codigo_barras[33];
		$codigo35 = $codigo_barras[34];
		$codigo36 = $codigo_barras[35];
		$codigo37 = $codigo_barras[36];
		$codigo38 = $codigo_barras[37];
		$codigo39 = $codigo_barras[38];
		$codigo40 = $codigo_barras[39];
		$codigo41 = $codigo_barras[40];
		$codigo42 = $codigo_barras[41];
		$codigo43 = $codigo_barras[42];
		$codigo44 = $codigo_barras[43];
		$codigo45 = $codigo_barras[44];
		$codigo46 = $codigo_barras[45];
		$codigo47 = $codigo_barras[46];
		
		return ("$codigo1$codigo2$codigo3$codigo4$codigo5.$codigo6$codigo7$codigo8$codigo9$codigo10 $codigo11$codigo12$codigo13$codigo14$codigo15.$codigo16$codigo17$codigo18$codigo19$codigo20$codigo21 $codigo22$codigo23$codigo24$codigo25$codigo26.$codigo27$codigo28$codigo29$codigo30$codigo31$codigo32 $codigo33 $codigo34$codigo35$codigo36$codigo37$codigo38$codigo39$codigo40$codigo41$codigo42$codigo43$codigo44$codigo45$codigo46$codigo47");
	
	}
	

	function analisaBoleto($codigoBarras){
		
		$codigoBarras = limpaBoleto($codigoBarras);
		
		
		$banco1 = $codigoBarras[0];
		$banco2 = $codigoBarras[1];
		$banco3 = $codigoBarras[2];
		
		$codigo40 = $codigoBarras[39];
		$codigo41 = $codigoBarras[40];
		$codigo42 = $codigoBarras[41];
		$codigo43 = $codigoBarras[42];
		$codigo44 = $codigoBarras[43];
		$codigo45 = $codigoBarras[44];
		$codigo46 = $codigoBarras[45];
		$codigo47 = $codigoBarras[46];
		
		$codigo35 = $codigoBarras[33];
		$codigo36 = $codigoBarras[34];
		$codigo37 = $codigoBarras[35];
		$codigo38 = $codigoBarras[36];
		
		$banco = "$banco1$banco2$banco3";
		$valor = floatval("$codigo40$codigo41$codigo42$codigo43$codigo44$codigo45.$codigo46$codigo47")+0;
		$code_vencimento = "$codigo35$codigo36$codigo37$codigo38";
		
				
		
		$dadosBoleto = array(
			'codigolimpo' => limpaBoleto($codigoBarras),
			'banco' => $banco,
			'vencimento' => $code_vencimento,
			'valor' => $valor
		);
		
		return $dadosBoleto;

	} // Retorna as principais informações do boleto
	
	function retornaValorVoleto($codigoBarras){
		$codigoBarras = analisaBoleto($codigoBarras);
		
		if($codigoBarras['valor'] >0){
			return $codigoBarras['valor'];
		}else{
			return limpaValorBoleto($_GET['valorBoleto']);
		}
				
	} // retorna o valor do código de barras
	
	function retornaVecimentoBoleto($codigoBarras){
		$vencimento = analisaBoleto($codigoBarras);
		
		if($vencimento['vencimento'] !=0){
			return $vencimento['vencimento'];
		}else{
			return codeVencimento($_GET['codeVencimento']);
		}
		
		
	} // vencimento do boleto

	function tarifaBoletoVencido($valorTotal){
		
		$tarifa = 0;
		
		if($valorTotal <50){
		$tarifa = 0.5;		
		}else if($valorTotal >= 50 && $valorTotal < 100){
			$tarifa = 1;
		}else if($valorTotal >= 100 && $valorTotal < 300){
			$tarifa = 3;
		}else if($valorTotal >= 300 && $valorTotal < 600){
			$tarifa = 4;
		}else if($valorTotal >= 600 && $valorTotal < 1000){
			$tarifa = 5;
		}else if($valorTotal >= 1000 && $valorTotal < 2000){
			$tarifa = 6;
		}else if($valorTotal >= 2000){
			$tarifa = 9.99;
		}
		
		return $tarifa;		
	} // tarifa boleto vencido
	
	function codeVencimento($dataVencimento){
		
		require "../conexao.php";
		
		
		$codeVencimento = 0;
		
		$sqlCodeVencimento = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento WHERE vencimento = '$dataVencimento'");
			while($resCodeVencimento = mysqli_fetch_array($sqlCodeVencimento)){
				$codeVencimento = $resCodeVencimento['codigo'];
		}	
		
		return $codeVencimento;
	} // retorna o codigo de vencimento do boleto
	
	
	function dataVencimento($codeVencimento){
		
		
		require "../conexao.php";
	
		$dataVencimento = 0;
		
		$sqlDataVencimento = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento WHERE codigo = '$codeVencimento'");
			while($resCodeVencimento = mysqli_fetch_array($sqlDataVencimento)){
				$dataVencimento = $resCodeVencimento['vencimento'];
		}	
		
		return $dataVencimento;		
	} // retorna a data de vencimento no formato 00/00/0000
	
	function taxaRecebimento($valorTotal){
		
		$tarifa = 0;
		
		if($valorTotal <2000){
			$tarifa = 0;		
		}elseif($valorTotal >= 2000 && $valorTotal < 2500){
			$tarifa = 11.99;
		}elseif($valorTotal >= 2500 && $valorTotal < 3000){
			$tarifa = 12.99;
		}elseif($valorTotal >= 3000 && $valorTotal < 4000){
			$tarifa = 14.99;
		}elseif($valorTotal >= 4000){
			$tarifa = 19.99;
		}
		
		return $tarifa;
		
	} // taxa de recebimento
	
	function verificaBoletoVencido($codeVencimento){
		
			
		if((codeVencimento(date("d/m/Y"))) > $codeVencimento){
			return 1;
		}else{
			return 2;
		}
		
		
	} // verifica se o boleto estar vencido
	
	function retornaValorBoletoFormatado($valorBoleto){
		return preg_replace('/[^0-9,.]/', '', $valorBoleto);
	}
	 // formata o valor digitado do boleto
	 
	 
	 
	function dataPagamentoContas(){
		
		$dataProximoDiaPagamento = 0;
		
		$sqlDataPagamento = mysqli_query($conexao_bd, "SELECT * FROM datas_pagamento_contas WHERE dia = '$data'");
		 if(mysqli_num_rows($sqlDataPagamento) >=1){
			  
			  while($resDataPagamento = mysqli_fetch_array($sqlDataPagamento)){
				  $dataProximoDiaPagamento = $resDataPagamento['proximo_dia']; 
			 }
			 
		}else{
				  $dataProximoDiaPagamento = $data;		
		}
	
	} // retorna a data de pagamento
	
	
	function verificaRegistracaoBanco($banco){
		
		
		
		$sql_verifica_banco = mysqli_query($conexao_bd, "SELECT * FROM lista_bancos WHERE codigo = '$banco'");
		
		while($res_verifica_restrincao = mysqli_fetch_array($sql_verifica_banco)){
				if($res_verifica_restrincao['restrincao'] == 'SIM' && verificaBoletoVencido($dataVencimento) == true){
						return true;
				}else{
						return false;
				}
			
			}
		
		
		
	}
	
	
	
	



?>

