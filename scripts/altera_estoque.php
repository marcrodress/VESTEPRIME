<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
body {
	padding:0;
	font:12px Arial, Helvetica, sans-serif;
	margin:0;
}
</style>
<? require "../conexao.php"; $code_produto = $_GET['code']; $loja = $_GET['loja']; ?>
</head>

<body>
<? if(isset($_POST['altera'])){
	
$estoque = $_POST['estoque'];

if($loja == 'taiba'){
$sql_altera = mysqli_query($conexao_bd, "UPDATE produtos SET estoque = '$estoque' WHERE code = '$code_produto'");
}else{
$sql_altera = mysqli_query($conexao_bd, "UPDATE produtos SET estoque2 = '$estoque' WHERE code = '$code_produto'");
}

echo "Pressione F5";
die;
}?>


<form name="" method="post" enctype="multipart/form-data">
<?
$estoque = 0;
$sql = mysqli_query($conexao_bd, "SELECT * FROM produtos WHERE code= '$code_produto'");
while($res = mysqli_fetch_array($sql)){
	if($loja == 'taiba'){
		$estoque = $res['estoque'];
	}else{
		$estoque = $res['estoque2'];
	}	
}
?>
 <input style="font:12px Arial, Helvetica, sans-serif; text-align:center; width:55px;" type="number" name="estoque" value="<? echo $estoque; ?>" />
 <input type="submit" name="altera" value="Alterar" />
</form>
</body>
</html>