<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/tirar_cadastro_lista.css" rel="stylesheet" type="text/css" />
</head>

<body>

<? if(isset($_POST['send'])){
require "../../conexao.php";	
$id = $_GET['id'];
$date = date("d/m/Y H:i:s");

mysql_query("UPDATE telemarketing SET ultima_ligacao = '$date' WHERE id = '$id'");

echo "Ligação confirmada.";
die;
}?>

<form name="" method="post" action="" enctype="multipart/form-data">
 <input type="submit" name="send" value="Confirmar" />
</form>
</body>
</html>