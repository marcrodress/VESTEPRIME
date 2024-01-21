<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/mostrar_comissao.css" rel="stylesheet" type="text/css" />
</head>

<body>
<? require "topo.php";  require "scripts/verificador_caixa.php"; ?>

<div id="box_pagamento_1">
<h1><strong>Folha de pagamento - Mensal</strong></h1>
<hr />
<table width="1000" border="0">
<tr></tr>
<tr></tr>
<tr>
  <td width="225" bgcolor="#0099CC"><strong>DESCRIÇÃO DA COMISSÃO</strong></td>
  <td width="174" bgcolor="#0099CC"><strong>PROCESSAMENTO</strong></td>
  <td width="158" bgcolor="#0099CC"><strong>COMISSÃO</strong></td>
  <td width="147" bgcolor="#0099CC"><strong>META MENSAL</strong></td>
  <td width="114" bgcolor="#0099CC"><strong>REALIZADA</strong></td>
  <td width="156" bgcolor="#0099CC"><strong>VALOR GANHO</strong></td>
</tr>
<tr>
  <td><strong>PAGAMENTO DE CONTAS</strong></td>
  <td><strong>BB</strong></td>
  <td><strong>0,03 a 0,20</strong></td>
  <td><strong>2000</strong></td>
  <td><? 
	$comissao_tarifas_boletos = 0;
	$faturamento_boletos = 0;
	$conta_boletos = mysqli_query($conexao_bd, "SELECT * FROM pagamento_boletos WHERE mes = '$mes' AND ano = '$ano' AND status != 'CANCELADO' AND operador = '$operador'");
	while($res_boletos = mysqli_fetch_array($conta_boletos)){
		$comissao_tarifas_boletos = (($res_boletos['tarifa_recebimento']*0.05)+($res_boletos['boleto_vencido']*0.05)+($res_boletos['boleto_tarifado']*0.05)+($res_boletos['boleto_impresso']*0.05))+$comissao_tarifas_boletos;
		$faturamento_boletos = (($res_boletos['tarifa_recebimento'])+($res_boletos['boleto_vencido'])+($res_boletos['boleto_tarifado'])+($res_boletos['boleto_impresso']))+$faturamento_boletos+0.22;
	}
	$conta_recarga = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM pagamento_boletos WHERE mes = '$mes' AND ano = '$ano' AND status != 'CANCELADO'")); 
	echo $conta_recarga;
	?></td>
  <td><? $comissao_pagamento_recarga = ($conta_recarga*0.03)+$comissao_tarifas_boletos; echo number_format($comissao_pagamento_recarga,2, ',', '.'); ?></td>
</tr>
<tr>
  <td bgcolor="#99CC00"><strong>RECARGA DE CELULAR</strong></td>
  <td bgcolor="#99CC00"><strong>MAQUINA BB</strong></td>
  <td bgcolor="#99CC00"><strong>0,2%</strong></td>
  <td bgcolor="#99CC00"><strong>500</strong></td>
  <td bgcolor="#99CC00"><?
	$soma_bb_prepago = 0;
	$faturamento_recarga = 0;
	echo $prepago2 = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM recarga_prepago WHERE m = '$mes' AND a = '$ano' AND status = 'Ativo' AND operador = '$operador'"));
	$recargapay_prepago = mysqli_query($conexao_bd, "SELECT * FROM recarga_prepago WHERE m = '$mes' AND a = '$ano' AND status = 'Ativo' AND operador = '$operador'");
		while($res_recargapay = mysqli_fetch_array($recargapay_prepago)){
			$soma_bb_prepago = $soma_bb_prepago+$res_recargapay['valor'];
			
			$faturamento_recarga = $faturamento_recarga+($res_recargapay['valor']*0.02);
			
		}
	?></td>
  <td bgcolor="#99CC00"><? $comissao_prepago = $soma_bb_prepago*0.002; echo number_format($comissao_prepago,2, ',', '.'); ?></td>
</tr>
<tr>
  <td bgcolor="#FFFFFF"><strong>GIFT CARD</strong></td>
  <td bgcolor="#FFFFFF"><strong>CELCOIN</strong></td>
  <td bgcolor="#FFFFFF"><strong>0.2%</strong></td>
  <td bgcolor="#FFFFFF"><strong>10</strong></td>
  <td bgcolor="#FFFFFF"><?
	$soma_gift_card= 0;
	$faturamento_gift_card = 0;
	echo $soma_gift_card = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM gift_card WHERE mes = '$mes' AND ano = '$ano' AND status = 'Ativo' AND operador = '$operador'"));
	$recargapay_soma_gift_card = mysqli_query($conexao_bd, "SELECT * FROM gift_card WHERE mes = '$mes' AND ano = '$ano' AND status = 'Ativo' AND operador = '$operador'");
		while($res_giftcard = mysqli_fetch_array($recargapay_soma_gift_card)){
			$soma_gift_card = $soma_gift_card+$res_giftcard['valor'];
			$faturamento_gift_card = $faturamento_gift_card+($res_giftcard['valor']*0.02);
		}
	?></td>
  <td bgcolor="#FFFFFF"><? $comissao_giftcard = $soma_gift_card*0.002; echo number_format($comissao_giftcard,2, ',', '.'); ?></td>
</tr>
<tr>
  <td bgcolor="#99CC00"><strong>RECARGA DE TV</strong></td>
  <td bgcolor="#99CC00"><strong>CELCOIN</strong></td>
  <td bgcolor="#99CC00"><strong>0.5%</strong></td>
  <td bgcolor="#99CC00"><strong>10</strong></td>
  <td bgcolor="#99CC00"><?
	$soma_tv= 0;
	echo $soma_tv = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM gift_card WHERE mes = '$mes' AND ano = '$ano' AND status = 'Ativo' AND operador = '$operador'"));
	$tv = mysqli_query($conexao_bd, "SELECT * FROM gift_card WHERE mes = '$mes' AND ano = '$ano' AND status = 'Ativo' AND operador = '$operador'");
		while($res_tv = mysqli_fetch_array($tv)){
			$soma_tv = $soma_tv+$res_tv['valor'];
		}
	?></td>
  <td bgcolor="#99CC00"><? $comissao_tv = $soma_tv*0.005; echo number_format($comissao_tv,2, ',', '.'); ?></td>
</tr>
<tr>
  <td bgcolor="#FFFFFF"><strong>SAQUE</strong></td>
  <td bgcolor="#FFFFFF"><strong>OUTROS BANCOS</strong></td>
  <td bgcolor="#FFFFFF"><strong>5% DO LUCRO</strong></td>
  <td bgcolor="#FFFFFF"><strong>50</strong></td>
  <td bgcolor="#FFFFFF"><?
	$soma_saques= 0;
	$faturamento_saque_outros_bancos = 0;
	echo $soma_saques = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM saques WHERE mes = '$mes' AND ano = '$ano' AND operador = '$operador'"));
	$saques = mysqli_query($conexao_bd, "SELECT * FROM saques WHERE mes = '$mes' AND ano = '$ano' AND operador = '$operador'");
		while($res_saques = mysqli_fetch_array($saques)){
			$soma_saques = $soma_saques+$res_saques['tarifa'];
			$faturamento_saque_outros_bancos = $faturamento_saque_outros_bancos+($res_saques['tarifa']-($res_saques['valor']*0.02));
		}
	?></td>
  <td bgcolor="#FFFFFF"><? $comissao_saques = $soma_saques*0.05; echo number_format($comissao_saques,2, ',', '.'); ?></td>
</tr>
<tr>
  <td bgcolor="#99CC00"><strong>EMPRÉSTIMOS</strong></td>
  <td bgcolor="#99CC00"><strong>CARTÃO DE CRÉDITO</strong></td>
  <td bgcolor="#99CC00"><strong>10% DO LUCRO</strong></td>
  <td bgcolor="#99CC00"><strong>10</strong></td>
  <td bgcolor="#99CC00"><?
	$soma_emprestimos_cartao = 0;
	$faturamento_emprestimo_cartao = 0;
	echo $emprestimo_cartao = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM emprestimo_cartao WHERE mes = '$mes' AND ano = '$ano' AND operador = '$operador'"));
	$emprestimo_cartao = mysqli_query($conexao_bd, "SELECT * FROM emprestimo_cartao WHERE mes = '$mes' AND ano = '$ano' AND operador = '$operador'");
		while($res_emprestimo_cartao = mysqli_fetch_array($emprestimo_cartao)){
			$soma_emprestimos_cartao = $soma_emprestimos_cartao+$res_emprestimo_cartao['lucro'];
			$faturamento_emprestimo_cartao = $faturamento_emprestimo_cartao+$res_emprestimo_cartao['lucro'];
		}
	?></td>
  <td bgcolor="#99CC00"><? $comissao_emprestimo_cartao = $soma_emprestimos_cartao*0.1; echo number_format($comissao_emprestimo_cartao,2, ',', '.'); ?></td>
</tr>
<tr>
  <td bgcolor="#FFFFFF"><strong>TED</strong></td>
  <td bgcolor="#FFFFFF"><strong>OUTROS BANCOS</strong></td>
  <td bgcolor="#FFFFFF"><strong>5% DA TARIFA</strong></td>
  <td bgcolor="#FFFFFF"><strong>10</strong></td>
  <td bgcolor="#FFFFFF"><?
	$soma_transferencia_ted = 0;
	$faturamento_ted = 0;
	echo $transferencia_ted = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM transferencia_ted WHERE mes = '$mes' AND ano = '$ano' AND operador = '$operador' AND status != 'Cancelado'"));
	$transferencia_ted = mysqli_query($conexao_bd, "SELECT * FROM transferencia_ted WHERE mes = '$mes' AND ano = '$ano' AND operador = '$operador' AND status != 'Cancelado'");
		while($res_transferencia_ted = mysqli_fetch_array($transferencia_ted)){
			$soma_transferencia_ted = $soma_transferencia_ted+$res_transferencia_ted['tarifa'];
			$faturamento_ted = $faturamento_ted+$res_transferencia_ted['tarifa'];
		}
	?></td>
  <td bgcolor="#FFFFFF"><? $comissao_transferencia_ted = $soma_transferencia_ted*0.05; echo number_format($comissao_transferencia_ted,2, ',', '.'); ?></td>
</tr>
<tr>
  <td bgcolor="#99CC00"><strong>VENDA DE PRODUTOS</strong></td>
  <td bgcolor="#99CC00"><strong>VESTE PRIME</strong></td>
  <td bgcolor="#99CC00"><strong>1% A 30% DO VALOR</strong></td>
  <td bgcolor="#99CC00"><strong>R$ 6.000,00</strong></td>
  <td bgcolor="#99CC00"><?
	$soma_compras = 0;
	$soma_comissao_vendas = 0;
	$faturamento_venda_produtos = 0;
	$produtos_caixa = mysqli_query($conexao_bd, "SELECT * FROM produtos_caixa WHERE operador = '$operador' AND mes = '$mes' AND ano = '$ano'");
		while($res_produtos_caixa = mysqli_fetch_array($produtos_caixa)){
			$soma_compras = $res_produtos_caixa['valor']+$soma_compras;
			$faturamento_venda_produtos = $res_produtos_caixa['valor']+$faturamento_venda_produtos;
			$soma_comissao_vendas = $res_produtos_caixa['comissao']+$soma_comissao_vendas;
	}
	echo number_format($soma_compras, 2, ',', '.');
	?></td>
  <td bgcolor="#99CC00"><? echo number_format($soma_comissao_vendas, 2, ',', '.'); ?></td>
</tr>
<tr>
  <td bgcolor="#FFFFFF"><strong>VESTE PRIME CARD</strong></td>
  <td bgcolor="#FFFFFF"><strong>VESTE PRIME</strong></td>
  <td bgcolor="#FFFFFF"><strong>R$ 0,50</strong></td>
  <td bgcolor="#FFFFFF"><strong>5</strong></td>
  <td bgcolor="#FFFFFF"><?
	echo $conta_veste_prime_card = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM conta_corrente WHERE mes_cadastro = '$mes' AND ano_cadastro = '$ano' AND proposta_credito = 'APROVADO'"));
	?></td>
  <td bgcolor="#FFFFFF"><? $comissao_veste_prime_card = $conta_veste_prime_card*0.50; echo number_format($comissao_veste_prime_card, 2, ',', '.'); ?></td>
</tr>
<tr>
  <td bgcolor="#99CC00"><strong>DEPÓSITO BANCÁRIO</strong></td>
  <td bgcolor="#99CC00"><strong>MAQUINA BB</strong></td>
  <td bgcolor="#99CC00"><strong>0,01</strong></td>
  <td bgcolor="#99CC00"><strong>20</strong></td>
  <td bgcolor="#99CC00"><?
	echo $deposito_banco_brasil = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM deposito_banco_brasil WHERE mes = '$mes' AND ano = '$ano' AND operador = '$operador' AND status != 'Cancelado'"));
	?></td>
  <td bgcolor="#99CC00"><? $comissao_deposito_banco_brasil = $deposito_banco_brasil*0.01; echo number_format($comissao_deposito_banco_brasil,2, ',', '.'); ?></td>
</tr>
<tr>
  <td height="7" bgcolor="#FFFFFF"><strong>SAQUE BB</strong></td>
  <td bgcolor="#FFFFFF"><strong>MAQUINA BB</strong></td>
  <td bgcolor="#FFFFFF"><strong>0,01</strong></td>
  <td bgcolor="#FFFFFF"><strong>50</strong></td>
  <td bgcolor="#FFFFFF"><?
	echo $saque_banco_brasil = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM saque_banco_brasil WHERE mes = '$mes' AND ano = '$ano' AND operador = '$operador' AND status != 'Cancelado'"));
	?></td>
  <td bgcolor="#FFFFFF"><? $comissao_saque_banco_brasil = $saque_banco_brasil*0.01; echo number_format($comissao_saque_banco_brasil,2, ',', '.'); ?></td>
</tr>
<tr>
  <td height="7" bgcolor="#99CC00"><strong>CAPITALIZA&Ccedil;AO</strong></td>
  <td bgcolor="#99CC00"><strong>VESTE PRIME</strong></td>
  <td bgcolor="#99CC00"><strong>10% DA MENSALIDADE</strong></td>
  <td bgcolor="#99CC00"><strong>10</strong></td>
  <td bgcolor="#99CC00"><?
	
	$valor_cap = 0;
	$sql_verifica_plano = mysqli_query($conexao_bd, "SELECT * FROM plano_capitalizao WHERE mes = '$mes' AND ano = '$ano' AND operador = '$operador' AND status = 'Ativo'");
	while($val_cap = mysqli_fetch_array($sql_verifica_plano)){
	 	$valor_cap = $val_cap['valor']+$valor_cap;
	}
	
	echo mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM plano_capitalizao WHERE mes = '$mes' AND ano = '$ano' AND operador = '$operador' AND status = 'Ativo'"));
		
	?></td>
  <td bgcolor="#99CC00"><? $vestecap = $valor_cap*0.1; echo number_format($vestecap,2, ',', '.'); ?></td>
</tr>
<tr>
  <td height="2" bgcolor="#FFFFFF"><strong>EMPRESTIMO NO BOLETO</strong></td>
  <td bgcolor="#FFFFFF"><strong>VESTE PRIME</strong></td>
  <td bgcolor="#FFFFFF"><strong>10% DOS JUROS</strong></td>
  <td bgcolor="#FFFFFF"><strong>1</strong></td>
  <td bgcolor="#FFFFFF"><?
	
	$valor_emprestimo = 0;
	$sql_valor_emprestimo = mysqli_query($conexao_bd, "SELECT * FROM emprestimo_boleto WHERE mes = '$mes' AND ano = '$ano' AND operador = '$operador' AND status = 'APROVADO'");
	while($val_emprestimo = mysqli_fetch_array($sql_valor_emprestimo)){
	 	$valor_emprestimo = (($val_emprestimo['quant_parcela']*$val_emprestimo['valor_parcela'])-$val_emprestimo['valor'])+$valor_emprestimo;
	}
	
	echo mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM emprestimo_boleto WHERE mes = '$mes' AND ano = '$ano' AND operador = '$operador' AND status = 'APROVADO'"));
		
	?></td>
  <td bgcolor="#FFFFFF"><? $valor_emprestimo = $valor_emprestimo*0.05; echo number_format($valor_emprestimo,2, ',', '.'); ?></td>
</tr>
<tr>
  <td height="3" bgcolor="#99CC00"><strong>RIFA ONLINE</strong></td>
  <td bgcolor="#99CC00"><strong>VESTE PRIME</strong></td>
  <td bgcolor="#99CC00"><strong>10% DO BILHETE</strong></td>
  <td bgcolor="#99CC00">---</td>
  <td bgcolor="#99CC00"><?
	
	$rifa = 0;
	$sql_rifa = mysqli_query($conexao_bd, "SELECT * FROM rifas_cupons WHERE mes = '$mes' AND ano = '$ano' AND operador = '$operador' AND status = 'Ativo'");
	while($res_rifa = mysqli_fetch_array($sql_rifa)){
	 	$rifa = $res_rifa['valor']+$rifa;
	}
	
	$rifa = $rifa*0.1;
	echo mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM rifas_cupons WHERE mes = '$mes' AND ano = '$ano' AND operador = '$operador' AND status = 'Ativo'"));
	
	?></td>
  <td bgcolor="#99CC00"><? echo number_format($rifa,2, ',', '.'); ?></td>
</tr>
<tr>
  <td colspan="5" align="right" bgcolor="#009999"><strong>COMISS&Otilde;ES DO M&Ecirc;S</strong></td>
  <td bgcolor="#009999">+
    <? 
	
	$comissao_mes = 0;
	$comissao_mes = $rifa+$comissao_pagamento_bb+$comissao_pagamento_recarga+$comissao_prepago+$comissao_prepago2+$comissao_giftcard+$comissao_tv+$comissao_saques+$comissao_veste_prime_card+$vestecap +$comissao_emprestimo_cartao+$comissao_transferencia_ted+$comissao_deposito_banco_brasil+$comissao_saque_banco_brasil+$soma_comissao_vendas;
	if($faturamento_venda_produtos >= 4000){
		$comissao_mes = $comissao_mes;
	}else{
		$comissao_mes = $comissao_mes*0.7;
	}
	echo number_format($comissao_mes,2, ',', '.');
	?></td>
</tr>
<tr>
  <td colspan="5" align="right" bgcolor="#009900"><strong>PROVENTOS MENSAIS</strong></td>
  <td bgcolor="#009900">+
    <?
    $salario = 0;
	$sql_salario = mysqli_query($conexao_bd, "SELECT * FROM adm WHERE cpf = '$operador'");
		while($res_salario = mysqli_fetch_array($sql_salario)){
			$salario = $res_salario['salario'];
		}
		echo number_format($salario, 2, ',', '.');
	?></td>
</tr>
<tr>
  <td colspan="5" align="right" bgcolor="#CCCCCC"><strong>FATURAMENTO CONT&Aacute;BIL</strong></td>
  <td bgcolor="#CCCCCC"><? $faturamento = $faturamento_boletos+$faturamento_recarga+$faturamento_gift_card+$faturamento_saque_outros_bancos+$faturamento_emprestimo_cartao+$faturamento_ted+$faturamento_venda_produtos; ?>
    R$ <? echo number_format($faturamento,2,',','.'); ?></td>
</tr>
<tr>
  <td colspan="5" align="right" bgcolor="#00CCFF"><strong>ADICIONAL CUMPRIMENTO DE METAS</strong></td>
  <td bgcolor="#00CCFF">+ <? $adicional_bonus = 0; if($faturamento >= 12000){ $adicional_bonus = $salario*0.35; echo number_format($adicional_bonus,2,',','.'); }else{ echo "Aguarda meta";} ?></td>
</tr>
<tr>
  <td colspan="5" align="right" bgcolor="#FF3300"><strong>DESCONTOS</strong></td>
  <td bgcolor="#FF3300">-
    <?
	$debitos = 0;
	$sql_retirada_dinheiro = mysqli_query($conexao_bd, "SELECT * FROM retirada_dinheiro WHERE operador = '$operador' AND mes = '$mes' AND ano = '$ano'");
		while($res_retirada_dinheiro = mysqli_fetch_array($sql_retirada_dinheiro)){
			if($res_retirada_dinheiro['finalidade'] == 'MULTA' || $res_retirada_dinheiro['finalidade'] == 'FINS PESSOAIS'){
			$debitos = $res_retirada_dinheiro['valor']+$debitos;
		 }
		}
		echo number_format($debitos, 2, ',', '.');
	?></td>
</tr>
<tr>
  <td colspan="5" align="right" bgcolor="#FF3300"><strong>IMPOSTOS INSS/IRRF</strong></td>
  <td bgcolor="#FF3300">-
    <?  $inss = (($salario+$comissao_mes+$adicional_bonus))*0.08;  echo number_format($inss, 2, ',','.'); ?></td>
</tr>
<? $salario = $salario+$comissao_mes+$adicional_bonus; ?>
<tr>
  <td align="right" colspan="5"><strong>SALDO LIQU&Iacute;DO A RECEBER</strong></td>
  <td><? $saldo_liquido = ($salario)-($debitos+$inss); echo number_format($saldo_liquido, 2, ',', '.'); ?></td>
</tr>
</table>
<?
$sql_comissoes_dia = mysqli_query($conexao_bd, "SELECT * FROM comissoes WHERE mes = '$mes' AND ano = '$ano' AND operador = '$operador'");
if(mysqli_num_rows($sql_comissoes_dia) == ''){
	mysqli_query($conexao_bd, "INSERT INTO comissoes (dia, mes, ano, data, data_completa, operador, pagamento_bb, pagamento_recargapay, recarga_bb, recarga_recargapay, gift_card, tv, saque_outros_bancos, emprestimo, ted, produtos, abertura_contas, deposito_bb, saque_bb, comissoes_mes, proventos, descontos, saldo_receber, veste_prime_card, impostos) VALUES ('$dia', '$mes', '$ano', '$data', '$data_completa', '$operador', '$comissao_pagamento_bb', '$comissao_pagamento_recarga', '$comissao_prepago', '$comissao_prepago2', '$comissao_giftcard', '$comissao_tv', '$comissao_saques', '$comissao_emprestimo_cartao', '$comissao_transferencia_ted', '$soma_comissao_vendas', '', '$comissao_deposito_banco_brasil', '$comissao_saque_banco_brasil', '$comissao_mes', '$salario', '$debitos', '$saldo_liquido', '$comissao_veste_prime_card', '$inss')");
}else{
	mysqli_query($conexao_bd, "UPDATE comissoes SET veste_prime_card = '$comissao_veste_prime_card', pagamento_bb = '$comissao_pagamento_bb', pagamento_recargapay = '$comissao_pagamento_recarga', recarga_bb = '$comissao_prepago', recarga_recargapay = '$comissao_prepago2', gift_card = '$comissao_giftcard', tv = '$comissao_tv', saque_outros_bancos = '$comissao_saques', emprestimo = '$comissao_emprestimo_cartao', ted = '$comissao_transferencia_ted', produtos = '$soma_comissao_vendas', abertura_contas = '', deposito_bb = '$comissao_deposito_banco_brasil', saque_bb = '$comissao_saque_banco_brasil', comissoes_mes = '$comissao_mes', proventos = '$salario', descontos = '$debitos', saldo_receber = '$saldo_liquido', impostos = '$inss' WHERE mes = '$mes' AND ano = '$ano' AND operador = '$operador'");
}


?>
</div><!-- box_pagamento_1 -->

</body>
</html>