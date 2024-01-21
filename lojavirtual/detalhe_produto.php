<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>VESTE PRIME - ELETRÔNICOS E ACESSÓRIOS DE CELULARES</title>
<link href="css/detalhe_produto.css" rel="stylesheet" type="text/css" />
</head>

<body>
<? require "topo.php"; ?>

<?
$id = $_GET['id'];
$sql_produto = mysqli_query($conexao_bd, "SELECT * FROM loja_online_produto WHERE id = '$id'");
while($res_produto = mysqli_fetch_array($sql_produto)){
?>
<div id="box">
 <h1 style="font:30px Arial, Helvetica, sans-serif; margin:10px;"><? echo $res_produto['titulo']; ?></h1><hr />
 
 <div id="box_produto">
  <img src="<? echo $res_produto['img']; ?>" width="800" height="800" />
  <br />
  <a href="?id=1&img"><img src="<? echo $res_produto['img2']; ?>" width="150" height="150" /></a>
  <img src="<? echo $res_produto['img3']; ?>" width="150" height="150" /></a>
  <img src="<? echo $res_produto['img4']; ?>" width="150" height="150" /></a>
  <img src="<? echo $res_produto['img5']; ?>" width="150" height="150" /></a>
 <h2 style="font:70px Arial, Helvetica, sans-serif; color:#F00; margin:0 0 0 250px; padding:10px; border-radius:20px; border:1px solid #000; width:500px; text-align:center;"><strong>R$ <? echo number_format($res_produto['valor_venda'],2,',','.'); ?></strong></h2>
 </div><!-- box_produto -->
<img src="http://www.ikuly.com/caixa/img/logo.png" width="1000" height="1" /> 
 <? echo $res_produto['descricao']; ?>
 
</div><!-- box -->
<? } ?>
</body>
</html>