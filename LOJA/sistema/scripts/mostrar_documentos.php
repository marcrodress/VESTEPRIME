<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/mostrar_documentos.css" rel="stylesheet" type="text/css" />
</head>

<body>
<? require "../../conexao.php"; ?>
<div id="box">
<?
$id_cliente = $_GET['id'];
$cpf_cliente = $_GET['cpf_cliente'];
?>
<h1><strong>CPF</strong></h1>
<?
$sql_cpf = mysql_query("SELECT * FROM clientes_docs WHERE id_cliente = '$id_cliente' AND tipo = 'CPF'");
if(mysql_num_rows($sql_cpf) == ''){
	echo "<h2><strong>Não existe comprovante de CPF vinculado a este cliente.</strong></h2>";
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
   <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
<hr /><h1><strong>RG</strong></h1>
<?
$sql_cpf = mysql_query("SELECT * FROM clientes_docs WHERE id_cliente = '$id_cliente' AND tipo = 'RG'");
if(mysql_num_rows($sql_cpf) == ''){
	echo "<h2><strong>Não existe comprovante de RG vinculado a este cliente.</strong></h2>";
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
   
   <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
<hr /><h1><strong>Comprovante de endereço</strong></h1>
<?
$sql_cpf = mysql_query("SELECT * FROM clientes_docs WHERE id_cliente = '$id_cliente' AND tipo = 'Comprovante de endereço'");
if(mysql_num_rows($sql_cpf) == ''){
	echo "<h2><strong>Não existe comprovante de endereço vinculado a este cliente.</strong></h2>";
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
   
   <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
<hr /><h1><strong>Titulo de eleitor</strong></h1>
<?
$sql_cpf = mysql_query("SELECT * FROM clientes_docs WHERE id_cliente = '$id_cliente' AND tipo = 'Titulo'");
if(mysql_num_rows($sql_cpf) == ''){
	echo "<h2><strong>Não existe comprovante de titulo vinculado a este cliente.</strong></h2>";
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
   
   <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
<hr /><h1><strong>Comprovante de alistamento militar</strong></h1>
<?
$sql_cpf = mysql_query("SELECT * FROM clientes_docs WHERE id_cliente = '$id_cliente' AND tipo = 'Reservista'");
if(mysql_num_rows($sql_cpf) == ''){
	echo "<h2><strong>Não existe comprovante de reservista vinculado a este cliente.</strong></h2>";
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
   
   <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
<hr /><h1><strong>Comprovante de carteira de trabalho e previdência social</strong></h1>
<?
$sql_cpf = mysql_query("SELECT * FROM clientes_docs WHERE id_cliente = '$id_cliente' AND tipo = 'Carteira de Trabalho'");
if(mysql_num_rows($sql_cpf) == ''){
	echo "<h2><strong>Não existe carteira de trabalho vinculado a este cliente.</strong></h2>";
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
   
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
<hr /><h1><strong>Comprovante de certidão de nascimento</strong></h1>
<?
$sql_cpf = mysql_query("SELECT * FROM clientes_docs WHERE id_cliente = '$id_cliente' AND tipo = 'Certidão de nascimento'");
if(mysql_num_rows($sql_cpf) == ''){
	echo "<h2><strong>Não existe Certidão de nascimento vinculado a este cliente.</strong></h2>";
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

   
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
<hr /><h1><strong>Comprovante de certidão de casamento</strong></h1>
<?
$sql_cpf = mysql_query("SELECT * FROM clientes_docs WHERE id_cliente = '$id_cliente' AND tipo = 'Certidão de casamento'");
if(mysql_num_rows($sql_cpf) == ''){
	echo "<h2><strong>Não existe Certidão de casamento vinculado a este cliente.</strong></h2>";
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