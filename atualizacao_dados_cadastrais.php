<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/atualizacao_dados_cadastrais.css" rel="stylesheet" type="text/css" />
</head>

<body>
<? require "topo.php";  require "scripts/verificador_caixa.php"; ?>

<div id="box_pagamento_1">
<? if($_GET['tipo'] == 'CONTATO'){ ?>
<h1><strong>ATUALIZE AS INFORMAÇÕES DE CONTATO DO CLIENTE</strong></h1>

<?

$sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '".$_GET['cliente']."'");
	while($res_cliente = mysqli_fetch_array($sql_cliente)){
?>
<form name="" method="post" action="" enctype="multipart/form-data">
<table width="1000" border="0">
  <tr>
    <td width="286" bgcolor="#999999"><strong>TELEFONE CELULAR 1:</strong></td>
    <td width="295" bgcolor="#999999"><strong>TELEFONE CELULAR 2:</strong></td>
    <td colspan="2" bgcolor="#999999"><strong>E-MAIL:</strong></td>
    </tr>
  <tr>
    <td><span id="sprytextfield12547851">
    <label for="celular_1"></label>
    <input name="celular_1" type="text" id="celular_1" size="15" value="<? echo $res_cliente['celular_1']; ?>" />
    <span class="textfieldRequiredMsg"></span><span class="textfieldInvalidFormatMsg"></span></span></td>
    <td><span id="sprytextfield2">
    <input name="celular_2" type="text" id="text1" size="15" value="<? echo $res_cliente['celular_2']; ?>" />
    <span class="textfieldInvalidFormatMsg"></span></span></td>
    <td width="230"><span id="sprytextfield3">
    <label for="text2"></label>
    <input name="email" type="text" id="text2" size="44" value="<? echo strtolower($res_cliente['email']); ?>" />
    </span></td>
    <td width="171"><input class="input" type="submit" name="button" id="button" value="Atualizar" /></td>
  </tr>
</table>
</form>
<? } ?>
<br />
<? if(isset($_POST['button'])){
	
$celular_1 = $_POST['celular_1'];
$celular_2 = $_POST['celular_2'];
$email = $_POST['email'];

$confirma_atualizacao = mysqli_query($conexao_bd, "UPDATE clientes SET celular_1 = '$celular_1', celular_2 = '$celular_2', email = '$email', ultima_atualizacao = '$data_completa', atualizacao = 'AGUARDA' WHERE cpf = '".$_GET['cliente']."'");

echo "<script language='javascript'>window.alert('INFORMAÇÕES ATUALIZADAS COM SUCESSO!');window.location='carrinho.php';</script>";



}?>
<? } // ATUALIZA INFORMAÇÕES DE CONTATO ?>
</div><!-- box_pagamento_1 -->
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield12547851", "custom", {useCharacterMasking:true, pattern:"(00) 00000.0000"});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "custom", {pattern:"(00) 00000.0000", useCharacterMasking:true, isRequired:false});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "none", {isRequired:false});
</script>
</body>
</html>