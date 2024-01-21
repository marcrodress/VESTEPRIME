<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/busca_debitos_prime_card.css" rel="stylesheet" type="text/css" />
<? require "../../../conexao.php"; ?>
</head>

<body>
<div id="box_debitos_do_mes">
<? if($_GET['p'] == 'detalhe_lancamento'){ ?>
<a href="?code_fatura=<? echo $_GET['code_fatura']; ?>">Volta</a>
<hr />
<table width="814" border="0">
  <tr>
    <td width="102" bgcolor="#993300"><strong>D. COMPRA</strong></td>
    <td width="134" bgcolor="#993300"><strong>CÓD. CARRINHO</strong></td>
    <td width="139" bgcolor="#993300"><strong>PARCELAMENTO</strong></td>
    <td width="152" bgcolor="#993300"><strong>QUANT. PARCELA</strong></td>
    <td width="95" bgcolor="#993300"><strong>Nº PARCELA</strong></td>
    <td width="57" bgcolor="#993300">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><a href=""><img src="../img/reenviar.png" width="20" height="20" border="0" title="REENVIAR LAÇAMENTO"></a></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<? } // fecha detalhes do lançamento ?>








<? if($_GET['p'] == ''){ ?>
<? if(isset($_POST['send'])){
	
$descricao = $_POST['descricao'];
$valor = $_POST['valor'];
$valor2 = $_POST['valor'];

$code_fatura = $_GET['code_fatura'];
$code_transacao = rand();
$cliente = 0;

$sql_1 = mysql_query("SELECT * FROM faturas_fechadas WHERE code_fatura = '$code_fatura'");
	while($res_1 = mysql_fetch_array($sql_1)){
			$cliente = $res_1['cliente'];
			$valor = $res_1['valor']+$valor;

		mysql_query("UPDATE faturas_fechadas SET valor = '$valor' WHERE code_fatura = '$code_fatura'");

	}

mysql_query("INSERT INTO lancamento_fechados (code_transacao, status, data, data_completa, dia, mes, ano, valor, n_parcela, cliente, code_fatura) VALUES ('$code_transacao', 'Ativo', '$data', '$data_completa', '$dia', '$mes', '$ano', '$valor2', '1', '$cliente', '$code_fatura')");

mysql_query("INSERT INTO compras_parceladas (code_transacao, ip, status, data_compra, data_completa, estabelecimento, parcela, n_parcela, total_parcela, valor_parcela, sit_pag_fatura) VALUES ('$code_transacao', '$ip', 'Lancada', '$data', '$data_completa', 'VESTEPRIME', '1', '1', '1', '$valor', '')");

mysql_query("INSERT INTO lancamento_fatura (code_transacao, status, data, data_completa, dia, mes, ano, descricao, valor, cliente) VALUES ('$code_transacao', 'TERMINADO', '$data', '$data_completa', '$dia', '$mes', '$ano', '$descricao', '$valor2', '$cliente')");

echo "<script language='javascript'>window.location='?code_fatura=$code_fatura';</script>";


}?>
<form name="" method="post" action="" enctype="multipart/form-data">
<table width="814" border="0">
  <tr>
    <td width="631"><strong>DESCRIÇÃO</strong></td>
    <td width="85"><strong>VALOR</strong></td>
    <td width="76">&nbsp;</td>
  </tr>
  <tr>
    <td><label for="textfield"></label>
    <input name="descricao" type="text" size="85"></td>
    <td><label for="textfield2"></label>
    <input name="valor" type="text" size="5"></td>
    <td><input type="submit" name="send" id="button" value="Enviar"></td>
  </tr>
</table>
</form>

<hr />
<table width="814" border="0">
  <tr>
    <td width="140" bgcolor="#0099CC"><strong>Code transação</strong></td>
    <td width="62" bgcolor="#0099CC"><strong>status</strong></td>
    <td width="88" bgcolor="#0099CC"><strong>data</strong></td>
    <td width="92" bgcolor="#0099CC"><strong>valor</strong></td>
    <td width="140" bgcolor="#0099CC"><strong>nº parcela</strong></td>
    <td width="92" bgcolor="#0099CC"><strong>parcelado</strong></td>
    <td width="170" bgcolor="#0099CC">&nbsp;</td>
  </tr>
  <?
  $sql_faturas = mysql_query("SELECT * FROM lancamento_fechados WHERE code_fatura = '".$_GET['code_fatura']."'");
  	while($res_debitos = mysql_fetch_array($sql_faturas)){
  ?>
  <tr>
    <td><? echo $res_debitos['code_transacao']; ?></td>
    <td><? echo $res_debitos['status']; ?></td>
    <td><? echo $res_debitos['data']; ?></td>
    <td><? echo $res_debitos['valor']; ?></td>
    <td><? echo $res_debitos['n_parcela']; ?></td>
    <td><? if($res_debitos['parcelado'] == 'SIM'){ echo "SIM"; }else{ echo "NÃO"; } ?></td>
    <td>
    <a href="?acao=excluir&id=<? echo $res_debitos['id']; ?>&valor=<? echo $res_debitos['valor']; ?>&code_fatura=<? echo $res_debitos['code_fatura']; ?>"><img src="../img/deleta.jpg" width="20" height="20" border="0" title="EXCLUIR LANÇAMENTO DA FATURA"></a>
    <a href="?p=detalhe_lancamento&code_transacao=<? echo $res_debitos['code_transacao']; ?>&id_lacamento=<? echo $res_debitos['id']; ?>&code_fatura=<? echo $_GET['code_fatura']; ?>"><img src="../img/detalhes.png" width="20" height="20" title="VERIFICAR DETALHES DO LANÇAMENTO" /></a>
    </td>
  </tr>
 <? } ?>
</table>
<? if($_GET['acao'] == 'excluir'){
	
$id = $_GET['id'];
$valor_retirada = $_GET['valor'];
$code_fatura = $_GET['code_fatura'];


$sql_1 = mysql_query("SELECT * FROM faturas_fechadas WHERE code_fatura = '$code_fatura'");
	while($res_1 = mysql_fetch_array($sql_1)){
			$valor = $res_1['valor']-$valor_retirada;
			
			mysql_query("UPDATE faturas_fechadas SET valor = '$valor' WHERE code_fatura = '$code_fatura'");
	}


mysql_query("DELETE FROM lancamento_fechados WHERE id = '$id'");

echo "<script language='javascript'>window.location='?code_fatura=$code_fatura';</script>";

}?>

<? }// fecha o p = 0 ?>
</div><!-- box_debitos_do_mes -->
</body>
</html>
