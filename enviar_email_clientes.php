,,<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/enviar_email_clientes.css" rel="stylesheet" type="text/css" />
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
<? require "topo.php";  require "scripts/verificador_caixa.php"; 

$autorizacao = mysqli_query($conexao_bd, "SELECT * FROM adm WHERE cpf = '$operador' AND senha_autorizacao = ''");
if(mysqli_num_rows($autorizacao) != ''){
	echo "<script language='javascript'>window.location='carrinho.php';</script>";
}

?>
<div id="box_cliente">
<h1><strong>ENVIAR E-MAIL PARA TODOS OS CLIENTES</strong><hr /></h1>
<hr>
<? if(isset($_POST['button'])){
	
$titulo = $_POST['titulo'];
$mensagem = base64_encode($_POST['mensagem']);

$nome = 0;
$email = 0;

if($titulo == ''){
	echo "<script language='javascript'>window.alert('POR FAVOR, DIGITE O TÍTULO!');</script>";
}elseif($mensagem == ''){
	echo "<script language='javascript'>window.alert('POR FAVOR, DIGITE A MENSAGEM!');</script>";
}else{
	$sql_usuarios = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE email != ''");
		while($res_usuarios = mysqli_fetch_array($sql_usuarios)){
			$nome = $res_usuarios['nome'];
			$email = strtolower($res_usuarios['email']);
			
			mysqli_query($conexao_bd, "INSERT INTO email_enviar (data, status, data_envio, nome, email, titulo, mensagem, numero) VALUES ('$data', 'Aguarda', '', '$nome', '$email', '$titulo', '$mensagem', '0')");
		}
		
		echo "<script language='javascript'>window.alert('MENSAGEM ENVIADA COM SUCESSO!');window.location='';</script>";
	
 }
}?>
<form name="" method="post" action="" enctype="multipart/form-data">
<table width="995" border="0">
  <tr>
    <td><strong>TITULO DO E-MAIL</strong></td>
  </tr>
  <tr>
    <td><label for="titulo"></label>
    <input style="font:20px Arial, Helvetica, sans-serif; color:#FC0; padding:10px; border:2px solid #00F; border-radius:5px;" name="titulo" type="text" id="titulo" value="<? echo $titulo; ?>" size="92"></td>
  </tr>
  <tr>
    <td><strong>MENSAGEM</strong></td>
  </tr>
  <tr>
    <td><textarea style="font:20px Arial, Helvetica, sans-serif; color:#FC0; padding:10px; border:2px solid #00F; border-radius:5px;" name="mensagem" cols="94" rows="30"><? echo $mensagem; ?></textarea></td>
  </tr>
  <tr>
    <td><input style="font:20px Arial, Helvetica, sans-serif; color:#000; padding:0; border:2px solid #00F; border-radius:0;" type="submit" name="button" id="button" value="Enviar"></td>
  </tr>
</table>
</form>
</div><!-- box_cliente -->
<? require "rodape.php"; ?>
</body>
</html>
