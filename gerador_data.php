<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
</head>

<body>
<?
require "conexao.php";
for($i=1; $i<=31; $i++){
	$nova_codigo = 9428+$i;
	$nova_data = 0;
	if($i < 10){
		$nova_data = "0$i/07/2023";
	}else{
		$nova_data = "$i/07/2023";
	}
	
	$sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento WHERE codigo = '$nova_codigo'");
	if(mysql_num_rows($sql_verifica) == NULL){
	mysqli_query($conexao_bd,"INSERT INTO datas_vencimento (codigo, vencimento) VALUES ('$nova_codigo', '$nova_data')");
	}
 }
?>
</body>
</html>