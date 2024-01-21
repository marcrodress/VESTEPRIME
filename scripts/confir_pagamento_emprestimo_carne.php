<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<?

$proposta = NULL;
$cliente = NULL;
$valor = NULL;
$parcela = NULL;
$data_pagamento = date("d/m/Y");
$id = NULL;


$sql_verifica_boleto = mysqli_query($conexao_bd, "SELECT * FROM boletos_emprestimo_boleto WHERE codigo_barras = '".$_GET['code_barras']."'");
 while($res_boleto = mysqli_fetch_array($sql_verifica_boleto)){
	$proposta = $res_boleto['proposta'];
	$cliente = $res_boleto['cliente'];
	$valor = $res_boleto['valor'];
	$parcela = $res_boleto['parcela'];
	$id = $res_boleto['id'];
	 
 }
$n_parcelas = NULL;
$tipo_emprestimo = NULL;
$sql_verifica_emprestimo = mysqli_query($conexao_bd, "SELECT * FROM emprestimo_boleto WHERE n_proposta = '$proposta'");
 while($res_verifica_emprestimo = mysqli_fetch_array($sql_verifica_emprestimo)){
	 $n_parcelas = $res_verifica_emprestimo['quant_parcela'];
	 $tipo_emprestimo = "carne_individual";
 }


if($tipo_emprestimo == 'carne_individual' && $n_parcelas == $parcela){
	
	mysqli_query($conexao_bd, "UPDATE emprestimo_boleto SET status = 'TERMINADO' WHERE n_proposta = '$proposta'");
	
	$limite = 0;
	$taxa_juros = 0;
	$sql_limite = mysqli_query($conexao_bd, "SELECT * FROM clientes_emprestimo_carne WHERE cliente = '$cliente'");
	 while($res_limite = mysqli_fetch_array($sql_limite)){
		 $limite = ($res_limite['limite']*0.4)+$res_limite['limite'];
		 $taxa_juros = $res_limite['juros'];
	 }
	 
	 if($limite >= 2000){
		 $limite = ($limite*0.2)+$limite;
		 $taxa_juros = $taxa_juros*0.7;
		 if($taxa_juros <= 4){
			 $taxa_juros = 4;
		 }else{
			 $taxa_juros = $taxa_juros;
		 }
	 }else{
		 $limite = ($limite*0.4)+$limite;
		 $taxa_juros = $taxa_juros*0.95;
	 }
	
	
	mysqli_query($conexao_bd, "UPDATE clientes_emprestimo_carne SET limite = '$limite', juros = '$taxa_juros' WHERE cliente = '$cliente'");
	
}


if($id == NULL){
$id = $_GET['id'];	
}else{
$id = $id;
}


mysqli_query($conexao_bd, "UPDATE boletos_emprestimo_boleto SET status = 'PAGO', data_pagamento = '$data_pagamento' WHERE id = '$id'");



	$score = 0;
	$sql_score = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente WHERE cliente = '$cliente'");
	 while($res_score = mysqli_fetch_array($sql_score)){
		 $score = $res_score['score'];
	 }

	   mysqli_query($conexao_bd, "INSERT INTO score (operador, tipo, data, dia, mes, ano, cliente, descricao, pontos) VALUES ('$operador', 'CREDITO', '$data', '$dia', '$mes', '$ano', '$cliente', 'PAGAMENTO DE PARCELA DE EMPRÉSTIMO NO BOLETO', '".$score*0.2."')");
   	  $score = $score+($valor*0.2);
       
	   

$n_parcelas = NULL;
$tipo_emprestimo = NULL;
$sql_verifica_emprestimo_grupo = mysqli_query($conexao_bd, "SELECT * FROM emprestimo_boleto_unico WHERE n_proposta = '$proposta'");
 while($res_verifica_emprestimo_grupo = mysqli_fetch_array($sql_verifica_emprestimo_grupo)){
	 $n_parcelas = $res_verifica_emprestimo_grupo['quant_parcela'];
	 $tipo_emprestimo = "grupo_unico";
 }	   

 if($tipo_emprestimo == 'grupo_unico' && $n_parcelas == $parcela){
	 

	 
  $sql_verifica_boleto = mysqli_query($conexao_bd, "SELECT * FROM boletos_emprestimo_boleto WHERE proposta = '$proposta' AND status = 'AGUARDA'");
		 
	 mysqli_query($conexao_bd, "UPDATE emprestimo_distribuicao_clientes	SET status = 'TERMINADO' WHERE n_proposta = '$proposta'");
	 mysqli_query($conexao_bd, "UPDATE emprestimo_boleto_unico SET status = 'TERMINADO' WHERE n_proposta = '$proposta'");
	 
	  $sql_integrantes = mysqli_query($conexao_bd, "SELECT * FROM emprestimo_distribuicao_clientes WHERE n_proposta = '$proposta'");
	   while($res_integrantes = mysqli_fetch_array($sql_integrantes)){
		   
		   $cpf_cliente = $res_integrantes['cliente'];
		   $limite = 0;
		   $taxa_juros = 0;
		   
		   $sql_limite = mysqli_query($conexao_bd, "SELECT * FROM limite_credmais WHERE cliente = '$cpf_cliente'");
		    while($res_limite = mysqli_fetch_array($sql_limite)){
				$limite = ($res_limite['limite']*0.5)+$res_limite['limite'];
				$taxa_juros = number_format($res_limite['taxa_juros']*0.97,2);
		   }
			 
			 mysqli_query($conexao_bd, "UPDATE limite_credmais SET limite = '$limite', taxa_juros = '$taxa_juros' WHERE cliente = '$cpf_cliente'");
			 
			 $cpf_cliente = 0;
			 $limite = 0;
			 $taxa_juros = 0;
		   
	    }
	  
	  
	  
	} // if que verifica se existe grupo e se é a última parcela
	   
	   
mysqli_query($conexao_bd, "UPDATE conta_corrente SET score = '$score' WHERE cliente = '$cliente'");


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
  CURLOPT_URL => "https://api.smsdev.com.br/v1/send?key=TZXZSWGNSZY51PZTLQ1SI772BRGA1FGQAKH16GEYTWKMUBSHF2K5D4O4REAUCWD2KG686DRENLFCJZKQT0FEJ4V1YSVICR1DCRU1PJW2OZIW48VKFQ8V084I82QJ5SSZ&type=9&number=$telefone_cliente&msg=".urlencode("VESTE PRIME: $nome_cliente_sms, o pagamento da parcela $parcela do seu credito pessoal foi confirmada com sucesso. Mais informacoes em seu e-mail.
  
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
	

include("../phpmailer/class.phpmailer.php");

$mail = new PHPMailer();
$mail->IsMAIL(); 
$mail->Host = "mail.ikuly.com"; 
$mail->SMTPAuth = true; 
$mail->Username = "suporte@ikuly.com"; 
$mail->Password = "Rcbv896xw*"; // senha
$mail->From = "suporte@ikuly.com";
$mail->FromName = "CONFIRMAÇÃO DE PAGAMENTO DE CRÉDITO PESSOAL";
$mail->AddAddress("$email_cliente,vesteprime@gmail.com","VESTE PRIME CARD");
$mail->WordWrap = 500; 
$mail->AddAttachment("anexo/arquivo.zip"); 
$mail->AddAttachment("imagem/foto.jpg");
$mail->IsHTML(true); //enviar em HTML

	$valor_total_fatura = number_format($valor_total_fatura,2,',','.');

	$mail->AddReplyTo("$email_cliente,vesteprime@gmail.com","$nome_cliente");
	$msg  = "";
	$msg .= "

<table width='800' align='center' style='border:20px solid #069; border-radius:10; padding:10px;' border='0'>
  <tr>
    <td colspan='2'  align='center' bgcolor='#FFFFFF' style='border:2px solid #FC0; border-radius:1000px; margin:-5px 0 0 0;'><h1 style='font:12px Arial, Helvetica, sans-serif; color:#CCC;'><strong>CONTRATO:</strong> $proposta</h1></td>
  </tr>
  <tr>
    <td colspan='2' style='border:2px solid #099; border-radius:1000px; margin:-5px 0 0 0;'  align='center' bgcolor='#003366'><h2 style='font:15px Arial, Helvetica, sans-serif; color:#0CF;'>BOLETO DE CRÉDITO PESSOAL</h2></td>
  </tr>
  <tr>
    <td colspan='2' align='center'><h1 style='font:20px Arial, Helvetica, sans-serif; color:#069; padding:2px;'><strong>Olá, $nome_cliente!
    <br><br>
    </strong><strong>Este e-mail é apenas para avisar que confirmamos o recebimento da parcela $parcela do seu crédito pessoal.</strong></h1>
    <p style='font:20px Arial, Helvetica, sans-serif; color:#069; padding:2px;'><strong>Obrigado pelo pagamento!</strong></p>
    <p style='font:20px Arial, Helvetica, sans-serif; color:#069; padding:2px;'><strong>Att.</strong></p>
    <p style='font:20px Arial, Helvetica, sans-serif; color:#069; padding:2px;'><strong>Sistema de crédito VESTE PRIME.</strong></p>
    <hr></td>
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
    <td colspan='2' align='center' bgcolor='#FFFFFF' style='border:2px solid #066; border-radius:10px;><h3 style='font:12px Arial, Helvetica, sans-serif;'><em>Mensagem automática, por favor, não responder.</em></h3>.</td>
  </tr>
</table>


	<br>\n";
 
$mail->Subject = "CONFIRMAÇÃO DE PAGAMENTO DE CRÉDITO PESSOAL";
//adicionando o html no corpo do email
$mail->Body = $msg;
//enviando e retornando o status de envio
if(!$mail->Send())
{
echo "<script language='javascript'>window.alert('OCORREU UM ERRO AO ENVIAR O BOLETO, TENTE NOVAMENTE!');window.location='?pg=detalhe&code=$proposta';</script>";
echo "Ocorreru um erro, tente novamente!".$mail->ErrorInfo;
//$mail->ErrorInfo informa onde ocorreu o erro 

exit;
} // verifica se pode fechar a fatura
	

?>
</body>
</html>