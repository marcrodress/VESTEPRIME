<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/plano_canada_previsto.css" rel="stylesheet" type="text/css" />
</head>

<body>
<? require "topo.php"; ?>


<div id="box_plano_canada">
<h1 style="font:18px Arial, Helvetica, sans-serif; margin:10px; color:#666; text-transform:uppercase;"><strong>Plano canadá - Despesas a pagar</strong></h1>
<hr />
<form name="" method="post" action="" enctype="multipart/form-data">
<h1 style="font:12px Arial, Helvetica, sans-serif; margin:10px;"><strong>Quantidade: <input style="font:12px Arial, Helvetica, sans-serif; color:#F00; border:1px solid #111; text-align:center;
padding:10px; border-radius:5px;" name="quant" type="number" value="" size="5" maxlength="2" />
Descrição: <input style="font:12px Arial, Helvetica, sans-serif; color:#F00; border:1px solid #111; text-align:center;
padding:10px; border-radius:5px;" name="descr" type="text" value="" size="97" />
Valor: <input style="font:12px Arial, Helvetica, sans-serif; color:#F00; border:1px solid #111; text-align:center;
padding:10px; border-radius:5px;" name="valor" type="number" value="" size="10" />
<input style="font:12px Arial, Helvetica, sans-serif; color:#F60; border:1px solid #111; text-align:center;
padding:10px; border-radius:5px; margin:10px;" type="submit" name="enviar" value="Cadastrar" /></strong></h1>
</form>
<? if(isset($_POST['enviar'])){
 
$quant = $_POST['quant'];
$descr = $_POST['descr'];
$valor = $_POST['valor'];

mysqli_query($conexao_bd, "INSERT INTO plano_canada_despesas (quant, descricao, valor) VALUES ('$quant', '$descr', '$valor')");

echo "<script language='javascript'>window.location='';</script>";
 
}?>

<hr />


<table style="margin:40px; border-radius:0; text-align:center; padding:10px; border:1px solid #000;" width="900" border="0">
  <tr>
    <td width="64" bgcolor="#333333"><strong>QUANT.</strong></td>
    <td width="577" bgcolor="#333333"><strong>DESCRIÇÃO</strong></td>
    <td width="109" bgcolor="#333333"><strong>VL. UNIT.</strong></td>
    <td width="130" bgcolor="#333333"><strong>VL. TOTAL</strong></td>
    <td width="20" style="border:1px solid #000; background:#000;" bgcolor="#333333"></td>
  </tr>
  <?
   $valor = 0; $i = 0;
   $sql_despesas = mysqli_query($conexao_bd, "SELECT * FROM plano_canada_despesas");
    while($res_despesas = mysqli_fetch_array($sql_despesas)){  $i++;  $valor = $valor+($res_despesas['valor']*$res_despesas['quant']);
	$cor = 0; if($i%2 == 0){ $cor = "#333"; }else{ $cor = "#666"; }
  ?>
  <form name="" method="post" action="" enctype="multipart/form-data">
   <input type="hidden" name="id" value="<? echo $res_despesas['id']; ?>" />
  <tr bgcolor='<? echo $cor; ?>'>
    <td><input style="font:12px Arial, Helvetica, sans-serif; color:#F60; text-align:center; border:1px solid <? echo $cor; ?>; background:<? echo $cor; ?>;" name="quant" type="text" value="<? echo $res_despesas['quant']; ?>" size="2" maxlength="2" /></td>
    <td><? echo $res_despesas['descricao']; ?></td>
    <td><input style="font:12px Arial, Helvetica, sans-serif; color:#F60; text-align:center; border:1px solid <? echo $cor; ?>; background:<? echo $cor; ?>;" type="text" name="valoruni" value="<? echo $res_despesas['valor']; ?>" size="5" /> 
    <input style="font:12px Arial, Helvetica, sans-serif; color:#F60; text-align:center; border:1px solid <? echo $cor; ?>; background:<? echo $cor; ?>;" type="submit" name="goes" value="" /></td>
    <td>R$ <? echo number_format($res_despesas['valor']*$res_despesas['quant'],2,',','.'); ?></td>
    <td><a href="?pg=excluir&id=<? echo $res_despesas['id']; ?>"><img src="img/deleta.fw.png" border="0" /></a></td>
  </tr>
  </form>
  <? } ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><strong>R$ <? echo number_format($valor,2,',','.'); ?></strong></td>
    <td>&nbsp;</td>
  </tr>
</table>

<? if(isset($_POST['goes'])){
	
$quant = $_POST['quant'];
$valoruni = $_POST['valoruni'];
$id = $_POST['id'];

mysqli_query($conexao_bd, "UPDATE plano_canada_despesas SET quant = '$quant', valor = '$valoruni' WHERE id = '$id'");
echo "<script language='javascript'>window.location='';</script>";

}?>



</div><!-- box_plano_canada -->
</body>
</html>
<? if($_GET['pg'] == 'excluir'){

 mysqli_query($conexao_bd, "DELETE FROM plano_canada_despesas WHERE id = '".$_GET['id']."'");
 echo "<script language='javascript'>window.locaton='despesas_plano_canada.php';</script>";

}?>