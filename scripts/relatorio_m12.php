<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>RELAT�RIO DE CONFERENCIA MANUAL</title>
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


<script language="javascript">window.print();</script>
<table width="338" border="1">
  <tr>
    <td align="center" colspan="2"><strong>RELAT&Oacute;RIO DE AUTORIZA��O M12</strong><br />
      Data: <? echo $_GET['data']; ?><br />Operador: <? echo $operador = $_GET['operador']; ?></td>
  </tr>
  <tr>
    <td width="195" bgcolor="#CCCCCC"><strong>TIPO</strong></td>
    <td width="127" bgcolor="#CCCCCC"><strong>VALOR</strong></td>
  </tr>

  <? $pagamento_contas = 0;
   $sql_pagamento = mysqli_query($conexao_bd, "SELECT * FROM pagamento_boletos_opcoes WHERE data = '".$_GET['data']."' AND operador = '$operador' AND forma_pagamento = 'M12'");
   while($res_pagamento = mysqli_fetch_array($sql_pagamento)){ $pagamento_contas =+$res_pagamento['valor'];
  ?>
  <tr>
    <td>Pagamento de contas</td>
    <td>R$ <? echo number_format($res_pagamento['valor'],2,',','.'); ?></td>
  </tr>
  <? } ?>
  
  <? $recarga_prepago = 0;
   $sql_celular = mysqli_query($conexao_bd, "SELECT * FROM recarga_prepago WHERE data = '".$_GET['data']."' AND operador = '$operador' AND forma_pagamento = 'M12'");
   while($res_celular = mysqli_fetch_array($sql_celular)){ $recarga_prepago+=$res_celular['valor'];
  ?>
  <tr>
    <td>Recarga de celular</td>
    <td>R$ <? echo number_format($res_celular['valor'],2,',','.'); ?></td>
  </tr>
  <? } ?>
  
  <? $recargaTvPrepago = 0;
   $sql_tv = mysqli_query($conexao_bd, "SELECT * FROM recarga_tv_prepago WHERE data = '".$_GET['data']."' AND operador = '$operador' AND forma_pagamento = 'M12'");
   while($res_tv = mysqli_fetch_array($sql_tv)){ $recargaTvPrepago+=$res_tv['valor'];
  ?>  
  <tr>
    <td>Recarga de TV Pr&eacute;-pago</td>
    <td>R$ <? echo number_format($res_tv['valor'],2,',','.'); ?></td>
  </tr>
  <? } ?>
  <? $vendaProdutos = 0;
   $sql_produtos = mysqli_query($conexao_bd, "SELECT * FROM pagamento_carrinho WHERE data = '".$_GET['data']."' AND operador = '$operador' AND form_pag = 'M12'");
   while($res_produtos = mysqli_fetch_array($sql_produtos)){ $vendaProdutos+=$res_produtos['valor_total'];
  ?>  
  <tr>
    <td>Venda de produtos</td>
    <td>R$ <? echo number_format($res_produtos['valor_total'],2,',','.'); ?></td>
  </tr>
  <? } ?>
  
 
  <tr>
    <td bgcolor="#CCCCCC" align="right"><strong>Valor transacionado</strong></td>
    <td>R$ <? echo number_format($vendaProdutos+$recarga_prepago+$recebimentoFaturas+$recargaTvPrepago+$rifaOnline+$saque_pix+$pagamento_contas,2,',','.'); ?></td>
  </tr>
</table>
</body>
</html>