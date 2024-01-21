<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<?php

$telefone_cliente = "(85) 98422.8226";

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

echo $telefone_cliente;

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.smsdev.com.br/v1/send?key=TZXZSWGNSZY51PZTLQ1SI772BRGA1FGQAKH16GEYTWKMUBSHF2K5D4O4REAUCWD2KG686DRENLFCJZKQT0FEJ4V1YSVICR1DCRU1PJW2OZIW48VKFQ8V084I82QJ5SSZ&type=9&number=85994345834&msg=".urlencode("VESTE PRIME: Hanna, Você recebeu uma mensagem com erro na data de hoje, 25/10/2020. Esta mensagem era ter sido enviada para outro cliente. Pedimos desculpas pelo ocorrido!
  
  
  
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

?>
</body>
</html>