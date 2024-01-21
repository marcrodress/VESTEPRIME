<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/comprovante_transferencia_ted.css" rel="stylesheet" type="text/css" />
</head>

<body>
<script language="javascript">window.print();</script>
<? require "../conexao.php"; ?>


<table width="305" border="1">
  <tr>
    <td colspan="2" align="center" bgcolor="#0033CC"><h1><img src="../img/logo.png" width="229" height="95" /></h1>
      <h2>COMPROVANTE DE RECARGA DE CELULAR PRE PAGO<br />
        <?  echo date("d/m/Y H:i:s");?>
      </h2>
    </td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#CCCCCC"><strong>CUPOM de venda emitido por <br />
VESTE PRIME - VESTUARIO E ACESSORIOS DE CELULARES</strong><br />
cnpj: 32.450.862/0001-02 <br />
RUA. capit&atilde;o in&aacute;cio prata - 2010 - Taiba <br />
s&atilde;o gon&ccedil;alo do amarante - cear&aacute; <br />
<strong>cep: </strong>62670-000 <br />
<strong>telefone: </strong>(85) 3315.6219</td>
  </tr>
  <tr>
    <td width="139" align="center" bgcolor="#FFFFFF"><strong>OPERADORA</strong></td>
    <td width="149" align="center" bgcolor="#FFFFFF"><strong>N&Uacute;MERO</strong></td>
  </tr>
  <tr>
    <td height="20" align="center" bgcolor="#FFFFFF"><? echo $_GET['operadora']; ?>&nbsp;</td>
    <td align="center" bgcolor="#FFFFFF"><? echo $_GET['numero']; ?>&nbsp;</td>
  </tr>
  <tr>
    <td align="center" bgcolor="#FFFFFF"><strong>NSU</strong></td>
    <td align="center" bgcolor="#FFFFFF"><strong>VALOR</strong></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#FFFFFF"><? echo $_GET['nsu']; ?></td>
    <td align="center" bgcolor="#FFFFFF">R$ <? echo number_format($_GET['valor_recarga'], 2, ',', '.'); ?></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#FFFFFF"><strong>TARIFA</strong></td>
    <td align="center" bgcolor="#FFFFFF"><strong>FORMA PAGAMENTO</strong></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#FFFFFF">R$ <? echo number_format($_GET['tarifa'], 2, ',', '.'); ?></td>
    <td align="center" bgcolor="#FFFFFF"><? echo $_GET['pagamento']; ?></td>
  </tr>
  <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><strong>AUTENTICA&Ccedil;&Atilde;O</strong></td>
  </tr>
  <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><? echo $_GET['autenticacao']; ?></td>
  </tr>
  <tr>
    <td height="38" colspan="2" align="left" bgcolor="#FFFFFF">O PROCESSAMENTO E EFETIVA&Ccedil;&Atilde;O DA RECARGA &Eacute; &Uacute;NICA E EXCLUSIVA DA OPERADORA, CASO TENHA PROBLEMAS, POR FAVOR, LIGUE PARA A OPERADORA INFORMANDO O NSU.</td>
  </tr>
</table>
<? $codigo_produto = $_GET['autenticacao']; $tipo_servico = "RECARGA DE CELULAR PRÉ-PAGO"; require "gerar_cupom_sorteio.php"; ?>


<? if($_GET['pagamento'] == 'VESTE PRIME'){ ?>

<table width="305" border="1" style="page-break-before: always;">
  <tr>
    <td colspan="2" align="center" bgcolor="#0033CC"><h1><img src="../img/logo.png" width="270" height="134" /></h1> 
      <h2>COMPROVANTE DE VENDA CART&Atilde;O VESTE CARD <?  echo date("d/m/Y H:i:s");?><br />
    </h2>
  </td>
  </tr>
  <tr>
    <td colspan="4" bgcolor="#CCCCCC"><strong>comprovante de uso do cartão<br /> 
    VESTE PRIME - VESTU&Aacute;RIO E ACESS&Oacute;RIOS DE CELULARES
</strong><br />
cnpj: 32.450.862/0001-02<br />
RUA capit&atilde;o in&aacute;cio prata - 2010 - Taiba <br />
s&atilde;o gon&ccedil;alo do amarante - cear&aacute; <br />
<strong>cep: </strong>62670-000 <br />
<strong>telefone: </strong>(85) 3315.6199</td>
  </tr>  
  <tr>
    <td width="128" bgcolor="#CCCCCC"><strong>cliente</strong></td>
    <td width="161" bgcolor="#CCCCCC"><strong>valor da transA&Ccedil;&Atilde;O</strong></td>
  </tr>
  <tr>
    <td><? echo $_GET['cliente']; ?></td>
    <td>R$ <? echo number_format($_GET['tarifa']+$_GET['valor_recarga'], 2, ',', '.'); ?></td>
  </tr>
  <tr>
    <td colspan="2" align="center" bgcolor="#CCCCCC"><strong>compra autenticada com senha de seguran&ccedil;a</strong></td>
  </tr>
  <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><p><strong>AUTENTICA&Ccedil;&Atilde;O</strong> <br /><? echo md5($_GET['valor_recarga']*$_GET['valor_recarga']); ?></p></td>
  </tr>
  <tr>
    <td colspan="2" align="left" bgcolor="#FFFFFF"><p>RECONHE&Ccedil;O MINHA D&Iacute;VIDA descrita acima  informada e declaro que pagarei  seu valor at&eacute; a data de vencimento da fatura..</p>
      <p>tenho plena e total convic&ccedil;&atilde;o e estou em pleno acordo que se eu n&atilde;o pagar a divida acima descrita em at&eacute; 10 dias corridos ap&oacute;s o vencimento da fatura terei meu nome inclu&iacute;do nos org&atilde;os de prote&ccedil;&atilde;o ao cr&eacute;dito.</p>
    <p>&nbsp;</p>
    <p>__________________________________________</p>
    <p>cliente: <? echo $_GET['cliente']; ?></p></td>
  </tr>
</table>
<? } ?>
</div><!-- topo_geral -->
</body>
</html>