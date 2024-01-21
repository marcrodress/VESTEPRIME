<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/imprimir_relatorio_comissao.css" rel="stylesheet" type="text/css" />
<title>Imprimir relatório</title>
</head>

<body>
<table width="1190" border="0">
  <tr>
    <td width="152" bgcolor="#CCCCCC"><strong>DATA COMPLETA</strong></td>
    <td width="309" bgcolor="#CCCCCC"><strong>DESCRI&Ccedil;&Atilde;O</strong></td>
    <td width="77" bgcolor="#CCCCCC"><strong>VALOR</strong></td>
    <td width="159" bgcolor="#CCCCCC"><strong>CLIENTE</strong></td>
    <td width="133" bgcolor="#CCCCCC"><strong>PRODUTO</strong></td>
    <td width="129" bgcolor="#CCCCCC"><strong>CARRINHO</strong></td>
    <td width="125" bgcolor="#CCCCCC"><strong>QUANTIDADE</strong></td>
    <td width="72" bgcolor="#CCCCCC"><strong>TIPO</strong></td>
  </tr>
 <?
 require "../../conexao.php";
 $code = $_GET['code'];
 $sql_comissao = mysql_query("SELECT * FROM comissao WHERE processamento = '$code'");
 	while($res_comissao = mysql_fetch_array($sql_comissao)){
 ?>
  <tr>
    <td><? echo $res_comissao['data_completa']; ?></td>
    <td><? echo $res_comissao['descricao']; ?></td>
    <td><? echo number_format($res_comissao['valor'], 2, ',', '.'); ?></td>
    <td><? echo $res_comissao['cliente']; ?></td>
    <td><? echo $res_comissao['produto']; ?></td>
    <td><? echo $res_comissao['carrinho']; ?></td>
    <td><? echo $res_comissao['quantidade']; ?></td>
    <td><? echo $res_comissao['tipo']; ?></td>
  </tr>
  <? } ?>
</table>
</body>
</html>