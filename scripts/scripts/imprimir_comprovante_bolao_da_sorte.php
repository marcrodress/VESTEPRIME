<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/imprimir_comprovante_bolao_da_sorte.css" rel="stylesheet" type="text/css" />
<? require "../conexao.php"; ?>
</head>

<body>
<?
$num_aposta = $_GET['num_aposta'];

$sql_select = mysqli_query($conexao_bd, "SELECT * FROM bolaodasorte WHERE num_aposta = '$num_aposta'");
if(mysqli_num_rows($sql_select) == ''){
	echo "N�o foram encontradas apostas com o n�mero";
}else{
	while($res_mostra_aposta = mysqli_fetch_array($sql_select)){
	
  $placar1 = $res_mostra_aposta['placar1']; 
  $placar2 = $res_mostra_aposta['placar2'];

  
 $sql_partida = mysqli_query($conexao_bd, "SELECT * FROM partida WHERE code = '".$res_mostra_aposta['code_jogo']."'");
	while($res_partida = mysqli_fetch_array($sql_partida)){

	  $data_jogo = $res_partida['data'];
	  $code_jogo = $res_partida['code'];	

	  $time1 = $res_partida['time1'];	
	  $time2 = $res_partida['time2'];	

  
 $sql_time1 = mysqli_query($conexao_bd, "SELECT * FROM time WHERE id = '$time1'");
	while($res_time1 = mysqli_fetch_array($sql_time1)){

	  $nome_time1 = $res_time1['time'];	

  
 $sql_time2 = mysqli_query($conexao_bd, "SELECT * FROM time WHERE id = '$time2'");
	while($res_time2 = mysqli_fetch_array($sql_time2)){
		
	  $nome_time2 = $res_time2['time'];	


?>
<table width="305" border="1">
  <tr>
    <td colspan="3" align="center" bgcolor="#0033CC"><h2><img src="../img/logo.png" width="266" height="124" /></h2>
        <h2>BOL�O DA SORTE S�RIE <? echo  $res_partida['serie']; ?> <br />
        JOGO N&ordm;: <? echo $res_partida['code']; ?><br />
          
  <? echo $res_mostra_aposta['data_completa']; ?></h2>
    </td>
  </tr>
  <tr>
    <td colspan="4" bgcolor="#CCCCCC"><strong>BILHETe de jogo emitido por <br /> 
    VESTE PRIME - VESTU&Aacute;RIO E ACESS&Oacute;RIOS DE CELULARES
</strong><br />
cnpj: 32.450.862/0001-02 <br />
RUA capit&atilde;o in&aacute;cio prata - 2010 - Taiba <br />
s&atilde;o gon&ccedil;alo do amarante - cear&aacute; <br />
<strong>cep: </strong>62670-000 <br />
<strong>telefone: </strong>(85) 3315.6219</td>
  </tr>
  <tr>  
  <tr>
    <td bgcolor="#FFFFFF" colspan="3" align="center"><span class="h3"><strong>BILHETE DE APOSTA N&ordm;</strong> <? echo $res_mostra_aposta['num_aposta']; ?> <br />
      <strong>AUTENTICA&Ccedil;&Atilde;O DE APOSTA </strong><? echo $res_mostra_aposta['autenticacao']; ?></span></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#CCCCCC"><strong>apostador</strong></td>
    <td width="154" bgcolor="#CCCCCC"><strong>STATUS</strong></td>
  </tr>
  <tr>
    <td colspan="2"><? echo $res_mostra_aposta['cliente']; ?></td>
    <td><? echo $res_mostra_aposta['status']; ?></td>
  </tr>
  <tr>
    <td colspan="2"><strong>form. pagto.</strong></td>
    <td><strong>valor</strong></td>
  </tr>
  <tr>
    <td colspan="2"><? echo $res_mostra_aposta['forma_pagamento_aposta']; ?></td>
    <td><? echo number_format($res_mostra_aposta['valor_aposta'],2); ?></td>
  </tr>
  <tr>
    <td colspan="3" align="center" bgcolor="#CCCCCC"><strong>data de jogo</strong><br />
    <? echo  $res_partida['data']; ?> as <? echo  $res_partida['hora']; ?></td>
  </tr>
  <tr>
    <td width="47" bgcolor="#CCCCCC"><strong>PLACAR</strong></td>
    <td colspan="2" align="left" bgcolor="#CCCCCC"><strong>TIME</strong></td>
  </tr>
  <tr>
    <td bgcolor="#00CC00"><strong><? echo $placar1; ?></strong></td>
    <td align="left" colspan="2" bgcolor="#00CC00"><strong><? echo $nome_time1; ?></strong></td>
  </tr>
  <tr>
    <td bgcolor="#00CC00"><strong><? echo $placar2; ?></strong></td>
    <td align="left" colspan="2" bgcolor="#00CC00"><strong><? echo $nome_time2; ?></strong></td>
  </tr>
  <tr>
    <td colspan="3" align="left" bgcolor="#FFFFFF">O PR&Ecirc;MIO BRUTO A SER PAGO PELA VESTE PRIME CORRESPONDE EM UM PERCENTUAL DE ARRECADA&Ccedil;&Atilde;O E SER&Aacute; DIVIDIDO IGUALMENTE ENTRE TODOS OS APOSTADORES QUE ACERTEREM O PLACAR DO JOGO.
      <p>ESTE BILHETE &Eacute; O &Uacute;NICO COMPROVANTE DE APOSTA, SENDO SUA APRESENTA&Ccedil;&Atilde;O INDISPENSAVEL PARA RESGATE DO PR&Ecirc;MIO EM CASO DE ACERTO DO PLACAR.</p>
      <p>O PR&Ecirc;MIO SER&Aacute; PAGO EXCLUSIVAMENTE AO TITULAR DESTE BILHETE EM CASO DE ACERTO, SENDO OBRIGAT&Oacute;RIO A APRESENTA&Ccedil;&Atilde;O DE UM DOCUMENTO DE IDENTIFICA&Ccedil;&Atilde;O PARA RESGATE DO MESMO.</p>
      <p>O APOSTADOR QUE TIVER SEU BILHETE REGISTRADO, TER&Aacute; O VALOR PERCENTUAL RELATIVO AO PR&Ecirc;MIO TRANSFERIDO PARA SUA CONTA online veste prime.</p></td>
  </tr>
</table>
<? }}}}} ?>
</div><!-- topo_geral -->
</body>
</html>