,,<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/faturas.css" rel="stylesheet" type="text/css" />

</head>

<body>
<? require "topo.php";  require "scripts/verificador_caixa.php"; ?>

<div id="box_cliente">
 <? $nome_cliente = 0; $cliente = 0;
 $sql_carrinho = mysqli_query($conexao_bd, "SELECT * FROM carrinho WHERE ip = '$ip' AND status = 'Ativo' AND cliente != ''");
 if(mysqli_num_rows($sql_carrinho) == ''){
	echo "<script language='javascript'>window.location='carrinho.php';</script>";
 }else{
    while($res_carrinho = mysqli_fetch_array($sql_carrinho)){
		$cpf_cliente = $res_carrinho['cliente'];
		$cliente = $res_carrinho['cliente'];
		$code_carrinho = $res_carrinho['code_carrinho'];
		

		
	$sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente WHERE cliente = '$cpf_cliente'");
	if(mysqli_num_rows($sql_cliente) == ''){
	}else{
		while($res_cliente = mysqli_fetch_array($sql_cliente)){
			$cliente = $res_cliente['cliente'];
		
	$sql_nome_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '$cpf_cliente'");
	if(mysqli_num_rows($sql_nome_cliente) == ''){
	}else{
		while($res_nome_cliente = mysqli_fetch_array($sql_nome_cliente)){
			$nome_cliente = $res_nome_cliente['nome']
			
	
 ?>
 <h1><strong> CLIENTE: </strong><strong class="strong"><? echo $nome_cliente; ?></strong>
<strong>SEGM: </strong><strong class="strong"><? echo $res_cliente['categoria']; ?></strong>         <strong class="strong2"><strong>LIMITE DISPONIVEL:</strong></strong><strong class="strong">R$ <? echo $limite_loja_disponivel = number_format($res_cliente['limite_loja_disponivel'],2); ?></strong></h1>
 <h1><strong>SALDO: </strong><strong class="strong">R$ 
 <? 
  
 $saldo = number_format($res_cliente['saldo'],2);  
 $saldo2 = number_format($res_cliente['saldo'],2);  
 echo number_format($res_cliente['saldo'],2);
 
 if($saldo2 <0){
 	$saldo2 = 0;
 }else{
	 $saldo2 = $saldo2;
 }
 
 
 ?>
 </strong> <strong>FINANCIAMENTO: </strong><strong class="strong">R$ <? echo $disponivel_cheque_especial = number_format($res_cliente['disponivel_pagamento_contas'],2); ?></strong> <strong>CRÉD. PESSOAL:</strong><strong class="strong">R$ <? echo number_format($res_cliente['disponivel_credito_pessoal'],2); ?></strong> <strong>SAQUE:</strong><strong class="strong">R$ <? echo number_format($res_cliente['disponivel_saque_facil'],2); ?></strong></h1>
 <? }}}}}} ?>
 </div><!-- box_cliente -->




<div id="box_corpo">
 <div id="pagamento">
 <? if(isset($_POST['valor_pag'])){
 
 $pag_forma = $_POST['pag_forma'];
 $valor_pag = $_POST['valor_pag'];
 $code_fatura = 0;
 $valor_fatura = 0;
 $status_fatura = 0;
 $sit_pag = 0;
 $soma_pagamentos = 0;
 $pagamento_minimo = 0;
 $score = 0;

 
 
 if($valor_pag == ''){
	echo "<script language='javascript'>window.alert('Digite o valor do pagamento!');</script>";
  }else{
	mysqli_query($conexao_bd, "INSERT INTO pagamento_fatura (codeCaixa, turno, operador, ip, status, data, data_completa, dia, mes, ano, cliente, valor, forma_pagamento) VALUES ('$codeCaixa', '$turno', '$operador', '$ip', 'Aguarda', '$data', '$data_completa', '$dia', '$mes', '$ano', '$cliente', '$valor_pag', '$pag_forma')");
	

    $sql_verifica_ultima_fatura = mysqli_query($conexao_bd, "SELECT * FROM faturas_fechadas WHERE status = 'FECHADO' AND cliente = '$cliente' ORDER BY id DESC LIMIT 1");
		while($res_ultima_fatura = mysqli_fetch_array($sql_verifica_ultima_fatura)){
			$code_fatura = $res_ultima_fatura['code_fatura'];
			$valor_fatura = $res_ultima_fatura['valor'];
			$pagamento_minimo = $res_ultima_fatura['minimo'];
			$status_fatura = $res_ultima_fatura['status'];
			$saldo_fatura = $res_ultima_fatura['saldo'];
		}
	
	if($status_fatura == 'FECHADO'){
		$sql_verifica_pagamentos = mysqli_query($conexao_bd, "SELECT * FROM pagamento_fatura WHERE status = 'Aguarda' AND cliente = '$cliente'");
		while($res_pagamentos = mysqli_fetch_array($sql_verifica_pagamentos)){
		 	$soma_pagamentos = $soma_pagamentos+$res_pagamentos['valor'];
		 }
		if($soma_pagamentos >= $saldo_fatura){
			$sit_pag = "PAGO";
			mysqli_query($conexao_bd, "UPDATE faturas_fechadas SET sit_juros = 'NAO' WHERE code_fatura = '$code_fatura' AND cliente = '$cliente'");
		}else{
			$sit_pag = "PAGO PARCIALMENTE";
		}
		
		$saldo_restante = $saldo_fatura-$soma_pagamentos;
				
		if($saldo_restante <=0){
			$saldo_restante = 0;
		}else{
			$saldo_restante = $saldo_restante;
		}
		
		mysqli_query($conexao_bd, "UPDATE faturas_fechadas SET sit_pag = '$sit_pag', saldo = '$saldo_restante' WHERE code_fatura = '$code_fatura' AND cliente = '$cliente'");
		
	}else{
	}
	
	$verifica_limite_usado = 0;
	$limite_credito = 0;
	$limite_pagamento = 0;
	$novo_limite_pagamento = 0;
	$novo_limite_pagamento_atual = 0;
	$novo_limite = 0;
	$sobra_limite = 0;
	$situacao = 0;
	$situacao2 = 0;
	$status = 0;
	
	

$nome_cliente_sms = 0;
$telefone_cliente = 0;
$sql_email_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '$cliente'");	
	while($res_email_cliente = mysqli_fetch_array($sql_email_cliente)){
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

$valor_sms = number_format($valor_pag,2,',','.');
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
  CURLOPT_URL => "https://api.smsdev.com.br/v1/send?key=TZXZSWGNSZY51PZTLQ1SI772BRGA1FGQAKH16GEYTWKMUBSHF2K5D4O4REAUCWD2KG686DRENLFCJZKQT0FEJ4V1YSVICR1DCRU1PJW2OZIW48VKFQ8V084I82QJ5SSZ&type=9&number=$telefone_cliente&msg=".urlencode("VESTE PRIME: $nome_cliente_sms, recebemos R$ $valor_sms referente ao pagamento de sua fatura. Obrigado!
  
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
	
	
	$sql_altera_limite = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente WHERE cliente = '$cliente'");
		while($res_altera_limite = mysqli_fetch_array($sql_altera_limite)){
			$limite_atual = $res_altera_limite['limite_loja_disponivel']+0;
			$limite_credito = $res_altera_limite['limite_loja']+0;
			$limite_pagamento = $res_altera_limite['disponivel_pagamento_contas']+0;
			$pagamento_contas = $res_altera_limite['pagamento_contas']+0;
			$score = $res_altera_limite['score'];
			$status = $res_altera_limite['status'];
			$situacao2 = $res_altera_limite['proposta_credito'];
			
			 $novo_limite = $valor_pag+$limite_atual;
			 
			if($novo_limite > $limite_credito){
			   $sobra_limite = $novo_limite-$limite_credito;
			   
			   
			   $novo_limite_pagamento = $limite_pagamento+$sobra_limite;
			   if($novo_limite_pagamento > $limite_pagamento){
				   $novo_limite_pagamento = $limite_pagamento;
			   }
			   
			   
			   $novo_limite = $limite_credito;
			   
			}else{
				$novo_limite = $novo_limite;
				$novo_limite_pagamento = $novo_limite_pagamento;
			}
			
			if($valor_pag >= $pagamento_minimo){
				if($status == 'CANCELADO'){
				$situacao = 'CANCELADO';				
				}else{
				$situacao = 'ATIVO';
				$situacao2 = 'APROVADO';
				}
			}else{
				if($status == 'CANCELADO'){
					$situacao = 'CANCELADO';				
				}else{
				$situacao = 'BLOQUEADO';
				}
				$score = $score-($valor_pag*10);
			}
			
			
			
		$score = 0;
		$sql_score = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente WHERE cliente = '$cliente'");
		 while($res_score = mysqli_fetch_array($sql_score)){
			 $score = $res_score['score'];
		 }
		  
		 mysqli_query($conexao_bd, "INSERT INTO score (operador, tipo, data, dia, mes, ano, cliente, descricao, pontos) VALUES ('$operador', 'CREDITO', '$data', '$dia', '$mes', '$ano', '$cliente', 'PAGAMENTO DE FATURA', '".$valor_pag*0.3."')");
		 
		 $score = $score+30;
		 mysqli_query($conexao_bd, "UPDATE conta_corrente SET score = '$score' WHERE cliente = '$cliente'");			
			
			
		 mysqli_query($conexao_bd, "UPDATE conta_corrente SET limite_loja_disponivel = '$novo_limite', disponivel_pagamento_contas = '$novo_limite_pagamento', score = '$score', status = '$situacao', proposta_credito = '$situacao2' WHERE cliente = '$cliente'");
			
		}
	
	
?>
  
    <script language="javascript">
		function abrePopUp(urlImagem){
			window.open(urlImagem,'Foto_Ampliada','top=150,left=500,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=335,height=400');
		}
	</script>
<a onclick="abrePopUp('scripts/imprimir_comprovante_pagamento_easy_card.php?cliente=<? echo $cliente; ?>&valor=<? echo $valor_pag; ?>');" href="">IMPRIMIR COMPROVANTE DE PAGAMENTO</a>

<? die; } }?>
 <form name="" method="post" action="" enctype="multipart/form-data">
 <h1><strong>FORMA DE PAGAMENTO</strong></h1><br />
 <select name="pag_forma" size="1">
   <option value="DINHEIRO">1 - DINHEIRO</option>
   <option value="TRANSFERENCIA">2 - PIX/TRANSFER&Ecirc;NCIA</option>
 </select> 
 <input name="valor_pag" type="text"  value="" />
 </form>
 <hr />
 </div><!-- pagamento -->
 
 <div id="box_compras">
<table width="500" border="0">
  <tr>
    <td colspan="5" bgcolor="#FEE9F7">
    <a style="font:10px Arial, Helvetica, sans-serif;" rel="superbox[iframe][915x600]" href="scripts/historico_faturas.php?cliente=<? echo $cliente; ?>">Históricos de faturas </a>  |  
    
    <a style="font:10px Arial, Helvetica, sans-serif;" rel="superbox[iframe][930x600]" title="Útimas compras" href="scripts/historico_compras.php?cliente=<? echo $cliente; ?>">ÚLTIMOS COMPRAS</a>
    
    
    <img src="img/bb.png" width="420" height="1" /><br />
    <strong>LANÇAMENTOS FUTUROS</strong></td>
  </tr>
  <tr>
    <td bgcolor="#FFE8DD"><strong>DATA</strong></td>
    <td width="101" bgcolor="#FFE8DD"><strong>CARRINHO</strong></td>
    <td width="70" bgcolor="#FFE8DD"><strong>TIPO</strong></td>
    <td width="70" bgcolor="#FFE8DD"><strong>PARCELA</strong></td>
    <td width="76" bgcolor="#FFE8DD"><strong>VALOR</strong></td>
  </tr>
<?
$valor_fatura = 0;
$sql_lancamentos = mysqli_query($conexao_bd, "SELECT * FROM lancamento_fatura WHERE cliente = '$cliente' AND status = 'Ativo'");
if(mysqli_num_rows($sql_lancamentos) == ''){
}else{
	while($res_faturas = mysqli_fetch_array($sql_lancamentos)){
		$code_transacao = $res_faturas['code_transacao'];
		
 $sql_compras_parceladas = mysqli_query($conexao_bd, "SELECT * FROM compras_parceladas WHERE code_transacao = '$code_transacao' AND status = 'Aguarda' LIMIT 1");		
	while($res_compras_parceladas = mysqli_fetch_array($sql_compras_parceladas)){
?>
  <tr>
    <td><? echo $res_faturas['data']; ?></td>
    <td><? echo $res_faturas['code_carrinho']; ?></td>
    <td><? if($res_faturas['parcelado'] == ''){ echo "A vista"; }else{ echo "Parcelado"; } ?></td>
    <td><? echo $res_compras_parceladas['parcela']; ?>
    <? if($res_faturas['parcelado'] == 'SIM' && $res_compras_parceladas['n_parcela'] != $res_compras_parceladas['total_parcela'] && mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM compras_parceladas WHERE code_transacao = '$code_transacao' AND status = 'Aguarda'")) >1){ ?>
     <a rel="superbox[iframe][450x200]" href="scripts/adiantar_parcelas.php?id=<? echo $res_faturas['id']; ?>&code_transacao=<? echo $res_compras_parceladas['code_transacao']; ?>&parcela=<? echo $res_compras_parceladas['n_parcela']+1; ?>"><img src="img/adiantar.png" alt="" width="15" height="15" border="0" title="Adiantar parcelas" /></a>
     <? } ?>
     
    </td>
    <td><? echo number_format($res_compras_parceladas['valor_parcela'],2); $valor_fatura = $valor_fatura+$res_compras_parceladas['valor_parcela'];?></td>
  </tr>
<? }}} ?>
  <tr>
    <td colspan="4" align="right" bgcolor="#FFECEC"><strong>VALOR PREVISTO</strong></td>
    <td bgcolor="#FFECEC"><? echo number_format($valor_fatura,2,',','.'); ?></td>
  </tr>
  <tr>
    <td colspan="5" bgcolor="#CCCCCC"><strong>PAGAMENTOS REALIZADOS</strong></td>
  </tr>
  <tr>
    <td bgcolor="#E1F0FF"><strong>DATA</strong></td>
    <td colspan="3" bgcolor="#E1F0FF"><strong>FORMA DE PAGAMENTO</strong></td>
    <td width="76" bgcolor="#E1F0FF"><strong>VALOR</strong></td>
  </tr>
  <? $pagamentos = 0;
  $sql_pagamento = mysqli_query($conexao_bd, "SELECT * FROM pagamento_fatura WHERE cliente = '$cliente' AND status = 'Aguarda'");
  	while($res_pagamento = mysqli_fetch_array($sql_pagamento)){
  ?>
  <tr>
    <td><? echo $res_pagamento['data']; ?></td>
    <td colspan="3"><? echo $res_pagamento['forma_pagamento']; ?></td>
    <td><? echo number_format($res_pagamento['valor'],2); $pagamentos = number_format($res_pagamento['valor'])+$pagamentos;?> 
      
      <? if($res_pagamento['data'] == "$data" && $res_pagamento['operador'] == "$operador"){ ?>
      <a href="?p=excluirpg&id=<? echo $res_pagamento['id']; ?>"><img src="img/deleta.jpg" width="7" height="7" border="0" title="Excluir pagamento" /></a>
      <? } ?>
      
    </td>
  </tr>
  <? } ?>
  <tr>
    <td colspan="5" bgcolor="#CCCCCC"><strong>DESCRIÇÃO DA FATURA</strong></td>
  </tr>
  <tr>
    <td width="129" bgcolor="#FFFFE1"><strong>ÚLTIMA FATURA</strong></td>
    <td colspan="2" bgcolor="#FFFFE1"><strong>SITUAÇÃO</strong></td>
    <td colspan="2" bgcolor="#FFFFE1"><strong>FECHAMENTO</strong></td>
  </tr>
  <tr>
    <td>
	<?
    $sql_verifica_ultima_fatura = mysqli_query($conexao_bd, "SELECT * FROM faturas_fechadas WHERE cliente = '$cliente' ORDER BY id DESC LIMIT 1");
	if(@mysqli_num_rows($sql_verifica_ultima_fatura) == ''){
		echo "ABERTA";
	}else{
		while($res_ultima_fatura = mysqli_fetch_array($sql_verifica_ultima_fatura)){
	?>
  <script language="javascript">
		function abrePopUp(urlImagem){
			window.open(urlImagem,'Foto_Ampliada','top=70,left=170,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=1050,height=500');
		}
	</script>
<a class="a2" onclick="abrePopUp('scripts/fatura_fechada.php?code_fatura=<? echo $res_ultima_fatura['code_fatura']; ?>');"><? echo $res_ultima_fatura['vencimento']; ?></a>    
    
    
    
    </td>
    <td colspan="2"><? echo $res_ultima_fatura['sit_pag']; ?></td>
    <? } } ?>
    <td colspan="2">
    <?
	$sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente WHERE cliente = '$cliente'");
		while($res_clientes = mysqli_fetch_array($sql_cliente)){
			
			echo $res_clientes['fechamento'];
		
	?>    
    </td>
  </tr>
  <tr>
    <td bgcolor="#FFFFE1"><strong>SALDO ATUAL</strong></td>
    <td colspan="2" bgcolor="#FFFFE1"><strong>PAG. MINÍMO:</strong></td>
    <td colspan="2" bgcolor="#FFFFE1"><strong>VENCIMENTO</strong></td>
  </tr>
  <tr>
    <td>R$ <? 
	   	$juros = 0;
		$multa = 0;
		$code_fatura = 0;
		$valor_total_fatura = 0;
		$vencimento_completo_fatura = 0;

	   
	    $sql_verifica_ultima_fatura = mysqli_query($conexao_bd, "SELECT * FROM faturas_fechadas WHERE status = 'FECHADO' AND cliente = '$cliente' ORDER BY id DESC LIMIT 1");
		while($res_saldo = mysqli_fetch_array($sql_verifica_ultima_fatura)){
			$code_fatura = $res_saldo['code_fatura'];
			$valor_total_fatura = $res_saldo['valor'];
			$vencimento_completo_fatura = $res_saldo['vencimento'];
		$verifica_juros = mysqli_query($conexao_bd, "SELECT * FROM juros_cartao WHERE code_fatura = '$code_fatura'");
	   		while($res_juros = mysqli_fetch_array($verifica_juros)){
				$juros = $res_juros['mora_atraso']+$juros;
				$multa = $res_juros['multa_atraso']+$multa;
			}			
						
			echo number_format((($res_saldo['saldo']+$juros+$multa)-$pagamentos),2);
		}
	
	 ?></td>
    <td colspan="2">R$ <? echo number_format($valor_fatura*0.4,2); ?></td>
    <td colspan="2"><? echo $res_clientes['vencimento']; ?></td>
  </tr>
  <tr>
    <td colspan="5"><a style="font:10px Arial, Helvetica, sans-serif; margin:0;" href="?pg=enviar_fatura&code_fatura=<? echo $code_fatura; ?>&cliente=<? echo $cliente; ?>&valor_total_fatura=<? echo $valor_total_fatura; ?>&vencimento_completo_fatura=<? echo $vencimento_completo_fatura; ?>"><img src="img/fatura_email.fw.png" width="50" height="30" border="0" title="Enviar fatura por e-mail" /></a>
    
    <? 
	
	$sql_verifica_desconto = mysqli_query($conexao_bd, "SELECT * FROM faturas_fechadas WHERE cliente = '$cliente' AND sit_pag = 'REFATURADO' ORDER BY id DESC LIMIT 3");
	if(mysqli_num_rows($sql_verifica_desconto) >= 2){
	?>
    <a style="font:10px Arial, Helvetica, sans-serif;" rel="superbox[iframe][915x600]" href="scripts/carta_cobranca.php?cliente=<? echo $cliente; ?>"><img src="img/carta.png" width="30" height="30" border="0" title="Carta de cobrança" /></a>
    <? } ?>
    
    
      &nbsp;</td>
    </tr>
  <? } ?>
</table>

 </div><!-- box_compras -->
 
 </div><!-- valor_compras -->
 
 </div><!-- box_corpo -->


<? require "rodape.php"; ?>
</body>
</html>

<? if($_GET['p'] == 'excluirpg'){
	
$id_pagamento = $_GET['id'];

mysqli_query($conexao_bd, "DELETE FROM pagamento_fatura WHERE id = '$id_pagamento'");

echo "<script language='javascript'>window.location='faturas.php';</script>";

}?>











<? if($_GET['pg'] == 'enviar_fatura'){

$valor_total_fatura = $_GET['valor_total_fatura'];
$vencimento_completo_fatura = $_GET['vencimento_completo_fatura'];
$code_fatura = $_GET['code_fatura'];
$cliente = $_GET['cliente'];

   
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
$mail->FromName = "SUA FATURA VESTE PRIME CARD!";
$mail->AddAddress("$email_cliente,vesteprime@gmail.com","VESTE PRIME CARD");
$mail->WordWrap = 500; 
$mail->AddAttachment("anexo/arquivo.zip"); 
$mail->AddAttachment("imagem/foto.jpg");
$mail->IsHTML(true); //enviar em HTML

	$valor_total_fatura = number_format($valor_total_fatura,2,',','.');

	$mail->AddReplyTo("$email_cliente,vesteprime@gmail.com","$nome_cliente");
	$msg  = "";
	$msg .= "

<table width='800' align='center' style='border:20px solid #F90; border-radius:50px; padding:10px;' border='0'>
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
 
$mail->Subject = "SUA FATURA VESTE PRIME CARD!";
//adicionando o html no corpo do email
$mail->Body = $msg;
//enviando e retornando o status de envio
if(!$mail->Send())
{
echo "<script language='javascript'>window.alert('OCORREU UM ERRO AO ENVIAR E-MAIL, POR FAVOR, TENTE NOVAMENTE');window.location='faturas.php?cliente=';</script>";
echo "Ocorreru um erro, tente novamente!".$mail->ErrorInfo;
//$mail->ErrorInfo informa onde ocorreu o erro 

exit;
} // verifica se pode fechar a fatura
	
echo "<script language='javascript'>window.alert('FATURA ENVIADA COM SUCESSO!');window.location='faturas.php?cliente=';</script>";


}?>


