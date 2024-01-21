<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/resultado_de_emprestimo_carne.css" rel="stylesheet" type="text/css" />
</head>

<body>
<? require "topo.php";  require "scripts/verificador_caixa.php"; ?>
<div id="box_pagamento_1">
<? if($_GET['pg'] == 'detalhe'){ ?>
<h1 style="font:15px Arial, Helvetica, sans-serif; margin:10px;"><strong>N da propósta: <? echo $n_proposta = $_GET['code']; ?></strong> - <a style="padding:5px; background:#090; border:2px solid #000; font:10px Arial, Helvetica, sans-serif; text-decoration:none; color:#FFF;" href="resultado_emprestimo_carne.php">Voltar</a></h1>
<hr />
<?

$sql_emprestimo = mysqli_query($conexao_bd, "SELECT * FROM emprestimo_boleto WHERE n_proposta = '$n_proposta'");
while($res_emprestimo = mysqli_fetch_array($sql_emprestimo)){
?>
<table width="990" border="0">
  <tr>
    <td colspan="5" align="center" bgcolor="#CCCCCC"><h1 style="font:20px Arial, Helvetica, sans-serif;"><strong>DADOS DO EMPRÉSTIMO</strong></h1></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#666666"><strong>CLIENTE</strong></td>
    <td width="127" bgcolor="#666666"><strong>CPF</strong></td>
    <td width="127" bgcolor="#666666"><strong>DATA</strong></td>
    <td width="127" bgcolor="#666666"><strong>TELEFONE</strong></td>
  </tr>
  <tr>
    <td colspan="2"><? echo $res_emprestimo['nome']; ?></td>
    <td><? echo $res_emprestimo['cpf']; ?></td>
    <td><? echo $res_emprestimo['data']; ?></td>
    <td><? echo $res_emprestimo['telefone']; ?></td>
  </tr>
  <tr>
    <td width="99" bgcolor="#666666"><strong>VALOR SOLICITADO</strong></td>
    <td width="89" bgcolor="#666666"><strong>N. PARCELA</strong></td>
    <td bgcolor="#666666"><strong>VL. PARCELA</strong></td>
    <td bgcolor="#666666"><strong>TAXA</strong></td>
    <td bgcolor="#666666"><strong>VL. TOTAL</strong></td>
  </tr>
  <tr>
    <td>R$ <? echo number_format($res_emprestimo['valor'],2,',','.'); ?></td>
    <td><? echo $res_emprestimo['quant_parcela']; ?></td>
    <td>R$ <? echo number_format($res_emprestimo['valor_parcela'],2,',','.'); ?></td>
    <td><? echo $res_emprestimo['juros']; ?>%</td>
    <td>R$ <? echo number_format($res_emprestimo['valor_total'],2,',','.'); ?></td>
  </tr>
  <tr>
    <td bgcolor="#666666"><strong>VENCIMENTO</strong></td>
    <td bgcolor="#666666"><strong>FORM. PAGAMENTO</strong></td>
    <td bgcolor="#666666"><strong>BANCO</strong></td>
    <td bgcolor="#666666"><strong>TIPO DE CONTA</strong></td>
    <td bgcolor="#666666"><strong>AGÊNCIA/CONTA</strong></td>
  </tr>
  <tr>
    <td><? echo $res_emprestimo['vencimento']; ?></td>
    <td><? echo $res_emprestimo['forma_pagamento']; ?></td>
    <td><? echo $res_emprestimo['banco']; ?></td>
    <td><? echo $res_emprestimo['tipo_conta']; ?></td>
    <td><? echo $res_emprestimo['agencia']; ?> / <? echo $res_emprestimo['conta']; ?></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#666666"><strong>OPERADOR:</strong> <? echo $res_emprestimo['operador']; ?></td>
    <td bgcolor="#666666"><strong>OPERADOR:</strong> <br />
      <? echo $res_emprestimo['operador']; ?></td>
    <td bgcolor="#666666"><strong>FIADOR:</strong> <br />
      <? echo $res_emprestimo['cpf_fi']; ?></td>
    <td bgcolor="#666666"><strong>ADMINISTRA&Ccedil;&Atilde;O DE CONTRATO</strong><br />
      <? if($res_emprestimo['status'] == 'APROVADO'){ ?>
      <a target="_blank" href="scripts/imprimir_contrato_carne.php?cpf=<? echo $res_emprestimo['cpf']; ?>&amp;n_proposta=<? echo $res_emprestimo['n_proposta']; ?>"><img src="img/cadastro.fw.png" alt="" width="20" height="20" border="0" title="IMPRIMIR CONTRATO" /></a> <a target="_blank" href="scripts/boletos_carne_emprestimo.php?proposta=<? echo $n_proposta; ?>" title="Emitir carn&ecirc; completo"><img src="img/carne_pagamento.png" width="18" height="20" border="0" /></a> <a  target="_blank" href="scripts/capa_boletos_carne_emprestimo.php?proposta=<? echo $n_proposta; ?>" title="Emitir carn&ecirc; completo"><img src="img/capa_carne.png" width="18" height="20" border="0" /></a>
      <? } ?>
      <? if($_GET['pgc'] == 'confirmar_credito'){

			$code = $_GET['code'];
			
			mysqli_query($conexao_bd, "UPDATE emprestimo_boleto SET sit_liberacao = 'CONFIRMADO' WHERE id = '".$_GET['id']."'");
			echo "<script language='javascript'>window.alert('Confirma&ccedil;&atilde;o enviada com sucesso! O Credito na conta do cliente ocorrer&aacute; em no m&aacute;ximo 72 horas &uacute;teis');window.location='?pg=detalhe&code=$code';</script>";
        
	    }?>
      <? if($res_emprestimo['status'] == 'APROVADO' && $res_emprestimo['contrato'] == ''){ ?>
      <a rel="superbox[iframe][300x250]" href="scripts/upload_contrato_emprestimo_carne.php?id=<? echo $res_emprestimo['id']; ?>"><img src="img/upload.png" alt="" width="20" height="20" border="0" title="ENVIAR CONTRATO" /></a>
      <? } ?>
      <? if($res_emprestimo['contrato'] !== '' && $res_emprestimo['status'] == 'APROVADO' && $res_emprestimo['sit_liberacao'] == 'AGUARDA'){ ?>
      <script language="JavaScript" type="text/javascript">
        function confirmacao(id) {
             var resposta = confirm("Tem certeza que todos os dados est&atilde;o corretos e o contrato devidamente assinado?");
         
             if (resposta == true) {
                  window.location.href = "?pg=detalhe&pgc=confirmar_credito&code=<? echo $_GET['code']; ?>&id="+id;
             }
        }
        </script>
      <a href="javascript:func()" onclick="confirmacao('<? echo $res_emprestimo['id']; ?>')"><img src="img/correto.fw.png" width="18" height="18" border="0" title="AUTORIZAR LIBERA&Ccedil;&Atilde;O DO CR&Eacute;DITO" /></a>
      <? } ?></td>
  </tr>
  <? if($tipo == 'ADM' && $res_emprestimo['status'] == 'Aguarda'){ ?>
  
  <? if(isset($_POST['button'])){
   
   $status = $_POST['status'];
   mysqli_query($conexao_bd, "UPDATE emprestimo_boleto SET status = '$status' WHERE n_proposta = '$n_proposta'");
   echo "<script language='javascript'>window.location='';</script>";

  
  }?>
  
  <form name="" method="post" enctype="multipart/form-data">
  <tr>
    <td colspan="5" bgcolor="#FFFFFF"><strong>RESULTADO DA ANALISE<br />
      <select name="status" size="1" id="select">
        <option value="APROVADO">APROVADO</option>
        <option value="NEGADO">NEGADO</option>
      </select>
      <input type="submit" name="button" id="button" value="Enviar" />
    </strong></td>
  </tr>
  </form>
  <? } ?>
  
  
 <? if($res_emprestimo['status'] == 'APROVADO' || $tipo == 'ADM'){ ?>
  
  
  <tr>
    <td colspan="5" bgcolor="#232323"><table class="td" width="970" align="center" border="0">
      <tr>
        <td colspan="11" bgcolor="#333333"><strong><span style="font-family: Arial, Helvetica, sans-serif; font-size: 20px">PARCELAS</span></strong></td>
      </tr>
      <tr>
        <td width="62" bgcolor="#666666"><strong>PARCELA</strong></td>
        <td width="54" bgcolor="#666666"><strong>STATUS</strong></td>
        <td width="59" bgcolor="#666666"><strong>VALOR</strong></td>
        <td width="50" bgcolor="#666666"><strong>MULTA</strong></td>
        <td width="46" bgcolor="#666666"><strong>JUROS</strong></td>
        <td width="48" bgcolor="#666666"><strong>SALDO</strong></td>
        <td width="245" bgcolor="#666666"><strong>COD. BARRAS</strong></td>
        <td width="89" bgcolor="#666666"><strong>LOCALIZADOR</strong></td>
        <td width="81" bgcolor="#666666"><strong>VENCIMENTO</strong></td>
        <td width="67" bgcolor="#666666"><strong>PAGT.</strong></td>
        <td width="123" bgcolor="#666666">
        <a target="_blank" href="scripts/boletos_carne_emprestimo.php?proposta=<? echo $n_proposta; ?>" title="Emitir carnê completo"><img src="img/carne_pagamento.png" width="18" height="20" border="0" /></a>
        <a  target="_blank" href="scripts/capa_boletos_carne_emprestimo.php?proposta=<? echo $n_proposta; ?>" title="Emitir carnê completo"><img src="img/capa_carne.png" width="18" height="20" border="0" /></a>
        </td>
      </tr>
 <? 
 $sql_parcela = mysqli_query($conexao_bd, "SELECT * FROM boletos_emprestimo_boleto WHERE proposta = '$n_proposta'");
 for($i=1; $i<=mysqli_num_rows($sql_parcela); $i++){
	 $sql_parcelas = mysqli_query($conexao_bd, "SELECT * FROM boletos_emprestimo_boleto WHERE proposta = '$n_proposta' AND parcela = '$i'"); 
	 while($res_parcela = mysqli_fetch_array($sql_parcelas)){
 ?>
	  <tr <? if($i%2 == 0){ echo "bgcolor='#444'"; }else{ echo "bgcolor='#222'"; } ?>>
        <td><h5><? echo $res_parcela['parcela']; ?></h5></td>
        <td><h5><? echo $res_parcela['status']; ?></h5></td>
        <td><h5>R$ <? echo number_format($res_parcela['valor'],2,',','.'); ?></h5></td>
        <td>
		<h4><? 
		$multa = 0;
		if($res_parcela['status'] == 'AGUARDA' && $code_vencimento_hoje > $res_parcela['vencimento']){
			$multa = $res_parcela['valor']*0.0999;
			echo number_format($multa,2,',','.');
		}
		?></h4>
        </td>
        <td>
		<h4><? 
		$juros = 0;
		if($res_parcela['status'] == 'AGUARDA' && ($code_vencimento_hoje > $res_parcela['vencimento'])){
			$juros = $res_parcela['valor']*0.003*($code_vencimento_hoje-$res_parcela['vencimento']);
			echo number_format($juros,2,',','.');
		}
		?></h4>
                </td>
        <td <? if($res_parcela['status'] == 'AGUARDA' && ($code_vencimento_hoje > $res_parcela['vencimento'])){ ?>bgcolor="#111"<? } ?>><h6 style="color:#0FF;"><? echo number_format($juros+$multa+$res_parcela['valor'],2,',','.'); ?></h6></td>
        <td>
        <? if($tipo == 'ADM'){ ?>
	        <a rel="superbox[iframe][800x250]" style="text-decoration:none; color:#FFF;" href="scripts/postar_codigo_emprestimo_carne.php?id=<? echo $res_parcela['id']; ?>&parcela=<? echo $res_parcela['parcela']; ?>&vencimento=<? echo $res_parcela['vencimento']; ?>&localizador=<? echo $res_parcela['localizador']; ?>&codigo_barras=<? echo $res_parcela['codigo_barras']; ?>"><? if($res_parcela['codigo_barras'] == ''){?> Postar código <? }else{echo $res_parcela['codigo_barras'];}; ?></a>
       
	   <? }else{ echo $res_parcela['codigo_barras']; } ?>
        
        
        
        </td>
        <td><h5><? echo $res_parcela['localizador']; ?></h5></td>
        <td><h5><? 
		
			$sql_vencimento = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento WHERE codigo = '".$res_parcela['vencimento']."'");
			 while($res_vencimento = mysqli_fetch_array($sql_vencimento)){
				 echo $res_vencimento['vencimento'];
			 }
		
		 ?></h5></td>
        <td><h5><? echo $res_parcela['data_pagamento']; ?></h5></td>
        <td>
        <a href="scripts/boleto_emprestimo.php?id=<? echo $res_parcela['id']; ?>&proposta=<? echo $res_parcela['proposta']; ?>" target="_blank"><img src="img/boletos.png" width="17" height="20" border="0" title="Emitir boleto de pagamento" /></a>
       
        <a href="?id=<? echo $res_parcela['id']; ?>&proposta=<? echo $res_parcela['proposta']; ?>&cpf=<? echo $res_parcela['cliente']; ?>&&pg=enviar_mail"><img src="img/email.png" width="17" height="20" border="0" /></a>
        
        <? if($tipo == 'ADM'){ ?>
        <?
        
		 $telefone_cliente = 0;
		 $sql_dados_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '".$res_parcela['cliente']."'");
		  while($res_dados = mysqli_fetch_array($sql_dados_cliente)){
			  $telefone_cliente = $res_dados['celular_1'];
		  }
		
		?>
        
        
         <a rel="superbox[iframe][270x250]" href="scripts/confirmar_pagamento_emprestimo_carne.php?id=<? echo $res_parcela['id']; ?>&valor=<? echo number_format($juros+$multa+$res_parcela['valor'],2); ?>&cpf=<? echo $res_parcela['cliente']; ?>&telefone_cliente=<? echo $telefone_cliente; ?>&<? echo $res_parcela['cliente']; ?>&parcela=<? echo $res_parcela['parcela']; ?>"><img src="img/dinheiro.png" width="20" height="20" border="0" title="Confirmar pagamento" /></a>
        <? } ?>
        
        </td>
      </tr>
      <? }} ?>
    </table></td>
    </tr>
    <? } ?>
</table>
<? } ?>
<? } // detalhe do empréstimo ?>




<? if($_GET['pg'] == ''){ ?>
<hr />
<h1 style="font:15px Arial, Helvetica, sans-serif; margin:10px; color:#CCC;"><strong>PROPOSTAS DE EMPRÉSTIMO NO CARNÊ</strong></h1>
<?
$soma_parcela = 0;
$sql_emprestimo = mysqli_query($conexao_bd, "SELECT * FROM emprestimo_boleto ORDER BY id DESC");
if(mysqli_num_rows($sql_emprestimo) == ''){
	echo "<script language='javascript'>window.alert('CLIENTE NÃO POSSUI EMPRÉSTIMO CONTRATADO!');window.location='carrinho.php';</script>";
}else{
?>
<table class="table" width="1000" border="0">
  <tr>
    <td width="83" bgcolor="#999999"><strong>PROPÓSTA</strong></td>
    <td width="69" bgcolor="#999999"><strong>DATA</strong></td>
    <td width="62" bgcolor="#999999"><strong>STATUS</strong></td>
    <td width="260" bgcolor="#999999"><strong>CLIENTE</strong></td>
    <td width="84" bgcolor="#999999"><strong>VALOR</strong></td>
    <td width="57" bgcolor="#999999"><strong>N&ordm;. PARCE.</strong></td>
    <td width="45" bgcolor="#999999"><strong>TAXA</strong></td>
    <td width="50" bgcolor="#999999"><strong>VENC.</strong></td>
    <td width="91" bgcolor="#999999"><strong>VL. PARCELA</strong></td>
    <td width="75" bgcolor="#999999"><strong>CPF</strong></td>
    <td width="68" bgcolor="#999999"><strong>OP&Ccedil;&Otilde;ES</strong></td>
  </tr>
  <? 
  $valor = 0;
  while($res_contratos = mysqli_fetch_array($sql_emprestimo)){ 

  
   
   $cl = 0;
   $sql_registrincao_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes_restricao_email WHERE cliente = '".$res_contratos['cpf']."'");
   if(mysqli_num_rows($sql_registrincao_cliente) == ''){
   	$cl = 1;
   }
   
  if($res_contratos['status'] == 'APROVADO' && $cl == 1 || $res_contratos['status'] == 'Aguarda' && $cl == 1){ $i++;
  $valor = $res_contratos['valor']+$valor;
  $soma_parcela = $res_contratos['valor_parcela']+$soma_parcela;  
  ?>
  <tr <? if($i%2 == 0){ echo "bgcolor='#888'"; }else{ echo "bgcolor='#333'"; } ?>>
    <td><? echo $res_contratos['n_proposta']; ?></td>
    <td><? echo $res_contratos['data']; ?></td>
    <td><? echo $res_contratos['status']; ?></td>
    <td><? 
	$sql_nome_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '".$res_contratos['cpf']."'");
		while($res_cliente = mysqli_fetch_array($sql_nome_cliente)){
			echo $res_cliente['nome'];
		}
	 ?></td>
    <td>R$ <? echo number_format($res_contratos['valor'],2,',','.'); ?></td>
    <td><? echo $res_contratos['quant_parcela']; ?></td>
    <td><? echo $res_contratos['juros']; ?>%</td>
    <td><? echo $res_contratos['vencimento']; ?></td>
    <td>R$ <? echo number_format($res_contratos['valor_parcela'],2,',','.'); ?></td>
    <td><? echo $res_contratos['cpf']; ?></td>
    <td>
    <? if($res_contratos['status'] == 'APROVADO' || $tipo == 'ADM'){ ?>
    <a href="?pg=detalhe&code=<? echo $n_proposta = $res_contratos['n_proposta']; ?>"><img src="img/cadastro.fw.png" width="20" height="20" border="0" title="DETALHES DO PAGAMENTO" /></a>
    <? } ?>
    
    
    
    <? if($res_contratos['status'] == 'AGUARDA'){ ?>
    <a href="?pg=cancela&id=<? echo $res_contratos['id']; ?>"><img src="img/bloquea.png" width="20" height="20" border="0" title="CANCELAR PROPOSTA DE CRÉDITO" /></a>
    <? } ?>
    
    
    
    </td>
  </tr>
  <? }} ?>
  
  <tr>
    <td colspan="4">&nbsp;</td>
    <td><strong>R$ <? echo number_format($valor,2,',','.'); ?></strong></td>
    <td colspan="3">&nbsp;</td>
    <td><strong>R$ <? echo number_format($soma_parcela,2,',','.'); ?></strong></td>
    <td colspan="2">&nbsp;</td>
    </tr>
</table>

<? } ?>


<? } // VERIFICAÇÃO DE PÁGINA  ?>



</div><!-- box_pagamento_1 -->

<? if($_GET['pg'] == 'cancela'){

$id_contrato = $_GET['id'];

mysqli_query($conexao_bd, "UPDATE emprestimo_boleto SET status = 'CANCELADO' WHERE id = '$id_contrato'");

echo "<script language='javascript'>window.alert('PROPÓSTA CANCELADA COM SUCESSO!');window.location='resultado_emprestimo_carne.php';</script>";

}?>

</body>
</html>



<? if($_GET['pg'] == 'enviar_mail'){
	
$cliente = $_GET['cpf'];	
$id = $_GET['id'];	
$proposta = $_GET['proposta'];	


$email_cliente = 0;
$nome_cliente = 0;
$sql_email_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '$cliente'");	
	while($res_email_cliente = mysqli_fetch_array($sql_email_cliente)){
		$email_cliente = strtolower($res_email_cliente['email']);
		$nome_cliente = strtoupper($res_email_cliente['nome']);
	}
	

include("phpmailer/class.phpmailer.php");

$mail = new PHPMailer();
$mail->IsMAIL(); 
$mail->Host = "mail.ikuly.com"; 
$mail->SMTPAuth = true; 
$mail->Username = "suporte@ikuly.com"; 
$mail->Password = "Rcbv896xw*"; // senha
$mail->From = "suporte@ikuly.com";
$mail->FromName = "BOLETO DO CRÉDITO PESSOAL CHEGOU!";
$mail->AddAddress("$email_cliente,vesteprime@gmail.com","VESTE PRIME CARD");
$mail->WordWrap = 500; 
$mail->AddAttachment("anexo/arquivo.zip"); 
$mail->AddAttachment("imagem/foto.jpg");
$mail->IsHTML(true); //enviar em HTML

	$mail->AddReplyTo("$email_cliente,vesteprime@gmail.com","$nome_cliente");
	$msg  = "";
	$msg .= "

<table width='800' align='center' style='border:20px solid #069; border-radius:50px; padding:10px;' border='0'>
  <tr>
    <td colspan='2'  align='center' bgcolor='#FFFFFF' style='border:2px solid #FC0; border-radius:1000px; margin:-5px 0 0 0;'><h1 style='font:12px Arial, Helvetica, sans-serif; color:#CCC;'><strong>CONTRATO:</strong> $proposta</h1></td>
  </tr>
  <tr>
    <td colspan='2' style='border:2px solid #099; border-radius:1000px; margin:-5px 0 0 0;'  align='center' bgcolor='#003366'><h2 style='font:15px Arial, Helvetica, sans-serif; color:#0CF;'>BOLETO DE CRÉDITO PESSOAL</h2></td>
  </tr>
  <tr>
    <td colspan='2' align='center'><h1 style='font:20px Arial, Helvetica, sans-serif; color:#CC0; padding:2px;'><strong>Olá, $nome_cliente!
    <br><br>
    Conforme solicitado, segue em anexo o boleto de seu crédito, pessoal.</strong></h1>
    <h1 style='font:20px Arial, Helvetica, sans-serif; color:#CC0; padding:2px;'><strong>Lembre-se, você deve pagar até o vencimento para evitar juros e multa.</strong></h1></td>
  </tr>
  <tr>
    <td colspan='2' align='center' bgcolor='#999999'><strong>CRÉDITO PESSOAL</strong></td>
  </tr>
  <tr>
    <td colspan='2' align='center'><p style='font:10px Arial, Helvetica, sans-serif;'>Para sua segurança, estamos enviando sua fatura por e-mail.</p>
    <p style='font:10px Arial, Helvetica, sans-serif;'>Evite pagar juros e multas, pague sua fatura em dias e evite a restrinção nos orgãos de proteção ao crédito, como o SPC e SARASA.</p></td>
  </tr>
  <tr>
    <td colspan='2' align='center'><a href='http://www.ikuly.com/caixa/scripts/boleto_emprestimo.php?id=$id&proposta=$proposta'><img src='http://ikuly.com/caixa/img/baixar_boleto.fw.png' alt='' width='272' height='78' border='0' /></a>
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
 
$mail->Subject = "BOLETO DO CRÉDITO PESSOAL CHEGOU!";
//adicionando o html no corpo do email
$mail->Body = $msg;
//enviando e retornando o status de envio
if(!$mail->Send())
{
echo "Ocorreru um erro, tente novamente!".$mail->ErrorInfo;
//$mail->ErrorInfo informa onde ocorreu o erro 

exit;
} // verifica se pode fechar a fatura
	
echo "<script language='javascript'>window.alert('BOLETO ENVIADO COM SUCESSO!');window.location='?pg=detalhe&code=$proposta';</script>";



}?>