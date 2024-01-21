<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/resultado_emprestimo_carne.css" rel="stylesheet" type="text/css" />
</head>

<body>
<? require "topo.php";  require "scripts/verificador_caixa.php"; ?>
<div id="box_pagamento_1">
<? if($_GET['pg'] == 'detalhes'){ ?>
<hr />
<h1 style="font:15px Arial, Helvetica, sans-serif; margin:10px;"><strong>N da propósta: <? echo $n_proposta = $_GET['n_proposta']; ?></strong> - <a style="padding:5px; background:#090; border:2px solid #000; font:10px Arial, Helvetica, sans-serif; text-decoration:none; color:#FFF;" href="resultado_saque_facil.php">Voltar</a></h1>
<?

$sql_emprestimo = mysqli_query($conexao_bd, "SELECT * FROM emprestimo_saque_facil WHERE n_proposta = '$n_proposta'");
while($res_emprestimo = mysqli_fetch_array($sql_emprestimo)){
?>
<table width="990" border="0">
  <tr>
    <td colspan="5" align="center" bgcolor="#333333"><h1 style="font:20px Arial, Helvetica, sans-serif;"><strong>DADOS DO CR&Eacute;DITO</strong></h1></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#000000"><strong>CLIENTE</strong></td>
    <td width="127" bgcolor="#000000"><strong>CPF</strong></td>
    <td width="127" bgcolor="#000000"><strong>DATA</strong></td>
    <td width="127" bgcolor="#000000"><strong>TELEFONE</strong></td>
  </tr>
  <tr>
    <td colspan="2"><h6><? echo $res_emprestimo['nome']; ?></h6></td>
    <td><h6><? echo $res_emprestimo['cpf']; ?></h6></td>
    <td><h6><? echo $res_emprestimo['data']; ?></h6></td>
    <td><h6><? echo $res_emprestimo['telefone']; ?></h6></td>
  </tr>
  <tr>
    <td width="99" bgcolor="#000000"><strong>VALOR SOLICITADO</strong></td>
    <td width="89" bgcolor="#000000"><strong>N. PARCELA</strong></td>
    <td bgcolor="#000000"><strong>VL. PARCELA</strong></td>
    <td bgcolor="#000000"><strong>TAXA</strong></td>
    <td bgcolor="#000000"><strong>VL. TOTAL</strong></td>
  </tr>
  <tr>
    <td><h6>R$ <? echo number_format($res_emprestimo['valor'],2,',','.'); ?></h6></td>
    <td><h6><? echo $res_emprestimo['quant_parcela']; ?></h6></td>
    <td><h6>R$ <? echo number_format($res_emprestimo['valor_parcela'],2,',','.'); ?></h6></td>
    <td><h6>20%</h6></td>
    <td><h6>R$ <? echo number_format($res_emprestimo['valor_total'],2,',','.'); ?></h6></td>
  </tr>
  <tr>
    <td bgcolor="#000000"><strong>VENCIMENTO</strong></td>
    <td bgcolor="#000000"><strong>FORM. PAGAMENTO</strong></td>
    <td bgcolor="#000000"><strong>BANCO</strong></td>
    <td bgcolor="#000000"><strong>TIPO DE CONTA</strong></td>
    <td bgcolor="#000000"><strong>AGÊNCIA/CONTA</strong></td>
  </tr>
  <tr>
    <td><h6>vencimento da fatura</h6></td>
    <td><h6><? echo $res_emprestimo['forma_pagamento']; ?></h6></td>
    <td><h6><? echo $res_emprestimo['banco']; ?></h6></td>
    <td><h6><? echo $res_emprestimo['tipo_conta']; ?></h6></td>
    <td><h6><? echo $res_emprestimo['agencia']; ?> / <? echo $res_emprestimo['conta']; ?></h6></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#000000"><strong>RESULTADO DA ANALISE DE CR&Eacute;DITO:</strong><br /> <h6><? echo $res_emprestimo['status']; ?></h6></td>
    <td bgcolor="#000000"><strong>OPERADOR:</strong> <br />
      <h6><? echo $res_emprestimo['operador']; ?></h6></td>
    <td bgcolor="#000000"><strong>IMPOSTOS:</strong> <br />
     <h6> R$ 29,99</h6><br />
      </td>
    <td bgcolor="#000000"><strong>ADMINISTRA&Ccedil;&Atilde;O DE CONTRATO</strong><br />
    	<script language="javascript">
		function abrePopUp(urlImagem){
			window.open(urlImagem,'Foto_Ampliada','top=150,left=500,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=350,height=400');
		}
	</script>
    
    <?
	$cliente = 0;
	 $sql_carrinho = mysqli_query($conexao_bd, "SELECT * FROM carrinho WHERE ip = '$ip' AND status = 'Ativo' AND cliente != ''");
	 if(mysqli_num_rows($sql_carrinho) == ''){
		echo "<script language='javascript'>window.location='carrinho.php';</script>";
	 }else{
		while($res_carrinho = mysqli_fetch_array($sql_carrinho)){
			$cliente = $res_carrinho['cliente'];
		}
	  }
	
	
	
	?>
    
      <a onclick="abrePopUp('scripts/contrato_saque_facil.php?cliente=<? echo $cliente; ?>&n_proposta=<? echo $n_proposta; ?>');" href=""><img src="img/cadastro.fw.png" alt="" width="20" height="20" border="0" title="IMPRIMIR CONTRATO" /></a></td>
  </tr>
  <tr>
    <td colspan="5" bgcolor="#333333"><table class="td" width="965" align="center" border="0">
      <tr>
        <td colspan="7" bgcolor="#666666"><strong><span style="font-family: Arial, Helvetica, sans-serif; font-size: 20px">PARCELAS</span></strong></td>
      </tr>
      <tr>
        <td width="114" bgcolor="#000000"><strong>COD. TRANSA&Ccedil;&Atilde;O</strong></td>
        <td width="124" bgcolor="#000000"><strong>STATUS</strong></td>
        <td width="125" bgcolor="#000000"><strong>ESTABELECIMENTO</strong></td>
        <td width="113" bgcolor="#000000"><strong>PARCELA</strong></td>
        <td width="138" bgcolor="#000000"><strong>N&ordm; PARCELA</strong></td>
        <td width="134" bgcolor="#000000"><strong>TOTAL PARCELA</strong></td>
        <td width="185" bgcolor="#000000"><strong>VALOR DA PARCELA</strong></td>
        </tr>
      <?
 
 $sql_parcelas = mysqli_query($conexao_bd, "SELECT * FROM compras_parceladas WHERE code_transacao = '$n_proposta'");
 while($res_parcela = mysqli_fetch_array($sql_parcelas)){ $i++;
 ?>
	  <tr <? if($i%2 == 0){ echo "bgcolor='#333'"; }else{ echo "bgcolor='#666'"; } ?>>
        <td><? echo $res_parcela['code_transacao']; ?></td>
        <td><? echo $res_parcela['status']; ?></td>
        <td><? echo $res_parcela['estabelecimento']; ?></td>
        <td><? echo $res_parcela['parcela']; ?></td>
        <td><? echo $res_parcela['n_parcela']; ?></td>
        <td><? echo $res_parcela['total_parcela']; ?></td>
        <td>R$ <? echo number_format($res_parcela['valor_parcela'],2,',','.'); ?></td>
        </tr>
      <? } ?>
    </table></td>
    </tr>
    <? } ?>
</table>
<? } // detalhe do empréstimo ?>




<? if($_GET['pg'] == ''){ ?>
<hr />
<h1 style="font:15px Arial, Helvetica, sans-serif; margin:10px;"><strong>PROPOSTAS DE EMPRÉSTIMO NO CARNÊ</strong></h1>
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

$sql_emprestimo = mysqli_query($conexao_bd, "SELECT * FROM emprestimo_saque_facil WHERE cpf = '$cpf_cliente'");
if(mysqli_num_rows($sql_emprestimo) == ''){
	echo "<script language='javascript'>window.alert('CLIENTE NÃO POSSUI EMPRÉSTIMO CONTRATADO!');window.location='carrinho.php';</script>";
}else{
?>
<table class="table" width="1000" border="0">
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
  <tr <? if($i%2 == 0){ echo "bgcolor='#666'"; }else{ echo "bgcolor='#222'"; } ?>>
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
    <? if($res_contratos['status'] == 'APROVADO'){ ?>
    <a href="?pg=detalhes&n_proposta=<? echo $n_proposta = $res_contratos['n_proposta']; ?>"><img src="img/cadastro.fw.png" width="20" height="20" border="0" title="DETALHES DO CRÉDITO PESSOAL" /></a>
    <? } ?>
    </td>
  </tr>
  <? } ?>
</table>

<? } ?>


<? } // VERIFICAÇÃO DE PÁGINA  ?>



</div><!-- box_pagamento_1 -->
</body>
</html>