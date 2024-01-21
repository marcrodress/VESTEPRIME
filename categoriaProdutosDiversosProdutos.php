<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/produtos_celulares.css" rel="stylesheet" type="text/css" />
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
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>

<body>
<? require "topo.php";  require "scripts/verificador_caixa.php"; ?>

<div id="box_pagamento_1">
<? if($_GET['acao'] == 'criar'){
  
  $codeProduto = $_GET['codeProduto'];
  
  mysqli_query($conexao_bd, "INSERT INTO categoriaProdutosDiversosProdutos 
  							(code, nomeProduto, imagem, valorCompra, valorVenda, estoque, comissao, codigoBarras, tipo, subtipo, descricao, quantidaVendida, perdas) VALUES 
							('$codeProduto', '', '', '', '', '', '', '', '', '', '', '0', '0')");
  
  echo "<script>window.location='?codeProduto=$codeProduto&acao=editar';</script>";
 
}?>

 <a style="float:left; margin:10px;" href="?codeProduto=<? echo rand(); ?>&acao=criar"><img src="https://cdn-icons-png.flaticon.com/512/7032/7032300.png" width="30" title="Cadastrar novo produto" height="30" /></a>

<h1 style="float:left; margin:15px 0 0 -2px;"><strong>CADASTRO DE PRODUTOS DE PRODUTOS/SERVI&Ccedil;OS PASSIVOS</strong></h1>
<hr />

<? if($_GET['acao'] == 'editar' && $codeProduto = $_GET['codeProduto']){ ?>
<form id="form1" name="form1" method="post" action="">
<?

$sqlProdutos = mysqli_query($conexao_bd, "SELECT * FROM categoriaProdutosDiversosProdutos WHERE code = '$codeProduto'");
while($resProdutos = mysqli_fetch_array($sqlProdutos)){

?>
  <table width="1000" border="0">
    <tr>
      <td colspan="3" bgcolor="#0099CC"><strong>NOME DO PRODUTO</strong></td>
      <td colspan="4" bgcolor="#0099CC"><strong>IMAGEM</strong></td>
    </tr>
    <tr>
      <td colspan="3"><input name="nomeProduto" type="text" value="<? echo $resProdutos['nomeProduto']; ?>" id="nomeProduto" size="60" /></td>
      <td colspan="4"><input name="imagem" type="text" value="<? echo $resProdutos['imagem']; ?>" size="90" /></td>
    </tr>
    <tr>
      <td width="163" bgcolor="#FFFF33"><strong>VALOR DE COMPRA</strong></td>
      <td width="136" bgcolor="#FFFF33"><strong>VALOR DE VENDA</strong></td>
      <td width="136" bgcolor="#FFFF33"><strong>ESTOQUE</strong></td>
      <td width="62" bgcolor="#FFFF33"><strong>COMISS&Atilde;O</strong></td>
      <td width="156" bgcolor="#FFFF33"><strong>C&Oacute;DIGO DE BARRAS </strong></td>
      <td width="150" bgcolor="#FFFF33"><strong>TIPO</strong></td>
      <td width="153" bgcolor="#FFFF33"><strong>SUB TIPO</strong></td>
    </tr>
    <tr>
      <td><input name="valorCompra" type="text" value="<? echo $resProdutos['valorCompra']; ?>" size="10" /></td>
      <td><input name="valorVenda" type="text" value="<? echo $resProdutos['valorVenda']; ?>" size="10" /></td>
      <td><input name="estoque" type="text" value="<? echo $resProdutos['estoque']; ?>" size="10" /></td>
      <td><input name="comissao" type="text" value="<? echo $resProdutos['comissao']; ?>" size="10" /></td>
      <td><input name="codigoBarras" type="text" value="<? echo $resProdutos['codigoBarras']; ?>" size="20" /></td>
      <td>
        <select name="tipo" size="1" id="tipo">
          <option value="<? echo $resProdutos['tipo']; ?>"><? echo $resProdutos['tipo']; ?></option>
          <option value="PRODUTO">PRODUTO</option>
          <option value="SERVICO">SERVICO</option>
        </select></td>
      <td>
        <select name="subTipo" size="1" id="subTipo">
          <option value="<? echo $resProdutos['subTipo']; ?>"><? echo $resProdutos['subtipo']; ?></option>
          <option value="ATIVO">ATIVO</option>
          <option value="PASSIVO">PASSIVO</option>
        </select></td>
    </tr>
    <tr>
      <td colspan="7" align="center" bgcolor="#66CC00"><strong>DESCRI&Ccedil;&Atilde;O DO PRODUTO</strong></td>
    </tr>
    <tr>
      <td colspan="7" align="center"><textarea style="width:990px; height:400px;" name="descricao" cols="90" rows="10"><? echo $resProdutos['descricao']; ?></textarea></td>
    </tr>
    <tr>
      <td colspan="7"><input style="font:15px Arial, Helvetica, sans-serif; width:150px; padding:10px; height:50px;" type="submit" name="enviar" id="enviar" value="ENVIAR" /></td>
    </tr>
  </table>
  <? } ?>
</form>




<? if(isset($_POST['enviar'])){

	$nomeProduto = $_POST['nomeProduto'];
	$imagem = $_POST['imagem'];
	$valorCompra = $_POST['valorCompra'];
	$valorVenda = $_POST['valorVenda'];
	$estoque = $_POST['estoque'];
	$comissao = $_POST['comissao'];
	$codigoBarras = $_POST['codigoBarras'];
	$tipo = $_POST['tipo'];
	$subTipo = $_POST['subTipo'];
	$descricao = $_POST['descricao'];
	
	$codeProduto = $_GET['codeProduto'];
	
	
	mysqli_query($conexao_bd, "UPDATE categoriaProdutosDiversosProdutos SET nomeProduto = '$nomeProduto', imagem = '$imagem', valorCompra = '$valorCompra', valorVenda = '$valorVenda', estoque = '$estoque', comissao = '$comissao', codigoBarras = '$codigoBarras', tipo = '$tipo', subtipo = '$subTipo', descricao = '$descricao' WHERE code = '$codeProduto'");
	
	echo "<script>window.location='?p=';</script>";


}?>





<? } ?>
  
<table width="996" border="1">
<?

$sqlProdutos = mysqli_query($conexao_bd, "SELECT * FROM categoriaProdutosDiversosProdutos");
while($resProdutos = mysqli_fetch_array($sqlProdutos)){

?>

  <tr>
    <td width="80" rowspan="3"><img src="<? echo $resProdutos['imagem']; ?>" width="80" height="80" /></td>
    <td colspan="8" align="left"><h4 style="font:15px Arial, Helvetica, sans-serif; margin:0; padding:3px;"><strong><? echo $resProdutos['nomeProduto']; ?></strong></h4></td>
    </tr>
  <tr>
    <td width="122"><strong>Valor de compra</strong></td>
    <td width="104"><strong>Valor de venda</strong></td>
    <td width="99"><strong>Estoque</strong></td>
    <td width="98"><strong>Comiss&atilde;o</strong></td>
    <td width="144"><strong>Cod. Barras</strong></td>
    <td width="76"><strong>Tipo</strong></td>
    <td width="123"><strong>Sub Tipo</strong></td>
    <td width="90" rowspan="2">
    
    	<a onclick="abrirJanelaPopUp('scripts/exibirMarcasProdutos.php?codeProduto=<? echo $resProdutos['code']; ?>')" href="#"><img title="Adicionar marcas para este produto" src="img/marcas.png" width="25" height="25" /></a>
        
        <a href="?codeProduto=<? echo $resProdutos['code']; ?>&acao=editar"><img title="Alterar Informações" src="img/mais_informacoes.png" width="25" height="25" /></a>
        
        <img src="img/deleta.fw.png" width="25" height="25" />
    </td>
  </tr>
  <tr>
    <td><? echo number_format($resProdutos['valorCompra'],2,',','.'); ?></td>
    <td><? echo number_format($resProdutos['valorVenda'],2,',','.'); ?></td>
    <td><? echo $resProdutos['estoque']; ?></td>
    <td><? echo number_format($resProdutos['comissao'],2,',','.'); ?></td>
    <td><? echo $resProdutos['codigoBarras']; ?></td>
    <td><? echo $resProdutos['tipo']; ?></td>
    <td><? echo $resProdutos['subtipo']; ?></td>
    </tr>
<? } ?>
</table>


<script>
        function abrirJanelaPopUp(url) {
            // Configurar as dimensões da janela pop-up
            var largura = 400;
            var altura = 500;

            // Calcular o posicionamento central da janela na tela
            var esquerda = (screen.width - largura) / 2;
            var topo = (screen.height - altura) / 2;

            // Abrir a janela pop-up e carregar a página HTML especificada
            var janelaPopUp = window.open(url, '_blank', 'width=' + largura + ',height=' + altura + ',left=' + esquerda + ',top=' + topo);
        }
</script>  
</div><!-- box_pagamento_1 -->
</body>
</html>
<? if(@$_GET['acao2'] != NULL){
	
	if($_GET['acao2'] == 'criar'){
		mysqli_query($conexao_bd, "INSERT INTO categoriaProdutosDiversosProdutosMarcas (codeProduto, marcas) VALUES ('".$_GET['codeProduto']."', '".$_GET['marca']."')");
	}else{
		$sqlMarcas = mysqli_query($conexao_bd, "DELETE FROM categoriaProdutosDiversosProdutosMarcas WHERE codeProduto = '".$_GET['codeProduto']."' AND marcas = '".$_GET['marca']."'");
	}
	
	echo "<script>window.location='?p=';</script>";

}?>