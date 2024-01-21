<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/mostrar_lucro_dia.css" rel="stylesheet" type="text/css" />
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
<? require "topo.php";   require "scripts/verificador_caixa.php"; ?>

<?
mysqli_query($conexao_bd, "UPDATE produtos SET estoque = '0' WHERE estoque <0");
if($operador != '05379839371'){
	echo "<script language='javascript'>window.location='carrinho.php';</script>";
}

?>


<div id="box_pagamento_1">

<?
$faturamento_total = 0;
$lucro_bruto = 0;
$produtos_em_estoque = 0;
$perdas = 0;
$despesas = 0;
$lucro_liquido = 0;

$pagamento_de_contas = 0;
$produtos_e_servicos = 0;
$recarga_tv = 0;
$recarga_celular_prepago = 0;
$gift_card = 0;
$saques = 0;
$emprestimos = 0;
$ted = 0;


$ano_filtro = $_GET['ano_filtro'];
$mes_filtro = $_GET['mes_filtro'];
$dia_filtro = $_GET['dia_filtro'];


// RIFA
$filtro_rifa = 0;
if($ano_filtro != '' && $mes_filtro != '' && $dia_filtro != ''){
	$filtro_rifa = "WHERE dia = '$dia_filtro' AND mes = '$mes_filtro' AND ano = '$ano_filtro' AND status != 'CANCELADO'";
}elseif($ano_filtro != '' && $mes_filtro != '' && $dia_filtro == ''){
	$faturamento_rifa = "WHERE mes = '$mes_filtro' AND ano = '$ano_filtro' AND status != 'CANCELADO'";
}else{
	$faturamento_rifa = "WHERE ano = '$ano_filtro' AND status != 'CANCELADO'";
}

$faturamento_rifa = 0;
$sql_rifas = mysqli_query($conexao_bd, "SELECT * FROM rifas_cupons $filtro_rifa");
	while($res_rifas = mysqli_fetch_array($sql_rifas)){
		$faturamento_rifa = $res_rifas['valor']+$faturamento_rifa;
	}
	
	
	
// PAGAMENTO DE CONTAS
$filtro_pagamento_contas = 0;
if($ano_filtro != '' && $mes_filtro != '' && $dia_filtro != ''){
	$filtro_pagamento_contas = "WHERE dia = '$dia_filtro' AND mes = '$mes_filtro' AND ano = '$ano_filtro' AND status != 'CANCELADO'";
}elseif($ano_filtro != '' && $mes_filtro != '' && $dia_filtro == ''){
	$filtro_pagamento_contas = "WHERE mes = '$mes_filtro' AND ano = '$ano_filtro' AND status != 'CANCELADO'";
}else{
	$filtro_pagamento_contas = "WHERE ano = '$ano_filtro' AND status != 'CANCELADO'";
}
$fate_pag = 0;
$sql_pagamento_de_contas = mysqli_query($conexao_bd, "SELECT * FROM pagamentoboletos $filtro_pagamento_contas");
	while($res_pagamento_contas = mysqli_fetch_array($sql_pagamento_de_contas)){
		$fate_pag = $res_pagamento_contas['valor_recebido']+$fate_pag;
		$tarifa_recebimento = $res_pagamento_contas['tarifa_recebimento'];
		$boleto_vencido = $res_pagamento_contas['boleto_vencido'];
		$comissao = $res_pagamento_contas['comissao'];
		$tarifa_processamento = $res_pagamento_contas['tarifa_processamento'];
		$boleto_tarifado = $res_pagamento_contas['boleto_tarifado'];
		$boleto_impresso = $res_pagamento_contas['boleto_impresso'];
		$processamento = 0.22;
		
		$pagamento_de_contas = $pagamento_de_contas+(($tarifa_recebimento+$boleto_tarifado+$boleto_vencido+$comissao+$processamento+$boleto_impresso)-$tarifa_processamento);
		
		
		
	} // while pagamento de contas
// FIM DO PAGAMENTO DE CONTAS




// PRODUTOS E SERVIÇOS
$filtro_produtos_e_servicos = 0;
if($ano_filtro != '' && $mes_filtro != '' && $dia_filtro != ''){
	$filtro_produtos_e_servicos = "WHERE dia = '$dia_filtro' AND mes = '$mes_filtro' AND ano = '$ano_filtro' AND status = 'Encerrado'";
}elseif($ano_filtro != '' && $mes_filtro != '' && $dia_filtro == ''){
	$filtro_produtos_e_servicos = "WHERE mes = '$mes_filtro' AND ano = '$ano_filtro' AND status = 'Encerrado'";
}else{
	$filtro_produtos_e_servicos = "WHERE ano = '$ano_filtro' AND status = 'Encerrado'";
}
$lucro_bruto_produtos_servicos = 0;
$comissao = 0;
$valor_compras_produtos_e_servicos = 0;
$sql_produtos_e_servicos = mysqli_query($conexao_bd, "SELECT * FROM produtos_caixa $filtro_produtos_e_servicos");
	while($res_produtos_e_servicos = mysqli_fetch_array($sql_produtos_e_servicos)){
		$produto = $res_produtos_e_servicos['code_produto'];
		$quant = $res_produtos_e_servicos['quant'];
		
		$sql_produto = mysqli_query($conexao_bd, "SELECT * FROM produtos WHERE code = '$produto'");
			while($res_produto = mysqli_fetch_array($sql_produto)){
				$comissao = ($res_produto['comissao']*$quant)+$comissao;
				$produtos_e_servicos = ($valor_venda = $res_produto['valor_venda']*$quant)+$produtos_e_servicos;
				$valor_compras_produtos_e_servicos = ($res_produto['valor_compra']*$quant)+$valor_compras_produtos_e_servicos;
			} // while produtos
		
	} // while produtox caixa
	
	


$lucro_bruto_produtos_servicos = $produtos_e_servicos-$valor_compras_produtos_e_servicos;

// FIM DO PRODUTOS E SERVIÇOS



	
// RECARGA DE TV
$filtro_recarga_tv = 0;
if($ano_filtro != '' && $mes_filtro != '' && $dia_filtro != ''){
	$filtro_recarga_tv = "WHERE d = '$dia_filtro' AND m = '$mes_filtro' AND a = '$ano_filtro' AND status = 'Ativo' AND processamento = 'CELCOIN'";
}elseif($ano_filtro != '' && $mes_filtro != '' && $dia_filtro == ''){
	$filtro_recarga_tv = "WHERE m = '$mes_filtro' AND a = '$ano_filtro' AND status = 'Ativo' AND processamento = 'CELCOIN'";
}else{
	$filtro_recarga_tv = "WHERE a = '$ano_filtro' AND status = 'Ativo' AND processamento = 'CELCOIN'";
}
$fate_tv = 0;
$sql_recarga_tv_prepago = mysqli_query($conexao_bd, "SELECT * FROM recarga_tv_prepago $filtro_recarga_tv");
	while($res_tv = mysqli_fetch_array($sql_recarga_tv_prepago)){
		
		$recarga_tv = $res_tv['lucro']+$recarga_tv;
		$fate_tv = $res_tv['valor']+$fate_tv;
		
	}
// FECHAR RECARGA DE TV PRÉ-PAGO


// RECARGA DE CELULAR PRÉ-PAGO
$filtro_recarga_prego = 0;
if($ano_filtro != '' && $mes_filtro != '' && $dia_filtro != ''){
	$filtro_recarga_prego = "WHERE d = '$dia_filtro' AND m = '$mes_filtro' AND a = '$ano_filtro' AND status = 'Ativo'";
}elseif($ano_filtro != '' && $mes_filtro != '' && $dia_filtro == ''){
	$filtro_recarga_prego = "WHERE m = '$mes_filtro' AND a = '$ano_filtro' AND status = 'Ativo'";
}else{
	$filtro_recarga_prego = "WHERE a = '$ano_filtro' AND status = 'Ativo' AND status = 'Ativo'";
}
$fate_prepago = 0;
$sql_recarga_prepago = mysqli_query($conexao_bd, "SELECT * FROM recarga_prepago $filtro_recarga_prego");
	while($recarga_prepago = mysqli_fetch_array($sql_recarga_prepago)){
		$recarga_celular_prepago = $recarga_prepago['lucro']+$recarga_celular_prepago;
		$fate_prepago = $recarga_prepago['valor']+$fate_prepago;
		
	}
// FIM DA RECARGA PRÉ-PAGO







// RECARGA DE GIFT CARD
$filtro_gift_card = 0;
if($ano_filtro != '' && $mes_filtro != '' && $dia_filtro != ''){
	$filtro_gift_card = "WHERE dia = '$dia_filtro' AND mes = '$mes_filtro' AND ano = '$ano_filtro' AND status = 'Ativo'";
}elseif($ano_filtro != '' && $mes_filtro != '' && $dia_filtro == ''){
	$filtro_gift_card = "WHERE mes = '$mes_filtro' AND ano = '$ano_filtro' AND status = 'Ativo'";
}else{
	$filtro_gift_card = "WHERE ano = '$ano_filtro' AND status = 'Ativo' AND status = 'Ativo'";
}
$fate_gift_card = 0;
$sql_gift_card = mysqli_query($conexao_bd, "SELECT * FROM gift_card $filtro_gift_card");
	while($recarga_gift_card = mysqli_fetch_array($sql_gift_card)){
		$gift_card = $recarga_gift_card['lucro']+$gift_card;
		$fate_gift_card = $recarga_gift_card['valor']+$fate_gift_card;
	}
// FIM DA RECARGA GIFT CARD







// INICAR SAQUES
$filtro_saques = 0;
if($ano_filtro != '' && $mes_filtro != '' && $dia_filtro != ''){
	$filtro_saques = "WHERE dia = '$dia_filtro' AND mes = '$mes_filtro' AND ano = '$ano_filtro'";
}elseif($ano_filtro != '' && $mes_filtro != '' && $dia_filtro == ''){
	$filtro_saques = "WHERE mes = '$mes_filtro' AND ano = '$ano_filtro'";
}else{
	$filtro_saques = "WHERE ano = '$ano_filtro'";
}
$valor_cobrado = 0;
$tarifas = 0;
$fate_saques = 0;
$sql_saques = mysqli_query($conexao_bd, "SELECT * FROM saques $filtro_saques");
	while($saques_s = mysqli_fetch_array($sql_saques)){
		$valor_cobrado = $saques_s['valor_cobrado']+$valor_cobrado;
		$fate_saques = $saques_s['valor']+$fate_saques;
		$tarifas = $tarifas+$saques_s['tarifa'];
	}
		
$juros_valor_cobrado = $valor_cobrado*0.0199;
$saques = $tarifas-$juros_valor_cobrado;
	
// FIM DOS SAQUES







// INICAR EMPRÉSTIMOS NO CARTÃO DE CRÉDITO
$filtro_emprestimos = 0;
if($ano_filtro != '' && $mes_filtro != '' && $dia_filtro != ''){
	$filtro_emprestimos = "WHERE dia = '$dia_filtro' AND mes = '$mes_filtro' AND ano = '$ano_filtro'";
}elseif($ano_filtro != '' && $mes_filtro != '' && $dia_filtro == ''){
	$filtro_emprestimos = "WHERE mes = '$mes_filtro' AND ano = '$ano_filtro'";
}else{
	$filtro_emprestimos = "WHERE ano = '$ano_filtro'";
}
$fate_emprestimo = 0;
$sql_emprestimo = mysqli_query($conexao_bd, "SELECT * FROM emprestimo_cartao $filtro_emprestimos");
	while($res_emprestimo = mysqli_fetch_array($sql_emprestimo)){
		$fate_emprestimo = $res_emprestimo['valor']+$fate_emprestimo;
		$emprestimos = $res_emprestimo['lucro']+$emprestimos;
	}

// FIM DOS EMPRÉSTIMOS NO CARTÃO



// INICAR FATURAMENTO CONFIRMADO
$filtro_faturamento_confirmado = 0;
if($ano_filtro != '' && $mes_filtro != '' && $dia_filtro != ''){
	$filtro_faturamento_confirmado = "WHERE dia = '$dia_filtro' AND mes = '$mes_filtro' AND ano = '$ano_filtro'";
}elseif($ano_filtro != '' && $mes_filtro != '' && $dia_filtro == ''){
	$filtro_faturamento_confirmado = "WHERE mes = '$mes_filtro' AND ano = '$ano_filtro'";
}else{
	$filtro_faturamento_confirmado = "WHERE ano = '$ano_filtro'";
}

$venda2 = 0;
$venda_confirmada = mysqli_query($conexao_bd, "SELECT * FROM pagamento_carrinho $filtro_faturamento_confirmado");
	while($res_confirmado = mysqli_fetch_array($venda_confirmada)){
		if($res_confirmado['form_pag'] == 'DINHEIRO' || $res_confirmado['form_pag'] == 'CARTÃO DE DÉBITO' || $res_confirmado['form_pag'] == 'CARTÃO DE CRÉDITO'){
		$venda2 = $res_confirmado['valor_fornecido']+$venda2;
		}elseif($res_confirmado['form_pag'] == 'VESTE PRIME'){
		$venda2 = $res_confirmado['valor_total']+$venda2;
		}
	}

$valor_confirmado = $valor_confirmado+$venda2;

// FIM DO FATURAMENTO CONFIRMADO




// INICAR TED
$filtro_ted = 0;
if($ano_filtro != '' && $mes_filtro != '' && $dia_filtro != ''){
	$filtro_ted = "WHERE dia = '$dia_filtro' AND mes = '$mes_filtro' AND ano = '$ano_filtro' AND status != 'Cancelado'";
}elseif($ano_filtro != '' && $mes_filtro != '' && $dia_filtro == ''){
	$filtro_ted = "WHERE mes = '$mes_filtro' AND ano = '$ano_filtro' AND status != 'Cancelado'";
}else{
	$filtro_ted = "WHERE ano = '$ano_filtro' AND status != 'Cancelado'";
}
$fate_ted = 0;
$sql_ted = mysqli_query($conexao_bd, "SELECT * FROM transferencia_ted $filtro_ted");
	while($res_ted = mysqli_fetch_array($sql_ted)){
		$ted = $res_ted['tarifa']+$ted;
		$fate_ted = $res_ted['valor']+$fate_ted;
	}

// FIM DOS TED






// AUXILIO EMERGENCIAL
$filtro_auxilio = 0;
if($ano_filtro != '' && $mes_filtro != '' && $dia_filtro != ''){
	$filtro_auxilio = "WHERE dia = '$dia_filtro' AND mes = '$mes_filtro' AND ano = '$ano_filtro'";
}elseif($ano_filtro != '' && $mes_filtro != '' && $dia_filtro == ''){
	$filtro_auxilio = "WHERE mes = '$mes_filtro' AND ano = '$ano_filtro'";
}else{
	$filtro_auxilio = "WHERE ano = '$ano_filtro'";
}

$soma_auxilio = 0;
$sql_auxilio = mysqli_query("SELECT * FROM auxilio_emergencial $filtro_auxilio");
while($res_auxilio = mysqli_fetch_array($sql_auxilio)){
	$soma_auxilio = $soma_auxilio+$res_auxilio['tarifa'];
}


$faturamento_total = $pagamento_de_contas+$faturamento_rifa+$produtos_e_servicos+$recarga_tv+$recarga_celular_prepago+$gift_card+$saques+$emprestimos+$ted;

$faturamento_confirmado = $pagamento_de_contas+$faturamento_confirmado+$recarga_tv+$recarga_celular_prepago+$gift_card+$saques+$emprestimos+$ted;
$lucro_total_bruto = $pagamento_de_contas+$lucro_bruto_produtos_servicos+$recarga_tv+$recarga_celular_prepago+$gift_card+$saques+$emprestimos+$ted;

?>
<hr />



 <div id="filtro">
   <form name="" method="post" action="" enctype="multipart/form-data">
   <select style="background:#000; border:1px solid #111; color:#F90;" name="dia" size="1">
     <option value="">Selecione o dia</option>
     <option value="<? echo $dia; ?>"><? echo $dia; ?></option>
	  <? for($i=1; $i<=31; $i++){ ?>
        <? if($i != $dia){ ?>
	    <option value="<? if($i <10) {echo "0$i"; }else{ echo $i; } ?>"><? if($i <10) {echo "0$i"; }else{ echo $i; } ?></option>
        <? } ?>
      <? } ?>
   </select>
   <select style="background:#000; border:1px solid #111; color:#F90;" name="mes" size="1">
     <option value="<? echo $mes; ?>"><? echo $mes; ?></option>
     <option value="">Selecione o mês</option>
	  <? for($i=1; $i<=12; $i++){ ?>
        <? if($i != $mes){ ?>
	    <option value="<? if($i <10) {echo "0$i"; }else{ echo $i; } ?>"><? if($i <10) {echo "0$i"; }else{ echo $i; } ?></option>
        <? } ?>
      <? } ?>
   </select>
   <select style="background:#000; border:1px solid #111; color:#F90;" name="ano" size="1">
     <option value="<? echo $ano; ?>"><? echo $ano; ?></option>
     <option value="<? echo $ano-1; ?>"><? echo $ano-1; ?></option>
     <option value="<? echo $ano-2; ?>"><? echo $ano-2; ?></option>
     <option value="<? echo $ano-3; ?>"><? echo $ano-3; ?></option>
     <option value="<? echo $ano-4; ?>"><? echo $ano-4; ?></option>
   </select>
  <input style="background:#000; border:1px solid #333; color:#F90;" type="submit" name="filtro" value="Filtrar" />
  </form>
  <? if(isset($_POST['filtro'])){
	 
  $dia = $_POST['dia'];
  $mes = $_POST['mes'];
  $ano = $_POST['ano'];
  
  if($ano == ''){
	  echo "<script language='javascript'>window.alert('É obrigatório informar o ano!');</script>";
  }else{
	  echo "<script language='javascript'>window.location='?ano_filtro=$ano&mes_filtro=$mes&dia_filtro=$dia';</script>";
  }
  
  }?>
 </div><!-- filtro -->
 <hr />
 
 <div id="resumo">
 	
    <div id="faturamento">
     <img src="img/fatu.png" />
     <p style="margin:7px 0 0 0;">R$ <? echo number_format($faturamento_total,2,',','.'); ?></p>
    </div><!-- faturamento -->
    
    <div id="lucro_bruto">
     <img src="img/lucro_bruto.png" />
     <p style="margin:7px 0 0 0;">R$ <? echo number_format($lucro_total_bruto,2,',','.'); ?></p>
    </div><!-- lucro_bruto -->
  

	 <?
     	$produtosEmEstoque = 0;
     	$produtosAtivo = 0;
     	$produtosPassivo = 0;
		
		$previsaoFaturamento = 0;
		$previsaoFaturamentoAtivo = 0;
		$previsaoFaturamentoPassivo = 0;
		
	 	$sql_produtos_em_estoque = mysqli_query($conexao_bd, "SELECT * FROM produtos WHERE tipo = 'PRODUTO'");
			while($res_produtos_capinhas = mysqli_fetch_array($sql_produtos_em_estoque)){
				
				$produtosEmEstoque += ($res_produtos_capinhas['estoque']*$res_produtos_capinhas['valor_compra']);
				$previsaoFaturamento += ($res_produtos_capinhas['estoque']*$res_produtos_capinhas['valor_venda']);
				
				if($res_produtos_capinhas['subTipo'] == 'ATIVO'){

					$produtosAtivo += ($res_produtos_capinhas['estoque']*$res_produtos_capinhas['valor_compra']);
					$previsaoFaturamentoAtivo += ($res_produtos_capinhas['estoque']*$res_produtos_capinhas['valor_venda']);
				
				}else{
				
					$produtosPassivo += ($res_produtos_capinhas['estoque']*$res_produtos_capinhas['valor_compra']);
					$previsaoFaturamentoPassivo += ($res_produtos_capinhas['estoque']*$res_produtos_capinhas['valor_venda']);

				}
			}
	
	 
	 ?>


    <div id="perdas">
     <img src="img/perdas.png" />
     <p style="margin:7px 0 0 0;">
     R$ <?
     	
		$filtro_perdas = 0;
		if($ano_filtro != '' && $mes_filtro != '' && $dia_filtro != ''){
			$filtro_perdas = "WHERE dia = '$dia_filtro' AND mes = '$mes_filtro' AND ano = '$ano_filtro' AND status = 'Ativo'";
		}elseif($ano_filtro != '' && $mes_filtro != '' && $dia_filtro == ''){
			$filtro_perdas = "WHERE mes = '$mes_filtro' AND ano = '$ano_filtro' AND status = 'Ativo'";
		}else{
			$filtro_perdas = "WHERE ano = '$ano_filtro' AND status = 'Ativo' AND status = 'Ativo'";
		}		
		
	 	$sql_perdas = mysqli_query($conexao_bd, "SELECT * FROM perdas_e_prejuizos $filtro_perdas");
			while($res_perdas = mysqli_fetch_array($sql_perdas)){
				$quantidade = $res_perdas['quantidade'];
				$produto = $res_perdas['produto'];
				
				$sql_produto = mysqli_query($conexao_bd, "SELECT * FROM produtos WHERE code = '$produto'");
					while($res_produto = mysqli_fetch_array($sql_produto)){
						$valor_pro = $res_produto['valor_venda']*$quantidade;
					}
				
				$perdas = $perdas+$valor_pro;
			}
			
			echo number_format($perdas,2,',','.');
		
	 
	 ?>     
     </p>
    </div><!-- lucro_bruto --> 

    <div id="despesas">
     <img src="img/despesas.png" />
     <p style="margin:7px 0 0 0;">R$ 
     <?
		$filtro_despesas = 0;
		if($ano_filtro != '' && $mes_filtro != '' && $dia_filtro != ''){
			$filtro_despesas = "WHERE mes = '$mes_filtro' AND ano = '$ano_filtro'";
		}elseif($ano_filtro != '' && $mes_filtro != '' && $dia_filtro == ''){
			$filtro_despesas = "WHERE mes = '$mes_filtro' AND ano = '$ano_filtro'";
		}else{
			$filtro_despesas = "WHERE ano = '$ano_filtro'";
		}
		
	 $sql_despesas = mysqli_query($conexao_bd, "SELECT * FROM despesas_mes $filtro_despesas");
	 	while($res_despesas = mysqli_fetch_array($sql_despesas)){
			$despesas = $despesas+$res_despesas['vl_parcela'];
		}
	 $sql_descontos = mysqli_query($conexao_bd, "SELECT * FROM pagamento_carrinho $filtro_despesas");
	 	while($res_descontos = mysqli_fetch_array($sql_descontos)){
			$descontos = $descontos+$res_descontos['valor'];
		}
	 
	 $despesas = $despesas+$descontos+$comissao;
	 
		echo number_format($despesas,2,',','.');
	 
	 
	 ?>
     </p>
    </div><!-- despesas -->  

    <div id="lucro_liquido">
     <img src="img/lucro_liquido.png" />
     <p style="margin:7px 0 0 0;">R$ <? $lucro_liquido = $valor_confirmado-$despesas-$lucro_bruto-$descontos; echo number_format($lucro_liquido,2,',','.'); ?></p>
    </div><!-- lucro_liquido -->
        

	 <?
     	$faturamento_previsto = 0;
	 	$sql_produtos_em_estoque = mysqli_query($conexao_bd, "SELECT * FROM produtos WHERE tipo = 'PRODUTO' AND status = 'Ativo'");
			while($res_produtos_e_servicos = mysqli_fetch_array($sql_produtos_em_estoque)){
				if($res_produtos_e_servicos['estoque'] >= 1){
				$faturamento_previsto += ($res_produtos_e_servicos['estoque']*$res_produtos_e_servicos['valor_venda']);
				}
			}
			
			
			//echo number_format((($faturamento_previsto-$produtos_em_estoque_lucro_capinhas)*0.6),2,',','.');
	 ?>
  
 </div><!-- resumo -->
 
 <div id="descricao_faturamento">
   <table width="1000" border="0">
     <tr>
    <td width="423" bgcolor="#333333"><strong style="color:#0C0; font:15px 'Courier New', Courier, monospace;"><strong>DESCRIÇÃO DE FATURAMENTO</strong></strong></td>
    <td width="150" align="center" bgcolor="#333333"><strong>FATURAMENTO</strong></td>
    <td width="146" align="center" bgcolor="#333333"><strong>LUCRO BRUTO</strong></td>
    <td width="148" align="center" bgcolor="#333333"><strong>LUCRO LIQUÍDO</strong></td>
    <td width="111" align="center" bgcolor="#333333"><strong>% DO LUCRO</strong></td>
  </tr>
  <tr>
    <td bgcolor="#666666"><strong>Pagamento de contas</strong></td>
    <td align="center" bgcolor="#666666"><strong>R$ <? echo number_format($fate_pag,2,',','.'); ?></strong></td>
    <td align="center" bgcolor="#666666"><strong>R$ <? echo number_format($pagamento_de_contas,2,',','.'); ?></strong></td>
    <td align="center" bgcolor="#666666"><strong>R$ <? echo number_format($pagamento_de_contas*0.95,2,',','.'); ?></strong></td>
    <td align="center" bgcolor="#666666"><strong><? echo number_format(($pagamento_de_contas*100)/$lucro_total_bruto,1); ?>%</strong></td>
  </tr>
  <tr>
    <td bgcolor="#666600"><strong>Produtos e serviços</strong></td>
    <td align="center" bgcolor="#666600"><strong>R$ <? echo number_format($produtos_e_servicos,2,',','.'); ?></strong></td>
    <td align="center" bgcolor="#666600"><strong>R$ <? echo number_format($lucro_bruto_produtos_servicos,2,',','.'); ?></strong></td>
    <td align="center" bgcolor="#666600"><strong>R$ <? echo number_format($lucro_bruto_produtos_servicos-$comissao-$descontos,2,',','.'); ?></strong></td>
    <td align="center" bgcolor="#666600"><strong><? echo number_format(($lucro_bruto_produtos_servicos*100)/$lucro_total_bruto,1); ?>%</strong></td>
  </tr>
  <tr>
    <td bgcolor="#666666"><strong>Recarga de TV</strong></td>
    <td align="center" bgcolor="#666666"><strong>R$ <? echo number_format($fate_tv,2,',','.'); ?></strong></td>
    <td align="center" bgcolor="#666666"><strong>R$ <? echo number_format($recarga_tv,2,',','.'); ?></strong></td>
    <td align="center" bgcolor="#666666"><strong>R$ <? echo number_format($recarga_tv*0.90,2,',','.'); ?></strong></td>
    <td align="center" bgcolor="#666666"><strong><? echo number_format(($recarga_tv*100)/$lucro_total_bruto,1); ?>%</strong></td>
  </tr>
  <tr>
    <td bgcolor="#666600"><strong>Recarga de Celular Pré-pago</strong></td>
    <td align="center" bgcolor="#666600"><strong>R$ <? echo number_format($fate_prepago,2,',','.'); ?></strong></td>
    <td align="center" bgcolor="#666600"><strong>R$ <? echo number_format($recarga_celular_prepago,2,',','.'); ?></strong></td>
    <td align="center" bgcolor="#666600"><strong>R$ <? echo number_format($recarga_celular_prepago*0.90,2,',','.'); ?></strong></td>
    <td align="center" bgcolor="#666600"><strong><? echo number_format(($recarga_celular_prepago*100)/$lucro_total_bruto,1); ?>%</strong></td>
  </tr>
  <tr>
    <td bgcolor="#666666"><strong>Gift Card</strong></td>
    <td align="center" bgcolor="#666666"><strong>R$ <? echo number_format($fate_gift_card,2,',','.'); ?></strong></td>
    <td align="center" bgcolor="#666666"><strong>R$ <? echo number_format($gift_card,2,',','.'); ?></strong></td>
    <td align="center" bgcolor="#666666"><strong>R$ <? echo number_format($gift_card*0.90,2,',','.'); ?></strong></td>
    <td align="center" bgcolor="#666666"><strong><? echo number_format(($gift_card*100)/$lucro_total_bruto,1); ?>%</strong></td>
  </tr>
  <tr>
    <td bgcolor="#666600"><strong>Saques</strong></td>
    <td align="center" bgcolor="#666600"><strong>R$ <? echo number_format($fate_saques,2,',','.'); ?></strong></td>
    <td align="center" bgcolor="#666600"><strong>R$ <? echo number_format($saques,2,',','.'); ?></strong></td>
    <td align="center" bgcolor="#666600"><strong>R$ <? echo number_format($saques*0.90,2,',','.'); ?></strong></td>
    <td align="center" bgcolor="#666600"><strong><? echo number_format(($saques*100)/$lucro_total_bruto,1); ?>%</strong></td>
  </tr>
  <tr>
    <td bgcolor="#666666"><strong>Empréstimos</strong></td>
    <td align="center" bgcolor="#666666"><strong>R$ <? echo number_format($fate_emprestimo,2,',','.'); ?></strong></td>
    <td align="center" bgcolor="#666666"><strong>R$ <? echo number_format($emprestimos,2,',','.'); ?></strong></td>
    <td align="center" bgcolor="#666666"><strong>R$ <? echo number_format($emprestimos*0.90,2,',','.'); ?></strong></td>
    <td align="center" bgcolor="#666666"><strong><? echo number_format(($emprestimos*100)/$lucro_total_bruto,1); ?>%</strong></td>
  </tr>
  <tr>
    <td bgcolor="#666600"><strong>TED</strong></td>
    <td align="center" bgcolor="#666600"><strong>R$ <? echo number_format($fate_ted,2,',','.'); ?></strong></td>
    <td align="center" bgcolor="#666600"><strong>R$ <? echo number_format($ted,2,',','.'); ?></strong></td>
    <td align="center" bgcolor="#666600"><strong>R$ <? echo number_format($ted*0.90,2,',','.'); ?></strong></td>
    <td align="center" bgcolor="#666600"><strong><? echo number_format(($ted*100)/$lucro_total_bruto,1); ?>%</strong></td>
  </tr>
  <tr>
    <td bgcolor="#666666"><strong>Auxilio emergencial</strong></td>
    <td align="center" bgcolor="#666666">R$ <? echo number_format($soma_auxilio,2,',','.'); ?></td>
    <td align="center" bgcolor="#666666">R$ <? echo mysqli_num_rows($sql_auxilio); ?></td>
    <td align="center" bgcolor="#666666">R$</td>
    <td align="center" bgcolor="#666666">R$</td>
  </tr>
  <tr>
    <td height="30" class="td">&nbsp;</td>
    <td align="center" bgcolor="#666600"><strong>R$ <? echo number_format($fate_ted+$fate_pag+$produtos_e_servicos+$fate_prepago+$fate_gift_card+$fate_saques+$fate_emprestimo,2,',','.'); ?></strong></td>
    <td align="center" bgcolor="#666600"><strong>R$ <? echo number_format($pagamento_de_contas+$lucro_bruto_produtos_servicos+$recarga_tv+$recarga_celular_prepago+$gift_card+$saques+$emprestimos+$ted,2,',','.'); ?></strong></td>
    <td align="center" bgcolor="#666600"><strong>R$ <? echo number_format(($pagamento_de_contas*0.95)+($lucro_bruto_produtos_servicos-$comissao-$descontos)+($recarga_tv*0.90)+($recarga_celular_prepago*0.90)+($gift_card*0.90)+($saques*0.90)+($emprestimos*0.90)+($ted*0.90),2,',','.'); ?></strong></td>
    <td align="center" bgcolor="#666600"><strong>100%</strong></td>
  </tr>
 </table>
 
  <?
 
      	$pagamentoAVista = 0;
     	$pagamentoAPrazo = 0;
		$totalVendas = 0;
		
		$credito = 0;
		$debito = 0;
		$transferencia = 0;
		$vpcard = 0;
		$m12 = 0;
		$dinheiro = 0;
		$descontos = 0;

		$sqlAVista = 0;
		
		if($ano_filtro != '' && $mes_filtro != '' && $dia_filtro != ''){
			$sqlAVista = "SELECT * FROM pagamento_carrinho WHERE dia = '".$_GET['dia_filtro']."' AND mes = '".$_GET['mes_filtro']."' AND ano = '".$_GET['ano_filtro']."' AND status = 'Encerrado'";
		}elseif($ano_filtro != '' && $mes_filtro != '' && $dia_filtro == ''){
			$sqlAVista = "SELECT * FROM pagamento_carrinho WHERE mes = '".$_GET['mes_filtro']."' AND ano = '".$_GET['ano_filtro']."' AND status = 'Encerrado'";
		}else{
			$sqlAVista = "SELECT * FROM pagamento_carrinho WHERE ano = '".$_GET['ano_filtro']."' AND status = 'Encerrado'";
		}

		
		$query = mysqli_query($conexao_bd, $sqlAVista);
			while($resCaixa = mysqli_fetch_array($query)){
								
				if($resCaixa['valor_fornecido'] > 0){
						$totalVendas +=$resCaixa['valor_fornecido'];
					}else{
						$totalVendas +=$resCaixa['valor_total'];
					}
				
				
			  if($resCaixa['form_pag'] == 'EASY CARD' || $resCaixa['form_pag'] == 'VESTE PRIME'){
					$vpcard +=$resCaixa['valor_total'];
					
			  }elseif($resCaixa['form_pag'] == 'M12'){
					$m12 +=$resCaixa['valor_total'];
					
			  }elseif($resCaixa['form_pag'] == 'TRANSFERENCIA'){
					$transferencia +=$resCaixa['valor_total'];
					
			  }elseif($resCaixa['form_pag'] == 'CARTÃO DE DÉBITO'){
					$debito +=$resCaixa['valor_total'];
					
			  }elseif($resCaixa['form_pag'] == 'CARTÃO DE CRÉDITO'){
					$credito +=$resCaixa['valor_total'];
					
			  }elseif($resCaixa['form_pag'] == 'DINHEIRO'){
		
					if($resCaixa['valor_fornecido'] > 0){
						$dinheiro +=$resCaixa['valor_fornecido'];
					}else{
						$dinheiro +=$resCaixa['valor_total'];
					}
				  
					
			  
			  }elseif($resCaixa['form_pag'] == 'DESCONTO LOJA'){
					$descontos +=$resCaixa['valor_total'];
			  }
		   }
 	
	function totalVendas(){
		return ($totalVendas-$descontos);
	}
	
	function lucroVendas(){
		return ($totalVendas-$descontos-$valor_compras_produtos_e_servicos-($totalVendas*0.01)-($vpcard+$m12));
	}
 
 
 ?>
 	<table width="1000" style="margin:10px 0 10px 0;" border="1">
      <tr>
        <td colspan="10" align="center" bgcolor="#666600"><h4 style="font:15px; padding:5px; margin:0;"><strong>RELATÓRIO DE VENDAS DE PRODUTOS/SERVI&Ccedil;OS POR PER&Iacute;ODO SELECIONADO</strong></h4></td>
      </tr>
      <tr>
        <td width="86" rowspan="3" align="center" bgcolor="#336600"><strong>TOTAL</strong><br /><br />R$ <? echo number_format($totalVendas, 2, ',','.'); ?></td>
        <td width="90" bgcolor="#6699CC" align="center"><strong>CRÉDITO</strong></td>
        <td width="94" bgcolor="#6699CC" align="center"><strong>DÉBITO</strong></td>
        <td width="102" bgcolor="#6699CC" align="center"><strong>TRANSFERÊNCIA</strong></td>
        <td width="91" bgcolor="#6699CC" align="center"><strong>DINHEIRO</strong></td>
        <td width="90" bgcolor="#6699CC" align="center"><strong>VP CARD</strong></td>
        <td width="84" bgcolor="#6699CC" align="center"><strong>M12</strong></td>
        <td width="83" bgcolor="#6699CC" align="center"><strong>A VISTA</strong></td>
        <td width="127" align="center" bgcolor="#6699CC"><strong>PRAZO</strong></td>
        <td width="89" rowspan="5" align="center" bgcolor="#336600"><strong>LUCRO CONFIRMADO</strong><br /><br />R$ <? echo number_format($totalVendas-$descontos-$valor_compras_produtos_e_servicos-($totalVendas*0.01)-($vpcard+$m12), 2, ',','.'); ?></td>
      </tr>
      <tr>
        <td align="center">R$ <? echo number_format($credito, 2, ',','.'); ?></td>
        <td align="center">R$ <? echo number_format($debito, 2, ',','.'); ?></td>
        <td align="center">R$ <? echo number_format($transferencia, 2, ',','.'); ?></td>
        <td align="center">R$ <? echo number_format($dinheiro, 2, ',','.'); ?></td>
        <td align="center">R$ <? echo number_format($vpcard, 2, ',','.'); ?></td>
        <td align="center">R$ <? echo number_format($m12, 2, ',','.'); ?></td>
        <td align="center">R$ <? echo number_format(($credito+$debito+$transferencia+$dinheiro), 2, ',','.'); ?></td>
        <td align="center">R$ <? echo number_format(($vpcard+$m12), 2, ',','.'); ?></td>
      </tr>
      <tr>
        <td align="center"><? echo number_format((100*$credito)/$totalVendas,2,',','.'); ?>%</td>
        <td align="center"><? echo number_format((100*$debito)/$totalVendas,2,',','.'); ?>%</td>
        <td align="center"><? echo number_format((100*$transferencia)/$totalVendas,2,',','.'); ?>%</td>
        <td align="center"><? echo number_format((100*$dinheiro)/$totalVendas,2,',','.'); ?>%</td>
        <td align="center"><? echo number_format((100*$vpcard)/$totalVendas,2,',','.'); ?>%</td>
        <td align="center"><? echo number_format((100*$m12)/$totalVendas,2,',','.'); ?>%</td>
        <td align="center" bgcolor="#009900"><strong><? echo number_format((100*($credito+$debito+$transferencia+$dinheiro))/$totalVendas,2,',','.'); ?>%</strong></td>
        <td align="center" bgcolor="#990000"><strong><? echo number_format((100*($vpcard+$m12))/$totalVendas,2,',','.'); ?>%</strong></td>
      </tr>
      <tr>
        <td colspan="2" align="center" bgcolor="#006699"><strong>FATURAMENTO</strong></td>
        <td colspan="2" align="center" bgcolor="#006699"><strong>DESCONTOS </strong></td>
        <td colspan="2" align="center" bgcolor="#006699"><strong>DESPESAS</strong></td>
        <td colspan="2" align="center" bgcolor="#006699"><strong>COMISS&Otilde;ES</strong></td>
        <td align="center" bgcolor="#006699"><strong>LUCRO PREVISTO</strong></td>
      </tr>
      <tr>
        <td colspan="2" align="center">R$ <? echo number_format($totalVendas, 2, ',','.'); ?></td>
        <td colspan="2" align="center">R$ <? echo number_format($descontos, 2, ',','.'); ?></td>
        <td colspan="2" align="center">R$ <? echo number_format($valor_compras_produtos_e_servicos, 2, ',','.'); ?></td>
        <td colspan="2" align="center">R$ <? echo number_format($totalVendas*0.01, 2, ',','.'); ?></td>
        <td align="center">R$ <? echo number_format($totalVendas-$descontos-$valor_compras_produtos_e_servicos-($totalVendas*0.01), 2, ',','.'); ?></td>
      </tr>
      <tr>
        <td colspan="10" align="center"><table width="990" border="1">
          <tr>
            <td colspan="8" bgcolor="#333366" align="center"><h2><strong>VIS&Atilde;O GERAL DE ESTOQUE</strong></h2></td>
            </tr>
          <tr>
            <td colspan="2" align="center" bgcolor="#6699CC"><h3 style="margin:2px; padding:2px;"><strong>ESTOQUE TOTAL</strong></h3></td>
            <td colspan="2" align="center" bgcolor="#6699CC"><h3 style="margin:2px; padding:2px;"><strong>PERDAS TOTAIS</strong></h3></td>
            <td colspan="2" align="center" bgcolor="#990000"><h3 style="margin:2px; padding:2px;"><strong>PREVIS&Atilde;O DE FATURAMENTO TOTAL</strong></h3></td>
            <td colspan="2" align="center" bgcolor="#663399"><h3 style="margin:2px; padding:2px;"><strong>PREVIS&Atilde;O DE LUCRO TOTAL</strong></h3></td>
            </tr>
          <tr>
            <td colspan="2" align="center" bgcolor="#336666"><h2 style="margin:2px; padding:2px;"><strong>R$ <? echo number_format($produtosEmEstoque,2,',','.'); ?></strong></h2></td>
            <td colspan="2" align="center" bgcolor="#6699CC">&nbsp;</td>
            <td colspan="2" align="center" bgcolor="#990000"><h2 style="margin:2px; padding:2px;"><strong>R$ <? echo number_format($previsaoFaturamento,2,',','.'); ?></strong></h2></td>
            <td colspan="2" align="center" bgcolor="#663399"><h2 style="margin:2px; padding:2px;"><strong>R$ <? echo number_format($previsaoFaturamento-$produtosEmEstoque,2,',','.'); ?></strong></h2></td>
          </tr>
          <tr>
            <td width="123" align="center" bgcolor="#336666"><strong>ATIVO</strong></td>
            <td width="124" align="center" bgcolor="#336666"><strong>PASSIVO</strong></td>
            <td width="99" align="center" bgcolor="#6699CC"><strong>ATIVO</strong></td>
            <td width="97" align="center" bgcolor="#6699CC"><strong>PASSIVO</strong></td>
            <td width="149" align="center" bgcolor="#990000"><strong>ATIVO</strong></td>
            <td width="132" align="center" bgcolor="#990000"><strong>PASSIVO</strong></td>
            <td width="100" align="center" bgcolor="#663399"><strong>ATIVO</strong></td>
            <td width="114" align="center" bgcolor="#663399"><strong>PASSIVO</strong></td>
          </tr>
          <tr>
            <td height="30" align="center" bgcolor="#336666">R$ <? echo number_format($produtosAtivo,2,',','.'); ?></td>
            <td align="center" bgcolor="#336666">R$ <? echo number_format($produtosPassivo,2,',','.'); ?></td>
            <td align="center" bgcolor="#6699CC">&nbsp;</td>
            <td align="center" bgcolor="#6699CC">&nbsp;</td>
            <td align="center" bgcolor="#990000">R$ <? echo number_format($previsaoFaturamentoAtivo,2,',','.'); ?></td>
            <td align="center" bgcolor="#990000">R$ <? echo number_format($previsaoFaturamentoPassivo,2,',','.'); ?></td>
            <td align="center" bgcolor="#663399">R$ <? echo number_format($previsaoFaturamentoAtivo-$produtosAtivo,2,',','.'); ?></td>
            <td align="center" bgcolor="#663399">R$ <? echo number_format($previsaoFaturamentoPassivo-$produtosPassivo,2,',','.'); ?></td>
          </tr>
        </table></td>
      </tr>
    </table>
	
   <div class="graficos">
   	
     <div class="graficoPizza" style="width:50%">
          <canvas id="myLineChart" width="400" height="200"></canvas
            ><script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Dados do gráfico
                    var data = {
                        labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio'],
                        datasets: [{
                            label: 'Vendas Mensais',
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1,
                            data: [65, 59, 80, 81, 56]
                        }]
                    };
            
                    // Opções do gráfico
                    var options = {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    };
            
                    // Configurações do gráfico
                    var config = { 
                        type: 'line',
                        data: data,
                        options: options
                    };
            
                    // Criar o gráfico
                    var myLineChart = new Chart(document.getElementById('myLineChart'), config);
                });
            </script>

 
     </div>
     
     <div class="graficoLinha" style="width:50%">
     	
        <canvas id="myPieChart" width="100" height="100"></canvas>
		
        	<script>
            document.addEventListener('DOMContentLoaded', function() {
                // Dados do gráfico de pizza
                var data = {
                    labels: ['Categoria A', 'Categoria B', 'Categoria C'],
                    datasets: [{
                        data: [30, 50, 20],
                        backgroundColor: ['rgb(255, 99, 132)', 'rgb(75, 192, 192)', 'rgb(255, 205, 86)'],
                    }]
                };
    
                // Configurações do gráfico de pizza
                var config = {
                    type: 'pie',
                    data: data,
                };
    
                // Criar o gráfico de pizza
                var myPieChart = new Chart(document.getElementById('myPieChart').getContext('2d'), config);
            });
          </script>

     </div>
 
   </div>
 
 </div><!-- descricao_faturamento -->
 
</div><!-- box_pagamento_1 -->
</body>
</html>

<? /*
$data_venda = 0;
$sql_produto = mysqli_query($conexao_bd, "SELECT * FROM produtos_caixa");
while($res_produto = mysqli_fetch_array($sql_produto)){
	
	$data_venda = $res_produto['data'];
	
	$dia1 = $data_venda[0];$dia2 = $data_venda[1]; $dia = "$dia1$dia2";
	$mes1 = $data_venda[3];$mes2 = $data_venda[4]; $mes = "$mes1$mes2";
	$ano1 = $data_venda[6];$ano2 = $data_venda[7]; $ano3 = $data_venda[8]; $ano4 = $data_venda[9]; $ano = "$ano1$ano2$ano3$ano4";
	
	mysqli_query($conexao_bd, "UPDATE produtos_caixa SET dia = '$dia', mes = '$mes', ano = '$ano' WHERE id = '".$res_produto['id']."'");
	
}

*/
?>
