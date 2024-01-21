<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/agendar_telefonema.css" rel="stylesheet" type="text/css" />
<script src="../../../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../../../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="box">
 <form action="confirmar_agendamento.php" method="post" name="form1" target="_top">
   <table width="354" border="0">
     <tr>
      <td width="103"><strong>Nome:</strong></td>
      <td width="129"><strong>Telefone:</strong></td>
      <td width="108"><strong>CPF:</strong></td>
    </tr>
    <tr>
      <td><label for="telefone_cliente"></label>
        <span id="sprytextfield3">
        <input type="text" name="nome_cliente" id="textfield2" />
        </span></td>
      <td><label for="cpf_cliente"></label>
        <span id="sprytextfield1">
        <input type="text" name="telefone_cliente" id="textfield3" />
        </span></td>
      <td><label for="rg_cliente"></label>
        <span id="sprytextfield2">
        <input type="text" name="cpf_cliente" id="textfield4" />
        </span></td>
    </tr>
    <tr>
      <td colspan="3"><strong>Motivo da liga&ccedil;&atilde;o</strong></td>
      </tr>
    <tr>
      <td colspan="3"><label for="textarea"></label>
        <textarea name="atividade" id="textarea" cols="93" rows="3"></textarea>        <label for="tipo_atendimento"></label></td>
      </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input class="input" type="submit" name="button" id="button" value="Enviar" /></td>
      <td>&nbsp;</td>
    </tr>
</table>
</form>
</div><!-- box -->
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "phone_number", {format:"phone_custom", pattern:"(00) 0000.0000", useCharacterMasking:true, isRequired:false});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "social_security_number", {format:"ssn_custom", useCharacterMasking:true, pattern:"000.000.000-00", isRequired:false});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "none", {isRequired:false});
</script>
</body>
</html>