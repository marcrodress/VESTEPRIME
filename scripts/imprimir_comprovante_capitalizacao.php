<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/imprimir_comprovante_capitalizacao.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?
require "../conexao.php";
$id = $_GET['id'];
  $sql_parcela = mysqli_query($conexao_bd, "SELECT * FROM parcelas_capitalizacao WHERE id = '$id'");
	while($res_parcela = mysqli_fetch_array($sql_parcela)){
?>
<table width="305" border="0">
  <tr>
    <td colspan="2" align="center" bgcolor="#0033CC"><h1><img src="../img/logo.png" width="229" height="95" /></h1>
      <h2>PAGAMENTO DE CAPITALIZA&Ccedil;&Atilde;O<br />
        <?  echo date("d/m/Y H:i:s");?><br />
      </h2>
    </td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#CCCCCC"><strong>COMPROVANTE DE PAGAMENTO DE T&Iacute;TULO DE CAPITALIZA&Ccedil;&Atilde;O</strong><br />
cnpj: 32.450.862/0001-02 <br />
RUA. capit&atilde;o in&aacute;cio prata - 2010 - Taiba <br />
s&atilde;o gon&ccedil;alo do amarante - cear&aacute; <br />
<strong>cep: </strong>62670-000 <br />
<strong>telefone: </strong>(85) 3315.6199</td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#FFF"><strong>CLIENTE</strong><BR /><? echo $res_ted['nome_remetente']; ?></td>
  </tr>
  <tr>
    <td colspan="2" align="center" bgcolor="#CCCCCC"><strong>CPF DO CLIENTE</strong></td>
  </tr>
  <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><? echo $res_parcela['cliente']; ?></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#CCCCCC"><strong>c&oacute;d. t&iacute;tulo</strong></td>
    <td width="151" align="center" bgcolor="#CCCCCC"><strong>PARCELA</strong></td>
  </tr>
  <tr>
    <td height="20" align="center" bgcolor="#FFFFFF"><? echo $res_parcela['code_capitalizacao']; ?></td>
    <td align="center" bgcolor="#FFFFFF"><? echo $res_parcela['n_parcela']; ?></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#CCCCCC"><strong>status</strong></td>
    <td align="center" bgcolor="#CCCCCC"><strong>vencimento</strong></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#FFFFFF"><? echo $res_parcela['status']; ?></td>
    <td align="center" bgcolor="#FFFFFF"><? echo $res_parcela['vencimento']; ?></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#CCCCCC"><strong>valor</strong></td>
    <td align="center" bgcolor="#CCCCCC"><strong>multa</strong></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#FFFFFF">R$ <? echo number_format($res_parcela['valor'],2,',','.'); ?></td>
    <td align="center" bgcolor="#FFFFFF">R$ <? echo number_format($res_parcela['multa'],2,',','.'); ?></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#CCCCCC"><strong>juros</strong></td>
    <td align="center" bgcolor="#CCCCCC"><strong>valor recebido</strong></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#FFFFFF">R$ <? echo number_format($res_parcela['juros'],2,',','.'); ?></td>
    <td align="center" bgcolor="#FFFFFF">R$ <? echo number_format($res_parcela['vl_recebido'],2,',','.'); ?></td>
  </tr>
  <tr>
    <td height="38" colspan="2" align="center" bgcolor="#CCCCCC"><strong>FORMA DE PAGAMENTO</strong></td>
  </tr>
  <tr>
    <td height="38" colspan="2" align="center" bgcolor="#FFFFFF"><? echo $res_parcela['forma_pagt']; ?></td>
  </tr>
  <tr>
    <td height="38" colspan="2" align="center" bgcolor="#CCCCCC"><strong>DATA DE PAGAMENTO</strong></td>
  </tr>
  <tr>
    <td height="38" colspan="2" align="center" bgcolor="#FFFFFF"><? echo $res_parcela['data_pagt']; ?></td>
  </tr>
  <tr>
    <td height="38" colspan="2" align="left" bgcolor="#FFFFFF"><hr />
    <p><strong style="font:10px Arial, Helvetica, sans-serif; text-decoration:none;">*Este comprovante &Eacute; o &uacute;nico comprovante de pagamento devendo ser apresentado sempre que necess&aacute;rio.</strong></p></td>
  </tr>
</table>
<? } ?>
</div><!-- topo_geral -->
</body>
</html>