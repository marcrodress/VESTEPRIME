<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/comprovante_saque_transferencia.css" rel="stylesheet" type="text/css" />
</head>

<body>
<script language="javascript">
 window.print();
</script>

<?
require "../conexao.php";
$id = $_GET['id'];
  $sql_ted = mysqli_query($conexao_bd, "SELECT * FROM saque_transferencia WHERE id = '$id'");
	while($res_ted = mysqli_fetch_array($sql_ted)){
?>
<table width="305" border="1">
  <tr>
    <td colspan="3" align="center" bgcolor="#0033CC"><h2><img src="../img/logo.png" width="229" height="95" /></h2>
      <h2>COMPROVANTE DE SAQUE TRANSFER&Ecirc;NCIA<br />
        <?  echo date("d/m/Y H:i:s");?><br />
      </h2>
    </td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#CCCCCC"><strong>CUPOM emitido por <br />
VESTE PRIME - VESTUARIO E ACESSORIOS DE CELULARES</strong><br />
cnpj: 32.450.862/0001-02 <br />
RUA. capit&atilde;o in&aacute;cio prata - 2010 - Taiba <br />
s&atilde;o gon&ccedil;alo do amarante - cear&aacute; <br />
<strong>cep: </strong>62670-000 <br />
<strong>telefone: </strong>(85) 3315.6219</td>
  </tr>
  <tr>
    <td width="135" bgcolor="#FFF"><strong>C&Oacute;DIGO</strong><BR />
      <? echo $res_ted['codigo']; ?></td>
    <td colspan="2" bgcolor="#FFF"><strong>CLIENTE</strong><BR /><? echo $res_ted['cliente']; ?></td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#CCCCCC"><strong>STATUS</strong>
      <br /><? echo $res_ted['status']; ?></td>
  </tr>
  <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><strong>BANCO</strong></td>
    <td width="151" align="center" bgcolor="#FFFFFF"><strong>AG&Ecirc;NCIA</strong></td>
  </tr>
  <tr>
    <td height="20" colspan="2" align="center" bgcolor="#FFFFFF"><? echo $res_ted['banco']; ?>&nbsp;</td>
    <td align="center" bgcolor="#FFFFFF"><? echo $res_ted['agencia']; ?>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><strong>TIPO DE CONTA</strong></td>
    <td align="center" bgcolor="#FFFFFF"><strong>CONTA</strong></td>
  </tr>
  <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><? echo $res_ted['tipo']; ?>&nbsp;</td>
    <td align="center" bgcolor="#FFFFFF"><? echo $res_ted['conta']; ?>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" align="center" bgcolor="#FFFFFF"><strong>VALOR TRANSFERIDO</strong></td>
  </tr>
  <tr>
    <td colspan="3" align="center" bgcolor="#FFFFFF">R$ <? echo number_format($res_ted['valor'], 2, ',', '.'); ?>&nbsp;</td>
  </tr>
  <tr>
    <td height="38" colspan="3" align="left" bgcolor="#FFFFFF"><p>EU, <? echo $res_ted['cliente']; ?> DECLARO QUE TRANSFERI A IMPORT&Acirc;NCIA R$ <? echo number_format($res_ted['valor'], 2, ',', '.'); ?> para a conta da veste prime/s&oacute;cio no banco de  c&oacute;digo <? echo $res_ted['banco']; ?> e que recebi o dinheiro em esp&eacute;cie no balc&atilde;o de atendimento.</p>
      <p>&nbsp;</p>
      <p>_________________________________________<BR />
      CPF:<? echo $res_ted['cpf']; ?>
      <br />
      <? echo $res_ted['cliente']; ?>
    </p></td>
  </tr>
</table>
<? } ?>
</div><!-- topo_geral -->
</body>
</html>