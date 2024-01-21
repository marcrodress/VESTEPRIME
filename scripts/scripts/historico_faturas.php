<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/historico_faturas.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="box">
<table class="table" width="900" border="0">
  <tr>
    <td colspan="9" bgcolor="#0099FF"><h1><strong>HISTÓRICO DE FATUAS</strong></h1></td>
  </tr>
  <tr>
    <td width="65" bgcolor="#FFD5EA"><strong>STATUS</strong></td>
    <td width="158" bgcolor="#FFD5EA"><strong>CÓDIGO DA FATURA</strong></td>
    <td width="110" bgcolor="#FFD5EA"><strong>VENCIMENTO</strong></td>
    <td width="71" bgcolor="#FFD5EA"><strong>DÉBITOS</strong></td>
    <td width="155" bgcolor="#FFD5EA"><strong>VALOR DA FATURA</strong></td>
    <td width="61" bgcolor="#FFD5EA"><strong>SALDO</strong></td>
    <td bgcolor="#FFD5EA"><strong>SIT. PAGAMENTO</strong></td>
    <td width="81" bgcolor="#FFD5EA"><strong>VALOR PAGO</strong></td>
    <td bgcolor="#FFD5EA">&nbsp;</td>
  </tr>
  <?
  require "../conexao.php";
  $sql_faturas = mysqli_query($conexao_bd, "SELECT * FROM faturas_fechadas WHERE cliente = '".$_GET['cliente']."' LIMIT 15");
  	while($res_faturas = mysqli_fetch_array($sql_faturas)){
  ?>
  <tr>
    <td><? echo $res_faturas['status']; ?></td>
    <td><? echo $res_faturas['code_fatura']; ?></td>
    <td><? echo $res_faturas['vencimento']; ?></td>
    <td><? echo number_format($res_faturas['valor_debitos'], 2, ',', '.'); ?></td>
    <td><? echo number_format($res_faturas['valor'], 2, ',', '.'); ?></td>
    <td><? echo number_format($res_faturas['saldo'], 2, ',', '.'); ?></td>
    <td><? echo $res_faturas['sit_pag']; ?></td>
    <td><? echo number_format($res_faturas['valor_pago'], 2, ',', '.'); ?></td>
    <td><a target="_blank" href="fatura_fechada.php?code_fatura=<? echo $res_faturas['code_fatura']; ?>"><img src="../img/imprimir.png" width="20" height="20" /></a></td>
  </tr>
  <? } ?>
</table>
</div><!-- historico_faturas -->
</body>
</html>