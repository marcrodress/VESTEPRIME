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
    <td width="303"><img src="../img/logo.png" width="288" height="143"></td>
    <td colspan="4" align="center" bgcolor="#CCCCCC"><h1>VESTE PRIME - VESTU&Aacute;RIO E ELETR&Ocirc;NICOS</h1>
    <p>CNPJ: 32.450.862/0001-02<br />
RUA. CAPITAO INÁCIO PRATA- 2010 - TAIBA <br />
SÃO GONÇALO DO AMARANTE<br />
<strong>CEP: </strong>62670-000<br />
<strong>TELEFONE: </strong>(85) 3315.6199</p></td>
  </tr>
  <tr>
    <td colspan="5" align="center" bgcolor="#FFFFFF"><h2 class="h2"><strong><? echo $res_cliente['nome']; ?></strong>  <br />    
    <? echo $res_cliente['endereco']; ?> - <? echo $res_cliente['n_residencia']; ?> <br />
<? echo $res_cliente['bairro']; ?> - <? echo $res_cliente['cidade']; ?> - 
CEP: <? echo $res_cliente['cep']; ?> - <? echo $res_cliente['estado']; ?></h2></td>
    </tr>
  <tr>
    <td colspan="2" rowspan="4" bgcolor="#669900"><h2 class="h5"><strong>LIMITES</strong></h2>
      <ul>
        <li class="li"><strong>LIMITE DE COMPRAS</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;R$ <? echo number_format($res_limites['limite_loja'], 2, ',', '.'); ?></li>
       <li class="li"><strong>LIMITE FINANCIAMENTO</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;R$ <? echo number_format($res_limites['pagamento_contas'], 2, ',', '.'); ?></li>
        <li class="li"><strong>LIMITE DE SAQUE</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;R$ <? echo number_format($res_limites['saque_facil'], 2, ',', '.'); ?></li>
        <li class="li"><strong>CR&Eacute;DITO PESSOAL</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;R$ <? echo number_format($res_limites['credito_pessoal'], 2, ',', '.'); ?></li>
      </ul>
      </td>
    <td colspan="3" align="center" bgcolor="#00CCFF"><strong>FATURA MENSAL VESTE PRIME CARD</strong>
      <hr /><h1 class="h1"><strong>VENCIMENTO:</strong> <? echo $res_fatura['vencimento']; ?></h1></td>
    </tr>
  <tr>
    <td colspan="2" align="center"><strong>Nº DO CARTÃO:</strong> <? echo $res_limites['cartao']; ?></td>
    <td align="center"><strong>FATURA N&ordm;: </strong><? echo $_GET['code_fatura']; ?></td>
    </tr>
  <tr>
    <td width="235" align="center" bgcolor="#CCCCCC"><strong>VALOR TOTAL DESTA FATURA</strong></td>
    <td width="257" align="center" bgcolor="#CCCCCC"><strong>PAGAMENTO M&Iacute;NIMO</strong></td>
    <td width="206" align="center" bgcolor="#CCCCCC"><strong>SALDO ANTERIOR</strong></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#003366"><h2 class="h4"><strong>R$ <? echo number_format($res_fatura['valor'], 2, ',', '.'); ?></strong></h2></td>
    <td align="center" bgcolor="#003366"><h2 class="h4"><strong>R$ <?  
	
	if($res_fatura['minimo'] <=0){
		echo "0,00";
	}else{
		echo number_format($res_fatura['minimo'], 2, ',', '.');
	}
	
	
	?></strong></h2></td>
    <td align="center" bgcolor="#993300"><h2 class="h4"><strong>R$ 
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
    <td colspan="5" align="center" bgcolor="#3399FF"><strong>RESUMO</strong></td>
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
      <li><? echo $res_parcelada['data_compra']; ?> - COMPRA VESTE PRIME &nbsp; <? echo $res_carrinho['code_carrinho']; ?> - <? echo $res_parcelada['parcela']; ?> -&nbsp;R$ <? echo number_format($res_lancamentos['valor'], 2, ',', '.'); ?></li>
    <? }} ?>            
    	
	<? }else{ ?>
      <li><? echo $res_lancamentos['data']; ?> - ANUIDADE TITULAR &nbsp; 15225 - &nbsp;R$ <? echo number_format($res_lancamentos['valor'], 2, ',', '.'); ?></li>      
      <? }} ?>
      
      <?
	  $multa_atraso = 0;
	  $mora = 0;
	  $dias_juros = 0;
      $sql_busca_juros = mysqli_query($conexao_bd, "SELECT * FROM juros_cartao WHERE fatura_lancamento = '".$_GET['code_fatura']."'");
	  if(mysqli_num_rows($sql_busca_juros) == ''){
	  }else{
		  while($res_busca_juros = mysqli_fetch_array($sql_busca_juros)){
			  if($res_busca_juros['multa_atraso'] == ''){
			  }else{
			    $multa_atraso = $res_busca_juros['multa_atraso'];
			  }
			  $mora = $res_busca_juros['mora_atraso'];
			  $dias_juros = $res_busca_juros['dias_atraso'];
		  }
	  ?>
      <li>MULTA CONTRATUAL POR ATRASO - &nbsp;R$ <? echo number_format($multa_atraso, 2, ',', '.'); ?></li>      
      <li>JUROS DE MORA - <? echo $dias_juros ?> dia(s) &nbsp; - &nbsp;R$ <? echo number_format($mora, 2, ',', '.'); ?></li>      
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
    <td height="22" colspan="3" rowspan="2"><p><strong>Encargos</strong></p>
      <p>&nbsp; </p>
      <ul>
        <li>Financiamento da fatura &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;29,99%</li>
        <li>Parcelamento de fatura  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 29,99%</li>
        <li>Juros Juros atraso contratual&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;0,9% a.d</li>
        <li>Multa por Atraso&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;19,99%</li>
        <li>Mora&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;0,9% a.d.</li>
        <li>Multa por Atraso&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 4,5%</li>
        <li>IOF&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;0,00082% dia + 0,38% adicional</li>
        <li></li>
    </ul>
      <p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td colspan="2"><p><strong>CET</strong></p>
      <ul>
        <li>CET parcelamento de fatura&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;29,99%.a.m.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1.289,00% a.a</li>
        <li>CET financiamento de fatura  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 29,99%.a.m.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1.289,00% a.a</li>
        <li>CET max. anual&nbsp;&nbsp;&nbsp;     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;49,98%.a.m.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1.290,34% a.a</li>
        <li></li>
      </ul>
      <p>&nbsp;</p>
      <p>&nbsp;</p></td>
    </tr>
  <tr>
    <td height="19" colspan="2"><p><strong><em>CONTRATE O SEGURO DO SEU CART&Atilde;O E FIQUE LIVRE DE D&Oacute; DE CABE&Ccedil;A</em></strong></p>
      <p>POR APENAS R$ 6,99 POR M&Ecirc;S VOC&Ecirc; FICA ISENTO DA FATURA CASO PERCA O EMPREGO INVOLUNTARIAMENTE.</p></td>
  </tr>
  <tr>
    <td colspan="5">Em caso de pagamento de qualquer valor abaixo do valor total da fatura, o cliente dever&aacute; arcar com as taxas e encargos previstos nesta fatura. O cliente que pagar abaixo do valor de 40% do valor total da fatura ficar&aacute; em atraso e arcar&aacute; com os encargos deste per&iacute;odo de atraso, apontadas nesta fatura. As op&ccedil;&otilde;es de parcelamento se caracterizar&atilde;o como financiamento.<br />Ao pagar o valor igual ou menor que o m&iacute;nimo o cliente concorda que o saldo restante incidir&aacute; dos encargos previstos em contrato assinado e concordado com o cliente.</td>
  </tr>
  <tr>
    <td colspan="3" align="center" bgcolor="#00CCFF"><h2><strong>FA&Ccedil;A J&Aacute; SEU CR&Eacute;DITO PESSOAL</strong></h2></td>
    <td colspan="2" align="center" bgcolor="#CCCCCC"><strong>AVISOS E INFORMES</strong></td>
  </tr>
  <tr>
    <td height="19" colspan="3" align="center">PARAB&Eacute;NS, VOC&Ecirc; TEM UM LIMITE DE CR&Eacute;DITO PESSOAL PR&Eacute;-APROVADO. USE AGORA E REALIZE SEUS SONHOS!</td>
    <td colspan="2" rowspan="3" align="center"><p>INFORMAMOS QUE APARTIR DO DIA 01/06/2019, O VALOR DA ANUIDADE SER&Aacute; REAJUSTADO PARA<strong> R$ 5,99</strong>.</p>
      <hr />
      <p>O <a href="../faturas/<? echo $res_fatura['anexo_boleto'] ?>">BOLETO</a> PARA PAGAMENTO SE ENCONTRA EM ANEXO</p></td>
    </tr>
  <tr>
    <td colspan="3" align="center" bgcolor="#00CC00"><span class="h6"><strong>R$ <span class="li"><? echo number_format($res_limites['credito_pessoal'], 2, ',', '.'); ?></span></strong></span></td>
    </tr>
  <tr>
    <td colspan="3">
      <? for($i=2; $i<=12; $i++){ ?>
      <p><? echo $i; ?> x <? echo number_format((($res_limites['credito_pessoal']*0.1199*$i)+$res_limites['credito_pessoal'])/$i,2); ?></p>
      <? } ?>
      <p>* A concess&atilde;o de empr&eacute;stimo est&aacute; sujeita a analise e aprova&ccedil;&atilde;o de cadastro e cr&eacute;dito e os valores acima podem variar sem no momento da contrata&ccedil;&atilde;o.</p></td>
  </tr>
  </table>
</div><!-- box -->
<? }}}} // fecha a fatura ?>
</body>
</html>