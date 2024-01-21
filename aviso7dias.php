<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<? require "conexao.php"; ?>
</head>

<body>
<?

$id_fatura = $_GET['id_fatura'];

$cliente = 0;
$vencimento = 0;
$code_fatura = 0;
$nome_cliente = 0;
$email_cliente1 = 0;
$email_cliente2 = 0;
$email_cliente3 = 0;
$valor = 0;


if($id_fatura == ''){
	$id_fatura = 1;
}else{
	$id_fatura = $id_fatura;
}

$total_fatura = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM faturas_fechadas"));

if($id_fatura > $total_fatura){
	echo "<script language='javascript'>window.location='aviso3dias.php?id_fatura=3000';</script>";
}else{


$sql_vencimento = mysqli_query($conexao_bd, "SELECT * FROM faturas_fechadas WHERE vencimento_sete_dias = '$code_vencimento_hoje' AND sit_pag = 'AGUARDA PAGAMENTO' AND id = '$id_fatura'");
if(mysqli_num_rows($sql_vencimento) == ''){
	$id_fatura++;
	echo "<script language='javascript'>window.location='?id_fatura=$id_fatura';</script>";
}else{
	
	while($res_fatura = mysqli_fetch_array($sql_vencimento)){
		$cliente = $res_fatura['cliente'];
		$vencimento = $res_fatura['vencimento'];
		$code_fatura = $res_fatura['code_fatura'];
		$saldo = $res_fatura['saldo'];
	}
	
  $sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '$cliente'");
	  while($res_cliente = mysqli_fetch_array){
		 
		 $email_cliente1 = $res_cliente['email']; 
		 $email_cliente2 = $res_cliente['email2']; 
		 $email_cliente3 = $res_cliente['email3']; 
		 $nome_cliente = $res_cliente['nome'];
    	 $telefone_cliente = $res_cliente['celular_1'];
	  }
	  
	
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


$valor_sms = number_format($valor,2,',','.');

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.smsdev.com.br/v1/send?key=TZXZSWGNSZY51PZTLQ1SI772BRGA1FGQAKH16GEYTWKMUBSHF2K5D4O4REAUCWD2KG686DRENLFCJZKQT0FEJ4V1YSVICR1DCRU1PJW2OZIW48VKFQ8V084I82QJ5SSZ&type=9&number=$telefone_cliente&msg=".urlencode("VESTE PRIME: Faltam 7 dias para o vencimento da sua fatura no valor de R$ $saldo. Vencimento: $vencimento. Mais informações acesse seu e-mail.
  
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
	  
	  
	  

include("phpmailer/class.phpmailer.php");

$mail = new PHPMailer();
$mail->IsMAIL(); 
$mail->Host = "mail.ikuly.com"; 
$mail->SMTPAuth = true; 
$mail->Username = "suporte@ikuly.com"; 
$mail->Password = "Rcbv896xw*"; // senha
$mail->From = "suporte@ikuly.com";
$mail->FromName = "SUA FATURA VENCE EM 7 DIAS!";
$mail->AddAddress("$email_cliente1,$email_cliente2,$email_cliente3,$vesteprime","VESTE PRIME CARD");
$mail->WordWrap = 500; 
$mail->AddAttachment("anexo/arquivo.zip"); 
$mail->AddAttachment("imagem/foto.jpg");
$mail->IsHTML(true); //enviar em HTML

	$valor_total_fatura = number_format($valor_total_fatura,2,',','.');

	$mail->AddReplyTo("$email_cliente","$nome_cliente");
	$msg  = "";
	$msg .= "


<table width='800' align='center' style='border:20px solid #F90; border-radius:0; padding:10px;' border='0'>
  <tr>
    <td width='232' style='border:2px solid #FC0; border-radius:1000px; margin:-5px 0 0 0;'  align='center' bgcolor='#FFFFFF'><h1 style='font:12px Arial, Helvetica, sans-serif; color:#CCC;'><strong>COD. FATURA:</strong> $code_fatura</h1></td>
    <td width='370' style='border:2px solid #099; border-radius:1000px; margin:-5px 0 0 0;'  align='center' bgcolor='#999999'><span style='font:20px Arial, Helvetica, sans-serif; color:#CCC;'><strong>VESTE PRIME CARD</strong></span></td>
    <td width='174' style='border:2px solid #FC0; border-radius:1000px; margin:-5px 0 0 0;'  align='center' bgcolor='#FFFFFF'><h1 style='font:12px Arial, Helvetica, sans-serif; color:#CCC;'><strong>VENCIMENTO:</strong> $vencimento</h1></td>
  </tr>
  <tr>
    <td colspan='3' style='border:2px solid #099; border-radius:1000px; margin:-5px 0 0 0;'  align='center' bgcolor='#003366'><h2 style='font:15px Arial, Helvetica, sans-serif; color:#0CF;'>FATURA MENSAL - VESTE PRIME CARD</h2></td>
  </tr>
  <tr>
    <td width='232' align='center'><img style='border-radius:10px; border:5px solid #069;' src='http://ikuly.com/caixa/img/veste_prime_card.jpg' alt='' width='250' height='150' /></td>
    <td align='justify' style='border:1px solid #CCC; border-radius:20px;'><h1 style='font:20px Arial, Helvetica, sans-serif; color:#CC0; padding:2px;'><strong>Olá, $nome_cliente!
    <br><br>
    A fatura do seu cartão vence em 7 dias, o valor para pagamento é de R$ $saldo com vencimento em $vencimento.</strong></h1></td>
    <td width='174' align='center'><a href='http://www.ikuly.com/caixa/scripts/fatura_fechada.php?code_fatura=$code_fatura'><img src='https://lh3.googleusercontent.com/TNlo7C3s2OLtz6FbjemlFxcoLY4Gc7aCZEhV1foVyy9xOtWC2CN4gJmbf_V3N8yEFg' width='100' border='0'/></a></td>
  </tr>
  <tr>
    <td colspan='3' align='center' bgcolor='#FFFFFF'><h1 style='font:25px Arial, Helvetica, sans-serif; color:#093; border:5px solid #F90; padding:5px; border-radius:10px;'><strong>Não se esqueça, se as coisas apertarem, você pode parcelar todo o saldo da sua fatura em até 24X vezes fixas.</strong></h1></td>
  </tr>
  <tr>
    <td colspan='3' align='center'><p style='font:10px Arial, Helvetica, sans-serif;'>Para sua segurança, estamos enviando sua fatura por e-mail.</p>
    <p style='font:10px Arial, Helvetica, sans-serif;'>Evite pagar juros e multas, pague sua fatura em dias e evite a restrinção nos orgãos de proteção ao crédito, como o SPC e SARASA.</p></td>
  </tr>
  <tr>
    <td colspan='3' align='center'><a href='http://www.ikuly.com/caixa/scripts/fatura_fechada.php?code_fatura=$code_fatura'><img src='http://ikuly.com/caixa/img/baixar_fatura.png' alt='' width='272' height='78' border='0' /></a>
    <hr /></td>
  </tr>
  <tr>
    <td align='center' style='border:2px solid #099; border-radius:10px; margin:-5px 0 0 0;'><img src='http://www.acim.com.br/wp-content/uploads/2016/03/spc-site.png' width='120' height='60' /><img src='https://upload.wikimedia.org/wikipedia/commons/thumb/3/30/SerasaExperian-TM_Portrait_RGB.svg/383px-SerasaExperian-TM_Portrait_RGB.svg.png' width='120' height='60' /></td>
    <td colspan='2'><p style='font:10px Arial, Helvetica, sans-serif; color:#F00; font-size: 10px'><strong>AVISO:</strong> Após 20 dias de atraso será solicitado a inclusão de seu CPF nos orgão de proteção ao crédito.</p>
    <p style='font:10px Arial, Helvetica, sans-serif;; font-family: Arial, Helvetica, sans-serif; font-size: 10px'><span style='font-family: Arial, Helvetica, sans-serif; font-size: 10px'>Após 45 dias de atraso será solicitado a inclusão desta fatura nos cartórios de protestos.</span></p></td>
  </tr>
  <tr>
    <td colspan='3'><hr /></td>
  </tr>
  <tr>
    <td colspan='3' align='justify' bgcolor='#999999' style='border:2px solid #066; border-radius:10px; margin:-5px 0 0 0;'><h4 style='font:11px Arial, Helvetica, sans-serif; color:#CCC; padding:0 5px 0 5px;'>Consultas, informações, transações, acesse www.vesteprime.com.br ou ligue (85) 3315.6199 (capitais e regiões metropolitanas) ou (85) 99158.7323 (demais localidades, somente chamadas de telefone fixo), de segunda a domingo, das 8h às 17h (exceto feriados nacionais). Reclamações, cancelamentos e informações gerais, ligue para o (85) 3315.6199, todos os dias, 24 horas por dia. Se não ficar satisfeito com a solução apresentada, contate a Ouvidoria: (85) 3315.6199, em dias úteis, das 9h às 18h.</h4></td>
  </tr>
  <tr>
    <td colspan='3' align='center' bgcolor='#FFFFFF'><h3 style='font:12px Arial, Helvetica, sans-serif; padding:0; margin:0; color:#999;'><em>Esta mensagem é automática, por favor, não responder.</em></h3></td>
  </tr>
</table>


	<br>\n";
 
$mail->Subject = "SUA FATURA VENCE EM 7 DIAS!";
//adicionando o html no corpo do email
$mail->Body = $msg;
//enviando e retornando o status de envio
if(!$mail->Send())
{

echo "Ocorreru um erro, tente novamente!".$mail->ErrorInfo;
//$mail->ErrorInfo informa onde ocorreu o erro 

exit;
}	 
  
$id_fatura++;
echo "<script language='javascript'>window.location='?id_fatura=$id_fatura';</script>";  
  
 }
}
?>
</body>
</html>