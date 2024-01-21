<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/fechamento_caixa.css" rel="stylesheet" type="text/css" />
</head>

<body>
<? require "topo.php";  require "scripts/verificador_caixa.php"; ?>

<div id="box_pagamento_1">
<h1><strong>RESUMO DE FECHAMENTO DE CAIXA</strong><hr /></h1>
<?

$soma_caixa_inicial = 0;
$id_do_caixa = 0;

$sql_abertura = mysqli_query($conexao_bd, "SELECT * FROM abertura_de_caixa WHERE operador = '$operador' AND status = 'Aberto' ORDER BY id DESC LIMIT 1");
 while($res_abertura = mysqli_fetch_array($sql_abertura)){
	 
$id_do_caixa =  $res_abertura['id'];
	 
$soma_caixa_inicial = $res_abertura['valor_caixa']+$soma_caixa_inicial;
	 
?>
<table width="1000" border="0">
  <tr>
    <td colspan="6"><strong>OPERADOR: <? echo @$nome; ?>  <br />DATA DE ABERTURA: <? echo $res_abertura['dada_completa']; ?></strong><hr /></td>
  </tr>
  <tr>
    <td><strong>SALDO MAQUINA BB</strong></td>
    <td><strong>NOTAS DE R$ 100,00</strong></td>
    <td><strong>NOTAS DE R$ 50,00</strong></td>
    <td><strong>NOTAS DE R$ 20,00</strong></td>
    <td><strong>NOTAS DE R$ 10,00</strong></td>
    <td><strong>NOTAS DE R$ 5,00</strong></td>
  </tr>
  <tr>
    <td>R$ <? echo number_format($res_abertura['saldaobb'], 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($res_abertura['notas100']*100, 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($res_abertura['notas50']*50, 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($res_abertura['notas20']*20, 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($res_abertura['notas10']*10, 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($res_abertura['notas5']*5, 2, ',', '.'); ?></td>
  </tr>
  <tr>
    <td><strong>NOTAS DE R$ 2,00</strong></td>
    <td><strong>MOEDAS DE R$ 1,00</strong></td>
    <td><strong>MOEDAS DE R$ 0,50</strong></td>
    <td><strong>MOEDAS DE R$ 0,25</strong></td>
    <td><strong>MOEDAS DE R$ 0,10</strong></td>
    <td><strong>MOEDAS DE 0,05</strong></td>
  </tr>
  <tr>
    <td>R$ <? echo number_format($res_abertura['notas2']*2, 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($res_abertura['moeda1']*1, 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($res_abertura['moeda50']*0.5, 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($res_abertura['moeda25']*0.25, 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($res_abertura['moeda10']*0.1, 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($res_abertura['moeda5']*0.05, 2, ',', '.'); ?></td>
  </tr>
  <tr>
    <td><strong>SALDO BANCO DO BRASIL</strong></td>
    <td><strong>SALDO BANCO INTER</strong></td>
    <td><strong>SALDO RECARGAPAY</strong></td>
    <td><strong>SALDO MERCADOPAGO</strong></td>
    <td><strong>SALDO CELCOIN</strong></td>
    <td><strong>PIC PAY</strong></td>
  </tr>
  <tr>
    <td>R$ <? echo number_format($res_abertura['bb'], 2, ',', '.'); ?></td>
    <td>R$ <? echo @number_format($res_abertura['bancointer'], 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($res_abertura['recargapay'], 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($res_abertura['mercadopago'], 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($res_abertura['celcoin'], 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format($res_abertura['picpay'], 2, ',', '.'); ?></td>
  </tr>
  <tr>
    <td bgcolor="#FFEADF" colspan="6"><hr /><strong>DINHEIRO INICIAL EM CAIXA</strong> <br />R$ 
	<? 
	
	?></td>
  </tr>
</table>
<? } ?>
<table width="1000" border="0">
  <tr>
    <td colspan="4" bgcolor="#00CC00"><strong>RESUMO FINAL PARA FECHAMENTO DE CAIXA</strong></td>
  </tr>
  <tr>
    <td width="224" bgcolor="#0099FF"><strong>VALOR EM DINEIRO</strong></td>
    <td width="258" bgcolor="#0099FF"><strong>VALOR EM CART&Atilde;O DE D&Eacute;BITO</strong></td>
    <td width="240" bgcolor="#0099FF"><strong>VALOR EM CART&Atilde;O DE CR&Eacute;DITO</strong></td>
    <td width="260" bgcolor="#0099FF"><strong>VALOR NO VESTE PRIME CARD</strong></td>
  </tr>
  <tr>
   <td>R$ <? echo number_format((($caixa_inicial+$valor_dinheiro+$carrinho_dinheiro+$transferencia_ted+$deposito_ted+$recebimento_faturas+$emissao)-($valor_caixa+$saque_caixa+$saque_caixa_debito+$sangria+$alivio+$resgate)), 2, ',', '.'); ?></td>
   <td>R$ <? echo number_format((($valor_cartao_debito+$carrinho_cartao_debito+$saque_caixa)), 2, ',', '.'); ?></td>
   <td>R$ <? echo number_format(($valor_cartao_credito+$carrinho_cartao_credito+$valor_caixa+$valor_ted+$valor_doc), 2, ',', '.'); ?></td>
   <td>R$ <? echo number_format(($valor_vesteprime+$carrinho_vesteprime), 2, ',', '.'); ?></td>
  </tr>
  <tr>
   <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#0099FF"><strong>VALOR EM TRANSA&Ccedil;&Atilde;O SAQUE DÉBITO</strong></td>
    <td bgcolor="#0099FF"><strong>VALOR EM TRANSA&Ccedil;&Atilde;O EMPRÉSTIMO</strong></td>
    <td bgcolor=""></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>R$ <? echo number_format($saque_caixa_com_tarifa, 2, ',', '.'); ?></td>
    <td>R$ <? echo number_format(($valor_caixa_transacao+$valor_ted_transacao+$valor_doc_transacao), 2, ',', '.'); ?></td>
    <td></td>
  </tr>
</table>
<hr />
<br />
<a class="a" rel="superbox[iframe][1000x550]" href="informar_saldo_de_choques.php?id_caixa=<? echo $id_do_caixa; ?>">INFORMAR VALORES PARA FECHAMENTO DE CAIXA</a>
<br /><br />
<script language="javascript">
		function abrePopUp(urlImagem){
			window.open(urlImagem,'Foto_Ampliada','top=150,left=500,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=350,height=400');
		}
</script>
<ul><li>Imprimir relatório transações MAQUINA BANCO DO BRASIL - <a target="_blank" onclick="abrePopUp('scripts/relatorio_bb_maquina.php?dia=<? echo date("d"); ?>&mes=<? echo date("m"); ?>&ano=<? echo date("Y"); ?>&data=<? echo date("d/m/Y"); ?>&operador=<? echo $operador; ?>');">BB</a></li>

<li>Imprimir relatório transações PIX/TRANSFERÊNCIA - <a target="_blank" onclick="abrePopUp('scripts/relatorio_pix_ted.php?dia=<? echo date("d"); ?>&mes=<? echo date("m"); ?>&ano=<? echo date("Y"); ?>&data=<? echo date("d/m/Y"); ?>&operador=<? echo $operador; ?>');">PIX</a></li>

<li>Imprimir relatório transações CARTÕES - <a target="_blank" onclick="abrePopUp('scripts/relatorio_cartao.php?dia=<? echo date("d"); ?>&mes=<? echo date("m"); ?>&ano=<? echo date("Y"); ?>&data=<? echo date("d/m/Y"); ?>&operador=<? echo $operador; ?>');">CARTÕES</a></li>

<li>Imprimir relatório transações AUTORIZAÇÕES INTERNAS - <a target="_blank" onclick="abrePopUp('scripts/relatorio_m12.php?dia=<? echo date("d"); ?>&mes=<? echo date("m"); ?>&ano=<? echo date("Y"); ?>&data=<? echo date("d/m/Y"); ?>&operador=<? echo $operador; ?>');">AUTORIZAÇÕES</a></li>


<li><a target="_blank" href="scripts/imprimir_formulario_de_fechamento_de_caixa.php?operador=<? echo $operador; ?>&data=<? echo date("d/m/Y"); ?>">Imprimir formulário de fechamento de caixa</a></li>
</ul>
<hr /><br />
<a class="a2" rel="superbox[iframe][720x110]" href="scripts/confirmar_fechamento_caixa.php?id_caixa=<? echo @$id_do_caixa; ?>">FECHAMENTO DE CAIXA</a>
<br /><br />
</div><!-- box_pagamento_1 -->
</body>
</html>