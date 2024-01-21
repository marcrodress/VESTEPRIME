<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/resultado_emprestimo_carne.css" rel="stylesheet" type="text/css" />
</head>

<body>
<? require "topo.php";  require "scripts/verificador_caixa.php"; ?>
<div id="box_pagamento_1">
<h1 style="font:15px Arial, Helvetica, sans-serif; margin:10px;"><strong>PROPOSTAS DE EMPRÉSTIMO NO CARNÊ</strong></h1>
<hr />
<?
$cpf_cliente = 0;

$sql_carrinho = mysqli_query($conexao_bd, "SELECT * FROM carrinho WHERE ip = '$ip' AND status = 'Ativo' AND cliente != ''");
 if(mysqli_num_rows($sql_carrinho) == ''){
	echo "<script language='javascript'>window.alert('INFORME O CLIENTE PARA CONTINUAR!');window.location='carrinho.php';</script>";
 }else{
    while($res_carrinho = mysqli_fetch_array($sql_carrinho)){
		$cpf_cliente = $res_carrinho['cliente'];
	}
 }

?>

<?

$sql_emprestimo = mysqli_query($conexao_bd, "SELECT * FROM emprestimo_boleto");
if(mysqli_num_rows($sql_emprestimo) == ''){
	echo "<script language='javascript'>window.alert('CLIENTE NÃO POSSUI EMPRÉSTIMO CONTRATADO!');window.location='carrinho.php';</script>";
}else{
?>
<table width="1000" border="0">
  <tr>
    <td width="73" bgcolor="#666666"><strong>PROPÓSTA</strong></td>
    <td width="63" bgcolor="#666666"><strong>DATA</strong></td>
    <td width="67" bgcolor="#666666"><strong>STATUS</strong></td>
    <td width="220" bgcolor="#666666"><strong>CLIENTE</strong></td>
    <td width="65" bgcolor="#666666"><strong>VALOR</strong></td>
    <td width="62" bgcolor="#666666"><strong>N&ordm;. PARCE.</strong></td>
    <td width="44" bgcolor="#666666"><strong>TAXA</strong></td>
    <td width="94" bgcolor="#666666"><strong>VL. PARCELA</strong></td>
    <td width="59" bgcolor="#666666"><strong>SITUA&Ccedil;&Atilde;O</strong></td>
    <td width="78" bgcolor="#666666"><strong>OP&Ccedil;&Otilde;ES</strong></td>
  </tr>
  <? 
  $valor = 0;
  while($res_contratos = mysqli_fetch_array($sql_emprestimo)){ 
  $valor = $res_contratos['valor']+$valor; 
  $i++; 
  
  ?>
  <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
    <td><? echo $res_contratos['n_proposta']; ?></td>
    <td><? echo $res_contratos['data']; ?></td>
    <td><? echo $res_contratos['status']; ?></td>
    <td><? 
	$sql_nome_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '".$res_contratos['cpf']."'");
		while($res_cliente = mysqli_fetch_array($sql_nome_cliente)){
			echo $res_cliente['nome'];
		}
	 ?></td>
    <td>R$ <? echo number_format($res_contratos['valor'],2,',','.'); ?></td>
    <td><? echo $res_contratos['quant_parcela']; ?></td>
    <td><? echo $res_contratos['juros']; ?></td>
    <td>R$ <? echo number_format($res_contratos['valor_parcela'],2,',','.'); ?></td>
    <td><? echo number_format($res_contratos['valor'],2,',','.'); ?></td>
    <td>
    <a href="?pg=detalhe&code=<? echo $res_contratos['n_proposta']; ?>"><img src="img/cadastro.jpg" width="20" height="20" border="0" title="DETALHES DO PAGAMENTO" /></a>
    <a href=""><img src="img/bloquea.png" width="20" height="20" border="0" title="DETALHES DO PAGAMENTO" /></a>
    </td>
  </tr>
  <tr>
    <td colspan="10" align="center"><table width="980" border="0">
     <?
      $sql_parcelas = mysqli_query($conexao_bd, "SELECT * FROM boletos_emprestimo_boleto WHERE proposta = '".$_GET['code']."'");
	 ?>
      <tr>
        <td width="72" bgcolor="#CCCCCC"><strong>PARCELA</strong></td>
        <td width="69" bgcolor="#CCCCCC"><strong>STATUS</strong></td>
        <td width="60" bgcolor="#CCCCCC"><strong>VALOR</strong></td>
        <td width="58" bgcolor="#CCCCCC"><strong>JUROS</strong></td>
        <td width="58" bgcolor="#CCCCCC"><strong>MULTA</strong></td>
        <td width="259" bgcolor="#CCCCCC"><strong>COD. BARRAS</strong></td>
        <td width="86" bgcolor="#CCCCCC"><strong>LOCALIZADOR</strong></td>
        <td width="83" bgcolor="#CCCCCC"><strong>VENCIMENTO</strong></td>
        <td width="112" bgcolor="#CCCCCC"><strong>DATA PAGAMENTO</strong></td>
        <td width="81" bgcolor="#CCCCCC"><strong>CARN&Ecirc;</strong></td>
      </tr>
      <? 	   while($res_parcelas = mysqli_fetch_array($sql_parcelas)){ $i++;  ?>
	  <tr <? if($i%2 == 0){ echo "bgcolor='#D5FFD5'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
        <td height="20"><? echo $res_parcelas['parcela']; ?></td>
        <td><? echo $res_parcelas['status']; ?></td>
        <td>R$ <? echo number_format($res_contratos['valor_parcela'],2,',','.'); ?></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><? echo $res_parcelas['codigo_barras']; ?></td>
        <td><? echo $res_parcelas['localizador']; ?></td>
        <td><? 
		
			$sql_vencimento = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento WHERE codigo = '".$res_parcelas['vencimento']."'");
			 while($res_vencimento = mysqli_fetch_array($sql_vencimento)){
				 echo $res_vencimento['vencimento'];
			 }
		
		 ?></td>
        <td>&nbsp;</td>
        <td>
        <img src="img/boletos.png" width="20" height="20" title="EMITIR BOLETO" />
        <img src="img/dinheiro.jpg" width="20" height="20" title="PAGAR PARCELA" />
        <img src="img/email.png" width="20" height="20" title="ENVIAR BOLETO POR E-MAIL" /></td>
      </tr>
      <? } ?>
    </table></td>
    </tr>
 <? } ?>
</table>
<? } ?>
</div><!-- box_pagamento_1 -->

</body>
</html>