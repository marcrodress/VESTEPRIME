<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/comprovante_transferencia_ted.css" rel="stylesheet" type="text/css" />
<script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
</head>

<body>
<script language="javascript">window.print();</script>
<?
require "../conexao.php";
$id = $_GET['id'];
  $sql_ted = mysqli_query($conexao_bd, "SELECT * FROM transferencia_ted WHERE id = '$id'");
	while($res_ted = mysqli_fetch_array($sql_ted)){
?>
<table width="305" border="1">
  <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><h1><img src="../img/logoComprovante.fw.png" width="210" height="110" /></h1>
      <h2 style="font:20px Arial, Helvetica, sans-serif; color:#000;">TRANSFER&Ecirc;NCIA<br />
      <?  echo date("d/m/Y H:i:s");?></h2>
      <strong>        *Recibo simples, N&Atilde;O BANC&Aacute;RIO</strong></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#FFFFFF"> <strong>cnpj: </strong>32.450.862/0001-02 <br />
RUA. capit&atilde;o in&aacute;cio prata - 2010 - Taiba <br />
s&atilde;o gon&ccedil;alo do amarante - cear&aacute; <br />
<strong>cep: </strong>62670-000 <br />
<strong>telefone: </strong>(85) 99158.7323</td>
  </tr>
  <tr>
    <td bgcolor="#FFF"><strong>C&Oacute;DIGO</strong><BR />
      <? echo base64_encode($id*4145); ?></td>
    <td bgcolor="#FFF"><strong>STATUS</strong>
      <br /><? echo $res_ted['status']; ?></td>
  </tr>
  <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><h1 class="h5"><strong>DESTINAT&Aacute;RIO</strong><strong></strong></h1></td>
  </tr>
  <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><? echo $res_ted['nome_beneficiario']; ?>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><strong>CPF DO DESTINAT&Aacute;RIO</strong></td>
  </tr>
  <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><? echo $res_ted['cpf_beneficiario']; ?>&nbsp;</td>
  </tr>
  <tr>
    <td align="center" bgcolor="#FFFFFF"><strong>BANCO</strong></td>
    <td width="151" align="center" bgcolor="#FFFFFF"><strong>AG&Ecirc;NCIA</strong></td>
  </tr>
  <tr>
    <td height="20" align="center" bgcolor="#FFFFFF"><? echo $res_ted['banco']; ?>&nbsp;</td>
    <td align="center" bgcolor="#FFFFFF"><? echo $res_ted['agencia']; ?>&nbsp;</td>
  </tr>
  <tr>
    <td align="center" bgcolor="#FFFFFF"><strong>TIPO DE CONTA</strong></td>
    <td align="center" bgcolor="#FFFFFF"><strong>CONTA DE CR&Eacute;DITO</strong></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#FFFFFF"><? echo $res_ted['tipo_conta']; ?>&nbsp;</td>
    <td align="center" bgcolor="#FFFFFF"><? echo $res_ted['conta_beneficario']; ?>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><strong>VALOR A SER TRANSFERIDO</strong></td>
  </tr>
  <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF">R$ <? echo number_format($res_ted['valor'], 2, ',', '.'); ?>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><strong>TELEFONE DE CONTATO</strong></td>
  </tr>
  <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><? echo $res_ted['telefone_remetente']; ?></td>
  </tr>
  <tr>
    <td height="18" colspan="2" align="left" bgcolor="#FFFFFF"><h1 class="h5">      * A TRANSFER&Ecirc;NCIA SER&Aacute; REALIZADO POR UMA DAS <strong>CONTAS DA VESTE PRIME </strong>DIRETAMENTE PARA O BENEFICI&Aacute;RIO INFORMADO.
      <p>        * A TRANSFERÊNCIA ser&Aacute; realizada at&Eacute; O FIM DO DIA &Uacute;TIL PARA A CONTA DE CR&Eacute;DITO.<BR /><BR />
     * TRANSFERÊNCIAS REALIZADAS APÓS AS 14 HORAS, fins de semana e feriADO PODER&Atilde;O SER EFETIVADAS APENAS NO PRÓXIMO DIA ÚTIL.     </p></td>
  </tr>
  <tr>
    <td height="18" colspan="2" align="center" bgcolor="#FFFFFF"><div id="qrcode"></div></td>
  </tr>
</table>
<? $codigo_produto = $res_ted['id']; $tipo_servico = "TRANSFERÊNCIA TED"; require "gerar_cupom_sorteio.php"; ?>
<script>
  // Obtenha a referência do elemento onde o QR code será renderizado
  var qrcodeElement = document.getElementById("qrcode");

  // Crie um objeto QRCode
  var qrcode = new QRCode(qrcodeElement, {
    text: "http://www.ikuly.com/cliente/comprovanteTed.php?i=<? echo base64_encode($res_ted['id']) ?>", // O texto que será codificado no QR code
    width: 60, // Largura do QR code
    height: 60 // Altura do QR code
  });

  // Renderize o QR code no elemento
  qrcode.makeCode("http://www.ikuly.com/cliente/comprovanteTed.php?i=<? echo base64_encode($res_ted['id']) ?>");
</script>
<? } ?>
</div><!-- topo_geral -->
</body>
</html>