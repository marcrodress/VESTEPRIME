<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/topo.css" rel="stylesheet" type="text/css" />
<? require "conexao.php"; ?>
</head>

<body>
<div id="box_topo">
 
 <img src="http://www.ikuly.com/caixa/img/logo.png" width="300" height="150" />
 
 <div id="menu_topo">
  <ul>
  <? 
   
   $sql_menu = mysqli_query($conexao_bd, "SELECT * FROM loja_online_categorias");
   	while($res_menu = mysqli_fetch_array($sql_menu)){
  ?>
   <li><a href="index.php?p=<? echo $res_menu['cod']; ?>"><? echo $res_menu['categoria']; ?></a></li>
  <? } ?>
  </ul>
 </div><!-- menu_topo -->
 
</div><!-- box_topo -->
</body>
</html>