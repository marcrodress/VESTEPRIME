<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/imprimir_comprovante_pagamento_easy_card.css" rel="stylesheet" type="text/css" />
</head>

<body>
<script language="javascript">window.print();</script>

<? require "../conexao.php"; ?>
<table width="305" border="1">
  <tr>
    <td align="center" bgcolor="#0033CC"><h1><strong>VESTE PRIME</strong><hr />
      <img src="../img/logo.png" width="277" height="156" /></h1> 
      <h2>COMPROVANTE DE pagamento cart&atilde;o VESTE PRIME CARD<br /><?  echo date("d/m/Y H:i:s");?><br />
    </h2>
  </td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#CCCCCC"><strong> Veste Prime - Vestuário e acessórios de celulares </strong><br />
cnpj: 32.450.862/0001-02 <br />
av. capit&atilde;o in&aacute;cio prata - 2010 - Taiba <br />
s&atilde;o gon&ccedil;alo do amarante - cear&aacute; <br />
<strong>cep: </strong>62670-000 <br />
<strong>telefone: </strong>(85) 3315.6199</td>
  </tr>  
  <tr>
    <td bgcolor="#CCCCCC"><hr />      <strong>cliente</strong></td>
  </tr>
  <tr>
    <td><strong>cpf:</strong><? echo $cpf_client = $_GET['cliente']; ?><br /><?
    
	$sql_nome_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '$cpf_client'");
		while($res_nome_cliente = mysqli_fetch_array($sql_nome_cliente)){
			echo $res_nome_cliente['nome'];
	}
	
	
	?></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC"><strong>valor do pagamento</strong><strong></strong></td>
  </tr>
  <tr>
    <td>R$ <? echo number_format($_GET['valor'],2); ?></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#FFFFFF"><p><strong>AUTENTICA&Ccedil;&Atilde;O</strong> <br /><? echo md5($_GET['valor_parcela']*$_GET['parcela']); ?></p></td>
  </tr>
</table>
<?  ?>
</div><!-- topo_geral -->
</body>
</html>