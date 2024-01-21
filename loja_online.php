<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/loja_online.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>
</head>

<body>
<? require "topo.php";  require "scripts/verificador_caixa.php"; ?>

<div id="box_pagamento_1">
<h1><strong>LOJA ONLINE - SISTEMA Drop shipping</strong></h1>
<hr />

<div id="menu_loja">
 <ul>
 <?
 $sql_categorias = mysqli_query($conexao_bd, "SELECT * FROM loja_online_categorias");
  while($res_categorias = mysqli_fetch_array($sql_categorias)){
 ?>
  <li><a href="?cate=<? echo $res_categorias['cod']; ?>&query=<? echo base64_encode("WHERE categoria = '".$_GET['cate']."' ORDER BY id DESC"); ?>"><strong><? echo strtoupper($res_categorias['categoria']); ?></strong></a></li>
 <? } ?>
 </ul>
 
 <form name="" method="post" enctype="multipart/form-data">
  <input style="font:12px Arial, Helvetica, sans-serif; color:#999; float:left; padding:10px; border:1px solid #000; width:220px; border-radius:5px; margin:-15px 0 0  20px;" type="text" name="keygo" />
  <input  style="font:12px Arial, Helvetica, sans-serif; color:#999; float:left; padding:10px; border:1px solid #000; width:45px; border-radius:5px; margin:-15px 0 0  2px;" type="submit" name="button" id="button" value="Go" />
 </form>
 <? if(isset($_POST['button'])){
  
  $keygo = $_POST['keygo'];
  
  if($keygo == ''){
	  echo "<script language='javascript'>window.alert('DIGITE AO MENOS 3 LETRAS');</script>";
  }else{
	  
	  $query = base64_encode("WHERE titulo LIKE '%$keygo%' OR descricao LIKE '%$keygo%' OR img LIKE '%$keygo%'");
	  
	 $sql_verifica_produto = mysqli_query($conexao_bd, "SELECT * FROM loja_online_produto WHERE titulo LIKE '%$keygo%' OR descricao LIKE '%$keygo%' OR img LIKE '%$keygo%'");
	  if(mysqli_num_rows($sql_verifica_produto) == ''){
		echo "<script language='javascript'>window.alert('Não foi encontrado nenhum produto com as informações digitadas!');</script>";
	  }else{
		echo "<script language='javascript'>window.location='?query=$query';</script>";
	  }
  }
 
 }?>
</div><!--menu_loja-->
<hr />

<div id="selecao_produtos">

<h1 style="float:left;">
        <? 
		 $sql_conta = mysqli_query($conexao_bd, "SELECT * FROM loja_online_categorias WHERE cod = '".$_GET['cate']."'");
		  while($res_conta = mysqli_fetch_array($sql_conta)){
			  echo $res_conta['categoria'];
		  }
		?>
</h1>

<form name="" method="post">
  <select style="float:right;" name="jumpMenu" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">
    <option value="">Selecione</option>
    <option value="?cate=<? echo $_GET['cate']; ?>&query=<? echo base64_encode("WHERE categoria = '".$_GET['cate']."' ORDER BY valor_venda ASC"); ?>">Menor preço</option>
    <option value="?cate=<? echo $_GET['cate']; ?>&query=<? echo base64_encode("WHERE categoria = '".$_GET['cate']."' ORDER BY valor_venda DESC"); ?>">Maior preço</option>
    <option value="?cate=<? echo $_GET['cate']; ?>&query=<? echo base64_encode("WHERE categoria = '".$_GET['cate']."' ORDER BY entrega ASC"); ?>">Entrega rápida</option>
    <option value="?cate=<? echo $_GET['cate']; ?>&query=<? echo base64_encode("WHERE categoria = '".$_GET['cate']."' AND valor_venda BETWEEN 0 AND 400"); ?>">Até 400</option>
    <option value="?cate=<? echo $_GET['cate']; ?>&query=<? echo base64_encode("WHERE categoria = '".$_GET['cate']."' AND valor_venda BETWEEN 0 AND 600"); ?>">Até 600</option>
    <option value="?cate=<? echo $_GET['cate']; ?>&query=<? echo base64_encode("WHERE categoria = '".$_GET['cate']."' AND valor_venda BETWEEN 0 AND 800"); ?>">Até 800</option>
    <option value="?cate=<? echo $_GET['cate']; ?>&query=<? echo base64_encode("WHERE categoria = '".$_GET['cate']."' AND valor_venda BETWEEN 0 AND 1000"); ?>">Até 1000</option>
    <option value="?cate=<? echo $_GET['cate']; ?>&query=<? echo base64_encode("WHERE categoria = '".$_GET['cate']."' AND valor_venda BETWEEN 0 AND 1500"); ?>">Até 1500</option>
    <option value="?cate=<? echo $_GET['cate']; ?>&query=<? echo base64_encode("WHERE categoria = '".$_GET['cate']."' AND valor_venda BETWEEN 0 AND 2000"); ?>">Até 2000</option>
  </select>
</form>

<img src="img/mais_informacoes.png" width="1190" height="1" />
 
 <?
 $categoria = $_GET['cate'];
 $query = base64_decode($_GET['query']);
 
 if($_GET['query'] == ''){
	$query = "WHERE categoria = '$categoria' ORDER BY id DESC";
 }else{
	$query = $query;
 }

  $sql_produtos = mysqli_query($conexao_bd, "SELECT * FROM loja_online_produto $query");
  while($res_produto = mysqli_fetch_array($sql_produtos)){
 ?>
 <div id="selecao_produtos_grade">
 
  <a href="descricao_produto.php?produto=<? echo $res_produto['id']; ?>&img=<? echo $res_produto['img']; ?>"><img title="Comprar agora" src="<? echo $res_produto['img']; ?>" width="230" height="200" border="0" /></a>
  
  <h1 style="font:9px Arial, Helvetica, sans-serif;"><strong><? echo $res_produto['titulo']; ?></strong></h1>
  <h1 style="color:#999; text-decoration:line-through; text-transform:none; padding:0; margin:-10px 0 0 0;  font:15px Arial, Helvetica, sans-serif;"><strong>De: R$ <? echo number_format($res_produto['valor_venda']+($res_produto['valor_venda']*0.2),2,',','.'); ?></strong></h1>
  <h1 style="color:#090; text-transform:none; padding:0; margin:0; font:25px Arial, Helvetica, sans-serif;"><strong>Por: R$ <? echo number_format($res_produto['valor_venda'],2,',','.'); ?></strong></h1>

  <h1 style="color:#900; text-decoration:0; text-transform:none; padding:0; margin:10px 0 10px 0;  font:15px Arial, Helvetica, sans-serif;"><strong>Entrega máxima: <? echo $res_produto['entrega']+2; ?> dias</strong></h1>


  <img src="img/FRETE-GRATIS.png" width="72" height="53" />
  
  <a href="descricao_produto.php?produto=<? echo $res_produto['id']; ?>&img=<? echo $res_produto['img']; ?>"><img src="img/COMPRAR_CARRINHO.fw.png" width="152" height="50" border="0" title="Comprar agora" /></a>
  
 </div><!-- selecao_produtos_grade -->
 <? } ?>

</div><!-- box_pagamento_1 -->
</body>
</html>
<?



?>