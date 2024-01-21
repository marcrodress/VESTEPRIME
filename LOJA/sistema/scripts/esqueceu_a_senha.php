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
	
$email = $_POST['email'];
$nova_senha = $_POST['nova_senha'];
$repet_senha = $_POST['repet_senha'];

$cpf_cliente = $_GET['cpf_cliente'];
$id_cliente = $_GET['id'];
	
$operador = $_GET['operador'];
$cpf_operador = $_GET['cpf_operador'];

$date = date("d/m/Y H:i:s");
$ip = $_SERVER['REMOTE_ADDR'];

$sql_senha = mysql_query("SELECT * FROM clientes WHERE senha = '$nova_senha' AND id = '$id_cliente'");
if(mysql_num_rows($sql_senha) == ''){
 echo "<script language='javascript'>window.alert('A senha digitada pelo cliente não confere!');</script>";
}else{
 if($nova_senha != $repet_senha){
 echo "<script language='javascript'>window.alert('As senhas digitadas não cofere!');</script>";
}else{
$update = mysql_query("UPDATE clientes SET senha = '$nova_senha', email = '$email' WHERE id = '$id_cliente'");
if($update == ''){
 echo "<script language='javascript'>window.alert('Ocorreu um erro ao atualizar os dados de acesso!');</script>";
}else{
mysql_query("INSERT INTO atualizacao_de_cadastro (ip, date, cpf, id_cliente, tipo_de_dado, operador, cpf_operador) VALUES ('$ip', '$date', '$cpf_cliente', '$id_cliente', 'Atualização dos dados de acesso', '$operador', '$cpf_operador')");

 echo "<script language='javascript'>window.alert('Dados de acesso atualizado com sucesso!');</script>";
}}}}?>

<form name="" method="post" action="" enctype="multipart/form-data">
<div id="box_atualiza_cpf">
 <table width="450" border="0" align="center">
  <tr>
    <td colspan="2"align="center"><h1><strong>CPF atual</strong><br /> <? echo $_GET['cpf_cliente']; ?></h1></td>
  </tr>
  <tr>
    <td colspan="2"align="center"><hr /></td>
  </tr>  
  <tr>
    <td width="215">Crie uma nova senha:</td>
    <td width="225">Nova senha:</td>
  </tr>
  <tr>
    <td><label for="textfield"></label>
      <span id="sprytextfield1">
      <input type="password" name="nova_senha" id="textfield" value="<? echo $_GET['senha']; ?>" />
      </span></td>
    <td><label for="textfield2"></label>
      <span id="sprytextfield2">
      <input type="password" name="repet_senha" id="textfield2" value="<? echo $_GET['senha']; ?>" />
      </span></td>
  </tr>
  <tr>
    <td colspan="2"align="center">Novo e-mail:</td>
  </tr>
  <tr>
    <td colspan="2"align="center"<br />
      <label for="textfield3"></label>
      <span id="sprytextfield3">
      <input type="text" name="email" id="textfield3" value="<? echo $_GET['email']; ?>" />
      </span></td>
  </tr>
  <tr>
    <td colspan="2"align="center"><input class="input2" type="submit" name="send" value="Atualizar" /></td>
  </tr>
 </table>
</form>
</div><!-- box_atualiza_cpf -->
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "email", {useCharacterMasking:true});
</script>
</body>
</html>