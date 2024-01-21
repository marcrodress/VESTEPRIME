<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/depesas_de_manutencao.css" rel="stylesheet" type="text/css" />
</head>

<body>
<? require "topo.php";  require "scripts/verificador_caixa.php"; 


$sql_verifica_lancamento = mysqli_query($conexao_bd, "SELECT * FROM despesas_loja WHERE status = 'Ativo'");
while($res_verifica = mysqli_fetch_array($sql_verifica_lancamento)){
	
	$id_lancamento = $res_verifica['id'];
	$data_compra = $res_verifica['data_compra'];
	$tipo = $res_verifica['tipo'];
	$descricao = $res_verifica['descricao'];
	$vl_parcela = $res_verifica['vl_parcela'];
	$n_parcela = $res_verifica['n_parcela'];
	$dia_vencimento = $res_verifica['dia_vencimento'];
	$forma_pagamento = $res_verifica['forma_pagamento'];

	$sql_lancamento = mysqli_query($conexao_bd, "SELECT * FROM despesas_mes WHERE id_despesa = '$id_lancamento' AND mes = '$mes' AND ano = '$ano'");
	$conta_lancamento = mysqli_num_rows($sql_lancamento);
		$sql_lancamentos = mysqli_query($conexao_bd, "SELECT * FROM despesas_mes WHERE id_despesa = '$id_lancamento'");
		$conta_lancamentos = mysqli_num_rows($sql_lancamentos);
		$conta_lancamentos++;
	 if($conta_lancamentos >= $n_parcela){
		mysqli_query($conexao_bd, "UPDATE despesas_loja SET status = 'TERMINADO' WHERE id = '$id_lancamento' AND tipo != 'FIXO' AND mes = '$mes' AND ano = '$ano'");
	 }
	 if($conta_lancamento <= 0){
		mysqli_query($conexao_bd, "INSERT INTO despesas_mes (dia, mes, ano, id_despesa, status, tipo, data_compra, descricao, vl_parcela, n_parcela, dia_vencimento, forma_pagamento) VALUES ('$dia_vencimento', '$mes', '$ano', '$id_lancamento', 'Aguarda', '$tipo', '$data_compra', '$descricao', '$vl_parcela', '$conta_lancamentos', '$dia_vencimento', '$forma_pagamento')");
	}	
}
?>









<div id="box_pagamento_1">
<h1 style="font:20px Arial, Helvetica, sans-serif; margin:5px;"><strong>CADASTRAR NOVA DESPESA</strong></h1>
<hr />
<? if(isset($_POST['button'])){
	
$tipo = $_POST['tipo'];
$data_compra = $_POST['data_compra'];
$descricao = $_POST['descricao'];
$vl_parcela = $_POST['vl_parcela'];
$n_parcela = $_POST['n_parcela'];
$dia_vencimento = $_POST['dia_vencimento'];
$forma_pagamento = $_POST['forma_pagamento'];


$sql = mysqli_query($conexao_bd, "INSERT INTO despesas_loja (dia, mes, ano, data, data_completa, status, tipo, data_compra, descricao, vl_parcela, n_parcela, dia_vencimento, forma_pagamento) VALUES ('$dia', '$mes', '$ano', '$data', '$data_completa', 'Ativo', '$tipo', '$data_compra', '$descricao', '$vl_parcela', '$n_parcela', '$dia_vencimento', '$forma_pagamento')");

if($sql == ''){
	echo "<script language='javascript'>window.alert('ERRO AO CADASTRAR DESPESA!');</script>";
}else{
	echo "<script language='javascript'>window.alert('DESPESA CADASTRADA COM SUCESSO!');window.location='';</script>";
}
}?>
<form name="" method="post" action="">
<table width="1000" border="0">
  <tr>
    <td bgcolor="#00CCCC"><strong>TIPO</strong></td>
    <td bgcolor="#00CCCC"><strong>DATA/COMPRA</strong></td>
    <td bgcolor="#00CCCC"><strong>DESCRIÇÃO</strong></td>
    <td bgcolor="#00CCCC"><strong>VALOR</strong></td>
    <td bgcolor="#00CCCC"><strong>N&ordm;. PARCELA</strong></td>
    <td bgcolor="#00CCCC"><strong>DIA/VENCIMENTO</strong></td>
    <td bgcolor="#00CCCC"><strong>FORM. PAGT.</strong></td>
    <td bgcolor="#00CCCC">&nbsp;</td>
  </tr>
  <tr>
    <td><label for="tipo"></label>
      <select name="tipo" size="1" id="tipo">
        <option value="UNICO">UNICO</option>
        <option value="PARCELA">PARCELA</option>
        <option value="FIXO">FIXO</option>
      </select></td>
    <td><label for="data_compra"></label>
    <input name="data_compra" type="text" id="data_compra" size="7" value="<? echo date("d/m/Y"); ?>"></td>
    <td><label for="descricao"></label>
    <input name="descricao" type="text" id="descricao" size="35"></td>
    <td><label for="n_parcela"></label>
    <input name="vl_parcela" type="text" id="vl_parcela" size="5"></td>
    <td><label for="n_parcela"></label>
    <input name="n_parcela" type="text" id="n_parcela" size="4"></td>
    <td><label for="dia_vencimento"></label>
    <input name="dia_vencimento" type="text" id="dia_vencimento" size="3"></td>
    <td><label for="forma_pagamento"></label>
      <select name="forma_pagamento" size="1" id="forma_pagamento">
        <option value="DINHEIRO">DINHEIRO</option>
        <option value="CHEQUE">CHEQUE</option>
        <option value="CART&Atilde;O DE D&Eacute;BITO">CART&Atilde;O DE D&Eacute;BITO</option>
        <option value="CART&Atilde;O DE CR&Eacute;DITO">CART&Atilde;O DE CR&Eacute;DITO</option>
        <option value="TRANSFER&Ecirc;NCIA">TRANSFER&Ecirc;NCIA</option>
        <option value="D&Eacute;BITO EM CONTA">D&Eacute;BITO EM CONTA</option>
      </select></td>
    <td><input type="submit" name="button" id="button" value="ENVIAR"></td>
  </tr>
</table>
<hr />
</form>
<br /><br />

<h1 style="font:15px Arial, Helvetica, sans-serif; margin:0; padding:0;"><strong>DESPESAS LANÇADAS NO MÊS</strong></h1>
<table width="1000" border="0" style="border:1px solid #930; border-radius:5px;">
  <tr>
    <td width="66" bgcolor="#CCCCCC"><strong>TIPO</strong></td>
    <td width="69" bgcolor="#CCCCCC"><strong>DATA</strong></td>
    <td width="290" bgcolor="#CCCCCC"><strong>DESCRIÇÃO</strong></td>
    <td width="106" bgcolor="#CCCCCC"><strong>VL. PARCELA</strong></td>
    <td width="108" bgcolor="#CCCCCC"><strong>QUANT. PARCELA</strong></td>
    <td width="115" bgcolor="#CCCCCC"><strong>DIA/VENCIMENTO</strong></td>
    <td width="158" bgcolor="#CCCCCC"><strong>FORM. PAGT.</strong></td>
    <td width="54" bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
<?
$i = 0; $total = 0;

$sql = mysqli_query($conexao_bd, "SELECT * FROM despesas_mes WHERE mes = '$mes' AND ano = '$ano'");
	while($res_despesa = mysqli_fetch_array($sql)){ $i++;
?>
  <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
    <td><? echo $res_despesa['tipo']; ?></td>
    <td><? echo $res_despesa['data_compra']; ?></td>
    <td><? echo $res_despesa['descricao']; ?></td>
    <td <? if($res_despesa['status'] == 'Pago'){ ?> bgcolor="#00CC00"<? } ?>>R$ <? $vl_total = $vl_total+$res_despesa['vl_parcela']; echo number_format($res_despesa['vl_parcela'],2,',','.'); ?></td>
    <td><? echo $res_despesa['n_parcela']; ?></td>
    <td><? echo $res_despesa['dia_vencimento']; ?></td>
    <td><? echo $res_despesa['forma_pagamento']; ?></td>
    <td>
    	<? if($res_despesa['status'] == 'Aguarda'){ ?>
        <a href="?p=mes&id=<? echo $res_despesa['id']; ?>"><img src="img/correto.jpg" width="20" height="20" border="0" /></a>
    	<? }elseif($res_despesa['status'] == 'Pago'){ ?>
        <a href="?p=updatemes&id=<? echo $res_despesa['id']; ?>"><img src="img/bloquea.png" width="20" height="20" border="0" /></a>
        <? } ?>
    	<? if($res_despesa['status'] != 'Pago'){ ?>
    	<a href="?p=excluir_mes&id=<? echo $res_despesa['id']; ?>"><img src="img/deleta.jpg" width="18" height="18" border="0" title="Excluir lancamento"></a>
        <? } ?>
    </td>
  </tr>
<? } ?>
  <tr>
    <td colspan="3">&nbsp;</td>
    <td bgcolor="#FFD2E1"><strong>R$ <? echo number_format($vl_total,2,',','.'); ?></strong></td>
    <td colspan="4">&nbsp;</td>
    </tr>
</table>







<br /><br />
<h1 style="font:15px Arial, Helvetica, sans-serif; margin:0; padding:0;"><strong>Histórico de depesas ativas</strong></h1>
<table width="1000" border="0" style="border:1px solid #930; border-radius:5px;">
  <tr>
    <td width="66" bgcolor="#CCCCCC"><strong>TIPO</strong></td>
    <td width="69" bgcolor="#CCCCCC"><strong>DATA</strong></td>
    <td width="330" bgcolor="#CCCCCC"><strong>DESCRIÇÃO</strong></td>
    <td width="93" bgcolor="#CCCCCC"><strong>VL. PARCELA</strong></td>
    <td width="114" bgcolor="#CCCCCC"><strong>QUANT. PARCELA</strong></td>
    <td width="117" bgcolor="#CCCCCC"><strong>DIA/VENCIMENTO</strong></td>
    <td width="155" bgcolor="#CCCCCC"><strong>FORM. PAGT.</strong></td>
    <td width="22" bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
<?
$i = 0; $total = 0;

$sql = mysqli_query($conexao_bd, "SELECT * FROM despesas_loja WHERE status = 'Ativo'");
	while($res_despesa = mysqli_fetch_array($sql)){ $i++;
?>
  <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
    <td><? echo $res_despesa['tipo']; ?></td>
    <td><? echo $res_despesa['data_compra']; ?></td>
    <td><? echo $res_despesa['descricao']; ?></td>
    <td><? echo $res_despesa['vl_parcela']; ?></td>
    <td><? echo $res_despesa['n_parcela']; ?></td>
    <td><? echo $res_despesa['dia_vencimento']; ?></td>
    <td><? echo $res_despesa['forma_pagamento']; ?></td>
    <td><a href="?p=excluir_loja&id=<? echo $res_despesa['id']; ?>"><img src="img/deleta.jpg" width="18" height="18" border="0" title="Excluir parcela"></a></td>
  </tr>
<? } ?>
</table>

</div><!-- box_pagamento_1 -->
</body>
</html>
<? if($_GET['p'] == 'excluir_loja'){
	
	mysqli_query($conexao_bd, "UPDATE despesas_loja SET status = 'Excluido' WHERE id = '".$_GET['id']."'");
	echo "<script language='javascript'>window.location='?';</script>";

}?>


<? if($_GET['p'] == 'excluir_mes'){
	$id = $_GET['id'];
	mysqli_query($conexao_bd, "DELETE FROM despesas_mes WHERE id = '$id'");
	echo "<script language='javascript'>window.location='?';</script>";

}?>

<? if($_GET['p'] == 'mes'){
	
	mysqli_query($conexao_bd, "UPDATE despesas_mes SET status = 'Pago' WHERE id = '".$_GET['id']."'");
	echo "<script language='javascript'>window.location='?';</script>";

}?>

<? if($_GET['p'] == 'updatemes'){
	
	mysqli_query($conexao_bd, "UPDATE despesas_mes SET status = 'Aguarda' WHERE id = '".$_GET['id']."'");
	echo "<script language='javascript'>window.location='?';</script>";

}?>