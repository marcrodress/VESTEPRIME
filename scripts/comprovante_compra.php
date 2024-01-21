<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/comprovante_compra.css" rel="stylesheet" type="text/css" />
</head>

<body>
<script language="javascript">window.print();</script>
<? require "../conexao.php"; ?>

<table width="305" border="1">
  <tr>
    <td colspan="2" align="center" bgcolor="#0033CC"><h1><strong>VESTE PRIME CARD</strong><hr />
      <img src="../img/logo.png" width="270" height="134" /></h1> 
      <h2>COMPROVANTE DE VENDA CART&Atilde;O VESTE CARD <br /><?  echo date("d/m/Y H:i:s");?><br />
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
    <td width="128" colspan="2" bgcolor="#CCCCCC"><strong>CLIENTE</strong></td>
  </tr>
  <tr>
    <td width="128" colspan="2" bgcolor="#FFFFFF">
    <?
	$sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '".$_GET['cliente']."'");
		while($res_cliente = mysqli_fetch_array($sql_cliente)){
			echo strtoupper($res_cliente['nome']);
		}    
	?>
    </td>
  </tr>
  <tr>
    <td width="128" bgcolor="#CCCCCC"><strong>CPF</strong></td>
    <td width="161" bgcolor="#CCCCCC"><strong>valor da transA&Ccedil;&Atilde;O</strong></td>
  </tr>
  <tr>
    <td><? echo $_GET['cliente']; ?></td>
    <td>R$ <? echo number_format($_GET['valor_parcela']*$_GET['parcela'],2,',','.'); ?></td>
  </tr>
  <tr>
    <td><strong>QUANT. PARCELAS</strong></td>
    <td><strong>VALOR DA PARCELA</strong></td>
  </tr>
  <tr>
    <td><? echo $_GET['parcela']; ?></td>
    <td>R$ <? echo number_format($_GET['valor_parcela'],2,',','.'); ?></td>
  </tr>
  <tr>
    <td colspan="2" align="center" bgcolor="#CCCCCC"><strong>compra autenticada com senha de seguran&ccedil;a</strong></td>
  </tr>
  <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><p><strong>AUTENTICA&Ccedil;&Atilde;O</strong> <br /><? echo md5($_GET['valor_parcela']*$_GET['parcela']); ?></p></td>
  </tr>
  <tr>
    <td colspan="2" align="left" bgcolor="#FFFFFF"><p>RECONHE&Ccedil;O MINHA D&Iacute;VIDA informada acima e declaro que pagarei  seu valor at&eacute; a data de vencimento da fatura..</p>
      <p>tenho plena e total convic&ccedil;&atilde;o e estou em pleno acordo que se eu n&atilde;o pagar a divida acima descrita em at&eacute; 10 dias corridos ap&oacute;s o vencimento da fatura terei meu nome inclu&iacute;do nos org&atilde;os de prote&ccedil;&atilde;o ao cr&eacute;dito.</p>
    <p>&nbsp;</p>
    <p>__________________________________________</p>
    <p><strong>NOME DO CLIENTE:</strong><br /> <? 
	
	$sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '".$_GET['cliente']."'");
		while($res_cliente = mysqli_fetch_array($sql_cliente)){
			echo strtoupper($res_cliente['nome']);
		}
	
	 $_GET['cliente']; ?><br /><strong>CPF: </strong><? echo $_GET['cliente']; ?></p></td>
  </tr>
</table>
<?  ?>
</div><!-- topo_geral -->
</body>
</html>