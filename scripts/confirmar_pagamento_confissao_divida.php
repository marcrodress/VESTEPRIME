<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
body {
	border:1px solid #000;
	text-align:center;
}
</style>
</head>

<body>
<? if(isset($_POST['enviar'])){

require "../conexao.php";

$data_pagamento = $_POST['data_pagamento'];
$valor = $_POST['valor'];
$code_negociacao = $_GET['code_negociacao'];

$sql_divida = mysqli_query($conexao_bd, "UPDATE boletos_negociacao SET status = 'PAGO', valor = '$valor', data_pagamento = '$data_pagamento' WHERE id = '".$_GET['id']."'");

if($_GET['parcela'] == '1'){
	
$sql_tipo = mysqli_query($conexao_bd, "SELECT * FROM dados_da_divida_negociacao WHERE code_negociacao = '$code_negociacao'");
while($res_tipo = mysqli_fetch_array($sql_tipo)){
	
	
} // while tipo de emprestimo
		require "tipo/credito_grupo.php";

	
}


echo "<br>Pagamento confirmado com sucesso!!!<br><br>Pressione F5 para mesclar a operação.<br><br>";
die;
}?>

<form name="" method="post" action="" enctype="multipart/form-data">
<h1 style="font:15px Arial, Helvetica, sans-serif;"><strong>Data de pagamento:</strong></h1>
<input style="font:20px Arial, Helvetica, sans-serif; color:#F90; padding:5px; border-radius:5px; border:1px solid #000; text-align:center;" name="data_pagamento" type="text" value="<? echo date("d/m/Y"); ?>" /><br />
<h1 style="font:15px Arial, Helvetica, sans-serif;"><strong>Valor pago:</strong></h1>
<input name="valor" type="text" id="valor" style="font:20px Arial, Helvetica, sans-serif; color:#F90; padding:5px; border-radius:5px; border:1px solid #000; text-align:center;" value="<? echo $_GET['valor']; ?>" size="5" /><br /><br />
<input style="font:12px Arial, Helvetica, sans-serif; color:#000; padding:5px; border-radius:5px; border:1px solid #000; text-align:center;" type="submit" name="enviar" value="Confirmar" />
</form><br />
</body>
</html>