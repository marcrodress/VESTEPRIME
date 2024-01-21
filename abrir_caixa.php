<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/abrir_caixa.css" rel="stylesheet" type="text/css" />
<? require "bootstrap.php"; ?>
</head>

<body>
<? require "topo.php"; ?>


<div id="box_pagamento_1" style="background-color:#000; border:5px solid #000;">
<form name="" method="post" action="" enctype="multipart/form-data">
<table class="table table-dark table-bordered border-secondary" width="1000" border="0">
  <tr>
    <td colspan="6"><h4><strong>FORMULÁRIO DE ABERTURA DE CAIXA</strong></h4></td>
  </tr>
  <tr>
    <td><strong>NOTAS DE R$ 100,00</strong></td>
    <td><strong>NOTAS DE R$ 50,00</strong></td>
    <td><strong>NOTAS DE R$ 20,00</strong></td>
    <td><strong>NOTAS DE R$ 10,00</strong></td>
    <td><strong>NOTAS DE R$ 5,00</strong></td>
    <td><strong>NOTAS DE DE R$ 2,00</strong></td>
  </tr>
  <tr>
    <td><label for="notas100"></label>
    <input type="text" name="notas100" id="notas100"></td>
    <td><label for="notas50"></label>
    <input type="text" name="notas50" id="notas50"></td>
    <td><label for="notas20"></label>
    <input type="text" name="notas20" id="notas20"></td>
    <td><label for="notas10"></label>
    <input type="text" name="notas10" id="notas10"></td>
    <td><label for="notas5"></label>
    <input type="text" name="notas5" id="notas5"></td>
    <td><label for="notas2"></label>
    <input type="text" name="notas2" id="notas2"></td>
  </tr>
  <tr>
    <td><strong>MOEDAS DE R$ 1,00</strong></td>
    <td><strong>MOEDAS DE R$ 0,50</strong></td>
    <td><strong>MOEDAS DE R$ 0,25</strong></td>
    <td><strong>MOEDAS DE R$ 0,10</strong></td>
    <td><strong>MOEDAS DE R$ 0,05</strong></td>
    <td><strong>SALDO MAQUINA</strong></td>
  </tr>
  <tr>
    <td><label for="moeda1"></label>
    <input type="text" name="moeda1" id="moeda1"></td>
    <td><label for="moeda50"></label>
    <input type="text" name="moeda50" id="moeda50"></td>
    <td><label for="moeda25"></label>
    <input type="text" name="moeda25" id="moeda25"></td>
    <td><label for="moeda10"></label>
    <input type="text" name="moeda10" id="moeda10"></td>
    <td><label for="moeda5"></label>
    <input type="text" name="moeda5" id="moeda5"></td>
    <td><label for="moeda1"></label>
    <input type="text" name="saldaobb" id="saldaobb"></td>
  </tr>
  <tr>
    <td bgcolor="#00CCCC"><strong>NOTAS DE R$ 200,00</strong></td>
    <td><strong>SALDO CELCOIN</strong></td>
    <td><strong>SALDO RECARPAY</strong></td>
    <td><strong>SALDO BANCO INTER</strong></td>
    <td><strong>SALDO MERCADO PAGO</strong></td>
    <td><strong>SALDO PICPAY</strong></td>
  </tr>
  <tr>
    <td bgcolor="#00FFFF"><label for="bb"></label>
    <input type="text" name="bb" id="bb"></td>
    <td><label for="celcoin"></label>
    <input type="text" name="celcoin" id="celcoin"></td>
    <td><label for="recargapay"></label>
    <input type="text" name="recargapay" id="recargapay"></td>
    <td><input type="text" name="bancointer" id="bancointer" /></td>
    <td><label for="mercadopago"></label>
    <input type="text" name="mercadopago" id="mercadopago"></td>
    <td><input type="text" name="picpay" id="picpay" /></td>
  </tr>
  <tr>
    <td colspan="6"><input class="btn btn-primary" style="width:200px;" type="submit" name="button" id="button" value="ABRIR CAIXA"></td>
  </tr>
</table>
</form>
<? if(isset($_POST['button'])){
	
$valor_caixa = $_POST['valor_caixa'];
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
$bancointer = $_POST['bancointer'];
$celcoin = $_POST['celcoin'];
$recargapay = $_POST['recargapay'];
$mercadopago = $_POST['mercadopago'];
$picpay = $_POST['picpay'];

$codeCaixa = (rand())+date("i")*date("s");

$sql_inseri = mysqli_query($conexao_bd, "INSERT INTO abertura_de_caixa (codeCaixa, turno, operador, ip, status, dia, mes, ano, data, dada_completa, hora_abertura, notas100, notas50, notas20, notas10, notas5, notas2, moeda1, moeda50, moeda25, moeda10, moeda5, saldaobb, bb, celcoin, recargapay, mercadopago, bancointer, picpay) VALUES ('$codeCaixa', '$turno', '$operador', '$ip', 'Aberto', '$dia', '$mes', '$ano', '$data', '$data_completa', '$hora', '$notas100', '$notas50', '$notas20', '$notas10', '$notas5', '$notas2', '$moeda1', '$moeda50', '$moeda25', '$moeda10', '$moeda5', '$saldaobb', '$bb', '$celcoin', '$recargapay', '$mercadopago', '$bancointer', '$picpay')");

echo "<script language='javascript'>window.location='carrinho.php';</script>";


}?>
</div><!-- box_pagamento_1 -->
</script>
</body>
</html>