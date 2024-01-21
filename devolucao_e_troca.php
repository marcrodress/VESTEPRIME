<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/devolucao_e_troca.css" rel="stylesheet" type="text/css" />
</head>

<body>
<? require "topo.php";  require "scripts/verificador_caixa.php"; ?>

<div id="box_deposito">
<h1><strong>TROCA DE PRODUTO</strong></h1>
<hr />
<form name="" method="post" action="" enctype="multipart/form-data">
  <span id="sprytextfield1">
  <h2 style="font:12px Arial, Helvetica, sans-serif; margin:10px 0 0 10px;"><strong>Digite o número do carrinho</strong></h2>
  <input style="font:12px Arial, Helvetica, sans-serif; width:150px; margin:5px; height:30px; color:#F00; margin:10px 0 5px 10px;" type="text" name="input" />
  </span>
  <input style="font:12px Arial, Helvetica, sans-serif; width:60px; padding:5px; margin:5px; height:40px; color:#F00; margin:0 0 0 10px;" type="submit" name="Enviar" value="Buscar" />
</form> 

</div><!-- box_deposito -->
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {hint:"Digite o n\xFAmero do carrinho"});
</script>
</body>
</html>