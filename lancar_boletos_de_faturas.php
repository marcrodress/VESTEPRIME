<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/lancar_boletos_de_faturas.css" rel="stylesheet" type="text/css" />
</head>

<body>
<? require "topo.php"; ?>


<div id="box_pagamento_1">
<h1><strong>LANÇAR BOLETOS DE FATURAS</strong></h1>
<hr />
<?
$sql_conta_corrente = mysqli_query($conexao_bd, "SELECT * FROM faturas_fechadas WHERE sit_pag = 'AGUARDA PAGAMENTO'");
?>
<table width="1000" border="0">
  <tr>
    <td width="99" bgcolor="#0099CC"><strong>VENCIMENTO</strong></td>
    <td width="286" bgcolor="#0099CC"><strong>CLIENTE</strong></td>
    <td width="117" bgcolor="#0099CC"><strong>CPF</strong></td>
    <td width="102" bgcolor="#0099CC"><strong>VALOR/FATURA</strong></td>
    <td bgcolor="#0099CC"><strong>C&Oacute;DIGO DE BARRAS</strong></td>
    <td width="66" bgcolor="#0099CC">&nbsp;</td>
  </tr>
  <? $soma_fatura = 0; while($res_fatura = mysqli_fetch_array($sql_conta_corrente)){ 
  
   	$id_faturas = $res_fatura['id'];
	$valor_faturas = $res_fatura['valor'];
	$faturas = $res_fatura['anexo_boleto'];
	
	$sql_verifica_restrincao = mysqli_query($conexao_bd, "SELECT * FROM clientes_restricao_email WHERE cliente = '".$res_fatura['cliente']."'");
	if(mysqli_num_rows($sql_verifica_restrincao) <= 0){  
  	
	if($valor_faturas >0){ ?>
  <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
    <td><? echo $res_fatura['vencimento']; ?></td>
    <td><?
    
	$i++;
	
	$sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '".$res_fatura['cliente']."'");
		while($res_clientes = mysqli_fetch_array($sql_cliente)){
			echo strtoupper($res_clientes['nome']);
		}
	$soma_fatura =  $res_fatura['valor']+$soma_fatura;
	?></td>
    <td><? echo $res_fatura['cliente']; ?></td>
    <td>R$ <? echo number_format($valor_faturas, 2, ',', '.'); ?></td>
    <td><label for="codigo_barras"></label>
    <form name="" method="post" action="" enctype="multipart/form-data">
      <input style="border:1px solid #000; text-align:center; font:15px Arial, Helvetica, sans-serif; color:#F00; border-radius:3px;" name="barras" type="text" size="40" value="<? echo $res_fatura['anexo_boleto']; ?>" /></td>
    <td>
      <input type="hidden" value="<? echo $res_fatura['code_fatura']; ?>" name="code_fatura">
      <input type="submit" name="button" id="button" value="ENVIAR">
    </form>
    </td>
  </tr>
  <? }}} ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td bgcolor="#CCCCCC">R$ <? echo number_format($soma_fatura, 2, ',', '.'); ?></td>
    <td>    
    <td>    
    <td>    
    <td>    
  </tr>
</table>
<? if(isset($_POST['button'])){
	
$code_fatura = $_POST['code_fatura'];
$barras = $_POST['barras'];

mysqli_query($conexao_bd, "UPDATE faturas_fechadas SET anexo_boleto = '$barras' WHERE code_fatura = '$code_fatura'");

echo "<script language='javascript'>window.alert('$barras - $code_fatura');</script>";

echo "<script language='javascript'>window.location='lancar_boletos_de_faturas.php';</script>";

}?>

<? if($_GET['p'] == 'excluir'){
	
$id_faturas = $_GET['id'];
mysqli_query($conexao_bd, "UPDATE faturas_fechadas SET anexo_boleto = '' WHERE id = '$id_faturas'");

echo "<script language='javascript'>window.location='lancar_boletos_de_faturas.php';</script>";

}?>
</div><!-- box_pagamento_1 -->
</body>
</html>