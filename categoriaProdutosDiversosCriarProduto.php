<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/produtos_celulares.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>

<body>
<? require "topo.php";  require "scripts/verificador_caixa.php"; ?>

<div id="box_pagamento_1">
<h1><strong>CRIAR RODUTOS DE PRODUTOS/SERVI&Ccedil;OS PASSIVOS</strong></h1>
<hr />

<form name="form" id="form">
  <select style="margin:10px 0 10px 400px; width:200px; text-align:center;" class="form-select" name="jumpMenu" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">
    <option selected>Selecione o produto</option>
	<?

	$sqlProdutos = mysqli_query($conexao_bd, "SELECT * FROM categoriaProdutosDiversosProdutos");
	while($resProdutos = mysqli_fetch_array($sqlProdutos)){
	
	?>
    <option value="?produto=<? echo $resProdutos['code']; ?>"><? echo $resProdutos['nomeProduto']; ?></option>
    <? } ?>
  </select>
</form>


<table class="table table-bordered" width="996" border="1">
<?
$valorCompra = 0;
$valorVenda = 0;
$estoque = 0;
$comissao = 0;
$tipo = 0;
$subtipo = 0;
$descricao = 0;
$nomeProduto = 0;
$imagem = 0;


$sqlProdutos = mysqli_query($conexao_bd, "SELECT * FROM categoriaProdutosDiversosProdutos WHERE code = '".$_GET['produto']."'");
while($resProdutos = mysqli_fetch_array($sqlProdutos)){
	
	$valorCompra = $resProdutos['valorCompra'];
	$valorVenda = $resProdutos['valorVenda'];
	$estoque = $resProdutos['estoque'];
	$comissao = $resProdutos['comissao'];
	$tipo = $resProdutos['tipo'];
	$subtipo = $resProdutos['subtipo'];
	$nomeProduto = $resProdutos['nomeProduto'];
	$descricao = $resProdutos['descricao'];
	$imagem = $resProdutos['imagem'];

?>

  <tr>
    <td width="80" rowspan="3"><img src="<? echo $resProdutos['imagem']; ?>" width="80" height="80" /></td>
    <td colspan="7" align="left"><h4 style="font:15px Arial, Helvetica, sans-serif; margin:0; padding:3px;"><strong><? echo $resProdutos['nomeProduto']; ?></strong></h4></td>
    </tr>
  <tr>
    <td width="122"><strong>Valor de compra</strong></td>
    <td width="104"><strong>Valor de venda</strong></td>
    <td width="99"><strong>Estoque</strong></td>
    <td width="152"><strong>Comiss&atilde;o</strong></td>
    <td width="148"><strong>Cod. Barras</strong></td>
    <td width="105"><strong>Tipo</strong></td>
    <td width="132"><strong>Sub Tipo</strong></td>
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

<? if(@$_GET['produto'] != NULL){ ?>
<div class="container">
	<div class="row">
     <div class="col">
      <form action="" enctype="multipart/form-data" method="post">
      	<input type="text" name="key" style="width:200px; font:18px Arial, Helvetica, sans-serif; text-transform:uppercase; padding:10px; height:40px; margin:10px 0 10px 380px;" autofocus="autofocus" placeholder="Digite o modelo"/> 
        <input name="buscar" type="submit" style="width:100px; font:18px Arial, Helvetica, sans-serif; text-transform:uppercase; padding:10px; height:40px; margin:0 0 10px 2px;"/>
      </form>
     </div>
    </div>
    
    <? if(isset($_POST['buscar'])){
		
		$key = $_POST['key'];
		$produto = $_GET['produto'];
		$sqlMarcasProduto = mysqli_query($conexao_bd, "SELECT * FROM categoriaProdutosDiversosModelos WHERE modelo LIKE '%$key%'");
		if(mysqli_num_rows($sqlMarcasProduto) >= 1){
		 	echo "<script>location='?produto=$produto&key=$key';</script>";
		 }else{
		 	echo "<script>alert('Não foi encontrado o modelo selecionado');</script>";
		}
    
	
	}?>
    
<? } ?>
    
	<div class="row">
        <div class="col">
              <? if(@$_GET['key'] != NULL){ ?>
            <table width="995" class="table table-bordered table-secondary">
              <thead>
                <tr>
                  <th width="141" scope="col">MARCA</th>
                  <th width="166" scope="col">MODELO</th>
                  <th width="190" scope="col">COD. PRODUTO</th>
                  <th width="125" scope="col">VALOR COMPRA</th>
                  <th width="108" scope="col">VALOR VENDA</th>
                  <th width="89" scope="col">ESTOQUE</th>
                  <th width="62" scope="col">COMISSAO</th>
                  <th width="76" scope="col">&nbsp;</th>
                </tr>
              </thead>
              <tbody>
              <? $marca = 0; $modelo = 0; $nomeModelo = 0; $nomeMarca = 0;
              $sqlMarcasProduto = mysqli_query($conexao_bd, "SELECT * FROM categoriaProdutosDiversosModelos WHERE modelo LIKE '%".$_GET['key']."%'");
				 while($resMarcasProduto = mysqli_fetch_array($sqlMarcasProduto)){
					 $marca = $resMarcasProduto['marca'];
					 $modelo = $resMarcasProduto['code'];
					 $nomeModelo = $resMarcasProduto['modelo'];
			  ?>
              
              <form name="" method="post" enctype="multipart/form-data" action="">
              
               <input type="hidden" name="tipo" value="<? echo $tipo; ?>"/>
               <input type="hidden" name="subtipo" value="<? echo $subtipo; ?>"/>
               
               <input type="hidden" name="descricao" value="<? echo $descricao; ?>"/>
               <input type="hidden" name="imagem" value="<? echo $imagem; ?>"/>
               
               <input type="hidden" name="marca" value="<? echo $marca; ?>"/>
               <input type="hidden" name="modelo" value="<? echo $modelo; ?>"/>
               
               <input type="hidden" name="codeNovoProduto" value="<? echo "$codeProduto$modelo"; ?>"/>

                <tr>
                  <td>
				   <? 
				   
				  	$sqlMarcas = mysqli_query($conexao_bd, "SELECT * FROM categoriaProdutosDiversosMarca WHERE code = '".$resMarcasProduto['marca']."'");
						 while($resMarcas = mysqli_fetch_array($sqlMarcas)){
							 echo $nomeMarca = $resMarcas['marca'];
						}
						
						$codeProduto = $_GET['produto'];
						
				   ?></td>
                  <td><? echo $resMarcasProduto['modelo']; ?></td>
                  <td><? echo "$codeProduto$modelo"; ?><br /><a rel="superbox[iframe][400x95]" href="scripts/produto_associado.php?produto=<? echo "$marca$modelo"; ?>">Associar código</a></td>
                  <td><input name="valorCompra" value="<? echo $valorCompra; ?>" type="text" class="form-control" style="border-radius:5px; height:30px; padding:10px; text-align:center;" size="10"></td>
                  <td><input name="valorVenda" value="<? echo $valorVenda; ?>" type="text" class="form-control" style="border-radius:5px; height:30px; padding:10px; text-align:center;" size="10"></td>
                  <td><input name="estoque"  type="text" class="form-control" style="border-radius:5px; height:30px; padding:10px; text-align:center;" size="7"></td>
                  <td><input name="comissao" value="<? echo $comissao; ?>" type="text" class="form-control" style="border-radius:5px; height:30px; padding:10px; text-align:center;" size="8"></td>
                  <td><input type="submit" name="button" class="form-control" style="border-radius:5px; height:30px; padding:10px; text-align:center;" id="button" value="Enviar"></td>
                </tr>
                <input type="hidden" name="nomeProduto" value="<? echo "$nomeProduto - $nomeMarca - $nomeModelo"; ?>"/>
              </form>
              <? } ?>
                
              </tbody>
            </table>
            
            <? } ?>
      </div>
        
    </div>
</div>
<? if(isset($_POST['button'])){

$codeNovoProduto = $_POST['codeNovoProduto'];	
$tipo = $_POST['tipo'];	
$subtipo = $_POST['subtipo'];	
$nomeProduto = $_POST['nomeProduto'];	
$descricao = $_POST['descricao'];	


	
$marca = $_POST['marca'];	
$modelo = $_POST['modelo'];	
$valorCompra = $_POST['valorCompra'];	
$valorVenda = $_POST['valorVenda'];	
$estoque = $_POST['estoque'];	
$comissao = $_POST['comissao'];

$sql = mysqli_query($conexao_bd, "SELECT * FROM produtos WHERE code = '$codeNovoProduto'");
if(mysqli_num_rows($sql) >=1){
$produto = $_GET['produto'];
	echo "<script>window.alert('Produto já cadastrado, faça as alterações pelo formulário de alteração');location='?produto=$produto';</script>";
}else{


mysqli_query($conexao_bd, "INSERT INTO produtos 
(tipo, subTipo, status, code, titulo, titulo_resumido, valor_venda, valor_compra, estoque, foto, foto2, foto3, foto4, foto5, descricao, link_fornecedor, alerta_estoque, produto_agregado, comissao, quant_vendida, perdas, codeProdutoPassivo, marcaProdutoPassivo, modeloProdutoPassivo) VALUES 
('$tipo', '$subtipo', 'Ativo', '$codeNovoProduto', '$nomeProduto', '$nomeProduto', '$valorVenda', '$valorCompra', '$estoque', '$imagem', '', '', '', '', '$descricao', '', '', '', '$comissao', '0', '', '".$_GET['produto']."', '$marca', '$modelo')");

$produto = $_GET['produto'];
echo "<script>location='?produto=$produto';</script>";
}
}?>
</div><!-- box_pagamento_1 -->
</body>
</html>
