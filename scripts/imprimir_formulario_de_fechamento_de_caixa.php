<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>FORMULÁRIO DE FECHAMENTO DE CAIXA</title>
<link href="css/imprimir_formulario_de_fechamento_de_caixa.css" rel="stylesheet" type="text/css" />

</head>

<body>

<div id="box">
<table width="1000" border="0">
  <tr>
    <td width="134"><img src="../img/index.png" width="134" height="95" /></td>
    <td width="445" colspan="2" align="center" bgcolor="#CCCCCC"><strong><h2 style="font-weight:bold;">FORMUL&Aacute;RIO DE FECHAMENTO DE CAIXA</h2></strong></td>
  </tr>
</table>


<?
require "../config.php";
$soma_caixa_inicial = 0;
$id_do_caixa = 0;

$data = $_GET['data'];
$operador = $_GET['operador'];

$sql_abertura = mysqli_query($conexao_bd, "SELECT * FROM abertura_de_caixa WHERE operador = '$operador' AND data = '$data'");
 while($res_abertura = mysqli_fetch_array($sql_abertura)){
	 
$id_do_caixa =  $res_abertura['id'];
	 
$soma_caixa_inicial = $res_abertura['valor_caixa']+$soma_caixa_inicial;
	 
?>
<table width="1000" border="0">
  <tr>
    <td align="center" colspan="6"><strong>OPERADOR: <? echo strtoupper($nome); ?>  <br />DATA DE ABERTURA: <? echo $res_abertura['dada_completa']; ?></strong></td>
  </tr>
  <tr>
    <td><strong>NOTAS DE r$ 200,00</strong></td>
    <td><strong>NOTAS DE R$ 100,00</strong></td>
    <td><strong>NOTAS DE R$ 50,00</strong></td>
    <td><strong>NOTAS DE R$ 20,00</strong></td>
    <td><strong>NOTAS DE R$ 10,00</strong></td>
    <td><strong>NOTAS DE R$ 5,00</strong></td>
  </tr>
  <tr>
    <td>R$ <? echo number_format($res_abertura['bb']*200, 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($res_abertura['notas100']*100, 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($res_abertura['notas50']*50, 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($res_abertura['notas20']*20, 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($res_abertura['notas10']*10, 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($res_abertura['notas5']*5, 2, ',', '.'); ?></td>
  </tr>
  <tr>
    <td><strong>NOTAS DE R$ 2,00</strong></td>
    <td><strong>MOEDAS DE R$ 1,00</strong></td>
    <td><strong>MOEDAS DE R$ 0,50</strong></td>
    <td><strong>MOEDAS DE R$ 0,25</strong></td>
    <td><strong>MOEDAS DE R$ 0,10</strong></td>
    <td><strong>MOEDAS DE 0,05</strong></td>
  </tr>
  <tr>
    <td>R$ <? echo number_format($res_abertura['notas2']*2, 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($res_abertura['moeda1']*1, 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($res_abertura['moeda50']*0.5, 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($res_abertura['moeda25']*0.25, 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($res_abertura['moeda10']*0.1, 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($res_abertura['moeda5']*0.05, 2, ',', '.'); ?></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#FFEADF" colspan="6"><strong>DINHEIRO INICIAL EM CAIXA</strong> <br />R$ 
      <? 
	
	$caixa_inicial = ($res_abertura['bb']*200)+($res_abertura['notas100']*100)+($res_abertura['notas50']*50)+($res_abertura['notas20']*20)+($res_abertura['notas10']*10)+($res_abertura['notas5']*5)+($res_abertura['notas2']*2)+($res_abertura['moeda1']*1)+($res_abertura['moeda50']*0.5)+($res_abertura['moeda25']*0.25)+($res_abertura['moeda10']*0.1)+($res_abertura['moeda5']*0.05);
	
	echo number_format($caixa_inicial, 2, ',', '.'); 
	
	?></td>
  </tr>
</table>
<? } ?>

<h2><strong>1º Fechamento de pagamentos de títulos e convênio</strong></h2>
<?
$valor_dinheiro = 0;
$valor_cartao_debito = 0;
$valor_cartao_credito = 0;
$valor_vesteprime = 0;
$valor_vale_transporte = 0;
$valor_qrcode = 0;
$total = 0;
$code_boleto = 0;
$pagamentosM12 = 0 ;

$pagamentoDebitoTotalTransacao = 0;
$pagamentoCreditoTotalTransacao = 0;

$sql_boletos = mysqli_query($conexao_bd, "SELECT * FROM pagamentoboletos WHERE operador = '$operador' AND data = '$data'");
while($res_boletos = mysqli_fetch_array($sql_boletos)){
	
	$code_boleto = $res_boletos['code_boleto'];
	
  if($res_boletos['status'] != 'CANCELADO'){
	  $total++;
   
   $sql_busca_pagamentos = mysqli_query($conexao_bd, "SELECT * FROM pagamento_boletos_opcoes WHERE code_boleto = '$code_boleto'");
   	while($res_pagamento = mysqli_fetch_array($sql_busca_pagamentos)){ 
	  
	if($res_pagamento['forma_pagamento'] == 'CARTAO DE CREDITO'){
	$valor_cartao_credito = $res_pagamento['valor']+$valor_cartao_credito;
	$pagamentoCreditoTotalTransacao = $res_pagamento['valor_transacao']+$pagamentoCreditoTotalTransacao;
	
	}elseif($res_pagamento['forma_pagamento'] == 'VESTE PRIME'){
	$valor_vesteprime = $res_pagamento['valor_transacao']+$valor_vesteprime;
	}elseif($res_pagamento['forma_pagamento'] == 'DINHEIRO'){
	$valor_dinheiro += $res_pagamento['valor_transacao'];
	}elseif($res_pagamento['forma_pagamento'] == 'VALE ALIMENTACAO'){
	$valor_vale_transporte = $res_pagamento['valor']+$valor_vale_transporte;
		
	}elseif($res_pagamento['forma_pagamento'] == 'CARTAO DE DEBITO'){
	$valor_cartao_debito = $res_pagamento['valor']+$valor_cartao_debito;
	$pagamentoDebitoTotalTransacao = $res_pagamento['valor_transacao']+$pagamentoDebitoTotalTransacao;
	
	}elseif($res_pagamento['forma_pagamento'] == 'TRANSFERENCIA'){
	$valor_transferencia = $res_pagamento['valor']+$valor_transferencia;
	}elseif($res_pagamento['forma_pagamento'] == 'M12'){
	$pagamentosM12 = $res_pagamento['valor']+$pagamentosM12;
	}
   }
 } // fecha o while
}
?>
<table width="1000" class="table" border="0">
  <tr>
    <td colspan="6" bgcolor="#CCCCCC"><strong>Foram recebidos <? echo $total; ?> titulos para pagamento</strong></td>
  </tr>
  <tr>
    <td align="center" width="166"><strong>Dinheiro</strong></td>
    <td width="179" align="center"><strong>Cartão de débito</strong></td>
    <td width="149" align="center"><strong>Cartão de crédito</strong></td>
    <td width="165" align="center"><strong>Veste Prime Card</strong></td>
    <td width="176" align="center"><strong>TRANSFER&Ecirc;NCIA</strong></td>
    <td width="139" align="center"><strong>M12</strong></td>
  </tr>
  <tr>
    <td align="center">R$ <? echo number_format($valor_dinheiro, 2, ',', '.'); ?></td>
    <td align="center">R$ <? echo number_format($valor_cartao_debito, 2, ',', '.'); ?></td>
    <td align="center">R$ <? echo number_format($valor_cartao_credito, 2, ',', '.'); ?></td>
    <td align="center">R$ <? echo number_format($valor_vesteprime, 2, ',', '.'); ?></td>
    <td align="center">R$ <? echo number_format($valor_transferencia, 2, ',', '.'); ?></td>
    <td align="center">R$ <? echo number_format($pagamentosM12, 2, ',', '.'); ?></td>
  </tr>
  <tr>
    <td colspan="6" align="center"><table class="table" width="990" border="0">
      <tr>
        <td align="center" width="126" style="padding:2px;" bgcolor="#66CC00"><strong>DATA</strong></td>
        <td align="center" width="31" style="padding:2px;" bgcolor="#66CC00"><strong>TIPO</strong></td>
        <td align="center" width="75" style="padding:2px;" bgcolor="#66CC00"><strong>EFETIVA&Ccedil;&Atilde;O</strong></td>
        <td width="59" align="center" style="padding:2px;" bgcolor="#66CC00"><strong>EMISSOR</strong></td>
        <td bgcolor="#66CC00" style="padding:2px;" align="center"><strong>C&Oacute;DIGO DE BARRAS</strong></td>
        <td bgcolor="#66CC00" style="padding:2px;" align="center"><strong>VALOR</strong></td>
        <td align="center" style="padding:2px;" bgcolor="#66CC00"><strong>JUROS</strong></td>
        <td width="80" style="padding:2px;" align="center" bgcolor="#66CC00"><strong>TAXAS</strong></td>
        <td colspan="2" style="padding:2px;" align="center" bgcolor="#66CC00"><strong>TOTAL</strong></td>
        </tr>
      <?
      $code_boleto = 0;  $i = 0;
	  $puxa_faturas = mysqli_query($conexao_bd, "SELECT * FROM pagamentoboletos WHERE data = '$data' AND status != 'CANCELADO' AND operador = '$operador'");
	  	while($res_fatura = mysqli_fetch_array($puxa_faturas)){
	  			$code_boleto = $res_fatura['code_boleto']; 
	  ?>
    
      <tr style="border:1px solid #CCC;" <? if($j%2 == 0){ echo "bgcolor='#CCCCCC'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
        <td style="padding:1px; border:1px solid #CCC;" align="center" ><? echo $res_fatura['data_completa']; ?></td>
        <td style="padding:1px; border:1px solid #CCC;" align="center" ><? echo $res_fatura['tipo']; ?></td>
        <td style="padding:1px; border:1px solid #CCC;" align="center" ><? echo $res_fatura['status']; ?></td>
        <td style="padding:1px; border:1px solid #CCC; font-size:11px;"" align="center" ><? 
		
			$banco = $res_fatura['banco'];
			$contaEspaco = 0;
			
			 for($i=0; $i<=strlen($banco); $i++){
				 if($contaEspaco <=2){
					 
					 if($banco[$i] == ' '){
						 $contaEspaco++;
					 }
					 
					 echo $banco[$i];
				 }
			}
		
		?></td>
        <td style="padding:1px; font-size:11px;" align="center" width="322"><? echo $res_fatura['code_barras']; ?></td>
        <td style="padding:1px;" align="center" width="85">R$ <? echo number_format($res_fatura['valor'], 2, ',', '.'); ?></td>
        <td style="padding:1px;" align="center" width="66">R$ <? echo number_format($res_fatura['juros'], 2, ',', '.'); ?></td>
        <td style="padding:1px;" align="center" >R$ <?  $tarifas = $res_fatura['tarifa_recebimento']+$res_fatura['boleto_vencido']+$res_fatura['boleto_impresso']+$res_fatura['boleto_tarifado']; echo number_format($tarifas, 2, ',', '.'); ?></td>
        <td align="center" colspan="2">R$ <? echo number_format($tarifas+$res_fatura['juros']+$res_fatura['valor'], 2, ',', '.'); ?></td>
        </tr>
      <?
      $pagamento_opcoes = mysqli_query($conexao_bd, "SELECT * FROM pagamento_boletos_opcoes WHERE code_boleto = '$code_boleto'");
	  if(mysqli_num_rows($pagamento_opcoes) >=1){
	  ?>
      <tr style="border:1px solid #000;" >
        <td colspan="5" style="border:1px solid #FFF;">&nbsp;</td>
        <td style="padding:1px;" colspan="5" bgcolor="#BBFFBB"><strong>RESUMO DE PAGAMENTO</strong></td>
      </tr>
	  <?
	  	while($res_opcoes = mysqli_fetch_array($pagamento_opcoes)){ $j++;
      ?>
      <tr>
        <td colspan="5" style="border:1px solid #FFF;">&nbsp;</td>
        <td style="padding:1px;" colspan="4"><? echo $res_opcoes['forma_pagamento']; ?></td>
        <td style="padding:1px;" width="107">R$ <? echo number_format($res_opcoes['valor_transacao'], 2, ',', '.'); ?></td>
      </tr>
      <? } ?>
	  <? }} ?>
    </table>
      </td>
   
    </tr>
</table>
<hr /><h2><strong>2º Fechamento de venda de produtos</strong></h2>
<?
$carrinho_dinheiro = 0;
$carrinho_cartao_debito = 0;
$carrinho_cartao_credito = 0;
$carrinho_vesteprime = 0;
$carrinho_transferencia = 0;
$total_produtos = 0;
$carrinhoM12 = 0;

$conta_produtos = mysqli_query($conexao_bd, "SELECT * FROM produtos_caixa WHERE data = '$data' AND operador = '$operador'");
	while($res_produtos = mysqli_fetch_array($conta_produtos)){
		$total_produtos = $res_produtos['quant']+$total_produtos;
	}


$sql_produtos = mysqli_query($conexao_bd, "SELECT * FROM pagamento_carrinho WHERE data = '$data' AND operador = '$operador'");
while($res_produtos = mysqli_fetch_array($sql_produtos)){
	if($res_produtos['form_pag'] == 'CARTÃO DE CRÉDITO'){
	$carrinho_cartao_credito = $res_produtos['valor_total']+$carrinho_cartao_credito;
	}elseif($res_produtos['form_pag'] == 'M12'){
	$carrinhoM12 = $res_produtos['valor_total']+$carrinhoM12;
	}elseif($res_produtos['form_pag'] == 'TRANSFERENCIA'){
	$carrinho_transferencia = $res_produtos['valor_total']+$carrinho_transferencia;
	}elseif($res_produtos['form_pag'] == 'VESTE PRIME'){
	$carrinho_vesteprime = ($res_produtos['quant_parcelas']*$res_produtos['valor_parcela'])+$carrinho_vesteprime;
	}elseif($res_produtos['form_pag'] == 'DINHEIRO'){
	  
	  if($res_produtos['troco'] == 0){
		$carrinho_dinheiro = $res_produtos['valor_total']+$carrinho_dinheiro;
	  }else{
		$carrinho_dinheiro = $res_produtos['valor_fornecido']+$carrinho_dinheiro;
	  }
	  
	}elseif($res_produtos['form_pag'] == 'CARTÃO DE DÉBITO'){
	$carrinho_cartao_debito = $res_produtos['valor_total']+$carrinho_cartao_debito;
	}
 } // fecha o while
?>
<table width="1000" border="0">
  <tr>
    <td colspan="6" bgcolor="#CCCCCC"><strong>DISTRIBUIÇÃO DA VENDA DE PROUTOS E/OU SERVIÇOS</strong><br />
     Foram vendidos <? echo $total_produtos; ?> produtos
    </td>
  </tr>
  <tr>
    <td width="163"><strong>DINHEIRO</strong></td>
    <td width="187"><strong>CARTÃO DE DÉBITO</strong></td>
    <td width="201"><strong>CARTÃO DE CRÉDITO</strong></td>
    <td width="139"><strong>VESTE PRIME CARD</strong></td>
    <td width="140"><strong>TRANSFER&Ecirc;NCIA</strong></td>
    <td width="147"><strong>M12</strong></td>
  </tr>
  <tr>
    <td>R$ <? echo number_format($carrinho_dinheiro, 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($carrinho_cartao_debito, 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($carrinho_cartao_credito, 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($carrinho_vesteprime, 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($carrinho_transferencia, 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($carrinhoM12, 2, ',', '.'); ?></td>
  </tr>
        <?
     $i = 0;
	 $carrinhos = mysqli_query($conexao_bd, "SELECT * FROM carrinho WHERE operador = '$operador' AND data = '$data' AND status = 'Encerrado'");
	 	while($res_carrinho = mysqli_fetch_array($carrinhos)){ $i++;
	 ?>  
  <tr>
    <td colspan="6"><table width="995" border="0">
    
      <tr>
        <td align="center" width="106" bgcolor="#66CC00"><strong>COD. CARRINHO</strong></td>
        <td align="center" width="119" bgcolor="#66CC00"><strong>CLIENTE</strong></td>
        <td colspan="6"  style="border:0px solid #FFF;" rowspan="2" align="center" bgcolor="#FFFFFF"><table style="border:0px solid #FFF;" width="752" border="0">
          <tr style="border:0px solid #FFF;">
            <td width="136" bgcolor="#00CC00"><strong>DATA</strong></td>
            <td width="98" bgcolor="#00CC00"><strong>COD.PRODUTO</strong></td>
            <td width="332" align="left" bgcolor="#00CC00"><strong>T&Iacute;TULO DO PRODUTO</strong></td>
            <td width="50" bgcolor="#00CC00"><strong>QUANT.</strong></td>
            <td width="50" bgcolor="#00CC00"><strong>VALOR</strong></td>
            <td width="60" bgcolor="#00CC00"><strong>TIPO</strong></td>
          </tr>

          <tr>
          <? 
	 
	 	$sqlPuxaPrdutos = mysqli_query($conexao_bd, "SELECT * FROM produtos_caixa WHERE code_carrinho = '".$res_carrinho['code_carrinho']."'"); 
         while($res_produto = mysqli_fetch_array($sqlPuxaPrdutos)){
	 
		  ?>
          
            <td><? echo $res_produto['data_completa']; ?></td>
            <td><? echo $res_produto['code_produto']; ?></td>
            <td align="left"><? 
				
				$sqlTituloProduto = mysqli_query($conexao_bd, "SELECT * FROM produtos WHERE code = '".$res_produto['code_produto']."'");
					 while($resTituloProduto = mysqli_fetch_array($sqlTituloProduto)){
						 echo $resTituloProduto['titulo_resumido'];
					}
				
			 ?></td>
            <td><? echo $res_produto['quant']; ?></td>
            <td><? echo number_format($res_produto['valor'],2,',','.'); ?></td>
            <td><? echo $res_produto['tipo']; ?></td>
          </tr>
      	  <? } ?>
          <tr>
            <td colspan="6"><table width="742" border="0">
              <tr>
                <td width="398" bgcolor="#FFFFFF" style="border:1px solid #FFF;">&nbsp;</td>
                <td width="209" bgcolor="#00CCFF"><strong>FORMA DE PAGAMENTO</strong></td>
                <td width="121" bgcolor="#00CCFF"><strong>VALOR</strong></td>
              </tr>
 				<?
                 
				 $sqlPagamentoCarrinho = mysqli_query($conexao_bd, "SELECT * FROM pagamento_carrinho WHERE code_carrinho = '".$res_carrinho['code_carrinho']."' AND valor_total >0 AND valor_total != 'f'");
					while($resPagamentoCarrinho = mysqli_fetch_array($sqlPagamentoCarrinho)){
				?>              
              <tr>
                <td bgcolor="#FFFFFF" style="border:1px solid #FFF;">&nbsp;</td>
               
                <td><? echo $resPagamentoCarrinho['form_pag']; ?></td>
                <td>R$ <? 
				
				if($resPagamentoCarrinho['form_pag'] == 'DINHEIRO'){
	  
				  if($resPagamentoCarrinho['troco'] == 0){
					echo number_format($resPagamentoCarrinho['valor_total'],2,',','.');
				  }else{
					echo number_format($resPagamentoCarrinho['valor_fornecido'],2,',','.');
				  }
				}else{
					echo number_format($resPagamentoCarrinho['valor_total'],2,',','.');
				}
				?></td>
              </tr>
                <? } ?>
            </table></td>
            </tr>
      
          
        </table>
        
        </td>
        </tr>
    
  	   <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
        <td align="center"><? echo $res_carrinho['code_carrinho']; ?></td>
        <td align="center"><? echo $res_carrinho['cliente']; ?></td> 
      </tr>
     
    </table></td>
  </tr>
  <? } ?>
  </table>

<?
$sql_puxa = mysqli_query($conexao_bd, "SELECT * FROM emprestimo_cartao WHERE data = '$data' AND operador = '$operador'");
if(mysqli_num_rows($sql_puxa) >=1){
?>  
  
<hr /><h2><strong>3º Fechamento de empréstimos</strong></h2>
<?
$valor_caixa = 0;
$valor_ted = 0;
$valor_doc = 0;

$valor_caixa_transacao = 0;
$valor_ted_transacao = 0;
$valor_doc_transacao = 0;


@$total_emprestimos++;
while($res_produtos = mysqli_fetch_array($sql_puxa)){
	
	$total_emprestimos++;
	
	if($res_produtos['forma_pagamento'] == 'CAIXA'){
	$valor_caixa = $res_produtos['valor']+$valor_caixa;
	$valor_caixa_transacao = $res_produtos['valor_total']+$valor_caixa_transacao;
	}elseif($res_produtos['forma_pagamento'] == 'TED'){
	$valor_ted = $res_produtos['valor']+$valor_ted;
	$valor_ted_transacao = $res_produtos['valor_total']+$valor_ted_transacao;
	}elseif($res_produtos['forma_pagamento'] == 'DOC'){
	$valor_doc = $res_produtos['valor']+$valor_doc;
	$valor_doc_transacao = $res_produtos['valor_total']+$valor_doc_transacao;
	}
 } // fecha o while

?>
<table width="1000" border="0">
  <tr>
    <td colspan="3" bgcolor="#CCCCCC"><strong>TOTAL DE EMPRÉSTIMOS NO CARTÃO DE CRÉDITO</strong><br />
    Foram realizados <? echo mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM emprestimo_cartao WHERE operador = '$operador' AND data = '$data'")); ?> empréstimos no cartão de crédito
    </td>
  </tr>
  <tr>
    <td width="315"><strong>VALORES PAGOS NO CAIXA</strong></td>
    <td width="338"><strong>VALORES ENVIADOS POR TED</strong></td>
    <td width="333"><strong>VALORES ENVIADOS POR DOC</strong></td>
  </tr>
  <tr>
    <td>R$ <? echo number_format($valor_caixa, 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($valor_ted, 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($valor_doc, 2, ',', '.'); ?></td>
  </tr>
  <tr>
    <td>VALOR DA TRANSAÇÃO<br />R$ <? echo number_format($valor_caixa_transacao, 2, ',', '.'); ?></td>
    <td>VALOR DA TRANSAÇÃO<br />R$ <? echo number_format($valor_ted_transacao, 2, ',', '.'); ?></td>
    <td>VALOR DA TRANSAÇÃO<br />R$ <? echo number_format($valor_doc_transacao, 2, ',', '.'); ?></td>
  </tr>
  <tr>
    <td colspan="3"><table width="995" border="0">
      <tr>
        <td align="center" width="90" bgcolor="#66CC00"><strong>N. PROP&Oacute;STA</strong></td>
        <td align="center" width="67" bgcolor="#66CC00"><strong>STATUS</strong></td>
        <td align="center" width="141" bgcolor="#66CC00"><strong>FORM. PAGAMENTO</strong></td>
        <td align="center" width="45" bgcolor="#66CC00"><strong>VALOR</strong></td>
        <td align="center" width="49" bgcolor="#66CC00"><strong>JUROS</strong></td>
        <td align="center" width="46" bgcolor="#66CC00"><strong>TARIFA</strong></td>
        <td align="center" width="89" bgcolor="#66CC00"><strong>N. PARCELAS</strong></td>
        <td align="center" width="83" bgcolor="#66CC00"><strong>VL. PARCELA</strong></td>
        <td align="center" width="86" bgcolor="#66CC00"><strong>VALOR TOTAL</strong></td>
        <td align="center" width="78" bgcolor="#66CC00"><strong>CLIENTE</strong></td>
        <td align="center" width="175" bgcolor="#66CC00"><strong>INFORMA&Ccedil;&Otilde;ES BANCARIAS</strong></td>
      </tr>
      <?
	  $i = 0;
      $emprestimo_cartao = mysqli_query($conexao_bd, "SELECT * FROM emprestimo_cartao WHERE operador = '$operador' AND data = '$data'");
	  	while($res_emprestimo_cartao = mysqli_fetch_array($emprestimo_cartao)){ $i++;
	  ?>
  	   <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
        <td align="center"><? echo $res_emprestimo_cartao['n_proposta']; ?></td>
        <td align="center"><? echo $res_emprestimo_cartao['status']; ?></td>
        <td align="center"><? echo $res_emprestimo_cartao['forma_pagamento']; ?></td>
        <td align="center"><? echo $res_emprestimo_cartao['valor']; ?></td>
        <td align="center"><? echo $res_emprestimo_cartao['juros']; ?></td>
        <td align="center"><? echo $res_emprestimo_cartao['tarifa']; ?></td>
        <td align="center"><? echo $res_emprestimo_cartao['quant_parcela']; ?></td>
        <td align="center"><? echo $res_emprestimo_cartao['valor_parcela']; ?></td>
        <td align="center"><? echo $res_emprestimo_cartao['valor_total']; ?></td>
        <td align="center"><? echo $res_emprestimo_cartao['cpf']; ?></td>
        <td align="center">Banco:<? echo $res_emprestimo_cartao['banco']; ?> - Tipo: <? echo $res_emprestimo_cartao['tipo_conta']; ?><br />Agência: <? echo $res_emprestimo_cartao['agencia']; ?> - Conta: <? echo $res_emprestimo_cartao['conta']; ?></td>
      </tr>
      <? } ?>
    </table></td>
    </tr>
</table>
<? } // fechamento de empréstimos ?>


<?
$sql_saque = mysqli_query($conexao_bd, "SELECT * FROM saques WHERE data = '$data' AND operador = '$operador'");
if(mysqli_num_rows($sql_saque) >=1){


$saque_caixa_debito = 0;
$saque_caixa_com_tarifa = 0;

	while($res_saque = mysqli_fetch_array($sql_saque)){
	
		$saque_caixa_debito = $res_saque['valor']+$saque_caixa_debito;	
		$saque_caixa_com_tarifa = $res_saque['valor_cobrado']+$saque_caixa_com_tarifa;	
			
}
?>
<hr /><h2><strong>4º Fechamento de saques no cartão de débito</strong></h2>
<table width="1000" border="0">
  <tr>
    <td colspan="3" bgcolor="#CCCCCC"><strong>TOTAL DE SAQUES NO CARTÃO DE DÉBITO</strong></td>
  </tr>
     <td width="238"><strong>VALORES PAGOS NO CAIXA</strong>
    <br>R$ <? echo number_format($saque_caixa_debito, 2, ',', '.'); ?></td>
  </tr>
  <tr>
    <td width="238">VALOR DAS TRANSAÇÕES
    <br />R$ <? echo number_format($saque_caixa_com_tarifa, 2, ',', '.'); ?></td>
  </tr>
  <tr>
    <td><table width="995" border="0">
      <tr>
        <td align="center" width="303" bgcolor="#66CC00"><strong>CLIENTE</strong></td>
        <td align="center" width="83" bgcolor="#66CC00"><strong>VALOR</strong></td>
        <td align="center" width="90" bgcolor="#66CC00"><strong>TARIFA</strong></td>
        <td align="center" width="123" bgcolor="#66CC00"><strong>VALOR COBRADO</strong></td>
        <td align="center" width="125" bgcolor="#66CC00"><strong>BANDEIRA</strong></td>
        <td align="center" width="245" bgcolor="#66CC00"><strong>BANCO</strong></td>
        </tr>
      <?
      $i=0;
	  $banco = 0;
	  $puxa_saques = mysqli_query($conexao_bd, "SELECT * FROM saques WHERE operador = '$operador' AND data = '$data'");
	  	while($res_saques = mysqli_fetch_array($puxa_saques)){ $i++;
		
		$sqlListaBanco = mysqli_query($conexao_bd, "SELECT * FROM lista_bancos WHERE codigo = '".$res_saques['banco']."'");
			while($resBanco = mysqli_fetch_array($sqlListaBanco)){ 
				$banco = $resBanco['nome_banco'];
			}
		
	  ?>
      <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
        <td align="center"><? echo strtoupper($res_saques['cliente']); ?></td>
        <td align="center">R$ <? echo number_format($res_saques['valor'],2,',','.'); ?></td>
        <td align="center">R$ <? echo number_format($res_saques['tarifa'],2,',','.'); ?></td>
        <td align="center">R$ <? echo number_format($res_saques['valor_cobrado'],2,',','.'); ?></td>
        <td align="center"><? echo strtoupper($res_saques['bandeira_cartao']); ?></td>
        <td align="center"><? echo strtoupper($banco); ?></td>
        </tr>
      <? } ?>
      </table></td>
  </tr>
</table>
<? } // fechamento de saque ?>



<?
$sql_saque_debito = mysqli_query($conexao_bd, "SELECT * FROM saque_banco_brasil WHERE data = '$data' AND operador = '$operador' AND status = 'Ativo'");	
if(mysqli_num_rows($sql_saque_debito) >=1){
?>
<hr /><h2><strong>5º FECHAMENTO DE SAQUES BANCO DO BRASIL</strong></h2>
<table width="1000" border="0">
  <tr>
    <td colspan="3" bgcolor="#CCCCCC"><strong>TOTAL DE SAQUES NO CARTÃO DE DÉBITO BANCO DO BRASIL</strong></td>
  </tr>
  <tr>
    <td width="238"><strong>VALORES PAGOS NO CAIXA</strong></td>
  </tr>
  <tr>
    <td>R$ <? 
	$saque_bb = 0;
	
	
		while($res_saque = mysqli_fetch_array($sql_saque_debito)){
				$saque_bb = $res_saque['valor']+$saque_bb;
			}
	
	echo number_format($saque_bb, 2, ',', '.'); ?></td>
  </tr>
  <tr>
    <td><table width="995" border="0">
      <tr>
        <td width="133" align="center" bgcolor="#66CC00"><strong>DATA</strong></td>
        <td width="114" align="center" bgcolor="#66CC00"><strong>CPF</strong></td>
        <td width="80" align="center" bgcolor="#66CC00"><strong>AG&Ecirc;NCIA</strong></td>
        <td width="101" align="center" bgcolor="#66CC00"><strong>TIPO</strong></td>
        <td width="88" align="center" bgcolor="#66CC00"><strong>CONTA</strong></td>
        <td width="258" align="center" bgcolor="#66CC00"><strong>FAVORECIDO</strong></td>
        <td width="83" align="center" bgcolor="#66CC00"><strong>VALOR</strong></td>
        <td width="104" align="center" bgcolor="#66CC00"><strong>N&ordm; DOCUMENTO</strong></td>
      </tr>
      <?
      $i=0;
	  $puxa_saques_bb = mysqli_query($conexao_bd, "SELECT * FROM saque_banco_brasil WHERE operador = '$operador' AND data = '$data' AND status = 'Ativo'");
	  	while($res_saques_bb = mysqli_fetch_array($puxa_saques_bb)){ $i++;
	  ?>
  	   <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
       <td align="center"><? echo strtoupper($res_saques_bb['data_completa']); ?></td>
       <td align="center"><? echo strtoupper($res_saques_bb['cliente']); ?></td>
        <td align="center"><? echo strtoupper($res_saques_bb['agencia']); ?></td>
        <td align="center"><? echo strtoupper($res_saques_bb['tipo_conta']); ?></td>
        <td align="center"><? echo strtoupper($res_saques_bb['conta']); ?></td>
        <td align="center"><? echo strtoupper($res_saques_bb['favorecido']); ?></td>
        <td align="center">R$ <? echo number_format($res_saques_bb['valor'],2,',','.'); ?></td>
        <td align="center"><? echo strtoupper($res_saques_bb['n_documento']); ?></td>
      </tr>
      <? } ?>
    </table></td>
  </tr>
</table>
<? } ?>

<?
 $sql_transferencia_ted = mysqli_query($conexao_bd, "SELECT * FROM transferencia_ted WHERE data = '$data' AND operador = '$operador' AND status != 'Cancelado'");
 if(mysqli_num_rows($sql_transferencia_ted) >=1){
?>
<hr />
<h2><strong>6º Fechamento de TRANSFERÊNCIAS TED</strong></h2>
<table width="1000" border="0">
  <tr>
    <td colspan="3" bgcolor="#CCCCCC"><strong>TOTAL DE TRANSFERÊNCIAS REALIZADAS</strong></td>
  </tr>
  <tr>
    <td width="238"><strong>TOTAL DE TRANSFERÊNCIA TED</strong></td>
  </tr>
  <?
  $transferencia_ted = 0;
 
  	while($res_ted = mysqli_fetch_array($sql_transferencia_ted)){
		$transferencia_ted = $res_ted['valor']+$res_ted['tarifa']+$transferencia_ted;
	}
		
  ?>
  <tr>
    <td>R$ <? echo number_format($transferencia_ted, 2, ',', '.');  ?></td>
  </tr>
  <tr>
    <td><table width="995" border="0">
      <tr>
        <td align="center" width="101" bgcolor="#66CC00"><strong>DATA</strong></td>
        <td align="center" width="56" bgcolor="#66CC00"><strong>STATUS</strong></td>
        <td width="100" align="center" bgcolor="#66CC00"><strong>TELEFONE</strong></td>
        <td align="center" width="270" bgcolor="#66CC00"><strong>NOME DO BENEFICI&Aacute;RIO</strong></td>
        <td align="center" width="98" bgcolor="#66CC00"><strong>CPF</strong></td>
        <td align="center" width="52" bgcolor="#66CC00"><strong>TARIFA</strong></td>
        <td align="center" width="29" bgcolor="#66CC00"><strong>TIPO</strong></td>
        <td align="center" width="70" bgcolor="#66CC00"><strong>AGENCIA</strong></td>
        <td align="center" width="68" bgcolor="#66CC00"><strong>CONTA</strong></td>
        <td align="center" width="60" bgcolor="#66CC00"><strong>BANCO</strong></td>
        <td align="center" width="45" bgcolor="#66CC00"><strong>VALOR</strong></td>
        </tr>
      <?
      $i=0;
	  $puxa_saques_bb = mysqli_query($conexao_bd, "SELECT * FROM transferencia_ted WHERE operador = '$operador' AND data = '$data' AND status != 'Cancelado'");
	  	while($res_saques_bb = mysqli_fetch_array($puxa_saques_bb)){ $i++;
	  ?>
  	   <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
        <td align="center" style="font:12px Arial, Helvetica, sans-serif;"><? echo strtoupper($res_saques_bb['data_completa']); ?></td>
        <td align="center" style="font:12px Arial, Helvetica, sans-serif;"><? echo strtoupper($res_saques_bb['status']); ?></td>
        <td align="center" style="font:12px Arial, Helvetica, sans-serif;"><? echo strtoupper($res_saques_bb['telefone_remetente']); ?></td>
        <td align="center" style="font:12px Arial, Helvetica, sans-serif;"><? echo strtoupper($res_saques_bb['nome_beneficiario']); ?></td>
        <td align="center" style="font:12px Arial, Helvetica, sans-serif;"><? echo strtoupper($res_saques_bb['cpf_beneficiario']); ?></td>
        <td align="center" style="font:12px Arial, Helvetica, sans-serif;"><? echo number_format($res_saques_bb['tarifa'], 2, ',', '.'); ?></td>
        <td align="center" style="font:12px Arial, Helvetica, sans-serif;"><? echo strtoupper($res_saques_bb['tipo_conta']); ?></td>
        <td align="center" style="font:12px Arial, Helvetica, sans-serif;"><? echo strtoupper($res_saques_bb['agencia']); ?></td>
        <td align="center" style="font:12px Arial, Helvetica, sans-serif;"><? echo strtoupper($res_saques_bb['conta_beneficario']); ?></td>
        <td align="center" style="font:12px Arial, Helvetica, sans-serif;"><? echo strtoupper($res_saques_bb['banco']); ?></td>
        <td align="center" style="font:12px Arial, Helvetica, sans-serif;"><? echo number_format($res_saques_bb['valor'], 2, ',', '.'); ?></td>
        </tr>
     <? } ?>
    </table></td>
  </tr>
</table>

<? } ?>



<?
$sql_deposito = mysqli_query($conexao_bd, "SELECT * FROM deposito_banco_brasil WHERE data = '$data' AND operador = '$operador' AND status != 'Cancelado'");
if(mysqli_num_rows($sql_deposito) >=1){
?>
<hr />
<h2><strong>7º Fechamento de DEPÓSITOS</strong></h2>
<table width="1000" border="0">
  <tr>
    <td colspan="3" bgcolor="#CCCCCC"><strong>TOTAL DE DEPOISTO REALIZADAS</strong></td>
  </tr>
  <tr>
    <td width="238"><strong>DEPÓSITO DIRETO BANCO DO BRASIL</strong></td>
  </tr>
  <?
  $deposito_bb = 0;
  
  	while($res_deposito = mysqli_fetch_array($sql_deposito)){
		$deposito_bb = $res_deposito['valor']+$deposito_bb;
	}
		
  ?>
  <tr>
    <td>R$ <? echo number_format($deposito_bb, 2, ',', '.');  ?></td>
  </tr>
  <tr>
    <td><table width="995" border="0">
      <tr>
        <td align="center" width="133" bgcolor="#66CC00"><strong>DATA</strong></td>
        <td align="center" width="89" bgcolor="#66CC00"><strong>CPF</strong></td>
        <td align="center" width="68" bgcolor="#66CC00"><strong>AG&Ecirc;NCIA</strong></td>
        <td align="center" width="95" bgcolor="#66CC00"><strong>TIPO</strong></td>
        <td align="center" width="99" bgcolor="#66CC00"><strong>CONTA</strong></td>
        <td align="center" width="284" bgcolor="#66CC00"><strong>FAVORECIDO</strong></td>
        <td align="center" width="90" bgcolor="#66CC00"><strong>VALOR</strong></td>
        <td align="center" width="103" bgcolor="#66CC00"><strong>N. DOCUMENTO</strong></td>
        </tr>
      <?
      $i=0;
  $sql_deposito = mysqli_query($conexao_bd, "SELECT * FROM deposito_banco_brasil WHERE data = '$data' AND operador = '$operador' AND status != 'Cancelado'");
	  
	  	while($res_deposito_bb = mysqli_fetch_array($sql_deposito)){ $i++;
	  ?>
  	   <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
        <td align="center"><? echo strtoupper($res_deposito_bb['data_completa']); ?></td>
        <td align="center"><? echo strtoupper($res_deposito_bb['cliente']); ?></td>
        <td align="center"><? echo strtoupper($res_deposito_bb['agencia']); ?></td>
        <td align="center"><? echo strtoupper($res_deposito_bb['tipo_conta']); ?></td>
        <td align="center"><? echo strtoupper($res_deposito_bb['conta']); ?></td>
        <td align="center"><? echo strtoupper($res_deposito_bb['favorecido']); ?></td>
        <td align="center">R$ <? echo number_format($res_deposito_bb['valor'], 2, ',', '.'); ?></td>
        <td align="center"><? echo strtoupper($res_deposito_bb['n_documento']); ?></td>
        </tr>
      <? } ?>
    </table></td>
  </tr>
</table>
<? } ?>

<?
  $sql_recebimento_faturas = mysqli_query($conexao_bd, "SELECT * FROM pagamento_fatura WHERE data = '$data' AND operador = '$operador' AND status != 'Cancelado'");
if(mysqli_num_rows($sql_recebimento_faturas)>=1){
?>
<hr />
<h2><strong>8º Fechamento de RECEBIMENTO DE FATURAS</strong></h2>
<table width="1000" border="0">
  <tr>
    <td colspan="3" bgcolor="#CCCCCC"><strong>TOTAL FATURAS RECEBIDAS</strong></td>
  </tr>
  <?
  $recebimento_faturas = 0;
  $recebimento_faturas_dinheiro = 0;
  	while($res_recebimento_faturas = mysqli_fetch_array($sql_recebimento_faturas)){
		$recebimento_faturas = $res_recebimento_faturas['valor']+$recebimento_faturas;
		
		if($res_recebimento_faturas['forma_pagamento'] == 'DINHEIRO'){
		 $recebimento_faturas_dinheiro = $res_recebimento_faturas['valor']+$recebimento_faturas_dinheiro;
		}
		
		
	}
		
  ?>
  <tr>
    <td>R$ <? echo number_format($recebimento_faturas, 2, ',', '.');  ?></td>
  </tr>
  <tr>
    <td><table width="995" border="0">
      <tr>
        <td align="center" width="193" bgcolor="#66CC00"><strong>DATA</strong></td>
        <td align="center" width="167" bgcolor="#66CC00"><strong>STATUS</strong></td>
        <td align="center" width="210" bgcolor="#66CC00"><strong>CLIENTE</strong></td>
        <td align="center" width="136" bgcolor="#66CC00"><strong>VALOR</strong></td>
        <td align="center" width="267" bgcolor="#66CC00"><strong>FORMA DE PAGAMENTO</strong></td>
        </tr>
      <?
      $i=0;
  $sql_recebimento_faturas = mysqli_query($conexao_bd, "SELECT * FROM pagamento_fatura WHERE data = '$data' AND operador = '$operador' AND status != 'Cancelado'");	  
  		while($res_recebimento_faturas = mysqli_fetch_array($sql_recebimento_faturas)){ $i++;
	  ?>
  	   <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
        <td align="center"><? echo strtoupper($res_recebimento_faturas['data_completa']); ?></td>
        <td align="center"><? echo strtoupper($res_recebimento_faturas['status']); ?></td>
        <td align="center"><? echo strtoupper($res_recebimento_faturas['cliente']); ?></td>
        <td align="center">R$ <? echo number_format($res_recebimento_faturas['valor'], 2, ',', '.'); ?></td>
        <td align="center"><? echo strtoupper($res_recebimento_faturas['forma_pagamento']); ?></td>
        </tr>
      <? } ?>
    </table></td>
  </tr>
</table>
<? } ?>


<?
  $sql_sangria = mysqli_query($conexao_bd, "SELECT * FROM sangria_caixa WHERE data = '$data' AND operador = '$operador' AND finalidade = 'SANGRIA'");
 if(mysqli_num_rows($sql_sangria)>=1){
?>
<hr />
<h2><strong>9º Fechamento de SANGRIA E ALÍVIO</strong></h2>
<table width="1000" border="0">
  <tr>
    <td colspan="3" bgcolor="#CCCCCC"><strong>TOTAL DE SANGRIA E ALIVIOS</strong></td>
  </tr>
  <tr>
    <td colspan="3" width="238"><strong>SANGRIA E ALIVIOS</strong></td>
  </tr>
  <?
  $sangria = 0;
  $alivio = 0;
  	while($res_sangria = mysqli_fetch_array($sql_sangria)){
		$sangria = $res_sangria['valor']+$sangria;
	}
	
  $sql_alivio = mysqli_query($conexao_bd, "SELECT * FROM sangria_caixa WHERE data = '$data' AND operador = '$operador' AND finalidade = 'ALIVIO'");
  	while($res_alivio = mysqli_fetch_array($sql_alivio)){
		$alivio = $res_alivio['valor']+$alivio;
	}
		
  ?>
  <tr>
   <td><strong>TOTAL DE ALIVIO</strong></td>
   <td><strong>TOTAL DE SANGRIA</strong></td>
  </tr>
  <tr>
    <td>R$ <? echo number_format($sangria, 2, ',', '.');  ?></td>
    <td>R$ <? echo number_format($alivio, 2, ',', '.');  ?></td>
  </tr>
  <tr>
    <td colspan="2"><table width="995" border="0">
      <tr>
        <td align="center" width="306" bgcolor="#66CC00"><strong>DATA COMPLETA</strong></td>
        <td align="center" width="306" bgcolor="#66CC00"><strong>FINALIDADE</strong></td>
        <td align="center" width="156" bgcolor="#66CC00"><strong>VALOR</strong></td>
        <td align="center" width="210" bgcolor="#66CC00"><strong>BANCO</strong></td>
        </tr>
      <?
      $i=0;
  $sql_alivio = mysqli_query($conexao_bd, "SELECT * FROM sangria_caixa WHERE data = '$data' AND operador = '$operador'");
  		while($res_alivio = mysqli_fetch_array($sql_alivio)){ $i++;
	  ?>
  	   <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
        <td align="center"><? echo $res_alivio['data_completa']; ?></td>
        <td align="center"><? echo strtoupper($res_alivio['finalidade']); ?></td>
        <td align="center">R$ <? echo number_format($res_alivio['valor'], 2, ',', '.'); ?></td>
        <td align="center"><? echo strtoupper($res_alivio['banco']); ?></td>
        </tr>
      <? } ?>
    </table></td>
    </tr>
</table>
<? } ?>


<?
$sql_comercial = mysqli_query($conexao_bd, "SELECT * FROM retirada_dinheiro WHERE data = '$data' AND operador = '$operador'");
if(mysqli_num_rows($sql_comercial)>=1){
?>
<hr />
<h2><strong>10º Fechamento de RETIRADA DE DINHEIRO</strong></h2>
<table width="1000" border="0">
  <tr>
    <td colspan="3" bgcolor="#CCCCCC"><strong>Foram realizados 8 retiradas</strong></td>
  </tr>
  <?
  $comercial = 0;
  $pessoal = 0;
  $sql_comercial = mysqli_query($conexao_bd, "SELECT * FROM retirada_dinheiro WHERE data = '$data' AND operador = '$operador' AND finalidade = 'FINS COMERCIAIS'");
  	while($res_comercial = mysqli_fetch_array($sql_comercial)){
		$comercial = $res_comercial['valor']+$comercial;
	}
  $sql_comercial = mysqli_query($conexao_bd, "SELECT * FROM retirada_dinheiro WHERE data = '$data' AND operador = '$operador' AND finalidade = 'DEVOLUCAO DE VALORES'");
  	while($res_comercial = mysqli_fetch_array($sql_comercial)){
		$comercial = $res_comercial['valor']+$comercial;
	}
	
  $sql_pessoal = mysqli_query($conexao_bd, "SELECT * FROM retirada_dinheiro WHERE data = '$data' AND operador = '$operador' AND finalidade = 'FINS PESSOAIS'");
  	while($res_pessoal = mysqli_fetch_array($sql_pessoal)){
		$pessoal = $res_pessoal['valor']+$pessoal;
	}
		
  ?>
  <tr>
   <td><strong>FINS COMERCIAIS</strong></td>
   <td><strong>FINS PESSOAIS</strong></td>
  </tr>
  <tr>
    <td>R$ <? echo number_format($comercial, 2, ',', '.');  ?></td>
    <td>R$ <? echo number_format($pessoal, 2, ',', '.');  ?></td>
  </tr>
  <tr>
    <td colspan="2"><table width="995" border="0">
      <tr>
        <td align="center" width="202" bgcolor="#66CC00"><strong>DATA</strong></td>
        <td align="center" width="407" bgcolor="#66CC00"><strong>DESCRI&Ccedil;&Atilde;O</strong></td>
        <td align="center" width="156" bgcolor="#66CC00"><strong>FINALIDADE</strong></td>
        <td align="center" width="212" bgcolor="#66CC00"><strong>VALOR</strong></td>
        </tr>
      <?
      $i=0;
  $sql_alivio = mysqli_query($conexao_bd, "SELECT * FROM retirada_dinheiro WHERE data = '$data' AND operador = '$operador' AND finalidade != 'MULTA'");
  		while($res_alivio = mysqli_fetch_array($sql_alivio)){ $i++;
	  ?>
  	   <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
        <td align="center"><? echo strtoupper($res_alivio['data_completa']); ?></td>
        <td align="center"><? echo strtoupper($res_alivio['descricao']); ?></td>
        <td align="center"><? echo strtoupper($res_alivio['finalidade']); ?></td>
        <td align="center">R$ <? echo number_format($res_alivio['valor'], 2, ',', '.'); ?></td>
        </tr>
      <? } ?>
    </table></td>
    </tr>
</table>
<? } ?>


<?

$sql_emite = mysqli_query($conexao_bd, "SELECT * FROM emissao_de_nota_de_pagamento WHERE data = '$data' AND operador = '$operador' AND status != 'CANCELADO'");
if(mysqli_num_rows($sql_emite)>=1){
?>
<hr />
<h2><strong>11&ordm; Informa&ccedil;ões sobre EMISSÃO DE NOTAS DE PAGAMENTOS</strong></h2>
<table width="1000" border="0">
  <tr>
    <td colspan="3" bgcolor="#CCCCCC"><strong>RELATÓRIO DE EMISSÃO DE NOTAS DE PAGAMENTOS</strong></td>
  </tr>
  <?
  $emissao = 0;
  $resgate = 0;
  $sql_emite = mysqli_query($conexao_bd, "SELECT * FROM emissao_de_nota_de_pagamento WHERE data = '$data' AND operador = '$operador' AND status != 'CANCELADO'");
  	while($res_emite = mysqli_fetch_array($sql_emite)){
		$emissao = $res_emite['valor']+$emissao;
	}
	
  $sql_resgate = mysqli_query($conexao_bd, "SELECT * FROM emissao_de_nota_de_pagamento WHERE dia_resgate = '$data' AND operador_regaste = '$operador' AND status = 'RESGATADO'");
  	while($res_resgate = mysqli_fetch_array($sql_resgate)){
		$resgate = ($res_resgate['valor']+$res_resgate['juros_rendidos'])+$resgate;
	}
		
  ?>
  <tr>
   <td width="551"><strong>EMISSÃO DE NOTAS</strong></td>
   <td width="439"><strong>RESGATE DE NOTAS</strong></td>
  </tr>
  <tr>
    <td>R$ <? echo number_format($emissao, 2, ',', '.');  ?></td>
    <td>R$ <? echo number_format($resgate, 2, ',', '.');  ?></td>
  </tr>
  <tr>
    <td colspan="2"><table width="990" border="0">
      <tr>
        <td width="81" bgcolor="#00CC00"><strong>Nº CUPOM</strong></td>
        <td width="144" bgcolor="#00CC00"><strong>DATA EMISSÃO</strong></td>
        <td width="144" bgcolor="#00CC00"><strong>STATUS</strong></td>
        <td width="321" bgcolor="#00CC00"><strong>NOME DO CLIENTE</strong></td>
        <td width="103" bgcolor="#00CC00"><strong>CPF</strong></td>
        <td width="87" bgcolor="#00CC00"><strong>TRAVADO</strong></td>
        <td width="56" bgcolor="#00CC00"><strong>VALOR</strong></td>
        <td width="48" bgcolor="#00CC00"><strong>DIA(S)</strong></td>
        <td width="116" bgcolor="#00CC00"><strong>VALOR A PAGAR</strong></td>
      </tr>
      <? $i=0;  
  $sql_emite = mysqli_query($conexao_bd, "SELECT * FROM emissao_de_nota_de_pagamento WHERE data = '$data' AND operador = '$operador' AND status = 'Ativo'");	  
  $sql_regate = mysqli_query($conexao_bd, "SELECT * FROM emissao_de_nota_de_pagamento WHERE data = '$data' AND operador_regaste = '$operador' AND status = 'RESGATADO'");	  
	  while($res_cupom = mysqli_fetch_array($sql_emite)){ $i++;
	   ?>
	  <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
        <td><? echo $res_cupom['code_cupom']; ?></td>
        <td><? echo $res_cupom['data_completa']; ?></td>
        <td><? echo $res_cupom['status']; ?></td>
        <td><? echo $res_cupom['nome']; ?></td>
        <td><? echo $res_cupom['cpf']; ?></td>
        <td><? echo $res_cupom['travado']; ?></td>
        <td>R$ <? echo number_format($res_cupom['valor'], 2, ',', '.'); ?></td>
        <td><? echo $res_cupom['dias_juros']; ?></td>
        <td>R$ <? echo number_format($res_cupom['valor']+$res_cupom['juros_rendidos'], 6, ',', '.'); ?></td>
      </tr>
      <? } ?>
      <?  
  $sql_regate = mysqli_query($conexao_bd, "SELECT * FROM emissao_de_nota_de_pagamento WHERE dia_resgate = '$data' AND operador_regaste = '$operador' AND status = 'RESGATADO'");	  
	  while($res_resgate = mysqli_fetch_array($sql_regate)){ $i++;
	   ?>
	  <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
        <td><? echo $res_resgate['code_cupom']; ?></td>
        <td><? echo $res_resgate['data_completa']; ?></td>
        <td><? echo $res_resgate['status']; ?></td>
        <td><? echo $res_resgate['nome']; ?></td>
        <td><? echo $res_resgate['cpf']; ?></td>
        <td><? echo $res_resgate['travado']; ?></td>
        <td>R$ <? echo number_format($res_resgate['valor'], 2, ',', '.'); ?></td>
        <td><? echo $res_cupom['dias_juros']; ?></td>
        <td>R$ <? echo number_format($res_resgate['valor']+$res_resgate['juros_rendidos'], 6, ',', '.'); ?></td>
      </tr>
      <? } ?>
    </table></td>
  </tr>
</table>
<? } ?>

<?
$sql_recargas = mysqli_query($conexao_bd, "SELECT * FROM recarga_prepago WHERE data = '$data' AND operador = '$operador' AND status = 'Ativo'");
if(mysqli_num_rows($sql_recargas) >=1){
?>
<hr />
<h2><strong>12&ordm; Informa&ccedil;ões sobre RECARGA DE CELULAR PRÉ-PAGO</strong>
</h2>
<?
$soma_recarga_dinheiro = 0;
$soma_recarga_debito = 0;
$soma_recarga_debito_taxa = 0;
$soma_recarga_credito = 0;
$soma_recarga_credito_taxa = 0;
$soma_recarga_vesteprime = 0;
$somaM12 = 0;

$sql_recargas = mysqli_query($conexao_bd, "SELECT * FROM recarga_prepago WHERE data = '$data' AND operador = '$operador' AND status = 'Ativo'");
	while($res_recargas = mysqli_fetch_array($sql_recargas)){
		if($res_recargas['forma_pagamento'] == 'DINHEIRO'){
			$soma_recarga_dinheiro = $res_recargas['valor']+$soma_recarga_dinheiro;
		}elseif($res_recargas['forma_pagamento'] == 'VESTE PRIME'){
			$soma_recarga_vesteprime = $res_recargas['valor']+$soma_recarga_vesteprime;
		}elseif($res_recargas['forma_pagamento'] == 'CARTAO DE CREDITO'){
			$soma_recarga_credito = $res_recargas['valor']+$soma_recarga_credito;
			$soma_recarga_credito_taxa = $res_recargas['valor']+$res_recargas['tarifa']+$soma_recarga_credito_taxa;		
		}elseif($res_recargas['forma_pagamento'] == 'M12'){
			$somaM12 = $res_recargas['valor']+$somaM12;		
		}elseif($res_recargas['forma_pagamento'] == 'CARTAO DE DEBITO'){
			$soma_recarga_debito = $res_recargas['valor']+$soma_recarga_debito;		
			$soma_recarga_debito_taxa = $res_recargas['valor']+$res_recargas['tarifa']+$soma_recarga_debito_taxa;		
		}
}

?>
<table width="1000" border="0">
  <tr>
    <td colspan="6" bgcolor="#CCCCCC"><strong>RELATÓRIO DE RECARGAS DE PRÉ-PAGO</strong></td>
  </tr>
  <tr>
   <td width="172"><strong>DINHEIRO</strong></td>
   <td width="253"><strong>CARTÃO DE DÉBITO</strong></td>
   <td width="192"><strong>CARTÃO DE CRÉDITO</strong></td>
   <td width="239"><strong>VESTE PRIME CARD</strong></td>
   <td width="122"><strong>M12</strong></td>
  </tr>
  <tr>
    <td>R$ <? echo number_format($soma_recarga_dinheiro, 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($soma_recarga_debito, 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($soma_recarga_credito, 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($soma_recarga_vesteprime, 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($somaM12, 2, ',', '.'); ?></td>
  </tr>
  <tr>
    <td colspan="5"><table width="990" border="0">
      <tr>
        <td width="132" bgcolor="#00CC00"><strong>DATA</strong></td>
        <td width="184" bgcolor="#00CC00"><strong>PROCESSAMENTO</strong></td>
        <td width="75" bgcolor="#00CC00"><strong>OPERADORA</strong></td>
        <td width="92" bgcolor="#00CC00"><strong>NÚMERO</strong></td>
        <td width="82" bgcolor="#00CC00"><strong>NSU</strong></td>
        <td width="102" bgcolor="#00CC00"><strong>CLIENTE</strong></td>
        <td width="152" bgcolor="#00CC00"><strong>FORM. PAGAMENTO</strong></td>
        <td width="62" bgcolor="#00CC00"><strong>VALOR</strong></td>
        <td width="71" bgcolor="#00CC00"><strong>TARIFA</strong></td>
      </tr>
      <? $i=0;
	  $sql_recargas = mysqli_query($conexao_bd, "SELECT * FROM recarga_prepago WHERE data = '$data' AND operador = '$operador' AND status = 'Ativo'");
	  while($res_sql_recargas = mysqli_fetch_array($sql_recargas)){ $i++;
	  ?>
	  <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
        <td><? echo $res_sql_recargas['data_completa']; ?></td>
        <td><? echo $res_sql_recargas['processamento']; ?></td>
        <td><? echo $res_sql_recargas['operadora']; ?></td>
        <td><? echo $res_sql_recargas['numero']; ?></td>
        <td><? echo $res_sql_recargas['nsu']; ?></td>
        <td><? echo $res_sql_recargas['cliente']; ?></td>
        <td><? echo $res_sql_recargas['forma_pagamento']; ?></td>
	    <td>R$ <? echo number_format($res_sql_recargas['valor'], 2, ',', '.'); ?></td>
	    <td>R$ <? echo number_format($res_sql_recargas['tarifa'], 2, ',', '.'); ?></td>
      </tr>
      <? } ?>
    </table></td>
  </tr>
</table>
<? } ?>

<?
$sql_recargas_tv = mysqli_query($conexao_bd, "SELECT * FROM recarga_tv_prepago WHERE data = '$data' AND operador = '$operador' AND status = 'Ativo'");
if(mysqli_num_rows($sql_recargas_tv) >=1){
?>
<hr />
<h2><strong>13&ordm; Informa&ccedil;ões sobre RECARGA DE TV PRÉ-PAGO</strong>
</h2>
<?
$soma_recarga_tv_prepago_dinheiro = 0;
$soma_recarga_tv_prepago_debito = 0;
$soma_recarga_tv_prepago_credito = 0;
$soma_recarga_tv_prepago_vesteprime = 0;

	while($res_recargas = mysqli_fetch_array($sql_recargas_tv)){
		if($res_recargas['forma_pagamento'] == 'DINHEIRO'){
			$soma_recarga_tv_prepago_dinheiro = $res_recargas['valor']+$soma_recarga_tv_prepago_dinheiro;
		}elseif($res_recargas['forma_pagamento'] == 'VESTE PRIME'){
			$soma_recarga_tv_prepago_vesteprime = $res_recargas['valor']+$soma_recarga_tv_prepago_vesteprime;
		}elseif($res_recargas['forma_pagamento'] == 'CARTAO DE CREDITO'){
			$soma_recarga_tv_prepago_credito = $res_recargas['valor']+$soma_recarga_tv_prepago_credito;
		}elseif($res_recargas['forma_pagamento'] == 'CARTAO DE DEBITO'){
			$soma_recarga_tv_prepago_debito = $res_recargas['valor']+$soma_recarga_tv_prepago_debito;		
		}
}

?>
<table width="1000" border="0">
  <tr>
    <td colspan="5" bgcolor="#CCCCCC"><strong>RELATÓRIO DE RECARGAS DE PRÉ-PAGO</strong></td>
  </tr>
  <tr>
   <td width="212"><strong>DINHEIRO</strong></td>
   <td width="337"><strong>CARTÃO DE DÉBITO</strong></td>
   <td width="248"><strong>CARTÃO DE CRÉDITO</strong></td>
   <td width="185"><strong>VESTE PRIME CARD</strong></td>
  </tr>
  <tr>
    <td>R$ <? echo number_format($soma_recarga_tv_prepago_dinheiro, 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($soma_recarga_tv_prepago_debito, 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($soma_recarga_tv_prepago_credito, 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($soma_recarga_tv_prepago_vesteprime, 2, ',', '.'); ?></td>
  </tr>
  <tr>
    <td colspan="4"><table width="990" border="0">
      <tr>
        <td width="65" bgcolor="#00CC00"><strong>DATA</strong></td>
        <td width="143" bgcolor="#00CC00"><strong>PROCESSAMENTO</strong></td>
        <td width="125" bgcolor="#00CC00"><strong>OPERADORA</strong></td>
        <td width="150" bgcolor="#00CC00"><strong>CÓDIGO</strong></td>
        <td width="82" bgcolor="#00CC00"><strong>NSU</strong></td>
        <td width="89" bgcolor="#00CC00"><strong>CLIENTE</strong></td>
        <td width="165" bgcolor="#00CC00"><strong>FORM. PAGAMENTO</strong></td>
        <td width="62" bgcolor="#00CC00"><strong>VALOR</strong></td>
        <td width="71" bgcolor="#00CC00"><strong>TARIFA</strong></td>
      </tr>
      <? $i=0;
	  $sql_recargas_tv = mysqli_query($conexao_bd, "SELECT * FROM recarga_tv_prepago WHERE data = '$data' AND operador = '$operador' AND status = 'Ativo'");
	  while($res_sql_recargas = mysqli_fetch_array($sql_recargas_tv)){ $i++;
	  ?>
	  <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
        <td><? echo $res_sql_recargas['data_completa']; ?></td>
        <td><? echo $res_sql_recargas['processamento']; ?></td>
        <td><? echo $res_sql_recargas['tv']; ?></td>
        <td><? echo $res_sql_recargas['code_cliente']; ?></td>
        <td><? echo $res_sql_recargas['nsu']; ?></td>
        <td><? echo $res_sql_recargas['cliente']; ?></td>
        <td><? echo $res_sql_recargas['forma_pagamento']; ?></td>
	    <td>R$ <? echo number_format($res_sql_recargas['valor'], 2, ',', '.'); ?></td>
	    <td>R$ <? echo number_format($res_sql_recargas['tarifa'], 2, ',', '.'); ?></td>
      </tr>
      <? } ?>
    </table></td>
  </tr>
</table>
<? } ?>

<?
$sql_giftcard = mysqli_query($conexao_bd, "SELECT * FROM gift_card WHERE data = '$data' AND operador = '$operador' AND status = 'Ativo'");
if(mysqli_num_rows($sql_giftcard) >=1){
?>
<hr />
<h2><strong>14&ordm; Informa&ccedil;ões sobre GIFT CARD</strong>
</h2>
<?
$soma_giftcard_dinheiro = 0;
$soma_giftcard_debito = 0;
$soma_giftcard_credito = 0;
$soma_giftcard_vesteprime = 0;

$sql_giftcard = mysqli_query($conexao_bd, "SELECT * FROM gift_card WHERE data = '$data' AND operador = '$operador' AND status = 'Ativo'");
	while($res_recargas = mysqli_fetch_array($sql_giftcard)){
		if($res_recargas['forma_pagamento'] == 'DINHEIRO'){
			$soma_giftcard_dinheiro = $res_recargas['valor']+$soma_giftcard_dinheiro;
		}elseif($res_recargas['forma_pagamento'] == 'VESTE PRIME'){
			$soma_giftcard_vesteprime = $res_recargas['valor']+$soma_giftcard_vesteprime;
		}elseif($res_recargas['forma_pagamento'] == 'CARTAO DE CREDITO'){
			$soma_giftcard_credito = $res_recargas['valor']+$soma_giftcard_credito;
		}elseif($res_recargas['forma_pagamento'] == 'CARTAO DE DEBITO'){
			$soma_giftcard_debito = $res_recargas['valor']+$soma_giftcard_debito;		
		}
}

?>
<table width="1000" border="0">
  <tr>
    <td colspan="5" bgcolor="#CCCCCC"><strong>RELATÓRIO DE RECARGAS DE PRÉ-PAGO</strong></td>
  </tr>
  <tr>
   <td width="212"><strong>DINHEIRO</strong></td>
   <td width="337"><strong>CARTÃO DE DÉBITO</strong></td>
   <td width="248"><strong>CARTÃO DE CRÉDITO</strong></td>
   <td width="185"><strong>VESTE PRIME CARD</strong></td>
  </tr>
  <tr>
    <td>R$ <? echo number_format($soma_giftcard_dinheiro, 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($soma_giftcard_debito, 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($soma_giftcard_credito, 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($soma_giftcard_vesteprime, 2, ',', '.'); ?></td>
  </tr>
  <tr>
    <td colspan="4"><table width="990" border="0">
      <tr>
        <td width="65" bgcolor="#00CC00"><strong>DATA</strong></td>
        <td width="143" bgcolor="#00CC00"><strong>PROCESSAMENTO</strong></td>
        <td width="125" bgcolor="#00CC00"><strong>GIFT CARD</strong></td>
        <td width="150" bgcolor="#00CC00"><strong>PIN</strong></td>
        <td width="89" bgcolor="#00CC00"><strong>CLIENTE</strong></td>
        <td width="165" bgcolor="#00CC00"><strong>FORM. PAGAMENTO</strong></td>
        <td width="62" bgcolor="#00CC00"><strong>VALOR</strong></td>
        <td width="71" bgcolor="#00CC00"><strong>TARIFA</strong></td>
      </tr>
      <? $i=0;
	$sql_giftcard = mysqli_query($conexao_bd, "SELECT * FROM gift_card WHERE data = '$data' AND operador = '$operador' AND status = 'Ativo'");
	  while($res_sql_recargas = mysqli_fetch_array($sql_giftcard)){ $i++;
	  ?>
	  <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
        <td><? echo $res_sql_recargas['data_completa']; ?></td>
        <td><? echo $res_sql_recargas['processamento']; ?></td>
        <td><? echo $res_sql_recargas['gift']; ?></td>
        <td><? echo $res_sql_recargas['pin']; ?></td>
        <td><? echo $res_sql_recargas['cliente']; ?></td>
        <td><? echo $res_sql_recargas['forma_pagamento']; ?></td>
	    <td>R$ <? echo number_format($res_sql_recargas['valor'], 2, ',', '.'); ?></td>
	    <td>R$ <? echo number_format($res_sql_recargas['tarifa'], 2, ',', '.'); ?></td>
      </tr>
      <? } ?>
    </table></td>
  </tr>
</table>
<? } ?>

<?
$sql_transferencia = mysqli_query($conexao_bd, "SELECT * FROM saque_transferencia WHERE data = '$data' AND operador = '$operador' AND status != 'Cancelado'");
if(mysqli_num_rows($sql_transferencia) >=1){
?>
<hr />
<h2><strong>15&ordm; Informa&ccedil;ões sobre TRANSFERÊNCIA SAQUE</strong></h2>
<?
$soma_transferencia = 0;


	while($res_saue_transferencia = mysqli_fetch_array($sql_transferencia)){
		$soma_transferencia = $res_saue_transferencia['valor']+$soma_transferencia;
}

?>
<table width="1000" border="0">
  <tr>
    <td colspan="5" bgcolor="#CCCCCC"><strong>RELATÓRIO DE SAQUE TRANSFERÊNCIA</strong></td>
  </tr>
  <tr>
    <td colspan="5">R$ <? echo number_format($soma_transferencia, 2, ',', '.'); ?></td>
  </tr>
  <tr>
    <td colspan="4"><table width="990" border="0">
      <tr>
        <td width="158" bgcolor="#00CC00"><strong>Data</strong></td>
        <td width="119" bgcolor="#00CC00"><strong>VALOR</strong></td>
        <td width="132" bgcolor="#00CC00"><strong>CPF</strong></td>
        <td width="228" bgcolor="#00CC00"><strong>CLIENTE</strong></td>
        <td width="91" bgcolor="#00CC00"><strong>BANCO</strong></td>
        <td width="79" bgcolor="#00CC00"><strong>TIPO</strong></td>
        <td width="68" bgcolor="#00CC00"><strong>AGÊNCIA</strong></td>
        <td width="81" bgcolor="#00CC00"><strong>CONTA</strong></td>
      </tr>
      <? $i=0;
		$sql_transferencia = mysqli_query($conexao_bd, "SELECT * FROM saque_transferencia WHERE data = '$data' AND operador = '$operador' AND status != 'Cancelado'");
	  while($res_sql_transferencia = mysqli_fetch_array($sql_transferencia)){ $i++;
	  ?>
	  <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
        <td><? echo $res_sql_transferencia['data_completa']; ?></td>
	    <td>R$ <? echo number_format($res_sql_transferencia['valor'], 2, ',', '.'); ?></td>
        <td><? echo $res_sql_transferencia['cpf']; ?></td>
        <td><? echo $res_sql_transferencia['cliente']; ?></td>
        <td><? echo $res_sql_transferencia['banco']; ?></td>
        <td><? echo $res_sql_transferencia['tipo']; ?></td>
	    <td><? echo $res_sql_transferencia['agencia']; ?></td>
	    <td><? echo $res_sql_transferencia['conta']; ?></td>
      </tr>
      <? } ?>
    </table></td>
  </tr>
</table>
<? } ?>


<?
$sql_saque_facil = mysqli_query($conexao_bd, "SELECT * FROM emprestimo_saque_facil WHERE data = '$data' AND operador = '$operador' AND status = 'APROVADO'");
if(mysqli_num_rows($sql_saque_facil) >=1){
?>
<hr />
<h2><strong>16&ordm; informa&ccedil;&otilde;es sobre saque f&aacute;cil</strong></h2>
<?
$saque_facil = 0;


	while($res_saque_facil = mysqli_fetch_array($sql_saque_facil)){
		$saque_facil = $res_saque_facil['valor']+$saque_facil;
}

?>
<table width="1000" border="0">
  <tr>
    <td colspan="5" bgcolor="#CCCCCC"><strong>RELATÓRIO DE SAQUE f&aacute;cil</strong></td>
  </tr>
  <tr>
    <td colspan="5">R$ <? echo number_format($saque_facil, 2, ',', '.'); ?></td>
  </tr>
  <tr>
    <td colspan="4"><table width="990" border="0">
      <tr>
        <td width="78" bgcolor="#00CC00"><strong>pr&oacute;posta</strong></td>
        <td width="109" bgcolor="#00CC00"><strong>cpf</strong></td>
        <td width="319" bgcolor="#00CC00"><strong>cliente</strong></td>
        <td width="80" bgcolor="#00CC00"><strong>valor</strong></td>
        <td width="159" bgcolor="#00CC00"><strong>status da proposta</strong></td>
        <td width="219" bgcolor="#00CC00"><strong>forma de recebimento</strong></td>
        </tr>
      <? $i=0; 
		$sql_saque_facil = mysqli_query($conexao_bd, "SELECT * FROM emprestimo_saque_facil WHERE data = '$data' AND operador = '$operador' AND status = 'APROVADO'");
	  
	  while($res_saque_facil = mysqli_fetch_array($sql_saque_facil)){ $i++; ?>
	  <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
        <td><? echo $res_saque_facil['n_proposta']; ?></td>
        <td><? echo $res_saque_facil['cpf']; ?></td>
        <td><? echo $res_saque_facil['nome']; ?></td>
        <td>R$ <? echo number_format($res_saque_facil['valor'], 2, ',', '.'); ?></td>
        <td><? echo $res_saque_facil['status']; ?></td>
        <td><? echo $res_saque_facil['recebimento']; ?></td>
	    </tr>
      <? } ?>
    </table></td>
  </tr>
</table>
<? } ?>


<? 
$sql_saque_facil = mysqli_query($conexao_bd, "SELECT * FROM loja_online_carrinho WHERE data = '$data' AND operador = '$operador'");
if(mysqli_num_rows($sql_saque_facil) >=1){
?>
<hr />
<h2><strong>17&ordm; informações da loja virtual</strong></h2>
<?
$loja_online_carrinho = 0;
$valor_dinheiro_loja_virtual = 0;

$sql_saque_facil = mysqli_query($conexao_bd, "SELECT * FROM loja_online_carrinho WHERE data = '$data' AND operador = '$operador'");
	while($res_saque_facil = mysqli_fetch_array($sql_saque_facil)){
		$loja_online_carrinho = $res_saque_facil['valor_total']+$loja_online_carrinho;
}
?>
<table width="1000" border="0">
  <tr>
    <td colspan="5" bgcolor="#CCCCCC"><strong>RELATÓRIO DE PEDIDOS DA LOJA VIRTUAL</strong></td>
  </tr>
  <tr>
    <td colspan="5">R$ <? echo number_format($loja_online_carrinho, 2, ',', '.'); ?></td>
  </tr>
  <tr>
    <td colspan="4">
      R$ <? $i=0; 
	   $sql_online_carrinho = mysqli_query($conexao_bd, "SELECT * FROM loja_online_carrinho WHERE data = '$data' AND operador = '$operador'");
	  	while($res_sql_online_carrinho = mysqli_fetch_array($sql_online_carrinho)){ $i++; 
	  ?>    
      <table width="990" border="0" style="border:1px solid #000; border-radius:5px;">
      <tr>
        <td width="77" bgcolor="#00CC00"><strong>Carrinho</strong></td>
        <td width="108" bgcolor="#00CC00"><strong>Cliente</strong></td>
        <td width="318" bgcolor="#00CC00"><strong>Produto</strong></td>
        <td width="114" bgcolor="#00CC00"><strong>Quant.</strong></td>
        <td width="123" bgcolor="#00CC00"><strong>VL Unitário</strong></td>
        <td width="222" bgcolor="#00CC00"><strong>VLTotal</strong></td>
        </tr>
	  <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
        <td><? echo $res_sql_online_carrinho['code_carrinho']; ?></td>
        <td><? echo $res_sql_online_carrinho['cliente']; ?></td>
        <td><? 
			
			$sql_produto = mysqli_query($conexao_bd, "SELECT * FROM loja_online_produto WHERE id = '".$res_sql_online_carrinho['id_produto']."'");
			  while($res_produto = mysqli_fetch_array($sql_produto)){
				  echo $res_produto['titulo'];
			  }
			 
		?></td>
        <td><? echo $res_sql_online_carrinho['quantidade']; ?></td>
	    <td>R$ <? echo number_format($res_sql_online_carrinho['valor_unitario'], 2, ',', '.'); ?></td>
	    <td>R$ <? echo number_format($res_sql_online_carrinho['valor_total'], 2, ',', '.'); ?></td>
	    </tr>
	  <tr>
	    <td bgcolor="#EAFFEA">&nbsp;</td>
	    <td bgcolor="#EAFFEA">&nbsp;</td>
	    <td bgcolor="#EAFFEA"><strong>Resumo de pagamento</strong></td>
	    <td bgcolor="#EAFFEA"><strong>Valor</strong></td>
	    <td bgcolor="#EAFFEA">&nbsp;</td>
	    <td bgcolor="#EAFFEA">&nbsp;</td>
	    </tr>
      <?
       $sql_pagamento_carrinho = mysqli_query($conexao_bd, "SELECT * FROM loja_online_pagamentos WHERE code_carrinho = '".$res_sql_online_carrinho['code_carrinho']."'");
	    while($res_pagamento = mysqli_fetch_array($sql_pagamento_carrinho)){ $i++;
		
		if($res_pagamento['forma_pagamento'] == 'DINHEIRO'){ 
			$valor_dinheiro_loja_virtual = $valor_dinheiro_loja_virtual+($res_pagamento['valor']-$res_pagamento['troco']); 
		}
	  ?>
	  <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
        <td><? echo $res_pagamento['forma_pagamento']; ?></td>
	    <td>R$ <? echo number_format($res_pagamento['valor']-$res_pagamento['troco'], 2, ',', '.'); ?></td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    </tr>
      <? } ?>
    </table></td>
  </tr>
  <? } ?>
</table>
<? } ?>

<?
$sql_capitalizacao = mysqli_query($conexao_bd, "SELECT * FROM parcelas_capitalizacao WHERE data_pagt = '$data' AND operador_pgto = '$operador'");
if(mysqli_num_rows($sql_capitalizacao) >=1){
?>
<hr /> 
<h2><strong>18&ordm; Fechamento de planos de capitalização</strong></h2>
<?
$capitalizacao = 0;
$soma_capitalizacao = 0;

$sql_capitalizacao = mysqli_query($conexao_bd, "SELECT * FROM parcelas_capitalizacao WHERE data_pagt = '$data' AND operador_pgto = '$operador'");
	while($res_capitalizacao = mysqli_fetch_array($sql_capitalizacao)){
		$capitalizacao = $res_capitalizacao['vl_recebido']+$capitalizacao;
}
?>
<table width="1000" border="0">
  <tr>
    <td colspan="5" bgcolor="#CCCCCC"><strong>RELATÓRIO DE PLANOS DE CAPITALIZAÇÃO</strong></td>
  </tr>
  <tr>
    <td colspan="5">R$ <? echo number_format($capitalizacao, 2, ',', '.'); ?></td>
  </tr>
  <tr>
    <td colspan="4"><table width="990" border="0">
      <tr>
        <td width="78" bgcolor="#00CC00"><strong>PLANO</strong></td>
        <td width="78" bgcolor="#00CC00"><strong>cpf</strong></td>
        <td width="300" bgcolor="#00CC00"><strong>CLIENTE</strong></td>
        <td width="50" bgcolor="#00CC00"><strong>PARCELA</strong></td>
        <td width="80" bgcolor="#00CC00"><strong>valor</strong></td>
        <td width="150" bgcolor="#00CC00"><strong>status da proposta</strong></td>
        <td width="200" bgcolor="#00CC00"><strong>forma de recebimento</strong></td>
        </tr>
      <? $i=0; 
$sql_capitalizacao = mysqli_query($conexao_bd, "SELECT * FROM parcelas_capitalizacao WHERE data_pagt = '$data' AND operador_pgto = '$operador'");
	  while($res_capitalizacao = mysqli_fetch_array($sql_capitalizacao)){ $i++; 
	  
	  	if($res_capitalizacao['forma_pagt'] == 'DINHEIRO'){
			$soma_capitalizacao = $res_capitalizacao['vl_recebido']+$soma_capitalizacao;
		}
	  
	  ?>
	  <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
        <td><? echo $res_capitalizacao['code_capitalizacao']; ?></td>
        <td><? echo $res_capitalizacao['cliente']; ?></td>
        <td><? 
		
		 $sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '".$res_capitalizacao['cliente']."'");
		 	while($res_cliente = mysqli_fetch_array($sql_cliente)){
				echo $res_cliente['nome'];
			}
		
		?></td>
        <td><? echo $res_capitalizacao['n_parcela']; ?></td>
        <td>R$ <? echo number_format($res_capitalizacao['vl_recebido'], 2, ',', '.'); ?></td>
        <td><? echo $res_capitalizacao['status']; ?></td>
        <td><? echo $res_capitalizacao['forma_pagt']; ?></td>
	    </tr>
      <? } ?>
    </table></td>
  </tr>
</table>
<? } ?>

<?
$sql_rifas = mysqli_query($conexao_bd, "SELECT * FROM rifas_cupons WHERE status = 'Ativo' AND operador = '$operador' AND data = '$data'");
if(mysqli_num_rows($sql_rifas) >=1){

?>
<hr />
<h2><strong>19&ordm; Fechamento de RIFAS ONLINE</strong></h2>
<?
$saldo_rifas = 0;
$saldo_rifas_dinheiro = 0;
$sql_rifas = mysqli_query($conexao_bd, "SELECT * FROM rifas_cupons WHERE status = 'Ativo' AND operador = '$operador' AND data = '$data'");
 while($res_rifas = mysqli_fetch_array($sql_rifas)){
	 $saldo_rifas = $res_rifas['valor']+$saldo_rifas;
	 
	 if($res_rifas['forma_pagamento'] == 'DINHEIRO'){
		 $saldo_rifas_dinheiro = $res_rifas['valor']+$saldo_rifas_dinheiro;
	 }
	 
}




?>
<table width="1000" border="0">
  <tr>
    <td colspan="5" bgcolor="#CCCCCC"><strong>RELATÓRIO DE PLANOS DE CAPITALIZAÇÃO</strong></td>
  </tr>
  <tr>
    <td colspan="5">R$ <? echo number_format($saldo_rifas, 2, ',', '.'); ?></td>
  </tr>
  <tr>
    <td colspan="4"><table width="990" border="0">
      <tr>
        <td width="121" bgcolor="#00CC00"><strong>Data</strong></td>
        <td width="87" bgcolor="#00CC00"><strong>CPF</strong></td>
        <td width="255" bgcolor="#00CC00"><strong>CLIENTE</strong></td>
        <td width="95" bgcolor="#00CC00"><strong>Telefone</strong></td>
        <td width="87" bgcolor="#00CC00"><strong>valor</strong></td>
        <td width="180" bgcolor="#00CC00"><strong>Forma de pagamento</strong></td>
        <td width="135" bgcolor="#00CC00"><strong>CUPOM</strong></td>
        </tr>
      <? $i=0; 
	$sql_rifas = mysqli_query($conexao_bd, "SELECT * FROM rifas_cupons WHERE status = 'Ativo' AND operador = '$operador' AND data = '$data'");
	  while($res_rifas = mysqli_fetch_array($sql_rifas)){ $i++; 
	  
	  ?>
	  <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
        <td><? echo $res_rifas['data_completa']; ?></td>
        <td><? echo $res_rifas['cpf']; ?></td>
        <td><? echo $res_rifas['nome_completo']; ?></td>
        <td><? echo $res_rifas['telefone']; ?></td>
        <td><strong>R$</strong> <? echo number_format($res_rifas['valor'],2,',','.'); ?></td>
        <td><? echo $res_rifas['forma_pagamento']; ?></td>
        <td><? echo $res_rifas['code_cupom']; ?></td>
	    </tr>
      <? } ?>
    </table></td>
  </tr>
</table>
<? } ?>

<?
$sqlAporte = mysqli_query($conexao_bd, "SELECT * FROM aporte_financeiro WHERE operador = '$operador' AND data = '$data'");
if(mysqli_num_rows($sqlAporte) >=1){
?>
<hr />
<h2><strong>20&ordm; Fechamento de ENTRADAS DE RECURSOS</strong></h2>
<?
$aporte = 0;
 while($resAporte = mysqli_fetch_array($sqlAporte)){
	 $aporte+=$resAporte['valor'];
}
?>
<table width="1000" border="0">
  <tr>
    <td colspan="5" bgcolor="#CCCCCC"><strong>RELAT&Oacute;RIO DE ENTRADA DE RECURSOS</strong></td>
  </tr>
  <tr>
    <td colspan="5">R$ <? echo number_format($aporte, 2, ',', '.'); ?></td>
  </tr>
  <tr>
    <td colspan="4"><table width="990" border="0">
      <tr>
        <td width="160" bgcolor="#00CC00"><strong>Data</strong></td>
        <td width="152" bgcolor="#00CC00"><strong>OPERADOR</strong></td>
        <td width="133" bgcolor="#00CC00"><strong>VALOR</strong></td>
        <td width="136" bgcolor="#00CC00"><strong>MOTIVO</strong></td>
        <td width="387" bgcolor="#00CC00"><strong>DESCRI&Ccedil;&Atilde;O</strong></td>
        </tr>
      <? $i=0; 
		$sqlAporte = mysqli_query($conexao_bd, "SELECT * FROM aporte_financeiro WHERE operador = '$operador' AND data = '$data'");
		 while($resAporte = mysqli_fetch_array($sqlAporte)){ $i++;
	  
	  ?>
      <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
        <td><? echo $resAporte['data_completa']; ?></td>
        <td><? echo $resAporte['operador']; ?></td>
        <td><strong>R$</strong> <? echo number_format($resAporte['valor'],2,',','.'); ?></td>
        <td><? echo $resAporte['motivo']; ?></td>
        <td><? echo number_format($resAporte['descricao'],2,',','.'); ?></td>
        </tr>
      <? } ?>
    </table></td>
  </tr>
</table>
<? } ?>

<hr />
<h2><strong>21&ordm; Informa&ccedil;&atilde;o de declara&ccedil;&otilde;es de valores</strong></h2>
<?
$sql_caixa_final = mysqli_query($conexao_bd, "SELECT * FROM fechamento_de_caixa WHERE id_caixa = '$id_do_caixa' AND operador = '$operador'");
while($res_abertura = mysqli_fetch_array($sql_caixa_final)){ 
?>
<table width="1000" border="0">
  <tr>
    <td align="center" colspan="6"><hr /></td>
  </tr>
  <tr>
    <td><strong>NOTAS DE R$ 200,00</strong></td>
    <td><strong>NOTAS DE R$ 100,00</strong></td>
    <td><strong>NOTAS DE R$ 50,00</strong></td>
    <td><strong>NOTAS DE R$ 20,00</strong></td>
    <td><strong>NOTAS DE R$ 10,00</strong></td>
    <td><strong>NOTAS DE R$ 5,00</strong></td>
  </tr>
  <tr>
    <td>R$ <? echo number_format($res_abertura['bb']*200, 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($res_abertura['notas100']*100, 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($res_abertura['notas50']*50, 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($res_abertura['notas20']*20, 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($res_abertura['notas10']*10, 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($res_abertura['notas5']*5, 2, ',', '.'); ?></td>
  </tr>
  <tr>
    <td><strong>NOTAS DE R$ 2,00</strong></td>
    <td><strong>MOEDAS DE R$ 1,00</strong></td>
    <td><strong>MOEDAS DE R$ 0,50</strong></td>
    <td><strong>MOEDAS DE R$ 0,25</strong></td>
    <td><strong>MOEDAS DE R$ 0,10</strong></td>
    <td><strong>MOEDAS DE 0,05</strong></td>
  </tr>
  <tr>
    <td>R$ <? echo number_format($res_abertura['notas2']*2, 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($res_abertura['moeda1']*1, 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($res_abertura['moeda50']*0.5, 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($res_abertura['moeda25']*0.25, 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($res_abertura['moeda10']*0.1, 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($res_abertura['moeda5']*0.05, 2, ',', '.'); ?></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#FFEADF" colspan="6"><hr />
      <strong>DINHEIRO FINAL INFORMADO</strong> <br />
      R$
      <? 
	
	$caixa_final = ($res_abertura['bb']*200)+($res_abertura['notas100']*100)+($res_abertura['notas50']*50)+($res_abertura['notas20']*20)+($res_abertura['notas10']*10)+($res_abertura['notas5']*5)+($res_abertura['notas2']*2)+($res_abertura['moeda1']*1)+($res_abertura['moeda50']*0.5)+($res_abertura['moeda25']*0.25)+($res_abertura['moeda10']*0.1)+($res_abertura['moeda5']*0.05);
	
	echo number_format($caixa_final, 2, ',', '.'); 
	
	?></td>
  </tr>
</table>
<? } ?>

<table width="1000" border="0">
  <tr>
    <td align="center" colspan="6" bgcolor="#00CC00"><h2><strong>RESUMO FINAL PARA FECHAMENTO DE CAIXA</strong></h2></td>
  </tr>
  <tr>
    <td width="155" bgcolor="#0099FF"><strong>ENTRADA DE DINHEIRO</strong></td>
    <td width="145" bgcolor="#0099FF"><strong>SA&Iacute;DA DE DINHEIRO</strong></td>
    <td width="239" bgcolor="#0099FF"><strong>CART&Atilde;O DE D&Eacute;BITO</strong></td>
    <td width="247" bgcolor="#0099FF"><strong>CART&Atilde;O DE CR&Eacute;DITO</strong></td>
    <td width="93" bgcolor="#0099FF"><strong>VP CARD</strong></td>
    <td width="95" bgcolor="#0099FF"><strong>M12</strong></td>
  </tr>
  <tr>
   <td>R$ <?
    $entradas = $caixa_inicial+$valor_dinheiro+$carrinho_dinheiro+$transferencia_ted+$deposito_bb+$recebimento_faturas_dinheiro+$emissao+$soma_recarga_dinheiro+$soma_recarga_tv_prepago_dinheiro+$soma_giftcard_dinheiro+$loja_online_carrinho+$capitalizacao+$saldo_rifas_dinheiro+$aporte;
    echo number_format(($entradas), 2, ',', '.'); ?></td>
   <td>R$
     <?
   $saidas = $valor_caixa+$saque_caixa_debito+$saque_bb+$sangria+$alivio+$comercial+$pessoal+$resgate+$soma_transferencia+$saque_facil;

    echo number_format(($saidas), 2, ',', '.'); ?></td>
   <td>R$ <? echo number_format((($valor_cartao_debito+$soma_giftcard_debito+$soma_recarga_debito+$soma_recarga_tv_prepago_debito+$carrinho_cartao_debito+$saque_caixa_debito)), 2, ',', '.'); ?></td>
   <td>R$ <? echo number_format(($valor_cartao_credito+$soma_giftcard_credito+$soma_recarga_credito+$soma_recarga_tv_prepago_credito+$carrinho_cartao_credito+$valor_caixa), 2, ',', '.'); ?></td>
   <td>R$ <? echo number_format(($valor_vesteprime+$soma_giftcard_vesteprime+$carrinho_vesteprime+$soma_recarga_vesteprime+$soma_recarga_tv_prepago_vesteprime), 2, ',', '.'); ?></td>
   <td>R$ <? echo number_format(($valor_vesteprime+$soma_giftcard_vesteprime+$carrinho_vesteprime+$soma_recarga_vesteprime+$soma_recarga_tv_prepago_vesteprime), 2, ',', '.'); ?></td>
  </tr>
  <tr>
   <td colspan="2" bgcolor="#FFBBBB"><strong>SALDO FINAL DO CAIXA</strong></td>
   <td bgcolor="#0099FF"><strong>TOTAL DE TRANSA&Ccedil;&Otilde;ES NO D&Eacute;BITO</strong></td>
    <td bgcolor="#0099FF"><strong>TOTAL DE TRANSA&Ccedil;&Otilde;ES NO CR&Eacute;DITO</strong></td>
    <td colspan="2" bgcolor="#0099FF"><strong>TRANSFER&Ecirc;NCIA/PIX</strong></td>
  </tr>
  <tr>
    <td colspan="2">R$ <? echo number_format(($saidas+$caixa_final)-$entradas, 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($pagamentoDebitoTotalTransacao, 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($pagamentoCreditoTotalTransacao, 2, ',', '.'); ?></td>
    <td colspan="2">R$ <? echo number_format(($valor_transferencia+$carrinho_transferencia), 2, ',', '.'); ?></td>
  </tr>
</table>
<hr />

<br />

<?

$saldo_final_caixa = $caixa_final-$valor_disponivel_caixa;

mysqli_query($conexao_bd, "DELETE FROM retirada_dinheiro WHERE operador = '$operador' AND data = '$data' AND descricao = 'DIFERENCA_CAIXA'");

$id_retirada = 0;
if($saldo_final_caixa >5 || $saldo_final_caixa <-5){
if($saldo_final_caixa <0){
	$saldo_final_caixa = -$saldo_final_caixa;
}else{
	$saldo_final_caixa = $saldo_final_caixa;
}
	
 $sql_verifica_debito = mysqli_query($conexao_bd, "SELECT * FROM retirada_dinheiro WHERE descricao = 'DIFERENCA_CAIXA' AND data = '$data' AND operador = '$operador'");
 if(mysqli_num_rows($sql_verifica_debito) == ''){
	 mysqli_query($conexao_bd, "INSERT INTO retirada_dinheiro (status, data, data_completa, dia, mes, ano, valor, finalidade, descricao, operador, processamento) VALUES ('Aguarda', '$data', '$data_completa', '$dia', '$mes', '$ano', '$saldo_final_caixa', 'MULTA', 'DIFERENCA_CAIXA', '$operador', '')");
 }else{
	mysqli_query($conexao_bd, "UPDATE retirada_dinheiro SET valor = '$saldo_final_caixa' WHERE operador = '$operador' AND descricao = 'DIFERENCA_CAIXA' AND data = '$data'");
 }
}
?>




<table width="995" border="0">
  <tr>
    <td align="left" colspan="5" bgcolor="#FFCC00"><strong>ANEXOS DESTE RELATÓRIO</strong></td>
  </tr>
  <tr>
    <td align="left" colspan="5"><ul>
      <li>(    ) Comprovantes recargas de celulares maquina Banco do Brasil</li>
      <li>(    ) Comprovante de saques maquina Banco do Brasil</li>
      <li>(    ) Comprovante de depósitos maquina Banco do Brasil</li>
      <li>(    ) Comprovante de pagamentos com os respectivos boletos na maquina do Banco do Brasil</li>
      <li>(    ) Relatório de comprovante de transações da maquina do Banco do Brasil</li>
      <li>(    ) Comprovante de fechamento de Caixa do Banco do Brasil</li>
      <li>(    ) Contratos de aberturas de cadastro do cartão VESTE PRIME CARD</li>
      <li>(    ) Comprovante de transações assinadas pelo cliente do cartao VESTE PRIME CARD</li>
      <li>(    ) Comprovante de transações realizados nos cartões crédito e débito</li>
      </ul></td>
  </tr>
  <tr>
    <td align="left" colspan="5">
    <strong>OBSERVAÇÕES</strong><br /><br>
      <hr /><br>
      <hr /><br>
      <hr /><br>
      <hr /><br>
      <hr /><br>
      <hr /><br>
      <hr /><br>
      <hr /></tr>
  <tr>
   <td align="center">
      <p>Taiba - São Gonçalo do Amarante, <? echo date("d"); ?> de 
<? $mes = date("m");
		
		if($mes == '1'){
			echo "janeiro";
		}elseif($mes == '2'){
			echo "fevereiro";
		}elseif($mes == '3'){
			echo "mar&ccedil;o";
		}elseif($mes == '4'){
			echo "abril";
		}elseif($mes == '5'){
			echo "maio";
		}elseif($mes == '6'){
			echo "junho";
		}elseif($mes == '7'){
			echo "julho";
		}elseif($mes == '8'){
			echo "agosto";
		}elseif($mes == '9'){
			echo "setembro";
		}elseif($mes == '10'){
			echo "outubro";
		}elseif($mes == '11'){
			echo "novembro";
		}else{
			echo "dezembro";
		}
	
	 ?> 
de <? echo date("Y"); ?>	  
      </p><br>
       <br />___________________________________________________________________<br>
      OPERADOR: <? echo strtoupper($nome); ?>
   </td>
  </tr>
  </table>

</div><!-- box -->
</body>
</html>