2<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>COMPROVANTE DE PAGAMENTO</title>
<link href="css/comprovante_de_pagamento_convenio.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="box">
  <ul>
    <li><? echo date("d/m/Y"); ?>&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;BANCO&nbsp;&nbsp;DO&nbsp;&nbsp;BRASIL&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;<? echo date("H:i:s"); ?></li>
    <li>
      <p><strong>COMPROVANTE&nbsp;DE&nbsp;PAGAMENTO&nbsp;DE&nbsp;TITULOS</strong></p></li>
    <li></li>
    <li>CORRESPONDE:&nbsp;VESTE PRIME VESTU&Aacute;RIO E ACESS&Oacute;RIOS DE CELULARES</li>
    <li>CNPJ: 32.450.862/0001-02</li>
    <li>RUA CAPIT&Atilde;O IN&Aacute;CIO PRATA - 2010 - TAIBA<BR />
      S&Atilde;O GON&Ccedil;ALO DO AMARANTE - CE - CEP: 62670-000</li>
    <li>================================================</li>
    <li><strong>CÓDIGO DE PAGAMENTO: </strong><br /><? echo $_GET['code_barra']; ?></li>
    <li><strong>CONVÊNIO:</strong></li>
    <li><? echo $_GET['convenio']; ?></li>
    <li>------------------------------------------------------------------------------------</li>
    <li>NR.&nbsp;DOCUMENTO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <? echo @$_GET['n_doc']; ?></li>
    <li>DATA&nbsp;DO&nbsp;PAGAMENTO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<? echo $_GET['dia_pagamento']; ?></li>
    <li>VALOR&nbsp;DO&nbsp;DOCUMENTO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; <? echo $_GET['valor']; ?></li>
    <li>VALOR&nbsp;cobrado&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; <? echo $_GET['valor']; ?></li>
    <li>================================================</li>
    <li><strong>NR.AUTENTICACAO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></li>
    <li><? echo @$_GET['autenticacao']; ?></li>
    <li>------------------------------------------------------------------------------------</li>
    <li>PAGAMENTOS REALIZADOS AP&Oacute;S AS 15 HORAS SER&Atilde;O <br />PROCESSADOS NO PR&Oacute;XIMO DIA &Uacute;TIL.</li>
    <li></li>
  </ul>
</div><!-- box -->
</body>
</html>