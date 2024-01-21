<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/comprovante_saque.css" rel="stylesheet" type="text/css" />
<? require "../config.php"; ?>
</head>

<body>
<script language="javascript">window.print();</script>

<table width="279" border="1">
  <tr>
    <td colspan="2" align="center" bgcolor="#0033CC"><h1><img src="../img/logo.png" width="270" height="123" /></h1> 
      <h2>COMPROVANTE DE saque<br /><?  echo date("d/m/Y H:i:s");?><br />
    </h2>
  </td>
  </tr>
  <tr>
    <td width="133" bgcolor="#CCCCCC"><strong>valor solicitado</strong></td>
    <td width="155" bgcolor="#CCCCCC"><strong>tarifa de saque</strong></td>
  </tr>
  <tr>
    <td><? echo @number_format($_GET['valor'], 2, ',', '.'); ?></td>
    <td>R$ <? echo @number_format($_GET['tarifa'], 2, ',', '.'); ?></td>
  </tr>
  <tr>
    <td colspan="4" bgcolor="#CCCCCC"> cnpj: 32.450.862/0001-02 <br />
RUA capit&atilde;o in&aacute;cio prata - 2010 - Taiba <br />
s&atilde;o gon&ccedil;alo do amarante - cear&aacute; <br />
<strong>cep: </strong>62670-000 <br />
<strong>telefone: </strong>(85) 3315.6219</td>
  </tr>
  <tr>
    <td colspan="2"><strong>cLIENTE</strong><br />
    <? echo $_GET['cliente']; ?></td>
  </tr>
  <tr>
    <td colspan="2" align="center" bgcolor="#CCCCCC"><strong>compra autenticada com senha</strong></td>
  </tr>
  <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><p><strong>AUTENTICA&Ccedil;&Atilde;O</strong> <br /><? echo md5($_GET['cliente']+$_GET['valor']); ?></p></td>
  </tr>
  <tr>
    <td colspan="2" align="justify" bgcolor="#FFFFFF"><p>ATEN&Ccedil;&Atilde;O, EM SEU EXTRATO BANCARIO IR&Aacute; APARECER COMO UMA COMPRA CONVENCIONAL.</p>
      <p>AP&Oacute;S A ENTREGA DOS VALORES N&Atilde;O SER&Aacute; POSS&Iacute;VEL ESTORNAR QUALQUER VALOR.</p>
      <p>CONFIRA O VALOR, N&Atilde;O SER&Aacute; ACEITO RECLAMA&Ccedil;&Otilde;ES POSTERIORES.</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>__________________________________________<br />
<strong>cliente: </strong><? echo $_GET['cliente']; ?></p></td>
  </tr>
</table>
<? $codigo_produto = md5($_GET['cliente']+$_GET['valor']); $tipo_servico = "SAQUE OUTROS BANCOS"; require "gerar_cupom_sorteio.php"; ?>
</div><!-- topo_geral -->
</body>
</html>