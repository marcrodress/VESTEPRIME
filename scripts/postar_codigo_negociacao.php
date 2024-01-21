<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
body {
	font:12px Arial, Helvetica, sans-serif;
	color:#333;
	text-align:center;
}
</style>
</head>

<body>

<? if(isset($_POST['enviar'])){

require "../conexao.php";

$codigo_barras = $_POST['codigo_barras'];
$vencimento = $_POST['vencimento'];
$localizador = $_POST['localizador'];

mysqli_query($conexao_bd, "UPDATE boletos_negociacao SET codigo_barras = '$codigo_barras', localizador = '$localizador', vencimento = '$vencimento' WHERE id = '".$_GET['id']."'");

echo "Boleto postado com sucesso!<br><br>Pressione F5";

die;

}?>

<form name="" method="post" action="" enctype="multipart/form-data">
 <strong>Código de barras - PARCELA: <? echo $_GET['parcela']; ?></strong> <br />
 <input type="text" style="font:20px Arial, Helvetica, sans-serif; padding:5px; border-radius:3px; text-align:center; color:#F00; border:1px solid #000;" name="codigo_barras" value="<? echo $_GET['codigo_barras']; ?>" size="70" />
 <br />
 <strong>Código do vencimento</strong> <br />
 <input name="vencimento" type="text" style="font:20px Arial, Helvetica, sans-serif; padding:5px; border-radius:3px; text-align:center; color:#F00; border:1px solid #000;" value="<? echo $_GET['vencimento']; ?>" size="5" />
 <br /> 
 <strong>Localizador</strong> <br />
 <input style="font:20px Arial, Helvetica, sans-serif; padding:5px; border-radius:3px; text-align:center; color:#F00; border:1px solid #000;"type="text" name="localizador" value="<? echo $_GET['localizador']; ?>" />
 <br /><br />
 <input style="font:20px Arial, Helvetica, sans-serif; padding:5px; border-radius:3px; text-align:center; color:#F00; border:1px solid #000;" type="submit" name="enviar" value="Enviar" /> 
</form>
</body>
</html>