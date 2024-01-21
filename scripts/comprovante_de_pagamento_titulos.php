<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>COMPROVANTE DE PAGAMENTO</title>
<link href="css/comprovante_de_pagamento_titulos.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="box">
  <ul>
    <li><? echo date("d/m/Y"); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BANCO DO BRASIL&nbsp;&nbsp;</strong>-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<? echo date("H:i:s"); ?></li>
    <li>&nbsp;&nbsp;&nbsp;&nbsp;<strong>&nbsp;&nbsp;<strong>&nbsp;</strong>&nbsp;<strong>&nbsp;</strong>&nbsp;<strong>&nbsp;</strong>&nbsp;<strong>&nbsp;</strong></strong>&nbsp;&nbsp;&nbsp;&nbsp;<strong>&nbsp;</strong>&nbsp;<strong>&nbsp;</strong>&nbsp;&nbsp;&nbsp;&nbsp;<strong>&nbsp;</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>&nbsp;</strong>VIA CLIENTE</li>
    <li>
      <p><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;COMPROVANTE&nbsp;DE&nbsp;PAGAMENTO&nbsp;DE&nbsp;TITULOS</strong></p>
    </li>
    <li></li>
    <li>CORRESPONDE:&nbsp;VESTE PRIME VESTU&Aacute;RIO E ACESS&Oacute;RIOS DE CELULARES</li>
    <li>CNPJ: 32.450.862/0001-02</li>
    <li>RUA CAPIT&Atilde;O IN&Aacute;CIO PRATA - 2010 - TAIBA<BR />
      S&Atilde;O GON&Ccedil;ALO DO AMARANTE - CE - CEP: 62670-000</li>
    <li>================================================</li>
    <li><? echo $_GET['code_barra']; ?></li>
    <li>BENEFICIARIO:</li>
    <li><? $banco = $_GET['banco']; echo $banco; ?></li>
    <li>------------------------------------------------------------------------------------</li>
    <li>NR.&nbsp;DOCUMENTO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <? echo @$_GET['n_doc']; ?></li>
    <li>DATA&nbsp;DE&nbsp;VENCIMENTO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <? echo $_GET['vencimento']; ?></li>
    <li>DATA&nbsp;DO&nbsp;PAGAMENTO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<? echo $_GET['dia_pagamento']; ?></li>
    <li>VALOR&nbsp;DO&nbsp;DOCUMENTO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<? echo @number_format($_GET['valor'], 2, ',', '.'); ?></li>
    <? if($_GET['juros_multa'] != '0'){ ?>
    <li>JUROS/MULTA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <? echo @number_format($_GET['juros_multa'], 2, ',', '.'); ?></li>
    <? } ?>
    <? if($_GET['descontos'] != '0'){ ?>
    <li>DESCONTOS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <? echo @number_format($_GET['descontos'], 2, ',', '.'); ?></li>
    <? } ?>
    <li>VALOR COBRADO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <? echo @number_format(($_GET['juros_multa']+$_GET['valor'])-$_GET['descontos'], 2, ',', '.'); ?></li>
    <li>================================================</li>
    <li>NR.AUTENTICACAO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
    <li><? echo @$_GET['autenticacao']; ?></li>
    <li>------------------------------------------------------------------------------------</li>
    <li>PAGAMENTOS REALIZADOS AP&Oacute;S AS 15 HORAS SER&Atilde;O <br />PROCESSADOS NO PR&Oacute;XIMO DIA &Uacute;TIL.</li>
    <li></li>
  </ul>
</div><!-- box -->
</body>
</html>