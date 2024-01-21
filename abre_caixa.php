<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/abre_caixa.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>

<body>
<? require "topo.php"; ?>

<div id="box_pagamento_1">

<form name="" method="post" action="" enctype="multipart/form-data">
<h1>ABRIR CAIXA PARA DIA DE TRABALHO</h1><hr />
<table width="1000" border="0">
  <tr>
    <td><strong>DIA PARA ABERTURA DO CAIXA</strong></td>
  </tr>
  <tr>
    <td><strong>
      <input type="text" name="data" disabled="disabled" value="<? echo date("d/m/Y"); ?>"/>
    </strong></td>
  </tr>
  <tr>
    <td><strong>VALOR DISPONÍVEL NO CAIXA DISPONÍVEL PARA ABERTURA</strong></td>
  </tr>
  <tr>
    <td><label for="textfield2"></label>
      <input name="valor" type="text"  size="10" /></td>
  </tr>
  <tr>
    <td><input type="submit" name="button" id="button" value="Abrir"></td>
  </tr>
</table>
</form>

<? if(isset($_POST['button'])){
	
$data = date("d/m/Y");
$valor = $_POST['valor'];

$sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM registro_diario_caixa WHERE data = '$data' AND operador = '$operador'");
if(mysqli_num_rows($sql_verifica) == 1){
	echo "<script language='javascript'>window.alert('VOCÊ JÁ ABRIU O CAIXA HOJE!');</script>";
}else{
	mysqli_query($conexao_bd, "INSERT INTO registro_diario_caixa (dia, mes, ano, data, data_completa, ip, operador, caixa_inicio, valor_creditos, valor_debitos, status) VALUES ('$dia', '$mes', '$ano', '$data', '$data_completa', '$ip', '$operador', '$valor', '0', '0', 'Aberto')");
	echo "<script language='javascript'>window.alert('CAIXA ABERTO COM SUCESSO!');window.location='carrinho.php';</script>";
}



}?>

</body>
</html>