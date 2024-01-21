<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/bolao_sorte.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>
</head>

<body>
<div id="box_jogos">
<h1><strong>Jogos do Bolão da Sorte</strong><hr /></h1>
<a class="a" rel="superbox[iframe][620x100]" href="jogos/cadastrar.php">CADASTRAR JOGO</a>

<form name="form" id="form">
  <select class="select" name="jumpMenu" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">
    <option value=""></option>
    <option value="?pack=bolao_sorte&serie=A">SÉRIE A</option>
    <option value="?pack=bolao_sorte&serie=B">SÉRIE B</option>
  </select>
</form>
<p></p>
<hr />
<table width="1190" border="0">
  <tr>
    <td align="center" width="50" bgcolor="#009999"><strong>COD.</strong></td>
    <td align="center" width="60" bgcolor="#009999"><strong>STATUS</strong></td>
    <td align="center" width="64" bgcolor="#009999"><strong>DATA</strong></td>
    <td align="center" width="47" bgcolor="#009999"><strong>HORA</strong></td>
    <td align="center" width="47" bgcolor="#009999"><strong>SÉRIE</strong></td>
    <td align="center" width="141" bgcolor="#009999"><strong>TIME 1 | GOL 1</strong></td>
    <td align="center" width="140" bgcolor="#009999"><strong>TIME 2 | GOL 2</strong></td>
    <td align="center" width="68" bgcolor="#009999"><strong>Q. APOSTA</strong></td>
    <td align="center" width="106" bgcolor="#009999"><strong>V. ACUMULADO</strong></td>
    <td align="center" width="87" bgcolor="#009999"><strong>S. ANTERIOR</strong></td>
    <td align="center" width="98" bgcolor="#009999"><strong>Q.GANHADORES</strong></td>
    <td align="center" width="86" bgcolor="#009999"><strong>V. GANHADOR</strong></td>
    <td align="center" width="114" bgcolor="#009999">&nbsp;</td>
  </tr>
<? 

$serie = $_GET['serie'];
$i=0;

$verifica_jogo = mysql_query("SELECT * FROM partida WHERE serie = '$serie' ORDER BY id DESC LIMIT 50");
while($res_jogo = mysql_fetch_array($verifica_jogo)){ $i++;
	
?>
  <tr <? if($i%2 == 0){ echo "bgcolor='#0099CC'"; }else{ echo "bgcolor='#DFFFE8'"; }?>>
    <td align="center"><? echo $code_jogo = $res_jogo['code']; ?></td>
    <td align="center"><? echo $res_jogo['status']; ?></td>
    <td align="center"><? echo $res_jogo['data']; ?></td>
    <td align="center"><? echo $res_jogo['hora']; ?></td>
    <td align="center"><? echo $res_jogo['serie']; ?></td>
    <td align="center"><? $time1 = $res_jogo['time1']; 
	$busca_jogo = mysql_query("SELECT * FROM time WHERE id = '$time1'");
	while($res_busca_jogo = mysql_fetch_array($busca_jogo)){
		echo $res_busca_jogo['time'];
	}
	?> - <? echo $res_jogo['gol1']; ?> gol(s)</td>
    <td align="center"><? $time2 = $res_jogo['time2']; 
	$busca_jogo = mysql_query("SELECT * FROM time WHERE id = '$time2'");
	while($res_busca_jogo = mysql_fetch_array($busca_jogo)){
		echo $res_busca_jogo['time'];
	}
	?> - <? echo $res_jogo['gol2']; ?> gol(s)</td>
    <td align="center"><? echo mysql_num_rows(mysql_query("SELECT * FROM bolaodasorte WHERE code_jogo = '$code_jogo'")); ?></td>
    <td align="center">R$ <? $valor_acumulado = number_format(((mysql_num_rows(mysql_query("SELECT * FROM bolaodasorte WHERE code_jogo = '$code_jogo' AND status = 'Ativo'"))+mysql_num_rows(mysql_query("SELECT * FROM bolaodasorte WHERE code_jogo = '$code_jogo' AND status = 'premiado'")))*0.5874),2);
	
	if($valor_acumulado <2){
		echo number_format("2",2);
	}else{
		echo $valor_acumulado;
	}
	 ?></td>
    <td align="center">R$ <? echo number_format($res_jogo['s_anterior'],2); ?></td>
    <td align="center"><? echo (mysql_num_rows(mysql_query("SELECT * FROM bolaodasorte WHERE code_jogo = '$code_jogo' AND status = 'premiado'")))+(mysql_num_rows(mysql_query("SELECT * FROM bolaodasorte WHERE code_jogo = '$code_jogo' AND situacao_pag = 'AGUARDA PAGAMENTO'"))); ?></td>
    <td align="center">R$ 
    <?
	$sql_busca_premio = mysql_query("SELECT * FROM bolaodasorte WHERE code_jogo = '$code_jogo' AND status = 'premiado' LIMIT 1");
	if(mysql_num_rows($sql_busca_premio) == ''){
		while($res_premiado = mysql_fetch_array($sql_busca_premio)){
			echo number_format($res_premiado['valor_premio'],2);
		}
	}else{
	$sql_busca_premio = mysql_query("SELECT * FROM bolaodasorte WHERE code_jogo = '$code_jogo' AND situacao_pag = 'AGUARDA PAGAMENTO' LIMIT 1");
		while($res_premiado = mysql_fetch_array($sql_busca_premio)){
			echo number_format($res_premiado['valor_premio'],2);
		}}
	?>
    </td>
    <td align="center">
    <a rel="superbox[iframe][370x100]" href="jogos/informar_resultado_bolaodasorte.php?code_partida=<? echo $res_jogo['code']; ?>&saldo_aposta=<? echo $valor_acumulado; ?>"><img src="img/resultado.png" width="18" height="18" border="0" title="Incluir resultado de jogo" /></a>
    <? if($res_jogo['status'] == 'Ativo'){ ?>
    <a href="?pack=bolao_sorte&pg=bloquea&id=<? echo $res_jogo['id']; ?>&serie=<? echo $_GET['serie']; ?>"><img src="img/bloquea.png" width="18" height="18" border="0" title="Bloquear apostas" /></a>
	<? } ?>
    <? if($res_jogo['status'] != 'Ativo'){ ?>  
    <a href="?pack=bolao_sorte&pg=ativa&id=<? echo $res_jogo['id']; ?>&serie=<? echo $_GET['serie']; ?>"><img src="img/correto.jpg" width="18" height="18" border="0" title="Reativar jogo" /></a>
	<? } ?>



    <a rel="superbox[iframe][820x300]" href="jogos/listar_ganhadores.php?id=<? echo $res_jogo['code']; ?>"><img src="img/lista_ganhadores.png" width="18" height="18" border="0" title="Mostrar ganhadores" /></a>





	<? if($res_jogo['status'] != 'Excluido'){ ?>  
    <a href="?pack=bolao_sorte&pg=excluir&id=<? echo $res_jogo['id']; ?>&serie=<? echo $_GET['serie']; ?>"><img src="img/deleta.jpg" width="18" height="18" border="0" title="Excluir Jogo" /></a>
    <? } ?>

    </td>
  </tr>
<? } ?>
</table>

</div><!-- box_jogos -->
</body>
</html>
<? if(@$_GET['pg'] == 'bloquea'){

$ids = $_GET['id'];
$serie = $_GET['serie'];


mysql_query("UPDATE partida SET status = 'Encerrado' WHERE id = '$ids'");

echo "<script language='javascript'>window.location='?pack=bolao_sorte&serie=$serie';</script>";

}?>

<? if(@$_GET['pg'] == 'ativa'){

$ids = $_GET['id'];
$serie = $_GET['serie'];

mysql_query("UPDATE partida SET status = 'Ativo' WHERE id = '$ids'");

echo "<script language='javascript'>window.location='?pack=bolao_sorte&serie=$serie';</script>";

}?>

<? if(@$_GET['pg'] == 'excluir'){

$ids = $_GET['id'];
$serie = $_GET['serie'];

mysql_query("UPDATE partida SET status = 'Excluido' WHERE id = '$ids'");

echo "<script language='javascript'>window.location='?pack=bolao_sorte&serie=$serie';</script>";

}?>