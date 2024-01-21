<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/comprovante_troca.css" rel="stylesheet" type="text/css" />
<? require "../config.php"; ?>
</head>

<body>

<?

$code_carrinho = $_GET['code_carrinho'];

  $busca_carrinho = mysqli_query($conexao_bd, "SELECT * FROM carrinho WHERE code_carrinho = '".$_GET['code_carrinho']."'");
  while($res_carrinho = mysqli_fetch_array($busca_carrinho)){
	  $code_carrinho = $res_carrinho['code_carrinho'];
?>
<table width="305" border="1">
  <tr>
    <td colspan="4" align="center" bgcolor="#0033CC"><h1><img src="../img/logo.png" width="229" height="95" /></h1>
      <h2>CUPOM DE TROCA DE VENDA DE PRODUTOS/SERVI&Ccedil;OS<br /><?  echo date("d/m/Y H:i:s");?><br />
    </h2>
    </td>
  </tr>
  <tr>
    <td colspan="4" bgcolor="#CCCCCC"><strong>comprovante de venda emitido por <br />
VESTE PRIME - VESTUARIO E ACESSORIOS DE CELULARES</strong><br />
cnpj: 32.450.862/0001-02 <br />
RUA. capit&atilde;o in&aacute;cio prata - 2010 - Taiba <br />
s&atilde;o gon&ccedil;alo do amarante - cear&aacute; <br />
<strong>cep: </strong>62670-000 <br />
<strong>telefone: </strong>(85) 3315.6199</td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#FFF"><strong>CARRINHO</strong><BR /><? echo $code_carrinho; ?></td>
    <td colspan="2" bgcolor="#FFF"><strong>CLIENTE</strong><BR /><? echo $cliente =  $res_carrinho['cliente']; ?></td>
  </tr>
  <tr>
    <td colspan="4" bgcolor="#CCCCCC"><strong>AUTENTICAÇÃO</strong><br />
    <? echo md5($code_carrinho); ?></td>
  </tr> 
   <? 
  $valor_total = 0;
  $i=0;
  $quant_comprada = 0;
  $quant_novo = 0;
  $code_produto = 0;
	  $busca_produto = mysqli_query($conexao_bd, "SELECT * FROM produtos_caixa WHERE code_carrinho = '$code_carrinho'");
	  while($res_produto = mysqli_fetch_array($busca_produto)){ $i++;
	 			$quant_comprada = $res_produto['quant'];
	 			$code_produto = $res_produto['code_produto'];
  ?>
  <tr>
  
    <td width="32" align="center" bgcolor="#CCCCCC"><h1 class="h5"><strong>item</strong></h1></td>
    <td width="50" align="center" bgcolor="#CCCCCC"><h1 class="h5"><strong>code</strong></h1></td>
    <td colspan="2" align="center" bgcolor="#CCCCCC"><h1 class="h5"><strong>PRODUTO</strong></h1></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#FFFFFF"><h1 class="h5"><? echo $i; ?></h1></td>
    <td align="center" bgcolor="#FFFFFF"><h1 class="h5"><? echo $code_produto = $res_produto['code_produto']; ?></h1></td>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><h1 class="h5">
	  <? 
	  $soma_lucro = 0;
	  $soma_comissao = 0;
	  $produto = mysqli_query($conexao_bd, "SELECT * FROM  produtos WHERE code = '$code_produto'");
	  while($res_produtos = mysqli_fetch_array($produto)){
		  echo $titulo_resumido = $res_produtos['titulo_resumido'];
		  
		  $estoque_atual = $res_produtos['estoque'];
		  
		  $comissao = $res_produtos['comissao'];
		  
		  if($res_produtos['code'] != '1714')
		  $soma_comissao = ($res_produtos['comissao']*$res_produto['quant'])+$soma_comissao;
		  $soma_lucro = (($res_produtos['valor_venda']-$res_produtos['valor_compra'])*$res_produto['quant'])+$soma_lucro;
		  
		  $quant_vendida = $res_produtos['quant_vendida'];
		  $quant = $res_produto['quant'];
		  $tipo = $res_produto['tipo'];
		  
		  $quant_novo = ($estoque_atual-$quant_comprada);
		  
		  $valor_da_comissao = $comissao*$quant;
		  
		  mysqli_query($conexao_bd, "INSERT INTO comissao (data, data_completa, dia, mes, ano, status, operador, descricao, valor, ip, cliente, produto, carrinho, quantidade, tipo) VALUES ('$data', '$data_completa', '$dia', '$mes', '$ano', 'Aguarda', '$operador', '$titulo_resumido', '$valor_da_comissao', '$ip', '$cliente', '$code_produto', '$code_carrinho', '$quant', '$tipo')");
		    
		  $quant_vendida = $quant_vendida+$quant_comprada;
		  mysqli_query($conexao_bd, "UPDATE produtos SET estoque = '$quant_novo', quant_vendida = '$quant_vendida' WHERE code = '$code_produto'");
		  
	  
	 ?></h1></td>
  </tr>
  <tr>
    <td colspan="2" align="center" bgcolor="#CCCCCC"><h1 class="h5"><strong>VR. UNIT&Aacute;Rio</strong></h1></td>
    <td width="146" align="center" bgcolor="#CCCCCC"><h1 class="h5"><strong>QUANTIDADE</strong></h1></td>
    <td width="49" align="center" bgcolor="#CCCCCC"><h1 class="h5"><strong>VR. TOTAL</strong></h1></td>
  </tr>
  <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><h1 class="h5">R$ <? echo number_format(($res_produto['valor']/$res_produto['quant']),2); ?></h1></td>
    <td width="146" align="center" bgcolor="#FFFFFF"><h1 class="h5"><? echo $res_produto['quant']; ?></h1></td>
    <td width="49" align="center" bgcolor="#FFFFFF"><h1 class="h5">R$ <? $valor_total = $valor_total+$res_produto['valor']; echo number_format($res_produto['valor'],2); ?></h1></td>
  </tr>
  </h1>
  <? }} ?>
  <tr>
    <td colspan="4" align="center" bgcolor="#CCCCCC"><strong>VALOR TOTAL DO CARRINHO</strong></td>
  </tr>
  <tr>
    <td colspan="4" align="center" bgcolor="#FFFFFF">R$ <? $valor_pontos = number_format($valor_total); echo number_format($valor_total,2); ?></td>
  
  <?
  $novos_pontos = 0;
  $vestepoint = 0;
  $busca_cliente = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente WHERE cliente = '$cliente'");
  	while($res_cliente =  mysqli_fetch_array($busca_cliente)){
		
		$vestepoint = $res_cliente['vestepoint'];
		
		$categoria = $res_cliente['categoria'];
		if($categoria == 'black'){
			$novos_pontos = $valor_pontos*4;
		}elseif($categoria == 'platinum'){
			$novos_pontos = $valor_pontos*3;
		}elseif($categoria == 'gold'){
			$novos_pontos = $valor_pontos*2;
		}else{
			$novos_pontos = $valor_pontos*1;
		}	
		$vestepoint = $vestepoint+$novos_pontos;
	   }

		
		mysqli_query($conexao_bd, "INSERT INTO extratato_vestepoint (ip, dia, mes, ano, data, data_completa, status, tipo, cliente, descricao, operador, total, valor_transacao, novo_saldo) VALUES ('$ip', '$dia', '$mes', '$ano', '$data', '$data_completa', 'Ativo', 'CREDITO', '$cliente', 'COMPRA DE PRODUTOS', '$operador', '$novos_pontos', '$valor_pontos', '$vestepoint')");
		
		mysqli_query($conexao_bd, "UPDATE conta_corrente SET vestepoint = '$vestepoint' WHERE cliente = '$cliente'");
			
  		
		
  
  
  ?>  
    
  </tr>
  <tr>
    <td colspan="4" align="center" bgcolor="#CCCCCC"><strong>PAGAMENTO</strong></td>
  </tr>
  <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><h1 class="h5"><strong>VALOR</strong></h1></td>
    <td align="center" bgcolor="#FFFFFF"><h1 class="h5"><strong>FORMA DE PAGAMENTO</strong></h1></td>
    <td align="center" bgcolor="#FFFFFF"><h1 class="h5"><strong>TROCO</strong></h1></td>
  </tr>
  <?
  $soma_dinheiro = 0;
  $soma_cartao_credito = 0;
  $soma_cartao_debito = 0;
	  $pagamento = mysql_query("SELECT * FROM pagamento_carrinho WHERE code_carrinho = '$code_carrinho'");
	  while($res_pagamento = mysql_fetch_array($pagamento)){
  ?>
  
  <? if($res_pagamento['form_pag'] == 'DINHEIRO'){ $soma_dinheiro = $res_pagamento['valor_fornecido']+$soma_dinheiro; ?>
  <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><h1 class="h5">r$ <? echo number_format($res_pagamento['valor_fornecido'],2); ?></h1></td>
    <td align="center" bgcolor="#FFFFFF"><h1 class="h5"><? echo $res_pagamento['form_pag']; ?></h1></td>
    <td align="center" bgcolor="#FFFFFF"><? echo $res_pagamento['troco']; ?></td>
  </tr>
  <? }else{
  
  if($res_pagamento['form_pag'] == 'CARTÃO DE CRÉDITO'){
	  if($res_pagamento['parcelas'] == '1'){
	  $soma_cartao_credito = ($res_pagamento['valor_fornecido']*0.05)+$soma_cartao_credito;
	  }else{
	  $soma_cartao_credito = (($res_pagamento['valor_fornecido']*0.05)+($res_pagamento['valor_fornecido']*0.02*$res_pagamento['parcelas']))+$soma_cartao_credito;
	  }
  }
  if($res_pagamento['form_pag'] == 'CARTÃO DE DÉBITO'){
	  $soma_cartao_debito = ($res_pagamento['valor_total']*0.02)+$soma_cartao_debito;
  }
	  
  ?>
  <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><h1 class="h5">r$ <? echo number_format($res_pagamento['valor_total'],2); ?></h1></td>
    <td align="center" bgcolor="#FFFFFF"><h1 class="h5"><? echo $res_pagamento['form_pag']; ?></h1></td>
    <td align="center" bgcolor="#FFFFFF"><? echo $res_pagamento['troco']; ?></td>
  </tr>   
  <? } // fecha opção de pagamento do carrinho ?>
  
  
  
  <? } ?>
  <tr>
    <td height="38" colspan="4" align="left" bgcolor="#FFFFFF"><h1 class="h5">
    <strong>*ESTE COMPROVANTE DE TROCA É O ÚNICO COMPROVANTE DE SUA COMPRA, SENDO OBRIGATÓRIO SUA APRESENTAÇÃO JUNTAMENTE COM O DOCUMENTO DE IDENTIFICAÇÃO EM CASO DE TROCA OU DEVOLU&Ccedil;&Atilde;O DE VALORES.</strong><br /> <br />
    <strong>PARA TROCAS</strong><br />
    <ul>
    <li>Apresentar este comprovante de compra.</li>
    <li>Todos os acessórios devem estar juntamente com o produto, inclusive as embalagens intactas.</li>
    <li>Só efetuamos a troca em caso de defeito de fabricação.</li>
    <li>Todos os produtos passaram por analise a qual a loja tem até 30 dias para dar um retorno ao cliente.</li>
    </ul>
    </h1>
    </td>
  </tr>
<? 

mysqli_query($conexao_bd, "UPDATE carrinho SET status = 'Encerrado' WHERE code_carrinho = '$code_carrinho'"); 

mysqli_query($conexao_bd, "UPDATE produtos_caixa SET status = 'Encerrado' WHERE code_carrinho = '$code_carrinho'");   

mysqli_query($conexao_bd, "UPDATE pagamento_carrinho SET status = 'Encerrado' WHERE code_carrinho = '$code_carrinho'");    


}?>
</table>
</div><!-- topo_geral -->
</body>
</html>