<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/listar_ganhadores.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="box">
<?
require "../../conexao.php";
$code_jogo = $_GET['id'];
$sql_busca_premio = mysql_query("SELECT * FROM bolaodasorte WHERE status = 'premiado' AND code_jogo = '$code_jogo'");
$sql_busca_premio2 = mysql_query("SELECT * FROM bolaodasorte WHERE situacao_pag = 'AGUARDA PAGAMENTO' AND code_jogo = '$code_jogo'");
if(mysql_num_rows($sql_busca_premio) == ''){
	echo "Não foi encontrado ganhadores para este jogo!";
}else{
?>
<table width="780" border="0">
  <tr>
    <td align="center" width="81" bgcolor="#669933"><strong>DATA</strong></td>
    <td align="center" width="84" bgcolor="#669933"><strong>Nº APOSTA</strong></td>
    <td align="center" width="105" bgcolor="#669933"><strong>APOSTADOR</strong></td>
    <td align="center" width="84" bgcolor="#669933"><strong>V. PRÊMIO</strong></td>
    <td align="center" width="127" bgcolor="#669933"><strong>SIT. PAGT.</strong></td>
    <td align="center" width="104" bgcolor="#669933"><strong>FORM. PAGT</strong></td>
    <td align="center" width="135" bgcolor="#669933"><strong>D. PAGAMENTO</strong></td>
  </tr>
  <?
    $i=0;
  	while($res_premio = mysql_fetch_array($sql_busca_premio)){
		$i++;
  ?>
  <tr <? if($i%2 == 0){ echo "bgcolor='#0099CC'"; }else{ echo "bgcolor='#DFFFE8'"; }?>>
    <td align="center"><? echo $res_premio['data_completa']; ?></td>
    <td align="center"><? echo $res_premio['num_aposta']; ?></td>
    <td align="center"><? echo $res_premio['cliente']; ?></td>
    <td align="center">R$ <? echo number_format($res_premio['valor_premio'],2); ?></td>
    <td align="center"><? echo $res_premio['situacao_pag']; ?></td>
    <td align="center"><? echo $res_premio['form_pag_premio']; ?></td>
    <td align="center"><? echo $res_premio['data_pagamento']; ?></td>
  </tr>
  <? } ?>
  
  
  <?
    $i=0;
  	while($res_premio = mysql_fetch_array($sql_busca_premio2)){
		$i++;
  ?>
  <tr <? if($i%2 == 0){ echo "bgcolor='#0099CC'"; }else{ echo "bgcolor='#DFFFE8'"; }?>>
    <td align="center"><? echo $res_premio['data_completa']; ?></td>
    <td align="center"><? echo $res_premio['num_aposta']; ?></td>
    <td align="center"><? echo $res_premio['cliente']; ?></td>
    <td align="center">R$ <? echo number_format($res_premio['valor_premio'],2); ?></td>
    <td align="center"><? echo $res_premio['situacao_pag']; ?></td>
    <td align="center"><? echo $res_premio['form_pag_premio']; ?></td>
    <td align="center"><? echo $res_premio['data_pagamento']; ?></td>
  </tr>
  <? } ?>  
  
</table>

<? } ?>
</div><!-- box -->
</body>
</html>