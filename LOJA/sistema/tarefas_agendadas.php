<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="agendamento/css/tarefas_agendadas.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="box_agenda">
<h1>Taferas agendadas</h1>
<?
$sql_1 = mysql_query("SELECT * FROM atividades WHERE status = 'Ativo'");
if(mysql_num_rows($sql_1) == ''){
	echo "<h2>No momento n�o existe nenhuma ativadade para ser feita!</h2>";
}else{
?>
<table width="1180" border="0">
  <tr>
    <td colspan="5"><strong>Rela��o das atividades que falta ser executadas</strong></td>
  </tr>
  <tr>
    <td colspan="5"><hr /></td>
  </tr>
  <tr>
    <td width="209"><strong>Data:</strong></td>
    <td width="325"><strong>Nome:</strong></td>
    <td width="295"><strong>Telefone:</strong></td>
    <td width="153" colspan="2"><strong>CPF:</strong></td>
  </tr>
<? while($res_1 = mysql_fetch_array($sql_1)){ ?>
  <tr>
    <td><? echo $res_1['date']; ?></td>
    <td><? echo $res_1['nome']; ?></td>
    <td><? echo $res_1['telefone']; ?></td>
    <td><? echo $res_1['cpf']; ?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Descri��o da atividade:</strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2"><a href="?pack=AGF1&acao=Executado&id=<? echo $res_1['id']; ?>">Executada</a> | <a href="?pack=AGF1&acao=Excluido&id=<? echo $res_1['id']; ?>">Excluir</a></td>
  </tr>
  <tr>
    <td colspan="5"><? echo $res_1['atividade']; ?></td>
  </tr>
  <tr>
    <td colspan="5"><hr /></td>
  </tr>
 <? } ?>
</table>

<? } ?>
</div><!-- box_agenda -->
</body>
</html>

<? if(@$_GET['acao'] == 'Executado'){
	
$id = $_GET['id'];

mysql_query("UPDATE atividades SET status = 'Executado' WHERE id = '$id'");

echo "<script language='javascript'>window.location='?pack=AGF1';</script>";

}?>


<? if(@$_GET['acao'] == 'Excluido'){
	
$id = $_GET['id'];

mysql_query("UPDATE atividades SET status = 'Exclu�do' WHERE id = '$id'");

echo "<script language='javascript'>window.location='?pack=AGF1';</script>";

}?>