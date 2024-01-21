<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>RELATÓRIO DE CONFERENCIA MANUAL</title>
<style type="text/css">
body{
	padding:0;
	margin:0;
	}
body,td,th {
	font:15px Arial, Helvetica, sans-serif;
}
</style>
</head>

<body>
<? require "../conexao.php"; ?>


<table width="338" border="1">
  <tr>
    <td align="center" colspan="2"><strong>RELAT&Oacute;RIO DE CARTÕES</strong><br />
      Data: <? echo $_GET['data']; ?><br />Operador: <? echo $operador = $_GET['operador']; ?></td>
  </tr>
  <tr>
    <td width="195" bgcolor="#CCCCCC"><strong>TIPO</strong></td>
    <td width="127" bgcolor="#CCCCCC"><strong>VALOR</strong></td>
  </tr>
  <? $saquedebito = 0;
   $sql_saques = mysqli_query($conexao_bd, "SELECT * FROM saques WHERE data = '".$_GET['data']."' AND operador = '$operador'");
   while($res_sques = mysqli_fetch_array($sql_saques)){ $saquedebito+=$res_sques['valor_cobrado'];
  ?>
  <tr>
    <td>Saque no d&eacute;bito</td>
    <td>R$ <? echo number_format($res_sques['valor_cobrado'],2,',','.'); ?></td>
  </tr>
  <? } ?>
  <? $emprestimoCartao = 0;
   $sql_pagamento = mysqli_query($conexao_bd, "SELECT * FROM emprestimo_cartao WHERE data = '".$_GET['data']."' AND operador = '$operador'");
   while($res_pagamento = mysqli_fetch_array($sql_pagamento)){ $emprestimoCartao =+$res_pagamento['valor_total'];
  ?>
  <tr>
    <td>Empréstimo no cartão</td>
    <td>R$ <? echo number_format($res_pagamento['valor_total'],2,',','.'); ?></td>
  </tr>
  <? } ?>
  
  <? $recarga_prepago = 0;
   $sql_celular = mysqli_query($conexao_bd, "SELECT * FROM recarga_prepago WHERE data = '".$_GET['data']."' AND operador = '$operador'");
   while($res_celular = mysqli_fetch_array($sql_celular)){
	  if($res_celular['forma_pagamento'] == 'CARTAO DE CREDITO' || $res_celular['forma_pagamento'] == 'CARTAO DE DEBITO'){
	    $recarga_prepago+=($res_celular['valor']+$res_celular['tarifa']);
  ?>
  <tr>
    <td>Recarga de celular</td>
    <td>R$ <? echo number_format(($res_celular['valor']+$res_celular['tarifa']),2,',','.'); ?></td>
  </tr>
  <? }} ?>
  
  <? $recargaTvPrepago = 0;
   $sql_tv = mysqli_query($conexao_bd, "SELECT * FROM recarga_tv_prepago WHERE data = '".$_GET['data']."' AND operador = '$operador'");
   while($res_tv = mysqli_fetch_array($sql_tv)){ 
   	if($res_tv['forma_pagamento'] == 'CARTAO DE CREDITO' || $res_tv['forma_pagamento'] == 'CARTAO DE DEBITO'){
    $recargaTvPrepago+=$res_tv['valor'];
  ?>  
  <tr>
    <td>Recarga de TV Pr&eacute;-pago</td>
    <td>R$ <? echo number_format($res_tv['valor'],2,',','.'); ?></td>
  </tr>
  <? }} ?>
  
  <? $vendaProdutos = 0;
   $sql_produtos = mysqli_query($conexao_bd, "SELECT * FROM pagamento_carrinho WHERE data = '".$_GET['data']."' AND operador = '$operador'");
   while($res_produtos = mysqli_fetch_array($sql_produtos)){ 
   	if($res_produtos['form_pag'] == 'CARTÃO DE CRÉDITO' || $res_produtos['form_pag'] == 'CARTÃO DE DÉBITO'){
   $vendaProdutos+=$res_produtos['valor_total'];
  ?>  
  <tr>
    <td>Venda de produtos</td>
    <td>R$ <? echo number_format($res_produtos['valor_total'],2,',','.'); ?></td>
  </tr>
  <? }} ?>
  
  
  <? $rifaOnline = 0;
   $sql_rifa = mysqli_query($conexao_bd, "SELECT * FROM rifas_cupons WHERE data = '".$_GET['data']."' AND operador = '$operador'");
   while($res_rifa = mysqli_fetch_array($sql_rifa)){ 
      	if($res_rifa['forma_pagamento'] == 'CARTAO DE DEBITO' || $res_rifa['forma_pagamento'] == 'CARTAO DE CREDITO'){
			$rifaOnline+=$res_rifa['valor'];
  ?>  
  <tr>
    <td>Rifas Online</td>
    <td>R$ <? echo number_format($res_rifa['valor'],2,',','.'); ?></td>
  </tr>
  <? }} ?>
   
  <tr>
    <td bgcolor="#CCCCCC" align="right"><strong>Valor transacionado</strong></td>
    <td>R$ <? echo number_format($vendaProdutos+$recarga_prepago+$emprestimoCartao+$recebimentoFaturas+$recargaTvPrepago+$rifaOnline+$saque_pix+$pagamento_contas,2,',','.'); ?></td>
  </tr>
</table>
</body>
</html>