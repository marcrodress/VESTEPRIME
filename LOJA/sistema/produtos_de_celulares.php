<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/produtos_de_celulares.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="box_cad_produto">
<? if(@$_GET['p'] == ''){ ?>
<h1><strong>PRODUTOS RELACIONADOS A CELULARES</strong><hr /></h1>
<form name="" method="post" action="" enctype="multipart/form-data">
<strong>Criar novo produto</strong><br />
<table width="1190" border="0">
  <tr>
    <td width="362">PRODUTO</td>
    <td width="258">IMAGEM DO PRODUTO</td>
    <td width="93">VALOR VENDA</td>
    <td width="62">COMISS&Atilde;O</td>
    <td align="center" width="152">VALOR DE COMPRA</td>
    <td width="237">&nbsp;</td>
  </tr>
  <tr>
    <td><label for="produto"></label>
    <input name="produto" type="text" id="produto" size="40"> </td>
    <td><label for="textfield3"></label>
      <input type="text" name="imagem" id="textfield3" /></td>
    <td><input name="valor_venda" type="text" id="valor_venda" size="5" /></td>
    <td><input name="comissao" type="text" id="comissao" size="5" /></td>
    <td align="center"><label for="valor_compra"></label>
      <input name="valor_compra" type="text" id="valor_compra" size="5" /></td>
    <td><input name="cadastrar" type="submit" id="cadastrar" value="Enviar" /></td>
  </tr>
</table>
</form>
<? if(isset($_POST['cadastrar'])){
	
$produto = strtoupper($_POST['produto']);
$comissao = strtoupper($_POST['comissao']);
$valor_venda = strtoupper($_POST['valor_venda']);
$valor_compra = strtoupper($_POST['valor_compra']);
$imagem = $_POST['imagem'];
$code_produto = rand();

$verifica_produto = mysqli_query($conexao_db, "SELECT * FROM produtos_celulares WHERE produto = '$produto'");
$conta_produto = mysqli_num_rows($verifica_produto);
if($conta_produto >= 1){
	echo "<script language='javascript'>window.alert('Produto com este mesmo titulo já está cadastrado');</script>";
}else{
	$produto_celular = mysqli_query($conexao_db, "INSERT INTO produtos_celulares (code, produto, valor_venda, comissao, valor_compra, imagem) VALUES ('$code_produto', '$produto', '$valor_venda', '$comissao', '$valor_compra', '$imagem')");
	
	if($produto_celular == ''){
		echo "<script language='javascript'>window.alert('Erro ao cadastrar!');</script>";
	}else{
	
	echo "<script language='javascript'>window.location='';</script>";
 }}
}?>
<hr />

<table width="1190" border="0">
  <tr>
    <td width="145" bgcolor="#0099CC"><strong>CÓDIGO</strong></td>
    <td width="607" bgcolor="#0099CC"><strong>PRODUTO</strong></td>
    <td width="607" bgcolor="#0099CC"><strong>VALOR DE VENDA</strong></td>
    <td width="607" bgcolor="#0099CC"><strong>VALOR DE COMPRA</strong></td>
    <td width="607" bgcolor="#0099CC"><strong>COMISSÃO</strong></td>
    <td width="109" bgcolor="#0099CC">&nbsp;</td>
  </tr>
  <?
  $i = 0;
  $sql_verifca = mysqli_query($conexao_db, "SELECT * FROM produtos_celulares");
   while($res_produto = mysqli_fetch_array($sql_verifca)){ $i++; 
  ?>
  <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
    <td><? echo $res_produto['code']; ?></td>
    <td><? echo $res_produto['produto']; ?></td>
    <td><? echo $res_produto['valor_venda']; ?></td>
    <td><? echo $res_produto['valor_compra']; ?></td>
    <td><? echo $res_produto['comissao']; ?></td>
    <td><a href="?pack=produtos_de_celulares&p=1&code_produto=<? echo $res_produto['code']; ?>"><img src="img/lista_ganhadores.png" width="20" height="20" border="0" title="Atualizar estoque" /></a></td>
  </tr>
  <? } ?>
</table>
<? } ?>



<? if(@$_GET['p'] == '1'){ ?>
<h1><strong>ATUALIZAR DO PRODUTO:  
<?

$code_modelo = 0;
$code_produto = $_GET['code_produto'];
$code_novo_produto = 0;
  $sql_verifca = mysqli_query($conexao_db, "SELECT * FROM produtos_celulares WHERE code = '".$_GET['code_produto']."'");
   while($res_produto = mysqli_fetch_array($sql_verifca)){ 
   	echo $produto = $res_produto['produto'];
   	$imagem = $res_produto['imagem'];
   	$comissao = $res_produto['comissao'];
   	$valor_venda = $res_produto['valor_venda'];
   	$valor_compra = $res_produto['valor_compra'];
		
		$puxa_modelos = mysqli_query($conexao_db, "SELECT * FROM modelos_celulares");
		while($res_modelos = mysqli_fetch_array($puxa_modelos)){
			$code_modelo = $res_modelos['code_modelo'];
			$modelo = $res_modelos['modelo'];
			$marca = $res_modelos['marca'];
			
			$titulo_produto = "$produto - $marca - $modelo";
			
			$code_novo_produto = rand()*date('s');
			$sql_verifica_se_existe_produto = mysqli_query($conexao_db, "SELECT * FROM produtos WHERE celular = 'SIM' AND code_produto_celular = '$code_produto' AND code_modelo = '$code_modelo'");
			if(mysqli_num_rows($sql_verifica_se_existe_produto) >=1){
			}else{
				mysqli_query($conexao_db, "INSERT INTO produtos (tipo, status, code, titulo, titulo_resumido, valor_venda, valor_compra, estoque, foto, foto2, foto3, foto4, foto5, descricao, link_fornecedor, alerta_estoque, produto_agregado, comissao, quant_vendida, celular, code_produto_celular, code_modelo, valor_venda2, valor_compra2, estoque2) VALUES ('PRODUTO', 'ATIVO', '$code_novo_produto', '$titulo_produto', '$titulo_produto', '$valor_venda', '$valor_compra', '0', '$imagem', '', '', '', '', '', '', '0', '0', '0.2', '0', 'SIM', '$code_produto', 	'$code_modelo', '', '', '')");
			}
			
			
		}
		
		
			
   }
?>
</strong><hr /></h1>
<table class="table" width="1190" border="0">
  <tr>
    <td width="135" bgcolor="#33CCCC"><strong>CÓD. PRODUTO</strong></td>
    <td width="121" bgcolor="#33CCCC"><strong>MARCA</strong></td>
    <td width="78" bgcolor="#33CCCC"><strong>MODELO</strong></td>
    <td width="147" bgcolor="#33CCCC"><strong>VALOR DE VENDA</strong></td>
    <td width="159" bgcolor="#33CCCC"><strong>VALOR COMPRA</strong></td>
    <td width="91" bgcolor="#33CCCC"><strong>ESTOQUE</strong></td>
    <td width="91" bgcolor="#33CCCC"><strong>COMISSÃO</strong></td>
    <td width="168" bgcolor="#33CCCC">&nbsp;</td>
    <td width="71" bgcolor="#33CCCC">&nbsp;</td>
  </tr>
  <?
  $i = 0;
  $sql_marca = mysqli_query($conexao_db, "SELECT * FROM marcas_celulares");
   while($res_marca = mysqli_fetch_array($sql_marca)){
   $sql_modelo = mysqli_query($conexao_db, "SELECT * FROM modelos_celulares WHERE marca = '".$res_marca['marca']."'"); 
   while($res_modelo = mysqli_fetch_array($sql_modelo)){ 
   $sql_produtos = mysqli_query($conexao_db, "SELECT * FROM produtos WHERE code_modelo = '".$res_modelo['code_modelo']."' AND code_produto_celular = '".$_GET['code_produto']."'"); 
   while($res_produtos = mysqli_fetch_array($sql_produtos)){ $i++;
  ?>
  <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
    <td><? echo $res_produtos['code']; ?></td>
    <td><? echo $res_modelo['marca']; ?></td>
    <td><? echo $res_modelo['modelo']; ?></td>
    <td><? echo $res_produtos['valor_venda']; ?></td>
    <td><? echo $res_produtos['valor_compra']; ?></td>
    <td><? echo $res_produtos['estoque']; ?></td>
    <td><? echo $res_produtos['comissao']; ?></td>
    <td></td>
    <td>
    <a rel="superbox[iframe][630x200]" href="scripts/atualizar_estoque_produto_celular.php?id=<? echo $res_produtos['id']; ?>"><img src="img/cadastro.jpg" width="20" height="20" border="0" title="Atualizar estoque do produto" /></a> 
    <img src="img/deleta.jpg" width="18" height="18" /></td>
  </tr>
  <? }}} ?>
</table>


<? } ?>

</div><!-- box_cad_produto -->
</body>
</html>