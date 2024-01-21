<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>

<body>
<img src="../img/roler.gif" />
<em>E-mail enviando com sucesso!!!</em>
<?
require "../../conexao.php";
$id = $_GET['id'];
$id_cliente = $_GET['id_cliente'];

$sql_1 = mysql_query("SELECT * FROM contratos_sky WHERE id = '$id'");
	while($res_1 = mysql_fetch_array($sql_1)){

		$plano = $res_1['plano'];
		$valor = $res_1['valor'];
		$brasileirao = $res_1['brasileirao'];
		$estadual = $res_1['estadual'];
		$cartao = $res_1['cartao'];
		$validade = $res_1['validade'];
		$nome_impressor_cartao = $res_1['nome_impressor_cartao'];
		$cosigo_s_cartao = $res_1['cosigo_s_cartao'];
		$bandeira = $res_1['bandeira'];
		$banco = $res_1['banco'];
		$agencia = $res_1['agencia'];
		$conta_corrente = $res_1['conta_corrente'];
		$obs = $res_1['obs'];

$sql_2 = mysql_query("SELECT * FROM telemarketing WHERE id = '$id_cliente'");
	while($res_2 = mysql_fetch_array($sql_2)){
		
		$tele_celular = $res_2['tele_celular'];
		$tele_comercial = $res_2['tele_comercial'];
		$tipo_imovel = $res_2['tipo_imovel'];
		$cpf = $res_2['cpf'];
		$nascimento = $res_2['nascimento'];
		$rg = $res_2['rg'];
		$estado_civil = $res_2['estado_civil'];
		$email = $res_2['email'];
		$tele_residencial = $res_2['tele_residencial'];
		$nome = $res_2['nome'];
		$endereco = $res_2['endereco'];
		$complemento = $res_2['complemento'];
		$bairro = $res_2['bairro'];
		$cidade = $res_2['cidade'];
		$estado = $res_2['estado'];
		$cep = $res_2['cep'];


include("phpmailer/class.phpmailer.php");

$mail = new PHPMailer();

$mail->IsSMTP(); 

$mail->Host = "mail.businessmarc.com"; 

$mail->SMTPAuth = true; 

$mail->Username = "suporte@businessmarc.com"; 
$mail->Password = "rcbv896x"; // senha

$mail->From = "suporte@businessmarc.com";
$mail->FromName = "Easy Loan Financial Services";

$mail->AddAddress("suporte@businessmarc.com","Assinatura de novo plano Sky - Easy Loan Financial Services");
$mail->AddAddress("cecilias@canalapolo.com.br,","Assinatura de novo plano Sky - Easy Loan Financial Services");

$mail->WordWrap = 500; 

$mail->AddAttachment("anexo/arquivo.zip"); 
$mail->AddAttachment("imagem/foto.jpg");
$mail->IsHTML(true); //enviar em HTML

	$mail->AddReplyTo("cecilias@canalapolo.com.br,marcrodress@gmail.com","Easy Loan Financial Services");
	$msg  = "";
	$msg .= "<b>
<table width='806' background='http://www.saldaodachina.com.br/E-MAIL_MARKETING/back.jpg' border='0' align='center'>
  <tr>
    <td align='center' width='800'><img src='http://www.easyloan.com.br/sky_sound_dt/sistema/sky/logo.png' width='803' height='153'></td>
  </tr>
  <tr>
    <td><img src='http://www.easyloan.com.br/sky_sound_dt/sistema/sky/email.png' width='800' height='60'></td>
  </tr>
  <tr>
    <td><table width='800' border='0'>
      <tr>
        <td width='223' align='center' bgcolor='#FFFFFF'><strong>Nome da loja:</strong></td>
        <td width='190' align='center' bgcolor='#FFFFFF'><strong>PDV:</strong></td>
        <td width='222' align='center' bgcolor='#FFFFFF'><strong>ID do vendedor:</strong></td>
        <td width='147' align='center' bgcolor='#FFFFFF'><strong>UF</strong></td>
        </tr>
      <tr>
        <td align='center' bgcolor='#FFFFFF'>Easy Loan Financial Services Marcos Rodrigues de Oliveira - ME</td>
        <td align='center' bgcolor='#FFFFFF'>&nbsp;</td>
        <td align='center' bgcolor='#FFFFFF'>&nbsp;</td>
        <td align='center' bgcolor='#FFFFFF'>Ceará</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><img src='http://www.easyloan.com.br/sky_sound_dt/sistema/sky/dados_do_cliente.png' width='800' height='60'></td>
  </tr>
  <tr>
    <td><table width='800' border='0'>
      <tr>
        <td colspan='5' align='center' bgcolor='#FFFFFF'><h1>Dados pessoais</h1></td>
        </tr>
      <tr>
        <td width='243' align='center' bgcolor='#FFFFFF'><h3>Nome:</h3></td>
        <td width='134' align='center' bgcolor='#FFFFFF'><h3>CPF:</h3></td>
        <td width='150' align='center' bgcolor='#FFFFFF'><h3>RG:</h3></td>
        <td width='123' align='center' bgcolor='#FFFFFF'><h3>Nascimento:</h3></td>
        <td width='128' align='center' bgcolor='#FFFFFF'><h3>Estado civil:</h3></td>
      </tr>
      <tr>
        <td align='center' bgcolor='#FFFFFF'>$nome</td>
        <td align='center' bgcolor='#FFFFFF'>$cpf</td>
        <td align='center' bgcolor='#FFFFFF'>$rg</td>
        <td align='center' bgcolor='#FFFFFF'>$nascimento</td>
        <td align='center' bgcolor='#FFFFFF'>$estado_civil
        <td>
      </tr>
      <tr>
        <td colspan='5' align='center' bgcolor='#FFFFFF'><h1>Dados de endereço e instalação</h1></td>
      </tr>
      <tr>
        <td align='center' bgcolor='#FFFFFF'><h3><strong>Endereço:</strong></h3></td>
        <td align='center' bgcolor='#FFFFFF'><h3><strong>Cep:</strong></h3></td>
        <td align='center' bgcolor='#FFFFFF'><h3><strong>Complemento:</strong></h3></td>
        <td align='center' bgcolor='#FFFFFF'><h3><strong>Tipo do imóvel:</strong></h3></td>
        <td align='center' bgcolor='#FFFFFF'><h3><strong>Bairro:</strong></h3></td>
      </tr>
      <tr>
        <td align='center' bgcolor='#FFFFFF'>$endereco</td>
        <td align='center' bgcolor='#FFFFFF'>$cep</td>
        <td align='center' bgcolor='#FFFFFF'>$complemento</td>
        <td align='center' bgcolor='#FFFFFF'>$tipo_imovel</td>
        <td align='center' bgcolor='#FFFFFF'>$bairro</td>
      </tr>
      <tr>
        <td align='center' bgcolor='#FFFFFF'><h3>Cidade:</h3></td>
        <td align='center' bgcolor='#FFFFFF'><h3>Estado:</h3></td>
        <td align='center' bgcolor='#FFFFFF'><h3>Telefone residêncial:</h3></td>
        <td align='center' bgcolor='#FFFFFF'><h3>Telefone celular:</h3></td>
        <td align='center' bgcolor='#FFFFFF'><h3>Telefone comercial:</h3></td>
      </tr>
      <tr>
        <td align='center' bgcolor='#FFFFFF'>$cidade</td>
        <td align='center' bgcolor='#FFFFFF'>$estado</td>
        <td align='center' bgcolor='#FFFFFF'>$tele_residencial</td>
        <td align='center' bgcolor='#FFFFFF'>$tele_celular</td>
        <td align='center' bgcolor='#FFFFFF'>$tele_comercial</td>
      </tr>
      <tr>
        <td align='center' bgcolor='#FFFFFF'><h3>E-mail:</h3></td>
        <td align='center' bgcolor='#FFFFFF'><h3>Plano:</h3></td>
        <td align='center' bgcolor='#FFFFFF'><h3>Valor:</h3></td>
        <td align='center' bgcolor='#FFFFFF'><h3>Brasileirão:</h3></td>
        <td align='center' bgcolor='#FFFFFF'><h3>Estadual:</h3></td>
      </tr>
      <tr>
        <td align='center' bgcolor='#FFFFFF'>$email</td>
        <td align='center' bgcolor='#FFFFFF'>$plano</td>
        <td align='center' bgcolor='#FFFFFF'>$valor </td>
        <td align='center' bgcolor='#FFFFFF'>$brasileirao</td>
        <td align='center' bgcolor='#FFFFFF'>$estadual </td>
      </tr>
      <tr>
        <td colspan='5' align='left' bgcolor='#FFFFFF'><h3>Observação:</h3></td>
        </tr>
      <tr>
        <td colspan='5' align='left' bgcolor='#FFFFFF'>$obs</td>
        </tr>
      <tr>
        <td colspan='5' align='center' bgcolor='#FFFFFF'><h1>Dados para pagamento:</h1></td>
      </tr>
      <tr>
        <td colspan='5' align='left' bgcolor='#FFFFFF'><h3>Se o pagamento for no cartão de crédito</h3></td>
        </tr>
      <tr>
        <td align='left' bgcolor='#FFFFFF'><strong>Nº do cartão:</strong></td>
        <td align='left' bgcolor='#FFFFFF'><strong>Validade:</strong></td>
        <td align='left' bgcolor='#FFFFFF'><strong>Nome impresso:</strong></td>
        <td align='left' bgcolor='#FFFFFF'><strong>Código segurança:</strong></td>
        <td align='left' bgcolor='#FFFFFF'><strong>Bandeira:</strong></td>
      </tr>
      <tr>
        <td align='left' bgcolor='#FFFFFF'>$cartao</td>
        <td align='left' bgcolor='#FFFFFF'>$validade</td>
        <td align='left' bgcolor='#FFFFFF'>$nome_impressor_cartao</td>
        <td align='left' bgcolor='#FFFFFF'>$cosigo_s_cartao</td>
        <td align='left' bgcolor='#FFFFFF'>$bandeira</td>
      </tr>
      <tr>
        <td colspan='5' align='left' bgcolor='#FFFFFF'><h3>Débito em conta corrente:</h3></td>
        </tr>
      <tr>
        <td align='left' bgcolor='#FFFFFF'>&nbsp;</td>
        <td align='left' bgcolor='#FFFFFF'><strong>Banco:</strong></td>
        <td align='left' bgcolor='#FFFFFF'><strong>Agência:</strong></td>
        <td align='left' bgcolor='#FFFFFF'><strong>Conta corrente:</strong></td>
        <td align='left' bgcolor='#FFFFFF'>&nbsp;</td>
      </tr>
      <tr>
        <td align='left' bgcolor='#FFFFFF'>&nbsp;</td>
        <td align='left' bgcolor='#FFFFFF'>$banco</td>
        <td align='left' bgcolor='#FFFFFF'>$agencia</td>
        <td align='left' bgcolor='#FFFFFF'>$conta_corrente</td>
        <td align='left' bgcolor='#FFFFFF'>&nbsp;</td>
      </tr>
    </table>      <a href='http://www.saldaodachina.com.br'><img src='http://www.easyloan.com.br/sky_sound_dt/sistema/sky/site.png' width='800' height='60' border='0'></a></td>
  </tr>
  <tr>
    <td bgcolor='#FFFFFF'><p>Qualquer dúvida é só me enviar um e-mail = marcrodress@gmail.com Telefone: (85) 3315.6219/9233.0928/8932.1649</p></td>
  </tr>
  </table>
<br>\n";
 
$mail->Subject = "Assinatura de um novo cliente Sky - Easy Loan Financial Services";
//adicionando o html no corpo do email
$mail->Body = $msg;
//enviando e retornando o status de envio
if(!$mail->Send())
{
echo "Ocorreru um erro, tente novamente!".$mail->ErrorInfo;
//$mail->ErrorInfo informa onde ocorreu o erro 

exit;
}

				
 }
}
?>
</body>
</html>