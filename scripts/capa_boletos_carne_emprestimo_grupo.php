<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>BOLETO DE PAGAMENTO</title>
<link href="css/capa_boletos_carne_emprestimo_grupo.css" rel="stylesheet" type="text/css" />
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


$sql_boletos = mysqli_query($conexao_bd, "SELECT * FROM boletos_emprestimo_boleto WHERE proposta = '$proposta' LIMIT 1");
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
    <td width="120" align="center" rowspan="6" bgcolor="#FFDBCA"><hr /> <strong>CORRESPONDENTE AUTORIZADO</strong><img src="../img/bb.png" width="166" height="149" />
    <hr />
    <h1 style="font:15px Arial, Helvetica, sans-serif;"><strong>VESTE PRIME</strong></h1>
    <p><img src="../img/telefone.png" width="86" height="80" /><span style="font:15px Arial, Helvetica, sans-serif;; font-family: Arial, Helvetica, sans-serif; font-size: 15px"><strong><br />(85) 99158.7323</strong></span></p>    <hr /></td>
    <td width="126" rowspan="3" align="center" bgcolor="#FFDBCA"><img src="../img/logo.png" width="196" height="102" /></td>
    <td colspan="2" bgcolor="#FFDBCA"><blockquote>
      <h1 style="font:20px Arial, Helvetica, sans-serif; margin:0; padding:0;"><strong> CARN&Ecirc; DE PAGAMENTO DE CR&Eacute;DITO PESSOAL</strong></h1>
    </blockquote></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#FFDBCA"><strong>CLIENTE:</strong><br />
    <?
    
	$sql_emprestimo = mysqli_query($conexao_bd, "SELECT * FROM emprestimo_boleto_unico WHERE n_proposta = '".$_GET['proposta']."'");
	 while($res_emprestimo = mysqli_fetch_array($sql_emprestimo)){
		$sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '".$res_emprestimo['cpf']."'");
			while($res_cliente = mysqli_fetch_array($sql_cliente)){
				echo $res_cliente['nome'];
			}}
	?>      <br /></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#FFDBCA"><strong>Vencimento das parcelas</strong><br /> O vencimento das parcelas será todo dia <strong>
    <?
    
	$sql_emprestimo = mysqli_query($conexao_bd, "SELECT * FROM emprestimo_boleto_unico WHERE n_proposta = '".$_GET['proposta']."'");
	 while($res_emprestimo = mysqli_fetch_array($sql_emprestimo)){
		$sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '".$res_emprestimo['cpf']."'");
			while($res_cliente = mysqli_fetch_array($sql_cliente)){
				echo $res_emprestimo['vencimento'];
			}}
	?></strong></td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#FFDBCA"><h1><strong>O cr&eacute;dito que chega no momento certo e na hora certa</strong>!</h1>
      <hr />
      <h1 style="font:15px Arial, Helvetica, sans-serif;"><strong>CENTRAL DE ATENDIMENTO</strong>
      </h2>
      </h1>
      <li> <strong>WhatsApp:</strong> (11) 96665-9661</li>
      <li>20 dias ap&oacute;s o vencimento o cliente ter&aacute; seu CPF inscrito nos ORG&Atilde;OS DE PROTE&Ccedil;&Atilde;O AO CR&Eacute;DITO.</li>
      <li>Ap&oacute;s o vencimento ser&aacute; cobrado multa de 9,99% e juros de 1% ao dia al&eacute;m do IOF.</li>    </td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#FFDBCA"><strong>PAGADOR</strong><br />
      <?
    
	$sql_emprestimo = mysqli_query($conexao_bd, "SELECT * FROM emprestimo_boleto_unico WHERE n_proposta = '".$_GET['proposta']."'");
	 while($res_emprestimo = mysqli_fetch_array($sql_emprestimo)){
		$sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '".$res_emprestimo['cpf']."'");
			while($res_cliente = mysqli_fetch_array($sql_cliente)){
	?>
      <? echo strtoupper($res_cliente['nome']); ?><br />
      <? echo strtoupper($res_cliente['endereco']); ?> - <? echo strtoupper($res_cliente['n_residencia']); ?><br />
    <? echo strtoupper($res_cliente['cep']); ?> - <? echo strtoupper($res_cliente['bairro']); ?> - <? echo strtoupper($res_cliente['cidade']); ?> - <? echo strtoupper($res_cliente['estado']); ?><br /> 

    <? }} ?></td>
  </tr>
  <tr>
    <td height="65" colspan="3" bgcolor="#FFDBCA"><h1>Solicite seu cr&eacute;dito e parcele em at&eacute; 36X fixas no boleto</h1>
        <strong>CORRESPONDENTE AUTORIZADO:</strong> <br />
        VESTE PRIME - RUA CAPIT&Atilde;O IN&Aacute;CIO PRATA, 2010 - TAIBA - S&Atilde;O GON&Ccedil;ALO DO AMARANTE - CEAR&Aacute; - CEP: 62670-000</td>
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