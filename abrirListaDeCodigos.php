<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Lista de produtos</title>
<? require "config.php"; ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="scripts/barcode/dist/JsBarcode.all.js"></script>
</head>

<body>
<script>
		Number.prototype.zeroPadding = function(){
			var ret = "" + this.valueOf();
			return ret.length == 1 ? "0" + ret : ret;
		};
</script>
<div class="row">
<? $iProduto=0;
$sqlProdutos = mysqli_query($conexao_bd, "SELECT * FROM ProdutosListaCodigoBarras WHERE operador = '$operador'");
 while($resProdutos = mysqli_fetch_array($sqlProdutos)){ $iProduto++;
	 $sqlProduto = mysqli_query($conexao_bd, "SELECT * FROM produtos WHERE code = '".$resProdutos['produto']."'");
	 	 while($produtoNome = mysqli_fetch_array($sqlProduto)){
			 $titulo = $produtoNome['titulo'];
		}
?>
  <h5 class="card-title">
  	<? echo $iProduto; echo ") ";echo $titulo; ?> - <a href="?acao=excluir&produto=<? echo $resProdutos['produto']; ?>"><img src="img/deleta.fw.png" width="16" height="15"/></a>
    - <a style="font:10px Arial, Helvetica, sans-serif; color:#999;" onclick="abrirQuantidadeCodigos(<?php echo $resProdutos['produto']; ?>)" href="#">Alterar quantidade</a>
  </h5>
  <? for($i=0; $i<$resProdutos['quantidade']; $i++){ ?>
  <div class="card" style="width: 11rem; margin-left:2px; padding:0;">
  		<img id="barcode1"/>
		<script>
			var url = new URL(window.location.href);			
			var produto = <? echo $resProdutos['produto']; ?>;
			JsBarcode("#barcode1", produto);
        </script>
	</div>
  <? } ?>
    
<? } ?>
</div>
<? if($_GET['acao'] == 'excluir'){ $produto = $_GET['produto'];

	mysqli_query($conexao_bd, "DELETE FROM ProdutosListaCodigoBarras WHERE produto = '$produto'");
	echo "<script>location='?acao=';</script>";

}?>


<script>
   function abrirQuantidadeCodigos(codeProdutos){
	  	var url = "scripts/abrirQuantidadeCodigos.php?produto="+codeProdutos;
        var width = 320;
        var height = 130;
        var left = (window.innerWidth - width) / 2;
        var top = (window.innerHeight - height) / 2;
        
        window.open(url, "Popup", "width=" + width + ",height=" + height + ",left=" + left + ",top=" + top);
 }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>