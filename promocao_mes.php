<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/promocao_mes.css" rel="stylesheet" type="text/css" />
</head>

<body>
<? require "topo.php";  require "scripts/verificador_caixa.php"; ?>
<div id="box_pagamento_1">
<h1><strong>Promoção do mês</strong></h1>
<? if($_GET['p'] == ''){ ?>
 <? if($tipo == 'ADM'){ ?>
<form name="" method="post" action="" enctype="multipart/form-data">
<h1 style="font:12px Arial, Helvetica, sans-serif;"> <strong>Titulo:
 <input type="text" size="70" name="titulo"/>
 Imagem:
 <input type="text" name="img" />
 Data da promoção
 <input type="text" name="data" /></strong>
 <input type="submit" name="enviar" value="Cadastrar" />
 </h1>
</form>
<? if(isset($_POST['enviar'])){

$titulo = $_POST['titulo'];
$img = $_POST['img'];
$data_promocao = $_POST['data'];

$codigo_promocao = rand()+date("s")+date("d");

mysqli_query($conexao_bd, "INSERT INTO promocao_cupom (status, codigo_promocao, titulo, img, data_promocao, ganhador, codigo_cupom, status_premio) VALUES ('ATIVO', '$codigo_promocao', '$titulo', '$img', '$data_promocao', '', '', '')");

echo "<script language='javascript'>window.location='?p=';</script>";

}?>


<? }} ?>
<hr />



<? if($_GET['p'] == 'sortear'){ ?>
<? if($_GET['status'] == ''){ ?>
<h1 style="font:40px Arial, Helvetica, sans-serif; color:#06C; margin:0 0 0 70px;"><strong>Embaralhando os cupons da promoção: <? echo $_GET['code']; ?></strong></h1>
<img style="margin:0 0 0 200px;" src="img/gif_carregando.gif" />

  <script type="text/javascript">
      function redirectTime(){
         window.location = "?p=sortear&status=eagora&code=<? echo $_GET['code']; ?>"
      }
   </script>
   <body onLoad="setTimeout('redirectTime()', 20000)">
<h1 style="font:50px Arial, Helvetica, sans-serif; color:#F90; margin:0 0 0 420px;"><strong>Aguarde...</strong></h1>
<? die;} ?>

<? if($_GET['status'] == 'eagora'){ ?>
<h1 style="font:40px Arial, Helvetica, sans-serif; color:#06C; margin:0 0 0 300px;"><strong>Cupons embaralhados</strong></h1>
<img style="margin:0 0 0 200px;" src="img/gif_carregando.gif" />

  <script type="text/javascript">
      function redirectTime(){
         window.location = "?p=sortear&status=ganhador&code=<? echo $_GET['code']; ?>"
      }
   </script>
   <body onLoad="setTimeout('redirectTime()', 8000)">
<h1 style="font:50px Arial, Helvetica, sans-serif; color:#F90; margin:0 0 0 420px;"><strong>É agora...</strong></h1>
<? die;} ?>

<? if($_GET['status'] == 'ganhador'){ ?>
<h1 style="font:40px Arial, Helvetica, sans-serif; color:#06C; margin:0 0 0 230px;"><strong>Eba! Achamos um ganhador...</strong></h1>
<img style="margin:0 0 0 350px;" src="img/ganhador.jpg" />
  <script type="text/javascript">
      function redirectTime(){
         window.location = "?p=sortear&status=dados_ganhador&code=<? echo $_GET['code']; ?>"
      }
   </script>
   <body onLoad="setTimeout('redirectTime()', 10000)">
<h1 style="font:50px Arial, Helvetica, sans-serif; color:#090; margin:0 0 0 50px;"><strong>Buscando informações do ganhador...</strong></h1>
<? die;} ?>





<? if($_GET['status'] == 'dados_ganhador'){ ?>
<h1 style="font:40px Arial, Helvetica, sans-serif; color:#06C; margin:0 0 0 230px;"><strong>Informações encontradas...</strong></h1>

<h2 style="border:2px solid #999; border-radius:20px; width:800px; color:#09C; margin:0 0 10px 80px; font:30px Arial, Helvetica, sans-serif; text-align:center;">
<?
$codigo_cupom = 0;
$nomecupom = 0;
$sql_cupom = mysqli_query($conexao_bd, "SELECT * FROM promocao_cupom_gerador WHERE status = 'Ativo' AND codigo_promocao = '".$_GET['code']."' ORDER BY rand() LIMIT 1");
	while($res_cupom = mysqli_fetch_array($sql_cupom)){
		$codigo_cupom = $res_cupom['codigo_cupom'];
		$nomecupom = $res_cupom['nome'];
	}
	
	mysqli_query($conexao_bd, "UPDATE promocao_cupom SET status = 'ENCERRADA', ganhador = '$nomecupom', codigo_cupom = '$codigo_cupom', status_premio = 'AGUARDA' WHERE codigo_promocao = '".$_GET['code']."'");
	
?>
<strong style="color:#090;">Cupom sorteado:</strong> <br /><? echo $codigo_cupom; ?><br />
<strong  style="color:#090;">Nome do ganhador:</strong><br /><? echo $nomecupom; ?>
</h2>
<img style="margin:0 0 0 350px;" src="img/parabens_premio.gif" />
  <script type="text/javascript">
      function redirectTime(){
         window.location = "?p="
      }
   </script>
   <body onLoad="setTimeout('redirectTime()', 25000)">
<? die; } ?>


<? }?>





<table width="1000" border="0">
<?
$i = 0;
$sql_promocao = mysqli_query($conexao_bd, "SELECT * FROM promocao_cupom ORDER BY id DESC");
 while($res_promocao = mysqli_fetch_array($sql_promocao)){ $i++;
?>
    <td width="94" rowspan="2"><img src="<? echo $res_promocao['img']; ?>" width="92" height="80" /></td>
    <td width="57" bgcolor="#CCCCCC"><strong>COD. </strong></td>
    <td width="166" bgcolor="#CCCCCC"><strong>TITULO</strong></td>
    <td width="99" bgcolor="#CCCCCC"><strong>DATA SORTEIO</strong></td>
    <td width="109" bgcolor="#CCCCCC"><strong>QUANT. CUPOM</strong></td>
    <td width="97" bgcolor="#CCCCCC"><strong>CUPONS APTOS</strong></td>
    <td width="147" bgcolor="#CCCCCC"><strong>GANHADOR</strong></td>
    <td width="100" bgcolor="#CCCCCC"><strong>STATUS PR&Ecirc;MIO</strong></td>
    <td width="93" bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
  <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
    <td><? echo $res_promocao['codigo_promocao']; ?></td>
    <td><? echo $res_promocao['titulo']; ?></td>
    <td><? echo $res_promocao['data_promocao']; ?></td>
    <td><? echo $promocao_cupom_gerador = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM promocao_cupom_gerador WHERE codigo_promocao = '".$res_promocao['codigo_promocao']."'")); ?></td>
    <td><? echo $promocao_cupom_gerador_ativo = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM promocao_cupom_gerador WHERE codigo_promocao = '".$res_promocao['codigo_promocao']."' AND status = 'Ativo'"));
		
		echo "<br>---<br>";
		echo number_format(($promocao_cupom_gerador_ativo*100)/$promocao_cupom_gerador,1);
		echo "%";
	
	 ?></td>
    <td><? echo $res_promocao['codigo_cupom']; ?><br /> <? echo $res_promocao['ganhador']; ?></td>
    <td><? echo $res_promocao['status_premio']; ?></td>
    <td>
    
	 <? if($res_promocao['status'] == 'ATIVO'){ ?>
	 <a rel="superbox[iframe][350x100]" href="scripts/gerar_cupom_avulso.php?codigo_promocao=<? echo $res_promocao['codigo_promocao']; ?>"><img src="img/troca-icon.png" width="40" height="40" border="0" title="Emitir cupons avulsos" /></a>
     
      <? if($tipo == 'ADM'){ ?>
     <a href="?p=sortear&code=<? echo $res_promocao['codigo_promocao']; ?>"><img src="img/sortear.jpg" width="40" height="40" border="0" title="Realizar sorteio da promoção" /></a>
     <? } ?>
     
     
     <? } ?>

	 <? if($res_promocao['status'] == 'ENCERRADA'){ ?>
     <a rel="superbox[iframe][400x200]" href="scripts/mostrar_ganhador_promocao_mes.php?codigo_promocao=<? echo $res_promocao['codigo_promocao']; ?>&codigo_cupom=<? echo $res_promocao['codigo_cupom']; ?>"><img src="img/ganhador.jpg" width="40" height="40" border="0" title="Buscar informações do ganhador" /></a>
     <? } ?>
     
     
	 <? if($res_promocao['status_premio'] == 'AGUARDA'){ ?>     
     <a href="?p=entregar&codigo_promocao=<? echo $res_promocao['codigo_promocao']; ?>"><img src="img/entregar.jpg" width="40" height="40" border="0" title="Informar que o produto foi entregue" /></a>
     <? } ?>
     
     
      </td>
  </tr>
<? } ?>
</table>

<? if($_GET['p'] == 'entregar'){

mysqli_query($conexao_bd, "UPDATE promocao_cupom SET status_premio = 'ENTREGUE' WHERE codigo_promocao = '".$_GET['codigo_promocao']."'");
echo "<script language='javascript'>window.location='?p=';</script>";
}?>

</div><!-- box_pagamento_1 -->
</body>
</html>