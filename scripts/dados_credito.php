<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<? require "../config.php"; ?>
<style type="text/css">
body {
	background-color: #FFF;
	font:12px Arial, Helvetica, sans-serif;
	text-align:center;
}
</style>
</head>

<body>
<?

$sql_credito = mysqli_query($conexao_bd, "SELECT * FROM emprestimo_distribuicao_clientes WHERE n_proposta = '".$_GET['n_proposta']."' AND cliente = '".$_GET['cliente']."'");
while($res_credito = mysqli_fetch_array($sql_credito)){
?>
<table width="400" border="0">
  <tr>
    <td colspan="2" bgcolor="#996600"><strong>DADOS DA CONTA DE CR&Eacute;DITO</strong></td>
  </tr>
  <tr>
    <td width="178" bgcolor="#669966"><strong>CPF</strong></td>
    <td width="212" bgcolor="#669966"><strong>NOME</strong></td>
  </tr>
  <tr>
    <td><? echo $res_credito['cpf_conta']; ?></td>
    <td><? echo $res_credito['nome_conta']; ?></td>
  </tr>
  <tr>
    <td bgcolor="#669966"><strong>TIPO DE CONTA</strong></td>
    <td bgcolor="#669966"><strong>AG&Ecirc;NCIA</strong></td>
  </tr>
  <tr>
    <td><? echo $res_credito['tipo_conta']; ?></td>
    <td><? echo $res_credito['agencia']; ?></td>
  </tr>
  <tr>
    <td colspan="2">CONTA: <? echo $res_credito['n_conta']; ?></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#669966"><strong>BANCO: <? echo $res_credito['banco']; ?></strong></td>
  </tr>
</table>
<? } ?>
</body>
</html>