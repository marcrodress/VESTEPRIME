<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>ENVIO DE E-MAIL DE CRÉDITO</title>
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
<img src="../img/roler.gif" />Fazendo verificação de clientes aptos.<br /><br />Enviando e-mails...<br />

<? require "../conexao.php"; ?>


<?

$cliente = 0;
$vencimento = 0;
$code_fatura = 0;
$limite_credito = 0;
$taxa_juros = 0;



$id_cliente = $_GET['id_cliente'];
if($id_cliente == ''){
	$id_cliente = 1;
}else{
	echo $id_cliente = $id_cliente;
}

if($id_cliente == mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM clientes_emprestimo_carne"))){
	echo "<script language='javascript'>window.close();</script>";
	
}


$verifica_limite_credito = mysqli_query($conexao_bd, "SELECT * FROM clientes_emprestimo_carne WHERE id = '$id_cliente'");
while($res_limite_credito = mysqli_fetch_array($verifica_limite_credito)){
		$limite_credito = $res_limite_credito['limite'];
		$cliente = $res_limite_credito['cliente'];
		$taxa_juros = $res_limite_credito['juros']/100;
	}
echo $limite_credito;

if($limite_credito <=0){
$id_cliente++;
echo "<script language='javascript'>window.location='?id_cliente=$id_cliente';</script>";
}else{

$sql_verifica_emprestimo_existente = mysqli_query($conexao_bd, "SELECT * FROM boletos_emprestimo_boleto WHERE cliente = '$cliente' AND status = 'AGUARDA'");
if(mysqli_num_rows($sql_verifica_emprestimo_existente) >1){
$id_cliente++;
echo "<script language='javascript'>window.location='?id_cliente=$id_cliente';</script>";
}else{
	
$sql_verifica_fechamento = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente cliente = '$cliente'");
  while($res_verifica_fechamento = mysqli_fetch_array($sql_verifica_fechamento)){
		
	$cliente = $res_verifica_fechamento['cliente'];
	$cartao = $res_verifica_fechamento['cartao'];
	$vencimento = $res_verifica_fechamento['vencimento'];
	
	
  } // fecha o while da conta corrente
  
  
$email_cliente = 0;
$nome_cliente = 0;
$sql_email_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '$cliente'");	
	while($res_email_cliente = mysqli_fetch_array($sql_email_cliente)){
		$email_cliente = strtolower($res_email_cliente['email']);
		$nome_cliente = strtoupper($res_email_cliente['nome']);
	}
	
$parcela4 = number_format((($limite_credito*$taxa_juros*4)+$limite_credito)/4,2,',','.');
$parcela5 = number_format((($limite_credito*$taxa_juros*5)+$limite_credito)/5,2,',','.');
$parcela6 = number_format((($limite_credito*$taxa_juros*6)+$limite_credito)/6,2,',','.');
$parcela7 = number_format((($limite_credito*$taxa_juros*7)+$limite_credito)/7,2,',','.');
$parcela8 = number_format((($limite_credito*$taxa_juros*8)+$limite_credito)/8,2,',','.');
$parcela9 = number_format((($limite_credito*$taxa_juros*9)+$limite_credito)/9,2,',','.');
$parcela10 = number_format((($limite_credito*$taxa_juros*10)+$limite_credito)/10,2,',','.');
$parcela11 = number_format((($limite_credito*$taxa_juros*11)+$limite_credito)/11,2,',','.');
$parcela12 = number_format((($limite_credito*$taxa_juros*12)+$limite_credito)/12,2,',','.');

$limite_credito = number_format($limite_credito,2,',','.');	
	
if($limite_credito >0){


include("../phpmailer/class.phpmailer.php");

$mail = new PHPMailer();
$mail->IsMAIL(); 
$mail->Host = "mail.ikuly.com"; 
$mail->SMTPAuth = true; 
$mail->Username = "suporte@ikuly.com"; 
$mail->Password = "Rcbv896xw*"; // senha
$mail->From = "suporte@ikuly.com";
$mail->FromName = "VESTE PRIME CARD";
$mail->AddAddress("$email_cliente","VOCÊ TEM UM LIMITE DE EMPRÉSTIMO PESSOAL PRÉ-APROVADO. SOLICITE AGORA!");
$mail->WordWrap = 500; 
$mail->AddAttachment("anexo/arquivo.zip"); 
$mail->AddAttachment("imagem/foto.jpg");
$mail->IsHTML(true); //enviar em HTML


	$mail->AddReplyTo("$email_cliente,vesteprime@gmail.com","$nome_cliente");
	$msg  = "";
	$msg .= "


<table width='800' align='center' style='border:20px solid #09C; border-radius:50px; padding:10px;' border='0'>
<tr></tr>
<tr>
  <td width='270' style='border:2px solid #FC0; border-radius:1000px; margin:-5px 0 0 0;'  align='center' bgcolor='#FFFFFF'><h1 style='font:12px Arial, Helvetica, sans-serif; color:#CCC;'><strong>CONTRATO:<br /></strong> $cartao</h1></td>
  <td width='298' style='border:2px solid #099; border-radius:1000px; margin:-5px 0 0 0;'  align='center' bgcolor='#999999'><span style='font:20px Arial, Helvetica, sans-serif; color:#CCC;'><strong>VESTE PRIME CARD</strong></span></td>
  <td width='178' style='border:2px solid #FC0; border-radius:1000px; margin:-5px 0 0 0;'  align='center' bgcolor='#FFFFFF'><h1 style='font:12px Arial, Helvetica, sans-serif; color:#CCC;'><strong>VENCIMENTO DA FATURA:<br /></strong> $vencimento</h1></td>
</tr>
<tr>
  <td colspan='3' style='border:2px solid #099; border-radius:1000px; margin:0; padding:0;'  align='center' bgcolor='#003366'><h2 style='font:15px Arial, Helvetica, sans-serif; color:#0CF;'>PARABÉNS! VOCÊ TEM UM CRÉDITO PESSOAL PRÉ-APROVADO.</h2></td>
</tr>
<tr>
  <td width='270' align='center'><img style='border-radius:10px; border:5px solid #069;' src='http://ikuly.com/caixa/img/veste_prime_card.jpg' alt='' width='260' height='160' /></td>
  <td align='justify' style='border:1px solid #CCC; border-radius:20px;'><h1 style='font:20px Arial, Helvetica, sans-serif; color:#CC0; padding:2px;'><strong>Olá, $nome_cliente! <br />
    <br />
    Informamos que você tem um limite de crédito pessoal no valor de até R$ $limite_credito, e você pode pagar em até 12X no boleto bancário.</strong></h1></td>
  <td width='178' align='center'><h1 style='font:15px Arial, Helvetica, sans-serif; color:#09C;'>Correspondente Autorizado<br />
    <img src='http://ikuly.com/caixa/img/bb.png' width='100' height='100' border='0'/></h1></td>
</tr>
<tr>
  <td colspan='3' align='center' bgcolor='#999999'><h1 style='font:15px Arial, Helvetica, sans-serif; color:#0FC; padding:0; margin:0;'>Para contratar, digira-se a uma filial autorizada mais perto portando seu CPF e documento de identificação.</h1></td>
</tr>
<tr>
  <td colspan='3' align='center' bgcolor='#33CC00'><strong style='font:15px Arial, Helvetica, sans-serif;'><strong>SIMULAÇÃO DE SEU EMPRÉSTIMO</strong></strong></td>
</tr>
<tr>
  <td align='center' bgcolor='#FFFFFF'>4 X $parcela4</td>
  <td align='center' bgcolor='#FFFFFF'>5 X $parcela5</td>
  <td align='center' bgcolor='#FFFFFF'>6 X $parcela6</td>
</tr>
<tr>
  <td align='center' bgcolor='#FFFFFF'>7 X $parcela7</td>
  <td align='center' bgcolor='#FFFFFF'>8 X $parcela8</td>
  <td align='center' bgcolor='#FFFFFF'>9 X $parcela9</td>
</tr>
<tr>
  <td align='center' bgcolor='#FFFFFF'>10 X $parcela10</td>
  <td align='center' bgcolor='#FFFFFF'>11 X $parcela11</td>
  <td align='center' bgcolor='#FFFFFF'>12 X $parcela12</td>
</tr>
<tr>
  <td colspan='3' align='center'><hr /><p style='font:10px Arial, Helvetica, sans-serif;'>Para sua segurança, estamos enviando esta propósta pessoal..</p>
    <p style='font:10px Arial, Helvetica, sans-serif;'>Evite pagar juros e multas, pague sua fatura em dias e evite a restrinção nos orgãos de proteção ao crédito, como o SPC e SARASA.</p></td>
</tr>
<tr>
  <td colspan='3' align='center'><hr /></td>
</tr>
<tr>
  <td align='center' style='border:2px solid #099; border-radius:10px; margin:-5px 0 0 0;'><img src='http://www.acim.com.br/wp-content/uploads/2016/03/spc-site.png' width='120' height='60' /><img src='https://upload.wikimedia.org/wikipedia/commons/thumb/3/30/SerasaExperian-TM_Portrait_RGB.svg/383px-SerasaExperian-TM_Portrait_RGB.svg.png' width='120' height='60' /></td>
  <td colspan='2'><p style='font:10px Arial, Helvetica, sans-serif; color:#F00; font-size: 10px'><strong>AVISO:</strong> Ao solicitar o crédito, o mesmo passará por analise de risco e o envio deste e-mail não garante aprovação.</p>
    <p style='font:10px Arial, Helvetica, sans-serif; color:#F00; font-size: 10px'>Após 20 dias de atraso você terá seu CPF inscrito nos orgãos de proteção ao crédito.</p>
    <p style='font:10px Arial, Helvetica, sans-serif;; font-family: Arial, Helvetica, sans-serif; font-size: 10px'><span style='font-family: Arial, Helvetica, sans-serif; font-size: 10px'>Após 45 dias de atraso será solicitado a inclusão desta fatura nos cartórios de protestos.</span></p></td>
</tr>
<tr>
  <td colspan='3'><hr /></td>
</tr>
<tr>
  <td colspan='3' align='justify' bgcolor='#999999' style='border:2px solid #066; border-radius:10px; margin:-5px 0 0 0;'><h4 style='font:11px Arial, Helvetica, sans-serif; color:#CCC; padding:0 5px 0 5px;'>Consultas, informações, transações, acesse www.vesteprime.com.br ou ligue (85) 3315.6199 (capitais e regiões metropolitanas) ou (85) 99158.7323 (demais localidades, somente chamadas de telefone fixo), de segunda a domingo, das 8h às 17h (exceto feriados nacionais). Reclamações, cancelamentos e informações gerais, ligue para o (85) 3315.6199, todos os dias, 24 horas por dia. Se não ficar satisfeito com a solução apresentada, contate a Ouvidoria: (85) 3315.6199, em dias úteis, das 9h às 18h.</h4></td>
</tr>
<tr>
  <td colspan='3' align='center' bgcolor='#FFFFFF' style='border:2px solid #066; border-radius:10px;><h3 style='font:12px arial, helvetica, sans-serif;'>Mensagem automática, por favor, não responder.</td>
</tr>
</table>


	<br>\n";
 
$mail->Subject = "VOCÊ TEM UM LIMITE DE EMPRÉSTIMO PESSOAL PRÉ-APROVADO. SOLICITE AGORA!";
//adicionando o html no corpo do email
$mail->Body = $msg;
//enviando e retornando o status de envio
if(!$mail->Send()){
$id_cliente++;
echo "<script language='javascript'>window.location='?id_cliente=$id_cliente';</script>";
echo "Ocorreru um erro, tente novamente!".$mail->ErrorInfo;
//$mail->ErrorInfo informa onde ocorreu o erro 
exit;
}

} // verifica se existe limite de crédito

	$id_cliente++;
	echo "<script language='javascript'>window.location='?id_cliente=$id_cliente';</script>";
 }
 
}

?>
</body>
</html>