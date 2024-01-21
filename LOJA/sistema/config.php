<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>

<body>
<? require "../conexao.php"; ?>
<?
@session_start();
@$login_operador = $_SESSION['login'];
@$nome_operador = $_SESSION['nome'];
@$cpf_operador = $_SESSION['cpf'];
@$senha_operador = $_SESSION['senha'];

if($login_operador == ''){
 echo "<script language='javascript'>window.location='../';</script>";
}elseif($nome_operador == ''){
 echo "<script language='javascript'>window.location='../';</script>";
}elseif($cpf_operador == ''){
 echo "<script language='javascript'>window.location='../';</script>";
}elseif($senha_operador == ''){
 echo "<script language='javascript'>window.location='../';</script>";
}else{
$autentica = mysqli_query($conexao_db, "SELECT * FROM adm WHERE login = '$login_operador' AND cpf = '$cpf_operador' AND senha = '$senha_operador'");
if(mysqli_num_rows($autentica) == ''){
  echo "<script language='javascript'>window.location='../';</script>";
}else{
}
}
?>
</body>
</html>