<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">
body {
	font:12px Arial, Helvetica, sans-serif;
}
table{
	border-radius:0;
	border:1px solid #000;
}
table td{
	border:1px solid #000;
	border-radius:5px;
}
</style>
</head>

<body>
<h1 style="font:30px Arial, Helvetica, sans-serif;"><strong>BOLETO DE PAGAMENTO DE CR&Eacute;DITO PESSOAL</strong></h1>
<hr />
<?
require "../conexao.php";

$code_vencimento_hoje = 0;

$sql_code_vencimento = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento WHERE vencimento = '$data'");
while($res_code_vencimento = mysqli_fetch_array($sql_code_vencimento)){
	$code_vencimento_hoje = $res_code_vencimento['codigo'];
}

$proposta = $_GET['proposta'];
$codigo_barras = 0;
$vencimento = 0;
$valor = 0;

$parcelas = 0;
$id_parcela = $_GET['id'];

$sql_emprestimo = mysqli_query($conexao_bd, "SELECT * FROM emprestimo_boleto WHERE n_proposta = '$proposta'");
while($res_emprestimo = mysqli_fetch_array($sql_emprestimo)){
	$parcelas = $res_emprestimo['quant_parcela'];
}


$sql_boletos = mysqli_query($conexao_bd, "SELECT * FROM boletos_emprestimo_boleto WHERE id = '$id_parcela'");
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
<?
    
	$sql_emprestimo = mysqli_query($conexao_bd, "SELECT * FROM emprestimo_boleto WHERE n_proposta = '".$_GET['proposta']."'");
	 while($res_emprestimo = mysqli_fetch_array($sql_emprestimo)){
		$sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '".$res_emprestimo['cpf']."'");
			while($res_cliente = mysqli_fetch_array($sql_cliente)){
	?>
<table width="900" border="0">
  <tr>
    <td width="96" rowspan="2"><img src="../img/bb.png" width="96" height="96" /></td>
    <td colspan="5" align="center" bgcolor="#FFFFFF"><h1 style="font:20px Arial, Helvetica, sans-serif;"><strong>CORRESPONDE AUTORIZADO</strong></h1>
    <h1 style="font:20px Arial, Helvetica, sans-serif;"><strong>VESTE PRIME - VESTU&Aacute;RIO E ACESS&Oacute;RIOS</strong></h1></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#FFFFFF"><strong>CPF:</strong> <? echo strtoupper($res_cliente['cpf']); ?></td>
    <td colspan="3" bgcolor="#FFFFFF"><strong>CLIENTE:</strong> <? echo strtoupper($res_cliente['nome']); ?></td>
  </tr>
  <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><strong>PARCELA</strong></td>
    <td width="236" align="center" bgcolor="#FFFFFF"><strong>VALOR DA PARCELA</strong></td>
    <td width="131" bgcolor="#FFFFFF" align="center"><strong>MULTA</strong></td>
    <td width="178" align="center" bgcolor="#FFFFFF"><strong>JUROS</strong></td>
    <td width="178" bgcolor="#FFFFFF" align="center"><strong>VALOR ATUAL:</strong></td>
  </tr>
  <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><? echo $res_boletos['parcela']; ?> / <? echo $parcelas; ?></td>
    <td align="center" bgcolor="#FFFFFF">R$ <? echo number_format($valor,2, ',','.'); ?></td>
    <td align="center" bgcolor="#FFFFFF">
     <? 
	 $multa = 0;
	  if($res_boletos['status'] == 'AGUARDA' && $code_vencimento_hoje > $res_boletos['vencimento']){
	  $multa = $res_boletos['valor']*0.0999;
	   echo number_format($multa,2,',','.');
	 }
		?>
    </td>
    <td align="center" bgcolor="#FFFFFF">
		<? 
		$juros = 0;
		if($res_boletos['status'] == 'AGUARDA' && $code_vencimento_hoje > $res_boletos['vencimento']){
			$juros = $res_boletos['valor']*0.003*($code_vencimento_hoje-$res_boletos['vencimento']);
			echo number_format($juros,2,',','.');
		}
		?>    
    </td>
    <td align="center" bgcolor="#FFFFFF"><? echo number_format($juros+$multa+$valor,2,',','.'); ?></td>
  </tr>
</table>
<? }} ?>

<p>-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</p>
<table width="900" border="0">
  <tr>
    <td width="129" align="center" rowspan="3" bgcolor="#FFFFFF"><img src="
      <?

	  $banco = $res_boletos['codigo_barras'];
      
	  $banco1 = $banco['0'];
	  $banco2 = $banco['1'];
	  $banco3 = $banco['2'];
	  
	  $banco = "$banco1$banco2$banco3";
	  
	 if($banco == '077'){
		echo "https://upload.wikimedia.org/wikipedia/commons/c/c1/Bancointer_oficial.png";
	  }elseif($banco == '341'){
		echo "https://tradersclub.com.br/wp-content/uploads/2019/01/itau.jpg";
	  }elseif($banco == '212'){
		echo "https://upload.wikimedia.org/wikipedia/commons/a/a5/LogoBancoOriginal.jpg";
	  }elseif($banco == '237'){
		echo "https://www.abcdacomunicacao.com.br/wp-content/uploads/Bradesco_logo.png";
	  }elseif($banco == '318'){
		echo "https://upload.wikimedia.org/wikipedia/commons/thumb/c/ca/Banco_BMG.svg/1200px-Banco_BMG.svg.png";
	  }else{
	  	echo "https://i0.wp.com/metacarpo.com.br/wp-content/uploads/2015/07/Emiss%C3%A3o-2-via-Boleto-Banco-do-Brasil.jpg";
	  }
	  ?>    
    " alt="" width="88" height="54" /></td>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><h1 style="font:23px Arial, Helvetica, sans-serif; padding:0; margin:0;"><strong><? echo $banco; ?> - 9 | <? echo $codigo_barras; ?></strong></h1></td>
  </tr>
  <tr>
    <td width="586" bgcolor="#FFFFFF"><strong>Local de Pagamento </strong><br />Pagavel em qualquer banco at&eacute; o vencimento </td>
    <td width="167" bgcolor="#CCCCCC"><strong>Vencimento</strong> <br />
    <? echo $vencimento; ?></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"><strong>Benefici&aacute;rio<br />
    </strong>Correspondente autorizado: <strong>VESTE PRIME</strong></td>
    <td bgcolor="#FFFFFF"><strong>Ag&ecirc;ncia/ C&oacute;digo Benefici&aacute;rio <br />
    2622-2 / 30604-5</strong></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#EAEA00">
     <? if($banco == '077'){ ?>    
    <img src="../img/nao_aceitar.fw.png" width="722" height="30" />
     <? }else{ ?>
     <strong style="font:20px Arial, Helvetica, sans-serif; margin:0; padding:0;">Cobrar juros e multas após o venciemnto</strong>     
     <? } ?>    
    </td>
    <td bgcolor="#FFFFFF"><strong>Nosso N&uacute;mero</strong> <br />
    <? echo $res_boletos['proposta']; ?></td>
  </tr>
  <tr>
    <td colspan="2" rowspan="5" bgcolor="#FFFFFF"><strong>OBSERVA&Ccedil;&Otilde;ES AO CAIXA</strong><br />
      <ul>
		<? if($banco == '077'){ ?>    
        <li>N&atilde;o aceitar ap&oacute;s o vencimento</li>
		<? } ?>
        <li>N&atilde;o aceitar cheque para pagamento</li>
      </ul>
      <strong>PREZADO CLIENTE</strong>
      <ul>
        <li>SE PRECISAR, SOLICITE OUTRO BOLETO PELO TELEFONE/WHATSAPP +55 (11) 96665-9661</li>
        <li>20 dias ap&oacute;s o vencimento o cliente ter&aacute; seu CPF inscrito nos ORG&Atilde;OS DE PROTE&Ccedil;&Atilde;O AO CR&Eacute;DITO.</li>
        <li>Ap&oacute;s o vencimento ser&aacute; cobrado multa de 9,99% e juros de 1% ao dia al&eacute;m do IOF</li>
    </ul></td>
    <td bgcolor="#FFFFFF"><strong>(=) Valor documento </strong> <br />
    R$ <? echo number_format($valor,2, ',','.'); ?></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">(-) Desconto/abatimento </td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">(+) Outras Dedu&ccedil;&otilde;es</td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">(+) Mora/multa</td>
  </tr>
  <tr>
    <td height="60" bgcolor="#CCCCCC"><strong>VALOR A RECERBER</strong> <br />
    R$ <? echo number_format($valor,2, ',','.'); ?></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#FFFFFF"><strong>PAGADOR</strong><br />
    
	<?
	$sql_emprestimo = mysqli_query($conexao_bd, "SELECT * FROM emprestimo_boleto WHERE n_proposta = '".$_GET['proposta']."'");
	 while($res_emprestimo = mysqli_fetch_array($sql_emprestimo)){
		$sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '".$res_emprestimo['cpf']."'");
			while($res_cliente = mysqli_fetch_array($sql_cliente)){
	?>
      <? echo strtoupper($res_cliente['nome']); ?><br />
      <? echo strtoupper($res_cliente['endereco']); ?> - <? echo strtoupper($res_cliente['n_residencia']); ?><br />
    <? echo strtoupper($res_cliente['cep']); ?> - <? echo strtoupper($res_cliente['bairro']); ?> - <? echo strtoupper($res_cliente['cidade']); ?> - <? echo strtoupper($res_cliente['estado']); ?></td>
    <td bgcolor="#FFFFFF"><strong>CPF DO PAGADOR</strong><br />
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
    <? }} ?></td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#FFFFFF"><img src="../img/code_barras.png" width="377" height="48" /></td>
  </tr>
</table>
<p>-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
</p>
<p>
  <? } ?>
</p>
<p>&nbsp;</p>
</body>
</html>