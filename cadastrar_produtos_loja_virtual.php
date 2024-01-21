<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/cadastrar_produtos_loja_virtual.css" rel="stylesheet" type="text/css" />
<!-- TinyMCE -->
<script type="text/javascript" src="tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",

		// Theme options
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>
<!-- /TinyMCE -->
</head>

<body>
<? require "topo.php";  require "scripts/verificador_caixa.php"; ?>

<div id="box_pagamento_1">
<h1><strong>CADASTRAR PRODUTOS NA LOJA VIRTUAL</strong></h1>
<hr />
<? if(isset($_POST['enviar'])){

$titulo = $_POST['titulo'];
$valor_venda = $_POST['valor_venda'];
$valor_compra = $_POST['valor_compra'];
$categoria = $_POST['categoria'];
$fornecedor = $_POST['fornecedor'];
$prazo_entrega = $_POST['prazo_entrega'];
$estoque = $_POST['estoque'];
$img = $_POST['img'];
$img2 = $_POST['img2'];
$img3 = $_POST['img3'];
$img4 = $_POST['img4'];
$img5 = $_POST['img5'];
$descricao = $_POST['descricao'];


$sql_insert = mysqli_query($conexao_bd, "INSERT INTO loja_online_produto (categoria, img, img2, img3, img4, img5, titulo, valor_compra, valor_venda, estoque, entrega, descricao, fornecedor) VALUES ('$categoria', '$img', '$img2', '$img3', '$img4', '$img5', '$titulo', '$valor_compra', '$valor_venda', '$estoque', '$prazo_entrega', '$descricao', '$fornecedor')");

if($sql_insert == ''){
echo "<script language='javascript'>window.alert('Ocorreu um erro, tente novamente');</script>";
}else{
echo "<script language='javascript'>window.alert('PRODUTO CADASTRADO COM SUCESSO!!!');window.location='';</script>";
}
}?>
<form name="" method="post" action="" enctype="multipart/form-data">
<table width="990" border="0">
  <tr>
    <td bgcolor="#CCCCCC"><strong>TITULO DO PRODUTO</strong></td>
    <td bgcolor="#CCCCCC"><strong>VALOR DE VENDA</strong></td>
    <td bgcolor="#CCCCCC"><strong>VALOR DE COMPRA</strong></td>
  </tr>
  <tr>
    <td><label for="titulo"></label>
    <input name="titulo" type="text" id="titulo" size="50" value="<? echo $titulo; ?>"></td>
    <td><label for="textfield2"></label>
    <input name="valor_venda" type="text" id="textfield2" size="10" value="<? echo $valor_venda; ?>"></td>
    <td><label for="textfield3"></label>
    <input name="valor_compra" type="text" id="textfield3" size="10" value="<? echo $valor_compra; ?>"></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC"><strong>CATEGÓRIA</strong></td>
    <td bgcolor="#CCCCCC"><strong>FORNECEDOR</strong></td>
    <td bgcolor="#CCCCCC"><strong>PRAZO DE ENTREGA</strong></td>
  </tr>
  <tr>
    <td><label for="select"></label>
      <select name="categoria" size="1" id="select">
        <? 
		 $sql_conta = mysqli_query($conexao_bd, "SELECT * FROM loja_online_categorias");
		  while($res_conta = mysqli_fetch_array($sql_conta)){
		?>
        <option value="<? echo $res_conta['cod']; ?>"><? echo $res_conta['categoria']; ?></option>
        <? } ?>
      </select></td>
    <td><label for="textfield4"></label>
    <input name="fornecedor" type="text" id="textfield4" value="<? echo $fornecedor; ?>" size="50"></td>
    <td><label for="textfield5"></label>
    <input name="prazo_entrega" type="text" id="textfield5" value="<? echo $prazo_entrega; ?>" size="5"></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC"><strong>ESTOQUE</strong></td>
    <td bgcolor="#CCCCCC"><strong>IMG</strong></td>
    <td bgcolor="#CCCCCC"><strong>IMG2</strong></td>
  </tr>
  <tr>
    <td><label for="textfield6"></label>
    <input name="estoque" type="text" id="textfield6" value="<? echo $estoque; ?>" size="5"></td>
    <td><label for="textfield7"></label>
    <input name="img" type="text" id="textfield7" value="<? echo $img; ?>" size="50"></td>
    <td><label for="textfield8"></label>
    <input name="img2" type="text" id="textfield8" value="<? echo $img2; ?>" size="40"></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC"><strong>IMG3</strong></td>
    <td bgcolor="#CCCCCC"><strong>IMG4</strong></td>
    <td bgcolor="#CCCCCC"><strong>IMG5</strong></td>
  </tr>
  <tr>
    <td><label for="textfield9"></label>
    <input name="img3" type="text" id="textfield9" value="<? echo $img3; ?>" size="50"></td>
    <td><label for="textfield10"></label>
    <input name="img4" type="text" id="textfield10" value="<? echo $img4; ?>" size="50"></td>
    <td><label for="textfield11"></label>
    <input name="img5" type="text" id="textfield11" value="<? echo $img5; ?>" size="40"></td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#CCCCCC"><strong>DESCRIÇÃO</strong></td>
  </tr>
  <tr>
    <td colspan="3"><label for="descricao"></label>
    <textarea name="descricao" id="descricao" cols="117" rows="50"><? echo $descricao; ?></textarea></td>
  </tr>
  <tr>
    <td colspan="3"><input type="submit" name="enviar" id="enviar" value="Enviar"></td>
  </tr>
</table>
</form>


</div><!-- box_pagamento_1 -->
</body>
</html>