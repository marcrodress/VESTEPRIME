<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/categoria_subcategoria.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>

<body>
<? require "topo.php";  require "scripts/verificador_caixa.php"; ?>

<div id="box_cadastro">
<? if(isset($_POST['button'])){

$ordem = $_POST['ordem'];
$categoria = $_POST['categoria'];
$code_categoria = rand();

mysqli_query($conexao_bd, "INSERT INTO menu_principal (ordem, code_categoria, nome_categoria, mostrar) VALUES ('$ordem', '$code_categoria', '$categoria', 'SIM')");
echo "<script language='javascript'>window.location='';</script>";


}?>
<form name="" method="post" action="" enctype="multipart/form-data">
<h1><strong>CATEGÓRIA E SUB CATEGÓRIA</strong></h1> <a style="font:12px Arial, Helvetica, sans-serif; background:#0C3; color:#FFF; text-decoration:none; padding:5px; margin:10px;" target="_blank" href="gerar_revista.php">GERAR REVISTA</a>
<a style="font:12px Arial, Helvetica, sans-serif; background:#0C3; color:#FFF; text-decoration:none; padding:5px; margin:10px;" target="_blank" href="gerar_revista2.php">GERAR REVISTA REVENDA</a>
<hr />
<table class="table" width="995" border="0" style="font:12px Arial, Helvetica, sans-serif; border:1px solid #999; text-align:center; border-radius:20px; padding:10px;">
  <tr>
    <td width="80" bgcolor="#00CCCC" style="font:12px Arial, Helvetica, sans-serif; border:1px solid #999; border-radius:20px;"><strong>ORDEM</strong></td>
    <td width="309" bgcolor="#00CCCC" style="font:12px Arial, Helvetica, sans-serif; border:1px solid #999; border-radius:20px;"><strong>CATEGÓRIA</strong></td>
    <td width="134" bgcolor="#FFFFFF">&nbsp;</td>
    <td width="66" bgcolor="#999900"><strong>ORDEM</strong></td>
    <td width="66" bgcolor="#999900"><strong>CATEG&Oacute;RIA</strong></td>
    <td colspan="2" bgcolor="#999900"><strong>SUB CATEG&Oacute;RIA</strong></td>
    </tr>
  <tr  style="font:12px Arial, Helvetica, sans-serif; border:1px solid #999; border-radius:20px;">
    <td bgcolor="#00CCCC" style="font:12px Arial, Helvetica, sans-serif; border:1px solid #999; border-radius:20px;"><label for="textfield"></label>
    <input style="width:30px;" name="ordem" type="number" id="textfield" size="6"></td>
    <td bgcolor="#00CCCC" style="font:12px Arial, Helvetica, sans-serif; border:1px solid #999; border-radius:20px;"><label for="textfield2"></label>
    <input name="categoria" type="text" id="textfield2" size="20"></td>
    <td bgcolor="#00CCCC" style="font:12px Arial, Helvetica, sans-serif; border:1px solid #999; border-radius:20px;"><input type="submit" name="button" id="button" value="ENVIAR"></td>
    </form>

    
<form name="" method="post" action="" enctype="multipart/form-data">    
    <td style="font:12px Arial, Helvetica, sans-serif; border:1px solid #999; border-radius:20px;"><input style="width:30px;" name="ordem" type="number" id="textfield3" size="6" /></td>
    <td style="font:12px Arial, Helvetica, sans-serif; border:1px solid #999; border-radius:20px;"><label for="categoria"></label>
      <select name="categoria" size="1" id="categoria">
      <?
      $sql_categoria = mysqli_query($conexao_bd,"SELECT * FROM menu_principal");
	  	while($res_categoria = mysqli_fetch_array($sql_categoria)){
	  ?>
        <option value="<? echo $res_categoria['code_categoria']; ?>"><? echo $res_categoria['nome_categoria']; ?></option>
      <? } ?>
    </select></td>
    <td width="134" style="font:12px Arial, Helvetica, sans-serif; border:1px solid #999; border-radius:20px;"><input name="subcategoria" type="text" id="textfield4" size="15" /></td>
    <td width="134" style="font:12px Arial, Helvetica, sans-serif; border:1px solid #999; border-radius:20px;"><input type="submit" name="button2" id="button2" value="ENVIAR" /></td>
  </tr>
  </form>
</table>
<? if(isset($_POST['button2'])){
	
$ordem = $_POST['ordem'];
$categoria = $_POST['categoria'];
$subcategoria = $_POST['subcategoria'];
$code_subcategoria = rand();

mysqli_query($conexao_bd, "INSERT INTO sub_categoria (ordem, code_subcategoria, nome_categoria, code_categoria) VALUES ('$ordem', '$code_subcategoria', '$subcategoria', '$categoria')");
echo "<script language='javascript'>window.location='';</script>";

}?>



<hr />
<ul>
<?
$sql_menu = mysqli_query($conexao_bd, "SELECT * FROM menu_principal ORDER BY ordem ASC");
	while($res_menu = mysqli_fetch_array($sql_menu)){
?>

<script language="Javascript">
function confirmacao(id) {
     var resposta = confirm("Deseja remover esse excluir essa categória?");
     if (resposta == true) {
          window.location.href = "?excluir=categoria&id="+id;
     }
}
</script>

<script language="Javascript">
function deleta(id) {
     var resposta = confirm("Deseja remover esse excluir essa sub categória?");
     if (resposta == true) {
          window.location.href = "?excluir=subcategoria&id="+id;
     }
}
</script>

<li><strong><? echo $res_menu['ordem']; ?> - <? echo $res_menu['nome_categoria']; ?> <a rel="superbox[iframe][330x100]" href="scripts/atualizar_categoria_subcategoria.php?pg=categoria&id=<? echo $res_menu['id']; ?>"><img src="img/cadastro.jpg" title="Editar categória" width="15" height="15" /></a> 
</strong><a href="javascript:func()"
onclick="confirmacao('<? echo $res_menu['id']; ?>')"><img src="img/deleta.jpg" width="12" height="12" /></a>
<ul>
<?
$sql_sub = mysqli_query($conexao_bd, "SELECT * FROM sub_categoria WHERE code_categoria = '".$res_menu['code_categoria']."' ORDER BY ordem ASC");
	while($res_sub = mysqli_fetch_array($sql_sub)){
?>
<li><? echo $res_sub['ordem']; ?> - <? echo $res_sub['nome_categoria']; ?> 
<a rel="superbox[iframe][330x100]" href="scripts/atualizar_categoria_subcategoria.php?pg=subcategoria&id=<? echo $res_sub['id']; ?>"><img src="img/cadastro.jpg" title="Editar categória" width="15" height="15" /></a> 
<a href="javascript:func()"
onclick="deleta('<? echo $res_sub['id']; ?>')"><img src="img/deleta.jpg" width="12" height="12" /></a>
<? } ?>
</ul>
<? } ?>
</ul>
</div><!-- box_cadastro -->
</body>
</html>
<? if($_GET['excluir'] == 'categoria'){
mysqli_query($conexao_bd, "DELETE FROM menu_principal WHERE id = '".$_GET['id']."'");
echo "<script language='javascript'>window.location='?';</script>";
}?>
<? if($_GET['excluir'] == 'subcategoria'){
mysqli_query($conexao_bd, "DELETE FROM sub_categoria WHERE id = '".$_GET['id']."'");
echo "<script language='javascript'>window.location='?';</script>";
}?>