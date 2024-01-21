<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/trocar_produto.css" rel="stylesheet" type="text/css" />
</head>

<body>
<? require "topo.php";  require "scripts/verificador_caixa.php"; ?>

<div id="box_pagamento_1">
<? if($_GET['p'] == ''){ ?>
<h1><strong>FAZER TROCA DE PRODUTO</strong></h1>
<hr />
<form name="" method="post" action="" enctype="multipart/form-data">
<table width="998" border="0">
  <tr>
    <td width="173" bgcolor="#D9FFEC"><strong>Digite o número do carrinho</strong></td>
    <td align="left" width="807" bgcolor="#D9FFEC"><label for="textfield"></label>
    <input name="n_carrinho" type="text" id="textfield" size="30">
    <input type="submit" name="button" id="button" value="Enviar"></td>
  </tr>
</table>
</form>
<hr />
<? if(isset($_POST['button'])){
$n_carrinho = $_POST['n_carrinho'];
if($n_carrinho == ''){
	echo "<em> Por favor, digite o número do carrinho!</em><hr>";
}else{
 $sql_numero = mysqli_query($conexao_bd, "SELECT * FROM carrinho WHERE code_carrinho = '$n_carrinho' AND status	= 'Encerrado'");
  if(mysqli_num_rows($sql_numero) == ''){
	echo "<em>Carrinho não encontrado, por favor, verifique o número da NOTA!</em><hr>";
  }else{
	echo "<script language='javascript'>window.location='?acao=mostra_carrinho&carrinho=$n_carrinho';</script>";
  }
 }
}?>



<? if($_GET['p'] == ''){ ?>
<table width="998" border="0">
  <tr>
    <td width="136" bgcolor="#00CC99"><strong>COD. CARRINHO</strong></td>
    <td width="98" bgcolor="#00CC99"><strong>PRODUTOS</strong></td>
    <td width="95" bgcolor="#00CC99"><strong>STATUS</strong></td>
    <td width="176" bgcolor="#00CC99"><strong>DATA</strong></td>
    <td width="316" bgcolor="#00CC99"><strong>CLIENTE</strong></td>
    <td width="99" bgcolor="#00CC99"><strong>OPERADOR</strong></td>
    <td width="54" bgcolor="#00CC99">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>
    	<script language="javascript">
		function abrePopUp(urlImagem){
			window.open(urlImagem,'Foto_Ampliada','top=150,left=500,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=330,height=400');
		}
	</script>    
    <a onclick="abrePopUp('scripts/comprovante_troca.php?code_carrinho=<? echo $_GET['carrinho']; ?>');" href=""><img src="img/troca.png" width="25" height="25" title="Emitir comprovante de troca de produto" /></a>
    <img src="img/reembolso.png" width="21" height="21" title="Fazer reembolso de valores" />
    </td>
  </tr>
  <tr>
    <td colspan="7"><table width="998" border="0">
      <tr>
        <td width="102" bgcolor="#CCCCCC"><strong>DATA</strong></td>
        <td width="63" bgcolor="#CCCCCC"><strong>STATUS</strong></td>
        <td width="101" bgcolor="#CCCCCC"><strong>TIPO</strong></td>
        <td width="67" bgcolor="#CCCCCC"><strong>QUANT.</strong></td>
        <td width="93" bgcolor="#CCCCCC"><strong>COD.</strong></td>
        <td width="361" bgcolor="#CCCCCC"><strong>PRODUTO</strong></td>
        <td width="69" bgcolor="#CCCCCC"><strong>VALOR</strong></td>
        <td width="108" bgcolor="#CCCCCC"><strong>DESCONTO</strong></td>
        </tr>
     <?
	 $produtos_caixa = mysqli_query($conexao_bd, "SELECT * FROM produtos_caixa WHERE code_carrinho = '".$_GET['carrinho']."'");
	 while($res_caixa = mysqli_fetch_array($produtos_caixa)){
	 ?>
      <tr>
        <td><? echo $res_caixa['data']; ?></td>
        <td><? echo $res_caixa['status']; ?></td>
        <td><? echo $res_caixa['tipo']; ?></td>
        <td><? echo $res_caixa['quant']; ?></td>
        <td><? echo $res_caixa['code_produto']; ?></td>
        <td><? 
		$sql_produto = mysqli_query($conexao_bd, "SELECT * FROM produtos WHERE code = '".$res_caixa['code_produto']."'");
		while($res_produto = mysqli_fetch_array($sql_produto)){
			echo $res_produto['titulo'];
		}
		?></td>
        <td><? echo $res_caixa['valor']; ?></td>
        <td><? echo $res_caixa['desconto']; ?>
          <script language="javascript">
		function abrePopUp(urlImagem){
			window.open(urlImagem,'Foto_Ampliada','top=150,left=500,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=330,height=400');
		}
		</script></td>
        </tr>
      <? } ?>
    </table></td>
  </tr>
</table>
<? } ?>






<? } ?>
</div><!-- box_pagamento_1 -->
</body>
</html>