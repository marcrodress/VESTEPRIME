<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/efetivar_pagamento.css" rel="stylesheet" type="text/css" />
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<? require "../conexao.php"; ?>

</head>

<body>
<div id="box">
<? if(isset($_POST['forma_processamento'])){
	

$forma_processamento = $_POST['forma_processamento'];
$banco = $_POST['banco'];
$tarifa = $_POST['tarifa'];
$comissao = $_POST['comissao'];
$data_pagamento = $_POST['data_pagamento'];
$observacao = $_POST['observacao'];
$cliente = $_POST['cliente'];
$valor_boleto = $_POST['valor_boleto']+$tarifa;
$operador = $_GET['operador'];


mysqli_query($conexao_bd, "UPDATE pagamento_boletos SET operador_efetivado = '$operador', data_efetivado = '$data', forma_processamento = '$forma_processamento', banco_processamento = '$banco', tarifa_processamento = '$tarifa', comissao = '$comissao', data_pagamento = '$data_pagamento', observacao = '$observacao', status = 'Efetivado' WHERE id = '".$_GET['id']."'");


echo "Pagamento efetivamento com sucesso!<br><br> Pressione F5 para finalizar a operação";

die;

}?>




<?

$sql_verifica_pagamento = mysqli_query($conexao_bd, "SELECT * FROM pagamento_boletos WHERE id = '".$_GET['id']."'");
	while($res_pagamento = mysqli_fetch_array($sql_verifica_pagamento)){
?>
<form name="" method="post" action="" enctype="multipart/form-data">
<table width="951" border="0">
  <tr>
    <td colspan="5">CÓDIGO DE BARRAS:
      <label for="textfield3"></label>
      <input name="textfield3" type="text" disabled id="textfield3" size="100" value="<? echo $res_pagamento['code_barras']; ?>"></td>
    <td width="180" rowspan="2">VENCIMENTO:
      <label for="textfield8"></label>      <input name="textfield8" value="<? echo $res_pagamento['vencimento']; ?>" type="text" disabled id="textfield8" size="20"></td>
  </tr> 
  <input type="hidden" name="cliente" value="<? echo $res_pagamento['cliente']; ?>" />
  <input type="hidden" name="valor_boleto" value="<? echo $res_pagamento['valor']; ?>" />
  <tr>
    <td colspan="2">BANCO EMISSOR: 
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
   <td colspan="6"><hr /></td>
  </tr>
  <tr>
    <td width="192">FORM. PROCESSAMENTO</td>
    <td width="176">BANCO</td>
    <td>TARIFA</td>
    <td>COMISSÃO</td>
    <td>DATA DE PAGAMENTO</td>
    <td>OBSERVA&Ccedil;&Atilde;O</td>
    </tr>
  <tr>
    <td><label for="forma_processamento"></label>
      <select name="forma_processamento" size="1" id="forma_processamento">
<option value="MAQUINA DE PAGAMENTO">MAQUINA DE PAGAMENTO</option>
<option value="CR&Eacute;DITO EM CONTA">CR&Eacute;DITO EM CONTA</option>
<option value="CONTA BANCARIA">CONTA BANCARIA</option>
<option value="CONTA BANCARIA">CART&Atilde;O DE CR&Eacute;DITO</option>
        <option value="OUTROS">OUTROS</option>
      </select></td>
    <td><label for="banco"></label>
      <select name="banco" size="1" id="banco">
        <option value="BANCO DO BRASIL">BANCO DO BRASIL</option>
        <option value="RECARGA PAY">RECARGA PAY</option>
        <option value="ITA&Uacute;">ITA&Uacute;</option>
        <option value="SANTANDER">SANTANDER</option>
        <option value="BANCO INTER">BANCO INTER</option>
        <option value="PICPAY">PICPAY</option>
        <option value="CELCOIN">CELCOIN</option>
      </select></td>
    <td><label for="select3"></label>
      <label for="tarifa"></label>
    <input name="tarifa" type="text" id="tarifa" value="0" size="5"></td>
    <td><input name="comissao" type="text" id="comissao" value="0" size="7"></td>
    <td><label for="select4"></label>
      <label for="observacao"></label>
      <label for="textfield9"></label>
      <span id="sprytextfield1">
      <input name="data_pagamento" type="text" id="textfield9" size="12" value="<? echo date("d/m/Y"); ?>" />
      <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span>      
      <label for="comissao"></label></td>
    <td><input name="observacao" type="text" id="observacao" size="20" /></td>
    </tr>
  <tr>
    <td colspan="6"><hr />      <input type="submit" name="button" id="button" value="EFETIVAR"></td>
  </tr>
</table>
</form>
<? } ?>
</div>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "date", {format:"dd/mm/yyyy", useCharacterMasking:true});
</script>
</body>
</html>