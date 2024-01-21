<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../scripts/css/mostrar_documentos.css" rel="stylesheet" type="text/css" />
<? require "../../conexao.php"; ?>
</head>

<body>
<?
$cpf = $_GET['cpf'];
$tipo = $_GET['tipo'];
$sql_1 = mysql_query("SELECT * FROM clientes_docs WHERE cpf = '$cpf' AND tipo = '$tipo'");
  while($res_1 = mysql_fetch_array($sql_1)){
?>
<img src="<? echo $res_1['doc']; ?>" />
<? } ?>
</body>
</html>