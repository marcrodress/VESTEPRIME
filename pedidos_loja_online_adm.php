<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/pedidos_loja_online_adm.css" rel="stylesheet" type="text/css" />
</head>

<body>
<? require "topo.php";  require "scripts/verificador_caixa.php"; ?>

<div id="box_pagamento_1">
<h1><strong>ADMINISTRAÇÃO DOS PEDIDOS DA LOJA ONLINE</strong></h1>
<hr />
<strong style="font:12px Arial, Helvetica, sans-serif; margin:5px; text-align:center;"><strong>Digite o número do pedido:</strong></strong>
<form name="" method="get" action="" enctype="multipart/form-data">
 <input style="border:2px solid #000; padding:10px; text-align:center; margin:5px; font:18px Arial, Helvetica, sans-serif; color:#999; border-radius:5px;" type="text" name="pedido" /> 
 <input style="border:2px solid #000; padding:10px; margin:5px; font:18px Arial, Helvetica, sans-serif; color:#999; border-radius:5px;" type="submit" name="" value="Buscar" />
</form>
<hr />
<?

$pedido = $_GET['pedido'];
if($pedido == ''){
$sql_carrinhos = mysqli_query($conexao_bd, "SELECT * FROM loja_online_carrinho ORDER BY id DESC");
}else{
$sql_carrinhos = mysqli_query($conexao_bd, "SELECT * FROM loja_online_carrinho WHERE code_carrinho = '$pedido' ORDER BY id DESC");
}
 	
	while($res_carrinho = mysqli_fetch_array($sql_carrinhos)){
  	 
	 $sql_produtos = mysqli_query($conexao_bd, "SELECT * FROM loja_online_produto WHERE id = '".$res_carrinho['id_produto']."'");
 	  
	   while($res_produto = mysqli_fetch_array($sql_produtos)){ $i++;
?>
<table width="990" border="0" <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
  <tr>
    <td width="87" rowspan="3"><img src="<? echo $res_produto['img']; ?>" width="85" height="69"></td>
    <td colspan="8"><h1 style="font:15px Arial, Helvetica, sans-serif; color:#999; margin:0; padding:0;"><strong style="font:10px Arial, Helvetica, sans-serif;">COD. PEDIDO:<? echo $res_produto['id']; ?></strong> - <strong><? echo $res_produto['titulo']; ?></strong></h1></td>
  </tr>
  <tr>
    <td width="77" bgcolor="#CCCCCC"><strong>COD. PEDIDO</strong></td>
    <td width="68" bgcolor="#CCCCCC"><strong>DATA</strong></td>
    <td width="43" bgcolor="#CCCCCC"><strong>QUANT.</strong></td>
    <td width="71" bgcolor="#CCCCCC"><strong>VL.UNIT.</strong></td>
    <td width="88" bgcolor="#CCCCCC"><strong>VL.TOTAL</strong></td>
    <td width="169" bgcolor="#CCCCCC"><strong>FORMA DE PAGAMENTO</strong></td>
    <td width="164" bgcolor="#CCCCCC"><strong>STATUS DA ENTREGA</strong></td>
    <td width="179" bgcolor="#CCCCCC"><strong>AÇÕES</strong></td>
  </tr>
  <tr>
    <td><? echo $res_carrinho['code_carrinho']; ?></td>
    <td><? echo $res_carrinho['data']; ?></td>
    <td><? echo $res_carrinho['quantidade']; ?></td>
    <td>R$ <? echo number_format($res_carrinho['valor_unitario'],2,',','.'); ?></td>
    <td>R$ <? echo number_format($res_carrinho['valor_total'],2,',','.'); ?></td>
    <td><? echo $res_carrinho['status_pagamento']; ?></td>
    <td><? echo $res_carrinho['status_entrega']; ?></td>
    <td>
    	<a target="_blank" href="scripts/detalhe_loja_online.php?carrinho=<? echo $res_carrinho['code_carrinho']; ?>&cliente=<? echo $res_carrinho['cliente']; ?>&produto=<? echo $res_carrinho['id_produto']; ?>"><img src="img/detalhe_do_pedido.jpg" width="20" height="20" border="0" title="Detalhes do pedido" /></a>
        
        
        <a href="<? echo $res_produto['fornecedor']; ?>" target="_blank"><img src="img/loja-virtual1.png" width="20" height="20" border="0" title="SITE DA LOJA PARCEIRA" /></a>
        
        <? if($res_carrinho['status_pagamento'] == 'AGUARDA CONFIRMACAO'){ ?>       
		<a target="_blank" rel="superbox[iframe][970x420]" href="scripts/verificar_pagamento_loja_online.php?carrinho=<? echo $res_carrinho['code_carrinho']; ?>&cliente=<? echo $res_carrinho['cliente']; ?>&produto=<? echo $res_carrinho['id_produto']; ?>"><img src="img/simbolo_dinheiro.png" width="20" height="20" border="0" title="VERIFICAR PAGAMENTO" /></a>
        <? } ?>

        
        <? if($res_carrinho['status_pagamento'] == 'APROVADO'){ ?>
        <a target="_blank" rel="superbox[iframe][960x350]" href="scripts/postar_nota_fiscal.php?carrinho=<? echo $res_carrinho['code_carrinho']; ?>&cliente=<? echo $res_carrinho['cliente']; ?>&produto=<? echo $res_carrinho['id_produto']; ?>"><img src="img/baixar.png" width="20" height="20" border="0" title="SUBIR NOTA FISCAL" /></a>
        <? } ?>
        
                

        <? if($res_carrinho['status_pagamento'] == 'PENDENTE'){ ?>
         <a href="alterar_informacoes_pagamento.php?carrinho=<? echo $res_carrinho['code_carrinho']; ?>&cliente=<? echo $res_carrinho['cliente']; ?>&produto=<? echo $res_carrinho['id_produto']; ?>"><img src="img/cartao_credito.png" width="20" height="20" border="0" title="Alterar dados de pagamento" /></a>
        <? } ?>

        <? if($res_carrinho['status_pagamento'] == 'APROVADO'){ ?>
        <a rel="superbox[iframe][960x250]" href="scripts/informar_produto_aguardando_retirada.php?pg=muda&carrinho=<? echo $res_carrinho['code_carrinho']; ?>&cliente=<? echo $res_carrinho['cliente']; ?>&produto=<? echo $res_carrinho['id_produto']; ?>"><img src="img/confirmar_entrega.jpg" width="30" height="20" border="0" title="Informar que o produto está aguardando retirada!" /></a>
        <? } ?>



      
      </td>
  </tr>
</table>
<? }} ?>
</div><!-- box_pagamento_1 -->
</body>
</html>
<? if($_GET['pg'] == 'cancela'){
 
 $carrinho = $_GET['carrinho'];
 
 mysqli_query($conexao_bd, "UPDATE loja_online_carrinho SET status = 'CANCELADO', status_pagamento = 'CANCELADO', status_entrega = 'CANCELADO' WHERE code_carrinho = '$carrinho'");
 
 mysqli_query($conexao_bd, "INSERT INTO loja_online_carrinho_cancelado (data, data_completa, dia, mes, ano, operador, carrinho) VALUES ('$data', '$data_completa', '$dia', '$mes', '$ano', '$operador', '$carrinho')");
 
 echo "<script language='javascript'>window.location='pedidos_da_loja_virtual.php';</script>";

}?>