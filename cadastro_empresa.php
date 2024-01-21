<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/cadastro_empresa.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="box_pagamento_1">
<h1><strong>CADASTRAR EMPRESA EMISSOR DE BOLETO</strong></h1>
<hr />
<form name="" method="post" action="" enctype="multipart/form-data">
<table width="950" border="0">
  <tr>
    <td width="48" bgcolor="#999999"><strong>BANCO</strong></td>
    <td width="148" bgcolor="#999999"><strong>CÓDIGO DA EMPRESA</strong></td>
    <td width="253" bgcolor="#999999"><strong>NOME DA EMPRESA</strong></td>
    <td width="145" bgcolor="#999999"><strong>CNPJ</strong></td>
    <td width="128" bgcolor="#999999"><strong>JUROS</strong></td>
    <td width="129" bgcolor="#999999"><strong>TARIFADO</strong></td>
    <td width="69" bgcolor="#999999">&nbsp;</td>
  </tr>
  <tr>
    <td><label for="banco"></label>
      <span id="sprytextfield1">
      <input name="banco" type="text" id="banco" size="3" />
      <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span></td>
    <td><label for="code_empresa"></label>
      <span id="sprytextfield2">
      <input name="code_empresa" type="text" id="code_empresa" size="10" />
      <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span></td>
    <td><label for="nome_empresa"></label>
      <span id="sprytextfield3">
      <input name="nome_empresa" type="text" id="nome_empresa" size="30" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    <td><label for="cnpj"></label>
      <span id="sprytextfield4">
      <input name="cnpj" type="text" id="cnpj" size="15" />
      <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span></td>
    <td><label for="juros">
      <input name="juros" type="radio" id="radio3" value="sim" checked="checked" />
      SIM
      <input type="radio" name="juros" id="radio4" value="nao" />
N&Atilde;O </label></td>
    <td><input type="radio" name="tarifado" id="radio" value="sim">
    <label for="juros">SIM 
      <input name="tarifado" type="radio" id="radio2" value="nao" checked="checked">
      NÃO
    </label></td>
    <td><input type="submit" name="button" id="button" value="Enviar"></td>
  </tr>
</table>
</form>
</div><!-- box_pagamento_1 -->
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "custom", {useCharacterMasking:true, pattern:"000"});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "custom", {pattern:"00000 00000", useCharacterMasking:true});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "custom", {useCharacterMasking:true, pattern:"00.000.000/0000-00"});
</script>
</body>
</html>