<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<? require "../config.php"; $codigoProduto = $_GET['produto']; ?>
<style>
	body{
	margin: 20px auto;
	text-align:center;
	background-color: #000;
	font:12px Arial, Helvetica, sans-serif;
	color:#FFF;
	}
</style>
</head>

<body>
<? if(isset($_POST['quantidade'])){

	$quantidade = $_POST['quantidade'];
	
	
	$sqlLista = mysqli_query($conexao_bd, "SELECT * FROM ProdutosListaCodigoBarras WHERE produto = '$codigoProduto' AND operador = '$operador'");
	if(mysqli_num_rows($sqlLista) == ''){
		mysqli_query($conexao_bd, "INSERT INTO ProdutosListaCodigoBarras (produto, quantidade, operador) VALUES ('$codigoProduto', '$quantidade', '$operador')");
	}else{
		mysqli_query($conexao_bd, "UPDATE ProdutosListaCodigoBarras SET quantidade = '$quantidade' WHERE produto = '$codigoProduto' AND operador = '$operador'");
	}
	
	echo "<strong>Operação realizada com sucesso!</strong><br><br>Pode fechar esta página ou pressionar F5";
	
	die;
	
	

}?>

<?php
$quant = 0;
$codigoProduto = $_GET['produto'];
$sqlLista = mysqli_query($conexao_bd, "SELECT * FROM ProdutosListaCodigoBarras WHERE produto = '$codigoProduto' AND operador = '$operador'");
while ($resLista = mysqli_fetch_array($sqlLista)) {
    $quant = $resLista['quantidade'];
}
?>
    <form action="" method="post" enctype="multipart/form-data">
        <h4 style="font:12px Arial, Helvetica, sans-serif; margin:5px;"><strong>Quantidade de códigos</strong></h4>
        <input autofocus="autofocus" style="font:20px Arial, Helvetica, sans-serif; padding:10px; text-align:center; width:100px; margin:5px;" name="quantidade" type="number" value="<?php echo $quant; ?>" />
        <input type="submit" style="font:15px Arial, Helvetica, sans-serif; height:40px; padding:10px; width:80px; margin:5px;" />
    </form>

</body>
</html>