<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/cancela_deposito.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="box">
<? require "../config.php"; ?>
<? if(isset($_POST['button'])){

$motivo = $_POST['motivo'];
$id = $_GET['id'];

mysqli_query($conexao_bd, "UPDATE deposito_banco_brasil SET status = 'Cancelado', motivo_cancelamento = '$motivo', operador_cancelamento = '$operador' WHERE id = '$id'");

echo "Cancelamento efetuado com sucesso!<br><br>Pressione F5 para mesclar a operação.";
die;
}?>
<strong>INFORME O MOTIVO DO CANCELAMENTO</strong><br />

<form name="" method="post" action="" enctype="multipart/form-data">
<textarea name="motivo"></textarea><br /><br />
<input type="submit" name="button" value="Cancelar" />
</form>
</div><!-- box -->
</body>
</html>