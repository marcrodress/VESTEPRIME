<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CONTRATO DE NEGOCIA&Ccedil;&Atilde;O DE D&Eacute;BITO</title>
<link href="css/contrato_negociacao.css" rel="stylesheet" type="text/css" />
</head>

<body>
<script language="javascript">window.print();</script>
<? require "../conexao.php"; ?>
<?
$sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '".$_GET['cliente']."'");
while($res_cliente = mysqli_fetch_array($sql_cliente)){

$sql_negociacao = mysqli_query($conexao_bd, "SELECT * FROM negociacoes WHERE code = '".$_GET['negociacao']."'");
while($res_negociacao = mysqli_fetch_array($sql_negociacao)){

$sql_operador = mysqli_query($conexao_bd, "SELECT * FROM adm WHERE cpf = '".$_GET['operador']."'");
while($res_operador = mysqli_fetch_array($sql_operador)){


?>
<div id="box">
<table width="995" border="0">
  <tr>
    <td colspan="2" align="center"><p><img src="../img/index.png" width="236" height="154" /></p>
      <p style="font:20px Arial, Helvetica, sans-serif;"><strong>TERMO DE CONFIRMA&Ccedil;&Atilde;O DE NEGOCIA&Ccedil;&Atilde;O DE D&Iacute;VIDA</strong></p></td>
  </tr>
  <tr>
    <td colspan="2">Eu, <? echo strtoupper($res_cliente['nome']); ?>, inscrito no CPF: <? echo $res_cliente['cpf']; ?> e RG: <? echo $res_cliente['rg']; ?> e domiciliando no endere&ccedil;o: <? echo $res_cliente['endereco']; ?> - <? echo $res_cliente['n_residencia']; ?> - <? echo $res_cliente['bairro']; ?> - <? echo $res_cliente['cidade']; ?>, <? echo $res_cliente['estado']; ?> - CEP: <? echo $res_cliente['cep']; ?>, reconhe&ccedil;o a negocia&ccedil;&atilde;o de minha d&iacute;vida junto a empresa MARCOS RODRIGUES DE OLIVEIRA 05379839371, inscrita no CNPJ: 32.450.862/0001-02, tendo como nome fantasia VESTE PRIME no valor total de R$ <? echo number_format($res_negociacao['divida_total'],2,',','.'); ?> e que ap&oacute;s a negocia&ccedil;&atilde;o de minha divida passa a ser R$ <? echo number_format($res_negociacao['divital_total'],2,',','.'); ?> divida em <? echo $res_negociacao['n_parcelas']; ?> parcelas iguais no valor de R$ <? echo number_format($res_negociacao['valor_parcela'],2,',','.'); ?> a ser pagas pontualmente na data de vencimento da minha divida, tendo conci&ecirc;ncia que caso eu n&atilde;o pague at&eacute; a data de vencimento eu terei que arcar com juros e multas.</td>
  </tr>
  <tr>
    <td colspan="2"><p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p></td>
  </tr>
  <tr>
    <td width="510"><strong>TESTEMUNHA 1</strong></td>
    <td width="475"><strong>TESTEMUNHA 2</strong></td>
  </tr>
  <tr>
    <td>NOME: _____________________________</td>
    <td>NOME: ________________________________</td>
  </tr>
  <tr>
    <td>CPF: ____________________________</td>
    <td>CPF: __________________________________</td>
  </tr>
  <tr>
    <td colspan="2"><p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p></td>
  </tr>
  <tr>
    <td colspan="2" align="center">
<strong>Taiba, </strong>S&atilde;o Gon&ccedil;alo do Amarante, <? echo date("d"); ?> de <? $mes = date("m");
		
		if($mes == '1'){
			echo "janeiro";
		}elseif($mes == '2'){
			echo "fevereiro";
		}elseif($mes == '3'){
			echo "março";
		}elseif($mes == '4'){
			echo "abril";
		}elseif($mes == '5'){
			echo "maio";
		}elseif($mes == '6'){
			echo "junho";
		}elseif($mes == '7'){
			echo "julho";
		}elseif($mes == '8'){
			echo "agosto";
		}elseif($mes == '9'){
			echo "setembro";
		}elseif($mes == '10'){
			echo "outubro";
		}elseif($mes == '11'){
			echo "novembro";
		}else{
			echo "dezembro";
		}
	
	 ?> de  <? echo date("Y"); ?>    
    </td>
  </tr>
  <tr>
    <td colspan="2" align="center"><p>________________________________________________ <br />
      Nome: <? echo strtoupper($res_cliente['nome']); ?></p>
      <p>CPF: <? echo strtoupper($res_cliente['cpf']); ?></p></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><p>_________________________________________</p>
      <p>OPERADOR AUTORIZADO</p></td>
  </tr>
  <tr>
    <td colspan="2" align="center">Nome: <? echo strtoupper($res_operador['nome']); ?></td>
  </tr>
  <tr>
    <td colspan="2" align="center">CPF:<? echo $_GET['operador']; ?></td>
  </tr>
</table>
<? }}} ?>
</div><!-- box -->
</body>
</html>