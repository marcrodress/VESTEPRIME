<?

require "conexao.php";

$sqlBoletos = mysqli_query($conexao_bd, "SELECT * FROM pagamento_boletos");
		echo mysqli_num_rows($sqlBoletos);
	while($resBoletos = mysqli_fetch_array($sqlBoletos)){
		
	$codeHoje = $resBoletos['codeHoje'];
    $codeCaixa = $resBoletos['codeCaixa'];
    $turno = $resBoletos['turno'];
    $code_boleto = $resBoletos['code_boleto'];
    $data = $resBoletos['data'];
    $data_completa = $resBoletos['data_completa'];
    $dia = $resBoletos['dia'];
    $mes = $resBoletos['mes'];
    $ano = $resBoletos['ano'];
    $ip = $resBoletos['ip'];
    $operador = $resBoletos['operador'];
    $status = $resBoletos['status'];
    $cliente = $resBoletos['cliente'];
    $valor = $resBoletos['valor'];
    $desconto = $resBoletos['desconto'];
    $juros = $resBoletos['juros'];
    $code_barras = $resBoletos['code_barras'];
    $banco = $resBoletos['banco'];
    $vencimento = $resBoletos['vencimento'];
    $codeVencimento = $resBoletos['codeVencimento'];
    $confirma_boleto_vencido = $resBoletos['confirma_boleto_vencido'];
    $tarifa_recebimento = $resBoletos['tarifa_recebimento'];
    $boleto_vencido = $resBoletos['boleto_vencido'];
    $boleto_tarifado = $resBoletos['boleto_tarifado'];
    $boleto_impresso = $resBoletos['boleto_impresso'];
    $valor_recebido = $resBoletos['valor_recebido'];
    $autenticacao = $resBoletos['autenticacao'];
    $tipo = $resBoletos['tipo'];
    $forma_processamento = $resBoletos['forma_processamento'];
    $banco_processamento = $resBoletos['banco_processamento'];
    $tarifa_processamento = $resBoletos['tarifa_processamento'];
    $operador_efetivado = $resBoletos['operador_efetivado'];
    $data_efetivado = $resBoletos['data_efetivado'];
    $comissao = $resBoletos['comissao'];
    $data_pagamento = $resBoletos['data_pagamento'];
    $observacao = $resBoletos['observacao'];
    $telefone = $resBoletos['telefone'];
    $motivo_cancelamento = $resBoletos['motivo_cancelamento'];
    $operador_cancelamento = $resBoletos['operador_cancelamento'];
    $data_cancelamento = $resBoletos['data_cancelamento'];
    $juros_maquina = $resBoletos['juros_maquina'];
    $diferenca_cartao = $resBoletos['diferenca_cartao'];
    $comprovante = $resBoletos['comprovante'];
    $invisivel = $resBoletos['invisivel'];
    $conjunto = $resBoletos['conjunto'];
		
		
		$sqlInsert = mysqli_query($conexao_bd, "INSERT INTO pagamentoboletos 
        (codeHoje, codeCaixa, turno, code_boleto, data, data_completa, dia, mes, ano, ip, operador, status, cliente, valor, desconto, juros, code_barras, banco, vencimento, codeVencimento, confirma_boleto_vencido, tarifa_recebimento, boleto_vencido, boleto_tarifado, boleto_impresso, valor_recebido, autenticacao, tipo, forma_processamento, banco_processamento, tarifa_processamento, operador_efetivado, data_efetivado, comissao, data_pagamento, observacao, telefone, motivo_cancelamento, operador_cancelamento, data_cancelamento, juros_maquina, diferenca_cartao, comprovante, invisivel, conjunto)
        VALUES 
        ('$codeHoje', '$codeCaixa', '$turno', '$code_boleto', '$data', '$data_completa', '$dia', '$mes', '$ano', '$ip', '$operador', '$status', '$cliente', '$valor', '$desconto', '$juros', '$code_barras', '$banco', '$vencimento', '$codeVencimento', '$confirma_boleto_vencido', '$tarifa_recebimento', '$boleto_vencido', '$boleto_tarifado', '$boleto_impresso', '$valor_recebido', '$autenticacao', '$tipo', '$forma_processamento', '$banco_processamento', '$tarifa_processamento', '$operador_efetivado', '$data_efetivado', '$comissao', '$data_pagamento', '$observacao', '$telefone', '$motivo_cancelamento', '$operador_cancelamento', '$data_cancelamento', '$juros_maquina', '$diferenca_cartao', '$comprovante', '$invisivel', '$conjunto')");
			
		
		
	}

	
	
	$sqlBoletos = mysqli_query($conexao_bd, "SELECT * FROM pagamentoboletos");
		while($resBoletos = mysqli_fetch_array($sqlBoletos)){
				
				$codeVencimento = 0;	
				$sqlCodeVencimento = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento WHERE vencimento = '".$resBoletos['vencimento']."'");
					while($resCodeVencimento = mysqli_fetch_array($sqlCodeVencimento)){
						$codeVencimento = $resCodeVencimento['codigo'];
					}
					
				$code_vencimento_hoje = 0;
				$sql_code_vencimento = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento WHERE vencimento = '".$resBoletos['data']."'");
				while($res_code_vencimento = mysqli_fetch_array($sql_code_vencimento)){
					$code_vencimento_hoje = $res_code_vencimento['codigo'];
				}		

			
			
			mysqli_query($conexao_bd, "UPDATE pagamentoboletos SET codeVencimento = '$codeVencimento' WHERE id = '".$resBoletos['id']."'");
			mysqli_query($conexao_bd, "UPDATE pagamentoboletos SET codeHoje = '$code_vencimento_hoje' WHERE id = '".$resBoletos['id']."'");
			
		}
	
	
	

?>