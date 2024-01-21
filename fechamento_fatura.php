<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>FECHAMENTO DE FATURA</title>
<style type="text/css">
body,td,th {
	color: #ccc;
}
body {
	background-color: #09C;
}
</style>
</head>

<body>
<img src="img/roler.gif" /> Carregando sistema e módulos de segurança...<br /><br />FAZENDO FECHAMENTO DE FATURAS<br />

<? require "conexao.php"; ?>


<?
$valor_fatura = 0;
$calcula_minimo = 0;
$cliente = 0;
$vencimento = 0;
$fechamento = 0;
$code_fatura = 0;
$valor_pagamentos = 0;
$code_fatura = 0;
$soma_lancamento = 0;
$soma_pagamentos = 0;
$sit_pag = 0;
$tarifa = 0;
$fatura_liminar = 0;
$soma_juros = 0;
$anuidade = 0;
$saldo_anterior = 0;
$vencimento_completo_fatura = 0;
$telefone_cliente = 0;



$id_cliente = $_GET['id_cliente'];
if($id_cliente == ''){
	$id_cliente = 1;
}else{
	echo $id_cliente = $id_cliente;
}

$conta_clientes = mysqli_num_rows((mysqli_query($conexao_bd, "SELECT * FROM conta_corrente")))+200;


if($id_cliente > $conta_clientes){
	echo "<script language='javascript'>window.location='verifica_pagamento.php?id_cliente=3000';</script>";
}

$sql_verifica_fechamento = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente WHERE fechamento = '$dia' AND id = '$id_cliente'");
if(mysqli_num_rows($sql_verifica_fechamento) == ''){
$id_cliente++;
echo "<br>Cliente $id_cliente não tem contas para fechar hoje</br>";
echo "<script language='javascript'>window.location='?id_cliente=$id_cliente';</script>";
}else{
  while($res_verifica_fechamento = mysqli_fetch_array($sql_verifica_fechamento)){
		
	$cliente = $res_verifica_fechamento['cliente'];
	$cartao = $res_verifica_fechamento['cartao'];
	$vencimento = $res_verifica_fechamento['vencimento'];
	$fechamento = $res_verifica_fechamento['fechamento'];
	$anuidade = $res_verifica_fechamento['anuidade'];
	$telefone_cliente = $res_verifica_fechamento['celular_1'];
	
	echo "<br>O Cliente $cliente tem fatura para fechar hoje</br>";
	
  } // fecha o while da conta corrente
  
  $sql_busca_code_fatura = mysqli_query($conexao_bd, "SELECT * FROM faturas_fechadas WHERE status = 'Aberto' AND cliente = '$cliente'");
	while($res_buca_code_fatura = mysqli_fetch_array($sql_busca_code_fatura)){
      echo "<br>Capta  código da fatura que está em aberto</br>";
	  $code_fatura = $res_buca_code_fatura['code_fatura'];
	  $vencimento_completo_fatura = $res_buca_code_fatura['vencimento'];
	} // fecha o while para pegar o código de faturas fechadas
	
	echo $code_fatura;
	
	$sql_soma_pagamentos = mysqli_query($conexao_bd, "SELECT * FROM pagamentos_fechados WHERE code_fatura = '$code_fatura'");
	while($res_soma_pagamentos = mysqli_fetch_array($sql_soma_pagamentos)){
      	echo "<br>Soma os pagamentos fechados</br>";
		$soma_pagamentos = $soma_pagamentos+$res_soma_pagamentos['valor'];
	}  // fecha o while da soma de pagamentos	
	
	$sql_soma_lacamentos = mysqli_query($conexao_bd, "SELECT * FROM lancamento_fechados WHERE code_fatura = '$code_fatura'");
	while($res_soma_lacamentos = mysqli_fetch_array($sql_soma_lacamentos)){
      	echo "<br>Soma os lançamentos fechados</br>";
		$soma_lancamento = $soma_lancamento+$res_soma_lacamentos['valor'];
	}  // fecha o while da soma de laçamentos
	
	$sql_soma_juros = mysqli_query($conexao_bd, "SELECT * FROM juros_cartao WHERE cliente = '$cliente' AND status = 'Aguarda'");
	while($res_soma_juros = mysqli_fetch_array($sql_soma_juros)){
      	echo "<br>Soma os juros fechados</br>";
		$soma_juros = $soma_juros+$res_soma_juros['multa_atraso']+$res_soma_juros['mora_atraso']+$res_soma_juros['juros']+$res_soma_juros['iof'];
	}  // fecha o while da soma juros
	
	mysqli_query($conexao_bd, "UPDATE juros_cartao SET status = 'Lancada', fatura_lancamento = '$code_fatura' WHERE status = 'Aguarda' AND cliente = '$cliente'");
	
	
	$sql_verifica_saldo = mysqli_query($conexao_bd, "SELECT * FROM faturas_fechadas WHERE cliente = '$cliente' AND status = 'FECHADO' ORDER BY id DESC LIMIT 1");
	while($res_verifica_saldo = mysqli_fetch_array($sql_verifica_saldo)){
	     echo "<br>Capita o saldo anterior da última fatura</br>";
		$saldo_anterior = $res_verifica_saldo['valor'];
	} // verifica o saldo da fatura anterior
	
	
	
	$fatura_liminar = number_format($soma_lancamento+$soma_juros+$saldo_anterior)-$soma_pagamentos;
	if($fatura_liminar <= 0){
	}else{
		$soma_lancamento = $soma_lancamento+$anuidade;
	mysqli_query($conexao_bd, "INSERT INTO lancamento_fechados (code_transacao, status, data, data_completa, dia, mes, ano, valor, cliente, code_fatura, n_parcela, id_compra_parcelada, parcelado) VALUES ('$code_transacao', 'Ativo', '$data', '$data_completa', '$dia', '$mes', '$ano', '$anuidade', '$cliente', '$code_fatura', 'ANUIDADE', '', '')");
	}	
	
	
	$valor_total_fatura = ($soma_lancamento+$soma_juros+$saldo_anterior)-$soma_pagamentos;
	$valor_total_fatura = number_format($valor_total_fatura,2);
	$minimo = number_format(($valor_total_fatura*0.4),2);
	
	
   if($valor_total_fatura <= 0){
   	$sit_pag = "PAGO";
   }else{
	$sit_pag = "AGUARDA PAGAMENTO";
   }
   
   echo "<br>AQUI FAZ O FECHAMENTO DA FATURA";
   
   
   
   
   $valor_total_fatura = str_replace(",", "", $valor_total_fatura);
   
   
   $faturas_fechadas = mysqli_query($conexao_bd, "UPDATE faturas_fechadas SET status = 'FECHADO', valor = '$valor_total_fatura', saldo = '$valor_total_fatura', valor_debitos = '$soma_lancamento', minimo = '$minimo', valor_pago = '$soma_pagamentos', sit_pag = '$sit_pag', soma_lancamento = '$soma_lancamento', soma_juros = '$soma_juros', soma_pagamentos = '$soma_pagamentos', saldo_anterior = '$saldo_anterior' WHERE code_fatura = '$code_fatura'");
   
   if($faturas_fechadas == ''){
   echo "<br>Fatura não foi fechada com sucesso - Fatura de número: $code_fatura<br>";
   }else{
   echo "<br>Fatura foi fechada com sucesso<br>";
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

$sql_email_restricao = mysqli_query($conexao_bd, "SELECT * FROM clientes_restricao_email WHERE cliente = '$cliente'");
if(mysqli_num_rows($sql_email_restricao) == ''){
$vesteprime = "vesteprime@gmail.com";
}else{
$vesteprime = "";
}

if($valor_total_fatura >=6){
	
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
  CURLOPT_URL => "https://api.smsdev.com.br/v1/send?key=TZXZSWGNSZY51PZTLQ1SI772BRGA1FGQAKH16GEYTWKMUBSHF2K5D4O4REAUCWD2KG686DRENLFCJZKQT0FEJ4V1YSVICR1DCRU1PJW2OZIW48VKFQ8V084I82QJ5SSZ&type=9&number=$telefone_cliente&msg=".urlencode("VESTE PRIME: Sua fatura com vencimento em $vencimento_completo_fatura é R$ $valor_total_fatura. Mais informações acesse seu e-mail.
  
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
$mail->FromName = "SUA FATURA VESTE PRIME CARD CHEGOU!";
$mail->AddAddress("$email_cliente,$vesteprime","VESTE PRIME CARD");
$mail->WordWrap = 500; 
$mail->AddAttachment("anexo/arquivo.zip"); 
$mail->AddAttachment("imagem/foto.jpg");
$mail->IsHTML(true); //enviar em HTML

	$valor_total_fatura = number_format($valor_total_fatura,2,',','.');

	$mail->AddReplyTo("$email_cliente,vesteprime@gmail.com","$nome_cliente");
	$msg  = "";
	$msg .= "

<table width='800' align='center' style='border:20px solid #069; border-radius:50px; padding:10px;' border='0'>
  <tr>
    <td width='232' style='border:2px solid #FC0; border-radius:1000px; margin:-5px 0 0 0;'  align='center' bgcolor='#FFFFFF'><h1 style='font:12px Arial, Helvetica, sans-serif; color:#CCC;'><strong>CONTRATO:</strong> $cartao</h1></td>
    <td width='370' style='border:2px solid #099; border-radius:1000px; margin:-5px 0 0 0;'  align='center' bgcolor='#999999'><span style='font:20px Arial, Helvetica, sans-serif; color:#CCC;'><strong>VESTE PRIME CARD</strong></span></td>
    <td width='174' style='border:2px solid #FC0; border-radius:1000px; margin:-5px 0 0 0;'  align='center' bgcolor='#FFFFFF'><h1 style='font:12px Arial, Helvetica, sans-serif; color:#CCC;'><strong>VENCIMENTO:</strong> $vencimento_completo_fatura</h1></td>
  </tr>
  <tr>
    <td colspan='3' style='border:2px solid #099; border-radius:1000px; margin:-5px 0 0 0;'  align='center' bgcolor='#003366'><h2 style='font:15px Arial, Helvetica, sans-serif; color:#0CF;'>FATURA MENSAL - VESTE PRIME CARD</h2></td>
  </tr>
  <tr>
    <td width='232' align='center'><img style='border-radius:10px; border:5px solid #069;' src='http://ikuly.com/caixa/img/veste_prime_card.jpg' alt='' width='250' height='150' /></td>
    <td align='justify' style='border:1px solid #CCC; border-radius:20px;'><h1 style='font:20px Arial, Helvetica, sans-serif; color:#CC0; padding:2px;'><strong>Olá, $nome_cliente!
    <br><br>A fatura do seu cartão está fechada no valor de R$ $valor_total_fatura com vencimento dia $vencimento_completo_fatura.</strong></h1></td>
    <td width='174' align='center'><a href='http://www.ikuly.com/caixa/scripts/fatura_fechada.php?code_fatura=$code_fatura'><img src='https://lh3.googleusercontent.com/TNlo7C3s2OLtz6FbjemlFxcoLY4Gc7aCZEhV1foVyy9xOtWC2CN4gJmbf_V3N8yEFg' width='100' border='0'/></a></td>
  </tr>
  <tr>
    <td colspan='3' align='center' bgcolor='#999999'><hr />
      <strong style='font:12px Arial, Helvetica, sans-serif; text-decoration:underline; text-transform:uppercase;'>Cartão: Veste Prime Card</strong>
      <hr /></td>
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
    <td colspan='3' align='center' bgcolor='#FFFFFF' style='border:2px solid #066; border-radius:10px;><h3 style='font:12px Arial, Helvetica, sans-serif;'>Mensagem automática, por favor, não responder.</h3>.</td>
  </tr>
</table>



	<br>\n";
 
$mail->Subject = "SUA FATURA VESTE PRIME CARD CHEGOU!";
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
} // verifica se pode fechar a fatura
	
	
	$valor_fatura = 0;
	$calcula_minimo = 0;
	$cliente = 0;
	$vencimento = 0;
	$fechamento = 0;
	$code_fatura = 0;
	$valor_pagamentos = 0;
	$code_fatura = 0;
	$soma_lancamento = 0;
	$soma_pagamentos = 0;
	$sit_pag = 0;
	$tarifa = 0;
	$fatura_liminar = 0;
	$dias_juros = 0;
	$soma_juros = 0;
	$saldo_anterior = 0;
	$vencimento_completo_fatura = 0;
	$telefone_cliente = 0;
	

	
	$id_cliente++;
	echo "<script language='javascript'>window.location='?id_cliente=$id_cliente';</script>";
	
} // fecha o IF da conta corrente se o fechamento é para hoje
?>
</body>
</html>