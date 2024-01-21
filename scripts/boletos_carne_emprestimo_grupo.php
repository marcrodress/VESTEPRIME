<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>BOLETO DE PAGAMENTO</title>
<link href="css/boletos_carne_emprestimo.css" rel="stylesheet" type="text/css" />
</head>

<body>
<h1 style="font:15px Arial, Helvetica, sans-serif; margin:0; padding:0;">&nbsp;</h1>
<p style="font:15px Arial, Helvetica, sans-serif; margin:0; padding:0;">&nbsp;</p>
<p style="font:15px Arial, Helvetica, sans-serif; margin:0; padding:0;">&nbsp;</p>
<p style="font:15px Arial, Helvetica, sans-serif; margin:0; padding:0;">&nbsp;</p>
<p style="font:15px Arial, Helvetica, sans-serif; margin:0; padding:0;">&nbsp;</p>
<h1 style="font:15px Arial, Helvetica, sans-serif; margin:0; padding:0;">
<strong>------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</strong></h1>
<br />
<?
require "../conexao.php";
$proposta = $_GET['proposta'];
$codigo_barras = 0;
$vencimento = 0;
$valor = 0;

$parcelas = 0;

$sql_emprestimo = mysqli_query($conexao_bd, "SELECT * FROM emprestimo_boleto_unico WHERE n_proposta = '$proposta'");
while($res_emprestimo = mysqli_fetch_array($sql_emprestimo)){
	$parcelas = $res_emprestimo['quant_parcela'];
}


$sql_boletos = mysqli_query($conexao_bd, "SELECT * FROM boletos_emprestimo_boleto WHERE proposta = '$proposta'");
while($res_boletos = mysqli_fetch_array($sql_boletos)){
	$codigo_barras = $res_boletos['codigo_barras'];
	
	$vencimento1 = $codigo_barras[40];
	$vencimento2 = $codigo_barras[41];
	$vencimento3 = $codigo_barras[42];
	$vencimento4 = $codigo_barras[43];
	
	$vencimento = "$vencimento1$vencimento2$vencimento3$vencimento4";
	
	$valor00 = $codigo_barras[48];
	$valor0 = $codigo_barras[49];
	$valor1 = $codigo_barras[50];
	$valor2 = $codigo_barras[51];
	$valor3 = $codigo_barras[52];
	$valor4 = $codigo_barras[53];
	
	$valor = ("$valor00$valor0$valor1$valor2.$valor3$valor4")+0;
		
$sql_pega_vencimento = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento WHERE codigo = '$vencimento'");
while($res_pega_vencimento = mysqli_fetch_array($sql_pega_vencimento)){
	$vencimento = $res_pega_vencimento['vencimento'];
}
	
	
?>
<table width="1000" border="0">
  <tr>
    <td width="156"><strong>PARCELA</strong><br />
      <? echo $res_boletos['parcela']; ?> / <? echo $parcelas; ?></td>
    <td width="126" align="center" rowspan="3"><img src="
      <?

	  $banco = $res_boletos['codigo_barras'];
      
	  $banco1 = $banco['0'];
	  $banco2 = $banco['1'];
	  $banco3 = $banco['2'];
	  
	  $banco = "$banco1$banco2$banco3";

		echo "https://seeklogo.com/images/B/Banco_do_Brasil-logo-5A0937E9EF-seeklogo.com.png";
	  
	 /* if($banco == '077'){
		echo "https://upload.wikimedia.org/wikipedia/commons/c/c1/Bancointer_oficial.png";
	  }elseif($banco == '341'){
		echo "https://tradersclub.com.br/wp-content/uploads/2019/01/itau.jpg";
	  }elseif($banco == '212'){
		echo "https://upload.wikimedia.org/wikipedia/commons/a/a5/LogoBancoOriginal.jpg";
	  }elseif($banco == '237'){
		echo "https://banco.bradesco/portal/layout/imagens/geral/logo.png";
	  }elseif($banco == '318'){
		echo "https://upload.wikimedia.org/wikipedia/commons/thumb/c/ca/Banco_BMG.svg/1200px-Banco_BMG.svg.png";
	  }else{
	  	echo "https://i0.wp.com/metacarpo.com.br/wp-content/uploads/2015/07/Emiss%C3%A3o-2-via-Boleto-Banco-do-Brasil.jpg";
	  }
	  
	  */
	  ?>    
    " width="94" height="54" /></td>
    <td colspan="4"><h1 style="font:20px Arial, Helvetica, sans-serif; margin:0; padding:0;"><strong> <? echo $banco; ?> - 9 | <? echo $codigo_barras; ?></strong></h1></td>
  </tr>
  <tr>
    <td width="156" bgcolor="#CCCCCC"><strong>Vencimento</strong><br />
    <? echo $vencimento; ?></td>
    <td colspan="3"><strong>Local de Pagamento </strong><br />Pagavel em qualquer banco at&eacute; o vencimento </td>
    <td width="218" bgcolor="#CCCCCC"><strong>Vencimento</strong><br />
    <? echo $vencimento; ?></td>
  </tr>
  <tr>
    <td><strong>Ag&ecirc;ncia</strong><br />
    2622-2 / 26062-2</td>
    <td colspan="3"><strong>Benefici&aacute;rio</strong><br />
    Correspondente autorizado Banco do Brasil: Veste Prime</td>
    <td><strong>Ag&ecirc;ncia/ C&oacute;digo Benefici&aacute;rio</strong><br />
    2622-2 / 30604-5</td>
  </tr>
  <tr>
    <td><strong>Nosso N&uacute;mero</strong><br />
    <? echo $res_boletos['proposta']; ?></td>
    <td colspan="4" bgcolor="#FF9900"><strong style="font:20px Arial, Helvetica, sans-serif; margin:0; padding:0;">N&Atilde;O RECEBER AP&Oacute;S O VENCIMENTO</strong></td>
    <td><strong>Nosso N&uacute;mero</strong><br />
    <? echo $res_boletos['proposta']; ?></td>
  </tr>
  <tr>
    <td><strong>(=) Valor documento </strong><br />
      R$ <? echo number_format($valor,2, ',','.'); ?></td>
    <td colspan="4" rowspan="5"><strong>OBSERVA&Ccedil;&Otilde;ES AO CAIXA</strong><br />
        <li>N&atilde;o aceitar ap&oacute;s o vencimento</li>
        <li>N&atilde;o aceitar cheque para pagamento</li>
       <br />
      <strong>PREZADO CLIENTE</strong>
      <li>AP&Oacute;S O VENCIMENTO, SOLICITE OUTRO BOLETO PELO WHATSAPP (11) 96665-9661</li>
      <li>20 dias ap&oacute;s o vencimento o cliente ter&aacute; seu CPF inscrito nos ORG&Atilde;OS DE PROTE&Ccedil;&Atilde;O AO CR&Eacute;DITO.</li>
      <li>Ap&oacute;s o vencimento ser&aacute; cobrado multa de 9,99% e juros de 1% ao dia al&eacute;m do IOF.</li>
    </td>
    <td><strong>(=) Valor documento </strong><br />
      R$ <? echo number_format($valor,2, ',','.'); ?></td>
  </tr>
  <tr>
    <td><strong>LOCALIZADOR:</strong> <? echo $res_boletos['localizador']; ?></td>
    <td>(-) Desconto/abatimento <br /></td>
  </tr>
  <tr>
    <td>(+) Outras Dedu&ccedil;&otilde;es<br /></td>
    <td>(+) Outras Dedu&ccedil;&otilde;es<br /></td>
  </tr>
  <tr>
    <td>(+) Mora/multa<br /></td>
    <td>(+) Mora/multa<br /></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC"><strong>VALOR A RECERBER</strong><br />
      R$ <? echo number_format($valor,2, ',','.'); ?></td>
    <td bgcolor="#CCCCCC"><strong>VALOR A RECERBER</strong><br />
    R$ <? echo number_format($valor,2, ',','.'); ?></td>
  </tr>
  <tr>
    <td rowspan="2"><strong>OBS: </strong>Mantenha suas parcelas em dia para evitar uma eventual cobran&ccedil;a de juros e multas.</td>
    <td colspan="4"><strong>PAGADOR</strong><br />
    <?
    
	$sql_emprestimo = mysqli_query($conexao_bd, "SELECT * FROM emprestimo_boleto_unico WHERE n_proposta = '".$_GET['proposta']."'");
	 while($res_emprestimo = mysqli_fetch_array($sql_emprestimo)){
		$sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '".$res_emprestimo['cpf']."'");
			while($res_cliente = mysqli_fetch_array($sql_cliente)){
	?>
    <? echo strtoupper($res_cliente['nome']); ?><br />
    <? echo strtoupper($res_cliente['endereco']); ?> - <? echo strtoupper($res_cliente['n_residencia']); ?><br />
    <? echo strtoupper($res_cliente['cep']); ?> - <? echo strtoupper($res_cliente['bairro']); ?> - <? echo strtoupper($res_cliente['cidade']); ?> - <? echo strtoupper($res_cliente['estado']); ?></td>
    <td><strong>CPF DO PAGADOR</strong><br /> 
      <?
      $cpf = $res_emprestimo['cpf'];
	  echo $cpf[0];
	  echo $cpf[1];
	  echo $cpf[2];
	  echo ".";
	  echo $cpf[3];
	  echo $cpf[4];
	  echo $cpf[5];
	  echo ".";
	  echo $cpf[6];
	  echo $cpf[7];
	  echo $cpf[8];
	  echo "-";
	  echo $cpf[9];
	  echo $cpf[10];
	  
	  ?>
    <? }} ?>
</td>
  </tr>
  <tr>
    <td colspan="5"><img class="img" src="../img/code_barras.png" width="314" height="48" /></td>
  </tr>
</table>
<br /><br />
<h1 style="font:15px Arial, Helvetica, sans-serif; margin:0; padding:0;">
<strong>------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</strong></h1>
<p style="font:15px Arial, Helvetica, sans-serif; margin:0; padding:0;">&nbsp;</p>
<p style="font:15px Arial, Helvetica, sans-serif; margin:0; padding:0;">&nbsp;</p>
<p style="font:15px Arial, Helvetica, sans-serif; margin:0; padding:0;">&nbsp;</p>
<? } ?>
</body>
</html>