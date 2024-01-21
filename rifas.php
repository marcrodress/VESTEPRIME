<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/rifas.css" rel="stylesheet" type="text/css" />
</head>

<body>
<? require "topo.php";  require "scripts/verificador_caixa.php"; ?>

<div id="box_pagamento_1">
<h1><strong>RIFAS</strong></h1>
<hr />


<? if($_GET['p'] == 'sortear'){ ?>
<? if($_GET['status'] == ''){ ?>
<h1 style="font:35px Arial, Helvetica, sans-serif; text-align:center; color:#06C; margin:0 0 0 10px;"><strong>Embaralhando os cupons da promoção: <? echo $_GET['nome_promocao']; ?></strong></h1>
<img style="margin:0 0 0 180px;" src="img/gif_carregando.gif" />

  <script type="text/javascript">
      function redirectTime(){
         window.location = "?p=sortear&status=eagora&code=<? echo $_GET['code']; ?>"
      }
   </script>
   <body onLoad="setTimeout('redirectTime()', 20000)">
<h1 style="font:50px Arial, Helvetica, sans-serif; color:#F90; margin:0 0 0 360px;"><strong>Aguarde...</strong></h1>
<? die;} ?>

<? if($_GET['status'] == 'eagora'){ ?>
<h1 style="font:40px Arial, Helvetica, sans-serif; color:#06C; margin:0 0 0 250px;"><strong>Cupons embaralhados</strong></h1>
<img style="margin:0 0 0 200px;" src="img/gif_carregando.gif" />

  <script type="text/javascript">
      function redirectTime(){
         window.location = "?p=sortear&status=ganhador&code=<? echo $_GET['code']; ?>"
      }
   </script>
   <body onLoad="setTimeout('redirectTime()', 8000)">
<h1 style="font:50px Arial, Helvetica, sans-serif; color:#F90; margin:0 0 0 400px;"><strong>É agora...</strong></h1>
<? die;} ?>

<? if($_GET['status'] == 'ganhador'){ ?>
<h1 style="font:40px Arial, Helvetica, sans-serif; color:#06C; margin:0 0 0 200px;"><strong>Eba! Achamos um ganhador...</strong></h1>
<img style="margin:0 0 0 350px;" src="img/ganhador.jpg" />
  <script type="text/javascript">
      function redirectTime(){
         window.location = "?p=sortear&status=dados_ganhador&code=<? echo $_GET['code']; ?>"
      }
   </script>
   <body onLoad="setTimeout('redirectTime()', 10000)">
<h1 style="font:50px Arial, Helvetica, sans-serif; text-align:center; color:#090; margin:0 0 0 50px;"><strong>Buscando informações do ganhador...</strong></h1>
<? die;} ?>





<? if($_GET['status'] == 'dados_ganhador'){ ?>
<h1 style="font:40px Arial, Helvetica, sans-serif; color:#06C; margin:0 0 0 230px;"><strong>Informações encontradas...</strong></h1>

<h2 style="border:2px solid #999; border-radius:20px; width:800px; color:#09C; margin:0 0 10px 80px; font:30px Arial, Helvetica, sans-serif; text-align:center;">
<?
$codigo_cupom = 0;
$nomecupom = 0;
$sql_cupom = mysqli_query($conexao_bd, "SELECT * FROM rifas_cupons WHERE status = 'Ativo' AND id_promocao = '".$_GET['code']."' ORDER BY rand() LIMIT 1");
	while($res_cupom = mysqli_fetch_array($sql_cupom)){
		$codigo_cupom = $res_cupom['code_cupom'];
		$nomecupom = $res_cupom['nome_completo'];
		$contato = $res_cupom['telefone'];
	}
	
	mysqli_query($conexao_bd, "UPDATE rifas SET status = 'ENCERRADA', contato = '$contato', ganhador = '$nomecupom', codigo_cupom = '$codigo_cupom', status_premio = 'AGUARDA' WHERE id = '".$_GET['code']."'");
	
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
   <body onLoad="setTimeout('redirectTime()', 55000)">
<? die; } ?>


<? }?>









<? if($tipo == 'ADM' && $_GET['p'] == ''){ ?>
<hr />
<? if(isset($_POST['cadastrar'])){

$titulo = $_POST['titulo'];
$imagem = $_POST['imagem'];
$inicio = $_POST['inicio'];
$fim = $_POST['fim'];
$custo = $_POST['custo'];
$valor = $_POST['valor'];

$code = rand()+($dia*$mes)+$dia+$mes+$ano;

mysqli_query($conexao_bd, "INSERT INTO rifas (data, code, status, titulo, imagem, inicio, fim, custo, valor, ganhador, codigo_cupom, status_premio, contato) VALUES ('$data', '$code', 'ATIVO', '$titulo', '$imagem', '$inicio', '$fim', '$custo', '$valor', '', '', '', '')");

echo "<script language='javascript'>window.alert('Promoção cadastrada com sucesso!!!');</script>";


}?>

<form name="" method="post" action="" enctype="multipart/form-data">
<table width="990" border="0">
  <tr>
    <td width="129" bgcolor="#CCCCCC"><strong>Titulo</strong></td>
    <td width="384" bgcolor="#CCCCCC"><strong>Imagem</strong></td>
    <td width="125" bgcolor="#CCCCCC"><strong>Data de inicio</strong></td>
    <td width="128" bgcolor="#CCCCCC"><strong>Data sorteio</strong></td>
    <td width="47" bgcolor="#CCCCCC"><strong>Custo</strong></td>
    <td width="48" bgcolor="#CCCCCC"><strong>Valor</strong></td>
    <td width="91" colspan="2" rowspan="2" bgcolor="#CCCCCC"><input style="font:12px Arial, Helvetica, sans-serif; padding:5px; background:#F90; margin:5px;" type="submit" name="cadastrar" id="cadastrar" value="Cadastrar"></td>
  </tr>
  <tr>
    <td><label for="titulo"></label>
    <input name="titulo" type="text" id="titulo" size="15"></td>
    <td><label for="imagem">
      <input name="imagem" type="text" id="imagem" size="15" />
    </label></td>
    <td><label for="inicio"></label>
      <span id="sprytextfield1">
      <input name="inicio" type="text" id="inicio" size="7" />
      <span class="textfieldRequiredMsg"></span><span class="textfieldInvalidFormatMsg"></span></span></td>
    <td><label for="fim"></label>
      <span id="sprytextfield2">
      <input name="fim" type="text" id="fim" size="7" />
      <span class="textfieldRequiredMsg"></span><span class="textfieldInvalidFormatMsg"></span></span></td>
    <td><label for="custo"></label>
      <input name="custo" type="text" id="custo" size="5"></td>
    <td><input name="valor" type="text" id="valor" size="5" /></td>
    </tr>
</table>
</form>
<? } ?>

<table width="990" border="1">
<?
$sql_sorteio = mysqli_query($conexao_bd, "SELECT * FROM rifas WHERE status != 'DELETADO' ORDER BY id DESC");
while($res_sorteio = mysqli_fetch_array($sql_sorteio)){
?> 
  <tr>
    <td width="64" rowspan="2"><label for="textfield"><img src="<? echo $res_sorteio['imagem']; ?>" width="50" height="50"></label></td>
    <td width="247" rowspan="2"><h3><? echo $res_sorteio['titulo']; ?></h3></td>
    <td width="73" bgcolor="#0099FF"><strong>Valor</strong></td>
    <td width="70" bgcolor="#0099FF"><strong>Inicio</strong></td>
    <td width="77" bgcolor="#0099FF"><strong>Sorteio</strong></td>
    <td width="84" bgcolor="#0099FF"><? if($tipo == 'ADM'){ ?><strong>N° Cupons</strong><? } ?></td>
    <td width="75" bgcolor="#0099FF"><? if($tipo == 'ADM'){ ?><strong>Custo</strong><? } ?></td>
    <td width="87" bgcolor="#0099FF"><? if($tipo == 'ADM'){ ?><strong>Faturamento</strong><? } ?></td>
    <td width="67" bgcolor="#0099FF"><? if($tipo == 'ADM'){ ?><strong>Lucro</strong><? } ?></td>
    <td width="82" bgcolor="#0099FF">&nbsp;</td>
  </tr> 
  <tr>
    <td>R$ <? echo number_format($res_sorteio['valor'],2,',',''); ?></td>
    <td><? echo $res_sorteio['inicio']; ?></td>
    <td><? echo $res_sorteio['fim']; ?></td>
    <td><? if($tipo == 'ADM'){ echo $bilhete_emitidos = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM rifas_cupons WHERE id_promocao = '".$res_sorteio['id']."' AND status = 'Ativo'")); }?></td>
    <td>R$ <? if($tipo == 'ADM'){ echo number_format($res_sorteio['custo'],2,',',''); }?></td>
    <td>R$ <? if($tipo == 'ADM'){ $faturamento = $bilhete_emitidos*$res_sorteio['valor']; echo number_format($faturamento,2,',',''); }?></td>
    <td>R$ <? if($tipo == 'ADM'){ echo number_format($faturamento-$res_sorteio['custo'],2,',',''); }?></td>
    <td>
    	<script language="javascript">
		function abrePopUps(urlImagem){
			window.open(urlImagem,'Foto_Ampliada','top=150,left=500,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=360,height=460');
		}
	</script>
    	<? if($res_sorteio['status'] == 'ATIVO'){ ?><a onclick="abrePopUps('scripts/cupom_rifa.php?id=<? echo $res_sorteio['id']; ?>');" href="?p="><img src="img/azul.webp" width="40" height="30" border="0" /></a> <? } ?>
        
		<? if($tipo == 'ADM'){ ?>
        <? if($res_sorteio['status'] == 'ATIVO'){ ?><a href="?p=sortear&nome_promocao=<? echo $res_sorteio['titulo']; ?>&code=<? echo $res_sorteio['id']; ?>"><img src="img/sortear.jpg" width="40" height="40" border="0" title="REALIZAR SORTEIO" /></a><? } ?>
        <? if($bilhete_emitidos <=0){ ?><a href="?p=2&acao=DELETADO&id=<? echo $res_sorteio['id']; ?>"><img src="img/deleta.jpg" width="20" height="20" border="0" title="Deletar sorteio" /></a><? } ?>
        <? if($res_sorteio['status'] == 'ATIVO'){ ?><a href="?p=2&acao=INATIVO&id=<? echo $res_sorteio['id']; ?>"><img src="img/bloquea.png" width="20" height="20" border="0" title="Inativar sorteio" /></a><? } ?>
        <? if($res_sorteio['status'] == 'INATIVO'){ ?><a href="?p=2&acao=ATIVO&id=<? echo $res_sorteio['id']; ?>"><img src="img/correto.jpg" width="20" height="20" border="0" title="Ativar sorteio" /></a><? } ?>
        
        <? } ?>
   
        
	 <? if($res_sorteio['status_premio'] == 'AGUARDA'){ ?>     
     <a href="?p=entregar&codigo_promocao=<? echo $res_sorteio['id']; ?>"><img src="img/entregar.jpg" width="40" height="40" border="0" title="Informar que o produto foi entregue" /></a>
     <? } ?>
   
   	<? echo $res_sorteio['status_premio']; ?>
        
   </td>
  </tr>
<? } ?>
</table>



</div><!-- box_pagamento_1 -->

</body>
</html>
<? if($_GET['p'] == 'entregar'){

mysqli_query($conexao_bd, "UPDATE rifas SET status_premio = 'ENTREGUE' WHERE id = '".$_GET['codigo_promocao']."'");
echo "<script language='javascript'>window.location='?p=';</script>";
}?>


<? if($_GET['p'] == '2'){

$acao = $_GET['acao'];
$id = $_GET['id'];

mysqli_query($conexao_bd, "UPDATE rifas SET status = '$acao' WHERE id = '$id'");
echo "<script language='javascript'>window.location='?p=';</script>";

}?>