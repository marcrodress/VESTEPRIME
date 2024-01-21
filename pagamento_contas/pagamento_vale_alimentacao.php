<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>

<body>
<strong>Selecione A BANDEIRA do cartão VALE ALIMENTAÇÃO  <br /><br /><a class="a_volta" href="?p=4&code_boleto=<? echo $_GET['code_boleto']; ?>">VOLTAR</a></strong>
<form name="" method="post" action="" enctype="multipart/form-data">
<select name="bandeira" size="1" autofocus>
  <option value="MASTERCARD">MASTERCARD</option>
  <option value="VISA">VISA</option>
  <option value="ELO">ELO</option>
  <option value="VALE SHOP">VALE SHOP</option>
  <option value="SODEXO">SODEXO</option>
  <option value="TICKET ALIMENTACAO">TICKET ALIMENTAÇÃO</option>
  <option value="ALELO">ALELO</option>
  <option value="OUTROS">OUTROS</option>
</select>
<input class="input_debito" name="parcela" type="text" value="1" size="1" />
</form>
<? if(isset($_POST['parcela'])){

$bandeira = $_POST['bandeira'];
$pag_form = $_GET['pag_form'];
$valorusar = $_GET['valorusar'];


if($parcela >1){
	echo "<script language='javascript'>window.alert('Por ser cartão de débito a transação deve ser feita a vista!');</script>";
}else{
  
  mysqli_query($conexao_bd, "INSERT INTO pagamento_boletos_opcoes (code_boleto, data, data_completa, dia, mes, ano, operador, status, forma_pagamento, n_parcelas, bandeira, valor, valor_parcela, valor_transacao, cliente, limite_antes, limite_consumido, troco, cheque_especial) VALUES ('$code_boleto', '$data', '$data_completa', '$dia', '$mes', '$ano', '$operador', 'Ativo', '$pag_form', '1', '$bandeira', '$valorusar', '$valorusar', '$valorusar', '$cliente', '', '', '', '')");
 
	echo "<script language='javascript'>window.location='?p=4&code_boleto=$code_boleto';</script>";
 	
 }
}?>
<hr /> 
<table width="450" border="0">
<? for($i=1; $i<=12; $i++){ ?>
  <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
    <? if($i == 1){ ?>
    <td width="372"><? echo $i; ?> X -  <? echo number_format(($_GET['valorusar']*0.12)+$_GET['valorusar'], 2, ',', '.'); ?></td>
    <td align="center" width="68"><? echo number_format(($_GET['valorusar']*0.12)+$_GET['valorusar'], 2, ',', '.'); ?></td>
    <? } ?>
  </tr>
<? }// final do for do numero de parcelas ?>
</table>
</body>
</html>