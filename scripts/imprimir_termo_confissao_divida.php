<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>TERMO DE NEGOCIAÇÃO</title>
<style type="text/css">
body {
	background-color: #FFF;
	text-align:center;
	font:15px Arial, Helvetica, sans-serif;
	white-space:normal;
	line-height:1.8;
}
body h3{
	font:12px Arial, Helvetica, sans-serif;
	}
body .table{
	text-align:center;
	}
</style>
</head>

<body>
<?

require "../conexao.php";

$cliente = $_GET['cliente'];

$sql_clientes = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '$cliente'");
while($res_cliente = mysqli_fetch_array($sql_clientes)){
?>
<table width="996" border="0">
  <tr>
    <td colspan="6" align="center"><img src="../img/logo.png" width="187" height="98" /></td>
  </tr>
  <tr>
    <td colspan="6" align="center"><h1 style="font:18px Arial, Helvetica, sans-serif;"><strong>TERMO DE  NEGOCIA&Ccedil;&Atilde;O DE D&Eacute;BITOS</strong></h1></td>
  </tr>
  <tr>
    <td colspan="6" align="center"><h1 style="font:15px Arial, Helvetica, sans-serif; text-align:left;"><img src="../img/dados_cliente.fw.png" width="1000" height="40" /></h1></td>
  </tr>
  <tr>
    <td colspan="2" align="center" bgcolor="#999999"><strong>Nome:</strong></td>
    <td colspan="2" align="center" bgcolor="#999999"><strong>Nome da m&atilde;e:</strong></td>
    <td colspan="2" align="center" bgcolor="#999999"><strong>Nome do pai:</strong></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><? echo strtoupper($res_cliente['nome']); ?></td>
    <td colspan="2" align="center"><? echo strtoupper($res_cliente['mae']); ?></td>
    <td colspan="2" align="center"><? echo strtoupper($res_cliente['pai']); ?></td>
  </tr>
  <tr>
    <td colspan="2" align="center" bgcolor="#999999"><strong>CPF:</strong></td>
    <td width="162" align="center" bgcolor="#999999"><strong>RG:</strong></td>
    <td width="142" align="center" bgcolor="#999999"><strong>Org. Expeditor</strong></td>
    <td width="162" align="center" bgcolor="#999999"><strong>Emiss&atilde;o:</strong></td>
    <td width="209" align="center" bgcolor="#999999"><strong>UF Expeditor:</strong></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><? echo strtoupper($res_cliente['cpf']); ?></td>
    <td align="center"><? echo strtoupper($res_cliente['rg']); ?></td>
    <td align="center"><? echo strtoupper($res_cliente['orgao_expeditor']); ?></td>
    <td align="center"><? echo $res_cliente['date_exp']; ?></td>
    <td align="center"><? echo strtoupper($res_cliente['uf_rg']); ?></td>
  </tr>
  <tr>
    <td width="145" bgcolor="#999999"><strong>Data de nascimento:</strong></td>
    <td width="160" bgcolor="#999999"><strong>Nacionalidade:</strong></td>
    <td bgcolor="#999999"><strong>Naturalidade:</strong></td>
    <td bgcolor="#999999"><strong>Sexo:</strong></td>
    <td bgcolor="#999999"><strong>Estado C&iacute;vil:</strong></td>
    <td bgcolor="#999999"><strong>C&ocirc;njuge:</strong></td>
  </tr>
  <tr>
    <td align="center"><? echo strtoupper($res_cliente['nascimento']); ?></td>
    <td align="center"><? echo strtoupper($res_cliente['nacionalidade']); ?></td>
    <td align="center"><? echo strtoupper($res_cliente['naturalidade']); ?></td>
    <td align="center"><? echo strtoupper($res_cliente['sexo']); ?></td>
    <td align="center"><? echo strtoupper($res_cliente['estado_civil']); ?></td>
    <td align="center"><? echo strtoupper($res_cliente['conjuge']); ?></td>
  </tr>
  <tr>
    <td colspan="6" align="left"><hr /><strong style="text-align:left;">Endere&ccedil;o:</strong> <? echo strtoupper($res_cliente['endereco']); ?>, <? echo strtoupper($res_cliente['n_residencia']); ?>,<? echo strtoupper($res_cliente['bairro']); ?> - <? echo strtoupper($res_cliente['cidade']); ?>, <? echo strtoupper($res_cliente['estado']); ?>, CEP: <? echo strtoupper($res_cliente['cep']); ?></td>
  </tr>
  <tr>
    <td colspan="6" align="center"><img src="../img/dados_da_negociacao.fw.png" width="1000" height="40" /></td>
  </tr>
  <tr>
    <td colspan="6" align="center"><table class="table" width="996" border="0">
      <tr>
        <td width="68" bgcolor="#666666">STATUS</td>
        <td width="105" bgcolor="#666666">N&deg; NEGO.</td>
        <td width="78" bgcolor="#666666">VL. TOTAL</td>
        <td width="87" bgcolor="#666666">DESCONTO</td>
        <td width="84" bgcolor="#666666">VL. PAGAR</td>
        <td width="115" bgcolor="#666666">FORM. PAG</td>
        <td width="104" bgcolor="#666666">VENCIMENTO</td>
        <td width="103" bgcolor="#666666">N&deg; PARCELAS</td>
        <td width="111" bgcolor="#666666">VL. PARCELA</td>
        <td width="97" bgcolor="#666666">VL. TOTAL</td>
      </tr>
     <?
	 $sql_negociacao = mysqli_query($conexao_bd, "SELECT * FROM dados_da_divida_negociacao_fechado WHERE code_negociacao = '".$_GET['negociacao']."'");
	  while($res_negociacao = mysqli_fetch_array($sql_negociacao)){
	 ?>   
      <tr>
        <td><h3><? echo $res_negociacao['status']; ?></h3></td>
        <td><h3><? echo $res_negociacao['total_dividas']; ?></h3></td>
        <td><h3><? echo  number_format($res_negociacao['vl_total'],2,',','.'); ?></h3></td>
        <td><h3><? echo  number_format($res_negociacao['desconto'],2,',','.'); ?></h3></td>
        <td><h3><? echo  number_format($res_negociacao['vl_pagar'],2,',','.'); ?></h3></td>
        <td><h3><? echo  $res_negociacao['forma_pag']; ?></h3></td>
        <td><h3><? echo  $res_negociacao['dia_vencimento']; ?></h3></td>
        <td><h3><? echo  $res_negociacao['parcelas']; ?></h3></td>
        <td><h3><? echo  number_format($res_negociacao['valor_parcela'],2,',','.'); ?></h3></td>
        <td><h3><? echo  number_format($res_negociacao['vl_total_negociado'],2,',','.'); ?></h3></td>
      </tr>
      <? } ?>
    </table></td>
  </tr>
  <tr>
    <td colspan="6" align="left"><strong>Declaro que estou de acordo com os termos: </strong>
      <ul>
        <li>A negocia&ccedil;&atilde;o se iniciar&aacute; quando for paga a primeira parcela descrita no termo de negocia&ccedil;&atilde;o acima.</li>
        <li>Ap&oacute;s o in&iacute;cio desde acordo de pagamento, ser&atilde;o cobradas juros e multa em caso de atraso nas demais parcelas.</li>
        <li>Esta negocia&ccedil;&atilde;o estar&aacute; finalizada somente ap&oacute;s a quita&ccedil;&atilde;o integral de todas as parcelas.</li>
        <li>Estou ciente que em caso de mais de 60 (sessenta) dias de atraso, terei que arcar com todos os custos de uma nova negocia&ccedil;&atilde;o, al&eacute;m de ter a ci&ecirc;ncia que terei meu nome inscrito nos org&atilde;os de prote&ccedil;&atilde;o ao cr&eacute;dito.</li>
    </ul></td>
  </tr>
  <tr>
    <td colspan="6" align="center"><p>_______________________,  <? echo date("d"); ?> de 
        <? $mes = date("m");
		
		if($mes == '1'){
			echo "janeiro";
		}elseif($mes == '2'){
			echo "fevereiro";
		}elseif($mes == '3'){
			echo "mar&ccedil;o";
		}elseif($mes == '4'){
			echo "abril";
		}elseif($mes == '5'){
			echo "maio";
		}elseif($mes == '6'){
			echo "junho";
		}elseif($mes == '7'){
			echo "julho";
		}elseif($mes == '8'){
			echo "agosto";
		}elseif($mes == '9'){
			echo "setembro";
		}elseif($mes == '10'){
			echo "outubro";
		}elseif($mes == '11'){
			echo "novembro";
		}else{
			echo "dezembro";
		}
	
	 ?>
 de <? echo date("Y"); ?></p>
      <p>&nbsp;</p>
<p>______________________________________</p>
<p><? echo strtoupper($res_cliente['nome']); ?></p>
      <p>CPF: <? echo strtoupper($res_cliente['cpf']); ?></p>
      <p>&nbsp;</p>
<p>______________________________________</p>
    <p>Operador: Marcos Rodrigues de Oliveira</p></td>
  </tr>
</table>
<hr />

<table style="border:1px solid #000;" width="996" border="0">
  <tr>
    <td align="center"><p style="line-height:1.5;"><strong>VESTE PRIME</strong><br />CNPJ: 32.450.862/0001-02<br />
    Rua Capit&atilde;o In&aacute;cio Prata, 2010 - Ta&iacute;ba - S&atilde;o Gon&ccedil;alo do Amarante - Cear&aacute;<br />
    CEP: 62670-000
    </p></td>
  </tr>
</table>
<? } ?>
</body>
</html>