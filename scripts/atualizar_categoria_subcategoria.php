<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<? require "../conexao.php"; ?>
</head>

<body>
<? if($_GET['pg'] == 'categoria'){ ?>
<? if(isset($_POST['cate'])){

$ordem = $_POST['ordem'];
$nome_categoria = $_POST['nome_categoria'];

mysqli_query($conexao_bd, "UPDATE menu_principal SET ordem = '$ordem', nome_categoria = '$nome_categoria' WHERE id = '".$_GET['id']."'");
echo "Atualizado com sucesso!";
die;

}?>


<?
$sql_menu = mysqli_query($conexao_bd, "SELECT * FROM menu_principal WHERE id = '".$_GET['id']."'");
	while($res_menu = mysqli_fetch_array($sql_menu)){
?>
<form name="" method="post" action="" enctype="multipart/form-data">
<input type="text" name="ordem" value="<? echo $res_menu['ordem']; ?>" size="1" /> - <input type="text" name="nome_categoria" value="<? echo $res_menu['nome_categoria']; ?>" /><input type="submit" name="cate" value="Atualizar" />
</form>
<? } ?>

<? } ?>











<? if($_GET['pg'] == 'subcategoria'){ ?>
<? if(isset($_POST['cate'])){

$ordem = $_POST['ordem'];
$nome_categoria = $_POST['nome_categoria'];

mysqli_query($conexao_bd, "UPDATE sub_categoria SET ordem = '$ordem', nome_categoria = '$nome_categoria' WHERE id = '".$_GET['id']."'");
echo "Atualizado com sucesso!";
die;

}?>


<?
$sql_menu = mysqli_query($conexao_bd, "SELECT * FROM sub_categoria WHERE id = '".$_GET['id']."'");
	while($res_menu = mysqli_fetch_array($sql_menu)){
?>
<form name="" method="post" action="" enctype="multipart/form-data">
<input type="number" name="ordem" value="<? echo $res_menu['ordem']; ?>" size="1" /> - <input type="text" name="nome_categoria" value="<? echo $res_menu['nome_categoria']; ?>" /><input type="submit" name="cate" value="Atualizar" />
</form>
<? } ?>

<? } ?>
</body>
</html>