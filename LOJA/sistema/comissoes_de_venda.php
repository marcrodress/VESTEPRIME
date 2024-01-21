<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/comissoes_de_venda.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="box_cad_produto">
<h1><strong>Comissões de venda</strong></h1>
<hr />
<? if(@$_GET['acao'] == '1'){

$code_comissao = $_GET['code_comissao'];
$cpf = $_GET['cpf'];
$creditos = $_GET['creditos'];
$debitos = $_GET['debitos'];
$saldo = $creditos-$saldo;

mysqli_query($conexao_db, "UPDATE comissao SET processamento = '$code_comissao', status = 'Processado' WHERE status = 'Aguarda' AND operador = '$cpf'");
mysqli_query($conexao_db, "UPDATE retirada_dinheiro SET processamento = '$code_comissao', status = 'Processado' WHERE status = 'Aguarda' AND operador = '$cpf'");

mysqli_query($conexao_db, "INSERT INTO pagamento_de_comissoes (operador, dia, mes, ano, data, data_completa, ip, code, creditos, debitos, saldo) VALUES ('$cpf', '$dia', '$mes', '$ano', '$data', '$data_completa', '$ip', '$code_comissao', '$creditos', '$debitos', '$saldo')");

mysqli_query($conexao_db, "INSERT INTO fluxo_de_caixa (status, data, data_completa, dia, mes, ano, tipo_entrada, cliente, descricao, forma_recebimento, valor, tipo, code_carrinho, origem, code_transacao) VALUES ('Ativo', '$data', '$data_completa', '$dia', '$mes', '$ano', 'CREDITO', '$cpf', 'COMISSÃO DE VENDAS', 'DINHEIRO', '$saldo', 'ENTRADA', '$code_comissao', 'COMISSAO', '$code_comissao')");

echo "<script language='javascript'>window.location='?pack=comissoes_de_venda';window.alert('Comissão processada com sucesso!');</script>";

}?>
<table width="1190" border="0">
  <tr>
    <td width="293" bgcolor="#999999"><strong>NOME</strong></td>
    <td width="118" bgcolor="#999999"><strong>LOGIN</strong></td>
    <td width="142" bgcolor="#999999"><strong>USUÁRIO</strong></td>
    <td width="132" bgcolor="#999999"><strong>CREDITOS</strong></td>
    <td width="157" bgcolor="#999999"><strong>DÉBITOS</strong></td>
    <td width="204" bgcolor="#999999"><strong>SALDO</strong></td>
    <td width="114" bgcolor="#999999">&nbsp;</td>
  </tr>
  <?

  $sql_ = mysqli_query($conexao_db, "SELECT * FROM adm");
  	while($res_user = mysqli_fetch_array($sql_)){
  ?>
  <tr>
    <td><? echo $res_user['nome']; ?></td>
    <td><? echo $res_user['login']; ?></td>
    <td><? echo $cpf = $res_user['cpf']; ?></td>
    <td>
  <?
  $creditos = 0;
  $sql_creditos = mysqli_query($conexao_db, "SELECT * FROM comissao WHERE operador = '$cpf' AND status = 'Aguarda'");
  	while($res_creditos = mysqli_fetch_array($sql_creditos)){
		$creditos = $creditos+$res_creditos['valor'];
	}
	
	echo number_format($creditos, 2, ',', '.');
	
  ?>    
    </td>
    <td><?
  $debitos = 0;
  $sql_debitos = mysqli_query($conexao_db, "SELECT * FROM retirada_dinheiro WHERE operador = '$cpf' AND status = 'Aguarda'");
  	while($res_debitos = mysqli_fetch_array($sql_debitos)){
		$debitos = $debitos+$res_debitos['valor'];
	}
	
	echo number_format($debitos, 2, ',', '.');
	
  ?></td>
    <td><? echo number_format($creditos-$debitos, 2, ',', '.'); ?></td>
    <td>
    <a href="?pack=comissoes_de_venda&acao=1&code_comissao=<? echo rand(); ?>&creditos=<? echo $creditos; ?>&debitos=<? echo $debitos; ?>&cpf=<? echo $res_user['cpf']; ?>"><img src="img/correto.jpg" width="20" height="20" border="0" /></a><img src="img/deleta.jpg" width="20" height="20" />
    <a target="_blank" href="scripts/imprimir_relatorio_comissao.php?operador=<? echo $cpf; ?>" title="Imprimir Relat&oacute;rio"><img src="img/impressora.png" width="20" height="20" border="0" /></a>
    </td>
  </tr>
  <tr>
    <td colspan="7"><hr /></td>
    </tr>
  <?
  
  $sql_comissao = mysqli_query($conexao_db, "SELECT * FROM pagamento_de_comissoes WHERE operador = '$cpf'");
  	while($res_comissao = mysqli_fetch_array($sql_comissao)){
  ?>  
  <tr>
    <td align="center" colspan="7"><strong>RESUMO DE COMISS&Otilde;ES J&Aacute; PROCESSADAS</strong></td>
    </tr>
  <tr>
    <td bgcolor="#999999"><strong>NOME</strong></td>
    <td bgcolor="#999999"><strong>DATA</strong></td>
    <td bgcolor="#999999"><strong>C&Oacute;DIGO</strong></td>
    <td bgcolor="#999999"><strong>CREDITOS</strong></td>
    <td bgcolor="#999999"><strong>DEBITOS</strong></td>
    <td bgcolor="#999999"><strong>SALDOA A SER PAGO</strong></td>
    <td bgcolor="#999999">&nbsp;</td>
  </tr>
  <tr>
    <td><? echo $res_user['nome']; ?></td>
    <td><? echo $res_comissao['data_completa']; ?></td>
    <td><? echo $res_comissao['code']; ?></td>
    <td><? echo $res_comissao['creditos']; ?></td>
    <td><? echo $res_comissao['debitos']; ?></td>
    <td><? echo $res_comissao['saldo']; ?></td>
    <td>
    <img src="img/deleta.jpg" width="20" height="20" /> 
    <a target="_blank" href="scripts/imprimir_relatorio_comissao_processados.php?code=<? echo $res_comissao['code']; ?>" title="Imprimir Relat&oacute;rio"><img src="img/impressora.png" width="20" height="20" border="0" /></a>
    </td>
  </tr>
 <? }} ?>
</table>
</div><!-- box_cad_produto -->
</body>
</html>