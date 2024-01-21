<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/pedidos_da_loja_virtual.css" rel="stylesheet" type="text/css" />
</head>

<body>
<? require "topo.php";  require "scripts/verificador_caixa.php"; ?>

<div id="box_pagamento_1">
<h1><strong>COMPRAS REALIZADAS NA LOJA VIRTUAL</strong></h1>
<hr />
<?

$cliente = 0;
$sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM carrinho WHERE status = 'Ativo' AND ip = '$ip'");
	while($res_cliente = mysqli_fetch_array($sql_cliente)){
		$cliente = $res_cliente['cliente'];
} // fecha busca cliente

if($cliente == 0){
	echo "<script language='javascript'>window.alert('É NECESSÁRIO INFORMAR O CLIENTE, POR FAVOR, ENTRE NO CADASTRO DO CLIENTE E RETORNE!');window.location='carrinho.php';</script>";
}else{

$sql_carrinhos = mysqli_query($conexao_bd, "SELECT * FROM loja_online_carrinho WHERE cliente = '$cliente' ORDER BY id DESC");
if(mysqli_num_rows($sql_carrinhos) == ''){
	echo "<script language='javascript'>window.alert('CLIENTE AINDA NÃO TEM COMPRAS REALIZADAS EM NOSSA LOJA ONLINE!');window.location='carrinho.php';</script>";
}else{
 	
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
    	<a target="_blank" href="scripts/detalhe_loja_online.php?carrinho=<? echo $res_carrinho['code_carrinho']; ?>&cliente=<? echo $cliente; ?>&produto=<? echo $res_carrinho['id_produto']; ?>"><img src="img/detalhe_do_pedido.jpg" width="20" height="20" border="0" title="Detalhes do pedido" /></a>
        
        <? if($res_carrinho['status_pagamento'] == 'CANCELADO'){ ?>        
         <a target="_blank" href="scripts/solicitar_reembolso_de_pagamento.php?carrinho=<? echo $res_carrinho['code_carrinho']; ?>&cliente=<? echo $cliente; ?>&produto=<? echo $res_carrinho['id_produto']; ?>" width="20" height="20" title="SOLICITAR REEMBOLSO DE PAGAMENTO" /><img src="img/reembolso.png" width="20" height="20" /></a></td>
        <? } ?>

        <? if($res_carrinho['status_pagamento'] == 'PENDENTE'){ ?>
         <a href="alterar_informacoes_pagamento.php?carrinho=<? echo $res_carrinho['code_carrinho']; ?>&cliente=<? echo $cliente; ?>&produto=<? echo $res_carrinho['id_produto']; ?>"><img src="img/cartao_credito.png" width="20" height="20" border="0" title="Alterar dados de pagamento" /></a>
        <? } ?>

        <? if($res_carrinho['status_entrega'] == 'AGUARDA RETIRADA'){ ?>        
         <a rel="superbox[iframe][1050x600]" href="scripts/confirmar_recebimento_produto.php?pg=muda&carrinho=<? echo $res_carrinho['code_carrinho']; ?>&cliente=<? echo $cliente; ?>&produto=<? echo $res_carrinho['id_produto']; ?>"><img src="img/confirmar_entrega.jpg" width="30" height="20" border="0" title="Confirmar entrega do produto" /></a>
        <? } ?>
        
        <? if($res_carrinho['status_entrega'] == 'ENTREGUE'){ ?>        
        <img src="img/Garantia.fw.png" width="25" height="20" title="Acionar garantia do produto" /> 
        <? } ?>


        <? if($res_carrinho['status_entrega'] == 'ENTREGUE'){ ?>        
         <img src="img/troca-icon.png" width="20" height="20" title="Troca expressa" /> 
        <? } ?>
		
        <? if($res_carrinho['nota_fiscal'] != ''){ ?>        
         <a href="notas_fiscais/<? echo $res_carrinho['nota_fiscal']; ?>" target="_blank"><img src="img/baixar.png" width="20" height="20" border="0" title="BAIXAR NOTA FISCAL" /></a>
        <? } ?>


        <? if($res_carrinho['status'] == 'ENVIADO' && $res_carrinho['status_pagamento'] == 'AGUARDA CONFIRMACAO' && $res_carrinho['status_entrega'] == 'AGUADA PAGAMENTO'){ ?>
         <a href="?pg=cancela&carrinho=<? echo $res_carrinho['code_carrinho']; ?>"><img src="img/bloquea.png" width="20" height="20" border="0" title="Cancelar pagamento" /></a>
        <? } ?>
        

  </tr>
</table>
<? }}}} ?>
</div><!-- box_pagamento_1 -->
</body>
</html>
<? if($_GET['pg'] == 'cancela'){
 
 $carrinho = $_GET['carrinho'];
 
 mysqli_query($conexao_bd, "UPDATE loja_online_carrinho SET status = 'CANCELADO', status_pagamento = 'CANCELADO', status_entrega = 'CANCELADO' WHERE code_carrinho = '$carrinho'");
 
 mysqli_query($conexao_bd, "INSERT INTO loja_online_carrinho_cancelado (data, data_completa, dia, mes, ano, operador, carrinho) VALUES ('$data', '$data_completa', '$dia', '$mes', '$ano', '$operador', '$carrinho')");
 
 echo "<script language='javascript'>window.location='pedidos_da_loja_virtual.php';</script>";

}?>