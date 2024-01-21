<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/pesquisa_de_produto.css" rel="stylesheet" type="text/css" />
<style type="text/css">
#box_corpo table tr td {
	font-weight: bold;
}
</style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</head>

<body>
<? require "topo.php"; ?>



<div id="box_corpo">
 <form name="" method="post" action="" enctype="multipart/form-data">
  <input type="text" name="buscador" class="input" size="44" autofocus="autofocus" /><input class="input2" type="submit" name="buscar" value="BUSCAR" />
  <br />
  <a target="_blank" style="font:10px Arial, Helvetica, sans-serif; float:left; color:#CCC; margin:3px" href="abrirListaDeCodigos.php">Lista de códigos</a>
  <a style="font:10px Arial, Helvetica, sans-serif; float:right; color:#CCC; margin:3px;" href="listar_produtos.php">Lista produtos</a>
 </form>
  <hr />

 <? if(isset($_POST['buscar'])){
	 
  $buscador = $_POST['buscador'];
  if($buscador == ''){
	  echo "<script language='javascript'>window.alert('DIGITE PELO MENOS 2 LETRAS OU NÚMEROS PARA FAZER A BUSCA!');</script>";
  }else{
	  $sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM produtos WHERE titulo LIKE '%$buscador%' OR code = '$buscador' OR titulo_resumido LIKE '%$buscador%' OR descricao LIKE '%$buscador%'");
	  $conta_produtos = mysqli_num_rows($sql_verifica);
	  
	  if($conta_produtos == ''){
		  echo "<script language='javascript'>window.alert('NÃO FOI ENCONTRADOS PRODUTOS COM INFORMAÇÕES DIGITADAS ($buscador)');</script>";
	  }else{
		  echo "<script language='javascript'>window.location='?key=$buscador';</script>";
	  }
  }
  }?>


<? if(@$key = $_GET['key'] != ''){ $key = $_GET['key']; ?>


<?
$sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM produtos WHERE code = '$key' OR titulo LIKE '%$key%' OR titulo_resumido LIKE '%$key%' OR descricao LIKE '%$key%'");
?>
	 
<h2><strong>Foram encontrados <? echo mysqli_num_rows($sql_verifica); ?> produto(s)</strong></h2>
<hr />
<? while($res_verifica = mysqli_fetch_array($sql_verifica)){ ?>
<table class="table table-bordered" width="1000" border="0">
  <tr>
	<td align="center" width="70" rowspan="3" class="text-center">
            <a rel="superbox[iframe][430x60]" href="scripts/alterarImagem.php?code=<?php echo $res_verifica['code']; ?>">
                <img src="<?php
                    if ($res_verifica['foto'] == '') {
                        echo "https://superprix.vteximg.com.br/arquivos/ids/183256-292-292/produto-sem-imagem.jpg?v=637218812594500000";
                    } else {
                        echo $res_verifica['foto'];
                    }
                ?>" width="70" height="70" title="Alterar Imagem" class="d-flex mx-auto my-auto" />
            </a>
           
            
     </td>
    <td colspan="10" class="table-active table-secondary">
    		<h3>
            
            <a href="#" onclick="abrirQuantidadeCodigos(<? echo $res_verifica['code']; ?>);">
                <img width="30" title="Adicionar produto a lista de código de barras" height="20" src="https://pt.seaicons.com/wp-content/uploads/2015/11/Ecommerce-Barcode-Scanner-icon.png" />
            </a>

             | 
                        
            <strong><? echo $res_verifica['titulo']; ?></strong> 
            
    		<a onclick="abrirCodigoBarras(<? echo $res_verifica['code']; ?>);" style="float:right; margin:0;" href="#"><img width="40" title="Gerar código de barras desse produto" height="20" src="https://cdn.icon-icons.com/icons2/179/PNG/128/barcode_reader_128x128-32_22291.png" /></a></h3>
    </td>
    </tr>
  <tr class="table-active" style="font:10px Arial, Helvetica, sans-serif;">
    <td width="131" bgcolor="#66CC33"><strong>c&oacute;d. PRODUTO</strong></td>
    <td width="100" bgcolor="#66CC33"><strong>ESTOQUE</strong></td>
    <td width="89" bgcolor="#66CC33"><strong>VALOR</strong></td>
    <td width="53" bgcolor="#66CC33"><strong>TIPO</strong></td>
    <td width="71" bgcolor="#66CC33"><strong>SUBTIPO</strong></td>
    <td width="104" bgcolor="#66CC33"><strong>Q. VENDIDA</strong></td>
    <td width="63" bgcolor="#66CC33"><strong>AGREGADO</strong></td>
    <td width="67" bgcolor="#66CC33"><strong>PRATELEIRA</strong></td>
    <td width="99" bgcolor="#66CC33"><strong>APROVA&Ccedil;&Atilde;O</strong></td>
    <td width="103" bgcolor="#66CC33">&nbsp;</td>
  </tr>
  <tr style="font:11px Arial, Helvetica, sans-serif;">
    <td>
	<? echo $codigo_produto = $res_verifica['code']; ?> 
    
    </td>
    <td bgcolor="#D2E9FF"><? if($operador == '05379839371'){ ?><a style="font:12px Arial, Helvetica, sans-serif; text-decoration:none; color:#000;" rel="superbox[iframe][130x60]" href="scripts/altera_estoque.php?code=<? echo $res_verifica['code']; ?>&loja=taiba"><? echo $res_verifica['estoque']+0; ?></a> <? }else{ ?> <? echo $res_verifica['estoque']+0; }?></td>
   
    <td bgcolor="#DDFFDD">R$ <? if($operador == '05379839371'){ ?><a style="font:12px Arial, Helvetica, sans-serif; text-decoration:none; color:#000;" rel="superbox[iframe][130x60]" href="scripts/altera_preco.php?code=<? echo $res_verifica['code']; ?>&loja=taiba"><? echo number_format($res_verifica['valor_venda']+0, 2, ',', '.'); ?></a> <? }else{ echo number_format($res_verifica['valor_venda']+0, 2, ',', '.'); } ?>
    </td>
    <td><? echo $res_verifica['tipo']; ?></td>
    <td><? echo $res_verifica['subTipo']; ?></td>
    <td><? echo $res_verifica['quant_vendida']; ?></td>
    <td><? echo $res_verifica['produto_agregado']; ?></td>
    <td>&nbsp;</td>
    <td><img src="https://img.freepik.com/vetores-premium/icone-de-classificacao-de-cinco-estrelas-estrelas-de-avaliacao-vetor-estrelas-planas-isoladas_118339-1270.jpg" width="70" height="18" /></td>
    <td bgcolor="#FFDECE">
      <?

	$sql_verifica_caixa = mysqli_query($conexao_bd, "SELECT * FROM produtos_caixa WHERE code_produto = '$codigo_produto' AND code_carrinho = '$code_carrinho'");
	if(mysqli_num_rows($sql_verifica_caixa) <=0){
	?>
      <a href="?p=1&code_produto=<? echo $res_verifica['code']; ?>">
        <img src="img/correto.jpg" width="20" height="18" border="0" title="Incluir produto ao carrinho" />
        </a> 
      
      
       		<? if($operador == '05379839371'){ ?>
                <a href="cadastrar_produto.php?p=informacoes_produto&code_produto=<? echo $res_verifica['code']; ?>" target="_blank">
                <img src="img/cadastro.fw.png" title="Editar informações do produto" width="20" height="18" border="0"/>
                </a>                
      		<? } ?>
            
      <? } ?>
      
    </td>
  </tr>
</table>	  
<? } ?>



<? } ?>
  

<script>
  function abrirCodigoBarras(codeProdutos){
	  	var url = "scripts/barcode/example/index.html?produto="+codeProdutos;
        var width = 320;
        var height = 190;
        var left = (window.innerWidth - width) / 2;
        var top = (window.innerHeight - height) / 2;
        
        window.open(url, "Popup", "width=" + width + ",height=" + height + ",left=" + left + ",top=" + top);
 }
 
   function abrirQuantidadeCodigos(codeProdutos){
	  	var url = "scripts/abrirQuantidadeCodigos.php?produto="+codeProdutos;
        var width = 320;
        var height = 130;
        var left = (window.innerWidth - width) / 2;
        var top = (window.innerHeight - height) / 2;
        
        window.open(url, "Popup", "width=" + width + ",height=" + height + ",left=" + left + ",top=" + top);
 }
 
document.addEventListener('keydown', function(event) {
    // Verifica se a tecla pressionada é a letra 'p' ou 'P'
    if ((event.key === 'p' || event.key === 'P') && document.activeElement.tagName !== 'INPUT') {
        // Redireciona para a página fechar_carrinho.php
        window.location.href = 'fecha_carrinho.php?p=';
    }
});



 
</script>






</div><!-- box_corpo -->

<? if($_GET['p'] == '1'){

$code_produto = $_GET['code_produto'];
$carrinho = 0;
$cliente = 0;

$pega_carrinho = mysqli_query($conexao_bd, "SELECT * FROM carrinho WHERE ip = '$ip' AND status = 'Ativo'");
	while($res_carrinho = mysqli_fetch_array($pega_carrinho)){
		$carrinho = $res_carrinho['code_carrinho'];
		$cliente = $res_carrinho['cliente'];	
	}

$sql_produto = mysqli_query($conexao_bd, "SELECT * FROM produtos WHERE code = '$code_produto'");
	while($res_produto = mysqli_fetch_array($sql_produto)){

$sql_produtos_caixa = mysqli_query($conexao_bd, "SELECT * FROM produtos_caixa WHERE code_carrinho = '$carrinho' AND code_produto = '$code_produto'");
if(mysqli_num_rows($sql_produtos_caixa) <= 0){
	
		$tipo = $res_produto['tipo'];
		$estoque = $res_produto['estoque'];
		$comissao = ($res_produto['comissao']*1);	
	
		$valor_compra = $res_produto['valor_compra'];
		$valor_venda = $res_produto['valor_venda'];
		$valor = ($valor_venda*1);
		$titulo = $res_produto['titulo'];
		$subTipo = $res_produto['subTipo'];
		
		$codeProdutoPassivo = $res_produto['codeProdutoPassivo'];
		$marcaProdutoPassivo = $res_produto['marcaProdutoPassivo'];
		$modeloProdutoPassivo = $res_produto['modeloProdutoPassivo'];	
	
	
	 	mysqli_query($conexao_bd, "INSERT INTO produtos_caixa (codeCaixa, turno, ip, code_carrinho, dia, mes, ano, data_completa, data, status, cliente, operador, tipo, quant, valor, code_produto, desconto, comissao, code_dia, loja, valor_compra, valor_venda, titulo, subtipo, codeProdutoPassivo, marcaProdutoPassivo, modeloProdutoPassivo) VALUES ('$codeCaixa', '$turno', '$ip', '$code_carrinho', '$dia', '$mes', '$ano', '$data_completa', '$data', 'Ativo', '$cliente', '$operador', '$tipo', '1', '$valor', '$code_produto', '', '$comissao', '$code_vencimento_hoje', '$filial', '$valor_compra', '$valor_venda', '$titulo', '$subTipo', '$codeProdutoPassivo', '$marcaProdutoPassivo', '$modeloProdutoPassivo')");

	echo "<script language='javascript'>window.location='?p=';</script>";
}else{
 }
}
}?>





<? require "rodape.php"; ?>

</body>
</html>
  
  <? if(isset($_POST['estoque'])){
  
  $code_produto = $_POST['code_produto'];
  $estoque = $_POST['estoque'];
  
  mysqli_query($conexao_bd, "UPDATE estoque SET estoque = '$estoque' WHERE code = '$code_produto' AND loja = '$filial'");
  
  echo "<script language='javascript'>window.alert('Estoque atualizado com sucesso!');</script>";
  
  }?>