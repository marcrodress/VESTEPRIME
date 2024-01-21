<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/incluir_comprovante_compra.css" rel="stylesheet" type="text/css" />
</head>

<body>
<? require "topo.php"; ?>

<div id="box_pagamento_1">
 <h1><strong>Envio de recibo de compra</strong></h1>

<?
$sql_1 = mysqli_query($conexao_bd, "SELECT * FROM lancamento_fatura WHERE comprovante = '' AND operador = '$operador' AND ano = '$ano' AND status != 'CANCELADO'");
if(mysqli_num_rows($sql_1) == ''){
	echo "<em>Não existe comprovantes para serem enviados!</em>";
}else{
?>
<table width="996" border="0">
  <tr>
    <td width="17" bgcolor="#009900">&nbsp;</td>
    <td width="67" bgcolor="#009900"><strong>DATA</strong></td>
    <td width="61" bgcolor="#009900"><strong>CPF</strong></td>
    <td width="172" bgcolor="#009900"><strong>CLIENTE</strong></td>
    <td width="158" bgcolor="#009900"><strong>DESCRIÇÃO</strong></td>
    <td width="76" bgcolor="#009900"><strong>VALOR</strong></td>
    <td width="71" bgcolor="#009900"><strong>PARCELAS</strong></td>
    <td width="86" bgcolor="#009900"><strong>VL. PARCELA</strong></td>
    <td width="87" bgcolor="#009900"><strong>VL. TOTAL</strong></td>
    <td width="100" bgcolor="#009900"><strong>COMPROVANTE</strong></td>
    <td width="55" bgcolor="#009900">&nbsp;</td>
  </tr>
<?
$i = 0;
$code_boleto = 0;

$inicio = 1;
$fim = 5;

while($res_1 = mysqli_fetch_array($sql_1)){ $i++;
?>
<form name="" method="post" action="" enctype="multipart/form-data">
  <tr <? if($i%2 == 0){ echo "bgcolor='#B5CDF2'"; }else{ echo "bgcolor='#C90'"; } ?>>
    <td><? echo $i; ?></td>
    <td><? echo $res_1['data']; ?></td>
    <td><? echo $res_1['cliente']; ?></td>
    <td><? 
	 $sql_2 = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '".$res_1['cliente']."'");
	 while($res_2 = mysqli_fetch_array($sql_2)){
		 echo $res_2['nome'];
	 }
	?></td>
    <td><? echo $res_1['descricao']; ?></td>
    <td>R$ <? echo number_format($res_1['valor'],2,',','.'); ?></td>
    <td><? echo $res_1['quant_parcela']; ?></td>
    <td>R$ <? echo number_format($res_1['valor_parcela'],2,',','.'); ?></td>
    <td>R$ <? echo number_format($res_1['valor_parcela']*$res_1['quant_parcela'],2,',','.'); ?></td>
    <td><input style="width:100px;" type="file" name="comprovante" id="fileField" /></td>
    <td><input type="submit" name="button" id="button" value="Enviar"></td>
  </tr>
<input type="hidden" name="id_doc" value="<? echo $res_1['id']; ?>" />
</form>
<? } ?>
</table>
<? } ?>

<? if(isset($_POST['button'])){
	
$id = $_POST['id_doc'];
$comprovante = $_FILES['comprovante']['name'];

$comprovante = str_replace(" ", "-", $comprovante); $comprovante = str_replace(",", "-", $comprovante); 
$comprovante = str_replace("ã", "a", $comprovante); $comprovante = str_replace("á", "a", $comprovante); 
$comprovante = str_replace("à", "a", $comprovante); $comprovante = str_replace("é", "e", $comprovante);
$comprovante = str_replace("ê", "e", $comprovante); $comprovante = str_replace("è", "e", $comprovante); 
$comprovante = str_replace("í", "i", $comprovante); $comprovante = str_replace("ì", "i", $comprovante); 
$comprovante = str_replace("ó", "o", $comprovante); $comprovante = str_replace("õ", "o", $comprovante);
$comprovante = str_replace("ç", "c", $comprovante);

if(file_exists("vesteprime_comprovantes/$comprovante")){ $a = 1;while(file_exists("vesteprime_comprovantes/[$a]$comprovante")){$a++;}$comprovante = "[".$a."]".$comprovante;}

(move_uploaded_file($_FILES['comprovante']['tmp_name'], "vesteprime_comprovantes/".$comprovante));

mysqli_query($conexao_bd, "UPDATE lancamento_fatura SET comprovante = '$comprovante' WHERE id = '$id'");
echo "<script language='javascript'>window.alert('Comprovante enviado com sucesso!!!');window.location='';</script>";

}?> 
 
</div><!-- box_pagamento_1 -->

</body>
</html>