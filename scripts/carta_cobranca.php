<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>COBRANÇA EXTRA-JUDICIAL</title>
<style type="text/css">
body {
	font:15px Arial, Helvetica, sans-serif;
}
body p{
	width:900px;
	text-align:justify;
	line-height:30px;
	}
</style>
</head>

<script language="javascript">window.print();</script>

<body><br /><br /><br /><br />
<?

	require "../conexao.php";
	
	$cliente = 0;
	$ultima_fatura = 0;
	$soma_divida_futura = 0;
	
	 $sql_carrinho = mysqli_query($conexao_bd, "SELECT * FROM carrinho WHERE ip = '$ip' AND status = 'Ativo' AND cliente != ''");
	 if(mysqli_num_rows($sql_carrinho) == ''){
		echo "<script language='javascript'>window.location='carrinho.php';</script>";
	 }else{
		while($res_carrinho = mysqli_fetch_array($sql_carrinho)){
			$cliente = $res_carrinho['cliente'];
		}
	  }

?>
<h1 align="center"><strong>NOTIFICA&Ccedil;&Atilde;O EXTRA JUDICIAL</strong></h1> <br />
<p align="center"><strong>PREZADA(O) 
<?

$sql_nome_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '$cliente'");
while($res_nome = mysqli_fetch_array($sql_nome_cliente)){
	echo strtoupper($res_nome['nome']);
}
?></strong>
, a VESTE PRIME - Central de  Recupera&ccedil;&atilde;o de Cr&eacute;ditos, empresa correspondente bancaria, vem por meio desta notifica-lo,  a fim de que sejam solucionadas as pend&ecirc;ncias que voc&ecirc; possui hoje junto ao  citado credor ainda na fase conciliat&oacute;ria. Tal medida evitar&aacute; eventual ingresso  com a competente a&ccedil;&atilde;o judicial, cujo procedimento poder&aacute; trazer-lhe  consequ&ecirc;ncias previstas no <strong>C&Oacute;DIGO DE PROCESSO CIVIL BRASILEIRO</strong>. O n&atilde;o  atendimento das provid&ecirc;ncias requeridas nesta NOTIFICA&Ccedil;&Atilde;O ser&aacute; interpretado  como falta de interesse na realiza&ccedil;&atilde;o deste Acordo Amig&aacute;vel, o qual trar&aacute;  EXCELENTES VANTAGENS, sendo, portanto, OPORTUNIDADE que n&atilde;o deve ser perdida. A  reabilita&ccedil;&atilde;o de seu nome junto aos &oacute;rg&atilde;os de prote&ccedil;&atilde;o ao cr&eacute;dito de sua regi&atilde;o  ocorrer&aacute; em at&eacute; 05 dias &uacute;teis ap&oacute;s o pagamento da 1&ordf; parcela ou quita&ccedil;&atilde;o. <br />
  <strong>Lembrando que conforme contrato assinado e est&aacute; dentro do c&oacute;digo civil,  caso o cliente sendo acionado judicialmente al&eacute;m dos custos relativos a d&iacute;vida  na VESTE PRIME o mesmo &eacute; ter&aacute; que arcar com os custos de processos e honor&aacute;rios  do advogado.</strong> <br /></p><br /><br />
<h1 style="font:15px Arial, Helvetica, sans-serif;" align="center"><strong style="text-align:center">Sua d&iacute;vida atualizada hoje &eacute; de: R$ 

    <?
	

		
    $saldo_ultima_fatura = mysqli_query($conexao_bd, "SELECT * FROM faturas_fechadas WHERE cliente = '$cliente' ORDER BY id DESC LIMIT 1");
		while($res_ultima_fatura = mysqli_fetch_array($saldo_ultima_fatura)){
			if($res_ultima_fatura['sit_pag'] == 'VENCIDA'){
				$ultima_fatura = $res_ultima_fatura['saldo'];
			}elseif($res_ultima_fatura['sit_pag'] == 'AGUARDA PAGAMENTO'){
				$ultima_fatura = $res_ultima_fatura['saldo'];
			}elseif($res_ultima_fatura['sit_pag'] == 'PAGO PARCIALMENTE'){
				$ultima_fatura = $res_ultima_fatura['saldo'];
			} // aguardando venciimento
	} // while do saldo da fatura
	
	$multas = 0;
	$juros = 0;
	$verifica_juros_multas = mysqli_query($conexao_bd, "SELECT * FROM juros_cartao WHERE cliente = '$cliente' AND status = 'Aguarda'");
	while($res_juros_multas = mysqli_fetch_array($verifica_juros_multas)){
		$multas = $res_juros_multas['multa_atraso']+$multas;
		$juros = $res_juros_multas['mora_atraso']+$juros;
	}	

	$juros_multas = $multas+$juros;

	$code_transacao = 0;
	$soma_divida_total = 0;
	$verifica_fatura_em_aberto = mysqli_query($conexao_bd, "SELECT * FROM lancamento_fatura WHERE cliente = '$cliente' AND status = 'Ativo'");
		while($res_fatura_em_aberto = mysqli_fetch_array($verifica_fatura_em_aberto)){
				$code_transacao = $res_fatura_em_aberto['code_transacao'];;
			$sql_parcelas = mysqli_query($conexao_bd, "SELECT * FROM compras_parceladas WHERE status = 'Aguarda' AND code_transacao = '$code_transacao'");
				while($res_compras_parceladas = mysqli_fetch_array($sql_parcelas)){
					$soma_divida_futura = number_format(($res_compras_parceladas['valor_parcela']+$soma_divida_futura), 2, ',', '.');
				 $soma_divida_total = $res_compras_parceladas['valor_parcela']+$soma_divida_futura;
			} // soma compras parceladas
		}
		
		$soma_divida_total = number_format($soma_divida_total+$juros_multas+$ultima_fatura,2);
		$somado = number_format($soma_divida_total,2,',','.');
		echo "<h2><strong> $somado</strong></h2>";	
	?>
  <?
    $valor_desconto = 0;
	$sql_verifica_desconto = mysqli_query($conexao_bd, "SELECT * FROM faturas_fechadas WHERE cliente = '$cliente' AND sit_pag = 'REFATURADO'");
	$conta_refaturado = mysqli_num_rows($sql_verifica_desconto);
	
	if($conta_refaturado <2){
		$valor_desconto = 0;
	}else{
	
	if($conta_refaturado >=2 && $conta_refaturado <=4){
		$valor_desconto = 0.4;
	}elseif($conta_refaturado >5 && $conta_refaturado <=7){
		$valor_desconto = 0.6;
	}elseif($conta_refaturado >8 && $conta_refaturado <=10){
		$valor_desconto = 0.8;
	}elseif($conta_refaturado >11 && $conta_refaturado <=30){
		$valor_desconto = 0.95;
	}
   }

 $perce = $valor_desconto;

  ?>  

.</strong></h1> <br /><br /><br />
<h1 style="font:15px Arial, Helvetica, sans-serif;" align="center">&nbsp;<strong>OFERTA IMPERDIVEL</strong></h1>
<table width="800" style="text-align:center; border:1px solid #000; border-radius:5px;" border="0">
  <tr>
    <td width="133" bgcolor="#669900"><strong>PARCELA</strong></td>
    <td width="274" bgcolor="#669900"><strong>VALOR DA PARCELA</strong></td>
    <td width="377" rowspan="13" bgcolor="#FFFFFF">APROVEITE O MEGA DESCONTO E LIMPE SEU NOME DE MANEIRA F&Aacute;CIL E R&Aacute;PIDO.</td>
  </tr>
  <tr>
    <td>1 X </td>
    <td><?  $soma_divida_total = $soma_divida_total-($soma_divida_total*$perce); echo number_format($soma_divida_total,2,',','.');  ?></td>
  </tr>
<?
for($i=2; $i<=15; $i++){

?>  
  <tr>
    <td><? echo $i; ?> X </td>
    <td><? echo number_format(((($soma_divida_total*$i*0.0499)+$soma_divida_total)/$i), 2, ',', '.'); ?></td>
  </tr>
<? } ?>
</table>
<p>&nbsp; </p>
<p>Ao escolher as parcelas, se diriga a uma de nossas lojas para concretizar sua negocia&ccedil;&atilde;o. </p>
<p><br />
  <br />
  <strong>Att.</strong> <br />
  <strong>Veste Prime</strong></p>
<p>&nbsp;</p>
</body>
</html>