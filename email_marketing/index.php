<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<? require "../conexao.php"; ?>
</head>

<body>
<?

$inicio = 0;
$fim = 0;

$sql_email = mysqli_query($conexao_bd, "SELECT * FROM email_enviar WHERE data_envio = '' AND status = 'Aguarda' ORDER BY id ASC LIMIT 1");
	while($res_email = mysqli_fetch_array($sql_email)){
		
		$inicio = $res_email['id'];
		
	}
	
	$fim = $inicio+200;
	
	echo "<script language='javascript'>window.location='enviar.php?inicio=$inicio&fim=$fim';</script>";

?>
</body>
</html>