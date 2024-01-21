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
<h1 style="font:30px Arial, Helvetica, sans-serif;"><strong>BOLETO DE PAGAMENTO NEGOCIAÇÃO DE DÉBITOS</strong></h1>
<hr />
<?
require "../conexao.php";

$code_vencimento_hoje = 0;

$sql_code_vencimento = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento WHERE vencimento = '$data'");
while($res_code_vencimento = mysqli_fetch_array($sql_code_vencimento)){
	$code_vencimento_hoje = $res_code_vencimento['codigo'];
}

?>
<?
    
	$sql_boleto = mysqli_query($conexao_bd, "SELECT * FROM boletos_negociacao WHERE proposta = '".$_GET['proposta']."' AND id = '".$_GET['id']."'");
	 while($res_boleto = mysqli_fetch_array($sql_boleto)){
		$sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '".$res_boleto['cliente']."'");
			while($res_cliente = mysqli_fetch_array($sql_cliente)){
	?>
<table width="900" border="0">
  <tr>
    <td width="96" rowspan="2"><img src="../img/logo.png" width="143" height="82" /></td>
    <td colspan="4" align="center" bgcolor="#FFFFFF"><h1 style="font:20px Arial, Helvetica, sans-serif;"><strong>CORRESPONDE AUTORIZADO</strong></h1>
    <h1 style="font:20px Arial, Helvetica, sans-serif;"><strong>VESTE PRIME - ELETR&Ocirc;NICOS E ACESS&Oacute;RIOS</strong></h1></td>
  </tr>
  <tr>
    <td width="236" bgcolor="#FFFFFF"><strong>CPF:</strong> <? echo strtoupper($res_cliente['cpf']); ?></td>
    <td width="487" colspan="2" bgcolor="#FFFFFF"><strong>CLIENTE:</strong> <? echo strtoupper($res_cliente['nome']); ?></td>
  </tr>
</table>
<? }} ?>

<p>-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</p>
<table width="900" border="0">
  <tr>
    <td width="129" align="center" rowspan="3" bgcolor="#FFFFFF"><img src="
      <?

    
	$sql_boleto = mysqli_query($conexao_bd, "SELECT * FROM boletos_negociacao WHERE proposta = '".$_GET['proposta']."' AND id = '".$_GET['id']."'");
	 while($res_boletos = mysqli_fetch_array($sql_boleto)){

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
	  	echo "https://i0.wp.com/metacarpo.com.br/wp-content/uploads/2015/07/Emissf%C3%A3o-2-via-Boleto-Banco-do-Brasil.jpg";
	  }
	  ?>    
    " alt="" width="88" height="54" /></td>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><h1 style="font:23px Arial, Helvetica, sans-serif; padding:0; margin:0;"><strong><? echo $banco; ?> - 9 | <? echo $res_boletos['codigo_barras']; ?></strong></h1></td>
  </tr>
  <tr>
    <td width="586" bgcolor="#FFFFFF"><strong>Local de Pagamento </strong><br />Pagavel em qualquer banco at&eacute; o vencimento </td>
    <td width="167" bgcolor="#CCCCCC"><strong>Vencimento</strong> <br />
    <? 
	
	$sql_code_vencimento = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento WHERE codigo = '".$res_boletos['vencimento']."'");
	while($res_code_vencimento = mysqli_fetch_array($sql_code_vencimento)){
		echo $code_vencimento_hoje = $res_code_vencimento['vencimento'];
	}
	
	?></td>
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
    R$ <? echo number_format($res_boletos['valor'],2, ',','.'); ?></td>
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
    R$ <? echo number_format($res_boletos['valor'],2, ',','.'); ?></td>
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
    <? }}} ?></td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#FFFFFF"><img src="../img/code_barras.png" width="377" height="48" /></td>
  </tr>
</table>
<p>-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
</p>
<p>
</p>
<p>&nbsp;</p>
</body>
</html>