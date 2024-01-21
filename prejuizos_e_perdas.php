<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/prejuizos_e_perdas.css" rel="stylesheet" type="text/css" />
</head>

<body>
<? require "topo.php";  require "scripts/verificador_caixa.php"; ?>
<div id="box_pagamento_1">
<? if(isset($_POST['button'])){
	
$tipo = $_POST['tipo'];
$quantidade = $_POST['quantidade'];
$motivo = $_POST['motivo'];
$produto = $_POST['produto'];
$data_ocorrencia = $_POST['data_ocorrencia'];

$sql_busca_produto = mysqli_query($conexao_bd, "SELECT * FROM produtos WHERE code = '$produto'");
if(mysqli_num_rows($sql_busca_produto) == ''){
}else{
	$sql_inseri = mysqli_query($conexao_bd, "INSERT INTO perdas_e_prejuizos (dia, mes, ano, data, data_completa, data_ocorrencia, ip, status, produto, quantidade, motivo, tipo, data_ocorrencia) VALUES ('$dia', '$mes', '$ano', '$data', '$data_completa', '$data_ocorrencia', '$ip', 'Ativo', '$produto', '$quantidade', '$motivo', '$tipo', '')");	
	
	while($res_produto = mysqli_fetch_array($sql_busca_produto)){
			
			$estoque = $res_produto['estoque']-$quantidade;
			$id = $res_produto['id'];
		
			mysqli_query($conexao_bd, "UPDATE produtos SET estoque = '$estoque' WHERE id = '$id'");
				
				
		} // fez o débito
	
	echo "<script language='javascript'>window.alert('INFORMAÇÃO REGISTRADA COM SUCESSO!');window.location='carrinho.php';</script>";
	
}
}?>
<form name="" method="post" enctype="multipart/form-data" action="">
<table width="1000" border="0">
  <tr>
    <td><strong>INFORMAR A PERDA DE PRODUTOS
    </strong>      <hr></td>
  </tr>
  <tr>
    <td width="167"><strong>DATA DA OCORR&Ecirc;NCIA</strong></td>
  </tr>
  <tr>
    <td width="167"><label for="data_ocorrencia"></label>
      <span id="sprytextfield1">
      <input name="data_ocorrencia" type="text" id="data_ocorrencia" size="20" value="<? echo date("d/m/Y"); ?>" />
      <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span></td>
  </tr>
  <tr>
    <td width="167"><strong>TIPO</strong></td>
  </tr>
  <tr>
    <td><strong>
      <select name="tipo" size="1" id="tipo">
        <option value="PERDA">PERDA</option>
        <option value="PREJU&Iacute;ZO">PREJU&Iacute;ZO</option>
      </select>
    </strong></td>
  </tr>
  <tr>
    <td><strong>QUANTIDADE</strong></td>
  </tr>
  <tr>
    <td><span id="sprytextfield2">
      <input name="quantidade" type="text" id="quantidade" size="5" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
  </tr>
  <tr>
    <td><strong>MOTIVO</strong></td>
  </tr>
  <tr>
    <td><span id="sprytextfield3">
      <input name="motivo" type="text" id="motivo" size="100" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
  </tr>
  <tr>
    <td><strong>PRODUTO</strong></td>
  </tr>
  <tr>
    <td><span id="sprytextfield4">
      <input name="produto" type="text" id="produto" size="20" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
  </tr>
  <tr>
    <td><strong>
      <input type="submit" name="button" id="button" value="ENVIAR" />
    </strong></td>
  </tr>
  </table>
</form>
</div><!-- box_pagamento_1 -->
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "date", {format:"dd/mm/yyyy", useCharacterMasking:true});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");
</script>
</body>
</html>