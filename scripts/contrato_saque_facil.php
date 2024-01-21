<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CONTRATO VESTE PRIME CARD</title>
<style type="text/css">
body {
	background-color: #fff;
	text-align:center;
	font:13px Arial, Helvetica, sans-serif;
	padding:0;
	margin:0;
}
body h1{
	font:30px Arial, Helvetica, sans-serif;
	margin:0;
	padding:0;
}
body h2{
	font:17px Arial, Helvetica, sans-serif;
	margin:0;
	padding:0;
}
</style>
</head>

<body>
<script language="javascript">window.print();</script>


<? 
require "../conexao.php";

$cliente = $_GET['cliente'];
$n_proposta = $_GET['n_proposta'];

$sql_proposta = mysqli_query($conexao_bd, "SELECT * FROM emprestimo_saque_facil WHERE n_proposta = '$n_proposta'");
while($res_proposta = mysqli_fetch_array($sql_proposta)){
?>
<table width="310" border="1">
    <td colspan="2" align="center"><h1><strong>SAQUE F&Aacute;CIL</strong><img src="../img/logo.png" width="229" height="95" /></h1>
      <h2><strong>TERMO DE RECEBIMENTO <br /> CR&Eacute;DITO DE SAQUE F&Aacute;CIL</strong><br /><?  echo date("d/m/Y H:i:s");?><br />
      (85) 99158.7323
      </h2>
    </td>
  <tr>
    <td colspan="2"><strong>N&ordm; DA PROPOSTA</strong></td>
  </tr>
  <tr>
    <td colspan="2"><? echo $res_proposta['n_proposta']; ?></td>
  </tr>
  <tr>
    <td colspan="2"><strong>CLIENTE</strong></td>
  </tr>
  <tr>
    <td colspan="2"><? echo $res_proposta['nome']; ?></td>
  </tr>
  <tr>
    <td width="141"><strong>CPF</strong></td>
    <td width="170"><strong>STATUS</strong></td>
  </tr>
  <tr>
    <td><? echo $res_proposta['cpf']; ?></td>
    <td><? echo $res_proposta['status']; ?></td>
  </tr>
  <tr>
    <td><strong>VALOR DO SAQUE</strong></td>
    <td><strong>QUANT. PARCELA</strong></td>
  </tr>
  <tr>
    <td>R$ <? echo number_format($res_proposta['valor'],2,',','.'); ?></td>
    <td><? echo $res_proposta['quant_parcela']; ?></td>
  </tr>
  <tr>
    <td colspan="2"><strong>VALOR DA PARCELA</strong></td>
  </tr>
  <tr>
    <td colspan="2">R$ <? echo number_format($res_proposta['valor_parcela'],2,',','.'); ?></td>
  </tr>
  <tr>
    <td colspan="2"><strong>VALOR TOTAL A PAGAR</strong></td>
  </tr>
  <tr>
    <td colspan="2">R$ <? echo number_format($res_proposta['valor_total'],2,',','.'); ?></td>
  </tr>
  <tr>
    <td colspan="2"><strong>FORMA DE RECEBIMENTO</strong></td>
  </tr>
  <tr>
    <td colspan="2"><? echo $res_proposta['recebimento']; ?></td>
  </tr>
  <tr>
    <td colspan="2"><strong>TERMO DE ACEITE:</strong></td>
  </tr>
  <tr>
    <td colspan="2" align="left"><p>CLAUSULA 1: Reconhe&ccedil;o o valor do cr&eacute;dito que foi apresentado e aceito por mim e tenho ci&ecirc;ncia que farei o pagamento juntamente com o vencimento da fatura do cart&atilde;o VESTE PRIME CARD, bem como o mesmo pode ser alterado sem aviso pr&eacute;vio sempre a seguir crit&eacute;rios internos da VESTE PRIME.</p>
    <p>&bull;	CLAUSULA 2: Reconhe&ccedil;o e tenho plena e total convic&ccedil;&atilde;o que se eu n&atilde;o pagar o cr&eacute;dito utilizado transcorridos 20 (dez) dias ap&oacute;s o vencimento poderei a crit&eacute;rio da institui&ccedil;&atilde;o financeira e/ou VESTE PRIME ter meu nome inclu&iacute;do nos ORG&Atilde;OS DE PROTE&Ccedil;&Atilde;O AO CR&Eacute;DITO.</p>
    <p>&bull;	CLAUSULA 3: Desde j&aacute;, autorizo a VESTE PRIME a usar o saldo de aplica&ccedil;&otilde;es e titulos de capitalaza&ccedil;&atilde;o junto a VESTE PRIME meu e/ou AVALISTA para quitar o saldo devedor referente a este cr&eacute;dito pessoal.</p>    <hr />
    <p><strong>RECONHE&Ccedil;O QUE RECEBI O VALOR INFORMADO ACIMA.</strong></p>
    <p>&nbsp;</p>
    <p>_____________________________________________<br />
	  <strong>NOME:</strong> <? echo $res_proposta['nome']; ?><br />
    <strong>CPF:</strong> <? echo $res_proposta['cpf']; ?></p></td>
  </tr>
</table>
<? } ?>
</body>
</html>