<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>

<body>
<? $code_conjunto = $_GET['code_conjunto']; $cliente = $_GET['cliente']; ?>


<? if($code_conjunto>=1){ ?>
<strong>Selecione a banderia e as parcelas <a class="a_volta" href="?code_conjunto=<? echo $code_conjunto; ?>">VOLTAR</a></strong>
<form name="" method="post" action="" enctype="multipart/form-data">
<select name="bandeira" size="1"  autofocus>
  <option value="MASTERCARD">MASTERCARD</option>
  <option value="VISA">VISA</option>
  <option value="ELO">ELO</option>
  <option value="HIPERCARD">HIPERCARD</option>
  <option value="FORTBRASIL">FORTBRASIL</option>
  <option value="DINERS">DINERS</option>
  <option value="AMERICAN EXPRESS">AMERICAN EXPRESS</option>
  <option value="FORTBRASIL">FORTBRASIL</option>
  <option value="OUTROS">OUTROS</option>
</select>
<input class="input_debito" type="text" name="parcela" size="1" />
</form>
<? if(isset($_POST['parcela'])){

$bandeira = $_POST['bandeira'];
$parcela = $_POST['parcela'];
$pag_form = $_GET['pag_form'];
$valorusar = $_GET['valorusar'];

$valor_parcela = 0;
$valor_transacao = 0;

$i = $parcela;

$valor_transacao = ($_GET['valorusar']*0.1)+($_GET['valorusar']);

if($parcela == 1){
$valor_parcela = $valor_transacao;
}else{
@$valor_parcela = ($valor_transacao*(0.03*$i)+$valor_transacao)/$i;
@$valor_transacao = (($valor_transacao*(0.03*$i)+$valor_transacao)/$i)*$i;
}


if($parcela <=0 || $parcela >12){
	echo "<script language='javascript'>window.alert('O número de parcela deve ser entre 1 a 12 parcelas');</script>";
}else{
  
  mysqli_query($conexao_bd, "INSERT INTO pagamento_boletos_opcoes (codeCaixa, turno, code_boleto, data, data_completa, dia, mes, ano, operador, status, forma_pagamento, n_parcelas, bandeira, valor, valor_parcela, valor_transacao, cliente, limite_antes, limite_consumido, troco, cheque_especial, conjunto) VALUES ('$codeCaixa', '$turno', '$code_boleto', '$data', '$data_completa', '$dia', '$mes', '$ano', '$operador', 'Ativo', '$pag_form', '$parcela', '$bandeira', '$valorusar', '$valor_parcela', '$valor_transacao', '$cliente', '', '', '', '', '$code_conjunto')");
 
	echo "<script language='javascript'>window.location='?code_conjunto=$code_conjunto';</script>";
 	
 }
}?>
<hr /> 
<table width="450" border="0">
<? for($i=1; $i<=12; $i++){ ?>
  <tr <? if($i%2 == 0){ echo "bgcolor='#666'"; }else{ echo "bgcolor='#333'"; } ?>>
    <? if($i == 1){ ?>
    <td width="372"><? echo $i; ?> X -  <? $valorusar1 = ($_GET['valorusar']*0.1)+($_GET['valorusar']); echo number_format($valorusar1, 2, ',', '.'); ?></td>
    <td align="center" width="68"><? echo number_format($valorusar1, 2, ',', '.'); ?></td>
    <? }else{ $valorusar = ($_GET['valorusar']*0.1)+($_GET['valorusar']); $valor_parcela_referencia = ($valorusar*0.03*$i);{ ?>
    <td width="372"><? echo $i; ?> X -  <? echo number_format(($valor_parcela_referencia+$valorusar)/$i, 2, ',', '.'); ?></td>
    <td align="center" width="68"><? echo number_format((($valor_parcela_referencia+$valorusar)/$i)*$i, 2, ',', '.'); ?></td><? }} ?>
  </tr>
<? }// final do for do numero de parcelas ?>
</table>










<? }else{ ?>
<strong>Selecione a banderia e as parcelas <a class="a_volta" href="?p=4&code_boleto=<? echo $_GET['code_boleto']; ?>">VOLTAR</a></strong>
<form name="" method="post" action="" enctype="multipart/form-data">
<select name="bandeira" size="1"  autofocus>
  <option value="MASTERCARD">MASTERCARD</option>
  <option value="VISA">VISA</option>
  <option value="ELO">ELO</option>
  <option value="HIPERCARD">HIPERCARD</option>
  <option value="FORTBRASIL">FORTBRASIL</option>
  <option value="DINERS">DINERS</option>
  <option value="AMERICAN EXPRESS">AMERICAN EXPRESS</option>
  <option value="FORTBRASIL">FORTBRASIL</option>
  <option value="OUTROS">OUTROS</option>
</select>
<input class="input_debito" type="text" name="parcela" size="1" />
</form>
<? if(isset($_POST['parcela'])){

$bandeira = $_POST['bandeira'];
$parcela = $_POST['parcela'];
$pag_form = $_GET['pag_form'];
$valorusar = $_GET['valorusar'];

$valor_parcela = 0;
$valor_transacao = 0;

$i = $parcela;

$valor_transacao = ($_GET['valorusar']*0.1)+($_GET['valorusar']);

if($parcela == 1){
$valor_parcela = $valor_transacao;
}else{
@$valor_parcela = ($valor_transacao*(0.03*$i)+$valor_transacao)/$i;
@$valor_transacao = (($valor_transacao*(0.03*$i)+$valor_transacao)/$i)*$i;
}


if($parcela <=0 || $parcela >12){
	echo "<script language='javascript'>window.alert('O número de parcela deve ser entre 1 a 12 parcelas');</script>";
}else{
  
  mysqli_query($conexao_bd, "INSERT INTO pagamento_boletos_opcoes (codeCaixa, turno, code_boleto, data, data_completa, dia, mes, ano, operador, status, forma_pagamento, n_parcelas, bandeira, valor, valor_parcela, valor_transacao, cliente, limite_antes, limite_consumido, troco, cheque_especial, conjunto) VALUES ('$codeCaixa', '$turno', '$code_boleto', '$data', '$data_completa', '$dia', '$mes', '$ano', '$operador', 'Ativo', '$pag_form', '$parcela', '$bandeira', '$valorusar', '$valor_parcela', '$valor_transacao', '$cliente', '', '', '', '', '$code_conjunto')");
 
	echo "<script language='javascript'>window.location='?p=4&code_boleto=$code_boleto';</script>";
 	
 }
}?>
<table width="450" border="0">
<? for($i=1; $i<=12; $i++){ ?>
  <tr <? if($i%2 == 0){ echo "bgcolor='#333'"; }else{ echo "bgcolor='#666'"; } ?>>
    <? if($i == 1){ ?>
    <td width="372"><? echo $i; ?> X -  <? $valorusar1 = ($_GET['valorusar']*0.1)+($_GET['valorusar']); echo number_format($valorusar1, 2, ',', '.'); ?></td>
    <td align="center" width="68"><? echo number_format($valorusar1, 2, ',', '.'); ?></td>
    <? }else{ $valorusar = ($_GET['valorusar']*0.1)+($_GET['valorusar']); $valor_parcela_referencia = ($valorusar*0.03*$i);{ ?>
    <td width="372"><? echo $i; ?> X -  <? echo number_format(($valor_parcela_referencia+$valorusar)/$i, 2, ',', '.'); ?></td>
    <td align="center" width="68"><h6 style="font:9px Arial, Helvetica, sans-serif; padding:0; margin:0;"><? echo number_format((($valor_parcela_referencia+$valorusar)/$i)*$i, 2, ',', '.'); ?></h6></td><? }} ?>
  </tr>
<? }// final do for do numero de parcelas ?>
</table>

<? } // verifica se é conjunto ?>
</body>
</html>