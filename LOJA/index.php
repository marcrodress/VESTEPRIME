<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Controle Financeiro Easy Loan</title>
<link href="css/index.css" rel="stylesheet" type="text/css" />
<link href="img/index.png" rel="shortcut icon" type="text/css" />
<? require "conexao.php"; ?>

</head>

<body>
<div id="box">
<? if(isset($_POST['button'])){

$login = $_POST['login'];
$cpf = $_POST['cpf'];
$senha = $_POST['senha'];

if($login == ''){
	echo "<h1><strong>Digite o LOGIN de acesso!</strong></h1>";
}elseif($cpf == ''){
	echo "<h1><strong>Digite o CPF de acesso!</strong></h1>";
}elseif($senha == ''){
	echo "<h1><strong>Digite o SENHA de acesso!</strong></h1>";	
}else{
	
$sql = mysqli_query($conexao_db, "SELECT * FROM adm WHERE login = '$login' AND cpf = '$cpf' AND senha = '$senha'");
if(mysqli_num_rows($sql) == ''){
	echo "<script language='javascript'>window.alert('Login e senha não corresponde!');window.location='index.php';</script>";
}else{
	echo "<img class='img' src='img/anigif.gif' width='200' height='200' />";
	while($res = mysqli_fetch_array($sql)){
		
	session_start();
	$_SESSION['login'] = $login;
	$_SESSION['cpf'] = $cpf;
	$_SESSION['senha'] = $senha;
	$_SESSION['nome'] = $res['nome'];
	
	echo "<script language='javascript'>window.location='sistema/?pack=T74DFG85F1F';</script>";
	
}}}}?>
 <img src="img/index.png" width="280" height="140" /><br /><br /><br />
 <hr />
<form action="" name="" method="post" enctype="multipart/form-data"> <table width="350" border="0">
  <tr>
    <td><strong>Login:</strong></td>
  </tr>
  <tr>
    <td><label for="textfield"></label>
    <input type="password" name="login" value="<? echo @$_POST['login']; ?>"></td>
  </tr>
  <tr>
    <td><strong>CPF:</strong></td>
  </tr>
  <tr>
    <td><label for="textfield2"></label>
    <input type="password" name="cpf" value="<? echo @$_POST['cpf']; ?>"></td>
  </tr>
  <tr>
    <td><strong>Senha:</strong></td>
  </tr>
  <tr>
    <td><label for="textfield3"></label>
    <input type="password" name="senha" value="<? echo @$_POST['senha']; ?>"></td>
  </tr>
  <tr>
    <td><input class="input" type="submit" name="button" id="button" value="Entrar"></td>
  </tr>
</table>
</form>

</div><!-- box -->
</body>
</html>