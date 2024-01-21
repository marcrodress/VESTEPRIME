<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/data_preve.css" rel="stylesheet" type="text/css" />
<? require "../../conexao.php"; ?>
</head>

<body>
<table width="950" border="0">
  <tr>
    <td width="187" height="22"><strong>N&ordm; do ben&eacute;ficio:</strong></td>
    <td width="239"><strong>Data de nascimento:</strong></td>
    <td width="187"><strong>Nome:</strong></td>
    <td width="186"><strong>CPF:</strong></td>
    <td width="79"><strong>Telefone:</strong></td>
  </tr>
<?
$id = $_GET['id'];

$sql_1 = mysql_query("SELECT * FROM lista_inss WHERE id = '$id'");
 while($res = mysql_fetch_array($sql_1)){
?>
  <tr>
    <td><? echo $res['n_beneficio']; ?></td>
    <td><? echo $res['dt_nasc']; ?></td>
    <td><? echo $res['nome']; ?></td>
    <td><? echo $res['cpf']; ?></td>
    <td><? echo $res['fone']; ?></td>
  </tr>
<? } ?>
</table>
<iframe src="http://www3.dataprev.gov.br/cws/contexto/hiscre/index.html" width="980" height="550" frameborder="0"></iframe>
</body>
</html>