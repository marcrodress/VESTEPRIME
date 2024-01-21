<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/tirar_cadastro_lista.css" rel="stylesheet" type="text/css" />
<? require "../../conexao.php"; ?>
</head>

<body>
<? if(isset($_POST['send'])){
	
$id = $_GET['id'];

mysql_query("UPDATE lista_inss SET status = 'Inativo' WHERE id = '$id'");

echo "Operação efetuada com sucesso.";
die;
}?>
<form name="" method="post" action="" enctype="multipart/form-data">
 <input type="submit" name="send" value="Confirmar" />
</form>
</body>
</html>