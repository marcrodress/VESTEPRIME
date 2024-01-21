<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/abre_pagamento.css" rel="stylesheet" type="text/css" />
</head>

<body>
<? require "../conexao.php"; ?>
<div id="box">
<h1><strong>Histórico de pagamento</strong></h1>
<?

$busca_pagamento = mysqli_query($conexao_bd, "SELECT * FROM pagamento_carrinho WHERE code_carrinho = '".$_GET['code_carrinho']."'");
if(mysqli_num_rows($busca_pagamento) == ''){
	echo "Não foi encontrado nenhum pagamento para este carrinnho.";
}else{

?>
<table width="700" border="0">
  <tr>
    <td align="center" width="58" bgcolor="#999999"><strong>VALOR</strong></td>
    <td align="center" width="179" bgcolor="#999999"><strong>FOR. DE PAGT.</strong></td>
    <td align="center" width="109" bgcolor="#999999"><strong>CART&Atilde;O</strong></td>
    <td align="center" width="85" bgcolor="#999999"><strong>PARCELAS</strong></td>
    <td align="center" width="91" bgcolor="#999999"><strong>vL. PARCELA</strong></td>
    <td align="center" width="99" bgcolor="#999999"><strong>VL. TOTAL</strong></td>
    <td width="49" bgcolor="#999999">&nbsp;</td>
  </tr>
  <? while($res_busca_pagamento = mysqli_fetch_array($busca_pagamento)){ ?>
  <tr>
    <td align="center">R$ <? echo @number_format($res_busca_pagamento['valor_total'],2); ?></td>
    <td align="center"><? echo @$res_busca_pagamento['form_pag']; ?></td>
    <td align="center"><? echo @$res_busca_pagamento['cartao']; ?></td>
    <td align="center"><? echo @$res_busca_pagamento['parcelas']; ?></td>
    <td align="center">R$ <? echo @number_format($res_busca_pagamento['valor_parcela'],2); ?></td>
    <td align="center">R$ <? echo @number_format($res_busca_pagamento['parcelas']*$res_busca_pagamento['valor_parcela'],2); ?></td>
    <td align="center">
   
    <?
    
	$valor_total = 0;
	if($res_busca_pagamento['form_pag'] == 'EASY CARD'){
		$valor_total = $res_busca_pagamento['parcelas']*$res_busca_pagamento['valor_parcela'];
	}else{
		$valor_total = $res_busca_pagamento['valor_total'];
	}
	
	?>
    
    <a href="?code_carrinho=<? echo @$_GET['code_carrinho']; ?>&cliente=<? echo $res_busca_pagamento['cliente']; ?>&valor_total=<? echo number_format($valor_total,2); ?>&forma_pag=<? echo base64_encode($res_busca_pagamento['form_pag']); ?>&id=<? echo $res_busca_pagamento['id']; ?>&sit_pag=excluir">
    
    <img src="../img/deleta.jpg" width="18" height="18" border="0"></a></td>
  </tr>
  <tr>
    <td colspan="7"><hr /></td>
    </tr>
  <? } ?>
</table>
<? } ?>

<? if($_GET['sit_pag'] == 'excluir'){

$forma_pag = base64_decode($_GET['forma_pag']);
$code_carrinho = $_GET['code_carrinho'];
$valor_total = $_GET['valor_total'];
$cliente = $_GET['cliente'];

if($forma_pag == 'DÉBITO EM CONTA'){
	
	mysqli_query($conexao_bd, "DELETE FROM fluxo_de_caixa WHERE code_carrinho = '$code_carrinho' AND forma_recebimento = 'DÉBITO EM CONTA'");
	
	$sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente WHERE cliente = '$cliente'");
		while($res_cliente = mysqli_fetch_array($sql_cliente)){
					
		$saldo = $res_cliente['saldo'];	
		$cheque_especial = $res_cliente['cheque_especial'];	
		$disponivel_cheque_especial = $res_cliente['disponivel_cheque_especial'];
		
			if($disponivel_cheque_especial < $cheque_especial){
				
				$valor_uso_cheque_especial = $cheque_especial-$disponivel_cheque_especial; 
				if($valor_uso_cheque_especial <0){
					$valor_uso_cheque_especial = -($valor_uso_cheque_especial);
				}else{
					$valor_uso_cheque_especial = $valor_uso_cheque_especial;
				}
				$saldo_vai_para_conta = $valor_total-$valor_uso_cheque_especial; 
				
				$devolver_valor_cheque_especial = ($valor_total-$saldo_vai_para_conta)+$disponivel_cheque_especial;
				
				$novo_saldo = $saldo+$valor_total;
				
				mysqli_query($conexao_bd, "UPDATE conta_corrente SET disponivel_cheque_especial = '$devolver_valor_cheque_especial', saldo = '$novo_saldo' WHERE cliente = '$cliente'");
				mysqli_query($conexao_bd, "DELETE FROM pagamento_carrinho WHERE id = '".$_GET['id']."'");
				
				echo "<script language='javascript'>window.location='?code_carrinho=$code_carrinho';</script>";

				
			}else{
				
				$novo_saldo = $valor_total+$saldo;
				mysqli_query($conexao_bd, "UPDATE conta_corrente SET saldo = '$novo_saldo' WHERE cliente = '$cliente'");
				mysqli_query($conexao_bd, "DELETE FROM pagamento_carrinho WHERE id = '".$_GET['id']."'");
				echo "<script language='javascript'>window.location='?code_carrinho=$code_carrinho';</script>";
			
				
			}
		
		}
		
}elseif($forma_pag == 'EASY CARD'){

	$lancamento_fatura = mysqli_query($conexao_bd, "SELECT * FROM lancamento_fatura WHERE code_carrinho = '$code_carrinho'");
		while($res_lancamento_fatura = mysqli_fetch_array($lancamento_fatura)){
			 	

				$code_transacao = $res_lancamento_fatura['code_transacao'];
				
				mysqli_query($conexao_bd, "DELETE FROM compras_parceladas WHERE code_transacao = '$code_transacao'");
				mysqli_query($conexao_bd, "DELETE FROM lancamento_fatura WHERE code_transacao = '$code_transacao'");
				mysqli_query($conexao_bd, "DELETE FROM pagamento_carrinho WHERE id = '".$_GET['id']."'");
				
				
				$sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente WHERE cliente = '$cliente'");
				while($res_cliente = mysqli_fetch_array($sql_cliente)){
					
					$limite_loja_disponivel = $res_cliente['limite_loja_disponivel'];
					
					$muda_limite = $valor_total+$limite_loja_disponivel;
					
					mysqli_query($conexao_bd, "UPDATE conta_corrente SET limite_loja_disponivel = '$muda_limite' WHERE cliente = '$cliente'");
					
				}
				
				
				
				
				
				echo "<script language='javascript'>window.location='?code_carrinho=$code_carrinho';</script>";
			}
	
		
}else{
	mysqli_query($conexao_bd, "DELETE FROM pagamento_carrinho WHERE id = '".$_GET['id']."'");
	mysqli_query($conexao_bd, "DELETE FROM fluxo_de_caixa WHERE code_carrinho = '$code_carrinho' AND forma_recebimento = '$forma_pag'");
	
	echo "<script language='javascript'>window.location='?code_carrinho=$code_carrinho';</script>";
		
 }
}?>
</div><!-- box -->
</body>
</html>