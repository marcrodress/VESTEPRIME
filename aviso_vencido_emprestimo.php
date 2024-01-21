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
$code_vencimento2 = 0;
$data_vencimento_sms = 0;
$total = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM boletos_emprestimo_boleto"))+100;

if($id_parcela > $total){
  echo "<script language='javascript'>window.location='aviso7dias.php?id_fatura=3000';</script>";
}else{
	
if($id_parcela == 0){
$id_parcela = 1;
}else{
$id_parcela = $id_parcela;
}

$sql_parcela = mysqli_query($conexao_bd, "SELECT * FROM boletos_emprestimo_boleto WHERE id = '$id_parcela' AND status = 'AGUARDA'");
if(mysqli_num_rows($sql_parcela) == ''){
	echo "EM DIAS";
	$id_parcela++;
	echo "<script language='javascript'>window.location='?id_parcela=$id_parcela';</script>";
}else{
	echo "INADIPLENTE";
	while($res_parcela = mysqli_fetch_array($sql_parcela)){
		$code_vencimento = $res_parcela['vencimento']+2;
		$cliente = $res_parcela['cliente'];
		$valor = $res_parcela['valor'];
		$id = $res_parcela['id'];
		$proposta = $res_parcela['proposta'];
		$parcela = $res_parcela['parcela'];
		$code_vencimento2 = $res_parcela['vencimento']+2;

		$sql_data_vencimento = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento WHERE codigo = '$code_vencimento2'");
		 while($res_vencimento = mysqli_fetch_array($sql_data_vencimento)){
			 $data_vencimento_sms = $res_vencimento['vencimento'];
		 }


		if($code_vencimento_hoje >= $code_vencimento){
		

		
$email_cliente = 0;
$nome_cliente = 0;
$nome_cliente_sms = 0;
$telefone_cliente = 0;

$sql_email_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '$cliente'");	
	while($res_email_cliente = mysqli_fetch_array($sql_email_cliente)){
		$email_cliente = strtolower($res_email_cliente['email']);
		$nome_cliente = strtoupper($res_email_cliente['nome']);
		$telefone_cliente = $res_email_cliente['celular_1'];
	}
	
$nome1 = $nome_cliente[0];
$nome2 = $nome_cliente[1];
$nome3 = $nome_cliente[2];
$nome4 = $nome_cliente[3];
$nome5 = $nome_cliente[4];
$nome6 = $nome_cliente[5];
$nome7 = $nome_cliente[6];
$nome8 = $nome_cliente[7];
$nome9 = $nome_cliente[8];
$nome10 = $nome_cliente[9];
$nome11 = $nome_cliente[10];
$nome12 = $nome_cliente[11];
$nome13 = $nome_cliente[12];
$nome14 = $nome_cliente[13];
$nome15 = $nome_cliente[14];
$nome16 = $nome_cliente[15];
$nome17 = $nome_cliente[16];
$nome18 = $nome_cliente[17];
$nome19 = $nome_cliente[18];
$nome20 = $nome_cliente[19];

$valor_sms = number_format($valor,2,',','.');
		
$nome_cliente_sms = "$nome1$nome2$nome3$nome4$nome5$nome6$nome7$nome8$nome9$nome10$nome11$nome12$nome13$nome14$nome15$nome16$nome17";

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
  CURLOPT_URL => "https://api.smsdev.com.br/v1/send?key=TZXZSWGNSZY51PZTLQ1SI772BRGA1FGQAKH16GEYTWKMUBSHF2K5D4O4REAUCWD2KG686DRENLFCJZKQT0FEJ4V1YSVICR1DCRU1PJW2OZIW48VKFQ8V084I82QJ5SSZ&type=9&number=$telefone_cliente&msg=".urlencode("VESTE PRIME: $nome_cliente_sms, a parcela de número $parcela do seu credito pessoal e com valor de R$ $valor_sms venceu no dia $data_vencimento_sms.
  
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
$mail->FromName = "A PARCELA $parcela DO SEU CRÉDITO ESTÁ VENCIDA, FIQUE EM DIAS COM SUAS CONTAS!";
$mail->AddAddress("$email_cliente","VESTE PRIME");
$mail->WordWrap = 500; 
$mail->AddAttachment("anexo/arquivo.zip"); 
$mail->AddAttachment("imagem/foto.jpg");
$mail->IsHTML(true); //enviar em HTML

	$valor_total_fatura = number_format($valor_total_fatura,2,',','.');

	$mail->AddReplyTo("$email_cliente","$nome_cliente");
	$msg  = "";
	$msg .= "

<table width='800' align='center' style='border:20px solid #F00; border-radius:50px; padding:10px;' border='0'>
  <tr>
    <td colspan='2'  align='center' bgcolor='#FFFFFF' style='border:2px solid #FC0; border-radius:1000px; margin:-5px 0 0 0;'><h1 style='font:12px Arial, Helvetica, sans-serif; color:#CCC;'><strong>CONTRATO:</strong> $proposta</h1></td>
  </tr>
  <tr>
    <td colspan='2' style='border:2px solid #099; border-radius:1000px; margin:-5px 0 0 0;'  align='center' bgcolor='#003366'><h2 style='font:15px Arial, Helvetica, sans-serif; color:#0CF;'>BOLETO DE CRÉDITO PESSOAL</h2></td>
  </tr>
  <tr>
    <td colspan='2' align='center'><h1 style='font:20px Arial, Helvetica, sans-serif; color:#CC0; padding:2px;'><strong>Olá, $nome_cliente!
    <br><br>
    Este e-mail é para avisar que a parcela: $parcela de seu crédito pessoal venceu há alguns dias ainda não consta o pagamento em nosso sistema, pedimos que compareça a uma de nossas lojas para fazer pagamento ou entre em contato com nossa central de negociação pelo telefone (11) 96665-9661. </strong></h1>
      <h1 style='font:20px Arial, Helvetica, sans-serif; color:#CC0; padding:2px;'>&nbsp;</h1>
      <table width='790' border='0'>
        <tr>
          <td width='189'><span style='font:20px Arial, Helvetica, sans-serif; color:#CC0; padding:2px;'><img src='https://i.pinimg.com/originals/d6/f8/80/d6f88013bfb61db12d85b70d58e75c7f.gif' alt='Resultado de imagem para gif correndo desenho' width='204' height='141'/></span></td>
          <td width='591'><span style='font:20px Arial, Helvetica, sans-serif; color:#000; padding:2px;'><strong>Corra para fazer o pagamento, não queremos você pagando juros.</strong></span></td>
        </tr>
      </table>
    <p style='font:20px Arial, Helvetica, sans-serif; color:#CC0; padding:2px;'><strong>Lembre-se, você deve pagar até o vencimento para evitar juros e multa.</strong></p></td>
  </tr>
  <tr>
    <td colspan='2' align='center' bgcolor='#999999'><strong>CRÉDITO PESSOAL</strong></td>
  </tr>
  <tr>
    <td colspan='2' align='center'><p style='font:10px Arial, Helvetica, sans-serif;'>Para sua segurança, estamos enviando sua fatura por e-mail.</p>
    <p style='font:10px Arial, Helvetica, sans-serif;'>Evite pagar juros e multas, pague sua fatura em dias e evite a restrinção nos orgãos de proteção ao crédito, como o SPC e SARASA.</p></td>
  </tr>
  <tr>
    <td colspan='2' align='center'><p>&nbsp;</p>
      <p><span style='font:20px Arial, Helvetica, sans-serif; color:#F00; padding:2px;; font-family: Arial, Helvetica, sans-serif; font-size: 20px'><strong>Caso já tenha pago, por favor, desconsiderar esse e-mail.</strong></span>
      </p>
    <hr /></td>
  </tr>
  <tr>
    <td width='232' align='center' style='border:2px solid #099; border-radius:10px; margin:-5px 0 0 0;'><img src='http://www.acim.com.br/wp-content/uploads/2016/03/spc-site.png' width='120' height='60' /><img src='https://upload.wikimedia.org/wikipedia/commons/thumb/3/30/SerasaExperian-TM_Portrait_RGB.svg/383px-SerasaExperian-TM_Portrait_RGB.svg.png' width='120' height='60' /></td>
    <td><p style='font:10px Arial, Helvetica, sans-serif; color:#F00; font-size: 10px'><strong>AVISO:</strong> Após 20 dias de atraso será solicitado a inclusão de seu CPF nos orgão de proteção ao crédito.</p>
    <p style='font:10px Arial, Helvetica, sans-serif;; font-family: Arial, Helvetica, sans-serif; font-size: 10px'><span style='font-family: Arial, Helvetica, sans-serif; font-size: 10px'>Após 45 dias de atraso será solicitado a inclusão desta fatura nos cartórios de protestos.</span></p></td>
  </tr>
  <tr>
    <td colspan='2'><hr /></td>
  </tr>
  <tr>
    <td colspan='2' align='justify' bgcolor='#999999' style='border:2px solid #066; border-radius:10px; margin:-5px 0 0 0;'><h4 style='font:11px Arial, Helvetica, sans-serif; color:#CCC; padding:0 5px 0 5px;'>Consultas, informações, transações, acesse www.vesteprime.com.br ou ligue (85) 3315.6199 (capitais e regiões metropolitanas) ou +55 (11) 96665-9661 (demais localidades, somente chamadas de telefone fixo), de segunda a domingo, das 8h às 17h (exceto feriados nacionais). Reclamações, cancelamentos e informações gerais, ligue para o (85) 3315.6199, todos os dias, 24 horas por dia. Se não ficar satisfeito com a solução apresentada, contate a Ouvidoria: (85) 3315.6199, em dias úteis, das 9h às 18h.</h4></td>
  </tr>
  <tr>
    <td colspan='2' align='center' bgcolor='#FFFFFF' style='border:2px solid #066; border-radius:10px;><h3 style='font:12px Arial, Helvetica, sans-serif;'>Mensagem automática, por favor, não responder.</h3>.</td>
  </tr>
</table>

	<br>\n";
 
$mail->Subject = "A PARCELA $parcela DO SEU CRÉDITO ESTÁ VENCIDA, FIQUE EM DIAS COM SUAS CONTAS!";
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
		} // vericca se faz três dias que falta para assinar
	} // while de verificação
  }
}
?>
</body>
</html>