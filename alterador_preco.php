<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>

<body>
<? require "conexao.php"; 

$puxa_pelicula = mysqli_query($conexao_bd, "SELECT * FROM produtos WHERE titulo LIKE '%MASTHO%'");
while($res_pelicula = mysqli_fetch_array($puxa_pelicula)){
$code_produto = $res_pelicula['code'];

mysqli_query($conexao_bd, "UPDATE produtos SET valor_compra = '1.49' WHERE code = '$code_produto'");

}



?>
</body>
</html>