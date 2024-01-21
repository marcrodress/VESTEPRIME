<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/termo_recebimento_de_emprestimo_cartoa.css" rel="stylesheet" type="text/css" />
</head>

<body>
<script language="javascript">window.print();</script>
<table width="305" border="1">
  <tr>
    <td align="center" bgcolor="#0033CC"><h1><img src="../img/logo.png" width="327" height="168" /></h1> 
      <h2>termo de recebimento de valores
      <?  echo date("d/m/Y H:i:s");?>
      <br />
    </h2>
  </td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#CCCCCC"><strong>comprovante de entrega de valores de empr&eacute;stimo contratato</strong><br />
cnpj: 32.450.862/0001-02 <br />
RUA capit&atilde;o in&aacute;cio prata - 2010 - Taiba <br />
s&atilde;o gon&ccedil;alo do amarante - cear&aacute; <br />
<strong>cep: </strong>62670-000 <br />
<strong>telefone: </strong>(85) 4042 2728</td>
  </tr>  
  <tr>
    <td bgcolor="#CCCCCC"><strong>CPF</strong></td>
  </tr>
  <tr>
    <td><? echo $_GET['cpf']; ?></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC"><strong>cliente</strong></td>
  </tr>
  <tr>
    <td><? echo $_GET['nome']; ?></td>
  </tr>
  <tr>
    <td><strong>valor recebido</strong></td>
  </tr>
  <tr>
    <td>R$ <? echo number_format($_GET['valor'], 2, ',', '.'); ?></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#CCCCCC"><strong>compra autenticada com senha de seguran&ccedil;a</strong></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#FFFFFF"><p><strong>AUTENTICA&Ccedil;&Atilde;O</strong> <br /><? echo @md5($_GET['valor_parcela']*$_GET['parcela']); ?></p></td>
  </tr>
  <tr>
    <td align="left" bgcolor="#FFFFFF"><p>DECLARO PARA DEVIDOS FINS QUE RECEBI A IMPORTANCIA DE R$  <? echo number_format($_GET['valor'], 2, ',', '.'); ?> REFERENTE UM EMPR&Eacute;STIMO FEITO COM A VESTE PRIME - VESTUÁRIO E ACESSÓRIOS DE CELULARES.</p>
    <p>&nbsp;</p>
    <p>__________________________________________</p>
    <p>cliente: <? echo $_GET['nome']; ?></p></td>
  </tr>
</table>
<?  ?>
</div><!-- topo_geral -->
</body>
</html>