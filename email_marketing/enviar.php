<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<? require "../conexao.php"; ?>
</head>

<body>
<? 

$id_email = 0;
$inicio = $_GET['inicio'];
$fim = $_GET['fim'];

if($inicio == $fim){
}else{

$sql_email = mysqli_query($conexao_bd, "SELECT * FROM email_enviar WHERE id = '$inicio'");
if(mysqli_num_rows($sql_email) == ''){
echo "<script language='javascript'>window.location='?inicio=$fim&fim=$fim';</script>";	
}else{
	while($res_email = mysqli_fetch_array($sql_email)){
		
		$nome = $res_email['nome'];
		$id_email = $res_email['id'];
		$email = $res_email['email'];
		$titulo = $res_email['titulo'];
		$mensagem = base64_decode($res_email['mensagem']);		
		
		mysqli_query($conexao_bd, "UPDATE email_enviar SET status = 'Enviado', data_envio = '$data' WHERE id = '$id_email'");
		
		
include("../phpmailer/class.phpmailer.php");


$mail = new PHPMailer();
$mail->IsMAIL(); 
$mail->Host = "mail.ikuly.com"; 
$mail->SMTPAuth = true; 
$mail->Username = "suporte@ikuly.com"; 
$mail->Password = "Rcbv896xw*"; // senha
$mail->From = "suporte@ikuly.com";
$mail->FromName = "VESTE PRIME CARD";
$mail->AddAddress("$email","VESTE PRIME CARD");
$mail->WordWrap = 500; 
$mail->AddAttachment("anexo/arquivo.zip"); 
$mail->AddAttachment("imagem/foto.jpg");
$mail->IsHTML(true); //enviar em HTML


	$mail->AddReplyTo("$email","$nome");
	$msg  = "";
	$msg .= "$mensagem\n";
 
$mail->Subject = "$titulo";
//adicionando o html no corpo do email
$mail->Body = $msg;
//enviando e retornando o status de envio
if(!$mail->Send())
{
$inicio++;
echo "<script language='javascript'>window.location='?inicio=$inicio&fim=$fim';</script>";
echo "Ocorreru um erro, tente novamente!".$mail->ErrorInfo;
//$mail->ErrorInfo informa onde ocorreu o erro 

exit;
}		
		
$inicio++;
echo "<script language='javascript'>window.location='?inicio=$inicio&fim=$fim';</script>";	
	}

 }
}
?>
</body>
</html>