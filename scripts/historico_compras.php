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
    <td colspan="11" bgcolor="#0099FF"><h1><strong>HISTÓRICO DE FATUAS</strong></h1></td>
  </tr>
  <tr>
    <td width="59" bgcolor="#FFD5EA"><strong>STATUS</strong></td>
    <td width="95" bgcolor="#FFD5EA"><strong>COD. TRASA&Ccedil;&Atilde;O</strong></td>
    <td width="94" bgcolor="#FFD5EA"><strong>DATA</strong></td>
    <td width="132" bgcolor="#FFD5EA"><strong>DESCRI&Ccedil;&Atilde;O</strong></td>
    <td width="78" bgcolor="#FFD5EA"><strong>VALOR</strong></td>
    <td width="85" bgcolor="#FFD5EA"><strong>PARCELADO</strong></td>
    <td width="75" bgcolor="#FFD5EA"><strong>QUAT. PARC.</strong></td>
    <td width="84" bgcolor="#FFD5EA"><strong>VL. PARC.</strong></td>
    <td width="64" bgcolor="#FFD5EA"><strong>CARRINHO</strong></td>
    <td width="68" bgcolor="#FFD5EA"><strong>OPERADOR</strong></td>
    <td width="20" bgcolor="#FFD5EA">&nbsp;</td>
  </tr>
  <?
  require "../conexao.php";
  $sql_faturas = mysqli_query($conexao_bd, "SELECT * FROM lancamento_fatura WHERE cliente = '".$_GET['cliente']."' ORDER BY id DESC LIMIT 20");
  	while($res_faturas = mysqli_fetch_array($sql_faturas)){
  ?>
  <tr>
    <td><? echo $res_faturas['status']; ?></td>
    <td><? echo $res_faturas['code_transacao']; ?></td>
    <td><? echo $res_faturas['data_completa']; ?></td>
    <td><? echo $res_faturas['descricao']; ?></td>
    <td><? echo number_format($res_faturas['valor'], 2, ',', '.'); ?></td>
    <td><? echo $res_faturas['parcelado']; ?></td>
    <td><? echo $res_faturas['quant_parcela']; ?></td>
    <td><? echo number_format($res_faturas['valor_parcela'], 2, ',', '.'); ?></td>
    <td><? echo $res_faturas['code_carrinho']; ?></td>
    <td><? echo $res_faturas['operador']; ?></td>
    <td><? if($res_faturas['comprovante'] != ''){ ?><a target="_blank" href="../vesteprime_comprovantes/<? echo $res_faturas['comprovante']; ?>"><img src="../img/imprimir.png" alt="" width="20" height="20" border="0" /></a><? } ?></td>
  </tr>
  <? } ?>
</table>
</div><!-- historico_faturas -->
</body>
</html>