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
<? require "../conexao.php"; $operador = $_GET['operador']; ?>

<script language="javascript">window.print();</script>
<table width="338" border="1">
  <tr>
    <td align="center" colspan="2"><strong>RELAT&Oacute;RIO DE SAQUES BANCO DO BRASIL</strong><br />Data: <? echo $_GET['data']; ?><br />Operador: <? echo $operador = $_GET['operador']; ?></td>
  </tr>
  <tr>
    <td width="195" bgcolor="#CCCCCC"><strong>TIPO</strong></td>
    <td width="127" bgcolor="#CCCCCC"><strong>VALOR</strong></td>
  </tr>
  <? $saque_banco_brasil = 0;
   $sql_saques = mysqli_query($conexao_bd, "SELECT * FROM saque_banco_brasil WHERE data = '".$_GET['data']."' AND operador = '$operador' AND status = 'Ativo'");
   while($res_sques = mysqli_fetch_array($sql_saques)){ $saque_banco_brasil = $saque_banco_brasil+$res_sques['valor'];
  ?>
  <tr>
    <td>Saque</td>
    <td>R$ <? echo number_format($res_sques['valor'],2,',','.'); ?></td>
  </tr>
  <? } ?>
 
  <tr>
    <td bgcolor="#CCCCCC" align="right"><strong>Valor transacionado</strong></td>
    <td>R$ <? echo number_format($saque_banco_brasil,2,',','.'); ?></td>
  </tr>
</table>


<br /><br />
<table width="338" style="page-break-before: always;" border="1">
  <tr>
    <td align="center" colspan="2"><strong>RELAT&Oacute;RIO DE DEP&Oacute;SITOS BANCO DO BRASIL</strong><br />
      Data: <? echo $_GET['data']; ?><br />
      Operador: <? echo $operador = $_GET['operador']; ?></td>
  </tr>
  <tr>
    <td width="195" bgcolor="#CCCCCC"><strong>TIPO</strong></td>
    <td width="127" bgcolor="#CCCCCC"><strong>VALOR</strong></td>
  </tr>
  <? $deposito_banco_brasil = 0;
   $sql_saques = mysqli_query($conexao_bd, "SELECT * FROM deposito_banco_brasil WHERE data = '".$_GET['data']."' AND operador = '$operador' AND status = 'Ativo'");
   while($res_sques = mysqli_fetch_array($sql_saques)){ $deposito_banco_brasil = $deposito_banco_brasil + $res_sques['valor'];
  ?>
  <tr>
    <td>Dep&oacute;sito</td>
    <td>R$ <? echo number_format($res_sques['valor'],2,',','.'); ?></td>
  </tr>
<? } ?>
  <tr>
    <td bgcolor="#CCCCCC" align="right"><strong>Valor transacionado</strong></td>
    <td>R$ <? echo number_format($deposito_banco_brasil,2,',','.'); ?></td>
  </tr>
</table>
<br /><br />




<table width="338" style="page-break-before: always;" border="1">
  <tr>
    <td align="center" colspan="2"><strong>RELAT&Oacute;RIO DE RECARGAS DE CELULAR</strong><br />
      Data: <? echo $_GET['data']; ?><br />
      Operador: <? echo $operador = $_GET['operador']; ?></td>
  </tr>
  <tr>
    <td width="195" bgcolor="#CCCCCC"><strong>TIPO</strong></td>
    <td width="127" bgcolor="#CCCCCC"><strong>VALOR</strong></td>
  </tr>
    <? $recarga_prepago = 0;
   $sql_saques = mysqli_query($conexao_bd, "SELECT * FROM recarga_prepago WHERE data = '".$_GET['data']."' AND operador = '$operador' AND processamento = 'MAQUINA BANCO DO BRASIL'");
   while($res_sques = mysqli_fetch_array($sql_saques)){ $recarga_prepago = $res_sques['valor']+$recarga_prepago;
  ?>
  <tr>
    <td>Recarga de celular</td>
    <td>R$ <? echo number_format($res_sques['valor'],2,',','.'); ?></td>
  </tr>
  <? } ?>
  <tr>
    <td bgcolor="#CCCCCC" align="right"><strong>Valor transacionado</strong></td>
    <td>R$ <? echo number_format($recarga_prepago,2,',','.'); ?></td>
  </tr>
</table>


<br /><br />

<table width="338" style="page-break-before: always;" border="1">
  <tr>
    <td align="center" colspan="2"><strong>RELAT&Oacute;RIO DE CONV&Ecirc;NIOS</strong><br />
      Data: <? echo $_GET['data']; ?><br />
      Operador: <? echo $operador = $_GET['operador']; ?></td>
  </tr>
  <tr>
    <td width="195" bgcolor="#CCCCCC"><strong>TIPO</strong></td>
    <td width="127" bgcolor="#CCCCCC"><strong>VALOR</strong></td>
  </tr>
  <? $convenio = 0;
   $sql_saques = mysqli_query($conexao_bd, "SELECT * FROM pagamento_boletos WHERE data_efetivado = '".$_GET['data']."' AND operador_efetivado = '$operador' AND status = 'Efetivado' AND tipo = 'CONVENIO'");
   while($res_sques = mysqli_fetch_array($sql_saques)){ $convenio = $res_sques['valor']+$convenio;
  ?>
  <tr>
    <td>CONVÊNIO</td>
    <td>R$ <? echo number_format($res_sques['valor'],2,',','.'); ?></td>
  </tr>
  <? } ?>
  <tr>
    <td bgcolor="#CCCCCC" align="right"><strong>Valor transacionado</strong></td>
    <td>R$ <? echo number_format($convenio,2,',','.'); ?></td>
  </tr>
</table>
<br /><br />
<table width="338" style="page-break-before: always;" border="1">
  <tr>
    <td align="center" colspan="2"><strong>RELAT&Oacute;RIO DE BOLETOS</strong><br />
      Data: <? echo $_GET['data']; ?><br />
      Operador: <? echo $operador = $_GET['operador']; ?></td>
  </tr>
  <tr>
    <td width="195" bgcolor="#CCCCCC"><strong>TIPO</strong></td>
    <td width="127" bgcolor="#CCCCCC"><strong>VALOR</strong></td>
  </tr>
  <? $pagamento = 0;
   $sql_saques = mysqli_query($conexao_bd, "SELECT * FROM pagamento_boletos WHERE data_efetivado = '".$_GET['data']."' AND operador_efetivado = '$operador' AND status = 'Efetivado' AND tipo = 'BOLETO'");
   while($res_sques = mysqli_fetch_array($sql_saques)){ $pagamento = ($res_sques['valor']+$res_sques['juros']-$res_sques['desconto'])+$pagamento;
  ?>
  <tr>
    <td>BOLETO</td>
    <td>R$ <? echo number_format((($res_sques['valor']+$res_sques['juros'])-$res_sques['desconto']),2,',','.'); ?></td>
  </tr>
  <? } ?>
  <tr>
    <td bgcolor="#CCCCCC" align="right"><strong>Valor transacionado</strong></td>
    <td>R$ <? echo number_format($pagamento,2,',','.'); ?></td>
  </tr>
</table>

</body>
</html>