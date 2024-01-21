<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/cadastrar_modelos_celulares.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="box_cad_produto">
<h1><strong>MODELOS DE CELULARES</strong><hr /></h1>
<form name="" method="post" action="" enctype="multipart/form-data">
<table width="1190" border="0">
  <tr>
    <td width="187" bgcolor="#009999"><strong>SELECIONE A MARCA</strong></td>
    <td width="147" bgcolor="#009999"><strong>INFORME O MODELO</strong></td>
    <td colspan="2" bgcolor="#009999">&nbsp;</td>
  </tr>
  <tr>
    <td height="21"><label for="select"></label>
      <select name="marca" size="1" id="select">
       <?
       $sql_marca = mysqli_query($conexao_db, "SELECT * FROM marcas_celulares");
	   	while($res_marca = mysqli_fetch_array($sql_marca)){
	   ?>
        <option value="<? echo $res_marca['marca']; ?>"><? echo $res_marca['marca']; ?></option>
       <? } ?>
    </select></td>
    <td><label for="textfield"></label>
    <input name="modelo" type="text" id="textfield" size="10"></td>
    <td width="805"><input type="submit" name="button" id="button" value="ENVIAR"></td>
    <td width="33">&nbsp;</td>
  </tr>
</table>
</form>
<? if(isset($_POST['button'])){
	
$marca = strtoupper($_POST['marca']);
$modelo = strtoupper($_POST['modelo']);
$code_modelo = rand()*date("s");

$verifica_modelo = mysqli_query($conexao_db, "SELECT * FROM modelos_celulares WHERE marca = '$marca' AND modelo = '$modelo'");
if(mysqli_num_rows($verifica_modelo)>=1){
	echo "<script language='javascript'>window.alert('MODELO DESTA MARCA JÁ FOI ADICONADO!');</script>";
}else{
	mysqli_query($conexao_db, "INSERT INTO modelos_celulares (marca, modelo, code_modelo) VALUES ('$marca', '$modelo', '$code_modelo')");
	echo "<script language='javascript'>window.location='';</script>";
}
}?>
<hr />

<?
 $sql_marca = mysqli_query($conexao_db, "SELECT * FROM marcas_celulares");
 while($res_marca = mysqli_fetch_array($sql_marca)){
?>
<h2><strong><? echo $res_marca['marca']; ?></strong></h2>
<ul>
<?
 $sql_modelo = mysqli_query($conexao_db, "SELECT * FROM modelos_celulares WHERE marca = '".$res_marca['marca']."'");
 while($res_modelo = mysqli_fetch_array($sql_modelo)){
?>
<li><? echo $res_modelo['modelo']; ?> - <a href="?pack=cadastrar_modelos_celulares&id=<? echo $res_modelo['id']; ?>&pg=deleta"><img src="../../img/deleta.jpg" width="18" height="18" /></a></li>
<? } ?>
</ul>
<? } ?>
</div><!-- box_cad_produto -->
</body>
</html>
<? if($_GET['pg'] == 'deleta'){
	
$id = $_GET['id'];
mysqli_query($conexao_db, "DELETE FROM modelos_celulares WHERE id = '$id'");
echo "<script language='javascript'>window.location='?pack=cadastrar_modelos_celulares';</script>";

}?>