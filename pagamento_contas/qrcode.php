<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>

<body>
<strong>Selecione a banderia e as parcelas <a class="a_volta" href="?p=4&code_boleto=<? echo $_GET['code_boleto']; ?>">VOLTAR</a></strong>
<form name="" method="post" action="" enctype="multipart/form-data">
<select name="bandeira" size="1"  autofocus>
  <option value="MERCADO PAGO">MERCADO PAGO</option>
  <option value="PICPAY">PICPAY</option>
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

$valor_transacao = $_GET['valorusar'];

if($parcela != 1){
	echo "<script language='javascript'>window.alert('O número de parcela deve ser 1');</script>";
}else{
  
  mysqli_query($conexao_bd, "INSERT INTO pagamento_boletos_opcoes (code_boleto, data, data_completa, dia, mes, ano, operador, status, forma_pagamento, n_parcelas, bandeira, valor, valor_parcela, valor_transacao, cliente, limite_antes, limite_consumido, troco, cheque_especial) VALUES ('$code_boleto', '$data', '$data_completa', '$dia', '$mes', '$ano', '$operador', 'Ativo', '$pag_form', '$parcela', '$bandeira', '$valorusar', '$valor_parcela', '$valor_transacao', '$cliente', '', '', '', '')");
 
	echo "<script language='javascript'>window.location='?p=4&code_boleto=$code_boleto';</script>";
 	
 }
}?>
<hr /> 
<table width="450" border="0">
  <tr bgcolor='#F0FFF8'>
    <td width="372">1 X -  <? $valorusar = $_GET['valorusar']; echo number_format($valorusar, 2, ',', '.'); ?></td>
  </tr>
</table>
</body>
</html>