<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Controle Financeiro VESTE PRIME</title>
<link href="css/alterarSenha.css" rel="stylesheet" type="text/css" />
<link href="img/index.png" rel="shortcut icon" type="text/css" />
<? require "config.php"; ?>
</head>

<body>
<div id="box">
<? if(isset($_POST['button'])){

$senhaAntiga = $_POST['senhaAntiga'];
$novaSenha = $_POST['novaSenha'];
$RepitaSenha = $_POST['RepitaSenha'];

if($senhaAntiga == ''){
	echo "<h1><strong>Digite a senha antiga!</strong></h1>";
}elseif($novaSenha == ''){
	echo "<h1><strong>Digite a nova senha!</strong></h1>";
}elseif($RepitaSenha == ''){
	echo "<h1><strong>Repita a SENHA de acesso!</strong></h1>";
}elseif($RepitaSenha != $novaSenha){
	echo "<h1><strong>As novas senhas digitadas não correspondem!</strong></h1>";	
}else{
	
$sql = mysqli_query($conexao_bd, "SELECT * FROM adm WHERE cpf = '$operador' senha = '$senhaAntiga'");
if(mysqli_num_rows($sql) >= 1){
	echo "<script language='javascript'>window.alert('Senha antiga não corresponde!');window.location='';</script>";
}else{
	echo "<img class='img' src='img/anigif.gif' width='200' height='200' />";
	
	mysqli_query($conexao_bd, "UPDATE adm SET senha = '$novaSenha' WHERE cpf = '$operador'");
		
		echo "<script language='javascript'>window.alert('Senha alterada e criptografada com sucesso! Por questões de segurança, você deverá refazer o login utilizando a nova senha');window.location='sair_do_sistema.php';</script>";		
	
	
}}}?>
 <img src="img/index.png" width="280" height="140" /><br /><br /><br />
 <hr />
<form action="" name="" method="post" enctype="multipart/form-data"> <table width="350" border="0">
  <tr>
    <td><strong>Digite sua senha atual:</strong></td>
  </tr>
  <tr>
    <td><label for="textfield"></label>
    <input type="password" name="senhaAntiga" autofocus></td>
  </tr>
  <tr>
    <td><strong>Digite a nova senha:</strong></td>
  </tr>
  <tr>
    <td><label for="textfield2"></label>
    <input type="password" name="novaSenha" value="<? echo @$_POST['cpf']; ?>"></td>
  </tr>
  <tr>
    <td><strong>Repita a nova senha:</strong></td>
  </tr>
  <tr>
    <td><label for="textfield3"></label>
    <input type="password" name="RepitaSenha" value="<? echo @$_POST['senha']; ?>"></td>
  </tr>
  <tr>
    <td><input class="input" type="submit" name="button" id="button" value="Entrar"></td>
  </tr>
</table>
</form>

</div><!-- box -->
</body>
</html>