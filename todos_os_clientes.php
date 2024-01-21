<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>RELAÇÃO DE CLIENTES</title>
<style type="text/css">
body,td,th {
	color: #000;
	font:12px Arial, Helvetica, sans-serif;
}
</style>
</head>
<? require "conexao.php"; ?>
<body>



<table width="926" border="0">
  <tr>
    <td width="348" bgcolor="#00CCCC"><em><strong>NOME</strong></em></td>
    <td width="111" bgcolor="#00CCCC"><em><strong>CPF</strong></em></td>
    <td width="109" bgcolor="#00CCCC"><em><strong>TELEFONE 1</strong></em></td>
    <td width="111" bgcolor="#00CCCC"><strong><em> TELEFONE 2</em></strong></td>
    <td width="74" bgcolor="#00CCCC"><em><strong>LIMITE</strong></em></td>
    <td width="88" bgcolor="#00CCCC"><em><strong>STATUS</strong></em></td>
    <td width="55" bgcolor="#00CCCC">&nbsp;</td>
  </tr>
<?

//mysqli_query($conexao_bd, "UPDATE conta_corrente SET status = 'CANCELADO' WHERE status = 'PENDENTE'");

$cpf = 0;
$nome = 0;
$telefone = 0;
$i = 0; 
$sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes");
	while($res_cliente = mysqli_fetch_array($sql_cliente)){
			$cpf = $res_cliente['cpf'];
		$sql_conta = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente WHERE cliente = '$cpf' AND status != 'CANCELADO'");
	while($res_conta = mysqli_fetch_array($sql_conta)){ $i++;

?>
  <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
    <td><? echo strtoupper($res_cliente['nome']); ?></td>
    <td><? echo $res_cliente['cpf']; ?></td>
    <td><? echo $res_cliente['celular_1']; ?></td>
    <td><? echo $res_cliente['celular_2']; ?></td>
    <td align="center"><? echo $res_conta['limite_loja_disponivel']; ?></td>
    <td align="center"><? echo strtoupper($res_conta['status']); ?></td>
    <td>
    	<? if($res_conta['status'] == 'ATIVO'){ ?>
        <a href="bloquea_usuario.php?p=INATIVO&id=<? echo $res_conta['id']; ?>"><img src="img/bloquea.png" width="20" height="20" title="INATIVAR USUARIO" /></a>
        <? } ?>
        
    	<? if($res_conta['status'] == 'INATIVO' || $res_conta['status'] == 'BLOQUEADO'){ ?>        
    	<a href="bloquea_usuario.php?p=ATIVO&id=<? echo $res_conta['id']; ?>"><img src="img/correto.jpg" width="20" height="20" title="REATIVAR CLIENTE" /></a>
        <? } ?>
        
    	<a href="bloquea_usuario.php?p=CANCELADO&id=<? echo $res_conta['id']; ?>"><img src="img/deleta.jpg" width="20" height="20" title="CANCELAR CONTRATO" /></a>
    </td>
  </tr>
  <? }} ?>
</table>
<hr />

TOTAL: <? echo $i; ?>



</body>
</html>