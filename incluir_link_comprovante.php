<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/incluir_link_comprovante.css" rel="stylesheet" type="text/css" />
</head>

<body>
<? require "topo.php"; ?>

<div id="box_pagamento_1">
 <h1><strong>Incluir link de comprovante<hr /></strong></h1>
<?
$sql_1 = mysqli_query($conexao_bd, "SELECT * FROM pagamento_boletos WHERE comprovante = '' AND operador = '$operador' AND ano = '$ano' AND status = 'Efetivado' LIMIT 20");
if(mysqli_num_rows($sql_1) == ''){
	echo "<em>Não existe comprovantes para serem enviados!</em>";
}else{
?>
<table width="996" border="0">
  <tr>
    <td width="17" bgcolor="#0099FF">&nbsp;</td>
    <td width="48" bgcolor="#0099FF"><strong>TIPO</strong></td>
    <td width="216" bgcolor="#0099FF"><strong>COD. BARRAS</strong></td>
    <td width="83" bgcolor="#0099FF"><strong>VENCIMENTO</strong></td>
    <td width="84" bgcolor="#0099FF"><strong>VL. TOTAL</strong></td>
    <td width="112" bgcolor="#0099FF"><strong>DATA EFETIVADO</strong></td>
    <td width="84" bgcolor="#0099FF"><strong>OPERADOR</strong></td>
    <td width="100" bgcolor="#0099FF"><strong>CLIENTE</strong></td>
    <td width="150" bgcolor="#0099FF"><strong>COMPROVANTE</strong></td>
    <td width="60" bgcolor="#0099FF">&nbsp;</td>
  </tr>
<?
$i = 0;
$code_boleto = 0;

$inicio = 1;
$fim = 5;

?>
<? while($res_1 = mysqli_fetch_array($sql_1)){ $i++; ?>
<form name="" method="post" action="" enctype="multipart/form-data">
<input type="hidden" name="id_pag" value="<? echo $res_1['id']; ?>" /> 
  <tr <? if($i%2 == 0){ echo "bgcolor='#B5CDF2'"; }else{ echo "bgcolor='#999'"; } ?>>
    <td><? echo $i; ?></td>
    <td><? echo $res_1['tipo']; ?></td>
    <td><? echo $res_1['code_barras']; ?></td>
    <td><? echo $res_1['vencimento']; ?></td>
    <td>R$ <? echo number_format($res_1['valor']+$res_1['juros'],2,',','.'); ?></td>
    <td><? echo $res_1['data_efetivado']; ?></td>
    <td><? echo $res_1['operador']; ?></td>
    <td><a rel="superbox[iframe][300x70]" href="scripts/mostrar_cliente.php?cliente=<? echo $res_1['cliente']; ?>"><? echo $res_1['cliente']; ?></a></td>
    <td><input style="width:150px;" name="comprovante" type="text" size="30"></td>
    <td><input type="submit" name="button_link" id="button" value="Enviar"></td>
  </tr>
</form>
<? } ?>
</table>
<? } ?>
 
<? if(isset($_POST['button_link'])){
	
$id_pag = $_POST['id_pag'];
$comprovante = $_POST['comprovante'];

mysqli_query($conexao_bd, "UPDATE pagamento_boletos SET comprovante = '$comprovante' WHERE id = '$id_pag'");
echo "<script language='javascript'>window.alert('Comprovante enviado com sucesso!!!');window.location='';</script>";
}?> 

 
</div><!-- box_pagamento_1 -->

</body>
</html>