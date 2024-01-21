<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/emitir_nota_troco.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>

<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<? require "topo.php";  require "scripts/verificador_caixa.php"; ?>


<div id="box_pagamento_1">
<h1><strong>EMITIR NOTA DE PAGAMENTO</strong></h1>
<hr />
<form name="" method="post" action="" enctype="multipart/form-data">
<table class="table table-striped table-bordered" width="990" border="0">
  <tr>
    <td bgcolor="#999999"><strong>NOME</strong></td>
    <td bgcolor="#999999"><strong>CPF</strong></td>
    <td bgcolor="#999999"><strong>RG</strong></td>
    <td align="center" bgcolor="#999999"><strong>TRAVA RECEBIMENTO</strong></td>
    <td align="center" bgcolor="#999999"><strong>VALOR</strong></td>
    <td bgcolor="#999999">&nbsp;</td>
  </tr>
  <tr>
    <td><label for="textfield"></label>
      <span id="sprytextfield2">
      <input name="nome" type="text" id="textfield" size="53" autofocus />
      <span class="textfieldRequiredMsg"></span></span></td>
    <td><label for="textfield2"></label>
      <span id="sprytextfield116301603">
      <input name="cpf" type="text" id="textfield2" size="15" />
<span class="textfieldInvalidFormatMsg"></span></span></td>
    <td><label for="textfield3"></label>
      <span id="sprytextfield3">
      <input name="rg" type="text" id="textfield3" size="15" />
      <span class="textfieldRequiredMsg"></span></span></td>
    <td align="center">
    <input name="trava" type="radio" id="radio" value="SIM">
    <label for="radio">SIM 
      <input name="trava" type="radio" id="radio2" value="NAO" checked="checked">
    NÃO</label></td>
    <td align="center"><label for="textfield4"></label>
      <span id="sprytextfield4">
      <input name="valor" type="text" id="textfield4" size="5" />
      <span class="textfieldRequiredMsg"></span></span></td>
    <td><input type="submit" name="button" id="button" value="ENVIAR"></td>
  </tr>
</table>
</form>
<hr />
<? if(isset($_POST['button'])){
	
$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$rg = $_POST['rg'];
$trava = $_POST['trava'];
$valor = $_POST['valor'];

$verifica_virgula = 0;

$code_cupom = rand()+date("s");
$code_cupom = $code_cupom*date("s")+date("d")+date("m")+date("Y")+date("H");

$autenticacao = strtoupper(md5($code_cupom));

if($valor <= 0){
	echo "<script language='javascript'>window.alert('NÃO É POSSÍVEL EMITIR UMA NOTA COM VALOR ZERADO!');</script>";
}else{

if($trava == 'SIM' && $cpf == ''){
	echo "<script language='javascript'>window.alert('SIM O TRAVAMENTO FOR MARCADO COMO SIM, É NECESSÁRIO INFORMAR O CPF!');</script>";
}else{
for($i=0; $i<(strlen($valor)); $i++){
	if($valor[$i] == ','){
		$verifica_virgula = 1;
	}
}


if($verifica_virgula == 1){
echo "<script language='javascript'>window.alert('Não é aceito o uso de (VIRGULAS) para digitar valores!');</script>";
}else{
	
	$sql_verica = mysqli_query($conexao_bd, "SELECT * FROM emissao_de_nota_de_pagamento WHERE data = '$data' AND cpf = '$cpf'");
	if(mysqli_num_rows($sql_verica) >= 50){
		echo "<script language='javascript'>window.alert('Já foi emitido na data de hoje uma nota de pagamento para este cliente!');</script>";
	}else{
		mysqli_query($conexao_bd, "INSERT INTO emissao_de_nota_de_pagamento (codeCaixa, turno, data, data_completa, dia, mes, ano, status, operador, nome, cpf, rg, travado, valor, dias_juros, juros_rendidos, code_cupom, autenticacao, ultimo_dia_juros, data_cancelamento, operador_cancelamento, data_resgate, dia_resgate, operador_regaste) VALUES ('$codeCaixa', '$turno', '$data', '$data_completa', '$dia', '$mes', '$ano', 'Ativo', '$operador', '$nome', '$cpf', '$rg', '$trava', '$valor', '0', '0', '$code_cupom', '$autenticacao', '', '', '', '', '', '')");
	?>
    
   	  <script language="javascript">
		function abrePopUp(urlImagem){
			window.open(urlImagem,'Foto_Ampliada','top=150,left=500,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=340,height=400');
		}
	</script>
    <a class="comprovante" onclick="abrePopUp('scripts/emitir_nota_de_pagamento.php?code_cupom=<? echo $code_cupom; ?>');" href="emitir_nota_troco.php">IMPRIMIR NOTA DE PAGAMENTO</a>
    <hr />
    <?	die;
	}
  }	
 }
}
}?>


<form name="" method="post" action="" enctype="multipart/form-data">
<h4 style="font:12px Arial, Helvetica, sans-serif; margin:0 0 -20px 380px;"><strong>Digite o número da nota de pagamento</strong></h4>
 <input style="margin:20px 0 20px 400px; text-align:center;" name="number_nota" type="text" id="number_nota" size="20" />
 <input type="submit" name="send" value="Buscar" />
</form>
<? if(isset($_POST['send'])){
$number_nota = $_POST['number_nota'];
$sql_verica = mysqli_query($conexao_bd, "SELECT * FROM emissao_de_nota_de_pagamento WHERE code_cupom = '$number_nota'");
if(mysqli_num_rows($sql_verica) == ''){
	echo "Não foi encontrado nenhuma nota de pagamento...";
}else{
?>
<table width="1000" border="0">
  <tr>
    <td width="67" bgcolor="#99FF00"><strong>NOTA</strong></td>
    <td width="119" bgcolor="#99FF00"><strong>DATA</strong></td>
    <td width="47" bgcolor="#99FF00"><strong>STATUS</strong></td>
    <td width="282" bgcolor="#99FF00"><strong>NOME</strong></td>
    <td width="120" bgcolor="#99FF00"><strong>CPF</strong></td>
    <td width="56" bgcolor="#99FF00"><strong>TRAVADO</strong></td>
    <td width="61" bgcolor="#99FF00"><strong>VALOR</strong></td>
    <td width="39" bgcolor="#99FF00"><strong>DIAS</strong></td>
    <td width="112" bgcolor="#99FF00"><strong>VALOR A PAGAR</strong></td>
    <td width="55" bgcolor="#99FF00">&nbsp;</td>
  </tr>
  <? 
  $i = 0;
  while($res_cupom = mysqli_fetch_array($sql_verica)){ $i++; 
  ?>
  <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
    <td><? echo $res_cupom['code_cupom']; ?></td>
    <td><? echo $res_cupom['data_completa']; ?></td>
    <td><? echo $res_cupom['status']; ?></td>
    <td><? echo $res_cupom['nome']; ?></td>
    <td><? echo $res_cupom['cpf']; ?></td>
    <td><? echo $res_cupom['travado']; ?></td>
    <td>R$ <? echo number_format($res_cupom['valor'], 2, ',', '.'); ?></td>
    <td><? echo $res_cupom['dias_juros']; ?></td>
    <td>R$ <? echo number_format($res_cupom['valor']+$res_cupom['juros_rendidos'], 6, ',', '.'); ?></td>
    <td>
    <? if($res_cupom['data'] == $data && $res_cupom['status'] == 'Ativo'){?>
    <a href="?acao=cancela&id=<? echo $res_cupom['id']; ?>"><img src="img/deleta.jpg" width="15" height="15" title="CANCELAR CUPOM"></a>
    <? } ?>
   	  <script language="javascript">
		function abrePopUp(urlImagem){
			window.open(urlImagem,'Foto_Ampliada','top=150,left=500,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=340,height=400');
		}
	</script>
    <a onclick="abrePopUp('scripts/emitir_nota_de_pagamento.php?code_cupom=<? echo $res_cupom['code_cupom']; ?>');" href="emitir_nota_troco.php"><img src="img/imprimir.png" width="15" height="15"></a>    
    
    <? if($res_cupom['status'] == 'Ativo'){?>       
   <a rel="superbox[iframe][710x130]"href="scripts/regaste_nota_de_pagamento.php?code_cupom=<? echo $res_cupom['code_cupom']; ?>"><img src="img/dinheiro.jpg" width="15" height="15"></a>
    <? } ?>   
   </td>
  </tr>
 <? } ?>
</table>
<? }}?>

<? if($_GET['acao'] == 'cancela'){
	
mysqli_query($conexao_bd, "UPDATE emissao_de_nota_de_pagamento SET status = 'CANCELADO', data_cancelamento = '$data_completa', operador_cancelamento = '$operador' WHERE id = '".$_GET['id']."'");

echo "<script language='javascript'>window.location='emitir_nota_troco.php';</script>";

}?>
</div><!-- box_pagamento_1 -->
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield116301603", "custom", {useCharacterMasking:true, pattern:"000.000.000-00", isRequired:false});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "none", {isRequired:false});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");
</script>
</body>
</html>