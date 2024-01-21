<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/recargas_de_telefone.css" rel="stylesheet" type="text/css" />
<script src="../../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<? require "../../conexao.php"; ?>
</head>

<body>
<div id="box_recarga_telefone">
 <h1><strong>Recarga de telefone a vista</strong><hr /></h1>
 
<form name="" method="post" action="" enctype="multipart/form-data">
<table width="900" border="0">
  <tr>
    <td align="left" width="181">CPF do cliente:</td>
    <td align="left" width="253">Operadora para recarga:</td>
    <td align="left" width="204">Digite o n&uacute;mero do telefone:</td>
    <td align="left" width="253">Repita o n&uacute;mero do telefone:</td>
    <td align="left" width="37">Valor:</td>
  </tr>
  <tr>
    <td><label for="cpf"></label>
      <span id="sprytextfield1">
      <input name="cpf" type="text" id="cpf" size="35" value="<? echo @$cpf_cliente; ?>" />
</span></td>
    <td><label for="operadora"></label>
      <select class="select" name="operadora" size="1" id="operadora">
        <option value="Vivo">Vivo</option>
        <option value="Claro">Claro</option>
        <option value="Tim">Tim</option>
        <option value="Oi">Oi</option>
</select></td>
    <td><label for="telefone"></label>
      <span id="sprytextfield2">
      <input name="telefone" type="text" id="telefone" size="42" />
      </span></td>
    <td><label for="repita_tele"></label>
      <span id="sprytextfield3">
      <input name="repita_tele" type="text" id="repita_tele" size="42" />
      </span></td>
    <td><label for="valor"></label>
      <span id="sprytextfield4">
      <input name="valor" type="text" id="valor" size="10" />
      </span></td>
  </tr>
  <tr>
    <td align="center" colspan="5"><input class="input" type="submit" name="button" id="button" value="Confirmar"></td>
    </tr>
</table>
</form>
<? if(isset($_POST['button'])){

$cpf = $_POST['cpf'];
$operadora = $_POST['operadora'];
$telefone = $_POST['telefone'];
$repita_tele = $_POST['repita_tele'];
$valor = $_POST['valor'];

$dia = date("d/m/Y");

if($telefone != $repita_tele){
	echo "<h2><strong>O número digitado não confere com o mesmo digitado!</strong></h2>";
}elseif($valor > 100){
	echo "<h2><strong>Só é permitido fazer no máximo R$ 100 reas de recargas por número!</strong></h2>";
}else{
?>		 

<form name="" method="post" action="confirma_recarga.php" enctype="multipart/form-data">
<input type="hidden" name="cpf" value="<? echo $cpf; ?>" />
<input type="hidden" name="operadora" value="<? echo $operadora; ?>" />
<input type="hidden" name="telefone" value="<? echo $telefone; ?>" />
<input type="hidden" name="valor" value="<? echo $valor; ?>" />
<table width="950" border="0">
  <tr>
    <td colspan="4"><h3>Selecione as opções de pagamento para a recarga de número <strong><? echo $telefone; ?></strong> - Operadora: <strong><? echo $operadora; ?></strong></h3></td>
  </tr>
  <tr>
    <td colspan="4"><hr></td>
  </tr>
  <tr>
    <td width="20"><input type="radio" name="metodo_de_pagamento" id="radio" value="A vista em dinheiro - <? echo number_format($valor,2,",",".") ?>">
    <label for="metodo_de_pagamento"></label></td>
    <td width="326"><strong>A vista em dinheiro</strong></td>
    <td width="308"><strong>Valor da recarga:</strong> R$ <? echo number_format($valor,2,",",".") ?></td>
    <td width="278"><strong>Total a pagar:</strong> R$ <? echo number_format($valor,2,",",".") ?></td>
  </tr>
  <tr>
    <td><label for="metodo_de_pagamento">
      <input type="radio" name="metodo_de_pagamento" id="radio3" value="Cartão de débito - pagamento do valor total de <? $valor2 = $valor+($valor*9.3/100); echo number_format($valor2,2,",",".") ?>">
    </label></td>
    <td><strong>A vista no cartão de débito:</strong></td>
    <td><strong>Valor da recarga:</strong> R$ <? echo number_format($valor,2,",",".") ?></td>
    <td><strong>Total a pagar:</strong> R$ <? $valor2 = $valor+($valor*9.3/100); echo number_format($valor2,2,",",".") ?></td>
  </tr>
  <tr>
    <td colspan="4"><hr></td>
  </tr>
  <tr>
    <td colspan="4"><strong>Opções para pagamento com cartão de crédito:</strong></td>
  </tr>
    <?
   $sql_2 = mysql_query("SELECT * FROM simulador_meses LIMIT 12");
   	while($res_2 = mysql_fetch_array($sql_2)){
    ?>
	
	<? if($res_2['mes'] == '1'){

	?>
  <tr>
    <td><input type="radio" name="metodo_de_pagamento" id="radio2" value="Cartão de crédito em <? echo $res_2['mes']; ?> X de R$ <? $valor2 = $valor+($valor*12.9/100); echo number_format($valor2,2,",","."); ?> "></td>
    <td>
    <? echo $res_2['mes']; ?> X de R$ <? $valor2 = $valor+($valor*12.9/100); echo number_format($valor2,2,",","."); ?>
    <? }else{?>
  <tr>
    <td><input type="radio" name="metodo_de_pagamento" id="radio2" value="Cartão de crédito em <? echo $res_2['mes']; ?> X de R$ <? $valor2 = $valor+($valor*15/100)+($res_2['mes']*5*$valor/100); $valor3 = $valor2/$res_2['mes']; echo number_format($valor3,2,",","."); ?> com valor total de <? echo number_format($valor2,2,",",".") ?>"></td>
    <td>
	<? echo $res_2['mes']; ?> X de R$ <? $valor2 = $valor+($valor*15/100)+($res_2['mes']*5*$valor/100); $valor3 = $valor2/$res_2['mes']; echo number_format($valor3,2,",",".");
	}
	?>
    </td>
    <td>Valor da recarga: R$ <? echo number_format($valor,2,",",".") ?></td>
    <td>Total a pagar: R$ <? echo number_format($valor2,2,",",".") ?></td>
  </tr>
  <? } ?>
  <tr>
    <td align="center" colspan="4"><input class="input" type="submit" name="confirma" id="confirma" value="Confirmar recarga"></td>
  </tr>
</table>
</form>		 
<? }}?>
</div><!-- box_recarga_telefone -->
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "social_security_number", {format:"ssn_custom", pattern:"000.000.000-00", useCharacterMasking:true, isRequired:false});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "phone_number", {format:"phone_custom", pattern:"(00) 0000.0000", useCharacterMasking:true});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "social_security_number", {format:"ssn_custom", useCharacterMasking:true, pattern:"(00) 0000.0000"});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");
</script>
</body>
</html>