<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/relatorio_mensal.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="box_relatorio_mensal">
<h1><strong>RELATÓRIO DO MÊS</strong></h1>
<hr />
<table width="1190" border="0">
  <tr>
    <td width="49">DIA</td>
    <td width="89" bgcolor="#00CCFF"><strong>PRODUTO</strong></td>
    <td width="80" bgcolor="#00CCFF"><strong>LUCRO</strong></td>
    <td width="94" bgcolor="#FFCC33"><strong>RECARGA</strong></td>
    <td width="75" bgcolor="#FFCC33"><strong>LUCRO</strong></td>
    <td width="123" bgcolor="#FFFF00"><strong>TV PRE-PAGO</strong></td>
    <td width="66" bgcolor="#FFFF00"><strong>LUCRO</strong></td>
    <td width="128" bgcolor="#339999"><strong> PAGAMENTOS</strong></td>
    <td width="65" bgcolor="#339999"><strong>LUCRO</strong></td>
    <td width="102" bgcolor="#99FF33"><strong>GIFT CARD</strong></td>
    <td width="88" bgcolor="#99FF33"><strong>LUCRO</strong></td>
    <td width="119" bgcolor="#CCCCCC"><strong>MOVIMENTO</strong></td>
    <td width="68" bgcolor="#CCCCCC"><strong>LUCRO</strong></td>
  </tr>
 <? for($i=1; $i<32; $i++){ ?>
  <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
    <td><? echo $i; ?></td>
    <td><? 
	$soma_produto = 0;
	
	$sql_produto = mysqli_query($conexao_db, "SELECT * FROM ");
	
	?></td>
    <td><? 
	$soma_recarga = 0;
	$soma_recarga_lucro = 0;
	
	$sql_recarga = mysqli_query($conexao_db, "SELECT * FROM recarga_prepago");
		while($res_recarga = mysqli_fetch_array($sql_recarga)){
			$soma_recarga = $res_recarga['valor']+$soma_recarga;
			$soma_recarga_lucro = $res_recarga['lucro']+$soma_recarga_lucro;
		}
	
		echo $soma_recarga;
	
	?></td>
    <td>&nbsp;</td>
    <td><? echo $soma_recarga_lucro; ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
 <? } ?>
</table>
</div><!-- box_relatorio_mensal -->
</body>
</html>