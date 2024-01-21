<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/mostrar_documentos.css" rel="stylesheet" type="text/css" />
<? require "../../conexao.php"; ?>
</head>

<body>
<div id="box">
<?
$id_cliente = $_GET['id'];
$cpf_cliente = $_GET['cpf_cliente'];
?>
<h1><strong>Comprovante de renda</strong></h1>
<?
$sql_cpf = mysql_query("SELECT * FROM clientes_docs WHERE id_cliente = '$id_cliente' OR cpf = '$cpf_cliente' AND tipo = 'Comprovante de renda'");
if(mysql_num_rows($sql_cpf) == ''){
	echo "<h2><strong>Não existe comprovante de renda vinculado a este cliente.</strong></h2>";
}else{
		while($res_cpf = mysql_fetch_array($sql_cpf)){
?>
      <table class="table" width="280" border="0">
        <tr>
          <td><span class="h3">

            </span><span class="h3"><img src="../../clientes_docs/<? echo $res_cpf['doc']; ?>" alt="" width="280" height="150" class="img" /></span>
            </td>
          </tr>
        <tr>
          <td><span class="h3"><strong>Enviado por: </strong><? echo $res_cpf['resp_envio']; ?><br /><strong>Data:</strong><? echo $res_cpf['date']; ?></span></td>
          </tr>
      </table>
   <? }} ?>  
<img src="../../../img/back_ground.png" width="1250" height="1" />
<h1><strong>Extrato bancario</strong></h1>
<?
$sql_cpf = mysql_query("SELECT * FROM clientes_docs WHERE id_cliente = '$id_cliente' OR cpf = '$cpf_cliente' AND tipo = 'Extrato bancario'");
if(mysql_num_rows($sql_cpf) == ''){
	echo "<h2><strong>Não existe comprovante de extrato bancario vinculado a este cliente.</strong></h2>";
}else{
		while($res_cpf = mysql_fetch_array($sql_cpf)){
?>
      <table class="table" width="280" border="0">
        <tr>
          <td><span class="h3">

            </span><span class="h3"><img src="../../clientes_docs/<? echo $res_cpf['doc']; ?>" alt="" width="280" height="150" class="img" /></span>
            </td>
          </tr>
        <tr>
          <td><span class="h3"><strong>Enviado por: </strong><? echo $res_cpf['resp_envio']; ?><br /><strong>Data:</strong><? echo $res_cpf['date']; ?></span></td>
          </tr>
      </table>
   <? }} ?>  
                
</div><!-- box -->
</body>
</html>