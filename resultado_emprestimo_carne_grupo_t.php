<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/resultado_emprestimo_carne.css" rel="stylesheet" type="text/css" />
</head>

<body>
<? require "topo.php";  require "scripts/verificador_caixa.php"; ?>
<div id="box_pagamento_1">
<hr />
<h1 style="font:15px Arial, Helvetica, sans-serif; margin:10px;"><strong>SOLICITA&Ccedil;&Otilde;ES DE CR&Eacute;DITO</strong></h1>
<table class="table" width="1000" border="0">
  <tr>
    <td width="82" bgcolor="#666666"><h3><strong>PROPÓSTA</strong></h3></td>
    <td width="70" bgcolor="#666666"><h3><strong>DATA</strong></h3></td>
    <td width="75" bgcolor="#666666"><h3><strong>STATUS</strong></h3></td>
    <td width="217" bgcolor="#666666"><h3><strong>CLIENTE</strong></h3></td>
    <td width="96" bgcolor="#666666"><h3><strong>VALOR</strong></h3></td>
    <td width="70" bgcolor="#666666"><h3><strong>N&ordm;. PARCE.</strong></h3></td>
    <td width="80" bgcolor="#666666"><h3><strong>VENCIMENTO</strong></h3></td>
    <td width="98" bgcolor="#666666"><h3><strong>VL. PARCELA</strong></h3></td>
    <td width="101" bgcolor="#666666"><h3><strong>VL. TOTAL</strong></h3></td>
    <td width="67" bgcolor="#666666"><h3><strong>OP&Ccedil;&Otilde;ES</strong></h3></td>
  </tr>
  <?
  $sql_1 = mysqli_query($conexao_bd, "SELECT * FROM emprestimo_boleto_unico WHERE status = 'APROVADO'");
  $valor = 0;
  $valor_total = 0;
  $valor_investido = 0;
  while($res_contratos = mysqli_fetch_array($sql_1)){
   $sql_registrincao_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes_restricao_email WHERE cliente = '".$res_contratos['cpf']."'");
   if(mysqli_num_rows($sql_registrincao_cliente) >=1){
   }else{
  $valor = $res_contratos['valor_parcela']+$valor; 
  $i++; 
  
  ?>
  <tr <? if($i%2 == 0){ echo "bgcolor='#666'"; }else{ echo "bgcolor='#333'"; } ?>>
    <td><? echo $res_contratos['n_proposta']; ?></td>
    <td><? echo $res_contratos['data']; ?></td>
    <td><? echo $res_contratos['status']; ?></td>
    <td><? 
	$sql_nome_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '".$res_contratos['cpf']."'");
		while($res_cliente = mysqli_fetch_array($sql_nome_cliente)){
			echo $res_cliente['nome'];
		}
	 ?></td>
    <td>R$ <? $valor_investido = $valor_investido+$res_contratos['valor']; echo number_format($res_contratos['valor'],2,',','.'); ?></td>
    <td><? echo $res_contratos['quant_parcela']; ?></td>
    <td><? echo $res_contratos['vencimento']; ?></td>
    <td>R$ <? echo number_format($res_contratos['valor_parcela'],2,',','.'); ?></td>
    <td>R$ <? $valor_total = $valor_total+$res_contratos['valor_total']; echo number_format($res_contratos['valor_total'],2,',','.'); ?></td>
    <td>
    <? if($res_contratos['status'] == 'APROVADO' || $tipo == 'ADM'){ ?>
    <a href="resultado_emprestimo_carne_grupo.php?p=2&n_proposta=<? echo $n_proposta = $res_contratos['n_proposta']; ?>"><img src="img/cadastro.fw.png" width="20" height="20" border="0" title="DETALHES DO PAGAMENTO" /></a>
    <? } ?>
    
    
    
    <? if($res_contratos['status'] != 'APROVADO' && $res_contratos['status'] != 'NEGADO' && $res_contratos['status'] != 'CANCELADO' && $res_contratos['status'] != 'TERMINADO'){ ?>
    <a href="?pg=cancela&id=<? echo $res_contratos['id']; ?>"><img src="img/bloquea.png" width="20" height="20" border="0" title="CANCELAR PRÓPOSTA DE CRÉDITO" /></a>
    <? } ?>
    
    
    
    </td>
  </tr>
  <? }} ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>R$ <? echo number_format($valor_investido,2,',','.'); ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>R$ <? echo number_format($valor,2,',','.'); ?></td>
    <td>R$ <? echo number_format($valor_total,2,',','.'); ?></td>
    <td>&nbsp;</td>
  </tr>
</table>
</div><!-- box_pagamento_1 -->
</body>
</html>