<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
</head>

<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<? require "topo.php";  require "scripts/verificador_caixa.php"; ?>
<div style="width:1000px; border-radius:10px; padding:10px; margin:5px auto 0 auto; background:#FFF;" id="box_pagamento_1">
<form name="" method="post" action="" enctype="multipart/form-data">
<h1 style="font:18px Arial, Helvetica, sans-serif;"><strong>REGISTRAR PIX/TRANSFERÊNCIA</strong></h1>
<table class="table table-striped table-bordered" width="990" border="0">
  <tr>
    <td width="156" bgcolor="#999999"><strong>DATA </strong></td>
    <td width="162" bgcolor="#999999"><strong>CPF</strong></td>
    <td width="312" bgcolor="#999999"><strong>NOME DO CLIENTE</strong></td>
    <td width="164" bgcolor="#999999"><strong>COMPROVANTE</strong></td>
    <td width="119" bgcolor="#999999"><strong>VALOR</strong></td>
    <td width="51" bgcolor="#999999">&nbsp;</td>
    </tr>
  <tr>
    <td><input name="data_transferencia" type="data" class="form-control" value="<? echo date("d/m/Y"); ?>"/></td>
    <td><input name="cpfTransferencia" type="text"  class="form-control" size="20"/></td>
    <td><input name="clienteTransferencia" type="text"  class="form-control" size="25"/></td>
    <td><input name="comprovante" type="file"  class="form-control" size="15"/></td>
    <td><input name="valorTra" type="text"  class="form-control" size="15" /></td>
    <td><input type="submit" name="button2" value="Enviar" /></td>
    </tr>
</table>
</form>
<? if(isset($_POST['button2'])){

$valor = $_POST['valorTra'];
if($valor < 1){
	echo "<script language='javascript'>window.alert('O VALOR DO SAQUE TRANSFERÊNCIA DEVE SER ENTRE 1 A 1500!');</script>";
}else{
	
$cpfTransferencia = $_POST['cpfTransferencia'];
$clienteTransferencia = $_POST['clienteTransferencia'];


$data_transferencia = $_POST['data_transferencia'];

$comprovante = $_FILES['comprovante']['name'];

$comprovante = str_replace(" ", "-", $comprovante); $comprovante = str_replace(",", "-", $comprovante); $comprovante = str_replace("ã", "a", $comprovante);
if(file_exists("comprovante_transferencia/$comprovante")){ $a = 1;while(file_exists("comprovante_transferencia/[$a]$comprovante")){$a++;}$comprovante = "[".$a."]".$comprovante;}
(move_uploaded_file($_FILES['comprovante']['tmp_name'], "comprovante_transferencia/".$comprovante));

$code_saque = rand();

$sql_insere = mysqli_query($conexao_bd, "INSERT INTO saque_transferencia (codeCaixa, turno, dia, mes, ano, data, data_completa, ip, operador, status, codigo, valor, cpf, cliente, data_transferencia, comprovante, motivo_cancelamento, operador_cancelamento) VALUES ('$codeCaixa', '$turno', '$dia', '$mes', '$ano', '$data', '$data_completa', '$ip', '$operador', 'Aguarda', '$code_saque', '$valor', '$cpfTransferencia', '$clienteTransferencia', '$data_transferencia', '$comprovante', '', '')");
if($sql_insere == ''){
	echo "<script language='javascript'>window.alert('OCORREU UM ERRO, TENTE NOVAMENTE!');</script>";
}else{
	echo "<script language='javascript'>window.alert('SOLICITAÇÃO DE SAQUE ENVIADO PARA ANALISE COM SUCESSO, AGUARDE A VERIFICAÇÃO!');window.location='';</script>";
 }
}
}?>
<hr />

<?
$sql_saque = mysqli_query($conexao_bd, "SELECT * FROM saque_transferencia WHERE data = '$data'");
if(mysqli_num_rows($sql_saque) == ''){
}else{
?>
<h1 style="font:15px Arial, Helvetica, sans-serif;"><strong>PIX/TRANSFERÊNCIAS REGISTRADAS</strong></h1>
<table class="table table-striped table-bordered table-primary table-hover" width="994" border="0">
  <tr>
    <td align="center" width="62" bgcolor="#CCCCCC"><strong>COD.</strong></td>
    <td align="center" width="108" bgcolor="#CCCCCC"><strong>DATA</strong></td>
    <td align="center" width="86" bgcolor="#CCCCCC"><strong>SATUS</strong></td>
    <td align="center" width="123" bgcolor="#CCCCCC"><strong>CPF</strong></td>
    <td width="423" bgcolor="#CCCCCC"><strong>NOME DO CLIENTE</strong></td>
    <td align="center" width="109" bgcolor="#CCCCCC"><strong>VALOR</strong></td>
    <td align="center" width="53" bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
  <? $i=1; while($res_saque = mysqli_fetch_array($sql_saque)){ $i++; ?>
  <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
    <td align="center"><? echo $res_saque['codigo']; ?></td>
    <td align="center"><? echo $res_saque['data']; ?></td>
    <td align="center"><? echo $res_saque['status']; ?></td>
    <td align="center"><? echo $res_saque['cpf']; ?></td>
    <td><? echo $res_saque['cliente']; ?></td>
    <td align="center">R$ <? echo number_format($res_saque['valor'],2, ',', '.'); ?></td>
    <td align="center">
	<? if($operador == '05379839371'){ ?>
    <a rel="superbox[iframe][550x205]" href="scripts/cancela_saque_transferencia.php?id=<? echo $res_saque['id']; ?>"><img src="img/deleta.jpg" width="18" height="18"></a>
    <? } ?>
  </td>
  </tr>
<? } ?>
</table>
<? } ?>



</div><!-- box_pagamento_1 -->

</body>
</html>