<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/setor_de_negociacao.css" rel="stylesheet" type="text/css" />

</head>

<body>

<? require "topo.php";  require "scripts/verificador_caixa.php";?>
<div id="box_cliente">
<hr />
<? if($_GET['p'] == ''){ ?>
<h1><strong>NEGOCIAÇÃO DE DÉBITOS</strong></h1>
 <?
 $sql_verifica_dividas = mysqli_query($conexao_bd, "SELECT * FROM dados_da_divida WHERE cliente = '$cliente'");
 if(mysqli_num_rows($sql_verifica_dividas) == ''){
	 echo "Não foi encontrado dívidas em aberto para esse cliente.";
 }else{
 ?> 
<table width="1000" border="0">
  <tr>
    <td width="28" bgcolor="#333333"><strong>ID</strong></td>
    <td width="112" bgcolor="#333333"><strong>TIPO</strong></td>
    <td width="83" bgcolor="#333333"><strong>VENCIMENTO</strong></td>
    <td width="76" bgcolor="#333333"><strong>STATUS</strong></td>
    <td width="113" bgcolor="#333333"><strong>SITUA&Ccedil;&Atilde;O</strong></td>
    <td width="88" bgcolor="#333333"><strong>D. ATRASO</strong></td>
    <td width="86" bgcolor="#333333"><strong>VL. TOTAL</strong></td>
    <td width="66" bgcolor="#333333"><strong>VL. PAGO</strong></td>
    <td width="61" bgcolor="#333333"><strong>SALDO</strong></td>
    <td width="53" bgcolor="#333333"><strong>JUROS</strong></td>
    <td width="52" bgcolor="#333333"><strong>MULTA</strong></td>
    <td width="80" bgcolor="#333333"><strong>VL. ATUAL</strong></td>
    <td style="border:1px solid #000;" width="20" bgcolor="#000">&nbsp;</td>
  </tr>
 <? $i=0; while($res_dividas = mysqli_fetch_array($sql_verifica_dividas)){ $i++;?>
  <tr <? if($i%2 == 0){ echo "bgcolor='#333'"; }else{ echo "bgcolor='#666'"; } ?>>
    <td><h3><? echo $i; ?></h3></td>
    <td><h3><? echo $res_dividas['tipo']; ?></h3></td>
    <td><h3><?
	 $sql_verifica_data = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento WHERE codigo = '".$res_dividas['vencimento']."'");
	  while($res_verifica_data = mysqli_fetch_array($sql_verifica_data)){
		  echo $res_verifica_data['vencimento'];
	  }
	?></h3></td>
    <?
     // verifica se divida pode ser negociada
	 $status = $res_dividas['status'];
	 
	 $vencido = 0;
	 
	 if($status == 'NEGADO' || $status == 'TERMINADO'){
		 $vencido = "NAO";
	 }elseif($status == 'AGUARDA PAGAMENTO' && $res_dividas['tipo'] == 'CARTAO'){
		 $vencido = "NAO";
	 }elseif($res_dividas['tipo'] == 'CREDITO PESSOAL' && ($code_vencimento_hoje-$res_dividas['vencimento']) > 0){
		 $vencido = "SIM";
	 }elseif($res_dividas['tipo'] == 'CREDITO PESSOAL' && ($code_vencimento_hoje-$res_dividas['vencimento']) >= 8000){
		 $vencido = "SIM";
	 }elseif($res_dividas['tipo'] == 'CREDITO PESSOAL' && ($code_vencimento_hoje-$res_dividas['vencimento']) <= 0){
		 $vencido = "NAO";
	 }elseif($status == 'VENCIDA' && $res_dividas['tipo'] == 'CARTAO'){
		 $vencido = "SIM";
	 }elseif($status == 'PAGO' && $res_dividas['tipo'] == 'CARTAO'){
		 $vencido = "NAO";
	 }
	
	?>    
    <td><h3><? 
	$code_divida = $res_dividas['code_divida'];
	if($status == 'RENEGOCIACAO'){
	echo "<a href='?p=contratos&code_negociacao=$code_divida'>$status</a>";
	}else{
	echo $status;
	}
	 ?></h3></td>
    <td><h3><? $situacao = $res_dividas['situacao'];
	 if($tipo != 'ADM'){
		echo $res_dividas['situacao']; 
	 }elseif($tipo == 'ADM' && $res_dividas['situacao'] == 'NAO NEGATIVADO'){
	 	echo "<a href='?p=negativar&divida=$code_divida' title='Negativar'>$situacao</a>";
	 }elseif($tipo == 'ADM' && $res_dividas['situacao'] == 'NEGATIVADO'){
	 	echo "<a style='color:#F00' href='?p=desnnegativar&divida=$code_divida' title=''><strong>$situacao</strong></a>";
	 }
		?></h3></td>
    <td><h3><? $atraso = $code_vencimento_hoje-$res_dividas['vencimento']; if($atraso>=1 && $atraso<8000){ echo $atraso; }else{ echo "0"; } ?> dias</h3></td>
    <td><h3><? echo number_format($res_dividas['valor_total'],2,',','.'); ?></h3></td>
    <td><h3><? echo number_format($res_dividas['valor_pago'],2,',','.'); ?></h3></td>
    <td><h3><? $saldo = $res_dividas['saldo_pagar']; echo number_format($saldo,2,',','.'); ?></h3></td>
    <td><h3><? if($vencido == 'SIM'){ $juros = ($atraso*0.0003*$saldo); if($juros >=1){ echo number_format($juros,2,',','.'); }} ?></h3></td>
    <td><h3><? if($vencido == 'SIM'){ $multa = $saldo*0.1; if($juros >= 1){ echo number_format($multa,2,',','.'); }}?></h3></td>
    <td><h3>R$ <? echo number_format(($saldo+$juros+$multa),2,',','.'); ?></h3></td>
    <td bgcolor="#000000"><? if($vencido == 'SIM'){ if($saldo > 0){ if($atraso>=1){  ?>
    <? if(mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM dados_da_divida_negociacao WHERE cliente = '$cliente' AND code_divida = '".$res_dividas['code_divida']."'")) == NULL){ ?>
    <a href="?p=add&cliente=<? echo $cliente; ?>&tipo=<? echo $res_dividas['tipo']; ?>&code_divida=<? echo $res_dividas['code_divida']; ?>&dias_atraso=<? echo $atraso ?>&vl_total=<? echo $res_dividas['valor_total']; ?>&vl_pago=<? echo $res_dividas['valor_pago']; ?>&saldo=<? echo $res_dividas['saldo_pagar']; ?>&juros=<? echo $juros; ?>&vencimento=<? echo $res_dividas['vencimento']; ?>&multa=<? echo $multa; ?>&vl_atualizado=<? echo ($saldo+$juros+$multa); ?>"><img src="img/adicionar.png" width="20" height="20" border="0" title="Negociar dívida"></a>
	<? } ?>
	
	<? }}} ?></td>
  </tr>
  <? } ?>
</table>
<? } ?>









<hr style="border:1px solid #111;" />
<h1><strong>DÍVIDAS A NEGOCIAR</strong></h1>
<?

$vl_atualizado = 0;
$desconto = 0;
$percentual = 0;
$dias_atraso = 0;

$sql_negociar = mysqli_query($conexao_bd, "SELECT * FROM dados_da_divida_negociacao WHERE cliente = '$cliente' AND status = 'AGUARDA'");
if(mysqli_num_rows($sql_negociar) == NULL){
	echo "<em style='font:10px arial; margin='10px;''>Nenhuma dívida adiconada</em>";
}else{
?>
<table width="1000" border="0">
  <tr>
    <td width="31" bgcolor="#333333"><strong>ID</strong></td>
    <td width="103" bgcolor="#333333"><strong>TIPO</strong></td>
    <td width="90" bgcolor="#333333"><strong>VENCIMENTO</strong></td>
    <td width="68" bgcolor="#333333"><strong>STATUS</strong></td>
    <td width="107" bgcolor="#333333"><strong>DIAS ATRASO</strong></td>
    <td width="82" bgcolor="#333333"><strong>VL. TOTAL</strong></td>
    <td width="80" bgcolor="#333333"><strong>VL. PAGO</strong></td>
    <td width="60" bgcolor="#333333"><strong>SALDO</strong></td>
    <td width="53" bgcolor="#333333"><strong>JUROS</strong></td>
    <td width="64" bgcolor="#333333"><strong>MULTA</strong></td>
    <td width="72" bgcolor="#333333"><strong>VL. ATUAL</strong></td>
    <td width="66" bgcolor="#333333"><strong>%DESC</strong></td>
    <td width="70" bgcolor="#333333"><strong>PAGAR</strong></td>
  </tr>
 <? $i=0; while($res_dividas_neg = mysqli_fetch_array($sql_negociar)){ $i++;?>
  <tr <? if($i%2 == 0){ echo "bgcolor='#333'"; }else{ echo "bgcolor='#666'"; } ?>>
    <td><h5><? echo $i; ?></h3></td>
    <td><h5><? echo $res_dividas_neg['tipo']; ?></h3></td>
    <td><h5><?
	 $sql_verifica_data = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento WHERE codigo = '".$res_dividas_neg['vencimento']."'");
	  while($res_verifica_data = mysqli_fetch_array($sql_verifica_data)){
		  echo $res_verifica_data['vencimento'];
	  }
	?></h5></td>
    <td><h5><? echo $res_dividas_neg['status']; ?></h3></td>
    <td><h5><? echo $dias_atraso = $res_dividas_neg['dias_atraso'];  ?> dias </h3></td>
    <td><h5><? echo number_format($res_dividas_neg['vl_total'],2,',','.'); ?></h3></td>
    <td><h5><? echo number_format($res_dividas_neg['vl_pago'],2,',','.'); ?></h3></td>
    <td><h5><? echo number_format($res_dividas_neg['saldo'],2,',','.'); ?></h3></td>
    <td><h5><? echo number_format($res_dividas_neg['juros'],2,',','.'); ?></h3></td>
    <td><h5><? echo number_format($res_dividas_neg['multa'],2,',','.'); ?></h3></td>
    <td><h5><? $vl_atualizado = $res_dividas_neg['vl_atualizado']+$vl_atualizado;  echo number_format($res_dividas_neg['vl_atualizado'],2,',','.'); ?></h3></td>
    <td><h5><? 
	
	require "per_desconto.php";

	$desconto = ($res_dividas_neg['vl_atualizado']*$percentual)+$desconto; 
	
	echo number_format($res_dividas_neg['vl_atualizado']*$percentual,2,',','.'); ?></h3></td>
    <td><h5><strong><? echo number_format($res_dividas_neg['vl_atualizado']-$res_dividas_neg['vl_atualizado']*$percentual,2,',','.'); ?></strong>
      <a href="?p=deleta&id=<? echo $res_dividas_neg['id']; ?>"><img src="img/deleta.fw.png" width="7" height="7" border="0" title="EXCLUIR DÍVIDA DA NEGOCIAÇÃO" /></a></h3></td>
  </tr>
  <? } ?>

  <tr <? if($i%2 == 0){ echo "bgcolor='#333'"; }else{ echo "bgcolor='#666'"; } ?>>
    <td bgcolor="#000000">&nbsp;</td>
    <td bgcolor="#000000">&nbsp;</td>
    <td bgcolor="#000000">&nbsp;</td>
    <td bgcolor="#000000">&nbsp;</td>
    <td bgcolor="#000000">&nbsp;</td>
    <td bgcolor="#000000">&nbsp;</td>
    <td bgcolor="#000000">&nbsp;</td>
    <td colspan="2" bgcolor="#000000">&nbsp;</td>
    <td colspan="2" align="right" bgcolor="#000000">&nbsp;</td>
    <td bgcolor="#000000"><strong>TOTAL</strong></td>
    <td bgcolor="#000000"><h6><? echo number_format($vl_atualizado,2,',','.'); ?></h6></td>
    </tr>
  <tr <? if($i%2 == 0){ echo "bgcolor='#333'"; }else{ echo "bgcolor='#666'"; } ?>>
    <td bgcolor="#000000">&nbsp;</td>
    <td bgcolor="#000000">&nbsp;</td>
    <td bgcolor="#000000">&nbsp;</td>
    <td bgcolor="#000000">&nbsp;</td>
    <td bgcolor="#000000">&nbsp;</td>
    <td bgcolor="#000000">&nbsp;</td>
    <td bgcolor="#000000">&nbsp;</td>
    <td colspan="2" bgcolor="#000000">&nbsp;</td>
    <td colspan="2" align="right" bgcolor="#000000">&nbsp;</td>
    <td bgcolor="#000000"><strong>DESCONTO</strong></td>
    <td bgcolor="#000000"><h2><? echo number_format($desconto,2,',','.'); ?></h2></td>
  </tr>
  <tr <? if($i%2 == 0){ echo "bgcolor='#333'"; }else{ echo "bgcolor='#666'"; } ?>>
    <td bgcolor="#000000">&nbsp;</td>
    <td bgcolor="#000000">&nbsp;</td>
    <td bgcolor="#000000">&nbsp;</td>
    <td bgcolor="#000000">&nbsp;</td>
    <td bgcolor="#000000">&nbsp;</td>
    <td bgcolor="#000000">&nbsp;</td>
    <td bgcolor="#000000">&nbsp;</td>
    <td colspan="2" bgcolor="#000000">&nbsp;</td>
    <td colspan="2" align="right" bgcolor="#000000">&nbsp;</td>
    <td bgcolor="#000000"><strong>V. PAGAR</strong></td>
    <td bgcolor="#000000"><h6><? echo number_format($vl_atualizado-$desconto,2,',','.'); ?></h6></td>
  </tr>
</table>
<a style="font:10px Arial, Helvetica, sans-serif; margin:0 0 0 0; float:right; padding:15px; border:1px solid #CCC; text-decoration:none; color:#9F0;" href="?p=parcelamento">Avançar</a>
<br />
<br />
<? } ?>
<? } //p ?>




<? if(@$_GET['p'] == 'parcelamento'){ ?>
<hr style="border:1px solid #111;" />
<h1><strong>ESCOLHA O PARCELAMENTO</strong></h1>
<?

$vl_atualizado = 0;
$desconto = 0;
$percentual = 0;
$dias_atraso = 0;

$sql_negociar = mysqli_query($conexao_bd, "SELECT * FROM dados_da_divida_negociacao WHERE cliente = '$cliente'");
if(mysqli_num_rows($sql_negociar) == NULL){
	echo "<em style='font:10px arial; margin='10px;''>Nenhuma dívida adiconada</em>";
}else{
?>
<table width="1000" border="0">
  <tr>
    <td width="31" bgcolor="#333333"><strong>ID</strong></td>
    <td width="103" bgcolor="#333333"><strong>TIPO</strong></td>
    <td width="90" bgcolor="#333333"><strong>VENCIMENTO</strong></td>
    <td width="68" bgcolor="#333333"><strong>STATUS</strong></td>
    <td width="107" bgcolor="#333333"><strong>DIAS ATRASO</strong></td>
    <td width="82" bgcolor="#333333"><strong>VL. TOTAL</strong></td>
    <td width="80" bgcolor="#333333"><strong>VL. PAGO</strong></td>
    <td width="60" bgcolor="#333333"><strong>SALDO</strong></td>
    <td width="53" bgcolor="#333333"><strong>JUROS</strong></td>
    <td width="64" bgcolor="#333333"><strong>MULTA</strong></td>
    <td width="72" bgcolor="#333333"><strong>VL. ATUAL</strong></td>
    <td width="66" bgcolor="#333333"><strong>%DESC</strong></td>
    <td width="70" bgcolor="#333333"><strong>PAGAR</strong></td>
  </tr>
 <? $i=0; while($res_dividas_neg = mysqli_fetch_array($sql_negociar)){ $i++;?>
  <tr <? if($i%2 == 0){ echo "bgcolor='#333'"; }else{ echo "bgcolor='#666'"; } ?>>
    <td><h5><? echo $i; ?></h3></td>
    <td><h5><? echo $res_dividas_neg['tipo']; ?></h3></td>
    <td><h5><?
	 $sql_verifica_data = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento WHERE codigo = '".$res_dividas_neg['vencimento']."'");
	  while($res_verifica_data = mysqli_fetch_array($sql_verifica_data)){
		  echo $res_verifica_data['vencimento'];
	  }
	?></h5></td>
    <td><h5><? echo $res_dividas_neg['status']; ?></h3></td>
    <td><h5><? echo $dias_atraso = $res_dividas_neg['dias_atraso'];  ?> dias </h3></td>
    <td><h5><? echo number_format($res_dividas_neg['vl_total'],2,',','.'); ?></h3></td>
    <td><h5><? echo number_format($res_dividas_neg['vl_pago'],2,',','.'); ?></h3></td>
    <td><h5><? echo number_format($res_dividas_neg['saldo'],2,',','.'); ?></h3></td>
    <td><h5><? echo number_format($res_dividas_neg['juros'],2,',','.'); ?></h3></td>
    <td><h5><? echo number_format($res_dividas_neg['multa'],2,',','.'); ?></h3></td>
    <td><h5><? $vl_atualizado = $res_dividas_neg['vl_atualizado']+$vl_atualizado;  echo number_format($res_dividas_neg['vl_atualizado'],2,',','.'); ?></h3></td>
    <td><h5><? 
	
	require "per_desconto.php";

	$desconto = ($res_dividas_neg['vl_atualizado']*$percentual)+$desconto; 
	
	echo number_format($res_dividas_neg['vl_atualizado']*$percentual,2,',','.'); ?></h3></td>
    <td><h5><strong><? echo number_format($res_dividas_neg['vl_atualizado']-$res_dividas_neg['vl_atualizado']*$percentual,2,',','.'); ?></strong>
      <a href="?p=deleta&id=<? echo $res_dividas_neg['id']; ?>"><img src="img/deleta.fw.png" width="7" height="7" title="EXCLUIR DÍVIDA DA NEGOCIAÇÃO" /></a></h3></td>
  </tr>
  <? } ?>

  <tr <? if($i%2 == 0){ echo "bgcolor='#333'"; }else{ echo "bgcolor='#666'"; } ?>>
    <td bgcolor="#000000">&nbsp;</td>
    <td bgcolor="#000000">&nbsp;</td>
    <td bgcolor="#000000">&nbsp;</td>
    <td bgcolor="#000000">&nbsp;</td>
    <td bgcolor="#000000">&nbsp;</td>
    <td bgcolor="#000000">&nbsp;</td>
    <td bgcolor="#000000">&nbsp;</td>
    <td colspan="2" bgcolor="#000000">&nbsp;</td>
    <td colspan="2" align="right" bgcolor="#000000">&nbsp;</td>
    <td bgcolor="#000000"><strong>TOTAL</strong></td>
    <td bgcolor="#000000"><h6><? echo number_format($vl_atualizado,2,',','.'); ?></h6></td>
    </tr>
  <tr <? if($i%2 == 0){ echo "bgcolor='#333'"; }else{ echo "bgcolor='#666'"; } ?>>
    <td bgcolor="#000000">&nbsp;</td>
    <td bgcolor="#000000">&nbsp;</td>
    <td bgcolor="#000000">&nbsp;</td>
    <td bgcolor="#000000">&nbsp;</td>
    <td bgcolor="#000000">&nbsp;</td>
    <td bgcolor="#000000">&nbsp;</td>
    <td bgcolor="#000000">&nbsp;</td>
    <td colspan="2" bgcolor="#000000">&nbsp;</td>
    <td colspan="2" align="right" bgcolor="#000000">&nbsp;</td>
    <td bgcolor="#000000"><strong>DESCONTO</strong></td>
    <td bgcolor="#000000"><h2><? echo number_format($desconto,2,',','.'); ?></h2></td>
  </tr>
  <tr <? if($i%2 == 0){ echo "bgcolor='#333'"; }else{ echo "bgcolor='#666'"; } ?>>
    <td bgcolor="#000000">&nbsp;</td>
    <td bgcolor="#000000">&nbsp;</td>
    <td bgcolor="#000000">&nbsp;</td>
    <td bgcolor="#000000">&nbsp;</td>
    <td bgcolor="#000000">&nbsp;</td>
    <td bgcolor="#000000">&nbsp;</td>
    <td bgcolor="#000000">&nbsp;</td>
    <td colspan="2" bgcolor="#000000">&nbsp;</td>
    <td colspan="2" align="right" bgcolor="#000000">&nbsp;</td>
    <td bgcolor="#000000"><strong>V. PAGAR</strong></td>
    <td bgcolor="#000000"><h6><? $valor_parcela = $vl_atualizado-$desconto; echo number_format($valor_parcela,2,',','.'); ?></h6></td>
  </tr>
</table>



<hr style="border:1px solid #111;" />
<form name="" method="post" action="" enctype="multipart/form-data">
<table width="600" style="font:20px 'Lucida Sans Unicode', 'Lucida Grande', sans-serif;" border="0">
 <? for($i=1; $i<=24; $i++){ ?>
  <tr>
    <td width="46"><input type="radio" name="parcela" id="radio" value="<? echo $i; ?>"></td>
    <td align="left" style="font:Tahoma, Geneva, sans-serif; color:#666;" width="868"><? echo $i; ?> X R$ <? if($i >1){echo number_format((($valor_parcela*$taxa_parcelamento*$i)+$valor_parcela)/$i,2,',','.'); }else{echo number_format($valor_parcela,2,',','.');}?></td>
    <td width="72" style="font:10px Tahoma, Geneva, sans-serif; color:#F00;"  align="left">R$ <? if($i >1){ echo number_format(($valor_parcela*$taxa_parcelamento*$i)+$valor_parcela,2,',','.'); }else{ echo number_format($valor_parcela,2,',','.'); }?></td>
  </tr>
 <? } ?>
  <tr>
    <td style="font:12px Arial, Helvetica, sans-serif; color:#930;" colspan="3"><hr style="border:1px solid #111;" />     <strong>FORMA DE PAGAMENTO</strong></td>
  </tr>
  <tr>
    <td colspan="3"><label for="select"></label>
      <select style="font:10px Arial, Helvetica, sans-serif; background:#000; text-align:center; width:400px; margin:0 0 0 0;  padding:7px; border:1px solid #555; text-decoration:none; color:#9F0;" name="forma_pag" size="1" id="select">
        <option value="BOLETO BANCARIO">BOLETO BANCARIO</option>
</select></td>
  </tr>
  <tr>
    <td style="font:12px Arial, Helvetica, sans-serif; color:#930;" colspan="3"><strong>DIA DE VENCIMENTO</strong></td>
  </tr>
  <tr>
     <td style="font:12px Arial, Helvetica, sans-serif; color:#930;" colspan="3">
       <select name="vencimento" size="1" id="select2" style="font:10px Arial, Helvetica, sans-serif; background:#000; text-align:center; width:100px; margin:0 0 0 0;  padding:7px; border:1px solid #555; text-decoration:none; color:#9F0;">
        <? for($i=1; $i<=28; $i++){ ?>
         <option value="<? echo $i; ?>"><? echo $i; ?></option>
        <? } ?>
       </select>
       <hr style="border:1px solid #111;" /></td>
  </tr>
  <tr>
    <td colspan="3"><input style="font:10px Arial, Helvetica, sans-serif; background:#000; margin:0 0 0 12px; padding:15px; border:1px solid #555; text-decoration:none; color:#9F0;" type="submit" name="confirmar" id="button" value="CONFIRMAR">
    </label>      
    &nbsp;</td>
  </tr>
  </table>
</form>  
<? if(isset($_POST['confirmar'])){
	
$parcela = $_POST['parcela'];
$forma_pag = $_POST['forma_pag'];
$dia_vencimento = $_POST['vencimento'];
$valor_parcelas = 0;
$valor_total = 0;
$code_negociacao = rand()*date("s");

if($parcela == 1){
$valor_parcelas = $valor_parcela;
$valor_total = $valor_parcela;
}else{
$valor_parcelas = (($valor_parcela*$taxa_parcelamento*$parcela )+$valor_parcela)/$parcela;
$valor_total = ($valor_parcela*$taxa_parcelamento*$parcela )+$valor_parcela;
}

mysqli_query($conexao_bd, "UPDATE dados_da_divida_negociacao SET code_negociacao = '$code_negociacao' WHERE cliente = '$cliente' AND status = 'AGUARDA'");

$total_dividas = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM dados_da_divida_negociacao WHERE code_negociacao = '$code_negociacao'"));

$sql_negocia = mysqli_query($conexao_bd, "INSERT INTO dados_da_divida_negociacao_fechado (dia, mes, ano, data, data_completa, operador, status, cliente, code_negociacao, total_dividas, vl_total, desconto, vl_pagar, forma_pag, parcelas, valor_parcela, vl_total_negociado, dia_vencimento, contrato, envio_contrato) VALUES ('$dia', '$mes', '$ano', '$data', '$data_completa', '$operador', 'AGUARDA', '$cliente', '$code_negociacao', '$total_dividas', '$vl_atualizado', '$desconto', '$valor_parcela', '$forma_pag', '$parcela', '$valor_parcelas', '$valor_total', '$dia_vencimento', '', '')");

echo "<script language='javascript'>window.alert('Dívida negociada, envie os documentos para analise!');window.location='?p=contratos&code_negociacao=$code_negociacao';</script>";

}?>  
<? } ?>


<? } //  ?>





<? if(@$_GET['p'] == 'contratos'){ require "detalhes_negociacao.php"; }?>






<hr style="border:1px solid #111;" />
</div><!-- box_cliente -->
<? require "rodape.php"; ?>
</body>
</html>
<? if(@$_GET['p'] == 'deleta'){
$id = $_GET['id'];

mysqli_query($conexao_bd, "DELETE FROM dados_da_divida_negociacao WHERE id = '$id'");
echo "<script language='javascript'>window.location='?';</script>";

}?>


<? if(@$_GET['p'] == 'add'){
	
$cliente = $_GET['cliente'];
$tipo = $_GET['tipo'];
$code_divida = $_GET['code_divida'];
$dias_atraso = $_GET['dias_atraso'];
$vl_total = $_GET['vl_total'];
$vl_pago = $_GET['vl_pago'];
$saldo = $_GET['saldo'];
$juros = $_GET['juros'];
$multa = $_GET['multa'];
$vl_atualizado = $_GET['vl_atualizado'];
$vencimento = $_GET['vencimento'];

mysqli_query($conexao_bd, "INSERT INTO dados_da_divida_negociacao (dia, mes, data, data_completa, operador, status, cliente, tipo, code_divida, vencimento, dias_atraso, vl_total, vl_pago, saldo, juros, multa, vl_atualizado, code_negociacao) VALUES ('$dia', '$mes', '$data', '$data_completa', '$operador', 'AGUARDA', '$cliente', '$tipo', '$code_divida', '$vencimento', '$dias_atraso', '$vl_total', '$vl_pago', '$saldo', '$juros', '$multa', '$vl_atualizado', '')");

echo "<script language='javascript'>window.location='?p=';</script>";

}?>

<? if(@$_GET['p'] == 'negativar'){

$divida = $_GET['divida'];

mysqli_query($conexao_bd, "UPDATE dados_da_divida SET situacao = 'NEGATIVADO' WHERE code_divida = '$divida'");
echo "<script language='javascript'>window.location='?p=';</script>";

}?>

<? if(@$_GET['p'] == 'desnnegativar'){

$divida = $_GET['divida'];

mysqli_query($conexao_bd, "UPDATE dados_da_divida SET situacao = 'NAO NEGATIVADO' WHERE code_divida = '$divida'");
echo "<script language='javascript'>window.location='?p=';</script>";

}?>
