<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<? require "connect.php"; ?>
<META content="MSHTML 6.00.2900.3020" name=GENERATOR>
<STYLE></STYLE>
</head>

<body>
<img src="img/roler.gif" /> <em>Enviando e-mail de número:</em> <? echo $_GET['id']; ?>

<?php
	
$title1 = $_GET['title1'];
$title2 = $_GET['title2'];
$title3 = $_GET['title3'];
$title4 = $_GET['title4'];
$title5 = $_GET['title5'];
$title6 = $_GET['title6'];
$title7 = $_GET['title7'];
$title8 = $_GET['title8'];
$title9 = $_GET['title9'];

$url1 = $_GET['url1'];
$url2 = $_GET['url2'];
$url3 = $_GET['url3'];
$url4 = $_GET['url4'];
$url5 = $_GET['url5'];
$url6 = $_GET['url6'];
$url7 = $_GET['url7'];
$url8 = $_GET['url8'];
$url9 = $_GET['url9'];

$img1 = $_GET['img1'];
$img2 = $_GET['img2'];
$img3 = $_GET['img3'];
$img4 = $_GET['img4'];
$img5 = $_GET['img5'];
$img6 = $_GET['img6'];
$img7 = $_GET['img7'];
$img8 = $_GET['img8'];
$img9 = $_GET['img9'];

$valor1 = $_GET['valor1'];
$valor2 = $_GET['valor2'];
$valor3 = $_GET['valor3'];
$valor4 = $_GET['valor4'];
$valor5 = $_GET['valor5'];
$valor6 = $_GET['valor6'];
$valor7 = $_GET['valor7'];
$valor8 = $_GET['valor8'];
$valor9 = $_GET['valor9'];

$tudo = mysql_query("SELECT * FROM usuarios_do_grupo");
$contatudo = mysql_num_rows($tudo);

$id = $_GET['id'];


$sql_1 = mysql_query("SELECT * FROM usuarios_do_grupo WHERE id = '$id'");
$conta_sql_1 = mysql_num_rows($sql_1);


if($id > $contatudo ){
?>
<br /><br />Todos os e-mails foram enviados<br /><em>Estamos redirecioandno de volta...</em>
<script language="javascript">setTimeout("location.href='index.php'",10000);</script> 
<? die; ?>
 
<? 
}else if($conta_sql_1 == ''){

$novo_id = $_GET['id']+1;	

echo "<script language='javascript'>window.location='envio_de_email_em_massa.php?envio_de_email_em_massa.php?title1=$title1&title2=$title2&title3=$title3&title4=$title4&title5=$title5&title6=$title6&title7=$title7&title8=$title8&title9=$title9&url1=$url1&url2=$url2&url3=$url3&url4=$url4&url5=$url5&url6=$url6&url7=$url7&url8=$url8&url9=$url9&img1=$img1&img2=$img2&img3=$img3&img4=$img4&img5=$img5&img6=$img6&img7=$img7&img8=$img8&img9=$img9&valor1=$valor1&valor2=$valor2&valor3=$valor3&valor4=$valor4&valor5=$valor5&valor6=$valor6&valor7=$valor7&valor8=$valor8&valor9=$valor9&id=$novo_id';</script>";

}else{

	while($res = mysql_fetch_array($sql_1)){
			
			$nome = $res['name'];
			$email = $res['email'];

include("phpmailer/class.phpmailer.php");

$mail = new PHPMailer();

$mail->IsSMTP(); 

$mail->Host = "mail.businessmarc.com"; 

$mail->SMTPAuth = true; 

$mail->Username = "suporte@businessmarc.com"; 
$mail->Password = "rcbv896x"; // senha

$mail->From = "suporte@businessmarc.com";
$mail->FromName = "Saldão da China BR";

$mail->AddAddress("suporte@businessmarc.com","Saldão da China BR");
$mail->AddAddress("$email","Newsletter");

$mail->WordWrap = 500; 

$mail->AddAttachment("anexo/arquivo.zip"); 
$mail->AddAttachment("imagem/foto.jpg");
$mail->IsHTML(true); //enviar em HTML

	$mail->AddReplyTo("$email","$nome");
	$msg  = "";
	$msg .= "<b>
<table width='800' background='http://www.saldaodachina.com.br/E-MAIL_MARKETING/back.jpg' border='0' align='center'>
  <tr>
    <td align='center' width='1437'><img src='http://www.saldaodachina.com.br/E-MAIL_MARKETING/logo.png' width='800' height='170'></td>
  </tr>
  <tr>
    <td><img src='http://www.saldaodachina.com.br/E-MAIL_MARKETING/email.png' width='800' height='60'></td>
  </tr>
  <tr>
    <td><table width='800' border='0'>
      <tr>
        <td width='220' align='center' bgcolor='#FFFFFF'><h1><span style='color: #ff6600; font-size: small;'>$title1</span></h1>
          <br />
          </span>
          </p>
          <a target='_blank' href='$url1'><img src='$img1' width='220' height='200' border='0' /></a><span style='font-size:  x-large; color: #0000ff;'><span style='font-size: large; color: #000000;'>Apenas</span> <span style='color: #ff0000;'>R$ $valor1<br />
            </span> <a href='$url1'><img src='http://www.saldaodachina.com.br/E-MAIL_MARKETING/btn_comprar.png' width='116' height='31' border='0' /></a><br />
          </span></td>
        <td align='center' width='23'><img src='email.png' alt='' width='5' height='320' /></td>
        <td width='220' align='center' bgcolor='#FFFFFF'><h1><span style='color: #ff6600; font-size: small;'>$title2</span></h1>
          <br />
          </span>
          </p>
          <a href='$url2'><img src='$img2' width='220' height='200' border='0' /></a><span style='font-size:  x-large; color: #0000ff;'><span style='font-size: large; color: #000000;'>Apenas</span> <span style='color: #ff0000;'>R$ $valor2 <br />
          </span> <a href='$url2'><img src='http://www.saldaodachina.com.br/E-MAIL_MARKETING/btn_comprar.png' width='116' height='31' border='0' /></a></span></td>
        <td align='center' width='15'><img src='email.png' alt='' width='5' height='320' /></td>
        <td width='220' align='center' bgcolor='#FFFFFF'><h1><span style='color: #ff6600; font-size: small;'>$title3</span></h1>
          <br />
          </span>
          </p>
          <a href='$url3'><img src='$img3' width='220' height='200' border='0' /></a><span style='font-size:  x-large; color: #0000ff;'><span style='font-size: large; color: #000000;'>Apenas</span> <span style='color: #ff0000;'>R$ $valor3<br />
          </span> <a href='$url3'><img src='http://www.saldaodachina.com.br/E-MAIL_MARKETING/btn_comprar.png' width='116' height='31' border='0' /></a></span></td>
      </tr>
    </table>
      <table width='800' border='0'>
        <tr>
          <td width='220' align='center' bgcolor='#FFFFFF'><h1><span style='color: #ff6600; font-size: small;'>$title4</span></h1>
            <br />
            </span>
            </p>
            <a href='$url4'><img src='$img4' width='220' height='200' border='0' /></a><span style='font-size:  x-large; color: #0000ff;'><span style='font-size: large; color: #000000;'>Apenas</span> <span style='color: #ff0000;'>R$ $valor4<br />
              </span> <a href='$url4'><img src='http://www.saldaodachina.com.br/E-MAIL_MARKETING/btn_comprar.png' width='116' height='31' border='0' /></a><br />
            </span></td>
          <td align='center' width='23'><img src='email.png' alt='' width='5' height='320' /></td>
          <td width='220' align='center' bgcolor='#FFFFFF'><h1><span style='color: #ff6600; font-size: small;'> $title5</span></h1>
            <br />
            </span>
            </p>
            <a href='$url5'><img src='$img5' width='220' height='200' border='0' /></a><span style='font-size:  x-large; color: #0000ff;'><span style='font-size: large; color: #000000;'>Apenas</span> <span style='color: #ff0000;'>R$ $valor5<br />
            </span> <a href='$url5'><img src='http://www.saldaodachina.com.br/E-MAIL_MARKETING/btn_comprar.png' width='116' height='31' border='0' /></a></span></td>
          <td align='center' width='15'><img src='email.png' alt='' width='5' height='320' /></td>
          <td width='220' align='center' bgcolor='#FFFFFF'><h1><span style='color: #ff6600; font-size: small;'>$title6</span></h1>
            <br />
            </span>
            </p>
            <a href='$url6'><img src='$img6' width='220' height='200' border='0' /></a><span style='font-size:  x-large; color: #0000ff;'><span style='font-size: large; color: #000000;'>Apenas</span> <span style='color: #ff0000;'>R$ $valor6<br />
            </span> <a href='$url6'><img src='http://www.saldaodachina.com.br/E-MAIL_MARKETING/btn_comprar.png' width='116' height='31' border='0' /></a></span></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width='800' border='0'>
      <tr>
        <td width='220' align='center' bgcolor='#FFFFFF'><h1><span style='color: #ff6600; font-size: small;'>$title7</span></h1>
          <br />
          </span>
          </p>
          <a href='$url7'><img src='$img7' width='220' height='200' border='0' /></a><span style='font-size:  x-large; color: #0000ff;'><span style='font-size: large; color: #000000;'>Apenas</span> <span style='color: #ff0000;'>R$ $valor7<br />
            </span> <a href='$url7'><img src='http://www.saldaodachina.com.br/E-MAIL_MARKETING/btn_comprar.png' width='116' height='31' border='0' /></a><br />
          </span></td>
        <td align='center' width='23'><img src='email.png' alt='' width='5' height='320' /></td>
        <td width='220' align='center' bgcolor='#FFFFFF'><h1><span style='color: #ff6600; font-size: small;'>$title8</span></h1>
          <br />
          </span>
          </p>
          <a href='$url8'><img src='$img8' width='220' height='200' border='0' /></a><span style='font-size:  x-large; color: #0000ff;'><span style='font-size: large; color: #000000;'>Apenas</span> <span style='color: #ff0000;'>R$ $valor8<br />
          </span> <a href='$url8'><img src='http://www.saldaodachina.com.br/E-MAIL_MARKETING/btn_comprar.png' width='116' height='31' border='0' /></a></span></td>
        <td align='center' width='15'><img src='email.png' alt='' width='5' height='320' /></td>
        <td width='220' align='center' bgcolor='#FFFFFF'><h1><span style='color: #ff6600; font-size: small;'>$title9</span></h1>
          <br />
          </span>
          </p>
          <a href='$url9'><img src='$img9' width='220' height='200' border='0' /></a><span style='font-size: x-large; color: #0000ff;'><span style='font-size: large; color: #000000;'>Apenas</span> <span style='color: #ff0000;'>R$ $valor9<br />
          </span> <a href='$url9'><img src='http://www.saldaodachina.com.br/E-MAIL_MARKETING/btn_comprar.png' width='116' height='31' border='0' /></a></span></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><p><a href='http://www.saldaodachina.com.br'><img src='http://www.saldaodachina.com.br/E-MAIL_MARKETING/site.png' width='800' height='60' border='0'></a></p></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><p><span style='color: #ffffff;'>Todas as ofertas acima s&atilde;o por tempo limitado.</span></p>
<p><span style='color: #ffffff;'>Voc&ecirc; pode conseguir um cupom com nossos afiliados e ter ainda mais desconto em suas compras.</span></p>
<p><span><span style='color: #ffffff;'>Para economizar acesse j&aacute;</span><span class='apple-converted-space'>&nbsp;</span><span style='color: #ffffff;'><a href='http://www.saldaodachina.com.br/'><span style='color: #ffffff;'>www.saldaodachina.com.br</span></a></span></span></p>
<p>&nbsp;</p>
<p><span><!--[if !supportLineBreakNewLine]--><br /> <!--[endif]--></span><span style='font-size: xx-small; color: #ffff00;'>Este e-mail &eacute; disparado automaticamente pelo nosso sistema, por favor, n&atilde;o responda, pois ele n&atilde;o &eacute; monitorado, caso tenha alguma d&uacute;vida entre em contato com nosso suporte.</span></p></td>
  </tr>
  </table>
<br>\n";
 
$mail->Subject = "Ofertas Exclusivas é só no Saldão da China - APROVEITE AS OFERTAS!!!";
//adicionando o html no corpo do email
$mail->Body = $msg;
//enviando e retornando o status de envio
if(!$mail->Send())
{
echo "Ocorreru um erro, tente novamente!".$mail->ErrorInfo;
//$mail->ErrorInfo informa onde ocorreu o erro 

exit;
}

$novo_id = $_GET['id']+1;	

echo "<script language='javascript'>window.location='envio_de_email_em_massa.php?envio_de_email_em_massa.php?title1=$title1&title2=$title2&title3=$title3&title4=$title4&title5=$title5&title6=$title6&title7=$title7&title8=$title8&title9=$title9&url1=$url1&url2=$url2&url3=$url3&url4=$url4&url5=$url5&url6=$url6&url7=$url7&url8=$url8&url9=$url9&img1=$img1&img2=$img2&img3=$img3&img4=$img4&img5=$img5&img6=$img6&img7=$img7&img8=$img8&img9=$img9&valor1=$valor1&valor2=$valor2&valor3=$valor3&valor4=$valor4&valor5=$valor5&valor6=$valor6&valor7=$valor7&valor8=$valor8&valor9=$valor9&id=$novo_id';</script>";

  }
 }
?>

</body>
</html>