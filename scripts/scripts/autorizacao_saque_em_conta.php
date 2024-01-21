<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/autorizacao_saque_em_conta.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?
require "../config.php";
$cliente = $_GET['cliente'];
$autenticacao = $_GET['autenticacao'];
$valor = $_GET['valor'];

$sql_verifica_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '$cliente'");
	while($res_cliente = mysqli_fetch_array($sql_verifica_cliente)){

$sql_extrato = mysqli_query($conexao_bd, "SELECT * FROM extrato_bancario WHERE code_transacao = '$autenticacao'");		
if(mysqli_num_rows($sql_extrato) == ''){
	mysqli_query($conexao_bd, "INSERT INTO extrato_bancario (dia, mes, ano, data, data_completa, ip, status, tipo, code_transacao, valor, cliente, operador, descricao) VALUES ('$dia', '$mes', '$ano', '$data', '$data_completa', '$ip', 'Ativo', 'DEBITO', '$autenticacao', '$valor', '$cliente', '$operador', 'SAQUE COM DÉBITO EM CONTA')");
}else{
}

?>
<table width="279" border="1">
  <tr>
    <td colspan="2" align="center" bgcolor="#0033CC"><h1><img src="../img/logo.png" width="270" height="123" /></h1> 
      <h2>saque com  D&Eacute;BITO EM CONTA<br /><?  echo date("d/m/Y H:i:s");?><br />
    </h2>
  </td>
  </tr>
  <tr>
    <td width="133" bgcolor="#CCCCCC"><strong>banco</strong></td>
    <td width="155" bgcolor="#CCCCCC"><strong>tipo de conta</strong></td>
  </tr>
  <tr>
    <td>banco do brasil</td>
    <td>corrente</td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC"><strong>ag&ecirc;ncia</strong></td>
    <td bgcolor="#CCCCCC"><strong>n&ordm; da conta</strong></td>
  </tr>
  <tr>
    <td>2622-0</td>
    <td>30604-5</td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC"><strong>identificador</strong></td>
    <td bgcolor="#CCCCCC"><strong>valor da transA&Ccedil;&Atilde;O</strong></td>
  </tr>
  <tr>
    <td><? echo $cliente; ?></td>
    <td>R$ <? echo number_format($_GET['valor'],2); ?></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#CCCCCC"><strong>cliente</strong></td>
  </tr>
  <tr>
    <td colspan="2"><? echo $res_cliente['nome']; ?></td>
  </tr>
  <tr>
    <td colspan="4" bgcolor="#CCCCCC"><strong>Autorização de débito emitido na(o) <br /> 
    VESTE PRIME - VESTU&Aacute;RIO E ACESS&Oacute;RIOS DE CELULARES
</strong><br />
cnpj: 32.450.862/0001-02 <br />
RUA capit&atilde;o in&aacute;cio prata - 2010 - Taiba <br />
s&atilde;o gon&ccedil;alo do amarante - cear&aacute; <br />
<strong>cep: </strong>62670-000 <br />
<strong>telefone: </strong>(85) 3315.6219</td>
  </tr>
  <tr>
    <td colspan="2"><strong>uso do cheque especial</strong></td>
  </tr>
  <tr>
    <td colspan="2">R$ <? 
	
	$cheque = number_format(-$_GET['cheque_especial'],2);
	if($cheque <=0){
		echo "0,00";
	}else{
		echo $cheque;
	}
	
	?></td>
  </tr>
  <tr>
    <td height="36" colspan="2"><strong>juros  m&aacute;ximo a ser cobrado por 30 dias de uso do cheque especial</strong></td>
  </tr>
  <tr>
    <td colspan="2">R$ <? $juros = number_format((-($_GET['cheque_especial']*0.0089*30)),2); 
	
	if($juros <=0){
		echo "0,00";
	}else{
		echo $juros;
	}	
	
	?></td>
  </tr>
  <tr>
    <td colspan="2" align="center" bgcolor="#CCCCCC"><strong>saque autenticada com senha de seguran&ccedil;a</strong></td>
  </tr>
  <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><p><strong>AUTENTICA&Ccedil;&Atilde;O</strong> <br /><? echo $autenticacao; ?></p></td>
  </tr>
  <tr>
    <td colspan="2" align="justify" bgcolor="#FFFFFF">autorizo por meio de senha eletr&ocirc;nica e por assinatura manual debitar em minha conta/cheque especial a import&acirc;ncia de R$ <? echo number_format($_GET['valor'],2); ?>.
      <p>RECONHE&Ccedil;O MINHA D&Iacute;VIDA descrita acima  informada e declaro que pagarei o valor relativo ao cheque especial no prazo máximo de 30 dias corridos..</p>
      <p>tenho plena e total convic&ccedil;&atilde;o e estou em pleno acordo que se eu n&atilde;o pagar a divida do uso do cheque especial por at&eacute; 60 dias corridos terei meu nome inclu&iacute;do nos org&atilde;os de prote&ccedil;&atilde;o ao cr&eacute;dito.</p>
    <p>&nbsp;</p>
    <p>__________________________________________</p>
    <p>cliente: <? echo $res_cliente['nome']; ?></p></td>
  </tr>
</table>
<? } ?>
</div><!-- topo_geral -->
</body>
</html>