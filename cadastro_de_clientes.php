<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>RELAÇÃO DE CLIENTES</title>
<style type="text/css">
body{
	background-color: #CCC;
}
body table{
	font:12px Arial, Helvetica, sans-serif;
	text-align:center;
	padding:2px;
}
body table td{
	padding:2px;
}
</style>
</head>

<body>
<? require "conexao.php"; ?>

<table width="1200" border="0">
  <tr>
    <td width="253" bgcolor="#00CCCC"><em><strong>NOME</strong></em></td>
    <td width="131" bgcolor="#00CCCC"><em><strong>CPF</strong></em></td>
    <td width="99" bgcolor="#00CCCC"><em><strong>TELEFONE 1</strong></em></td>
    <td width="117" bgcolor="#00CCCC"><strong><em>E-MAIL</em></strong></td>
    <td width="97" bgcolor="#00CCCC"><em><strong>CEP</strong></em></td>
    <td width="201" bgcolor="#00CCCC"><em><strong>ENDERE&Ccedil;O / N&ordm;</strong></em></td>
    <td width="95" bgcolor="#00CCCC"><em><strong>BAIRRO</strong></em></td>
    <td width="173" bgcolor="#00CCCC"><strong>CIDADE</strong></td>
  </tr>
<?
$cpf = 0;
$nome = 0;
$telefone = 0;
$i = 1; 
$sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes");
	while($res_cliente = mysqli_fetch_array($sql_cliente)){ $i++;
			$cpf = $res_cliente['cpf'];
		$sql_conta = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente WHERE cliente = '$cpf'");
	while($res_conta = mysqli_fetch_array($sql_conta)){

?>
  <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
    <td><? echo strtoupper($res_cliente['nome']); ?></td>
    <td><? echo $res_cliente['cpf']; ?></td>
    <td><? echo $res_cliente['celular_1']; ?></td>
    <td><? echo strtolower($res_cliente['email']); ?></td>
    <td align="center"><? echo $res_cliente['cep']; ?></td>
    <td align="center"><? echo strtoupper($res_cliente['endereco']); ?> / <? echo $res_cliente['n_residencia']; ?></td>
    <td><? echo strtoupper($res_cliente['bairro']); ?></td>
    <td><? echo strtoupper($res_cliente['cidade']); ?></td>
  </tr>
  <? }} ?>
</table>

</body>
</html>