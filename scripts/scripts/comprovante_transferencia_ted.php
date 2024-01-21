<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/comprovante_transferencia_ted.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?
require "../conexao.php";
$id = $_GET['id'];
  $sql_ted = mysqli_query($conexao_bd, "SELECT * FROM transferencia_ted WHERE id = '$id'");
	while($res_ted = mysqli_fetch_array($sql_ted)){
?>
<table width="305" border="1">
  <tr>
    <td colspan="3" align="center" bgcolor="#0033CC"><h1><strong>VESTE PRIME</strong><hr /></h1> <h2><img src="../img/logo.png" width="229" height="95" /></h2>
      <h2>COMPROVANTE DE TRANSFER&Ecirc;NCIA TED/DOC<br />
        <?  echo date("d/m/Y H:i:s");?><br />
      </h2>
    </td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#CCCCCC"><strong>CUPOM de venda emitido por <br />
VESTE PRIME - VESTUARIO E ACESSORIOS DE CELULARES</strong><br />
cnpj: 32.450.862/0001-02 <br />
RUA. capit&atilde;o in&aacute;cio prata - 2010 - Taiba <br />
s&atilde;o gon&ccedil;alo do amarante - cear&aacute; <br />
<strong>cep: </strong>62670-000 <br />
<strong>telefone: </strong>(85) 3315.6219</td>
  </tr>
  <tr>
    <td width="135" bgcolor="#FFF"><strong>C&Oacute;DIGO</strong><BR />
      <? echo base64_encode($id*4145); ?></td>
    <td colspan="2" bgcolor="#FFF"><strong>CLIENTE</strong><BR /><? echo $res_ted['nome_remetente']; ?></td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#CCCCCC"><strong>STATUS</strong>
      <br /><? echo $res_ted['status']; ?></td>
  </tr> 
  <tr>
  
    <td colspan="3" align="center" bgcolor="#CCCCCC"><strong>ENVIANTE</strong></td>
  </tr>
  <tr>
    <td colspan="3" align="center" bgcolor="#FFFFFF"><? echo $res_ted['cpf_remetente']; ?></td>
  </tr>
  <tr>
    <td colspan="3" align="center" bgcolor="#CCCCCC"><h1 class="h5"><strong>DESTINAT&Aacute;RIO</strong><strong></strong></h1></td>
  </tr>
  <tr>
    <td colspan="3" align="center" bgcolor="#FFFFFF"><? echo $res_ted['nome_beneficiario']; ?>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" align="center" bgcolor="#CCCCCC"><strong>CPF DO DESTINAT&Aacute;RIO</strong></td>
  </tr>
  <tr>
    <td colspan="3" align="center" bgcolor="#FFFFFF"><? echo $res_ted['cpf_beneficiario']; ?>&nbsp;</td>
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
    <td align="center" bgcolor="#FFFFFF"><strong>CONTA DE CR&Eacute;DITO</strong></td>
  </tr>
  <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><? echo $res_ted['tipo_conta']; ?>&nbsp;</td>
    <td align="center" bgcolor="#FFFFFF"><? echo $res_ted['conta_beneficario']; ?>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" align="center" bgcolor="#FFFFFF"><strong>VALOR A SER TRANSFERIDO</strong></td>
  </tr>
  <tr>
    <td colspan="3" align="center" bgcolor="#FFFFFF">R$ <? echo number_format($res_ted['valor'], 2, ',', '.'); ?>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" align="center" bgcolor="#FFFFFF"><strong>OBSERVA&Ccedil;&Otilde;ES DO ENVIO</strong></td>
  </tr>
  <tr>
    <td colspan="3" align="center" bgcolor="#FFFFFF"><? echo $res_ted['observacoes']; ?>&nbsp;</td>
  </tr>
  <tr>
    <td height="38" colspan="3" align="left" bgcolor="#FFFFFF"><h1 class="h5">
    * ESTE CUPOM É O ÚNICO COMPROVANTE DE transfer&ecirc;ncia.<BR /><BR />
    * A TRANSFER&Ecirc;NCIA SER&Aacute; REALIZADO POR UMA DAS CONTAS DA VESTE PRIME DIRETAMENTE PARA O BENEFICI&Aacute;RIO INFORMADO.<br /><BR />
    * A TRANSFERÊNCIA PODE DEMORAR ATÉ 4 HORAS PARA SER EFETIVADA.<BR /><BR />
    * TRANSFERÊNCIAS REALIZADAS APÓS AS 15 HORAS PODERAM SER EFETIVADAS APENAS NO PRÓXIMO DIA ÚTIL.
    </td>
  </tr>
</table>
<? } ?>
</div><!-- topo_geral -->
</body>
</html>