<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-885-1" />
<link href="css/verificar_pagamento_loja_online.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="box">
<? require "../config.php"; ?>

<? if(isset($_POST['button'])){

$comentario = $_POST['comentario'];
$resultado = $_POST['resultado'];
$code_carrinho = $_GET['carrinho'];
$cliente = $_GET['cliente'];
$produto = $_GET['produto'];

$email_cliente = 0;
$nome_cliente = 0;

$sql_email = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '$cliente'");
while($res_email = mysqli_fetch_array($sql_email)){
		$email_cliente = $res_email['email'];
		$nome_cliente = $res_email['nome'];
	}

$titulo = 0;
$quantidade = 0;
$vlunitario = 0;
$vltotal = 0;
$img = 0;



$sql_carrinho = mysqli_query($conexao_bd, "SELECT * FROM loja_online_carrinho WHERE code_carrinho = '$code_carrinho'");
while($res_carrinho = mysqli_fetch_array($sql_carrinho)){
	  $quantidade = $res_carrinho['quantidade'];
	  $vlunitario = number_format($res_carrinho['valor_unitario'],2,',','.');
	  $vltotal = number_format($res_carrinho['valor_total'],2,',','.');
	}

$sql_produto = mysqli_query($conexao_bd, "SELECT * FROM loja_online_produto WHERE id = '$produto'");
while($res_produto = mysqli_fetch_array($sql_produto)){
	  $titulo = $res_produto['titulo'];
	  $img = $res_produto['img'];
	}



mysqli_query($conexao_bd, "UPDATE loja_online_carrinho SET status = '$resultado', status_pagamento = '$resultado', status_entrega = '$resultado', comentario_pagamento = '$comentario', data_comentario_pagamento = '$data' WHERE code_carrinho = '$code_carrinho'");

echo "<em>Informação de pagamento enviado com sucesso!!!</em>";


include("../phpmailer/class.phpmailer.php");

$mail = new PHPMailer();
$mail->IsMAIL(); 
$mail->Host = "mail.ikuly.com"; 
$mail->SMTPAuth = true; 
$mail->Username = "suporte@ikuly.com"; 
$mail->Password = "Rcbv896xw*"; // senha
$mail->From = "suporte@ikuly.com";
$mail->FromName = "VESTE PRIME LOJA ONLINE";
$mail->AddAddress("$email_cliente,vesteprime@gmail.com","VESTE PRIME LOJA ONLINE");
$mail->WordWrap = 500; 
$mail->AddAttachment("anexo/arquivo.zip"); 
$mail->AddAttachment("imagem/foto.jpg");
$mail->IsHTML(true); //enviar em HTML


	$mail->AddReplyTo("$email_cliente,vesteprime@gmail.com","$nome_cliente");
	$msg  = "";
	$msg .= "


<table width='800' align='center' style='border:20px solid #09C; border-radius:30px; padding:0;' border='0'>
  <tr>
    <td colspan='6'  align='center' bgcolor='#6699CC' style='border:2px solid #FC0; border-radius:1000px; margin:-5px 0 0 0;'><span style='font:30px Arial, Helvetica, sans-serif; color:#FC0;; font-family: Arial, Helvetica, sans-serif; font-size: 30px'><strong>Olá $nome_cliente, temos notícias sobre o pagamento do seu produto!</strong></span></td>
  </tr>
  <tr>
    <td colspan='6'  align='center' bgcolor='#003366' style='border:2px solid #099; border-radius:1000px; margin:0; padding:0;'><h2 style='font:15px Arial, Helvetica, sans-serif; text-align:center; color:#0CF;'>CÓDIGO DO PEDIDO: $code_carrinho</h2></td>
  </tr>
  <tr>
    <td width='125' rowspan='3' align='center' bgcolor='#FFFFFF'><h1 style='font:15px Arial, Helvetica, sans-serif; color:#0FC; padding:0; margin:0;'><img src='$img' width='116' height='83'></h1></td>
    <td colspan='5' align='center' bgcolor='#F5FFEC'><h1>$titulo</h1></td>
  </tr>
  <tr>
    <td width='83' align='center' bgcolor='#CCCCCC'><p style='font:12px Arial, Helvetica, sans-serif; color:#000; font-size: 10px'><strong>QUANT.</strong></p></td>
    <td width='101' align='center' bgcolor='#CCCCCC'><p style='font:12px Arial, Helvetica, sans-serif; color:#000; font-size: 10px'><strong>VL. UNIT.</strong></p></td>
    <td width='108' align='center' bgcolor='#CCCCCC'><p style='font:12px Arial, Helvetica, sans-serif; color:#000; font-size: 10px'><strong>VL. TOTAL</strong></p></td>
    <td width='153' align='center' bgcolor='#CCCCCC'><p style='font:12px Arial, Helvetica, sans-serif; color:#000; font-size: 10px'><strong>PAGAMENTO</strong></p></td>
    <td width='190' align='center' bgcolor='#CCCCCC'><p style='font:12px Arial, Helvetica, sans-serif; color:#000; font-size: 10px'><strong>STATUS DA ENTREGA</strong></p></td>
  </tr>
  <tr>
    <td align='center' bgcolor='#FFFFFF'>$quantidade</td>
    <td align='center' bgcolor='#FFFFFF'>R$ $vlunitario</td>
    <td align='center' bgcolor='#FFFFFF'>R$ $vltotal</td>
    <td align='center' bgcolor='#FFFFFF'><span style='font:12px Arial, Helvetica, sans-serif; color:#000; font-size: 10px; font-family: Arial, Helvetica, sans-serif'>$resultado</span></td>
    <td align='center' bgcolor='#FFFFFF'><span style='font:12px Arial, Helvetica, sans-serif; color:#000; font-size: 10px; font-family: Arial, Helvetica, sans-serif'>$resultado</span></td>
  </tr>
  <tr>
    <td colspan='6' align='LEFT' bgcolor='#FFFFFF'><hr>
      <p style='font:12px Arial, Helvetica, sans-serif; color:#000; font-size: 10px'><strong>INFORMAÇÕES SOBRE O PAGAMENTO</strong></p>
      <p style='font:12px Arial, Helvetica, sans-serif; color:#000; font-size: 10px'> $comentario     </p></td>
  </tr>
  <tr>
    <td colspan='6' align='LEFT' bgcolor='#FFFFFF'><hr>
      <p style='font:12px Arial, Helvetica, sans-serif; color:#000; font-size: 10px'><strong>INFORMAÇÕES SOBRE A ENTREGA</strong></P>
    <p style='font:12px Arial, Helvetica, sans-serif; color:#000; font-size: 10px'> Prezado,</P>
    <p style='font:12px Arial, Helvetica, sans-serif; color:#000; font-size: 10px'>O prazo máximo de entrega depende da confirmação do pagamento, e poderá ser alterado de acordo com a disponibilidade do estoque.</P></td>
  </tr>
  <tr>
    <td colspan='6' align='center' bgcolor='#FFFFFF'><hr>
      <p style='font:15px Arial, Helvetica, sans-serif; color:#09C;'>*Solicite seu cartão de crédito, é fácil, rápido e sem burocracia.</p>
      <img style='border-radius:10px; border:5px solid #069;' src='http://ikuly.com/caixa/img/veste_prime_card.jpg' alt='' width='260' height='160' />
      <p><img src='http://www.acim.com.br/wp-content/uploads/2016/03/spc-site.png' width='120' height='60' /><img src='https://upload.wikimedia.org/wikipedia/commons/thumb/3/30/SerasaExperian-TM_Portrait_RGB.svg/383px-SerasaExperian-TM_Portrait_RGB.svg.png' width='120' height='60' />      </p>
<p style='font:10px Arial, Helvetica, sans-serif; color:#F00; font-size: 10px'><strong>AVISO:</strong> Ao solicitar o crédito, o mesmo passará por analise de risco e o envio deste e-mail não garante aprovação. </p></td>
  </tr>
  <tr>
    <td colspan='6'><hr /></td>
  </tr>
  <tr>
    <td colspan='6' align='justify' bgcolor='#999999' style='border:2px solid #066; border-radius:10px; margin:-5px 0 0 0;'><h4 style='font:11px Arial, Helvetica, sans-serif; color:#CCC; padding:0 5px 0 5px;'>Consultas, informações, transações, acesse www.vesteprime.com.br ou ligue  (85) 99158.7323 (demais localidades, somente chamadas de telefone fixo), de segunda a domingo, das 8h às 17h (exceto feriados nacionais). Reclamações, cancelamentos e informações gerais, ligue para o (85) 99158.7323, todos os dias, 24 horas por dia. Se não ficar satisfeito com a solução apresentada, contate a Ouvidoria: (85) 99158.7323, em dias úteis, das 9h às 18h.</h4></td>
  </tr>
  <tr>
    <td colspan='6' align='center' bgcolor='#FFFFFF' style='border:2px solid #066; border-radius:10px;><h3 style='font:12px Arial, Helvetica, sans-serif;'><em>*Crédito sujeito a análise de risco.</em><br><em>Mensagem automática, por favor, não responder.</em></td>
  </tr>
</table>


	<br>\n";
 
$mail->Subject = "NOVIDADE SOBRE O PAGAMENTO DO PRODUTO: $titulo!";
//adicionando o html no corpo do email
$mail->Body = $msg;
//enviando e retornando o status de envio
if(!$mail->Send())
{
echo "Ocorreru um erro, tente novamente!".$mail->ErrorInfo;
//$mail->ErrorInfo informa onde ocorreu o erro 

exit;
}


die;

}?>
<form name="" method="post" action="" enctype="multipart/form-data">
 <table width="950" border="0">
  <tr>
    <td colspan="10" align="center" bgcolor="#CCCCCC"><strong>HISTÓRICO DE PAGAMENTO</strong></td>
  </tr>
  <tr>
    <td width="168" bgcolor="#E1EBF4"><strong>FORMA DE PAGAMENTO</strong></td>
    <td width="76" bgcolor="#E1EBF4"><strong>DATA</strong></td>
    <td width="62" bgcolor="#E1EBF4"><strong>STATUS</strong></td>
    <td width="79" bgcolor="#E1EBF4"><strong>VALOR</strong></td>
    <td width="89" bgcolor="#E1EBF4"><strong>BANDEIRA</strong></td>
    <td width="60" bgcolor="#E1EBF4"><strong>PARCELA</strong></td>
    <td width="179" bgcolor="#E1EBF4"><strong>NÚMERO DO CARTÃO</strong></td>
    <td width="78" bgcolor="#E1EBF4"><strong>VENCIMENTO</strong></td>
    <td width="31" bgcolor="#E1EBF4"><strong>CCV</strong></td>
    <td width="86" bgcolor="#E1EBF4"><strong>AÇÕES</strong></td>
  </tr>
<?
$sql_pagamentos = mysqli_query($conexao_bd, "SELECT * FROM loja_online_pagamentos WHERE code_carrinho = '".$_GET['carrinho']."'");
while($res_pagamentos = mysqli_fetch_array($sql_pagamentos)){
?>
  <tr>
    <td><? echo $res_pagamentos['forma_pagamento']; ?></td>
    <td><? echo $res_pagamentos['data']; ?></td>
    <td><? echo $res_pagamentos['status']; ?></td>
    <td>R$ <? echo number_format($res_pagamentos['valor'],2,',','.'); ?></td>
    <td><? echo $res_pagamentos['bandeira']; ?></td>
    <td><? echo $res_pagamentos['parcela']; ?></td>
    <td><? echo $res_pagamentos['numero_cartao']; ?></td>
    <td><? echo $res_pagamentos['vencimento']; ?></td>
    <td><? echo $res_pagamentos['ccv']; ?></td>
    <td>
    <? if($res_pagamentos['status'] != 'APROVADO'){ ?>
     <a href="?pg=aprovar&id=<? echo $res_pagamentos['id']; ?>&carrinho=<? echo $_GET['carrinho'] ?>&resultado=APROVADO&cliente=<? $_GET['cliente']; ?>&produto=<? echo $_GET['produto'] ?>"><img src="../img/correto.jpg" width="20" height="20" title="APROVAR PAGAMENTO" /></a>
    <? } ?> 

    <? if($res_pagamentos['status'] == 'APROVADO'){ ?>    
     <a href="?pg=aprovar&id=<? echo $res_pagamentos['id']; ?>&carrinho=<? echo $_GET['carrinho'] ?>&resultado=REPROVADO&cliente=<? $_GET['cliente']; ?>&produto=<? echo $_GET['produto'] ?>"><img src="../img/bloquea.png" width="20" height="20" /></a>
    <? } ?> 

     <a href="?pg=excluir&id=<? echo $res_pagamentos['id']; ?>&carrinho=<? echo $_GET['carrinho'] ?>&resultado=REPROVADO&cliente=<? $_GET['cliente']; ?>&produto=<? echo $_GET['produto'] ?>"><img src="../img/deleta.jpg" width="18" height="18" /></a>

    </td>
  </tr>
<? } ?> 
  <tr>
    <td colspan="10" bgcolor="#E1EBF4"><strong>COMENT&Aacute;RIO SOBRE O PAGAMENTO</strong></td>
    </tr>
  <tr>
    <td colspan="10"><label for="textarea"></label>
      <textarea name="comentario" id="textarea" cols="100" rows="5"></textarea></td>
  </tr>
  <tr>
    <td colspan="10" bgcolor="#E1EBF4"><strong>RESULTADO DA ANALISE DO PAGAMENTO</strong></td>
  </tr>
  <tr>
    <td colspan="10"><label for="select"></label>
      <select name="resultado" size="1" id="select">
        <option value="APROVADO">APROVADO</option>
        <option value="PENDENTE">REPROVADO</option>
      </select></td>
  </tr>
  <tr>
    <td colspan="10"><hr /><input type="submit" name="button" id="button" value="ENVIAR" /></td>
  </tr>
 </table>
</form>
</div><!-- box -->
















<? if($_GET['pg'] == 'excluir'){

$carrinho = $_GET['carrinho'];
$resultado = $_GET['resultado'];
$cliente = $_GET['cliente'];
$produto = $_GET['produto'];

$sql = mysqli_query($conexao_bd, "DELETE FROM loja_online_pagamentos WHERE id = '".$_GET['id']."'");

echo "<script language='javascript'>window.location='?carrinho=$carrinho&cliente=$cliente&produto=$produto';</script>";

}?>

<? if($_GET['pg'] == 'aprovar'){

$carrinho = $_GET['carrinho'];
$resultado = $_GET['resultado'];
$cliente = $_GET['cliente'];
$produto = $_GET['produto'];


$sql = mysqli_query($conexao_bd, "UPDATE loja_online_pagamentos SET status = '$resultado' WHERE id = '".$_GET['id']."'");

echo "<script language='javascript'>window.location='?carrinho=$carrinho&cliente=$cliente&produto=$produto';</script>";

}?>
</body>
</html>