<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>

<body>
<?
require "conexao.php";

$id_parcela = $_GET['id_parcela'];
$email_cliente = 0;
$parcela = 0;
$nome_cliente = 0;
$code_vencimento = 0;
$total = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM boletos_emprestimo_boleto"))+100;

if($id_parcela > $total){
  echo "<script language='javascript'>window.location='aviso_dia_emprestimo.php';</script>";
}else{
	
if($id_parcela == 0){
$id_parcela = 1;
}else{
$id_parcela = $id_parcela;
}

$sql_parcela = mysqli_query($conexao_bd, "SELECT * FROM boletos_emprestimo_boleto WHERE id = '$id_parcela' AND status = 'AGUARDA'");
if(mysqli_num_rows($sql_parcela) == ''){
	$id_parcela++;
	echo "<script language='javascript'>window.location='?id_parcela=$id_parcela';</script>";
}else{
	while($res_parcela = mysqli_fetch_array($sql_parcela)){
		$code_vencimento = $res_parcela['vencimento']-3;
		$cliente = $res_parcela['cliente'];
		$valor = $res_parcela['valor'];
		$id = $res_parcela['id'];
		$proposta = $res_parcela['proposta'];
		$parcela = $res_parcela['parcela'];


		if($code_vencimento_hoje == $code_vencimento){

$email_cliente = 0;
$nome_cliente = 0;
$telefone_cliente = 0;

$sql_email_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '$cliente'");	
	while($res_email_cliente = mysqli_fetch_array($sql_email_cliente)){
		$email_cliente = strtolower($res_email_cliente['email']);
		$nome_cliente = strtoupper($res_email_cliente['nome']);
		$telefone_cliente = $res_email_cliente['celular_1'];
	}
	
	
$telefone_cliente = str_replace(" ", "", $telefone_cliente); 
$telefone_cliente = str_replace(",", "", $telefone_cliente); 
$telefone_cliente = str_replace("�", "", $telefone_cliente);
$telefone_cliente = str_replace("�", "", $telefone_cliente); 
$telefone_cliente = str_replace("�", "", $telefone_cliente); 
$telefone_cliente = str_replace("�", "", $telefone_cliente);
$telefone_cliente = str_replace("�", "", $telefone_cliente); 
$telefone_cliente = str_replace("�", "", $telefone_cliente); 
$telefone_cliente = str_replace("�", "", $telefone_cliente);
$telefone_cliente = str_replace("�", "", $telefone_cliente); 
$telefone_cliente = str_replace("�", "", $telefone_cliente); 
$telefone_cliente = str_replace("�", "", $telefone_cliente);
$telefone_cliente = str_replace("�", "", $telefone_cliente); 
$telefone_cliente = str_replace("(", "", $telefone_cliente); 
$telefone_cliente = str_replace(")", "", $telefone_cliente);
$telefone_cliente = str_replace(".", "", $telefone_cliente);


$valor_sms = number_format($valor,2,',','.');

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.smsdev.com.br/v1/send?key=TZXZSWGNSZY51PZTLQ1SI772BRGA1FGQAKH16GEYTWKMUBSHF2K5D4O4REAUCWD2KG686DRENLFCJZKQT0FEJ4V1YSVICR1DCRU1PJW2OZIW48VKFQ8V084I82QJ5SSZ&type=9&number=$telefone_cliente&msg=".urlencode("VESTE PRIME: A parcela do cr�dito pessoal vence em 3 dias, o valor da parcela � $valor_sms. Mais informa��es acesse seu e-mail.
  
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
$mail->FromName = "O BOLETO DE SEU CR�DITO PESSOAL CHEGOU!";
$mail->AddAddress("$email_cliente","VESTE PRIME CARD");
$mail->WordWrap = 500; 
$mail->AddAttachment("anexo/arquivo.zip"); 
$mail->AddAttachment("imagem/foto.jpg");
$mail->IsHTML(true); //enviar em HTML

	$valor_total_fatura = number_format($valor_total_fatura,2,',','.');

	$mail->AddReplyTo("$email_cliente","$nome_cliente");
	$msg  = "";
	$msg .= "

<table width='800' align='center' style='border:20px solid #090; border-radius:50px; padding:10px;' border='0'>
  <tr>
    <td colspan='2'  align='center' bgcolor='#FFFFFF' style='border:2px solid #FC0; border-radius:1000px; margin:-5px 0 0 0;'><h1 style='font:12px Arial, Helvetica, sans-serif; color:#CCC;'><strong>CONTRATO:</strong> $proposta</h1></td>
  </tr>
  <tr>
    <td colspan='2' style='border:2px solid #099; border-radius:1000px; margin:-5px 0 0 0;'  align='center' bgcolor='#003366'><h2 style='font:15px Arial, Helvetica, sans-serif; color:#0CF;'>BOLETO DE CR�DITO PESSOAL</h2></td>
  </tr>
  <tr>
    <td colspan='2' align='center'><h1 style='font:20px Arial, Helvetica, sans-serif; color:#CC0; padding:2px;'><strong>Ol�, $nome_cliente!
    <br><br>
    Este e-mail � para avisar que a parcela: $parcela de seu cr�dito pessoal vence em 3 dias. Para sua comodidade estamos enviando em anexo o boleto de pagamento.</strong></h1>
    <h1 style='font:20px Arial, Helvetica, sans-serif; color:#CC0; padding:2px;'><strong>Lembre-se, voc� deve pagar at� o vencimento para evitar juros e multa.</strong></h1></td>
  </tr>
  <tr>
    <td colspan='2' align='center' bgcolor='#999999'><strong>CR�DITO PESSOAL</strong></td>
  </tr>
  <tr>
    <td colspan='2' align='center'><p style='font:10px Arial, Helvetica, sans-serif;'>Para sua seguran�a, estamos enviando sua fatura por e-mail.</p>
    <p style='font:10px Arial, Helvetica, sans-serif;'>Evite pagar juros e multas, pague sua fatura em dias e evite a restrin��o nos org�os de prote��o ao cr�dito, como o SPC e SARASA.</p></td>
  </tr>
  <tr>
    <td colspan='2' align='center'><p><a href='http://www.ikuly.com/caixa/scripts/boleto_emprestimo.php?id=$id&proposta=$proposta'><img src='http://ikuly.com/caixa/img/baixar_boleto.fw.png' alt='' width='272' height='78' border='0' /></a>
      </p>
      <p><span style='font:20px Arial, Helvetica, sans-serif; color:#CC0; padding:2px;; font-family: Arial, Helvetica, sans-serif; font-size: 20px'><strong>Caso j� tenha pago, por favor, desconsiderar esse e-mail.</strong></span>
      </p>
    <hr /></td>
  </tr>
  <tr>
    <td width='232' align='center' style='border:2px solid #099; border-radius:10px; margin:-5px 0 0 0;'><img src='http://www.acim.com.br/wp-content/uploads/2016/03/spc-site.png' width='120' height='60' /><img src='https://upload.wikimedia.org/wikipedia/commons/thumb/3/30/SerasaExperian-TM_Portrait_RGB.svg/383px-SerasaExperian-TM_Portrait_RGB.svg.png' width='120' height='60' /></td>
    <td><p style='font:10px Arial, Helvetica, sans-serif; color:#F00; font-size: 10px'><strong>AVISO:</strong> Ap�s 20 dias de atraso ser� solicitado a inclus�o de seu CPF nos org�o de prote��o ao cr�dito.</p>
    <p style='font:10px Arial, Helvetica, sans-serif;; font-family: Arial, Helvetica, sans-serif; font-size: 10px'><span style='font-family: Arial, Helvetica, sans-serif; font-size: 10px'>Ap�s 45 dias de atraso ser� solicitado a inclus�o desta fatura nos cart�rios de protestos.</span></p></td>
  </tr>
  <tr>
    <td colspan='2'><hr /></td>
  </tr>
  <tr>
    <td colspan='2' align='justify' bgcolor='#999999' style='border:2px solid #066; border-radius:10px; margin:-5px 0 0 0;'><h4 style='font:11px Arial, Helvetica, sans-serif; color:#CCC; padding:0 5px 0 5px;'>Consultas, informa��es, transa��es, acesse www.vesteprime.com.br ou ligue (85) 3315.6199 (capitais e regi�es metropolitanas) ou +55 (11) 96665-9661 (demais localidades, somente chamadas de telefone fixo), de segunda a domingo, das 8h �s 17h (exceto feriados nacionais). Reclama��es, cancelamentos e informa��es gerais, ligue para o (85) 3315.6199, todos os dias, 24 horas por dia. Se n�o ficar satisfeito com a solu��o apresentada, contate a Ouvidoria: (85) 3315.6199, em dias �teis, das 9h �s 18h.</h4></td>
  </tr>
  <tr>
    <td colspan='2' align='center' bgcolor='#FFFFFF' style='border:2px solid #066; border-radius:10px;><h3 style='font:12px Arial, Helvetica, sans-serif;'>Mensagem autom�tica, por favor, n�o responder.</h3>.</td>
  </tr>
</table>

	<br>\n";
 
$mail->Subject = "O BOLETO DE SEU CR�DITO PESSOAL CHEGOU!";
//adicionando o html no corpo do email
$mail->Body = $msg;
//enviando e retornando o status de envio
if(!$mail->Send())
{
$id_parcela++;
echo "<script language='javascript'>window.location='?id_parcela=$id_parcela';</script>";
echo "Ocorreru um erro, tente novamente!".$mail->ErrorInfo;
//$mail->ErrorInfo informa onde ocorreu o erro 

exit;
} // verifica se pode fechar a fatura

$id_parcela++;
echo "<script language='javascript'>window.location='?id_parcela=$id_parcela';</script>";	
		
		}else{						
		$id_parcela++;
		echo "<script language='javascript'>window.location='?id_parcela=$id_parcela';</script>";	
		} // vericca se faz tr�s dias que falta para assinar
	} // while de verifica��o
  }
}
?>
</body>
</html>