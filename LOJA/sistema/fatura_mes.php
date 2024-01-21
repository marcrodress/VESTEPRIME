<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/fatura_mes.css" rel="stylesheet" type="text/css" />
<link href="img/logo.png" rel="shortcut icon" />
</head>

<body>
<div id="box_faturas_do_mes">
 <h1><strong>Faturas do mês de <? echo date("m/Y"); ?></strong></h1>
 <hr />
<table width="1200" border="0">
  <tr>
    <td width="64" bgcolor="#999999"><strong>STATUS</strong></td>
    <td width="50" bgcolor="#999999"><strong>CODE</strong></td>
    <td width="244" bgcolor="#999999"><strong>CLIENTE</strong></td>
    <td width="102" bgcolor="#999999"><strong>CPF</strong></td>
    <td width="50" bgcolor="#999999"><strong>DÉBITOS</strong></td>
    <td width="58" bgcolor="#999999"><strong>CRÉDITOS</strong></td>
    <td width="68" bgcolor="#999999"><strong>VALOR</strong></td>
    <td width="61" bgcolor="#999999"><strong>MULTA</strong></td>
    <td width="65" bgcolor="#999999"><strong>JUROS</strong></td>
    <td width="82" bgcolor="#999999"><strong>VALOR PAGO</strong></td>
    <td width="93" bgcolor="#999999"><strong>VENCIMENTO</strong></td>
    <td width="141" bgcolor="#999999"><strong>SIT.PAG</strong></td>
    <td width="68" bgcolor="#999999">&nbsp;</td>
  </tr>
<? $i = 0;
$sql_faturas = mysql_query("SELECT * FROM faturas_fechadas WHERE mes_vencimento	= '".date("m")."'");
	while($res_faturas = mysql_fetch_array($sql_faturas)){ $i++;
?>
  <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
    <td><? echo $res_faturas['status']; ?></td>
    <td><? echo $res_faturas['code_fatura']; ?></td>
    <td>
	<? 
    $sql_cliente= mysql_query("SELECT * FROM clientes WHERE cpf = '".$res_faturas['cliente']."'");
        while($res_clientes = mysql_fetch_array($sql_cliente)){
			echo $res_clientes['nome'];
			
		}
    ?>    
    </td>
    <td><? echo $res_faturas['cliente']; ?></td>
    <td>
	<?
	$debito = 0;
    $sql_busca_debito = mysql_query("SELECT * FROM lancamento_fechados WHERE code_fatura = '".$res_faturas['code_fatura']."'");
		while($res_debito = mysql_fetch_array($sql_busca_debito)){
				$debito = $debito+$res_debito['valor'];
		}
	?>
    <a rel="superbox[iframe][830x400]" href="scripts/busca_debitos_prime_card.php?code_fatura=<? echo $res_faturas['code_fatura']; ?>"><? echo number_format($debito,2); ?></a>
    </td>
    <td>
	<?
	$credito = 0;
    $sql_busca_pagamento = mysql_query("SELECT * FROM pagamentos_fechados WHERE code_fatura = '".$res_faturas['code_fatura']."'");
		while($res_pagamento = mysql_fetch_array($sql_busca_pagamento)){
				$credito = 0+$res_pagamento['valor'];
		} echo $credito;
	?>    
    </td>
    <td><? echo $res_faturas['valor']; ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><? echo $res_faturas['valor_pago']; ?></td>
    <td><? echo $res_faturas['vencimento']; ?></td>
    <td><? echo $res_faturas['sit_pag']; ?></td>
    <td><img src="img/enviar_email.jpg" width="20" height="20">
    </td>
  </tr>
<? } // fecha ?>
</table> 
</div><!-- box_faturas_do_mes -->
</body>
</html>