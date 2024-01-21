<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/retirada_dinheiro.css" rel="stylesheet" type="text/css" />
</head>

<body>
<? require "topo.php";  require "scripts/verificador_caixa.php"; ?>

<div id="box_pagamento_1">

<? if(isset($_POST['button'])){
	
$finalidade = $_POST['finalidade'];
$descricao = $_POST['descricao'];
$valor = $_POST['valor'];

if($descricao == ''){
	echo "<script language='javascript'>window.alert('Digite a descrição');</script>";
}else{

$retirada_dinheiro = mysqli_query($conexao_bd, "INSERT INTO retirada_dinheiro (codeCaixa, turno, status, data, data_completa, dia, mes, ano, valor, finalidade, descricao, operador, processamento) VALUES ('$codeCaixa', '$turno', 'Aguarda', '$data', '$data_completa', '$dia', '$mes', '$ano', '$valor', '$finalidade', '$descricao', '$operador', '')");

if($retirada_dinheiro == ''){
	echo "<script language='javascript'>window.alert('ERRO AO INFORMAR RETIRADA DE DINHEIRO!');</script>";
}else{
	echo "<script language='javascript'>window.alert('RETIRADA CONFIRMADO COM SUCESSO!!!');</script>";
  }
 }
}?>

<form name="" method="post" action="" enctype="multipart/form-data">
<table width="980" border="0">
  <tr>
    <td align="center" bgcolor="#0099FF"><strong>RETIRADA DE DINHEIRO PARA FINS PESSOAIS</strong></td>
  </tr>
  <tr>
    <td align="center">FINALIDADE</td>
  </tr>
  <tr>
    <td height="30" align="center"><label for="finalidade"></label>
      <select name="finalidade" size="1" id="finalidade">
        <option value="FINS PESSOAIS">FINS PESSOAIS</option>
        <option value="FINS COMERCIAIS">FINS COMERCIAIS</option>
        <option value="DEVOLUCAO DE VALORES">DEVOLUÇÃO DE VALORES</option>
      </select></td>
  </tr>
  <tr>
    <td align="center">DESCRIÇÃO</td>
  </tr>
  <tr>
    <td align="center"><label for="descricao"></label>
    <input type="text" name="descricao" id="descricao"></td>
  </tr>
  <tr>
    <td align="center">VALOR</td>
  </tr>
  <tr>
    <td align="center"><input type="text" name="valor" id="valor" /></td>
  </tr>
  <tr>
    <td align="center"><input type="submit" name="button" id="button" value="Enviar" /></td>
  </tr>
</table>
</form>
</div><!-- box_pagamento_1 -->

</body>
</html>