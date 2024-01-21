<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/cadastrar_produto.css" rel="stylesheet" type="text/css" />
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="box_cad_produto">
<? if($_GET['p'] == ''){ ?>
<br /><br />
<h1><strong>Insira o código de barras</strong></h1>
<form name="" method="post" action="" enctype="multipart/form-data">
<input class="input" type="text" name="code_produto" /><input class="input1" type="submit" name="enviar" value="Buscar" />
</form>

<? if(isset($_POST['enviar'])){
	

 $code_produto = $_POST['code_produto'];
 
 $sql_1 = mysqli_query($conexao_db, "SELECT * FROM codigos_associados WHERE codigo_barras = '$code_produto'");
 $sql_2 = mysqli_query($conexao_db, "SELECT * FROM produtos WHERE code = '$code_produto'");

 if(mysqli_num_rows($sql_2) == ''){
	 
	if(mysqli_num_rows($sql_1) == ''){
	 echo "<script language='javascript'>window.location='?pack=cadastrar_produto&p=2&produto=$code_produto';</script>";
	}else{
	 echo "<script language='javascript'>window.alert('Produto já está cadastrado no sistema!');window.location='?pack=cadastrar_produto&p=3&produto=$code_produto';</script>";
	}
	 
 }elseif(mysqli_num_rows($sql_2) == ''){
	 echo "<script language='javascript'>window.location='?pack=cadastrar_produto&p=2&produto=$code_produto';</script>";
 }else{
	 echo "<script language='javascript'>window.alert('Produto já está cadastrado no sistema!');window.location='?pack=cadastrar_produto&p=3&produto=$code_produto';</script>";
 }
}?>

<? } // verifica código de barras ?>



<? if($_GET['p'] == '2'){ ?>


<form name="" method="post" action="" enctype="multipart/form-data">
<table width="1190" border="0">
  <tr>
    <td colspan="3"><strong>CÓDIGO DE BARRAS</strong></td>
    <td width="511"><strong>CATEGÓRIA</strong></td>
    <td align="center" width="243"><strong>ALERTA DE ESTOQUE</strong></td>
  </tr>
  <tr>
    <td colspan="3"><strong>
    <input name="textfield" type="text" disabled id="textfield" size="60" value="<? echo @$_GET['produto']; ?>">
    </strong></td>
    <td><strong>
      <select name="categoria" size="1" class="select" id="categoria">
        <option value="CELULARES">CELULARES</option>
        <option value="COMPUTADOR">COMPUTADOR</option>
        <option value="VESTUARIO">VESTUARIO</option>
        <option value="SERVI&Ccedil;O">SERVI&Ccedil;O</option>
        <option value="BELEZA">BELEZA</option>        
        <option value="ACESSÓRIOS">ACESSÓRIOS</option>        
        </select>
    </strong></td>
    <td align="center"><span id="sprytextfield1">
      <input name="alerta_estoque" type="text" id="alerta_estoque" size="10" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
  </tr>
  <tr>
    <td colspan="3"><strong>TITULO</strong></td>
    <td><strong>TITULO RESUMIDO</strong></td>
    <td align="center"><strong>VALOR VENDA</strong></td>
  </tr>
  <tr>
    <td colspan="3"><span id="sprytextfield2">
      <input name="titulo" type="text" id="titulo" size="60" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    <td><span id="sprytextfield3">
      <input name="titulo_resumido" type="text" id="titulo_resumido" size="60" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    <td align="center"><span id="sprytextfield4">
      <input name="valor_venda" type="text" id="valor_venda" size="10" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
  </tr>
  <tr>
    <td width="113"><strong>VALOR COMPRA</strong></td>
    <td width="151"><strong>comiss&atilde;o</strong></td>
    <td width="152">&nbsp;</td>
    <td><strong>FOTO - <a rel="superbox[iframe][400x95]" href="scripts/produto_associado.php?produto=<? echo @$_GET['produto']; ?>">Associar produto</a></strong></td>
    <td align="center"><strong>ESTOQUE</strong></td>
  </tr>
  <tr>
    <td><span id="sprytextfield5">
      <input name="valor_compra" type="text" id="valor_compra" size="10" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    <td><span id="sprytextfield9">
      <input name="comissao" type="text" id="comissao" size="10" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    <td>&nbsp;</td>
    <td><span id="sprytextfield6">
      <input name="foto" type="text" id="foto" size="60" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    <td align="center"><span id="sprytextfield7">
      <input name="estoque" type="text" id="estoque" size="10" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
  </tr>
  <tr>
    <td colspan="3"><strong>LINK FORNECEDOR</strong></td>
    <td><strong>PRODUTOS AGREGADO</strong></td>
    <td align="center"><strong>VALOR AGREGADO</strong></td>
  </tr>
  <tr>
    <td colspan="3"><span id="sprytextfield8">
      <input name="link_fornecedor" type="text" id="link_fornecedor" size="60" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    <td><strong>
      <input name="produto_agregado" type="text" id="produto_agregado" size="60">
    </strong></td>
    <td align="center"><strong>
    <input name="valor_agregado" type="text" id="valor_agregado" size="10">
    </strong></td>
  </tr>
  <tr>
    <td colspan="5"><hr />      
      <strong>DESCRIÇÃO DO PRODUTO</strong></td>
  </tr>
  <tr>
    <td colspan="5"><span id="sprytextarea1">
      <textarea name="descricao" id="descricao" cols="150" rows="15"></textarea>
      <span class="textareaRequiredMsg">A value is required.</span></span></td>
  </tr>
  <tr>
    <td colspan="5"><input class="input1" type="submit" name="button" id="button" value="Enviar"></td>
  </tr>
</table>
</form>

<? if(isset($_POST['button'])){
	
$categoria = $_POST['categoria'];
$code_produto = $_GET['produto'];
$alerta_estoque = $_POST['alerta_estoque'];
$titulo = $_POST['titulo'];
$titulo_resumido = $_POST['titulo_resumido'];
$valor_venda = $_POST['valor_venda'];
$valor_compra = $_POST['valor_compra'];
$foto = $_POST['foto'];
$estoque = $_POST['estoque'];
$comissao = $_POST['comissao'];
$link_fornecedor = $_POST['link_fornecedor'];
$produto_agregado = $_POST['produto_agregado'];
$valor_agregado = $_POST['valor_agregado'];
$descricao = $_POST['descricao'];


mysqli_query($conexao_db, "INSERT INTO inserir_estoque (data, codigo_barras, estoque) VALUES ('$data', '$code_produto', '$estoque')");
mysqli_query($conexao_db, "INSERT INTO codigos_associados (produto_original, codigo_barras) VALUES ('$code_produto', '$code_produto')");

$sql_1 = mysqli_query($conexao_db, "INSERT INTO produtos (tipo, status, code, categoria, titulo, titulo_resumido, valor_venda, valor_compra, estoque, foto, descricao, link_fornecedor, alerta_estoque, produto_agregado, valor_agregado, comissao) VALUES ('PRODUTO', 'Ativo', '$code_produto', '$categoria', '$titulo', '$titulo_resumido', '$valor_venda', '$valor_compra', '$estoque', '$foto', '$descricao', '$link_fornecedor', '$alerta_estoque', '$produto_agregado', '$valor_agregado', '$comissao')");

if($sql_1 == ''){
	 echo "<script language='javascript'>window.alert('Erro ao cadastrar produto!');</script>";
}else{
	 echo "<script language='javascript'>window.alert('Produto cadastrado com sucesso!');window.location='?pack=cadastrar_produto&p=';</script>";
}

}?>



<? } // verifica código de barras ?>










<? if($_GET['p'] == '3'){ ?>

<?
 $code_produto = $_GET['produto'];
 $sql_1 = mysqli_query($conexao_db, "SELECT * FROM produtos WHERE code = '$code_produto'");
 	while($res_1 = mysqli_fetch_array($sql_1)){
?>

<form name="" method="post" action="" enctype="multipart/form-data">
<table width="1190" border="0">
  <tr>
    <td colspan="3"><strong>CÓDIGO DE BARRAS</strong></td>
    <td width="519"><strong>CATEGÓRIA</strong></td>
    <td align="center" width="308"><strong>ALERTA DE ESTOQUE</strong></td>
  </tr>
  <tr>
    <td colspan="3"><strong>
    <input name="textfield" type="text" disabled id="textfield" size="60" value="<? echo @$_GET['produto']; ?>">
    </strong></td>
    <td><strong>
      <select name="categoria" size="1" class="select" id="categoria">
        <option value="<? echo $res_1['categoria']; ?>"><? echo $res_1['categoria']; ?></option>
        <option value=""></option>
        <option value="CELULARES">CELULARES</option>
        <option value="COMPUTADOR">COMPUTADOR</option>
        <option value="VESTUARIO">VESTUARIO</option>
        <option value="SERVI&Ccedil;O">SERVI&Ccedil;O</option>
        <option value="BELEZA">BELEZA</option>
        <option value="ACESSÓRIOS">ACESSÓRIOS</option>                
        </select>
    </strong></td>
    <td align="center"><span id="sprytextfield1">
      <input name="alerta_estoque" type="text" id="alerta_estoque" size="10" value="<? echo $res_1['alerta_estoque']; ?>" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
  </tr>
  <tr>
    <td colspan="3"><strong>TITULO</strong></td>
    <td><strong>TITULO RESUMIDO</strong></td>
    <td align="center"><strong>VALOR VENDA</strong></td>
  </tr>
  <tr>
    <td colspan="3"><span id="sprytextfield2">
      <input name="titulo" type="text" id="titulo" size="60" value="<? echo $res_1['titulo']; ?>" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    <td><span id="sprytextfield3">
      <input name="titulo_resumido" type="text" id="titulo_resumido" size="60" value="<? echo $res_1['titulo_resumido']; ?>" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    <td align="center"><span id="sprytextfield4">
      <input name="valor_venda" type="text" id="valor_venda" size="10" value="<? echo $res_1['valor_venda']; ?>" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
  </tr>
  <tr>
    <td width="174"><strong>VALOR COMPRA</strong></td>
    <td width="121"><strong>comiss&atilde;o</strong></td>
    <td width="121">&nbsp;</td>
    <td><strong>FOTO - <a rel="superbox[iframe][400x95]" href="scripts/produto_associado.php?produto=<? echo @$_GET['produto']; ?>">Associar produto</a></strong></td>
    <td align="center"><strong>ESTOQUE</strong></td>
  </tr>
  <tr>
    <td><span id="sprytextfield5">
      <input name="valor_compra" type="text" id="valor_compra" size="10" value="<? echo $res_1['valor_compra']; ?>" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    <td><span id="sprytextfield11">
    <input name="comissao" type="text" id="comissao" size="10" value="<? echo $res_1['comissao']; ?>" />
    <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    <td>&nbsp;</td>
    <td><span id="sprytextfield6">
      <input name="foto" type="text" id="foto" size="60" value="<? echo $res_1['foto']; ?>" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    <td align="center"><span id="sprytextfield10">
    <input name="estoque" type="text" id="estoque" size="10" value="<? echo $res_1['estoque']; ?>" />
    <span class="textfieldRequiredMsg">A value is required.</span></span></td>
  </tr>
  <tr>
    <td colspan="3"><strong>LINK FORNECEDOR</strong></td>
    <td><strong>PRODUTOS AGREGADO</strong></td>
    <td align="center"><strong>VALOR AGREGADO</strong></td>
  </tr>
  <tr>
    <td colspan="3"><span id="sprytextfield8">
      <input name="link_fornecedor" type="text" id="link_fornecedor" size="60" value="<? echo $res_1['link_fornecedor']; ?>" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    <td><strong>
      <input name="produto_agregado" type="text" id="produto_agregado" value="<? echo $res_1['produto_agregado']; ?>" size="60">
    </strong></td>
    <td align="center"><strong>
    <input name="valor_agregado" type="text" id="valor_agregado" value="<? echo $res_1['valor_agregado']; ?>" size="10">
    </strong></td>
  </tr>
  <tr>
    <td colspan="5"><hr />      
      <strong>DESCRIÇÃO DO PRODUTO</strong></td>
  </tr>
  <tr>
    <td colspan="5"><span id="sprytextarea1">
      <textarea name="descricao" id="descricao" cols="150" rows="15"><? echo $res_1['descricao']; ?></textarea>
      <span class="textareaRequiredMsg">A value is required.</span></span></td>
  </tr>
  <tr>
    <td colspan="5"><input class="input1" type="submit" name="button" id="button" value="Enviar"></td>
  </tr>
</table>
</form>
<? } ?>





<? if(isset($_POST['button'])){
	
$categoria = $_POST['categoria'];
$code_produto = $_GET['produto'];
$alerta_estoque = $_POST['alerta_estoque'];
$titulo = $_POST['titulo'];
$titulo_resumido = $_POST['titulo_resumido'];
$valor_venda = $_POST['valor_venda'];
$valor_compra = $_POST['valor_compra'];
$foto = $_POST['foto'];
$estoque = $_POST['estoque'];
$link_fornecedor = $_POST['link_fornecedor'];
$produto_agregado = $_POST['produto_agregado'];
$valor_agregado = $_POST['valor_agregado'];
$descricao = $_POST['descricao'];

$estoque = $_POST['estoque'];
$comissao = $_POST['comissao'];

$produto = $_GET['produto'];


$sql_1 = mysqli_query($conexao_db, "UPDATE produtos SET estoque = '$estoque', comissao = '$comissao', categoria = '$categoria', titulo = '$titulo', titulo_resumido = '$titulo_resumido', valor_venda = '$valor_venda', valor_compra = '$valor_compra', foto = '$foto', descricao = '$descricao', link_fornecedor = '$link_fornecedor', alerta_estoque = '$alerta_estoque', produto_agregado = '$produto_agregado', valor_agregado = '$valor_agregado' WHERE code = '$produto'");

if($sql_1 == ''){
	 echo "<script language='javascript'>window.alert('Erro ao atualizar produto!');</script>";
}else{
	 echo "<script language='javascript'>window.alert('Produto atualizado com sucesso!');window.location='?pack=cadastrar_produto&p=';</script>";
}

}?>



<? } // Atualiza produto ?>







</div><!-- box_cad_produto -->
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5");
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6");
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7");
var sprytextfield8 = new Spry.Widget.ValidationTextField("sprytextfield8");
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1");
var sprytextfield9 = new Spry.Widget.ValidationTextField("sprytextfield9");
var sprytextfield10 = new Spry.Widget.ValidationTextField("sprytextfield10");
var sprytextfield11 = new Spry.Widget.ValidationTextField("sprytextfield11");
</script>
</body>
</html>