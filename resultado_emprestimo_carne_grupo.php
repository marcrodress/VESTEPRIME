<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/resultado_emprestimo_carne_grupo.css" rel="stylesheet" type="text/css" />
</head>

<body>
<? require "topo.php";  require "scripts/verificador_caixa.php"; ?>
<div id="box_pagamento_1">
<hr />
<h1><strong>Hist&oacute;rico de cr&eacute;ditos solicitados - t&iacute;tulo único</strong></h1>
<? if($_GET['p'] == '1'){ ?>
<table class="table" width="1000" border="0">
  <tr>
    <td colspan="10" bgcolor="#666666" align="center"><h1 class="h1"><strong>RESULTADO DO EMPRÉSTIMO EM GRUPO - ÚNICO</strong></h1></td>
  </tr>
  <tr>
    <td bgcolor="#333333"><strong>Nº PROPOSTA</strong></td>
    <td bgcolor="#333333"><strong>STATUS</strong></td>
    <td bgcolor="#333333"><strong>CPF</strong></td>
    <td bgcolor="#333333"><strong>NOME DO CLIENTE</strong></td>
    <td bgcolor="#333333"><strong>VALOR</strong></td>
    <td bgcolor="#333333"><strong>Q°. PARCELAS</strong></td>
    <td bgcolor="#333333"><strong>VL. PARCELA</strong></td>
    <td bgcolor="#333333"><strong>VL. TOTAL</strong></td>
    <td bgcolor="#333333"><strong>VENCIMENTO</strong></td>
    <td bgcolor="#333333">&nbsp;</td>
  </tr>
<?

$cliente = 0;

$sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM carrinho WHERE status = 'Ativo' AND ip = '$ip'");
	while($res_cliente = mysqli_fetch_array($sql_cliente)){
		$cliente = $res_cliente['cliente'];
} // fecha busca cliente

$sql_1 = mysqli_query($conexao_bd, "SELECT * FROM emprestimo_boleto_unico WHERE cpf = '$cliente'");
if(mysqli_num_rows($sql_1) == ''){
	echo "<script language='javascript'>window.location='carrinho.php';</script>";
}else{
	while($res_1 = mysqli_fetch_array($sql_1)){ $i++;
?>  
  <tr <? if($i%2 == 0){ echo "bgcolor='#888'"; }else{ echo "bgcolor='#444'"; } ?>>
    <td><? echo $res_1['n_proposta']; ?></td>
    <td><? echo $res_1['status']; ?></td>
    <td><? echo $res_1['cpf']; ?></td>
    <td><? 
		$sqlcliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '".$res_1['cpf']."'");
			while($res_cliente = mysqli_fetch_array($sqlcliente)){
				echo $res_cliente['nome'];
			}
	?></td>
    <td>R$ <? echo number_format($res_1['valor'],2,',','.'); ?></td>
    <td><? echo $res_1['quant_parcela']; ?></td>
    <td>R$ <? echo number_format($res_1['valor_parcela'],2,',','.'); ?></td>
    <td>R$ <? echo number_format($res_1['valor_total'],2,',','.'); ?></td>
    <td><? echo $res_1['vencimento']; ?></td>
    <td>
     
     <a href="?p=2&n_proposta=<? echo $res_1['n_proposta']; ?>"><img src="img/cadastro.fw.png" width="20" height="20" border="0" title="Verificar detalhes do empréstimo" /></a>
     
     <? if($res_1['status'] == 'SIMULACAO'){ ?>
     <a href="?p=1&n_proposta=<? echo $res_1['n_proposta']; ?>&pg=cancela"><img src="img/bloquea.png" width="20" height="20" border="0" title="Cancelar empréstimo" /></a>
     <? } ?>
    
    </td>
  </tr>
<? }} ?>
</table>

<? if($_GET['pg'] == 'cancela'){

$n_proposta = $_GET['n_proposta'];

mysqli_query($conexao_bd, "UPDATE emprestimo_boleto_unico SET status = 'CANCELADO' WHERE n_proposta = '".$n_proposta."'");
mysqli_query($conexao_bd, "UPDATE emprestimo_distribuicao_clientes SET status = 'CANCELADO' WHERE n_proposta = '".$n_proposta."'");
mysqli_query($conexao_bd, "UPDATE boletos_emprestimo_boleto SET status = 'CANCELADO' WHERE proposta = '".$n_proposta."'");

echo "<script language='javascript'>window.location='?p=1';</script>";

}?>


<? } // pagina 1 ?>









<? if($_GET['p'] == '2'){ ?>
<?

$n_proposta = $_GET['n_proposta'];

$sql_n_proposta = mysqli_query($conexao_bd, "SELECT * FROM emprestimo_boleto_unico WHERE n_proposta = '$n_proposta'");
while($res_proposta = mysqli_fetch_array($sql_n_proposta)){
?>
 <table width="1000" class="table" border="0">
  <tr>
    <td colspan="4" align="center" bgcolor="#333333"><h1 class="h1"><strong>DATALHE DO EMPRÉSTIMO</strong></h1></td>
  </tr>
  <tr>
    <td width="225" bgcolor="#666666"><strong>QUANT. MEMBROS</strong></td>
    <td width="253" bgcolor="#666666"><strong>CPF DO COORDENADOR</strong></td>
    <td width="279" bgcolor="#666666"><strong>NOME DO COORDENADOR</strong></td>
    <td width="223" bgcolor="#666666"><strong>N° PARCELAS</strong></td>
  </tr>
  <tr>
    <td><? echo $membros = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM emprestimo_distribuicao_clientes WHERE n_proposta = '$n_proposta'")); ?></td>
    <td><? echo $res_proposta['cpf']; ?></td>
    <td><? 
		$sqlcliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '".$res_proposta['cpf']."'");
			while($res_cliente = mysqli_fetch_array($sqlcliente)){
				echo $res_cliente['nome'];
			}
	?></td>
    <td><? echo $quant_parcela = $res_proposta['quant_parcela']; ?></td>
  </tr>
  <tr>
    <td bgcolor="#666666"><strong>DATA DA CONTRATAÇÃO</strong></td>
    <td bgcolor="#666666"><strong>STATUS</strong></td>
    <td bgcolor="#666666"><strong>VALOR</strong></td>
    <td bgcolor="#666666"><strong>TAXA M&Eacute;DIA DO GRUPO</strong></td>
  </tr>
  <tr>
    <td><? echo $res_proposta['data']; ?></td>
    <td><? echo $res_proposta['status']; ?></td>
    <td>R$ <? echo number_format($res_proposta['valor'],2,',','.'); ?></td>
    <td>
	<?
	 $taxa = 0;
	 $sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM emprestimo_distribuicao_clientes WHERE n_proposta = '$n_proposta'");
	  while($res_taxa = mysqli_fetch_array($sql_verifica)){
		  $taxa = $taxa+$res_taxa['juros'];
	  }
	  
	  echo number_format($taxa/$membros,2);
	
	?>%</td>
  </tr>
  <tr>
    <td bgcolor="#666666"><strong>VALOR DA PARCELA</strong></td>
    <td bgcolor="#666666"><strong>VALOR TOTAL</strong></td>
    <td bgcolor="#666666"><strong>VENCIMENTO</strong></td>
    <td rowspan="2"><strong>ADMINISTRA&Ccedil;&Atilde;O DE CONTRATO</strong><br />
	  <? if($res_proposta['status'] == 'SIMULACAO'){ ?>
       <br />
       <a style="font:10px Arial, Helvetica, sans-serif; padding:10px; border-radius:3px; background:#06C; text-decoration:none; color:#FFF; margin:5px;" href="emprestimo_carne_crediamigo_grupo.php?p=5&n_proposta=<? echo $_GET['n_proposta']; ?>">Voltar a simulação</a>
	  <? } ?>      
	  
	  
	  <? if($res_proposta['status'] == 'APROVADO'){ ?>
      <a target="_blank" href="scripts/imprimir_contrato_carne_grupo.php?n_proposta=<? echo $res_proposta['n_proposta']; ?>"><img src="img/cadastro.fw.png" alt="" width="20" height="20" border="0" title="IMPRIMIR CONTRATO" /></a>
      <? } ?>
      <? if($_GET['pgc'] == 'confirmar_credito'){

			$n_proposta = $_GET['n_proposta'];
			
			mysqli_query($conexao_bd, "UPDATE emprestimo_boleto_unico SET sit_liberacao = 'CONFIRMADO' WHERE id = '".$_GET['id']."'");
			echo "<script language='javascript'>window.alert('Confirmação enviada com sucesso! O Crédito na conta do cliente ocorrerá em no máximo 72 horas úteis');window.location='?p=2&n_proposta=$n_proposta';</script>";
        
	    }?>
      <? if($res_proposta['status'] == 'APROVADO' && $res_proposta['contrato'] == ''){ ?>
      <a rel="superbox[iframe][300x250]" href="scripts/upload_contrato_emprestimo_carne_grupo.php?id=<? echo $res_proposta['id']; ?>"><img src="img/upload.png" alt="" width="20" height="20" border="0" title="ENVIAR CONTRATO" /></a>
      <? } ?>
      <? if($res_proposta['contrato'] !== '' && $res_proposta['status'] == 'APROVADO' && $res_proposta['sit_liberacao'] == ''){ ?>
      <script language="JavaScript" type="text/javascript">
        function confirmacao(id) {
             var resposta = confirm("Tem certeza que todos os dados estão corretos e o contrato devidamente assinados?");
         
             if (resposta == true) {
                  window.location.href = "?pg=detalhe&pgc=confirmar_credito&p=2&n_proposta=<? echo $n_proposta; ?>&id="+id;
             }
        }
        </script>
      <a href="javascript:func()" onclick="confirmacao('<? echo $res_proposta['id']; ?>')"><img src="img/correto.fw.png" width="20" height="20" border="0" title="AUTORIZAR LIBERA&Ccedil;&Atilde;O DO CR&Eacute;DITO" /></a>
      <? } ?></td>
  </tr>
  <tr>
    <td>R$ <? echo number_format($res_proposta['valor_parcela'],2,',','.'); ?></td>
    <td>R$ <? echo number_format($res_proposta['valor_total'],2,',','.'); ?></td>
    <td><? echo $res_proposta['vencimento']; ?></td>
  </tr>
  <? if($tipo == 'ADM' && $res_proposta['status'] == 'SIMULACAO'){  ?>
  <tr>
    <td colspan="4">
     <form name="" method="post" action="" enctype="multipart/form-data">
      <select style="font:12px Arial, Helvetica, sans-serif; border:1px solid #000; padding:5px; border-radius:5px;" name="situacao" size="1" id="select">
        <option value="APROVADO">APROVADO</option>
        <option value="REPROVADO">REPROVADO</option>
    </select>
    <input name="sitau" type="submit" style="font:12px Arial, Helvetica, sans-serif; border:1px solid #000; padding:5px; border-radius:5px;" value="Confirmar" />
    </form>
    
    <? if(isset($_POST['sitau'])){ 
	
	 $situacao = $_POST['situacao'];
	 
	 if($situacao == 'APROVADO'){
	 
		 for($i=1; $i<=$res_proposta['quant_parcela']; $i++){
			 mysqli_query($conexao_bd, "INSERT INTO boletos_emprestimo_boleto (cliente, proposta, parcela, codigo_barras, localizador, vencimento, valor, status, data_pagamento) VALUES ('".$res_proposta['cpf']."', '$n_proposta', '$i', '', '', '', '".$res_proposta['valor_parcela']."', 'AGUARDA', '')");
		 } // for
	 } // verifica aprovação
	 
	  mysqli_query($conexao_bd, "UPDATE emprestimo_boleto_unico SET status = '$situacao' WHERE n_proposta = '$n_proposta'");
	  mysqli_query($conexao_bd, "UPDATE emprestimo_distribuicao_clientes SET status = '$situacao' WHERE n_proposta = '$n_proposta'");
	 
	 echo "<script language='javascript'>window.alert('ALTERAÇÃO REALIZADO COM SUCESSO!');window.location='';</script>";	   
	 	
	 
	}?>
    
    </td>
  </tr>
  <? }// TIPO ?>
</table>

<table width="1000" class="table" border="0">
  <tr>
    <td colspan="10" align="center"><h1 class="h1">Membros do grupo</h1></td>
  </tr>
  <tr>
    <td bgcolor="#6699CC"><strong>STATUS</strong></td>
    <td bgcolor="#6699CC"><strong>CPF</strong></td>
    <td bgcolor="#6699CC"><strong>NOME</strong></td>
    <td bgcolor="#6699CC"><strong>VALOR</strong></td>
    <td bgcolor="#6699CC"><strong>JUROS</strong></td>
    <td bgcolor="#6699CC"><strong>TARIFA</strong></td>
    <td bgcolor="#6699CC"><strong>N° PARC.</strong></td>
    <td bgcolor="#6699CC"><strong>VL. PARCELA</strong></td>
    <td bgcolor="#6699CC"><strong>VL. TOTAL</strong></td>
    <td bgcolor="#6699CC">&nbsp;</td>
  </tr>
<?

$sql_clientes = mysqli_query($conexao_bd, "SELECT * FROM emprestimo_distribuicao_clientes WHERE n_proposta = '$n_proposta'");
while($res_clientes = mysqli_fetch_array($sql_clientes)){
?>
  <tr>
    <td><? echo $res_clientes['status']; ?></td>
    <td><? echo $res_clientes['cliente']; ?></td>
    <td>
	<? 
		$sqlcliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '".$res_clientes['cliente']."'");
			while($res_cliente = mysqli_fetch_array($sqlcliente)){
				echo $res_cliente['nome'];
			}
	?>    
    </td>
    <td>R$ <? echo number_format($res_clientes['valor'],2,',','.'); ?></td>
    <td><? echo $res_clientes['juros']; ?>%</td>
    <td>R$ <? echo number_format($res_clientes['tarifa'],2,',','.'); ?></td>
    <td><? echo $res_clientes['quant_parcela']; ?></td>
    <td>R$ <? echo number_format($res_clientes['valor_parcela'],2,',','.'); ?></td>
    <td>R$ <? echo number_format($res_clientes['valor_total'],2,',','.'); ?></td>
    <td><a rel="superbox[iframe][420x180]" href="scripts/dados_credito.php?cliente=<? echo $res_clientes['cliente']; ?>&n_proposta=<? echo $n_proposta; ?>"><img src="img/DINHEIRO_ICO.png" width="20" height="20" border="0" /></a></td>
  </tr>
<? } ?>
</table>
<? } ?>

<table class="td" width="960" align="center" border="0">
      <tr>
        <td colspan="11" bgcolor="#666666"><strong><span style="font-family: Arial, Helvetica, sans-serif; font-size: 20px">PARCELAS</span></strong></td>
      </tr>
      <tr>
        <td width="63" bgcolor="#000033"><strong>PARCELA</strong></td>
        <td width="55" bgcolor="#000033"><strong>STATUS</strong></td>
        <td width="60" bgcolor="#000033"><strong>VALOR</strong></td>
        <td width="51" bgcolor="#000033"><strong>MULTA</strong></td>
        <td width="47" bgcolor="#000033"><strong>JUROS</strong></td>
        <td width="49" bgcolor="#000033"><strong>SALDO</strong></td>
        <td width="259" bgcolor="#000033"><strong>COD. BARRAS</strong></td>
        <td width="90" bgcolor="#000033"><strong>LOCALIZADOR</strong></td>
        <td width="82" bgcolor="#000033"><strong>VENCIMENTO</strong></td>
        <td width="69" bgcolor="#000033"><strong>PAGT.</strong></td>
        <td width="85" bgcolor="#000033">
        <a target="_blank" href="scripts/boletos_carne_emprestimo_grupo.php?proposta=<? echo $n_proposta; ?>" title="Emitir carnê completo"><img src="img/carne_pagamento.png" width="18" height="20" border="0" /></a>
        <a  target="_blank" href="scripts/capa_boletos_carne_emprestimo_grupo.php?proposta=<? echo $n_proposta; ?>" title="Emitir carnê completo"><img src="img/capa_carne.png" width="18" height="20" border="0" /></a>
        </td>
      </tr>


 <? 
 $sql_parcela = mysqli_query($conexao_bd, "SELECT * FROM boletos_emprestimo_boleto WHERE proposta = '$n_proposta'");
 for($i=1; $i<=mysqli_num_rows($sql_parcela); $i++){
	 $sql_parcelas = mysqli_query($conexao_bd, "SELECT * FROM boletos_emprestimo_boleto WHERE proposta = '$n_proposta' AND parcela = '$i'"); 
	 while($res_parcela = mysqli_fetch_array($sql_parcelas)){
 ?>
	  <tr <? if($i%2 == 0){ echo "bgcolor='#666'"; }else{ echo "bgcolor='#222'"; } ?>>
        <td><h5><? echo $res_parcela['parcela']; ?></h5></td>
        <td><h5><? echo $res_parcela['status']; ?></h5></td>
        <td><h5>R$ <? echo number_format($res_parcela['valor'],2,',','.'); ?></h5></td>
        <td>
		<h4><? 
		$multa = 0;
		if($res_parcela['status'] == 'AGUARDA' && $code_vencimento_hoje > $res_parcela['vencimento']){
			$multa = $res_parcela['valor']*0.0599;
			echo number_format($multa,2,',','.');
		}
		?></h4>
        </td>
        <td>
		<h4><? 
		$juros = 0;
		if($res_parcela['status'] == 'AGUARDA' && ($code_vencimento_hoje > $res_parcela['vencimento'])){
			$juros = $res_parcela['valor']*0.002*($code_vencimento_hoje-$res_parcela['vencimento']);
			echo number_format($juros,2,',','.');
		}
		?></h4>
                </td>
        <td><h6><? echo number_format($juros+$multa+$res_parcela['valor'],2,',','.'); ?></h6></td>
        <td>
        <? if($tipo == 'ADM'){ ?>
	        <a rel="superbox[iframe][800x250]" style="text-decoration:none; color:#CCC;" href="scripts/postar_codigo_emprestimo_carne.php?id=<? echo $res_parcela['id']; ?>&parcela=<? echo $res_parcela['parcela']; ?>&vencimento=<? echo $res_parcela['vencimento']; ?>&localizador=<? echo $res_parcela['localizador']; ?>&codigo_barras=<? echo $res_parcela['codigo_barras']; ?>"><? if($res_parcela['codigo_barras'] == ''){?> Postar código <? }else{echo $res_parcela['codigo_barras'];}; ?></a>
       
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
        <a href="scripts/boleto_emprestimo_grupo.php?id=<? echo $res_parcela['id']; ?>&proposta=<? echo $res_parcela['proposta']; ?>" target="_blank"><img src="img/boletos.png" width="17" height="20" border="0" title="Emitir boleto de pagamento" /></a>
       
        <a href="?id=<? echo $res_parcela['id']; ?>&proposta=<? echo $res_parcela['proposta']; ?>&cpf=<? echo $res_parcela['cliente']; ?>&&pg=enviar_mail"><img src="img/email.png" width="17" height="20" border="0" /></a>
        
        <? if($tipo == 'ADM'){ ?>
         <a rel="superbox[iframe][270x250]" href="scripts/confirmar_pagamento_emprestimo_carne.php?ultima=<? if($res_parcela['parcela'] == $quant_parcela){ echo "SIM"; } ?>&tipo=grupo_unico&id=<? echo $res_parcela['id']; ?>&valor=<? echo number_format($juros+$multa+$res_parcela['valor'],2); ?>&cpf=<? echo $res_parcela['cliente']; ?>&parcela=<? echo $res_parcela['parcela']; ?>&n_proposta=<? echo $n_proposta; ?>"><img src="img/dinheiro.png" width="20" height="20" border="0" title="Confirmar pagamento" /></a>
        <? } ?>
        
        </td>
      </tr>
      <? }} ?>
    </table>
<br /><br />

<? } // fecha página 2 ?>

</div><!-- box_pagamento_1 -->
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
    <td colspan='2' align='center'><a href='http://www.ikuly.com/caixa/scripts/boleto_emprestimo_grupo.php?id=$id&proposta=$proposta'><img src='http://ikuly.com/caixa/img/baixar_boleto.fw.png' alt='' width='272' height='78' border='0' /></a>
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
	
echo "<script language='javascript'>window.alert('BOLETO ENVIADO COM SUCESSO!');window.location='?p=2&n_proposta=$proposta';</script>";



}?>