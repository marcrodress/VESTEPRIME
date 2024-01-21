<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/emitir_nota_de_pagamento.css" rel="stylesheet" type="text/css" />
</head>

<body> <script language="javascript">window.print();</script>
<?
require "../conexao.php";
$code_cupom = $_GET['code_cupom'];
  $emissao_de_nota_de_pagamento = mysqli_query($conexao_bd, "SELECT * FROM emissao_de_nota_de_pagamento WHERE code_cupom = '$code_cupom'");
	while($res_emissao_de_nota_de_pagamento = mysqli_fetch_array($emissao_de_nota_de_pagamento)){
?>
<table width="305" border="1">
  <tr>
    <td colspan="2" align="center" bgcolor="#0033CC"><h1><strong>VESTE PRIME</strong><hr /></h1> <h2><img src="../img/logo.png" width="229" height="95" /></h2>
      <h2>COMPROVANTE DE NOTA DE PAGAMENTO<br />
        <?  echo date("d/m/Y H:i:s");?><br />
      </h2>
    </td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#CCCCCC"><strong>NOTA DE PAGAMENTO<br />
VESTE PRIME - VESTUARIO E ACESSORIOS DE CELULARES</strong><br />
cnpj: 32.450.862/0001-02 <br />
RUA. capit&atilde;o in&aacute;cio prata - 2010 - Taiba <br />
s&atilde;o gon&ccedil;alo do amarante - cear&aacute; <br />
<strong>cep: </strong>62670-000 <br />
<strong>telefone: </strong>(85) 3315.6199</td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#FFF"><strong>C&Oacute;DIGo de resgaTe</strong><BR />
      <? echo $res_emissao_de_nota_de_pagamento['code_cupom']; ?></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#FFF"><strong>STATUS DA NOTA</strong><br />
    <? echo $res_emissao_de_nota_de_pagamento['status']; ?></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#CCCCCC"><strong>cliente</strong><br /></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#FFFFFF"><? echo strtoupper($res_emissao_de_nota_de_pagamento['nome']); ?></td>
  </tr> 
  <tr>
  
    <td width="137" align="center" bgcolor="#CCCCCC"><strong>cpf</strong></td>
    <td width="152" align="center" bgcolor="#CCCCCC"><strong>rg</strong></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#FFFFFF"><? echo $res_emissao_de_nota_de_pagamento['cpf']; ?></td>
    <td align="center" bgcolor="#FFFFFF"><? echo $res_emissao_de_nota_de_pagamento['rg']; ?></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#CCCCCC"><h1 class="h5"><strong>valor</strong><strong></strong></h1></td>
    <td align="center" bgcolor="#CCCCCC"><strong>restrito</strong></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#FFFFFF">R$ <? echo number_format($res_emissao_de_nota_de_pagamento['valor'], 2, ',', '.'); ?></td>
    <td align="center" bgcolor="#FFFFFF"><? echo $res_emissao_de_nota_de_pagamento['travado']; ?></td>
  </tr>
  <? if($res_emissao_de_nota_de_pagamento['status'] == 'RESGATADO'){ ?>
  <tr>
    <td align="center" bgcolor="#CCCCCC"><strong>TOTAL DE DIAS</strong></td>
    <td align="center" bgcolor="#CCCCCC"><strong>JUROS RENDIDOS</strong></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#FFFFFF"><? echo $res_emissao_de_nota_de_pagamento['dias_juros']; ?></td>
    <td align="center" bgcolor="#FFFFFF">R$ <? echo number_format($res_emissao_de_nota_de_pagamento['juros_rendidos'], 2, ',', '.'); ?></td>
  </tr>
  <tr>
    <td colspan="2" align="center" bgcolor="#CCCCCC"><strong>valor a ser recebido</strong></td>
  </tr>
  <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><p>R$ <? echo number_format($res_emissao_de_nota_de_pagamento['juros_rendidos']+$res_emissao_de_nota_de_pagamento['valor'], 2, ',', '.'); ?><br /><br />
    <p>_____________________________________<br />
    Declaro que recebi o valor acima apresentado.</p></td>
  </tr>
  <? } ?>
  <tr>
    <td colspan="2" align="center" bgcolor="#CCCCCC"><strong>autentica&ccedil;&atilde;o</strong></td>
  </tr>
  <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><? echo $res_emissao_de_nota_de_pagamento['autenticacao']; ?></td>
  </tr>
  <tr>
    <td height="38" colspan="2" align="left" bgcolor="#FFFFFF"><h1 class="h5">
    * ESTE CUPOM É O ÚNICO COMPROVANTE PARA RESGATE E DEVE SER APRESENTADO PARA RESGATE.<BR /><BR />
    * se o cliente optar por travar o recebtmento, somente o cliente pode fazer o resgate dos valores mostrando o cpf e documento de identifica&ccedil;&atilde;o com foto.</td>
  </tr>
</table>
<? } ?>

</div><!-- topo_geral -->
</body>
</html>