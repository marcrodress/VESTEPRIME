<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<link href="css/ver_pagamentos_boletos.css" rel="stylesheet" type="text/css" />
<? require "../conexao.php"; ?>
</head>

<body>
<div id="box">
<?
$sql_pagamento = 0;
$code_conjunto = $_GET['code_conjunto'];
if($code_conjunto >= 1){
$sql_pagamento = mysqli_query($conexao_bd, "SELECT * FROM pagamento_boletos_opcoes WHERE conjunto = '$code_conjunto'");
}else{
$sql_pagamento = mysqli_query($conexao_bd, "SELECT * FROM pagamento_boletos_opcoes WHERE code_boleto = '".$_GET['code_boleto']."'");
}
if(mysqli_num_rows($sql_pagamento) == ''){
	echo "Ainda não foi registrado nenhum pagamento!";
}else{
?>
<table width="900" border="0">
  <tr>
    <td width="72" bgcolor="#CCCCCC"><strong>VALOR</strong></td>
    <td width="179" bgcolor="#CCCCCC"><strong>FORM. PAGT.</strong></td>
    <td width="94" bgcolor="#CCCCCC"><strong>BANDEIRA</strong></td>
    <td width="120" bgcolor="#CCCCCC"><strong>N&ordm; PARCELAS</strong></td>
    <td width="142" bgcolor="#CCCCCC"><strong>VALOR PARCELA</strong></td>
    <td width="135" bgcolor="#CCCCCC"><strong>VALOR TRANSA&Ccedil;&Atilde;O</strong></td>
    <td width="53" bgcolor="#CCCCCC"><strong>TROCO</strong></td>
    <td width="71" bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
<? while($res_pagamento = mysqli_fetch_array($sql_pagamento)){ ?>
  <tr>
    <td>R$ <? echo number_format($res_pagamento['valor'], 2, ',', '.'); ?></td>
    <td><? echo $res_pagamento['forma_pagamento']; ?></td>
    <td><? echo $res_pagamento['bandeira']; ?></td>
    <td><? echo $res_pagamento['n_parcelas']; ?></td>
    <td>R$ <? echo number_format($res_pagamento['valor_parcela'], 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($res_pagamento['valor_transacao'], 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($res_pagamento['troco'], 2, ',', '.'); ?></td>
    <td><a href="?code_boleto=<? echo $res_pagamento['code_boleto']; ?>&forma_pagamento=<? echo $res_pagamento['forma_pagamento']; ?>&id=<? echo $res_pagamento['id']; ?>&cliente=<? echo $res_pagamento['cliente']; ?>&limite_antes=<? echo $res_pagamento['limite_antes']; ?>&acao=excluir"><img src="../img/deleta.jpg" width="18" height="18" /></a></td>
  </tr>
<? } ?>
</table>
<? } ?>
</div><!-- box -->
</body>
</html>
<? if($_GET['acao'] == 'excluir'){

$code_boleto = $_GET['code_boleto'];
$cliente = $_GET['cliente'];
$forma_pagamento = $_GET['forma_pagamento'];
$limite_antes = $_GET['limite_antes'];
$id = $_GET['id'];

if($forma_pagamento == 'VESTE PRIME'){
	mysqli_query($conexao_bd, "UPDATE conta_corrente SET disponivel_pagamento_contas = '$limite_antes' WHERE cliente = '$cliente'");
}

mysqli_query($conexao_bd, "DELETE FROM pagamento_boletos_opcoes WHERE id = '$id'");

echo "<script language='javascript'>window.location='?code_boleto=$code_boleto';</script>";

}?>