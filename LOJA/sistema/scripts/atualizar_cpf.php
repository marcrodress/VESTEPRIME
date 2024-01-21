<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../css/cadastrar_cliente.css" rel="stylesheet" type="text/css" />
<script src="../../../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../../../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>

<body>
<? require "../../conexao.php"; ?>

<? if(isset($_POST['send'])){

$senha = $_POST['senha'];
$novo_cpf = $_POST['novo_cpf'];
$repit_cpf = $_POST['repit_cpf'];

$cpf_cliente = $_GET['cpf_cliente'];
$id_cliente = $_GET['id'];
	
$operador = $_GET['operador'];
$cpf_operador = $_GET['cpf_operador'];

$date = date("d/m/Y H:i:s");
$ip = $_SERVER['REMOTE_ADDR'];

$sql_senha = mysql_query("SELECT * FROM clientes WHERE senha = '$senha' AND id = '$id_cliente'");
if(mysql_num_rows($sql_senha) == ''){
 echo "<script language='javascript'>window.alert('A senha digitada pelo cliente não confere!');</script>";
}else{
if($novo_cpf == $cpf_cliente){
 echo "<script language='javascript'>window.alert('O novo CPF é o mesmo do antigo CPF!');</script>";
}else{
 if($novo_cpf != $repit_cpf){
 echo "<script language='javascript'>window.alert('OS CPFs digitados não cofere!');</script>";
}else{
$update = mysql_query("UPDATE clientes SET cpf = '$novo_cpf' WHERE id = '$id_cliente'");
if($update == ''){
 echo "<script language='javascript'>window.alert('Ocorreu um erro ao atualizar o CPF!');</script>";
}else{
mysql_query("INSERT INTO atualizacao_de_cadastro (ip, date, cpf, id_cliente, tipo_de_dado, operador, cpf_operador) VALUES ('$ip', '$date', '$cpf_cliente', '$id_cliente', 'Atualização de CPF', '$operador', '$cpf_operador')");

 echo "<script language='javascript'>window.alert('CPF atualizado com sucesso!');</script>";
}}}}}?>

<div id="box_atualiza_cpf">
<form name="send" method="post" action="" enctype="multipart/form-data">
 <table width="450" border="0" align="center">
  <tr>
    <td colspan="2"align="center"><h1><strong>CPF atual</strong><br /> <? echo $_GET['cpf_cliente']; ?></h1></td>
  </tr>
  <tr>
    <td colspan="2"align="center"><hr /></td>
  </tr>  
  <tr>
    <td width="215">Digite o novo CPF:</td>
    <td width="225">Repita o novo CPF:</td>
  </tr>
  <tr>
    <td><label for="textfield"></label>
      <span id="sprytextfield1">
      <input type="text" name="novo_cpf" id="textfield" />
      </span></td>
    <td><label for="textfield2"></label>
      <span id="sprytextfield2">
      <input type="text" name="repit_cpf" id="textfield2" />
      </span></td>
  </tr>
  <tr>
    <td colspan="2"align="center"><strong>Digite a senha de altorização</strong><br> 
      <label for="textfield3"></label>
      <span id="sprytextfield3">
      <input type="password" name="senha" id="textfield3" />
      </span></td>
  </tr>
  <tr>
    <td colspan="2"align="center"><input class="input2" type="submit" name="send" value="Atualizar"></td>
  </tr>
</table>
</form>
</div><!-- box_atualiza_cpf -->
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "social_security_number", {format:"ssn_custom", pattern:"000.000.000-00", useCharacterMasking:true});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "social_security_number", {format:"ssn_custom", useCharacterMasking:true, pattern:"000.000.000-00"});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
</script>
</body>
</html>