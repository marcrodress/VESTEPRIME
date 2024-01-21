<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>INFORMAÇÃO DE VALORES</title>
<link href="css/informar_saldo_de_choques.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="box_pagamento_1">
<?
require "config.php";

$id_caixa = $_GET['id_caixa'];
$sql_vefica_fechamento_caixa = mysqli_query($conexao_bd, "SELECT * FROM fechamento_de_caixa WHERE id_caixa = '$id_caixa'");
if(mysqli_num_rows($sql_vefica_fechamento_caixa) == ''){
	
	mysqli_query($conexao_bd, "INSERT INTO fechamento_de_caixa (
	codeCaixa, turno, id_caixa, operador, ip, status, dia, mes, ano, data, dada_completa, hora_abertura, notas100, notas50, notas20, notas10, notas5, notas2, moeda1, moeda50, moeda25, moeda10, moeda5, saldaobb, bb
	) VALUES (
	'$codeCaixa', '$turno', '$id_caixa', '$operador', '$ip', 'Aguarda Fechamento', '$dia', '$mes', '$ano', '$data', '$data_completa', '$hora', '$notas100', '$notas50', '$notas20', '$notas10', '$notas5', '$notas2', '$moeda1', '$moeda50', '$moeda25', '$moeda10', '$moeda5', '$saldaobb', '$bb')");
	
	echo "<script language='javascript'>window.location='';</script>";	
}
?>




<? if(isset($_POST['button'])){

$notas100 = $_POST['notas100'];
$notas50 = $_POST['notas50'];
$notas20 = $_POST['notas20'];
$notas10 = $_POST['notas10'];
$notas5 = $_POST['notas5'];
$notas2 = $_POST['notas2'];
$moeda1 = $_POST['moeda1'];
$moeda50 = $_POST['moeda50'];
$moeda25 = $_POST['moeda25'];
$moeda10 = $_POST['moeda10'];
$moeda5 = $_POST['moeda5'];
$saldaobb = $_POST['saldaobb'];
$bb = $_POST['bb'];






$sql_inseri = mysqli_query($conexao_bd, "UPDATE fechamento_de_caixa SET notas100 = '$notas100', notas50 = '$notas50', notas20 = '$notas20', notas10 = '$notas10', notas5 = '$notas5', notas2 = '$notas2', moeda1 = '$moeda1', moeda50 = '$moeda50', moeda25 = '$moeda25', moeda10 = '$moeda10', moeda5 = '$moeda5', saldaobb = '$saldaobb', bb = '$bb' WHERE id_caixa = '$id_caixa'");

echo "<strong>Informações adicionadas com sucesso</strong><br><br>Pressione F5 para mesclar a operação.";

die;

}?>









<?
$id_caixa = $_GET['id_caixa'];
$sql_vefica_fechamento_caixa = mysqli_query($conexao_bd, "SELECT * FROM fechamento_de_caixa WHERE id_caixa = '$id_caixa'");
if(mysqli_num_rows($sql_vefica_fechamento_caixa) == ''){
	echo "OCORREU UM ERRO FECHA O CAIXA, POR FAVOR, TENTE NOVAMENTE!";
}else{
	while($res_caixa = mysqli_fetch_array($sql_vefica_fechamento_caixa)){
?>
<form name="" method="post" action="" enctype="multipart/form-data">
<table width="1000" border="0">
  <tr>
    <td colspan="6" bgcolor="#CCCCCC"><strong>FORMULÁRIO DE FECHAMENTO DE CAIXA
    </strong>      <hr></td>
  </tr>
  <tr>
    <td bgcolor="#999900"><strong>NOTAS DE R$ 100,00</strong></td>
    <td bgcolor="#999900"><strong>NOTAS DE R$ 50,00</strong></td>
    <td bgcolor="#999900"><strong>NOTAS DE R$ 20,00</strong></td>
    <td bgcolor="#999900"><strong>NOTAS DE R$ 10,00</strong></td>
    <td bgcolor="#999900"><strong>NOTAS DE R$ 5,00</strong></td>
    <td bgcolor="#999900"><strong>NOTAS DE DE R$ 2,00</strong></td>
  </tr>
  <tr>
    <td><label for="notas100"></label>
    <input type="text" name="notas100" id="notas100" value="<? echo $res_caixa['notas100']; ?>"></td>
    <td><label for="notas50"></label>
    <input type="text" name="notas50" id="notas50" value="<? echo $res_caixa['notas50']; ?>"></td>
    <td><label for="notas20"></label>
    <input type="text" name="notas20" id="notas20" value="<? echo $res_caixa['notas20']; ?>"></td>
    <td><label for="notas10"></label>
    <input type="text" name="notas10" id="notas10" value="<? echo $res_caixa['notas10']; ?>"></td>
    <td><label for="notas5"></label>
    <input type="text" name="notas5" id="notas5" value="<? echo $res_caixa['notas5']; ?>"></td>
    <td><label for="notas2"></label>
    <input type="text" name="notas2" id="notas2" value="<? echo $res_caixa['notas2']; ?>"></td>
  </tr>
  <tr>
    <td bgcolor="#999900"><strong>MOEDAS DE R$ 1,00</strong></td>
    <td bgcolor="#999900"><strong>MOEDAS DE R$ 0,50</strong></td>
    <td bgcolor="#999900"><strong>MOEDAS DE R$ 0,25</strong></td>
    <td bgcolor="#999900"><strong>MOEDAS DE R$ 0,10</strong></td>
    <td bgcolor="#999900"><strong>MOEDAS DE R$ 0,05</strong></td>
    <td bgcolor="#0099CC"><strong>NOTAS DE R$ 200,00</strong></td>
  </tr>
  <tr>
    <td><label for="moeda1"></label>
    <input type="text" name="moeda1" id="moeda1" value="<? echo $res_caixa['moeda1']; ?>"></td>
    <td><label for="moeda50"></label>
    <input type="text" name="moeda50" id="moeda50" value="<? echo $res_caixa['moeda50']; ?>"></td>
    <td><label for="moeda25"></label>
    <input type="text" name="moeda25" id="moeda25" value="<? echo $res_caixa['moeda25']; ?>"></td>
    <td><label for="moeda10"></label>
    <input type="text" name="moeda10" id="moeda10" value="<? echo $res_caixa['moeda10']; ?>"></td>
    <td><label for="moeda5"></label>
    <input type="text" name="moeda5" id="moeda5" value="<? echo $res_caixa['moeda5']; ?>"></td>
    <td bgcolor="#0099CC"><label for="moeda1">
      <input type="text" name="bb" id="bb" value="<? echo $res_caixa['bb']; ?>" />
    </label></td>
  </tr>
  <tr>
    <td colspan="6"><hr>
      <input class="input2" type="submit" name="button" id="button" value="ENVIAR INFORMAÇÕES"></td>
  </tr>
</table>
</form>
<? }} ?>
</div><!-- box_pagamento_1 -->
</body>
</html>