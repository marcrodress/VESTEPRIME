<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>FATURA PRIVATE LABEL</title>
<link href="css/fatura_fechada.css" rel="stylesheet" type="text/css" />
</head>

<body>
<? require "../conexao.php"; 

$sql_busca_fatura = mysqli_query($conexao_bd, "SELECT * FROM faturas_fechadas WHERE code_fatura = '".$_GET['code_fatura']."'");
if(mysqli_num_rows($sql_busca_fatura) == ''){
}else{
	while($res_fatura = mysqli_fetch_array($sql_busca_fatura)){
		
	$sql_busca_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '".$res_fatura['cliente']."'");
	$sql_busca_limites = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente WHERE cliente = '".$res_fatura['cliente']."'");
	
	while($res_cliente = mysqli_fetch_array($sql_busca_cliente)){
	while($res_limites = mysqli_fetch_array($sql_busca_limites)){

?>
<div id="box">
<table width="1010" border="0">
  <tr>
    <td class="td" align="center" width="295"><img src="../img/index.png" width="210" height="110"></td>
    <td colspan="4" align="center" bgcolor="#FFFFFF"><h1 style="font:22px Arial, Helvetica, sans-serif;"><strong>VESTE PRIME -  ELETR&Ocirc;NICOS E ACESSORIOS DE CELULARES</strong></h1>
    <p>CNPJ: 32.450.862/0001-02<br />
RUA. CAPITAO INÁCIO PRATA- 2010 - TAIBA <br />
SÃO GONÇALO DO AMARANTE<br />
<strong>CEP: </strong>62670-000<br />
    </p></td>
  </tr>
  <tr>
    <td colspan="5" align="center" bgcolor="#FFFFFF"><h2 class="h2"><strong><? echo $res_cliente['nome']; ?></strong>  <br />    
    <? echo $res_cliente['endereco']; ?> - <? echo $res_cliente['n_residencia']; ?> <br />
<? echo $res_cliente['bairro']; ?> - <? echo $res_cliente['cidade']; ?> - 
CEP: <? echo $res_cliente['cep']; ?> - <? echo $res_cliente['estado']; ?></h2></td>
    </tr>
  <tr>
    <td colspan="2" rowspan="4" bgcolor="#FFFFFF"><h2 class="h5"><strong>LIMITES</strong></h2>
      <ul>
        <li class="li"><strong>LIMITE DE COMPRAS</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;R$ <? echo number_format($res_limites['limite_loja'], 2, ',', '.'); ?></li>
       <li class="li"><strong>LIMITE FINANCIAMENTO</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;R$ <? echo number_format($res_limites['pagamento_contas'], 2, ',', '.'); ?></li>
        <li class="li"><strong>SAQUE F&Aacute;CIL</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;R$ <? echo number_format($res_limites['credito_pessoal'], 2, ',', '.'); ?></li>
        <li class="li"><strong>CR&Eacute;DITO PESSOAL</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;R$ <? 
		
		$sql_emprestimo_carne = mysqli_query($conexao_bd, "SELECT * FROM clientes_emprestimo_carne WHERE cliente = '".$res_fatura['cliente']."'");
		 while($res_emprestimo_carne = mysqli_fetch_array($sql_emprestimo_carne)){
			 echo number_format($res_emprestimo_carne['limite'], 2, ',', '.');
		 }
		
		 ?></li>
      </ul>
      </td>
    <td colspan="3" align="center" bgcolor="#FFFFFF"><strong>FATURA MENSAL VESTE PRIME CARD</strong>
      <hr /><h1 class="h1"><strong>VENCIMENTO:</strong> <? echo $res_fatura['vencimento']; ?></h1></td>
    </tr>
  <tr>
    <td colspan="2" align="center"><strong>Nº DO CARTÃO:</strong> <? echo $res_limites['cartao']; ?></td>
    <td align="center"><strong>FATURA N&ordm;: </strong><? echo $_GET['code_fatura']; ?></td>
    </tr>
  <tr>
    <td width="228" align="center" bgcolor="#FFFFFF"><strong>VALOR TOTAL</strong></td>
    <td width="206" align="center" bgcolor="#FFFFFF"><strong>PAGAMENTO M&Iacute;NIMO</strong></td>
    <td width="213" align="center" bgcolor="#FFFFFF"><strong>SALDO ANTERIOR</strong></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#FFFFFF"><h2 class="h4"><strong>R$ <? echo number_format($res_fatura['valor'], 2, ',', '.'); ?></strong></h2></td>
    <td align="center" bgcolor="#FFFFFF"><h2 class="h4"><strong>R$ <?  
	
	if($res_fatura['minimo'] <=0){
		echo "0,00";
	}else{
		echo number_format($res_fatura['minimo'], 2, ',', '.');
	}
	
	
	?></strong></h2></td>
    <td align="center" bgcolor="#FFFFFF"><h2 class="h4"><strong>R$ 
	<?  
	$saldo_anterior = 0;
	$sql_busca_ultima_fatura = mysqli_query($conexao_bd, "SELECT * FROM faturas_fechadas WHERE cliente = '".$res_fatura['cliente']."' AND code_fatura != '".$_GET['code_fatura']."' ORDER BY id DESC LIMIT 1");
	while($res_ultima_fatura = mysqli_fetch_array($sql_busca_ultima_fatura)){
			
			$saldo_anterior = $res_ultima_fatura['valor'];
			

   }
	
			if($saldo_anterior <=0){
			echo number_format(0, 2, ',', '.');
			}else{
			echo number_format($saldo_anterior, 2, ',', '.');
			}	
	?></strong></h2></td>
  </tr>
  <tr>
    <td colspan="5"><img src="../img/back_ground.png" width="1000" height="10"></td>
  </tr>
  <tr>
    <td colspan="5" align="center" bgcolor="#FFFFFF"><strong>RESUMO DE TRANSA&Ccedil;&Otilde;ES</strong></td>
    </tr>
  <tr>
    <td colspan="3"><strong>D&Eacute;BITOS</strong></td>
    <td colspan="2"><strong>CR&Eacute;DITOS</strong></td>
  </tr>
  <tr>
    <td colspan="3"><ul>
      <?
	$busca_lacamentos = mysqli_query($conexao_bd, "SELECT * FROM lancamento_fechados WHERE code_fatura = '".$_GET['code_fatura']."' AND status = 'Ativo'");
    	while($res_lancamentos = mysqli_fetch_array($busca_lacamentos)){
			
			$code_transacao = $res_lancamentos['code_transacao'];
			$n_parcela = $res_lancamentos['n_parcela'];
    
	if($n_parcela != 'ANUIDADE'){
	$busca_compras = mysqli_query($conexao_bd, "SELECT * FROM compras_parceladas WHERE code_transacao = '$code_transacao' AND n_parcela = '$n_parcela'");
    	while($res_parcelada = mysqli_fetch_array($busca_compras)){	

	$busca_carrinho = mysqli_query($conexao_bd, "SELECT * FROM lancamento_fatura WHERE code_transacao = '$code_transacao'");
    	while($res_carrinho = mysqli_fetch_array($busca_carrinho)){
	?>
      <li><? echo $res_parcelada['data_compra']; ?> - <? echo $res_carrinho['descricao']; ?> &nbsp; <? echo $res_carrinho['code_carrinho']; ?> - <? echo $res_parcelada['parcela']; ?> -&nbsp;R$ <? echo number_format($res_lancamentos['valor'], 2, ',', '.'); ?></li>
    <? }} ?>            
    	
	<? }else{ ?>
      <li><? echo $res_lancamentos['data']; ?> - ANUIDADE TITULAR &nbsp; - &nbsp;R$ <? echo number_format($res_lancamentos['valor'], 2, ',', '.'); ?></li>      
      <? }} ?>
      
      <?
		
		$multa = 0;
		$mora = 0;
		$juros = 0;
		$iof = 0;
		
      $sql_busca_juros = mysqli_query($conexao_bd, "SELECT * FROM juros_cartao WHERE fatura_lancamento = '".$_GET['code_fatura']."'");
	  if(mysqli_num_rows($sql_busca_juros) >=1){
		  while($res_busca_juros = mysqli_fetch_array($sql_busca_juros)){
			   
			    $multa = $res_busca_juros['multa_atraso']+$multa;				
				
			  if($res_busca_juros['mora_atraso']>0){
				  $mora = $res_busca_juros['mora_atraso']+$mora;
			  }
			  
			  if($res_busca_juros['juros']>0){
				  $juros = $res_busca_juros['juros']+$juros;
			  }
			  
				  $iof = $res_busca_juros['iof']+$iof;
			  }			  
	  }
	  ?>
      <li>MULTA CONTRATUAL POR ATRASO - &nbsp;R$ <? echo number_format($multa, 2, ',', '.'); ?></li>      
      <li>JUROS DE MORA - &nbsp;R$ <? echo number_format($mora, 2, ',', '.'); ?></li>      
      <li>JUROS REMUNERATÓRIO - &nbsp;R$ <? echo number_format($juros, 2, ',', '.'); ?></li>      
      <li>IOF - &nbsp;R$ <? echo number_format($iof, 2, ',', '.'); ?></li>      
	  <? } // fecha o while que verifica a existência de juros ?>
      
      <? if($saldo_anterior > 0){ ?>
      <li>SALDO DA FATURA ANTERIOR - &nbsp;R$ <? echo number_format($saldo_anterior, 2, ',', '.'); ?></li>      
      <? } ?>      
      
      </ul>      </td>
    <td colspan="2">
    <ul>
     <? 
	$busca_pagamentos = mysqli_query($conexao_bd, "SELECT * FROM pagamentos_fechados WHERE code_fatura = '".$_GET['code_fatura']."' AND status = 'Ativo'");
    	while($res_pagamentos = mysqli_fetch_array($busca_pagamentos)){
			
			$id_pagamento = $res_pagamentos['id_pagamento'];

	$busca_PAG = mysqli_query($conexao_bd, "SELECT * FROM pagamento_fatura WHERE id = '$id_pagamento'");
    	while($res_PAG = mysqli_fetch_array($busca_PAG)){
	
	?>
    <li><? echo $res_PAG['data']; ?> PAGAMENTO RECEBIDO - <? echo number_format($res_PAG['valor'],2); ?></li>
    <? }} ?>
    </ul></td>
    </tr>
  <tr>
    <td colspan="5"><img src="../img/back_ground.png" alt="" width="1000" height="10"></td>
  </tr>
  <tr>
    <td height="22" colspan="3" rowspan="2"><strong>Encargos</strong><br />
      <ul>
        <li>Financiamento da fatura &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;29,99%</li>
        <li>Parcelamento de fatura  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 29,99%</li>
        <li>Juros Juros atraso contratual&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;0,9% a.d</li>
        <li>Multa por Atraso&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;19,99%</li>
        <li>Mora&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;0,9% a.d.</li>
        <li>Multa por Atraso&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 4,5%</li>
        <li>IOF&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;0,00082% dia + 0,38% adicional</li>
        <li></li>
    </ul>
      </td>
    <td colspan="2"><strong>CET</strong><br />
      <ul>
        <li>CET parcelamento de fatura&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;29,99%.a.m.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1.289,00% a.a</li>
        <li>CET financiamento de fatura  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 29,99%.a.m.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1.289,00% a.a</li>
        <li>CET max. anual&nbsp;&nbsp;&nbsp;     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;49,98%.a.m.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1.290,34% a.a</li>
        <li></li>
      </ul>
      <p>&nbsp;</p>
      <p>&nbsp;</p></td>
    </tr>
  <tr>
    <td height="19" colspan="2"><p style="color:#F00;"><strong><em>ALTERA&Ccedil;&Atilde;O DA ANUIDADE DO SEU CART&Atilde;O</em></strong></p>
      <p>Informamos que a anuidade do cart&atilde;o ir&aacute; de R$ 5,99 para R$ 7,99 a partir do m&ecirc;s abril de 2020</p></td>
  </tr>
  <tr>
    <td colspan="5"><p>Em caso de pagamento de qualquer valor abaixo do valor total da fatura, o cliente dever&aacute; arcar com as taxas e encargos previstos nesta fatura. O cliente que pagar abaixo do valor de 40% do valor total da fatura ficar&aacute; em atraso e arcar&aacute; com os encargos deste per&iacute;odo de atraso, apontadas nesta fatura. As op&ccedil;&otilde;es de parcelamento se caracterizar&atilde;o como financiamento.<br />Ao pagar o valor igual ou menor que o m&iacute;nimo o cliente concorda que o saldo restante incidir&aacute; dos encargos previstos em contrato assinado e concordado com o cliente.</p></td>
  </tr>
  <tr>
    <td colspan="5" align="center"><h1 style="font:30px Arial, Helvetica, sans-serif; padding:0; margin:0;"><strong><img src="../img/382.png" width="20" height="20" />--------------------------------------------------------------------------------------------------</strong></h1>

  <table width="1000" class="table" border="0">
    <tr>
      <td class="td" width="115" align="center" rowspan="2">
      <img src="
      <?

	  $banco = $res_fatura['anexo_boleto'];
      
	  $banco1 = $banco['0'];
	  $banco2 = $banco['1'];
	  $banco3 = $banco['2'];
	  
	  $banco = "$banco1$banco2$banco3";
	  
	  /*
	  if($banco == '077'){
		echo "https://upload.wikimedia.org/wikipedia/commons/c/c1/Bancointer_oficial.png";
	  }elseif($banco == '341'){
		echo "https://tradersclub.com.br/wp-content/uploads/2019/01/itau.jpg";
	  }elseif($banco == '212'){
		echo "https://upload.wikimedia.org/wikipedia/commons/a/a5/LogoBancoOriginal.jpg";
	  }elseif($banco == '237'){
		echo "https://banco.bradesco/portal/layout/imagens/geral/logo.png";
	  }elseif($banco == '318'){
		echo "https://upload.wikimedia.org/wikipedia/commons/thumb/c/ca/Banco_BMG.svg/1200px-Banco_BMG.svg.png";
	  }else{
	  	echo "../img/logo.png";
	  }
	  */
	  
	  echo "https://seeklogo.com/images/B/Banco_do_Brasil-logo-5A0937E9EF-seeklogo.com.png";
	  
	  
	  ?>
      " width="100" height="60">
      </td>
      <td align="center" colspan="6"><h1 style="font:25px Arial, Helvetica, sans-serif; padding:0; margin:0;"><strong><? echo $banco; ?> - 9 | <? echo $res_fatura['anexo_boleto']; ?></strong></strong></h1></td>
      </tr>
    <tr>
      <td colspan="5"><h1 style="font:12px Arial, Helvetica, sans-serif; margin:0; padding:0;"><strong>Local de Pagamento</strong><br />
PAG&Aacute;VEL EM QUALQUER BANCO AT&Eacute; O VENCIMENTO</h1></td>
      <td width="150" bgcolor="#CCCCCC"><h1 style="font:12px Arial, Helvetica, sans-serif; margin:0; padding:0;  text-align:center;"><strong>VENCIMENTO</strong><br />
	  <? echo $res_fatura['vencimento']; ?>
      </h1></td>
      </tr>
    <tr>
      <td colspan="6" bgcolor="#FFFFFF"><h1 style="font:20px Arial, Helvetica, sans-serif; color:#F00;"><strong>N&Atilde;O RECEBER ESTE BOLETO AP&Oacute;S
        <?
		 
		  $data_vencimento = $res_fatura['vencimento'];
		 
		 $code_vencimento = 0;
		 $sql_vencimento = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento WHERE vencimento = '$data_vencimento'");
		 	while($res_vencimento = mysqli_fetch_array($sql_vencimento)){
				$code_vencimento = $res_vencimento['codigo']+19;
			}
			$sql_mostra_vencimento = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento WHERE codigo = '$code_vencimento'");
			 while($res_mostra_vencimento = mysqli_fetch_array($sql_mostra_vencimento)){
				 echo $res_mostra_vencimento['vencimento'];
			 }
			
					
		?>
      </strong></h1></td>
      <td><h1 style="font:12px Arial, Helvetica, sans-serif; margin:0; padding:0;  text-align:center;"><strong> Beneficiário</strong><br>00019/000000027</h1>
</td>
      </tr>
    <tr>
      <td><h1 style="font:12px Arial, Helvetica, sans-serif; margin:0; padding:0;  text-align:center;"><strong>Data Documento</strong><br /><? echo date("d/m/Y"); ?></h1></td>
      <td width="97"><h1 style="font:12px Arial, Helvetica, sans-serif; margin:0; padding:0;  text-align:center;"><strong>Nº Documento</strong><br />
        <? echo $res_fatura['sit_boleto']; ?></h1></td>
      <td width="176"><h1 style="font:12px Arial, Helvetica, sans-serif; margin:0; padding:0;  text-align:center;"><strong>Esp&eacute;cie</strong><br />
        REAL</h1></td>
      <td width="130"><h1 style="font:12px Arial, Helvetica, sans-serif; margin:0; padding:0;  text-align:center;"><strong>Carteira</strong><br />
        IB_PF</h1></td>
      <td align="center" width="138"><span style="font:12px Arial, Helvetica, sans-serif; margin:0; padding:0;  text-align:center;"><strong>Uso do Banco</strong><br />
        0000005</span></td>
      <td align="center" width="154"><span style="font:12px Arial, Helvetica, sans-serif; margin:0; padding:0;  text-align:center;"><strong>Aceite</strong><br />
         NAO
</span></td>
      <td bgcolor="#CCCCCC"><h1 style="font:12px Arial, Helvetica, sans-serif; margin:0; padding:0;  text-align:center;"><strong>( = ) Valor do Documento</strong><br /> R$ <? echo number_format($res_fatura['valor'], 2, ',', '.'); ?></h1></td>
      </tr>
    <tr>
      <td colspan="6" rowspan="5"><h1 style="font:15px Arial, Helvetica, sans-serif;"><strong>ATEN&Ccedil;&Atilde;O SENHOR CAIXA</strong></h1>
        <hr />
<h2 style="font:12px Arial, Helvetica, sans-serif;"><strong>ATENÇÃO: N&Atilde;O ACEITAR VALOR MENOR QUE O TOTAL DA FATURA</strong></h2>
<h2 style="font:12px Arial, Helvetica, sans-serif;"><strong>
  OBSERVA&Ccedil;&Atilde;O: JUROS E MULTAS SER&Atilde;O COBRADOS NA OUTRA FATURA</strong></h2>
        <p style="font:12px Arial, Helvetica, sans-serif;">Em caso de dúvidas ligar para (85) 3315.6119 ou pelo WhatsApp  (11) 96665-9661</p></td>
      <td><h1 style="font:12px Arial, Helvetica, sans-serif; margin:0; padding:0;  text-align:center;">( - ) Desconto/Abatimento</h1></td>
      </tr>
    <tr>
      <td><h1 style="font:12px Arial, Helvetica, sans-serif; margin:0; padding:0;  text-align:center;">( - ) Outras Deduções</h1></td>
      </tr>
    <tr>
      <td><h1 style="font:12px Arial, Helvetica, sans-serif; margin:0; padding:0;  text-align:center;">( + ) Mora/Multa</h1></td>
      </tr>
    <tr>
      <td><h1 style="font:12px Arial, Helvetica, sans-serif; margin:0; padding:0;  text-align:center;">( + ) Outros Acréscimos</h1></td>
      </tr>
    <tr>
      <td bgcolor="#CCCCCC"><h1 style="font:15px Arial, Helvetica, sans-serif; margin:0; padding:0; text-align:center"><strong>( = ) Valor Cobrado</strong><br /> R$ <? echo number_format($res_fatura['valor'], 2, ',', '.'); ?></h1></td>
      </tr>
    <tr>
      <td colspan="6">
        <p><strong>PAGADOR:</strong><br /><span class="h2"><strong><? echo $res_cliente['nome']; ?></strong> <br />
            <? echo $res_cliente['endereco']; ?> - <? echo $res_cliente['n_residencia']; ?> - <? echo $res_cliente['bairro']; ?> <br />
             
CEP: <? echo $res_cliente['cep']; ?> - <? echo $res_cliente['cidade']; ?> - <? echo $res_cliente['estado']; ?></span></p></td>
      <td bgcolor="#FFFFFF"><p><strong>CPF: </strong><? echo $res_cliente['cpf']; ?></p>        
        <p>&nbsp;</p></td>
      </tr>
    <tr>
      <td class="td" colspan="7"><img src="../img/code_barras.png" width="500" height="50" /></td>
      </tr>
</table>
      
      
      </td>
  </tr>
  </table>
</div><!-- box -->
<? }}} // fecha a fatura ?>
</body>
</html>