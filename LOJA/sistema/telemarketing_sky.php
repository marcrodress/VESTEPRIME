<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/lista_de_aposentados_e_pensionista.css" rel="stylesheet" type="text/css" />
<link href="img/logo.png" rel="shortcut icon" />
</head>

<body>
<div id="box_cadastro_de_cliente">
 <h1>Lista de aposentados<hr /></h1>
 <form name="avancar" method="post" action="" enctype="multipart/form-data">
  <input type="text" name="key" /><input class="input" type="submit" name="avancar" value="Buscar" />
 </form>

<? if(isset($_POST['avancar'])){
	
$key = $_POST['key'];
$sql_search = mysql_query("SELECT * FROM telemarketing WHERE nome LIKE '%$key%' OR cpf LIKE '%$key%'");
if(mysql_num_rows($sql_search) == ''){
	echo "<h1 class='h1'><strong>N�o foi encontrado nenhum registro com este dado.</strong></h1>";
}else{
?>
<table width="1192" border="0">
  <tr>
    <td width="256"><h2><strong>Nome:</strong></h2>
      <h2>&nbsp;</h2></td>
    <td width="115"><h2><strong>&Uacute;ltimo contato:</strong></h2></td>
    <td width="157"><h2><strong>Cidade:</strong></h2></td>
    <td width="112"><h2><strong>Bairro:</strong></h2></td>
    <td width="72"><h2><strong>Estado:</strong></h2></td>
    <td width="108"><h2>CEP::</h2></td>
    <td width="96"><h2><strong>CPF:</strong></h2></td>
    <td width="108"><h2><strong>Telefone::</strong></h2></td>
    <td width="128">&nbsp;</td>
  </tr>
  <? while($res_1 = mysql_fetch_array($sql_search)){ ?>
  <tr>
    <td><? echo $res_1['nome']; ?></td>
    <td><? if($res_1['ultima_ligacao'] == ''){ echo "N&atilde;o realizado"; }else{ echo $res_1['ultima_ligacao']; } ?></td>
    <td><? echo $res_1['cidade']; ?></td>
    <td><? echo $res_1['bairro']; ?></td>
    <td><? echo $res_1['estado']; ?></td>
    <td><? echo $res_1['cep']; ?></td>
    <td><? echo $res_1['cpf']; ?></td>
    <td><? echo $res_1['tele_celular']; ?></td>
    <td><a href="pg_extras/cadastro_completo_telemarketing.php?id=<? echo $res_1['id']; ?>" rel="superbox[iframe][1005x250]"><img src="img/cadastro.jpg" alt="" width="20" height="20" border="0" title="Cadastro Completo" /></a><a href="pg_extras/confirmar_telemarketing.php?id=<? echo $res_1['id']; ?>" rel="superbox[iframe][835x400]"><img src="img/correto.jpg" alt="" width="20" height="20" border="0" title="Confirmar ades&atilde;o" /></a> <a href="pg_extras/agenda_telefonica.php?id=<? echo $res_1['id']; ?>&amp;nome=<? echo $res_1['nome']; ?>&amp;cpf=<? echo $res_1['cpf']; ?>&amp;fone=<? echo $res_1['tele_celular']; ?>" rel="superbox[iframe][1000x600]"><img src="img/agenda_telefonica.jpg" alt="" width="20" height="20" border="0" title="Consultar n&uacute;mero na agenda telef&ocirc;nica" /></a> <a href="pg_extras/tirar_cadastro_lista_sky.php?id=<? echo $res_1['id']; ?>" rel="superbox[iframe][120x70]"><img src="img/deleta.jpg" alt="" width="18" height="18" border="0" title="Tirar cadastro da lista" /></a> <a href="pg_extras/confirmar_ligacao_sky.php?id=<? echo $res_1['id']; ?>&amp;tipo=telemarketing_sky" rel="superbox[iframe][120x70]"><img src="img/marcar_como_ligado.png" alt="" width="20" height="20" border="0" title="Marcar que voc&ecirc; fez a liga&ccedil;&atilde;o" /></a></td>
  </tr>
  <tr>
    <td height="3" colspan="9"><img src="img/contrato.png" alt="" width="1165" height="1" /></td>
  </tr>
  <? } ?>
</table>
<hr />
<? }} ?> 
 
<?
$sql_1 = mysql_query("SELECT * FROM telemarketing ORDER BY rand() LIMIT 100");
?>
<table width="1192" border="0">
  <tr>
    <td width="256"><h2><strong>Nome:</strong></h2>      <h2>&nbsp;</h2></td>
    <td width="115"><h2><strong>&Uacute;ltimo contato:</strong></h2></td>
    <td width="157"><h2><strong>Cidade:</strong></h2></td>
    <td width="112"><h2><strong>Bairro:</strong></h2></td>
    <td width="72"><h2><strong>Estado:</strong></h2></td>
    <td width="108"><h2>CEP::</h2></td>
    <td width="96"><h2><strong>CPF:</strong></h2></td>
    <td width="108"><h2><strong>Telefone::</strong></h2></td>
    <td width="128">&nbsp;</td>
  </tr>
<? while($res_1 = mysql_fetch_array($sql_1)){ ?>
  <tr>
    <td><? echo $res_1['nome']; ?></td>
    <td><? if($res_1['ultima_ligacao'] == ''){ echo "N�o realizado"; }else{ echo $res_1['ultima_ligacao']; } ?></td>
    <td><? echo $res_1['cidade']; ?></td>
    <td><? echo $res_1['bairro']; ?></td>
    <td><? echo $res_1['estado']; ?></td>
    <td><? echo $res_1['cep']; ?></td>
    <td><? echo $res_1['cpf']; ?></td>
    <td><? echo $res_1['tele_celular']; ?></td>
    <td><a href="pg_extras/cadastro_completo_telemarketing.php?id=<? echo $res_1['id']; ?>" rel="superbox[iframe][1005x250]"><img src="img/cadastro.jpg" width="20" height="20" border="0" title="Cadastro Completo" /></a><a href="pg_extras/confirmar_telemarketing.php?id=<? echo $res_1['id']; ?>" rel="superbox[iframe][835x400]"><img src="img/correto.jpg" alt="" width="20" height="20" border="0" title="Confirmar ades�o" /></a> <a href="pg_extras/agenda_telefonica.php?id=<? echo $res_1['id']; ?>&nome=<? echo $res_1['nome']; ?>&cpf=<? echo $res_1['cpf']; ?>&fone=<? echo $res_1['tele_celular']; ?>" rel="superbox[iframe][1000x600]"><img src="img/agenda_telefonica.jpg" alt=" " width="20" height="20" border="0" title="Consultar n&uacute;mero na agenda telef&ocirc;nica" /></a> <a href="pg_extras/tirar_cadastro_lista_sky.php?id=<? echo $res_1['id']; ?>" rel="superbox[iframe][120x70]"><img src="img/deleta.jpg" alt="" width="18" height="18" border="0" title="Tirar cadastro da lista" /></a> <a href="pg_extras/confirmar_ligacao_sky.php?id=<? echo $res_1['id']; ?>&tipo=telemarketing_sky" rel="superbox[iframe][120x70]"><img src="img/marcar_como_ligado.png" alt="" width="20" height="20" border="0" title="Marcar que voc� fez a liga��o" /></a></td>
  </tr>
  <tr>
    <td height="3" colspan="9"><img src="img/contrato.png" width="1165" height="1"></td>
  </tr>
<? } ?>
</table>


</div><!-- box_cadastro_de_cliente -->
</body>
</html>