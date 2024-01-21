<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/agenda_telefonica.css" rel="stylesheet" type="text/css" />
<? require "../../conexao.php"; ?>
</head>

<body>
<div id="box">
<table width="980" border="0">
  <tr>
    <td width="305"><strong>Nome:</strong></td>
    <td width="351"><strong>CPF:</strong></td>
    <td width="330"><strong>Telefone atual:</strong></td>
  </tr>
  <tr>
    <td><? echo $nome = $_GET['nome']; ?></td>
    <td><? echo $cpf = $_GET['cpf']; ?></td>
    <td><? echo $fone = $_GET['fone']; ?></td>
  </tr>
  <tr>
    <td colspan="3"><hr /></td>
    </tr>
  <tr>
    <td colspan="3">
    <?
    $m = mysql_query("SELECT * FROM lista_telefonica WHERE NOME LIKE '%$nome%' OR FONE LIKE '%$fone%' OR cpf = '$cpf'");
	if(mysql_num_rows($m) == ''){
	  echo "Não foi encontrado nenhum número para esta pessoa!";
	}else{
	 $conta = mysql_num_rows($m);
 	  while($res = mysql_fetch_array($m)){
	?>
    <ul>
 	 <li>DDD: <? echo $res['ddd']; ?> / <? echo $res['fone']; ?></li>
    </ul>
    <? }} ?>
    </td>
    </tr>
  <tr>
    <td align="center" colspan="3"><a href="?s=procob&nome=<? echo $_GET['nome']; ?>&cpf=<? echo $_GET['cpf']; ?>&fone=<? echo $_GET['fone']; ?>">Buscar no procop</a></td>
  </tr>
</table>

<? if(@$_GET['s'] == 'procob'){ ?>

<iframe src="https://consulta.procob.com" width="980" frameborder="0" height="400"></iframe>

<? } ?>

</div><!-- box -->
</body>
</html>
