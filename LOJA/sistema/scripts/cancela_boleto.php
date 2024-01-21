<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/cancela_boleto.css" rel="stylesheet" type="text/css" />
</head>

<body>
<? require "../../conexao.php"; ?>
<div id="box">
<? if(isset($_POST['button'])){

$motivo = $_POST['motivo'];

mysql_query("UPDATE pagamento_boletos SET status = 'CANCELADO', motivo_cancelamento = '$motivo', operador_cancelamento = '$operador', data_cancelamento = '$data_completa' WHERE id = '".$_GET['id']."'");


echo "Pagamento cancelado com sucesso!<br><br> Pressione F5 para finalizar a operação";

die;

}?>


<?

$sql_verifica_pagamento = mysql_query("SELECT * FROM pagamento_contas WHERE id = '".$_GET['id']."'");
	while($res_pagamento = mysql_fetch_array($sql_verifica_pagamento)){
?>
<form name="" method="post" action="" enctype="multipart/form-data">
<table width="951" border="0">
  <tr>
    <td colspan="4">CÓDIGO DE BARRAS:
      <label for="textfield3"></label>
      <input name="textfield3" type="text" disabled id="textfield3" size="100" value="<? echo $res_pagamento['code_barras']; ?>"></td>
    <td width="180" rowspan="2">VENCIMENTO:
      <label for="textfield8"></label>      <input name="textfield8" value="<? echo $res_pagamento['vencimento']; ?>" type="text" disabled id="textfield8" size="20"></td>
  </tr> 
  <input type="hidden" name="cliente" value="<? echo $res_pagamento['cliente']; ?>" />
  <input type="hidden" name="valor_boleto" value="<? echo $res_pagamento['valor']; ?>" />
  <tr>
    <td width="192">BANCO EMISSOR: 
      <label for="textfield4"></label>
    <input name="textfield4" type="text" disabled id="textfield4" value="<? echo $res_pagamento['banco']; ?>" size="40"></td>
    <td width="86">VALOR: 
      <label for="textfield5"></label>
    <input name="textfield5" type="text" disabled id="textfield5" value="<? echo number_format($res_pagamento['valor'], 2, ',', '.'); ?>" size="10"> </td>
    <td width="134">JUROS: 
      <label for="textfield6"></label>
    <input name="textfield6" type="text" disabled id="textfield6" value="<? echo $res_pagamento['juros']; ?>" size="10"></td>
    <td width="155">TARIFA: 
      <label for="textfield7"></label>
      <input name="textfield7" type="text" disabled id="textfield7" value="<? echo $res_pagamento['tarifa']; ?>" size="10"></td>
    </tr>
  <tr>
   <td colspan="5"><hr /></td>
  </tr>
  <tr>
    <td colspan="5"><strong>DESCREVA O MOTIVO DO CANCELAMENTO</strong></td>
    </tr>
  <tr>
    <td colspan="5"><label for="select3"></label>
      <label for="select4"></label>
      <label for="textarea"></label>
      <textarea name="motivo" id="textarea" cols="130" rows="3"></textarea>
      <label for="observacao"></label></td>
    </tr>
  <tr>
    <td colspan="5"><hr />      <input type="submit" name="button" id="button" value="EFETIVAR"></td>
  </tr>
</table>
</form>
<? } ?>
</div>
</body>
</html>