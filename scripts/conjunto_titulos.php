<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<? require "../conexao.php"; $code_conjunto = $_GET['code_conjunto']; ?>
<style type="text/css">
body {
	background-color: #FFF;
}
body table td{
	border:1px solid #000;
	border-radius:5px;
	text-align:center;
	font:12px Arial, Helvetica, sans-serif; 
}
</style>
</head>

<body>
<table width="900" border="0">
  <tr>
    <td colspan="9" bgcolor="#669966"><h1 style="font:15px Arial, Helvetica, sans-serif; padding:0; margin:0;"><strong>TÍTULOS DESSE CONJUNTO</strong></h1></td>
  </tr>
  <tr>
    <td bgcolor="#999900"><strong>TIPO</strong></td>
    <td bgcolor="#999900"><strong>EMISSOR</strong></td>
    <td bgcolor="#999900"><strong>COD. BARRAS</strong></td>
    <td bgcolor="#999900"><strong>VALOR</strong></td>
    <td bgcolor="#999900"><strong>JUROS</strong></td>
    <td bgcolor="#999900"><strong>TARIFAS</strong></td>
    <td bgcolor="#999900"><strong>IMPRESSAO</strong></td>
    <td bgcolor="#999900"><strong>TOTAL</strong></td>
    <td bgcolor="#999900">&nbsp;</td>
  </tr>
<?
$sql_conjunto_boletos = mysqli_query($conexao_bd, "SELECT * FROM pagamentoboletos WHERE conjunto = '".$_GET['code_conjunto']."'");
while($res_titulos = mysqli_fetch_array($sql_conjunto_boletos)){ $i++;
?>
  <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
    <td><? echo $res_titulos['tipo']; ?></td>
    <td><? echo $res_titulos['banco']; ?></td>
    <td><? echo $res_titulos['code_barras']; ?></td>
    <td><? echo number_format($res_titulos['valor'],2,',','.'); ?></td>
    <td><? echo number_format($res_titulos['juros'],2,',','.'); ?></td>
    <td><? echo number_format($res_titulos['tarifa_recebimento'],2,',','.'); ?></td>
    <td><? echo number_format($res_titulos['boleto_impresso'],2,',','.'); ?></td>
    <td><? $total = $total+$res_titulos['valor_recebido']; echo number_format($res_titulos['valor_recebido'],2,',','.'); ?></td>
    <td><a href="?pg=cancela&id=<? echo $res_titulos['id']; ?>&code_conjunto=<? echo $code_conjunto; ?>"><img src="../img/deleta.jpg" width="18" height="18" border="0" /></a></td>
  </tr>
<? } ?>
  <tr>
    <td colspan="7">&nbsp;</td>
    <td bgcolor="#996600"><? echo number_format($total,2,',','.'); ?></td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
<? if($_GET['pg'] == 'cancela'){
	
$id = $_GET['id'];
$code_conjunto = $_GET['code_conjunto'];

$sql_verifica_pagamento = mysqli_query($conexao_bd, "SELECT * FROM pagamento_boletos_opcoes WHERE conjunto = '$code_conjunto'");
if(mysqli_num_rows($sql_verifica_pagamento) >= 1){
echo "<script language='javascript'>window.alert('Você deve primeiro excluir todos os pagamentos para excluir um título');</script>";
}else{
mysqli_query($conexao_bd, "DELETE FROM pagamentoboletos WHERE id = '$id'");
echo "<script language='javascript'>window.location='conjunto_titulos.php?code_conjunto=$code_conjunto';</script>";
}
}?>