<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/saldo_confirmado.css" rel="stylesheet" type="text/css" />
</head>

<body>
<? require "topo.php"; ?>


<div id="box_plano_canada">
<h1 style="font:18px Arial, Helvetica, sans-serif; margin:10px; color:#666; text-transform:uppercase;"><strong>SALDO CONFIRMADO</strong></h1>
<hr />
<form name="" method="post" action="" enctype="multipart/form-data">
<h1 style="font:12px Arial, Helvetica, sans-serif; margin:10px;"><strong>Tipo: 

<select name="tipo" size="1" id="tipo" style="font:12px Arial, Helvetica, sans-serif; background:#000; border:1px solid #333;color:#F60; text-align:center;
padding:10px; border-radius:5px;">
  <option value="SALDO">SALDO BANCARIO</option>
  <option value="INVESTIMENTO">INVESTIMENTO</option>
</select>
Descrição: <input style="font:12px Arial, Helvetica, sans-serif; border:1px solid #333;color:#F60; text-align:center; text-align:center;
padding:10px; border-radius:5px;" name="descr" type="text" value="" size="88" />
Valor: <input style="font:12px Arial, Helvetica, sans-serif; border:1px solid #333;color:#F60; text-align:center; text-align:center;
padding:10px; border-radius:5px;" name="valor" type="number" value="" size="10" />
<input style="font:12px Arial, Helvetica, sans-serif; border:1px solid #333;color:#F60; text-align:center; text-align:center;
padding:10px; border-radius:5px; margin:10px;" type="submit" name="enviar" value="Cadastrar" /></strong></h1>
</form>
<? if(isset($_POST['enviar'])){
 
$tipo = $_POST['tipo'];
$descr = $_POST['descr'];
$valor = $_POST['valor'];

mysqli_query($conexao_bd, "INSERT INTO plano_canada_saldo_confirmado (tipo, descricao, valor) VALUES ('$tipo', '$descr', '$valor')");

echo "<script language='javascript'>window.locaton='';</script>";
 
}?>

<hr />


<table style="margin:0 0 0 100px; border-radius:0; text-align:center; padding:10px; border:1px solid #000;" width="809" border="0">
  <tr>
    <td width="64" bgcolor="#111"><strong>TIPO.</strong></td>
    <td width="577" bgcolor="#111"><strong>DESCRIÇÃO</strong></td>
    <td width="130" bgcolor="#111"><strong>VL. TOTAL</strong></td>
    <td width="20" bgcolor="#000"></td>
  </tr>
  <?
   $valor = 0; $i = 0;
   $sql_despesas = mysqli_query($conexao_bd, "SELECT * FROM plano_canada_saldo_confirmado");
    while($res_despesas = mysqli_fetch_array($sql_despesas)){  $i++;  $valor = $valor+($res_despesas['valor']);
	$cor = 0; if($i%2 == 0){ $cor = "#333"; }else{ $cor = "#666"; }
	
  ?>
  <form name="" method="post" action="" enctype="multipart/form-data">
  <tr bgcolor='<? echo $cor; ?>'>
    <td><? echo $res_despesas['tipo']; ?></td>
    <td><input style="width:0px; border:1px solid <? echo $cor; ?>; background:<? echo $cor; ?>;" type="submit" name="goes" value="" /> <? echo $res_despesas['descricao']; ?></td>
    <td>R$ <input name="valor" type="text" style="border:1px solid <? echo $cor; ?>; background:<? echo $cor; ?>; width:60px; text-align:center;" value="<? echo $res_despesas['valor']; ?>" size="3" /></td>
    <td><a href="?pg=excluir&id=<? echo $res_despesas['id']; ?>"><img src="img/deleta.fw.png".jpg" border="0" /></a></td>
  </tr>
   <input type="hidden" name="id" value="<? echo $res_despesas['id']; ?>" />
  </form>
  <? } ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>R$ <? echo number_format($valor,2,',','.'); ?></td>
    <td>&nbsp;</td>
  </tr>
</table>


</div><!-- box_plano_canada -->
</body>
</html>
<? if(isset($_POST['goes'])){

$id = $_POST['id'];
$valor = $_POST['valor'];

mysqli_query($conexao_bd, "UPDATE plano_canada_saldo_confirmado SET valor = '$valor' WHERE id = '$id'");

echo "<script language='javascript'>window.location='';</script>";

}?>


<? if($_GET['pg'] == 'excluir'){

 mysqli_query($conexao_bd, "DELETE FROM plano_canada_saldo_confirmado WHERE id = '".$_GET['id']."'");
 echo "<script language='javascript'>window.locaton='saldo_confirmado.php';</script>";

}?>