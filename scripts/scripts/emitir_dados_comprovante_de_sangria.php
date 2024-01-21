<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>COMPROVANTE DE PAGAMENTO</title>
<link href="css/emitir_dados_deposito.css" rel="stylesheet" type="text/css" />
</head>

<body>
<script language="javascript">window.print();</script>
<div id="box">
  <ul>
    <li><? echo date("d/m/Y"); ?>&nbsp;-&nbsp;<strong>SANGRIA DE CAIXA</strong>&nbsp;-&nbsp;&nbsp;<? echo date("H:i:s"); ?></li>
    <li>
      <p><strong>------------------------------------------------------------------------------------</strong></p></li>
    <li>coban:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 74419 </li>
    <li>loja: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 001</li>
    <li>CNPJ:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;32.450.862/0001-02</li>
    <li>BENEFICI&Aacute;RIO: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;      &nbsp;  &nbsp;marcos rodrigues de oliveira</li>
    <li>nome fantasia:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;veste prime</li>
    <li>valor dA SANGRIA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <? echo @number_format($_GET['valor'], 2, ',', '.'); ?></li>
    <li><strong>================================================</strong></li>
    <li></li>
    <li>respons&aacute;vel para PELO REPASSE DE VALORES&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
    <li>nome:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<? echo @$_GET['nome_operador']; ?></li>
    <li>cpf: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<? echo $_GET['cpf_operador']; ?></li>
    <li></li>
    <li><strong>------------------------------------------------------------------------------------</strong></li>
    <li><strong>dados da pessoa que efetuou a sangria</strong></li>
    <li><br /><br /> NOME:__________________________________________.</li>
    <li><br /><br />CPF:___________________________________________</li>
    <li><br /><br /><br />______________________________________________</li>
    <li>ASSINATURA.</li>
    <li></li>
    <li></li>
    <li><br /><br /><br /><br /></li>
    <li></li>
    <li>______________________________</li>
    <li> Assinatura do responsável</li>
  </ul>
</div><!-- box -->
</body>
</html>