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

if($id_cliente == mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM conta_corrente"))){
	echo "<script language='javascript'>window.close();</script>";
}

$cliente = 0;
$cartao = 0;
$vencimento = 0;
$limite_loja = 0;
$limite_loja_disponivel = 0;
$pagamento_contas = 0;
$limite = 0;
$disponivel_pagamento_contas = 0;

$sql_verifica_fechamento = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente");
  while($res_verifica_fechamento = mysqli_fetch_array($sql_verifica_fechamento)){
		
	$cliente = $res_verifica_fechamento['cliente'];
	$cartao = $res_verifica_fechamento['cartao'];
	$vencimento = $res_verifica_fechamento['vencimento'];
	$limite_loja = number_format($res_verifica_fechamento['limite_loja'],2,',','.');
	$limite_loja_disponivel = number_format($res_verifica_fechamento['limite_loja_disponivel'],2,',','.');
	$pagamento_contas = number_format($res_verifica_fechamento['pagamento_contas'],2,',','.');
	$disponivel_pagamento_contas = number_format($res_verifica_fechamento['disponivel_pagamento_contas'],2,',','.');
	
  } // fecha o while da conta corrente


$sql_verifica_emprestimo = mysqli_query($conexao_bd, "SELECT * FROM clientes_emprestimo_carne WHERE cliente = '$cliente'");
  while($res_emprestimo = mysqli_fetch_array($sql_verifica_emprestimo)){
		
	$limite = number_format($res_emprestimo['limite'],2,',','.');
	
  } // fecha o while da conta corrente
  
  
$email_cliente = 0;
$nome_cliente = 0;
$sql_email_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '$cliente'");	
	while($res_email_cliente = mysqli_fetch_array($sql_email_cliente)){
		$email_cliente = strtolower($res_email_cliente['email']);
		$nome_cliente = strtoupper($res_email_cliente['nome']);
	}
	
include("../phpmailer/class.phpmailer.php");

$mail = new PHPMailer();
$mail->IsMAIL(); 
$mail->Host = "mail.ikuly.com"; 
$mail->SMTPAuth = true; 
$mail->Username = "suporte@ikuly.com"; 
$mail->Password = "Rcbv896xw*"; // senha
$mail->From = "suporte@ikuly.com";
$mail->FromName = "VESTE PRIME CARD";
$mail->AddAddress("$email_cliente,vesteprime@gmail.com","JÁ CONHECE SEUS LIMITES DE CRÉDITO? VEJA AGORA!");
$mail->WordWrap = 500; 
$mail->AddAttachment("anexo/arquivo.zip"); 
$mail->AddAttachment("imagem/foto.jpg");
$mail->IsHTML(true); //enviar em HTML


	$mail->AddReplyTo("$email_cliente,vesteprime@gmail.com","$nome_cliente");
	$msg  = "";
	$msg .= "

<table width='800' align='center' style='border:1px solid #09C; border-radius:50px; padding:10px;' border='0'>
<tr>
  <td width='178' align='center'><table width='800' align='center' style='border:1px solid #09C; border-radius:50px; padding:10px;' border='0'>
    <tr>
      <td width='270' style='border:2px solid #FC0; border-radius:1000px; margin:-5px 0 0 0;'  align='center' bgcolor='#FFFFFF'><h1 style='font:12px Arial, Helvetica, sans-serif; color:#CCC;'><strong>CONTRATO:<br />
        </strong> $cartao</h1></td>
      <td width='298' style='border:2px solid #099; border-radius:1000px; margin:-5px 0 0 0;'  align='center' bgcolor='#999999'><span style='font:20px Arial, Helvetica, sans-serif; color:#CCC;'><strong>VESTE PRIME CARD</strong></span></td>
      <td width='178' style='border:2px solid #FC0; border-radius:1000px; margin:-5px 0 0 0;'  align='center' bgcolor='#FFFFFF'><h1 style='font:12px Arial, Helvetica, sans-serif; color:#CCC;'><strong>VENCIMENTO DA FATURA:<br />
        </strong> $vencimento</h1></td>
    </tr>
    <tr>
      <td colspan='3' style='border:2px solid #099; border-radius:1000px; margin:0; padding:0;'  align='center' bgcolor='#003366'><h2 style='font:15px Arial, Helvetica, sans-serif; color:#0CF;'>PARABÉNS! VOCÊ TEM LIMITE DE CRÉDITO APROVADO!</h2></td>
    </tr>
    <tr>
      <td width='270' align='center'><img style='border-radius:10px; border:5px solid #069;' src='http://ikuly.com/caixa/img/veste_prime_card.jpg' alt='' width='260' height='160' /></td>
      <td align='justify' style='border:1px solid #CCC; border-radius:20px;'><h1 style='font:20px Arial, Helvetica, sans-serif; color:#CC0; padding:2px;'><strong>Olá, $nome_cliente! <br />
        <br />
        Sabia que você tem limite de crédito aprovado na VESTE PRIME? Conheça abaixo.</strong></h1></td>
      <td width='178' align='center'><h1 style='font:15px Arial, Helvetica, sans-serif; color:#09C;'>Correspondente Autorizado<br />
        <img src='http://ikuly.com/caixa/img/bb.png' width='100' height='100' border='0'/></h1></td>
    </tr>
    <tr>
      <td colspan='3' align='center' bgcolor='#999999'><h1 style='font:15px Arial, Helvetica, sans-serif; color:#0FC; padding:0; margin:0;'><strong style='font:15px Arial, Helvetica, sans-serif;'><strong>SEUS LIMITES DE CRÉDITO</strong></strong></h1></td>
    </tr>
    <tr>
      <td align='center' bgcolor='#FFFFFF'><strong>LIMITE DE COMPRAS</strong></td>
      <td align='center' bgcolor='#FFFFFF'><strong>LIMITE DE FINANCIAMENTO</strong></td>
      <td align='center' bgcolor='#FFFFFF'><strong>EMPRÉSTIMO</strong></td>
    </tr>
    <tr>
      <td align='center' bgcolor='#FFFFFF'>$limite_loja</td>
      <td align='center' bgcolor='#FFFFFF'>$pagamento_contas</td>
      <td align='center' bgcolor='#FFFFFF'>$limite</td>
    </tr>
    <tr>
      <td align='center' bgcolor='#FFFFFF'><strong>DISPONÍVEL</strong></td>
      <td align='center' bgcolor='#FFFFFF'><strong>DISPONÍVEL</strong></td>
      <td align='center' bgcolor='#FFFFFF'><strong>DISPONÍVEL</strong></td>
    </tr>
    <tr>
      <td align='center' bgcolor='#FFFFFF'>$limite_loja_disponivel</td>
      <td align='center' bgcolor='#FFFFFF'>$disponivel_pagamento_contas</td>
      <td align='center' bgcolor='#FFFFFF'>$limite</td>
    </tr>
    <tr>
      <td colspan='3' align='center'><hr />
        <p style='font:10px Arial, Helvetica, sans-serif;'>Para sua segurança, estamos enviando esta propósta pessoal..</p>
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
  </table>    <h1 style='font:15px Arial, Helvetica, sans-serif; color:#09C;'>&nbsp;</h1></td>
</tr>
</table>


	<br>\n";
 
$mail->Subject = "JÁ CONHECE SEUS LIMITES DE CRÉDITO? VEJA AGORA!";
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
	


	$id_cliente++;
	echo "<script language='javascript'>window.location='?id_cliente=$id_cliente';</script>";
?>
</body>
</html>