<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/imprimir_contrato.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="box">
 <? include "../../conexao.php"; ?>     
      <?
	  $cpf = $_GET['cpf'];
	  $n_proposta = $_GET['n_proposta'];
	  
      $sql_1 = mysql_query("SELECT * FROM clientes WHERE cpf = '$cpf'");
	  	while($res = mysql_fetch_array($sql_1)){
			
      $sql_2 = mysql_query("SELECT * FROM envio_de_propostas WHERE n_proposta = '$n_proposta'");
	  	while($res2 = mysql_fetch_array($sql_2)){	
		
		$valor_solicitado = $res2['valor_solicitado'];
		$valor_parcelas = $res2['valor_parcelas'];
		$quantidade_parcelas = $res2['quantidade_parcelas'];
		$cpf = $res2['cpf'];
				
			
      $sql_3 = mysql_query("SELECT * FROM clientes WHERE cpf = '$cpf'");
	  	while($res3 = mysql_fetch_array($sql_3)){									
	  ?>
      
      <br />
      
      
  <table width="950" border="1">
    <tr>
      <td align="center" colspan="3"><img src="../../img/index.png" width="150" height="80" /></td>
    </tr>
    <tr>
      <td width="317"><strong>N&ordm; da prop&oacute;sta:</strong></td>
      <td width="305"><strong>Loja: </strong></td>
      <td width="306"><strong>Promotor: </strong></td>
    </tr>
    <tr>
      <td><? echo $n_proposta = $_GET['n_proposta']; ?></td>
      <td>Easy Loan Financial Services</td>
      <td>Marcos Rodrigues de Oliveira</td>
    </tr>
    <tr>
      <td colspan="3"><strong>Cliente:</strong> <? echo $res['nome']; ?></td>
    </tr>
    <tr>
      <td><strong>CPF:</strong></td>
      <td><strong>Data de nascimento:</strong></td>
      <td><strong>RG: </strong></td>
    </tr>
    <tr>
      <td height="10"><? echo $_GET['cpf']; ?></td>
      <td height="10"><? echo $res['nascimento']; ?></td>
      <td height="10"><? echo $res['rg']; ?></td>
    </tr>
    <tr>
      <td height="11" colspan="3" bgcolor="#CCCCCC" align="center"><img src="../img/emprestimo.png" /></td>
    </tr>
    <tr>
      <td><strong>Valor solicitado:</strong></td>
      <td><strong>Valor da parcela:</strong></td>
      <td><strong>Valor total a ser pago:</strong></td>
    </tr>
    <tr>
      <td> R$ <? echo @number_format($valor_solicitado,2,",","."); ?></td>
      <td>R$ <? echo @number_format($valor_parcelas,2,",","."); ?></td>
      <td>R$
      <? $total = $valor_parcelas*$quantidade_parcelas; echo number_format($total,2,",","."); ?></td>
    </tr>
    <tr>
      <td><strong>Banco para realizar o cr&eacute;dito:</strong></td>
      <td><strong>Ag&ecirc;ncia / Tipo de conta:</strong></td>
      <td><strong>Conta que vai receber o cr&eacute;dito:</strong></td>
    </tr>
    <tr>
      <td><? echo $res3['nome_banco']; ?></td>
      <td><? echo $res3['agencia']; ?> / <? echo $res3['tipo_de_conta']; ?></td>
      <td><? echo $res3['conta_bancaria']; ?></td>
    </tr>
    <tr>
      <td colspan="3" bgcolor="#CCC" align="center"><img src="../img/contrato.png" /></td>
    </tr>
    <tr>
      <td colspan="3"><p>Pelo presente contrato apresenta-se cláusulas com termos que  ser&aacute; obedecido entre <strong><? echo $res['nome']; ?></strong> e a <strong>Easy Loan Financial Services</strong> inscrita no  CNPJ sob n&ordm;<strong> 18.471.972/0001.20</strong>.</p>
        <p><strong> Cl&aacute;usula 1&ordf; - </strong>Este  contrato trata-se de um empr&eacute;stimo oferecido pela Easy Loan Financial Services  no cart&atilde;o de cr&eacute;dito deste cliente, e que o mesmo est&aacute; ciente que de forma  alguma ser&aacute; feito o estorno conforme os crit&eacute;rios da cl&aacute;usula 5&ordm;.</p>
        <p><strong>Cl&aacute;usula 2&ordf; &ndash; </strong>Os valores  dos empr&eacute;stimos s&atilde;o distribu&iacute;dos da seguinte forma: </p>
        <ul>
          <li>Valor solicitado: R$ <? echo @number_format($valor_solicitado,2,",","."); ?></li>
          <li>Valor de cada parcela: R$ <? echo $quantidade_parcelas; echo "X "; echo @number_format($valor_parcelas,2,",","."); ?></li>
          <li>Valor total que foi realizado o d&eacute;bito no cart&atilde;o  do cliente: R$ <? $total = $valor_parcelas*$quantidade_parcelas; echo number_format($total,2,",","."); ?></li>
        </ul>
        <p><strong> Cl&aacute;usula 3&ordf; &ndash; </strong>O  valor solicitado do empr&eacute;stimo ser&aacute; creditado na conta banc&aacute;ria do cliente  informado pelo mesmo no momento da realiza&ccedil;&atilde;o ou atualiza&ccedil;&atilde;o do cadastro no  prazo m&aacute;ximo de 120 horas &uacute;teis (5 dias &uacute;teis), sendo que o cliente est&aacute;  cliente do prazo e que n&atilde;o poder&aacute; fazer qualquer tipo de reclama&ccedil;&atilde;o posterior.</p>
        <p>&nbsp;<strong>Cl&aacute;usula 4&ordf; &ndash; </strong>As cobran&ccedil;as referentes ao empr&eacute;stimo v&ecirc;m na fatura do  cart&atilde;o do cliente e o vencimento de cada parcela &eacute; a mesma da data de  vencimento da fatura do cart&atilde;o do titular independentemente de qual data foi  feito o empr&eacute;stimo.</p>
        <p><strong>Cl&aacute;usula 5&ordf; &ndash; </strong>O  cliente s&oacute; ser&aacute; reembolsado seguindo os seguintes crit&eacute;rios:</p>
        <ul>
          <li>Falha no sistema da Easy Loan Financial Services ou da empresa  parceira que impossibilite a cobran&ccedil;a do cart&atilde;o de cr&eacute;dito.</li>
          <li>Solicita&ccedil;&atilde;o de cancelamento feito pelo cliente  em at&eacute; 24 horas, ter&aacute; devolu&ccedil;&atilde;o total sem qualquer tipo de desconto.</li>
          <li>O Sistema recusar a cobran&ccedil;a no cart&atilde;o.</li>
          <li>For detectada alguma fraude no processamento  entre ambas as partes.</li>
        </ul>
        <p><strong>Cl&aacute;usula 6&ordf; &ndash; </strong>Ao  assinar este termo tamb&eacute;m confirmo e autorizo o cr&eacute;dito referente ao empr&eacute;stimo  em minha conta bancaria cadastrada ou atualizada na Easy Loan.</p>
        <p><strong>Cl&aacute;usula 7&ordf; &ndash; </strong>As  taxas relativas ao empr&eacute;stimo ser&atilde;o pagas pelo cliente ao decorrer do pagamento  das parcelas.</p>
        <p><strong>Cl&aacute;usula 8&ordf; &ndash; </strong>Lembrando  que ao fazer o empr&eacute;stimo conosco o d&eacute;bito ser&aacute; feito no cart&atilde;o de cr&eacute;dito do  cliente e caso haja inadimpl&ecirc;ncia n&atilde;o ser&aacute; mais com a Easy Loan Financial  Services e sim com a financeira ou banco emissor do cart&atilde;o.</p>
        <p><strong>Cl&aacute;usula 9&ordf; &ndash; </strong>Taxas  provenientes de atrasos n&atilde;o ser&atilde;o pagas a Easy Loan e sim a financeira e as  taxas ser&aacute; as mesas do seu cart&atilde;o.</p>
        <p><strong>Cl&aacute;usula 10&ordf; &ndash; </strong>A  Easy Loan Financial Services tem o direito de sonegar qualquer informa&ccedil;&atilde;o sobre  o cart&atilde;o do cliente, as informa&ccedil;&otilde;es s&oacute; ser&atilde;o sobre o empr&eacute;stimo.</p>
        <p><strong>Cl&aacute;usula 11&ordf; &ndash; </strong>A  Easy Loan Financial Services n&atilde;o far&aacute; nenhum tipo de negocia&ccedil;&atilde;o ou renegocia&ccedil;&atilde;o  relacionada ao empr&eacute;stimo conforme a cl&aacute;usula 8&ordf;.</p>
        <p><strong>Cl&aacute;usula 12&ordf; &ndash; </strong>N&atilde;o  ser&aacute; feito o cancelamento passar 24 horas ap&oacute;s o cr&eacute;dito ter sido feito na conta  bancaria do cliente.</p>
<p><strong>Cláusula 13ª</strong> A quitação das parcelas referente aos valores do empréstimo será cobrando na fatura e somente será quitada após o pagamento da fatura.</p>
<p><strong>Cláusula 14ª</strong> O cliente poderá fazer quantos empréstimos quiser desde que o cartão tenha limite para arcar com o valor e as taxas do empréstimo.</p>
<p><strong>Cláusula 15ª</strong> Fica  eleito o foro da comarca de S&atilde;o Gon&ccedil;alo do Amarante para resolver qualquer  problema entre ambas as partes, caso o acordo n&atilde;o seja feito junto ao  escrit&oacute;rio da Easy Loan Financial Services.</p></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <table width="950" border="0">
    <tr>
      <td align="center" width="532" height="26">Local: ________________________________________________________</td>
      <td align="center" width="399">Data: __________ de ___________________ de __________</td>
    </tr>
    <tr>
      <td align="center" colspan="2"><br />
      ___________________________________________________________</td>
    </tr>
    <tr>
      <td colspan="2" align="center">Assinatura do cliente:</td>
    </tr>
    <tr>
      <td colspan="2" align="center"><br /></td>
      <td width="5"></td>
    </tr>
    <tr>
      <td align="center"><p>&nbsp;</p>
      <p><strong>Easy Loan Financial Services</strong></p></td>
      <td align="center">____________________________________________________  Assinatura do promotor:</td>
    </tr>
    <tr>
      <td colspan="2" align="center">&nbsp;</td>
    </tr>
  </table>
  <? }} ?>
  <p>&nbsp;</p>
</div><!-- box -->
<? if(isset($_POST['imprimir'])){ ?>
<script type="text/javascript">
window.print() 
</script>
<? die;}} ?>
<form name="imprimir" method="post" action="" enctype="multipart/form-data">
<input type="button" name="imprimir" value="Imprimir" onclick="window.print();">
</form>
</body>
</html>