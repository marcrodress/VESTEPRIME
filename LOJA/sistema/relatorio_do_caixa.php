<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/relatorio_do_caixa.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="box_caixa">
 <h1>Fluxo do caixa - Mês: <? $mes = date("m"); $ano = date("Y"); echo "$mes/$ano"; ?></h1>
 <a class="a" href="">Registrar a entreda de crédito</a> - <a class="a" href="">Registrar entrada de débito</a>
<?
 $sql_1 = mysql_query("SELECT * FROM relatorio_do_caixa WHERE mes = '$mes' AND ano = '$ano'");
 if(mysql_num_rows($sql_1) == ''){
  echo "<h2>Ainda não foi gerado fluxo de caixa para este mês!</h2>";
 }else{
?>
<table width="1180" border="0">
  <tr>
    <td width="155"><strong>Data e hora de registro:</strong></td>
    <td width="92"><strong>Data:</strong></td>
    <td width="102"><strong>T. Registro:</strong></td>
    <td width="144"><strong>Código do serviço:</strong></td>
    <td width="176"><strong>Serviço:</strong></td>
    <td width="108"><strong>CPF do cliente:</strong></td>
    <td width="85"><strong>Valor:</strong></td>
    <td width="154"><strong>Forma de recebimento:</strong></td>
    <td width="57"><strong>Lucro:</strong></td>
    <td width="63">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="10"><hr></td>
  </tr>
<? while($res_1 = mysql_fetch_array($sql_1)){ ?>
  <tr>
    <td><? echo $res_1['date_complet']; ?></td>
    <td><? echo $res_1['date']; ?></td>
    <td><? echo $res_1['tipo']; ?></td>
    <td><? echo $res_1['codigo']; ?></td>
    <td><? echo $res_1['motivo']; ?></td>
    <td><? echo $res_1['cpf']; ?></td>
    <td>R$ <? echo number_format($res_1['valor'],2,",","."); ?></td>
    <td><? echo $res_1['forma_de_recebimento']; ?></td>
    <td>R$ <? echo number_format($res_1['lucro'],2,",","."); ?></td>
    <td><a href="c"><img src="img/deleta.jpg" width="18" height="18" border="0" title="Romover esta movimentação" /></a></td>
  </tr>
  <tr>
    <td colspan="10"><hr></td>
  </tr>
<? }} ?>  
  <tr>
    <td colspan="9">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="9"><strong>RESUMO DO FLUXO DE CAIXA:</strong>
      <hr /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>MOVIMENTA&Ccedil;&Atilde;O:</strong></td>
    <td colspan="2"><strong>CR&Eacute;DITOS:</strong></td>
    <td><strong>D&Eacute;BITOS:</strong></td>
    <td colspan="6"><strong>VALOR EM CAIXA:</strong></td>
    </tr>
  <tr>
    <td>
	 R$ <?
	 $soma_valor = mysql_query("SELECT SUM(valor) as soma FROM relatorio_do_caixa WHERE mes = '$mes' AND ano = '$ano'");
	 	while($res_soma_valor = mysql_fetch_array($soma_valor)){
			echo number_format($res_soma_valor["soma"],2,",",".");
	  }	
	 ?>
     </td>
    <td colspan="2">
	 R$
	    <?
	 $soma_valor = mysql_query("SELECT SUM(lucro) as soma FROM relatorio_do_caixa WHERE mes = '$mes' AND ano = '$ano' AND tipo = 'Crédito'");
	 	while($res_soma_valor = mysql_fetch_array($soma_valor)){
			echo number_format($res_soma_valor["soma"],2,",",".");
	  }	
	 ?>
     </td>    
    <td>R$ <?
	 $soma_valor = mysql_query("SELECT SUM(lucro) as soma FROM relatorio_do_caixa WHERE mes = '$mes' AND ano = '$ano' AND tipo = 'Débito'");
	 	while($res_soma_valor = mysql_fetch_array($soma_valor)){
			echo number_format($res_soma_valor["soma"],2,",",".");
	  }	
	 ?></td>
    <td colspan="6">
	 R$
	 <?
	$soma_valor = mysql_query("SELECT SUM(lucro) as soma FROM relatorio_do_caixa WHERE mes = '$mes' AND ano = '$ano' AND tipo = 'Crédito'");
	$soma_valor2 = mysql_query("SELECT SUM(lucro) as soma FROM relatorio_do_caixa WHERE mes = '$mes' AND ano = '$ano' AND tipo = 'Débito'");
	 	while($res_soma_valor = mysql_fetch_array($soma_valor)){
			$soma1 = $res_soma_valor["soma"];
	 	while($res_soma_valor2 = mysql_fetch_array($soma_valor2)){
			$soma2 = $res_soma_valor2["soma"];
			
			echo number_format($soma1-$soma2,2,",",".");
			
	  }}	
	 ?></td>
    </tr>
</table>
 
</div><!-- box_caixa -->
</body>
</html>