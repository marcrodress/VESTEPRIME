<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
</head>

<body>
<table width="700" border="0">
  <tr>
    <td width="116" bgcolor="#99CC00"><strong>FATURA</strong></td>
    <td width="244" bgcolor="#99CC00"><strong>CLIENTE</strong></td>
    <td width="171" bgcolor="#99CC00"><strong>VALOR</strong></td>
    <td width="151" bgcolor="#99CC00"><strong>VENCIMENTO</strong></td>
  </tr>
<?
  $faturas_vencidas = 0;
  require "../conexao.php";
  $sql_vencidas = mysqli_query($conexao_bd, "SELECT * FROM faturas_fechadas WHERE sit_pag = 'VENCIDA'");
	   while($res_vencidas = mysqli_fetch_array($sql_vencidas)){
	$sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente WHERE cliente = '".$res_vencidas['cliente']."' AND status = 'CANCELADO'");
	if(mysqli_num_rows($sql_cliente) == ''){
			
?>
  <tr>
    <td><? echo $res_vencidas['code']; ?></td>
    <td><? echo $res_vencidas['cliente']; ?></td>
    <td><? echo $res_vencidas['valor']; ?></td>
    <td><? echo $res_vencidas['vencimento']; ?></td>
  </tr>
<? } }?>
</table>
</body>
</html>