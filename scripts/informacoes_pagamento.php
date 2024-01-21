<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<link href="css/informacoes_pagamento.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="box">
<?

require "../conexao.php";

$sql_boleto = mysqli_query($conexao_bd, "SELECT * FROM pagamentoboletos WHERE id = '".$_GET['id']."'");
	while($res_boleto = mysqli_fetch_array($sql_boleto)){
?>
<table width="900" border="0">
  <tr>
    <td colspan="6" bgcolor="#99FF00"><strong>CÓDIGO DE BARRAS</strong></td>
  </tr>
  <tr>
    <td colspan="6"><? echo $res_boleto['code_barras']; ?></td>
  </tr>
  <tr>
    <td colspan="6">
	<? 
	
	$code_barras = $res_boleto['code_barras']; 
	
	for($i=0; $i<strlen($code_barras); $i++){
		if($code_barras[$i] == '.' || $code_barras[$i] == ' ' || $code_barras[$i] == '-'){
		}else{
			echo $code_barras[$i];
	  }
	}
	
	?>
    </td>
  </tr>
  <tr>
    <td bgcolor="#99FF00"><strong>CÓD.</strong></td>
    <td bgcolor="#99FF00"><strong>DATA</strong></td>
    <td bgcolor="#99FF00"><strong>OPERADOR</strong></td>
    <td bgcolor="#99FF00"><strong>IP</strong></td>
    <td bgcolor="#99FF00"><strong>STATUS</strong></td>
    <td bgcolor="#99FF00"><strong>FORMA PGT.</strong></td>
  </tr>
  <tr>
    <td><? echo @$res_boleto['code_boleto']; ?></td>
    <td><? echo @$res_boleto['data_completa']; ?></td>
    <td><? echo @$res_boleto['operador']; ?></td>
    <td><? echo @$res_boleto['ip']; ?></td>
    <td><? echo @$res_boleto['status']; ?></td>
    <td><? echo @$res_boleto['forma_pagamento']; ?></td>
  </tr>
  <tr>
    <td bgcolor="#99FF00"><strong>VALOR</strong></td>
    <td bgcolor="#99FF00"><strong>DESCONTOS</strong></td>
    <td bgcolor="#99FF00"><strong>JUROS</strong></td>
    <td bgcolor="#99FF00"><strong>TARIFA CARTÃO</strong></td>
    <td bgcolor="#99FF00"><strong>BOLETO VENCIDO</strong></td>
    <td bgcolor="#99FF00"><strong>TARIFA RECEBIMENTO</strong></td>
  </tr>
  <tr>
    <td><? echo @number_format($res_boleto['valor'], 2, ',', '.'); ?></td>
    <td><? echo @number_format($res_boleto['desconto'], 2, ',', '.'); ?></td>
    <td><? echo @number_format($res_boleto['juros'], 2, ',', '.'); ?></td>
    <td><? echo @number_format($res_boleto['tarifa_cartao'], 2, ',', '.'); ?></td>
    <td><? echo @$res_boleto['confirma_boleto_vencido']; ?></td>
    <td><? echo @number_format($res_boleto['boleto_vencido'], 2, ',', '.'); ?></td>
  </tr>
  <tr>
    <td bgcolor="#99FF00"><strong>TARIFA VENCIDO</strong></td>
    <td bgcolor="#99FF00"><strong>TARIFA IMPRESSÃO</strong></td>
    <td bgcolor="#99FF00"><strong>VALOR RECEBIDO</strong></td>
    <td bgcolor="#99FF00"><strong>TIPO</strong></td>
    <td bgcolor="#99FF00"><strong>BANCO/ORGÃO</strong></td>
    <td bgcolor="#99FF00"><strong>VENCIMENTO</strong></td>
  </tr>
  <tr>
    <td><? echo @number_format($res_boleto['boleto_vencido'], 2, ',', '.'); ?></td>
    <td><? echo @number_format($res_boleto['boleto_impresso'], 2, ',', '.'); ?></td>
    <td><? echo @number_format($res_boleto['valor_recebido'], 2, ',', '.'); ?></td>
    <td><? echo @$res_boleto['tipo']; ?></td>
    <td><? echo @$res_boleto['banco']; ?></td>
    <td><? echo @$res_boleto['vencimento']; ?></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#99FF00"><strong>CLIENTE</strong></td>
    <td colspan="2" bgcolor="#99FF00"><strong>TELEFONE</strong></td>
    <td bgcolor="#99FF00">&nbsp;</td>
    <td bgcolor="#99FF00">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><? echo @$res_boleto['cliente']; ?></td>
    <td colspan="2"><? echo @$res_boleto['telefone']; ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<? } ?>
</div><!-- box -->
</body>
</html>