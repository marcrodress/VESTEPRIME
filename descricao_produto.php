<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/descricao_produto.css" rel="stylesheet" type="text/css" />
</head>

<body>
<? require "topo.php";  require "scripts/verificador_caixa.php"; ?>
 <?
 $id = $_GET['produto'];
  $sql_produtos = mysqli_query($conexao_bd, "SELECT * FROM loja_online_produto WHERE id = '$id'");
  while($res_produto = mysqli_fetch_array($sql_produtos)){
 ?>
<div id="box_pagamento_1">
<h1><strong><? echo $res_produto['titulo']; ?></strong></h1>
<hr />
<??>
 <div id="descricao_produto">
  
  <div id="foto_produto">
   <a target="_blank" href="<? echo $_GET['img']; ?>"><img src="<? echo $_GET['img']; ?>" width="350" height="320" border="0" /></a>
   
   <ul>
    <li><a href="?produto=<? echo $_GET['produto']; ?>&img=<? echo $res_produto['img']; ?>"><img src="<? echo $res_produto['img']; ?>" width="50" height="50" border="0" /></a></li>
    <li><a href="?produto=<? echo $_GET['produto']; ?>&img=<? echo $res_produto['img2']; ?>"><img src="<? echo $res_produto['img2']; ?>" width="50" height="50" border="0" /></a></li>
    <li><a href="?produto=<? echo $_GET['produto']; ?>&img=<? echo $res_produto['img3']; ?>"><img src="<? echo $res_produto['img3']; ?>" width="50" height="50" border="0" /></a></li>
    <li><a href="?produto=<? echo $_GET['produto']; ?>&img=<? echo $res_produto['img4']; ?>"><img src="<? echo $res_produto['img4']; ?>" width="50" height="50" border="0" /></a></li>
    <li><a href="?produto=<? echo $_GET['produto']; ?>&img=<? echo $res_produto['img5']; ?>"><img src="<? echo $res_produto['img5']; ?>" width="50" height="50" border="0" /></a></li>
   </ul>
   
  </div><!-- foto_produto -->
  
  <div id="informacoes_basicas">
   <ul>
   <li><h1 style="font:12px Arial, Helvetica, sans-serif; color:#CCC;">Cod.: <? echo $res_produto['id']; ?></h1></li>
   <li><h1 style="font:30px Arial, Helvetica, sans-serif; text-decoration:line-through; font-style:italic;">De: R$ <? echo number_format($res_produto['valor_venda']+($res_produto['valor_venda']*0.2),2,',','.'); ?></h1></li>
   <li><h1 style="font:65px Arial, Helvetica, sans-serif; font-style:italic; color:#090">Por: R$ <? echo number_format($res_produto['valor_venda'],2,',','.'); ?></h1></li>
   <li><h1 style="font:20px Arial, Helvetica, sans-serif; font-style:italic; color:#090">A vista: R$ <? echo number_format($res_produto['valor_venda']-($res_produto['valor_venda']*0.04),2,',','.'); ?></h1></li>
   <li><h1 style="font:20px Arial, Helvetica, sans-serif; font-style:italic; color:#F00">Prazo de entrega máxima: <? echo $res_produto['entrega']+2; ?> dias úteis</h1></li>
   <li><img src="img/FRETE-GRATIS.png" width="72" height="53"/> 
   <a href="pagamento_do_produto.php?produto=<? echo $res_produto['id']; ?>"><img src="img/COMPRAR_CARRINHO.fw.png" width="152" height="50" title="Comprar agora" border="0" /></a></li>
   <li><hr /></li>
   <li><h1 style="font:15px Arial, Helvetica, sans-serif; font-style:italic;">Com esta compra você ganha <? echo number_format($res_produto['valor_venda']/4,0); ?> pontos no seu VESTE POINT</h1></li>
   </ul>
  </div><!-- informacoes_basicas -->
  
  <div id="enviar_descricao_produto">
   <a href="">Enviar Informações</a>
   <img style="border-radius:5px;" src="img/cartao_credito.png" width="200" height="116"/><br /><br />
   <strong>Parcele em até 12 X</strong><img src="img/button.png" width="220" height="1" /><br /><br />
   <?
    for($i=2; $i<=10; $i++){
		echo $i;
		echo " X ";
		echo number_format($res_produto['valor_venda']/$i,2,',','.');
		echo "<br>";
	}
   ?>
  </div><!-- enviar_descricao_produto -->
  
 </div><!-- descricao_produto -->
 
 <div id="descricao_produto_todo">
  <br />
  <hr />
  <h1 style="font:20px Arial, Helvetica, sans-serif; color:#999;"><strong>Descrição do produto</strong></h1>
  <hr />
   <? echo $res_produto['descricao']; ?>
 </div><!-- descricao_produto_todo -->
 
</div><!-- box_pagamento_1 -->
<? } // descriçao do produto ?>
</body>
</html>