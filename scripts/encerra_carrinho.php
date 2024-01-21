<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/encerra_carrinho.css" rel="stylesheet" type="text/css" />
<script src="barcode/dist/JsBarcode.all.js"></script>
</head>

<body>
<script language="javascript">window.print();</script>
<? require "../config.php"; ?>
<script>
		Number.prototype.zeroPadding = function(){
			var ret = "" + this.valueOf();
			return ret.length == 1 ? "0" + ret : ret;
		};
</script>




<? $code_carrinho = 0;

mysqli_query($conexao_bd, "DELETE FROM pagamento_carrinho WHERE valor_total = '0'");   
mysqli_query($conexao_bd, "DELETE FROM pagamento_carrinho WHERE valor_total = 'f'");

  $busca_carrinho = mysqli_query($conexao_bd, "SELECT * FROM carrinho WHERE ip = '$ip' AND status = 'Ativo'");
  while($res_carrinho = mysqli_fetch_array($busca_carrinho)){
	  $code_carrinho = $res_carrinho['code_carrinho'];
	  $cliente = $res_carrinho['cliente'];
?>

<table width="305" style="font:10px Arial, Helvetica, sans-serif;" border="1">
  <tr>
    <td colspan="5" align="center" bgcolor="#FFF">
      <img src="https://ikuly.com/caixa/img/logoComprovante.fw.png" width="152" height="82" />
      <h3 style="margin:0; padding:0; color:#000;">CUPOM DE VENDA <br />
	  	<?  echo date("d/m/Y H:i:s");?>
      </h3>
    </td>
  </tr>
  <tr>
    <td colspan="5" bgcolor="#CCCCCC" style="font-size:10px;"><strong> cnpj: </strong>32.450.862/0001-02 <br />
RUA. capit&atilde;o in&aacute;cio prata - 2010 - Taiba <br />
s&atilde;o gon&ccedil;alo do amarante - 
<strong>cep: </strong>62670-000 <br />
<strong>telefone: </strong>(85) 99158.7323</td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#FFF"><strong>CARRINHO</strong><BR /><? echo $code_carrinho; ?></td>
    <td colspan="3" bgcolor="#FFF"><strong>CLIENTE</strong><BR /><? 
	$sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '$cliente'");
		while($res_cliente = mysqli_fetch_array($sql_cliente)){
			echo $res_cliente['nome'];
		}
		?>
	</td>
  </tr>
  <tr>
    <td colspan="5" bgcolor="#CCCCCC"><strong>AUTENTICAÇÃO</strong><br />
    <? echo md5($code_carrinho); ?></td>
  </tr> 
   <? 
  $valor_total = 0;
  $i=0;
  $quant_comprada = 0;
  $quant_novo = 0;
  $code_produto = 0;
	  $busca_produto = mysqli_query($conexao_bd, "SELECT * FROM produtos_caixa WHERE code_carrinho = '$code_carrinho' AND status = 'Ativo'");
	  while($res_produto = mysqli_fetch_array($busca_produto)){ $i++;
	 			$quant_comprada = $res_produto['quant'];
	 			$code_produto = $res_produto['code_produto'];
  ?>
  <tr>
  
    <td width="32" align="center" bgcolor="#CCCCCC"><h1 class="h5"><strong>item</strong></h1></td>
    <td width="38" align="center" bgcolor="#CCCCCC"><h1 class="h5"><strong>code</strong></h1></td>
    <td colspan="3" align="center" bgcolor="#CCCCCC"><h1 class="h5"><strong>PRODUTO</strong></h1></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#FFFFFF"><h1 class="h5"><? echo $i; ?></h1></td>
    <td align="center" bgcolor="#FFFFFF"><h1 class="h5"><? echo $code_produto = $res_produto['code_produto']; ?></h1></td>
    <td colspan="3" align="center" bgcolor="#FFFFFF"><h1 class="h5">
	  <? 
	  $soma_lucro = 0;
	  $soma_comissao = 0;
	  
	  $quantidadeProdutoPassivo = 0;
	  $produto = mysqli_query($conexao_bd, "SELECT * FROM  produtos WHERE code = '$code_produto'");
	  while($res_produtos = mysqli_fetch_array($produto)){
		  
		  echo $titulo_resumido = $res_produtos['titulo_resumido'];
		  
		  $codeProdutoPassivo = $res_produtos['codeProdutoPassivo'];

		  
		  $sqlProdutoPassivo = mysqli_query($conexao_bd, "SELECT * FROM categoriaProdutosDiversosProdutos WHERE code = '$codeProdutoPassivo'");
		    while($resProdutoPassivo = mysqli_fetch_array($sqlProdutoPassivo)){
				$quantidadeProdutoPassivo = $resProdutoPassivo['quantidaVendida'];
		   }
		   
		   $quantidadeProdutoPassivo += $res_produto['quant'];
		   mysqli_query($conexao_bd, "UPDATE categoriaProdutosDiversosProdutos SET quantidaVendida = '$quantidadeProdutoPassivo' WHERE code = '$codeProdutoPassivo'");
			
			
			
		  $estoque_atual = $res_produtos['estoque'];
		  
		  $comissao = $res_produtos['comissao'];
		  
			$valor_venda = 0;
			$valor_compra = 0;
			if($filial == 'JERI'){
			$valor_venda = $res_produtos['valor_venda2'];
			$valor_compra = $res_produtos['valor_compra2'];
			}else{
			$valor_venda = $res_produtos['valor_venda'];
			$valor_compra = $res_produtos['valor_compra'];
			}		  
		  
		  
		  $soma_comissao = ($res_produtos['comissao']*$res_produto['quant'])+$soma_comissao;
		  $soma_lucro = (($valor_venda-$valor_compra)*$res_produto['quant'])+$soma_lucro;
		  
		  $quant_vendida = $res_produtos['quant_vendida'];
		  $quant = $res_produto['quant'];
		  $tipo = $res_produto['tipo'];
		  
		  $quant_novo = ($estoque_atual-$quant_comprada);
		  
		  $valor_da_comissao = $comissao*$quant;
		  
		  mysqli_query($conexao_bd, "INSERT INTO comissao (data, data_completa, dia, mes, ano, status, operador, descricao, valor, ip, cliente, produto, carrinho, quantidade, tipo) VALUES ('$data', '$data_completa', '$dia', '$mes', '$ano', 'Aguarda', '$operador', '$titulo_resumido', '$valor_da_comissao', '$ip', '$cliente', '$code_produto', '$code_carrinho', '$quant', '$tipo')");
		    
		  $quant_vendida = $quant_vendida+$quant_comprada;
		  mysqli_query($conexao_bd, "UPDATE produtos SET quant_vendida = '$quant_vendida' WHERE code = '$code_produto'");
		  
			   if($filial == 'JERI'){
			   $estoque_atual = $res_produtos['estoque2']-$quant_comprada;
			   $estoque2 = $res_produtos['estoque2'];
			   mysqli_query($conexao_bd, "UPDATE produtos SET estoque2 = '$estoque_atual' WHERE code = '$code_produto'");
			   }else{
			   $estoque_atual = $res_produtos['estoque']-$quant_comprada;
			   mysqli_query($conexao_bd, "UPDATE produtos SET estoque = '$estoque_atual' WHERE code = '$code_produto'");
			   }
			   
			   
			   
	 ?></h1></td>
  </tr>
  <tr>
    <td colspan="2" align="center" bgcolor="#CCCCCC"><h1 class="h5"><strong>VR. UNIT&Aacute;Rio</strong></h1></td>
    <td width="78" align="center" bgcolor="#CCCCCC"><h1 class="h5"><strong>QUANTIDADE</strong></h1></td>
    <td colspan="2" align="center" bgcolor="#CCCCCC"><h1 class="h5"><strong>TOTAL TOTAL</strong></h1></td>
  </tr>
  <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><h1 class="h5">R$ <? echo number_format(($res_produto['valor']/$res_produto['quant']),2,',','.'); ?></h1></td>
    <td width="78" align="center" bgcolor="#FFFFFF"><h1 class="h5"><? echo $res_produto['quant']; ?></h1></td>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><h1 class="h5">R$ <? $valor_total = $valor_total+$res_produto['valor']; echo number_format($res_produto['valor'],2,',','.'); ?></h1></td>
  </tr>
  <? }} ?>
  <tr>
    <td colspan="5" align="center" bgcolor="#CCCCCC"><strong>VALOR TOTAL DO CARRINHO</strong></td>
  </tr>
  <tr>
    <td colspan="5" align="center" bgcolor="#FFFFFF">R$ <? $valor_pontos = number_format($valor_total); echo number_format($valor_total,2,',','.'); ?></td>
  
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
    <td colspan="5" align="center" bgcolor="#CCCCCC"><strong>PAGAMENTO</strong></td>
  </tr>
  <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><h1 class="h5"><strong>VALOR</strong></h1></td>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><h1 class="h5"><strong>FORMA DE PAGAMENTO</strong></h1></td>
    <td width="49" align="center" bgcolor="#FFFFFF"><h1 class="h5"><strong>TROCO</strong></h1></td>
  </tr>
  <?
  $soma_dinheiro = 0;
  $soma_cartao_credito = 0;
  $soma_cartao_debito = 0;
  $pagamento = mysqli_query($conexao_bd,"SELECT * FROM pagamento_carrinho WHERE code_carrinho = '$code_carrinho'");
  while($res_pagamento = mysqli_fetch_array($pagamento)){
  ?>
  
  <? if($res_pagamento['form_pag'] == 'DINHEIRO'){ $soma_dinheiro = $res_pagamento['valor_fornecido']+$soma_dinheiro; ?>
  <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><h1 class="h5">r$ <? echo number_format($res_pagamento['valor_fornecido'],2,',','.'); ?></h1></td>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><h1 class="h5"><? echo $res_pagamento['form_pag']; ?></h1></td>
    <td align="center" bgcolor="#FFFFFF"><? echo number_format($res_pagamento['troco'],2,',','.'); ?></td>
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
    <td colspan="2" align="center" bgcolor="#FFFFFF"><h1 class="h5">r$ <? echo number_format($res_pagamento['valor_total'],2,',','.'); ?></h1></td>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><h1 class="h5"><? echo $res_pagamento['form_pag']; ?></h1></td>
    <td align="center" bgcolor="#FFFFFF"><? echo number_format($res_pagamento['troco'],2,',','.'); ?></td>
  </tr>   
  <? } // fecha opção de pagamento do carrinho ?>
  
  
  <? } ?>
  <tr>
    <td height="18" colspan="5" style="font:10px Arial, Helvetica, sans-serif; margin:0;  padding:0;" align="left" bgcolor="#FFFFFF">
    <strong>PARA TROCA</strong><br />
    <strong style="text-transform:lowercase;">É obrigatório apresentar este cupom e:</strong>
    <ul style="margin:5px 0 0 -20px; text-transform:lowercase;">
      <li>Apresentar este comprovante de compra juntamente com o produto, inclusive as embalagens intactas em até 7 DIAS.</li>
      <li>Todos os acessórios devem estar intactos.</li>
      <li>Só efetuamos a troca em caso de defeito de fabricação.</li>
      <li>Após 7 dias, o cliente deve enviar um e-mail para suporte@ikuly.com</li>
    </ul>
    	
    </td>
  </tr>
  <tr>
    <td height="18" align="center" colspan="5" style="margin:0; padding:0;" bgcolor="#FFFFFF"><img style="margin:-2px auto;" alt="" id="barcode1"/></td>
  </tr>
  

<script>
	var url = new URL(window.location.href);			
	var produto = <? echo $code_carrinho; ?>;
	JsBarcode("#barcode1", produto);
</script>  

<? $codigo_produto = $code_carrinho; $tipo_servico = "COMPRA DE PRODUTOS"; require "gerar_cupom_sorteio.php"; ?>

<?

mysqli_query($conexao_bd, "UPDATE carrinho SET status = 'Encerrado' WHERE code_carrinho = '$code_carrinho'"); 

mysqli_query($conexao_bd, "UPDATE produtos_caixa SET status = 'Encerrado' WHERE code_carrinho = '$code_carrinho'");   

mysqli_query($conexao_bd, "DELETE FROM pagamento_carrinho WHERE valor_total = '0'");   
mysqli_query($conexao_bd, "DELETE FROM pagamento_carrinho WHERE valor_total = 'f'");   

mysqli_query($conexao_bd, "UPDATE pagamento_carrinho SET status = 'Encerrado' WHERE code_carrinho = '$code_carrinho'"); 

}?>

<?  ?>

<?  if($cliente != ''){ ?>

<table width="300" border="0" style="page-break-before: always;">
  <tr>
    <td width="296" colspan="2" align="center" bgcolor="#FFF"><h2><img src="../img/logoComprovante.fw.png" width="229" height="110" /></h2>
      <h2 style="width:300px; color:#000;"><strong>DESCONTOS EXLUSIVOS PARA VOC&Ecirc; QUE &Eacute; CLIENTE VIP VESTE PRIME</strong></h2>
    </td>
  </tr>
  <tr>
    <td bgcolor="#FFF"><strong>CLIENTE VIP</strong><BR /><? 
	$sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '$cliente'");
		while($res_cliente = mysqli_fetch_array($sql_cliente)){
			echo $res_cliente['nome'];
		}
		?>    </td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#CCCCCC"><h1 style="width:300px;">VENCIMENTO DAS OFERTAS ABAIXO <? 
		
		$sql_code_vencimento = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento WHERE codigo = '".($code_vencimento_hoje+5)."'");
		
		while($res_code_vencimento = mysqli_fetch_array($sql_code_vencimento)){
			echo $res_code_vencimento['vencimento'];
		}
	
	
	
	?></h1></td>
  </tr>
  <tr>
  
    <td align="center" bgcolor="#FFFFFF">
    
    <?
	require "../code_vencimento.php";
	$code_desconto[7];
	$produtos_com_desconto[7];
	$code_categoria = 0;
	$estoque = 0;
	$gera_cupom = 0;

	$sql_caixa = mysqli_query($conexao_bd, "SELECT * FORM produtos_caixa WHERE cliente = '$cliente' AND data != '$data' ORDER BY rand() LIMIT 6");
	if(mysqli_num_rows($sql_caixa) == ''){
		  for($i=0; $i<=15; $i++){			  
			  $sql_compras = mysqli_query($conexao_bd, "SELECT * FROM relacao_produto_categoria ORDER BY rand() LIMIT 1");
			   while($res_sql_compras = mysqli_fetch_array($sql_compras)){		  
			  $gera_cupom = rand(125129,954781);
			  $produtos_com_desconto = $res_sql_compras['produto'];
			  $valor_desconto = rand(5,15);
			  
			  mysqli_query($conexao_bd, "INSERT INTO cupom_descontos (status, cupom, limite_utilizacoes, total_utilizacoes, percentual, valor_desconto, usuario, vencimento, minimo_carrinho, produto, carrinho) VALUES ('Ativo', '$gera_cupom', '1', '0', '$valor_desconto', '', '$cliente', '".($code_vencimento+5)."', '', '$produtos_com_desconto', '$code_carrinho')");

					  		$produtos_com_desconto = 0;
			  
				} // while que pega o código do produto
		  } // fecha o for que gera os 5 produtos com desconto
	}else{
		while($res_compras_feitas = mysqli_fetch_array($sql_caixa)){

			$conta_produtos = mysqli_num_rows($sql_caixa);
			if($conta_produtos <5){
				  for($i=0; $i<=15; $i++){			  
					  $sql_compras = mysqli_query($conexao_bd, "SELECT * FROM relacao_produto_categoria ORDER BY rand() LIMIT 1");
					   while($res_sql_compras = mysqli_fetch_array($sql_compras)){		  
					  $gera_cupom = rand(125129,954781);
					  $produtos_com_desconto = $res_sql_compras['produto'];
					  $valor_desconto = rand(5,15);
					  
					  mysqli_query($conexao_bd, "INSERT INTO cupom_descontos (status, cupom, limite_utilizacoes, total_utilizacoes, percentual, valor_desconto, usuario, vencimento, minimo_carrinho, produto, carrinho) VALUES ('Ativo', '$gera_cupom', '1', '0', '$valor_desconto', '0', '$cliente', '".($code_vencimento+5)."', '0', '$produtos_com_desconto', '$code_carrinho')");
					  		$produtos_com_desconto = 0;

						} // while que pega o código do produto
				  } // fecha o for que gera os 5 produtos com desconto
			} // if que verifica se foram comprados apenas 3 produtos
			

			  $gera_cupom = rand(125129,954781);
			  $produtos_com_desconto = $res_sql_compras['code_produto'];
			  $valor_desconto = rand(5,15);
			  

			  mysqli_query($conexao_bd, "INSERT INTO cupom_descontos (status, cupom, limite_utilizacoes, total_utilizacoes, percentual, valor_desconto, usuario, vencimento, minimo_carrinho, produto, carrinho) VALUES ('Ativo', '$gera_cupom', '1', '0', '$valor_desconto', '', '$cliente', '".($code_vencimento+5)."', '', '$produtos_com_desconto', '$code_carrinho')");
				$produtos_com_desconto = 0;

		}
		
	} // verifica se existe compras do cliente no sistema
	?>

	<?php
    $quantidadeProdutos = 0;
    $sql_cupom_desconto = mysqli_query($conexao_bd, "SELECT * FROM cupom_descontos WHERE carrinho = '$code_carrinho'");
    
    while ($res_cupom = mysqli_fetch_array($sql_cupom_desconto)) {
        $sql_produto = mysqli_query($conexao_bd, "SELECT * FROM produtos WHERE code = '".$res_cupom['produto']."' AND estoque >= 1");
    
        while ($res_produto = mysqli_fetch_array($sql_produto)) {
            $valor_desconto = ($res_produto['valor_venda'] * (($res_cupom['percentual'] + 10) / 100));
    
            if ($quantidadeProdutos < 6 && $quantidadeProdutos < mysqli_num_rows($sql_cupom_desconto)) {
    ?>
	 <table width="305" border="0" style="border:2px solid #000; border-radius:5px; margin:0 0 3px 0;">
        <tr>
          <td width="70"><img src="<? echo $res_produto['foto']; ?>" alt="" width="70" height="70"></td>
          <td width="221"><h1 style="font:15px Arial, Helvetica, sans-serif; color:#000; margin:0 0 0 0;"><strong><? 
		  	
			for($i=0; $i<=20; $i++){
		  		echo $res_produto['titulo_resumido'][$i];
				
			}
			$quantidadeProdutos++;	 ?></strong></h1>
            <p style="font:10px Arial, Helvetica, sans-serif; margin:3px 0 -0px 0;">PRE&Ccedil;O NORMAL: <strong>R$ <? echo number_format($res_produto['valor_venda'],2,',','.'); ?></strong><br>
            <strong style="font:15px Arial, Helvetica, sans-serif;"><strong>PRA VOC&Ecirc;: R$ <? echo number_format($res_produto['valor_venda']-$valor_desconto,2,',','.'); ?></strong></strong></p>
          <h1 style="font:10px Arial, Helvetica, sans-serif; color:#000;"><strong>CUPOM:</strong> <? echo $res_cupom['cupom']; ?></h1></td>
        </tr>
      </table>
     <? }}} ?>        
    </td>
  </tr>
  <tr>
    <td height="38" colspan="2" align="left" bgcolor="#FFFFFF">
    <hr>
    <ul>
      <li>
        <h1 class="h5">A promo&ccedil;&atilde;o acima s&oacute; &eacute; v&aacute;lida para o dia, não podendo ser prorrogada para outro dia.</h1>
      </li>
    </ul></td>
  </tr>
</table>    
</table>
<? } ?>

<? ?>


<?
$sql_clientes_emprestimo_carne = mysqli_query($conexao_bd, "SELECT * FROM clientes_emprestimo_carne WHERE cliente = '$cliente' AND limite >0");	
if(mysqli_num_rows($sql_clientes_emprestimo_carne) == ''){
}else{
	while($res_clientes_emprestimo_carne = mysqli_fetch_array($sql_clientes_emprestimo_carne)){
 
 $sql_boletos_emprestimo_boleto = mysqli_query($conexao_bd, "SELECT * FROM boletos_emprestimo_boleto WHERE cliente = '$cliente' AND status = 'AGUARDA'");
 if(mysqli_num_rows($sql_boletos_emprestimo_boleto) >1){
 }else{
?>
<table width="300" border="0" style="page-break-before: always;">
  <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><h2><img src="../img/logoComprovante.fw.png" width="229" height="110" /></h2>
      <h2 style="width:300px; color:#000;"><strong>TEMOS UMA OFERTA DE CR&Eacute;CR&Eacute;DITO PESSOAL DISPONÍVEL PARA VOCÊ. APROVEITE!</strong></h2>
    </td>
  </tr>
  <tr>
    <td bgcolor="#FFF"><strong>CLIENTE VIP</strong><BR /><? 
	$sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '$cliente'");
		while($res_cliente = mysqli_fetch_array($sql_cliente)){
			echo $res_cliente['nome'];
		}	
		?>    </td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#FFF"><h1 style="width:300px; color:#000;"><hr />VALOR DO CRÉDITO<br>R$ <? echo number_format($res_clientes_emprestimo_carne['limite'],2,',','.'); ?></h1></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#FFF"><h3 style="font:15px Arial, Helvetica, sans-serif; margin:0; padding:0;"><strong>SIMULAÇÃO DO CRÉDITO</strong></h3></td>
  </tr>
  <? for($i=18; $i>=4; $i--){ ?>
  <tr>
    <td align="center" bgcolor="#FFFFFF"><h3 style="font:25px Arial, Helvetica, sans-serif; margin:0; padding:0;"><strong><? echo $i; ?> X R$
    <? 
	$limite = $res_clientes_emprestimo_carne['limite'];
	$taxa = ($res_clientes_emprestimo_carne['juros']/100);
	echo number_format((($limite*$taxa*$i)+$limite)/$i,2,',','.'); ?></strong></h3></td>
  </tr>
  <? } ?>
  <tr>
    <td height="38" colspan="2" align="left" bgcolor="#FFFFFF">
    <hr>
    <ul style="margin:-5px 0 0 -10px; font:9px Arial, Helvetica, sans-serif; text-transform:lowercase;">
      <li>Esta oferta passará por análise de crédito e este demonstrativo não garante aprovação.</li>
      <li>A oferta mostrada acima é válida por tempo determinado e pode ser cancelada ou alterAda a qualquer momento sem aviso prévio.</li>
    </ul></td>
  </tr>
</table>    
</table>
<? }}} ?>


</div><!-- topo_geral -->
</body>
</html>