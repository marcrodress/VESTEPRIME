<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/cancela_pagamento.css" rel="stylesheet" type="text/css" />
</head>

<body>
<? require "topo.php"; ?>

<div id="box_pagamento_1">
<h1><strong>CANCELAR UM PAGAMENTO</strong></h1>
<hr />
<? if($_GET['p'] == ''){ ?>
<form name="" method="post" action="" enctype="multipart/form-data">
 <select class="select" name="tipo_convenio">
  <option value="BOLETO">BOLETO</option>
  <option value="CONVEIO">CONVÊNIO</option>
 </select>
 <input class="botao_avancar" type="submit" name="avancar" value="Avançar" />
</form>

<? if(isset($_POST['avancar'])){
	
$tipo_pagamento = $_POST['tipo_convenio'];

echo "<script language='javascript'>window.location='?p=2&tipo=$tipo_pagamento';</script>";

}?>

<? }// pagamentos 1 ?>



<? if($_GET['p'] == '2'){ ?>
<? if($_GET['tipo'] == 'BOLETO'){ ?>
<form name="" method="post" action="" enctype="multipart/form-data">
  <span id="sprytextfield500">
  <input class="codigo_barras" type="text" name="boleto" />
  <span class="textfieldRequiredMsg"></span><span class="textfieldInvalidFormatMsg"></span></span>
 <input class="botao_avancar2" type="submit" name="avancar" value="Avançar" />
</form>
<? } ?>

<? if($_GET['tipo'] == 'CONVEIO'){ ?>
<form name="" method="post" action="" enctype="multipart/form-data">
  <span id="sprytextfield0616151">
  <input class="codigo_barras" type="text" name="boleto" />
  <span class="textfieldRequiredMsg"></span><span class="textfieldInvalidFormatMsg"></span></span>
 <input class="botao_avancar2" type="submit" name="avancar" value="Avançar" />
</form>
<? } ?>
<? if(isset($_POST['avancar'])){
	
$boleto = $_POST['boleto'];
$tipo = $_GET['tipo'];

$sql_verifica_boleto = mysqli_query($conexao_bd, "SELECT * FROM pagamento_contas WHERE code_barras = '$boleto'");
if(mysqli_num_rows($sql_verifica_boleto) == ''){
	echo "<script language='javascript'>window.alert('BOLETO NÃO ENCONTRADO!');</script>";
}else{
	while($res_verifica_boleto = mysqli_fetch_array($sql_verifica_boleto)){
		$status = $res_verifica_boleto['status'];
		$boleto = base64_encode($boleto);
		if($status == 'Efetivado'){
			echo "<br><br><br><br><hr><strong>O pagamento foi efetivado e não pode ser cancelado!</strong><hr>";
		}else{
			echo "<script language='javascript'>window.location='?p=3&code_barras=$boleto&tipo=$tipo';</script>";
  } // verifica o boleto
 }
} // verifica se o boleto foi encontrado
}?>

<? }// pagamentos 2 ?>


<? if($_GET['p'] == '3'){ ?>

<form name="" method="post" action="" enctype="multipart/form-data">
<table width="1000" border="0">
  <tr>
    <td colspan="6" bgcolor="#CCCCCC"><strong>CÓDIGO DE BARRAS</strong></td>
  </tr>
  <tr>
    <td colspan="6"><? echo base64_decode($_GET['code_barras']); ?></td>
  </tr>
  <tr>
    <td width="191" bgcolor="#CCCCCC">BANCO</td>
    <td width="74" bgcolor="#CCCCCC">VALOR</td>
    <td width="85" bgcolor="#CCCCCC">JUROS</td>
    <td width="149" bgcolor="#CCCCCC">VENCIMENTO</td>
    <td width="157" bgcolor="#CCCCCC">DT. PAGT.</td>
    <td width="204" bgcolor="#CCCCCC">CLIENTE</td>
  </tr>
 <?
 $sql_boleto = mysqli_query($conexao_bd, "SELECT * FROM pagamento_contas WHERE code_barras = '".base64_decode($_GET['code_barras'])."'");
 	while($res_boleto = mysqli_fetch_array($sql_boleto)){
 ?>
  <tr>
    <td><? echo $res_boleto['banco']; ?></td>
    <td><? echo number_format($res_boleto['valor'], 2, ',', '.'); ?></td>
    <td><? echo $res_boleto['juros']; ?></td>
    <td><? echo $res_boleto['vencimento']; ?></td>
    <td><? echo $res_boleto['data_pagamento']; ?></td>
    <td><? echo $res_boleto['cliente']; ?></td>
  </tr>
  <? } ?>
  <tr>
    <td colspan="6" bgcolor="#CCCCCC">INFORME O MOTIVO</td>
  </tr>
  <tr>
    <td align="center" colspan="6"><input class="motivo" type="text" name="motivo" id="textfield"></td>
  </tr>
  <tr>
    <td colspan="6"><p><strong>ATENÇÃO</strong></p>
      <ul>
        <li>Confira todas as informações contidas na GUIA de recolhimento.</li>
        <li>Você poderá responder JUDICIALMENTE caso o cancelamento seja indevido.</li>
        <li>Após o cancelamento não poderá será desfeito.</li>
    </ul>
    <hr /></td>
  </tr>
  <tr>
    <td colspan="6"><input class="botao_avancar3" type="submit" name="button" id="button" value="Enviar"></td>
  </tr>
</table>
</form>
<? if(isset($_POST['button'])){
	
$motivo = $_POST['motivo'];
$tipo = $_GET['motivo'];
$code_barras = base64_decode($_GET['code_barras']); 


if($motivo == ''){
	echo "<script language='javascript'>window.alert('Informe o motivo do cancelamento!');</script>";
}else{
	$sql_cancela = mysqli_query($conexao_bd, "SELECT * FROM boletos_cancelados WHERE code_barras = '$code_barras'");
	if(mysqli_num_rows($sql_cancela) >= 1){
	echo "<script language='javascript'>window.alert('Já existe um registro de cancelamento desse boleto no sistema e não possível fazer outra solicitação!');</script>";	
	}else{
	 $sql_inseri = mysqli_query($conexao_bd, "INSERT INTO boletos_cancelados (dia, mes, ano, data, data_completa, ip, operador, tipo, status, code_barras, motivo) VALUES ('$dia', '$mes', '$ano', '$data', '$data_completa', '$ip', '$operador', '$tipo', 'Ativo', '$code_barras', '$motivo')");

	echo "<script language='javascript'>window.location='?p=4&code_barras=$boleto&tipo=$tipo&motivo=$motivo';</script>";
	 	
	}
 }
}?>
<? }// pagamentos 3 ?>


<? if($_GET['p'] == '4'){ ?>
<br /><br /><script language="javascript">
 function abrePopUps(urlImagem){
			window.open(urlImagem,'Foto_Ampliada','top=150,left=500,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=360,height=450');
		}
	</script>
<a class="a" onclick="abrePopUps('scripts/comprovante_de_cancelamento_pagamento.php?code_barra=<? echo $_GET['codigo_barras']; ?>&dia_pagamento=<? echo $dia_pagamento; ?>&vencimento=<? echo $vencimento; ?>&valor=<? echo $valores; ?>&convenio=<? echo $orgao; ?>&autenticacao=<? echo $autenticacao; ?>&n_doc=<? echo $n_doc; ?>');" href="">IMPRIMIR COMPROVANTE DE CANCELAMENTO</a>
<? }// pagamentos 4 ?>

</div><!-- box_pagamento_1 -->

<script type="text/javascript">
var sprytextfield500 = new Spry.Widget.ValidationTextField("sprytextfield500", "custom", {useCharacterMasking:true, pattern:"00000.00000 00000.000000 00000.000000 0 00000000000000"});
var sprytextfield0616151 = new Spry.Widget.ValidationTextField("sprytextfield0616151", "custom", {pattern:"00000000000-0 00000000000-0 00000000000-0 00000000000-0", useCharacterMasking:true});
var sprytextfield151515 = new Spry.Widget.ValidationTextField("sprytextfield151515", "date", {format:"dd/mm/yyyy", useCharacterMasking:true});
var sprytextfield260000165412 = new Spry.Widget.ValidationTextField("sprytextfield260000165412", "date", {format:"dd/mm/yyyy", useCharacterMasking:true});
</script>
</body>
</html>