<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
body,td,th {
	color: #000;
	font:15px Arial, Helvetica, sans-serif;
}
</style>
<? require "../conexao.php"; ?>
</head>

<body>
<script language="javascript">window.print();</script>

<?
$sql_beneficiario = mysqli_query($conexao_bd, "SELECT * FROM auxilio_emergencial WHERE code = '".$_GET['code']."'");
while($res_beneficiario = mysqli_fetch_array($sql_beneficiario)){
?>
<table width="950" border="0">
  <tr>
    <td width="153"><img src="../img/logo.png" width="153" height="80" /></td>
    <td colspan="4" align="center"><h1 style="font:30px Arial, Helvetica, sans-serif;"><strong>AUTROIZA&Ccedil;&Atilde;O DE SAQUE/TRANSFER&Ecirc;NCIA CAIXA TEM</strong></h1></td>
    <td width="159">
    <? if($res_beneficiario['beneficio'] == 'AUXILIO EMERGENCIAL'){ ?>
    <img src="../img/auxilio.jpg" alt="" width="159" height="88" />
    <? }elseif($res_beneficiario['beneficio'] == 'BOLSA FAMILIA'){ ?>
    <img src="../img/bolsa_familia.jpg" alt="" width="159" height="88" />
    <? }elseif($res_beneficiario['beneficio'] == 'FGTS'){ ?>
    <img src="../img/fgts.png" alt="" width="159" height="88" />
    <? }else{ ?>
    <img src="../img/caixa_tem.png" alt=""  width="159" height="88" />
    <? } ?>
    </td>
  </tr>
  <tr>
    <td colspan="6" align="center" bgcolor="#CCCCCC"><strong>DADOS DO TITULAR DO BENEFICIO</strong></td>
  </tr>
<?


$sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '".$res_beneficiario['cpf_auxilio']."'");
while($res_cliente = mysqli_fetch_array($sql_cliente)){

?>
  <tr>
    <td colspan="2"><strong>NOME</strong></td>
    <td width="165"><strong>CPF</strong></td>
    <td width="182"><strong>NASCIMENTO</strong></td>
    <td width="201"><strong>IDENTIDADE/ORGAO EXPEDITOR</strong></td>
    <td><strong>DATA DE EXPEDI&Ccedil;&Atilde;O</strong></td>
  </tr>
  <tr>
    <td colspan="2"><? echo $res_cliente['nome']; ?></td>
    <td><? echo $res_cliente['cpf']; ?></td>
    <td width="182"><? echo $res_cliente['nascimento']; ?></td>
    <td width="201"><? echo $res_cliente['rg']; ?>/<? echo $res_cliente['orgao_expeditor']; ?></td>
    <td><? echo $res_cliente['date_exp']; ?></td>
  </tr>
  <tr>
    <td colspan="2"><strong>ESTADO CIV&Iacute;L</strong></td>
    <td><strong>SEXO</strong></td>
    <td width="182"><strong>NOME DO PAI</strong></td>
    <td width="201"><strong>NOME DA M&Atilde;E</strong></td>
    <td><strong>NATURALIDADE</strong></td>
  </tr>
  <tr>
    <td colspan="2"><? echo $res_cliente['estado_civil']; ?></td>
    <td><? echo $res_cliente['sexo']; ?></td>
    <td width="182"><? echo $res_cliente['pai']; ?></td>
    <td width="201"><? echo $res_cliente['mae']; ?></td>
    <td><? echo $res_cliente['naturalidade']; ?></td>
  </tr>
  <tr>
    <td colspan="4"><strong>ENDERE&Ccedil;O</strong></td>
    <td width="201"><strong>TELEFONE</strong></td>
    <td><strong>CELULAR</strong></td>
  </tr>
  <tr>
    <td colspan="4"><? echo $res_cliente['endereco']; ?>, <? echo $res_cliente['n_residencia']; ?> - <? echo $res_cliente['bairro']; ?> - <? echo $res_cliente['cidade']; ?> - <? echo $res_cliente['estado']; ?></td>
    <td width="201"><? echo $res_cliente['celular_1']; ?></td>
    <td><? echo $res_cliente['celular_2']; ?></td>
  </tr>
<? } ?>
  <tr>
    <td colspan="6" align="center" bgcolor="#CCCCCC"><strong>DADOS DE QUEM VAI RECEBER O BENEFICIO</strong></td>
  </tr>
<?
$sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '".$res_beneficiario['cpf_tira']."'");
while($res_cliente = mysqli_fetch_array($sql_cliente)){

?>
  <tr>
    <td colspan="2"><strong>NOME</strong></td>
    <td width="165"><strong>CPF</strong></td>
    <td width="182"><strong>NASCIMENTO</strong></td>
    <td width="201"><strong>IDENTIDADE/ORGAO EXPEDITOR</strong></td>
    <td><strong>DATA DE EXPEDI&Ccedil;&Atilde;O</strong></td>
  </tr>
  <tr>
    <td colspan="2"><? echo $nome = $res_cliente['nome']; ?></td>
    <td><? echo $cpf = $res_cliente['cpf']; ?></td>
    <td width="182"><? echo $res_cliente['nascimento']; ?></td>
    <td width="201"><? echo $res_cliente['rg']; ?>/<? echo $res_cliente['orgao_expeditor']; ?></td>
    <td><? echo $res_cliente['date_exp']; ?></td>
  </tr>
  <tr>
    <td colspan="2"><strong>ESTADO CIV&Iacute;L</strong></td>
    <td><strong>SEXO</strong></td>
    <td width="182"><strong>NOME DO PAI</strong></td>
    <td width="201"><strong>NOME DA M&Atilde;E</strong></td>
    <td><strong>NATURALIDADE</strong></td>
  </tr>
  <tr>
    <td colspan="2"><? echo $res_cliente['estado_civil']; ?></td>
    <td><? echo $res_cliente['sexo']; ?></td>
    <td width="182"><? echo $res_cliente['pai']; ?></td>
    <td width="201"><? echo $res_cliente['mae']; ?></td>
    <td><? echo $res_cliente['naturalidade']; ?></td>
  </tr>
  <tr>
    <td colspan="4"><strong>ENDERE&Ccedil;O</strong></td>
    <td width="201"><strong>TELEFONE</strong></td>
    <td><strong>CELULAR</strong></td>
  </tr>
  <tr>
    <td colspan="4"><? echo $res_cliente['endereco']; ?>, <? echo $res_cliente['n_residencia']; ?> - <? echo $res_cliente['bairro']; ?> - <? echo $res_cliente['cidade']; ?> - <? echo $res_cliente['estado']; ?></td>
    <td width="201"><? echo $res_cliente['celular_1']; ?></td>
    <td><? echo $res_cliente['celular_2']; ?></td>
  </tr>
<? } ?>
  <tr>
    <td colspan="6" align="center" bgcolor="#CCCCCC"><strong>DADOS DO SAQUE DO BENEFECICIO</strong></td>
  </tr>
  <tr>
    <td colspan="2"><strong>N&deg; DA RETIRADA</strong></td>
    <td><strong>TIPO</strong></td>
    <td><strong>VALOR</strong></td>
    <td><strong>TARIFA</strong></td>
    <td><strong>TIPO DE RETIRADA</strong></td>
  </tr>
  <tr>
    <td colspan="2"><? echo $res_beneficiario['code']; ?></td>
    <td><? echo $res_beneficiario['beneficio']; ?></td>
    <td>R$ <? echo number_format($res_beneficiario['valor'],2,',',''); ?></td>
    <td>R$ <? echo number_format($res_beneficiario['tarifa'],2,',',''); ?></td>
    <td><? echo $res_beneficiario['tipo']; ?></td>
  </tr>
  <tr>
    <td colspan="6"><hr /></td>
  </tr>
  <tr>
    <td colspan="6" align="justify"><br />Eu <strong><? echo $nome; ?></strong>, autorizo a VESTE PRIME a fazer a retirada do meu benefício que se encontra no aplicativo CAIXA TEM no valor de R$ <? echo number_format($res_beneficiario['valor'],2,',',''); ?> e tenho total ciência que será descontado uma tarifa no valor de R$ <? echo number_format($res_beneficiario['tarifa'],2,',',''); ?>. Também declaro que estou ciente e disposto a declarar em qualquer meio formal ou informal inclusive a prestar depoimento caso necessário que estou ciente da retirada dos recursos e do pagamento da tarifa que é desconta no ato do repasse do saldo.
    <br />
    <br />
    <br />
    <br /> 
     <br />
    <br />
    <br />
    <br />    
    </td>
  </tr>
  <tr>
    <td colspan="6" align="center">
    São Gonçalo do Amarante, <? echo date("d"); ?> de <?
    
	if($mes == '01'){
		echo "janeiro";
	}elseif($mes == '02'){
		echo "fevereiro";
	}elseif($mes == '03'){
		echo "março";
	}elseif($mes == '04'){
		echo "abril";
	}elseif($mes == '05'){
		echo "maio";
	}elseif($mes == '06'){
		echo "junho";
	}elseif($mes == '07'){
		echo "julho";
	}elseif($mes == '08'){
		echo "agosto";
	}elseif($mes == '09'){
		echo "setembro";
	}elseif($mes == '10'){
		echo "outubro";
	}elseif($mes == '11'){
		echo "novembro";
	}else{
		echo "dezembro";
	}
	
	?> de <? echo date("Y"); ?>.
    <br />
    <br />
    <br />
    <br />     
    <br />
    <br />
    <br />
    <br />     
    <strong>X</strong>__________________________________________________
    <br />
    <? echo $nome; ?>
    <br />
    CPF: <? echo $cpf; ?>
    
    
    </td>
  </tr>
<? } ?>
</table>
</body>
</html>