<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/termo_de_deposito.css" rel="stylesheet" type="text/css" />
<title>DECLARAÇÃO DE DEPÓSITO</title>
</head>

<body>
<div id="box">
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<p align="center"><strong><u>TERMO DE CONCLUS&Atilde;O DE AL&Iacute;VIO DE NUMER&Aacute;RIO</u></strong></p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>Eu, <? echo $_GET['nome_operador']; ?>, inscrito no CPF: <? echo $_GET['cpf_operador']; ?>,  confirmo que efetuei o al&iacute;vio de numer&aacute;rio no Banco do Brasil no COBAN 74419 e CNPJ 32.450.862/0001-02 no valor de R$ <? echo @number_format($_GET['valor'], 2, ',', '.'); ?>, tendo como benefici&aacute;rio MARCOS RODRIGUES DE OLIVEIRA 05379839371, pessoa jur&iacute;dica portadora do CNPJ: 32.450.862/0001-02, cujo o comprovante de transa&ccedil;&atilde;o se encontra em anexo a esta declara&ccedil;&atilde;o.</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p align="center">Taiba, S&atilde;o Gon&ccedil;alo do Amarante  &ndash; <? echo date("d"); ?> de <? $m = date("m"); 

if($m == 1){
	echo "Janeiro";
}elseif($m == 2){
	echo "Fevereiro";
}elseif($m == 3){
	echo "Março";
}elseif($m == 4){
	echo "Abril";
}elseif($m == 5){
	echo "Maio";
}elseif($m == 6){
	echo "Junho";
}elseif($m == 7){
	echo "Julho";
}elseif($m == 8){
	echo "Agosto";
}elseif($m == 9){
	echo "Setembro";
}elseif($m == 10){
	echo "Outubro";
}elseif($m == 11){
	echo "Novembro";
}else{
	echo "Dezembro";
}


?> de <? echo date("Y"); ?></a></p>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<p align="center">____________________________________________________<br />
  Assinatura: <? echo $_GET['nome_operador']; ?></p>
<p>&nbsp;</p>

</div><!-- box -->
</body>
</html>