<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/informar_resultado_bolaodasorte.css" rel="stylesheet" type="text/css" />
<? require "../../conexao.php"; ?>
<script src="../../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="box">
<? if(isset($_POST['button'])){

$time1 = $_POST['time1'];
$time2 = $_POST['time2'];
$acumulado = $_POST['acumulado'];

$code_jogo = $_GET['code_partida'];
$saldo_aposta = $_GET['saldo_aposta'];

$valor_premio_total = 0;

$sql_update = mysql_query("UPDATE partida SET gol1 = '$time1', gol2 = '$time2', v_acumulado = '$saldo_aposta', s_anterior = '$acumulado' WHERE code = '$code_jogo'");


$sql_confere_aposta = mysql_query("SELECT * FROM bolaodasorte WHERE code_jogo = '$code_jogo' AND placar1 = '$time1' AND placar2 = '$time2' AND status = 'Ativo'");
$total_de_apostas = mysql_num_rows($sql_confere_aposta);
if($total_de_apostas == ''){
}else{
$sql_select_jogo = mysql_query("SELECT * FROM partida WHERE code = '$code_jogo'");
	while($res_pega_acumulado = mysql_fetch_array($sql_select_jogo)){
		
		$v_acumulado = $res_pega_acumulado['v_acumulado'];
		$s_anterior = $res_pega_acumulado['s_anterior'];
		
		$valor_premio_total = number_format((($v_acumulado+$s_anterior)/$total_de_apostas),1);
		if($valor_premio_total <2){
			$valor_premio_total = 2;
		}else{
			$valor_premio_total = $valor_premio_total;
		}
		
		
		while($res_verifica_aposta = mysql_fetch_array($sql_confere_aposta)){
			
			$verifica_apostador = $res_verifica_aposta['cliente'];
			$num_aposta = $res_verifica_aposta['num_aposta'];
			
			$verifica_se_ha_conta = mysql_query("SELECT * FROM conta_corrente WHERE cliente = '$verifica_apostador'");
			if(mysql_num_rows($verifica_se_ha_conta) == ''){
				mysql_query("UPDATE bolaodasorte SET situacao_pag = 'AGUARDA PAGAMENTO', valor_premio = '$valor_premio_total', status = 'Ativo' WHERE num_aposta = '$num_aposta'");
			}else{
			 	while($res_inserir_saldo = mysql_fetch_array($verifica_se_ha_conta)){
			 			
						$novo_saldo = $res_inserir_saldo['saldo']+$valor_premio_total;
						
							mysql_query("UPDATE conta_corrente SET saldo = '$novo_saldo' WHERE cliente = '$verifica_apostador'");
							mysql_query("UPDATE bolaodasorte SET situacao_pag = 'PAGAMENTO EFETUADO', valor_premio = '$valor_premio_total',  data_pagamento = '$data_completa', form_pag_premio = 'CRÉDITO EM CONTA EASY CARD', status = 'premiado' WHERE num_aposta = '$num_aposta'");
							mysql_query("INSERT INTO fluxo_de_caixa (status, data, data_completa, dia, mes, ano, tipo_entrada, cliente, descricao, forma_recebimento, valor) VALUES ('Ativo', '$data', '$data_completa', '$dia', '$mes', '$ano', 'SAÍDA', '$verifica_apostador', 'PAGAMENTO DE JOGO - BOLÃO DA SORTE', 'TRANSFERÊNCIA DE VALOR PARA CONTA EASY LOAN', '$valor_premio_total')");


				}
			}
			
			
   }	
  }
 }
 echo "<strong>INFORMAÇÃO REGISTRADA COM SUCESSO!</strong><BR><br>Pressione F5 para mesclar a operação.";
 die;
}?>




<form action="" enctype="multipart/form-data" method="post">
<table width="341" border="0">
<?

?>
  <tr>
    <td width="93" bgcolor="#D9ECFF">
      <strong>
      <?
	
	$select_jogo = mysql_query("SELECT * FROM partida WHERE code = '".$_GET['code_partida']."'");
	while($res_jogo = mysql_fetch_array($select_jogo)){	
	
	$select_jogo = mysql_query("SELECT * FROM time WHERE id = '".$res_jogo['time1']."'");
	while($res_jogo = mysql_fetch_array($select_jogo)){
		echo $res_jogo['time'];
	}}
	?>
      </strong></td>
    <td width="99" bgcolor="#D9ECFF">
      <strong>
      <?
	
	$select_jogo = mysql_query("SELECT * FROM partida WHERE code = '".$_GET['code_partida']."'");
	while($res_jogo = mysql_fetch_array($select_jogo)){	
	
	
	$select_jogos = mysql_query("SELECT * FROM time WHERE id = '".$res_jogo['time2']."'");
	while($res_jogos = mysql_fetch_array($select_jogos)){
		echo $res_jogos['time'];
	}}
	?>    
      </strong></td>
    <td width="74" bgcolor="#D9ECFF"><strong>ACUMULADO</strong></td>
    <td width="57" bgcolor="#D9ECFF">&nbsp;</td>
  </tr>
  <tr>
    <td><label for="time1"></label>
      <span id="sprytextfield1">
      <input name="time1" type="text" id="time1" size="4" />
      <span class="textfieldRequiredMsg">.</span><span class="textfieldInvalidFormatMsg"></span></span></td>
    <td><label for="time2"></label>
      <span id="sprytextfield2">
      <input name="time2" type="text" id="time2" size="4" />
      <span class="textfieldRequiredMsg"></span><span class="textfieldInvalidFormatMsg"></span></span></td>
    <td><label for="textfield"></label>
      <input name="acumulado" type="text" id="textfield" size="5" /></td>
    <td><input class="input" type="submit" name="button" id="button" value="Enviar" /></td>
  </tr>
</table>
</form>
</div><!-- box -->
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "integer", {useCharacterMasking:true});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "integer", {useCharacterMasking:true});
</script>
</body>
</html>