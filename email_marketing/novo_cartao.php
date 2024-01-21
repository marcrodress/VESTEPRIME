<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<? require "../conexao.php"; ?>
</head>

<body>
<?

$conta_cliente = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM clientes"));

$id = $_GET['id'];
if($id == 0){
	$id = 1;
}else{
	echo $id = $id;	
}

if($id >=($conta_cliente+10)){
	echo "<script language='javascript'>window.location='index.php';</script>";
}
$conta_clientes = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE id = '$id'");
if(mysqli_num_rows($conta_clientes) <=0){
$id++;
echo "<script language='javascript'>window.location='?id=$id';</script>";	
}else{

	$email_cliente = 0;
	$nome_cliente = 0;
	$nome_cliente_sms = 0;
	$telefone_cliente = 0;
	 
	 while($res_fatura = mysqli_fetch_array($conta_clientes)){
		echo $nome_cliente = strtoupper($res_fatura['nome']);
		echo "<br>";
		echo $telefone_cliente = $res_fatura['celular_1'];		
	} // while
	

$telefone_cliente = str_replace(" ", "", $telefone_cliente); 
$telefone_cliente = str_replace(",", "", $telefone_cliente); 
$telefone_cliente = str_replace("ã", "", $telefone_cliente);
$telefone_cliente = str_replace("á", "", $telefone_cliente); 
$telefone_cliente = str_replace("à", "", $telefone_cliente); 
$telefone_cliente = str_replace("é", "", $telefone_cliente);
$telefone_cliente = str_replace("ê", "", $telefone_cliente); 
$telefone_cliente = str_replace("è", "", $telefone_cliente); 
$telefone_cliente = str_replace("í", "", $telefone_cliente);
$telefone_cliente = str_replace("ì", "", $telefone_cliente); 
$telefone_cliente = str_replace("ó", "", $telefone_cliente); 
$telefone_cliente = str_replace("õ", "", $telefone_cliente);
$telefone_cliente = str_replace("ç", "", $telefone_cliente); 
$telefone_cliente = str_replace("(", "", $telefone_cliente); 
$telefone_cliente = str_replace(")", "", $telefone_cliente);
$telefone_cliente = str_replace(".", "", $telefone_cliente);

$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.smsdev.com.br/v1/send?key=TZXZSWGNSZY51PZTLQ1SI772BRGA1FGQAKH16GEYTWKMUBSHF2K5D4O4REAUCWD2KG686DRENLFCJZKQT0FEJ4V1YSVICR1DCRU1PJW2OZIW48VKFQ8V084I82QJ5SSZ&type=9&number=$telefone_cliente&msg=".urlencode("VESTE PRIME: Você foi selecionado(a) para ser um dos primeiros a obter nosso cartão MASTERCARD, gostaria de solicitar? Clique no link http://abre.ai/veste2020
  
  "),
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_SSL_VERIFYHOST => 0,
  CURLOPT_SSL_VERIFYPEER => 0,
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}	
	
	
	
	
	
	$id++;
	echo "<script language='javascript'>window.location='?id=$id';</script>";	
	
}


?>
</body>
</html>