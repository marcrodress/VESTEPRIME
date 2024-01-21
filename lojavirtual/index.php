<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>VESTE PRIME - ELETRÔNICOS E ACESSÓRIOS DE CELULARES</title>
<link href="css/index.css" rel="stylesheet" type="text/css" />
</head>

<body>
<? require "topo.php"; ?>

<div id="box">
 
  <? 
   
   $sql_menu = mysqli_query($conexao_bd, "SELECT * FROM loja_online_categorias WHERE cod = '".$_GET['p']."'");
   	while($res_menu = mysqli_fetch_array($sql_menu)){
  ?>
 <h1 style="font:30px Arial, Helvetica, sans-serif; margin:10px;"><? echo $res_menu['categoria']; ?></h1>
 <? } ?>
 
 
 
 
 <? 
 
  $p = $_GET['p'];
  if($p == 0){
	  $p = 8415;
  }
  
  $sql_pro = mysqli_query($conexao_bd, "SELECT * FROM loja_online_produto WHERE categoria = '$p' ORDER BY id DESC");
   while($res_pro = mysqli_fetch_array($sql_pro)){
 ?>
 <div id="box_produto">
  <a style="font:20px Arial, Helvetica, sans-serif; text-decoration:none; color:#039;" href="detalhe_produto.php?id=<? echo $res_pro['id']; ?>"><img src="<? echo $res_pro['img']; ?>" width="400" height="400" />
  <? echo $res_pro['titulo']; ?></a>
  <hr />
  <h1 style="font:35px Arial, Helvetica, sans-serif; color:#930;">R$ <? echo number_format($res_pro['valor_venda'],2,',','.'); ?></h1>
 </div><!-- box_produto -->
 <? } ?>
 
</div><!-- box -->


<??>
</body>
</html>