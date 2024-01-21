<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/mostra_cliente.css" rel="stylesheet" type="text/css" />
</head>

<body>
<? require "topo.php";  require "scripts/verificador_caixa.php"; ?>
<div id="topo">
<div id="busca_produto">
<img src="img/linha.png" width="1000" height="5" />
<? if(isset($_POST['gos'])){

$key = $_POST['key'];

$sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente WHERE cliente = '$key' OR cartao = '$key'");
if(mysqli_num_rows($sql_cliente) == ''){
echo "<script language='javascript'>window.alert('CLIENTE NÃO ENCONTRADO!');</script>";
}else{
  while($res_cliente = mysqli_fetch_array($sql_cliente)){
	  
	  $cpf_cliente = $res_cliente['cliente'];
	  
	$sql_carrinho = mysqli_query($conexao_bd, "SELECT * FROM carrinho WHERE ip = '$ip' AND status = 'Ativo'");
	if(mysqli_num_rows($sql_carrinho) == ''){
		$code_carrinho = rand();
	 mysqli_query($conexao_bd, "INSERT INTO carrinho (ip, code_carrinho, hora_abertura, data, status, cliente, operador, code_dia, loja) VALUES ('$ip', '$code_carrinho', '$data_completa', '$data', 'Ativo', '$cpf_cliente', '$operador', '$code_dia', '$loja')");
	 echo "<script language='javascript'>window.location='carrinho.php?p=';</script>";
	}else{
	 mysqli_query($conexao_bd, "UPDATE carrinho SET cliente = '$cpf_cliente' WHERE ip = '$ip' AND status = 'Ativo'");
	 echo "<script language='javascript'>window.location='carrinho.php?p=';</script>";
   }
  }
 }
}?>

  <form name="" method="post" enctype="multipart/form-data">
    <span id="sprytextfield2">
    <input class="input1" type="password" name="key" autofocus />
</span>
    <input class="input2" type="submit" name="gos" value="" />
  </form>
 </div><!-- busca_produto -->
<img src="img/linha.png" width="1000" height="5" />
</div><!-- topo -->




<div id="box_corpo">
 
 <div id="box_cliente">
 <?
 $sql_carrinho = mysqli_query($conexao_bd, "SELECT * FROM carrinho WHERE ip = '$ip' AND status = 'Ativo'");
 if(mysqli_num_rows($sql_carrinho) == ''){
 }else{
 ?>

 <? } ?>
 </div><!-- box_cliente -->
 
 <div id="box_compras">
 <?
 $verifica_carrinho = mysqli_query($conexao_bd, "SELECT * FROM carrinho WHERE status = 'Ativo' AND ip = '$ip'");
 if(mysqli_num_rows($verifica_carrinho) == ''){
	echo "Não existe nenhum produto/serviço adicionado ao carrinho.";	 
 }else{
 $verifica_produtos_carrinho = mysqli_query($conexao_bd, "SELECT * FROM produtos_caixa  WHERE status = 'Ativo' AND ip = '$ip'");
  ?>
  <table width="500" border="0">
  <tr>
    <td colspan="5"><strong>DESCRIÇÃO DO CARRINHO</strong></td>
    <td width="69"><a href="">PRINT</a></td>
  </tr>
  <tr>
    <td colspan="6"><hr /></td>
  </tr>
  <tr>
    <td width="42"><strong>ITEM</strong></td>
    <td width="48"><strong>COD.</strong></td>
    <td width="207"><strong>DESCRIÇÃO</strong></td>
    <td width="60"><strong>QUANT.</strong></td>
    <td width="58"><strong>V.UNIT.</strong></td>
    <td width="69"><strong>V.TOTAL</strong></td>
  </tr>
  <tr>
    <td colspan="6"><hr></td>
  </tr>
  <? 
  	$produtos = 0;
	$servicoes = 0;
	$item = 0;
	$valor_compras = 0;
  	while($res_produtos_carrinho = mysqli_fetch_array($verifica_produtos_carrinho)){ $item++;
	
	if($res_produtos_carrinho['tipo'] == 'PRODUTO'){
	$produtos++;
	}else{
	$servicoes++;
	}
	
	$valor_compras = $res_produtos_carrinho['valor']+$valor_compras;
	
  ?>
  <tr>
    <td height="29"><? echo $item; ?></td>
    <td><? echo $res_produtos_carrinho['code_produto']; ?></td>
    <td><? $code_produto = $res_produtos_carrinho['code_produto']; 
	
	$busca_produto = mysqli_query($conexao_bd, "SELECT * FROM produtos WHERE status = 'Ativo' AND code = '$code_produto'");
		while($res_produto = mysqli_fetch_array($busca_produto)){
				echo $res_produto['titulo_resumido'];
			
	
	?></td>
    <td><? echo $res_produtos_carrinho['quant']; ?></td>
    <td><? echo number_format($res_produto['valor'],2); ?></td>
    <td><? echo number_format($res_produtos_carrinho['valor'],2); ?></td>
  </tr>
  <? }} ?>
  </table>
<? }// fecha a verificação do carrinho ?>
 </div><!-- box_compras -->
 
 <div id="valor_compras">
  <h1><strong>Valor: </strong> <strong class="strong3">R$ <? echo number_format($valor_compras,2); ?></strong></h1>
  <hr />
  <h2><strong>PRODUTOS:</strong> <? echo $produtos; ?> - <strong>SERVIÇOS:</strong> <? echo $servicoes; ?></h2>
 </div><!-- valor_compras -->
 
 <div id="avisos">

 </div><!-- avisos -->
 
</div><!-- box_corpo -->

<? require "rodape.php"; ?>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {maxChars:16});
</script>
</body>
</html>