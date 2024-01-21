<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<? 

session_start();
$_SESSION['cpf'] = 000;
$_SESSION['nome'] = 000;

unset($_SESSION['codeCaixa']);
session_destroy();


	echo "<script language='javascript'>window.location='login.php';</script>";




?>
</body>
</html>