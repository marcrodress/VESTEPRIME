<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/pagamento_de_bolao_da_sorte.css" rel="stylesheet" type="text/css" />
<? require "../conexao.php"; ?>

</head>

<body>
<?
$num_aposta = $_GET['num_aposta'];

$pag = $_GET['pag'];

if($pag == 2){
	$pag = "Dinheiro no caixa da loja";
}elseif($pag == 3){
	$pag = "DOC/TED";
}elseif($pag == 4){
	$pag = "Cheque";
}

mysqli_query($conexao_bd, "UPDATE bolaodasorte SET situacao_pag = 'PAGAMENTO EFETUADO', form_pag_premio = '$pag', data_pagamento = '$data_completa', status = 'premiado' WHERE num_aposta = '$num_aposta'");

$sql_select = mysqli_query($conexao_bd, "SELECT * FROM bolaodasorte WHERE num_aposta = '$num_aposta'");
if(mysqli_num_rows($sql_select) == ''){
	echo "Não foram encontradas apostas com o número";
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
    <td colspan="3" align="center" bgcolor="#0033CC"><h1><img src="../img/logo.png" width="300" height="160" />
      <hr /></h1> <h2>RECIBO DE ENTREGA E RECEBIMENTO DE PRÊMIO<hr /></h2><h2>BOLÃO DA SORTE SÉRIE <? echo  $res_partida['serie']; ?> <br />SORTEIO <? echo $res_partida['code']; ?><br />

<? echo $res_mostra_aposta['data_completa']; ?></h2>
  </td>
  </tr>
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
    <td><? echo $res_mostra_aposta['valor_aposta']; ?></td>
  </tr>
  <tr>
    <td colspan="2"><strong>VALOR DO PR&Ecirc;MIO</strong></td>
    <td><strong>RECEBIMENTO EM</strong></td>
  </tr>
  <tr>
    <td colspan="2"><? echo @number_format($res_mostra_aposta['valor_premio'],2); ?></td>
    <td><? echo $pag; ?></td>
  </tr>
 <? if($pag == 'DOC/TED'){ ?>
  <tr>
    <td colspan="2"><strong>BANCO</strong></td>
    <td><strong>TIPO DE CONTA</strong></td>
  </tr>
  <tr>
    <td colspan="2"><? echo $res_mostra_aposta['banco']; ?></td>
    <td><? echo $res_mostra_aposta['tipo_conta']; ?></td>
  </tr>
  <tr>
    <td colspan="2"><strong>AG&Ecirc;NCIA</strong></td>
    <td><strong>CONTA BANCARIA</strong></td>
  </tr>
  <tr>
    <td colspan="2"><? echo $res_mostra_aposta['agencia']; ?></td>
    <td><? echo $res_mostra_aposta['conta_bancaria']; ?></td>
  </tr>
  <? } ?>
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
    <td align="center" colspan="3" bgcolor="#FFFFFF">
   	DECLARO PARA DEVIDOS FINS DE PROVA QUE CONFIRMO O RECEBIMENTO DO PRÊMIO NO VALOR DE R$ <? echo @number_format($res_mostra_aposta['valor_premio'],2); ?> PAGO EM DINHEIRO PELA EASY LOAN RELATIVO AO JOGO BOLÃO DA SORTE NA DATA DE <? echo $data_completa ?> sob a forma de pagamento: <? echo $pag; ?>.
    <br /><br /><br /><br />
    
    _________________________________
    CLIENTE DE CPF:<BR /><BR /><BR /><BR />
    

    _________________________________
    Assinatura do operador:<BR /><BR />
  </td>
  </tr>
</table>
<? }}}}} ?>
</div><!-- topo_geral -->
</body>
</html>