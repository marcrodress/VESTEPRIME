<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>LANÇAMENTO DE JUROS</title>
<style type="text/css">
body,td,th {
	color: #000;
}
body {
	background-color:#09C;
}
</style>
</head>

<body>
<img src="img/roler.gif" /> Carregando sistema e módulos de segurança...<br />VERIFICA JUROS<br />
<?
require "conexao.php";

$cliente = 0;

$id_cliente = $_GET['id_cliente'];
if($id_cliente == ''){
	$id_cliente = 1;
}

$conta_faturas = mysqli_num_rows((mysqli_query($conexao_bd, "SELECT * FROM faturas_fechadas")))+100;

if($id_cliente > $conta_faturas){
	echo "<script language='javascript'>window.location='gerar_juros_nota.php';</script>";
}
$total_dias_juros = 0;


$sql_verifica_faturas = mysqli_query($conexao_bd, "SELECT * FROM faturas_fechadas WHERE sit_juros = 'SIM' AND id = '$id_cliente'");
if(mysqli_num_rows($sql_verifica_faturas) == ''){
$id_cliente++;
echo "<script language='javascript'>window.location='?id_cliente=$id_cliente';</script>";
}else{
	while($res_verifica_juros = mysqli_fetch_array($sql_verifica_faturas)){
		$status_fatura = $res_verifica_juros['sit_pag'];
		$saldo = $res_verifica_juros['saldo'];
		$vencimento = $res_verifica_juros['vencimento'];
		$vencimento_completo_fatura = $res_verifica_juros['vencimento'];
		$cliente = $res_verifica_juros['cliente'];
		$code_fatura = $res_verifica_juros['code_fatura'];
		
		echo $saldo_multa = ($saldo*0.0999);
		echo "<br>";
		echo $saldo_mora = ($saldo*0.007);
		echo "<br>";
		echo $saldo_juros = ($saldo*0.009);
		echo "<br>";
		echo $saldo_iof = ($saldo*0.01);
		echo "<br>";
		
$verifica_conta_corrente = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente WHERE cliente = '$cliente'");
while($res_conta_corrente = mysqli_fetch_array($verifica_conta_corrente)){
	$cartao = $res_conta_corrente['cartao'];
}


$email_cliente = 0;
$nome_cliente = 0;
$telefone_cliente = 0;

$sql_email_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '$cliente'");	
	while($res_email_cliente = mysqli_fetch_array($sql_email_cliente)){
		$email_cliente = strtolower($res_email_cliente['email']);
		$nome_cliente = strtoupper($res_email_cliente['nome']);
		$telefone_cliente = strtoupper($res_email_cliente['celular_1']);
	}	

		$score = 0;
		$sql_score = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente WHERE cliente = '$cliente'");
		 while($res_score = mysqli_fetch_array($sql_score)){
			 $score = $res_score['score'];
		 }
		  
		   mysqli_query($conexao_bd, "INSERT INTO score (operador, tipo, data, dia, mes, ano, cliente, descricao, pontos) VALUES ('$operador', 'DEBITO', '$data', '$dia', '$mes', '$ano', '$cliente', 'ATRASO DE FATURA', '".($score-1)."')");
		 
		  $score = $score-20;
		   mysqli_query($conexao_bd, "UPDATE conta_corrente SET score = '$score' WHERE cliente = '$cliente'");		  
		  
		  
$sql_email_restricao = mysqli_query($conexao_bd, "SELECT * FROM clientes_restricao_email WHERE cliente = '$cliente'");
if(mysqli_num_rows($sql_email_restricao) == ''){
$vesteprime = "vesteprime@gmail.com";
}else{
$vesteprime = "";
}


	
$telefone_cliente = str_replace(" ", "", $telefone_cliente); 
$telefone_cliente = str_replace(".", "", $telefone_cliente);
$telefone_cliente = str_replace("(", "", $telefone_cliente); 
$telefone_cliente = str_replace(")", "", $telefone_cliente);
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



$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.smsdev.com.br/v1/send?key=TZXZSWGNSZY51PZTLQ1SI772BRGA1FGQAKH16GEYTWKMUBSHF2K5D4O4REAUCWD2KG686DRENLFCJZKQT0FEJ4V1YSVICR1DCRU1PJW2OZIW48VKFQ8V084I82QJ5SSZ&type=9&number=$telefone_cliente&msg=".urlencode("VESTE PRIME: Sua fatura venceu em $vencimento_completo_fatura e não detectamos o pagamento. Mais informações acesse seu e-mail.
  
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
$saldo = number_format($saldo, 2, ',', '.');

$mail = new PHPMailer();
$mail->IsMAIL(); 
$mail->Host = "mail.ikuly.com"; 
$mail->SMTPAuth = true; 
$mail->Username = "suporte@ikuly.com"; 
$mail->Password = "Rcbv896xw*"; // senha
$mail->From = "suporte@ikuly.com";
$mail->FromName = "VESTE PRIME CARD";
$mail->AddAddress("$email_cliente","FATURA VENCIDA - URGENTE - SERVIÇO DE PROTEÇÃO AO CRÉDITO");
$mail->WordWrap = 500; 
$mail->AddAttachment("anexo/arquivo.zip"); 
$mail->AddAttachment("imagem/foto.jpg");
$mail->IsHTML(true); //enviar em HTML

	$mail->AddReplyTo("$email_cliente,vesteprime@gmail.com","$nome_cliente");
	$msg  = "";
	$msg .= "

<table width='800' align='center' style='border:20px solid #F00; border-radius:50px; padding:10px;' border='0'>
  <tr>
    <td width='232' style='border:2px solid #FC0; border-radius:1000px; margin:-5px 0 0 0;'  align='center' bgcolor='#FFFFFF'><h1 style='font:12px Arial, Helvetica, sans-serif; color:#CCC;'><strong>CONTRATO:</strong> $cartao</h1></td>
    <td width='370' style='border:2px solid #099; border-radius:1000px; margin:-5px 0 0 0;'  align='center' bgcolor='#999999'><span style='font:20px Arial, Helvetica, sans-serif; color:#CCC;'><strong>VESTE PRIME CARD</strong></span></td>
    <td width='174' style='border:2px solid #FC0; border-radius:1000px; margin:-5px 0 0 0;'  align='center' bgcolor='#FFFFFF'><h1 style='font:12px Arial, Helvetica, sans-serif; color:#CCC;'><strong>VENCIMENTO:</strong> $vencimento_completo_fatura</h1></td>
  </tr>
  <tr>
    <td colspan='3' style='border:2px solid #099; border-radius:1000px; margin:-5px 0 0 0;'  align='center' bgcolor='#FF0000'><h2 style='font:15px Arial, Helvetica, sans-serif; color:#FF0;'>AVISO DE COBRANÇA - VESTE PRIME CARD</h2></td>
  </tr>
  <tr>
    <td width='232' align='center'><img style='border-radius:10px; border:5px solid #069;' src='http://ikuly.com/caixa/img/veste_prime_card.jpg' alt='' width='250' height='150' /></td>
    <td align='justify' style='border:1px solid #CCC; border-radius:20px;'><h1 style='font:20px Arial, Helvetica, sans-serif; color:#CC0; padding:2px;'><strong>Olá, $nome_cliente!
    <br><br>
    Informamos que até o presente momento ainda não identificamos o pagamento da fatura no valor de R$ $saldo que está vencida desde dia $vencimento_completo_fatura.</strong></h1></td>
    <td width='174' align='center'><a href='http://www.ikuly.com/caixa/scripts/fatura_fechada.php?code_fatura=$code_fatura'><img src='https://lh3.googleusercontent.com/TNlo7C3s2OLtz6FbjemlFxcoLY4Gc7aCZEhV1foVyy9xOtWC2CN4gJmbf_V3N8yEFg' width='100' border='0'/></a></td>
  </tr>
  <tr>
    <td colspan='3' align='center' bgcolor='#999999'><hr />
      <strong style='font:12px Arial, Helvetica, sans-serif; text-decoration:underline; text-transform:uppercase;'>Cartão: Veste Prime Card</strong>
      <hr /></td>
  </tr>
  <tr>
    <td colspan='3' align='center'><p style='font:10px Arial, Helvetica, sans-serif;'>Para sua segurança e comodidade, estamos enviando sua fatura por e-mail.</p>
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
    <td colspan='3' align='center' bgcolor='#FFFFFF' style='border:2px solid #066; border-radius:10px;><h3 style='font:12px Arial, Helvetica, sans-serif;'>Mensagem automática, por favor, não responder.</h3>.</td>
  </tr>
</table>



				
	<br>\n";
 
$mail->Subject = "FATURA VESTE PRIME CARD ESTÁ EM ATRASO";
//adicionando o html no corpo do email
$mail->Body = $msg;
//enviando e retornando o status de envio
if(!$mail->Send())
{
$id_cliente++;
echo "<script language='javascript'>window.location='?id_cliente=$id_cliente';</script>";
echo "Ocorreru um erro, tente novamente!".$mail->ErrorInfo;
//$mail->ErrorInfo informa onde ocorreu o erro 
exit;
}


	$sql_juros = mysqli_query($conexao_bd, "SELECT * FROM juros_cartao WHERE code_fatura = '$code_fatura'");
		while($res_juros = mysqli_fetch_array($sql_juros)){
			
			$dias_atraso = $res_juros['dias_atraso'];
			$ultimo_juro = $res_juros['ultimo_juro'];
			$tipo = $res_juros['tipo'];
			$multa_atraso = $res_juros['multa_atraso'];
			$mora_atraso = $res_juros['mora_atraso']+$saldo_mora;
			$juros = $res_juros['juros']+$saldo_juros;
			
			$dias_atraso++;
			
			if($multa_atraso == 0 && $tipo == 'MULTA'){
				mysqli_query($conexao_bd, "UPDATE juros_cartao SET multa_atraso = '$saldo_multa' WHERE code_fatura = '$code_fatura' AND tipo = 'MULTA'");
			} // verifica se a multa está igual a zero
			
			if($multa_atraso == 0 && $tipo == 'JUROS'){
				mysqli_query($conexao_bd, "UPDATE juros_cartao SET juros = '$juros', dias_atraso = '$dias_atraso' WHERE code_fatura = '$code_fatura' AND tipo = 'JUROS'");
			} // verifica se a multa está igual a zero
			
			if($multa_atraso == 0 && $tipo == 'IOF'){
				mysqli_query($conexao_bd, "UPDATE juros_cartao SET iof = '$saldo_iof' WHERE code_fatura = '$code_fatura' AND tipo = 'IOF'");
			} // verifica se a multa está igual a zero
			
			if($ultimo_juro != $data){
				mysqli_query($conexao_bd, "UPDATE juros_cartao SET mora_atraso = '$mora_atraso', dias_atraso = '$dias_atraso', ultimo_juro = '$data' WHERE code_fatura = '$code_fatura' AND tipo = 'MORA'");
			} // verifica se já foi lançado os juros de hoje
			
		} // while juros

	} // while pega dos dados da fatura

$id_cliente++;
echo "<script language='javascript'>window.location='?id_cliente=$id_cliente';</script>";
} // final que verifica se existe juros para hoje

?>
</body>
</html>