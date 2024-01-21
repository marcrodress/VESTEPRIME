<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/cadastrar_produto.css" rel="stylesheet" type="text/css" />
<!-- TinyMCE -->
<script type="text/javascript" src="tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		mode : "textareas",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme : "simple"
		
	});
</script>
<!-- /TinyMCE -->
</head>

<body>
<? require "topo.php";  require "scripts/verificador_caixa.php"; ?>

<div id="box_cadastro">
<h1><strong>CADASTRAR PRODUTO</strong></h1>
<hr />
    <? if($_GET['p'] == ''){ ?>
    <div id="code_produto">
    <? if(isset($_POST['verifica'])){
		
	 $code_produto = $_POST['code_produto'];
	 $categoria = 0;
	 
	 if($code_produto == ''){
	 	echo "<script language='javascript'>window.alert('Informe o código do produto!');</script>";
	 }else{
	 	$sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM produtos WHERE code = '$code_produto'");
		if(mysqli_num_rows($sql_verifica) == ''){
	 		echo "<script language='javascript'>window.alert('Produto ainda não cadastro, informe os detalhes de forma organizada!');window.location='?p=categoria&code_produto=$code_produto';</script>";						
		}else{
			 $sql_categoria = mysqli_query($conexao_bd, "SELECT * FROM relacao_produto_categoria WHERE produto = '$code_produto'");
		  		while($res_produtos = mysqli_fetch_array($sql_categoria)){
				  $categoria = $res_produtos['code_categoria'];
				}			 
			 
	 		echo "<script language='javascript'>window.alert('Produto já cadastrado!');window.location='?p=categoria&categoria=$categoria&code_produto=$code_produto';</script>";						
		  }
	 }
	}?>
    <form name="" method="post" action="" enctype="multipart/form-data">
    <strong style="font:18px Arial, Helvetica, sans-serif; color:#FF0;">Informe o código do produto</strong><br />
    <input style="font:15px Arial, Helvetica, sans-serif; margin:10px; text-align:center; width:200px; padding:10px; height:20px; border:1px solid #FFF; border-radius:10px;" type="text" name="code_produto" autofocus />
    <input  style="font:15px Arial, Helvetica, sans-serif; margin:0; width:80px; padding:10px; height:40px; border:1px solid #FFF; border-radius:10px;" type="submit" name="verifica" value="Avançar" />
    </form>
    </div><!-- code_produto -->
    <? } // codigo do produto ?>
    
    
    
    
    <? if($_GET['p'] == 'categoria'){ ?>
  <div id="informar_categorias">
  <? if(isset($_POST['verifica'])){
  
  	$categoria = $_POST['categoria'];
	$code_produto = $_GET['code_produto'];
	echo "<script language='javascript'>window.location='?p=sub_categoria&categoria=$categoria&code_produto=$code_produto';</script>";						
  
  
  }?>
    <form name="" method="post" action="" enctype="multipart/form-data">
     <strong style="font:15px Arial, Helvetica, sans-serif; color:#FF0;"><strong>SELECIONE A CATEGÓRIA DO PRODUTO</strong><br /></strong>
    <hr />
     <select style="font:15px Arial, Helvetica, sans-serif; width:300px; height:40px; padding:10px; border:1px solid #CCC; border-radius:10px;" name="categoria" size="1">
       <option value=""></option>
       <?
	   $sql_menu = mysqli_query($conexao_bd, "SELECT * FROM menu_principal");
		while($res_menu = mysqli_fetch_array($sql_menu)){	   
	   ?>
       <option value="<? echo $res_menu['code_categoria']; ?>"><? echo $res_menu['nome_categoria']; ?></option>
       <? } ?>
     </select>
    <input  style="font:15px Arial, Helvetica, sans-serif; margin:0; width:80px; padding:10px; height:41px; border:1px solid #FFF; border-radius:10px;" type="submit" name="verifica" value="Avançar" />
    </form>
    </div><!-- informar_categorias -->
	<? } ?>    
    
    
    <? if($_GET['p'] == 'sub_categoria'){ ?>
  	<div id="informar_sub_categorias">
    <? if(isset($_POST['verifica'])){
     
	 $subcategoria = $_POST['subcategoria'];
	 $categoria = $_GET['categoria'];
	 $code_produto = $_GET['code_produto'];
	 
	 $sql_sub_categoria = mysqli_query($conexao_bd, "SELECT * FROM relacao_produto_categoria WHERE code_categoria = '$categoria' AND produto = '$code_produto' AND code_sub_categoria = '$subcategoria'");
	if(mysqli_num_rows($sql_sub_categoria) == ''){
		mysqli_query($conexao_bd, "INSERT INTO relacao_produto_categoria (produto, code_categoria, code_sub_categoria) VALUES ('$code_produto', '$categoria', '$subcategoria')");
		echo "<script language='javascript'>window.location='';</script>";
	}else{
		echo "<script language='javascript'>window.alert('Sub-categória já foi adicionada!');</script>";
	 }
	}?>
    <form name="" method="post" action="" enctype="multipart/form-data">
     <strong style="font:15px Arial, Helvetica, sans-serif; color:#FF0;"><strong>SELECIONE AS SUB-CATEGÓRIAS DO PRODUTO</strong><br /></strong>
    <hr />
     <select style="font:15px Arial, Helvetica, sans-serif; width:300px; height:40px; padding:10px; border:1px solid #CCC; border-radius:10px;" name="subcategoria" size="1">
       <?
	   $sql_menu = mysqli_query($conexao_bd, "SELECT * FROM sub_categoria WHERE code_categoria = '".$_GET['categoria']."'");
		while($res_menu = mysqli_fetch_array($sql_menu)){	   
	   ?>
       <option value="<? echo $res_menu['code_subcategoria']; ?>"><? echo $res_menu['nome_categoria']; ?></option>
       <? } ?>
     </select>
    <input  style="font:15px Arial, Helvetica, sans-serif; margin:0; width:80px; padding:10px; height:41px; border:1px solid #FFF; border-radius:10px;" type="submit" name="verifica" value="Incluir" />
    </form>
    <hr />
    
    
    <?
    
	$sql_sub = mysqli_query($conexao_bd, "SELECT * FROM relacao_produto_categoria WHERE code_categoria = '".$_GET['categoria']."' AND produto = '".$_GET['code_produto']."'");
	
	?>
    <table width="500" border="0" style="font:12px Arial, Helvetica, sans-serif; border:1px solid #CCC; border-radius:10px; margin:0 0 0 50px; padding:10px;">
      <tr>
        <td width="408" bgcolor="#0066CC"><strong><em>SUB-CATEGÓRIAS</em></strong></td>
        <td width="76" bgcolor="#0066CC"></td>
      </tr>
      <? while($res_produto = mysqli_fetch_array($sql_sub)){ $i++; ?>
	  <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
        <td><? 
		
	   $sql_menu = mysqli_query($conexao_bd, "SELECT * FROM sub_categoria WHERE code_subcategoria = '".$res_produto['code_sub_categoria']."'");
		while($res_menu = mysqli_fetch_array($sql_menu)){
			 echo $res_menu['nome_categoria'];
		}
		
		?></td>
        <td><a href="?p=sub_categoria&categoria=<? echo $_GET['categoria']; ?>&code_produto=<? echo $_GET['code_produto']; ?>&pg=excluir&id=<? echo $res_produto['id'];?>"><img src="img/deleta.jpg" /></a></td>
      </tr>
      <? } ?>
      <tr>
       <td colspan="2"><hr /><br />
       <a style="font:12px Arial, Helvetica, sans-serif; background:#CCC; color:#666; padding:10px; border:1px solid #FF0; text-decoration:none;" href="?p=cadastrar_produto&categoria=<? echo $_GET['categoria']; ?>&code_produto=<? echo $_GET['code_produto']; ?>">Avançar</a></td>
      </tr>
    </table>
    
    </div><!-- informar_sub_categorias -->
	<? } ?>    
	
     <? if($_GET['p'] == 'cadastrar_produto'){
     
	 $categoria = $_GET['categoria'];
	 $code_produto = $_GET['code_produto'];
	 
	 $verifica_sql = mysqli_query($conexao_bd, "SELECT * FROM produtos WHERE code = '$code_produto'");
	 if(mysqli_num_rows($verifica_sql) == ''){
	 mysqli_query($conexao_bd, "INSERT INTO produtos (tipo, subTipo, status, code, titulo, titulo_resumido, valor_venda, valor_compra, estoque, foto, foto2, foto3, foto4, foto5, descricao, link_fornecedor, alerta_estoque, produto_agregado, comissao, quant_vendida, perdas, codeProdutoPassivo, marcaProdutoPassivo, modeloProdutoPassivo) VALUES ('', '', '', '$code_produto', '', '', '', '', '0', '', '', '', '', '', '', '', '', '', '', '0', '0', '', '', '')");
	 }
	 
	echo "<script language='javascript'>window.location='?p=informacoes_produto&code_produto=$code_produto';</script>";						
	 
	 
	 } ?>





    <? if($_GET['p'] == 'informacoes_produto'){ ?>
  	<div id="detalhes_do_produto">
    <? if(isset($_POST['button'])){
		
	 $titulo = $_POST['titulo'];
	 $titulo_resumido = $_POST['titulo_resumido'];
	 $estoque = $_POST['estoque'];
	 $valor_venda = $_POST['valor_venda'];
	 $valor_compra = $_POST['valor_compra'];
	 $foto1 = $_POST['foto1'];
	 $foto2 = $_POST['foto2'];
	 $foto3 = $_POST['foto3'];
	 $foto4 = $_POST['foto4'];
	 $foto5 = $_POST['foto5'];
	 
	 $comissao = $_POST['comissao'];
	 $alerta_estoque = $_POST['alerta_estoque'];
	 $fornecedor = $_POST['fornecedor'];
	 $descricao = base64_encode($_POST['descricao']);

	 $tipo = $_POST['tipo'];
	 $subTipo = $_POST['subtipo'];
	 
	 mysqli_query($conexao_bd, "UPDATE produtos SET tipo = '$tipo', subTipo = '$subTipo', titulo = '$titulo', titulo_resumido = '$titulo_resumido', valor_venda = '$valor_venda', valor_compra = '$valor_compra', estoque = '$estoque', descricao = '$descricao', link_fornecedor = '$fornecedor', foto = '$foto1', foto2 = '$foto2', foto3 = '$foto3', foto4 = '$foto4', foto5 = '$foto5', alerta_estoque = '$alerta_estoque', comissao = '$comissao' WHERE code = '".$_GET['code_produto']."'");
	 
	echo "<script language='javascript'>window.location='?p=';</script>";						
	 
	}?>
    
    
    <?
	$sql_produto = mysqli_query($conexao_bd, "SELECT * FROM produtos WHERE code = '".$_GET['code_produto']."'");
	 while($res_produto = mysqli_fetch_array($sql_produto)){
	?>
    <form name="" method="post" enctype="multipart/form-data">
    <table width="788" border="0" style="margin:0 0 0 -10px;">
      <tr>
        <td width="151" bgcolor="#333333"><strong>TITULO</strong></td>
        <td width="119" bgcolor="#333333"><strong>TITULO RESUMIDO</strong></td>
        <td width="75" bgcolor="#333333"><strong>ESTOQUE</strong></td>
        <td width="119" bgcolor="#333333"><strong>VENDA</strong></td>
        <td width="94" bgcolor="#333333"><strong>COMPRA</strong></td>
        <td width="92" bgcolor="#333333"><strong>ALERTA</strong></td>
        <td width="111" bgcolor="#333333"><strong>TIPO</strong></td>
        </tr>
      <tr>
        <td><input name="titulo" type="text" id="titulo" value="<? echo $res_produto['titulo']; ?>" size="19"></td>
        <td><input name="titulo_resumido" type="text"value="<? echo $res_produto['titulo_resumido']; ?>" size="15"></td>
        <td><input name="estoque" type="text" id="estoque" size="8" value="<? echo $res_produto['estoque']; ?>"></td>
        <td><input id="valor_venda" name="valor_venda" type="text" value="<? echo $res_produto['valor_venda']; ?>" size="10" /></td>
        <td><input id="valor_compra" name="valor_compra" type="text" value="<? echo $res_produto['valor_compra']; ?>" size="10" /></td>
        <td><input name="alerta_estoque" type="text" id="textfield3" size="6"  value="<? echo $res_produto['alerta_estoque']; ?>" /></td>
        <td>
          <select style="font:15px; padding:10px;" name="tipo" size="1" id="tipo">
            <option value="<? echo $res_produto['tipo']; ?>"><? echo $res_produto['tipo']; ?></option>
            <option value="PRODUTO">PRODUTO</option>
            <option value="SERVICO">SERVICO</option>
            </select>
        </td>
      </tr>
      <tr>
        <td bgcolor="#333333"><strong>FOTO 1</strong></td>
        <td bgcolor="#333333"><strong>FOTO 2</strong></td>
        <td bgcolor="#333333"><strong>FOTO 3</strong></td>
        <td bgcolor="#333333"><strong>FOTO 4</strong></td>
        <td bgcolor="#333333"><strong>FOTO 5</strong></td>
        <td bgcolor="#333333"><strong>FORNECEDOR</strong></td>
        <td bgcolor="#333333"><strong>SUBTIPO</strong></td>
        </tr>
      <tr>
        <td><label for="foto1"></label>
        <input name="foto1" type="text" value="<? echo $res_produto['foto']; ?>" size="19"></td>
        <td><label for="foto2"></label>
        <input name="foto2" type="text" value="<? echo $res_produto['foto2']; ?>" size="15"></td>
        <td><label for="foto3"></label>
        <input name="foto3" type="text" value="<? echo $res_produto['foto3']; ?>" size="8"></td>
        <td><input name="foto4" type="text" value="<? echo $res_produto['foto4']; ?>" size="15" /></td>
        <td><label for="foto4">
          <input name="foto5" type="text" value="<? echo $res_produto['foto5']; ?>" size="10" />
        </label></td>
        <td><input name="fornecedor" type="text"  value="<? echo $res_produto['link_fornecedor']; ?>" size="10" /></td>
        <td><select style="font:15px; padding:10px;" name="subtipo" size="1" id="subtipo">
          <option value="<? echo $res_produto['subTipo']; ?>"><? echo $res_produto['subTipo']; ?></option>
          <option value="ATIVO">ATIVO</option>
          <option value="PASSIVO">PASSIVO</option>
        </select></td>
        </tr>
      <tr>
        <td bgcolor="#333333"><strong>COMISSÃO</strong></td>
        <td colspan="6" bgcolor="#333333"><strong>TIPO</strong></td>
        </tr>
      <tr>
        <td><label for="textfield2"></label>
          <input name="comissao" type="text" value="<? echo $res_produto['comissao']; ?>" size="20"></td>
        <td colspan="6" bgcolor="#FFFFFF"><label for="textfield3"></label>
          <label for="tipo"></label>
          <label for="subtipo"></label>
          <a 
        rel="superbox[iframe][400x95]" href="scripts/produto_associado.php?produto=<? echo @$_GET['code_produto']; ?>">Associar produto</a>
          <label for="textfield4"></label>          <label for="tipo"></label>          <label for="subtipo"></label></td>
        </tr>
      <tr>
        <td colspan="7" bgcolor="#003333"><strong>DESCRIÇÃO COMPLETA</strong></td>
        </tr>
      <tr>
        <td align="center" colspan="7"><label for="textarea"></label>
          <textarea name="descricao" id="textarea" cols="128" rows="20"><? echo base64_decode($res_produto['descricao']); ?></textarea></td>
        </tr>
      <tr>
        <td colspan="7"><input type="submit" name="button" id="button" value="CADASTRAR"></td>
        </tr>
    </table>
    </form>
    <? } // while do produto ?>
    
        <script>
        function handleKeyPress(event) {
            // Verifica se a tecla pressionada é "D" e se o valor_venda está vazio
            if (event.key === 'D' && document.getElementById('valor_venda').value.trim() === '') {
                // Obtém o valor do input valor_compra
                var valorCompra = document.getElementById('valor_compra').value;

                // Verifica se o valor_compra é um número
                if (!isNaN(valorCompra)) {
                    // Calcula o dobro e arredonda para dois decimais
                    var valorVenda = (parseFloat(valorCompra) * 2).toFixed(2);

                    // Insere o valor calculado no input valor_venda
                    document.getElementById('valor_venda').value = valorVenda;
                }
            }
        }
    </script>
    </div><!-- detalhes_do_produto -->
    <? } ?>








</div><!-- box_cadastro -->
</body>
</html>
<? if($_GET['pg'] == 'excluir'){
	
$categoria = $_GET['categoria'];
$code_produto = $_GET['code_produto'];

mysqli_query($conexao_bd, "DELETE FROM relacao_produto_categoria WHERE id = '".$_GET['id']."'");
echo "<script language='javascript'>window.location='?p=sub_categoria&categoria=$categoria&code_produto=$code_produto';</script>";


}?>