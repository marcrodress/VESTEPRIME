<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/relatorio_de_boletos.css" rel="stylesheet" type="text/css" />
</head>

<body>
<? require "../conexao.php"; ?>

<div id="box_pagamento_1">
<h1><strong>LISTA DE BOLETOS QUE AGUARDAM SER EFETIVADOS</strong></h1>
 <?
 $sql_boleto = mysqli_query($conexao_bd, "SELECT * FROM pagamento_boletos WHERE status = 'Aguarda'");
 if(mysqli_num_rows($sql_boleto) == ''){
 }else{
 ?>
<table width="1000" border="0">
  <tr>
    <td width="70"><strong>CONVÊNIO</strong></td>
    <td width="80"><strong>BENEFICIÁRIO</strong></td>
    <td width="200"><strong>CÓDIGO DE BARRAS</strong></td>
    <td width="50"><strong>VALOR</strong></td>
    <td width="50"><strong>JUROS</strong></td>
    <td width="100"><strong>FORM. PAGT</strong></td>
    <td width="50"><strong>TARIFA</strong></td>
    <td width="100"><strong>VENCIMENTO</strong></td>
    <td width="70"><strong>CLIENTE</strong></td>
    <td width="70"><strong>TELEFONE</strong></td>
    </tr>
  <?
  $i = 0; $total = 0;
   while($res_boleto = mysqli_fetch_array($sql_boleto)){ $i++; 
   
   	if($res_boleto['confirma_boleto_vencido'] == 'SIM' || $res_boleto['vencimento'] == $data || $res_boleto['boleto_vencido'] > 0){
   
   ?>
  <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
    <td><? echo $res_boleto['tipo']; ?></td>
    <td>
	<?
	if($res_boleto['tipo'] == 'CONVENIO'){
		echo $res_boleto['banco'];
	}else{
    $banco = $res_boleto['banco'];
	
	$sql_banco = mysqli_query($conexao_bd, "SELECT * FROM lista_bancos WHERE codigo = '$banco'");
		while($res_banco = mysqli_fetch_array($sql_banco)){
				echo $banco2 = $res_banco['nome_banco'];
	  }
	}
	?>	
    </td>
    <td><? echo $res_boleto['code_barras']; ?></td>
    <td><? $total = $res_boleto['valor']+$total; echo number_format($res_boleto['valor'], 2, ',', '.'); ?></td>
    <td><? echo $res_boleto['juros']; ?></td>
    <td><? echo $res_boleto['forma_pagamento']; ?></td>
    <td><? echo @$res_boleto['tarifa']; ?></td>
    <td><? echo $res_boleto['vencimento']; ?></td>
    <td><a rel="superbox[iframe][300x70]" href="LOJA/sistema/scripts/mostrar_cliente.php?cliente=<? echo $res_boleto['cliente']; ?>"><? echo $res_boleto['cliente']; ?></a></td>
    <td><? echo $res_boleto['telefone']; ?></td>
    </tr>
  <? }} ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right"><strong>VALOR</strong></td>
    <td><? echo number_format($total, 2, ',', '.'); ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  </table>
<? } ?>
<hr />
 <?
 $sql_boleto = mysqli_query($conexao_bd, "SELECT * FROM pagamento_boletos WHERE status = 'Aguarda' AND vencimento != '$data' AND confirma_boleto_vencido != 'SIM' ORDER BY id ASC");
 if(mysqli_num_rows($sql_boleto) == ''){
 }else{
 ?>
<table width="1000" border="0">
  <tr>
    <td width="70"><strong>CONVÊNIO</strong></td>
    <td width="80"><strong>BENEFICIÁRIO</strong></td>
    <td width="200"><strong>CÓDIGO DE BARRAS</strong></td>
    <td width="50"><strong>VALOR</strong></td>
    <td width="50"><strong>JUROS</strong></td>
    <td width="100"><strong>FORM. PAGT</strong></td>
    <td width="50"><strong>TARIFA</strong></td>
    <td width="100"><strong>VENCIMENTO</strong></td>
    <td width="70"><strong>CLIENTE</strong></td>
    <td width="70"><strong>TELEFONE</strong></td>
    </tr>
  <?
  $i = 0; $total = 0;
   while($res_boleto = mysqli_fetch_array($sql_boleto)){ $i++; ?>
  <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
    <td><? echo $res_boleto['tipo']; ?></td>
    <td>
	<?
	if($res_boleto['tipo'] == 'CONVENIO'){
		echo $res_boleto['banco'];
	}else{
    $banco = $res_boleto['banco'];
	
	$sql_banco = mysqli_query($conexao_bd, "SELECT * FROM lista_bancos WHERE codigo = '$banco'");
		while($res_banco = mysqli_fetch_array($sql_banco)){
				echo $banco2 = $res_banco['nome_banco'];
	  }
	}
	?>	
    </td>
    <td><? echo $res_boleto['code_barras']; ?></td>
    <td><? $total = $res_boleto['valor']+$total; echo number_format($res_boleto['valor'], 2, ',', '.'); ?></td>
    <td><? echo $res_boleto['juros']; ?></td>
    <td><? echo $res_boleto['forma_pagamento']; ?></td>
    <td><? echo @$res_boleto['tarifa']; ?></td>
    <td><? echo $res_boleto['vencimento']; ?></td>
    <td><a rel="superbox[iframe][300x70]" href="LOJA/sistema/scripts/mostrar_cliente.php?cliente=<? echo $res_boleto['cliente']; ?>"><? echo $res_boleto['cliente']; ?></a></td>
    <td><? echo $res_boleto['telefone']; ?></td>
    </tr>
  <? } ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right"><strong>VALOR</strong></td>
    <td><? echo number_format($total, 2, ',', '.'); ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  </table>
<? } ?>

</div><!-- box_pagamento_1 -->
</body>
</html>